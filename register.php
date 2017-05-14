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
    <!-- Client validation -->
    <script src="assets/javascript/clientValidation.js"></script>
    <!-- PHP -->
    <?php
    include("assets/database.php");
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
<!-- Navbar -->
<nav class="navbar">
    <img src="assets/images/logo.png"/>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">FRONT PAGE</a></li>
        <li><a href="login.php">LOG IN</a></li>
    </ul>
</nav>
<!-- Container -->
<div class="main-container">
    <div class="cell-container row">
        <div class="col-sm-12 compact-column">
            <div class="white-cell">
                <h2>Register new account</h2>
                <form action="" method="POST" onsubmit="return validate_spectator()">
                    <p>Username:</p>
                    <input class="form-control" id="spectatorUsername" name="username" onchange="validate_spectatorUsername()" type="text"/>
                    <div id="spectatorUsernameMessage"></div>
                    <p>Password:</p>
                    <input class="form-control" id="spectatorPassword" name="password" onchange="validate_spectatorPassword()" type="password"/>
                    <div id="spectatorPasswordMessage"></div>
                    <p>First name:</p>
                    <input class="form-control" id="spectatorFirstname" name="firstname" onchange="validate_spectatorFirstname()" type="text"/>
                    <div id="spectatorFirstnameMessage"></div>
                    <p>Last name:</p>
                    <input class="form-control" id="spectatorLastname" name="lastname" onchange="validate_spectatorLastname()" type="text"/>
                    <div id="spectatorLastnameMessage"></div>
                    <p>Phone number:</p>
                    <input class="form-control" id="spectatorPhoneNr" name="phoneNr" onchange="validate_spectatorPhoneNr()" type="text"/>
                    <div id="spectatorPhoneNrMessage"></div>
                    <p>E-mail:</p>
                    <input class="form-control" id="spectatorEmail" name="email" onchange="validate_spectatorEmail()" type="text"/>
                    <div id="spectatorEmailMessage"></div>
                    <input class="btn" name="submitSpectator" type="submit" value="Register">
                    <?php
                    if (isset($_POST["submitSpectator"])) {
                        registerSpectator();
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p>(C) 2017 Sindre Beba and Sander Fagerland Sandøy</p>
    </footer>
</div>
</body>
</html>

