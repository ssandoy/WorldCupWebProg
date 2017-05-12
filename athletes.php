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
    <!-- JavaScript -->
    <script>
        $(document).ready(function () {
            populateAthleteTable();
            $("#eventSelect").change(populateAthleteTable);
            function populateAthleteTable() {
                value = $("#eventSelect").val();
                $.ajax({
                    url: "assets/ajax.php",
                    type: "post",
                    data: {eventID: value},
                    success: function (response) {
                        $("#athleteTable").html(response);
                    }
                });
            }
        });
    </script>
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
        <li><a href="mypage.php">MY PAGE</a></li>
        <li><a href="admin.php">ADMIN</a></li>
        <li class="active"><a href="athletes.php">ATHLETES</a></li>
        <li><a href="events.php">EVENTS</a></li>
        <li><a href="login.php">LOG OUT</a></li>
    </ul>
</nav>
<!-- Container -->
<div class="row" id="container">
    <form action="" method="POST">
        <select class="form-control" id="eventSelect">
            <option value='0'>All events</option>
            <?php populateEventsDropdown(); ?>
        </select>
    </form>
    <div class="col-sm-12 compact-column">
        <div class="white-cell">
            <table class="table">
                <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Age</th>
                    <th>Nationality</th>
                    <th>Gender</th>
                    <th>Sport</th>
                </tr>
                </thead>
                <tbody id="athleteTable">
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>