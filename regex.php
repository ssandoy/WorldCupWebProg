<?php
/**
 * Created by PhpStorm.
 * User: ssandoy
 * Date: 12.05.2017
 * Time: 22.32
 */

// Kjører regex på alle felt og escaper spesialtegn med real_escape_string()
$okRegex = true;
// Fornavn
$firstname = $_POST["firstname"];
if (!preg_match("/^[A-Za-zÆØÅæøå\- ]{2,20}$/",$firstname)) {
    echo "Fornavn kan kun inneholde norske bokstaver, bindestrek og mellomrom, og må være mellom 2 og 20 tegn.<br><br>";
    $okRegex = false;
}
// Etternavn
$lastname = $_POST["etternavn"];
if (!preg_match("/^[A-Za-zÆØÅæøå\- ]{2,20}$/",$lastname)) {
    echo "Etternavn kan kun inneholde norske bokstaver, bindestrek og mellomrom, og må være mellom 2 og 20 tegn.<br><br>";
    $okRegex = false;
}
// Telefon
$phonenr = $_POST["phoneNr"];
if (!preg_match("/^[0-9]{8}$/",$phonenr)) {
    echo "Telefonnummer må bestå av 8 siffer.<br><br>";
    $okRegex = false;
}
// E-post
$email = $_POST["email"];
if (!preg_match("/^[a-z0-9.\-_]{2,22}@[a-z0-9.\-_]{2,22}.[a-z]{2,4}$/",$email)) {
    echo "Epostadresse kan kun inneholde små bokstaver fra a til z, tall, punktum, bindestrek og understrek, og må være mellom 2 og 22 tegn. Det samme gjelder domenenavnet.<br><br>";
    $okRegex = false;
}
// PASSORD
$password = $_POST["password"];
if (!preg_match("(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}",$password)) {
    echo "Et passord består av minst 8 tegn, minst én stor og liten bokstav, samt minst et tall.<br><br>";
    $okRegex = false;
}

if (!$okRegex) {
    echo "<a href=\"index.html\">Gå tilbake til forsiden</a>";
    die;
}