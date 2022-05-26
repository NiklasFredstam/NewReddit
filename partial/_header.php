<?php

if (isset($_SESSION["id"])) {
    $dbC = new DB();
    $user = $dbC -> getUserByID($_SESSION["id"])[0];
    $username = $user["username"];
}

echo 
'<div class="header" id="header">';
echo 
    '<div class="header-div first">';
if(isset($_SESSION["id"])) {
    echo 
        'Nice to see you ' 
        . $username 
        . '!
        <a class="profile-link" href="./profile.php">SETTINGS</a>';
}
echo 
    '</div>';

echo 
    '<div class="header-div second">
        <a class="logo-link" href="./index.php">
        THE NEW REDDIT
        </a>
    </div>';

echo 
    '<div class="header-div">';

if(!isset($_SESSION["id"])) {
    echo 
        '<form>
            <button class="header-button" formaction="./login.php">Login</button>
        </form>
        <form>
            <button class="header-button" formaction="./register.php">Register</button>
        </form>';
}
else {
        echo 
        '<form>
            <button class="header-button" formaction="./php/logout_process.php">Logout</button>
        </form>';
}

    echo 
    '</div>';

echo 
'</div>
<hr class="header-line">';
?>