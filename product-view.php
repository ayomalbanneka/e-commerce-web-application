<?php 

include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/product-view.css" />
    <title>Products | UrbanElegance</title>
</head>

<body>

    <?php include "header.php"; ?>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-3 py-3 px-2 mx-1 mb-3">
                        <div class="container-fluid border border-2 rounded-2 border-black">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <h5>Sort Products</h5>
                                </div>
                            </div>
                            <div class="srt"></div>
                            <div class="row pt-4">
                                <div class="col-12">
                                    <span style="font-size: 15px;">Sort By : Date</span>
                                </div>
                                <div class="col-12">
                                    <div class="form-check pt-3">
                                        <input class="form-check-input" name="check1" type="checkbox" value="" id="newest"  onclick="onlyOne(this);">
                                        <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">
                                            Date : Newest on top
                                        </label>
                                    </div>
                                    <div class="form-check pt-3">
                                        <input class="form-check-input " name="check1" type="checkbox" value="" id="newest" onclick="onlyOne(this);">
                                        <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">
                                            Date : Oldest on top
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="srt mt-4"></div>
                            <div class="row pt-4">
                                <div class="col-12">
                                    <span style="font-size: 15px;">Sort By : Quantity</span>
                                </div>
                                <div class="col-12">
                                    <div class="form-check pt-3">
                                        <input class="form-check-input" name="check1" type="checkbox" value="" id="newest" onclick="onlyTwo(this);">
                                        <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">
                                            Quantity : High to low
                                        </label>
                                    </div>
                                    <div class="form-check pt-3">
                                        <input class="form-check-input " name="check1" type="checkbox" value="" id="newest" onclick="onlyTwo(this);">
                                        <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">
                                            Quantity : Low to High
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="srt mt-4"></div>
                            <div class="row pt-4">
                                <div class="col-12">
                                    <span style="font-size: 15px;">Sort by : Price</span>
                                </div>
                                <div class="col-12">
                                    <div class="form-check pt-3">
                                        <input class="form-check-input " name="check1" type="checkbox" value="" id="newest" onclick="onlyThree(this);">
                                        <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">
                                            Price : High to low
                                        </label>
                                    </div>
                                    <div class="form-check pt-3">
                                        <input class="form-check-input " name="check1" type="checkbox" value="" id="newest" onclick="onlyThree(this);">
                                        <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">
                                            Price : Low to High
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex flex-columnn gap-3 mt-3 srt-inpt">
                                <div class="col-12 d-grid">
                                    <input type="text" placeholder="From" />
                                </div>
                                <div class="col-12 d-grid">
                                    <input type="text" placeholder="To" />
                                </div>
                            </div>
                            <!-- <div class="srt mt-4"></div> -->
                            <div class="row mt-4 srt-btn mb-3">
                                <div class="col-6 d-grid">
                                    <button>Sort</button>
                                </div>
                                <div class="col-6 d-grid">
                                    <button>Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <!-- <div class="row">
                            <div class="col-12">
                                <div class="inpt">
                                    <input type="text" placeholder="Search..." />
                                    <button>
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-lg-12">

                            <div class="row" id="basicSearchResult">
                                <div class="card-group gap-4 ms-auto mx-auto col-12 col-md-12 mt-3 px-5 py-5">
                                    <!-- <div class="card">
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
                                </div>
                            </div>

                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>

    <script src="js/script.js"></script>
    <!-- <script src="js/bootstrap.bundle.js"></script> -->

</body>

</html>