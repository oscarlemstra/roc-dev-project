<?php

//sends an email with a code to verify your email that you have given
function sendEmail_emailVerificationCode($email, $dbm) {

    $code = rand(100000, 999999);
    $date = date("Y-m-d");
    $record = array("email"=>$email, "code"=>$code, "creation_date"=>$date);

    //checks if a code already exists, if not: make one, if yes: update the old one
    if (!$dbm->getRecordsFromTable("email_verification_code", "email", $email)) {
        $dbm->insertRecordToTable("email_verification_code", $record);
    }
    else {
        $dbm->updateRecordsFromTable("email_verification_code", "code", $code, "email", $email);
    }

    $naam = "student";

    $to = $email;
    $subject = "Email verificatie";

    
    $message = file_get_contents("../template/email-verification.html");

    // general changes
    $message = str_replace("[USERNAME]", $naam, $message);

    // verification code
    $message = str_replace("[CODE]", $code, $message);
    

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


function sendEmail_PasswordReset($email, $securetyString, $destinationCode, $dbm) {


    $destination = "http://localhost/pages/wachtwoord-reset?e=".$destinationCode."&s=".$securetyString;

    $naam = $dbm->getRecordsfromTable('user', 'email', $email)[0]['first_name'];

    $to = $email;
    $subject = "Email verificatie";

    
    $message = file_get_contents("../../template/password-reset.html");

    // general changes
    $message = str_replace("[USERNAME]", $naam, $message);

    // url replacement
    $message = str_replace("[DESTINATION]", $destination, $message);
    

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

