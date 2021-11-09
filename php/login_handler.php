<?php session_start();

require_once '../includes/DatabaseManager.php';
$dbm = new DatabaseManager();


$record = $dbm->getRecordsFromTable("user", "email", $_POST['email']);

if ($record && hash("sha3-512", $_POST['password']) === $record[0]['hashed_password']) {
    header("location: ../pages/study-progression");
}
else {
    $_SESSION['errorMessage'] = "Gegevens zijn incorrect";
    header("location: ../pages/login");
}