<?php
require_once "../php/db.php";
$dbC = new DB("../db/");
$toecho = "";
if($comments = $dbC -> getCommentsByThread($_GET["thread"])) {
    foreach($comments as $c) {
            $toecho .= 
            '<div class="comment-username">'
            . $c["username"]
            . '</div>'
            . '<div class="comment-text">'
            . $c["text"]
            . '</div>'
            . '<div class="comment-date">'
            . $c["date_created"]
            . '</div>';
    }
}
echo $toecho;
?>