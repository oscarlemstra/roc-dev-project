<?php session_start();

require_once '../includes/DatabaseManager.php';
$dbm = new DatabaseManager();

$a = array("role"=>"test5");

//testing code
print_r($dbm->insertRecordToTable("user_role", $a));
