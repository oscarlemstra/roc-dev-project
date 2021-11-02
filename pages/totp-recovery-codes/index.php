<!--//TODO: find recovery codes table (table relation etc)-->

<?php
session_start();

require_once "../../includes/DatabaseManager.php";
require_once "../../vendor/otp-generator.php";

//connections
$dbm = new DatabaseManager();

//get record of user from DB
//$record = $dbm->getRecordsFromTable("user", "email", $_SESSION['email']);

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
<?php displayArray(generateNumericOTPs(10,6)); ?>
<br>
bewaar deze codes op een veilige plek!
</body>
</html>