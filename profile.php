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
    <link rel="stylesheet" type="text/css" href='./css/style.css?v=43<?php time() ?>'>
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
        <form name="edit-user-info" action="./php/update_user_info_post.php" onsubmit="validateUserInfo()" id="edit-user-info" method="post">
            <label for="username">Username:</label>
            <input type="text" value="<?php echo  $username ?>" id="username" name="username" disabled><br><br>
            <label for="email">Email:</label>
            <input type="text" value="<?php echo  $email ?>" id="email" name="email" disabled><br><br>
            <label for="new-password">Password:</label>
            <input type="password" value="" id="old-password" name="old-password" disabled><br><br>
            <label for="old-password">New Password:</label>
            <input type="password" value="" id="new-password" name="new-password" disabled><br><br>
            <button type="button" id="edit-button" onclick="activateForm()">Edit</button>
            <input type="submit" id="submitbutton" value="Save Changes" disabled><br><br>
        </form>
    </div>

    <?php include "./partial/_footer.php" ?>

</body>
</html>