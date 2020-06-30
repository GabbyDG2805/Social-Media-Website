<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
/**
 *  Database Manipulation 
 */

class Database
{
	private $conn;
	
	public function open_connection($db) {
		// Create connection
		$conn = new mysqli("localhost","joe","12Oblivion!", $db);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		return $conn;
		//echo "connected successfully"; use when testing connection
	}

	public function queryDb($connection, $queryString) {
		$result = $connection->query($queryString);
		return $result;
	}
}