
/*
 * ADMIN REGISTRATION VALIDATION
 */

function validate_adminUsername() {
    var regex = new RegExp(/^[A-Za-z\-]{2,20}$/);
    var value = document.getElementById("adminUsername").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("adminUsernameMessage").innerHTML = "<div class='alert alert-danger'>Username can "
            + "only include english letters and hyphen (-). It must be between 2 and 20 characters</div>";
    } else {
        document.getElementById("adminUsernameMessage").innerHTML = "";
    }
    return ok;
}

function validate_adminPassword() {
    var regex = new RegExp(/^[A-Za-z0-9\-]{6,20}$/);
    var value = document.getElementById("adminPassword").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("adminPasswordMessage").innerHTML = "<div class='alert alert-danger'>Password can "
            + "only include english letters, digits and hyphen (-). It must be between 6 and 20 characters</div>";
    } else {
        document.getElementById("adminPasswordMessage").innerHTML = "";
    }
    return ok;
}

function validate_adminFirstname() {
    var regex = new RegExp(/^[A-Za-z\- ]{2,20}$/);
    var value = document.getElementById("adminFirstname").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("adminFirstnameMessage").innerHTML = "<div class='alert alert-danger'>Firstname can "
            + "only include english letters, hyphen (-) and space. It must be between 2 and 20 characters</div>";
    } else {
        document.getElementById("adminFirstnameMessage").innerHTML = "";
    }
    return ok;
}

function validate_adminLastname() {
    var regex = new RegExp(/^[A-Za-z\- ]{2,20}$/);
    var value = document.getElementById("adminLastname").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("adminLastnameMessage").innerHTML = "<div class='alert alert-danger'>Lastname can "
            + "only include english letters, hyphen (-) and space. It must be between 2 and 20 characters</div>";
    } else {
        document.getElementById("adminLastnameMessage").innerHTML = "";
    }
    return ok;
}

function validate_adminPhoneNr() {
    var regex = new RegExp(/^[0-9]{8,15}$/);
    var value = document.getElementById("adminPhoneNr").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("adminPhoneNrMessage").innerHTML = "<div class='alert alert-danger'>Phone number can "
            + "only include digits. It must be between 8 and 15 characters</div>";
    } else {
        document.getElementById("adminPhoneNrMessage").innerHTML = "";
    }
    return ok;
}

function validate_admin() {
    var ok = validate_adminUsername();
    ok = (validate_adminPassword() && ok);
    ok = (validate_adminLastname() && ok);
    ok = (validate_adminFirstname() && ok);
    return (validate_adminPhoneNr() && ok);
}

/*
 * ATHLETE REGISTRATION VALIDATION
 */

function validate_athleteFirstname() {
    var regex = new RegExp(/^[A-Za-z\- ]{2,20}$/);
    var value = document.getElementById("athleteFirstname").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("athleteFirstnameMessage").innerHTML = "<div class='alert alert-danger'>Firstname can "
            + "only include english letters, hyphen (-) and space. It must be between 2 and 20 characters</div>";
    } else {
        document.getElementById("athleteFirstnameMessage").innerHTML = "";
    }
    return ok;
}

function validate_athleteLastname() {
    var regex = new RegExp(/^[A-Za-z\- ]{2,20}$/);
    var value = document.getElementById("athleteLastname").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("athleteLastnameMessage").innerHTML = "<div class='alert alert-danger'>Lastname can "
            + "only include english letters, hyphen (-) and space. It must be between 2 and 20 characters</div>";
    } else {
        document.getElementById("athleteLastnameMessage").innerHTML = "";
    }
    return ok;
}

function validate_athleteAge() {
    var regex = new RegExp(/^[0-9]{2}$/);
    var value = document.getElementById("athleteAge").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("athleteAgeMessage").innerHTML = "<div class='alert alert-danger'>Age must be a 2 "
            + " digit number</div>";
    } else {
        document.getElementById("athleteAgeMessage").innerHTML = "";
    }
    if (value > 50) {
        document.getElementById("athleteAge").value = 50;
        document.getElementById("athleteAgeMessage").innerHTML = "";
        ok = true;
    } else if (value < 16) {
        document.getElementById("athleteAge").value = 16;
        document.getElementById("athleteAgeMessage").innerHTML = "";
        ok = true;
    }
    return ok;
}

function validate_athleteNationality() {
    var regex = new RegExp(/^[A-Za-z\- ]{2,20}$/);
    var value = document.getElementById("athleteNationality").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("athleteNationalityMessage").innerHTML = "<div class='alert alert-danger'>Nationality "
            + " can only include english letters, hyphen (-) and space. It must be between 2 and 20 characters</div>";
    } else {
        document.getElementById("athleteNationalityMessage").innerHTML = "";
    }
    return ok;
}

function validate_athlete() {
    var ok = validate_athleteFirstname();
    ok = (validate_athleteLastname() && ok);
    ok = (validate_athleteAge() && ok);
    return (validate_athleteNationality() && ok);
}

/*
 * EVENT REGISTRATION VALIDATION
 */

function validate_eventDescription() {
    var regex = new RegExp(/^[A-Za-z0-9\- ]{2,255}$/);
    var value = document.getElementById("eventDescription").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("eventDescriptionMessage").innerHTML = "<div class='alert alert-danger'>Description "
            + "can only include english letters, digits, hyphen (-) and space. It must be between 2 and 255 "
            + "characters</div>";
    } else {
        document.getElementById("eventDescriptionMessage").innerHTML = "";
    }
    return ok;
}

function validate_eventDatetime() {
    var regex = new RegExp(/^2019\-[0-9]{2}\-[0-9]{2}$/);
    var value = document.getElementById("eventDatetime").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("eventDatetimeMessage").innerHTML = "<div class='alert alert-danger'>You must choose a "
            + "legitimate date in 2019.</div>";
    } else {
        document.getElementById("eventDatetimeMessage").innerHTML = "";
    }
    return ok;
}

function validate_event() {
    var ok = validate_eventDescription();
    return (validate_eventDatetime() && ok);
}

/*
 * SPECTATOR REGISTRATION VALIDATION
 */

function validate_spectatorUsername() {
    var regex = new RegExp(/^[A-Za-z\-]{2,20}$/);
    var value = document.getElementById("spectatorUsername").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("spectatorUsernameMessage").innerHTML = "<div class='alert alert-danger'>Username can "
            + "only include english letters and hyphen (-). It must be between 2 and 20 characters</div>";
    } else {
        document.getElementById("spectatorUsernameMessage").innerHTML = "";
    }
    return ok;
}

function validate_spectatorPassword() {
    var regex = new RegExp(/^[A-Za-z0-9\-]{6,20}$/);
    var value = document.getElementById("spectatorPassword").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("spectatorPasswordMessage").innerHTML = "<div class='alert alert-danger'>Password can "
            + "only include english letters, digits and hyphen (-). It must be between 6 and 20 characters</div>";
    } else {
        document.getElementById("spectatorPasswordMessage").innerHTML = "";
    }
    return ok;
}

function validate_spectatorFirstname() {
    var regex = new RegExp(/^[A-Za-z\- ]{2,20}$/);
    var value = document.getElementById("spectatorFirstname").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("spectatorFirstnameMessage").innerHTML = "<div class='alert alert-danger'>Firstname can "
            + "only include english letters, hyphen (-) and space. It must be between 2 and 20 characters</div>";
    } else {
        document.getElementById("spectatorFirstnameMessage").innerHTML = "";
    }
    return ok;
}

function validate_spectatorLastname() {
    var regex = new RegExp(/^[A-Za-z\- ]{2,20}$/);
    var value = document.getElementById("spectatorLastname").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("spectatorLastnameMessage").innerHTML = "<div class='alert alert-danger'>Lastname can "
            + "only include english letters, hyphen (-) and space. It must be between 2 and 20 characters</div>";
    } else {
        document.getElementById("spectatorLastnameMessage").innerHTML = "";
    }
    return ok;
}

function validate_spectatorPhoneNr() {
    var regex = new RegExp(/^[0-9]{8,15}$/);
    var value = document.getElementById("spectatorPhoneNr").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("spectatorPhoneNrMessage").innerHTML = "<div class='alert alert-danger'>Phone number can "
            + "only include digits. It must be between 8 and 15 characters</div>";
    } else {
        document.getElementById("spectatorPhoneNrMessage").innerHTML = "";
    }
    return ok;
}

function validate_spectatorEmail() {
    var regex = new RegExp(/^[a-z0-9.\-_]{2,20}@[a-z0-9.\-_]{2,20}.[a-z]{2,4}$/);
    var value = document.getElementById("spectatorEmail").value;
    var ok = regex.test(value);
    if (!ok) {
        document.getElementById("spectatorEmailMessage").innerHTML = "<div class='alert alert-danger'>Email can only "
            + "include small english letters, hyphen (-) and underscore (_). It must be between 2 and 20 characters."
            + "The same applies to the domain name";
    } else {
        document.getElementById("spectatorEmailMessage").innerHTML = "";
    }
    return ok;
}

function validate_spectator() {
    var ok = validate_spectatorUsername();
    ok = (validate_spectatorPassword() && ok);
    ok = (validate_spectatorFirstname() && ok);
    ok = (validate_spectatorLastname() && ok);
    ok = (validate_spectatorPhoneNr() && ok);
    return (validate_spectatorEmail() && ok);
}