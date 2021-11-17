<?php

//if (isset($_COOKIE["user"])) {
//    header("Location: ./pages/home");
//} else {
//    header("Location: ./pages/login");
//}
//
//?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>landing</title>
    <link rel="stylesheet" href="styles/login-signup-style.css">

</head>
<body>
<div class="container">
    <form action="pages/login/" method="post">
        <input type="submit" value="Login" class="submitenabled" id="submit">
    </form>
    <form action="pages/signup/" method="post">
        <input type="submit" value="Registratie student" class="submitenabled" id="submit">
    </form>
    <form action="" method="post">
        <input type="submit" value="Registratie docent" class="submitenabled" id="submit">
    </form>
</div>
</body>
</html>