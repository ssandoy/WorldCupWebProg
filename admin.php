<?php
/**
 * Created by PhpStorm.
 * User: ssandoy
 * Date: 06.04.2017
 * Time: 14.03
 */
session_start();

include("database.php");

if(!$_SESSION["loggedin"])
{
    echo "Du er ikke logget inn";
    echo "<br/><a href=login.php>Tilbake til innlogging</a>";
    die();
}


?>

<h1>Du er nå logget inn på adminsiden</h1>

