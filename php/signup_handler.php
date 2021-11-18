<?php session_start();

require_once('../includes/DatabaseManager.php');
$dbm = new DatabaseManager();

// a .inc.php file is a file that is put inside the includes folder
// includes are .php files that are required in another file. such as this one
require_once('../includes/signup_error_handling.php');
require_once('../includes/email_send.php');

$email = $_POST['email'];

$name = $_POST['first_name'];

$pwd = $_POST['password'];
$confirmed = $_POST['confirmPassword'];


// these 2 functions check if the email and password (pwd) are valid inside the signup-error-handling.php
// if the function is returns any value
//      send the user to signup page with an error message
//
// if the functions returns false
//      continue with the rest of the code
$result = emailCheck($email, $dbm);
if ($result) {
    $_SESSION['errorMessage'] = $result;
    header('location: ../pages/signup');
    exit();
}


$result = pwdCheck($pwd, $confirmed, $email);
if ($result) {
    $_SESSION['errorMessage'] = $result;
    header('location: ../pages/signup');
    exit();
}


if(!sendEmail_emailVerificationCode($email, $name, $dbm)) {
    $_SESSION['errorMessage'] = 'het sturen van een email heeft gefaald. neem alstublieft contact op met de site-eigenaar';
    header('location: ../pages/signup');
    exit();
}

if ($_SESSION['signup']['user_role'] === "student") {
    $_SESSION['signup'] += [
        "email"=>$_POST['email'],
        "first_name"=>$_POST['first_name'],
        "tussenvoegsel"=>$_POST['tussenvoegsel'],
        "last_name"=>$_POST['last_name'],
        "student_nr"=>$_POST['student_nr'],
        "group"=>$_POST['group'],
        "password"=>$_POST['password'],
    ];
}

header('location: ../pages/6code-verification');
