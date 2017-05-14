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
    include("assets/database.php");
    include("assets/authorization.php");
    ?>
    <!-- Metadata -->
    <title>WSC - Seefeld 2019</title>
    <meta charset="UTF-8">
    <meta name="author" content="Sindre Beba, Sander Sandøy">
</head>
<body>
<!-- Navbar -->
<nav class="navbar">
    <img src="assets/images/logo.png"/>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">FRONT PAGE</a></li>
        <?php getPartialNavbar(); ?>
        <li><a href="athletes.php">ATHLETES</a></li>
        <li><a href="events.php">EVENTS</a></li>
        <li><a href="logout.php">LOG OUT</a></li>
    </ul>
</nav>
<!-- Container -->
<div class="main-container">
    <div class="cell-container row">
        <div class="col-sm-12 compact-column">
            <div class="white-cell">
                <h2>Register new account</h2>
                <form action="" method="POST">
                    <p>Username:</p>
                    <input class="form-control" name="username" type="text"/>
                    <p>Password:</p>
                    <input class="form-control" name="password" type="password"/>
                    <p>First name:</p>
                    <input class="form-control" name="firstname" type="text"/>
                    <p>Last name:</p>
                    <input class="form-control" name="lastname" type="text"/>
                    <p>Phone number:</p>
                    <input class="form-control" name="phoneNr" type="text"/>
                    <p>E-mail:</p>
                    <input class="form-control" name="email" type="text"/>
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

