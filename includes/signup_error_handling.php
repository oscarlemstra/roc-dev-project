<?php

function emailCheck($email, $dbm) {
    $error = false;
    $errorMessage = '';

    if ($email === '') {
        $error = true;
        $errorMessage = 'email vak is niet ingevuld';
    }

    // split email at '@' and check if there are more than 2 items in the array
    // indicating that 2 or more '@' has been used
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !$error) {
        $error = true;
        $errorMessage = 'email vak heeft geen email formaat erin';
    }
    
    // check if email ends with 'talnet.nl' or 'student.rocvf.com'
    if ($splitEmail[count($splitEmail) - 1] !== "talnet.nl" && !$error) {
        $error = true;
        $errorMessage = 'email is niet een school email adress';
    }

    if ($dbm->getRecordsFromTable("user", "email", $email)) {
        $error = true;
        $errorMessage = 'email adres is al in gebruik';
    }

    if ($error) {
        return $errorMessage;
    } else {
        return false;
    }
}


function pwdCheck($pwd, $confirmpwd, $email) {
    $error = false;
    $errorMessage = '';

    if ($pwd === '' || $confirmpwd === '') {
        $error = true;
        $errorMessage = 'wachtwoord vak is niet ingevuld';
    }

    if (strlen($pwd) < 8 && !$error) {
        $error = true;
        $errorMessage = 'wachtwoord 8 of meer characters hebben';
    }

    if (!preg_match('~[0-9]+~', $pwd) && !$error) {
        $error = true;
        $errorMessage = 'wachtwoord heeft ook een nummer nodig';
    }

    if (!preg_match('/[A-Za-z]/', $pwd) && !$error) {
        $error = true;
        $errorMessage = 'wachtwoord heeft ook een letter nodig';
    }

    if (!preg_match('/[A-Z]/', $pwd) && !$error) {
        $error = true;
        $errorMessage = 'wachtwoord heeft tenminste 1 hoofdletter nodig';
    }

    $splitEmail = explode('@', $email);
    $splitEmail = strtolower($splitEmail[0]);
    $lowercasePwd = strtolower($pwd);
    if (strpos($lowercasePwd, $splitEmail) && !$error) {
        $error = true;
        $errorMessage = 'wachtwoord kan niet email naam bevatten';
    }

    if ($pwd !== $confirmpwd) {
        $error = true;
        $errorMessage = 'wachtwoorden moeten hetzelfde zijn';
    }

    if ($error) {
        return $errorMessage;
    } else {
        return false;
    }
}
