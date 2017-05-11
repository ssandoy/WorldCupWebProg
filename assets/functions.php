<?php
/**
 * Created by PhpStorm.
 * User: Sindre
 * Date: 08.05.2017
 * Time: 09.19
 */

session_start();
if (!isset($_SESSION["loggedin"])) {
    $_SESSION["loggedin"] = false;
}

function getNavbar() {
    if($_SESSION["loggedin"]) {
        echo "<li><a href='mypage.php'>MY PAGE</a></li>
              <li><a href='athletes.php'>ATHLETES</a></li>
              <li><a href='events.php'>EVENTS</a></li>
              <li><a href='login.php'>LOG OUT</a></li>";
    } else {
        echo "<li><a href='login.php'>LOG IN</a></li>";
    }
}

function validateAdminLogin() {
    if(!$_SESSION["loggedin"]) {
        echo "Du er ikke logget inn";
        echo "<br/><a href=login.php>Tilbake til innlogging</a>";
        die();
    }
}