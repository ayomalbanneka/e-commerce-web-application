<?php

include "../connection.php";

$title = $_POST["title"];
$dic = $_POST["dic"];
$doc = $_POST["doc"];
$qty = $_POST["qty"];
$pid = $_POST["pid"];

// echo($title);
// echo($dic);
// echo($doc);
// echo($qty);
// echo($pid);

Database::iud("UPDATE `products` SET `title` = '" . $title . "' , `qty` = '" . $qty . "' , 
`delivery_fee_colombo` = '" . $dic . "' ,`delivery_fee_other` = '" . $doc . "' WHERE `id` = '" . $pid . "' ");

echo ("Product has been updated!");

$length = sizeof($_FILES);

if ($length <= 3 && $length > 0) {

    $allowed_img_extension = array("image/jpeg", "image/png", "image/svg+xml");

    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id` = '" . $pid . "'");
    $img_num = $img_rs->num_rows;

    for ($a = 0; $a < $img_num; $a++) {
        $img_data = $img_rs->fetch_assoc();

        unlink($img_data["img_path"]);
        Database::search("DELETE FROM `product_img` WHERE `products_id` = '" . $pid . "'");
    }

    for ($x = 0; $x < $length; $x++) {
        if (isset($_FILES["i" . $x])) {
            $image_file = $_FILES["i" . $x];
            $file_extension = $image_file["type"];

            if (in_array($file_extension, $allowed_img_extension)) {

                $new_image_extension;

                if ($file_extension == "image/jpeg") {
                    $new_image_extension = ".jpeg";
                } elseif ($file_extension == "image/png") {
                    $new_image_extension = ".png";
                } elseif ($file_extension == "image/svg+xml") {
                    $new_image_extension = ".svg";
                }

                // $file_name = "img//product_images//" . $title . $x . uniqid() . $new_image_extension;

                $ext = strtolower(pathinfo($image_file["name"], PATHINFO_EXTENSION));
                $new_file_name = $title . "_" . uniqid() . "." . $ext;

                // Absolute server path (real disk location)
                $server_path = $_SERVER['DOCUMENT_ROOT'] . "/shop/img/product_images/" . $new_file_name;

                // Relative web path (for browser & DB)
                $web_path = "img/product_images/" . $new_file_name;

                move_uploaded_file($image_file["tmp_name"], $server_path);

                Database::iud("INSERT INTO `product_img` (`img_path`,`products_id`) VALUES
                ('" . $web_path . "','" . $pid . "')");
            } else {
                echo ("Invalid Image Type");
            }
        }
    }

    // echo ("success");
} else {
    echo ("Invalid Image Count");
}
