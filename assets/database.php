<?php

include("classes.php");

$db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
if ($db->connect_error) {
    echo "Feil i databasetilknytningen";
    trigger_error($db->connect_error);
}

function registerAdmin() {
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
    //mysqli_close($db); #TODO: LUKKE HER?
}

function registerAthlete() {
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
    //mysqli_close($db); #TODO: LUKKE HER?
}

function registerEvent() {
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
    //mysqli_close($db); #TODO: LUKKE HER?
}

function registerSpectator() {
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
    //mysqli_close($db); #TODO: LUKKE HER?
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
}


function populateAthletesTable() {
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        echo "Feil i databasetilknytningen";
        trigger_error($db->connect_error);
    }

    $sql = "Select firstname, lastname, age, nationality from Athlete ";
    $resultat = $db->query($sql);

    if($db->affected_rows>0)
    {
        $antallRader = $db->affected_rows;
        echo "Antall rader funnet : $antallRader <br/>";
        for ($i=0;$i<$antallRader;$i++)
        {
            $rad = $resultat->fetch_object();
            echo "<td>$rad->firstname</td>
                  <td>$rad->lastname</td>
                  <td>$rad->age</td>
                  <td>$rad->nationality</td>";
        }

    }
    else
    {
        echo "Fant ingen rader som oppfylte søket!";
    }
    $db->close();
}

function listAllSpectators() {

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
}

function listEventAthletes() {
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
}

function getNextEvent() {
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        echo "Feil i databasetilknytningen";
        trigger_error($db->connect_error);
    }

    $sql = "SELECT description, datetime, gender, sport "
         . "FROM Event "
         . "ORDER BY datetime ASC "
         . "LIMIT 1";
    $resultat = $db->query($sql);

    if($db->affected_rows>0) {
        $rad = $resultat->fetch_object();
        $date = DateTime::createFromFormat("m-d-y", $rad->datetime);
        $dateString = $date->format("l, F jS Y");
        if ($rad->gender == "Male") {
            $gender = "Men's";
        } else {
            $gender = "Women's";
        }
        echo "<h4 class='nextEvent'>$dateString</h4>"
           . "<h3 class='nextEvent'>$rad->description</h3>"
           . "<h4 class='nextEvent'>$gender $rad->sport</h4>";
    } else {
        echo "<p>There are no more events</p>";
    }

    $db->close();
}
?>