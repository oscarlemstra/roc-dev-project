<?php
session_start();

require_once "../../vendor/autoload.php";
require_once "../../vendor/sonata-project/google-authenticator/src/FixedBitNotation.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleAuthenticator.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleQrUrl.php";
require_once "../../includes/DatabaseManager.php";
include_once "../../vendor/otp-generator.php";

//connections
$dbm = new DatabaseManager();
$g = new \Google\Authenticator\GoogleAuthenticator();

//get record of user from DB
$record = $dbm->getRecordsFromTable("user", "email", $_SESSION['email']);

//display values in array below each other
function displayArray($arr) {
    $arrLength = count($arr);
    for ($i = 0; $i < $arrLength; $i++) {
        print($arr[$i] . '<br>');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>recovery codes</title>
</head>
<body>
<?php displayArray(generateNumericOTPs(6,6)); ?>
<br>
bewaar deze codes op een veilige plek!
</body>
</html>