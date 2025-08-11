<?php 

include "../connection.php";

include "../mail/SMTP.php";
include "../mail/PHPMailer.php";
include "../mail/Exception.php";

require_once "../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();


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

        Database::iud("UPDATE `users` SET `e_vcode` = '" . $code . "' WHERE `email` = '" . $email . "' ");

        // Email Code 

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['G_EMAIL']; // Sender's email
        $mail->Password = $_ENV['G_APP_PASSWORD'];; //App Password
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
        $mail->Subject = 'UrbanElagance Email Verification code'; // Subject of the email
        $bodyContent = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Helvetica Neue, Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .email-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .email-header img {
            max-height: 40px;
        }
        
        .email-content {
            padding: 30px;
        }
        
        h1 {
            font-size: 24px;
            margin-top: 0;
            color: #000;
            text-align: center;
        }
        
        .verification-code {
            background: #f8f8f8;
            border: 1px dashed #d1d1d1;
            padding: 15px;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 25px 0;
            color: #d32f2f; /* Red color for the code */
        }
        
        .instructions {
            margin-bottom: 25px;
            color: #555;
        }
        
        .note {
            font-size: 14px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 15px;
            margin-top: 25px;
        }
        
        .footer {
            background: #f9f9f9;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }
        
        .footer a {
            color: #d32f2f; /* Red color for links */
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
            <h1>Email Verification</h1>
            
            <p class="instructions">We received a request to reset your password. Please use the following verification code to proceed:</p>
            
            <div class="verification-code">' . $code . '</div>
            
            <p class="note">For security reasons, do not share this code with anyone. Our team will never ask for your verification code.</p>
        </div>
        
        <div class="footer">
            <p>&copy; ' . date('Y') . ' UrbanElagance. All rights reserved.</p>
            <p><a href="http://localhost/shop/contact-us.php">Contact Support</a> | <a href="#">Privacy Policy</a></p>
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


?>