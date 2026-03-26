<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LoanSchedule;
use App\Models\loan;
use App\Models\LoanPenalty;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CheckOverdueLoans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loans:check-overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for overdue loans and apply penalties';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for overdue loans...');
        
        $schedules = LoanSchedule::whereIn('status', ['pending', 'partial'])->get();
        $today = Carbon::today();
        $penaltiesApplied = 0;

        foreach ($schedules as $schedule) {
            $loan = loan::where('loan_number', $schedule->loan_number)->first();
            if (!$loan) continue;

            $gracePeriod = $loan->grace_period ?? 3;
            $dueDateWithGrace = Carbon::parse($schedule->due_date)->addDays($gracePeriod);
            
            if ($today->gt($dueDateWithGrace)) {
                // Check if penalty already applied for this schedule
                $existingPenalty = LoanPenalty::where('loan_schedule_id', $schedule->id)->first();
                
                if (!$existingPenalty) {
                    $penaltyAmount = 0;
                    if ($loan->penalty_type === 'percentage') {
                        $penaltyRate = $loan->penalty_value ?? 5;
                        $unpaid = $schedule->monthly_payment - $schedule->amount_paid;
                        $penaltyAmount = round($unpaid * ($penaltyRate / 100), 2);
                    } else {
                        $penaltyAmount = $loan->penalty_value ?? 50.00;
                    }

                    LoanPenalty::create([
                        'loan_number' => $schedule->loan_number,
                        'loan_schedule_id' => $schedule->id,
                        'penalty_amount' => $penaltyAmount,
                        'status' => 'unpaid'
                    ]);

                    $schedule->status = 'overdue';
                    $schedule->penalty += $penaltyAmount;
                    $schedule->save();
                    
                    $penaltiesApplied++;
                } else {
                    // Update status if it was just pending/partial but now confidently overdue
                    if ($schedule->status !== 'overdue') {
                        $schedule->status = 'overdue';
                        $schedule->save();
                    }
                }
            }
        }

        $this->info("Completed. Penalties applied: {$penaltiesApplied}");
        Log::info("CheckOverdueLoans: Penalties applied: {$penaltiesApplied}");
    }
}
