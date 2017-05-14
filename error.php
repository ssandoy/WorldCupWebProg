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
    include("assets/errorHandling.php");
    ?>
    <!-- Metadata -->
    <title>WSC - Seefeld 2019</title>
    <meta charset="UTF-8">
    <meta name="author" content="Sindre Beba, Sander Sandøy">
</head>
<body>
<!-- Navbar -->
<nav class="navbar">
    <img src="assets/images/logo.png" />
    <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="index.php">FRONT PAGE</a></li>
        <?php getNavbar(); ?>
    </ul>
</nav>
<!-- Container -->
<div class="main-container">
    <div class="row cell-container">
        <div class="col-sm-12 compact-column">
            <div class="white-cell">
                <h2>An error occured</h2>
                <p><a href="index.php">Return to the frontpage.</a></p>
            </div>
        </div>
    </div>
    <footer>
        <p>(C) 2017 Sindre Beba and Sander Fagerland Sandøy</p>
    </footer>
</div>
</body>
</html>