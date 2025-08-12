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
        $mail->addEmbeddedImage('../img/email_img.png', 'logo_img');
        // $mail->addEmbeddedImage('img/social_icons/facebook.ico', 'fb_img');
        // $mail->addEmbeddedImage('img/social_icons/instagram.ico', 'insta_img');
        // $mail->addEmbeddedImage('img/social_icons/linkedin.ico', 'link_img');
        // $mail->addEmbeddedImage('img/social_icons/twitter.ico', 'twit_img');
        $mail->isHTML(true);
        // $mail->AddEmbeddedImage('logo.jpg', 'logoimg', 'img/Slight 555 (1).png'); // attach file logo.jpg, and later link to it using identfier logoimg
        $mail->Subject = 'UrbanElagance Email Verification code'; // Subject of the email
        $bodyContent = 'UrbanElagance Email Verification Code'; // Subject of the email
        $bodyContent = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Helvetica Neue, Arial, sans-serif;
            background-color: #121212;
            margin: 0;
            padding: 0;
            color: #e0e0e0;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #1e1e1e;
            border: 1px solid #333;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        
        .email-header {
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid #333;
            background: #000;
        }
        
        .email-header img {
            max-height: 45px;
            filter: brightness(0) invert(1);
        }
        
        .email-content {
            padding: 30px;
        }
        
        h1 {
            font-size: 24px;
            margin-top: 0;
            color: #fff;
            text-align: center;
            font-weight: 500;
        }
        
        .verification-code {
            background: #2a2a2a;
            border: 1px solid #444;
            padding: 18px;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 3px;
            margin: 30px 0;
            color: #ff4444;
            border-radius: 6px;
            font-family: monospace;
        }
        
        .instructions {
            margin-bottom: 25px;
            color: #bbb;
            font-size: 15px;
            text-align: center;
        }
        
        .security-note {
            background: #2a1e1e;
            border-left: 3px solid #ff4444;
            padding: 15px;
            margin: 30px 0;
            color: #ddd;
            font-size: 14px;
        }
        
        .footer {
            background: #000;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
            border-top: 1px solid #333;
        }
        
        .footer a {
            color: #ff4444;
            text-decoration: none;
            margin: 0 10px;
        }
        
        .expiry-notice {
            color: #ff4444;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
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
            
            <p class="instructions">We received a request to verify your email. Please use the following verification code:</p>
            
            <div class="verification-code">' . $code . '</div>
            
            <p class="expiry-notice">Expires in 30 minutes</p>
            
            <div class="security-note">
                <strong>Security Alert:</strong> Never share this code with anyone. UrbanElagance will never ask you for your verification code.
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; ' . date('Y') . ' UrbanElagance. All rights reserved.</p>
            <p>
                <a href="http://localhost/shop/contact-us.php">Contact Support</a>
                <a href="#">Privacy Policy</a>
            </p>
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