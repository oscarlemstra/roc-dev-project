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

//generate secret for user
$secret = $g->generateSecret();

//store secret in DB
$dbm->updateRecordsFromTable("user", "secret", $secret, "email", $_SESSION['email']);

//generate qr code with secret
$link = Sonata\GoogleAuthenticator\GoogleQrUrl::generate($record[0]["email"], $secret, 'roc-dev');

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