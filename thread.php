<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_GET["thread"])) {
    header("Location: ./threadnotfound.php");
    exit();
}
require "./php/models/thread.php";
require "./php/db.php";
$dbC = new DB();
$t = $dbC -> getThreadByID($_GET["thread"]);
if(sizeof($t) == 0) {
    header("Location: ./threadnotfound.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
	<script src="./js/UserValidation.js"></script>

</head>

<body>
    <?php
    echo $t[0]["thread_id"];
    ?>

</body>
</html>