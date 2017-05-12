<?php
if (isset($_POST["eventID"])) {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }
    // Get eventID.
    $id = $_POST["eventID"];
    // Execute SQL query.
    if ($id == 0) {
        $sql = "SELECT firstname, lastname, age, nationality, gender, sport "
            . "FROM Athlete;";
    } else {
        $sql = "SELECT firstname, lastname, age, nationality, gender, sport "
            . "FROM Athlete AS A "
            . "JOIN EventAthlete ON A.AthleteID = EventAthlete.Athlete "
            . "WHERE EventAthlete.Event LIKE $id";
    }
    $resultat = $db->query($sql);
    // Echo out all rows.
    if ($db->affected_rows > 0) {
        $antallRader = $db->affected_rows;
        for ($i = 0; $i < $antallRader; $i++) {
            $rad = $resultat->fetch_object();
            echo "<tr><td>$rad->firstname</td>"
                . "<td>$rad->lastname</td>"
                . "<td>$rad->age</td>"
                . "<td>$rad->nationality</td>"
                . "<td>$rad->gender</td>"
                . "<td>$rad->sport</td></tr>";
        }
    }
    // Close database connection.
    $db->close();
}

if (isset($_POST["athleteGender"]) && isset($_POST["athleteSport"])) {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }
    // Get gender and sport.
    $gender = $_POST["athleteGender"];
    $sport = $_POST["athleteSport"];
    // Execute SQL query.
    $sql = "SELECT description, datetime "
         . "FROM Event "
         . "WHERE gender = '$gender' AND sport = '$sport';";
    $resultat = $db->query($sql);
    // Echo out all rows.
    echo "<h3>Add athlete to events:</h3>";
    if ($db->affected_rows > 0) {
        $antallRader = $db->affected_rows;
        for ($i = 0; $i < $antallRader; $i++) {
            $rad = $resultat->fetch_object();
            echo "<div class='checkbox'><label><input type='checkbox'>$rad->description</label></div>";
        }
    } else {
        echo "<p>No events found.</p>";
    }
    // Close database connection.
    $db->close();
}

if (isset($_POST["eventGender"]) && isset($_POST["eventSport"])) {
    // Connect to database.
    $db = new mysqli("student.cs.hioa.no", "s236305", "", "s236305");
    if ($db->connect_error) {
        trigger_error($db->connect_error);
    }
    // Get gender and sport.
    $gender = $_POST["eventGender"];
    $sport = $_POST["eventSport"];
    // Execute SQL query.
    $sql = "SELECT firstname, lastname "
        . "FROM Athlete "
        . "WHERE gender = '$gender' AND sport = '$sport';";
    $resultat = $db->query($sql);
    // Echo out all rows.
    echo "<h3>Add athletes to event:</h3>";
    if ($db->affected_rows > 0) {
        $antallRader = $db->affected_rows;
        for ($i = 0; $i < $antallRader; $i++) {
            $rad = $resultat->fetch_object();
            echo "<div class='checkbox'><label><input type='checkbox'>$rad->firstname $rad->lastname</label></div>";
        }
    } else {
        echo "<p>No athletes found.</p>";
    }
    // Close database connection.
    $db->close();
}
?>