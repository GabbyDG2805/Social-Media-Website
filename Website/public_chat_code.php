<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * 
 */
class PublicChat
{
	
	function __construct()
	{
		include 'database.php';
	}

	//function to get profile information
	public function get_profile($user) {
		$db = new Database();
		$connection = $db->open_connection("groupproject");

		$findProfile = "SELECT * FROM accounts WHERE email LIKE '%" . $user . "%' LIMIT 1";
		
		$resultProfile = $db->queryDb($connection, $findProfile);
		/*if (!$result) {
		    trigger_error('Invalid query: ' . $connection->error);
		}*/
		if ($resultProfile->num_rows > 0) {
			return $profileData = mysqli_fetch_assoc($resultProfile);
		} else {
			$_SESSION['failMsg'] = "Email or password is incorrect!";
		}		
	}

	//currently generic fetch users - will be adapted into 'online users'
	public function get_users() {
		$db = new Database();
		$connection = $db->open_connection("groupproject");

		$getusers = "SELECT `profile_picture`, `email`, `first_name`, `last_name` FROM accounts";

		$foundUsers = $db->queryDb($connection, $getusers);

		if(!$foundUsers) {
			trigger_error('Ivalid query: ' . $connection->error);
		}
		return $foundUsers;
	}

	public function get_public_posts() {
		$db = new Database();
		$connection = $db->open_connection("groupproject");

		$getPrivMsgs = "SELECT * FROM private_messages WHERE receiver = 'public_room' ORDER BY `private_messages`.`sent_time` DESC";

		$result = $db->queryDb($connection, $getPrivMsgs);

		if (!$result) {
		    trigger_error('Invalid query: ' . $connection->error);
		}

		return $result;		
	}
}