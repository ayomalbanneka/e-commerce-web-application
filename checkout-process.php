<?php

session_start();
include "connection.php";

if (isset($_SESSION["u"])) {

    $mail = $_SESSION["u"]["email"];
    $fname = $_SESSION["u"]["fname"];
    $lname = $_SESSION["u"]["lname"];
    $mobile = $_SESSION["u"]["mobile"];

    $address_rs = Database::search("SELECT * FROM `users_has_address`
    INNER JOIN `city` ON users_has_address.city_city_id=city.city_id
    INNER JOIN `district` ON city.district_district_id=district.district_id
    WHERE `users_email` = '" . $mail . "' ");

    $address_data = $address_rs->fetch_assoc();

    $address = $address_data["line1"] . ", " . $address_data["line2"];
    $city = $address_data["city_name"];

    function generateRandomDigits($length = 10)
        {
            $digits = '';
            for ($i = 0; $i < $length; $i++) {
                $digits .= mt_rand(0, 9); // Append a random digit from 0 to 9
            }
            return $digits;
        }

    $order_id = generateRandomDigits(10);

    $items = "";
    $product_total = 0;
    $delivery_total = 0;

    $cart_rs = Database::search("SELECT * FROM `cart`
    INNER JOIN `products` ON cart.cart_products_id=products.id 
    WHERE `cart_users_email` = '" . $mail . "' ");

    $cart_num = $cart_rs->num_rows;

    for ($x = 0; $x < $cart_num; $x++) {

        $cart_data = $cart_rs->fetch_assoc();

        $unit_price = $cart_data["price"];
        $cart_qty = $cart_data["cart_qty"];
        $product_total += $unit_price * $cart_qty;

        if ($address_data["district_id"] == 5) {
            $delivery_total += $cart_data["delivery_fee_colombo"];
        } else {
            $delivery_total += $cart_data["delivery_fee_other"];
        }

        $items .= $cart_data["title"] . ", ";
    }

    $amount = $product_total + $delivery_total;
    $merchant_id = "1228041";
    $merchant_secret = "NzAxMjQzNTc0MzQ2ODc1OTcwNTg0MDg2ODAwNTM2NjkzODA4NTc=";
    $currency = "LKR";

    $hash = strtoupper(
        md5(
            $merchant_id .
                $order_id .
                number_format($amount, 2, '.', '') .
                $currency .
                strtoupper(md5($merchant_secret))
        )
    );

    $array;

    $array["email"] = $mail;
    $array["fname"] = $fname;
    $array["lname"] = $lname;
    $array["mobile"] = $mobile;
    $array["address"] = $address;
    $array["city"] = $city;
    $array["order_id"] = $order_id;
    $array["items"] = $items;
    $array["amount"] = $amount;
    $array["merchant_id"] = $merchant_id;
    $array["merchant_secret"] = $merchant_secret;
    $array["currency"] = $currency;
    $array["hash"] = $hash;

    echo json_encode($array);
} else {
    echo "Please login to your account";
}
