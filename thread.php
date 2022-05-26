<?php
include "./php/bootstrap.php";
if(!isset($_GET["thread"])) {
    header("Location: ./threadnotfound.php");
    exit();
}
$dbC = new DB();
$thread = $dbC -> getThreadByID($_GET["thread"]);
if(sizeof($thread) == 0) {
    header("Location: ./threadnotfound.php");
    exit();
}
$thread = $thread[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href='./css/style.css?v=4<?php rand() ?>'>
    <script src="./js/ThreadHandler.js"></script>
</head>

<body onload="<?php echo 'loadComments(' . $_GET["thread"] . ')'; ?>">

    <?php include "./partial/_header.php" ?>



    <div class="center-flex">

        <div class="original-post">

            <div class="op-topic">
                <?php echo $thread["topic"] ?>
            </div>
            <hr class="thread-line">
            <div class="op-text">
                <?php echo $thread["text"] ?>
            </div>
            <hr class="thread-line">
            <div class="op-info">
                <div class="op-username">
                    <?php echo $thread["username"] ?>
                </div>
                <div class="op-date">
                    <?php echo $thread["date_created"] ?>
                </div>
            </div>

        </div>

        
        <div class="new-comment" id="new-comment-form">

        <?php

        if(isset($_SESSION["id"])) {
            echo 
            '<input type="hidden" name="thread-id" id="thread-id" value="' . $_GET["thread"] . '">
            <textarea type="text" name="comment" class="comment-input" id="comment-input" placeholder="Write your comment here..." required minlength="2" title="Required"></textarea>
            <input type="button" class="standard-button comment" value="Comment" onclick="insertComment()">';
        }
        ?>
        
        </div>

        <div class="comment-container" id="comment-container">
        </div>

    </div>

    <?php include "./partial/_footer.php" ?>

</body>
</html>