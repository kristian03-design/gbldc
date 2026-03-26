<?php

namespace App\Services;

/**
 * Amortizing Interest for cooperative loans (Diminishing Balance).
 * Uses config loan_interest_tiers: annual rate by loan amount, monthly installment.
 */
class LoanInterestService
{
    /**
     * Get annual interest rate (%) for a given loan amount based on configured tiers.
     */
    public static function getAnnualRateForAmount(float $amount): float
    {
        $tiers = config('loan_interest_tiers.tiers', []);
        foreach ($tiers as $tier) {
            if ($amount <= $tier['max_amount']) {
                return (float) $tier['annual_rate'];
            }
        }
        return 16.0; // fallback
    }

    /**
     * Amortizing interest (Diminishing Balance)
     * Monthly Payment M = P * [ r * (1 + r)^n ] / [ (1 + r)^n - 1 ]
     */
    public static function computeAmortizing(float $principal, float $annualRatePercent, int $termMonths): array
    {
        if ($principal <= 0 || $termMonths <= 0) {
            return ['total_due' => $principal, 'interest_amount' => 0.0, 'monthly_payment' => 0.0];
        }
        
        $monthlyRate = ($annualRatePercent / 100) / 12;
        
        if ($monthlyRate == 0) {
            $monthlyPayment = $principal / $termMonths;
            $totalDue = $principal;
            $interestAmount = 0.0;
        } else {
            // Equal Principal Diminishing Interest:
            // Total Interest = P * r * (n + 1) / 2
            $interestAmount = $principal * $monthlyRate * ($termMonths + 1) / 2;
            $totalDue = $principal + $interestAmount;
            // Average monthly payment
            $monthlyPayment = $totalDue / $termMonths;
        }
        
        return [
            'total_due' => round($totalDue, 2),
            'interest_amount' => round($interestAmount, 2),
            'monthly_payment' => round($monthlyPayment, 2)
        ];
    }

    /**
     * Get tier rate for amount and compute amortizing total due and interest.
     * Takes into account diminishing interest based on Paid Shared Capital.
     */
    public static function tieredCompound(float $principal, int $termMonths, float $paidSharedCapital = 0.0): array
    {
        $baseAnnualRate = self::getAnnualRateForAmount($principal);

        // Diminishing Interest based on Shared Capital
        // For every ₱5,000 paid, discount is 0.5%
        $discount = floor($paidSharedCapital / 5000) * 0.5;
        
        // Minimum interest floor is 5.0%
        $annualRate = max(5.0, $baseAnnualRate - $discount);

        $result = self::computeAmortizing($principal, $annualRate, $termMonths);
        $result['annual_rate'] = $annualRate;
        $result['base_rate'] = $baseAnnualRate;
        $result['discount_applied'] = $discount;
        return $result;
    }

    /**
     * Generate actual amortization schedule table using Reducing Balance (Diminishing Interest).
     * Supports Daily, Weekly, and Monthly frequencies.
     */
    public static function generateAmortizationSchedule(float $principal, float $annualRatePercent, int $termPeriods, string $startDateStr, string $frequency = 'Monthly'): array
    {
        $schedule = [];
        $frequency = strtolower($frequency);
        
        // Convert annual rate to period rate
        if ($frequency == 'daily') {
            $ratePerPeriod = ($annualRatePercent / 100) / 365;
        } elseif ($frequency == 'weekly') {
            $ratePerPeriod = ($annualRatePercent / 100) / 52;
        } else {
            // Default to monthly
            $ratePerPeriod = ($annualRatePercent / 100) / 12;
        }
        
        // Calculate fixed period payment (Amortization Formula)
        if ($ratePerPeriod > 0) {
            $periodPayment = $principal * ($ratePerPeriod * pow(1 + $ratePerPeriod, $termPeriods)) / (pow(1 + $ratePerPeriod, $termPeriods) - 1);
        } else {
            $periodPayment = $principal / $termPeriods;
        }
        
        $balance = $principal;
        $currentDate = \Carbon\Carbon::parse($startDateStr);
        
        for ($i = 1; $i <= $termPeriods; $i++) {
            $interestForPeriod = round($balance * $ratePerPeriod, 2);
            
            $principalForPeriod = round($periodPayment - $interestForPeriod, 2);
            
            // Adjust final payment to avoid rounding drift
            if ($i == $termPeriods || $balance - $principalForPeriod < 0.01) {
                $principalForPeriod = $balance;
                $periodPayment = $principalForPeriod + $interestForPeriod;
            }
            
            $remainingBalance = max(0, round($balance - $principalForPeriod, 2));

            $schedule[] = [
                'payment_number' => $i,
                'due_date' => $currentDate->format('Y-m-d'),
                'beginning_balance' => round($balance, 2),
                'monthly_payment' => round($periodPayment, 2), // Maps to 'monthly_payment' column in DB
                'principal_amount' => round($principalForPeriod, 2),
                'interest_amount' => round($interestForPeriod, 2),
                'remaining_balance' => $remainingBalance,
                'penalty' => 0
            ];
            
            $balance = $remainingBalance;
            
            // Advance date based on frequency
            if ($frequency == 'daily') {
                $currentDate->addDay();
            } elseif ($frequency == 'weekly') {
                $currentDate->addWeeks(1);
            } else {
                $currentDate->addMonthNoOverflow();
            }

            // Force break if paid off early due to rounding
            if ($balance <= 0) break;
        }
        
        return $schedule;
    }

    /**
     * Parse loan term string to months (e.g. "12 Months" -> 12).
     */
    public static function termToMonths($term): int
    {
        if (is_numeric($term)) {
            return (int) $term;
        }
        if (preg_match('/^(\d+)/', (string) $term, $m)) {
            return (int) $m[1];
        }
        return 0;
    }
}
