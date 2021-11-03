<?php session_start();

require_once('../includes/DatabaseManager.php');
$dbm = new DatabaseManager();

// a .inc.php file is a file that is put inside the includes folder
// includes are .php files that are require'd in another file. such as this one
require_once('../includes/signup_error_handling.php');
require_once('../includes/email_send.php');

$email = $_POST['email'];

$pwd = $_POST['password'];
$confirmpwd = $_POST['confirmPassword'];


// these 2 functions check if the email and password (pwd) are valid inside the signup-error-handling.php
// if the function is returns any value
//      send the user to signup page with a error message
//
// if the functions returns false
//      continue with the rest of the code
$result = emailCheck($email, $dbm);
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


// if(!sendEmail_emailVerificationCode($email, $dbm)) {
//     $_SESSION['errorMessage'] = 'het sturen van een email heeft gefaald. neem alstublieft contact op met de site-eigenaar';
//     header('location: ../pages/signup');
//     exit();
// }
$signup = array("email"=>$_POST['email'], "password"=>$_POST['password']);
$_SESSION['signup'] = $signup;

header('location: ../pages/6code-verification');
