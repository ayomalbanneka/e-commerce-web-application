<?php

include "connection.php";

$code = $_POST["code"];
$email = $_POST["email"];

$user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "' AND `e_vcode` = '" . $code . "' ");

$user_num = $user_rs->num_rows;

if ($user_num == 1) {

    Database::iud("UPDATE `users` SET `status_status_id` = '4' WHERE `email` = '" . $email . "' AND `e_vcode` = '" . $code . "' ");

    echo ("success");
} else {
    echo ("Invalid email address or verification code.");
}
