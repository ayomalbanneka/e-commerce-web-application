<?php
session_start();
include "../connection.php";

$email = $_SESSION['u']['email'];
$o_id = $_POST['o'];
$amount = $_POST['a'];

// Get the selected sizes JSON
$items = json_decode($_POST['items'], true); // array of sizes and colors corresponding to each cart item
$status = "1";
// Date Time settings
$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s"); // corrected format

$cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_users_email` = '" . $email . "'");
$cart_num = $cart_rs->num_rows;

for ($x = 0; $x < $cart_num; $x++) {
    $cart_data = $cart_rs->fetch_assoc();

    $productId = $cart_data['cart_products_id'];
    $matchedItem = null;

    foreach ($items as $item) {
        if ($item['productId'] == $productId) {
            $matchedItem = $item;
            break;
        }
    }

    $size = $matchedItem ? $matchedItem['size'] : '';
    $color = $matchedItem ? $matchedItem['color'] : '';

    Database::iud("INSERT INTO `invoice` 
        (`order_id`, `date`, `total`, `invoice_qty`, `status`, `size`, `color`,`users_email`, `products_id`) 
        VALUES (
            '" . $o_id . "',
            '" . $date . "',
            '" . $amount . "',
            '" . $cart_data['cart_qty'] . "',
            '" . $status . "',
            '" . $size . "',
            '" . $color . "',
            '" . $email . "',
            '" . $cart_data['cart_products_id'] . "'
        )
    ");

    // Update product quantity
    $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $cart_data['cart_products_id'] . "'");
    $product_data = $product_rs->fetch_assoc();

    $old_qty = $product_data['qty'];
    $sold_qty = $cart_data['cart_qty'];
    $new_qty = $old_qty - $sold_qty;

    Database::iud("UPDATE `products` SET `qty` = '" . $new_qty . "' WHERE `id` = '" . $cart_data['cart_products_id'] . "'");
}

// Clear the cart after purchase
Database::iud("DELETE FROM `cart` WHERE `cart_users_email` = '" . $email . "'");

echo "success";
