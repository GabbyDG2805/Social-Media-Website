<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include('forum_code.php');

$forumCode = new ForumCode();
//$forumCode->send_message($_POST);
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Blog Post - Start Bootstrap Template</title>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
      <!-- Custom styles for this template -->
      <link href="css/quickblog.css" rel="stylesheet">
      <link rel="stylesheet" href="css/chatcss.css">
      <style type="text/css">
        .startMsgUsr:hover 
        {
          opacity: 0.5;
          cursor: pointer;
        }
      </style>
   </head>
   <body style="padding-top: 56px;">
     
      <!-- Page Content -->
      <div class="container">
         <div class="row">
            <!-- Post Content Column -->
            <div class="col-lg-8" id="forumPage">
               <h1 class="mt-4">Forum Page</h1>
               <hr>
                <?php 
                  $posts = $forumCode->get_posts();
                  foreach($posts as $post) {
                    echo '
                      <div class="card my-4">
                      <h5 class="card-header">'. $post['post_title'] . '</h5>
                      <div class="card-body">
                      <p>' . $post['post_author'] . ', ' . date('d/m/y H:i:s', strtotime($post['post-date'])) . '</p>
                      </div>
                      </div>
                    ';
                  } 
                ?>
            </div>
            <div class="col-lg-8" id="privateMsgWidget">
               <h1 class="mt-4">Private Messages</h1>
               <hr>
               <div class="card my-4">
                  <h5 class="card-header">Private Message</h5>
                  <div class="card-body">
                     <div class="panel panel-primary">
                        <div class="panel-body">
                           <ul class="chat">
                              <span id="dynamic_chat"></span>
                           </ul>
                        </div>
                        <div class="panel-footer">
                           <form role="form" method="POST" action="" name="sendMsg" id="sendMsg">
                              <div class="input-group" style="margin-bottom: 5px;">
                                 <input type="hidden" name="receiver" id="receiver" value="">
                                 <input type="hidden" name="sender" id="user_who_online" value="<?php echo $_SESSION['user_online']; ?>">
                                 <input type="text" name="msgbody" id="msgbody" placeholder="Enter your message..." class="form-control">
                              </div>
                              <div class="input-group">
                                 <button type="submit" class="form-control btn btn-success" name="msg_post"><span class="fas fa-paper-plane"></span></button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
               <!-- Search Widget -->
               <div class="card my-4">
                  <h5 class="card-header">People</h5>
                  <div class="card-body">
                    <?php //echo 'tester@test.com' 
                      $getUser = $forumCode->get_users();
                      foreach($getUser as $foundUser) {
                        echo '<div class="input-group toggle-prvmsg" style="border: 0.5px solid black; padding: 5px; border-radius: 10px; margin-bottom:5px;">
                            <img src="assets/generic-profile.png" name="hey" alt="pp" style="height:30px; margin-right: 5px;" class="privMsgUsr">
                            <h5>
                              <span class="startMsgUsr">'. $foundUser['email'] . '</span>
                            </h5>
                         </div>';
                      }
                    ?>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container -->
      <!-- Bootstrap core JavaScript -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <script type="text/javascript">
          $(document).ready(function(){
            $(".startMsgUsr").click(function(e) {
              var messageThem = $(this).text();
              var online_user = $('#user_who_online').val();

              $("#receiver").val(messageThem);

              $.ajax({
                type: "POST",
                url: 'private_room_ajax.php',
                data: {'who_sending': online_user,"messageThem": messageThem},
                success: function(data) {
                  $('#dynamic_chat').html(data);

                },
                error: function(xhr){
                  alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
              });
            });


            $("#sendMsg").submit(function(e) {
              e.preventDefault();
              var sender = $('#user_who_online').val();
              var receiver = $('#receiver').val();
              var msgContents = $('#msgbody').val();

              $.ajax({
                type: "POST",
                url: 'sendPrivateMsg.php',
                data: {'sender': sender,'receiver': receiver,'msgContents': msgContents},
                success: function(data) {
                  $('#dynamic_chat').html(data);
                },
                error: function(xhr){
                  alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
              });
            });


            $("#privateMsgWidget").hide();
            $(".startMsgUsr").click(function() {
              $("#privateMsgWidget").toggle();
              $("#forumPage").toggle();
            });
          });
      </script>
   </body>
</html>