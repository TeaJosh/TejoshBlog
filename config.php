<?php
// config.php - Database configuration

class Configuration {
    public $username = "root";     // Database username
    public $password = "";         // Database password
    public $database = "site";     // Database name
    public $host = "localhost";    // Database host (usually localhost)

    // Constructor to allow easy overriding of default values
    public function __construct($username = null, $password = null, $database = null, $host = null) {
        if ($username) $this->username = $username;
        if ($password) $this->password = $password;
        if ($database) $this->database = $database;
        if ($host) $this->host = $host;
    }
}
?>
