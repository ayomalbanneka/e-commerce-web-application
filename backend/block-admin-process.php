
<?php

include "../connection.php";

if (isset($_GET["email"])) {

    $mail = $_GET["email"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $mail . "' ");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num == 1) {

        $admin_data = $admin_rs->fetch_assoc();
        $status = $admin_data["status"];

        if ($status == "Active") {
            Database::iud("UPDATE `admin` SET `status`='Deactive' WHERE `email` = '" . $mail . "' ");
            echo ("user has deactivated.");
        } elseif ($status == "Deactive") {
            Database::iud("UPDATE `admin` SET `status`='Blocked' WHERE `email` = '" . $mail . "' ");
            echo ("user has been blocked.");
        } elseif ($status == "Blocked") {
            Database::iud("UPDATE `admin` SET `status`='Active' WHERE `email` = '" . $mail . "' ");
            echo ("user has been unblocked.");
        } else {
            echo ("Something went wrong!");
        }
    } else {
        echo ("Cannot find the user please try again later.");
    }
} else {
    echo ("Something went wrong!");
}


?>