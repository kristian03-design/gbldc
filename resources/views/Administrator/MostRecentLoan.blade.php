<div class="bg-white rounded-xl shadow-lg p-8">
            @if($ShowRecords->count() > 0)
                @php $record = $ShowRecords->first(); @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-green-50 p-6 rounded-lg border border-green-200">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-id-card text-green-600 text-xl mr-3"></i>
                            <h3 class="text-lg font-semibold text-green-800">Member ID</h3>
                        </div>
                        <p class="text-gray-700 text-lg">{{ $record->member_id }}</p>
                    </div>

                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-user text-blue-600 text-xl mr-3"></i>
                            <h3 class="text-lg font-semibold text-blue-800">Name</h3>
                        </div>
                        <p class="text-gray-700 text-lg">{{ $record->last_name }}, {{ $record->first_name }} {{ $record->middle_name }}</p>
                    </div>

                    <div class="bg-purple-50 p-6 rounded-lg border border-purple-200">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-hashtag text-purple-600 text-xl mr-3"></i>
                            <h3 class="text-lg font-semibold text-purple-800">Reference No.</h3>
                        </div>
                        <p class="text-gray-700 text-lg">{{ $record->reference_number }}</p>
                    </div>

                    <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-200">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-tags text-yellow-600 text-xl mr-3"></i>
                            <h3 class="text-lg font-semibold text-yellow-800">Type</h3>
                        </div>
                        <p class="text-gray-700 text-lg">{{ $record->transaction_type }}</p>
                    </div>

                    <div class="bg-red-50 p-6 rounded-lg border border-red-200">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-check-circle text-red-600 text-xl mr-3"></i>
                            <h3 class="text-lg font-semibold text-red-800">Status</h3>
                        </div>
                        <p class="text-gray-700 text-lg">{{ $record->payment_status }}</p>
                    </div>

                    <div class="bg-indigo-50 p-6 rounded-lg border border-indigo-200">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-money-bill-wave text-indigo-600 text-xl mr-3"></i>
                            <h3 class="text-lg font-semibold text-indigo-800">Amount</h3>
                        </div>
                        <p class="text-gray-700 text-lg font-bold">₱{{ number_format($record->payment_amount, 2) }}</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 md:col-span-2 lg:col-span-3">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-calendar-alt text-gray-600 text-xl mr-3"></i>
                            <h3 class="text-lg font-semibold text-gray-800">Date of Transaction</h3>
                        </div>
                        <p class="text-gray-700 text-lg">{{ \Carbon\Carbon::parse($record->transaction_date)->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-exclamation-triangle text-yellow-500 text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Fully Paid Loans Found</h3>
                    <p class="text-gray-500">This member does not have any fully paid loans yet.</p>
                </div>
            @endif
        </div>
=======
        <!-- Record Display -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            @if($ShowRecords->count() > 0)
                @php $record = $ShowRecords->first(); @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-green-50 p-6 rounded-lg border border-green-200">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-id-card text-green-600 text-xl mr-3"></i>
                            <h3 class="text-lg font-semibold text-green-800">Member ID</h3>
                        </div>
                        <p class="text-gray-700 text-lg">{{ $record->member_id }}</p>
                    </div>

                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-user text-blue-600 text-xl mr-3"></i>
                            <h3 class="text-lg font-semibold text-blue-800">Name</h3>
                        </div>
                        <p class="text-gray-700 text-lg">{{ $record->last_name }}, {{ $record->first_name }} {{ $record->middle_name }}</p>
                    </div>

                    <div class="bg-purple-50 p-6 rounded-lg border border-purple-200">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-hashtag text-purple-600 text-xl mr-3"></i>
                            <h3 class="text-lg font-semibold text-purple-800">Loan Number</h3>
                        </div>
                        <p class="text-gray-700 text-lg">{{ $record->loan_number }}</p>
                    </div>

                    <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-200">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-tags text-yellow-600 text-xl mr-3"></i>
                            <h3 class="text-lg font-semibold text-yellow-800">Loan Type</h3>
                        </div>
                        <p class="text-gray-700 text-lg">{{ $record->loan_type }}</p>
                    </div>

                    <div class="bg-red-50 p-6 rounded-lg border border-red-200">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-check-circle text-red-600 text-xl mr-3"></i>
                            <h3 class="text-lg font-semibold text-red-800">Status</h3>
                        </div>
                        <p class="text-gray-700 text-lg">{{ $record->loan_status }}</p>
                    </div>

                    <div class="bg-indigo-50 p-6 rounded-lg border border-indigo-200">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-money-bill-wave text-indigo-600 text-xl mr-3"></i>
                            <h3 class="text-lg font-semibold text-indigo-800">Loan Amount</h3>
                        </div>
                        <p class="text-gray-700 text-lg font-bold">₱{{ number_format($record->loan_amount, 2) }}</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 md:col-span-2 lg:col-span-3">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-calendar-alt text-gray-600 text-xl mr-3"></i>
                            <h3 class="text-lg font-semibold text-gray-800">Loan Date</h3>
                        </div>
                        <p class="text-gray-700 text-lg">{{ \Carbon\Carbon::parse($record->created_at)->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-exclamation-triangle text-yellow-500 text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Fully Paid Loans Found</h3>
                    <p class="text-gray-500">This member does not have any fully paid loans yet.</p>
                </div>
            @endif
        </div>
