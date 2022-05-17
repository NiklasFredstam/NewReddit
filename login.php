<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
else {
    if(isset($_SESSION["id"])) {
        header("Location: ./index.php");
        exit();
    }
}

$loginerror;
require "./php/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	checkLogin();
}

function checkLogin() {
	$username = trim($_POST['username']);
	$pwd = trim($_POST['password']);
	$userArr = findUser($username);
	if($userArr !== false) {
		if(password_verify($pwd,$userArr[0]["password"])) {
			$_SESSION["id"] = $userArr[0]["user_id"];
			header("Location: ./index.php");
			exit();
		}
		else {
			$loginerror = '<p>Incorrect login credentials!</p>';
		}
	}
	else {
		$loginerror = '<p>No user registered for this username!</p>';
	}
}

function findUser($username) {
	$dbConnect = new DB();
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
        <form name="login" action="login.php" onsubmit="checkLogin()" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" placeholder="Enter a registered username or email" required minlength="4">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" pattern="(?=.*\d)(?=.*[a-zåäö])(?=.*[A-ZÅÄÖ]).{8,20}" required title="Must contain at least one numeric value, one lowercase letter and one uppercase letter">
            <input type="submit" value="Send" >
        </form>
		<?php
		if(isset($loginerror)) {
			echo $loginerror;
		}
		?>
    </div>

</body>
</html>