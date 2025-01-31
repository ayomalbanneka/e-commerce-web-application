<?php

include "connection.php";

if (isset($_GET["on"])) {

    $order_number = $_GET["on"];

    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id` = '" . $order_number . "'");
    $invoice_num = $invoice_rs->num_rows;

    if ($invoice_num > 0) {
?>

        <table class="table align-middle mb-0 bg-white mb-3">
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

            while ($selected_data = $invoice_rs->fetch_assoc()) {

                // Fetch the user data
                $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $selected_data["users_email"] . "'");
                $users_data = $user_rs->fetch_assoc();
                // Fetch the product data
                $product_rs = Database::search("SELECT * FROM `products` INNER JOIN `sizes` ON products.sizes_sizes_id=sizes.sizes_id 
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
                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id` = '" . $selected_data["products_id"] . "'");
                                    $img_num = $img_rs->num_rows;
                                    $img_data = $img_rs->fetch_assoc();

                                    if ($img_num > 0) {
                                        // Display product image if it exists
                                    ?>

                                        <img src="<?php echo $img_data["img_path"]; ?>" class="img-fluid rounded col-md-3" style="width: 130px; height: 150px;" alt="Product Image">

                                    <?php

                                    } else {
                                        // Display placeholder if no image is available
                                    ?>

                                        <img src="img/empty.svg" class="img-fluid rounded" style="width: 50px; height: 45px;" alt="Product Image">;

                                    <?php
                                    }
                                    ?>


                                </div>
                                <!-- Product Info -->
                                <div class="col-9 col-sm-10 col-md-11">
                                    <p class="mb-1 col-lg-6 fw-bold text-truncate"><?php echo $product_data["title"]; ?></p>
                                    <p class="text-muted mb-0 text-truncate">Order No: <?php echo $selected_data["order_id"]; ?></p>
                                </div>
                            </div>

                        </td>
                        <td>
                            <p class="fw-normal mb-1"><?php echo $users_data["fname"] . " " . $users_data["lname"]; ?></p>
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

    <?php
    }

    ?>


<?php

} else {
    echo ("Please add a invoice number first");
}

?>