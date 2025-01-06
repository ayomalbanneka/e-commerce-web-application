<?php

session_start();

include "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {

        $user_email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];
        $pqty = $_GET["qty"];

        $user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $user_email . "' ");
        $user_data = $user_rs->fetch_assoc();

        if ($user_data['status_status_id'] == 4) {

            $cart_rs = Database::search("SELECT * FROM `cart` WHERE 
            `cart_users_email` = '" . $user_email . "' AND `cart_products_id` = '" . $pid . "'");

            $cart_num = $cart_rs->num_rows;

            if ($cart_num == 1) {

                $cart_data = $cart_rs->fetch_assoc();
                $current_qty = $cart_data["cart_qty"];
                $new_qty = (int)$current_qty + 1;

                if ($pqty >= $new_qty) {
                    Database::iud("UPDATE `cart` SET `cart_qty` = '" . $new_qty . "' WHERE 
                `cart_users_email` = '" . $user_email . "' AND `cart_products_id` = '" . $pid . "'");

                    echo ("Cart Updated");
                } else {
                    echo ("Invalid Quantity");
                }
            } else {
                Database::iud("INSERT INTO `cart`(`cart_qty`,`cart_users_email`,`cart_products_id`) 
            VALUES ('1','" . $user_email . "','" . $pid . "') ");

                echo ("Product added to the cart");
            }
        }else{
            echo "Please verify your email address";
        }
    } else {
        echo ("Something went wrong");
    }
} else {
    echo ("Please login to your account");
}
