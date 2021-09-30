<?php

// =================================================================== //
//
// Code by: Thijn
//
// used for:
// signup/index.php
//
// path:
// ../pages/signup/index.php
//
// external source's:
// signup-error-handling.php
// path: ../includes/signup-error-handling.php
//
// Copyright (c) Thijn Douwma
// fuck you get your own code
// 
// =================================================================== //

require_once('signup-error-handling.inc.php');

$email = $_POST['email'];
$confirmEmail = $_POST['confirmEmail'];

$pwd = $_POST['password'];
$confirmpwd = $_POST['confirmPassword'];


$result = emailCheck($email, $confirmEmail);
if ( $result ) {
    $result = str_replace(" ", "%20", $result);
    header('location: ../../../pages/signup/?error=' . $result);
}

$result = pwdCheck($pwd, $confirmpwd, $email);
if ( $result ) {
    $result = str_replace(" ", "%20", $result);
    header('location: ../../../pages/signup/?error=' . $result);
}
