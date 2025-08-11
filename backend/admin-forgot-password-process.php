<?php

include "../connection.php";

include "../mail/SMTP.php";
include "../mail/PHPMailer.php";
include "../mail/Exception.php";

require_once "../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["email"])) {

    $email = $_GET["email"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num == 1) {
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

        Database::iud("UPDATE `admin` SET `vcode` = '" . $code . "' WHERE `email` = '" . $email . "' ");

        // Email Code 

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['G_EMAIL']; // Sender's email
        $mail->Password = $_ENV['G_APP_PASSWORD']; //App Password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('ayomalkaushalya@gmail.com', 'Reset Password'); // Sender's Email, Sender's Email
        $mail->addReplyTo('ayomalkaushalya@gmail.com', 'Reset Password'); // Sender's Email, Sender's Email
        $mail->addAddress($email); //Receiver's Email 
        $mail->addEmbeddedImage('../img/email_img.png', 'logo_img');
        // $mail->addEmbeddedImage('img/social_icons/facebook.ico', 'fb_img');
        // $mail->addEmbeddedImage('img/social_icons/instagram.ico', 'insta_img');
        // $mail->addEmbeddedImage('img/social_icons/linkedin.ico', 'link_img');
        // $mail->addEmbeddedImage('img/social_icons/twitter.ico', 'twit_img');
        $mail->isHTML(true);
        // $mail->AddEmbeddedImage('logo.jpg', 'logoimg', 'img/Slight 555 (1).png'); // attach file logo.jpg, and later link to it using identfier logoimg
        $mail->Subject = 'UrbanElagance Forgot Password Verification Code'; // Subject of the email
        $bodyContent = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            color: #333333;
            line-height: 1.5;
        }
        
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .email-header {
            padding: 30px;
            text-align: center;
            background: #ffffff;
            border-bottom: 1px solid #eeeeee;
        }
        
        .email-header img {
            max-height: 50px;
        }
        
        .email-content {
            padding: 30px;
        }
        
        h1 {
            font-size: 22px;
            margin-top: 0;
            color: #222222;
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .verification-code {
            background: #f9f9f9;
            border: 1px solid #eaeaea;
            padding: 20px;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 30px 0;
            color: #d32f2f;
            border-radius: 6px;
            font-family: monospace;
        }
        
        .instructions {
            margin-bottom: 20px;
            color: #555555;
            font-size: 15px;
        }
        
        .security-note {
            background-color: #fff8f8;
            border-left: 4px solid #d32f2f;
            padding: 15px;
            margin: 25px 0;
            font-size: 14px;
            color: #666666;
        }
        
        .button {
            display: block;
            width: 200px;
            background: #d32f2f;
            color: white !important;
            padding: 12px 0;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            margin: 25px auto;
        }
        
        .footer {
            background: #fafafa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999999;
            border-top: 1px solid #eeeeee;
        }
        
        .footer a {
            color: #d32f2f;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="cid:logo_img" alt="UrbanElagance Logo">
        </div>
        
        <div class="email-content">
            <h1>Password Reset Verification</h1>
            
            <p class="instructions">You recently requested to reset your password for your UrbanElagance account. Please use the following verification code to proceed:</p>
            
            <div class="verification-code">' . $code . '</div>
            
            <p class="instructions">Enter this code on the password reset page to verify your identity. This code will expire in 30 minutes.</p>
            
            <div class="security-note">
                <strong>Security tip:</strong> Never share this code with anyone. UrbanElagance will never ask you for your verification code.
            </div>
            
            <a href="http://localhost/shop/admin-forgot-password.php" class="button">Reset Password</a>
        </div>
        
        <div class="footer">
            <p>If you didnt request this password reset, please ignore this email or <a href="#">contact support</a> if you have concerns.</p>
            <p>&copy; ' . date('Y') . ' UrbanElagance. All rights reserved.</p>
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
