<?php

function hashPassword($userID, $userPassword) {
    $hashedID = hash('sha256', $userID);
    $hashedUnsaltedPWD = hash('sha256', $userPassword);
    $salt = hash('md5', $hashedID . $hashedUnsaltedPWD);

    $hashedPWD = hash('sha512', $userPassword);

    $pepper = 'tr54t5fyu67hyu6j7gtr5f4gt5hyu67iuhkjdaoifkjsaoxhjlzLKMCSiovdshfDSOIfhdSIviszhSugvzuhuiuvhuhfiudzAbkjoioidsiuFDAoihsuvshuvshuohfe';

    $finalHashedPWD = hash('sha512', $salt . $hashedPWD . $pepper);

    return $finalHashedPWD;
}