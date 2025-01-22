<?php

include "connection.php";

$email = $_POST["email"];
$newPw = $_POST["np"];
$retypedPw = $_POST["rp"];
$vcode = $_POST["vcode"];

if (empty($newPw)) {
    echo "Please enter your new password!";
} elseif (strlen($newPw) < 5 || strlen($newPw) > 20) {
    echo "New password must contain between 5 to 20 characters!";
} elseif (empty($retypedPw)) {
    echo "Please enter your retyped password!";
} elseif (strlen($retypedPw) < 5 || strlen($retypedPw) > 20) {
    echo "Retyped password must contain between 5 to 20 characters!";
} elseif ($newPw != $retypedPw) {
    echo "The passwords do not match!";
} elseif (empty($vcode)) {
    echo "Please enter your verification code!";
} else {

    $user_rs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {
        // Hash the new password before updating it
        $hashedPassword = password_hash($retypedPw, PASSWORD_DEFAULT);

        Database::iud("UPDATE `admin` SET `password` = '" . $hashedPassword . "' WHERE `email` = '" . $email . "'");
        echo "success";
    } else {
        echo "Invalid Verification Code!";
    }
}
