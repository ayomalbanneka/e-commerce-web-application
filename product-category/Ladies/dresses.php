<?php

include "../../connection.php";

$query = "SELECT * FROM `products` 
        INNER JOIN `category` ON products.category_cat_id = category.cat_id 
        INNER JOIN `category_has_sub_category` ON products.category_has_sub_category_category_has_sub_category_id = category_has_sub_category.category_has_sub_category_id 
        INNER JOIN `sub_category` ON category_has_sub_category.sub_category_sub_cat_id = sub_category.sub_cat_id  
        WHERE category.cat_name='Ladies' AND sub_category.sub_cat_name = 'Dresses' ";

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$products_per_page = 10; // Number of products per page
$number_of_pages = ceil($product_num / $products_per_page);
$page_no = isset($_GET['page']) ? $_GET['page'] : 1;
$page_results = ($page_no - 1) * $products_per_page;

$selected_rs = Database::search($query . " LIMIT $products_per_page OFFSET $page_results");
$selected_num = $selected_rs->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/product-view.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="shortcut icon" href="../../favicon.ico" />
    <title>Women - Dresses | UrbanElegance</title>
</head>

<body>



    <?php include "../../header2.php"; ?>

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
                                    <button onclick="sort2(0)">Sort</button>
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
                                        <select class="form-select" id="srtByPrice" onchange="srtByPrice2(0);">
                                            <option value="0">Best match</option>
                                            <option value="1">Price: high to low</option>
                                            <option value="2">Price: low to high</option>

                                        </select>
                                    </div>

                                    <span onclick="showSort2();" class="btn btn-outline-dark d-lg-none"><i class="bi bi-funnel"></i></span>

                                    <div class="modal fade" tabindex="-1" id="spanModel4">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Sort Products</h5>
                                                    <span data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></span>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-12">
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
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="clearSort();">Clear</button>
                                                    <button type="button" class="btn btn-outline-dark" onclick="sortMini2(0);">Sort</button>
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
                                                                <img src="../../<?php echo $img_data["img_path"]; ?>" class="card-img-top img-fluid custom-img">
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="../img/lady.jpg" class="card-img-top img-fluid custom-img">
                                                            <?php
                                                            }
                                                            ?>
                                                            <div class="card-body">
                                                                <h5 class="card-title text-center fs-6"><?php echo $selected_data["title"]; ?></h5>
                                                                <p class="card-text text-center">Rs.<?php echo $selected_data["price"]; ?>.00</p>

                                                                <?php
                                                                if ($selected_data["qty"] > 0) {
                                                                ?>
                                                                    <a class="btn btn-dark d-grid rounded-5" href='../../single-product-view.php?id=<?php echo $selected_data["id"]; ?>'>Buy Now</a>
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
                                                            <li class="page-item">
                                                                <a class="page-link" href="<?php

                                                                                            if ($page_no <= 1) {
                                                                                                echo "#";
                                                                                            } else {
                                                                                                echo "?page=" . ($page_no - 1);
                                                                                            }

                                                                                            ?>" aria-label="Previous">
                                                                    <span aria-hidden="true">&laquo;</span>
                                                                </a>
                                                            </li>

                                                            <?php

                                                            for ($x = 1; $x <= $number_of_pages; $x++) {
                                                                if ($page_no == $x) {
                                                            ?>

                                                                    <li class="page-item active">
                                                                        <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                                    </li>

                                                                <?php
                                                                } else {
                                                                ?>

                                                                    <li class="page-item">
                                                                        <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                                    </li>

                                                            <?php
                                                                }
                                                            }

                                                            ?>

                                                            <li class="page-item">
                                                                <a class="page-link" href="<?php

                                                                                            if ($page_no >= $number_of_pages) {
                                                                                                echo "#";
                                                                                            } else {
                                                                                                echo "?page=" . ($page_no + 1);
                                                                                            }

                                                                                            ?>" aria-label="Next">
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


        <p class="subcat" id="sub_cat"><?php echo $selected_data["sub_cat_id"] ?></p>
        <p class="subcat" id="cat_name"><?php echo $selected_data["cat_name"] ?></p>



    </div>

    </div>
    </div>
    </div>
    </div>

    <?php include "../../footer.php"; ?>

    <script src="../../js/script.js"></script>
    <script src="../../js/bootstrap.bundle.js"></script>

</body>

</html>