<?php
session_start();

require_once "../../includes/DatabaseManager.php";
require_once "../../vendor/otp-generator.php";

//connections
$dbm = new DatabaseManager();

//get record of backup codes from DB
$backupsRecord = $dbm->getRecordsFromTable("2fa_backup_codes", "email", $_SESSION['email']);

//generate codes
$codes = generateNumericOTPs(10,6);

if($backupsRecord) {
    //if record exists in DB, update codes
    for ($i = 0; $i < 5; $i++) {
        $j = $i + 1;
        $dbm->updateRecordsFromTable("2fa_backup-codes", "code_".$j, $codes[$i], "email", $_SESSION['email']);
    }
} else {
    //if record does not exist in DB, insert

    $insertArray = [
        "email" => $_SESSION['email'],
        "code_1" => $codes[0],
        "code_2" => $codes[1],
        "code_3" => $codes[2],
        "code_4" => $codes[3],
        "code_5" => $codes[4],
        "code_6" => $codes[5]
    ];

    $dbm->insertRecordToTable("2fa_backup_codes", $insertArray);
}


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
<?php displayArray($codes); ?>
<br>
bewaar deze codes op een veilige plek!
<br>
<a href="../home">naar homepage</a>
</body>
</html>