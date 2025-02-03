<?php
session_start();
include "connection.php";

if (isset($_SESSION["au"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Orders Management | UrbanElegance</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/admin-panel.css">
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />
    </head>

    <body>

        <div class="container2">

            <?php include "admin-navigation-panel.php" ?>

            <div class="main">

                <?php include "admin-header.php" ?>

                <div class="container">
                    <h1 class="header">Orders</h1>

                    <!-- Search Form -->
                    <div class="container search-form mt-4">
                        <form class="row col-12 col-lg-12 g-3 col-sm-12 align-items-end">
                            <!-- Invoice ID Input -->
                            <div class="col-md-4">
                                <label class="form-label">Search by Order No:</label>
                                <input type="text" class="form-control" id="order_number" onkeyup="searchInvoice();" placeholder="Enter Order No">
                            </div>
                            <!-- From Date Input -->
                            <div class="col-md-3">
                                <label class="form-label">From Date:</label>
                                <input type="date" class="form-control" id="from">
                            </div>
                            <!-- To Date Input -->
                            <div class="col-md-3">
                                <label class="form-label">To Date:</label>
                                <input type="date" class="form-control" id="to">
                            </div>
                            <!-- Submit Button -->
                            <div class="col-md-2 d-grid">
                                <label class="btn btn-primary" onclick="findOrders();">Find</label>
                            </div>
                        </form>
                    </div>
                    <!-- Search Form -->

                    <table class="table align-middle mb-0 bg-white mb-3" id="view_area">
                        <thead>
                            <tr>
                                <th>Product & Invoice ID</th>
                                <th>Buyer</th>
                                <th>Amount</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <?php

                        $query = "SELECT * FROM `invoice` ORDER BY `date` DESC";
                        $pageno;

                        if (isset($_GET["page"])) {
                            $pageno = $_GET["page"];
                        } else {
                            $pageno = 1;
                        }

                        $invoice_rs = Database::search($query);
                        $invoice_num = $invoice_rs->num_rows;

                        $results_per_page = 10;
                        $number_of_pages = ceil($invoice_num / $results_per_page);

                        $page_results = ($pageno - 1) * $results_per_page;
                        $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results);
                        $selected_num = $selected_rs->num_rows;

                        for ($x = 0; $x < $selected_num; $x++) {

                            $selected_data = $selected_rs->fetch_assoc();

                            $users_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $selected_data["users_email"] . "'");
                            $users_data = $users_rs->fetch_assoc();

                            $product_rs = Database::search("SELECT * FROM `products` 
                            INNER JOIN `sizes` ON products.sizes_sizes_id=sizes.sizes_id 
                             WHERE `id`='" . $selected_data["products_id"] . "'");
                            $product_data = $product_rs->fetch_assoc();

                        ?>

                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="col-3 col-sm-6 col-md-5">
                                                <?php
                                                // Fetch the product image
                                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id` = '" . $product_data["id"] . "'");
                                                $img_num = $img_rs->num_rows;
                                                $img_data = $img_rs->fetch_assoc();

                                                if ($img_num > 0) {
                                                    // Display product image if it exists
                                                ?>

                                                    <img src="<?php echo $img_data["img_path"]; ?>" class="img-fluid rounded col-md-3 d-none d-lg-block" style="width: 130px; height: 150px;" alt="Product Image">

                                                <?php

                                                } else {
                                                    // Display placeholder if no image is available
                                                ?>

                                                    <img src="img/empty.svg" class="img-fluid rounded d-none d-lg-block" style="width: 50px; height: 45px;" alt="Product Image">;

                                                <?php
                                                }
                                                ?>


                                            </div>
                                            <!-- Product Info -->
                                            <div class="col-9 col-sm-10 col-md-11">
                                                <p class="mb-1 col-lg-6 fw-bold text-truncate"><?php echo $product_data["title"]; ?></p>
                                                <p class="text-muted mb-0 text-truncate">Order Number: <?php echo $selected_data["order_id"]; ?></p>
                                            </div>
                                        </div>

                                    </td>



                                    <div class="modal fade" id="spanModal1<?php echo $selected_data['users_email'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <?php
                                                $buyer_rs = Database::search("SELECT * FROM `users_has_address` WHERE `users_email` = '" . $selected_data["users_email"] . "' ");
                                                $buyer_data = $buyer_rs->fetch_assoc();
                                                ?>

                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $users_data['fname'] . " " . $users_data['lname']; ?> - Address Details</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><?php echo $buyer_data['line1']; ?></p>
                                                    <p><?php echo $buyer_data['line2']; ?></p>
                                                    <p><?php echo $buyer_data['postal_code']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <td>
                                        <p class="fw-normal mb-1" onclick="userDetails('<?php echo $selected_data['users_email']; ?>');" style="cursor: pointer;"><?php echo $users_data["fname"] . " " . $users_data["lname"]; ?></p>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1">Rs.<?php echo $selected_data["total"]; ?>.00</p>
                                    </td>

                                    <td>
                                        <P class="fw-normal mb-1"><?php echo $product_data["size"]; ?></P>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"><?php echo $selected_data["invoice_qty"]; ?></p>
                                    </td>
                                    <td>

                                        <?php

                                        if ($selected_data["status"] == 0) {

                                        ?>

                                            <span class="confirmOrder">Confirm Order</span>

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

                                            <span class="shipping">Shipping</span>

                                        <?php
                                        } elseif ($selected_data["status"] == 4) {
                                        ?>

                                            <span class="delivered">Confirmed <i class="bi bi-check-circle-fill text-success"></i></span>

                                        <?php
                                        }

                                        ?>


                                    </td>

                                    <td>
                                        <?php

                                        if ($selected_data["status"] == 0) {
                                        ?>

                                            <button class="btn btn-outline-danger border border-2 btn-sm btn-rounded" id="confirm" onclick="orderStatus(0, <?php echo $selected_data['invoice_id'] ?>);">
                                                Confirm Order
                                            </button>

                                        <?php
                                        } elseif ($selected_data["status"] == 1) {
                                        ?>

                                            <button class="btn btn-outline-warning border border-2 btn-sm btn-rounded" id="packing" onclick="orderStatus(1, <?php echo $selected_data['invoice_id'] ?>);">
                                                Packing
                                            </button>

                                        <?php
                                        } elseif ($selected_data["status"] == 2) {
                                        ?>

                                            <button class="btn btn-outline-info border border-2 btn-sm btn-rounded" id="dispatched" onclick="orderStatus(2, <?php echo $selected_data['invoice_id'] ?>);">
                                                Dispatched
                                            </button>

                                        <?php
                                        } elseif ($selected_data["status"] == 3) {
                                        ?>

                                            <button class="btn btn-outline-success border border-2 btn-sm btn-rounded" id="shipping" onclick="orderStatus(3, <?php echo $selected_data['invoice_id'] ?>);">
                                                Shipping
                                            </button>

                                        <?php
                                        } elseif ($selected_data["status"] == 4) {
                                        ?>

                                            <button class="btn btn-outline-success border border-2 btn-sm btn-rounded" id="delivered">
                                                Confirmed
                                            </button>

                                        <?php
                                        }

                                        ?>
                                    </td>
                                </tr>

                            </tbody>

                        <?php

                        }


                        ?>


                    </table>

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

        <script src="js/script.js"></script>
        <script src="js/admin-panel.js"></script>
        <script src="js/bootstrap.bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>

    </html>

<?php

} else {
    header("Location:admin-sign-in.php");
}

?>