<?php

class Thread {

    public $id;
    public $topic;
    public $creator;
    public $comments;

    function __construct($id, $topic, $creator, $comments) {
        $this -> id = $id;
        $this -> topic = $topic;
        $this -> creator = $creator;
        $this -> comments = $comments;
    }

}
?>