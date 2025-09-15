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

  if(!valid){
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