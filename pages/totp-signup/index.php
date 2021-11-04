<?php

session_start();

require_once "../../vendor/autoload.php";
require_once "../../vendor/sonata-project/google-authenticator/src/FixedBitNotation.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleAuthenticator.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleQrUrl.php";
use Google\Authenticator\GoogleAuthenticator;

//connections
$g = new GoogleAuthenticator();

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
</head>
<body>

<img alt ="qr code laadt niet? herlaadt pagina" src="<?php echo $link?>">
<br>
<a href="../totp-login">klik dit als je de qr-code hebt gescand</a>

</body>
</html>