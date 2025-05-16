<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Profile | UrbanElagance</title>

    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="shortcut icon" href="favicon.ico" />

</head>

<body>



    <div class="container-fluid">

        <div class="row">

            <?php include "profile-header.php";

            // include "connection.php";

            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                $details_rs = Database::search("SELECT * FROM `user_details` WHERE `email` = '" . $email . "'");

                $address_rs = Database::search("SELECT * FROM `users_address_details` WHERE `users_email` = '" . $email . "'");

                $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email` = '" . $email . "'");

                $details_data = $details_rs->fetch_assoc();
                $address_data = $address_rs->fetch_assoc();
                $image_data = $image_rs->fetch_assoc();


            ?>

                <div class="modal fade" tabindex="-1" id="spanModel3">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content modal-content1">
                            <div class="otp-body w-100 vh-100 d-flex align-items-center justify-content-center">
                                <div class="otp-card">
                                    <h1 class="otp-h1">OTP Verification</h1>
                                    <p>Code has been send to <strong> <?php echo $email; ?></strong></p>
                                    <div class="otp-card-inputs">
                                        <input type="text" maxlength="6" id="i" autofocus>
                                    </div>
                                    <p>Didn't get the otp <a href="#" onclick="verifyEmail();">Resend</a></p>
                                    <button class="btn btn-outline-dark text-center " onclick="verifyOtp();">Verify</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 bg-dark anime">
                    <div class="row">

                        <div class="col-12 bg-body rounded mt-4 mb-4">
                            <div class="row g-2">

                                <div class="col-md-3 border-end">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                        <?php

                                        if (empty($image_data["img_path"])) {
                                        ?>
                                            <img src="img/new_user.svg" class="rounded mt-5" id="image" style="width: 150px;" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $image_data["img_path"]; ?>" class="mt-5" id="image" style="width: 160px; height: 180px; border-radius: 50%;" />
                                        <?php
                                        }

                                        ?>



                                        <span class="fw-bold"><?php echo $details_data["fname"] . " " . $details_data["lname"]; ?>

                                            <?php

                                            $user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");
                                            $user_num = $user_rs->num_rows;
                                            $user_data = $user_rs->fetch_assoc();

                                            if ($user_data["status_status_id"] == 3) {
                                            ?>

                                                <i class="bi bi-exclamation-diamond-fill text-warning"></i>

                                            <?php
                                            } else {
                                            ?>

                                                <i style="color: #399918;" class="bi bi-check-circle-fill"></i>

                                            <?php
                                            }

                                            ?>


                                        </span>
                                        <span class="fw-bold text-black-50"><?php echo $email; ?></span>

                                        <input type="file" class="d-none" id="profileimage" />
                                        <label for="profileimage" class="btn btn-dark mt-5" onclick="changeProfileImage();">Update Profile Image</label>

                                    </div>
                                </div>

                                <div class="col-md-5 col-lg-9 border-end">
                                    <div class="p-3 py-5">

                                        <?php

                                        $user_rs2 = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");
                                        $user_num2 = $user_rs2->num_rows;
                                        $user_data2 = $user_rs2->fetch_assoc();

                                        if ($user_data2["status_status_id"] == 3) {
                                        ?>

                                            <div class="alert alert-warning" role="alert">
                                                Please verify your email
                                            </div>

                                        <?php
                                        }

                                        ?>





                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="fw-bold">Profile Settings</h4>
                                        </div>

                                        <div class="row mt-4">

                                            <div class="col-6">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="fname" value="<?php echo $details_data["fname"]; ?>" />
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lname" value="<?php echo $details_data["lname"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Mobile</label>
                                                <input type="text" class="form-control" id="mobile" value="<?php echo $details_data["mobile"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Email</label>
                                                <div class="input-group">

                                                    <?php

                                                    $user_rs2 = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");
                                                    $user_num2 = $user_rs2->num_rows;
                                                    $user_data2 = $user_rs2->fetch_assoc();

                                                    if ($user_data2["status_status_id"] == 3) {
                                                    ?>

                                                        <input type="text" class="form-control" readonly id="email" value="<?php echo $details_data["email"]; ?>" />
                                                        <span class="input-group-text bg-dark text-light" style="cursor: pointer;" onclick="verifyEmail();">
                                                            Verify
                                                        </span>

                                                    <?php
                                                    } else {
                                                    ?>

                                                        <input type="text" class="form-control" readonly id="email" value="<?php echo $details_data["email"]; ?>" />
                                                        

                                                    <?php
                                                    }

                                                    ?>


                                                </div>

                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Registered Date</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $details_data["joined_date"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Address Line 01</label>
                                                <?php

                                                if (empty($address_data["line1"])) {
                                                ?>
                                                    <input type="text" id="line1" class="form-control" placeholder="Type Address Line 01" />
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="text" id="line1" class="form-control" value="<?php echo $address_data["line1"]; ?>" />
                                                <?php
                                                }

                                                ?>

                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Address Line 02</label>
                                                <?php

                                                if (empty($address_data["line2"])) {
                                                ?>
                                                    <input type="text" id="line2" class="form-control" placeholder="Type your address line 02" />
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="text" id="line2" class="form-control" value="<?php echo $address_data["line2"]; ?>" />
                                                <?php
                                                }

                                                ?>

                                            </div>

                                            <?php

                                            $province_rs = Database::search("SELECT * FROM province");
                                            $district_rs = Database::search("SELECT * FROM district");
                                            $city_rs = Database::search("SELECT * FROM city");

                                            ?>

                                            <div class="col-6">
                                                <label class="form-label">Province</label>
                                                <select class="form-select" onchange="selectDistrict();" id="province">
                                                    <option value="0">
                                                        Select Province</option>
                                                    <?php

                                                    for ($x = 0; $x < $province_rs->num_rows; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $province_data["province_id"]; ?>" <?php
                                                                                                                        if (!empty($address_data["province_id"])) {
                                                                                                                            if ($province_data["province_id"] == $address_data["province_id"]) {
                                                                                                                        ?>selected<?php
                                                                                                                                }
                                                                                                                            } ?>>
                                                            <?php echo $province_data["province_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">District</label>
                                                <select class="form-select" id="district" onchange="selectCity();">
                                                    <option value="0">Select District</option>
                                                    <?php

                                                    for ($x = 0; $x < $district_rs->num_rows; $x++) {
                                                        $district_data = $district_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $district_data["district_id"]; ?>" <?php
                                                                                                                        if (!empty($address_data["district_id"])) {
                                                                                                                            if ($district_data["district_id"] == $address_data["district_id"]) {
                                                                                                                        ?>selected<?php
                                                                                                                                }
                                                                                                                            }
                                                                                                                                    ?>>
                                                            <?php echo $district_data["district_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">City</label>
                                                <select class="form-select" id="city">
                                                    <option value="0">Select City</option>
                                                    <?php

                                                    for ($x = 0; $x < $city_rs->num_rows; $x++) {
                                                        $city_data = $city_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $city_data["city_id"]; ?>" <?php
                                                                                                                if (!empty($address_data["city_id"])) {
                                                                                                                    if ($city_data["city_id"] == $address_data["city_id"]) {
                                                                                                                ?>selected<?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                            ?>>
                                                            <?php echo $city_data["city_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">Postal Code</label>
                                                <?php

                                                if (empty($address_data["postal_code"])) {
                                                ?>
                                                    <input type="text" id="pcode" class="form-control" placeholder="Enter your Postal Code" />
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="text" id="pcode" class="form-control" value="<?php echo $address_data["postal_code"]; ?>" />

                                                <?php
                                                }

                                                ?>

                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Gender</label>
                                                <input type="text" class="form-control" value="<?php echo $details_data["gender_name"]; ?>" readonly />
                                            </div>

                                            <div class="col-12 d-grid mt-2">
                                                <button class="btn btn-outline-dark" onclick="updateProfile();">Update My Profile</button>
                                            </div>

                                            <div class="col-12 d-grid mt-2">
                                                <button class="btn btn-outline-danger" onclick="deleteUserAccount('<?php echo $details_data['email']; ?>');">Delete My Account</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <!-- <div class="col-md-4 text-center">
                                <div class="row">
                                    <span class="fw-bold text-black-50 mt-5">Display ads</span>
                                </div>
                            </div> -->

                            </div>
                        </div>

                    </div>
                </div>

            <?php

            }

            ?>


        </div>
    </div>

    <?php include "footer.php"; ?>


    <script src="js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/script.js"></script>
</body>

</html>