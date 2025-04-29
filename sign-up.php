<?php 

include "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | UrbanElagance</title>
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

                            <h2 class="mb-4 fw-bolder">Sign Up</h2>

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

                                    <label class="form-label" for="password">Password</label>
                                    <input class="form-control bg-body-secondary" type="password" required id="password" />

                                    <label class="form-label" for="mobile">Mobile Number</label>
                                    <input class="form-control bg-body-secondary" type="text" required id="mobile" />

                                    <div>
                                        <label class="form-label" for="">Gender</label>
                                        <select class="form-select" id="gender">

                                            <?php

                                            $rs = Database::search("SELECT * FROM `gender`");
                                            $num = $rs->num_rows;

                                            for ($x = 0; $x < $num; $x++) {
                                                $data = $rs->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $data["id"]; ?>">
                                                    <?php echo $data["gender_name"]; ?>
                                                </option>

                                            <?php

                                            }

                                            ?>

                                        </select>
                                    </div>

                                </div>


                            </div>

                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="1" id="tc" required>
                                <label class="form-check-label" for="tc">
                                    I agreed for all <a class="link link-dark" href="#">Terms & Conditions</a> and <a class="link link-dark" href="#">Privacy Policy</a>
                                </label>
                            </div>

                            <div class="col-12 col-lg-10 col-md-6 mt-3 d-grid">
                                <button class="fw-bold btn btn-dark py-2 text-uppercase" onclick="signUp();" id="sweetBtn">
                                <span class="spinner-border spinner-border-sm d-none" id="signUpSpinner" aria-hidden="true"></span>
                                create account</button>
                            </div>

                            <div class="col-12 col-lg-10 col-md-6 mt-3">
                                <p>Already have an account <a class="link link-primary text-decoration-none" href="sign-in.php">Sign In</a> </p>
                            </div>

                        </div>

                        <div class="col-12 col-md-2 me-5">

                            <div>
                                <img src="img/sign-up.gif" class="sign-up-gif d-none d-lg-block" width="329px" height="350px" alt="signup" />
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