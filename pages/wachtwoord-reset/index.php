<?php 
    session_start();

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/login-signup-style.css">
    <title>Wachtwoord reseten</title>
</head>
<body>
    <div class="container">
        <form method="post">
            <h1>Wachtwoord Reset</h1>
            <p>een email is gestuurd naar <?php echo $_POST['email']; ?><br/>. volg de instructies op de email en log daarna weer in</p>
            <a href="../login/">login</a>
        </form>
        <?php
            if(isset($_SESSION["errorMessage"])) {
                echo "<div class='error'" . $_SESSION["errorMessage"] . "</div>";
                unset($_SESSION['errorMessage']);
            }
        ?>
    </div>
</body>
</html>