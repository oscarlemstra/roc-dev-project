<?php session_start();

require_once "../../vendor/otp-generator.php";

////generate codes
$codes = generateNumericOTPs(10,6);

$_SESSION['backupInsertArray'] = [
        "code_1" => $codes[0],
        "code_2" => $codes[1],
        "code_3" => $codes[2],
        "code_4" => $codes[3],
        "code_5" => $codes[4],
        "code_6" => $codes[5]
    ];

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
    <link rel="icon" type="image/x-icon" href="../../images/favicon.jpg">
</head>
<body>
<div class="container">
    <?php displayArray($codes); ?>
    <br>
    bewaar deze codes op een veilige plek!
    <br> <br> <br>
    <form action="../../php/make_account.php">
        <input type="submit" value="naar home" class="submitenabled" id="submit">
    </form>
</div>
</body>
</html>