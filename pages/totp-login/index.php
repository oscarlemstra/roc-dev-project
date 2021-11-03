<?php

use Google\Authenticator\GoogleAuthenticator;

session_start();

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
    //show on-screen - DEBUG
    JSC("submitted code: ".$_POST['pass-code']);
    JSC("correct code: ".$g->getCode($userRecord[0]["secret"]));

    //check code
    if ($g->checkCode($userRecord[0]["secret"], $_POST['pass-code'])) {
        //if correct passcode

        if ($backupsRecord) {
            //if there are backup codes in DB
            header('location: ../home');
        } else {
            //if there aren't any backup codes in DB
            header('location: ../totp-recovery-codes');
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
</head>
<body>
<form action="index.php" method="post">
    <input type="text" name="pass-code">
    <button type="submit" name="submit">submit</button>
</form>
<a href="../totp-recovery">telefoon kwijt?</a>
</body>
</html>