<?php

require_once "../../vendor/autoload.php";
require_once "../../vendor/sonata-project/google-authenticator/src/FixedBitNotation.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleAuthenticator.php";
require_once "../../vendor/sonata-project/google-authenticator/src/GoogleQrUrl.php";


$g = new \Google\Authenticator\GoogleAuthenticator();
//$secret = 'XVQ2UIGO75XRUKJO';
$secret = $g->generateSecret();
$link = Sonata\GoogleAuthenticator\GoogleQrUrl::generate('JSC', $secret, 'roc-dev');
echo $secret."<br>";
if(isset($_POST['submit'])){
    JSC("post: ".$_POST['pass-code']);
    JSC("code: ".$g->getCode($secret));
    echo ($g->checkCode($secret, $_POST['pass-code'])) ? 'JAAAAAA!' : 'NEEEEE';
}

function JSC($input){
    echo "<pre>";
    print_r($input);
    echo "</pre>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>totp signup</title>
</head>
<body>
<img src="<?php echo $link?>">

<br>
<form action="index.php" method="post">
    <input type="text" name="pass-code">
    <button type="submit" name="submit">CLICK!</button>
</form>
</body>
</html>