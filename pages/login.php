<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/main-style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <form action="../includes/login.inc.php">
            <label for="email">Email adress:</label>
            <input type="email" name="email" id="email">

            <label for="password">Wachtwoord:</label>
            <input type="password" name="password" id="password">

            <input type="submit" value="submit">
        </form>
    </div>
</body>
</html>