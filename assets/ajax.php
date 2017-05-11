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
            . "WHERE EventAthlete.Event LIKE " . $id;
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
?>