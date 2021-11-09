<?php session_start();

$email = $_SESSION['signup']['email'];

require_once "../../includes/DatabaseManager.php";
require_once "../../vendor/otp-generator.php";

//connections
$dbm = new DatabaseManager();

//get record of backup codes from DB
$backupsRecord = $dbm->getRecordsFromTable("2fa_backup_codes", "email", $email);

//generate codes
$codes = generateNumericOTPs(10,6);

if($backupsRecord) {
    //if record exists in DB, update codes
    for ($i = 0; $i <= 5; $i++) {
        $j = $i + 1;
        $dbm->updateRecordsFromTable("2fa_backup_codes", "code_".$j, $codes[$i], "email", $email);
    }
} else {
    //if record does not exist in DB, insert

    $insertArray = [
        "email" => $email,
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
    <link rel="stylesheet" href="../../styles/login-signup-style.css">
</head>
<body>
<div class="container">
    <?php displayArray($codes); ?>
    <br>
    bewaar deze codes op een veilige plek!
    <br>
    <form action="index.php" method="post">
        <input type="submit" value="next" class="submitenabled" id="submit">
    </form>
</div>
</body>
</html>