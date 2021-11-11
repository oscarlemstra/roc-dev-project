<?php session_start();

require_once '../includes/DatabaseManager.php';
$dbm = new DatabaseManager();

$a = array("role"=>"test1");

//testing code
print($dbm->insertRecordToTable("user_role", $a));
