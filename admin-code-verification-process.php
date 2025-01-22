<?php

include "connection.php";

$email = $_POST["email"];
$vcode = $_POST["vcode"];

if (empty($vcode)) {
    echo "Please enter your verification code!";
} else {
    $user_rs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "' AND `vcode` = '" . $vcode . "'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {
        echo "success";
    } else {
        echo "Invalid Verification Code!";
    }
}
