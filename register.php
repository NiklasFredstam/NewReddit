<?php
include "./php/bootstrap.php";

if(isset($_SESSION["id"])) {
    header("Location: ./index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href='./css/style.css?v=<?php time() ?>'>
	<script src="./js/UserValidation.js"></script>
</head>

<body>

    <?php include "./partial/_header.php" ?>

    <div class="center-flex" id="container">
        <?php 
        if(isset($_GET["errormsg"])) {
            echo $_GET["errormsg"];
        }
        ?>
        <div class="user-form">
            <form name="registration" class="register-form" action="./php/register_post.php" onsubmit="checkRegistration()" method="post">
                <label class="register-form-label" for="username">Username:</label>
                <input class="register-form-input" type="text" name="username" id="username" placeholder="Enter you prefered username" required minlength="4">
                <label class="register-form-label" for="email">E-mail:</label>
                <input class="register-form-input" type="email" name="email" id="email" placeholder="jane@doe.com" required>
                <label class="register-form-label" for="password">Password:</label>
                <input class="register-form-input" type="password" name="password" id="password" placeholder="Enter a password" pattern="(?=.*\d)(?=.*[a-zåäö])(?=.*[A-ZÅÄÖ]).{8,20}" required title="Must contain at least one numeric value, one lowercase letter and one uppercase letter">
                <input type="submit" class="standard-button large" value="Send" >
            </form>
        </div>

    </div>

    <?php include "./partial/_footer.php" ?>

</body>
</html>