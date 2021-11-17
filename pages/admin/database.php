<?php

$server = 'localhost';
$username = 'root';
$password = 'root';
$database = "roc_dev";
$port = "8889";

try {
    $connection = mysqli_connect($server, $username, $password, $database, $port);
    if (!$connection) die('Error!!');
} catch (Exception $error) {


} finally {

}