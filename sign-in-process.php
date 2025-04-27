<?php
session_start();
include "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];
$rememberMe = $_POST["rememberMe"];

if (empty($email)) {
    echo "Please enter your email address";
} elseif (strlen($email) > 100) {
    echo "Email address must contain fewer than 100 characters";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address";
} elseif (empty($password)) {
    echo "Please enter your password";
} elseif (strlen($password) < 5 || strlen($password) > 20) {
    echo "Password must contain between 5 to 20 characters!";
} else {
    // Check for the user with the given email
    $rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");

    if ($rs->num_rows == 1) {
        $user_data = $rs->fetch_assoc();

        // Verify the encrypted password using password_verify()
        if (password_verify($password, $user_data['password'])) {
            // Check the status of the user
            if ($user_data['status_status_id'] == '3' || $user_data['status_status_id'] == '4') {
                echo "success";
                $_SESSION["u"] = $user_data;

                if ($rememberMe == "true") {
                    setcookie("email", $email, time() + (60 * 60 * 24 * 365), "/");
                    setcookie("password", $user_data['password'], time() + (60 * 60 * 24 * 365), "/");
                }
                
            } else {
                echo "Account is inactive or restricted";
            }
        } else {
            echo "Invalid email address or password";
        }
    } else {
        echo "Invalid email address or password";
    }
}
?>
