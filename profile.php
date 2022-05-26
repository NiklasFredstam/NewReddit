<?php
include "./php/bootstrap.php";
if(!isset($_SESSION["id"])) {
    header("Location: ./index.php");
    exit();
}
$dbC = new DB();
$username;
$email;
if($user = $dbC -> getUserByID($_SESSION["id"])){
    $username = $user[0]["username"];
    $email = $user[0]["email"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href='./css/style.css?v=<?php rand() ?>'>
    <script src="./js/ProfileHandler.js"></script>
</head>

<body>

    <?php
    include "./partial/_header.php";
    ?>
    <div class="center-flex">
        <?php
        if(isset($_GET["msg"])) {
            echo $_GET["msg"];
        }
        ?>
        <div class="user-form">
            <div class="form-labels">
                <label class="form-label" for="username">Username:</label>
                <label class="form-label" for="email">Email:</label>
                <label class="form-label" for="new-password">Password:</label>
                <label class="form-label" for="old-password">New Password:</label>
            </div>
            <form name="edit-user-info" class="edit-user-form" action="./php/update_user_info_post.php" onsubmit="validateUserInfo()" id="edit-user-info" method="post">
                <input class="user-form-input" type="text" value="<?php echo  $username ?>" id="username" name="username" disabled="true">
                <input class="user-form-input" type="text" value="<?php echo  $email ?>" id="email" name="email" disabled="true">
                <input class="user-form-input" type="password" value="" id="old-password" name="old-password" disabled="true">
                <input class="user-form-input" type="password" value="" id="new-password" name="new-password" disabled="true">
                <button type="button" class="standard-button small" id="edit-button" onclick="activateForm()">Edit</button>
                <input type="submit" class="disabled-button large" id="submit-button" value="Save Changes" disabled>
            </form>
        </div>

    </div>

    <?php include "./partial/_footer.php" ?>

</body>
</html>