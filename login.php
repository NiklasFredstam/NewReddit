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
    <link rel="stylesheet" type="text/css" href='./css/style.css?v=<?php echo rand() ?>'>
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
            <form name="login-form" id="login-form" class="login-form" action="./php/login_post.php" onsubmit="checkLogin()" method="post">
                <label class="login-form-label" for="username">Username:</label>
                <input type="text" name="username" class="login-form-input" id="username" placeholder="Enter a registered username or email" required minlength="4">
                <label class="login-form-label" for="password">Password:</label>
                <input type="password" name="password" class="login-form-input" id="password" placeholder="Enter your password" pattern="(?=.*\d)(?=.*[a-zåäö])(?=.*[A-ZÅÄÖ]).{8,20}" required title="Must contain at least one numeric value, one lowercase letter and one uppercase letter">
                <input type="submit" class="standard-button large" value="Log In" >
            </form>
        </div>
		<?php
		if(isset($loginerror)) {
			echo $loginerror;
		}
		?>
    </div>

	<?php include "./partial/_footer.php" ?>

</body>
</html>