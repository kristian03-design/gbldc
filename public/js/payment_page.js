// Payment frequency selection
const paymentOptions = document.querySelectorAll(".payment-option");
const amountDue = document.getElementById("amount-due");
const buttonText = document.getElementById("button-text");
let selectedAmount = 1000;

paymentOptions.forEach((option) => {
  option.addEventListener("click", () => {
    paymentOptions.forEach((opt) => opt.classList.remove("selected"));
    option.classList.add("selected");

    if (option.innerHTML.includes("Pay Full")) {
      selectedAmount = 12000;
      amountDue.textContent = "₱12,000.00";
      buttonText.textContent = "Pay ₱12,000.00 Now";
    } else {
      selectedAmount = 1000;
      amountDue.textContent = "₱1,000.00";
      buttonText.textContent = "Pay ₱1,000.00 Now";
    }
  });
});

// Payment method selection (radio-based, supports hiding card info and validation)
const methodRadios = document.querySelectorAll('input[name="paymethod"]');
const methodLabels = document.querySelectorAll("label.flex.items-center");
const cardDetails = document.getElementById("card-details");
let selectedMethod = "Card";

function updateMethodUI() {
  methodRadios.forEach((radio, idx) => {
    if (radio.checked) {
      selectedMethod = radio.nextElementSibling?.textContent.trim() || "Card";
      if (methodLabels[idx]) methodLabels[idx].classList.add("selected");
    } else {
      if (methodLabels[idx]) methodLabels[idx].classList.remove("selected");
    }
  });
  if (selectedMethod.toLowerCase() === "card") {
    cardDetails.style.display = "block";
  } else {
    cardDetails.style.display = "none";
  }
}

methodRadios.forEach((radio) => {
  radio.addEventListener("change", updateMethodUI);
});
updateMethodUI();

// Card number formatting
const cardNumberInput = document.getElementById("card-number");
if (cardNumberInput) {
  cardNumberInput.addEventListener("input", (e) => {
    let value = e.target.value.replace(/\s+/g, "").replace(/[^0-9]/gi, "");
    let formattedValue = value.match(/.{1,4}/g)?.join(" ") || value;
    e.target.value = formattedValue;
  });
}

// Expiry date formatting
const expiryInput = document.getElementById("expiry");
if (expiryInput) {
  expiryInput.addEventListener("input", (e) => {
    let value = e.target.value.replace(/\D/g, "");
    if (value.length >= 2) {
      value = value.substring(0, 2) + "/" + value.substring(2, 4);
    }
    e.target.value = value;
  });
}

// CVC validation
const cvcInput = document.getElementById("cvc");
if (cvcInput) {
  cvcInput.addEventListener("input", (e) => {
    e.target.value = e.target.value.replace(/\D/g, "");
  });
}

// Form submission
const paymentForm = document.getElementById("payment-form");
const payButton = document.getElementById("pay-button");
const loadingSpinner = document.getElementById("loading-spinner");
const successMessage = document.getElementById("success-message");

paymentForm.addEventListener("submit", (e) => {
  e.preventDefault();
  // If not Card, skip card validation
  if (selectedMethod === "Card") {
    // Validate card fields
    if (!validateCardNumber(cardNumberInput.value)) {
      cardNumberInput.classList.add("border-red-500");
      document.getElementById("card-error").classList.remove("hidden");
      return;
    }
  }
  // Show loading state
  payButton.classList.add("loading");
  buttonText.classList.add("hidden");
  loadingSpinner.classList.remove("hidden");
  // Simulate payment processing
  setTimeout(() => {
    paymentForm.style.display = "none";
    successMessage.style.display = "flex";
    successMessage.classList.remove("hidden");
    successMessage.classList.add("fade-in");
    // Lottie animation (if not already loaded)
    if (window.dotlottieWCLoaded !== true) {
      const script = document.createElement('script');
      script.type = 'module';
      script.src = 'https://unpkg.com/@lottiefiles/dotlottie-wc@0.6.2/dist/dotlottie-wc.js';
      document.body.appendChild(script);
      window.dotlottieWCLoaded = true;
    }
  }, 2000);
});

// Back button functionality
function goBack() {
  if (
    confirm("Are you sure you want to go back? Your progress will be lost.")
  ) {
    window.history.back();
  }
}

// Input validation
function validateCardNumber(number) {
  const regex = new RegExp("^[0-9]{13,19}$");
  return regex.test(number.replace(/\s/g, ""));
}

// Real-time validation
cardNumberInput.addEventListener("blur", (e) => {
  const cardError = document.getElementById("card-error");
  if (!validateCardNumber(e.target.value)) {
    cardError.classList.remove("hidden");
    e.target.classList.add("border-red-500");
  } else {
    cardError.classList.add("hidden");
    e.target.classList.remove("border-red-500");
  }
});
