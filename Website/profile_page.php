<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start(); 

include 'profile_code.php';
$profileObj = new Profile();
if(isset($_SESSION['user_online'])) {
	$profileData = $profileObj->get_profile($_SESSION['user_online']);
	if(isset($_POST['update-bio-hidden']) == "bio-update"){
		$profileObj->updateBio($_POST['bio-text'], $_SESSION['user_online']);
	}
	if(isset($_POST['create-post-hidden']) == "create-post-hidden") {
		$profileObj->create_post($_POST['create-post-title'], $_POST['create-post-text'], $_SESSION['user_online']);
	}
	if(isset($_POST['update_profile_pic']) == 'update_profile_pic') {
		$profileObj->uploadPicture($_FILES["profilePictureToUpload"], $_SESSION['user_online']);
	}
}
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/profile_styles.css">
		<!-- <script src="JS/main.js"></script> -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<!-- <script src="https://use.fontawesome.com/781a8c5bc8.js"></script> -->
		<!-- jQuery Modal -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<style type="text/css">
			.nav:hover{
				cursor: pointer;
			}
			.editProPic:hover {
				cursor: pointer;
			}
		</style>
	</head>

	<body>
		<div class="container">
			<div id="Banner">
				<?php 
					if($profileData['university'] == 'University of Lincoln') {
						echo '<img id="BannerImage" src="Assets/lincolnbanner.jpg" alt="The University of Lincoln">';
					} else if ($profileData['university'] == 'University of Nottingham') {
						echo '<img id="BannerImage" src="Assets/nottinghambanner.jpg" alt="The University of Nottingham">';
					} else if ($profileData['university'] == 'University of Derby') {
						echo '<img id="BannerImage" src="Assets/derbybanner.jpg" alt="The University of Derby">';
					}
					
					if(isset($_SESSION['user_online']) == $profileData['email']) {
						echo '<img align="left" id="ProfilePicture" class="editProPic" src="Assets/' . $profileData['profile_picture'] . '" alt="Me" data-toggle="modal" data-target="#update_profile">';
					} else {
						echo '<img align="left" id="ProfilePicture" class="editProPic" src="Assets/' . $profileData['profile_picture'] . '" alt="Me">';
					}
				?>
				<div id="NameBar">
					<h1 style="color:white; font-size: 20pt; padding-top: 8px;">
						<?php 
							if(isset($_SESSION['user_online'])) {
								echo ucfirst($profileData['first_name']) . " " . ucfirst($profileData['last_name']); 
							} else {
								echo "<a href='login.php'>You should log in.</a>";
							}
						?>
					</h1>
					<nav id="NavigationBar" >
						<ul id="Navigation">
							<li class="NavigationList tablinks" onclick="openTab(event, 'AboutMe')"><a class="nav" >About Me</a></li>
							<li class="NavigationList tablinks" onclick="openTab(event, 'activity-feed')"><a class="nav">Activity Feed</a></li>
							<?php
								if(isset($_SESSION['user_online'])) {
									if($_SESSION['user_online'] == $profileData['email']) {
										echo '<li class="NavigationList tablinks"><a class="nav"  data-toggle="modal" data-target="#create-post">Create Post <i class="fas fa-pencil-alt"></i></a></li>';
									}
								}
							?>
						</ul>
					</nav>
				</div>
			</div>
			<section id="Profile">		
				<div id="Summary">
			
				</div>
				<div id="AboutMe" class="tabcontent" style="margin-top: 10px;">
					<h1 style="text-decoration: underline;">About Me</h1>
					<p>
						<?php 
							if(isset($_SESSION['user_online'])) {
								echo "I study " . $profileData['course'] . " at the " . $profileData['university'] . "."; 
							}
						?>
					</p>
					<br>
					<?php
						if(isset($_SESSION['user_online'])) {
							if($_SESSION['user_online'] == $profileData['email']) {
								echo '<h3 style="text-decoration: underline; color:#5f0776;" data-toggle="modal" data-target="#bio-text">Bio <i class="fas fa-pencil-alt"></i></h3>';
							} else {
								echo '<h3 style="text-decoration: underline;"><Bio</h3>';
							}
						}
					?>
					<p>
						<?php if(isset($_SESSION['user_online'])) { echo $profileData['about_text']; }?>
					</p>
				</div>
				<div id="activity-feed" class="tabcontent" style="margin-top: 10px;">
					<h1 style="text-decoration: underline;">Activity</h1>
					<?php 
						if(isset($_SESSION['user_online'])) {
							$posts = $profileObj->get_profile_activity($profileData['first_name']);
							if ($posts->num_rows > 0) {
			                    foreach($posts as $post) {
			                     	echo '
			                    	<div class="card" style="width: 18rem;">
									  <div class="card-header" style="background-color:#5f0776; color:white;">
									  ' . $post['post_title'] . '
									  </div>
									  <div class="card-body">
									  	<p>
									  		' . $post['post_author'] . ', ' . date('d/m/y H:i:s', strtotime($post['post_date'])) . '
									  	</p>
									  </div>
									</div>
			                    ';
			                    }
			                } else {
			                    echo '
			                    	<div class="card" style="width: 18rem;">
									  <div class="card-header">
									   <i class="far fa-frown"></i>
									  </div>
									  <div class="card-body">
									  	<p>
									  		You haven\'t posted yet.
									  	</p>
									  </div>
									</div>
			                    ';
			                }
			            }
	                ?>
				</div>
			</section>

<div class="modal fade" id="update_profile" tabindex="-1" role="dialog" aria-labelledby="updateProfilePic" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateProfilePic">Update Your Profile Picture <i class="far fa-smile"></i></h5>
      </div>
      	<form method="POST" action="" enctype="multipart/form-data">
      		<div class="modal-body">
				<input type="hidden" value="update_profile_pic" name="update_profile_pic">
				<input type="file" name="profilePictureToUpload" id="profilePictureToUpload" /> 
	        	<button class="btn btn-success" type="submit" id="profile-pic-submit" name="profile-pic-submit">Submit <i class="fas fa-pencil-alt"></i></button>
	      </div>
	    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="bio-text" tabindex="-1" role="dialog" aria-labelledby="updateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateLabel">Update Your Bio <i class="far fa-smile"></i></h5>
      </div>
      	<form role="form" method="POST" action="">
      		<div class="modal-body">
				<input type="hidden" value="bio-update" name="update-bio-hidden">
				<div class="form-group">
					<textarea class="form-control" id="bio-text" name="bio-text" aria-describedby="bio-text" style="resize: none;"><?php echo $profileData['about_text']; ?></textarea>
				</div>
	        	<button class="btn btn-primary" type="submit" id="bio-submit" name="bio-submit">Edit <i class="fas fa-pencil-alt"></i></button>
	      </div>
	    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="create-post" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createLabel">Create Post <i class="far fa-smile"></i></h5>
      </div>
      	<div class="modal-body">
			<form role="form" method="POST" action="">
				<input type="hidden" value="create-post-form" name="create-post-hidden">
				<div class="form-group">
				    <input type="text" class="form-control" name="create-post-title" id="create-post-title" aria-describedby="create-post-title" placeholder="Write a cool title!">
				</div>
				<div class="form-group">
					<textarea class="form-control" id="create-post-text" name="create-post-text" aria-describedby="create-post-text" style="resize: none;" placeholder="Write something magical!"></textarea>
				</div>
	        	<button class="btn btn-success" type="submit" id="create-post-submit" name="create-post-submit" style="width: 100%;">Post <i class="far fa-paper-plane"></i></button>
	    	</form>
	    </div>
    </div>
  </div>
</div>
		</div>
	</body>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#activity-feed").hide();
		});
		function openTab(evt, cityName) {
		  // Declare all variables
		  var i, tabcontent, tablinks;

		  // Get all elements with class="tabcontent" and hide them
		  tabcontent = document.getElementsByClassName("tabcontent");
		  for (i = 0; i < tabcontent.length; i++) {
		    tabcontent[i].style.display = "none";
		  }

		  // Get all elements with class="tablinks" and remove the class "Selected"
		  tablinks = document.getElementsByClassName("tablinks");
		  for (i = 0; i < tablinks.length; i++) {
		    tablinks[i].className = tablinks[i].className.replace(" Selected", "");
		  }

		  // Show the current tab, and add an "Selected" class to the button that opened the tab
		  document.getElementById(cityName).style.display = "block";
		  evt.currentTarget.className += " Selected";
		}
	</script>
</html>