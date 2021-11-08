<?php

session_start();

require_once "../../includes/DatabaseManager.php";
require_once "../../vendor/autoload.php";
require_once "../../vendor/sonata-project/google-authenticator/src/FixedBitNotation.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleAuthenticator.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleQrUrl.php";
use Google\Authenticator\GoogleAuthenticator;

//connections
$dbm = new DatabaseManager();
$g = new GoogleAuthenticator();

//get record of user from DB
$userRecord = $dbm->getRecordsFromTable("user", "email", $_SESSION['email']);

//if user already exists, go to login page
if($userRecord) {
    header('location: ../totp-login');
    exit();
}

//generate secret for user
$secret = $g->generateSecret();

//store secret in session
$_SESSION['secret'] = $secret;

//generate qr code with secret
$link = Sonata\GoogleAuthenticator\GoogleQrUrl::generate($_SESSION['email'], $secret, 'roc-dev');

echo $secret."<br>"; // - DEBUG
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>totp signup</title>
    <link rel="stylesheet" href="../../styles/login-signup-style.css">
</head>
<body>

<img alt ="qr code laadt niet? herlaadt pagina" src="<?php echo $link?>">
<br>
<a href="../totp-login">klik dit als je de qr-code hebt gescand</a>

</body>
</html>