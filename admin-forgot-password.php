<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | UrbanElagance</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />
</head>

<body>

    <!-- upper nav bar -->

    <?php include "profile-header.php"  ?>

    <!-- upper nav bar -->

    <div class="container anime"">
        <div class=" row d-flex justify-content-center fields">
        <div class="card custom-card col-12 col-md-9 col-lg-10 mt-5 mb-5 px-5 py-5">
            <div class="card-body">
                <div class="row">

                    <div class="col-12 col-lg-7">

                        <h2 class="mb-4 fw-bolder">Forgot Password</h2>

                        <h6 class="mb-4">Enter your email address below and we'll send you a code to reset your password</h6>

                        <div class="row">

                            <div id="emaildiv">

                                <div class="col-12 col-lg-10 col-md-12 mb-2">
                                    <label class="form-label" for="email2"> Enter Your Email Address <i class="bi bi-envelope"></i></label>
                                    <input class="form-control bg-body-secondary" type="email" id="email2" required placeholder="example@email.com" />
                                </div>

                                <div class="col-12 col-lg-10 col-md-12 mt-3 d-grid">
                                    <button class="fw-bold btn btn-outline-dark py-2" id="sendbtn" onclick="adminEmailSend();">SEND</button>
                                </div>

                            </div>

                            <div class="d-none" id="vcodeDiv">

                                <div class="col-12 col-lg-10 col-md-12 mb-2">
                                    <label class="form-label" for="vcode"> Verification Code </i></label>
                                    <input class="form-control bg-body-secondary text-center" type="text" id="vcode" required />
                                </div>

                                <div class="col-12 col-lg-10 col-md-12 mt-3 d-grid">
                                    <button class="fw-bold btn btn-outline-dark py-2" onclick="adminVerifyCode();">Verify</button>
                                </div>

                            </div>

                            <div id="newPasswordDiv" class="col-10 mb-2 d-none">
                                <div class="d-flex flex-column flex-md-row align-items-start gap-2">
                                    <!-- New Password -->
                                    <div class="w-100">
                                        <label class="form-label" for="np">New Password</label>
                                        <div class="input-group">
                                            <input class="form-control bg-body-secondary" type="password" id="np" aria-label="New Password">
                                            <button class="btn btn-outline-dark" type="button" id="npb" onclick="showPassword1();">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Re-type New Password -->
                                    <div class="w-100">
                                        <label class="form-label" for="rnp">Re-type New Password</label>
                                        <div class="input-group">
                                            <input class="form-control bg-body-secondary" type="password" id="rp" aria-label="Re-type New Password">
                                            <button class="btn btn-outline-dark" type="button" id="rpb" onclick="showPassword2();">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reset Password Button -->
                                <div class="mt-3 d-grid">
                                    <button class="fw-bold btn btn-outline-dark text-uppercase py-2" id="sendbtn" onclick="AdminResetPassword();">reset password</button>
                                </div>

                            </div>

                            <!-- Go Back Link -->
                            <div class="mt-4">
                                <a class="link icon-link icon-link-hover link-dark text-decoration-none" href="sign-in.php">
                                    <i class="bi bi-arrow-left"></i> Go Back
                                </a>
                            </div>


                        </div>
                    </div>

                    <div class="col-6 col-md-1 d-flex justify-content-start ">

                        <div>

                            <img src="img/forgot-password.gif" class="fp-gif d-none d-lg-block" width="320px" height="350px" alt="lock" />

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- footer  -->

    <div>

        <?php include "footer.php"; ?>

    </div>
    <!-- footer  -->


    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>