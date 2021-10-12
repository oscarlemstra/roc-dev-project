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
$headers = 'From: 2026970@talnet.nl' . "\r\n" .
    'Reply-To: olemstra@roc-dev.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$result = mail("olemstra@roc-dev.nl", "test", "wow het werkt", $headers);

if ($result) {
    echo "email is verzonden";
}
else {
    echo "email is niet verzonden";
}

//$hashedPassword = hash("sha3-512", $_POST['password']);
//$dbm->insertRecordToUser("1", $_POST['email'], $hashedPassword);

//header('location: ../pages/login');