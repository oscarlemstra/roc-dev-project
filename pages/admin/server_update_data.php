<?php
require_once('database.php');


$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : 'not correct';

if ($contentType === "application/json") {

    //Receive the RAW post data.
    $content = trim(file_get_contents("php://input"));

    $decoded = json_decode($content, true);

    $query = 'UPDATE subject SET name = "'.$decoded['name'].'", hours = '.$decoded['hours'].' WHERE subject_id = '.$decoded['id'];

    $object = $connection->query($query); //dit levert altijd 1 resultaat op

    $result = false;

    if(mysqli_affected_rows($connection) >0 ) {
        $result = true;
    }

}

echo json_encode($result);