<?php

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$msg = $_POST["msg"];
$subject = $_POST["subject"];

include "mail/SMTP.php";
include "mail/PHPMailer.php";
include "mail/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (empty($fname)) {
    echo ("Please enter your first name!");
} elseif (strlen($fname) > 50) {
    echo ("First name must contain LESS THAN 50 characters!");
} else if (empty($lname)) {
    echo ("Please enter your last name!");
} elseif (strlen($lname) > 50) {
    echo ("Last name must contain LESS THAN 50 characters!");
} else if (empty($email)) {
    echo ("Please enter your email address");
} elseif (strlen($email) > 100) {
    echo ("Email address must contain LESS THAN 100 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Please enter a valid email address!");
} elseif (empty($subject)) {
    echo("Please enter the reason");
} elseif (empty($msg)) {
    echo("Please enter your message");
} else {
    // email code
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ayomalkaushalya@gmail.com';   // SMTP email for sending
    $mail->Password = 'bsrvoockjpmvivoe';          // SMTP email password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Set sender's email dynamically and authenticate with a fixed SMTP email
    $mail->setFrom($email, $fname . ' ' . $lname);
    $mail->addReplyTo($email);
    $mail->addAddress('ayomalkaushalya@gmail.com');  // Your email as the fixed recipient
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $bodyContent = $msg;
    $mail->Body = $bodyContent;

    if (!$mail->send()) {
        echo ("Your mail sending failed. Please try again");
    } else {
        echo("success");
    }
}
