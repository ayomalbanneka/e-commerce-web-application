<?php

include "connection.php"

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | UrbanElegance</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/sign-in.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-borderless/borderless.css" > -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />
    <link rel="shortcut icon" href="favicon.ico" />


</head>

<body>
    <!-- upper nav bar  -->

    <?php  include "profile-header.php"  ?>

    <!-- upper nav bar  -->

    <div class="container anime">
        <div class="row d-flex justify-content-center">
            <div class="card custom-card col-12 col-md-10 col-lg-10 mt-5 mb-5 px-5 py-5">
                <div class="card-body">
                    <div class="row">

                        <div class="col-12 col-lg-7">

                            <h2 class="mb-4 fw-bolder">Sign In</h2>

                            <div class="row">

                                <div class="col-12 col-lg-10 col-md-12 mb-2">

                                    <?php 
                                    
                                    $email = "";
                                    $password = "";

                                    if(isset($_COOKIE["email"])){
                                        $email = $_COOKIE["email"];
                                    }
                                    if(isset($_COOKIE["password"])){
                                        $password = $_COOKIE["password"];
                                    }
                                    
                                    ?>

                                    <label class="form-label" for="email"> Email Address <i class="bi bi-envelope"></i></label>
                                    <input value="<?php echo $email ?>" class="form-control bg-body-secondary" type="email" id="email" required />

                                    <label class="form-label" for="password">Password <i class="bi bi-key"></i> </label>
                                    <input value="<?php echo $password ?>" class="form-control bg-body-secondary" type="password" id="password" required />

                                    <div class="mb-3 mt-3 d-flex justify-content-end">
                                        <a class="link-primary text-decoration-none" href="forgot-password.php">Forgot Password?</a>
                                    </div>

                                </div>


                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember Me</label>
                            </div>

                            <div class="col-12 col-lg-10 col-md-10 mt-3 d-grid">
                                <button class="fw-bold btn btn-dark py-2" onclick="signIn();" id="sweetBtn">Sign In</button>
                            </div>

                            <div class="col-12 col-lg-10 col-md-6 mt-3">
                                <p>Don't have an account? <a class="link link-primary text-decoration-none" href="sign-up.php">Sign Up</a> </p>
                            </div>

                            <div class="col-12 col-lg-10 col-md-7 mt-3">
                                <p>Are you an administrator? <a class="link link-primary text-decoration-none" href="admin-sign-in.php">Login Here</a> </p>
                            </div>

                        </div>

                        <div class="col-12 col-md-2">

                            <div>

                                <img src="img/sign_in.gif" class="d-none d-lg-block" width="330px" height="350px" alt="signin" />

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
    <!--Remove this for borderless sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
    <!--Use this for borderless sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script> 
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>