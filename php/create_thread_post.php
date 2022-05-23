<?php

//SESSION ID IS NOT SET HERE, WHY????
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["id"])) {
    require "./db.php";
    $dbC = new DB("../db/");
    if($id = $dbC -> insertThread($_SESSION["id"],$_POST["topic"],$_POST["text"],date("Y-m-d H:i"))) {
        header("Location: ../thread.php?thread=" . $id);
        exit();
    }
}
header("Location: ../index.php");
exit();

?>