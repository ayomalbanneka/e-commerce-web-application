<?php

session_start();
include "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {
        $email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];

        $user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "' ");
        $user_data = $user_rs->fetch_assoc();

        if ($user_data['status_status_id'] == 4) {
            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE 
            `users_email` = '" . $email . "' AND `products_id` = '" . $pid . "'");

            $watchlist_num = $watchlist_rs->num_rows;

            if ($watchlist_num == 1) {

                $watchlist_data = $watchlist_rs->fetch_assoc();
                $watchlist_id = $watchlist_data["w_id"];

                Database::iud("DELETE FROM `watchlist` WHERE `w_id` = '" . $watchlist_id . "'");
                echo ("removed");
            } else {
                Database::iud("INSERT INTO `watchlist`(`users_email`,`products_id`) 
            VALUES('" . $email . "','" . $pid . "')");
                echo ("Added");
            }
        } else {
            echo "Please verify your email address";
            
        }
    } else {
        echo ("Something went wrong. Try again");
    }
} else {
    echo ("Please log in to your account");
}
