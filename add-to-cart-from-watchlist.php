<?php

session_start();
include "connection.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $email = $_SESSION['u']['email'];

    $watchlis_rs = Database::search("SELECT * FROM `watchlist` WHERE `w_id` = '" . $id . "'");

    $watchlist_num = $watchlis_rs->num_rows;
    $watchlist_data = $watchlis_rs->fetch_assoc();

    if ($watchlist_num == 0) {
        echo ("Something went wrong");
    } else {
        Database::iud("INSERT INTO `cart` (`cart_qty`,`cart_users_email`,`cart_products_id`) VALUES('1','".$email."','".$watchlist_data['products_id']."')");
        echo ("Added to cart successfully");

        Database::iud("DELETE FROM `watchlist` WHERE `w_id` = '" . $id . "'");

    }

}
