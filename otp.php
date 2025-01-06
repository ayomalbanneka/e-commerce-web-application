<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<style>
    *{
        box-sizing: border-box;
    }
</style>

<body class="otp-body">
    <div class="otp-card">
        <h1 class="otp-h1">OTP Verification</h1>
        <p>Code has been send to ayo***********@gmail.com</p>
        <div class="otp-card-inputs">
            <input type="text" id="i" value="1" autofocus>
        </div>
        <p>Didn't get the otp <a href="#">Resend</a></p>
        <button class="btn btn-outline-dark" onclick="verifyOtp();">Verify</button>
    </div>

    <script src="js/script.js"></script>
</body>
</html>