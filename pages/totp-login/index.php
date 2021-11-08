<?php

session_start();

use Google\Authenticator\GoogleAuthenticator;
require_once "../../vendor/autoload.php";
require_once "../../vendor/sonata-project/google-authenticator/src/FixedBitNotation.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleAuthenticator.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleQrUrl.php";
require_once "../../includes/DatabaseManager.php";

//connections
$dbm = new DatabaseManager();
$g = new GoogleAuthenticator();

//get record of user and backup codes from DB
$userRecord = $dbm->getRecordsFromTable("user", "email", $_SESSION['email']);
$backupsRecord = $dbm->getRecordsFromTable("2fa_backup_codes", "email", $_SESSION['email']);

//SUBMIT is pressed
if (isset($_POST['submit'])) {

    //use secret from DB if it exists, else use secret from session
    if ($userRecord) {
        $secret = $userRecord[0]['secret'];
    } else {
        $secret = $_SESSION['secret'];
    }

    //show on-screen - DEBUG
    JSC("submitted code: " . $_POST['pass-code']);
    JSC("correct code: " . $g->getCode($secret));


    //check code
    if ($g->checkCode($secret, $_POST['pass-code'])) {
        //if correct passcode

        if ($backupsRecord) {
            //if there are backup codes in DB
            header('location: ../home');
            exit();
        } else {
            //if there aren't any backup codes in DB
            header('location: ../totp-recovery-codes');
            exit();
        }

    } else {
        //if incorrect passcode
        echo "no!";
    }
}

//for debugging
function JSC($input) {
    echo "<pre>";
    print_r($input);
    echo "</pre>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>totp login</title>
<!--    <link rel="stylesheet" href="../../styles/login-signup-style.css">-->
</head>
<body>
<div class="container">
<form action="index.php" method="post">
    <h1>google authenticator</h1>
    <a href="../totp-recovery">telefoon kwijt?</a>
    <input type="text" inputmode="numeric" pattern="[0-9]*" name="pass-code" required>
    <input type="submit" value="submit" class="submitenabled" id="submit">
</form>
</div>
</body>
</html>