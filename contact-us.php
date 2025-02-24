<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | UrbanElagance</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />

</head>

<body>

    <!-- upper nav bar  -->

    <?php  include "profile-header.php"  ?>
    
    <!-- upper nav bar  -->

    <div class="container anime">
        <div class="row d-flex justify-content-center">
            <div class="card custom-card col-12 col-md-12 col-lg-10 mt-5 mb-5 px-5 py-5">
                <div class="card-body">
                    <div class="row">

                        <div class="col-12 col-lg-7">

                            <h2 class="mb-4 fw-bolder">Contact Us</h2>

                            <div class="row">

                                <div class="col-12 col-lg-10 col-md-8 mb-2 sign-up-form">

                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="form-label" for="fname">First Name</label>
                                            <input class="form-control bg-body-secondary" type="text" required id="fname" />
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label class="form-label" for="lname">Last Name</label>
                                            <input class="form-control bg-body-secondary" type="text" required id="lname" />
                                        </div>
                                    </div>

                                    <label class="form-label" for="email">Email Address</label>
                                    <input class="form-control bg-body-secondary" type="email" required id="email" />

                                    <label class="form-label" for="subject">Reason</label>
                                    <input class="form-control bg-body-secondary" type="text" required id="subject" />

                                    <label class="form-label" for="message">Message</label>
                                    <textarea class="form-control" id="message"></textarea>

                                </div>


                            </div>

                            <div class="col-12 col-lg-10 col-md-6 mt-3 d-grid">
                                <button class="fw-bold btn btn-dark py-2 text-uppercase" onclick="contactUs();" id="sweetBtn">Send <i class="bi bi-send"></i></button>
                            </div>

                        </div>

                        <div class="col-12 col-md-2 me-5">

                            <div>
                                <img src="img/contact-us.gif" class="sign-up-gif d-none d-lg-block" width="329px" height="350px" alt="contact-us" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer  -->

    <div class="anime">

        <?php include "footer.php"; ?>



    </div>

    <!-- footer  -->

    <script src="js/script.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>