<!DOCTYPE html>
<html>
<head>
    <!-- jQuery -->
    <script src="assets/javascript/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">
    <script src="assets/javascript/bootstrap.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/stylesheet.css"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed" rel="stylesheet">
    <!-- PHP -->
    <?php
    include("assets/authorization.php");
    ?>
    <!-- Metadata -->
    <title>WSC - Seefeld 2019</title>
    <meta charset="UTF-8">
    <meta name="author" content="Sindre Beba, Sander Sandøy">
</head>
<body>
    <!-- Authorization -->
    <?php validateNotLoggedIn() ?>
    <div class="loginWindow">
        <div class="loginHeader">
            <b>Login</b>
        </div>
        <div class="loginBody">
            <form method="POST" action="">
                <p>Username</p>
                <input class="form-control" name="username" type="text">
                <p>Password</p>
                <input class="form-control" name="password" type="password">
                <div class='checkbox'><label><input name="adminLogin" type='checkbox'>Admin</label></div>
                <input class="btn btn-default" name="loginSubmit" type="submit" value="Log in"/><br />
            </form>
            <br/>
            <p><a href="register.php">Don't have an account? Register here.</a></p>
            <div class="loginMessage">
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
</body>
</html>
