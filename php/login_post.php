<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "./db.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    checkLogin();
}

if(!isset($_GLOBALS["errormsg"])) {
    $_GLOBALS["errormsg"] = 'Something went wrong, please try again';
}

header("Location: ../login.php?errormsg=" . $_GLOBALS["errormsg"]);

function checkLogin() {
	$username = trim($_POST['username']);
	$pwd = trim($_POST['password']);
	$userArr = findUser($username);
	if($userArr !== false) {
		if(password_verify($pwd,$userArr[0]["password"])) {
			$_SESSION["id"] = $userArr[0]["user_id"];
			header("Location: ../index.php");
			exit();
		}
		else {
			$_GLOBALS["errormsg"] = 'Incorrect login credentials';
		}
	}
	else {
		$_GLOBALS["errormsg"] = 'No user registered for this username or email';
	}
}
function findUser($username) {
	$dbConnect = new DB("../db/");
	$userArr = $dbConnect -> getUserByUsername($username);
	if(sizeof($userArr) != 1) {
		$userArr = $dbConnect -> getUserByEmail($username);
	}
	if(sizeof($userArr) == 1) {
		return $userArr;
	}
	else {
		return false;
	}
}
?>