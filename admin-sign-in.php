<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin SignIn | UrbanElegance</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />

</head>

<body>
    <!-- upper nav bar  -->

    <?php include "profile-header.php"; ?>

    <!-- upper nav bar  -->

    <div class="modal fade" id="adminVerificationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header bg-light">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-shield-lock fs-5 me-2 text-primary"></i>
                        <h5 class="modal-title mb-0">Admin Verification</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Security Alert -->
                    <div class="alert alert-warning d-flex align-items-center mb-4">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <div>Security verification required for admin access</div>
                    </div>

                    <!-- OTP Input -->
                    <div class="mb-3">
                        <label class="form-label">Enter 6-digit verification code</label>
                        <div class="d-flex justify-content-between">
                            <input type="text" class="form-control text-center mx-1" style="height: 50px; font-size: 1.2rem;" id="otp" autofocus>
                        </div>
                        <!-- <div class="form-text">Sent to admin@<?php echo explode('@', $email)[1]; ?></div> -->
                        <div class="form-text">Sent to your email</div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Cancel
                        </button>
                        <button type="button" class="btn btn-dark" onclick="verifyAdminCode();">
                            <i class="bi bi-shield-check me-1"></i> Verify
                        </button>
                    </div>

                    <!-- Footer Links -->
                    <div class="text-center mt-3 pt-2 border-top">
                        <small class="text-muted">
                            Didn't receive code?
                            <a href="#" class="text-decoration-none" onclick="adminSignIn()">Resend</a> |
                            <a href="contact-us.php" class="text-decoration-none">Need help?</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container anime2">
        <div class="row d-flex justify-content-center">
            <div class="card custom-card col-12 col-md-10 col-lg-10 mt-5 mb-5 px-5 py-5">
                <div class="card-body">
                    <div class="row">

                        <div class="col-12 col-lg-7">

                            <h2 class="mb-4 fw-bolder">Admin Sign In</h2>

                            <div class="row">

                                <div class="col-12 col-lg-10 col-md-8 mb-2">

                                    <label class="form-label" for="email"> Email Address <i class="bi bi-envelope"></i></label>
                                    <input class="form-control bg-body-secondary" type="email" id="email" required />
                                    <h6 class="text-danger small mt-1 d-none" id="email_err">Enter the email address</h6>

                                    <label class="form-label" for="password">Password <i class="bi bi-key"></i> </label>
                                    <input class="form-control bg-body-secondary" type="password" id="password" required />
                                    <h6 class="text-danger small mt-1 d-none" id="pwd_err">Enter the password</h6>

                                    <div class="mb-3 mt-3 d-flex justify-content-end">
                                        <a class="link-primary text-decoration-none" href="admin-forgot-password.php">Forgot Password?</a>
                                    </div>

                                </div>


                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="adminRememberMe">
                                <label class="form-check-label" for="adminRememberMe">
                                    Remember Me
                                </label>
                            </div>

                            <div class="col-12 col-lg-10 col-md-6 mt-3 d-grid">
                                <button class="fw-bold btn btn-dark py-2" onclick="adminSignIn();" id="sweetBtn">
                                    <span class="spinner-border spinner-border-sm d-none" id="adminSignInSpinner" aria-hidden="true"></span>
                                    Sign In
                                </button>
                            </div>

                            <div class="mt-4">
                                <a class="link icon-link icon-link-hover link-dark text-decoration-none" href="sign-in.php"><i class="bi bi-arrow-left"></i> Go Back</a>
                            </div>

                            <!-- <div class="col-12 col-lg-10 col-md-6 mt-3">
                                <p>Create New Account <a class="link link-primary text-decoration-none" href="sign-up.php">Sign Up</a> </p>
                            </div> -->

                        </div>

                        <div class="col-12 col-md-2">

                            <div class="col-6">

                                <img src="img/admin-sign-in.gif" class="admin-sign-in-gif d-none d-lg-block" width="330px" height="350px" alt="signin" />

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

    <script src="js/admin-panel.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>