<?php

if (isset($_SESSION["id"])) {
    $dbC = new DB();
    $user = $dbC -> getUserByID($_SESSION["id"])[0];
    $username = $user["username"];
    // $role = $user["role"];
}

echo 
'<div class="header" id="header">';

echo 
    '<div class="logo">
        <a class="logo-link" href="./index.php">
        THE NEW REDDIT
        </a>
    </div>';

echo 
    '<div class="login-buttons">';

if(!isset($_SESSION["id"])) {
    echo 
        '<form>
            <button class="loginButton" formaction="./login.php">Login</button>
        </form>
        <form>
            <button class="loginButton" formaction="./register.php">Register</button>
        </form>';
}
else {
        echo 
        '<p class="loggedInText">Nice to see you ' . $username . '</p>';
        echo 
        '<form>
            <button class="loginButton" formaction="./php/logout_process.php">Logout</button>
        </form>';
}

    echo 
    '</div>';

echo 
'</div>';
?>