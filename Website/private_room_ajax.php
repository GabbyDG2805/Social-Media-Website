<?php
include 'forum_code.php';

$forumObj = new ForumCode();
$result = $forumObj->get_private_messages($_POST['who_sending'], $_POST['messageThem']);

while ($data = mysqli_fetch_row($result)) {
    
    if ($data[1] == $_POST['who_sending']) {
        echo '
        <li>
          <span style="float: right;">
            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" />
          </span>
          <strong>' . $data[1] . '</strong>
          <small class=" text-muted"><span class="fa fa-clock"></span> ' . $data[4] . '</small>
          <p>
              ' . $data[3] . '
          </p>
        </li>';
    } else {
        echo '<li>
                <span style="float: left; margin-right: 5px;">
                  <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                </span>
                <strong >' . $data[1] . '</strong> <small class="pull-right text-muted">
                <span class="fa fa-clock"></span> ' . $data[4] . '</small>
                <p>
                    ' . $data[3] . '
                </p>
            </li>';
    }
}