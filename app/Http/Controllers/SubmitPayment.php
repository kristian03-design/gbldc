<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\PaymentModel;
use Illuminate\Http\Request;
use App\Models\SharedCapital;
use App\Models\officialmember;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SubmitPayment extends Controller
{
    public function pay(Request $request)
    {
        // Custom validation for reference_number uniqueness with encrypted field
        $request->validate([
            'loan_number' => 'nullable|string',
            'member_id' => 'required|string',
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'transaction_type' => 'required|string',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
            'transaction_date' => 'required|date',
            'transaction_handler' => 'required|string',
            'updater_name' => 'required|string',
            'reference_number' => 'required|string',
            'payment_amount' => 'required|numeric|min:0',
            'remarks' => 'nullable|string',
            'admin_copy' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'member_copy' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);
       
        $referenceDigits = preg_replace('/\D+/', '', (string) $request->reference_number);
        if (strlen($referenceDigits) !== 13) {
            return redirect()->back()->with('error', 'Reference number must be exactly 13 digits (GCash). Format: 0000/0000/00000.');
        }

        // #region agent log
        try {
            $logPayload = [
                'sessionId'    => '1fb5bb',
                'runId'        => 'pre-fix-ref',
                'hypothesisId' => 'H1',
                'location'     => 'SubmitPayment.php:pay',
                'message'      => 'Reference number normalized to 13 digits',
                'data'         => [
                    'raw_len'    => strlen((string) $request->reference_number),
                    'digits_len' => strlen((string) $referenceDigits),
                    'digits_last4'=> substr((string) $referenceDigits, -4),
                ],
                'timestamp'    => (int) round(microtime(true) * 1000),
            ];
            file_put_contents(base_path('debug-1fb5bb.log'), json_encode($logPayload) . PHP_EOL, FILE_APPEND);
        } catch (\Throwable $e) {
            // swallow logging errors
        }
        // #endregion

        // Check reference_number uniqueness manually for encrypted field
        $existingPayment = PaymentModel::where('reference_number', $referenceDigits)->first();
        if ($existingPayment) {
            return redirect()->back()->with('error', 'Reference number already exists. Please use a unique reference number.');
        }

        $pay = $request->all();
        $pay['reference_number'] = $referenceDigits;

        Log::info('Validation passed, data: ' . json_encode($pay));

        // #region agent log
        try {
            $logPayload = [
                'sessionId'    => '4b0db3',
                'runId'        => 'pre-fix-shared-capital-loan-number',
                'hypothesisId' => 'SC1',
                'location'     => 'SubmitPayment.php:pay',
                'message'      => 'SubmitPayment branch pre-check',
                'data'         => [
                    'transaction_type'     => $pay['transaction_type'] ?? null,
                    'loan_number_is_null'  => array_key_exists('loan_number', $pay) ? ($pay['loan_number'] === null) : null,
                    'loan_number_empty'    => array_key_exists('loan_number', $pay) ? (trim((string) $pay['loan_number']) === '') : null,
                ],
                'timestamp'    => (int) round(microtime(true) * 1000),
            ];
            file_put_contents(base_path('debug-4b0db3.log'), json_encode($logPayload) . PHP_EOL, FILE_APPEND);
        } catch (\Throwable $e) {
        }
        // #endregion

        // Handle file uploads (common for all transaction types)
        if ($request->hasFile('admin_copy')) {
            $file = $request->file('admin_copy');
            $filename = $request->last_name . $request->first_name . $request->middle_name . '.' . time() . '.admin_copy.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('Admin_Copy', $filename, 'local');
            $pay['admin_copy'] = $imagePath;
        }

        if ($request->hasFile('member_copy')) {
            $file = $request->file('member_copy');
            $filename = $request->last_name . $request->first_name . $request->middle_name . '.' . time() . '.member_copy.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('Member_Copy', $filename, 'local');
            $pay['member_copy'] = $imagePath;
        }
        
        // Get member email for notifications
        $memberEmail = $this->getMemberEmail($request->member_id);
        $memberName = $request->first_name . ' ' . $request->last_name;

        // Case 1: Loan payment without loan number (error)
        if ($pay['loan_number'] === null && $pay['transaction_type'] === 'Loan Payment') {
            return redirect()->back()->with('error', 'You need to provide Loan number.');
        }

        // Case 2: Loan payment with loan number
        elseif ($pay['loan_number'] !== null && $pay['transaction_type'] === 'Loan Payment') {
            $findLoanRecord = Loan::where('loan_number', $pay['loan_number'])->first();

            if (!$findLoanRecord) {
                return redirect()->back()->with('error', 'Loan record not found for this loan number.');
            }

            try {
                // Convert values to float before arithmetic operations
                $paymentAmount = (float) $pay['payment_amount'];
                $currentBalance = (float) $findLoanRecord->loan_balance;
                
                // Update loan balance
                $newBalance = $currentBalance - $paymentAmount;
                $findLoanRecord->loan_balance = (string) $newBalance;
                $findLoanRecord->save();

                // Create payment record
                $paymentRow = PaymentModel::create($pay);
                
                // Deduct from schedule table sequentially
                try {
                    $remainingPayment = $paymentAmount;
                    $schedules = \App\Models\LoanSchedule::where('loan_number', $pay['loan_number'])
                        ->whereIn('status', ['pending', 'partial'])
                        ->orderBy('due_date', 'asc')
                        ->get();
                        
                    foreach ($schedules as $schedule) {
                        if ($remainingPayment <= 0) break;
                        
                        $dueForThisMonth = (float) $schedule->monthly_payment - (float) $schedule->amount_paid;
                        
                        if ($remainingPayment >= $dueForThisMonth) {
                            $schedule->amount_paid = (float)$schedule->amount_paid + $dueForThisMonth;
                            $schedule->status = 'paid';
                            // append payment ID reference
                            $prevRefs = $schedule->payment_id_reference ? $schedule->payment_id_reference . ',' : '';
                            $schedule->payment_id_reference = $prevRefs . $paymentRow->id;
                            $schedule->save();
                            
                            $remainingPayment -= $dueForThisMonth;
                        } else {
                            $schedule->amount_paid = (float)$schedule->amount_paid + $remainingPayment;
                            $schedule->status = 'partial';
                            $prevRefs = $schedule->payment_id_reference ? $schedule->payment_id_reference . ',' : '';
                            $schedule->payment_id_reference = $prevRefs . $paymentRow->id;
                            $schedule->save();
                            
                            $remainingPayment = 0;
                        }
                    }
                } catch (\Exception $e) {
                    Log::error('Failed to deduct from loan schedules: ' . $e->getMessage());
                }

                Log::info('Loan payment created successfully');
                
                // Send email notification
                $this->sendPaymentNotification(
                    $memberEmail,
                    $memberName,
                    'Loan Payment',
                    $pay['payment_amount'],
                    $pay['reference_number'],
                    $pay['transaction_date'],
                    $newBalance,
                    'Loan Balance'
                );
                
                return redirect()->back()->with('Record-updated', 'Loan payment recorded successfully.');
            } catch (\Exception $e) {
                Log::error('Loan payment creation failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Failed to record loan payment. Please try again.');
            }
        }

        // Case 3: Non-loan payment (Shared Capital, Time Deposit, Savings, etc.)
        elseif ($pay['transaction_type'] !== 'Loan Payment') {

            // #region agent log
            try {
                $logPayload = [
                    'sessionId'    => '4b0db3',
                    'runId'        => 'pre-fix-shared-capital-loan-number',
                    'hypothesisId' => 'SC2',
                    'location'     => 'SubmitPayment.php:pay',
                    'message'      => 'Entering non-loan payment branch',
                    'data'         => [
                        'transaction_type'    => $pay['transaction_type'],
                        'loan_number_present' => array_key_exists('loan_number', $pay),
                        'loan_number_raw'     => $pay['loan_number'] ?? null,
                    ],
                    'timestamp'    => (int) round(microtime(true) * 1000),
                ];
                file_put_contents(base_path('debug-4b0db3.log'), json_encode($logPayload) . PHP_EOL, FILE_APPEND);
            } catch (\Throwable $e) {
            }
            // #endregion

            // Always ignore loan_number for non-loan payments
            unset($pay['loan_number']);

            switch ($pay['transaction_type']) {
                case 'Shared Capital':
                    $findSharedCapitalRecord = SharedCapital::where('member_id', $pay['member_id'])->first();

                    if (!$findSharedCapitalRecord) {
                        return redirect()->back()->with('error', 'Shared capital record not found for this member.');
                    }

                    try {
                        // Convert values to float before arithmetic operations
                        $paymentAmount = (float) $pay['payment_amount'];
                        $currentCapital = (float) $findSharedCapitalRecord->shared_capital_amount;
                        
                        // Update shared capital (subtract payment from capital)
                        $newBalance = $currentCapital - $paymentAmount;
                        $findSharedCapitalRecord->shared_capital_amount = (string) $newBalance;
                        $findSharedCapitalRecord->save();

                        // Create payment record
                        PaymentModel::create($pay);
                        Log::info('Shared capital payment created successfully');
                        
                        // Check for 50% Paid Threshold for Loan Eligibility
                        $originalTotal = (float) $findSharedCapitalRecord->shared_capital_amount_balance;
                        $remainingBalance = (float) $newBalance;
                        $paidAmount = $originalTotal - $remainingBalance;
                        $requiredAmount = $originalTotal * 0.5;

                        if ($paidAmount >= $requiredAmount) {
                            $existingNotif = \App\Models\Notification::where('member_id', $findSharedCapitalRecord->member_id)
                                ->where('type', 'loan_eligibility')
                                ->first();

                            if (!$existingNotif) {
                                \App\Models\Notification::create([
                                    'member_id' => $findSharedCapitalRecord->member_id,
                                    'title' => 'Loan Eligibility Unlocked!',
                                    'message' => 'Congratulations! You have paid 50% of your Shared Capital and are now eligible to apply for GBLDC loans.',
                                    'type' => 'loan_eligibility',
                                    'is_read' => false
                                ]);
                                session()->flash('loan_eligible', true);
                            }
                        }
                        
                        // Send email notification
                        $this->sendPaymentNotification(
                            $memberEmail,
                            $memberName,
                            'Shared Capital Payment',
                            $pay['payment_amount'],
                            $pay['reference_number'],
                            $pay['transaction_date'],
                            $newBalance,
                            'Shared Capital'
                        );

                        return redirect()->back()->with('Record-updated', 'Shared capital payment recorded successfully.');
                    } catch (\Exception $e) {
                        Log::error('Shared capital payment creation failed: ' . $e->getMessage());
                        return redirect()->back()->with('error', 'Failed to record shared capital payment. Please try again.');
                    }
                    break;

                case 'Time Deposit':
                    try {
                        // Add time deposit logic here
                        PaymentModel::create($pay);
                        Log::info('Time deposit payment created successfully');

                        // Get the payment amount for notification
                        $newBalance = (float) $pay['payment_amount'];

                        // Send email notification
                        $this->sendPaymentNotification(
                            $memberEmail,
                            $memberName,
                            'Time Deposit',
                            $pay['payment_amount'],
                            $pay['reference_number'],
                            $pay['transaction_date']
                        );

                        return redirect()->back()->with('Record-updated', 'Time deposit recorded successfully.');
                    } catch (\Exception $e) {
                        Log::error('Time deposit payment creation failed: ' . $e->getMessage());
                        return redirect()->back()->with('error', 'Failed to record time deposit. Please try again.');
                    }
                    break;

                case 'Savings':
                    try {
                        // Add savings logic here
                        PaymentModel::create($pay);
                        Log::info('Savings payment created successfully');

                        // Get the payment amount for notification
                        $newBalance = (float) $pay['payment_amount'];

                        // Send email notification
                        $this->sendPaymentNotification(
                            $memberEmail,
                            $memberName,
                            'Savings Deposit',
                            $pay['payment_amount'],
                            $pay['reference_number'],
                            $pay['transaction_date']
                        );

                        return redirect()->back()->with('Record-updated', 'Savings payment recorded successfully.');
                    } catch (\Exception $e) {
                        Log::error('Savings payment creation failed: ' . $e->getMessage());
                        return redirect()->back()->with('error', 'Failed to record savings payment. Please try again.');
                    }
                    break;

                default:
                    return redirect()->back()->with('error', 'Unknown transaction type.');
            }
        }

        // Case 4: (old error path) Non-loan payment with loan number — now unreachable because
        // non-loan payments are handled by the previous branch and loan_number is ignored.

        // Fallback error
        return redirect()->back()->with('error', 'Invalid transaction parameters.');
    }
    
    /**
     * Get member email from officialmember table
     */
    private function getMemberEmail($memberId)
    {
        $member = officialmember::where('member_id', $memberId)->first();
        if ($member && $member->email) {
            return $member->email;
        }
        return null;
    }
    
    /**
     * Send payment notification email to member
     */
    private function sendPaymentNotification($email, $memberName, $transactionType, $amount, $referenceNumber, $transactionDate, $newBalance = null, $balanceType = null)
    {
        // Skip if no email address
        if (empty($email)) {
            Log::warning('Payment notification skipped: No email address found for member');
            return;
        }
        
        // #region agent log
        try {
            $payload = [
                'sessionId'    => '4b0db3',
                'runId'        => 'pre-fix-email-mismatch',
                'hypothesisId' => 'EM1',
                'location'     => 'SubmitPayment.php:sendPaymentNotification',
                'message'      => 'Email payload for payment notification',
                'data'         => [
                    'email'            => $email,
                    'transaction_type' => $transactionType,
                    'amount'           => (float) $amount,
                    'reference_last4'  => substr(preg_replace('/\D+/', '', (string) $referenceNumber), -4),
                    'transaction_date' => $transactionDate,
                    'balance_type'     => $balanceType,
                    'has_new_balance'  => $newBalance !== null,
                ],
                'timestamp'    => (int) round(microtime(true) * 1000),
            ];
            file_put_contents(base_path('debug-4b0db3.log'), json_encode($payload) . PHP_EOL, FILE_APPEND);
        } catch (\Throwable $e) {
        }
        // #endregion

        try {
            Mail::to($email)->send(new \App\Mail\PaymentNotification(
                $email,
                $memberName,
                $transactionType,
                $amount,
                $referenceNumber,
                $transactionDate,
                $newBalance,
                $balanceType
            ));
            Log::info('Payment notification email sent successfully to: ' . $email);
        } catch (\Exception $e) {
            Log::error('Failed to send payment notification email: ' . $e->getMessage());
        }
    }
}
