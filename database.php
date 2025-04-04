<?php
require_once '../secure/config.php';

class Database {
    protected $user = "root";
    protected $password = "";
    protected $db = "site";
    protected $cn;

    public function GetConnection() {
        $config = new Configuration();
        
        $this->user = $config->username;
        $this->password = $config->password;
        $this->db = $config->database;

        $this->cn = new mysqli("localhost", $this->user, $this->password, $this->db);
        
        if ($this->cn->connect_errno) {
            echo "Failed to connect to MySQL: " . $this->cn->connect_error;
            exit();
        }
        return $this->cn;
    }

    public function CloseConnection() {
        if ($this->cn) {
            $this->cn->close();
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
        $cn = $this->cn;
        if ($query == "") {
            return "Error: Query cannot be blank";
        }
        
        $result = $this->cn->query($query);
        $array = $result->fetch_all(MYSQLI_ASSOC);
        $result->free_result();
        return $array;
    }

    public function getArray($query) {
        $cn = $this->cn;
        if ($query == "") {
            return "Error: Query cannot be blank";
        }

        $result = $this->cn->query($query);
        $array = $result->fetch_array(MYSQLI_ASSOC);
        $result->free_result();
        return $array;
    }
}

$db = new Database();
$cn = $db->GetConnection();
?>
