<?php

include "../connection.php";

if (!isset($_GET["id"])) {
    echo "Invalid product";
    exit;
}

$product_id = $_GET["id"];

$invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `products_id` = '" . $product_id . "'");
if ($invoice_rs->num_rows > 0) {
    echo "Cannot delete a product that already has orders. Deactivate it instead.";
    exit;
}

$img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id` = '" . $product_id . "'");
while ($img_data = $img_rs->fetch_assoc()) {
    $absolute_path = $_SERVER['DOCUMENT_ROOT'] . "/shop/" . $img_data["img_path"];
    if (file_exists($absolute_path)) {
        unlink($absolute_path);
    }
}

Database::iud("DELETE FROM `cart` WHERE `cart_products_id` = '" . $product_id . "'");
Database::iud("DELETE FROM `watchlist` WHERE `products_id` = '" . $product_id . "'");
Database::iud("DELETE FROM `products_has_sizes` WHERE `products_id` = '" . $product_id . "'");
Database::iud("DELETE FROM `products_has_colors` WHERE `products_id` = '" . $product_id . "'");
Database::iud("DELETE FROM `product_img` WHERE `products_id` = '" . $product_id . "'");
Database::iud("DELETE FROM `products` WHERE `id` = '" . $product_id . "'");

echo "Deleted";