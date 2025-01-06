<?php

session_start();
include "connection.php";

$txt = $_POST["t"];

$query = "SELECT * FROM `products`";

if (!empty($txt)) {
    $query .= "WHERE `title` LIKE '%" . $txt . "%'";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/product-view.css" />
        <!-- <link rel="stylesheet" href="style.css"> -->
        <title>Products | UrbanElegance</title>
    </head>

    <body>

        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-3 py-3 px-2 mx-1 mb-3">
                            <div class="container-fluid border border-2 rounded-2 border-black d-none d-lg-block">
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
                                            <input class="form-check-input" name="check1" type="checkbox" id="newest" onclick="onlyOne(this);">
                                            <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">
                                                Date : Newest on top
                                            </label>
                                        </div>
                                        <div class="form-check pt-3">
                                            <input class="form-check-input " name="check1" type="checkbox" id="oldest" onclick="onlyOne(this);">
                                            <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">
                                                Date : Oldest on top
                                            </label>
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
                                        <span style="font-size: 15px;">Price</span>
                                    </div>
                                </div>
                                <div class="row d-flex custom-price-input flex-columnn gap-3 mt-3 srt-inpt">
                                    <div class="col-12 d-grid mt-4">
                                        <input type="text" id="pf" placeholder="From" />
                                    </div>
                                    <div class="col-12 d-grid">
                                        <input type="text" id="pt" placeholder="To" />
                                    </div>
                                </div>
                                <!-- <div class="srt mt-4"></div> -->
                                <div class="row mt-4 srt-btn mb-3">
                                    <div class="col-6 d-grid">
                                        <button onclick="sort(0)">Sort</button>
                                    </div>
                                    <div class="col-6 d-grid">
                                        <button onclick="clearSort();">Clear</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-between align-items-center">
                                    <?php

                                    $product_rs2 = Database::search($query);
                                    $product_num2 = $product_rs2->num_rows;

                                    ?>
                                    <span>Results <?php echo $product_num2 ?></span>
                                    <div class="d-flex gap-2 align-items-center">
                                        <span>Sort By</span>
                                        <div class="srt-select">
                                            <select class="form-select" id="srtByPrice" onchange="srtByPrice(0);">
                                                <option value="">Best match</option>
                                                <option value="1">Price: high to low</option>
                                                <option value="2">Price: low to high</option>
                                            </select>
                                        </div>

                                        <span onclick="showSort();" class="btn btn-outline-dark d-lg-none"><i class="bi bi-funnel"></i></span>

                                        <div class="modal fade" tabindex="-1" id="spanModel">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Sort</h5>
                                                        <span data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></span>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-12">
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
                                                                                <input class="form-check-input" name="check1" type="checkbox" id="newest1" onclick="onlyOne(this);">
                                                                                <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">Date: Newest on top</label>
                                                                            </div>
                                                                            <div class="form-check pt-3">
                                                                                <input class="form-check-input " name="check1" type="checkbox" id="oldest1" onclick="onlyOne(this);">
                                                                                <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">Date: Oldest on top</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="srt mt-4"></div>
                                                                    <div class="row pt-4">
                                                                        <div class="col-12">
                                                                            <span style="font-size: 15px;">Quantity Status</span>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-check pt-3">
                                                                                <input class="form-check-input" name="check1" type="checkbox" id="qty1">
                                                                                <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">Available</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="srt mt-4"></div>
                                                                    <div class="row pt-4">
                                                                        <div class="col-12">
                                                                            <span style="font-size: 15px;">Price</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row d-flex custom-price-input flex-column gap-3 mt-3 srt-inpt">
                                                                        <div class="col-12 d-grid mt-4">
                                                                            <input type="text" id="pf1" placeholder="From" />
                                                                        </div>
                                                                        <div class="col-12 d-grid">
                                                                            <input type="text" id="pt1" placeholder="To" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearSort();">Clear</button>
                                                        <button type="button" class="btn btn-primary" onclick="sortMini(0);">Sort</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                </div>


                                          
                            </div>



                            <div class="col-lg-12">

                                <div class="row" id="sortResult">
                                    <div class="container anime2">
                                        <div class="row">
                                            <div class="col-12 mt-3 px-5 py-5">
                                                <div class="row">
                                                    <?php
                                                    $pageno;

                                                    if ("0" != $_POST["page"]) {
                                                        $pageno = $_POST["page"];
                                                    } else {
                                                        $pageno = 1;
                                                    }

                                                    $product_rs = Database::search($query);
                                                    $product_num = $product_rs->num_rows;

                                                    $products_per_page = 6;
                                                    $number_of_pages = ceil($product_num / $products_per_page);

                                                    $page_results = ($pageno - 1) * $products_per_page;
                                                    $selected_rs = Database::search($query . " LIMIT " . $products_per_page . " OFFSET " . $page_results);

                                                    $selected_num = $selected_rs->num_rows;

                                                    for ($x = 0; $x < $selected_num; $x++) {
                                                        $selected_data = $selected_rs->fetch_assoc();
                                                    ?>

                                                        <div class="col-12 col-md-6 col-lg-4 mb-4"> <!-- 3 columns per row on large screens -->
                                                            <div class="card h-100">
                                                                <?php
                                                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id` = '" . $selected_data["id"] . "'");
                                                                $img_num = $img_rs->num_rows;
                                                                $img_data = $img_rs->fetch_assoc();

                                                                if ($img_num > 0) {
                                                                ?>
                                                                    <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top img-fluid custom-img">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="img/L_Dress3.jpg" class="card-img-top img-fluid custom-img">
                                                                <?php
                                                                }
                                                                ?>
                                                                <div class="card-body">
                                                                    <h5 class="card-title text-center fs-6"><?php echo $selected_data["title"]; ?></h5>
                                                                    <p class="card-text text-center">Rs.<?php echo $selected_data["price"]; ?>.00</p>

                                                                    <?php
                                                                    if ($selected_data["qty"] > 0) {
                                                                    ?>
                                                                        <a class="btn btn-dark d-grid rounded-5" href='single-product-view.php?id=<?php echo $selected_data["id"]; ?>'>Buy Now</a>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <a class="btn btn-dark d-grid rounded-5" readOnly href="#">Out Of Stock</a>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php
                                                    }
                                                    ?>

                                                    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                                                        <nav aria-label="Page navigation example">
                                                            <ul class="pagination pagination-lg justify-content-center">
                                                                <li class="page-item non-active">
                                                                    <a class="page-link" <?php

                                                                                            if ($pageno <= 1) {
                                                                                                echo ("#");
                                                                                            } else {
                                                                                            ?> onclick="basicSearch(<?php echo ($pageno - 1); ?>);" <?php
                                                                                                                                                }

                                                                                                                                                    ?> aria-label="Previous">
                                                                        <span aria-hidden="true">&laquo;</span>
                                                                    </a>
                                                                </li>

                                                                <?php

                                                                for ($x = 1; $x <= $number_of_pages; $x++) {
                                                                    if ($pageno == $x) {
                                                                ?>

                                                                        <li class="page-item active">
                                                                            <a class="page-link" onclick="basicSearch(<?php echo ($x); ?>);">
                                                                                <?php echo $x; ?>
                                                                            </a>
                                                                        </li>

                                                                    <?php
                                                                    } else {
                                                                    ?>

                                                                        <li class="page-item">
                                                                            <a class="page-link" onclick="basicSearch(<?php echo ($x); ?>);">
                                                                                <?php echo $x; ?>
                                                                            </a>
                                                                        </li>

                                                                <?php
                                                                    }
                                                                }

                                                                ?>


                                                                <li class="page-item">
                                                                    <a class="page-link" <?php

                                                                                            if ($pageno >= $number_of_pages) {
                                                                                                echo ("#");
                                                                                            } else {
                                                                                            ?> onclick="basicSearch(<?php echo ($pageno + 1); ?>);" <?php
                                                                                                                                                }

                                                                                                                                                    ?> aria-label=" Next">
                                                                        <span aria-hidden="true">&raquo;</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </nav>
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
            </div>
        </div>
        </div>
    </body>

    </html>

<?php

} else if (empty($txt)) {

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
                                            <input class="form-check-input" name="check1" type="checkbox" id="newest" onclick="onlyOne(this);">
                                            <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">
                                                Date : Newest on top
                                            </label>
                                        </div>
                                        <div class="form-check pt-3">
                                            <input class="form-check-input " name="check1" type="checkbox" id="oldest" onclick="onlyOne(this);">
                                            <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">
                                                Date : Oldest on top
                                            </label>
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
                                            <input class="form-check-input " name="check1" type="checkbox" id="qty" onclick="onlyTwo(this);">
                                            <label style="font-size: 13px;" class="form-check-label" for="flexCheckDefault">
                                                Available
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="srt mt-4"></div>
                                <div class="row pt-4">
                                    <div class="col-12">
                                        <span style="font-size: 15px;">Price</span>
                                    </div>
                                </div>
                                <div class="row d-flex flex-columnn gap-3 mt-3 srt-inpt">
                                    <div class="col-12 d-grid mt-4">
                                        <input type="text" id="pf" placeholder="From" />
                                    </div>
                                    <div class="col-12 d-grid">
                                        <input type="text" id="pt" placeholder="To" />
                                    </div>
                                </div>
                                <!-- <div class="srt mt-4"></div> -->
                                <div class="row mt-4 srt-btn mb-3">
                                    <div class="col-6 d-grid">
                                        <button onclick="sort(0)">Sort</button>
                                    </div>
                                    <div class="col-6 d-grid">
                                        <button onclick="clearSort();">Clear</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">

                            <div class="row">
                                <div class="col-12 d-flex justify-content-between align-items-center">

                                    <span>Results 0</span>
                                    <div class="d-flex gap-2 col-md-10 align-items-center">
                                        <span>Sort By</span>
                                        <div class="srt-select">
                                            <select class="form-select" id="srtByPrice" onchange="srtByPrice(0);">
                                                <option value="">Best match</option>
                                                <option value="1">Price: high to low</option>
                                                <option value="2">Price: low to high</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                          
                            </div>

                        </div>

                        <div class="col-lg-12">

                            <div class="row" id="basicSearchResult">
                                <div class="card-group gap-4 ms-auto mx-auto col-12 col-md-12 mt-3 px-5 py-5">

                                </div>
                            </div>

                        </div>



                    </div>

                </div>
            </div>
        </div>
        </div>

        <script src="js/script.js"></script>
        <!-- <script src="js/bootstrap.bundle.js"></script> -->

    </body>

    </html>

<?php

}

?>

<?php
