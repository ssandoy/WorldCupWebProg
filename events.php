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
        <img src="assets/images/logo.png" />
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">FRONT PAGE</a></li>
            <?php getPartialNavbar(); ?>
            <li><a href="athletes.php">ATHLETES</a></li>
            <li class="active"><a href="events.php">EVENTS</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
    </nav>
    <!-- Container -->
    <div class="main-container">
        <div class="row cell-container">
            <div class="col-sm-12 compact-column">
                <div class="white-cell">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class='col-sm-2'>Date</th>
                                <th class='col-sm-3'>Sport</th>
                                <th class='col-sm-5'>Event</th>
                                <th class='col-sm-2'></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php populateEventsTable(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer>
            <p>(C) 2017 Sindre Beba and Sander Fagerland Sandøy</p>
        </footer>
    </div>
</body>
</html>