<?php 

include "../connection.php";

$otp = $_POST['otp'];
$email = $_POST['email'];

if(empty($otp)) {
    echo "Please enter your verification code!";
} else {
    $user_rs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "' AND `l_vcode` = '" . $otp . "'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {
        echo "success";
    } else {
        echo "Invalid Verification Code!";
    }

}

?>