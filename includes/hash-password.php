<?php

function hashPassword($userID, $userPassword) {
    $hashedID = hash('sha256', $userID);
    $hashedUnsaltedPWD = hash('sha256', $userPassword);
    $salt = hash('md5', $hashedID . $hashedUnsaltedPWD);

    $hashedPWD = hash('sha512', $userPassword);
    $finalHashedPWD = hash('sha512', $salt . $hashedPWD);

    return $finalHashedPWD;
}