<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-green-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-8 text-center">
        <div class="mb-6">
            <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Payment Successful!</h1>
        <p class="text-gray-600 mb-6">Your GCash payment has been processed successfully.</p>

        @if(isset($payment))
        <div class="bg-gray-50 p-4 rounded-lg mb-6 text-left">
            <h3 class="font-semibold text-gray-800 mb-2">Payment Details:</h3>
            <p><strong>Member ID:</strong> {{ $payment['member_id'] }}</p>
            <p><strong>Transaction Type:</strong> {{ $payment['transaction_type'] }}</p>
            <p><strong>Amount:</strong> ₱{{ number_format($payment['amount'], 2) }}</p>
            @if($payment['loan_number'])
            <p><strong>Loan Number:</strong> {{ $payment['loan_number'] }}</p>
            @endif
        </div>
        @endif

        <a href="{{ route('Payment.Page') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
            Return to Payment Page
        </a>
    </div>
</body>
</html>
