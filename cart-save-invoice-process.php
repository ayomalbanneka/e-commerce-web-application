<?php

session_start();

include "connection.php";

$email = $_SESSION['u']['email'];
$o_id = $_POST['o'];
$amount = $_POST['a'];

// Date Time settings

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y:m:d H:i:s");

$cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_users_email` = '" . $email . "'");
$cart_num = $cart_rs->num_rows;


for ($x = 0; $x < $cart_num; $x++) {

    $cart_data = $cart_rs->fetch_assoc();

    Database::iud("INSERT INTO `invoice` (`order_id`,`date`,`total`,`invoice_qty`,`status`,`users_email`,`products_id`) 
    VALUES('" . $o_id . "','" . $date . "','" . $amount . "','" . $cart_data['cart_qty'] . "','1','" . $email . "','" . $cart_data['cart_products_id'] . "') ");

    $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $cart_data['cart_products_id'] . "' ");
    $product_data = $product_rs->fetch_assoc();

    $old_qty = $product_data['qty'];
    $sold_qty = $cart_data['cart_qty'];
    $new_qty = $old_qty - $sold_qty;

    Database::iud("UPDATE `products` SET `qty` = '" . $new_qty . "' WHERE `id` = '" . $cart_data['cart_products_id'] . "' ");
    // echo ("Quantity Updated");
    Database::iud("DELETE FROM `cart` WHERE `cart_users_email` = '" . $email . "'");

}

echo("success");

// Database::iud("DELETE * FROM `cart`");
// echo("Cart cleared");