<?php

include "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$password = $_POST["password"];
$gender = $_POST["gender"];
$checkbox = $_POST["tc"];

if (empty($fname)) {
    echo "Please enter your first name!";
} elseif (strlen($fname) > 50) {
    echo "First name must contain less than 50 characters!";
} elseif (empty($lname)) {
    echo "Please enter your last name!";
} elseif (strlen($lname) > 50) {
    echo "Last name must contain less than 50 characters!";
} elseif (empty($email)) {
    echo "Please enter your email address";
} elseif (strlen($email) > 100) {
    echo "Email address must contain less than 100 characters";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Please enter a valid email address!";
} elseif (empty($password)) {
    echo "Please enter the password!";
} elseif (strlen($password) < 5 || strlen($password) > 20) {
    echo "Password must contain between 5 to 20 characters!";
} elseif (empty($mobile)) {
    echo "Please enter your mobile number!";
} elseif (strlen($mobile) != 10) {
    echo "Mobile number must contain 10 characters!";
} elseif (!preg_match("/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/", $mobile)) {
    echo "Invalid mobile number!";
} else {

    $rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "' OR `mobile` = '" . $mobile . "'");

    $num = $rs->num_rows;

    if ($num > 0) {
        echo "User with the same Email Address or Mobile Number already exists!";
    } else {

        if ($checkbox == "true") {
            // Encrypt the password using hash. The password before storing it in the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            Database::iud("INSERT INTO `users`(`fname`, `lname`, `email`, `password`, `mobile`, `joined_date`, `gender_id`, `status_status_id`) 
            VALUES('" . $fname . "','" . $lname . "','" . $email . "','" . $hashedPassword . "','" . $mobile . "','" . $date . "','" . $gender . "','3')");

            echo "success";
        } else {
            echo "Please agree to terms & conditions";
        }
    }
}
?>
