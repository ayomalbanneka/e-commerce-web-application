<?php

include "connection.php";

if (isset($_GET["email"])) {

    $mail = $_GET["email"];

    $user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $mail . "' ");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {

        $user_data = $user_rs->fetch_assoc();
        $status = $user_data["status_status_id"];

        if ($status == 4) {
            Database::iud("UPDATE `users` SET `status_status_id`='2' WHERE `email` = '" . $mail . "' ");
            echo ("user has been blocked.");
        } elseif ($status == 2) {
            Database::iud("UPDATE `users` SET `status_status_id`='4' WHERE `email` = '" . $mail . "' ");
            echo ("user has been unblocked.");
        }
    } else {
        echo ("Cannot find the user please try again later.");
    }
} else {
    echo ("Something went wrong!");
}
