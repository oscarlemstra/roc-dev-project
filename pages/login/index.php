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
        <form action="../../includes/login.inc.php" method="post">
            <h1>Inloggen</h1>
            <a href="./signup">account registreren</a>

            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Wachtwoord">
            <input type="submit" value="submit">
        </form>
        <div>
            <?php
                if(isset($_SESSION["error"])) {
                    echo "<div class='error'>" . $_SESSION["error"] . "</div>";
                }
            ?>
        </div>
    </div>
</body>
</html>