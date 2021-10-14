<?php

require_once "../../vendor/autoload.php";
require_once "../../vendor/sonata-project/google-authenticator/src/FixedBitNotation.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleAuthenticator.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleQrUrl.php";

$user = "STUDENTNR"; //studentnr from database

$g = new \Google\Authenticator\GoogleAuthenticator();
$secret = $g->generateSecret();
$link = Sonata\GoogleAuthenticator\GoogleQrUrl::generate($user, $secret, 'roc-dev');

echo $secret."<br>"; // - DEBUG
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>totp signup</title>
</head>
<body>

<img src="<?php echo $link?>">

</body>
</html>