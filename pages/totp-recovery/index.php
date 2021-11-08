<?php
session_start();

require_once "../../includes/DatabaseManager.php";

//connections
$dbm = new DatabaseManager();

//get record of backup codes from DB
$backupsRecord = $dbm->getRecordsFromTable("2fa_backup_codes", "email", $_SESSION['email']);

if (isset($_POST['submit'])) {
    $correctCode = false;

    //check code in post for each code in DB
    for ($i = 1; $i < 7; $i++) {
        if ($_POST['backup-code'] === $backupsRecord[0]["code_".$i]) {
            //if correct backup code
            echo '<a href="../totp-recovery-codes">genereer nieuwe backup codes?</a><br>';
            echo '<a href="../home">naar homepage</a><br>';
            $correctCode = true;

            //overwrite used code with NULL
            $dbm->updateRecordsFromTable("2fa_backup_codes", "code_".$i, NULL, "code_".$i, $_POST['backup-code']);

            break;
        }
    }

    //if code in post doesn't match with any codes in DB
    if(!$correctCode) {
        echo "no!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>totp-recovery</title>
</head>
<body>
<form action="index.php" method="post">
    <input type="text" inputmode="numeric" pattern="[0-9]*" name="backup-code">
    <button type="submit" name="submit">submit</button>
</form>
</body>
</html>
