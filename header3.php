<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>

    <nav class="navbar navbar-expand-sm">
        <div class="container">
            <a class="navbar-brand" href="../home.php">
                <img src="../img/Slight 555 (1).png" alt="Logo" width="230" height="40" class="d-inline-block align-text-top">

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
                        $email = $_SESSION["u"]["email"];

                        // include "connection.php";

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
                                <div class="row">
                                    <input type="text" placeholder="Search..." required id="basic_search_txt">
                                    <button type="submit" class="btn" onclick="basicSearch(0);">Search</button>
                                    <a class="text-center text-decoration-none text-dark" href="../advanced-seacrh.php">Advanced Search</a>
                                </div>

                            </div>
                        </div>

                        <!-- <span class=" text-dark user-name-nav"><b>Hi, </b><?php echo $data["fname"] . " " . $data["lname"]; ?></span> | -->
                        <a class="btn btn-outline-dark custom-nav-btn" id="searchBtn" href="#"><i class="bi bi-search"></i></a>
                        <a class="btn btn-outline-dark custom-nav-btn position-relative" href="../cart.php"><i class="bi bi-bag"></i>

                            <?php 
                            
                            $cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_users_email` = '".$email."'");
                            $cart_num = $cart_rs->num_rows;
                            
                            ?>

                            <span class="position-absolute top-0 h6 mt-1 mx-2 translate-middle badge rounded-pill bg-danger">
                                <?php echo $cart_num; ?>
                            </span>


                        </a>

                        <div class="dropdown">
                            <button class="btn border border-0 dropdown-toggle profile-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php

                                if (empty($image_data["img_path"])) {
                                ?>
                                    <img src="../img/new_user.svg" class="rounded" style="width: 20px;" />
                                <?php
                                } else {
                                ?>
                                    <img src="../<?php echo $image_data["img_path"]; ?>" style="width: 25px; height: 25px; border-radius: 50%;" />
                                <?php
                                }

                                ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../user-profile.php">My Profile</a></li>
                                <li><a class="dropdown-item" href="../watchlist.php">Watchlist</a></li>
                                <li><a class="dropdown-item" href="../purchase-history.php">Purchase History</a></li>
                                <!-- <li><a class="dropdown-item" href="#">Messages</a></li> -->
                                <li><a class="dropdown-item" href="../contact-us.php">Contact Us</a></li>
                                <li><a class="dropdown-item" href="#" onclick="signOut2();">Sign Out</a></li>
                            </ul>
                        </div>
                    <?php

                    } else {
                    ?>

                        <div id="searchModal" class="modal anime">
                            <div class="modal-content">
                                <span class="close">&times;</span>

                                <input type="text" placeholder="Search..." required id="basic_search_txt">
                                <button type="submit" onclick="basicSearch(0);">Search</button>
                                <a class="text-center text-decoration-none text-dark" href="../advanced-search.php">Advanced Search</a>

                            </div>
                        </div>

                        <a class="btn btn-outline-dark" id="searchBtn" href="#"><i class="bi bi-search"></i></a>
                        <div class="dropdown">
                            <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../sign-in.php">Sign In</a></li>
                                <li><a class="dropdown-item" href="../sign-up.php">Sign Up</a></li>
                            </ul>
                        </div>
                    <?php
                    }

                    ?>





                </div>

            </div>
        </div>
    </nav>

    <!-- upper nav bar  -->


    <!-- lower nav bar  -->

    <ul class="nav d-flex justify-content-center bg-dark">
        <li class="nav-item">
            <a class="nav-link text-light custom-nav active" aria-current="page" href="../home.php">HOME</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light custom-nav" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                LADIES
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">New</a></li>
                <li><a class="dropdown-item" href="#">T-Shirt</a></li>
                <li><a class="dropdown-item" href="../product-category/Ladies/dresses.php">Dresses</a></li>
                <li><a class="dropdown-item" href="#">Top</a></li>
                <li><a class="dropdown-item" href="#">Pants & Leggins</a></li>
                <li><a class="dropdown-item" href="#">Jump Suit</a></li>
                <li><a class="dropdown-item" href="#">Skirt</a></li>
                <li><a class="dropdown-item" href="#">Jeans</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light custom-nav" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                GENTS
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">New</a></li>
                <li><a class="dropdown-item" href="#">T-Shirts</a></li>
                <li><a class="dropdown-item" href="../product-category/Gents/shirts.php">Shirts</a></li>
                <li><a class="dropdown-item" href="#">Trousers</a></li>
                <li><a class="dropdown-item" href="#">Jeans</a></li>
                <li><a class="dropdown-item" href="#">Shorts</a></li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light custom-nav" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                KIDS
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../product-category/Kids/boys.php">Boys</a></li>
                <li><a class="dropdown-item" href="../product-category/Kids/girls.php">Girls</a></li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light custom-nav" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                ACCESSORIES
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Gents</a></li>
                <li><a class="dropdown-item" href="#">Ladies</a></li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light custom-nav" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                FOOTWEAR
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Gents</a></li>
                <li><a class="dropdown-item" href="#">Ladies</a></li>
                <li><a class="dropdown-item" href="#">Kids Shoes</a></li>
            </ul>
        </li>

    </ul>

    <script src="../js/script.js"></script>
    <!-- <script src="js/bootstrap.bundle.js"></script> -->
</body>

</html>