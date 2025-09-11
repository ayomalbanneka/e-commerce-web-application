<?php

include "../connection.php";

$title = $_POST["title"];
$dic = $_POST["dic"];
$doc = $_POST["doc"];
$qty = $_POST["qty"];
$pid = $_POST["pid"];

Database::iud("UPDATE `products` SET `title` = '" . $title . "' , `qty` = '" . $qty . "' , 
`delivery_fee_colombo` = '" . $dic . "' ,`delivery_fee_other` = '" . $doc . "' WHERE `id` = '" . $pid . "' ");

if (isset($_POST['sizes'])) {
    $sizes = json_decode($_POST['sizes'], true);
    $colors = json_decode($_POST['colors'], true);

    // Remove existing sizes and colors
    Database::iud("DELETE FROM products_has_sizes WHERE products_id='$pid'");
    Database::iud("DELETE FROM products_has_colors WHERE products_id='$pid'");

    // Insert new sizes
    foreach ($sizes as $sizeId) {
        Database::iud("INSERT INTO products_has_sizes (products_id, sizes_sizes_id) VALUES ('$pid', '$sizeId')");
    }

    // Insert new colors
    foreach ($colors as $colorId) {
        Database::iud("INSERT INTO products_has_colors (products_id, color_color_id) VALUES ('$pid', '$colorId')");
    }
}


$length = sizeof($_FILES);

if ($length <= 3 && $length > 0) {

    $allowed_img_extension = array("image/jpeg", "image/png", "image/svg+xml");

    // Delete existing images
    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id` = '$pid'");
    while ($img_data = $img_rs->fetch_assoc()) {
        $absolute_path = $_SERVER['DOCUMENT_ROOT'] . "/shop/" . $img_data["img_path"];
        if (file_exists($absolute_path)) {
            unlink($absolute_path);
        }
    }
    Database::iud("DELETE FROM `product_img` WHERE `products_id` = '$pid'");

    // Upload new images (if provided)
    if ($length > 0 && $length <= 3) {
        $allowed_img_extension = ["image/jpeg", "image/png", "image/svg+xml"];

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["i" . $x])) {
                $image_file = $_FILES["i" . $x];
                $file_extension = $image_file["type"];

                if (in_array($file_extension, $allowed_img_extension)) {
                    $ext = strtolower(pathinfo($image_file["name"], PATHINFO_EXTENSION));
                    $new_file_name = $title . "_" . uniqid() . "." . $ext;

                    $server_path = $_SERVER['DOCUMENT_ROOT'] . "/shop/img/product_images/" . $new_file_name;
                    $web_path = "img/product_images/" . $new_file_name;

                    move_uploaded_file($image_file["tmp_name"], $server_path);

                    Database::iud("INSERT INTO `product_img` (`img_path`,`products_id`) 
                               VALUES ('$web_path','$pid')");
                } else {
                    echo "Invalid Image Type";
                    exit;
                }
            }
        }
    }

    // echo ("success");
} else {
    echo ("Invalid Image Count");
}

echo ("Product has been updated!");
