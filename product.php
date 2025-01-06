<?php

session_start();
include "connection.php";
$pageno;

if (isset($_SESSION["au"])) {
    $email = $_SESSION["au"]["email"];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product | UrbanElegance</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/admin-panel.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />
        <link rel="shortcut icon" href="favicon.ico" />
    </head>

    <body>

        <div class="container2">

            <?php include "admin-navigation-panel.php"; ?>

            <div class="main">

                <?php include "admin-header.php" ?>

                <div class="container mt-5">

                    <div class="row">

                        <?php

                        if (isset($_GET["page"])) {
                            $pageno = $_GET["page"];
                        } else {
                            $pageno = 1;
                        }

                        $results_per_page = 4;
                        $page_results = ($pageno - 1) * $results_per_page;


                        // Get the total number of products for pagination
                        $products_rs = Database::search("SELECT * FROM `products`");

                        $products_num = $products_rs->num_rows;
                        $number_of_pages = ceil($products_num / $results_per_page);


                        $selected_rs = Database::search("SELECT * FROM `products`
                            INNER JOIN `color` ON products.color_color_id = color.color_id 
                            INNER JOIN `category` ON products.category_cat_id = category.cat_id 
                            INNER JOIN `category_has_sub_category` ON products.category_has_sub_category_category_has_sub_category_id = category_has_sub_category.category_has_sub_category_id 
                            INNER JOIN `sub_category` ON category_has_sub_category.sub_category_sub_cat_id = sub_category.sub_cat_id 
                            WHERE `admin_email` = '" . $email . "' LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                        // Query with LIMIT and OFFSET for pagination
                        // $products_rs = Database::search("SELECT * FROM `products`
                        //     INNER JOIN `color` ON products.color_color_id = color.color_id 
                        //     INNER JOIN `category` ON products.category_cat_id = category.cat_id 
                        //     INNER JOIN `category_has_sub_category` ON products.category_has_sub_category_category_has_sub_category_id = category_has_sub_category.category_has_sub_category_id 
                        //     INNER JOIN `sub_category` ON category_has_sub_category.sub_category_sub_cat_id = sub_category.sub_cat_id 
                        //     WHERE `admin_email` = '" . $email . "' 
                        //     LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                        ?>

                        <div>
                            <h3>Products</h3>

                            <hr class="border border-1 border-dark" />



                            <div class="wishlist">
                                <?php
                                $selected_num = $selected_rs->num_rows;
                                for ($x = 0; $x < $selected_num; $x++) {
                                    $selected_data = $selected_rs->fetch_assoc();
                                ?>

                                    <div class="row align-items-center mb-3">
                                        <div class="col-3 col-md-2">
                                            <?php
                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id` = '" . $selected_data["id"] . "' ");
                                            $img_num = $img_rs->num_rows;
                                            $img_data = $img_rs->fetch_assoc();

                                            if ($img_num > 0) {
                                            ?>
                                                <img class="rounded img-fluid" src="<?php echo $img_data["img_path"]; ?>" />
                                            <?php
                                            } else {
                                            ?>
                                                <img src=" " class="img-fluid" />
                                            <?php
                                            }
                                            ?>
                                        </div>

                                        <div class="col-6 col-md-7">
                                            <h6><?php echo $selected_data["title"]; ?></h6>
                                            <p class="text-muted">Categories: <?php echo $selected_data["sub_cat_name"]; ?>, <?php echo $selected_data["cat_name"]; ?></p>
                                            <p>Color: <?php echo $selected_data["color_name"]; ?></p>
                                            <p>Quantity: <?php echo $selected_data["qty"]; ?></p>
                                        </div>

                                        <div class="col-2 text-end">
                                            <p class="price2">Rs.<?php echo $selected_data["price"]; ?>.00</p>
                                            <div class="col-12 col-md-12">
                                                <a href="update-product.php?id=<?php echo $selected_data["id"]; ?>" class="btn btn-outline-dark border border-1 mb-2">
                                                    UPDATE
                                                </a>

                                                <?php

                                                if ($selected_data["status_status_id"] == 1) {
                                                ?>

                                                    <button class="btn btn-outline-danger border border-1" onclick="productStatus('<?php echo $selected_data['id']; ?>');">Deactivate</button>

                                                <?php
                                                } else {
                                                ?>

                                                    <button class="btn btn-outline-success border border-1" onclick="productStatus('<?php echo $selected_data['id']; ?>');">Active</button>

                                                <?php
                                                }

                                                ?>


                                            </div>
                                        </div>
                                    </div>

                                    <hr />

                                <?php
                                }
                                ?>

                            </div>



                        </div>

                        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-lg justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link" href="<?php

                                                                    if ($pageno <= 1) {
                                                                        echo "#";
                                                                    } else {
                                                                        echo "?page=" . ($pageno - 1);
                                                                    }

                                                                    ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <?php

                                    for ($x = 1; $x <= $number_of_pages; $x++) {
                                        if ($pageno == $x) {
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

                                                                    if ($pageno >= $number_of_pages) {
                                                                        echo "#";
                                                                    } else {
                                                                        echo "?page=" . ($pageno + 1);
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

        <script src="js/admin-panel.js"></script>
        <script src="js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>

    </html>

<?php

}else {
    header("Location:admin-sign-in.php");
}

?>