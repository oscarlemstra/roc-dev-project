<?php 

require_once '../includes/DatabaseManager.php';
$dbm = new DatabaseManager();

echo print_r($_POST);


$record = $dbm->getRecordsFromTable("user", "email", $_POST['email']);

echo "<br><br><br><pre>";
echo print_r($record);
echo "</pre>";