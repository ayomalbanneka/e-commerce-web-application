<?php
session_start();
include "../connection.php";

include "../mail/SMTP.php";
include "../mail/PHPMailer.php";
include "../mail/Exception.php";

require_once "../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST["email"];
$password = $_POST["password"];
$rememberMe = $_POST["adminRememberMe"];

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
    $rs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "'");

    if ($rs->num_rows == 1) {

        $user_data = $rs->fetch_assoc();

        // Verify the encrypted password using password_verify()
        if (password_verify($password, $user_data['password'])) {
            // Check the status of the user

            // echo "success";
            $_SESSION["au"] = $user_data;

            if ($rememberMe == "true") {
                setcookie("email", $email, time() + (60 * 60 * 24 * 365));
                setcookie("password", $password, time() + (60 * 60 * 24 * 365));
            }
        } else {
            echo "Invalid email address or password";
        }


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

        Database::iud("UPDATE `admin` SET `l_vcode` = '" . $code . "' WHERE `email` = '" . $email . "' ");

        // Email Code 

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['G_EMAIL']; // Sender's email
        $mail->Password = $_ENV['G_APP_PASSWORD']; //App Password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('ayomalkaushalya@gmail.com', 'Verification Code'); // Sender's Email, Sender's Email
        $mail->addReplyTo('ayomalkaushalya@gmail.com', 'Verification Code'); // Sender's Email, Sender's Email
        $mail->addAddress($email); //Receiver's Email 
        $mail->addEmbeddedImage('../img/email_img.png', 'logo_img');
        // $mail->addEmbeddedImage('img/social_icons/facebook.ico', 'fb_img');
        // $mail->addEmbeddedImage('img/social_icons/instagram.ico', 'insta_img');
        // $mail->addEmbeddedImage('img/social_icons/linkedin.ico', 'link_img');
        // $mail->addEmbeddedImage('img/social_icons/twitter.ico', 'twit_img');
        $mail->isHTML(true);
        // $mail->AddEmbeddedImage('logo.jpg', 'logoimg', 'img/Slight 555 (1).png'); // attach file logo.jpg, and later link to it using identfier logoimg
        $mail->Subject = 'UrbanElagance Admin Login Code'; // Subject of the email
        $bodyContent = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Verification</title>
    <style>
        body {
            font-family: Segoe UI, Roboto, Helvetica, Arial, sans-serif;
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
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            border: 1px solid #333;
        }
        
        .email-header {
            padding: 30px;
            text-align: center;
            background: #000;
            border-bottom: 1px solid #333;
        }
        
        .email-header img {
            max-height: 50px;
            filter: brightness(0) invert(1);
        }
        
        .email-content {
            padding: 30px;
        }
        
        h1 {
            font-size: 22px;
            margin-top: 0;
            color: #fff;
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .admin-badge {
            display: inline-block;
            background: #d32f2f;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .verification-code {
            background: #2a2a2a;
            border: 1px solid #444;
            padding: 20px;
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
            margin-bottom: 20px;
            color: #bbb;
            font-size: 15px;
        }
        
        .security-note {
            background: #2a1e1e;
            border-left: 4px solid #ff4444;
            padding: 15px;
            margin: 25px 0;
            font-size: 14px;
            color: #ddd;
        }
        
        .admin-alert {
            background: #2a1e1e;
            border: 1px solid #ff4444;
            padding: 15px;
            margin: 25px 0;
            font-size: 14px;
            color: #ff4444;
            text-align: center;
            border-radius: 4px;
            font-weight: 500;
        }
        
        .button {
            display: block;
            width: 200px;
            background: #ff4444;
            color: white !important;
            padding: 12px 0;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            margin: 25px auto;
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
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="cid:logo_img" alt="UrbanElagance Admin Logo">
        </div>
        
        <div class="email-content">
            <div style="text-align: center;">
                <span class="admin-badge">ADMIN PORTAL</span>
            </div>
            
            <h1>Admin Login Verification</h1>
            
            <div class="admin-alert">
                ADMINISTRATOR ACCESS REQUEST DETECTED
            </div>
            
            <p class="instructions">A login attempt was made to the UrbanElagance Admin Portal. Please use the following verification code to complete authentication:</p>
            
            <div class="verification-code">' . $code . '</div>
            
            <p class="instructions">This security code will expire in <strong>15 minutes</strong>. If you didnt request this access, please secure your account immediately.</p>
            
            <div class="security-note">
                <strong>Critical Security Notice:</strong> This code provides access to sensitive administrative controls. Never share it with anyone, including colleagues.
            </div>
            
            <a href="http://localhost/shop/admin-login.php" class="button">Continue to Admin Portal</a>
        </div>
        
        <div class="footer">
            <p>If you believe this login attempt is unauthorized, please <a href="#">contact security</a> immediately.</p>
            <p>&copy; ' . date('Y') . ' UrbanElagance Admin. All rights reserved.</p>
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
        echo "Invalid email address or password";
    }
}
