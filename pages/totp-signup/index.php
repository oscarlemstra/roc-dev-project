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

//get record of user from DB
$userRecord = $dbm->getRecordsFromTable("user", "email", $_SESSION['email']);

//generate secret for user
$secret = $g->generateSecret();

//store secret in DB
$dbm->updateRecordsFromTable("user", "secret", $secret, "email", $_SESSION['email']);

//generate qr code with secret
$link = Sonata\GoogleAuthenticator\GoogleQrUrl::generate($userRecord[0]["email"], $secret, 'roc-dev');

echo $secret."<br>"; // - DEBUG
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>totp signup</title>
</head>
<body>

<img alt ="qr code laadt niet? herlaadt pagina" src="<?php echo $link?>">
<a href="../totp-login">klik dit als je de qr-code hebt gescand</a>

</body>
</html>