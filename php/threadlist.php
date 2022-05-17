<?php

function getThreads() {
    $dbConnect = new DB();
    return $dbConnect -> getThreads();
}

function createThreadElements($threads) {
    $toecho = "";
    foreach($threads as $t) {
        //href needs to change, somehow
        $toecho .= 
        "<div class='thread' href='" . $t["thread_id"] . "'>"
        . $t['topic']
        . $t['user']
        . "</div>";
    }
    return $toecho;
}
?>