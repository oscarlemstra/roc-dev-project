<?php
require_once('database.php');

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : 'not correct';

if ($contentType === "application/json") {

    //Receive the RAW post data.
    $query = 'SELECT name, subject_id FROM subject';
    $object = $connection->query($query); //dit levert altijd 1 resultaat op
    $result = $object->fetch_all(MYSQLI_ASSOC);
}

echo json_encode($result);
