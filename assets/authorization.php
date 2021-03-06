<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    $_SESSION["loggedin"] = false;
}
if (!isset($_SESSION["adminloggedin"])) {
    $_SESSION["adminloggedin"] = false;
}

function checkAdminLogin() {
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        die('Connect Error: ' . $db->connect_error);
    }

    $username = $_POST['username']; //Set UserName
    $password = $_POST['password']; //Set Password
    if(isset($username, $password)) {
        ob_start();
        // To protect from MySQL injection
        $username = stripslashes($_POST["username"]);
        $password = stripslashes($_POST["password"]);
        $myusername = $db->real_escape_string($username);
        $mypassword = $db->real_escape_string($password);
        $sql="SELECT * FROM Admin WHERE username='$myusername' AND password=Password('$mypassword')";
        $result=$db->query($sql);
        // If result matched $myusername and $mypassword, table row must be 1 row
        if($db->affected_rows==1) {
            // Register $myusername and redirect to file "admin.php"
            $_SESSION['adminloggedin']= true;
            $_SESSION['name'] = $myusername;
            $row = $result->fetch_array();
            $_SESSION['adminID'] = $row['AdminID'];
            header("location:admin.php");
        } else {
            echo "Wrong Username or Password. Please retry";
        }
        ob_end_flush();
    } else {
        echo "Please enter some username and password";
    }
    $db->close();
}

function checkSpectatorLogin() {
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        die('Connect Error: ' . $db->connect_error);
    }

    $username = $_POST['username']; //Set UserName
    $password = $_POST['password']; //Set Password
    if(isset($username, $password)) {
        ob_start();
        // To protect from MySQL injection
        $username = stripslashes($_POST["username"]);
        $password = stripslashes($_POST["password"]);
        $myusername = $db->real_escape_string($username);
        $mypassword = $db->real_escape_string($password);
        $sql="SELECT * FROM Spectator WHERE username='$myusername' AND password=Password('$mypassword')";
        $result=$db->query($sql);
        // If result matched $myusername and $mypassword, table row must be 1 row
        if($db->affected_rows==1) {
            // Register $myusername and redirect to file "admin.php"
            $_SESSION['loggedin']= true;
            $_SESSION['name'] = $myusername;
            $row = $result->fetch_array();
            $_SESSION['spectatorID'] = $row['SpectatorID'];
            header("location:mypage.php");
        } else {
            echo "Wrong Username or Password. Please retry";
        }
        ob_end_flush();
    } else {
        echo "Please enter some username and password";
    }
    $db->close();
}


function getNavbar() {
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
        echo "<li><a href='mypage.php'>MY PAGE</a></li>
              <li><a href='athletes.php'>ATHLETES</a></li>
              <li><a href='events.php'>EVENTS</a></li>
              <li><a href='logout.php'>LOG OUT</a></li>";
    } else if(isset($_SESSION["adminloggedin"]) && $_SESSION["adminloggedin"]) {
        echo "<li><a href='admin.php'>ADMIN</a></li>
              <li><a href='athletes.php'>ATHLETES</a></li>
              <li><a href='events.php'>EVENTS</a></li>
              <li><a href='logout.php'>LOG OUT</a></li>";
    } else {
        echo "<li><a href='login.php'>LOG IN</a></li>";
    }
}

function getPartialNavbar() {
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
        echo "<li><a href='mypage.php'>MY PAGE</a></li>";
    } else if(isset($_SESSION["adminloggedin"]) && $_SESSION["adminloggedin"]) {
        echo "<li><a href='admin.php'>ADMIN</a></li>";
    }
}

function validateAdminLogin()
{
    if (!isset($_SESSION["adminloggedin"]) || !$_SESSION["adminloggedin"]) {
        ob_start();
        header("location:index.php");
        ob_end_flush();
    }
}

function validateSpectatorLogin(){
    if (!isset($_SESSION["loggedin"])|| !$_SESSION["loggedin"]) {
        ob_start();
        header("location:index.php");
        ob_end_flush();
    }
}

function validateLogin() {
    if (!isset($_SESSION["adminloggedin"]) || !$_SESSION["adminloggedin"]) {
        if (!isset($_SESSION["loggedin"])|| !$_SESSION["loggedin"]) {
            ob_start();
            header("location:index.php");
            ob_end_flush();
        }
    }
}

function validateNotLoggedIn() {
    if ((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) || (isset($_SESSION["adminloggedin"]) && $_SESSION["adminloggedin"])) {
        ob_start();
        header("location:index.php");
        ob_end_flush();
    }
}