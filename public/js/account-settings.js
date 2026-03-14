document.addEventListener("DOMContentLoaded", function () {
  // Payment Methods Management
  const paymentTableBody = document.getElementById("paymentTableBody");
  const paymentForm = document.getElementById("paymentForm");
  const paymentType = document.getElementById("paymentType");
  const accountName = document.getElementById("accountName");
  const accountNumber = document.getElementById("accountNumber");
  let paymentMethods = [];

  function renderPayments() {
    paymentTableBody.innerHTML = "";
    paymentMethods.forEach((method, idx) => {
      const row = document.createElement("tr");
      row.innerHTML = `
                            <td class="py-2 px-4 border-b text-sm hover:bg-gray-50">${method.type}</td>
                            <td class="py-2 px-4 border-b text-sm hover:bg-gray-50">${method.name}</td>
                            <td class="py-2 px-4 border-b text-sm hover:bg-gray-50">${method.number}</td>
                            <td class="py-2 px-4 border-b text-sm hover:bg-gray-50">
                                <button class="text-red-600 hover:underline text-xs" data-remove="${idx}">Remove</button>
                            </td>
                        `;
      paymentTableBody.appendChild(row);
    });
  }

  paymentTableBody.addEventListener("click", function (e) {
    if (e.target && e.target.matches("button[data-remove]")) {
      const idx = parseInt(e.target.getAttribute("data-remove"));
      paymentMethods.splice(idx, 1);
      renderPayments();
    }
  });

  paymentForm?.addEventListener("submit", function (e) {
    e.preventDefault();
    paymentMethods.push({
      type: paymentType.value,
      name: accountName.value,
      number: accountNumber.value,
    });
    renderPayments();
    paymentForm.reset();
    Swal.fire({
      icon: "success",
      iconColor: '#16a34a',
      color: '#1e2939',
      title: "Payment method added!",
      showConfirmButton: false,
      timer: 1500,
    });
  });

  renderPayments();

  // Profile Info Update
  document
    .getElementById("profileForm")
    ?.addEventListener("submit", function (e) {
      e.preventDefault();
      const name = document.getElementById("fullNameInput").value;
      const email = document.getElementById("emailInput").value;
      const asideName = document.querySelector("aside .font-semibold");
      const asideEmail = document.querySelector(
        "aside .text-xs.lg\\:text-sm.text-gray-500"
      );
      if (asideName) asideName.textContent = name;
      if (asideEmail) asideEmail.textContent = email;
      // Update aside profile picture if changed
      const profilePic = document.getElementById("profilePicPreview").src;
      const asideImg = document.querySelector("aside img.rounded-full");
      if (asideImg) {
        asideImg.classList.add("rounded-full", "object-cover");
        asideImg.style.width = "100%";
        asideImg.style.height = "100%";
        asideImg.style.aspectRatio = "1/1";
        asideImg.style.objectFit = "cover";
        asideImg.src = profilePic;
      }
      Swal.fire({
        icon: "success",
        iconColor: '#16a34a',
        color: '#1e2939',
        title: "Profile updated!",
        showConfirmButton: false,
        timer: 1500,
      });
    });

  // Profile Picture Preview & Aside Update
  document
    .getElementById("profilePicInput")
    ?.addEventListener("change", function (e) {
      const file = e.target.files[0];
      if (file && file.size <= 2 * 1024 * 1024) {
        const reader = new FileReader();
        reader.onload = function (ev) {
          document.getElementById("profilePicPreview").src = ev.target.result;
          document.getElementById("asideProfilePic").src = ev.target.result;
          Swal.fire({
            icon: "success",
            iconColor: '#16a34a',
            color: '#1e2939',
            title: "Profile picture changed!",
            showConfirmButton: false,
            timer: 1500,
          });
        };
        reader.readAsDataURL(file);
      } else if (file) {
        alert("File is too large. Max size is 2MB.");
        e.target.value = "";
      }
    });

  // Enlarge Aside Profile Picture
  document
    .getElementById("asideProfilePic")
    ?.addEventListener("click", function () {
      Swal.fire({
        imageUrl: this.src,
        imageAlt: "Profile Picture",
        showConfirmButton: false,
        showCloseButton: true,
        width: 460,
        padding: "1em",
        background: "#fff",
      });
    });

  // Delete Account Confirmation
  document
    .getElementById("deleteAccountBtn")
    ?.addEventListener("click", function () {
      Swal.fire({
        title: "Are you sure?",
        text: "This will permanently delete your account and all associated data. This action cannot be undone.",
        icon: "warning",
        iconColor: "#ef4444",
        color: "#1e2939",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#006425",
        confirmButtonText: "Yes, delete it!",
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire("Deleted!", "Your account has been deleted.", "success");
          // Add account deletion logic here
        }
      });
    });

  // Mobile Sidebar Menu
  const mobileMenuBtn = document.getElementById("mobileMenuBtn");
  const closeSidebarBtn = document.getElementById("closeSidebarBtn");
  const sidebar = document.getElementById("sidebar");
  const mobileOverlay = document.getElementById("mobileOverlay");

  function openSidebar() {
    sidebar.classList.remove("-translate-x-full");
    mobileOverlay.classList.remove("hidden");
    mobileOverlay.classList.add("bg-black");
    mobileOverlay.style.backgroundColor = "rgba(0,0,0,0.4)";
    document.body.classList.add("overflow-hidden");
  }

  function closeSidebar() {
    sidebar.classList.add("-translate-x-full");
    mobileOverlay.classList.add("hidden");
    mobileOverlay.classList.remove("bg-black", "bg-opacity-40");
    document.body.classList.remove("overflow-hidden");
  }

  mobileMenuBtn?.addEventListener("click", openSidebar);
  closeSidebarBtn?.addEventListener("click", closeSidebar);
  mobileOverlay?.addEventListener("click", closeSidebar);

  // Close sidebar when clicking nav links (mobile)
  const navLinks = sidebar?.querySelectorAll("nav a");
  navLinks?.forEach((link) => {
    link.addEventListener("click", () => {
      if (window.innerWidth < 1024) {
        closeSidebar();
      }
    });
  });

  // Close sidebar on resize to desktop
  window.addEventListener("resize", () => {
    if (window.innerWidth >= 1024) {
      closeSidebar();
    }
  });
});
