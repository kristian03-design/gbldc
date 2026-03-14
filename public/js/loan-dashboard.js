document.addEventListener("DOMContentLoaded", function () {
  // Mobile menu elements
  const mobileMenuBtn = document.getElementById("mobileMenuBtn");
  const closeSidebarBtn = document.getElementById("closeSidebarBtn");
  const sidebar = document.getElementById("sidebar");
  const mobileOverlay = document.getElementById("mobileOverlay");

  // Modal elements
  const makePaymentBtn = document.getElementById("makePaymentBtn");
  const paymentModal = document.getElementById("paymentModal");
  const cancelButton = document.getElementById("cancelPayment");
  const paymentForm = document.getElementById("paymentForm");
  const paymentAmountInput = document.getElementById("paymentAmount");
  const paymentMethodInput = document.getElementById("paymentMethod");

  // Credit score elements
  const circle = document.getElementById("credit-score-circle");
  const scoreText = document.getElementById("credit-score-text");
  const loanScore = document.getElementById("loan-credit-score");
  const paymentHistoryBody = document.getElementById("paymentHistoryBody");

  // Mobile menu functionality
  function openSidebar() {
    sidebar.classList.remove("-translate-x-full");
    mobileOverlay.classList.remove("hidden");
    document.body.classList.add("overflow-hidden");
  }

  function closeSidebar() {
    sidebar.classList.add("-translate-x-full");
    mobileOverlay.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
  }

  mobileMenuBtn?.addEventListener("click", openSidebar);
  closeSidebarBtn?.addEventListener("click", closeSidebar);
  mobileOverlay?.addEventListener("click", closeSidebar);

  // Close sidebar when clicking on navigation links (mobile)
  const navLinks = sidebar?.querySelectorAll("nav a");
  navLinks?.forEach((link) => {
    link.addEventListener("click", () => {
      if (window.innerWidth < 1024) {
        closeSidebar();
      }
    });
  });

  // Close sidebar on window resize to desktop
  window.addEventListener("resize", () => {
    if (window.innerWidth >= 1024) {
      closeSidebar();
    }
  });

  // Credit score calculation
  function getCreditScore(amount) {
    amount = Number(amount);
    if (amount >= 50000) return 100;
    if (amount >= 20000) return 90;
    if (amount >= 10000) return 70;
    if (amount >= 5000) return 55;
    return 60;
  }

  // Update credit score UI
  function updateCreditScoreUI(score) {
    if (circle && scoreText) {
      const radius = 40;
      const circumference = 2 * Math.PI * radius;
      circle.setAttribute("stroke", score < 50 ? "#f87171" : "#22c55e");
      const offset = circumference * (1 - score / 100);
      circle.setAttribute("stroke-dasharray", circumference);
      circle.setAttribute("stroke-dashoffset", offset);
      scoreText.textContent = `${score}%`;
    }
    if (loanScore) loanScore.textContent = `${score}%`;
  }

  // Modal helpers
  function showModal() {
    paymentModal.classList.remove("hidden");
    paymentModal.style.background = "rgba(0,0,0,0.5)";
    document.body.classList.add("overflow-hidden");
  }

  function hideModal() {
    paymentModal.classList.add("hidden");
    paymentModal.style.background = "";
    document.body.classList.remove("overflow-hidden");
  }

  // Payment method text
  function getPaymentMethodText(method) {
    return method === "card" ? "Credit/Debit Card" : "Gcash";
  }

  // Add new payment to history table
  function addPaymentToHistory(date, amount, method) {
    const tr = document.createElement("tr");
    tr.className = "border-t hover:bg-gray-50";
    tr.innerHTML = `
            <td class="p-3 text-sm">${date}</td>
            <td class="p-3 text-sm font-medium">PHP ${Number(
              amount
            ).toLocaleString()}</td>
            <td class="p-3 text-sm">${getPaymentMethodText(method)}</td>
            <td class="p-3 text-sm">
              <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Paid</span>
            </td>
          `;
    if (paymentHistoryBody.firstChild) {
      paymentHistoryBody.insertBefore(tr, paymentHistoryBody.firstChild);
    } else {
      paymentHistoryBody.appendChild(tr);
    }
  }

  // Initial credit score
  let creditScore = getCreditScore(paymentAmountInput?.value || 0);
  updateCreditScoreUI(creditScore);


  // Event: Real-time payment amount and credit score update
  paymentAmountInput?.addEventListener("input", function () {
    // Update real-time amount display
    const realtimeDisplay = document.getElementById("realtimeAmountDisplay");
    if (realtimeDisplay) {
      realtimeDisplay.textContent = `PHP ${Number(
        paymentAmountInput.value
      ).toLocaleString()}`;
    }
    // Update credit score
    const newScore = getCreditScore(paymentAmountInput.value);
    updateCreditScoreUI(newScore);
  });
});
// Loan History Modal logic
document.addEventListener("DOMContentLoaded", function () {
  const viewFullHistoryBtn = document.getElementById("viewFullHistoryBtn");
  const loanHistoryModal = document.getElementById("loanHistoryModal");
  const closeLoanHistoryModal = document.getElementById(
    "closeLoanHistoryModal"
  );

  viewFullHistoryBtn?.addEventListener("click", function (e) {
    e.preventDefault();
    loanHistoryModal.classList.remove("hidden");
    document.body.classList.add("overflow-hidden");
  });

  closeLoanHistoryModal?.addEventListener("click", function () {
    loanHistoryModal.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
  });

  // Optional: Close modal when clicking outside the modal content
  loanHistoryModal?.addEventListener("click", function (e) {
    if (e.target === loanHistoryModal) {
      loanHistoryModal.classList.add("hidden");
      document.body.classList.remove("overflow-hidden");
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
    const logoutBtn = document.getElementById("logoutBtn");
    if (logoutBtn) {
        logoutBtn.addEventListener("click", function (e) {
            e.preventDefault();
            Swal.fire({
                title: "Are you sure you want to logout?",
                icon: "warning",
                iconColor: "#ef4444",
                color: "#1e2939",
                showCancelButton: true,
                reverseButtons: true, // Confirm button on right
                confirmButtonColor: "#22c55e",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancel",
                confirmButtonText: "Yes, logout",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to login page or perform logout logic here
                    window.location.href = "index.html";
                }
            });
        });
    }
});

