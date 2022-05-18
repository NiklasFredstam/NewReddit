<?php

echo 
'<form name="create-thread" action="./php/create_thread_post.php" onsubmit="checkThread()" method="post">
        <label for="Subject">Subject:</label>
        <input type="text" name="topic" id="topic" placeholder="Enter a subject title..." required minlength="8" title="Required">
        <label for="text">Text:</label>
        <input type="text" name="text" id="text" placeholder="..." title="Optional">
        <input type="submit" value="Send" >
</form>';
?>