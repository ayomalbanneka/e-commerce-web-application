<?php

session_start();

include "connection.php";

if (isset($_SESSION["u"])) {

    $order_id = $_POST["o"];
    $pid = $_POST["i"];
    $mail = $_POST["m"];
    $amount = $_POST["a"];
    $qty = $_POST["q"];

    // echo($order_id);

    $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $pid . "'");
    $product_data = $product_rs->fetch_assoc();

    $current_qty = $product_data["qty"];
    $new_qty = $current_qty - $qty;

    Database::iud("UPDATE `products` SET `qty` = '" . $new_qty . "' WHERE `id` = '" . $pid . "' ");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice` (`order_id`,`date`,`total`,`invoice_qty`,`status`,`products_id`,`users_email`) 
    VALUES('".$order_id."','".$date."','".$amount."','".$qty."','0','".$pid."','".$mail."') ");

    echo("success");

} else {
    echo ("Please login to your account");
}
