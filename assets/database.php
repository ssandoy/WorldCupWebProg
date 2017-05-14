<?php

include("classes.php");

//======================================================================
// DELETE FUNCTIONS
//======================================================================

function deleteAthlete($id) {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }
    // Execute SQL query.
    $sql = "DELETE FROM Athlete "
        . "WHERE AthleteID = '$id';";
    $db->query($sql);
    // Close database connection.
    $db->close();
}

function deleteEvent($id) {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }
    // Execute SQL query.
    $sql = "DELETE FROM Event "
        . "WHERE EventID = '$id';";
    $db->query($sql);
    // Close database connection.
    $db->close();
}
//======================================================================
// EDIT FUNCTIONS
//======================================================================

function editAdmin() {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }

    #editAdmin via POST-calls and update db.
    $id = $_SESSION['adminID'];
    $firstname = $db->real_escape_string($_POST["firstname"]);
    $lastname = $db->real_escape_string($_POST["lastname"]);
    $phoneNr = $db->real_escape_string($_POST["phoneNr"]);
    $username = $db->real_escape_string($_POST["username"]);
    $password = $db->real_escape_string($_POST["password"]);

    $okRegex = true;
    //REGEX
    if (!preg_match("/^[A-Za-z\\- ]{2,20}$/",$firstname) ){
        $okRegex = false;
        echo "Firstname can only include english letters, hyphen (-) and space. It must be between 2 and 20 characters<br><br>";
    } else if (!preg_match("/^[A-Za-z\\- ]{2,20}$/",$lastname)){
        $okRegex = false;
        echo "Lastname can only include english letters, hyphen (-) and space. It must be between 2 and 20 characters<br><br>";
    } else if (!preg_match("/^[0-9]{8}$/",$phoneNr)) {
        $okRegex = false;
        echo "Phone number can only include digits. It must be between 8 and 15 characters<br><br>";
    } else if (!preg_match("/^[A-Za-z\\-]{2,20}$/",$username)) {
        $okRegex = false;
        echo "Username can only include english letters, digits and hyphen (-). It must be between 6 and 20 characters<br><br>";
    } else if (!preg_match("/^[A-Za-z0-9\\-]{6,20}$/",$password)) {
        $okRegex = false;
        echo "Password can only include english letters, digits and hyphen (-). It must be between 6 and 20 characters<br><br>";
    }


    if($okRegex) {

        $sql = "UPDATE Admin SET firstname=$firstname,lastname=$lastname,phonenumber=$phoneNr,username=$username, password=Password('$password') ";
        $sql .= " WHERE AdminID = $id;";

        $result = $db->query($sql);

        if ($result === TRUE) {
            header("location:admin.php");
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $db->error;
        }
    }
    // Close database connection.
    $db->close();
}

function editEvent(){
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }

    #editAdmin via POST-calls and update db.
    $id = $db->real_escape_string($_POST["eventID"]);
    $description = $db->real_escape_string($_POST["description"]);
    $datetime = $db->real_escape_string($_POST["datetime"]);
    $gender = $db->real_escape_string($_POST["gender"]);
    $sport = $db->real_escape_string($_POST["sport"]);

    $okRegex = true;
    //REGEX
    if (!preg_match("/^[A-Za-z0-9\\- ]{2,255}$/",$description) ){
        $okRegex = false;
        echo "Description can only include english letters, digits, hyphen (-) and space. It must be between 2 and 255 characters<br><br>";
    } if (!preg_match("/^[0-9]{2}\\/[0-9]{2}\\/2019$/",$datetime)){
        echo "You must choose a date in 2019<br><br>";
        $okRegex = false;
    } if (!($eventGender == "Male" || $gender == "Female")) {
        $okRegex = false;
        echo "Invalid gender<br><br>";
    } if (!(event == "Cross-country" || $sport == "Nordic combined" || $sport == "Ski jumping")) {
        $okRegex = false;
        echo "Please choose one of our available sports<br><br>";
    }

    if($okRegex) {

        $sql = "UPDATE Event SET description = '$description',datetime = '$datetime',gender = '$gender',sport = '$sport'";
        $sql .= " WHERE EventID = $id;";

        $result = $db->query($sql);

        if ($result === TRUE) {
            header("location:events.php");
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $db->error;
        }
    }
    // Close database connection.
    $db->close();
}

function editAthlete(){
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }

    #editAthlete via POST-calls and update db.
    $id = $db->real_escape_string($_POST["athleteID"]);
    $firstname = $db->real_escape_string($_POST["firstname"]);
    $lastname = $db->real_escape_string($_POST["lastname"]);
    $age = $db->real_escape_string($_POST["age"]);
    $nationality = $db->real_escape_string($_POST["nationality"]);
    $gender = $db->real_escape_string($_POST["gender"]);
    $sport = $db->real_escape_string($_POST["sport"]);

    $okRegex = true;
    //REGEX
    if (!preg_match("/^[A-Za-z\\- ]{2,20}$/",$firstname) ){
        $okRegex = false;
        echo "Firstname can only include english letters, hyphen (-) and space. It must be between 2 and 20 characters<br><br>";
    } if (!preg_match("/^[A-Za-z\\- ]{2,20}$/",$lastname)){
        $okRegex = false;
        echo "Lastname can only include english letters, hyphen (-) and space. It must be between 2 and 20 characters<br><br>";
    }  if (!preg_match("/^[0-9]{2}$/",$age)) {
        $okRegex = false;
        echo "Age can only include digits. It must be between 8 and 15 characters<br><br>";
    }  if (!preg_match("/^[A-Za-z\\- ]{2,20}$/",$nationality)) {
        $okRegex = false;
        echo "Nationality can only include english letters, digits and hyphen (-). It must be between 2 and 20 characters<br><br>";
    } if (!($gender == "Male" || $gender == "Female")) {
        $okRegex = false;
        echo "Invalid gender<br><br>";
    } if (!($sport == "Cross-country" || $sport == "Nordic combined" || $sport == "Ski jumping")) {
        $okRegex = false;
        echo "Please choose one of our available sports<br><br>";
    }

    if($okRegex) {

        $sql = "UPDATE Athlete SET firstname='$firstname', lastname='$lastname', age='$age', nationality='$nationality', gender='$gender', sport='$sport'";
        $sql .= " WHERE AthleteID = $id";

        $result = $db->query($sql);

        if ($result === TRUE) {
            header("location:athletes.php");
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $db->error;
        }
    }
    // Close database connection.
    $db->close();
}

//======================================================================
// GET FUNCTIONS
//======================================================================

function getAdminInfo() {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }
    // Get the ID of the logged in admin. T
    $id = $_SESSION['adminID'];
    // Execute SQL query.
    $sql = "SELECT username, firstname, lastname, phonenumber "
        . "FROM Admin "
        . "WHERE AdminID = $id;";
    $result = $db->query($sql);
    // Echo out admin info.
    if($db->affected_rows>0) {
        $row = $result->fetch_object();
        echo "<h4>Username:</h4><p>$row->username</p>"
            . "<h4>Name:</h4><p>$row->firstname $row->lastname</p>"
            . "<h4>Phone number:</h4><p>$row->phonenumber</p>";
    } else {
        echo "<p>Could not find admin info.</p>";
    }
    // Close database connection.
    $db->close();
}

function getSpectatorInfo() {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }
    // Get the ID of the logged in spectator.
    $id = $_SESSION['spectatorID'];
    // Execute SQL query.
    $sql = "SELECT firstname, lastname, phonenumber, email, username "
        . "FROM Spectator "
        . "WHERE SpectatorID = $id;";
    $result = $db->query($sql);
    // Echo out spectator info.
    if($db->affected_rows>0) {
        $row = $result->fetch_object();
        echo "<h4>Username:</h4><p>$row->username</p>"
            . "<h4>Name:</h4><p>$row->firstname $row->lastname</p>"
            . "<h4>Phone number:</h4><p>$row->phonenumber</p>"
            . "<h4>E-mail:</h4><p>$row->email</p>";
    } else {
        echo "<p>Could not find user info.</p>";
    }
    // Close database connection.
    $db->close();
}

function getNextEvent() {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }
    // Execute SQL query.
    $sql = "SELECT description, datetime, gender, sport "
        . "FROM Event "
        . "ORDER BY datetime ASC "
        . "LIMIT 1";
    $result = $db->query($sql);
    // Echo out the next event.
    if($db->affected_rows>0) {
        $row = $result->fetch_object();
        $date = DateTime::createFromFormat("m-d-y", $row->datetime);
        $dateString = $date->format("l, F jS Y");
        if ($row->gender == "Male") {
            $gender = "Men's";
        } else {
            $gender = "Women's";
        }
        echo "<p>$dateString</p>"
            . "<h4>$row->description</h4>"
            . "<p>$gender $row->sport</p>";
    } else {
        echo "<p>There are no more events</p>";
    }
    // Close database connection.
    $db->close();
}

//======================================================================
// POPULATE FUNCTIONS
//======================================================================
function populateAthleteForm()
{
    if (isset($_GET["id"])) {
        // Connect to database.
        $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
        if ($db->connect_error) {
            trigger_error($db->connect_error);
        }

        $id = $_GET['id'];

        $sql = "SELECT firstname, lastname, age, nationality, gender, sport "
            . "FROM Athlete "
            . "WHERE AthleteID = $id ";

        $result = $db->query($sql);
        if ($db->affected_rows > 0) {
            $numRows = $db->affected_rows;
            for ($i = 0; $i < $numRows; $i++) {
                $row = $result->fetch_object();
                echo "<input class='form-control' name='athleteID' type='hidden' value='$id'></td>"
                    ."<p>First name:</p>"
                    . "<input class='form-control' id='athleteFirstname' name='firstname' onchange='validate_athleteFirstname()' type='text' value='$row->firstname'></td>"
                    . "<div id='athleteFirstnameMessage'></div>"
                    . "<p>Last name:</p>"
                    . "<input class='form-control' id='athleteLastname' name='lastname' onchange='validate_athleteLastname()' type='text' value='$row->lastname'></td>"
                    . "<div id='athleteLastnameMessage'></div>"
                    . "<p>Age:</p>"
                    . "<input class='form-control' id='athleteAge' name='age' onchange='validate_athleteAge()' type='number' value='$row->age'></td>"
                    . "<div id='athleteAgeMessage'></div>"
                    . "<p>Nationality:</p>"
                    . "<input class='form-control' id='athleteNationality' name='nationality' onchange='validate_athleteNationality()' type='text' value='$row->nationality'></td>"
                    . "<div id='athleteNationalityMessage'></div>"
                    . "<p>Gender:</p>"
                    . "<select class='form-control' id='athleteGender' name='gender' value='$row->gender' readonly>
                        <option>Male</option>
                        <option>Female</option>
                   </select>"
                    . "<p>Sport:</p>"
                    . "<select class='form-control' id='athleteSport' name='sport' value='$row->sport' readonly>
                       <option>Cross-country</option>
                       <option>Nordic combined</option>
                       <option>Ski jumping</option>
                    </select> ";
            }
        }
        // Close database connection.
        $db->close();

    }
}

function populateEventForm()
{
    if (isset($_GET["id"])) {
        // Connect to database.
        $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
        if ($db->connect_error) {
            trigger_error($db->connect_error);
        }

        $id = $_GET['id'];

        $sql = "SELECT description, gender, sport, datetime "
            . "FROM Event "
            . "WHERE EventID = $id ";

        $result = $db->query($sql);
        if ($db->affected_rows > 0) {
            $numRows = $db->affected_rows;
            for ($i = 0; $i < $numRows; $i++) {
                $row = $result->fetch_object();
                echo "<input class='form-control' name='eventID'  type='hidden' value='$id'></td>"
                    ."<p>Description:</p>"
                    . "<input class='form-control' name='description' type='text' value='$row->description'></td>"
                    . "<p>Sport:</p>"
                    . "<input class='form-control' name='gender' type='text' value='$row->sport' readonly></td>"
                    . "<p>Gender:</p>"
                    . "<input class='form-control' name='sport' type='text' value='$row->gender' readonly></td>"
                    . "<p>Datetime</p>"
                    . "<input class='form-control' name='datetime' type='text' value='$row->datetime'/>";
            }
        }
        // Close database connection.
        $db->close();

    }
}

function populateEventsDropdown() {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }
    // Execute SQL query.
    $sql = "SELECT EventID, gender, sport, description, datetime "
             . "FROM Event "
             . "ORDER BY datetime ASC;";
    $result = $db->query($sql);
    // Echo out all rows.
    if($db->affected_rows>0) {
        $numRows = $db->affected_rows;
        for ($i=0;$i<$numRows;$i++) {
            $row = $result->fetch_object();
            //$date = DateTime::createFromFormat("m-d-y", $row->datetime);
            //$dateString = $date->format("l, F jS Y");
            if ($row->gender == "Male") {
                $gender = "Men's";
            } else {
                $gender = "Women's";
            }
            echo "<option value='$row->EventID'>$gender $row->sport - $row->description </option>";
        }
    }
    // Close database connection.
    $db->close();
}

function populateEventSpectatorTable() {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }
    // Get the ID of the logged in spectator.
    $id = $_SESSION["spectatorID"];
    // Execute SQL query.
    $sql = "SELECT description, datetime, gender, sport "
        . "FROM Event "
        . "JOIN EventSpectator ON Event.EventID = EventSpectator.Event "
        . "WHERE EventSpectator.Spectator LIKE $id "
        . "ORDER BY datetime ASC;";
    $result = $db->query($sql);
    // Echo out all rows.
    if ($db->affected_rows > 0) {
        $numRows = $db->affected_rows;
        for ($i = 0; $i < $numRows; $i++) {
            $row = $result->fetch_object();
            $date = DateTime::createFromFormat("m-d-y", $row->datetime);
            $dateString = $date->format("F jS Y");
            if ($row->gender == "Male") {
                $gender = "Men's";
            } else {
                $gender = "Women's";
            }
            echo "<tr><td>$dateString</td>"
                . "<td>$gender $row->sport</td>"
                . "<td>$row->description</td>";
        }
    }
    // Close database connection.
    $db->close();
}

function populateEventsTable() {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }
    // Execute SQL query.
    $sql = "SELECT EventID, description, datetime, gender, sport "
         . "FROM Event "
         . "ORDER BY datetime ASC;";
    $result = $db->query($sql);
    // Echo out all rows.
    if ($db->affected_rows > 0) {
        $numRows = $db->affected_rows;
        for ($i = 0; $i < $numRows; $i++) {
            $row = $result->fetch_object();
            $date = DateTime::createFromFormat("m-d-y", $row->datetime);
            $dateString = $date->format("F jS Y");
            if ($row->gender == "Male") {
                $gender = "Men's";
            } else {
                $gender = "Women's";
            }
            if (isset($_SESSION["adminloggedin"]) && $_SESSION["adminloggedin"]) {
                echo "<tr><td>$dateString</td>"
                    . "<td>$gender $row->sport</td>"
                    . "<td>$row->description</td>"
                    . "<td>"//<form method='POST' action=''>"
                    . "<a href='editEvent.php?id=$row->EventID'><button class='btn btn-sm btn-warning'>Edit</button></a> "
                    . "<a href='events.php?deleteID=$row->EventID'><button class='btn btn-sm btn-danger'>Delete</button></a>"
                    . "</td></tr>";
            } else if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
                echo "<tr><td>$dateString</td>"
                    . "<td>$gender $row->sport</td>"
                    . "<td>$row->description</td>";
                // Execute SQL query.
                $sql = "SELECT Event "
                    . "FROM EventSpectator "
                    . "WHERE EventSpectator.Spectator LIKE " . $_SESSION['spectatorID'] . " "
                    . "AND EventSpectator.Event LIKE " . $row->EventID . ";";
                $result2 = $db->query($sql);
                if ($db->affected_rows == 1) {
                    $row2 = $result2->fetch_object();
                    echo "<td><a href='events.php?checkoutID=$row2->Event'>"
                        . "<button class='btn btn-sm btn-warning'>Check out</button></a></td></tr>";
                } else {
                    echo "<td><a href='events.php?checkinID=$row->EventID'>"
                        . "<button class='btn btn-sm btn-success'>Check in</button></a></td></tr>";
                }
            }
        }
    }
    // Close database connection.
    $db->close();
}

//======================================================================
// REGISTER FUNCTIONS
//======================================================================

function registerAdmin() {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }

    #regAdmin via POST-calls and call save_to_DB-method.
    $firstname = $db->real_escape_string($_POST["firstname"]);
    $lastname = $db->real_escape_string($_POST["lastname"]);
    $phoneNr = $db->real_escape_string($_POST["phoneNr"]);
    $username = $db->real_escape_string($_POST["username"]);
    $password = $db->real_escape_string($_POST["password"]);

    // check if admin already exists
    $sql = "SELECT A.username FROM Admin AS A WHERE A.username = '".$username."';";
    $row = $db->query($sql);
    $exists = mysqli_num_rows($row) != 0;

    $okRegex = true;
    //REGEX
    if (!preg_match("/^[A-Za-z\\- ]{2,20}$/",$firstname) ){
        $okRegex = false;
        echo "Firstname can only include english letters, hyphen (-) and space. It must be between 2 and 20 characters<br><br>";
    } else if (!preg_match("/^[A-Za-z\\- ]{2,20}$/",$lastname)){
        $okRegex = false;
        echo "Lastname can only include english letters, hyphen (-) and space. It must be between 2 and 20 characters<br><br>";
    } else if (!preg_match("/^[0-9]{8}$/",$phoneNr)) {
        $okRegex = false;
        echo "Phone number can only include digits. It must be between 8 and 15 characters<br><br>";
    } else if (!preg_match("/^[A-Za-z\\-]{2,20}$/",$username)) {
        $okRegex = false;
        echo "Username can only include english letters, digits and hyphen (-). It must be between 6 and 20 characters<br><br>";
    } else if (!preg_match("/^[A-Za-z0-9\\-]{6,20}$/",$password)) {
        $okRegex = false;
        echo "Password can only include english letters, digits and hyphen (-). It must be between 6 and 20 characters<br><br>";
    }


    if($okRegex) {
    $admin = new Admin($firstname, $lastname, $phoneNr, $username, $password);

    $okTransaction = true;
    if (!$exists) {
        if (!$admin->save_to_db($db) || $db->affected_rows == 0) {
            $okTransaction = false;
        }
    }
    if ($okTransaction) {
        $db->commit();
    } else {
        $db->rollback();
        ob_start();
        //header("Location: feilmelding.html");
        ob_flush();
    }
    }
    // Close database connection.
    $db->close();
}

function registerSpectator() {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }

    #regSpecator via POST-calls and call save_to_DB-method.
    $firstname = $db->real_escape_string($_POST["firstname"]);
    $lastname = $db->real_escape_string($_POST["lastname"]);
    $phoneNr = $db->real_escape_string($_POST["phoneNr"]);
    $email = $db->real_escape_string($_POST["email"]);
    $username = $db->real_escape_string($_POST["username"]);
    $password = $db->real_escape_string($_POST["password"]);

    $okRegex = true;
    //REGEX
    if (!preg_match("/^[A-Za-z\\- ]{2,20}$/",$firstname) ){
        $okRegex = false;
        echo "Firstname can only include english letters, hyphen (-) and space. It must be between 2 and 20 characters<br><br>";
    } else if (!preg_match("/^[A-Za-z\\- ]{2,20}$/",$lastname)){
        $okRegex = false;
        echo "Lastname can only include english letters, hyphen (-) and space. It must be between 2 and 20 characters<br><br>";
    } else if (!preg_match("/^[0-9]{8}$/",$phoneNr)) {
        $okRegex = false;
        echo "Phone number can only include digits. It must be between 8 and 15 characters<br><br>";
    } else if (!preg_match("/^[A-Za-z\\-]{2,20}$/",$username)) {
        $okRegex = false;
        echo "Username can only include english letters, digits and hyphen (-). It must be between 2 and 20 characters<br><br>";
    } else if (!preg_match("/^[A-Za-z0-9\\-]{6,20}$/",$password)) {
        $okRegex = false;
        echo "Password can only include english letters, digits and hyphen (-). It must be between 6 and 20 characters<br><br>";
    }

    if($okRegex) {
        $spectator = new Spectator($firstname, $lastname, $phoneNr, $email, $username, $password);

        $okTransaction = true;
        #TODO: Hente ut ID for Spectator her?
        if (!$spectator->save_to_db($db) || $db->affected_rows == 0) {
            $okTransaction = false;
        }
        if ($okTransaction) {
            $db->commit();
        } else {
            $db->rollback();
            ob_start();
            //header("Location: feilmelding.html");
            ob_flush();
        }
    }
    // Close database connection.
    $db->close();
}

function registerAthlete() {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }

    #regAthelete via POST-calls and call save_to_DB-method.
    $firstname = $db->real_escape_string($_POST["firstname"]);
    $lastname = $db->real_escape_string($_POST["lastname"]);
    $age = $db->real_escape_string($_POST["age"]);
    $nationality = $db->real_escape_string($_POST["nationality"]);
    $gender = $db->real_escape_string($_POST["gender"]);
    $sport = $db->real_escape_string($_POST["sport"]);

    $okRegex = true;
    //REGEX
    if (!preg_match("/^[A-Za-z\\- ]{2,20}$/",$firstname) ){
        $okRegex = false;
        echo "Firstname can only include english letters, hyphen (-) and space. It must be between 2 and 20 characters<br><br>";
    } if (!preg_match("/^[A-Za-z\\- ]{2,20}$/",$lastname)){
        $okRegex = false;
        echo "Lastname can only include english letters, hyphen (-) and space. It must be between 2 and 20 characters<br><br>";
    }  if (!preg_match("/^[0-9]{2}$/",$age)) {
        $okRegex = false;
        echo "Age can only include digits. It must be between 8 and 15 characters<br><br>";
    }  if (!preg_match("/^[A-Za-z\\- ]{2,20}$/",$nationality)) {
        $okRegex = false;
        echo "Nationality can only include english letters, digits and hyphen (-). It must be between 2 and 20 characters<br><br>";
    } if (!($gender == "Male" || $gender == "Female")) {
        $okRegex = false;
        echo "Invalid gender<br><br>";
    } if (!($sport == "Cross-country" || $sport == "Nordic combined" || $sport == "Ski jumping")) {
        $okRegex = false;
        echo "Please choose one of our available sports<br><br>";
    }

    if($okRegex) {

        $athlete = new Athlete($firstname, $lastname, $age, $nationality, $gender, $sport);

        $okTransaction = true;
        if (!$athlete->save_to_db($db) || $db->affected_rows == 0) {
            $okTransaction = false;
        }
        if ($okTransaction) {
            $athleteID = $db->insert_id;
            $db->commit();
        } else {
            $db->rollback();
            ob_start();
            //header("Location: feilmelding.html");
            ob_flush();
        }

        if (isset($_POST["events"])) {
            #regEventAthlete via POST-calls and call save_to_DB-method.

            foreach ($_POST['events'] as $value) {
                $eventID = $value;
                $eventAthlete = new EventAthlete($eventID, $athleteID);
                $okTransaction = true;
                if (!$eventAthlete->save_to_db($db) || $db->affected_rows == 0) {
                    $okTransaction = false;
                }
                if ($okTransaction) {
                    $db->commit();
                } else {
                    $db->rollback();
                    ob_start();
                    header("Location: feilmelding.html");
                    ob_flush();
                }
            }
        } else {
            header("Location:index.php");
        }
    }

    // Close database connection.
    $db->close();
}

function registerEvent() {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }
    #regEvent via POST-calls and call save_to_DB-method.
    $description = $db->real_escape_string($_POST["description"]);
    $datetime = date("d-m-y", strtotime($db->real_escape_string($_POST["datetime"])));
    $gender = $db->real_escape_string($_POST["gender"]);
    $sport = $db->real_escape_string($_POST["sport"]);

    $okRegex = true;
    //REGEX
    if (!preg_match("/^[A-Za-z0-9\\- ]{2,255}$/",$description) ){
        $okRegex = false;
        echo "Description can only include english letters, digits, hyphen (-) and space. It must be between 2 and 255 characters<br><br>";
    } if (!preg_match("/^[0-9]{2}\\/[0-9]{2}\\/2019$/",$datetime)){
        echo "You must choose a date in 2019<br><br>";
        $okRegex = false;
    } if (!($gender == "Male" || $gender == "Female")) {
        $okRegex = false;
        echo "Invalid gender<br><br>";
    } if (!($sport == "Cross-country" || $sport == "Nordic combined" || $sport == "Ski jumping")) {
        $okRegex = false;
        echo "Please choose one of our available sports<br><br>";
    }

    if($okRegex) {

        $event = new Event($description, $datetime, $gender, $sport);

        $okTransaction = true;
        if (!$event->save_to_db($db) || $db->affected_rows == 0) {
            $okTransaction = false;
        }
        if ($okTransaction) {
            $eventID = $db->insert_id;
            $db->commit();
        } else {
            $db->rollback();
            ob_start();
            //header("Location: feilmelding.html");
            ob_flush();
        }

        if (isset($_POST["athletes"])) {
            #regEventAthlete via POST-calls and call save_to_DB-method.

            foreach ($_POST['athletes'] as $value) {
                $athleteID = $value;
                $eventAthlete = new EventAthlete($eventID, $athleteID);
                $okTransaction = true;
                if (!$eventAthlete->save_to_db($db) || $db->affected_rows == 0) {
                    $okTransaction = false;
                }
                if ($okTransaction) {
                    $db->commit();
                } else {
                    $db->rollback();
                    ob_start();
                    header("Location: feilmelding.html");
                    ob_flush();
                }
            }
        } else {
            header("Location:index.php");
        }
    }

    // Close database connection.
    $db->close();
}

function registerEventAthlete() {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }

    #regEventAthlete via POST-calls and call save_to_DB-method.
    $athleteID = $db->real_escape_string($_POST["AthleteID"]);
    $eventID = $db->real_escape_string($_POST["EventID"]);

    $eventAthlete = new EventAthlete($eventID, $athleteID);

    $okTransaction = true;
    if (!$eventAthlete->save_to_db($db) || $db->affected_rows == 0) {
        $okTransaction = false;
    }
    if ($okTransaction) {
        $db->commit();
    } else {
        $db->rollback();
        ob_start();
        //header("Location: feilmelding.html");
        ob_flush();
    }
    // Close database connection.
    $db->close();
}

//======================================================================
// CHECK IN AND OUT FUNCTIONS
//======================================================================

function checkin($eventID) {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }
    // Get the ID of the logged in spectator.
    $spectatorID = $_SESSION["spectatorID"];
    // Execute SQL query.
    $sql = "INSERT INTO EventSpectator (Event, Spectator) "
        . "VALUES ('$eventID','$spectatorID')";
    $db->query($sql);
    // Close database connection.
    $db->close();
}

function checkout($eventID) {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }
    // Get the ID of the logged in spectator.
    $spectatorID = $_SESSION["spectatorID"];
    // Execute SQL query.
    $sql = "DELETE FROM EventSpectator "
        . "WHERE Event = '$eventID' "
        . "AND Spectator = '$spectatorID'";
    $db->query($sql);
    // Close database connection.
    $db->close();
}

//======================================================================
// OTHER FUNCTIONS TODO: Fix and categorize these
//======================================================================


/*$



function registerEventSpectator() {
    #regEventSpectator via POST-calls and call save_to_DB-method.
    $spectatorID = $db->real_escape_string($_POST["SpectatorID"]);
    $eventID = $db->real_escape_string($_POST["EventID"]);

    $eventSpectator = new EventSpectator($eventID, $spectatorID);

    $okTransaction = true;
    if (!$event->save_to_db($db) || $db->affected_rows == 0) {
        $okTransaction = false;
    }
    if ($okTransaction) {
        $db->commit();
    } else {
        $db->rollback();
        ob_start();
        //header("Location: feilmelding.html");
        ob_flush();
    }
    //mysqli_close($db); #TODO: LUKKE HER?
}*/

/*  TODO: DO WE NEED THESE??
 *
 * function listAllSpectators() {

    $sql = "Select username, firstname, lastname, phonenumber, email from Spectator ";
    $resultat = $db->query($sql);

    if($db->affected_rows>0)
    {
        $antallRader = $db->affected_rows;
        echo "Antall rader funnet : $antallRader <br/>";
        for ($i=0;$i<$antallRader;$i++)
        {
            $rad = $resultat->fetch_object();
            echo $rad->username." ".$rad->firstname." ".$rad->lastname." ".$rad->phonenumber." ".$rad->email."<br/>";
        }

    }
    else
    {
        echo "Fant ingen rader som oppfylte søket!";
    }
    $db->close();
}*/
?>