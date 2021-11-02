//TODO: find recovery codes table (table relation etc)
<?php
session_start();

require_once "../../includes/DatabaseManager.php";

//connections
$dbm = new DatabaseManager();

//get record of user from DB
$record = $dbm->getRecordsFromTable("user", "email", $_SESSION['email']);

if (isset($_POST['submit'])) {
    //check code
    if ($record[0][recovery] === $_POST['recovery']) {
        //if correct passcode
        echo "yes!";
    } else {
        //if incorrect passcode
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
    <input type="text" name="recovery">
    <button type="submit" name="submit">submit</button>
</form>
</body>
</html>
