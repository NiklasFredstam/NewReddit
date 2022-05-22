<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_GET["thread"])) {
    header("Location: ./threadnotfound.php");
    exit();
}
require "./php/db.php";
$dbC = new DB();
$thread = $dbC -> getThreadByID($_GET["thread"]);
if(sizeof($thread) == 0) {
    header("Location: ./threadnotfound.php");
}
$thread = $thread[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href='./css/style.css?v=<?php time() ?>'>
    <script src="./js/ThreadHandler.js"></script>

</head>

<body onload="<?php echo 'loadComments(' . $_GET["thread"] . ')' ?>">

    <?php include "./partial/_header.php" ?>



    <div class="center-flex">

        <?php echo $thread["username"]; ?>

        <div class="comment-container" id="comment-container">


        </div>

        <div class="new-comment-form" id="new-comment-form">

        <?php
        if(isset($_SESSION["id"])) {
            echo 
            '<label for="comment">Comment:</label>
            <input type="text" name="comment" id="comment-input" placeholder="Write your comment here..." required minlength="2" title="Required">
            <input type="button" onclick="insertComment(' . $_GET["thread"] . ')" value="Send" >';
        }
        ?>
        
        </div>
    </div>

    <?php include "./partial/_footer.php" ?>

</body>
</html>