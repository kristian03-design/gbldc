<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Shared Capital Payment History Detail | GBLDC Admin</title>
    <link rel="stylesheet" href="output.css" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  
  <!-- ✓ DataTables Core & Responsive CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="icon" type="image/png"
      href={{asset('images/logocoop-removebg-preview-2.png')}}>
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen">
    <!-- Header Section -->
    <header class="bg-white shadow-md fixed left-0 top-0 z-50 w-full">
      <div
        class="max-w-7xl mx-auto flex justify-between items-center px-4 py-3 relative">
        <div class="flex items-center space-x-4">
          <img src={{asset('images/logocoop-removebg-preview-2.png')}}
            alt="GBLDC Logo" class="w-12 h-12 object-cover" />
          <h1 class="text-lg md:text-xl font-semibold text-teal-900">GBLDC Shared Capital Payment History Detail</h1>
        </div>
        <div class="relative">
          <button id="user-menu-button"
            class="flex items-center gap-3 focus:outline-none">
            <span
              class="hidden md:inline text-gray-700 font-medium">Admin</span>
            <img src={{asset('images/logocoop-removebg-preview-2.png')}}
              alt="Admin Avatar"
              class="w-10 h-10 rounded-full border-2 border-green-600 object-cover" />
            <i class="fas fa-chevron-down text-gray-600 text-sm"></i>
          </button>
          <div id="user-menu"
            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-100 py-2 hidden transition-all duration-200 ease-in-out">
            <a href="#"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">Profile</a>
            <a href="{{route ('Admin.manage')}}"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">Manage User</a>
            <a href="{{ route('Admin.Settings') }}"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">Settings</a>
            <div class="border-t my-1 border-gray-200"></div>
            <a href="{{ route('Admin.Logout') }}"
              class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition">Logout</a>
          </div>
        </div>
      </div>
    </header>
      <main class="pt-28 pb-12 px-4 max-w-7xl mx-auto">
    <!-- Title -->
    <div class="mb-8">
      <h2 class="text-2xl font-bold text-green-800">Shared Capital Payment History Detail</h2>
      <p class="text-gray-700">View members payment in shared capital.</p>
      <a href="{{route('Check.Last.Record', ['member_id' => $FindRecord->first()->member_id ?? '', 'type' => 'shared_capital'])}}" class="inline-flex items-center mt-1 px-3 py-1.5 rounded bg-green-100 text-green-800 hover:bg-green-200 transition-colors focus:outline-none focus:ring-2 focus:ring-green-400 shadow-sm mr-3">
        <i class="fa fa-arrow-left mr-2"></i> Back</a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow p-8">
      <h3 class="text-2xl font-bold text-green-800 mb-6 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2a4 4 0 004 4h2a4 4 0 004-4z" /></svg>
        Shared Capital Payment History
      </h3>
      <div class="overflow-x-auto">
                  <table 
            id="loanTable" 
            class="display responsive nowrap w-full text-sm border border-green-100 rounded-lg my-2"
          >
            <thead>
              <tr class="bg-green-100 text-green-900">
                <th>Member ID</th>
                <th>Reference No.</th>
                <th>Payment Amount</th>
                <th>Transaction Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($FindRecord as $Record)
              <tr class="hover:bg-gray-50">
                <td class="py-2 px-2 border-b border-gray-200">{{$Record->member_id}}</td>
                <td class="py-2 px-2 border-b border-gray-200">{{$Record->reference_number}}</td>
                <td class="py-2 px-2 border-b border-gray-200">{{$Record->payment_amount}}</td>
                <td class="py-2 px-2 border-b border-gray-200">{{$Record->transaction_date}}</td>
                <td class="py-2 px-2 border-b border-gray-200">
                  <a
                    href="{{route ('View.SC.Record', $Record->id)}}"
                    class="inline-flex items-center px-3 py-1.5 rounded bg-green-50 text-green-700 border border-green-200 hover:bg-green-200 hover:text-green-900 focus:outline-none focus:ring-2 focus:ring-green-400 transition-all shadow-sm mr-2"
                  >
                    <i class="fas fa-eye mr-1"></i>View Details
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

      </div>
    </div>
      </main>
      <script>
      const counters = document.querySelectorAll('[data-target]');
      const animateCounter = (counter) => {
        const target = +counter.getAttribute('data-target');
        const duration = 1000; // 1 second
        const stepTime = 20; // 20ms
        const steps = duration / stepTime;
        const increment = target / steps;
        let current = 0;

        const updateCounter = () => {
          current += increment;
          if (current < target) {
            counter.innerText = Math.ceil(current).toLocaleString();
            setTimeout(updateCounter, stepTime);
          } else {
            counter.innerText = target.toLocaleString();
          }
        };
        updateCounter();
      };

      counters.forEach(animateCounter);
      const userMenuBtn = document.getElementById("user-menu-button");
      const userMenu = document.getElementById("user-menu");

    userMenuBtn.addEventListener("click", (e) => {
      e.stopPropagation(); // Prevents the click from bubbling to document
      userMenu.classList.toggle("hidden");
    });

    document.addEventListener("click", (e) => {
      if (!userMenu.contains(e.target) && !userMenuBtn.contains(e.target)) {
        userMenu.classList.add("hidden");
      }
    });
    </script>
     <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script>
    $(document).ready(function () {
      // Setup - add a select to the "Type" header for filtering only
      $('#loanTable thead tr').clone(true).appendTo('#loanTable thead');
      $('#loanTable thead tr:eq(1) th').each(function (i) {
        if (i === 2) { // Only the "Type" column
          var select = $('<select class="border rounded px-1 py-0.5 text-xs" hidden><option value="">All</option></select>')
            .appendTo($(this).empty())
            .on('change', function () {
              var val = $.fn.dataTable.util.escapeRegex($(this).val());
              table.column(i).search(val ? '^' + val + '$' : '', true, false).draw();
            });
          $('#loanTable tbody tr').each(function () {
            var cellText = $('td', this).eq(i).text().trim();
            if (select.find('option[value="' + cellText + '"]').length === 0) {
              select.append('<option value="' + cellText + '">' + cellText + '</option>');
            }
          });
        } else {
          $(this).html(''); // Clear other header cells in the filter row
        }
      });

      const table = $('#loanTable').DataTable({
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true,
        columnDefs: [
          { targets: -1, responsivePriority: 1 } // Make Actions column high priority
        ],
        language: {
          search: "🔍 Search:",
          lengthMenu: "Show _MENU_ entries",
          info: "Showing _START_ to _END_ of _TOTAL_ loans",
          infoEmpty: "No loans found",
          zeroRecords: "No matching loans found"
        }
      });
    });

    // Improved modal rendering with icons and better layout
    function renderStep(title, data, icon) {
      let html = `<div style="margin-bottom:10px;"><span style="font-weight:bold;display:inline-flex;align-items:center;gap:6px;">${icon || ''}${title}</span><ul style="margin:4px 0 0 18px;padding:0;">`;
      for (const key in data) {
        html += `<li style="margin-bottom:2px;"><strong>${key}:</strong> ${data[key]}</li>`;
      }
      html += '</ul></div>';
      return html;
    }

    const icons = [
      '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>',
      '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M16 3v4M8 3v4"/></svg>',
      '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg>',
      '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3v4M8 3v4"/></svg>'
    ];
  </script>
    </body>
</html>
