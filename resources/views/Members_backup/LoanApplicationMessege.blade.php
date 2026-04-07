<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FontAwesome for Icons -->
    <script src="https://kit.fontawesome.com/e588cb9d47.js"
      crossorigin="anonymous"></script>
    <link rel="icon" type="image/png"
      href="path/images/logocoop-removebg-preview 2.png" sizes="512x512" />
    <link href="../src/animation/animation.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap"
      rel="stylesheet">    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src={{asset("js/dropdown.js")}}></script>
    <script src={{asset("js/landingpage.js")}}></script>
    <script src={{asset("/js/landingpage-user.js")}}></script>
    <title>Loan Application | GBLDC</title>
  </head>

  <body class="bg-white text-gray-800 scroll-smooth"
    style="font-family: Outfit;">
    <!-- Header Section -->
    <header
      class="fixed top-0 left-0 w-full z-50 bg-white/95 backdrop-blur-sm shadow-sm border-b border-gray-100">
      <div
        class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3 lg:py-0">
        <!-- Logo Section - Responsive sizing -->
        <a href="{{route ('Member.Landing')}}"
          class="flex items-center gap-2 sm:gap-3 py-1 sm:py-2 flex-shrink-0">
          <img src="{{asset('images/logocoop-removebg-preview 2.png')}}"
            alt="GBLDC Logo"
            class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 object-contain">
          <span
            class="font-semibold text-base sm:text-lg lg:text-xl text-green-700 tracking-tight whitespace-nowrap">GBLDC</span>
        </a>

        <!-- Desktop Navigation -->
        <nav
          class="hidden lg:flex items-center gap-1 xl:gap-4 text-sm xl:text-base font-medium">
          <a href="{{route ('Member.Landing')}}"
            class="px-2 xl:px-3 py-2 rounded-md hover:bg-green-50 hover:text-green-700 transition-colors duration-200">Home</a>

          <!-- Products & Services Dropdown -->
          <div class="relative group">
            <button
              class="flex items-center gap-1 px-2 xl:px-3 py-2 rounded-md hover:bg-green-50 hover:text-green-700 transition-colors duration-200 focus:outline-none">
              <span class="whitespace-nowrap">Product &
                Services</span>
              <i
                class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180 duration-200"></i>
            </button>
            <div
              class="absolute left-0 top-full mt-2 w-48 bg-white border border-gray-100 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-20">
              <a href="loan-products.html"
                class="block px-4 py-3 hover:bg-green-50 hover:text-green-700 rounded-t-lg transition-colors">Loans</a>
              <a href="deposit.html"
                class="block px-4 py-3 hover:bg-green-50 hover:text-green-700 transition-colors">Deposits</a>
              <a href="savings-page.html"
                class="block px-4 py-3 hover:bg-green-50 hover:text-green-700 rounded-b-lg transition-colors">Savings</a>
            </div>
          </div>

          <!-- About Dropdown -->
          <div class="relative group">
            <button
              class="flex items-center gap-1 px-2 xl:px-3 py-2 rounded-md hover:bg-green-50 hover:text-green-700 transition-colors duration-200 focus:outline-none">
              <span>About</span>
              <i
                class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180 duration-200"></i>
            </button>
            <div
              class="absolute left-0 top-full mt-2 w-56 bg-white border border-gray-100 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-20">
              <a href="about-gbldc.html"
                class="block px-4 py-3 hover:bg-green-50 hover:text-green-700 rounded-t-lg transition-colors">About
                GBLDC</a>
              <a href="#"
                class="block px-4 py-3 hover:bg-green-50 hover:text-green-700 transition-colors">Mission
                & Vision</a>
              <a href="board-of-directors.html"
                class="block px-4 py-3 hover:bg-green-50 hover:text-green-700 transition-colors">Board
                of Directors</a>
              <a href="committee-officers.html"
                class="block px-4 py-3 hover:bg-green-50 hover:text-green-700 rounded-b-lg transition-colors">Committee
                Officers</a>
            </div>
          </div>

          <a href="news&events.html"
            class="px-2 xl:px-3 py-2 rounded-md hover:bg-green-50 hover:text-green-700 transition-colors duration-200 whitespace-nowrap">News
            & Events</a>
        </nav>

        <!-- Desktop CTA Button -->
        <div class="hidden lg:flex items-center">
          <div class="ml-4">
            <div class="relative group">
              <a href="#" title="User Profile"
                onclick="toggleProfileDropdown(event)"
                class="flex items-center gap-2">
                <img
                  src="{{asset('images/logocoop-removebg-preview 2.png')}}"
                  alt="User Avatar"
                  class="w-12 h-12 rounded-full object-cover shadow-sm hover:ring-2 hover:ring-green-400 transition-all duration-200 cursor-pointer">
                <i
                  class="fas fa-chevron-down text-gray-500 text-base">
                </a></i>
              <!-- Desktop Profile Dropdown Menu -->
              <div id="profile-dropdown"
                class="absolute right-0 mt-2 w-72 p-4 bg-white rounded-lg shadow-lg border z-30 hidden animate-fade-in">
                <div
                  class="flex items-center px-4 py-2 text-gray-800 font-semibold mb-2 break-all">
                  <?php echo isset($_SESSION['user_name']) ?
                  htmlspecialchars($_SESSION['user_name']) :
                  ''; ?>
                </div>
                <a href="loandashboard.html"
                  class="block px-4 text-gray-800 hover:bg-green-200 rounded-md p-2 transition-colors">Loan
                  Dashboard</a>
                <a href="{{ route('Member.AccountSettings') }}"
                  class="block px-4 py-2 text-gray-800 hover:bg-green-200 rounded-md p-2 transition-colors">Settings</a>
                <a href="help.html"
                  class="block px-4 py-2 text-gray-800 hover:bg-green-200 rounded-md p-2 transition-colors">Help
                  & Support</a>
                <div class="border-t my-1">
                  <a href="index.html"
                    onclick="openLogoutModal(event)"
                    class="block px-4 py-2 hover:bg-green-200 rounded-md p-2 transition-colors">Logout</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Mobile menu button -->
        <button id="mobile-menu-btn"
          class="lg:hidden flex items-center justify-center w-10 h-10 rounded-full hover:bg-green-50 transition-colors duration-200"
          onclick="toggleMobileMenu()">
          <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor"
            class="w-6 h-6 transition-transform duration-200">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <svg id="close-icon" xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor"
            class="w-6 h-6 hidden transition-transform duration-200">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Mobile Navigation Menu -->
      <div id="mobile-menu"
        class="lg:hidden absolute top-full left-0 w-full bg-white border-b border-gray-100 shadow-lg transform -translate-y-full invisible transition-all duration-300 z-40">
        <nav class="px-4 sm:px-6 py-4 space-y-1">
          <!-- Mobile Home Link -->
          <a href="{{route ('Member.Landing')}}"
            class="block px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors font-medium">
            Home
          </a>

          <!-- Mobile Products & Services -->
          <div class="space-y-1">
            <button onclick="toggleDropdownProductsMobile(event)"
              class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors font-medium text-left">
              <span>Product & Services</span>
              <i id="products-chevron"
                class="fas fa-chevron-down text-sm transition-transform duration-200"></i>
            </button>
            <div id="dropdown-menu-products-mobile"
              class="hidden ml-4 space-y-1">
              <a href="loan-products.html"
                class="block px-4 py-2 rounded-lg hover:bg-green-100 hover:text-green-700 transition-colors text-sm">Loans</a>
              <a href="deposit.html"
                class="block px-4 py-2 rounded-lg hover:bg-green-100 hover:text-green-700 transition-colors text-sm">Deposits</a>
              <a href="savings-page.html"
                class="block px-4 py-2 rounded-lg hover:bg-green-100 hover:text-green-700 transition-colors text-sm">Savings</a>
            </div>
          </div>

          <!-- Mobile About -->
          <div class="space-y-1">
            <button onclick="toggleDropdownMobileAbout(event)"
              class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors font-medium text-left">
              <span>About</span>
              <i id="about-chevron"
                class="fas fa-chevron-down text-sm transition-transform duration-200"></i>
            </button>
            <div id="dropdown-menu-about-mobile"
              class="hidden ml-4 space-y-1">
              <a href="about-gbldc.html"
                class="block px-4 py-2 rounded-lg hover:bg-green-100 hover:text-green-700 transition-colors text-sm">About
                GBLDC</a>
              <a href="#"
                class="block px-4 py-2 rounded-lg hover:bg-green-100 hover:text-green-700 transition-colors text-sm">Mission
                & Vision</a>
              <a href="board-of-directors.html"
                class="block px-4 py-2 rounded-lg hover:bg-green-100 hover:text-green-700 transition-colors text-sm">Board
                of Directors</a>
              <a href="committee-officers.html"
                class="block px-4 py-2 rounded-lg hover:bg-green-100 hover:text-green-700 transition-colors text-sm">Committee
                Officers</a>
            </div>
          </div>

          <!-- Mobile News & Events -->
          <a href="news&events.html"
            class="block px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors font-medium">
            News & Events
          </a>
           <!-- Mobile User Profile -->
                <div class="border-t pt-4 mt-4">
                    <div class="flex items-center px-4 py-2 mb-2">
                      <img src="https://via.placeholder.com/32x32/22c55e/ffffff?text=U" 
                           alt="User Avatar"
                           class="w-8 h-8 rounded-full object-cover mr-3">
                      <span class="font-medium text-gray-800">
                        <?php echo isset($_SESSION['user_name']) ?
                        htmlspecialchars($_SESSION['user_name']) :
                        ''; ?>
                      </span>
                    </div>
                    <a href="loandashboard.html" class="block px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors text-sm">Loan Dashboard</a>
                    <a href="account-settings.html" class="block px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors text-sm">Settings</a>
                    <a href="help.html" class="block px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors text-sm">Help & Support</a>
                    <a href="#" onclick="openLogoutModal(event)" class="block px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-700 transition-colors text-sm">Logout</a>
                </div>
        </nav>
      </div>
    </header>
    {{-- Start Content Area --}}
    <form action="" class="">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-center text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
    </form>
    {{-- End Content Area --}}

        <script>
              function toggleMobileMenu() {
                const mobileMenu = document.getElementById('mobile-menu');
                const menuIcon = document.getElementById('menu-icon');
                const closeIcon = document.getElementById('close-icon');
                
                if (mobileMenu.classList.contains('mobile-menu-open')) {
                    // Close menu
                    mobileMenu.classList.remove('mobile-menu-open');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                } else {
                    // Open menu
                    mobileMenu.classList.add('mobile-menu-open');
                    menuIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                }
            }

            // Mobile dropdown toggles
            function toggleDropdownProductsMobile(event) {
                event.preventDefault();
                const dropdown = document.getElementById('dropdown-menu-products-mobile');
                const chevron = document.getElementById('products-chevron');
                
                if (dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('hidden');
                    chevron.classList.add('rotate-180');
                } else {
                    dropdown.classList.add('hidden');
                    chevron.classList.remove('rotate-180');
                }
            }

            function toggleDropdownMobileAbout(event) {
                event.preventDefault();
                const dropdown = document.getElementById('dropdown-menu-about-mobile');
                const chevron = document.getElementById('about-chevron');
                
                if (dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('hidden');
                    chevron.classList.add('rotate-180');
                } else {
                    dropdown.classList.add('hidden');
                    chevron.classList.remove('rotate-180');
                }
            }
            // loan-application.js
function validateStep1(event) {
  event.preventDefault();
  const requiredFields = document.querySelectorAll(
    "input[required], select[required]"
  );
  let allFilled = true;
  let missingFields = [];

  requiredFields.forEach((field) => {
    if (!field.value.trim()) {
      allFilled = false;
      field.classList.add("border-red-500");
      let label =
        field.closest("div")?.querySelector("label")?.textContent ||
        field.previousElementSibling?.textContent ||
        field.closest("fieldset")?.querySelector("legend")?.textContent ||
        field.name ||
        field.id ||
        "Field";
      label = label.replace("*", "").trim();
      if (!missingFields.includes(label)) missingFields.push(label);
    } else {
      field.classList.remove("border-red-500");
    }
  });

  if (!allFilled) {
    Swal.fire({
      icon: "warning",
      iconColor: "#dc2626",
      color: "#1e2939",
      title: "Missing Required Fields",
      html: `<p>Please fill out the following required fields before proceeding:</p>
                   <ul style="text-align:left; color:#e53e3e;">
                   ${missingFields.map((f) => `<li>• ${f}</li>`).join("")}
                   </ul>`,
      confirmButtonColor: "#16a34a",
    });
  } else {
    // Proceed to the next page
    window.location.href = "applynowstep2.html";
  }
}

function closeModal() {
  // Not needed with SweetAlert2
}

function calculateAge() {
  const birthDateInput = document.getElementById("birthDate");
  const ageInput = document.getElementById("age");
  const birthDateValue = birthDateInput.value;
  if (!birthDateValue) {
    ageInput.value = "";
    return;
  }
  const today = new Date();
  const birthDate = new Date(birthDateValue);
  let age = today.getFullYear() - birthDate.getFullYear();
  const m = today.getMonth() - birthDate.getMonth();
  if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
    age--;
  }
  ageInput.value = age >= 0 ? age : "";
}
// PSGC API base URL
const PSGC_API = "https://psgc.gitlab.io/api";

// Elements
const provinceSelect = document.getElementById("province");
const citySelect = document.getElementById("city");
const barangaySelect = document.getElementById("barangay");

// Load provinces on page load
fetch(`${PSGC_API}/provinces/`)
  .then((res) => res.json())
  .then((provinces) => {
    provinces.forEach((province) => {
      provinceSelect.innerHTML += `<option value="${province.code}">${province.name}</option>`;
    });
  });

// When province changes, load cities/municipalities
provinceSelect.addEventListener("change", function () {
  const provinceCode = this.value;
  citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
  barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
  if (!provinceCode) return;

  fetch(`${PSGC_API}/provinces/${provinceCode}/cities-municipalities/`)
    .then((res) => res.json())
    .then((cities) => {
      cities.forEach((city) => {
        citySelect.innerHTML += `<option value="${city.code}">${city.name}</option>`;
      });
    });
});

// When city/municipality changes, load barangays and set zip code
citySelect.addEventListener("change", function () {
  const cityCode = this.value;
  barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
  document.getElementById("zipCode").value = ""; // Clear zip code
  if (!cityCode) return;

  // Fetch barangays
  fetch(`${PSGC_API}/cities-municipalities/${cityCode}/barangays/`)
    .then((res) => res.json())
    .then((barangays) => {
      barangays.forEach((barangay) => {
        barangaySelect.innerHTML += `<option value="${barangay.code}">${barangay.name}</option>`;
      });
    });

  // Fetch city/municipality details for zip code
  fetch(`${PSGC_API}/cities-municipalities/${cityCode}/`)
    .then((res) => res.json())
    .then((city) => {
      // PSGC API returns postalCode (zip code)
      document.getElementById("zipCode").value = city.postalCode || "";
    });
});

// Logout Modal Functions
function openLogoutModal(event) {
    event.preventDefault();
    const modal = document.getElementById('logout-modal');
    const modalContent = document.getElementById('logout-modal-content');
    const mobileMenu = document.getElementById('mobile-menu');
    
    // Close mobile menu if it's open
    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    
    modal.classList.remove('hidden');
    
    // Animate modal content in
    modalContent.style.opacity = '0';
    modalContent.style.transform = 'scale(0.95)';
    setTimeout(() => {
        modalContent.style.transition = 'opacity 0.3s, transform 0.3s';
        modalContent.style.opacity = '1';
        modalContent.style.transform = 'scale(1)';
    }, 10);
    
    // Add a semi-transparent background overlay
    if (!document.getElementById('logout-modal-overlay')) {
        const overlay = document.createElement('div');
        overlay.id = 'logout-modal-overlay';
        overlay.style.position = 'fixed';
        overlay.style.top = 0;
        overlay.style.left = 0;
        overlay.style.width = '100vw';
        overlay.style.height = '100vh';
        overlay.style.background = 'rgba(0,0,0,0.4)';
        overlay.style.zIndex = 59;
        overlay.onclick = closeLogoutModal;
        document.body.appendChild(overlay);
    }
    
    // Prevent body scrolling
    document.body.classList.add('overflow-hidden');
}

function closeLogoutModal() {
    const modal = document.getElementById('logout-modal');
    const modalContent = document.getElementById('logout-modal-content');
    
    if (!modal || modal.classList.contains('hidden')) {
        return; // Modal is already closed
    }
    
    // Animate modal content out
    modalContent.style.transition = 'opacity 0.2s, transform 0.2s';
    modalContent.style.opacity = '0';
    modalContent.style.transform = 'scale(0.95)';
    
    setTimeout(() => {
        modal.classList.add('hidden');
        // Remove the overlay if it exists
        const overlay = document.getElementById('logout-modal-overlay');
        if (overlay) overlay.remove();
        // Allow body scrolling again
        document.body.classList.remove('overflow-hidden');
    }, 200);
}

function confirmLogout() {
    // Close the modal first
    closeLogoutModal();
    
    // Add a small delay for better UX, then redirect
    setTimeout(() => {
        // You can also make an AJAX call here to properly logout from the server
        // For now, we'll just redirect
        window.location.href = 'index.html';
    }, 300);
}

// Profile Dropdown Function
function toggleProfileDropdown(event) {
    event.preventDefault();
    const dropdown = document.getElementById('profile-dropdown');
    dropdown.classList.toggle('hidden');
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function handler(e) {
        if (!dropdown.contains(e.target) && !event.target.contains(e.target)) {
            dropdown.classList.add('hidden');
            document.removeEventListener('click', handler);
        }
    });
}

// Desktop Dropdown Functions (for existing dropdowns)
function toggleDropdown(event) {
    event.preventDefault();
    const dropdown = document.getElementById('dropdown-menu');
    dropdown.classList.toggle('hidden');
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function handler(e) {
        if (!dropdown.contains(e.target) && !event.target.contains(e.target)) {
            dropdown.classList.add('hidden');
            document.removeEventListener('click', handler);
        }
    });
}

function toggleDropdownProducts(event) {
    event.preventDefault();
    const dropdown = document.getElementById('dropdown-menu-products');
    dropdown.classList.toggle('hidden');
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function handler(e) {
        if (!dropdown.contains(e.target) && !event.target.contains(e.target)) {
            dropdown.classList.add('hidden');
            document.removeEventListener('click', handler);
        }
    });
}

// Mobile Menu Toggle Functions with Enhanced Touch Events
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const mobileProductsToggle = document.getElementById('mobile-products-toggle');
    const mobileProductsDropdown = document.getElementById('mobile-products-dropdown');
    const mobileAboutToggle = document.getElementById('mobile-about-toggle');
    const mobileAboutDropdown = document.getElementById('mobile-about-dropdown');

    // Add touch feedback to all mobile menu items
    function addTouchFeedback() {
        const mobileMenuItems = document.querySelectorAll('#mobile-menu a, #mobile-menu button');
        
        mobileMenuItems.forEach(item => {
            // Skip if already has touch feedback
            if (item.dataset.touchFeedback) return;
            item.dataset.touchFeedback = 'true';
            
            // Add touch start event for immediate feedback
            item.addEventListener('touchstart', function(e) {
                // Different colors for different types of items
                let bgColor = '#dcfce7'; // Default green
                
                if (this.href && this.href.includes('applynow')) {
                    bgColor = '#dcfce7'; // Green for Apply Now
                } else if (this.onclick && this.onclick.toString().includes('openLogoutModal')) {
                    bgColor = '#fee2e2'; // Light red for logout
                } else if (this.closest('#mobile-products-dropdown, #mobile-about-dropdown')) {
                    bgColor = '#dbeafe'; // Light blue for dropdown items
                }
                
                this.style.backgroundColor = bgColor;
                this.style.transform = 'scale(0.98)';
                this.style.transition = 'all 0.1s ease';
            }, { passive: true });
            
            // Remove feedback on touch end
            item.addEventListener('touchend', function() {
                setTimeout(() => {
                    this.style.backgroundColor = '';
                    this.style.transform = '';
                }, 150);
            }, { passive: true });
            
            // Handle touch cancel (when user drags away)
            item.addEventListener('touchcancel', function() {
                this.style.backgroundColor = '';
                this.style.transform = '';
            }, { passive: true });
        });
    }

    // Toggle mobile menu
    function toggleMobileMenu() {
        mobileMenu.classList.toggle('hidden');
        document.body.classList.toggle('overflow-hidden'); // Prevent scrolling when menu is open
        
        // Add touch feedback after menu opens
        if (!mobileMenu.classList.contains('hidden')) {
            setTimeout(addTouchFeedback, 100);
        }
    }

    // Close mobile menu
    function closeMobileMenu() {
        mobileMenu.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Mobile menu button click with enhanced touch feedback
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', function() {
            // Add haptic feedback if available
            if (navigator.vibrate) {
                navigator.vibrate(50); // 50ms vibration
            }
            toggleMobileMenu();
        });
        
        // Add touch feedback to hamburger button
        mobileMenuButton.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.95)';
            this.style.backgroundColor = '#16a34a';
            this.style.color = 'white';
            this.style.transition = 'all 0.1s ease';
        }, { passive: true });
        
        mobileMenuButton.addEventListener('touchend', function() {
            setTimeout(() => {
                this.style.transform = '';
                this.style.backgroundColor = '';
                this.style.color = '';
            }, 100);
        }, { passive: true });
        
        mobileMenuButton.addEventListener('touchcancel', function() {
            this.style.transform = '';
            this.style.backgroundColor = '';
            this.style.color = '';
        }, { passive: true });
    }

    // Mobile menu close button click
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', function() {
            if (navigator.vibrate) {
                navigator.vibrate(30);
            }
            closeMobileMenu();
        });
        
        // Add touch feedback to close button
        mobileMenuClose.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.9)';
            this.style.color = '#dc2626';
            this.style.transition = 'all 0.1s ease';
        }, { passive: true });
        
        mobileMenuClose.addEventListener('touchend', function() {
            setTimeout(() => {
                this.style.transform = '';
                this.style.color = '';
            }, 100);
        }, { passive: true });
        
        mobileMenuClose.addEventListener('touchcancel', function() {
            this.style.transform = '';
            this.style.color = '';
        }, { passive: true });
    }

    // Close menu when clicking outside (on the backdrop)
    if (mobileMenu) {
        mobileMenu.addEventListener('click', function(e) {
            if (e.target === mobileMenu) {
                closeMobileMenu();
            }
        });
    }

    // Enhanced Mobile Products dropdown toggle
    if (mobileProductsToggle && mobileProductsDropdown) {
        mobileProductsToggle.addEventListener('click', function() {
            mobileProductsDropdown.classList.toggle('hidden');
            const chevron = this.querySelector('i');
            if (chevron) {
                chevron.classList.toggle('fa-chevron-down');
                chevron.classList.toggle('fa-chevron-up');
            }
            
            // Add haptic feedback
            if (navigator.vibrate) {
                navigator.vibrate(30);
            }
            
            // Add touch feedback to dropdown items when opened
            if (!mobileProductsDropdown.classList.contains('hidden')) {
                setTimeout(addTouchFeedback, 50);
            }
        });
    }

    // Enhanced Mobile About dropdown toggle
    if (mobileAboutToggle && mobileAboutDropdown) {
        mobileAboutToggle.addEventListener('click', function() {
            mobileAboutDropdown.classList.toggle('hidden');
            const chevron = this.querySelector('i');
            if (chevron) {
                chevron.classList.toggle('fa-chevron-down');
                chevron.classList.toggle('fa-chevron-up');
            }
            
            // Add haptic feedback
            if (navigator.vibrate) {
                navigator.vibrate(30);
            }
            
            // Add touch feedback to dropdown items when opened
            if (!mobileAboutDropdown.classList.contains('hidden')) {
                setTimeout(addTouchFeedback, 50);
            }
        });
    }

    // Close mobile menu when window is resized to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) { // lg breakpoint
            closeMobileMenu();
        }
    });

    // Enhanced keyboard support and modal handling
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            // Close mobile menu
            closeMobileMenu();
            
            // Close desktop dropdowns
            const dropdowns = ['dropdown-menu', 'dropdown-menu-products', 'profile-dropdown'];
            dropdowns.forEach(id => {
                const dropdown = document.getElementById(id);
                if (dropdown && !dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                }
            });
            
            // Close logout modal
            closeLogoutModal();
        }
    });

    // Close logout modal when clicking on the backdrop
    const logoutModal = document.getElementById('logout-modal');
    if (logoutModal) {
        logoutModal.addEventListener('click', function(e) {
            if (e.target === logoutModal) {
                closeLogoutModal();
            }
        });
    }

    // Initialize touch feedback when page loads (for initial menu items)
    setTimeout(addTouchFeedback, 500);
});

        </script>
         <div id="logout-modal"
        class="fixed inset-0 z-[60] flex items-center justify-center hidden">
        <div id="logout-modal-content"
          class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full mx-4 transform transition-all duration-300 relative z-[61]">
          <div class="text-center">
            <!-- Icon -->
            <div
              class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
              <i class="fas fa-sign-out-alt text-red-600 text-xl"></i>
            </div>

            <!-- Title -->
            <h3 class="text-lg font-medium text-gray-900 mb-2">
              Confirm Logout
            </h3>

            <!-- Message -->
            <p class="text-sm text-gray-500 mb-6">
              Are you sure you want to logout? You will need to sign in again to
              access your account.
            </p>

            <!-- Buttons -->
            <div
              class="flex flex-col sm:flex-row gap-3 sm:gap-2 justify-center">
              <button onclick="closeLogoutModal()"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                Cancel
              </button>
               <a href="{{ route('Member.Logout') }}"
                class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 inline-block text-center">
                Logout
              </a>
            </div>
          </div>
        </div>
      </div>
    </body>
</html>
