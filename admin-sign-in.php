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

    <div class="container anime">
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

                                    <label class="form-label" for="password">Password <i class="bi bi-key"></i> </label>
                                    <input class="form-control bg-body-secondary" type="password" id="password" required />

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
                                <button class="fw-bold btn btn-dark py-2" onclick="adminSignIn();" id="sweetBtn">Sign In</button>
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

        <script src="js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="js/bootstrap.bundle.js"></script>
</body>

</html>