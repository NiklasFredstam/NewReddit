<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if($_SERVER["REQUEST_METHOD"] != "POST" && !isset($_SESSION["id"])) {
    header("Location: ../index.php");
    exit();
}
require "./db.php";
$dbC = new DB("../db/testing.db");
if($id = $dbC -> insertComment($_SESSION["id"],$_POST["topic"],$_POST["text"])) {
    header("Location: ../thread.php?thread=" . $id);
}
else {
    header("Location: ../index.php");
}
?>