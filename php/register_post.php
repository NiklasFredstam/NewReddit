<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "./db.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    validateAndRegister();
}

if(!isset($_GLOBALS["errormsg"])) {
    $_GLOBALS["errormsg"] = 'Something went wrong, please try again';
}

header("Location: ../login.php?errormsg=" . $_GLOBALS["errormsg"]);

function validateAndRegister() {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $pwd = trim($_POST['password']);
    if(validateUsername($username) && 
    validateEmail($email) && 
    validatePassword($pwd)) {
        if(usernameBusy($username)) {
            $_GLOBALS["errormsg"] = 'Username already in use';
        }
        elseif(emailBusy($email)) {
            $_GLOBALS["errormsg"] = 'Email already in use';
        }
        else {
            registerUser($username,$email,$pwd);
            header("Location: ../index.php");
            exit();
        }
    }
    else {
        $_GLOBALS["errormsg"] = 'Incorrect registration details';
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
    $dbConnect = new DB("../db/");
    if($a = $dbConnect -> getUserByEmail($email)) {
        return sizeof($a) != 0;
    }
    else 
        return false;
}
function usernameBusy($username) {
    $dbConnect = new DB("../db/");
    if($a = $dbConnect -> getUserByUsername($username)) {
        return sizeof($a) != 0;
    }
    else 
        return false;
}
function registerUser($username,$email,$pwd) {
    $dbConnect = new DB("../db/");
    $hashedpwd = password_hash($pwd,PASSWORD_DEFAULT);
    $_SESSION["id"] = $dbConnect -> insertUser($username,$email,$hashedpwd,"user");
}
?>