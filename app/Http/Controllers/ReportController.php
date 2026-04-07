<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\loan;
use App\Models\officialmember;
use App\Models\sharedCapital;
use App\Models\paymentModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    public function index()
    {
        // 1. Loan Repayment Progress (Bar Chart) - top 5 active loans
        // We'll calculate percentage of (loan_amount - loan_balance) / loan_amount
        $activeLoans = loan::where('loan_status', 'Ongoing')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $loanProgress = [];
        foreach ($activeLoans as $l) {
            $amt = (float) $l->loan_amount;
            $bal = (float) $l->loan_balance;
            if ($amt > 0) {
                $paid = $amt - $bal;
                $pctPaid = round(($paid / $amt) * 100);
                $pctRem = 100 - $pctPaid;
                
                // Fetch member name securely depending on how it's stored. 
                // Assumes loan table has member_id or name. Let's look up member if we have member_id.
                // Assuming $l->member_id corresponds to officialmember id or we can use $l->first_name if denormalized
                $name = $l->first_name ? $l->first_name . ' ' . $l->last_name : 'Member #' . $l->id;
                
                $loanProgress[] = [
                    'name' => $name,
                    'paid_pct' => $pctPaid,
                    'rem_pct' => $pctRem
                ];
            }
        }

        // 2. Financial Performance (Line Chart) - Last 6 months disbursements vs collections
        $financials = [
            'labels' => [],
            'disbursements' => [],
            'collections' => []
        ];
        
        // Fetch all payments once to handle decrypted values in PHP
        $allPayments = paymentModel::all();

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->startOfMonth()->subMonths($i);
            $monthStr = $date->format('Y-m');
            $financials['labels'][] = $date->format('M Y');
            
            $monthStart = $date->copy()->startOfMonth()->format('Y-m-d 00:00:00');
            $monthEnd = $date->copy()->endOfMonth()->format('Y-m-d 23:59:59');
            $monthStartVal = substr($monthStart, 0, 10);
            $monthEndVal = substr($monthEnd, 0, 10);
            
            $disbursed = loan::whereBetween('created_at', [$monthStart, $monthEnd])
                             ->whereIn('loan_status', ['Ongoing', 'Finished']) // assuming these mean approved/disbursed
                             ->sum('loan_amount');
            $financials['disbursements'][] = (float) $disbursed;
            
            // Collections (Payments)
            $collected = 0;
            foreach ($allPayments as $payment) {
                if ($payment->transaction_date) {
                    $tDate = substr($payment->transaction_date, 0, 10);
                    if ($tDate >= $monthStartVal && $tDate <= $monthEndVal) {
                        $collected += (float) $payment->payment_amount;
                    }
                }
            }
            $financials['collections'][] = $collected;
        }

        // 3. New Members by Month (Bar Chart) - Current Year (Jan-Dec)
        $newMembers = [];
        $memberLabels = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthStart = Carbon::now()->month($m)->startOfMonth()->format('Y-m-d 00:00:00');
            $monthEnd = Carbon::now()->month($m)->endOfMonth()->format('Y-m-d 23:59:59');
            
            $count = officialmember::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $newMembers[] = $count;
            $memberLabels[] = Carbon::now()->month($m)->format('M');
        }

        // 4. Recent Loans Table
        $recentLoans = loan::orderBy('created_at', 'desc')->take(5)->get();

        // 5. Key Metrics
        $totalMembers = officialmember::count();
        $totalLoanPortfolio = loan::whereIn('loan_status', ['Ongoing', 'Finished'])->sum('loan_amount');
        $outstandingBalance = loan::where('loan_status', 'Ongoing')->sum('loan_balance');
        
        $allShared = sharedCapital::all();
        $totalSharedCapital = 0;
        foreach($allShared as $sc) {
            $totalSharedCapital += (float) ($sc->amount ?? $sc->share_amount ?? $sc->shared_capital_amount ?? 0);
        }

        $keyMetrics = [
            'totalMembers' => $totalMembers,
            'totalLoanPortfolio' => $totalLoanPortfolio,
            'outstandingBalance' => $outstandingBalance,
            'sharedCapital' => $totalSharedCapital
        ];

        return view('Administrator.Reports', compact('loanProgress', 'financials', 'newMembers', 'memberLabels', 'recentLoans', 'keyMetrics'));
    }

    public function exportMembers()
    {
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=Members_Report_" . date('Ymd_His') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $members = officialmember::all();
        $columns = array('ID', 'First Name', 'Last Name', 'Email', 'Contact Number', 'Street Address', 'Barangay', 'City', 'Province', 'Joined At');

        $callback = function() use($members, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($members as $mem) {
                fputcsv($file, [
                    $mem->id,
                    $mem->first_name,
                    $mem->last_name,
                    $mem->email,
                    $mem->contact_number,
                    $mem->street_address,
                    $mem->barangay,
                    $mem->city,
                    $mem->province,
                    $mem->created_at ? $mem->created_at->format('Y-m-d') : ''
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportLoans()
    {
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=Loans_Report_" . date('Ymd_His') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $loans = loan::all();
        $columns = array('Loan Number', 'Member', 'Loan Term', 'Amount', 'Balance', 'Status', 'Date Approved');

        $callback = function() use($loans, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($loans as $l) {
                $name = $l->first_name ? $l->first_name . ' ' . $l->last_name : 'Member';
                fputcsv($file, [
                    $l->loan_number,
                    $name,
                    $l->loan_term,
                    $l->loan_amount,
                    $l->loan_balance,
                    $l->loan_status,
                    $l->created_at ? $l->created_at->format('Y-m-d') : ''
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportSharedCapital()
    {
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=SharedCapital_Report_" . date('Ymd_His') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $records = sharedCapital::all();
        // Adjust columns according to actual table structure
        $columns = array('ID', 'Member ID', 'Amount', 'Date Added');

        $callback = function() use($records, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($records as $r) {
                fputcsv($file, [
                    $r->id,
                    $r->member_id ?? '',
                    $r->amount ?? $r->share_amount ?? $r->shared_capital_amount ?? 0,
                    $r->created_at ? $r->created_at->format('Y-m-d') : ''
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
