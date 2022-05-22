<?php
if (session_status() === PHP_SESSION_NONE) {
        session_start();
}
require "./db.php";

$dbC = new DB("../db/testing.db");


if(isset($_SESSION["id"]) && $_GET["text"]) {
        $cid = $dbC -> insertComment($_GET["thread"],$_SESSION["id"],$_GET["text"]);
}


?>