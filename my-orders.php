<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - UrbanElegance</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="shortcut icon" href="favicon.ico">
</head>

<body>

    <?php include "header.php"; ?>

    <div class="container-fluid mt-5 px-3 px-lg-5 anime2">

        <div class="row justify-content-center">

            <?php

            if (isset($_SESSION['u'])) {
                $email = $_SESSION['u']['email'];

                $pageno;

                if (isset($_GET["page"])) {
                    $pageno = $_GET["page"];
                } else {
                    $pageno = 1;
                }

                $query = "SELECT * FROM `invoice`
                INNER JOIN `products` ON invoice.products_id=products.id
                INNER JOIN `category` ON products.category_cat_id = category.cat_id 
                INNER JOIN `category_has_sub_category` ON products.category_has_sub_category_category_has_sub_category_id = category_has_sub_category.category_has_sub_category_id 
                INNER JOIN `sub_category` ON category_has_sub_category.sub_category_sub_cat_id = sub_category.sub_cat_id 
                WHERE `users_email` = '" . $email . "'";

                $invoice_rs = Database::search($query);
                $invoice_num = $invoice_rs->num_rows;

                $result_per_page = 5;
                $number_of_pages = ceil($invoice_num / $result_per_page);
                $page_results = ($pageno - 1) * $result_per_page;
                $selected_rs = Database::search($query . " LIMIT " . $result_per_page . " OFFSET " . $page_results);
                $selected_num = $selected_rs->num_rows;
            ?>

                <div class="col-12">
                    <h3 class="text-lg-start">Purchase History</h3>
                    <hr class="border border-1 border-dark" />
                </div>

                <?php
                if ($selected_num == 0) {
                ?>
                    <!-- Empty view -->
                    <div class="col-12 text-center mt-5 mb-5">
                        <p class="fs-4 fw-bold">You have not purchased any items yet...</p>
                        <a href="home.php" class="btn btn-outline-dark fs-5 fw-bold">Start Shopping</a>
                    </div>
                    <!-- End Empty view -->
                    <?php
                } else {
                    for ($x = 0; $x < $selected_num; $x++) {
                        $selected_data = $selected_rs->fetch_assoc();
                    ?>

                        <div class="col-12 col-md-12 col-lg-12 wishlist rounded p-3">
                            <div class="row align-items-center">

                                <!-- Product Image -->
                                <div class="col-4 col-lg-2 col-md-1 col-sm-1">
                                    <?php
                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id` = '" . $selected_data["id"] . "'");
                                    $img_data = $img_rs->fetch_assoc();

                                    if ($img_rs->num_rows > 0) {
                                    ?>
                                        <img class="rounded img-fluid" src="<?php echo $img_data["img_path"]; ?>" />
                                    <?php
                                    } else {
                                    ?>
                                        <img src="" class="img-fluid" alt="No Image Available" />
                                    <?php
                                    }
                                    ?>
                                </div>

                                <!-- Product Details -->
                                <div class="col-8 col-sm-6">
                                    <h6 class="fw-bold"><?php echo $selected_data["title"]; ?></h6>
                                    <p class="text-muted small">Categories: <?php echo $selected_data["sub_cat_name"]; ?>, <?php echo $selected_data["cat_name"]; ?></p>
                                    <p>Quantity: <?php echo $selected_data["invoice_qty"]; ?></p>
                                    <p class="text-secondary small">Invoice ID: <?php echo $selected_data['invoice_id']; ?></p>
                                    <p>Status:
                                        <?php

                                        if ($selected_data["status"] == 0) {

                                        ?>

                                            <span class="confirmOrder">Pending</span>

                                        <?php

                                        } elseif ($selected_data["status"] == 1) {
                                        ?>

                                            <span class="packing">Packing</span>

                                        <?php
                                        } elseif ($selected_data["status"] == 2) {
                                        ?>

                                            <span class="dispatched">Dispatched</span>

                                        <?php
                                        } elseif ($selected_data["status"] == 3) {
                                        ?>

                                            <span class="shipping">Shipped</span>

                                        <?php
                                        } elseif ($selected_data["status"] == 4) {
                                        ?>

                                            <span class="delivered">Delivered Successfully <i class="bi bi-check-circle-fill text-success"></i></span>

                                        <?php
                                        }

                                        ?>
                                    </p>
                                </div>

                                <!-- Price -->
                                <div class="col-12 col-sm-3 text-sm-end">
                                    <p class="price fs-5 fw-bold">Rs.<?php echo $selected_data["total"]; ?>.00</p>
                                </div>

                            </div>
                        </div>
                        <hr />
            <?php
                    }
                }
            } else {
                header("Location: sign-in.php");
            }
            ?>

        </div>
    </div>

    <?php

    if ($selected_data !== 0) {
    ?>

        <!-- Pagination -->
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
        <!-- End Pagination -->

    <?php
    }

    ?>



    <?php include "footer.php"; ?>

    <script src="js/script.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>