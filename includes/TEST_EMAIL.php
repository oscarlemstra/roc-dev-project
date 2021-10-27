<?php

$to = 'tdouwma@roc-dev.com';
$subject = "Email verificatie";

// $message = file_get_contents("../template/email-verification.html");

// // general changes
// $message = str_replace("[USERNAME]", "test name" /* <- Username here */, $message);

// // verification changes
// $message = str_replace("[DESTINATION]", "https://test_url.test/" /* <- destination url here */, $message);

// // 6 code changes
// $message = str_replace("[NUM1]", "1" /* <- number here */, $message);
// $message = str_replace("[NUM2]", "2" /* <- number here */, $message);
// $message = str_replace("[NUM3]", "3" /* <- number here */, $message);
// $message = str_replace("[NUM4]", "4" /* <- number here */, $message);
// $message = str_replace("[NUM5]", "5" /* <- number here */, $message);
// $message = str_replace("[NUM6]", "6" /* <- number here */, $message);

$message = "hallo";


$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: 2134301@talnet.nl' . "\r\n";

$result = mail($to, $subject, $message);

print_r($result);
if ($result) {
    echo "\n it worky";
} else {
    echo "\n it not worky";
}

// if ($result) echo "it worked";
// else echo "not worky";