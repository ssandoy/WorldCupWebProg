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
    <!-- Authorization -->
    <?php validateAdminLogin() ?>
    <!-- Navbar -->
    <nav class="navbar">
        <img src="assets/images/logo.png"/>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">FRONT PAGE</a></li>
            <li class="active"><a href="admin.php">ADMIN</a></li>
            <li><a href="athletes.php">ATHLETES</a></li>
            <li><a href="events.php">EVENTS</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
    </nav>
    <!-- Container -->
    <div class="main-container">
        <div class="cell-container">
            <h2><select class="form-control" id="formSelect">
                <option>Register new admin</option>
                <option>Register new athlete</option>
                <option>Register new event</option>
            </select></h2>
            <div class="row" id="adminForm">
                <form action="" method="POST" onsubmit="return validate_admin()">
                    <div class="col-sm-8 compact-column">
                        <div class="white-cell">
                            <p>Username:</p>
                            <input class="form-control" id="adminUsername" name="username" onchange="validate_adminUsername()" type="text"/>
                            <div id="adminUsernameMessage"></div>
                            <p>Password:</p>
                            <input class="form-control" id="adminPassword" name="password" onchange="validate_adminPassword()" type="password"/>
                            <div id="adminPasswordMessage"></div>
                            <p>First name:</p>
                            <input class="form-control" id="adminFirstname" name="firstname" onchange="validate_adminFirstname()" type="text"/>
                            <div id="adminFirstnameMessage"></div>
                            <p>Last name:</p>
                            <input class="form-control" id="adminLastname" name="lastname" onchange="validate_adminLastname()" type="text"/>
                            <div id="adminLastnameMessage"></div>
                            <p>Phone number:</p>
                            <input class="form-control" id="adminPhoneNr" name="phoneNr" onchange="validate_adminPhoneNr()" type="text"/>
                            <div id="adminPhoneNrMessage"></div>
                            <input class="btn" name="submitAdmin" type="submit" value="Register">
                            <?php
                            if (isset($_POST["submitAdmin"])) {
                                registerAdmin();
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-4 compact-column">
                        <div class="white-cell">
                            <h3>Admin account</h3>
                            <hr>
                            <?php getAdminInfo(); ?>

                        </div>
                    </div>
                </form>
            </div>
            <div class="row" id="athleteForm">
                <form action="" method="POST" onsubmit="return validate_athlete()">
                    <div class="col-sm-8 compact-column">
                        <div class="white-cell">
                            <p>First name:</p>
                            <input class="form-control" id="athleteFirstname" name="firstname" onchange="validate_athleteFirstname()" type="text"/>
                            <div id="athleteFirstnameMessage"></div>
                            <p>Last name:</p>
                            <input class="form-control" id="athleteLastname" name="lastname" onchange="validate_athleteLastname()" type="text"/>
                            <div id="athleteLastnameMessage"></div>
                            <p>Age:</p>
                            <input class="form-control" id="athleteAge" name="age" onchange="validate_athleteAge()" type="number" min="16" max="50"/>
                            <div id="athleteAgeMessage"></div>
                            <p>Nationality:</p>
                            <input class="form-control" id="athleteNationality" name="nationality" onchange="validate_athleteNationality()" type="text"/>
                            <div id="athleteNationalityMessage"></div>
                            <p>Gender:</p>
                            <select class="form-control" id="athleteGender" name="gender">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                            <p>Sport:</p>
                            <select class="form-control" id="athleteSport" name="sport">
                                <option>Cross-country</option>
                                <option>Nordic combined</option>
                                <option>Ski jumping</option>
                            </select>
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
            <div class="row" id="eventForm">
                <form action="" method="POST" onsubmit="return validate_event()">
                    <div class="col-sm-8 compact-column">
                        <div class="white-cell">
                            <p>Sport:</p>
                            <select class="form-control" id="eventSport" name="sport">
                                <option>Cross-country</option>
                                <option>Nordic combined</option>
                                <option>Ski jumping</option>
                            </select>
                            <p>Gender:</p>
                            <select class="form-control" id="eventGender" name="gender">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                            <p>Description:</p>
                            <input class="form-control" id="eventDescription" name="description" onchange="validate_eventDescription()" type="text"/>
                            <div id="eventDescriptionMessage"></div>
                            <p>Date:</p>
                            <input class="form-control" id="eventDatetime" name="datetime" onchange="validate_eventDatetime()" type="date" min="2019-01-01" max="2019-12-31"/>
                            <div id="eventDatetimeMessage"></div>
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
        <footer>
            <p>(C) 2017 Sindre Beba and Sander Fagerland Sandøy</p>
        </footer>
    </div>
</body>
</html>

