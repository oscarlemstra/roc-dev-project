<?php session_start();

//use signup email if isset, else use login
$email = $_SESSION['signup']['email'] ?? $_SESSION['login']['email'];

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
$_SESSION['signup']['secret'] = $secret;

//generate qr code with secret
$link = Sonata\GoogleAuthenticator\GoogleQrUrl::generate($email, $secret, 'roc-dev');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>totp signup</title>
    <link rel="stylesheet" href="../../styles/login-signup-style.css">
    <link rel="icon" type="image/x-icon" href="../../images/favicon.jpg">
</head>
<body>
<div class="container">
    <img alt ="qr code laadt niet? herlaadt pagina" src="<?php echo $link?>">
    <br>
    <?php echo $secret ?>
    <br>
    <p>scan deze qr-code met een authenticator app <br>(of voeg handmatig de secret toe)</p>
    <form action="../totp-login">
        <input type="submit" value="volgende" class="submitenabled" id="submit">
    </form>
</div>
</body>
</html>