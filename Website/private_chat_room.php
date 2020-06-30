<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('public_chat_code.php');
$pcObj = new PublicChat();
/*if(isset($_SESSION['user_online'])) {
  $profileData = $pcObj->get_profile($_SESSION['user_online']);
}*/
?>
<!doctype html>
<html style="background-color: grey;">
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link href="css/private_chat_room.css" type="text/css" rel="stylesheet"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style type="text/css">
    #sign-out:hover {
      opacity: 0.5;
    }
  </style>
</head>
<body style="background-color: grey;" >
<div class="container" style="background-color: grey; color: grey;">
<h3 class=" text-center" style='color:white;'>Private Chat Room <?php if(isset($_SESSION['user_online'])) { echo "<a href='user_access_code.php?logout' id='signout-out'><i class='fas fa-sign-out-alt'></i></a>"; } ?></h3>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people" style="background-color: #5f0776;">
          <div class="headind_srch">
            <!-- Search form -->
            <input type="text" class="form-control" id="searchForUser" placeholder="Search User..." >
          </div>
          <div class="inbox_chat" >
            <?php //echo 'tester@test.com' 
                $getUser = $pcObj->get_users();
                foreach($getUser as $foundUser) {
                  echo '<div class="chat_list">
                    <div class="chat_people">
                      <div class="chat_img"> <img src="Assets/' . $foundUser['profile_picture'] . '" alt="pp"> </div>
                      <div class="chat_ib">
                        <h5>' . ucfirst($foundUser['first_name']) . " " . ucfirst($foundUser['last_name']) . '</h5>
                        <!--<span class="chat_date">04/03/2019</span><p>Marmelade.</p>-->
                      </div>
                    </div>
                  </div>';
                }
              ?>





          </div>
        </div>
        <div class="mesgs">
          <div class="msg_history">
          </div>
          <div class="type_msg">
            <div class="input_msg_write">
              <form name="publicSubmitMsg" id="publicSubmitMsg">
                <div class="form-group">
                  <input type="hidden" name="sender" id="user_who_online" value="<?php echo $_SESSION['user_online']; ?>">
                  <input type="text" class="form-control" name="publicTxt" id="publicTxt" placeholder="Write your message and press enter..." />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      var ajaxCall=function() {
        var online_user = $("#user_who_online").val();
        $.ajax({
            type:'POST',
            url:'public_room_get.php',
            data: {'online_user': online_user},
            success:function(data)
            {
              $('.msg_history').html(data);
            }
        });
      }
      setInterval(ajaxCall,1000);
      $("#publicSubmitMsg").submit(function(e) {
          e.preventDefault();
          var sender = $('#user_who_online').val();
          var msgContents = $('#publicTxt').val();

          $.ajax({
            type: "POST",
            url: 'public_room_send.php',
            data: {'sender': sender,'msgContents': msgContents},
            success: function(data) {
              console.log('successfully sent message');
              $('#publicTxt').val('');
            },
            error: function(xhr){
              alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
          });
        });
    });
  </script>
    </body>
    </html>