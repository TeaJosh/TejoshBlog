<?php
// Define the base directory (adjust the path accordingly)
define('BASE_DIR', realpath(dirname(__FILE__) . '/../..')); // Navigate up to the correct level

// Require the config file using the base directory
require_once(BASE_DIR . '/homework/portfolio/config.php'); // Adjusted path

class Database {
    protected $user;
    protected $password;
    protected $db;
    protected $cn;

    public function __construct() {
        $this->loadConfig();
        $this->getConnection(); // Ensure the connection is initialized
    }

    protected function loadConfig() {
        $config = new Configuration();
        
        $this->user = $config->username;
        $this->password = $config->password;
        $this->db = $config->database;
    }

    public function getConnection() {
        if ($this->cn === null) {
            $this->cn = new mysqli("localhost", $this->user, $this->password, $this->db);
        
            if ($this->cn->connect_errno) {
                throw new Exception("Failed to connect to MySQL: " . $this->cn->connect_error);
            }
        }
        return $this->cn;
    }

    public function closeConnection() {
        if ($this->cn) {
            $this->cn->close();
            $this->cn = null;
        }
    }

    public function __set($name, $value) {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }

    public function getAll($query) {
        if (empty($query)) {
            throw new InvalidArgumentException("Query cannot be blank");
        }

        $result = $this->cn->query($query);
        if (!$result) {
            throw new Exception("Query failed: " . $this->cn->error);
        }
        
        $array = $result->fetch_all(MYSQLI_ASSOC);
        $result->free_result();
        return $array;
    }

    public function getArray($query) {
        if (empty($query)) {
            throw new InvalidArgumentException("Query cannot be blank");
        }

        $result = $this->cn->query($query);
        if (!$result) {
            throw new Exception("Query failed: " . $this->cn->error);
        }

        $array = $result->fetch_array(MYSQLI_ASSOC);
        $result->free_result();
        return $array;
    }

    public function __destruct() {
        $this->closeConnection();
    }
}

$db = new Database();
$cn = $db->getConnection();
?>
