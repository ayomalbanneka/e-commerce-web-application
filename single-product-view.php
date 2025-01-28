<?php

include "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT * FROM `products` 
    INNER JOIN `category_has_sub_category` ON products.category_has_sub_category_category_has_sub_category_id=category_has_sub_category.category_has_sub_category_id 
    INNER JOIN `category` ON category_has_sub_category.category_cat_id=category.cat_id 
    INNER JOIN `sub_category` ON category_has_sub_category.sub_category_sub_cat_id=sub_category.sub_cat_id  
    INNER JOIN `material` ON products.material_material_id = material.material_id 
    INNER JOIN `color` ON products.color_color_id = color.color_id 
    INNER JOIN `sizes` ON products.sizes_sizes_id = sizes.sizes_id 
    WHERE `id` ='" . $pid . "' ");

    if ($product_rs->num_rows == 1) {
        $product_data = $product_rs->fetch_assoc();

?>


        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title> <?php echo $product_data["title"]; ?> | UrbanElegance - Stay Elegant, Stay Urban</title>
            <link rel="stylesheet" href="css/style.css" />
            <link rel="stylesheet" href="css/bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
            <link rel="shortcut icon" href="favicon.ico" />
        </head>

        <body>

            <!-- header -->
            <nav class="navbar navbar-expand-sm">
                <div class="container">
                    <a class="navbar-brand" href="home.php">
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
                                        <form action="" method="">
                                            <input type="text" placeholder="Search..." name="query" required>
                                            <button type="submit">Search</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- <span class=" text-dark user-name-nav"><b>Hi, </b><?php echo $data["fname"] . " " . $data["lname"]; ?></span> | -->
                                <a class="btn btn-outline-dark custom-nav-btn" id="searchBtn" href="#" onclick="basicSearch(0);"><i class="bi bi-search"></i></a>
                                <a class="btn btn-outline-dark custom-nav-btn position-relative" href="cart.php"><i class="bi bi-bag"></i>

                                    <?php

                                    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_users_email` = '" . $email . "'");
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
                                            <img src="img/new_user.svg" class="rounded" style="width: 20px;" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $image_data["img_path"]; ?>" style="width: 25px; height: 25px; border-radius: 50%;" />
                                        <?php
                                        }

                                        ?>
                                    </button>
                                    <ul class="dropdown-menu ">
                                        <li><a class="dropdown-item" href="user-profile.php">My Profile</a></li>
                                        <li><a class="dropdown-item" href="watchlist.php">Watchlist</a></li>
                                        <li><a class="dropdown-item" href="#">Purchase History</a></li>
                                        <li><a class="dropdown-item" href="#">Messages</a></li>
                                        <li><a class="dropdown-item" href="#">Contact Admin</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="signOut();">Sign Out</a></li>
                                    </ul>
                                </div>
                            <?php

                            } else {
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

                                <a class="btn btn-outline-dark" id="searchBtn" href="#"><i class="bi bi-search"></i></a>
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

            <!-- upper nav bar  -->


            <!-- lower nav bar  -->

            <ul class="nav d-flex justify-content-center bg-dark">
                <li class="nav-item">
                    <a class="nav-link text-light custom-nav active" aria-current="page" href="home.php">HOME</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light custom-nav" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        LADIES
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">New</a></li>
                        <li><a class="dropdown-item" href="#">T-Shirt</a></li>
                        <li><a class="dropdown-item" href="product-category/Ladies/dresses.php">Dresses</a></li>
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
                        <li><a class="dropdown-item" href="product-category/Gents/shirts.php">Shirts</a></li>
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
                        <li><a class="dropdown-item" href="product-category/Kids/boys.php">Boys</a></li>
                        <li><a class="dropdown-item" href="product-category/Kids/girls.php">Girls</a></li>
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
            <!-- header  -->

            <p class="f6 text-secondary mx-3 mt-3"><a class="link-primary text-decoration-none" href="home.php">Home</a> / <?php echo $product_data["cat_name"] . "/ " . $product_data["sub_cat_name"]; ?></p>



            <div class="container anime">
                <div class="row d-flex justify-content-center">
                    <div class="card spv-card custom-product-card col-12 col-md-10 col-lg-12 mt-5 mb-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-4">

                                    <div class="col-12 col-md-12 col-lg-12">

                                        <div class="row">

                                            <div id="productCarousel" class="carousel slide product-img" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php
                                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id` = '" . $pid . "'");
                                                    $img_num = $img_rs->num_rows;

                                                    if ($img_num != 0) {
                                                        for ($x = 0; $x < $img_num; $x++) {
                                                            $img_data = $img_rs->fetch_assoc();
                                                            $img_path = $img_data["img_path"];
                                                    ?>
                                                            <div class="carousel-item <?php echo ($x == 0) ? 'active' : ''; ?>">
                                                                <img src="<?php echo $img_path; ?>" class="d-block spv-img" style="width: 100%;" alt="Image <?php echo $x + 1; ?>">
                                                            </div>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <div class="carousel-item active">
                                                            <img src="https://placehold.co/600x400" class="d-block spv-img" style="width: 100%;" alt="Placeholder Image">
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>

                                                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>


                                        </div>

                                    </div>

                                </div>

                                <div class="col-12 col-md-12 col-lg-6">

                                    <p class="f6 text-secondary"><a class="text-secondary text-decoration-none" href="home.php">categories:</a> <?php echo $product_data["cat_name"] . ", " . $product_data["sub_cat_name"]; ?></p>


                                    <h3 class="d-flex justify-content-start"><?php echo $product_data["title"]; ?></h3>

                                    <div class="row ">
                                        <div class="col-md-6 col-lg-12 product-details mb-3">
                                            <!-- <p>SKU: 243784</p> -->
                                            <p>AVAILABILITY: <?php echo $product_data["qty"]; ?> in stock</p>
                                            <div class="price">Rs.<?php echo $product_data["price"]; ?>.00</div>
                                            <p>Fabric: <?php echo $product_data["material_name"]; ?></p>

                                            <!-- <p>Model Height- 5'5"</p> -->
                                            <!-- <p>Fit on Size - 6</p> -->
                                            <!-- Colors Section -->
                                            <label class="fw-bold">Colors</label>
                                            <div class="color-options mb-3">
                                                <input class="form-check-input d-none" name="colors[]" type="checkbox" id="color_<?php echo $product_data['color_color_id']; ?>" value="<?php echo $product_data['color_color_id']; ?>">
                                                <label class="btn btn-outline-dark" for="color_<?php echo $product_data['color_color_id']; ?>"><?php echo $product_data['color_name']; ?></label>
                                            </div>

                                            <!-- Sizes Section -->
                                            <label class="fw-bold">Sizes</label>
                                            <div class="selections color-options">
                                                <input class="form-check-input d-none" name="sizes[]" type="checkbox" id="size_<?php echo $product_data['sizes_sizes_id']; ?>" value="<?php echo $product_data['sizes_sizes_id']; ?>">
                                                <label class="btn btn-outline-dark" for="size_<?php echo $product_data['sizes_sizes_id']; ?>"><?php echo $product_data['size']; ?></label>
                                            </div>

                                            <div class="col-md-12 col-lg-12 d-flex">
                                                <label class="fw-bold">Qty:</label><br />
                                                <button class="btn btn-link px-2" onclick="sQtyDec(<?php echo $product_data['qty']; ?>);">
                                                    <i class="bi bi-dash"></i>
                                                </button>&nbsp;
                                                <div class="row product-qty">
                                                    <input type="text" min="0" id="qty_cnt" class="form-control bg-body-secondary text-center" aria-label="Quantity" value="1" onkeyup="checkQty(<?php echo $product_data['qty']; ?>);">
                                                </div> &nbsp;
                                                <button class="btn btn-link px-2" onclick="sQtyInc(<?php echo $product_data['qty']; ?>);">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>

                                            <h6 class="mt-3">Delivery Fee In Colombo: <?php echo $product_data["delivery_fee_colombo"]; ?></h6>
                                            <h6 class="mt-3">Delivery Fee Out Of Colombo: <?php echo $product_data["delivery_fee_other"]; ?></h6>

                                            <div class=" col-12 mt-3 col-md-6 col-lg-9 ">

                                                <!-- <div class="input-group mt-4 mb-3">
                                                    <input type="number" class="form-control bg-body-secondary" aria-label="Quantity" value="1">
                                                </div> -->

                                                <div class="col-6 col-lg-12 col-md-12 mb-3">
                                                    <button class="add-to-cart" onclick="addToCart('<?php echo $product_data['id']; ?>','<?php echo $product_data['qty']; ?>');" id="addToCart"><i class="bi bi-cart-plus"></i> ADD TO CART</button>
                                                </div>

                                                <div class="col-6 col-lg-12 col-md-12 mb-3">

                                                    <?php

                                                    if (isset($_SESSION["u"])) {
                                                        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE 
                                                        `users_email` = '" . $_SESSION["u"]["email"] . "' AND
                                                        `products_id` = '" . $product_data["id"] . "'");

                                                        $watchlist_num = $watchlist_rs->num_rows;

                                                        if ($watchlist_num == 1) {
                                                    ?>

                                                            <button class="add-to-cart text-uppercase" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);"><i id="heart<?php echo $product_data['id']; ?>" class="bi bi-check-circle-fill" style="color: greenyellow;"></i> added to watchlist</button>

                                                        <?php
                                                        } else {
                                                        ?>

                                                            <button class="add-to-cart" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);"><i id="heart<?php echo $product_data['id']; ?>" class="bi bi-heart-fill" style="color: red;"></i> ADD TO WATCHLIST</button>

                                                        <?php
                                                        }
                                                    } else {
                                                        ?>

                                                        <button class="add-to-cart" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);"><i id="heart<?php echo $product_data['id']; ?>" class="bi bi-heart-fill" style="color: red;"></i> ADD TO WATCHLIST</button>

                                                    <?php
                                                    }

                                                    ?>

                                                </div>

                                                <div class="col-6 col-lg-12 col-md-12 mb-3">
                                                    <button class="add-to-cart" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);"><i style="color: greenyellow;" class="bi bi-cash"></i> BUY NOW</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- new arrivals div  -->

            <div class="container">

                <div class="row">
                    <div class="d-flex justify-content-center ms-auto mx-auto mt-3 col-11 col-md-9 col-lg-12 px-5 py-4">
                        <h1 class="text-uppercase fs-2">new arrivals</h1>
                    </div>
                </div>

            </div>

            <div class="container">
                <hr class="border border-dark">
            </div>

            <div class="container">
                <div class="row">
                    <div class="card-group gap-4 ms-auto mx-auto col-11 col-md-12 col-lg-12 mt-3 px-5 py-5">
                        <?php

                        $product_rs = Database::search("SELECT * FROM `products` WHERE 
                        `status_status_id` = '1' ORDER BY `datetime_added` DESC LIMIT 3");

                        $product_num = $product_rs->num_rows;

                        if ($product_num > 0) {
                            for ($x = 0; $x < $product_num; $x++) {
                                $product_data = $product_rs->fetch_assoc();

                        ?>

                                <div class="card">

                                    <?php

                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id` = '" . $product_data["id"] . "'");
                                    $img_num = $img_rs->num_rows;
                                    $img_data = $img_rs->fetch_assoc();

                                    if ($img_num > 0) {
                                    ?>
                                        <img src="<?php echo $img_data["img_path"] ?>" class="card-img-top custom-img" alt="">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="https://placehold.co/600x400" class="card-img-top custom-img" alt="">
                                    <?php
                                    }

                                    ?>


                                    <div class="card-body">
                                        <h5 class="card-title text-center fs-6"><?php echo $product_data["title"]; ?></h5>
                                        <p class="card-text text-center">LKR <?php echo $product_data["price"]; ?>.00</p>

                                        <?php

                                        if ($product_data["qty"] > 0) {
                                        ?>

                                            <a class="btn btn-dark d-grid rounded-5" href='single-product-view.php?id=<?php echo $product_data["id"]; ?>'>Buy Now</a>

                                        <?php
                                        } else {
                                        ?>
                                            <a class="btn btn-secondary d-grid rounded-5" href="#" readOnly>Out Of Stock</a>
                                        <?php
                                        }

                                        ?>

                                    </div>
                                </div>

                        <?php

                            }
                        }

                        ?>
                    </div>
                </div>
            </div>

            <!-- new arrivals div  -->

            <!-- footer  -->

            <?php include "footer.php"; ?>

            <!-- footer-->
            </div>

            <!-- End of container -->
            <script src="js/script.js"></script>
            <script src="js/bootstrap.bundle.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>


<?php
    } else {
        echo ("Something went wrong");
    }
} else {
    echo ("Please select a product first");
}

?>