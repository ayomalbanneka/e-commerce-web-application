// add hoverd class to select list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle

let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
}

document.getElementById('productImg').addEventListener('change', function () {
  const imgPreview = document.getElementById('imgPreview');
  imgPreview.innerHTML = '';
  const files = this.files;
  if (files.length > 0) {
    Array.from(files).forEach(file => {
      const reader = new FileReader();
      reader.onload = function (e) {
        const img = document.createElement('img');
        img.src = e.target.result;
        imgPreview.appendChild(img);
      };
      reader.readAsDataURL(file);
    });
  }
});

function searchInvoice() {
  var orderNumber = document.getElementById("order_number");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "Invalid Invoice Id" || response == "Please add a invoice number first") {
        alert(response);
        window.location.reload();
      }
      document.getElementById("view_area").innerHTML = response;
    }
  }

  request.open("GET", "backend/search-invoice-process.php?on=" + orderNumber.value, true);
  request.send();
}

function orderStatus(status, id) {

  // var invoice = document.getElementById("invoice").innerText;

  var request = new XMLHttpRequest();

  request.onreadystatechange = () => {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        location.reload();
      }
    }
  }

  request.open("GET", "backend/order-status-change-process.php?status=" + status + "&invoice=" + id, true);
  request.send();

}

var modal;

function userDetails(email) {

  // alert(email)

  var userModal = document.getElementById("spanModal1" + email);
  modal = new bootstrap.Modal(userModal);
  modal.show();
}


function setAdminDetails(email) {
  var adminModal = document.getElementById("adminUpdateModal" + email);
  modal = new bootstrap.Modal(adminModal);
  modal.show();
}

var modal2;

function adminSignIn() {

  var email = document.getElementById("email");
  var password = document.getElementById("password");
  var rememberMe = document.getElementById("adminRememberMe");

  let emailError = document.getElementById('email_err');
  let pwdError = document.getElementById('pwd_err');

  let valid = true;

  [emailError, pwdError].forEach(el => {
    el.classList.add("d-none");
  })

  if (email.value.trim() === '') {
    emailError.classList.remove('d-none');
    valid = false;
  }

  if (password.value.trim() === '') {
    pwdError.classList.remove('d-none');
    valid = false;
  }

  if (!valid) {
    return;
  }

  var form = new FormData();

  var adminVerificationModel = document.getElementById("adminVerificationModal");

  form.append("email", email.value);
  form.append("password", password.value);
  form.append("adminRememberMe", rememberMe.checked);

  var request = new XMLHttpRequest();

  addEventListener('click', (e) => {

    setTimeout(() => {
      document.getElementById("adminSignInSpinner").classList.remove("d-none");
      //Disable the button while processing
      document.getElementById("sweetBtn").disabled = true;

    }, e ? 1000 : 0);

  })

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;

      if (response == "success") {

        setTimeout(() => {

          document.getElementById("adminSignInSpinner").classList.add("d-none");
          document.getElementById("sweertBtn").disabled = false;
        }, response == "success" ? 3000 : 0)

        modal2 = new bootstrap.Modal(adminVerificationModel);
        modal2.show();
      } else {

        document.getElementById("adminSignInSpinner").classList.remove("d-none");
        //Disable the button while processing
        document.getElementById("sweetBtn").disabled = true;

        setTimeout(() => {
          Swal.fire({
            icon: "error",
            title: "User Not Found",
            text: response
          });
          setTimeout(() => {
            document.getElementById("adminSignInSpinner").classList.add("d-none");
            document.getElementById("sweetBtn").disabled = false;
          })
        }, response ? 3000 : 0);
      }
    }
  }

  request.open("POST", "backend/admin-sign-in-process.php", true);
  request.send(form);

}

//This will stop multiple alert repeting when click the button
document.getElementById("sweetBtn").removeEventListener('click', adminSignIn);
document.getElementById("sweetBtn").addEventListener('click', function (event) {
  event.preventDefault();
  adminSignIn();
});

function verifyAdminCode() {
  const otp = document.getElementById('otp').value;
  const email = document.getElementById('email').value;

  if (otp.length !== 6 || isNaN(otp)) {
    alert("Please enter a valid 6-digit code.");
    return;
  }

  const form = new FormData();
  form.append('otp', otp);
  form.append('email', email);

  const request = new XMLHttpRequest();
  request.onreadystatechange = () => {

    if (request.readyState === 4 && request.status === 200) {
      const response = request.responseText;
      if (response === "success") {
        Swal.fire({
          title: "Login Successful",
          icon: "success",
          text: "You are now logged in as an admin."
        }).then(() => {
          window.location.href = "admin-panel.php";
        });
      } else {
        Swal.fire({
          title: "Login Failed",
          icon: "error",
          text: "Login failed. Please check your code and try again."
        });
      }

    }

  }

  request.open("POST", "backend/verify-admin-code.php", true);
  request.send(form)

}
function blockAdmin(email) {
  const request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      const response = request.responseText;
      alert(response);
      window.location.reload();
    }
  }

  request.open("GET", "backend/block-admin-process.php?email=" + email, true);
  request.send();
}

function adminRegistration() {
  const fname = document.getElementById('firstName').value;
  const lname = document.getElementById('lastName').value;
  const email = document.getElementById('email').value;
  const role = document.getElementById('role').value;
  const mobile = document.getElementById('mobile').value;
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirmPassword').value;

  let valid = true;

  let fnameError = document.getElementById('fname_err');
  let lnameError = document.getElementById('lname_err');;
  let emailError = document.getElementById('email_err');
  let pwdError = document.getElementById('pwd_err');
  let cpwdError = document.getElementById('cpwd_err');
  let roleError = document.getElementById('role_err');
  let mobileError = document.getElementById('mobile_err');

  [emailError, pwdError, fnameError, lnameError, cpwdError, roleError, mobileError].forEach(el => {
    el.classList.add("d-none");
  });

  // Validate first name
  if (fname.trim() === '') {
    document.getElementById('fname_err').classList.remove('d-none');
    valid = false;
  }

  // Validate last name
  if (lname.trim() === '') {
    document.getElementById('lname_err').classList.remove('d-none');
    valid = false;
  }

  // Validate email
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    document.getElementById('email_err').classList.remove('d-none');
    valid = false;
  }

  // Validate role
  if (role === '0') {
    document.getElementById('role_err').classList.remove('d-none');
    valid = false;
  }

  // Validate mobile number
  const mobilePattern = /07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/; // Example pattern for 10-digit numbers
  if (!mobilePattern.test(mobile)) {
    document.getElementById('mobile_err').classList.remove('d-none');
    valid = false;
  }

  // Validate password
  if (password.length < 8) {
    document.getElementById('pwd_err').classList.remove('d-none');
    valid = false;
  }

  // Validate confirm password
  if (password !== confirmPassword) {
    document.getElementById('cpwd_err').classList.remove('d-none');
    valid = false;
  }

  if (!valid) {
    return;
  }

  const form = new FormData();
  form.append('firstName', fname);
  form.append('lastName', lname);
  form.append('email', email);
  form.append('role', role);
  form.append('mobile', mobile);
  form.append('password', password);

  const request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      const response = request.responseText;
      if (response === 'success') {
        Swal.fire({
          title: "Registration Successful",
          icon: "success",
          text: "Admin account has been created successfully."
        }).then(() => {
          window.location.reload();
        });
      } else {
        alert(response);
      }
    }
  }

  request.open("POST", "backend/admin-registration-process.php", true);
  request.send(form);

}

function adminDetailsUpdater() {
  const fname = document.getElementById('UfirstName').value;
  const lname = document.getElementById('UlastName').value;
  const email = document.getElementById('Uemail').value;
  const mobile = document.getElementById('Umobile').value;

  let valid = true;

  let fnameError = document.getElementById('fname_err');
  let lnameError = document.getElementById('lname_err');;
  let emailError = document.getElementById('email_err');
  let mobileError = document.getElementById('mobile_err');

  [emailError, fnameError, lnameError, mobileError].forEach(el => {
    el.classList.add("d-none");
  });

  // Validate first name
  if (fname.trim() === '') {
    document.getElementById('Ufname_err').classList.remove('d-none');
    valid = false;
  }

  // Validate last name
  if (lname.trim() === '') {
    document.getElementById('Ulname_err').classList.remove('d-none');
    valid = false;
  }

  // Validate email
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    document.getElementById('Uemail_err').classList.remove('d-none');
    valid = false;
  }

  // Validate mobile number
  const mobilePattern = /07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/;
  if (!mobilePattern.test(mobile)) {
    document.getElementById('Umobile_err').classList.remove('d-none');
    valid = false;
  }

  if (!valid) {
    return;
  }

  const form = new FormData();
  form.append('fname', fname);
  form.append('lname', lname);
  form.append('email', email);
  form.append('mobile', mobile);

  const request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      const response = request.responseText;
      if (response === 'success') {
        Swal.fire({
          title: "Update Successful",
          icon: "success",
          text: "Admin details have been updated successfully."
        }).then(() => {
          window.location.reload();
        });
      } else {
        alert(response);
      }
    }
  }

  request.open("POST", "backend/admin-details-update-process.php", true);
  request.send(form);

}

function showPassword1() {
  var textField = document.getElementById("np");
  var button = document.getElementById("npb");

  if (textField.type == "password") {
    textField.type = "text";
    button.innerHTML = `<i class="bi bi-eye-slash-fill"></i>`;
  } else {
    textField.type = "password";
    button.innerHTML = `<i class="bi bi-eye-fill"></i>`;
  }

}

function showPassword2() {
  var textField = document.getElementById("rp");
  var button = document.getElementById("rpb");

  if (textField.type == "password") {
    textField.type = "text";
    button.innerHTML = `<i class="bi bi-eye-slash-fill"></i>`;
  } else {
    textField.type = "password";
    button.innerHTML = `<i class="bi bi-eye-fill"></i>`;
  }

}

function adminEmailSend() {
  var email = document.getElementById("email2");
  var emaildiv = document.getElementById("emaildiv");
  var vcodeDiv = document.getElementById("vcodeDiv");

  const emailError = document.getElementById("email_err");

  [emailError].forEach(el => {
    el.classList.add('d-none');
  })

  let isValid = true;

  if (email.value.trim() === "") {
    emailError.classList.remove('d-none');
    isValid = false;
  }

  if (!isValid) {
    return;
  }

  var request = new XMLHttpRequest();

  addEventListener('click', (e) => {

    setTimeout(() => {
      document.getElementById("adminForgotPasswordSpinner").classList.remove("d-none");
      //Disable the button while processing
      document.getElementById("sendBtn").disabled = true;

    }, e ? 1000 : 0);

  })

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {

        setTimeout(() => {
          document.getElementById("adminForgotPasswordSpinner").classList.add("d-none");
          //Disable the button while processing
          document.getElementById("sendBtn").disabled = false;

        }, response == "success" ? 3000 : 0);

        setTimeout(() => {
          Swal.fire({
            title: "Verification code send successfully",
            icon: "success",
            text: "Verification send to your email address"
          }).then(() => {
            emaildiv.classList.toggle("d-none");
            vcodeDiv.classList.toggle("d-none");
          });
        }, response == "success" ? 3000 : 0)


      } else {
        Swal.fire({
          icon: "error",
          title: "User Not Found",
          text: response
        });
      }
    }
  };

  request.open("GET", "backend/admin-forgot-password-process.php?email=" + email.value, true);
  request.send();
}

function adminVerifyCode() {
  const email = document.getElementById("email2");
  var newPasswordDiv = document.getElementById("newPasswordDiv");

  const codeError = document.getElementById('code_err');

  [codeError].forEach(el => {
    el.classList.add('d-none');
  })

  let isValid = true;

  if (vcode.value.trim() === "") {
    codeError.classList.remove('d-none');
    isValid = false;
  }

  if (!isValid) {
    return;
  }

  var form = new FormData();

  form.append("vcode", vcode.value);
  form.append("email", email.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        Swal.fire({
          title: "Verification code verified successfully",
          icon: "success"
        }).then(() => {
          vcodeDiv.classList.toggle("d-none");
          newPasswordDiv.classList.toggle("d-none");
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops :(",
          text: response
        });
      }
    }
  }

  request.open("POST", "backend/admin-code-verification-process.php", true);
  request.send(form);
}

function AdminResetPassword() {
  var email = document.getElementById("email2");
  var newPassword = document.getElementById("np");
  var retypedPassword = document.getElementById("rp");
  var vcode = document.getElementById("vcode");

  var newPasswordDiv = document.getElementById("newPasswordDiv");
  var vcodeDiv = document.getElementById("vcodeDiv");

  const newPwdError = document.getElementById("newpwd_err");
  const pwdMatchError = document.getElementById("pwd_match_err");

  [newPwdError, pwdMatchError].forEach(el => {
    el.classList.add('d-none');
  })

  let isValid = true;

  if (newPassword.value.trim() === "") {
    newPwdError.classList.remove('d-none');
    isValid = false;
  }

  if (retypedPassword.value.trim() === "" || retypedPassword.value !== newPassword.value) {
    pwdMatchError.classList.remove('d-none');
    isValid = false;
  }

  if (!isValid) {
    return;
  }

  var form = new FormData();

  form.append("email", email.value);
  form.append("np", newPassword.value);
  form.append("rp", retypedPassword.value);
  form.append("vcode", vcode.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        Swal.fire({
          title: "Password changed successfully",
          icon: "success"
        }).then(() => {
          newPasswordDiv.classList.toggle("d-none");
          vcodeDiv.classList.toggle("d-none");
          window.location = "admin-sign-in.php";
        });
      } else {
        Swal.fire({
          icon: "warning",
          title: "Oops :(",
          text: response
        });
      }
    }
  }

  request.open("POST", "backend/admin-reset-password-process.php", true);
  request.send(form);
}