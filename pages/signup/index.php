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
        <form action="../../includes/signup.inc.php" method="post">
            <h1>Account registreren</h1>
            <a href="../login">Inloggen</a>

            <input type="email" name="email" placeholder="Email" id="email">
            <input type="email" name="confirmEmail" placeholder="Confirm Email" id="email2">

            <input type="password" name="password" placeholder="Wachtwoord" id="pwd">
            <input type="password" name="confirmPassword" placeholder="Confirm Wachtwoord" id="pwd2">

            <input type="submit" value="submit" id="submit" class="inputDisabled">
        </form>
        <div class='error displayNone' id='error'></div>
        <?php
            if(isset($_SESSION["error"])) {
                echo "<div class='error' id='error2>" . $_SESSION["error"] . "</div>";
            }
        ?>
    </div>
    <script src="../../javascript/signup.js"></script>
</body>
</html>