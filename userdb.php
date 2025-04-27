<?php
// Check whether we're on localhost or live server and set DB credentials accordingly
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    // Local database connection
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "userdb";
} else {
    // Live server database connection (kmvsolutions.net)
    $db_server = "localhost";
    $db_user = "TRana";
    $db_pass = "1bcc19af";
    $db_name = "kmvsolutions_TRana";
}

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
