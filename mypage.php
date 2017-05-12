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
    include("assets/functions.php");
    ?>
    <!-- Metadata -->
    <title>WSC - Seefeld 2019</title>
    <meta charset="UTF-8">
    <meta name="author" content="Sindre Beba, Sander Sandøy">
    <!-- Form Selector JavaScript -->
    <script>
        $(document).ready(function() {
            $("#athleteForm").hide();
            $("#eventForm").hide();
            $("#formSelect").change(function () {
                value = $("#formSelect").val();
                if (value == "Register new admin") {
                    $("#adminForm").show();
                    $("#athleteForm").hide();
                    $("#eventForm").hide();
                } else if (value == "Register new athlete") {
                    $("#adminForm").hide();
                    $("#athleteForm").show();
                    $("#eventForm").hide();
                } else {
                    $("#adminForm").hide();
                    $("#athleteForm").hide();
                    $("#eventForm").show();
                }
            });
        });
    </script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <img src="assets/images/logo.png" />
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">FRONT PAGE</a></li>
            <li><a href="admin.php">ADMIN</a></li>
            <li class="active"><a href="mypage.php">MY PAGE</a></li>
            <li><a href="athletes.php">ATHLETES</a></li>
            <li><a href="events.php">EVENTS</a></li>
            <li><a href="login.php">LOG OUT</a></li>
        </ul>
    </nav>
    <!-- Container -->
    <div class="main-container">
        <div class="row cell-container">
            <div class="col-sm-8 compact-column">
                <div class="white-cell">
                    <h2>Events you have checked in on:</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sport</th>
                                <th>Description</th>
                                <th>Gender</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php populateEventSpectatorTable(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-4 compact-column">
                <div class="white-cell">
                    <h3>User account</h3>
                    <hr>
                    <?php getSpectatorInfo(); ?>
                </div>
            </div>
        </div>
        <footer>
            <p>(C) 2017 Sindre Beba and Sander Fagerland Sandøy</p>
        </footer>
    </div>
</body>
</html>