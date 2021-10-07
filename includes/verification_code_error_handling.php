<?php

function codeCheck($code) {
    $error = false;
    $errorMessage = '';

    if ($code === '') {
        $error = true;
        $errorMessage = 'code vake is leeg';
    }

    if (strlen($code) !== 6 && !$error) {
        $error = true;
        $errorMessage = 'code is niet 6 lang';
    }
    

    if ($error) {
        return $errorMessage;
    } else {
        return false;
    }
}
