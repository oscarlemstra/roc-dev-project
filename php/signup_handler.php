<?php session_start();

require_once('../includes/DatabaseManager.php');
$dbm = new DatabaseManager();

// a .inc.php file is a file that is put inside the includes folder
// includes are .php files that are require'd in another file. such as this one
require_once('../includes/signup_error_handling.php');
require_once('../includes/email_send.php');

$email = $_POST['email'];
$confirmEmail = $_POST['confirmEmail'];

$pwd = $_POST['password'];
$confirmpwd = $_POST['confirmPassword'];


// these 2 functions check if the email and password (pwd) are valid inside the signup-error-handling.php
// if the function is returns any value
//      send the user to signup page with a error message
//
// if the functions returns false
//      continue with the rest of the code
$result = emailCheck($email, $confirmEmail);
if ($result) {
    $_SESSION['errorMessage'] = $result;
    header('location: ../pages/signup');
    exit();
}


$result = pwdCheck($pwd, $confirmpwd, $email);
if ($result) {
    $_SESSION['errorMessage'] = $result;
    header('location: ../pages/signup');
    exit();
}



if( !sendEmail($email, 'verification') ) {
    $_SESSION['errorMessage'] = 'het stuuren van een email heeft gefaald. neem alstublieft contact op met site-eigenaar';
    header('location: ../pages/signup');
    exit();
};


/*
$hashedPassword = hash("sha3-512", $_POST['password']);
$dbm->insertRecordToUser("1", $_POST['email'], $hashedPassword);

header('location: ../pages/login');
*/