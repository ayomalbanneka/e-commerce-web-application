<?php

session_start();
include "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];
$rememberMe = $_POST["adminRememberMe"];

if (empty($email)) {
    echo "Please enter your email address";
} elseif (!strlen($email) > 100) {
    echo ("Email address must contain LOWER THAN 100 characters");
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid email address");
} elseif (empty($password)) {
    echo "Please enter your password";
} elseif (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password must contain between 5 to 20 characters!");
} else {

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "' AND `password` = '" . $password . "' ");

    $admin_num = $admin_rs->num_rows;

    if ($admin_num == 1) {


        $admin_data = $admin_rs->fetch_assoc();
        $_SESSION["au"] = $admin_data;
        echo ("success");

        if ($rememberMe == "true") {
            setcookie("email", $email, time() + (60 * 60 * 24 * 365));
            setcookie("password", $password, time() + (60 * 60 * 24 * 365));
        }
    } else {
        echo ("Invalid email address or password");
    }
}
