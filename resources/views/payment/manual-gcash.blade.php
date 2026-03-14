<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCash Payment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        .gcash-blue { background-color: #0066cc; }
        .gcash-light-blue { background-color: #e6f3ff; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- GCash Header -->
        <div class="gcash-blue text-white p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center mr-3">
                        <span class="text-blue-600 font-bold text-sm">GC</span>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold">GCash</h1>
                        <p class="text-xs opacity-90">Pay Bills & Buy Load</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-xs">Balance</p>
                    <p class="font-bold">₱1,250.00</p>
                </div>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="p-6">
            <h2 class="text-xl font-bold text-center text-gray-800 mb-6">Confirm Payment</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 text-center px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 text-center px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-600">Merchant:</span>
                    <span class="font-semibold">GBLDC Cooperative</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-600">Amount:</span>
                    <span class="font-bold text-lg text-blue-600">₱<span id="amount-display">0.00</span></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Fee:</span>
                    <span class="text-green-600">Free</span>
                </div>
            </div>

            <form action="{{ route('manual_gcash_submit') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="member_id" class="block text-sm font-medium text-gray-700 mb-1">Member ID</label>
                        <input type="text" id="member_id" name="member_id" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="loan_number" class="block text-sm font-medium text-gray-700 mb-1">Loan Number (Optional)</label>
                        <input type="text" id="loan_number" name="loan_number"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <label for="last_name" class="block text-xs font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" id="last_name" name="last_name" required
                                   class="w-full px-2 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="first_name" class="block text-xs font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" id="first_name" name="first_name" required
                                   class="w-full px-2 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="middle_name" class="block text-xs font-medium text-gray-700 mb-1">Middle</label>
                            <input type="text" id="middle_name" name="middle_name"
                                   class="w-full px-2 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                    </div>
                    <div>
                        <label for="transaction_type" class="block text-sm font-medium text-gray-700 mb-1">Transaction Type</label>
                        <select id="transaction_type" name="transaction_type" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" disabled selected>Select Type</option>
                            <option value="Shared Capital">Shared Capital Payment</option>
                            <option value="Loan Payment">Loan Payment</option>
                            <option value="Time Deposit">Time Deposit</option>
                            <option value="Savings">Savings</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label for="payment_amount" class="block text-sm font-medium text-gray-700 mb-1">Amount (PHP)</label>
                        <input type="number" id="payment_amount" name="payment_amount" step="0.01" min="0.01" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="reference_number" class="block text-sm font-medium text-gray-700 mb-1">Reference Number</label>
                        <input type="text" id="reference_number" name="reference_number" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="transaction_date" class="block text-sm font-medium text-gray-700 mb-1">Transaction Date</label>
                        <input type="date" id="transaction_date" name="transaction_date" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="remarks" class="block text-sm font-medium text-gray-700 mb-1">Remarks</label>
                        <textarea id="remarks" name="remarks" rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                </div>

                <button type="submit" class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                    Pay Now
                </button>
            </form>
        </div>

        <div class="bg-gray-50 px-6 py-3 text-center">
            <a href="{{ route('Payment.Page') }}" class="text-blue-600 hover:text-blue-800 text-sm">Cancel</a>
        </div>
    </div>

    <script>
        // Update amount display
        document.getElementById('payment_amount').addEventListener('input', function() {
            const amount = parseFloat(this.value) || 0;
            document.getElementById('amount-display').textContent = amount.toFixed(2);
        });
    </script>
</body>
</html>
