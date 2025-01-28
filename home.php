<?php include "connection.php"; ?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UrbanElegance - Stay Elegant, Stay Urban</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />

</head>

<body>

    <!-- upper nav bar  -->

    <?php include "header.php"; ?>

    <!-- lower nav bar  -->


    <!-- carousel  -->

    <div id="basicSearchResult">

        <div class="col-12">
            <div id="hero-carousel" class="carousel slide anime2" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active c-item">
                        <img src="img/bg.png" class="d-block w-100 c-img" alt="Slide 1">
                        <div class="carousel-caption top-0 mt-4">
                            <p class="mt-5 fs-3 text-uppercase"> Effortlessly blending urban edge with timeless allure</p>
                            <h1 class="display-1 fw-bolder text-capitalize text-center">UrbanElegance</h1>
                        </div>
                    </div>
                    <div class="carousel-item c-item">
                        <img src="img/carousel2.png" class="d-block w-100 c-img" alt="Slide 2">
                        <div class="carousel-caption top-0 mt-4">
                            <p class="text-uppercase fs-3 mt-5">Empowering women's fashion with chic urban elegance</p>
                            <p class="display-1 fw-bolder text-capitalize">UrbanElegance</p>
                        </div>
                    </div>
                    <div class="carousel-item c-item">
                        <img src="img/carousel3 (1).jpg" class="d-block w-100 c-img" alt="Slide 3">
                        <div class="carousel-caption top-0 mt-4">
                            <p class="text-uppercase fs-3 mt-5">Redefining men's fashion with urban sophistication</p>
                            <p class="display-1 fw-bolder text-capitalize">UrbanElegance</p>
                        </div>
                    </div>
                    <div class="carousel-item c-item">
                        <img src="img/carousel4.jpg" class="d-block w-100 c-img" alt="Slide 4">
                        <div class="carousel-caption top-0 mt-4">
                            <p class="text-uppercase fs-3 mt-5">Stylish and playful urban fashion for kids.</p>
                            <p class="display-1 fw-bolder text-capitalize">UrbanElegance</p>
                        </div>
                    </div>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
                    <span aria-hidden="true"><i class="bi bi-caret-left-fill" style="font-size: 2rem;"></i></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
                    <span aria-hidden="true"><i class="bi bi-caret-right-fill" style="font-size: 2rem;"></i></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>



        <!-- carousel  -->

        <!-- new arrivals div  -->

        <div class="container anime2">

            <div class="row">
                <div class="d-flex justify-content-center ms-auto mx-auto mt-3 col-11 col-md-9 col-lg-12 px-5 py-4">
                    <h1 class="text-uppercase fs-2">new arrivals</h1>
                </div>
            </div>

        </div>

        <div class="container">
            <hr class="border border-dark">
        </div>

        <div class="container anime2">
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



                    <!-- <div class="card">
                    <img src="img/L_Dress2.jpg" class="card-img-top custom-img" alt="SLEEVE LESS HIGH NECK PRINTED DRESS">
                    <div class="card-body">
                        <h5 class="card-title text-center fs-6">SLEEVE LESS NECK PRINTED DRESS</h5>
                        <p class="card-text text-center">Rs.4,500.00</p>
                        <a class="btn btn-dark d-grid rounded-5" href="#">Buy Now</a>
                    </div>
                </div>
                <div class="card">
                    <img src="img/G_Shirt1.jpg" class="card-img-top custom-img" alt="DOUBLE POCKET SHIRT">
                    <div class="card-body">
                        <h5 class="card-title text-center fs-6">DOUBLE POCKET SHIRT</h5>
                        <p class="card-text text-center">Rs.5,990.00</p>
                        <a class="btn btn-dark d-grid rounded-5" href="#">Buy Now</a>
                    </div>
                </div> -->
                </div>

                <!-- <div class="card-group gap-4 ms-auto mx-auto col-12 col-md-12 col-lg-12 mt-3 px-5 py-5">
                <div class="card">
                    <img src="img/L_Dress3.jpg" class="card-img-top custom-img" alt="LONG SLEEVE SOLID DRESS">
                    <div class="card-body">
                        <h5 class="card-title text-center fs-6">LONG SLEEVE SOLID DRESS</h5>
                        <p class="card-text text-center">Rs.6,000.00</p>
                        <a class="btn btn-dark d-grid rounded-5" href="#">Buy Now</a>
                    </div>
                </div>
                <div class="card">
                    <img src="img/L_Dress4.jpg" class="card-img-top custom-img" alt="SLEEVE LESS HIGH NECK PRINTED DRESS">
                    <div class="card-body">
                        <h5 class="card-title text-center fs-6">PRINTED STRAPPY DRESS</h5>
                        <p class="card-text text-center">Rs.4,500.00</p>
                        <a class="btn btn-dark d-grid rounded-5" href="#">Buy Now</a>
                    </div>
                </div>
                <div class="card">
                    <img src="img/G_T-Shirt1.jpg" class="card-img-top custom-img" alt="DOUBLE POCKET SHIRT">
                    <div class="card-body">
                        <h5 class="card-title text-center fs-6">CHECK SHIRT</h5>
                        <p class="card-text text-center">Rs.8,990.00</p>
                        <a class="btn btn-dark custom-btn d-grid rounded-5" href="#">Buy Now</a>
                    </div>
                </div> -->
                <!-- </div> -->
            </div>
        </div>

        <!-- new arrivals div  -->


        <!-- shop categories  -->

        <div class="container anime2">

            <div class="row">

                <div class="container">

                    <div class="row">
                        <div class="d-flex justify-content-center ms-auto mx-auto mt-3 col-11 col-md-9 col-lg-12 px-5 py-4">
                            <h1 class="text-uppercase fs-2">shop categories</h1>
                        </div>
                    </div>

                </div>

                <div class="container">
                    <hr class="border border-dark">
                </div>

                <div class="container-fluid">

                    <div class="row">
                        <div class="card-group gap-4 ms-auto mx-auto col-11 col-md-12 col-lg-12 mt-3 px-5 py-5">
                            <div class="card">
                                <img src="img/men.jpg" class="card-img-top custom-img2" alt="LONG SLEEVE SOLID DRESS">
                                <div class="card-body">
                                    <h5 class="card-title text-center fs-4">MENS</h5>
                                    <a class="btn btn-dark d-grid rounded-5" href="shop_categories/men.php">Shop Now</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="img/lady.jpg" class="card-img-top custom-img2" alt="SLEEVE LESS HIGH NECK PRINTED DRESS">
                                <div class="card-body">
                                    <h5 class="card-title text-center fs-4">LADIES</h5>
                                    <a class="btn btn-dark d-grid rounded-5" href="shop_categories/ladies.php">Shop Now</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="img/kid.jpg" class="card-img-top custom-img2" alt="DOUBLE POCKET SHIRT">
                                <div class="card-body">
                                    <h5 class="card-title text-center fs-4">KIDS</h5>
                                    <a class="btn btn-dark d-grid rounded-5" href="shop_categories/kids.php">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!-- shop categories  -->

    </div>




    <!-- footer  -->

    <?php include "footer.php"; ?>

    <!-- footer -->

    <script src="js/script.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>