<?php
require "./db.php";
$dbC = new DB("../db/");
$toreturn = "";

$threads = $dbC -> getThreads();

if($threads === false) {
    echo $toreturn;
    exit();
}
if(isset($_GET["filter_text"])) {
    $filter = $_GET["filter_text"];
    foreach($threads as $t) {
        if(strpos($t['topic'], $filter) !== false) {
            $toreturn .=
            "<a class='thread' href='./thread.php?thread=" . $t["thread_id"] . "'>
                <div class='thread-topic'>"
                . $t['topic']
                . "</div>"
                .  "<div class='thread-username'>"
                . $t['username']
                . "</div>"
                .  "<div class='thread-date'>"
                . $t['date_created']
                . "</div>
            </a>";
        }
    }
}
else {
    foreach($threads as $t) {
        $toreturn .=
            "<a class='thread' href='./thread.php?thread=" . $t["thread_id"] . "'>
                <div class='thread-topic'>"
                . $t['topic']
                . "</div>"
                .  "<div class='thread-username'>"
                . $t['username']
                . "</div>
            </a>";
    }
}

if($toreturn == "") {
    $toreturn = "No matching threads! :(";
}

echo $toreturn;

?>