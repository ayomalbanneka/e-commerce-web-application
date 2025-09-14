<?php

session_start();

include "../connection.php";

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];

$user_rs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "'");
if ($user_rs->num_rows == 1) {
    Database::iud("UPDATE `admin` SET `fname` = '" . $fname . "',`lname` = '" . $lname . "', `mobile` = '" . $mobile . "',`email` = '" . $email . "' WHERE `email`= '" . $email . "' ");
    echo "success";
} else {
    echo "error";
}
