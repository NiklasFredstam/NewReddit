<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('Europe/Stockholm');

if(isset($_SESSION["id"]) && validateComment()) {
    require_once "./db.php";
    $dbC = new DB("../db/");
    if($id = $dbC -> insertComment($_GET["thread"],$_SESSION["id"],$_GET["text"],date("Y-m-d H:i"))) {
        if($comments = $dbC -> getCommentsByThread($_GET["thread"])) {
            $c = $comments[0];
            echo
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
}

function validateComment() {
    return true;
}

function createCommentDiv() {
    return 
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


?>