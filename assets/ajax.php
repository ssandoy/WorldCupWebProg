<?php

// populateAthletesTable
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
            . "FROM Athlete "
            . "ORDER BY lastname DESC;";
    } else {
        $sql = "SELECT firstname, lastname, age, nationality, gender, sport "
            . "FROM Athlete "
            . "JOIN EventAthlete ON Athlete.AthleteID = EventAthlete.Athlete "
            . "WHERE EventAthlete.Event LIKE $id "
            . "ORDER BY lastname DESC;";
    }
    $result = $db->query($sql);
    // Echo out all rows.
    if ($db->affected_rows > 0) {
        $numRows = $db->affected_rows;
        for ($i = 0; $i < $numRows; $i++) {
            $row = $result->fetch_object();
            $lastname = strtoupper($row->lastname);
            echo "<tr><td><b>$lastname</b> $row->firstname</td>"
                . "<td>$row->age</td>"
                . "<td>$row->nationality</td>"
                . "<td>$row->gender</td>"
                . "<td>$row->sport</td></tr>";
        }
    } else {
        echo "<tr><td>No athletes found.</td></tr>";
    }
    // Close database connection.
    $db->close();
}

//populateEventCheckboxes
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
    $result = $db->query($sql);
    // Echo out all rows.
    echo "<h3>Add athlete to events</h3>"
        . "<hr>";
    if ($db->affected_rows > 0) {
        $numRows = $db->affected_rows;
        for ($i = 0; $i < $numRows; $i++) {
            $row = $result->fetch_object();
            echo "<div class='checkbox'><label><input type='checkbox'>$row->description</label></div>";
        }
    } else {
        echo "<p>No events found.</p>";
    }
    // Close database connection.
    $db->close();
}

// populateAthleteCheckboxes
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
    $result = $db->query($sql);
    // Echo out all rows.
    echo "<h3>Add athletes to event</h3>"
        . "<hr>";
    if ($db->affected_rows > 0) {
        $numRows = $db->affected_rows;
        for ($i = 0; $i < $numRows; $i++) {
            $row = $result->fetch_object();
            echo "<div class='checkbox'><label><input type='checkbox'>$row->firstname $row->lastname</label></div>";
        }
    } else {
        echo "<p>No athletes found.</p>";
    }
    // Close database connection.
    $db->close();
}
?>