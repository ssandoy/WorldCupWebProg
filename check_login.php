<?php
session_start();
$db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
if ($db->connect_error) {
    echo "Feil i databasetilknytningen";
    trigger_error($db->connect_error);
}

$username = $_POST['username']; //Set UserName
$password = $_POST['password']; //Set Password
$msg ='';
if(isset($username, $password)) {
    ob_start();
    // To protect from MySQL injection
    $username = stripslashes($_POST["username"]);
    $password = stripslashes($_POST["password"]);
    $myusername = $db->real_escape_string($username);
    $mypassword = $db->real_escape_string($password);
    $sql="SELECT * FROM Admin WHERE username='$myusername' AND password='$mypassword'";

    $result=$db->query($sql);
    // If result matched $myusername and $mypassword, table row must be 1 row
    if($db->affected_rows==1){
        // Register $myusername and redirect to file "admin.php"
        
        $_SESSION['loggedin']= true;
        $_SESSION['name'] = $myusername;
        header("location:admin.php");
    }
    else {
        $msg = "Wrong Username or Password. Please retry";
        header("location:login.php?msg=$msg");
    }
    ob_end_flush();
}
else {
    header("location:login.php?msg=Please enter some username and password");
}

$db->close();
?>

