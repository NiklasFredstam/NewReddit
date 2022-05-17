<?php

if (isset($_SESSION["id"])) {
    $dbConnect = new DB();
    $user = $dbConnect -> getUserByID($_SESSION["id"])[0];
    $username = $user["username"];
    $role = $user["role"];
}
echo '<div class="header" id="header">';
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
    echo '<p class="loggedInText">Nice to see you ' . $username . '</p>';
    echo 
    '<form>
        <button class="loginButton" formaction="./php/logout_process.php">Logout</button>
    </form>';
}
echo '</div>'
?>