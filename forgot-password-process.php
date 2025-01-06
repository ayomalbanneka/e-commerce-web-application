<?php

include "connection.php";

include "mail/SMTP.php";
include "mail/PHPMailer.php";
include "mail/Exception.php";


use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["email"])) {

    $email = $_GET["email"];

    $user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {
        function generateRandomDigits($length = 6)
        {
            $digits = '';
            for ($i = 0; $i < $length; $i++) {
                $digits .= mt_rand(0, 9); // Append a random digit from 0 to 9
            }
            return $digits;
        }

        // Generate a random string of 6 digits
        $code = generateRandomDigits(6);

        Database::iud("UPDATE `users` SET `vcode` = '" . $code . "' WHERE `email` = '" . $email . "' ");

        // Email Code 

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ayomalkaushalya@gmail.com'; // Sender's email
        $mail->Password = 'bsrvoockjpmvivoe'; //App Password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('ayomalkaushalya@gmail.com', 'Reset Password'); // Sender's Email, Sender's Email
        $mail->addReplyTo('ayomalkaushalya@gmail.com', 'Reset Password'); // Sender's Email, Sender's Email
        $mail->addAddress($email); //Receiver's Email 
        $mail->addEmbeddedImage('img/email_img.png', 'logo_img');
        // $mail->addEmbeddedImage('img/social_icons/facebook.ico', 'fb_img');
        // $mail->addEmbeddedImage('img/social_icons/instagram.ico', 'insta_img');
        // $mail->addEmbeddedImage('img/social_icons/linkedin.ico', 'link_img');
        // $mail->addEmbeddedImage('img/social_icons/twitter.ico', 'twit_img');
        $mail->isHTML(true);
        // $mail->AddEmbeddedImage('logo.jpg', 'logoimg', 'img/Slight 555 (1).png'); // attach file logo.jpg, and later link to it using identfier logoimg
        $mail->Subject = 'UrbanElagance forgot password verification code'; // Subject of the email
        $bodyContent = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            padding-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            color: #fffafa;
        }

        .email-header img {
            max-width: 150px;
        }

        .email-body {
            text-align: center;
            padding: 20px;
        }

        .email-body h2 {
            margin-bottom: 20px;
            color: #333333;
        }

        .email-body p {
            margin-bottom: 30px;
            color: #555555;
        }

        .email-footer {
            text-align: center;
            padding: 20px;
            border-top: 1px solid #e0e0e0;
        }
    </style>
</head>

<body>
    <div class="email-container ">
        <div class="email-header">
            <img src="cid:logo_img" alt="Company Logo">
        </div>
        <div class="email-body">
            <h2>Email Verification</h2>
            <p>Thank you for signing up with us. Please enter the below code with 6 digit to verify your email address.
            </p>
            <h1 href="#">' . $code . '</h1>
        </div>
        <div class="email-footer">
            <p>If you did not sign up for this account, you can safely ignore this email.</p>
        </div>
        
    </div>
</body>

</html>'; // content of the email
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo ("Verification code sending failed!");
        } else {
            echo ("success");
        }
    } else {
        echo ("Invalid Email Address");
    }
} else {
    echo ("Please enter your email address");
}
