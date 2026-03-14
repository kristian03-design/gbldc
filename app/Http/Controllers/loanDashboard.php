<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\loan;
use App\Models\paymentModel;
use App\Models\QRCode;
class loanDashboard extends Controller
{
    public function view(){
        $fist_name = Auth::guard('officialmember')->user()->first_name;
        $middle_name = Auth::guard('officialmember')->user()->middle_name;
        $last_name = Auth::guard('officialmember')->user()->last_name;
        $email = Auth::guard('officialmember')->user()->email;
        $member_id = Auth::guard('officialmember')->user()->member_id;
        $gender = Auth::guard('officialmember')->user()->gender;
        $PaymentHistory = paymentModel::where('member_id', $member_id)->get();
        $loans = loan::where('member_id', $member_id)->get();

        $loanInfo = loan::where('member_id', $member_id)->where('loan_status', '!=', 'Fully Paid')->orderBy('created_at', 'desc')->first();
        $sharedCapitalInfo = \App\Models\sharedCapital::where('member_id', $member_id)->first();

        // Get active QR code
        $activeQRCode = QRCode::where('is_active', true)->first();

        // Calculate current due amounts
        $currentDueLoan = $loanInfo ? $loanInfo->due_amount : 'Not set';
        $currentDueSharedCapital = $sharedCapitalInfo ? $sharedCapitalInfo->payment_amount_per_schedule : 'Not set';

        // Get payment start dates
        $loanPaymentStartDate = $loanInfo ? $loanInfo->payment_start_date : null;
        $sharedCapitalPaymentStartDate = $sharedCapitalInfo ? $sharedCapitalInfo->payment_start_date : null;

        // dd($loanInfo);
        return view('Members.LoanDashboard', compact('fist_name', 'middle_name', 'last_name','email','loanInfo','PaymentHistory','loans', 'sharedCapitalInfo', 'currentDueLoan', 'currentDueSharedCapital', 'loanPaymentStartDate', 'sharedCapitalPaymentStartDate', 'gender', 'activeQRCode'));
    }

    public function paymentSchedule($type = null){
        $fist_name = Auth::guard('officialmember')->user()->first_name;
        $middle_name = Auth::guard('officialmember')->user()->middle_name;
        $last_name = Auth::guard('officialmember')->user()->last_name;
        $email = Auth::guard('officialmember')->user()->email;
        $member_id = Auth::guard('officialmember')->user()->member_id;
        $gender = Auth::guard('officialmember')->user()->gender;

        $currentDay = date('j');
        $currentMonth = date('n');
        $currentYear = date('Y');

        $loanInfo = null;
        $sharedCapitalInfo = null;
        $loanScheduleData = null;
        $sharedCapitalScheduleData = null;
        $paymentHistory = paymentModel::where('member_id', $member_id)->get();

        if ($type === 'loan' || $type === null) {
            $loanInfo = loan::where('member_id', $member_id)->first();
            if ($loanInfo) {
                // Generate loan schedule data based on frequency and term
                $loanScheduleData = $this->generateScheduleData(
                    $loanInfo->frequency_of_payment ?? 'monthly', 
                    $loanInfo->payment_start_date ?? null, 
                    $paymentHistory, 
                    'Loan Payment',
                    $loanInfo->loan_term
                );
            }
        }

        if ($type === 'shared_capital' || $type === null) {
            $sharedCapitalInfo = \App\Models\sharedCapital::where('member_id', $member_id)->first();
            if ($sharedCapitalInfo) {
                // Generate shared capital schedule data
                $sharedCapitalScheduleData = $this->generateScheduleData($sharedCapitalInfo->payment_frequency ?? 'monthly', $sharedCapitalInfo->payment_start_date ?? null, $paymentHistory, 'Shared Capital');
            }
        }

        return view('Members.PaymentSchedule', compact(
            'fist_name', 'middle_name', 'last_name', 'email',
            'loanInfo', 'sharedCapitalInfo', 'loanScheduleData', 'sharedCapitalScheduleData', 'type',
            'currentDay', 'currentMonth', 'currentYear', 'gender'
        ));
    }

    private function generateScheduleData($frequency, $paymentStartDate = null, $paymentHistory = null, $paymentType = 'Payment', $loanTermStr = null) {
        $currentYear = date('Y');
        $currentMonth = date('m');
        $frequency = strtolower($frequency);

        // Parse Loan Term into Months (e.g. "6 Months" -> 6)
        $termMonths = 12; // Default to 12 if not provided or parsing fails
        if ($loanTermStr && preg_match('/(\d+)/', (string) $loanTermStr, $matches)) {
            $termMonths = (int) $matches[1];
        }

        if (str_contains(strtolower($frequency), 'daily') || str_contains(strtolower($frequency), 'weekly')) {
            $paymentDays = [];
            $daysInMonth = date('t', strtotime("$currentYear-$currentMonth-01"));

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $isPaymentDay = false;
                $isOverdue = false;
                $paymentMade = false;

                // Determine if this is a payment day based on frequency and start date
                if ($paymentStartDate) {
                    $startDate = new \DateTime($paymentStartDate);
                    $currentDate = new \DateTime("$currentYear-$currentMonth-$day");

                    if (str_contains(strtolower($frequency), 'daily')) {
                        $isPaymentDay = ($currentDate >= $startDate);
                    } elseif (str_contains(strtolower($frequency), 'weekly')) {
                        $daysDiff = $startDate->diff($currentDate)->days;
                        $isPaymentDay = ($daysDiff % 7 == 0 && $currentDate >= $startDate);
                    }
                }

                // Check if payment was made for this day
                if ($paymentHistory && $isPaymentDay) {
                    $paymentDate = date('Y-m-d', strtotime("$currentYear-$currentMonth-$day"));
                    $paymentMade = $paymentHistory->where('transaction_date', $paymentDate)->where('transaction_type', $paymentType)->count() > 0;
                }

                // Check if payment is overdue (past due date and not paid)
                if ($isPaymentDay && !$paymentMade) {
                    $paymentDueDate = strtotime("$currentYear-$currentMonth-$day");
                    $today = strtotime(date('Y-m-d'));
                    $isOverdue = ($paymentDueDate < $today);
                }

                $paymentDays[] = [
                    'day' => $day,
                    'isPaymentDay' => $isPaymentDay,
                    'isOverdue' => $isOverdue,
                    'paymentMade' => $paymentMade
                ];
            }

            return [
                'type' => 'calendar',
                'frequency' => $frequency,
                'year' => $currentYear,
                'month' => $currentMonth,
                'days' => $daysInMonth,
                'paymentDays' => $paymentDays
            ];
        } else {
            // Monthly Setup
            $months = [];
            $currentMonthNum = (int) date('n');
            $currentYearNum  = (int) date('Y');
            $todayDate       = new \DateTime(date('Y-m-d'));
            
            // Start Date Setup
            $startDate = null;
            if ($paymentStartDate) {
                $startDate = new \DateTime($paymentStartDate);
            } else {
                $startDate = new \DateTime(date('Y-m-01'));
            }

            for ($i = 0; $i < $termMonths; $i++) {
                // Determine exact month/year for this iteration
                $curStepDate = clone $startDate;
                $curStepDate->modify("+$i months");
                
                $monthName = $curStepDate->format('F');
                $monthNum  = (int) $curStepDate->format('n');
                $yearNum   = (int) $curStepDate->format('Y');
                
                // Check if payment was made for this specific month/year combination
                $paymentMade = false;
                $isOverdue = false;
                $isFuture = false;
                
                if ($paymentHistory) {
                    foreach ($paymentHistory as $payment) {
                        $paymentDate = new \DateTime($payment->transaction_date);
                        if ((int) $paymentDate->format('n') === $monthNum && 
                            (int) $paymentDate->format('Y') === $yearNum &&
                            $payment->transaction_type === $paymentType) {
                            $paymentMade = true;
                            break;
                        }
                    }
                    
                    if (!$paymentMade) {
                        // Is this due date strictly in the past? e.g. Year matches and Month is < current, OR Year < current.
                        if ($yearNum < $currentYearNum || ($yearNum === $currentYearNum && $monthNum < $currentMonthNum)) {
                            $isOverdue = true;
                        } else {
                            $isFuture = true;
                        }
                    }
                } else {
                    $isFuture = true; // No history at all = future if not paid. Technically should check if overdue based on calendar.
                    if ($yearNum < $currentYearNum || ($yearNum === $currentYearNum && $monthNum < $currentMonthNum)) {
                        $isOverdue = true;
                        $isFuture = false;
                    }
                }
                
                $months[] = [
                    'name' => $monthName,
                    'month' => $monthNum,
                    'year' => $yearNum,
                    'paymentMade' => $paymentMade,
                    'isOverdue' => $isOverdue,
                    'isFuture' => $isFuture
                ];
            }
            
            return [
                'type' => 'monthly',
                'frequency' => 'monthly',
                'months' => $months,
                'currentMonth' => $currentMonthNum,
                'currentYear' => $currentYearNum
            ];
        }
    }

    public function loanHistory(){
        $fist_name = Auth::guard('officialmember')->user()->first_name;
        $middle_name = Auth::guard('officialmember')->user()->middle_name;
        $last_name = Auth::guard('officialmember')->user()->last_name;
        $email = Auth::guard('officialmember')->user()->email;
        $member_id = Auth::guard('officialmember')->user()->member_id;
        $loans = loan::where('member_id', $member_id)->get();

        return view('Members.MemberLoanHistory', compact('fist_name', 'middle_name', 'last_name','email','loans'));
    }

    public function fullPaymentHistory(){
        $fist_name = Auth::guard('officialmember')->user()->first_name;
        $middle_name = Auth::guard('officialmember')->user()->middle_name;
        $last_name = Auth::guard('officialmember')->user()->last_name;
        $email = Auth::guard('officialmember')->user()->email;
        $member_id = Auth::guard('officialmember')->user()->member_id;
        $gender = Auth::guard('officialmember')->user()->gender;
        
        // Get ALL payment history (both Loan Payments and Shared Capital)
        $allPayments = paymentModel::where('member_id', $member_id)
            ->orderBy('transaction_date', 'desc')
            ->get();

        return view('Members.FullPaymentHistory', compact('fist_name', 'middle_name', 'last_name', 'email', 'allPayments', 'gender'));
    }

    public function checkLoanStatus(){
        $fist_name = Auth::guard('officialmember')->user()->first_name;
        $middle_name = Auth::guard('officialmember')->user()->middle_name;
        $last_name = Auth::guard('officialmember')->user()->last_name;
        $email = Auth::guard('officialmember')->user()->email;
        $member_id = Auth::guard('officialmember')->user()->member_id;
        $gender = Auth::guard('officialmember')->user()->gender;

        // Get current active loan (not fully paid)
        $currentLoan = loan::where('member_id', $member_id)
            ->where('loan_status', '!=', 'Fully Paid')
            ->orderBy('created_at', 'desc')
            ->first();

        // Get payment history for current loan
        $loanPaymentHistory = null;
        if ($currentLoan) {
            $loanPaymentHistory = paymentModel::where('member_id', $member_id)
                ->where('transaction_type', 'Loan Payment')
                ->where('loan_number', $currentLoan->loan_number)
                ->orderBy('transaction_date', 'desc')
                ->get();
        }

        // Calculate loan progress
        $loanProgress = 0;
        $totalPaid = 0;
        if ($currentLoan && $currentLoan->loan_amount > 0) {
            $totalPaid = $currentLoan->loan_amount - $currentLoan->loan_balance;
            $loanProgress = ($totalPaid / $currentLoan->loan_amount) * 100;
        }

        return view('Members.CheckLoanStatus', compact(
            'fist_name', 'middle_name', 'last_name', 'email', 'gender',
            'currentLoan', 'loanPaymentHistory', 'loanProgress', 'totalPaid', 'member_id'
        ));
    }

    public function underConstruction(){
        return view('Members.UnderConstruction');
    }

}
