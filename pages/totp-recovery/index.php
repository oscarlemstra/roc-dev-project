<?php session_start();

//$email = $_SESSION['login']['email'];
$email = "user@email.com";

require_once "../../includes/DatabaseManager.php";

//connections
$dbm = new DatabaseManager();

//get record of user and backup codes from DB
$userRecord = $dbm->getRecordsFromTable("user", "email", $_SESSION['email']);
$backupsRecord = $dbm->getRecordsFromTable("2fa_backup_codes", "email", $_SESSION['email']);

//default state
$correctCode = false;

if (isset($_POST['backup-code'])) {

    //check code in post for each code in DB
    for ($i = 1; $i <= 6; $i++) {
        //if correct backup code
        if ($_POST['backup-code'] === $backupsRecord[0]["code_".$i]) {

            //overwrite used code and secret with NULL
            $dbm->updateRecordsFromTable("2fa_backup_codes", "code_".$i, NULL, "code_".$i, $_POST['backup-code']);
            $dbm->updateRecordsFromTable("user", "secret", NULL, "email", $_SESSION['email']);

            //go to totp-signup
            header('location: ../totp-signup');
            exit();
        }
    }

    //if code in post doesn't match with any codes in DB
    $_SESSION['errorMessage'] = 'incorrecte code';
    header('location: ../totp-recovery');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>totp-recovery</title>
    <link rel="stylesheet" href="../../styles/login-signup-style.css">
</head>
<body>
    <div class="container">
        <form action="index.php" method="post">
            <h1>recovery</h1>
            <input type="text" inputmode="numeric" pattern="[0-9]*" name="backup-code" required>
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
