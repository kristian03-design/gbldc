<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCash Payment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">GCash Payment</h1>
        <form action="{{ route('paymongo_gcash_initiate') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="member_id" class="block text-sm font-medium text-gray-700 mb-2">Member ID</label>
                <input type="text" id="member_id" name="member_id" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="loan_number" class="block text-sm font-medium text-gray-700 mb-2">Loan Number (Optional)</label>
                <input type="text" id="loan_number" name="loan_number"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="transaction_type" class="block text-sm font-medium text-gray-700 mb-2">Type of Transaction</label>
                <select id="transaction_type" name="transaction_type" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected>Select Type</option>
                    <option value="Shared Capital">Shared Capital Payment</option>
                    <option value="Loan Payment">Loan Payment</option>
                    <option value="Time Deposit">Time Deposit</option>
                    <option value="Savings">Saving</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Payment Amount (PHP)</label>
                <input type="number" id="amount" name="amount" step="0.01" min="0.01" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <input type="hidden" name="success_url" value="{{ route('paymongo_success') }}">
            <input type="hidden" name="failed_url" value="{{ route('paymongo_failed') }}">
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                Proceed to GCash Payment
            </button>
        </form>
        <div class="mt-4 text-center">
            <a href="{{ route('Payment.Page') }}" class="text-blue-600 hover:text-blue-800">Back to Payment Page</a>
        </div>
    </div>
</body>
</html>
