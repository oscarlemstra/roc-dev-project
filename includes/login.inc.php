<?php 

require_once '../php/DatabaseManager.php';
$dbm = new DatabaseManager();

echo $dbm->checkConnectionToDatabase();