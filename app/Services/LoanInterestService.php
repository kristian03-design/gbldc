<?php

namespace App\Services;

/**
 * Tiered compound interest for cooperative loans (Philippines-inspired).
 * Uses config loan_interest_tiers: annual rate by loan amount, monthly compounding.
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
     * Compound interest: A = P(1 + r/n)^(n*t).
     * P = principal, r = annual rate (decimal), n = 12 (monthly), t = term in years = months/12.
     * So: totalDue = P * (1 + r/12)^months, interestAmount = totalDue - P.
     *
     * @param float $principal Loan amount
     * @param float $annualRatePercent Annual rate as percentage (e.g. 10 for 10%)
     * @param int   $termMonths Loan term in months
     * @return array{total_due: float, interest_amount: float}
     */
    public static function computeCompound(float $principal, float $annualRatePercent, int $termMonths): array
    {
        if ($principal <= 0 || $termMonths <= 0) {
            return ['total_due' => $principal, 'interest_amount' => 0.0];
        }
        $r = $annualRatePercent / 100;
        $totalDue = $principal * pow(1 + $r / 12, $termMonths);
        $interestAmount = $totalDue - $principal;
        return [
            'total_due' => round($totalDue, 2),
            'interest_amount' => round($interestAmount, 2),
        ];
    }

    /**
     * Get tier rate for amount and compute compound total due and interest.
     *
     * @return array{annual_rate: float, total_due: float, interest_amount: float}
     */
    public static function tieredCompound(float $principal, int $termMonths): array
    {
        $annualRate = self::getAnnualRateForAmount($principal);
        $result = self::computeCompound($principal, $annualRate, $termMonths);
        $result['annual_rate'] = $annualRate;
        return $result;
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
