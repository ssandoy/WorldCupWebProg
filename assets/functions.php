<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    $_SESSION["loggedin"] = false;
}

function getNavbar() {
    if($_SESSION["loggedin"]) {
        echo "<li><a href='admin.php'>ADMIN</a></li>
              <li><a href='mypage.php'>MY PAGE</a></li>
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