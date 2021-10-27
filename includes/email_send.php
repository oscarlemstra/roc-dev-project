<?php

function sendEmail($email ,$emailType) {



    $to = $email;
    $subject = "Email verificatie";

    if ($emailType === 'verification') $message = file_get_contents("../template/email-verification.html");
    if ($emailType === '6code')        $message = file_get_contents("../template/6code.html");
    if ($emailType === 'pwdReset')     $message = file_get_contents("../template/pwd-reset.html");

    // general changes
    $message = str_replace("[USERNAME]", "test name" /* <- Username here */, $message);

    // verification changes
    $message = str_replace("[DESTINATION]", "https://test_url.test/" /* <- destination url here */, $message);

    // 6 code changes
    $message = str_replace("[NUM1]", "1" /* <- number here */, $message);
    $message = str_replace("[NUM2]", "2" /* <- number here */, $message);
    $message = str_replace("[NUM3]", "3" /* <- number here */, $message);
    $message = str_replace("[NUM4]", "4" /* <- number here */, $message);
    $message = str_replace("[NUM5]", "5" /* <- number here */, $message);
    $message = str_replace("[NUM6]", "6" /* <- number here */, $message);


    // Set content-type header for sending HTML email 
    $headers  = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
    
    // Additional headers
    $headers .= 'From: Jopie <ROC-DEV-TEST@outlook.com>' . "\r\n";

    $result = mail($to, $subject, $message, $headers);

    if ($result) {
        return true;
    } else {
        return false;
    }
}
