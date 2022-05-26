<?php

echo 
'<form name="thread-form" class="thread-form" action="./php/create_thread_post.php" onsubmit="checkThread()" method="post">
        <input type="text" class="thread-form-topic" name="topic" id="topic" placeholder="Enter your topic..." required minlength="8" title="Required">
        <textarea type="text" class="form-textarea" name="text" id="text" placeholder="Write your text here..." title="Optional"></textarea>
        <input type="submit" class="standard-button" value="Create Thread" >
</form>';
?>