<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('Europe/Stockholm');
require_once "./db.php";

if(isset($_SESSION["id"]) && isset($_GET["thread"]) && isset($_GET["text"])) {
    $dbC = new DB("../db/");
    if(validateComment() && threadExists()) {
        if($id = $dbC -> insertComment($_GET["thread"],$_SESSION["id"],$_GET["text"],date("Y-m-d H:i"))) {
            if($comments = $dbC -> getCommentsByThread($_GET["thread"])) {
                echo createCommentDiv($comments[0]);
            }
        }
    }
}

function validateComment() {
    return strlen($_GET["text"]) <= 500 && strlen($_GET["text"]) >= 2;
}

function threadExists() {
    $dbC = new DB("../db/");
    return sizeof($dbC -> getThreadByID($_GET["thread"])) != 0;
}

function createCommentDiv($c) {
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