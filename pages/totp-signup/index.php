<?php

require_once "./vendor/autoload.php";
require_once "./vendor/sonata-project/google-authenticator/src/FixedBitNotation.php";
require_once "./vendor/sonata-project/google-authenticator/src/GoogleAuthenticator.php";
require_once "./vendor/sonata-project/google-authenticator/src/GoogleQrUrl.php";


//include_once __DIR__.'/../src/FixedBitNotation.php';
//include_once __DIR__.'/../src/GoogleAuthenticator.php';
//include_once __DIR__.'/../src/GoogleQrUrl.php';
$g = new \Google\Authenticator\GoogleAuthenticator();
//$link = new Sonata\GoogleAuthenticator\GoogleAuthenticator();
echo getcwd();
$secret = 'XVQ2UIGO75XRUKJO';
$link = Sonata\GoogleAuthenticator\GoogleQrUrl::generate('JSC', $secret, 'JSC-OdJ');
JSC($_POST);
if(isset($_POST['submit'])){
    JSC($_POST['pass-code']);
    JSC($g->getCode($secret));
    echo ($g->checkCode($secret, $_POST['pass-code'])) ? 'JAAAAAA!' : 'NEEEEE';
}

function JSC($input){
    echo "<pre>";
    print_r($input);
    echo "</pre>";
}

JSC($g);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>totp</title>
</head>
<body>
<h1>Hello World!</h1>
<a href="<?php echo $link?>" target="_blank">KLIK HIER!!!</a>
<img src="<?php echo $link?>">

<br>
<form action="index.php" method="post">
    <input type="text" name="pass-code">
    <button type="submit" name="submit">CLICK!</button>
</form>
</body>
</html>