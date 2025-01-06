<?php

include "connection.php";

// include "mail/SMTP.php";
// include "mail/PHPMailer.php";
// include "mail/Exception.php";

// use PHPMailer\PHPMailer\PHPMailer;

$status = $_GET["status"];
$id = $_GET["invoice"];
// echo($id);
// echo($status);

// Updating the quary for there status

if ($status == 0) {
    Database::iud("UPDATE `invoice` SET `status` = '1' WHERE `invoice_id` = '" . $id . "'");
    echo ("success");
}
if ($status == 1) {
    Database::iud("UPDATE `invoice` SET `status` = '2' WHERE `invoice_id` = '" . $id . "'");
    echo ("success");
}
if ($status == 2) {
    Database::iud("UPDATE `invoice` SET `status` = '3' WHERE `invoice_id` = '" . $id . "'");
    echo ("success");
}
if ($status == 3) {
    Database::iud("UPDATE `invoice` SET `status` = '4' WHERE `invoice_id` = '" . $id . "'");
    echo ("success");
}
