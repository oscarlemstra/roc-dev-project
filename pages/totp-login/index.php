<?php session_start();

//use signup email if isset, else use login
$email = $_SESSION['signup']['email'] ?? $_SESSION['login']['email'];

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

//SUBMIT is pressed
if (isset($_POST['pass-code'])) {

    //use secret from session if isset, else use secret from DB
    $secret = $_SESSION['signup']['secret'] ?? $userRecord[0]['secret'];

    //check code
    if ($g->checkCode($secret, $_POST['pass-code'])) {
        //if correct passcode

        if ($userRecord) {
            //if user exists in DB (login process)

            if ($_SESSION['signup']['secret']) {
                //if secret in session isset (recovery process)
                $dbm->updateRecordsFromTable("user", "secret", $_SESSION['signup']['secret'], "email", $email);
            }
            session_destroy();
            $_SESSION['logged_in'] = true;
            $_SESSION['ID'] = $userRecord[0]['user_id'];
            header('location: ../study-progression');

        } else {
            //signup process
            header('location: ../totp-recovery-codes');
        }

    } else {
        //if incorrect passcode
        $_SESSION['errorMessage'] = "incorrecte code";
        header("location: index.php");
    }
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>totp login</title>
    <link rel="stylesheet" href="../../styles/login-signup-style.css">
    <link rel="icon" type="image/x-icon" href="../../images/favicon.jpg">
</head>
<body>
<div class="container">
<form action="index.php" method="post">
    <h1>2-factor authentication</h1>
    <a href="../totp-recovery">telefoon kwijt?</a>
    <input type="text" inputmode="numeric" pattern="[0-9]*" name="pass-code" required>
    <input type="submit" value="verstuur" class="submitenabled" id="submit">
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