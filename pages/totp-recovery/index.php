//TODO: find recovery codes table (table relation etc)
<?php
session_start();

require_once "../../includes/DatabaseManager.php";

//connections
$dbm = new DatabaseManager();

//get record of user from DB
$record = $dbm->getRecordsFromTable("2fa_backup_codes", "email", $_SESSION['email']);

if (isset($_POST['submit'])) {
    //check code in post for each code in DB
    for ($i = 1; $i < 7; $i++) {
        if ($_POST['backup-code'] === $record[0]["code_".$i]) {
            //if correct backup code
            echo "yes!";
        }
    }
    //if incorrect backup code
    echo "no!";
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
    <input type="text" name="backup-code">
    <button type="submit" name="submit">submit</button>
</form>
</body>
</html>
