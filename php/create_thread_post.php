<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('Europe/Stockholm');

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["id"])) {
    require_once "./db.php";
    $dbC = new DB("../db/");
    if(validateThread()) {
        if($id = $dbC -> insertThread($_SESSION["id"],$_POST["topic"],$_POST["text"],date("Y-m-d H:i"))) {
            header("Location: ../thread.php?thread=" . $id);
            exit();
        }
    }
}
header("Location: ../index.php");
exit();

function validateThread() {
    return strlen($_POST["topic"]) > 8 && strlen($_POST["text"]) < 500;
}

?>