<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "./db.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    checkAndTryLogin();
}

if(!isset($_GLOBALS["errormsg"])) {
    $_GLOBALS["errormsg"] = 'Something went wrong, please try again';
}

header("Location: ../login.php?errormsg=" . $_GLOBALS["errormsg"]);

function checkAndTryLogin() {
	$userArr = findUser();
	if($userArr !== false) {
		tryLogin($userArr[0]);
	}
	else {
		$_GLOBALS["errormsg"] = 'No user registered for this username or email';
	}
}
function findUser() {
	$dbConnect = new DB("../db/");
	$userArr = $dbConnect -> getUserByUsername(trim($_POST['username']));
	if(sizeof($userArr) != 1) {
		$userArr = $dbConnect -> getUserByEmail(trim($_POST['username']));
	}
	if(sizeof($userArr) == 1) {
		return $userArr;
	}
	else {
		return false;
	}
}
function tryLogin($user) {
	if(password_verify(trim($_POST['password']),$user["password"])) {
		$_SESSION["id"] = $user["user_id"];
		header("Location: ../index.php");
		exit();
	}
	else {
		$_GLOBALS["errormsg"] = 'Incorrect login credentials';
	}
}
?>