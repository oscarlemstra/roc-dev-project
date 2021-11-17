<?php session_start();
$_SESSION['signup']['user_role'] = "student";
$_SESSION['signup']['group'] = "MMVAOO9B";
$_SESSION['signup']['student_nr'] = "1234567";
$_SESSION['signup']['first_name'] = "henk";
$_SESSION['signup']['tussenvoegsel'] = "van der";
$_SESSION['signup']['last_name'] = "laan";
$_SESSION['signup']['email'] = "henk.vanderlaan@student.rocvf.nl";
$_SESSION['signup']['password'] = "sldkjfslkfjslkfjsflksjdflksdjflksdjflskdfjsldkfjsdlkfjsdlfksdjflksdjflskdjfsldkfjsdlkfjsldkfjsdlkfjsdllskdfjslkdfjlskdfjlskdffff";
$_SESSION['signup']['secret'] = "slkfjsdlkfj";

require_once "../includes/DatabaseManager.php";
require_once "../includes/hash-password.php";

//connections
$dbm = new DatabaseManager();

//get user_role record and group record from DB
$userRoleRecord = $dbm->getRecordsFromTable("user_role", "role", $_SESSION['signup']['user_role']);
$groupRecord = $dbm->getRecordsFromTable("group", "name", $_SESSION['signup']['group']);

//prepare user insert array
$userInsertArray = [
    "user_role_id" => $userRoleRecord[0]['user_role_id'],
    "group_id" => $groupRecord[0]['group_id'],
    "student_nr" => $_SESSION['signup']['student_nr'],
    "first_name" => $_SESSION['signup']['first_name'],
    "tussenvoegsel" => $_SESSION['signup']['tussenvoegsel'],
    "last_name" => $_SESSION['signup']['last_name'],
    "email" => $_SESSION['signup']['email'],
    "password" => "",
    "secret" => $_SESSION['signup']['secret']
];

//insert into user table
$dbm->insertRecordToTable("user", $userInsertArray);

//get user record
$userRecord = $dbm->getRecordsFromTable("user", "email", $_SESSION['signup']['email']);

//update password in DB
$dbm->updateRecordsFromTable("user", "password", hashPassword($userRecord[0]['user_id'], $_SESSION['signup']['password']), "user_id", $userRecord[0]['user_id']);


//prepare backup insert array
for ($i = 1; $i <= count($_SESSION['backupInsertArray']); $i++) {
    $hashedBackupCodesArray['code_' . $i] = hashPassword($userRecord[0]['user_id'], $_SESSION['backupInsertArray']['code_' . $i]);
}
$backupInsertArray = ['user_id' => $userRecord[0]['user_id']] + $hashedBackupCodesArray;

//insert into 2fa backup table
$dbm->insertRecordToTable('2fa_backup_codes', $backupInsertArray);


//go to homepage
session_destroy();
$_SESSION['logged-in'] = true;
$_SESSION['ID'] = $userRecord[0]['user_id'];
header('location: ../pages/study-progression');
exit();