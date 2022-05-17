<?php
class DB {

    private $dbPath = "./db/testing.db";

    function __construct($path = "./db/testing.db") {
        $this -> dbPath = $path;
    }
    
    public function insertUser($username, $email, $pwd, $role) {
        $db = new SQLite3($this->dbPath);
        $id = false;
        $sql = 'INSERT INTO Users(username,email,password,role) VALUES(:username,:email,:password,:role)';
        if($stmt = $db->prepare($sql)) {
            $stmt->bindValue(':username', $username, SQLITE3_TEXT);
            $stmt->bindValue(':email', $email, SQLITE3_TEXT);
            $stmt->bindValue(':password', $pwd, SQLITE3_TEXT);
            $stmt->bindValue(':role', $role, SQLITE3_TEXT);
            $db->busyTimeout(5000);
            if($stmt->execute()) {
                $id = $db->lastInsertRowID();
                echo $id;
            }
        }
        $db->close();
        unset($db);
        return $id;
    }
    
    public function insertThread() {
    
    }

    public function insertComment() {
    
    }

    public function getThreads() {
        $db = new SQLite3($this->dbPath);
        $sql = 'SELECT thread_id, topic, username
                FROM Threads
                INNER JOIN Users 
                ON Users.user_id = Threads.creator_id;';
        $result = false;
        if($stmt = $db->prepare($sql)) {
            $db->busyTimeout(5000);
            if($r = $stmt->execute()) {
                $result = $this -> resultToArray($r);
            }
        }
        $db -> close();
        unset($db);
        return $result;
    }
    
    public function getUserByUsername($username) {
        $db = new SQLite3($this->dbPath);
        $sql = 'SELECT * FROM Users WHERE username=:username;';
        $result = false;
        if($stmt = $db->prepare($sql)) {
            $stmt->bindValue(':username', $username);
            $db->busyTimeout(5000);
            if($r = $stmt->execute()) {
                $result = $this -> resultToArray($r);
            }
        }
        $db -> close();
        unset($db);
        return $result;
    }

    public function getUserByEmail($email) {
        $db = new SQLite3($this->dbPath);
        $sql = 'SELECT * FROM Users WHERE email=:email;';
        $result = false;
        if($stmt = $db->prepare($sql)) {
            $stmt->bindValue(':email', $email);
            $db->busyTimeout(5000);
            if($r = $stmt->execute()) {
                $result = $this -> resultToArray($r);
            }
        }
        $db -> close();
        unset($db);
        return $result;
    }

    public function getUserByID($id) {
        $db = new SQLite3($this->dbPath);
        $sql = 'SELECT * FROM Users WHERE user_id=:id;';
        $result = false;
        if($stmt = $db->prepare($sql)) {
            $stmt->bindValue(':id', $id);
            $db->busyTimeout(5000);
            if($r = $stmt->execute()) {
                $result = $this -> resultToArray($r);
            }
        }
        $db -> close();
        unset($db);
        return $result;
    }

    private function resultToArray($result) {
        $ra = array();
        while($user = $result -> fetchArray(SQLITE3_ASSOC)) {
            if($user !== 1) {
                $ra[] = $user;
            }
        }
        return $ra;
    }
}

?>