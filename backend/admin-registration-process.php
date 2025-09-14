<?php

include '../connection.php';

$fname = $_POST['firstName'];
$lname = $_POST['lastName'];
$email = $_POST['email'];
$pwd = $_POST['password'];
$mobile = $_POST['mobile'];
$role = $_POST['role'];

$rs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "' OR `mobile` = '" . $mobile . "'");

$num = $rs->num_rows;

if ($num > 0) {
    echo "User with the same Email Address or Mobile Number already exists!";
} else {

    // Encrypt the password using hash. The password before storing it in the database
    $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `admin` ( `email`,`fname`, `lname`, `password`,`mobile`,`joined_date`,`role`,`status`)
    VALUES ('$email','$fname', '$lname',  '$hashedPassword', '$mobile', '$date', '$role', 'Active')");

    echo "success";
}
