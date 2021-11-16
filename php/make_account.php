<?php session_start();

require_once '../includes/DatabaseManager.php';
$dbm = new DatabaseManager();

//testing code
print_r($dbm->checkConnectionToDatabase());

echo "wow";
