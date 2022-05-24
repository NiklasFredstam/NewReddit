<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "./db.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["id"])) {
    $dbC = new DB("../db/");
    if($user = $dbC -> getUserByID($_SESSION["id"])) {
        if(sizeof($user) == 1) {
            if(validateNewInfo($user[0])) {
                updateUser($user[0]);
            }
        }
    } 
}

header("Location: ../profile.php");
exit();

function validateNewInfo($user) {
    $valid = false;
    $valid = validateUsername($user) && validateEmail($user);
    if($_POST["new-password"] != "" && $_POST["old-password"] != "") {
        $valid = validatePassword($user); 
    }
    return $valid;
}
function validateUsername($user){
    if($user["username"] == $_POST["username"]) {
        return true;
    }
    else {
        return strlen(trim($_POST["username"])) > 3 && !usernameBusy();
    }
}
function validateEmail($user){
    if($user["email"] == $_POST["email"]) {
        return true;
    }
    else {
        $e = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        return filter_var($e, FILTER_VALIDATE_EMAIL) && !emailBusy();
    }
}
function validatePassword($user){
    if(password_verify($_POST["old-password"],$user["password"])) {
        $pattern="/(?=.*\d)(?=.*[a-zåäö])(?=.*[A-ZÅÄÖ]).{8,}/";
        return preg_match($pattern, $_POST["new-password"]);
    }
    return false;
}
function emailBusy() {
    $dbC = new DB("../db/");
    if($a = $dbC -> getUserByEmail($_POST["email"])) {
        return sizeof($a) != 0;
    }
    else 
        return false;
}
function usernameBusy() {
    $dbC = new DB("../db/");
    if($a = $dbC -> getUserByUsername($_POST["username"])) {
        return sizeof($a) != 0;
    }
    else 
        return false;
}
function updateUser() {
    $dbC = new DB("../db/");
    if($_POST["new-password"] != "" && $_POST["old-password"] != "") {
        $hashedpwd = password_hash($_POST["old-password"],PASSWORD_DEFAULT);
        if($dbC -> updateUserPassword($hashedpwd,$_SESSION["id"])) {
        }
    }
    if($dbC -> updateUserInfo($_POST["username"],$_POST["email"],$_SESSION["id"])) {
    }
}
?>