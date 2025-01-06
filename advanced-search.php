<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- <link rel="stylesheet" href="css/product-view.css" /> -->
    <title>Advacned Search | UrbanElegance</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

</head>

<body>

    <?php include "header.php"; ?>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-3 py-3 px-2 mx-1 mb-3 anime">
                        <div class="container-fluid border border-2 rounded-2 border-black  d-none d-lg-block">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <h5>Advanced Search</h5>
                                </div>
                            </div>
                            <div class="srt"></div>
                            <div class="row pt-4">
                                <div class="col-12">
                                    <span style="font-size: 15px;">Search By : Size</span>
                                </div>
                                <div class="col-12">
                                    <div class="form-check pt-3">

                                        <select class="form-select" id="size">
                                            <option value="0">Select Size </option>

                                            <?php

                                            $size_rs = Database::search("SELECT * FROM `sizes`");
                                            $size_num = $size_rs->num_rows;

                                            for ($x = 0; $x < $size_num; $x++) {
                                                $size_data = $size_rs->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $size_data["sizes_id"]; ?>"><?php echo $size_data["size"]; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>




                                    </div>
                                </div>
                            </div>
                            <div class="srt mt-4"></div>
                            <div class="row pt-4">
                                <div class="col-12">
                                    <span style="font-size: 15px;">Search By : Colors</span>
                                </div>
                                <div class="col-12">
                                    <div class="form-check pt-3">
                                        <select class="form-select" id="color">
                                            <option value="0">Select Color </option>

                                            <?php

                                            $size_rs = Database::search("SELECT * FROM `color`");
                                            $size_num = $size_rs->num_rows;

                                            for ($x = 0; $x < $size_num; $x++) {
                                                $size_data = $size_rs->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $size_data["color_id"]; ?>"><?php echo $size_data["color_name"]; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="srt mt-4"></div>
                            <div class="row pt-4">
                                <div class="col-12">
                                    <span style="font-size: 15px;">Search by : category</span>
                                </div>
                                <div class="col-12">
                                    <div class="form-check pt-3">
                                        <select class="form-select" id="category">
                                            <option value="0">Select Category </option>

                                            <?php

                                            $size_rs = Database::search("SELECT * FROM `category`");
                                            $size_num = $size_rs->num_rows;

                                            for ($x = 0; $x < $size_num; $x++) {
                                                $size_data = $size_rs->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $size_data["cat_id"]; ?>"><?php echo $size_data["cat_name"]; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="srt mt-4"></div>
                            <div class="row pt-4">
                                <div class="col-12">
                                    <span style="font-size: 15px;">Search by : Sub Category</span>
                                </div>
                                <div class="col-12">
                                    <div class="form-check pt-3">
                                        <select class="form-select" id="sub_cat">
                                            <option value="0">Select Sub Category </option>

                                            <?php

                                            $size_rs = Database::search("SELECT * FROM `sub_category`");
                                            $size_num = $size_rs->num_rows;

                                            for ($x = 0; $x < $size_num; $x++) {
                                                $size_data = $size_rs->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $size_data["sub_cat_id"]; ?>"><?php echo $size_data["sub_cat_name"]; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="srt mt-4"></div>
                            <div class="row pt-4">
                                <div class="col-12">
                                    <span style="font-size: 15px;">Search by : Brand</span>
                                </div>
                                <div class="col-12">
                                    <div class="form-check pt-3">
                                        <select class="form-select" id="brand">
                                            <option value="0">Select Barnd </option>

                                            <?php

                                            $size_rs = Database::search("SELECT * FROM `brand`");
                                            $size_num = $size_rs->num_rows;

                                            for ($x = 0; $x < $size_num; $x++) {
                                                $size_data = $size_rs->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $size_data["brand_id"]; ?>"><?php echo $size_data["brand_name"]; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="srt mt-4"></div>
                            <div class="row pt-4">
                                <div class="col-12">
                                    <span style="font-size: 15px;">Quantity Status</span>
                                </div>
                                <div class="col-12">
                                    <!-- <div class="form-check pt-3">
                                            <input class="form-check-input" name="check1" type="checkbox" id="q_high" onclick="onlyTwo(this);">
                                            <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">
                                                Quantity : High to low
                                            </label>
                                        </div> -->
                                    <div class="form-check pt-3">
                                        <input class="form-check-input " name="check1" type="checkbox" id="qty">
                                        <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">
                                            Available
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="srt mt-4"></div>
                            <div class="row pt-4">
                                <div class="col-12">
                                    <span style="font-size: 15px;">Search by : Products Collection</span>
                                </div>
                                <div class="col-12">
                                    <div class="form-check pt-3">
                                        <select class="form-select" id="gender">
                                            <option value="0">Select Collection </option>

                                            <?php

                                            $size_rs = Database::search("SELECT * FROM `product_collection`");
                                            $size_num = $size_rs->num_rows;

                                            for ($x = 0; $x < $size_num; $x++) {
                                                $size_data = $size_rs->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $size_data["id"]; ?>"><?php echo $size_data["name"]; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="srt mt-4"></div>
                            <div class="row pt-4">
                                <div class="col-12">
                                    <span style="font-size: 15px;">Price Range</span>
                                </div>
                                <div class="row d-flex flex-columnn gap-3 mb-3 mt-3 srt-inpt">
                                    <div class="col-12 d-grid">
                                        <input type="text" placeholder="From" id="pf" />
                                    </div>
                                    <div class="col-12 d-grid">
                                        <input type="text" placeholder="To" id="pt" />
                                    </div>
                                </div>
                            </div>
                            <div class="srt mt-4"></div>
                            <div class="row mt-4 d-flex justify-content-center col-12 mb-3">
                                <div class="col-6 d-grid">
                                    <button class="btn btn-outline-dark col-12 d-grid" onclick="clearSearch();">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 anime2">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <span></span>
                                <div class="d-flex gap-2 align-items-center mb-3">
                                    <span>Sort By</span>
                                    <div class="srt-select">
                                        <select class="form-select" id="srtByPrice" onchange="srtByPrice3(0);">
                                            <option value="0">Best match</option>
                                            <option value="1">Price: high to low</option>
                                            <option value="2">Price: low to high</option>
                                        </select>
                                    </div>
                                </div>
                                <span onclick="showAdvancedSearch();" class="btn btn-outline-dark d-lg-none"><i class="bi bi-funnel"></i></span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="inpt">
                                <input type="text" placeholder="Search..." id="text" />
                                <button class="btn btn-dark" onclick="advancedSearch(0);">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>



                        <div class="modal fade" tabindex="-1" id="spanModel2">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Sort</h5>
                                        <span data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></span>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid border border-2 rounded-2 border-black">
                                            <div class="row">
                                                <div class="col-12 mt-3">
                                                    <h5>Advanced Search</h5>
                                                </div>
                                            </div>
                                            <div class="srt"></div>
                                            <div class="row pt-4">
                                                <div class="col-12">
                                                    <span style="font-size: 15px;">Search By : Size</span>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check pt-3">

                                                        <select class="form-select" id="size1">
                                                            <option value="0">Select Size </option>

                                                            <?php

                                                            $size_rs = Database::search("SELECT * FROM `sizes`");
                                                            $size_num = $size_rs->num_rows;

                                                            for ($x = 0; $x < $size_num; $x++) {
                                                                $size_data = $size_rs->fetch_assoc();

                                                            ?>

                                                                <option value="<?php echo $size_data["sizes_id"]; ?>"><?php echo $size_data["size"]; ?></option>

                                                            <?php

                                                            }

                                                            ?>

                                                        </select>




                                                    </div>
                                                </div>
                                            </div>
                                            <div class="srt mt-4"></div>
                                            <div class="row pt-4">
                                                <div class="col-12">
                                                    <span style="font-size: 15px;">Search By : Colors</span>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check pt-3">
                                                        <select class="form-select" id="color1">
                                                            <option value="0">Select Color </option>

                                                            <?php

                                                            $size_rs = Database::search("SELECT * FROM `color`");
                                                            $size_num = $size_rs->num_rows;

                                                            for ($x = 0; $x < $size_num; $x++) {
                                                                $size_data = $size_rs->fetch_assoc();

                                                            ?>

                                                                <option value="<?php echo $size_data["color_id"]; ?>"><?php echo $size_data["color_name"]; ?></option>

                                                            <?php

                                                            }

                                                            ?>

                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="srt mt-4"></div>
                                            <div class="row pt-4">
                                                <div class="col-12">
                                                    <span style="font-size: 15px;">Search by : category</span>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check pt-3">
                                                        <select class="form-select" id="category1">
                                                            <option value="0">Select Category </option>

                                                            <?php

                                                            $size_rs = Database::search("SELECT * FROM `category`");
                                                            $size_num = $size_rs->num_rows;

                                                            for ($x = 0; $x < $size_num; $x++) {
                                                                $size_data = $size_rs->fetch_assoc();

                                                            ?>

                                                                <option value="<?php echo $size_data["cat_id"]; ?>"><?php echo $size_data["cat_name"]; ?></option>

                                                            <?php

                                                            }

                                                            ?>

                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="srt mt-4"></div>
                                            <div class="row pt-4">
                                                <div class="col-12">
                                                    <span style="font-size: 15px;">Search by : Sub Category</span>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check pt-3">
                                                        <select class="form-select" id="sub_cat1">
                                                            <option value="0">Select Sub Category </option>

                                                            <?php

                                                            $size_rs = Database::search("SELECT * FROM `sub_category`");
                                                            $size_num = $size_rs->num_rows;

                                                            for ($x = 0; $x < $size_num; $x++) {
                                                                $size_data = $size_rs->fetch_assoc();

                                                            ?>

                                                                <option value="<?php echo $size_data["sub_cat_id"]; ?>"><?php echo $size_data["sub_cat_name"]; ?></option>

                                                            <?php

                                                            }

                                                            ?>

                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="srt mt-4"></div>
                                            <div class="row pt-4">
                                                <div class="col-12">
                                                    <span style="font-size: 15px;">Search by : Brand</span>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check pt-3">
                                                        <select class="form-select" id="brand1">
                                                            <option value="0">Select Barnd </option>

                                                            <?php

                                                            $size_rs = Database::search("SELECT * FROM `brand`");
                                                            $size_num = $size_rs->num_rows;

                                                            for ($x = 0; $x < $size_num; $x++) {
                                                                $size_data = $size_rs->fetch_assoc();

                                                            ?>

                                                                <option value="<?php echo $size_data["brand_id"]; ?>"><?php echo $size_data["brand_name"]; ?></option>

                                                            <?php

                                                            }

                                                            ?>

                                                        </select>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="srt mt-4"></div>
                                            <div class="row pt-4">
                                                <div class="col-12">
                                                    <span style="font-size: 15px;">Quantity Status</span>
                                                </div>
                                                <div class="col-12">
                                                    <!-- <div class="form-check pt-3">
                                            <input class="form-check-input" name="check1" type="checkbox" id="q_high" onclick="onlyTwo(this);">
                                            <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">
                                                Quantity : High to low
                                            </label>
                                        </div> -->
                                                    <div class="form-check pt-3">
                                                        <input class="form-check-input " name="check1" type="checkbox" id="qty1">
                                                        <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">
                                                            Available
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="srt mt-4"></div>
                                            <div class="row pt-4">
                                                <div class="col-12">
                                                    <span style="font-size: 15px;">Search by : Gender</span>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check pt-3">
                                                        <select class="form-select" id="gender1">
                                                            <option value="0">Select Gender </option>

                                                            <?php

                                                            $size_rs = Database::search("SELECT * FROM `product_collection`");
                                                            $size_num = $size_rs->num_rows;

                                                            for ($x = 0; $x < $size_num; $x++) {
                                                                $size_data = $size_rs->fetch_assoc();

                                                            ?>

                                                                <option value="<?php echo $size_data["id"]; ?>"><?php echo $size_data["name"]; ?></option>

                                                            <?php

                                                            }

                                                            ?>

                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="srt mt-4"></div>
                                            <div class="row pt-4">
                                                <div class="col-12">
                                                    <span style="font-size: 15px;">Price Range</span>
                                                </div>
                                                <div class="row d-flex flex-columnn gap-3 mb-3 mt-3 srt-inpt">
                                                    <div class="col-12 d-grid">
                                                        <input type="text" placeholder="From" id="pf1" />
                                                    </div>
                                                    <div class="col-12 d-grid">
                                                        <input type="text" placeholder="To" id="pt1" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="srt mt-4"></div>
                                            <div class="row mt-4 d-flex justify-content-center col-12 mb-3">
                                                <div class="col-6 d-grid">
                                                    <button class="btn btn-outline-dark col-12 d-grid" onclick="clearSearch();">Clear</button>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearSearch();">Clear</button>
                                        <button type="button" class="btn btn-primary" onclick="advancedSearch2(0);">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12">

                            <div class="row" id="view_area">
                                <div class="card-group gap-4 ms-auto mx-auto col-12 col-md-12 mt-3 px-5 py-5">

                                </div>
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
    <script src="js/bootstrap.bundle.js"></script>

</body>

</html>