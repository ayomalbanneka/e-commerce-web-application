<?php

session_start();

include "connection.php";

$price = $_GET['price'];
$sub_cat = $_GET["sub_cat"];
$cat_name = $_GET["cat_name"];

$query = "SELECT * FROM `products`  INNER JOIN `category` ON products.category_cat_id = category.cat_id 
        INNER JOIN `category_has_sub_category` ON products.category_has_sub_category_category_has_sub_category_id = category_has_sub_category.category_has_sub_category_id 
        INNER JOIN `sub_category` ON category_has_sub_category.sub_category_sub_cat_id = sub_category.sub_cat_id  
        WHERE category.cat_name='".$cat_name."' AND sub_category.sub_cat_id = '".$sub_cat."' ";

if ($price == "1") {
    $query = $query . "ORDER BY `price` DESC ";
} else if ($price == "2") {
    $query = $query . "ORDER BY `price` ASC ";
}

?>

<div class="col-lg-12">

    <div class="row" id="basicSearchResult">
        <div class="container anime">
            <div class="row">
                <div class="col-12 mt-3 px-5 py-5">
                    <div class="row">
                        <?php
                        $pageno;

                        if ("0" != $_GET["page"]) {
                            $pageno = $_GET["page"];
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
                                        <img src="../<?php echo $img_data["img_path"]; ?>" class="card-img-top img-fluid custom-img">
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
                                            <a class="btn btn-dark d-grid rounded-5" href='../single-product-view.php?id=<?php echo $selected_data["id"]; ?>'>Buy Now</a>
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
                                        <a class="page-link" href="#" <?php

                                                                if ($pageno <= 1) {
                                                                    echo ("#");
                                                                } else {
                                                                ?> onclick="srtByPrice(<?php echo ($pageno - 1); ?>);" <?php
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
                                                <a class="page-link" href="#" onclick="srtByPrice(<?php echo ($x); ?>);">
                                                    <?php echo $x; ?>
                                                </a>
                                            </li>

                                        <?php
                                        } else {
                                        ?>

                                            <li class="page-item">
                                                <a class="page-link" href="#" onclick="srtByPrice(<?php echo ($x); ?>);">
                                                    <?php echo $x; ?>
                                                </a>
                                            </li>

                                    <?php
                                        }
                                    }

                                    ?>


                                    <li class="page-item">
                                        <a class="page-link" href="#" <?php

                                                                if ($pageno >= $number_of_pages) {
                                                                    echo ("#");
                                                                } else {
                                                                ?> onclick="srtByPrice(<?php echo ($pageno + 1); ?>);" <?php
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