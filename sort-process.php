<?php

session_start();
include "connection.php";


$from = $_POST["from"];
$to = $_POST["to"];
$time = $_POST["time"];
$stock = $_POST["stock"];
$text = $_POST["t"];

$query = "SELECT * FROM `products` WHERE `title` LIKE '%" . $text . "%' AND `status_status_id` = '1'";

if ($stock != "0") {
    if ($stock == "1") {
        $query .= " AND qty > '0'";
    }
}

if (!empty($from)) {
    $query .= " AND `price` >= '" . $from . "'";
}

if (!empty($to)) {
    $query .= " AND `price` <= '" . $to . "'";
}

if (!empty($from) && !empty($to)) {
    $query .= " AND `price` BETWEEN '" . $from . "' AND '" . $to . "'";
}

if ($time != "0" && $stock == "0") {
    if ($time == "1") {
        $query .= " ORDER BY datetime_added DESC";
    } else if ($time == "2") {
        $query .= " ORDER BY datetime_added ASC";
    }
}

if ($stock != "0" && $time != "0") {
    if ($time == "1") {
        $query .= " ORDER BY datetime_added DESC";
    } else if ($time == "2") {
        $query .= " ORDER BY datetime_added ASC";
    }
}



if ($stock == "0" && $time == "0" && !empty($from)) {
    $query .= " AND `price` >= '" . $from . "' ";
} elseif ($stock == "0" && $time == "0" && !empty($to)) {
    $query .= " AND `price` <= '" . $to . "' ";
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
                                                                ?> onclick="sort(<?php echo ($pageno - 1); ?>);" <?php
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
                                                <a class="page-link" onclick="sort(<?php echo ($x); ?>);">
                                                    <?php echo $x; ?>
                                                </a>
                                            </li>

                                        <?php
                                        } else {
                                        ?>

                                            <li class="page-item">
                                                <a class="page-link" onclick="sort(<?php echo ($x); ?>);">
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
                                                                ?> onclick="sort(<?php echo ($pageno + 1); ?>);" <?php
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