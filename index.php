<?php

if (isset($_COOKIE["user"])) {
    header("Location: ./pages/home");
} else {
    header("Location: ./pages/login");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>landing</title>
    <link rel="stylesheet" href="../../styles/login-signup-style.css">

</head>
<body>
<form action="index.php" method="post">
    <input type="text" name="pass-code">
    <button type="submit" name="submit">submit</button>
</form>
</body>
</html>