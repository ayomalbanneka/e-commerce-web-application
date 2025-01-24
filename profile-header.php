<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
</head>

<body>

    <nav class="navbar navbar-expand-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="img/Slight 555 (1).png" alt="Logo" width="230" height="40" class="d-inline-block align-text-top">

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                </ul>

                <div class="gap-2 col-md-6 d-md-flex justify-content-md-end d-sm-flex justify-content-sm-center nav-button">

                    <?php

                    session_start();

                    if (isset($_SESSION["u"])) {
                        $data = $_SESSION["u"];
                        $email = $_SESSION["u"]["email"];

                        include "connection.php";

                        $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email` = '" . $email . "'");

                        if ($image_rs->num_rows > 0) {
                            // Fetch image data
                            $image_data = $image_rs->fetch_assoc();
                        } else {
                            $image_data = ["img_path" => ""];
                        }

                    ?>

                        <div id="searchModal" class="modal anime">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <form action="" method="">
                                    <input type="text" placeholder="Search..." name="query" required>
                                    <button type="submit">Search</button>
                                </form>
                            </div>
                        </div>

                        <!-- <span class="text-lg-start text-dark"><b>Hi, </b><?php echo $data["fname"] . " " . $data["lname"]; ?></span> | -->
                        <!-- <a class="btn btn-outline-dark custom-nav-btn" href="#"><i class="bi bi-search"></i></a>
                        <a class="btn btn-outline-dark custom-nav-btn" href="#"><i class="bi bi-bag"></i></a> -->
                        <div class="dropdown">
                            <button class="btn border border-0 dropdown-toggle custom-nav-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php

                                if (empty($image_data["img_path"])) {
                                ?>
                                    <img src="img/new_user.svg" class="rounded" style="width: 20px;" />
                                <?php
                                } else {
                                ?>
                                    <img src="<?php echo $image_data["img_path"]; ?>" style="width: 25px; height: 25px; border-radius: 50%;" />
                                <?php
                                }

                                ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="user-profile.php">My Profile</a></li>
                                <li><a class="dropdown-item" href="watchlist.php">Watchlist</a></li>
                                <li><a class="dropdown-item" href="purchase-history.php">Purchase History</a></li>
                                <li><a class="dropdown-item" href="contact-us.php">Contact US</a></li>
                                <li><a class="dropdown-item" href="#" onclick="signOut();">Sign Out</a></li>
                            </ul>
                        </div>
                    <?php

                    } else {
                    ?>
                        <a class="btn btn-outline-dark" href="#"><i class="bi bi-search"></i></a>
                        <div class="dropdown">
                            <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="sign-in.php">Sign In</a></li>
                                <li><a class="dropdown-item" href="sign-up.php">Sign Up</a></li>
                            </ul>
                        </div>
                    <?php
                    }

                    ?>





                </div>

            </div>
        </div>
    </nav>


    <script src="js/script.js"></script>
</body>

</html>