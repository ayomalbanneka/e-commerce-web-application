<?php

include "connection.php";

if (isset($_GET["f"]) && isset($_GET["t"])) {

    $from = $_GET["f"];
    $to = $_GET["t"];

    $query = "SELECT * FROM `invoice`";

    $invocie_rs = Database::search($query);
    $invocie_num = $invocie_rs->num_rows;

    for ($x = 0; $x < $invocie_num; $x++) {

        $invoice_data = $invocie_rs->fetch_assoc();

        $sold_date = $invoice_data["date"];
        $date = explode(" ", $sold_date);

        $d = $date[0];
        $t = $date[1];

        $product_rs = Database::search("SELECT * FROM `products`
        INNER JOIN `sizes` ON products.sizes_sizes_id=sizes.sizes_id
        WHERE `id` = '" . $invoice_data["products_id"] . "' ");
        $product_data = $product_rs->fetch_assoc();

        $user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $invoice_data["users_email"] . "'");
        $users_data = $user_rs->fetch_assoc();

        if (!empty($from) && empty($to)) {
            if ($from <= $d) {

?>

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
                                <p class="mb-1 fw-bold text-truncate"><?php echo $product_data["title"]; ?></p>
                                <p class="text-muted mb-0 text-truncate">Invoide ID: <?php echo $invoice_data["invoice_id"]; ?></p>
                            </div>
                        </div>

                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?php echo $users_data["fname"] . " " . $users_data["lname"]; ?></p>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">Rs.<?php echo $invoice_data["total"]; ?>.00</p>
                    </td>

                    <td>
                        <P class="fw-normal mb-1"><?php echo $product_data["size"]; ?></P>
                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?php echo $invoice_data["invoice_qty"]; ?></p>
                    </td>
                    <td>

                        <?php

                        if ($invoice_data["status"] == 0) {

                        ?>

                            <span class="confirmOrder">Confirm Order</span>

                        <?php

                        } elseif ($invoice_data["status"] == 1) {
                        ?>

                            <span class="packing">Packing</span>

                        <?php
                        } elseif ($invoice_data["status"] == 2) {
                        ?>

                            <span class="dispatched">Dispatched</span>

                        <?php
                        } elseif ($invoice_data["status"] == 3) {
                        ?>

                            <span class="shipping">Shipping</span>

                        <?php
                        } elseif ($invoice_data["status"] == 4) {
                        ?>

                            <span class="delivered">Delivered</span>

                        <?php
                        }

                        ?>


                    </td>

                    <td>
                        <?php

                        if ($invoice_data["status"] == 0) {
                        ?>

                            <button class="btn btn-outline-danger border border-2 btn-sm btn-rounded">
                                Confirm Order
                            </button>

                        <?php
                        } elseif ($invoice_data["status"] == 1) {
                        ?>

                            <button class="btn btn-outline-warning border border-2 btn-sm btn-rounded">
                                Packing
                            </button>

                        <?php
                        } elseif ($invoice_data["status"] == 2) {
                        ?>

                            <button class="btn btn-outline-info border border-2 btn-sm btn-rounded">
                                Dispatched
                            </button>

                        <?php
                        } elseif ($invoice_data["status"] == 3) {
                        ?>

                            <button class="btn btn-outline-primary border border-2 btn-sm btn-rounded">
                                Shipping
                            </button>

                        <?php
                        } elseif ($invoice_data["status"] == 4) {
                        ?>

                            <button class="btn btn-outline-success border border-2 btn-sm btn-rounded">
                                Delivered
                            </button>

                        <?php
                        }

                        ?>
                    </td>
                </tr>

            <?php

            }
        } elseif (empty($from) && !empty($to)) {

            if ($to >= $d) {
            ?>

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
                                <p class="mb-1 fw-bold text-truncate"><?php echo $product_data["title"]; ?></p>
                                <p class="text-muted mb-0 text-truncate"><?php echo $invoice_data["invoice_id"]; ?></p>
                            </div>
                        </div>

                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?php echo $users_data["fname"] . " " . $users_data["lname"]; ?></p>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">Rs.<?php echo $invoice_data["total"]; ?>.00</p>
                    </td>

                    <td>
                        <P class="fw-normal mb-1"><?php echo $product_data["size"]; ?></P>
                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?php echo $invoice_data["invoice_qty"]; ?></p>
                    </td>
                    <td>

                        <?php

                        if ($invoice_data["status"] == 0) {

                        ?>

                            <span class="confirmOrder">Confirm Order</span>

                        <?php

                        } elseif ($invoice_data["status"] == 1) {
                        ?>

                            <span class="packing">Packing</span>

                        <?php
                        } elseif ($invoice_data["status"] == 2) {
                        ?>

                            <span class="dispatched">Dispatched</span>

                        <?php
                        } elseif ($invoice_data["status"] == 3) {
                        ?>

                            <span class="shipping">Shipping</span>

                        <?php
                        } elseif ($invoice_data["status"] == 4) {
                        ?>

                            <span class="delivered">Delivered</span>

                        <?php
                        }

                        ?>


                    </td>

                    <td>
                        <?php

                        if ($invoice_data["status"] == 0) {
                        ?>

                            <button class="btn btn-outline-danger border border-2 btn-sm btn-rounded">
                                Confirm Order
                            </button>

                        <?php
                        } elseif ($invoice_data["status"] == 1) {
                        ?>

                            <button class="btn btn-outline-warning border border-2 btn-sm btn-rounded">
                                Packing
                            </button>

                        <?php
                        } elseif ($invoice_data["status"] == 2) {
                        ?>

                            <button class="btn btn-outline-info border border-2 btn-sm btn-rounded">
                                Dispatched
                            </button>

                        <?php
                        } elseif ($invoice_data["status"] == 3) {
                        ?>

                            <button class="btn btn-outline-primary border border-2 btn-sm btn-rounded">
                                Shipping
                            </button>

                        <?php
                        } elseif ($invoice_data["status"] == 4) {
                        ?>

                            <button class="btn btn-outline-success border border-2 btn-sm btn-rounded">
                                Delivered
                            </button>

                        <?php
                        }

                        ?>
                    </td>
                </tr>

            <?php
            }
        } elseif (!empty($from) && !empty($to)) {
            ?>

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
                            <p class="mb-1 fw-bold text-truncate"><?php echo $product_data["title"]; ?></p>
                            <p class="text-muted mb-0 text-truncate">Invoide ID: <?php echo $invoice_data["invoice_id"]; ?></p>
                        </div>
                    </div>

                </td>
                <td>
                    <p class="fw-normal mb-1"><?php echo $users_data["fname"] . " " . $users_data["lname"]; ?></p>
                </td>
                <td>
                    <p class="fw-normal mb-1">Rs.<?php echo $invoice_data["total"]; ?>.00</p>
                </td>

                <td>
                    <P class="fw-normal mb-1"><?php echo $product_data["size"]; ?></P>
                </td>
                <td>
                    <p class="fw-normal mb-1"><?php echo $invoice_data["invoice_qty"]; ?></p>
                </td>
                <td>

                    <?php

                    if ($invoice_data["status"] == 0) {

                    ?>

                        <span class="confirmOrder">Confirm Order</span>

                    <?php

                    } elseif ($invoice_data["status"] == 1) {
                    ?>

                        <span class="packing">Packing</span>

                    <?php
                    } elseif ($invoice_data["status"] == 2) {
                    ?>

                        <span class="dispatched">Dispatched</span>

                    <?php
                    } elseif ($invoice_data["status"] == 3) {
                    ?>

                        <span class="shipping">Shipping</span>

                    <?php
                    } elseif ($invoice_data["status"] == 4) {
                    ?>

                        <span class="delivered">Delivered</span>

                    <?php
                    }

                    ?>


                </td>

                <td>
                    <?php

                    if ($invoice_data["status"] == 0) {
                    ?>

                        <button class="btn btn-outline-danger border border-2 btn-sm btn-rounded">
                            Confirm Order
                        </button>

                    <?php
                    } elseif ($invoice_data["status"] == 1) {
                    ?>

                        <button class="btn btn-outline-warning border border-2 btn-sm btn-rounded">
                            Packing
                        </button>

                    <?php
                    } elseif ($invoice_data["status"] == 2) {
                    ?>

                        <button class="btn btn-outline-info border border-2 btn-sm btn-rounded">
                            Dispatched
                        </button>

                    <?php
                    } elseif ($invoice_data["status"] == 3) {
                    ?>

                        <button class="btn btn-outline-primary border border-2 btn-sm btn-rounded">
                            Shipping
                        </button>

                    <?php
                    } elseif ($invoice_data["status"] == 4) {
                    ?>

                        <button class="btn btn-outline-success border border-2 btn-sm btn-rounded">
                            Delivered
                        </button>

                    <?php
                    }

                    ?>
                </td>
            </tr>

<?php
        }else{
            ?>
            
            <?php
        }
    }
}
