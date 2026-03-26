<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateMissingLoanSchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-loan-schedules';
    protected $description = 'Generate missing loan schedules for active loans and sync past payments';

    public function handle()
    {
        $loans = \App\Models\loan::where('loan_status', 'Ongoing')->get();
        $count = 0;

        foreach ($loans as $loan) {
            if (\App\Models\LoanSchedule::where('loan_number', $loan->loan_number)->exists()) {
                continue;
            }

            $termMonths = \App\Services\LoanInterestService::termToMonths($loan->loan_term ?? 12);
            $interestRate = (float) $loan->interest_rate;
            if (!$interestRate) {
                $interestRate = \App\Services\LoanInterestService::getAnnualRateForAmount((float)$loan->loan_amount);
            }

            $startDate = $loan->payment_start_date ? $loan->payment_start_date->format('Y-m-d') : $loan->created_at->addMonth()->format('Y-m-d');
            
            $scheduleRows = \App\Services\LoanInterestService::generateAmortizationSchedule(
                (float) $loan->loan_amount,
                $interestRate,
                $termMonths,
                $startDate
            );

            foreach ($scheduleRows as $row) {
                \App\Models\LoanSchedule::create([
                    'loan_number' => $loan->loan_number,
                    'member_id' => $loan->member_id,
                    'due_date' => $row['due_date'],
                    'monthly_payment' => $row['monthly_payment'],
                    'principal_amount' => $row['principal_amount'],
                    'interest_amount' => $row['interest_amount'],
                    'remaining_balance' => $row['remaining_balance'],
                    'status' => 'pending',
                    'amount_paid' => 0,
                ]);
            }

            $pastPayments = \App\Models\paymentModel::where('loan_number', $loan->loan_number)
                ->where('transaction_type', 'Loan Payment')
                ->orderBy('transaction_date', 'asc')
                ->get();

            foreach ($pastPayments as $payment) {
                $remainingPayment = (float) $payment->payment_amount;
                $schedules = \App\Models\LoanSchedule::where('loan_number', $loan->loan_number)
                    ->whereIn('status', ['pending', 'partial'])
                    ->orderBy('due_date', 'asc')
                    ->get();
                    
                foreach ($schedules as $schedule) {
                    if ($remainingPayment <= 0) break;
                    
                    $dueForThisMonth = (float) $schedule->monthly_payment - (float) $schedule->amount_paid;
                    
                    if ($remainingPayment >= $dueForThisMonth) {
                        $schedule->amount_paid = (float)$schedule->amount_paid + $dueForThisMonth;
                        $schedule->status = 'paid';
                        $prevRefs = $schedule->payment_id_reference ? $schedule->payment_id_reference . ',' : '';
                        $schedule->payment_id_reference = $prevRefs . $payment->id;
                        $schedule->save();
                        
                        $remainingPayment -= $dueForThisMonth;
                    } else {
                        $schedule->amount_paid = (float)$schedule->amount_paid + $remainingPayment;
                        $schedule->status = 'partial';
                        $prevRefs = $schedule->payment_id_reference ? $schedule->payment_id_reference . ',' : '';
                        $schedule->payment_id_reference = $prevRefs . $payment->id;
                        $schedule->save();
                        
                        $remainingPayment = 0;
                    }
                }
            }

            $this->info('Generated schedule for Loan: ' . $loan->loan_number);
            $count++;
        }

        $this->info("Completed migrating {$count} loans.");
    }
}
