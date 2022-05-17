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
    <link rel="stylesheet" type="text/css" href='./css/style.css?v=<?php time() ?>'>
    <!-- <link rel="stylesheet" href="./css/style.css"> -->
    <script src="./js/ThreadFilter.js"></script>	
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>	
</head>

<body>

    <?php include "./partial/_header.php"; ?>

    <div class="search-container">

        <input type="text" id="filter" class="search-bar" placeholder="Search topics..." onkeyup="filterThreads()">

    </div>
    
    <div class="center-flex">
        <div class="thread-container" id="threads">
            <?php
            $db = new DB();
            $threads = $db -> getThreads();
            foreach($threads as $t) {
                echo
                "<a class='thread' href='./thread.php?thread=" . $t["thread_id"] . "'>
                    <div class='thread-topic'>"
                    . $t['topic']
                    . "</div>"
                    .  "<div class='thread-username'>"
                    . $t['username']
                    . "</div>
                </a>";
            }
            ?>
        </div>
    </div>

    <?php include "./partial/_footer.php" ?>

</body>
</html>