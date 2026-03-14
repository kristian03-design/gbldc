<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>GBLDC — Loan Payment History Detail</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Tailwind CDN for quick visual preview -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- FontAwesome CDN for icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
  <!-- DataTables Tailwind integration CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwind.min.css" />
</head>
<body class="bg-gray-50 text-gray-900">
  <!-- Header -->
  <header class="bg-white shadow-md fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
      <div class="flex items-center space-x-4">
        <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC Logo" class="w-12 h-12 object-cover" />
        <h1 class="text-teal-900 font-semibold text-xl md:text-2xl">GBLDC Loan Payment History Detail</h1>
      </div>
      <div class="relative">
        <button id="user-menu-button" type="button" aria-haspopup="true" aria-expanded="false" aria-controls="user-menu" class="flex items-center gap-2 focus:outline-none cursor-pointer">
          <span class="hidden md:inline font-medium text-gray-700">Admin</span>
          <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="Admin Avatar" class="w-10 h-10 rounded-full border-2 border-green-600 object-cover" />
          <i class="fas fa-chevron-down text-gray-600"></i>
        </button>
        <div id="user-menu" class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg border border-gray-100 py-2 hidden transition duration-200 ease-in-out" role="menu" aria-label="User menu">
          <a href="#" role="menuitem" class="block px-4 py-2 text-sm hover:bg-green-50 hover:text-green-700 text-gray-700">Profile</a>
          <a href="{{ route('Admin.Settings') }}" role="menuitem" class="block px-4 py-2 text-sm hover:bg-green-50 hover:text-green-700 text-gray-700">Settings</a>
          <div class="border-t border-gray-200 my-1"></div>
          <a href="{{ route('Admin.Logout') }}"
              class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition">Logout</a>
        </div>
      </div>
    </div>
  </header>

  <main class="pt-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">

      <!-- Back Button -->
      <div class="mb-4">
        <a href="javascript:history.back()" class="inline-flex items-center px-3 py-1.5 rounded bg-green-100 text-green-800 hover:bg-green-200 transition-colors focus:outline-none focus:ring-2 focus:ring-green-400 shadow-sm">
          <i class="fa fa-arrow-left mr-2"></i> Back
        </a>
      </div>

      <!-- Payment History Detail: DataTable -->
      <section class="bg-white border rounded-xl overflow-hidden">
        <div class="p-6 border-b border-gray-200">
          <h2 class="text-2xl font-bold text-gray-900">Payment History for Loan Number: {{ $loan_number }}</h2>
          <p class="text-gray-600 mt-1">Detailed view of all payments made for this loan.</p>
        </div>
        <div class="overflow-x-auto">
          <table id="payment-history-detail-table" class="stripe hover" style="width:100%">
            <thead>
              <tr>
                <th>Date</th>
                <th>Reference</th>
                <th>Type</th>
                <th>Method</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Handler</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($payments as $payment)
              <tr>
                <td>{{ \Carbon\Carbon::parse($payment->transaction_date)->format('M d, Y') }}</td>
                <td>{{ $payment->reference_number }}</td>
                <td>{{ $payment->transaction_type }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>₱{{ number_format($payment->payment_amount, 2) }}</td>
                <td>
                  @if($payment->payment_status == 'Paid')
                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Paid</span>
                  @elseif($payment->payment_status == 'Late')
                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/20">Late</span>
                  @elseif($payment->payment_status == 'Early')
                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-sky-50 text-sky-700 ring-1 ring-inset ring-sky-600/20">Early</span>
                  @else
                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-gray-50 text-gray-700 ring-1 ring-inset ring-gray-600/20">{{ $payment->payment_status }}</span>
                  @endif
                </td>
                <td>{{ $payment->transaction_handler }}</td>
                <td>
                  <a
                    href="{{ route('view_details', $payment->id) }}"
                    class="inline-flex items-center px-3 py-1.5 rounded bg-green-50 text-green-700 border border-green-200 hover:bg-green-200 hover:text-green-900 focus:outline-none focus:ring-2 focus:ring-green-400 transition-all shadow-sm mr-2">
                    <i class="fas fa-eye mr-1"></i>View Receipt
                  </a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="8" class="text-center py-4 text-gray-500">No payment history found for this loan.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </section>

    </div>
  </main>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <!-- DataTables Tailwind integration JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwind.min.js"></script>

  <script>
    // Toggle user menu dropdown
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');

    userMenuButton.addEventListener('click', () => {
      const isExpanded = userMenuButton.getAttribute('aria-expanded') === 'true';
      userMenuButton.setAttribute('aria-expanded', String(!isExpanded));
      userMenu.classList.toggle('hidden');
    });

    // Close menu if clicking outside
    document.addEventListener('click', (event) => {
      if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
        userMenu.classList.add('hidden');
        userMenuButton.setAttribute('aria-expanded', 'false');
      }
    });

    // Initialize DataTable with improved layout and spacing
    $(document).ready(function() {
      $('#payment-history-detail-table').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        order: [[0, 'desc']], // Order by Date descending by default
        columnDefs: [
          { targets: 4, className: 'text-right' }, // Amount right aligned
          { targets: 7, orderable: false } // Disable ordering on Actions column
        ],
        language: {
          searchPlaceholder: "Search payments...",
          search: "",
          lengthMenu: "Show _MENU_ entries",
          info: "Showing _START_ to _END_ of _TOTAL_ entries",
        },
        dom:
          "<'flex flex-col md:flex-row md:items-center md:justify-between mb-4'<'flex items-center space-x-4'l><'flex items-center space-x-2'f>>" +
          "rt" +
          "<'flex flex-col md:flex-row md:items-center md:justify-between mt-4'<'text-sm text-gray-600'i><'pagination' p>>",
        initComplete: function() {
          // Add margin top and left to the length menu container
          const lengthDiv = $('div.dataTables_length');
          lengthDiv.addClass('mt-2 ml-2');

          // Style the select inside length menu
          const lengthSelect = lengthDiv.find('select');
          lengthSelect.addClass('form-select mt-1 block w-full md:w-auto rounded border border-gray-300 bg-white py-1 px-2 text-sm text-gray-700 focus:border-emerald-500 focus:ring-emerald-500');

          // Make the label a flex row with spacing and no wrap
          $('div.dataTables_length label').addClass('flex items-center gap-2 whitespace-nowrap');

          // Style search input
          const searchInput = $('div.dataTables_filter input');
          searchInput.addClass('form-input mt-1 block w-full md:w-64 rounded border border-gray-300 py-1 px-2 text-sm text-gray-700 focus:border-emerald-500 focus:ring-emerald-500');

          // Style pagination container with margin bottom
          $('div.pagination').addClass('mt-2 md:mt-0 mb-4');

          // Add margin outside pagination buttons for spacing
          $('div.pagination a, div.pagination span').addClass('mr-2 last:mr-0');

          // Style info text with margin top and left
          $('div.dataTables_info').addClass('mt-2 ml-2');
        }
      });
    });
  </script>
</body>
</html>
