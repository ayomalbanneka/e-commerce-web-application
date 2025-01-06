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
  var id = document.getElementById("invoice");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "Invalid Invoice Id" || response == "Please add a invoice number first") {
        alert(response);
        window.location.reload();
      }
      document.getElementById("view_area").innerHTML = response;
      // alert(response);
    }
  }

  request.open("GET", "search-invoice-process.php?id=" + id.value, true);
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

  request.open("GET", "order-status-change-process.php?status=" + status + "&invoice=" + id, true);
  request.send();

}

var modal;

function userDetails(email) {

  // alert(email)

  var userModal = document.getElementById("spanModal1" + email);
  modal = new bootstrap.Modal(userModal);
  modal.show();
}