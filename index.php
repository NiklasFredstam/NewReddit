<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require "./php/db.php";
$dbC = new DB();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href='./css/style.css?v=<?php time() ?>'>
    <script src="./js/IndexHandler.js"></script>	
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>	
</head>

<body onload="filterThreads('')">

    <?php 
    include "./partial/_header.php"; 
    
    echo '<div id="create-thread" class="center-flex">';
    if(isset($_SESSION["id"])){
        echo '<button class="new-thread-button" onclick="createThreadForm()">New Thread</button>';
    }
    echo '</div>'
    ?>

    <div class="search-container">

        <input type="text" id="filter" class="search-bar" placeholder="Search topics..." onkeyup="filterThreads(this.value)">

    </div>
    <div class="center-flex">
        <div class="thread-container" id="thread-container">

        </div>
    </div>

    <?php include "./partial/_footer.php" ?>

</body>
</html>
<?php

?>