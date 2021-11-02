<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/login-signup-style.css">
    <title>registreren</title>
</head>
<body>
    <div class="container">
        <form action="../../php/signup_handler.php" method="post" id="form">
            <h1>Account registreren</h1>
            <a href="../login">Inloggen</a>

            <input type="email" name="email" placeholder="Email" id="email" required>

            <input type="password" name="password" placeholder="Wachtwoord" id="pwd" required>
            <input type="password" name="confirmPassword" placeholder="Confirm Wachtwoord" id="pwd2" required>

            <input type="submit" value="submit" class="submitenabled" id="submit">
        </form>
        <div class='error displayNone' id='error'></div>
        <?php
            if (isset($_SESSION['errorMessage'])) {
                echo "<div class='error' id='error2'>" . $_SESSION['errorMessage'] . "</div>";
                unset($_SESSION['errorMessage']);
            }
        ?>
    </div>
    <script src="../../javascript/signup.js"></script>
</body>
</html>