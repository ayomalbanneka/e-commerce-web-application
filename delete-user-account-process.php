<?php

include "connection.php";

if (isset($_GET["email"])) {

    $email = $_GET["email"];

    $user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '".$email."'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {

        $user_data = $user_rs->fetch_assoc();

        Database::iud("DELETE FROM `users` WHERE `email` = '".$email."'");
        echo("success");
    }

}
