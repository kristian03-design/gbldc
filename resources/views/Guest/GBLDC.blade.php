<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FontAwesome for Icons -->
    <script src="https://kit.fontawesome.com/e588cb9d47.js"
      crossorigin="anonymous"></script>
    <link rel="icon" type="image/png"
      href="{{asset('images/logocoop-removebg-preview-2.png')}}" sizes="512x512" />
    <link href="../src/animation/animation.css" rel="stylesheet">
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap"
      rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script
      src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <title>Landing Page | GBLDC</title>

  </head>
  <body class="bg-white text-gray-800 scroll-behaviour-smooth" style="font-family: Outfit;">
    <!-- Modern Header/Navbar -->
    <header
      class="fixed top-0 left-0 w-full z-50 bg-white/95 backdrop-blur-sm shadow-sm border-b border-gray-100">
      <div
        class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3 lg:py-0">
        <!-- Logo Section - Responsive sizing -->
        <a href="{{route('Landing.Page')}}"
          class="flex items-center gap-2 sm:gap-3 py-1 sm:py-2 flex-shrink-0">
          <img src="{{asset ('images/logocoop-removebg-preview-2.png')}}"
            alt="GBLDC Logo"
            class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 object-contain">
          <span
            class="font-semibold text-base sm:text-lg lg:text-xl text-green-700 tracking-tight whitespace-nowrap">GBLDC</span>
        </a>

        <!-- Desktop Navigation -->
        <nav
          class="hidden lg:flex items-center gap-1 xl:gap-4 text-sm xl:text-base font-medium">
          <a href="{{route('Landing.Page')}}"
            class="px-2 xl:px-3 py-2 rounded-md hover:bg-green-50 hover:text-green-700 transition-colors duration-200">Home</a>

          <!-- Products & Services Dropdown -->
          <div class="relative group">
            <button
              class="flex items-center gap-1 px-2 xl:px-3 py-2 rounded-md hover:bg-green-50 hover:text-green-700 transition-colors duration-200 focus:outline-none">
              <span class="whitespace-nowrap">Services</span>
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
        <div class="flex items-center gap-3">
          <a href="{{ route('Member.Login') }}"
            class="w-full hidden lg:inline-block bg-green-600 text-white px-12 py-2 rounded-full text-sm font-semibold shadow hover:bg-green-700 transition">Login</a>
        </div>


        <!-- Mobile menu button -->
        <button id="mobile-menu-btn"
          class="lg:hidden flex items-center justify-center w-10 h-10 rounded-full hover:bg-green-50 transition-colors duration-200"
          onclick="toggleMobileMenu()">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>

      <!-- Mobile Navigation Menu -->
      <div id="mobile-menu"
        class="lg:hidden absolute top-full left-0 w-full bg-white border-b border-gray-100 shadow-lg transform -translate-y-full invisible transition-all duration-300 z-40">
        <nav class="px-4 sm:px-6 py-4 space-y-1">
          <!-- Mobile Home Link -->
          <a href="{{route('Landing.Page')}}"
            class="block px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors font-medium">
            Home
          </a>

          <!-- Mobile Products & Services -->
          <div class="space-y-1">
            <button onclick="toggleDropdownProductsMobile(event)"
              class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors font-medium text-left">
              <span>Services</span>
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
            <div id="dropdown-menu-about-mobile" class="hidden ml-4 space-y-1">
              <a href="about-gbldc.html"
                class="block px-4 py-2 rounded-lg hover:bg-green-100 hover:text-green-700 transition-colors text-sm">About
                GBLDC</a>
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
        </nav>
      </div>
    </header>

    <!-- Hero Section -->
    <section
      class="relative w-full min-h-screen flex items-center justify-center md:pt-32 md:pb-20 overflow-hidden">
      <img src="{{asset('images/meeting-2.png')}}" alt="Hero Banner"
        class="absolute inset-0 w-full h-full object-cover pointer-events-none select-none"
        onerror="this.style.display='none'"/>
      <div
        class="absolute inset-0 bg-gradient-to-br from-green-700/80 to-green-800/80 opacity-75"></div>
      <div class="relative z-10 max-w-3xl mx-auto text-center px-4">
        <h1
          class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight drop-shadow-lg fade-in">Your
          Financial Growth,<br><span class="text-green-400">Our
            Priority</span></h1>
        <p class="text-lg md:text-2xl text-green-100 mb-8 font-light slide-up">Building
          stronger communities through cooperative financial services. Join
          thousands of members who trust us for their financial future.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center slide-up mt-10">
          <a href="{{route('Registration.form1')}}"
            class="bg-green-600 text-white px-8 py-3 rounded-full text-lg font-semibold shadow hover:bg-green-700 transition">Become
            a Member</a>
          <a href="learn-more-about-membership.html"
            class="border-2 border-white text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-white hover:text-green-700 transition">About Membership</a>
        </div>
      </div>
    </section>
    <!-- Products/Services Section -->
    <section id="services" class="py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our
            Services</h2>
          <p class="text-xl text-gray-600 max-w-2xl mx-auto">Comprehensive
            financial solutions designed to meet your needs and help you achieve
            your goals.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Loans Card -->
          <div
            class="bg-white rounded-2xl p-8 shadow-lg hover-lift hover:shadow-xl hover-scale">
            <div
              class="w-16 h-16  flex items-center justify-center mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" width="60" height="70"
                viewBox="0 0 24 24" fill="#0000000">
                <g clip-path="url(#clip0_4418_169761)">
                  <path
                    d="M21.9201 16.7496C21.5901 19.4096 19.4101 21.5896 16.7501 21.9196C15.1401 22.1196 13.6401 21.6796 12.4701 20.8196C11.8001 20.3296 11.9601 19.2896 12.7601 19.0496C15.7701 18.1396 18.1401 15.7596 19.0601 12.7496C19.3001 11.9596 20.3401 11.7996 20.8301 12.4596C21.6801 13.6396 22.1201 15.1396 21.9201 16.7496Z"
                    fill="white" style="fill: var(--fillg);" />
                  <path
                    d="M9.99 2C5.58 2 2 5.58 2 9.99C2 14.4 5.58 17.98 9.99 17.98C14.4 17.98 17.98 14.4 17.98 9.99C17.97 5.58 14.4 2 9.99 2ZM9.05 8.87L11.46 9.71C12.33 10.02 12.75 10.63 12.75 11.57C12.75 12.65 11.89 13.54 10.84 13.54H10.75V13.59C10.75 14 10.41 14.34 10 14.34C9.59 14.34 9.25 14 9.25 13.59V13.53C8.14 13.48 7.25 12.55 7.25 11.39C7.25 10.98 7.59 10.64 8 10.64C8.41 10.64 8.75 10.98 8.75 11.39C8.75 11.75 9.01 12.04 9.33 12.04H10.83C11.06 12.04 11.24 11.83 11.24 11.57C11.24 11.22 11.18 11.2 10.95 11.12L8.54 10.28C7.68 9.98 7.25 9.37 7.25 8.42C7.25 7.34 8.11 6.45 9.16 6.45H9.25V6.41C9.25 6 9.59 5.66 10 5.66C10.41 5.66 10.75 6 10.75 6.41V6.47C11.86 6.52 12.75 7.45 12.75 8.61C12.75 9.02 12.41 9.36 12 9.36C11.59 9.36 11.25 9.02 11.25 8.61C11.25 8.25 10.99 7.96 10.67 7.96H9.17C8.94 7.96 8.76 8.17 8.76 8.43C8.75 8.77 8.81 8.79 9.05 8.87Z"
                    fill="white" style="fill: var(--fillg);" />
                </g>
                <defs>
                  <clippath id="clip0_4418_169761">
                    <rect width="24" height="24" fill="white" />
                  </clippath>
                </defs>
              </svg>

            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Flexible
              Loans</h3>
            <p class="text-gray-600 mb-6">Access competitive loan rates for
              personal, business, or educational needs with flexible repayment
              terms.</p>
            <a href="loan-products.html"
              class="text-green-600 font-semibold hover:text-green-800 hover:underline transition-colors">Learn
              More →</a>
          </div>

          <div
            class="bg-white rounded-2xl p-8 shadow-lg hover-lift hover:shadow-xl hover-scale">
            <div
              class="w-16 h-16 flex items-center justify-center mb-6">
              <svg viewBox="0 0 24 24" aria-label="Deposit" role="img"
                fill="none" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round">
                <!-- Base tray -->
                <path d="M3 17h18v3H3z" />
                <!-- Arrow down -->
                <path d="M12 4v8M8 10l4 4 4-4" />
                <!-- Coin -->
                <circle cx="12" cy="6" r="2" />
              </svg>

            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Secure
              Deposits</h3>
            <p class="text-gray-600 mb-6">Grow your savings with competitive
              interest rates and flexible deposit options tailored to your
              financial goals.</p>
            <a href="deposit.html"
              class="text-green-600 font-semibold hover:text-green-800 hover:underline transition-colors">Learn
              More →</a>
          </div>

          <!-- Savings Card -->
          <div
            class="bg-white rounded-2xl p-8 shadow-lg hover-lift hover:shadow-xl hover-scale">
            <div
              class="w-16 h-16 flex items-center justify-center mb-6">
              <svg viewBox="0 0 24 24" aria-label="Savings jar" role="img"
                fill="none" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round">
                <rect x="6" y="6" width="12" height="14" rx="3" />
                <path d="M9 6V4h6v2" />
                <circle cx="12" cy="11" r="2.25" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Savings</h3>
            <p class="text-gray-600 mb-6">Secure your future and grow your
              wealth
              with our reliable savings options designed for every member.</p>
            <a href="savings-page.html"
              class="text-green-600 font-semibold hover:text-green-800 hover:underline transition-colors">Learn
              More →</a>
          </div>
        </div>
      </section>
      <!-- Member Meetings Carousel -->
      <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Member
              Meetings & Events</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Stay connected
              with our community through regular meetings and special
              events.</p>
          </div>
          <div class="relative">
            <!-- Slick Carousel -->
            <div class="slick-carousel flex " id="meetings-carousel">
              <div>
                <img src="{{asset('images/meeting-1.png')}}"
                  class="object-cover rounded-xl shadow-lg w-full h-72 md:h-96 px-2"
                  alt="Meeting 1">
              </div>
              <div>
                <img src="{{asset('images/meeting-2.png')}}"
                  class="object-cover rounded-xl shadow-lg w-full h-72 md:h-96 px-2"
                  alt="Meeting 2">
              </div>
              <div>
                <img src="{{asset('images/meeting-3.png')}}"
                  class="object-cover rounded-xl shadow-lg w-full h-72 md:h-96 px-2"
                  alt="Meeting 3">
              </div>
              <div>
                <img src="{{asset('images/board-group-photo.jpg')}}"
                  class="object-cover rounded-xl shadow-lg w-full h-72 md:h-96 px-2"
                  alt="Board Group">
              </div>
              <div>
                <img src="{{asset('images/event4.jpg')}}"
                  class="object-cover rounded-xl shadow-lg w-full h-72 md:h-96 px-2"
                  alt="Event 4">
              </div>
              <div>
                <img src="{{asset('images/event2.jpg')}}"
                  class="object-cover rounded-xl shadow-lg w-full h-72 md:h-96 px-2"
                  alt="Event 5">
              </div>
              <div>
                <img src="{{asset('images/event3.jpg')}}"
                  class="object-cover rounded-xl shadow-lg w-full h-72 md:h-96 px-2"
                  alt="Event 6">
              </div>
            </div>
            <!-- Slick Dots will appear here -->
          </div>
        </div>
        <!-- SlickJS CSS & JS -->
        <link rel="stylesheet" type="text/css"
          href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
        <link rel="stylesheet" type="text/css"
          href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script
          src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        <!-- News & Events Section -->
        <section id="news" class="py-20 bg-gray-50">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
              <h2
                class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Latest
                News & Updates</h2>
              <p class="text-xl text-gray-600 max-w-2xl mx-auto">Stay informed
                with the latest developments and opportunities at GBLDC.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              <article
                class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift hover:shadow-xl hover-scale">
                <img src="{{asset('images/event1.jpg')}}" alt="Event 1"
                  class="rounded-t-2xl w-full h-56 object-cover">
                <div class="p-6">
                  <span class="text-sm text-green-600 font-semibold mb-6">March
                    22,
                    2024</span>
                  <h3 class="text-xl font-semibold text-gray-900 mt-2 mb-3">22nd
                    Annual
                    General Assembly of Greater Bulacan Livelihood Development
                    Cooperative</h3>
                  <p class="text-gray-600 mb-4">Held last March 22,
                    2024 @ Cafe De Apati, Makinabang, Baliuag, Bulacan. Join us
                    for
                    an engaging discussion on cooperative development and future
                    initiatives.</p>
                  <a href="#"
                    class="inline-flex items-center text-green-600 font-semibold hover:text-green-800 hover:underline transition-colors">
                    Read More
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </a>
                </div>
              </article>

              <article
                class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift hover:shadow-xl hover-scale">
                <img src="{{asset('images/event2.jpg')}}" alt="Event 2"
                  class="rounded-t-2xl w-full h-56 object-cover">
                <div class="p-6">
                  <span class="text-sm text-green-600 font-semibold">August 15,
                    2025</span>
                  <h3
                    class="text-xl font-semibold text-gray-900 mt-2 mb-3">Coop
                    Parade,
                    Kick-Off Ceremony and Launching of Go Koop</h3>
                  <p class="text-gray-600 mb-4">Empowering
                    Cooperatives in line with the Celebration of Cooperative
                    Month
                    2023. Join us for a day of celebration and awareness of the
                    cooperative movement in our community.</p>
                  <a href="#"
                    class="inline-flex items-center text-green-600 font-semibold hover:text-green-800 hover:underline transition-colors">
                    Read More
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </a>
                </div>
              </article>

              <article
                class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift hover:shadow-xl hover-scale">
                <img src="{{asset('images/event3.jpg')}}" alt="Event 3"
                  class="rounded-t-2xl w-full h-56 object-cover">
                <div class="p-6">
                  <span class="text-sm text-green-600 font-semibold"> April
                    12-13, 2025</span>
                  <h3
                    class="text-xl font-semibold text-gray-900 mt-2 mb-3">Family
                    Outing and Team Building</h3>
                  <p class="text-gray-600 mb-4">Join us for a day of fun and
                    bonding activities designed to strengthen our cooperative
                    spirit
                    and teamwork.</p>
                  <a href="#"
                    class="inline-flex items-center text-green-600 font-semibold hover:text-green-800 hover:underline transition-colors">
                    Read More
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round"  
                        stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </a>
                </div>
              </article>

              <article class="bg-white rounded-2xl shadow-lg overflow-hidden">

              </div>

              <div class="text-center mt-12">
                <a href="news&events.html"
                  class="bg-green-700 hover:bg-green-900 text-white px-8 py-3 rounded-full font-semibold transition-colors">
                  View All News
                </a>
              </div>
            </div>
          </section>
          <!-- Testimonial Section -->
          <section class="bg-white py-20 w-full">
            <div class="max-w-7xl mx-auto px-4">
              <div class="text-center mb-16">
                <h2
                  class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Member
                  Feedback</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">What our
                  partners say about us</p>
              </div>

              <!-- Swiper Container -->
              <div class="swiper testimonial-swiper">
                <div class="swiper-wrapper">

                  <!-- Testimonial 1 -->
                  <div class="swiper-slide">
                    <div
                      class="flex flex-col lg:flex-row items-center gap-12 max-w-6xl mx-auto">
                      <div class="relative flex-shrink-0">
                        <img src="{{asset('images/member-testimonial.jpg')}}"
                          alt="Joselito Gutierrez"
                          class="member-image">
                      </div>
                      <div class="flex-1 max-w-2xl">
                        <div class="testimonial-card">
                          <span
                            class="quote-mark absolute -left-4 -top-2">"</span>
                          <p
                            class="text-lg text-gray-800 leading-relaxed mb-6 relative z-10">
                            Kung sa trabaho, halos malaki na din ang nawala sa
                            akin. Kaya yung natanggap ko, panggastos ko na din
                            pambili ng pagkain at vitamins para may malakas na
                            resistensya. Pinagpapasalamat ko po sa GBLDC anuman
                            pong naiabot na tulong para makaraos din.
                          </p>
                          <span
                            class="quote-mark absolute -right-4 -bottom-8">"</span>

                          <div class="mt-8 relative z-10">
                            <h4
                              class="font-semibold text-gray-900 text-xl mb-1">Joselito
                              D.C Gutierrez</h4>
                            <p class="text-gray-600 mb-3">Member, Poblacion
                              Branch</p>
                            <div class="star-rating">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Testimonial 2 -->
                  <div class="swiper-slide">
                    <div
                      class="flex flex-col lg:flex-row items-center gap-12 max-w-6xl mx-auto">
                      <div class="relative flex-shrink-0">
                        <img src="{{asset('images/member-tes')}}timonial-2.jpg"
                          alt="Maria Santos"
                          class="member-image">
                      </div>
                      <div class="flex-1 max-w-2xl">
                        <div class="testimonial-card">
                          <span
                            class="quote-mark absolute -left-4 -top-2">"</span>
                          <p
                            class="text-lg text-gray-800 leading-relaxed mb-6 relative z-10">
                            Napakaganda ng serbisyo ng GBLDC. Nakatulong talaga
                            sa pagpapalaki ng aming negosyo. Ang mga staff ay
                            napakabait at handang tumulong. Salamat sa
                            cooperative na ito!
                          </p>
                          <span
                            class="quote-mark absolute -right-4 -bottom-8">"</span>

                          <div class="mt-8 relative z-10">
                            <h4
                              class="font-semibold text-gray-900 text-xl mb-1">Maria
                              C. Santos</h4>
                            <p class="text-gray-600 mb-3">Business Owner,
                              Baliuag Branch</p>
                            <div class="star-rating">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Testimonial 3 -->
                  <div class="swiper-slide">
                    <div
                      class="flex flex-col lg:flex-row items-center gap-12 max-w-6xl mx-auto">
                      <div class="relative flex-shrink-0">
                        <img src="{{asset('images/member-tes')}}timonial-3.jpg"
                          alt="Roberto Cruz"
                          class="member-image">
                      </div>
                      <div class="flex-1 max-w-2xl">
                        <div class="testimonial-card">
                          <span
                            class="quote-mark absolute -left-4 -top-2">"</span>
                          <p
                            class="text-lg text-gray-800 leading-relaxed mb-6 relative z-10">
                            Matagal na akong miyembro ng GBLDC at nakita ko kung
                            paano lumago ang kooperatiba. Ang kanilang savings
                            programs ay nakatulong sa amin na ma-secure ang
                            future ng pamilya namin.
                          </p>
                          <span
                            class="quote-mark absolute -right-4 -bottom-8">"</span>

                          <div class="mt-8 relative z-10">
                            <h4
                              class="font-semibold text-gray-900 text-xl mb-1">Roberto
                              M. Cruz</h4>
                            <p class="text-gray-600 mb-3">Senior Member, Main
                              Branch</p>
                            <div class="star-rating">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

                <!-- Pagination -->
                <div class="swiper-pagination"></div>
              </div>

              <!-- Trust Indicators -->
              <div class="flex justify-center items-center mt-12 gap-8">
                <div class="text-center">
                  <div
                    class="flex gap-1 text-orange-400 text-lg justify-center mb-2">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </div>
                  <p class="text-sm text-gray-600">Trusted by 1000+ members</p>
                </div>
              </div>
            </div>
          </section>

          <!-- Floating Chatbot Button & Widget -->
          <button onclick="toggleChatbot()"
            class="fixed bottom-8 right-8 bg-green-600 hover:bg-green-700 text-white w-16 h-16 rounded-full shadow-lg flex items-center justify-center z-50 transition-all duration-300 focus:outline-none ring-4 ring-green-300/20 animate-bounce"
            aria-label="Open Chatbot">
            <i class="fas fa-comments text-2xl"></i>
          </button>
          <div id="chatbot-widget"
            class="fixed bottom-24 right-8 w-96 max-w-full bg-white rounded-2xl shadow-2xl border border-green-100 flex-col overflow-hidden z-50 hidden transition-all duration-300 animate-fade-in-up animate_faster">
            <div
              class="bg-green-600 px-4 py-3 flex items-center gap-3 text-white shadow">
              <img src="{{asset('images/logocoop-r')}}emovebg-preview 2.png" alt="GBLDC"
                class="w-8 h-8 rounded-full border-2 border-white shadow" />
              <span class="font-medium text-left text-base flex-1">Chat with
                GBLDC</span>
              <button onclick="toggleChatbot()"
                class="text-white focus:outline-none hover:text-gray-300 transition-colors"
                title="Close"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div id="chat-messages"
              class="flex-1 p-4 overflow-y-auto text-sm space-y-3 text-black custom-scrollbar scroll-behavior-smooth"
              style="height: 320px; background: transparent;">
              <div class="flex items-start gap-2">
                <img src="{{asset('images/logocoop-r')}}emovebg-preview 2.png"
                  alt="GBLDC"
                  class="w-6 h-6 rounded-full border border-green-200" />
                <div
                  class="bg-green-100 text-black px-4 py-2 rounded-2xl rounded-bl-none shadow max-w-[100%]">Welcome
                  to GBLDC Chatbot! How can I assist you today?</div>
              </div>
            </div>
            <div id="typing-indicator"
              class="px-6 pb-2 text-xs text-gray-500 hidden">
              <span
                class="border bg-green-600 text-white py-2 px-2 rounded-lg">GBLDC
                is
                typing...</span>
            </div>
            <form id="chat-form"
              class="flex p-2 border-t bg-white/80 backdrop-blur rounded-b-2xl shadow-inner text-black gap-2">
              <input id="chat-input" type="text"
                placeholder="Type your message..."
                class="flex-1 px-4 py-2 border border-green-200 rounded-full focus:outline-none focus:ring-2 focus:ring-green-600 text-black transition-shadow shadow-sm" />
              <button type="submit"
                class="bg-green-600 text-white px-5 py-2 rounded-full hover:bg-green-700 transition-colors shadow"><i
                  class="fas fa-paper-plane"></i></button>
            </form>
          </div>
        </section>

        <!-- Footer  -->
        <footer class="bg-green-900 text-white pt-12 pb-4 mt-16">
          <div class="max-w-7xl mx-auto px-4">
            <div
              class="grid grid-cols-1 md:grid-cols-4 gap-10 md:gap-8 text-sm">
              <div class="flex flex-col items-center md:items-start">
                <h4
                  class="font-semibold mb-3 uppercase tracking-wide text-lg">Products</h4>
                <ul class="space-y-2">
                  <li><a href="loan-products.html"
                      class="hover:underline transition-colors">Loan
                      Products</a></li>
                  <li><a href="deposit.html"
                      class="hover:underline transition-colors">Deposit
                      Products</a></li>
                  <li><a href="#"
                      class="hover:underline transition-colors">Savings
                      Products</a></li>
                </ul>
              </div>
              <div class="flex flex-col items-center md:items-start">
                <h4
                  class="font-semibold mb-3 uppercase tracking-wide text-lg">About</h4>
                <ul class="space-y-2">
                  <li><a href="about-gbldc.html"
                      class="hover:underline transition-colors">About
                      GBLDC</a></li>
                  <li><a href="#"
                      class="hover:underline transition-colors duration-200">Senior
                      Management</a></li>
                  <li><a href="#"
                      class="hover:underline transition-colors duration-200">Officers
                      & Committees</a></li>
                  <li><a href="#"
                      class="hover:underline transition-colors duration-200">About Membership</a></li>
                </ul>
              </div>
              <div class="flex flex-col items-center md:items-start">
                <h4
                  class="font-semibold mb-3 uppercase tracking-wide text-lg">Quicklinks</h4>
                <ul class="space-y-2">
                  <li><a href="https://ifernglobal.com.ph/"
                      class="hover:underline transition-colors">iFern
                      Global</a></li>
                  <li><a href="index.html"
                      class="hover:underline transition-colors">Member Portal
                      Login</a></li>
                  <li><a href="#"
                      class="hover:underline transition-colors">Contact
                      Us</a></li>
                  <li><a href="applynow.html"
                      class="hover:underline transition-colors">Apply
                      Now</a></li>
                  <li><a href="#"
                      class="hover:underline transition-colors">Feedback</a></li>
                </ul>
              </div>
              <div class="flex flex-col items-center md:items-start">
                <h4
                  class="font-semibold mb-3 uppercase tracking-wide text-lg">Get
                  Our App</h4>
                <div class="flex gap-2 mb-2">
                  <a href="https://play.google.com/store" target="_blank"><img
                      src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                      alt="Google Play" class="h-10 rounded shadow" /></a>
                  <a href="https://www.apple.com/app-store/"
                    target="_blank"><img
                      src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                      alt="App Store" class="h-10 rounded shadow" /></a>
                </div>
                <p class="text-xs text-white">Download our app for a better
                  banking
                  experience.</p>
              </div>
            </div>
            <div
              class="border-t border-green-800 mt-10 pt-6 flex flex-col md:flex-row md:justify-between md:items-center text-xs text-white gap-2">
              <div class="text-center md:text-left">GREATER BULACAN LIVELIHOOD
                DEVELOPMENT COOPERATIVE © 2025. ALL RIGHTS RESERVED.</div>
              <div class="flex space-x-6 mt-4 md:mt-0 md:text-center">
                <a href="#"
                  class="text-white text-sm transition-colors hover:underline">Privacy
                  Policy</a>
                <a href="#" class="text-white  text-sm transition-colors hover:underline">Terms
                  of
                  Service</a>
                <a href="#" class="text-white  text-sm transition-colors hover:underline">Cookie
                  Policy</a>
              </div>
            </div>

          </div>
        </footer>
        <!-- JS SCRIPT -->
        <script src="../src/javascript/landingpage.js"></script>
        <script src="../src/javascript/landingpage-user.js"></script>
      </body>
    </html>