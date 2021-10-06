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

require_once('../includes/DatabaseManager.php');
$dbm = new DatabaseManager();

// a .inc.php file is a file that is put inside the includes folder
// includes are .php files that are require'd in another file. such as this one
require_once('../includes/signup_error_handling.php');

$email = $_POST['email'];
$confirmEmail = $_POST['confirmEmail'];

$pwd = $_POST['password'];
$confirmpwd = $_POST['confirmPassword'];


// these 2 functions check if the email and password (pwd) are valid inside the signup-error-handling.inc.php
// if they function is returns any value
//      send the user to signup page with a error message
//
// if the functions returns false
//      continue with the rest of the code
$result = emailCheck($email, $confirmEmail);
if ($result) {
    $result = str_replace(" ", "%20", $result);
    header('location: ../pages/signup/?error=' . $result);
}


$result = pwdCheck($pwd, $confirmpwd, $email);
if ($result) {
    $result = str_replace(" ", "%20", $result);
    header('location: ../pages/signup/?error=' . $result);
}


//$hashedPassword = hash("sha3-512", $_POST['password']);
//$dbm->insertRecordToUser("1", $_POST['email'], $hashedPassword);

//header('location: ../pages/login');