<?php session_start();

require_once '../includes/hash-password.php';
require_once '../includes/DatabaseManager.php';
$dbm = new DatabaseManager();


$record = $dbm->getRecordsFromTable("user", "email", $_POST['email']);

$userID = $record[0]['user_id'];
$password = hashPassword($userID, $_POST['password']);

if ($record && $password === $record[0]['password']) {
    $login = array("email"=>$_POST['email']);
    $_SESSION['login'] = $login;

    header("location: ../pages/totp-login");
}
else {
    $_SESSION['errorMessage'] = "Gegevens zijn incorrect";
    header("location: ../pages/login");
}