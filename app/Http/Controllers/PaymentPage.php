<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QRCode;
use App\Models\OfficialMember;
use App\Models\loan;

class PaymentPage extends Controller
{
    public function Payment()
    {
        $activeQRCode = QRCode::where('is_active', true)->first();

        return view('Administrator.PaymentPage', compact('activeQRCode'));
    }

    public function memberLookup(Request $request)
    {
        $request->validate([
            'member_id' => 'required|string',
        ]);

        $memberId = trim((string) $request->member_id);

        // #region agent log
        try {
            $logPayload = [
                'sessionId'    => '1fb5bb',
                'runId'        => 'pre-fix-memberlookup',
                'hypothesisId' => 'H1',
                'location'     => 'PaymentPage.php:memberLookup',
                'message'      => 'Member lookup against officialmembers',
                'data'         => [
                    'member_id_len'  => strlen($memberId),
                    'member_id_last4'=> substr($memberId, -4),
                ],
                'timestamp'    => (int) round(microtime(true) * 1000),
            ];
            file_put_contents(base_path('debug-1fb5bb.log'), json_encode($logPayload) . PHP_EOL, FILE_APPEND);
        } catch (\Throwable $e) {
            // swallow logging errors
        }
        // #endregion

        $member = OfficialMember::where('member_id', $memberId)->first();

        if (!$member) {
            return response()->json(['success' => false], 200);
        }

        $activeLoan = loan::where('member_id', $memberId)
            ->where('loan_status', '!=', 'Fully Paid')
            ->orderByDesc('created_at')
            ->first();

        // #region agent log
        try {
            $logPayload = [
                'sessionId'    => '1fb5bb',
                'runId'        => 'pre-fix-memberlookup',
                'hypothesisId' => 'H2',
                'location'     => 'PaymentPage.php:memberLookup',
                'message'      => 'Loan lookup for autofill',
                'data'         => [
                    'member_id_last4' => substr($memberId, -4),
                    'found_active_loan' => (bool) $activeLoan,
                    'has_loan_number' => (bool) ($activeLoan && !empty($activeLoan->loan_number)),
                ],
                'timestamp'    => (int) round(microtime(true) * 1000),
            ];
            file_put_contents(base_path('debug-1fb5bb.log'), json_encode($logPayload) . PHP_EOL, FILE_APPEND);
        } catch (\Throwable $e) {
            // swallow logging errors
        }
        // #endregion

        return response()->json([
            'success' => true,
            'member'  => [
                'member_id'   => $member->member_id,
                'last_name'   => $member->last_name,
                'first_name'  => $member->first_name,
                'middle_name' => $member->middle_name,
                'loan_number' => $activeLoan?->loan_number,
            ],
        ]);
    }
}