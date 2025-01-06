<?php

include "connection.php";

session_start();
$email = $_SESSION["au"]["email"];

$title = $_POST["pn"];
$brand = $_POST["brand"];
$category = $_POST["category"];
$subCategory = $_POST["sub_cat"];
$material = $_POST["material"];
$productGender = $_POST["gender"];
$colors = $_POST["color"];
$sizes = $_POST["size"];
$price = $_POST["price"];
$qty = $_POST["qty"];
$dic = $_POST["dic"];
$doc = $_POST["doc"];

if (empty($title)) {
    echo "Please enter the title";
} elseif ($sizes == 0) {
    echo "Please select a size";
} elseif ($productGender == 0) {
    echo "Please select a gender for the product";
} elseif (empty($price)) {
    echo "Please enter a cost";
} elseif (!is_numeric($price)) {
    echo "Invalid input for cost";
} elseif ($qty <= 0 || !is_numeric($qty)) {
    echo "Invalid input for quantity";
} elseif (empty($dic) || !is_numeric($dic)) {
    echo "Please enter a valid delivery fee for Colombo";
} elseif ($category == 0) {
    echo "Please select a category";
} elseif ($subCategory == 0) {
    echo "Please select a sub category";
} elseif ($material == 0) {
    echo "Please select a material";
} elseif ($colors == 0) {
    echo "Please select a color";
} else {

    // $product_rs = Database::search("SELECT * FROM `products`");
    // $product_num = $product_rs->num_rows;
    // $product_data = $product_rs->fetch_assoc();

    $chsc_rs = Database::search("SELECT * FROM `category_has_sub_category` WHERE
    `category_cat_id` = '" . $category . "' AND `sub_category_sub_cat_id` = '" . $subCategory . "' ");

    $chsc_id;
    // $phc_id;
    // $phs_id;

    if ($chsc_rs->num_rows > 0) {
        $chsc_data = $chsc_rs->fetch_assoc();
        $chsc_id = $chsc_data["category_has_sub_category_id"];
    } else {
        Database::iud("INSERT INTO `category_has_sub_category` (`category_cat_id`,`sub_category_sub_cat_id`) 
        VALUES ('" . $category . "','" . $subCategory . "')");

        $chsc_id = Database::$connection->insert_id;
    }

    // $phc_rs = Database::search("SELECT * FROM `products_has_color` WHERE 
    // `products_has_color_id` = '" . $product_data["id"] . "' AND `color_color_id` = '" . $colors . "' ");

    // if ($phc_rs->num_rows > 0) {
    //     $phc_data = $phc_rs->fetch_assoc();
    //     $phc_id = $phc_data["products_has_color_id"];
    // } else {
    //     Database::iud("INSERT INTO `products_has_color` (`products_has_color_id`,`color_color_id`) 
    //     VALUES ('" . $product_data["id"] . "','" . $colors . "') ");

    //     $phc_id = Database::$connection->insert_id;
    // }

    // $phs_rs = Database::search("SELECT * FROM `products_has_sizes` WHERE 
    // `products_has_sizes_id` = '" . $product_data["id"] . "' AND `sizes_sizes_id` = '" . $size . "'");

    // if ($phs_rs->num_rows > 0) {
    //     $phs_data = $phs_rs->fetch_assoc();
    //     $phs_id = $phs_data["products_has_sizes_id"];
    // } else {
    //     Database::iud("INSERT INTO `products_has_sizes`(`products_has_sizes_id`,`sizes_sizes_id`) 
    //     VALUES ('" . $product_data["id"] . "','" . $size . "')");

    //     $phs_id = Database::$connection->insert_id;
    // }

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Database::iud("INSERT INTO `products` (`title`,`price`,`qty`,`datetime_added`,
    `delivery_fee_colombo`,`delivery_fee_other`,`category_cat_id`,`brand_brand_id`,
    `material_material_id`,`product_collection_id`,`status_status_id`,`color_color_id`,
    `sizes_sizes_id`,`category_has_sub_category_category_has_sub_category_id`,`admin_email`) 
    VALUES('" . $title . "','" . $price . "','" . $qty . "','" . $date . "','" . $dic . "',
    '" . $doc . "','" . $category . "','" . $brand . "','" . $material . "','" . $productGender . "','" . $status . "', 
    '" . $colors . "','" . $sizes . "','" . $chsc_id . "','" . $email . "') ");

    $products_id = Database::$connection->insert_id;
    $length = count($_FILES);

    if ($length <= 3 && $length > 0) {

        $allowed_img_extension = array("image/jpeg", "image/png", "image/svg+xml");

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["image" . $x])) {
                $image_file = $_FILES["image" . $x];
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

                    $file_name = "img//product_images//" . $title . $x . uniqid() . $new_image_extension;
                    move_uploaded_file($image_file["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `product_img` (`img_path`,`products_id`) VALUES
                    ('" . $file_name . "','" . $products_id . "')");
                } else {
                    echo ("Invalid Image Type");
                }
            }
        }

        echo ("success");
    } else {
        echo ("Invalid Image Count");
    }
}
