<?php

include "connection.php";

$mtl = $_GET["mtl"];

$mtl_rs = Database::search("SELECT * FROM `material` WHERE `material_name` LIKE '%" . $mtl . "%' ");

if ($mtl_rs->num_rows > 0) {
    echo ("This material already exists.");
} else {
    Database::iud("INSERT INTO `material` (`material_name`) VALUES ('" . $mtl . "')");

    echo ("success");
}
