<?php
require "../php/db.php";
$dbC = new DB("../db/testing.db");
$toecho = "";
if($comments = $dbC -> getCommentsByThread($_GET["thread"])) {
    foreach($comments as $c) {
            $toecho .= 
            '<div class="comment">'
            . $c["text"]
            . $c["username"]
            . '</div>';
    }
}
echo $toecho;
?>