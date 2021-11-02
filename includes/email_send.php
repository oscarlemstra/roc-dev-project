<?php

function sendEmail($email ,$emailType) {

    $to = $email;
    $subject = "Email verificatie";

    
    if ($emailType === 'verification') $message = file_get_contents("../template/email-verification.html");
    if ($emailType === 'pwdReset')     $message = file_get_contents("../template/pwd-reset.html");

    // general changes
    $message = str_replace("[USERNAME]", "test name" /* <- Username here */, $message);

    // verification code
    $message = str_replace("[CODE]", "number" /* <- number here */, $message);
    
    // url destination changes
    $message = str_replace("[DESTINATION]", "https://test_url.test/" /* <- destination url here */, $message);
    

    // Set content-type header for sending HTML email 
    $headers  = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
    
    // Additional headers
    $headers .= 'From: roc-dev test <ROC-DEV-TEST@outlook.com>' . "\r\n";

    $result = mail($to, $subject, $message, $headers);

    if ($result) {
        return true;
    } else {
        return false;
    }
}
