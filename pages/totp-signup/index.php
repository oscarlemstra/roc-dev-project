<?php

session_start();
$_SESSION['email'] = "user@email.com";

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

//if user already exists and secret is set, go to login page
if($userRecord && $userRecord[0]['secret'] != NULL) {
    header('location: ../totp-login');
    exit();
}

//generate secret for user
$secret = $g->generateSecret();

//store secret in session
$_SESSION['secret'] = $secret;

//generate qr code with secret
$link = Sonata\GoogleAuthenticator\GoogleQrUrl::generate($_SESSION['email'], $secret, 'roc-dev');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>totp signup</title>
    <link rel="stylesheet" href="../../styles/login-signup-style.css">
</head>
<body>
<div class="container">
    <?php echo $secret."<br>"; // - DEBUG ?>
    <img alt ="qr code laadt niet? herlaadt pagina" src="<?php echo $link?>">
    <br>
    <a href="../totp-login">klik dit als je de qr-code hebt gescand</a>
</div>
</body>
</html>