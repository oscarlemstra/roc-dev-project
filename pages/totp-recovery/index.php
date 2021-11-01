<?php
session_start();

require_once "../../vendor/autoload.php";
require_once "../../vendor/sonata-project/google-authenticator/src/FixedBitNotation.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleAuthenticator.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleQrUrl.php";
require_once "../../includes/DatabaseManager.php";

//connections
$dbm = new DatabaseManager();
$g = new \Google\Authenticator\GoogleAuthenticator();

//get record of user from DB
$record = $dbm->getRecordsFromTable("user", "email", $_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>totp-recovery</title>
</head>
<body>
<form action="index.php" method="post">
    <input type="text" name="pass-code">
    <button type="submit" name="submit">submit</button>
</form>
</body>
</html>
