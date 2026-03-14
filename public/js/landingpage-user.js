// Logout Modal Functions
function openLogoutModal(event) {
  event.preventDefault();
  const modal = document.getElementById("logout-modal");
  const modalContent = document.getElementById("logout-modal-content");
  const mobileMenu = document.getElementById("mobile-menu");

  // Close mobile menu if it's open
  if (mobileMenu && !mobileMenu.classList.contains("hidden")) {
    mobileMenu.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
  }

  modal.classList.remove("hidden");

  // Animate modal content in
  modalContent.style.opacity = "0";
  modalContent.style.transform = "scale(0.95)";
  setTimeout(() => {
    modalContent.style.transition = "opacity 0.3s, transform 0.3s";
    modalContent.style.opacity = "1";
    modalContent.style.transform = "scale(1)";
  }, 10);

  // Add a semi-transparent background overlay
  if (!document.getElementById("logout-modal-overlay")) {
    const overlay = document.createElement("div");
    overlay.id = "logout-modal-overlay";
    overlay.style.position = "fixed";
    overlay.style.top = 0;
    overlay.style.left = 0;
    overlay.style.width = "100vw";
    overlay.style.height = "100vh";
    overlay.style.background = "rgba(0,0,0,0.4)";
    overlay.style.zIndex = 59;
    overlay.onclick = closeLogoutModal;
    document.body.appendChild(overlay);
  }

  // Prevent body scrolling
  document.body.classList.add("overflow-hidden");
}

function closeLogoutModal() {
  const modal = document.getElementById("logout-modal");
  const modalContent = document.getElementById("logout-modal-content");

  if (!modal || modal.classList.contains("hidden")) {
    return; // Modal is already closed
  }

  // Animate modal content out
  modalContent.style.transition = "opacity 0.2s, transform 0.2s";
  modalContent.style.opacity = "0";
  modalContent.style.transform = "scale(0.95)";

  setTimeout(() => {
    modal.classList.add("hidden");
    // Remove the overlay if it exists
    const overlay = document.getElementById("logout-modal-overlay");
    if (overlay) overlay.remove();
    // Allow body scrolling again
    document.body.classList.remove("overflow-hidden");
  }, 200);
}

function confirmLogout() {
  // Close the modal first
  closeLogoutModal();

  // Add a small delay for better UX, then redirect
  setTimeout(() => {
    // You can also make an AJAX call here to properly logout from the server
    // For now, we'll just redirect
    window.location.href = "index.html";
  }, 300);
}

// Profile Dropdown Function
function toggleProfileDropdown(event) {
  event.preventDefault();
  const dropdown = document.getElementById("profile-dropdown");
  dropdown.classList.toggle("hidden");

  // Close dropdown when clicking outside
  document.addEventListener("click", function handler(e) {
    if (!dropdown.contains(e.target) && !event.target.contains(e.target)) {
      dropdown.classList.add("hidden");
      document.removeEventListener("click", handler);
    }
  });
}

// Desktop Dropdown Functions (for existing dropdowns)
function toggleDropdown(event) {
  event.preventDefault();
  const dropdown = document.getElementById("dropdown-menu");
  dropdown.classList.toggle("hidden");

  // Close dropdown when clicking outside
  document.addEventListener("click", function handler(e) {
    if (!dropdown.contains(e.target) && !event.target.contains(e.target)) {
      dropdown.classList.add("hidden");
      document.removeEventListener("click", handler);
    }
  });
}

function toggleDropdownProducts(event) {
  event.preventDefault();
  const dropdown = document.getElementById("dropdown-menu-products");
  dropdown.classList.toggle("hidden");

  // Close dropdown when clicking outside
  document.addEventListener("click", function handler(e) {
    if (!dropdown.contains(e.target) && !event.target.contains(e.target)) {
      dropdown.classList.add("hidden");
      document.removeEventListener("click", handler);
    }
  });
}


// Intersection Observer for animations
const observerOptions = {
  threshold: 0.1,
  rootMargin: "0px 0px -50px 0px",
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("slide-up");
    }
  });
}, observerOptions);

// Observe all sections for animation
document.querySelectorAll("section").forEach((section) => {
  observer.observe(section);
});
