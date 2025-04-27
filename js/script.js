// Search Bar

// Open modal
document.getElementById('openSearchModal').addEventListener('click', function () {
    const searchModal = new bootstrap.Modal(document.getElementById('searchModal'));
    searchModal.show();
});

// Close modal
document.querySelector('.modal .btn-close').addEventListener('click', function () {
    const searchModal = new bootstrap.Modal(document.getElementById('searchModal'));
    searchModal.hide();
});

// Search Bar


var myCarousel = document.querySelector('#hero-carousel');
var carousel = new bootstrap.Carousel(myCarousel, {
    interval: 3000, // Set your desired interval in milliseconds
    ride: 'carousel'
});


const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
    myInput.focus()
})


function changeImage() {
    var img = document.getElementById("image");
    var prodImg = document.getElementById("prod-img");

    if (img.files.length > 0) {
        var url = window.URL.createObjectURL(img.files[0]);
        prodImg.src = url;
    } else {
        prodImg.src = "img/user.png";
    }
}



function signUp() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var mobile = document.getElementById("mobile");
    var password = document.getElementById("password");
    var gender = document.getElementById("gender");
    var checkbox = document.getElementById("tc");

    var form = new FormData();

    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("email", email.value);
    form.append("mobile", mobile.value);
    form.append("password", password.value);
    form.append("gender", gender.value);
    form.append("tc", checkbox.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                Swal.fire({
                    title: "User Registration Successful",
                    icon: "success"
                }).then(() => {
                    window.location = "sign-in.php";
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

    request.open("POST", "sign-up-process.php", true);
    request.send(form);

}

function signInWithEmail() {
    window.location.href = "sign-up.php";
}

//This will stop multiple alert repeting when click the button
document.getElementById("sweetBtn").removeEventListener('click', signUp);
document.getElementById("sweetBtn").addEventListener('click', function (event) {
    event.preventDefault();
    signUp();
});

function signIn() {
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var rememberMe = document.getElementById("rememberMe");

    var form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("rememberMe", rememberMe.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                Swal.fire({
                    title: "User Sign In Success",
                    icon: "success"
                }).then(() => {
                    window.location = "home.php";
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "User Not Found",
                    text: response
                });
            }
        }
    };

    request.open("POST", "sign-in-process.php", true);
    request.send(form);
}

//This will stop multiple alert repeting when click the button
document.getElementById("sweetBtn").removeEventListener('click', signIn);
document.getElementById("sweetBtn").addEventListener('click', function (event) {
    event.preventDefault();
    signIn();
});

function emailSend() {
    var email = document.getElementById("email2");
    var emaildiv = document.getElementById("emaildiv");
    var vcodeDiv = document.getElementById("vcodeDiv");


    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                Swal.fire({
                    title: "Verification code send successfully",
                    icon: "success",
                    text: "Verification send to your email address"
                }).then(() => {
                    emaildiv.classList.toggle("d-none");
                    vcodeDiv.classList.toggle("d-none");

                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "User Not Found",
                    text: response
                });
            }
        }
    };

    request.open("GET", "forgot-password-process.php?email=" + email.value, true);
    request.send();
}

//This will stop multiple alert repeting when click the button
document.getElementById("sweetBtn").removeEventListener('click', emailSend);
document.getElementById("sweetBtn").addEventListener('click', function (event) {
    event.preventDefault();
    emailSend();
});

function adminEmailSend() {
    var email = document.getElementById("email2");
    var emaildiv = document.getElementById("emaildiv");
    var vcodeDiv = document.getElementById("vcodeDiv");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                Swal.fire({
                    title: "Verification code send successfully",
                    icon: "success",
                    text: "Verification send to your email address"
                }).then(() => {
                    emaildiv.classList.toggle("d-none");
                    vcodeDiv.classList.toggle("d-none");
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "User Not Found",
                    text: response
                });
            }
        }
    };

    request.open("GET", "admin-forgot-password-process.php?email=" + email.value, true);
    request.send();
}

function adminVerifyCode() {
    const email = document.getElementById("email2");
    var newPasswordDiv = document.getElementById("newPasswordDiv");
    // var vcodeDiv = document.getElementById("vcodeDiv");

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

    request.open("POST", "admin-code-verification-process.php", true);
    request.send(form);
}

function AdminResetPassword() {
    var email = document.getElementById("email2");
    var newPassword = document.getElementById("np");
    var retypedPassword = document.getElementById("rp");
    var vcode = document.getElementById("vcode");

    var newPasswordDiv = document.getElementById("newPasswordDiv");
    var vcodeDiv = document.getElementById("vcodeDiv");

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

    request.open("POST", "admin-reset-password-process.php", true);
    request.send(form);
}

//This will stop multiple alert repeting when click the button
document.getElementById("sweetBtn").removeEventListener('click', adminEmailSend);
document.getElementById("sweetBtn").addEventListener('click', function (event) {
    event.preventDefault();
    adminEmailSend();
});

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

function verifyCode() {
    const email = document.getElementById("email2");
    var newPasswordDiv = document.getElementById("newPasswordDiv");
    // var vcodeDiv = document.getElementById("vcodeDiv");

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

    request.open("POST", "code-verification-process.php", true);
    request.send(form);

}

function resetPassword() {
    var email = document.getElementById("email2");
    var newPassword = document.getElementById("np");
    var retypedPassword = document.getElementById("rp");
    var vcode = document.getElementById("vcode");

    var newPasswordDiv = document.getElementById("newPasswordDiv");
    var vcodeDiv = document.getElementById("vcodeDiv");

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
                    window.location = "sign-in.php";
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

    request.open("POST", "reset-password-process.php", true);
    request.send(form);

}

//This will stop multiple alert repeting when click the button
document.getElementById("sweetBtn").removeEventListener('click', resetPassword);
document.getElementById("sweetBtn").addEventListener('click', function (event) {
    event.preventDefault();
    resetPassword();
});


function adminSignIn() {

    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var rememberMe = document.getElementById("adminRememberMe");

    var form = new FormData();

    form.append("email", email.value);
    form.append("password", password.value);
    form.append("adminRememberMe", rememberMe.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response = "success") {
                var btn = document.getElementById("sweetBtn");

                Swal.fire({
                    title: "User Sign In Success",
                    icon: "success"
                }).then(() => {
                    window.location = "admin-panel.php";
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "User Not Found",
                    text: response
                });
            }
        }
    }

    request.open("POST", "admin-sign-in-process.php", true);
    request.send(form);

}

//This will stop multiple alert repeting when click the button
document.getElementById("sweetBtn").removeEventListener('click', adminSignIn);
document.getElementById("sweetBtn").addEventListener('click', function (event) {
    event.preventDefault();
    adminSignIn();
});

function addToCart() {
    var addToCart = document.getElementById("addToCart");

    addToCart.addEventListener('click', function () {
        addToCart.textContent = 'ADDED';
    });
}

document.getElementById("addToCart").removeEventListener('click', addToCart);
document.getElementById("addToCart").addEventListener('click', function (event) {
    event.preventDefault();
    addToCart();
});

function signOut() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                Swal.fire({
                    title: "Sign Out successfully",
                    icon: "success"
                }).then(() => {
                    window.location.reload();
                });
            }
        }
    }

    request.open("POST", "sign-out-process.php", true);
    request.send();

}
document.getElementById("sweetBtn").removeEventListener('click', signOut);
document.getElementById("sweetBtn").addEventListener('click', function (event) {
    event.preventDefault();
    signOut();
});

function signOut2() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                Swal.fire({
                    title: "Sign Out successfully",
                    icon: "success"
                }).then(() => {
                    window.location.reload();
                });
            }
        }
    }

    request.open("POST", "../../sign-out-process.php", true);
    request.send();

}
document.getElementById("sweetBtn").removeEventListener('click', signOut);
document.getElementById("sweetBtn").addEventListener('click', function (event) {
    event.preventDefault();
    signOut();
});

function selectDistrict() {

    var province_id = document.getElementById("province").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            document.getElementById("district").innerHTML = response;
            selectCity();
        }
    }

    request.open("GET", "select-district-process.php?id=" + province_id, true);
    request.send();
}

function selectCity() {
    var district_id = document.getElementById("district").value;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            document.getElementById("city").innerHTML = response;
        }
    }
    request.open("GET", "select-city-process.php?id=" + district_id, true);
    request.send();

}

function changeProfileImage() {
    var image = document.getElementById("profileimage");

    image.onchange = function () {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        document.getElementById("image").src = url;
    }
}

function updateProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var pcode = document.getElementById("pcode");
    var city = document.getElementById("city");
    var image = document.getElementById("profileimage");

    var form = new FormData();

    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("mobile", mobile.value);
    form.append("line1", line1.value);
    form.append("line2", line2.value);
    form.append("pcode", pcode.value);
    form.append("city", city.value);
    form.append("profileimage", image.files[0]);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "Updated" || response == "Saved") {
                Swal.fire({
                    title: "Profile Updated successfully",
                    icon: "success"
                }).then(() => {
                    window.location.reload();
                });
            } else if (response == "You have not selected any profile image") {
                Swal.fire({
                    title: "Oops :(",
                    icon: "warning",
                    text: "You have not selected any profile image"
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    // title: "Sign Out successfully",
                    icon: "error",
                    text: response
                })
            }
        }
    }

    request.open("POST", "update-profile-process.php", true);
    request.send(form);

}

function changeProductImage() {
    var image = document.getElementById("imageUploader");

    image.onchange = function () {

        var file_count = image.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;
            }

        } else {
            alert(file_count + "files selected. You can upload only 3 or less than 3 files");
        }

    }
}

// function addSize(x) {
//     var checkboxes = document.querySelectorAll('input[name="size"]:checked');
//     var sizes = [x];

//     checkboxes.forEach(function (checkbox) {
//         sizes.push(checkbox.value);
//     });

//     var request = new XMLHttpRequest();

//     request.onreadystatechange = function () {
//         if (request.readyState == 4 && request.status == 200) {
//             var response = request.responseText;
//             alert(response);
//         }
//     }

//     // Convert the sizes array to a query string format
//     var sizesParam = sizes.join(",");

//     request.open("GET", "add-product-process.php?size=" + sizes, true);
//     request.send();
// }


function addColor(x) {
    var checkboxes = document.querySelectorAll('input[name="color"]:checked');
    var colors = [x];

    checkboxes.forEach(function (checkbox) {
        colors.push(checkbox.value);
    });

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            alert(response);
        }
    }

    // Convert the sizes array to a query string format
    var colorsParam = colors.join(",");

    request.open("GET", "add-product-process.php?color=" + encodeURIComponent(colorsParam), true);
    request.send();
}

function addProducts() {
    // alert(x);

    var title = document.getElementById("productName");
    var brand = document.getElementById("brand");
    var category = document.getElementById("category");
    var subCategory = document.getElementById("sub_category");
    var color = document.getElementById("color");
    var size = document.getElementById("size");
    var gender = document.getElementById("gender");
    var material = document.getElementById("material");
    var price = document.getElementById("price");
    var qty = document.getElementById("qty");
    var dic = document.getElementById("dic");
    var doc = document.getElementById("doc");
    var imageUploader = document.getElementById("imageUploader");

    // alert(title.value);
    // alert(brand.value);
    // alert(category.value);
    // alert(subCategory.value);
    // alert(color.value);
    // alert(material.value);
    // alert(price.value);
    // alert(qty.value);
    // alert(dic.value);
    // alert(doc.value);
    // alert(size.value);
    // alert(gender.value);

    var form = new FormData();

    form.append("pn", title.value);
    form.append("brand", brand.value);
    form.append("category", category.value);
    form.append("sub_cat", subCategory.value);
    form.append("material", material.value);
    form.append("gender", gender.value);
    form.append("size", size.value);
    form.append("color", color.value);
    form.append("price", price.value);
    form.append("qty", qty.value);
    form.append("dic", dic.value);
    form.append("doc", doc.value);

    var file_count = imageUploader.files.length;

    for (var x = 0; x < file_count; x++) {
        form.append("image" + x, imageUploader.files[x]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                Swal.fire({
                    title: "Products Uploaded successfully",
                    icon: "success"
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    title: "Oops :(",
                    icon: "warning",
                    text: response
                })
            }

        }
    }

    request.open("POST", "add-product-process.php", true);
    request.send(form);

}

document.getElementById("sweetBtn").removeEventListener('click', addProducts);
document.getElementById("sweetBtn").addEventListener('click', function (event) {
    event.preventDefault();
    addProducts();
});

function loadMainImg(x) {
    var sample_img_ = document.getElementById("productImg" + x).src;
    var mainImg = document.getElementById("mainImg");
    // alert(sample_img_);

    mainImg.style.backgroundImage = "url(" + sample_img_ + ")";
}

function checkQty(qty) {
    var input = document.getElementById("qty_cnt");
    if (input.value <= 0) {
        var err = document.getElementById("cnt_err");
        err.innerHTML = "Quantity must be one or more!";
        input.value = 1;
    } else if (input.value > qty) {
        var err = document.getElementById("cnt_err");
        err.innerHTML = "Insufficient Quantity";
        input.value = qty;
    }

}


function basicSearch(x) {
    var txt = document.getElementById("basic_search_txt");

    var form = new FormData();
    form.append("t", txt.value); // Search query
    form.append("page", x); // Page number

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            // document.getElementById("basicSearchResult").innerHTML = response;
            sessionStorage.setItem("searchResults", response);
            sessionStorage.setItem("searchQuery", txt.value);
            window.location = "search-result.php";
        }
    }

    request.open("POST", "basic-search-process.php", true);
    request.send(form);
}

function basicSearch2(x) {
    var txt = document.getElementById("basic_search_txt");

    var form = new FormData();
    form.append("t", txt.value); // Search query
    form.append("page", x); // Page number

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            // document.getElementById("basicSearchResult").innerHTML = response;
            sessionStorage.setItem("searchResults", response);
            sessionStorage.setItem("searchQuery", txt.value);
            window.location.href = "../../search-result.php";
        }
    }

    request.open("POST", "../../basic-search-process.php", true);
    request.send(form);
}

function basicSearch3(x) {
    var txt = document.getElementById("basic_search_txt");

    var form = new FormData();
    form.append("t", txt.value); // Search query
    form.append("page", x); // Page number

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            // document.getElementById("basicSearchResult").innerHTML = response;
            sessionStorage.setItem("searchResults", response);
            sessionStorage.setItem("searchQuery", txt.value);
            window.location = "../search-result.php";
        }
    }

    request.open("POST", "../basic-search-process.php", true);
    request.send(form);
}



function payNow(id) {

    var qty = document.getElementById("qty_cnt").value;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            var obj = JSON.parse(response);
            // alert(response);

            var mail = obj['umail'];
            var amount = obj['amount'];

            if (response == 1) {
                alert('Please login to your account');
                window.location = 'sign-in.php';
            } else if (response == 2) {
                alert('Please update your address');
                window.location = 'user-profile.php';
            } else if (response == 3) {
                alert('Please verify your email address');
                window.location = 'user-profile.php';
            } else {


                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    // alert("Payment completed" + orderId);
                    saveInvoice(orderId, id, mail, amount, qty);
                };

                payhere.onDismissed = function onDismissed() {

                    console.log("Payment dismissed");
                };

                payhere.onError = function onError(error) {
                    console.log("Error : " + error);
                };

                var payment = {
                    "sandbox": true,
                    "merchant_id": obj["mid"],
                    "return_url": "http://localhost/Eshop/singleProductView.php?id=" + id,
                    "cancel_url": "http://localhost/Eshop/singleProductView.php?id=" + id,
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": obj["amount"] + ".00",
                    "currency": obj["currency"],
                    "hash": obj["hash"],
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": obj["umail"],
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };


            }

        }
    }
    request.open("GET", "buy-now-process.php?id=" + id + "&qty=" + qty, true);
    request.send();

}


function saveInvoice(orderId, id, mail, amount, qty) {

    var form = new FormData();
    form.append("o", orderId);
    form.append("i", id);
    form.append("m", mail);
    form.append("a", amount);
    form.append("q", qty);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            var response = request.responseText;
            if (response == 'success') {
                window.location = 'invoice.php?id=' + orderId;
            } else {
                alert(response);
            }

        }
    }
    request.open("POST", "save-invoice-process.php", true);
    request.send(form);
}


function addToCart(id, qty) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            alert(response);
            location.reload();
        }
    }

    request.open("GET", "addToCartProcess.php?id=" + id + "&qty=" + qty, true);
    request.send();
}

function printInvoice() {
    var restorePage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorePage;
}

function downloadInvoice() {
    const invoice = document.getElementById('page');

    html2canvas(invoice).then(canvas => {
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF();

        // Convert canvas to image
        const imgData = canvas.toDataURL('image/png');

        // Calculate dimensions
        const imgWidth = pdf.internal.pageSize.getWidth();
        const imgHeight = (canvas.height * imgWidth) / canvas.width;

        // Add image to PDF
        pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);

        // Save the PDF
        pdf.save('invoice.pdf');
    });
}


function addToWatchlist(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "removed" || response == "Added") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "add-to-watchlist-process.php?id=" + id, true);
    request.send();

}

function removeFromWatchlist(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "Deleted") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }


    request.open("GET", "remove-watchlist-process.php?id=" + id, true);
    request.send();
}

function cartQtyPlus(id, qty) {
    var input = document.getElementById("qty_cnt");
    if (input.value < qty) {
        var new_val = parseInt(input.value) + 1;
        input.value = new_val;
    }

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == 'success') {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }
    request.open("GET", "qty-inc.php?id=" + id + "&qty=" + qty, true);
    request.send();

}

function cartQtyMinus(id) {
    var input = document.getElementById("qty_cnt");
    if (input.value > 1) {
        var new_val = parseInt(input.value) - 1;
        input.value = new_val;
    } else {
        var err = document.getElementById("cnt_err");
        err.innerHTML = "Minumum quantity reached!";
        input.value = 1;
    }

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == 'success') {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }
    request.open("GET", "qty-dec.php?id=" + id, true);
    request.send();

}

function sQtyInc(qty) {

    var input = document.getElementById("qty_cnt");
    if (input.value < qty) {
        var new_val = parseInt(input.value) + 1;
        input.value = new_val;
    }

}

function sQtyDec() {
    var input = document.getElementById("qty_cnt");
    if (input.value > 1) {
        var new_val = parseInt(input.value) - 1;
        input.value = new_val;
    }
}

function checkQty(qty) {
    var input = document.getElementById("qty_cnt");
    if (input.value <= 0) {
        alert("Quantity must be one or more!");
        input.value = 1;
    } else if (input.value > qty) {
        alert("Insufficient Quantity");
    }
}

function removeFromCart(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "Removed") {
                alert("Product removed from the cart");
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "remove-from-cart-process.php?id=" + id, true);
    request.send();
}

function onlyOne(checkbox) {

    var checkboxes = document.getElementsByName(checkbox.name)
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })

}

function onlyTwo(checkbox) {
    var checkboxes = document.getElementsByName(checkbox.name)
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })

}

function onlyThree(checkbox) {
    var checkboxes = document.getElementsByName(checkbox.name)
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })

}

function sort(x) {

    // var txt = document.getElementById("basic_search_txt");
    var txt = sessionStorage.getItem("searchQuery"); // Retrieve stored query

    var time = "0";

    if (document.getElementById("newest").checked) {
        time = "1";
    } else if (document.getElementById("oldest").checked) {
        time = "2";
    }

    var stock = "0";

    if (document.getElementById("qty").checked) {
        stock = "1";
    }

    var from = document.getElementById("pf");
    var to = document.getElementById("pt");


    var form = new FormData();

    form.append("t", txt);
    form.append("from", from.value);
    form.append("to", to.value);
    form.append("stock", stock);
    form.append("time", time);
    form.append("page", x);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            // document.getElementById("sortResult").innerHTML = response;
            sessionStorage.setItem("searchResults", response); // Store sorted results
            displayResults(); // Update results
        }
    }

    request.open("POST", "sort-process.php", true);
    request.send(form);

}

function displayResults() {
    var results = sessionStorage.getItem("searchResults");
    if (results) {
        document.getElementById("sortResult").innerHTML = results;
    }
}

function sort2(x) {

    var time = "0";

    if (document.getElementById("newest").checked) {
        time = "1";
    } else if (document.getElementById("oldest").checked) {
        time = "2";
    }

    var stock = "0";

    if (document.getElementById("qty").checked) {
        stock = "1";
    }

    var from = document.getElementById("pf");
    var to = document.getElementById("pt");
    var category = document.getElementById("cat_name").innerText;
    var sub_cat = document.getElementById("sub_cat").innerText;

    // alert(sub_cat.innerText)
    // alert(category.innerText)


    var form = new FormData();

    form.append("from", from.value);
    form.append("to", to.value);
    form.append("stock", stock);
    form.append("time", time);
    form.append("cat_name", category);
    form.append("sub_cat", sub_cat);
    form.append("page", x);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            document.getElementById("sortResult").innerHTML = response;
        }
    }

    request.open("POST", "../../sort-process2.php", true);
    request.send(form);

}

function clearSort() {
    // window.location.reload();

    document.getElementById("newest").checked = false;
    document.getElementById("oldest").checked = false;
    document.getElementById("qty").checked = false;
    document.getElementById("pf").value = "";
    document.getElementById("pt").value = "";

    document.getElementById("newest1").checked = false;
    document.getElementById("oldest1").checked = false;
    document.getElementById("qty1").checked = false;
    document.getElementById("pf1").value = "";
    document.getElementById("pt1").value = "";

}

function clearSearch() {
    window.location.reload();
}

function srtByPrice(x) {

    var txt = document.getElementById("basic_search_txt");


    var price = 0;

    if (document.getElementById('srtByPrice').value != "0") {
        price = document.getElementById('srtByPrice').value;
    }

    // alert(price);

    var request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            document.getElementById('sortResult').innerHTML = response;
        }
    }
    request.open("GET", "sort-price-process.php?price=" + price + "&t=" + txt.value + "&page=" + x, true);
    request.send();


}

function srtByPrice2(x) {

    var sub_cat = document.getElementById("sub_cat").innerText;
    var cat_name = document.getElementById("cat_name").innerText;
    // alert(cat_name)

    var price = 0;

    if (document.getElementById('srtByPrice').value != "0") {
        price = document.getElementById('srtByPrice').value;
    }

    // alert(price);

    var request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            document.getElementById('sortResult').innerHTML = response;
        }
    }
    request.open("GET", "../../sort-price-process2.php?price=" + price + "&page=" + x + "&sub_cat=" + sub_cat + "&cat_name=" + cat_name, true);
    request.send();


}

function srtByPrice3(x) {

    var txt = document.getElementById("basic_search_txt");


    var price = 0;

    if (document.getElementById('srtByPrice').value != "0") {
        price = document.getElementById('srtByPrice').value;
    }

    // alert(price);

    var request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            document.getElementById('view_area').innerHTML = response;
        }
    }
    request.open("GET", "advanced-search-sort-price-process.php?price=" + price + "&t=" + txt.value + "&page=" + x, true);
    request.send();


}

function adminSignOut() {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                Swal.fire({
                    title: "Sign Out successfully",
                    icon: "success"
                }).then(() => {
                    window.location = "admin-sign-in.php";
                });
            }
        }
    }

    request.open("GET", "admin-sign-out-process.php", true);
    request.send();
}

function updateProduct(id) {
    // alert(id);
    var title = document.getElementById("productName");
    var stock = document.getElementById("qty");
    var dic = document.getElementById("dic");
    var doc = document.getElementById("doc");
    var images = document.getElementById("imageUploader");

    var form = new FormData();

    form.append("title", title.value);
    form.append("qty", stock.value);
    form.append("dic", dic.value);
    form.append("doc", doc.value);
    form.append("pid", id);

    var count = images.files.length;

    for (var x = 0; x < count; x++) {
        form.append("i" + x, images.files[x]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "Product has been updated!") {
                Swal.fire({
                    title: "Product has been updated",
                    icon: "success"
                }).then(() => {
                    window.location = "product.php";
                });
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "update-product-process.php", true);
    request.send(form);


}

function addColor() {
    var clr = document.getElementById("new_clr");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText
            if (response == "success") {
                Swal.fire({
                    title: "Success",
                    text: "Color has registered successfully",
                    icon: "success"
                });
            } else {
                Swal.fire({
                    title: "Error",
                    text: response,
                    icon: "error"
                });
            }
        }
    }

    request.open("GET", "save-color-process.php?clr=" + clr.value, true);
    request.send();
}

function addMaterial() {
    var mtl = document.getElementById("new_mtl");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText
            if (response == "success") {
                Swal.fire({
                    title: "Success",
                    text: "Material has registered successfully",
                    icon: "success"
                });
            } else {
                Swal.fire({
                    title: "Error",
                    text: response,
                    icon: "error"
                });
            }
        }
    }

    request.open("GET", "save-material-process.php?mtl=" + mtl.value, true);
    request.send();
}

function addBrand() {
    var brd = document.getElementById("new_brd");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText
            if (response == "success") {
                Swal.fire({
                    title: "Success",
                    text: "Brand has registered successfully",
                    icon: "success"
                });
            } else {
                Swal.fire({
                    title: "Error",
                    text: response,
                    icon: "error"
                });
            }
        }
    }

    request.open("GET", "save-brand-process.php?brd=" + brd.value, true);
    request.send();
}

function addCategory() {
    var category = document.getElementById("new_cat");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText
            if (response == "success") {
                Swal.fire({
                    title: "Success",
                    text: "Category has registered successfully",
                    icon: "success"
                });
            } else {
                Swal.fire({
                    title: "Error",
                    text: response,
                    icon: "error"
                });
            }
        }
    }

    request.open("GET", "save-category-process.php?cat=" + category.value, true);
    request.send();
}

function addSubCategory() {

    var sub_category = document.getElementById("sub_cat");
    // alert(sub_category);
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText
            if (response == "success") {
                Swal.fire({
                    title: "Success",
                    text: "Sub category has registered successfully",
                    icon: "success"
                });
            } else {
                Swal.fire({
                    title: "Error",
                    text: response,
                    icon: "error"
                });
            }
        }
    }

    request.open("GET", "save-sub_category-process.php?sub_cat=" + sub_category.value, true);
    request.send();

}

var model;

function showSort() {
    var smodel = document.getElementById("spanModel");

    model = new bootstrap.Modal(smodel);
    model.show();

}

function sortMini(x) {

    var txt = sessionStorage.getItem("searchQuery"); // Retrieve stored query


    var time = "0";

    if (document.getElementById("newest1").checked) {
        time = "1";
    } else if (document.getElementById("oldest1").checked) {
        time = "2";
    }

    var stock = "0";

    if (document.getElementById("qty1").checked) {
        stock = "1";
    }

    var from = document.getElementById("pf1");
    var to = document.getElementById("pt1");

    var form = new FormData();

    form.append("t", txt);
    form.append("from", from.value);
    form.append("to", to.value);
    form.append("stock", stock);
    form.append("time", time);
    form.append("page", x);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            // document.getElementById("sortResult").innerHTML = response;
            sessionStorage.setItem("searchResults", response); // Store sorted results
            displayResults(); // Update results
            model.hide();
        }
    }

    request.open("POST", "sort-process.php", true);
    request.send(form);
}

var model4;

function showSort2() {
    var smodel = document.getElementById("spanModel4");

    model4 = new bootstrap.Modal(smodel);
    model4.show();

}

function sortMini2(x) {
    var time = "0";

    if (document.getElementById("newest1").checked) {
        time = "1";
    } else if (document.getElementById("oldest1").checked) {
        time = "2";
    }

    var stock = "0";

    if (document.getElementById("qty1").checked) {
        stock = "1";
    }

    var from = document.getElementById("pf1");
    var to = document.getElementById("pt1");
    var category = document.getElementById("cat_name").innerText;
    var sub_cat = document.getElementById("sub_cat").innerText;

    // alert(sub_cat.innerText)
    // alert(category.innerText)


    var form = new FormData();

    form.append("from", from.value);
    form.append("to", to.value);
    form.append("stock", stock);
    form.append("time", time);
    form.append("cat_name", category);
    form.append("sub_cat", sub_cat);
    form.append("page", x);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            document.getElementById("sortResult").innerHTML = response;
            model4.hide();
        }
    }

    request.open("POST", "../../sort-process2.php", true);
    request.send(form);
}

function blockUser(email) {
    // alert(email);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            alert(response);
            window.location.reload();
        }
    }

    request.open("GET", "block-user-process.php?email=" + email, true);
    request.send();

}

function productStatus(id) {
    // alert(id);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "Deactivate" || response == "Activate") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "change-product-status-process.php?id=" + id, true);
    request.send();

}

function advancedSearch(x) {

    var size = document.getElementById("size");
    var text = document.getElementById("text");
    var color = document.getElementById("color");
    var category = document.getElementById("category");
    var sub_cat = document.getElementById("sub_cat");
    var brand = document.getElementById("brand");
    var gender = document.getElementById("gender");
    var from = document.getElementById("pf");
    var to = document.getElementById("pt");

    var stock = "0";

    if (document.getElementById("qty").checked) {
        stock = "1";
    }

    var form = new FormData();

    form.append("s", size.value);
    form.append("txt", text.value);
    form.append("c", color.value);
    form.append("cat", category.value);
    form.append("scat", sub_cat.value);
    form.append("b", brand.value);
    form.append("ch", stock);
    form.append("g", gender.value);
    form.append("f", from.value);
    form.append("t", to.value);
    form.append("page", x)

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            document.getElementById("view_area").innerHTML = response;
        }
    }

    request.open("POST", "advaced-search-process.php", true)
    request.send(form);

}

var model2;

function showAdvancedSearch() {
    var smodel = document.getElementById("spanModel2");

    model2 = new bootstrap.Modal(smodel);
    model2.show();

}

function advancedSearch2(x) {

    var size = document.getElementById("size1");
    var text = document.getElementById("text");
    var color = document.getElementById("color1");
    var category = document.getElementById("category1");
    var sub_cat = document.getElementById("sub_cat1");
    var brand = document.getElementById("brand1");
    var gender = document.getElementById("gender1");
    var from = document.getElementById("pf1");
    var to = document.getElementById("pt1");

    var stock = "0";

    if (document.getElementById("qty1").checked) {
        stock = "1";
    }
    var form = new FormData();

    form.append("s", size.value);
    form.append("txt", text.value);
    form.append("c", color.value);
    form.append("cat", category.value);
    form.append("scat", sub_cat.value);
    form.append("b", brand.value);
    form.append("ch", stock);
    form.append("g", gender.value);
    form.append("f", from.value);
    form.append("t", to.value);
    form.append("page", x)

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            document.getElementById("view_area").innerHTML = response;
            model2.hide();
        }
    }

    request.open("POST", "advaced-search-process2.php", true)
    request.send(form);

    // alert("OK")

}

function findOrders() {
    // alert("OK");

    var from = document.getElementById("from");
    var to = document.getElementById("to");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            document.getElementById("view_area").innerHTML = response;
        }

    }

    request.open("GET", "find-orders-process.php?f=" + from.value + "&t=" + to.value, true);
    request.send();

}

function checkout() {

    // alert(id)

    var qty = document.getElementById("qty_cnt").value;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            var obj = JSON.parse(response);
            // alert(response);

            // var mail = obj['email'];
            var amount = obj['amount'];
            // var items = obj['items'];


            if (response == 1) {
                alert('Please login to your account');
                window.location = 'sign-in.php';
            } else if (response == 2) {
                alert('Please update your address');
                window.location = 'user-profile.php';
            } else {


                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    // alert("Payment completed" + orderId);
                    checkoutSaveInvoice(orderId, amount);
                };

                payhere.onDismissed = function onDismissed() {

                    console.log("Payment dismissed");
                };

                payhere.onError = function onError(error) {
                    console.log("Error : " + error);
                };

                var payment = {
                    "sandbox": true,
                    "merchant_id": obj["merchant_id"],
                    "return_url": "http://localhost/Eshop/cart.php",
                    "cancel_url": "http://localhost/Eshop/cart.php",
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["order_id"],
                    "items": obj["items"],
                    "amount": obj["amount"] + ".00",
                    "currency": obj["currency"],
                    "hash": obj["hash"],
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": obj["email"],
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };

            }

        }
    }
    request.open("GET", "checkout-process.php", true);
    request.send();
}

function checkoutSaveInvoice(orderId, amount) {

    var form = new FormData();
    form.append("o", orderId);
    form.append("a", amount);

    var request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == 'success') {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(response);
            }

        }
    }
    request.open("POST", "cart-save-invoice-process.php", true);
    request.send(form);
}


function contactUs() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var msg = document.getElementById("message");
    var subject = document.getElementById("subject");

    var form = new FormData();

    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("email", email.value);
    form.append("msg", msg.value);
    form.append("subject", subject.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                Swal.fire({
                    title: "Email send successfully",
                    icon: "success",
                    text: "We will contact you in two business days"
                }).then(() => {
                    window.location.reload();
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

    request.open("POST", "contact-us-process.php", true);
    request.send(form);

}

var model3;


function verifyEmail() {
    // alert("OK");

    var vemail = document.getElementById("email").value;
    var emodel = document.getElementById("spanModel3");

    var request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText
            if (response == "success") {
                Swal.fire({
                    title: "Success",
                    text: "Verification Code sended successfully",
                    icon: "success"
                }).then(() => {
                    model3 = new bootstrap.Modal(emodel);
                    model3.show();
                });



            } else {
                Swal.fire({
                    title: "Error",
                    text: response,
                    icon: "error"
                });
            }
        }
    }

    request.open("GET", "email-verification-process.php?email=" + vemail, true);
    request.send()

}

function verifyOtp() {
    var code = document.getElementById("i");
    var email = document.getElementById("email");

    var form = new FormData();

    form.append("code", code.value);
    form.append("email", email.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                Swal.fire({
                    title: "Success",
                    text: "Your email verified successfully",
                    icon: "success"
                }).then(() => {
                    window.location.reload();
                });

            } else {
                Swal.fire({
                    title: "Error",
                    text: response,
                    icon: "error"
                });
            }
        }
    }

    request.open("POST", "account-verify-process.php", true);
    request.send(form);

}

function deleteUserAccount(email) {
    var email = document.getElementById("email").value;
    // alert(email.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                Swal.fire({
                    title: "Your account deleted successfully",
                    text: "Your account deleted successfully. We are sad to see you go. ",
                    icon: "success"
                }).then(() => {
                    window.location = "home.php";
                });

            } else {
                Swal.fire({
                    title: "Error",
                    text: response,
                    icon: "error"
                });
            }
        }
    }

    request.open("GET", "delete-user-account-process.php?email=" + email, true);
    request.send();

}

function addToCartFromWatchlist(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "Added to cart successfully") {
                window.location.reload()
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "add-to-cart-from-watchlist.php?id=" + id, true);
    request.send()

}