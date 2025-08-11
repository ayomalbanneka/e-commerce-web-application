<?php

session_start();

if ($_SESSION["au"]) {

    $_SESSION["au"] = null;
    session_destroy();

    echo ("success");
}
