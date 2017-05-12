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
        $(document).ready(function () {
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
    <!-- JavaScript -->
    <script>
        $(document).ready(function () {
            populateEventCheckboxes();
            $("#athleteGender").change(populateEventCheckboxes);
            $("#athleteSport").change(populateEventCheckboxes);
            function populateEventCheckboxes() {
                gender = $("#athleteGender").val();
                sport = $("#athleteSport").val();
                $.ajax({
                    url: "assets/ajax.php",
                    type: "post",
                    data: {athleteGender: gender, athleteSport: sport},
                    success: function (response) {
                        $("#eventCheckboxes").html(response);
                    }
                });
            }
            populateAthleteCheckboxes();
            $("#eventGender").change(populateAthleteCheckboxes);
            $("#eventSport").change(populateAthleteCheckboxes);
            function populateAthleteCheckboxes() {
                gender = $("#eventGender").val();
                sport = $("#eventSport").val();
                $.ajax({
                    url: "assets/ajax.php",
                    type: "post",
                    data: {eventGender: gender, eventSport: sport},
                    success: function (response) {
                        $("#athleteCheckboxes").html(response);
                    }
                });
            }
        });
    </script>
</head>
<body>
<!-- Navbar -->
<nav class="navbar">
    <img src="assets/images/logo.png"/>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">FRONT PAGE</a></li>
        <li class="active"><a href='admin.php'>ADMIN</a></li>
        <li><a href='athletes.php'>ATHLETES</a></li>
        <li><a href='events.php'>EVENTS</a></li>
        <li><a href='login.php'>LOG OUT</a></li>
    </ul>
</nav>
<!-- Container -->
<div class="row" id="container">
    <?php validateAdminLogin() ?>
    <select class="form-control" id="formSelect">
        <option>Register new admin</option>
        <option>Register new athlete</option>
        <option>Register new event</option>
    </select>
    <div id="adminForm">
        <form action="" method="POST">
            <div class="col-sm-8 compact-column">
                <div class="white-cell">
                    <p>First name:</p>
                    <input class="form-control" name="firstname" type="text"/>
                    <p>Last name:</p>
                    <input class="form-control" name="lastname" type="text"/>
                    <p>Phone number:</p>
                    <input class="form-control" name="phoneNr" type="text"/>
                    <p>Username:</p>
                    <input class="form-control" name="username" type="text"/>
                    <p>Password:</p>
                    <input class="form-control" name="password" type="text"/>
                    <input class="btn" name="submitAdmin" type="submit" value="Register">
                    <?php
                    if (isset($_POST["submitAdmin"])) {
                        registerAdmin();
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-4 compact-column">
                <?php //getAdminInfo(); ?>
            </div>
        </form>
    </div>
    <div id="athleteForm">
        <form action="" method="POST">
            <div class="col-sm-8 compact-column">
                <div class="white-cell">
                    <p>First name:</p>
                    <input class="form-control" name="firstname" type="text"/>
                    <p>Last name:</p>
                    <input class="form-control" name="lastname" type="text"/>
                    <p>Age:</p>
                    <input class="form-control" name="age" type="text"/>
                    <p>Nationality:</p>
                    <input class="form-control" name="nationality" type="text"/>
                    <p>Gender:</p>
                    <input class="form-control" id="athleteGender" name="gender" type="text"/>
                    <p>Sport:</p>
                    <input class="form-control" id="athleteSport" name="sport" type="text"/>
                    <input class="btn" name="submitAthlete" type="submit" value="Register">
                    <?php
                    if (isset($_POST["submitAthlete"])) {
                        registerAthlete();
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-4 compact-column">
                <div class="white-cell" id="eventCheckboxes"></div>
            </div>
        </form>
    </div>
    <div id="eventForm">
        <form action="" method="POST">
            <div class="col-sm-8 compact-column">
                <div class="white-cell">
                    <p>Sport:</p>
                    <input class="form-control" id="eventSport" name="sport" type="text"/>
                    <p>Description:</p>
                    <input class="form-control" name="description" type="text"/>
                    <p>Gender:</p>
                    <input class="form-control" id="eventGender" name="gender" type="text"/>
                    <p>Date:</p>
                    <input class="form-control" name="datetime" type="text"/>
                    <input class="btn" name="submitEvent" type="submit" value="Register">
                    <?php
                    if (isset($_POST["submitEvent"])) {
                        registerEvent();
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-4 compact-column">
                <div class="white-cell" id="athleteCheckboxes"></div>
            </div>
        </form>
    </div>
</div>
</body>
</html>

