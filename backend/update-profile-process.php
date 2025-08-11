<?php

session_start();

include "../connection.php";

$email = $_SESSION["u"]["email"];

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$mobile = $_POST["mobile"];
$line1 = $_POST["line1"];
$line2 = $_POST["line2"];
$city = $_POST["city"];
$pcode = $_POST["pcode"];

$user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");

if ($user_rs->num_rows == 1) {
    Database::iud("UPDATE `users` SET `fname` = '" . $fname . "',`lname` = '" . $lname . "', `mobile` = '" . $mobile . "' WHERE `email`= '" . $email . "' ");

    $address_rs = Database::search("SELECT * FROM `users_has_address` WHERE `users_email` = '" . $email . "'");

    if ($address_rs->num_rows == 1) {

        // update

        Database::iud("UPDATE `users_has_address` SET `city_city_id` = '" . $city . "' ,
        `line1` = '" . $line1 . "', `line2` = '" . $line2 . "', `postal_code` = '" . $pcode . "' 
        WHERE `users_email` = '" . $email . "' ");
    } else {

        //Insert

        Database::iud("INSERT INTO `users_has_address` 
        (`users_email`,`city_city_id`,`line1`,`line2`,`postal_code`) VALUES
        ('" . $email . "','" . $city . "','" . $line1 . "','" . $line2 . "','" . $pcode . "') ");
    }

    if (sizeof($_FILES) == 1) {
        // image upload

        $image = $_FILES["profileimage"];
        $image_extension = $image["type"];

        $allowed_image_extension = array("image/jpeg", "image/png", "image/svg+xml");

        if (in_array($image_extension, $allowed_image_extension)) {

            $new_extension;

            if ($image_extension == "image/jpeg") {
                $new_extension = ".jpeg";
            } elseif ($image_extension == "image/png") {
                $new_extension = ".png";
            } elseif ($image_extension == "image/svg+xml") {
                $new_extension = ".svg";
            }

            // $file_name = "img//profile_images//" . $fname . "_" . uniqid() . $new_extension;

            // Extract file extension
            
            $ext = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
            $new_file_name = $fname . "_" . uniqid() . "." . $ext;

            // Absolute server path (real disk location)
            $server_path = $_SERVER['DOCUMENT_ROOT'] . "/shop/img/profile_images/" . $new_file_name;

            // Relative web path (for browser & DB)
            $web_path = "img/profile_images/" . $new_file_name;

            move_uploaded_file($image["tmp_name"], $server_path);

            $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email` = '" . $email . "'");

            if ($image_rs->num_rows == 1) {
                Database::iud("UPDATE `profile_img` SET `img_path` = '" . $web_path . "' WHERE `users_email` = '" . $email . "' ");
                echo ("Updated");
            } else {
                Database::iud("INSERT INTO `profile_img` (`img_path`,`users_email`) VALUES
                ('" . $web_path . "','" . $email . "')");
                echo ("Saved");
            }
        }
    } elseif (sizeof($_FILES) == 0) {
        echo ("You have not selected any profile image");
    } else {
        echo ("You can upload only 1 file");
    }
} else {
    echo ("Invalid User!");
}
