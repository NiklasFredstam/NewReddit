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

$t_id = $_GET["thread"];
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
    <?php
    echo $t_id;
    ?>

</body>
</html>