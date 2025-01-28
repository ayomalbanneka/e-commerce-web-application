<?php

include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watchlist | UrbanElegance</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>

    <?php include "header.php"; ?>

    <div class="container-fluid mt-5 px-3 px-lg-5 anime2">

        <div class="row">

            <?php if (isset($_SESSION["u"])) {
                $email = $_SESSION['u']['email'];

                $pageno;

                if (isset($_GET["page"])) {
                    $pageno = $_GET["page"];
                } else {
                    $pageno = 1;
                }

                $query = "SELECT * FROM `watchlist` 
                          INNER JOIN `products` ON watchlist.products_id=products.id 
                          INNER JOIN `color` ON products.color_color_id=color.color_id 
                          INNER JOIN `users` ON watchlist.users_email=users.email
                          INNER JOIN `category` ON products.category_cat_id=category.cat_id 
                          INNER JOIN `category_has_sub_category` ON products.category_has_sub_category_category_has_sub_category_id=category_has_sub_category.category_has_sub_category_id 
                          INNER JOIN `sub_category` ON category_has_sub_category.sub_category_sub_cat_id=sub_category.sub_cat_id 
                          WHERE watchlist.users_email='" . $email . "'";

                $watchlist_rs = Database::search($query);
                $watchlist_num = $watchlist_rs->num_rows;

                $result_per_page = 5;
                $number_of_pages = ceil($watchlist_num / $result_per_page);
                $page_results = ($pageno - 1) * $result_per_page;
                $selected_rs = Database::search($query . " LIMIT $result_per_page OFFSET $page_results");
                $selected_num = $selected_rs->num_rows;
            ?>

                <div>
                    <h3 class="text-lg-start">Watchlist</h3>
                    <hr class="border border-1 border-dark" />

                    <?php if ($selected_num == 0) { ?>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 text-center emptyView">
                                    <label class="form-label fs-4 fw-bold">You have no items in your Wishlist yet.</label>
                                </div>
                                <div class="col-12 col-lg-4 mx-auto d-grid">
                                    <a href="home.php" class="btn btn-outline-dark fs-5 fw-bold">Start Shopping</a>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="wishlist">
                            <?php for ($x = 0; $x < $selected_num; $x++) {
                                $selected_data = $selected_rs->fetch_assoc();
                                $list_id = $selected_data["w_id"];
                            ?>
                                <div class="row align-items-center mb-3">
                                    <div class="col-4 col-sm-3 col-md-2">
                                        <?php
                                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id` = '" . $selected_data["id"] . "'");
                                        $img_data = $img_rs->fetch_assoc();
                                        ?>
                                        <img class="rounded img-fluid" src="<?php echo $img_data ? $img_data["img_path"] : 'placeholder.png'; ?>" alt="Product Image" />
                                    </div>
                                    <div class="col-8 col-sm-6 col-md-7">
                                        <h6 class="text-truncate"><?php echo $selected_data["title"]; ?></h6>
                                        <p class="text-muted mb-1">Categories: <?php echo $selected_data["sub_cat_name"]; ?>, <?php echo $selected_data["cat_name"]; ?></p>
                                        <p class="mb-1">Color: <?php echo $selected_data["color_name"]; ?></p>
                                        <p class="mb-0">Quantity: <?php echo $selected_data["qty"]; ?></p>
                                    </div>
                                    <div class="col-4 col-sm-2 text-end">
                                        <p class="price mb-0">Rs.<?php echo $selected_data["price"]; ?>.00</p>
                                    </div>
                                    <div class="col-8 col-sm-1 text-end d-flex justify-content-end gap-2">
                                        <button class="btn btn-outline-dark btn-sm" onclick="addToCartFromWatchlist(<?php echo $list_id; ?>)">
                                            <i class="bi bi-cart-plus-fill"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" onclick="removeFromWatchlist(<?php echo $list_id; ?>)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <hr />
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>

            <?php } ?>

        </div>

        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 anime2">
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

    <?php include "footer.php"; ?>

    <script src="js/script.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>