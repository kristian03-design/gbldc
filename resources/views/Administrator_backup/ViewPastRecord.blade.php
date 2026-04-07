<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Payment Recipt | GBLDC</title>
    <link rel="stylesheet" href="output.css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
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
          <h1 class="text-lg md:text-xl font-semibold text-teal-900">GBLDC Payment Recipt</h1>
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
  <!-- Start Content Area -->
      <div class="max-w-7xl mx-auto px-4 py-8 ">
        <div class="flex items-start gap-8">
       

        <div class="container mx-auto py-8 px-4">
          <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Transaction Recipt Record</h1>
          
          <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-center text-red-700 px-4 py-3 m-2 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if(session('Record-updated'))
                <div class="bg-green-100 border border-green-400 text-center text-green-700 px-4 py-3 m-2 rounded relative mb-4" role="alert">
                    <strong class="font-bold"></strong>
                    <span class="block sm:inline">{{ session('Record-updated') }}</span>
                </div>
            @endif
          
            <!-- Payment Form -->
              <form action="{{route ('Payment.Submit')}}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                  <!-- Grid for Member Name and Transaction Type -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <!-- Member Name -->
                      <div>
                          <label for="member_name" class="block mb-2 text-sm font-medium text-gray-700">Member ID</label>
                          <input type="text" id="member_name" value="{{$Record->member_id}}" readonly
                              class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200">
                      </div>
                      <!-- Loan Number -->
                      <div>
                          <label for="loan_no" class="block mb-2 text-sm font-medium text-gray-700">Loan Number</label>
                          <input type="text" id="loan_no" value="{{$Record->loan_number}}" readonly
                              class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200">
                      </div>
                       <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" id="last_name" value="{{$Record->last_name}}" readonly 
                                class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200">
                        </div>

                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" id="first_name" value="{{$Record->first_name}}" readonly
                                class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200">
                        </div>

                        <!-- Middle Name -->
                        <div>
                            <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text" id="middle_name" value="{{$Record->middle_name}}" readonly
                                class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200">
                        </div>

                      <!-- Type of Transaction -->
                      <div>
                          <label for="transaction_type" class="block mb-2 text-sm font-medium text-gray-700">Type of Transaction</label>
                          <input type="text" class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200" value="{{$Record->transaction_type}}" readonly>
                        </div>
                  </div>

                  <!-- Grid for Payment Method and Payment Status -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <!-- Payment Method -->
                      <div>
                          <label for="payment_method" class="block mb-2 text-sm font-medium text-gray-700">Payment Method</label>
                          <input type="text" class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200" value="{{$Record->payment_method}}" readonly>
                      </div>

                      <!-- Paid On Time / Late / Early -->
                      <div>
                          <label for="payment_status" class="block mb-2 text-sm font-medium text-gray-700">Payment Status</label>
                          <input type="text" class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200" value="{{$Record->payment_status}}" readonly>
                      </div>
                  </div>

                  <!-- Grid for Dates -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <!-- Date of Transaction -->
                      <div>
                          <label for="transaction_date" class="block mb-2 text-sm font-medium text-gray-700">Date of Transaction</label>
                          <input type="date" id="transaction_date" value="{{$Record->transaction_date}}" readonly
                              class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200">
                      </div>

                  </div>

                  <!-- Grid for Transaction Handler and Updater -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <!-- Name of Transaction Handler -->
                      <div>
                          <label for="txn_handler" class="block mb-2 text-sm font-medium text-gray-700">Name of Transaction Handler</label>
                          <input type="text" id="txn_handler" value="{{$Record->transaction_handler}}" readonly
                              class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200">
                      </div>

                      <!-- Name of Person Who Update/Save -->
                      <div>
                          <label for="updater" class="block mb-2 text-sm font-medium text-gray-700">Name of Person Who Update/Save</label>
                          <input type="text" id="updater" value="{{$Record->updater_name}}" readonly
                              class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200">
                      </div>
                  </div>

                  <!-- Grid for Reference Number and Amount -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <!-- Reference Number -->
                      <div>
                          <label for="reference_number" class="block mb-2 text-sm font-medium text-gray-700">Reference Number</label>
                          <input type="text" id="reference_number" value="{{$Record->reference_number}}" readonly
                              class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200">
                      </div>

                      <!-- Amount of Payment -->
                      <div>
                          <label for="payment_amount" class="block mb-2 text-sm font-medium text-gray-700">Amount of Payment</label>
                          <input type="number" id="payment_amount" value="{{$Record->payment_amount}}" readonly
                              class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200">
                      </div>
                  </div>

                  <!-- Remarks -->
                  <div>
                      <label for="remarks" class="block mb-2 text-sm font-medium text-gray-700">Remarks</label>
                      <textarea id="remarks"  value="{{$Record->remarks}}" readonly rows="4" 
                          class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200"></textarea>
                  </div>

                  <!-- Grid for File Uploads -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <!-- Picture for Member Copy -->
                      <div>
                          <label class="block mb-2 text-sm font-medium text-gray-700">Member Recipt Copy</label>
                          <div class="flex items-center">
                              <label for="member_picture" hidden class="cursor-pointer bg-blue-500 hover:bg-blue-600 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200">
                                  Choose File
                              </label>
                              <span id="member_file_text" hidden class="ml-3 text-sm text-gray-500">No file chosen</span>
                          </div>
                           <img src="data:{{ $MemberMimeType }};base64,{{ $MemberBase64 }}" alt="Valid ID">
                      </div>

                      <!-- Picture for Coop Copy -->
                      <div>
                          <label class="block mb-2 text-sm font-medium text-gray-700">Coop Recipt Copy</label>
                          <div class="flex items-center">
                              <label for="coop_picture" hidden class="cursor-pointer bg-blue-500 hover:bg-blue-600 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200">
                                  Choose File
                              </label>
                              <span id="coop_file_text" hidden class="ml-3 text-sm text-gray-500">No file chosen</span>
                          </div>
                           <img src="data:{{ $AdminMimeType }};base64,{{ $AdminBase64 }}" alt="Valid ID">
                      </div>
                  </div>

                  <!-- Submit Button -->
                  <div class="pt-4 flex justify-between">
                      <a href="{{route ('Check.Last.Record', $Record->member_id)}}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-6 rounded-lg focus:ring-4 focus:ring-blue-300 focus:outline-none transition-all duration-200">Back</a>
                      <a href="{{ route('Loan.Payment.History', $Record->loan_number) }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 px-6 rounded-lg focus:ring-4 focus:ring-green-300 focus:outline-none transition-all duration-200">Payment History</a>
                  </div>
              </form>
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
    </body>
</html>