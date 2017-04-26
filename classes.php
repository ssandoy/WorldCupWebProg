<?php
/**
 * Created by PhpStorm.
 * User: ssandoy
 * Date: 06.04.2017
 * Time: 12.51
 */


class Admin {
    private $firstname;
    private $lastname;
    private $phoneNr;
    private $username;
    private $password;

    function __construct($fn, $ln, $pn, $us, $pw) {
        $this->firstname = $fn;
        $this->lastname = $ln;
        $this->phoneNr = $pn;
        $this->username = $us;
        $this->password = $pw;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getPhoneNr() {
        return $this->phoneNr;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    public function save_to_db($db) {
        $hash = hash("sha1", $this->password);
        $sql = "INSERT INTO Admin (firstname,lastname,phonenumber,username, password) ";
        $sql .= "VALUES ('$this->firstname','$this->lastname','$this->phoneNr','$this->username', '$hash')";
        $result = $db->query($sql);
        if (!$result) {
            trigger_error($db->error);
        }
        return $result;
    }
}

class Spectator {
    private $firstname;
    private $lastname;
    private $phoneNr;
    private $email;
    private $username;
    private $password;

    function __construct($fn, $ln, $pn, $em, $us, $pw) {
        $this->firstname = $fn;
        $this->lastname = $ln;
        $this->phoneNr = $pn;
        $this->email = $em;
        $this->username = $us;
        $this->password = $pw;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getPhoneNr() {
        return $this->phoneNr;
    }

    function getEmail() {
        return $this->email;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    #TODO: Implementere lagring i Event
    public function save_to_db($db) {
        $hash = hash("sha1", $this->password);
        $sql = "INSERT INTO Spectator (firstname,lastname,phonenumber,email,username, password) ";
        $sql .= "VALUES ('$this->firstname','$this->lastname','$this->phoneNr','$this->email','$this->username', '$hash')";
        $result = $db->query($sql);
        if (!$result) {
            trigger_error($db->error);
        }
        return $result;
    }
}

class Athlete {
    private $firstname;
    private $lastname;
    private $age;
    private $nationality;

    function __construct($fn, $ln, $ag, $nt) {
        $this->firstname = $fn;
        $this->lastname = $ln;
        $this->age = $ag;
        $this->nationality = $nt;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getAge() {
        return $this->age;
    }

    function getNationality() {
        return $this->nationality;
    }
    
    public function save_to_db($db) {
        $sql = "INSERT INTO Athlete (firstname,lastname,age,nationality) ";
        $sql .= "VALUES ('$this->firstname','$this->lastname','$this->age','$this->nationality')";
        $result = $db->query($sql);
        if (!$result) {
            trigger_error($db->error);
        }
        return $result;
    }
}

class Event {
    private $description;
    private $datetime;


    function __construct($ds, $dt) {
        $this->description = $ds;
        $this->datetime = $dt;
    }

    function getDescription() {
        return $this->description;
    }

    function getDatetime() {
        return $this->datetime;
    }

    public function save_to_db($db) {
        $sql = "INSERT INTO Event (description,datetime) ";
        $sql .= "VALUES ('$this->description','$this->datetime')";
        $result = $db->query($sql);
        if (!$result) {
            trigger_error($db->error);
        }
        return $result;
    }
}

class EventAthlete {
    private $event;
    private $athlete;

    function __construct($ev, $at) {
        $this->event = $ev;
        $this->athlete = $at;
    }

    public function save_to_db($db) {
        $sql = "INSERT INTO EventAthlete (Event,Athlete) ";
        $sql .= "VALUES ('$this->event','$this->athlete')";
        $result = $db->query($sql);
        if (!$result) {
            trigger_error($db->error);
        }
        return $result;
    }

}

class EventSpectator {
    private $event;
    private $spectator;

    function __construct($ev, $sp) {
        $this->event = $ev;
        $this->spectator = $sp;
    }

    public function save_to_db($db) {
        $sql = "INSERT INTO EventAthlete (Event,Spectator) ";
        $sql .= "VALUES ('$this->event','$this->spectator')";
        $result = $db->query($sql);
        if (!$result) {
            trigger_error($db->error);
        }
        return $result;
    }

}

?>