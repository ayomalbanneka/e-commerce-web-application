<?php

include "connection.php";

$cat = $_GET["cat"];

$cat_rs = Database::search("SELECT * FROM `category` WHERE `cat_name` LIKE '%" . $cat . "%' ");

if ($cat_rs->num_rows > 0) {
    echo ("This category already exists.");
} else {
    Database::iud("INSERT INTO `category` (`cat_name`) VALUES ('" . $cat . "')");

    echo ("success");
}
