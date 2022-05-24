<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "./db.php";
$_GLOBALS["msg"] = 'Something went wrong...';
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
header("Location: ../profile.php?msg=" . $_GLOBALS["msg"]);
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
    } else {
        $_GLOBALS["msg"] = "Password is incorrect";
    }
    return false;
}
function emailBusy() {
    $dbC = new DB("../db/");
    if($a = $dbC -> getUserByEmail($_POST["email"])) {
        if(sizeof($a) != 0) {
            $_GLOBALS["msg"] = "That email is already in use";
            return true;
        }
    }
    return false;
}
function usernameBusy() {
    $dbC = new DB("../db/");
    if($a = $dbC -> getUserByUsername($_POST["username"])) {
        if(sizeof($a) != 0) {
            $_GLOBALS["msg"] = "That username is already in use";
            return true;
        }
    }
    return false;
}
function updateUser() {
    $dbC = new DB("../db/");
    if($_POST["new-password"] != "") {
        $hashedpwd = password_hash($_POST["new-password"],PASSWORD_DEFAULT);
        if($dbC -> updateUserPassword($hashedpwd,$_SESSION["id"])) {
            $_GLOBALS["msg"] = 'Password successfully changed<br>';
        }
    }
    if($dbC -> updateUserInfo($_POST["username"],$_POST["email"],$_SESSION["id"])) {
        $_GLOBALS["msg"] .= 'User details successfully updated<br>';
    }
}
?>