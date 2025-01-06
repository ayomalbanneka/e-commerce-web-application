<?php

include "connection.php";

if (isset($_GET['id'])) {

    $p_id = $_GET['id'];

    $p_srch = Database::search("SELECT * FROM `cart` WHERE cart_products_id = '$p_id' ");

    $p_data = $p_srch->fetch_assoc();
    $new_qty = $p_data['cart_qty'] - 1;

    if ($p_srch->num_rows == 1) {

        if ($new_qty == 0) {

            echo 'You have reached to minimum quantity';
        } else {
            Database::iud("UPDATE `cart` SET cart_qty = '$new_qty' WHERE cart_products_id = '$p_id' ");
            echo 'success';
        }
    }
}
