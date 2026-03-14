function showRegisterSection() {
  const reg = document.getElementById("registerSection");
  const login = document.querySelector(
    ".max-w-6xl.flex.rounded-2xl.shadow-xl.overflow-hidden:not(#registerSection):not(#otpSection):not(#forgotPasswordSection):not(#loginOtpSection):not(#forgotPasswordOtpSection)"
  );
  const otp = document.getElementById("otpSection");
  const loginOtp = document.getElementById("loginOtpSection");
  const forgot = document.getElementById("forgotPasswordSection");
  const forgotOtp = document.getElementById("forgotPasswordOtpSection");

  // Hide all other sections
  [login, otp, loginOtp, forgot, forgotOtp].forEach((section) => {
    if (section) {
      section.classList.add("hidden", "invisible", "pointer-events-none");
      section.style.display = "none";
    }
  });

  // Show registration section
  if (reg) {
    reg.classList.remove("hidden", "invisible", "pointer-events-none");
    reg.style.display = "flex";
    reg.style.opacity = 0;
    reg.style.transition = "opacity 0.5s";
    setTimeout(() => {
      reg.style.opacity = 1;
    }, 10);
    reg.scrollIntoView({ behavior: "smooth", block: "center" });
  }
}

// Scroll to login section when "Log in" is clicked
function scrollToLogin() {
  const login = document.querySelector(
    ".max-w-6xl.flex.rounded-2xl.shadow-xl.overflow-hidden:not(#registerSection):not(#otpSection):not(#forgotPasswordSection):not(#loginOtpSection):not(#forgotPasswordOtpSection)"
  );
  const reg = document.getElementById("registerSection");
  const otp = document.getElementById("otpSection");
  const loginOtp = document.getElementById("loginOtpSection");
  const forgot = document.getElementById("forgotPasswordSection");
  const forgotOtp = document.getElementById("forgotPasswordOtpSection");

  // Hide all other sections
  [reg, otp, loginOtp, forgot, forgotOtp].forEach((section) => {
    if (section) {
      section.classList.add("hidden", "invisible", "pointer-events-none");
      section.style.display = "none";
    }
  });

  // Show login section
  if (login) {
    login.classList.remove("hidden", "invisible", "pointer-events-none");
    login.style.display = "flex";
    login.style.opacity = 0;
    login.style.transition = "opacity 0.5s";
    setTimeout(() => {
      login.style.opacity = 1;
    }, 10);
    login.scrollIntoView({ behavior: "smooth", block: "center" });
  } else {
    window.scrollTo({ top: 0, behavior: "smooth" });
  }
}

// Show OTP section and hide registration
function showOtpSection() {
  // Show SweetAlert2 before showing OTP section with timer, no confirm button
  Swal.fire({
    icon: "success",
    iconColor: "#16a34a",
    customClass: {
      popup: "swal2-custom-popup",
    },
    title: "Check your email",
    titleText: "Email Verification",
    color: "#1e2939",
    text: "Your 6-digit code has been sent to your email address.",
    timer: 2000,
    showConfirmButton: false,
    willClose: () => {
      const otp = document.getElementById("otpSection");
      const reg = document.getElementById("registerSection");
      if (reg) {
        reg.classList.add("hidden", "invisible", "pointer-events-none");
        reg.style.display = "none";
      }
      if (otp) {
        otp.classList.remove("hidden", "invisible", "pointer-events-none");
        otp.style.display = "flex";
        otp.style.opacity = 0;
        otp.style.transition = "opacity 0.5s";
        setTimeout(() => {
          otp.style.opacity = 1;
        }, 10);
        otp.scrollIntoView({ behavior: "smooth", block: "center" });
      }
    },
  });
}

function showForgotPasswordSection() {
  const forgot = document.getElementById("forgotPasswordSection");
  const login = document.querySelector(
    ".max-w-6xl.flex.rounded-2xl.shadow-xl.overflow-hidden:not(#registerSection):not(#otpSection):not(#forgotPasswordSection):not(#loginOtpSection):not(#forgotPasswordOtpSection)"
  );

  // Hide login section
  if (login) {
    login.classList.add("hidden", "invisible", "pointer-events-none");
    login.style.display = "none";
  }

  // Show forgot password section
  if (forgot) {
    forgot.classList.remove("hidden", "invisible", "pointer-events-none");
    forgot.style.display = "flex";
    forgot.style.opacity = 0;
    forgot.style.transition = "opacity 0.5s";
    setTimeout(() => {
      forgot.style.opacity = 1;
    }, 10);
    forgot.scrollIntoView({ behavior: "smooth", block: "center" });
  }
}

function validateLoginFields() {
  const email = document.querySelector(
    'input[type="email"][placeholder="example@mail.com"]'
  );
  const password = document.querySelector(
    'input[type="password"][placeholder="••••••••"]'
  );
  const emailValue = email.value.trim();
  const passwordValue = password.value.trim();

  // Simple email format check
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailValue && !passwordValue) {
    Swal.fire({
      icon: "warning",
      iconColor: "#dc2626",
      color: "#1e2939",
      title: "Missing Fields",
      text: "Please fill both Email Address and Password fields.",
    });
  } else if (!emailValue && passwordValue) {
    Swal.fire({
      icon: "warning",
      iconColor: "#dc2626",
      color: "#1e2939",
      title: "Missing Email",
      text: "Please enter your email address.",
    });
  } else if (emailValue && !passwordValue) {
    Swal.fire({
      icon: "warning",
      iconColor: "#dc2626",
      color: "#1e2939",
      title: "Missing Password",
      text: "Please enter your password.",
    });
  } else if (!emailPattern.test(emailValue)) {
    Swal.fire({
      icon: "warning",
      iconColor: "#dc2626",
      color: "#1e2939",
      title: "Invalid Email",
      text: "Please enter a valid email address.",
    });
  } else {
    // Proceed with login (show OTP section for login verification)
    Swal.fire({
      icon: "success",
      iconColor: "#16a34a",
      customClass: { popup: "swal2-custom-popup" },
      title: "Check your email",
      titleText: "Login Verification",
      color: "#1e2939",
      text: "Your 6-digit code has been sent to your email address.",
      timer: 2000,
      showConfirmButton: false,
      willClose: () => {
        const otp = document.getElementById("loginOtpSection");
        const login = document.getElementById("loginSect").parentElement;
        if (login) {
          login.classList.add("hidden", "invisible", "pointer-events-none");
          login.style.display = "none";
        }
        if (otp) {
          otp.classList.remove("hidden", "invisible", "pointer-events-none");
          otp.style.display = "flex";
          otp.style.opacity = 0;
          otp.style.transition = "opacity 0.5s";
          setTimeout(() => {
            otp.style.opacity = 1;
          }, 10);
          otp.scrollIntoView({ behavior: "smooth", block: "center" });
        }
      },
    });
  }
}

// Ensure FB SDK is loaded before using FB functions
function fbLogin() {
  if (typeof FB === "undefined") {
    alert(
      "Facebook SDK not loaded. Please check your internet connection and try again."
    );
    return;
  }
  FB.login(
    function (response) {
      if (response.authResponse) {
        FB.api("/me", { fields: "name,email" }, function (profile) {
          if (!profile.email) {
            alert(
              "Unable to retrieve email from Facebook. Please ensure your Facebook account has a verified email."
            );
            return;
          }
          fetch("facebook_register.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `email=${encodeURIComponent(
              profile.email
            )}&name=${encodeURIComponent(profile.name)}`,
          })
            .then((res) => res.text())
            .then((data) => {
              window.location.href = "user-landingpage.php";
            })
            .catch((err) => {
              alert("Error during Facebook login: " + err);
            });
        });
      } else {
        alert("Facebook login was not successful.");
      }
    },
    { scope: "email" }
  );
}

window.fbAsyncInit = function () {
  FB.init({
    appId: "4093222834242920", // Replace with your App ID
    cookie: true,
    xfbml: true,
    version: "v23.0",
  });
};

window.onload = function () {
  const googleBtn = document.getElementById("googleLoginBtn");
  if (googleBtn) {
    googleBtn.addEventListener("click", function () {
      google.accounts.id.initialize({
        client_id:
          "528123102514-o8vap3bmgnogbgvtfuipgkgea739ov3c.apps.googleusercontent.com", // Replace with your Google Client ID
        callback: handleGoogleCredentialResponse,
      });
      google.accounts.id.prompt(); // Shows the Google One Tap prompt
    });
  }
};

function handleGoogleCredentialResponse(response) {
  // Send the credential to your backend for verification and login
  fetch("google_login.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "credential=" + encodeURIComponent(response.credential),
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        window.location.href = "user-landingpage.php";
      } else {
        alert("Google login failed.");
      }
    });
}

// OTP input auto-focus and form logic
document.addEventListener("DOMContentLoaded", function () {
  const otpInputs = document.querySelectorAll('#otpSection input[type="text"]');
  otpInputs.forEach((input, idx) => {
    input.addEventListener("input", function () {
      if (this.value.length === 1 && idx < otpInputs.length - 1) {
        otpInputs[idx + 1].focus();
      }
    });
    input.addEventListener("keydown", function (e) {
      if (e.key === "Backspace" && !this.value && idx > 0) {
        otpInputs[idx - 1].focus();
      }
    });
  });

  // OTP form submit handler using SweetAlert2
  const otpForm = document.querySelector("#otpSection form");
  if (otpForm) {
    otpForm.addEventListener("submit", function (e) {
      e.preventDefault();
      let otpCode = "";
      otpInputs.forEach((inp) => (otpCode += inp.value));
      if (otpCode.length === 6) {
        Swal.fire({
          icon: "success",
          iconColor: "#16a34a",
          customClass: {
            popup: "swal2-custom-popup",
          },
          title: "Account Created!",
          titleText: "Welcome to GBLDC",
          text: "Your account has been successfully created.",
          color: "#1e2939",
          timer: 2000,
          showConfirmButton: false,
          willClose: () => {
            scrollToLogin();
          },
        });
      } else {
        Swal.fire({
          icon: "warning",
          iconColor: "#dc2626",
          title: "Incomplete Code",
          titleText: "Invalid OTP",
          color: "#1e2939",
          text: "Please enter the 6-digit code.",
          confirmButtonColor: "#16a34a",
        });
      }
    });
  }

  // Optional: Resend OTP handler using SweetAlert2
  const resendLink = document.querySelector('#otpSection a[href="#"]');
  if (resendLink) {
    resendLink.addEventListener("click", function (e) {
      e.preventDefault();
      Swal.fire({
        icon: "info",
        iconColor: "#dc2626",
        title: "OTP Resent",
        titleText: "Resend OTP",
        color: "#1e2939",
        text: "A new OTP has been sent to your email.",
        confirmButtonColor: "#16a34a",
      });
    });
  }

  // Forgot Password link logic
  const forgotLink = document.getElementById("forgotPasswordLink");
  if (forgotLink) {
    forgotLink.addEventListener("click", function (e) {
      e.preventDefault();
      showForgotPasswordSection();
    });
  }

  // Handle forgot password form submit
  const forgotForm = document.getElementById("forgotPasswordForm");
  if (forgotForm) {
    forgotForm.addEventListener("submit", function (e) {
      e.preventDefault();
      Swal.fire({
        icon: "success",
        iconColor: "#16a34a",
        customClass: { popup: "swal2-custom-popup" },
        title: "Reset Link Sent",
        text: "A password reset link has been sent to your email address.",
        color: "#1e2939",
        timer: 2000,
        showConfirmButton: false,
        willClose: () => {
          scrollToLogin();
        },
      });
    });
  }

  // Realtime update of OTP email hint based on login email input
  const loginEmailInput = document.querySelector(
    '#loginSect input[type="email"]'
  );
  const otpEmailHint = document.getElementById("otpEmailHint");
  if (loginEmailInput && otpEmailHint) {
    loginEmailInput.addEventListener("input", function () {
      const email = loginEmailInput.value.trim();
      if (email) {
        otpEmailHint.textContent = `Code sent to: ${email}`;
      } else {
        otpEmailHint.textContent = "Example: juandelacruz@gmail.com";
      }
    });
  }

  // OTP input auto-focus and form logic for login OTP
  const loginOtpInputs = document.querySelectorAll(
    '#loginOtpSection input[type="text"]'
  );
  loginOtpInputs.forEach((input, idx) => {
    input.addEventListener("input", function () {
      if (this.value.length === 1 && idx < loginOtpInputs.length - 1) {
        loginOtpInputs[idx + 1].focus();
      }
    });
    input.addEventListener("keydown", function (e) {
      if (e.key === "Backspace" && !this.value && idx > 0) {
        loginOtpInputs[idx - 1].focus();
      }
    });
  });

  // OTP form submit handler using SweetAlert2
  const loginOtpForm = document.getElementById("loginOtpForm");
  if (loginOtpForm) {
    loginOtpForm.addEventListener("submit", function (e) {
      e.preventDefault();
      let otpCode = "";
      loginOtpInputs.forEach((inp) => (otpCode += inp.value));
      if (otpCode.length === 6) {
        Swal.fire({
          icon: "success",
          iconColor: "#16a34a",
          customClass: { popup: "swal2-custom-popup" },
          title: "Login Successful!",
          text: "Discover your financial future with GBLDC. Welcome User!",
          color: "#1e2939",
          timer: 2000,
          showConfirmButton: false,
          willClose: () => {
            window.location.href = "user-landingpage.php"; // Redirect to user landing page
          },
        });
      } else {
        Swal.fire({
          icon: "warning",
          iconColor: "#dc2626",
          title: "Incomplete Code",
          titleText: "Invalid OTP",
          color: "#1e2939",
          text: "Please enter the 6-digit code.",
          confirmButtonColor: "#16a34a",
        });
      }
    });
  }

  // Resend OTP handler for login OTP
  const loginResendLink = document.getElementById("loginOtpResend");
  if (loginResendLink) {
    loginResendLink.addEventListener("click", function (e) {
      e.preventDefault();
      let timerInterval;
      Swal.fire({
        icon: "info",
        iconColor: "#16a34a",
        title: "OTP Resent",
        titleText: "Resend OTP",
        color: "#1e2939",
        text: "A new OTP has been sent to your email.",
        confirmButtonColor: "#16a34a",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        willClose: () => {
          clearInterval(timerInterval);
        },
      });
    });
  }
});
