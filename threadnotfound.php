<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require "./php/db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <?php include "./partial/_header.php"; ?>

    <div class="search-container">

        <input type="text" id="filter" class="search-bar" placeholder="Search topics..." onkeyup="filterThreads()">

    </div>
    
    <div class="center-flex">
        <img src="./img/sadman.jpg" alt="Disappointed man" width="500" height="600"> 
    </div>
    <div>
        <a href="./index.php">Back to start</a>
    </div>

    <?php include "./partial/_footer.php" ?>

</body>
</html>