<?php

include "../connection.php";

session_start();
$email = $_SESSION["au"]["email"];

$title = $_POST["pn"];
$brand = $_POST["brand"];
$category = $_POST["category"];
$subCategory = $_POST["sub_cat"];
$material = $_POST["material"];
$productGender = $_POST["gender"];
$colors = $_POST["color"];
$sizes = $_POST["sid"];
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

    $chsc_rs = Database::search("SELECT * FROM `category_has_sub_category` WHERE
    `category_cat_id` = '" . $category . "' AND `sub_category_sub_cat_id` = '" . $subCategory . "' ");

    $chsc_id;

    if ($chsc_rs->num_rows > 0) {
        $chsc_data = $chsc_rs->fetch_assoc();
        $chsc_id = $chsc_data["category_has_sub_category_id"];
    } else {
        Database::iud("INSERT INTO `category_has_sub_category` (`category_cat_id`,`sub_category_sub_cat_id`) 
        VALUES ('" . $category . "','" . $subCategory . "')");

        $chsc_id = Database::$connection->insert_id;
    }

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Database::iud("INSERT INTO `products` (`title`,`price`,`qty`,`datetime_added`,
    `delivery_fee_colombo`,`delivery_fee_other`,`category_cat_id`,`brand_brand_id`,
    `material_material_id`,`product_collection_id`,`status_status_id`,`category_has_sub_category_category_has_sub_category_id`,`admin_email`) 
    VALUES('" . $title . "','" . $price . "','" . $qty . "','" . $date . "','" . $dic . "',
    '" . $doc . "','" . $category . "','" . $brand . "','" . $material . "','" . $productGender . "','" . $status . "', 
    '" . $chsc_id . "','" . $email . "') ");

    $products_id = Database::$connection->insert_id;


    foreach (explode(',', $sizes) as $size) {
        Database::iud("INSERT INTO `products_has_sizes`(`products_id`,`sizes_sizes_id`) 
        VALUES ('" . $products_id . "','" . $size . "')");
    }

    foreach (explode(',', $colors) as $color) {
        Database::iud("INSERT INTO `products_has_colors` (`products_id`,`color_color_id`) 
        VALUES ('" . $products_id . "','" . $color . "') ");
    }

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

                    // $file_name = "img//product_images//" . $title . $x . uniqid() . $new_image_extension;

                    $ext = strtolower(pathinfo($image_file["name"], PATHINFO_EXTENSION));
                    $new_file_name = $title . "_" . uniqid() . "." . $ext;

                    // Absolute server path (real disk location)
                    $server_path = $_SERVER['DOCUMENT_ROOT'] . "/shop/img/product_images/" . $new_file_name;

                    // Relative web path (for browser & DB)
                    $web_path = "img/product_images/" . $new_file_name;


                    move_uploaded_file($image_file["tmp_name"], $server_path);

                    Database::iud("INSERT INTO `product_img` (`img_path`,`products_id`) VALUES
                    ('" . $web_path . "','" . $products_id . "')");
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
