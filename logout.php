<?php

/**
 * Created by PhpStorm.
 * User: ssandoy
 * Date: 12.05.2017
 * Time: 22.03
 */
session_start();
if (isset($_SESSION["loggedin"])){
    unset($_SESSION["loggedin"]);
}
if (isset($_SESSION["adminloggedin"])){
    unset($_SESSION["adminloggedin"]);
}
echo "Du er nå logget ut";
header("Location: index.php");