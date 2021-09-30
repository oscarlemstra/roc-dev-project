<?php 

require_once '../includes/DatabaseManager.php';
$dbm = new DatabaseManager();

echo print_r($_POST);

$dbm->insertRecordToUser(1, $_POST['email'], $_POST['password']);