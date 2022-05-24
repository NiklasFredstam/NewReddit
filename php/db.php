<?php
class DB {

    private $dbPath;
    private $dbName = "newreddit.db";

    function __construct($path = "./db/") {
        $this -> dbPath = $path . $this->dbName;
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
            }
        }
        $db->close();
        unset($db);
        return $id;
    }
    
    public function insertThread($user_id, $topic, $text, $date) {
        $db = new SQLite3($this->dbPath);
        $id = false;
        $sql = 'INSERT INTO Threads(topic,text,date_created,user_id) VALUES(:topic,:text,:date,:user_id)';
        if($stmt = $db->prepare($sql)) {
            $stmt->bindValue(':topic', $topic, SQLITE3_TEXT);
            $stmt->bindValue(':text', $text, SQLITE3_TEXT);
            $stmt->bindValue(':date', $date, SQLITE3_TEXT);
            $stmt->bindValue(':user_id', $user_id);
            $db->busyTimeout(5000);
            if($stmt->execute()) {
                $id = $db->lastInsertRowID();
            }
        }
        $db->close();
        unset($db);
        return $id;
    }

    public function insertComment($thread_id, $user_id, $text, $date) {
        $db = new SQLite3($this->dbPath);
        $id = false;
        $sql = 'INSERT INTO Comments(thread_id,user_id,text,date_created) VALUES(:thread_id,:user_id,:text,:date)';
        if($stmt = $db->prepare($sql)) {
            $stmt->bindValue(':thread_id', $thread_id);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':text', $text, SQLITE3_TEXT);
            $stmt->bindValue(':date', $date, SQLITE3_TEXT);
            $db->busyTimeout(5000);
            if($stmt->execute()) {
                $id = $db->lastInsertRowID();
            }
        }
        $db->close();
        unset($db);
        return $id;
    }

    public function getCommentsByThread($id) {
        $db = new SQLite3($this->dbPath);
        $sql = 'SELECT text, username, date_created
                FROM Comments
                INNER JOIN Users 
                ON Users.user_id = Comments.user_id
                WHERE thread_id=:id;';
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


    public function getThreads() {
        $db = new SQLite3($this->dbPath);
        $sql = 'SELECT thread_id, topic, text, username, date_created
                FROM Threads
                INNER JOIN Users 
                ON Users.user_id = Threads.user_id;';
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

    public function getThreadByID($id) {
        $db = new SQLite3($this->dbPath);
        $sql = 'SELECT thread_id, topic, text, username, date_created
                FROM Threads
                INNER JOIN Users 
                ON Users.user_id = Threads.user_id
                WHERE thread_id=:id;';
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

    public function resultToArray($result) {
        $ra = array();
        while($user = $result -> fetchArray(SQLITE3_ASSOC)) {
            if($user !== 1) {
                $ra[] = $user;
            }
        }
        return $ra;
    }

    public function updateUserInfo($username, $email, $id) {
        $db = new SQLite3($this->dbPath);
        $suc = false;
        $sql = 'UPDATE Users
                SET username = :username,
                    email = :email
                WHERE user_id = :id';
        if($stmt = $db->prepare($sql)) {
            $stmt->bindValue(':username', $username, SQLITE3_TEXT);
            $stmt->bindValue(':email', $email, SQLITE3_TEXT);
            $stmt->bindValue(':id', $id);
            $db->busyTimeout(5000);
            if($stmt->execute()) {
                $suc = true;
            }
        }
        $db->close();
        unset($db);
        return $suc;
    }
    public function updateUserPassword($password, $id) {
        $db = new SQLite3($this->dbPath);
        $suc = false;
        $sql = 'UPDATE Users
                SET password = :password
                WHERE user_id = :id';
        if($stmt = $db->prepare($sql)) {
            $stmt->bindValue(':password', $password, SQLITE3_TEXT);
            $db->busyTimeout(5000);
            if($stmt->execute()) {
                $suc = true;
            }
        }
        $db->close();
        unset($db);
        return $suc;
    }
}

?>