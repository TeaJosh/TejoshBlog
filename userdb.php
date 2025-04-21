<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "userdb";

try {
	// Create a PDO instance
	$pdo = new PDO("mysql:host=$db_server; dbname=$db_name; charset=utf8", $db_user, $db_pass);

	// Set error mode to exception
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	} catch (PDOException $e) {
		// Handle connection errors
		die("Could not connect! Error: " . $e->getMessage());
	}
?>
