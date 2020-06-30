<?php
include_once('forum_code.php');

$forumObj = new ForumCode();
$sender = $_POST['sender'];
$receiver = 'public_room';
$msgContents = $_POST['msgContents']; 

$result = $forumObj->send_message($sender, $receiver, $msgContents);