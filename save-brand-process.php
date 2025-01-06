<?php

include "connection.php";

$brd = $_GET["brd"];

$brd_rs = Database::search("SELECT * FROM `brand` WHERE `brand_name` LIKE '%" . $brd . "%' ");

if ($brd_rs->num_rows > 0) {
    echo ("This brand already exists.");
} else {
    Database::iud("INSERT INTO `brand` (`brand_name`) VALUES ('" . $brd . "')");

    echo ("success");
}
