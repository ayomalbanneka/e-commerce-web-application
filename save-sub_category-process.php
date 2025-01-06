<?php

include "connection.php";

$sub_cat = $_GET["sub_cat"];

$sub_cat_rs = Database::search("SELECT * FROM `sub_category` WHERE `sub_cat_name` LIKE '%" . $sub_cat . "%' ");

if ($sub_cat_rs->num_rows > 0) {
    echo ("This sub category already exists.");
} else {
    Database::iud("INSERT INTO `sub_category` (`sub_cat_name`) VALUES ('" . $sub_cat . "')");

    echo ("success");
}
