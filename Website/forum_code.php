<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Class for manipulating the data for the forum page
 */
class ForumCode
{
	
	function __construct()
	{
		include 'database.php';
	}

	public function get_posts() {
		$db = new Database();
		$connection = $db->open_connection("groupproject");

		$getposts = "SELECT * FROM forum_posts LIMIT 5";
		
		$result = $db->queryDb($connection, $getposts);

		if (!$result) {
		    trigger_error('Invalid query: ' . $connection->error);
		}

		return $result;
	}

	//currently generic fetch users - will be adapted into 'online users'
	public function get_users() {
		$db = new Database();
		$connection = $db->open_connection("groupproject");

		$getusers = "SELECT `email` FROM accounts";

		$foundUsers = $db->queryDb($connection, $getusers);

		if(!$foundUsers) {
			trigger_error('Ivalid query: ' . $connection->error);
		}
		return $foundUsers;
	}

	public function get_private_messages($loggedInUser, $selectedUsr) {
		$db = new Database();
		$connection = $db->open_connection("groupproject");

		$getPrivMsgs = "SELECT * FROM private_messages WHERE (sender = '" . $loggedInUser . "' AND receiver = '" . $selectedUsr . "') OR (receiver = '" . $loggedInUser . "' AND sender = '" . $selectedUsr . "')";

		$result = $db->queryDb($connection, $getPrivMsgs);

		if (!$result) {
		    trigger_error('Invalid query: ' . $connection->error);
		}

		return $result;		
	}

	public function send_message($sender, $receiver, $msgContents) {
		$db = new Database();
		$connection = $db->open_connection("groupproject");

		$msgToSend = isset($msgArray['msgbody']) && !empty($msgArray['msgbody']) ? $msgArray['msgbody'] : null;

		$sendMsgQuery = "INSERT INTO private_messages (sender, receiver, message_contents, sent_time, opened) VALUES ('" . $sender . "', '" . $receiver . "', '" . $msgContents . "', '" . date('d/m/y H:i:s') . "', '" . 0  . "')";
		$sendMsgResult = $db->queryDb($connection, $sendMsgQuery);

		if (!$sendMsgResult) {
		    trigger_error('Invalid query: ' . $connection->error);
		}
	}
}