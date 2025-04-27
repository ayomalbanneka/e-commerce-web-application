<?php

session_start();

include "connection.php";

if (isset($_GET["email"])) {

    $email = $_GET["email"];

    $user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {

        // Delete all the data related to the user from the database

        // Watchlist Table

        Database::iud("DELETE w
        FROM watchlist w
        JOIN users u ON w.users_email = u.email
        WHERE `email` = '" . $email . "'");

        // Cart Table

        Database::iud("DELETE c
        FROM cart c
        JOIN users u ON c.cart_users_email = u.email
        WHERE u.email = '" . $email . "'");

        // Invoice Table

        Database::iud("DELETE i
        FROM invoice i
        JOIN users u ON i.users_email = u.email
        WHERE u.email = '" . $email . "'");

        // Profile Image Table

        Database::iud("DELETE pi
        FROM profile_img pi
        JOIN users u ON pi.users_email = u.email
        WHERE u.email = '" . $email . "'");

        Database::iud("DELETE ua
        FROM users_has_address ua
        JOIN users u ON ua.users_email = u.email
        WHERE u.email = '" . $email . "'");

        Database::iud("DELETE FROM users
        WHERE email = '" . $email . "'");

        session_destroy();
        
        echo ("success");
    }
}
