<?php session_start();
$_SESSION['signup']['user_role_id'] = 1;
$_SESSION['signup']['group_id'] = 1;
$_SESSION['signup']['student_nr'] = "1234567";
$_SESSION['signup']['first_name'] = "henk";
$_SESSION['signup']['tussenvoegsel'] = "van der";
$_SESSION['signup']['last_name'] = "laan";
$_SESSION['signup']['email'] = "henk.vanderlaan@student.rocvf.nl";
$_SESSION['signup']['password'] = "sldkjfslkfjslkfjsflksjdflksdjflksdjflskdfjsldkfjsdlkfjsdlfksdjflksdjflskdjfsldkfjsdlkfjsldkfjsdlkfjsdllskdfjslkdfjlskdfjlskdffff";
$_SESSION['signup']['secret'] = "slkfjsdlkfj";

require_once "../includes/DatabaseManager.php";

//connections
$dbm = new DatabaseManager();

//prepare insert array
$insertArray = [
    "user_role_id" => $_SESSION['signup']['user_role_id'],
    "group_id" => $_SESSION['signup']['group_id'],
    "student_nr" => $_SESSION['signup']['student_nr'],
    "first_name" => $_SESSION['signup']['first_name'],
    "tussenvoegsel" => $_SESSION['signup']['tussenvoegsel'],
    "last_name" => $_SESSION['signup']['last_name'],
    "email" => $_SESSION['signup']['email'],
    "password" => $_SESSION['signup']['password'],
    "secret" => $_SESSION['signup']['secret']
];

//insert into user table
$dbm->insertRecordToTable("user", $insertArray);

//go to homepage
//header('location: ../pages/home');
