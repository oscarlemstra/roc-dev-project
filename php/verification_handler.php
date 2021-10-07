<?php session_start();

require_once('../includes/DatabaseManager.php');
$dbm = new DatabaseManager();

// includes are .php files that are require'd in another file. such as this one
require_once('../includes/verification_code_error_handling.php');

$verification_code = $_POST['verification_code'];


// this function will check if the code is a valid format
// if the function returns any value
//      send the user to signup page with a error message
//
// if the functions returns false
//      continue with the rest of the code
$result = codeCheck($verification_code);
if ($result) {
    $_SESSION['errorMessage'] = $result;
    header('location: ../pages/email-verification');
    exit();
}


$hashedPassword = hash("sha3-512", $_POST['password']);
$dbm->insertRecordToUser("1", $_POST['email'], $hashedPassword);

header('location: ../pages/login');