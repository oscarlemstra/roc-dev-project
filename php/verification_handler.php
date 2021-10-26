<?php session_start();

require_once('../includes/DatabaseManager.php');
$dbm = new DatabaseManager();


//require_once('../includes/verification_code_error_handling.php');

//$verification_code = $_POST['verification_code'];


/*$result = codeCheck($verification_code);
if ($result) {
    $_SESSION['errorMessage'] = $result;
    header('location: ../pages/email-verification');
    exit();
}*/

//--------------------------------------------------------------------------------------
//je test code voor de email verificatie is 203198

$code = "910012";

$to = "olemstra@roc-dev.com";
$subject = "Email verificatie";
$message = "
<html>
<head>
    <title>Email verificatie</title>
</head>
<body>
    <p>Je test code voor de email verificatie is ". $code ."</p>
</body>
</html>
";


$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: 2026970@talnet.nl' . "\r\n" . 'Reply-To: olemstra@roc-dev.com' . "\r\n";

$result = mail($to, $subject, $message, $headers);

if ($result) {
    echo "email is verzonden";
}
else {
    echo "email is niet verzonden";
}


//--------------------------------------------------------------------------------------

//$hashedPassword = hash("sha3-512", $_POST['password']);
//$dbm->insertRecordToUser("1", $_POST['email'], $hashedPassword);

//header('location: ../pages/login');