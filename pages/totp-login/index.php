<?php session_start();

$email = $_SESSION['signup']['email'];

require_once "../../vendor/autoload.php";
require_once "../../vendor/sonata-project/google-authenticator/src/FixedBitNotation.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleAuthenticator.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleQrUrl.php";
require_once "../../includes/DatabaseManager.php";
use Google\Authenticator\GoogleAuthenticator;

//connections
$dbm = new DatabaseManager();
$g = new GoogleAuthenticator();

//get record of user and backup codes from DB
$userRecord = $dbm->getRecordsFromTable("user", "email", $email);
$backupsRecord = $dbm->getRecordsFromTable("2fa_backup_codes", "email", $email);

//SUBMIT is pressed
if (isset($_POST['pass-code'])) {

    //use secret from DB if it exists, else use secret from session
    if ($userRecord) {
        $secret = $userRecord[0]['secret'];
    } else {
        $secret = $_SESSION['signup']['secret'];
    }

//    show on-screen - DEBUG
//    JSC("submitted code: " . $_POST['pass-code']);
//    JSC("correct code: " . $g->getCode($secret));

    //check code
    if ($g->checkCode($secret, $_POST['pass-code'])) {
        //if correct passcode


        if ($backupsRecord && $userRecord) {
            //if backup and user exist
            header('location: ../home');
        } else {
            //if there aren't any backup codes in DB
            header('location: ../totp-recovery-codes');

        }
        exit();

    } else {
        //show error
        $_SESSION['errorMessage'] = "incorrecte code";
        header("location: index.php");
        exit();
    }
}


//for debugging
//function JSC($input) {
//    echo "<pre>";
//    print_r($input);
//    echo "</pre>";
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>totp login</title>
    <link rel="stylesheet" href="../../styles/login-signup-style.css">
</head>
<body>
<div class="container">
<form action="index.php" method="post">
    <h1>google authenticator</h1>
    <a href="../totp-recovery">telefoon kwijt?</a>
    <input type="text" inputmode="numeric" pattern="[0-9]*" name="pass-code" required>
    <input type="submit" value="submit" class="submitenabled" id="submit">
</form>
    <?php
    if(isset($_SESSION["errorMessage"])) {
        echo "<div class='error' id='error2'>" . $_SESSION["errorMessage"] . "</div>";
        unset($_SESSION['errorMessage']);
    }
    ?>
</div>
</body>
</html>