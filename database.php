<?php
/**
 * Created by PhpStorm.
 * User: ssandoy
 * Date: 06.04.2017
 * Time: 14.08
 */

include("classes.php");
$db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
if ($db->connect_error) {
    echo "Feil i databasetilknytningen";
    trigger_error($db->connect_error);
}


if(isset($_POST["regAdmin"]))
{
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

if(isset($_POST["regAthlete"]))
{
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

if(isset($_POST["regEvent"]))
{
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

if(isset($_POST["regSpectator"]))
{
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


if(isset($_POST["regEventAthlete"]))
{
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

if(isset($_POST["regEventSpectator"]))
{
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
    mysqli_close($db); #TODO: LUKKE HER?
}


if(isset($_GET["listAllAthletes"]))
{

    $sql = "Select firstname, lastname, age, nationality from Athlete ";
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

if(isset($_GET["listAllSpectators"]))
{

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

if(isset($_GET["listEventAthletes"]))
{
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



?>