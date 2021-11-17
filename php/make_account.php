<?php session_start();
//$_SESSION['signup']['user_role_id'] = 1;
//$_SESSION['signup']['group_id'] = 1;
//$_SESSION['signup']['student_nr'] = "1234567";
//$_SESSION['signup']['first_name'] = "henk";
//$_SESSION['signup']['tussenvoegsel'] = "van der";
//$_SESSION['signup']['last_name'] = "laan";
//$_SESSION['signup']['email'] = "henk.vanderlaan@student.rocvf.nl";
//$_SESSION['signup']['password'] = "sldkjfslkfjslkfjsflksjdflksdjflksdjflskdfjsldkfjsdlkfjsdlfksdjflksdjflskdjfsldkfjsdlkfjsldkfjsdlkfjsdllskdfjslkdfjlskdfjlskdffff";
//$_SESSION['signup']['secret'] = "slkfjsdlkfj";

require_once "../includes/DatabaseManager.php";

//connections
$dbm = new DatabaseManager();

//get user_role record and group record
$userRoleRecord = $dbm->getRecordsFromTable("user_role", "role", $_SESSION['signup']['user_role']);
$groupRecord = $dbm->getRecordsFromTable("group", "name", $_SESSION['signup']['class']);

//prepare user insert array
$userInsertArray = [
    "user_role_id" => $userRoleRecord[0]['user_role_id'],
    "group_id" => $groupRecord[0]['group_id'],
    "student_nr" => $_SESSION['signup']['student_nr'],
    "first_name" => $_SESSION['signup']['first_name'],
    "tussenvoegsel" => $_SESSION['signup']['tussenvoegsel'],
    "last_name" => $_SESSION['signup']['last_name'],
    "email" => $_SESSION['signup']['email'],
    "password" => $_SESSION['signup']['password'],
    "secret" => $_SESSION['signup']['secret']
];

//insert into user table
$dbm->insertRecordToTable("user", $userInsertArray);


//get user record
$userRecord = $dbm->getRecordsFromTable("user", "email", $_SESSION['signup']['email']);

//prepare backup insert array
$backupInsertArray = ['user_id' => $userRecord[0]['user_id']] + $_SESSION['backupInsertArray'];

//insert into 2fa backup table
$dbm->insertRecordToTable('2fa_backup_codes', $backupInsertArray);


//go to homepage
$_SESSION['logged-in'] = true;
header('location: ../pages/study-progression');
exit();