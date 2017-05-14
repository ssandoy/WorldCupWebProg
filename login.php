<!DOCTYPE html>

<html>

<head>
    <title>Login Page</title>
    <style type = "text/css">
        body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
        }
        label {
            font-weight:bold;
            width:100px;
            font-size:14px;
        }
        .box {
            border:#666666 solid 1px;
        }
    </style>
    <?php include("assets/authorization.php"); ?>
</head>

<body bgcolor = "#FFFFFF">
<!-- Authorization -->
<?php validateNotLoggedIn() ?>
    <div align = "center">
        <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
            <div style = "margin:30px">
                <form method="POST" action="">
                    <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                    <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                    <label>Admin :</label><input type="checkbox" name="adminLogin"/><br/><br />
                    <input name="loginSubmit" type="submit" value="Submit"/><br />
                </form>
                <div style = "font-size:11px; color:#cc0000; margin-top:10px">
                    <?php
                        if (isset($_POST["loginSubmit"])) {
                            if (isset($_POST["adminLogin"])) {
                                checkAdminLogin();
                            } else {
                                checkSpectatorLogin();
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
