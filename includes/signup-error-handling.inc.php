<?php

// =================================================================== //
//
// Code by: Thijn
//
// used for:
// signup.inc.php
//
// path:
// ../includes/signup.inc.php
//
// Copyright (c) Thijn Douwma
// fuck you get your own code
// 
// =================================================================== //


function emailCheck($email, $confirmEmail) {
    $error = false;
    $errorMessage = '';

    if ($email === '' || $confirmEmail === '') {
        $error = true;
        $errorMessage = 'email is leeg';
    }

    // split email at '@' and check if last array item is not 'student.rocvf.nl'
    $splitEmail = explode('@', $email);
    if ($splitEmail[count($splitEmail) - 1] !== "student.rocvf.nl" && !$error) {
        $error = true;
        $errorMessage = 'email is niet een school email adress';
    }

    if ($email !== $confirmEmail && !$error) {
        $error = true;
        $errorMessage = 'emails zijn niet hetzelfde';
    }

    if (isset($error)) {
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
        $errorMessage = 'wachtwoord is leeg';
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

    if (isset($error)) {
        return $errorMessage;
    } else {
        return false;
    }
}

