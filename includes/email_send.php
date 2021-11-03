<?php

//sends an email with a code to verify your email that you have given
function sendEmail_emailVerificationCode($email, $dbm) {

    $code = rand(100000, 999999);
    $date = date("Y-m-d");
    $record = array("email"=>$email, "code"=>$code, "creation_date"=>$date);

    $dbm->insertRecordToTable("email_verification_code", $record);

    $to = $email;
    $subject = "Email verificatie";

    
    $message = file_get_contents("../template/email-verification.html");

    // general changes
    $message = str_replace("[USERNAME]", "student" /* <- Username here */, $message);

    // verification code
    $message = str_replace("[CODE]", $code /* <- number here */, $message);
    

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
