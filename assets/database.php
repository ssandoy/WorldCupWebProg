<?php

include("classes.php");

//======================================================================
// DELETE FUNCTIONS
//======================================================================

function deleteAthlete() {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }

    // Get the ID of the logged in admin. T
    $id =  $_POST['athleteID'];  //FIXME
    // Execute SQL query.
    $sql = "Delete FROM Athlete"
        . "WHERE AthleteID = $id;";
    $result = $db->query($sql);

    if ($result === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $db->error;
    }
    // Close database connection.
    $db->close();
}

function deleteEvent() {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }

    // Get the ID of the logged in admin. T
    $id = $_POST['eventID'];//FIXME
    // Execute SQL query.
    $sql = "Delete FROM Event"
        . "WHERE EventID = $id;";
    $result = $db->query($sql);

    if ($result === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $db->error;
    }
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

    $sql = "UPDATE Admin SET firstname=$firstname,lastname=$lastname,phonenumber=$phoneNr,username=$username, password=Password('$password') ";
    $sql .= " WHERE AdminID = $id;";

    $result = $db->query($sql);

    if ($result === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $db->error;
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
    $eventGender = $db->real_escape_string($_POST["eventGender"]);
    $eventSport = $db->real_escape_string($_POST["eventSport"]);

    $sql = "UPDATE Event SET description = $description,datetime = $datetime,gender = $eventGender,sport = $eventSport";
    $sql .= " WHERE EventID = $id;";

    $result = $db->query($sql);

    if ($result === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $db->error;
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

    #editAdmin via POST-calls and update db.
    $id = $db->real_escape_string($_POST["athleteID"]);
    $firstname = $db->real_escape_string($_POST["firstname"]);
    $lastname = $db->real_escape_string($_POST["lastname"]);
    $age = $db->real_escape_string($_POST["age"]);
    $nationality = $db->real_escape_string($_POST["nationality"]);
    $gender = $db->real_escape_string($_POST["athleteGender"]);
    $sport = $db->real_escape_string($_POST["athleteSport"]);

    $sql = "UPDATE Athlete SET firstname=$firstname,lastname=$lastname,age=$age,nationality=$nationality,gender=$gender,sport=$sport";
    $sql .= " WHERE Athlete = $id;";

    $result = $db->query($sql);

    if ($result === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $db->error;
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
            $date = DateTime::createFromFormat("m-d-y", $row->datetime);
            $dateString = $date->format("l, F jS Y");
            if ($row->gender == "Male") {
                $gender = "Men's";
            } else {
                $gender = "Women's";
            }
            echo "<option value='$row->EventID'>$gender $row->sport - $row->description ($dateString)</option>";
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
    // Get the ID of the logged in spectator. TODO
    $id = 1;
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
                . "<td>$row->description</td></tr>";
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
    $sql = "SELECT description, datetime, gender, sport "
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
            echo "<tr><td>$dateString</td>"
                . "<td>$row->sport</td>"
                . "<td>$gender</td>"
                . "<td>$row->description</td></tr>";
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

    $athlete = new Athlete($firstname, $lastname, $age, $nationality);

    $okTransaction = true;
    if (!$athlete->save_to_db($db) || $db->affected_rows == 0) {
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

function registerEvent() {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }
    #regEvent via POST-calls and call save_to_DB-method.
    $description = $db->real_escape_string($_POST["description"]);
    $datetime = $db->real_escape_string($_POST["datetime"]);

    $event = new Event($description, $datetime);

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
    // Close database connection.
    $db->close();
}


//======================================================================
// OTHER FUNCTIONS TODO: Fix and categorize these
//======================================================================


/*$db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
if ($db->connect_error) {
    echo "Feil i databasetilknytningen";
    trigger_error($db->connect_error);
}









function registerEventAthlete() {
    #regEventAthlete via POST-calls and call save_to_DB-method.
    $athleteID = $db->real_escape_string($_POST["AthleteID"]);
    $eventID = $db->real_escape_string($_POST["EventID"]);

    $eventAthlete = new EventAthlete($eventID, $athleteID);

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
}

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

/*function listEventAthletes() {
    $eventID = $_GET["eventID"];
    $sql = "Select A.firstname, A.lastname, A.age, A.nationality from Athlete as A";
    $sql .= "JOIN EventAthlete ON A.AthleteID = EventAthlete.Athlete WHERE EventAthlete.Event LIKE ".$eventID;
    $resultat = $db->query($sql);

    if($db->affected_rows>0)
    {
        $antallRader = $db->affected_rows;
        echo "Antall rader funnet : $antallRader <br/>";
        for ($i=0;$i<$antallRader;$i++)
        {
            $rad = $resultat->fetch_object();
            echo $rad->firstname." ".$rad->lastname." ".$rad->age." ".$rad->nationality."<br/>";
        }

    }
    else
    {
        echo "Fant ingen rader som oppfylte søket!";
    }
    $db->close();
}*/
?>