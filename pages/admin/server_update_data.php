<?php
require_once('database.php');

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : 'not correct';



//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

$decoded = json_decode($content, true);

$query = 'SELECT * FROM subject WHERE subject_id = '.$decoded->id;
//$query = 'UPDATE subject SET name = '.$content->name.', hours = '.$content->hours.' [WHERE subject_id = 1]';
$object = $connection->query($query); //dit levert altijd 1 resultaat op
$result = $object->fetch_assoc();

//echo json_encode($result);


echo json_encode($result);
