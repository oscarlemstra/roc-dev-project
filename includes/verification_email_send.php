<?php

function sendEmail($email) {



    $to = $email;
    $subject = "Email verificatie";
    $message = file_get_contents("../template/6code.html");

    $message = str_replace("[USERNAME]", "" /* <- Username here */, $message);
    $message = str_replace("[DESTINATION]", "" /* <- destination url here */, $message);

    $message = str_replace("[NUM1]", "" /* <- number here */, $message);
    $message = str_replace("[NUM2]", "" /* <- number here */, $message);
    $message = str_replace("[NUM3]", "" /* <- number here */, $message);
    $message = str_replace("[NUM4]", "" /* <- number here */, $message);
    $message = str_replace("[NUM5]", "" /* <- number here */, $message);
    $message = str_replace("[NUM6]", "" /* <- number here */, $message);


    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: 2026970@talnet.nl' . "\r\n" . 'Reply-To: olemstra@roc-dev.com' . "\r\n";

    $result = mail($to, $subject, $message, $headers);

    if ($result) {
        echo "email is verzonden";
    }
    else {
        echo "email is niet verzonden";
    }
}
