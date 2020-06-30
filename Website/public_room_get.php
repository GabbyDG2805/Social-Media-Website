<?php
include_once('public_chat_code.php');
$pcObj = new PublicChat();

  $chatPosts = $pcObj->get_public_posts();
  foreach($chatPosts as $chatPost) {
    if($chatPost['sender'] == $_POST['online_user']) {
      echo '
        <div class="outgoing_msg">
          <div class="sent_msg">
            <p>' . $chatPost['message_contents'] . '</p>
            <span class="time_date"> ' . $chatPost['sent_time'] . '</span> </div>
        </div>';
    } else {
      echo '
        <div class="incoming_msg">
          <div class="incoming_msg_img"> <img src="assets/generic-profile.png" alt="pp"> </div>
          <div class="received_msg">
            <div class="received_withd_msg">
              <p>' . $chatPost['message_contents'] . '</p>
              <span class="time_date"> ' . $chatPost['sent_time'] . '</span></div>
          </div>
        </div>';
    }
  }
?>