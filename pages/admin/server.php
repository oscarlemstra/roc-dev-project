<?php
require_once('database.php');

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : 'not correct';

if ($contentType === "application/json") {

    //Receive the RAW post data.
    $content = trim(file_get_contents("php://input"));

    $decoded = json_decode($content, true);
    $query = 'SELECT * FROM subject WHERE subject_id = '.$content;
    $object = $connection->query($query); //dit levert altijd 1 resultaat op
    $result = $object->fetch_assoc();
}

echo json_encode($result);
