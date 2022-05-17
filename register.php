<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
else {
    if(isset($_SESSION["userid"])) {
        header("Location: ./index.php");
        exit();
    }
}

require "./php/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    validateAndRegister();
}

function validateAndRegister() {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $pwd = trim($_POST['password']);
    if(validateUsername($username) && 
    validateEmail($email) && 
    validatePassword($pwd)) {
        if(usernameBusy($username)) {
            echo '<p>Username already in use!</p>';
        }
        elseif(emailBusy($email)) {
            echo '<p>Email already in use!</p>';
        }
        else {
            registerUser($username,$email,$pwd,"user");
            header("Location: ./index.php");
            exit();
        }
    }
    else {
        echo '<p>Incorrect registration details!</p>';
    }
}

function validateUsername($username){
	if(strlen(trim($username)) > 3)
		return true;
	return false;
}

function validateEmail($email){
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePassword($password){
	$pattern="/(?=.*\d)(?=.*[a-zåäö])(?=.*[A-ZÅÄÖ]).{8,}/";
	return preg_match($pattern, $password);
}

function emailBusy($email) {
    $dbConnect = new DB();
    if($a = $dbConnect -> getUserByEmail($email)) {
        return sizeof($a) != 0;
    }
    else 
        return false;
}

function usernameBusy($username) {
    $dbConnect = new DB();
    if($a = $dbConnect -> getUserByUsername($username)) {
        return sizeof($a) != 0;
    }
    else 
        return false;
}

function registerUser($username,$email,$pwd,$role) {
    $dbConnect = new DB();
    $hashedpwd = password_hash($pwd,PASSWORD_DEFAULT);
    $_SESSION["id"] = $dbConnect -> insertUser($username,$email,$hashedpwd,$role);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
	<script src="./js/UserValidation.js"></script>

</head>

<body>
    <div class="center-flex" id="container">

        <form name="registration" action="register.php" onsubmit="checkRegistration()" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" placeholder="Enter you prefered username" required minlength="4">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" placeholder="john@smith.com" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter a password" pattern="(?=.*\d)(?=.*[a-zåäö])(?=.*[A-ZÅÄÖ]).{8,20}" required title="Must contain at least one numeric value, one lowercase letter and one uppercase letter">
            <input type="submit" value="Send" >
        </form>

    </div>

</body>
</html>