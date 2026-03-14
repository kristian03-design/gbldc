<?php

/**
 * Tiered annual interest rates for cooperative loans (Philippines-inspired).
 * CDA and PH cooperatives often use monthly or annual rates; here we use annual % with monthly compounding.
 * Tiers: smaller loans get a lower rate, larger loans a higher rate (common in PH cooperatives).
 */
return [
    'tiers' => [
        ['max_amount' => 50_000,    'annual_rate' => 8],   // Up to 50k — 8% p.a. (e.g. emergency / small)
        ['max_amount' => 150_000,  'annual_rate' => 10],  // 50,001 – 150k — 10% p.a.
        ['max_amount' => 500_000,  'annual_rate' => 12],  // 150,001 – 500k — 12% p.a.
        ['max_amount' => 2_000_000,'annual_rate' => 14],  // 500,001 – 2M — 14% p.a.
        ['max_amount' => PHP_INT_MAX, 'annual_rate' => 16], // Above 2M — 16% p.a.
    ],
    'compounding_per_year' => 12, // monthly
];
