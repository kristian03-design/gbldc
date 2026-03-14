  document.addEventListener("DOMContentLoaded", function () {
        // Mobile menu elements
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeSidebarBtn = document.getElementById('closeSidebarBtn');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');
        // Mobile menu functionality
        function openSidebar() {
          sidebar.classList.remove('-translate-x-full');
          mobileOverlay.classList.remove('hidden');
            mobileOverlay.classList.add('bg-black');
            mobileOverlay.style.backgroundColor = 'rgba(0,0,0,0.4)';
          document.body.classList.add('overflow-hidden');
        }
        function closeSidebar() {
          sidebar.classList.add('-translate-x-full');
          mobileOverlay.classList.add('hidden');
          mobileOverlay.classList.remove('bg-black', 'bg-opacity-40'); // Remove background opacity
          document.body.classList.remove('overflow-hidden');
        }
        mobileMenuBtn?.addEventListener('click', openSidebar);
        closeSidebarBtn?.addEventListener('click', closeSidebar);
        mobileOverlay?.addEventListener('click', closeSidebar);
        // Close sidebar when clicking on navigation links (mobile)
        const navLinks = sidebar?.querySelectorAll('nav a');
        navLinks?.forEach(link => {
          link.addEventListener('click', () => {
        if (window.innerWidth < 1024) {
          closeSidebar();
        }
          });
        });
        // Close sidebar on window resize to desktop
        window.addEventListener('resize', () => {
          if (window.innerWidth >= 1024) {
        closeSidebar();
          }
        });
      });