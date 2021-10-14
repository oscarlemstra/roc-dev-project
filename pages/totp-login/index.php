<?php

require_once "../../vendor/autoload.php";
require_once "../../vendor/sonata-project/google-authenticator/src/FixedBitNotation.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleAuthenticator.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleQrUrl.php";

$g = new \Google\Authenticator\GoogleAuthenticator();
$secret = ""; //from database

if (isset($_POST['submit'])) {
    //show on-screen - DEBUG
    JSC("submitted code: ".$_POST['pass-code']);
    JSC("correct code: ".$g->getCode($secret));

    //check code
    if ($g->checkCode($secret, $_POST['pass-code'])) {
//if correct passcode
        echo "yes!";
    } else {
//if incorrect passcode
        echo "no!";
    }

}

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
    <   input type="text" name="pass-code">
    <button type="submit" name="submit">submit</button>
</form>
</body>
</html>