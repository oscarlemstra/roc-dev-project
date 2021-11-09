<?php session_start();

require_once '../includes/DatabaseManager.php';
$dbm = new DatabaseManager();

$record = $dbm->getRecordsFromTable("email_verification_code", "email", $_SESSION['signup']['email']);

if ($_POST['verification_code'] === $record[0]['code']) {
    $dbm->deleteRecordsFromTable("email_verification_code", "email", $_SESSION['signup']['email']);
    header('location: ../pages/totp-signup');
    exit();
}
else {
    $_SESSION['errorMessage'] = "code is fout";
    header('location: ../pages/6code-verification');
    exit();
}
