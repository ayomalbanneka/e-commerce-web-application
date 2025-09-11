<?php

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$msg = $_POST["msg"];
$subject = $_POST["subject"];

include "../mail/SMTP.php";
include "../mail/PHPMailer.php";
include "../mail/Exception.php";

require_once "../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

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
    echo ("Please enter the reason");
} elseif (empty($msg)) {
    echo ("Please enter your message");
} else {
    // email code
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['G_EMAIL'];   // SMTP email for sending
    $mail->Password = $_ENV['G_APP_PASSWORD'];;          // SMTP email password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Set sender's email dynamically and authenticate with a fixed SMTP email
    $mail->setFrom($_ENV['G_EMAIL'], 'UrbanElagance Contact Form');
    $mail->addReplyTo($email, $fname . ' ' . $lname);
    $mail->addAddress('ayomalkaushalya@gmail.com');  // Your email as the fixed recipient
    $mail->addEmbeddedImage('../img/email_img.png', 'logo_img');
    $mail->isHTML(true);
    $mail->Subject = 'New Contact Form: ' . $subject;
    
    // Get current timestamp
    $currentDateTime = date("l, F j, Y \a\\t g:i A");
    
    $bodyContent = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer Contact Message</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 650px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }
        
        .email-header {
            padding: 25px 30px;
            text-align: center;
            background: #000000;
            color: white;
            border-bottom: 4px solid #ff0000;
        }
        
        .email-header img {
            max-height: 50px;
            margin-bottom: 15px;
        }
        
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .email-header p {
            margin: 8px 0 0;
            font-size: 16px;
            opacity: 0.9;
        }
        
        .email-body {
            padding: 30px;
        }
        
        .message-card {
            background: #f9f9f9;
            border-radius: 4px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #ff0000;
        }
        
        .message-card p {
            margin: 0;
            font-size: 16px;
            color: #333;
            line-height: 1.5;
            white-space: pre-wrap;
        }
        
        .customer-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin: 25px 0;
        }
        
        .info-item {
            padding: 12px 15px;
            background: #f9f9f9;
            border-radius: 4px;
            border: 1px solid #eee;
        }
        
        .info-item strong {
            display: block;
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .info-item span {
            font-size: 16px;
            color: #000;
            font-weight: 500;
        }
        
        .priority-tag {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
            background: #ff0000;
            color: #fff;
        }
        
        .action-buttons {
            text-align: center;
            margin: 30px 0 20px;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background: #ff0000;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            margin: 0 10px;
            border: none;
        }
        
        .btn-outline {
            background: transparent;
            color: #ff0000;
            border: 1px solid #ff0000;
        }
        
        .email-footer {
            padding: 20px;
            text-align: center;
            background: #000;
            color: #999;
            font-size: 14px;
            border-top: 1px solid #333;
        }
        
        .email-footer a {
            color: #ff0000;
            text-decoration: none;
        }
        
        .timestamp {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            padding: 8px;
            background: #f9f9f9;
            border-radius: 4px;
        }
        
        .divider {
            height: 1px;
            background: #eee;
            margin: 25px 0;
        }
        
        .subject-line {
            font-size: 18px;
            color: #000;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        @media (max-width: 600px) {
            .customer-info {
                grid-template-columns: 1fr;
            }
            
            .btn {
                display: block;
                margin: 10px auto;
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="cid:logo_img" alt="UrbanElagance Logo">
            <h1>New Customer Message</h1>
            <p>Contact form submission requires your attention</p>
        </div>
        
        <div class="email-body">
            <span class="priority-tag">Action Required</span>
            
            <div class="subject-line">
                <strong>Subject:</strong> ' . htmlspecialchars($subject) . '
            </div>
            
            <div class="message-card">
                <p>' . nl2br(htmlspecialchars($msg)) . '</p>
            </div>
            
            <div class="customer-info">
                <div class="info-item">
                    <strong>Customer Name</strong>
                    <span>' . htmlspecialchars($fname) . ' ' . htmlspecialchars($lname) . '</span>
                </div>
                <div class="info-item">
                    <strong>Email Address</strong>
                    <span>' . htmlspecialchars($email) . '</span>
                </div>
                <div class="info-item">
                    <strong>Submitted On</strong>
                    <span>' . $currentDateTime . '</span>
                </div>
            </div>
            
            <div class="timestamp">
                This message was received via the UrbanElagance website contact form
            </div>
            
            <div class="divider"></div>
            
            <div class="action-buttons">
                <a style="text-decoration:none; color:#fff; font-weight:bold;" href="mailto:' . htmlspecialchars($email) . '?subject=Re: ' . rawurlencode($subject) . '" class="btn">Reply to Customer</a>
            </div>
        </div>
        
        <div class="email-footer">
            <p>This email was generated automatically from the UrbanElagance contact form.</p>
            <p>© ' . date("Y") . ' UrbanElagance Customer Care. All rights reserved.</p>
        </div>
    </div>
</body>
</html>';
    $mail->Body = $bodyContent;

    if (!$mail->send()) {
        echo "Your mail sending failed. Please try again. Error: " . $mail->ErrorInfo;
    } else {
        echo "success";
    }
}