<?php

namespace App\Http\Controllers;

use App\Services\PayMongoService;
use Illuminate\Http\Request;

class PayMongoController extends Controller
{
    protected $paymongoService;

    public function __construct(PayMongoService $paymongoService)
    {
        $this->paymongoService = $paymongoService;
    }

    public function showGcashPage()
    {
        return view('payment.gcash');
    }

    public function initiateGcashPayment(Request $request)
    {
        $request->validate([
            'member_id' => 'required|string',
            'loan_number' => 'nullable|string',
            'transaction_type' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'success_url' => 'required|url',
            'failed_url' => 'required|url',
        ]);

        if (!config('services.paymongo.secret_key')) {
            return back()->with('error', 'PayMongo secret key not configured. Please check your .env file and ensure PAYMONGO_PUBLIC is set.');
        }

        $amount = (int)($request->amount * 100); // PayMongo expects amount in centavos
        $successUrl = $request->success_url;
        $failedUrl = $request->failed_url;

        $sourceResponse = $this->paymongoService->createSource($amount, $successUrl, $failedUrl, 'gcash');

        if (isset($sourceResponse['data']['attributes']['checkout_url'])) {
            // Store payment details in session for later use
            session([
                'gcash_payment' => [
                    'member_id' => $request->member_id,
                    'loan_number' => $request->loan_number,
                    'transaction_type' => $request->transaction_type,
                    'amount' => $request->amount,
                    'source_id' => $sourceResponse['data']['id']
                ]
            ]);
            return redirect($sourceResponse['data']['attributes']['checkout_url']);
        }

        return back()->with('error', 'Failed to initiate payment.');
    }

    public function handlePaymentSuccess(Request $request)
    {
        // Retrieve payment details from session
        $paymentData = session('gcash_payment');

        if ($paymentData) {
            // Get member details for the payment record
            $member = \App\Models\OfficialMember::where('member_id', $paymentData['member_id'])->first();

            if (!$member) {
                return view('payment.failed', ['error' => 'Member not found']);
            }

            // Prepare payment data for database (matching SubmitPayment format)
            $paymentRecord = [
                'loan_number' => $paymentData['loan_number'],
                'member_id' => $paymentData['member_id'],
                'last_name' => $member->last_name,
                'first_name' => $member->first_name,
                'middle_name' => $member->middle_name ?? '',
                'transaction_type' => $paymentData['transaction_type'],
                'payment_method' => 'GCash',
                'payment_status' => 'Paid',
                'transaction_date' => now()->toDateString(),
                'transaction_handler' => 'GCash',
                'updater_name' => 'GCash',
                'reference_number' => $paymentData['source_id'], // Use source_id as reference
                'payment_amount' => $paymentData['amount'],
                'remarks' => 'GCash payment via PayMongo',
                'admin_copy' => null,
                'member_copy' => null,
            ];

            // Handle different transaction types like SubmitPayment
            if ($paymentData['transaction_type'] === 'Loan Payment' && $paymentData['loan_number']) {
                $loan = \App\Models\Loan::where('loan_number', $paymentData['loan_number'])->first();
                if (!$loan) {
                    return view('payment.failed', ['error' => 'Loan record not found']);
                }
                // Update loan balance
                $loan->loan_balance -= $paymentData['amount'];
                $loan->save();
            } elseif ($paymentData['transaction_type'] === 'Shared Capital') {
                $sharedCapital = \App\Models\SharedCapital::where('member_id', $paymentData['member_id'])->first();
                if ($sharedCapital) {
                    $sharedCapital->shared_capital_amount -= $paymentData['amount'];
                    $sharedCapital->save();
                }
            }
            // For Time Deposit and Savings, just create the payment record

            // Save to payment table
            \App\Models\PaymentModel::create($paymentRecord);

            // Clear the session
            session()->forget('gcash_payment');

            return view('payment.success', ['payment' => $paymentData]);
        }

        return view('payment.success');
    }

    public function handlePaymentFailed(Request $request)
    {
        // Clear the session on failure
        session()->forget('gcash_payment');

        return view('payment.failed');
    }

    public function showManualGcashPage()
    {
        return view('payment.manual-gcash');
    }

    public function submitManualGcashPayment(Request $request)
    {
        \Log::info('Manual GCash payment submission started', $request->all());

        $request->validate([
            'member_id' => 'required|string',
            'loan_number' => 'nullable|string',
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'transaction_type' => 'required|string',
            'payment_amount' => 'required|numeric|min:0.01',
            'reference_number' => 'required|string',
            'transaction_date' => 'required|date',
            'remarks' => 'nullable|string',
        ]);

        \Log::info('Validation passed for manual GCash payment');

        // Check reference_number uniqueness manually for encrypted field
        $existingPayment = \App\Models\PaymentModel::where('reference_number', $request->reference_number)->first();
        if ($existingPayment) {
            \Log::info('Reference number already exists: ' . $request->reference_number);
            return back()->with('error', 'Reference number already exists. Please use a unique reference number.');
        }

        if ($request->loan_number === null && $request->transaction_type === 'Loan Payment') {
            return back()->with('error', 'You need to provide Loan number for loan payment.');
        }

        // Get member details for verification
        $member = \App\Models\OfficialMember::where('member_id', $request->member_id)->first();
        \Log::info('Member lookup result', ['member_id' => $request->member_id, 'found' => $member ? true : false]);

        if (!$member) {
            \Log::info('Member not found for ID: ' . $request->member_id);
            return back()->with('error', 'Member not found');
        }

        // Prepare payment data for database
        $paymentRecord = [
            'loan_number' => $request->loan_number,
            'member_id' => $request->member_id,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name ?? '',
            'transaction_type' => $request->transaction_type,
            'payment_method' => 'GCash',
            'payment_status' => 'Paid',
            'transaction_date' => $request->transaction_date,
            'transaction_handler' => 'GCash',
            'updater_name' => 'GCash',
            'reference_number' => $request->reference_number,
            'payment_amount' => $request->payment_amount,
            'remarks' => $request->remarks,
            'admin_copy' => null,
            'member_copy' => null,
        ];

        // Handle different transaction types like SubmitPayment
        if ($request->transaction_type === 'Loan Payment' && $request->loan_number) {
            $loan = \App\Models\Loan::where('loan_number', $request->loan_number)->first();
            if (!$loan) {
                \Log::info('Loan record not found for loan number: ' . $request->loan_number);
                return back()->with('error', 'Loan record not found');
            }
            if ($loan->loan_balance <= 0) {
                \Log::info('Loan already fully paid for loan number: ' . $request->loan_number);
                return back()->with('error', 'Loan is already fully paid.');
            }
            if ($request->payment_amount > $loan->loan_balance) {
                \Log::info('Payment amount exceeds loan balance', ['payment_amount' => $request->payment_amount, 'loan_balance' => $loan->loan_balance]);
                return back()->with('error', 'Payment amount exceeds loan balance.');
            }
            // Update loan balance
            $loan->loan_balance -= $request->payment_amount;
            $loan->save();
            \Log::info('Loan balance updated successfully', ['new_balance' => $loan->loan_balance]);
        } elseif ($request->transaction_type === 'Shared Capital') {
            $sharedCapital = \App\Models\SharedCapital::where('member_id', $request->member_id)->first();
            if ($sharedCapital) {
                $sharedCapital->shared_capital_amount -= $request->payment_amount;
                $sharedCapital->save();
                \Log::info('Shared capital updated successfully', ['new_amount' => $sharedCapital->shared_capital_amount]);
            } else {
                \Log::info('Shared capital record not found for member: ' . $request->member_id);
            }
        }
        // For Time Deposit and Savings, just create the payment record (no balance updates needed)

        \Log::info('Attempting to create payment record', $paymentRecord);

        try {
            // Save to payment table
            $createdPayment = \App\Models\PaymentModel::create($paymentRecord);
            \Log::info('Payment record created successfully', ['payment_id' => $createdPayment->id ?? 'unknown']);
            return back()->with('success', 'GCash payment recorded successfully');
        } catch (\Exception $e) {
            \Log::error('Failed to create payment record: ' . $e->getMessage(), [
                'exception' => $e,
                'payment_data' => $paymentRecord
            ]);
            return back()->with('error', 'Failed to save payment record. Please try again.');
        }
    }
}
