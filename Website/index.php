<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<p>
		<?php 
			if(isset($_SESSION['user_online'])){
			    echo hey . $_SESSION['user_online'];
			    echo "<br/> <a href='user_access_code.php?logout'>Logout</a>";
			} else {
			    echo 'why not <a href="login.php">log in</a>?';
			}
		?>		
	</p>
</body>
</html>