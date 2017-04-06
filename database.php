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
    #TODO: regAthlete via POST-calls and call save_to_DB-method.
    $lagreFornavn = $_POST["lagreFornavn"];
    $lagrePassord = $_POST["lagrePassord"];

    $sql = "Update ansatt Set Passord = Password('$lagrePassord') where Fornavn='$lagreFornavn'";
    $res = $db->query($sql);
    if($db->affected_rows>0)
    {
        echo "Oppdatering OK";
    }
    else
    {
        echo "Oppdatering ikke OK";
    }
}

if(isset($_POST["regEvent"]))
{
    #TODO: regEvent via POST-calls and call save_to_DB-method.
    $lagreFornavn = $_POST["lagreFornavn"];
    $lagrePassord = $_POST["lagrePassord"];

    $sql = "Update ansatt Set Passord = Password('$lagrePassord') where Fornavn='$lagreFornavn'";
    $res = $db->query($sql);
    if($db->affected_rows>0)
    {
        echo "Oppdatering OK";
    }
    else
    {
        echo "Oppdatering ikke OK";
    }
}