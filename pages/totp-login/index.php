<?php
require_once "../../vendor/autoload.php";
require_once "../../vendor/sonata-project/google-authenticator/src/FixedBitNotation.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleAuthenticator.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleQrUrl.php";


$g = new \Google\Authenticator\GoogleAuthenticator();
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
    <button type="submit" name="submit">CLICK!</button>
</form>
</body>
</html>