<?php

require "./db.php";
$dbC = new DB("../db/");
if(isset($_SESSION["id"]) && $_GET["text"]) {
        $cid = $dbC -> insertComment($_GET["thread"],$_SESSION["id"],$_GET["text"],,date("Y-m-d H:i"));
}

?>