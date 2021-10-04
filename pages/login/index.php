<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/login-signup-style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <form action="../../php/login_handler.php" method="post">
            <h1>Inloggen</h1>
            <a href="../signup">account registreren</a>

            <input type="email" name="email" placeholder="Email" id="email" required>
            <input type="password" name="password" placeholder="Wachtwoord" id="pwd" required>
            <input type="submit" value="submit" class="submitenabled" id="submit">
        </form>
        <?php
            if(isset($_SESSION["errorMessage"])) {
                echo "<div class='error' id='error2'>" . $_SESSION["errorMessage"] . "</div>";
                unset($_SESSION['errorMessage']);
            }
        ?>
    </div>
</body>
</html>