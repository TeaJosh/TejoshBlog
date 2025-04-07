<?php
require_once('../database.php');

class ProfileDAL {
    protected $profile;
    protected $user;
    protected $email;
    protected $address;
    protected $phone;
    protected $userRole;
    protected $allRoles;
    protected $cn;
    protected $db;

    public function __set($attribute, $value) {
        if (property_exists($this, $attribute)) {
            $this->$attribute = $value;
            echo "Updated {$attribute} to {$value}";
        } else {
            echo "Failed to update {$attribute}.";
        }
    }

    public function __get($name) {
        return $this->$name;
    }

    public function LoadProfile($id) {
        $this->cn = $this->db->NewConnection();

        $sql = "Select * from user where iduser = " . $id;
        $this->user = $this->db->getArray($sql);

        $sql = "Select * from profile where iduser = " . $id;
        $this->profile = $this->db->getArray($sql);

        $sql = "Select * from address where iduser = " . $id;
        $this->address = $this->db->getAll($sql);

        $sql = "Select * from phone where iduser = " . $id;
        $this->phone = $this->db->getAll($sql);

        $sql = "Select * from email where iduser = " . $id;
        $this->email = $this->db->getAll($sql);

        $sql = "Select * from vwuser where iduser = " . $id;
        $this->userRole = $this->db->getAll($sql);

        $sql = "Select * from role";
        $this->allRoles = $this->db->getAll($sql);
    }

    function __construct($id=0) {
        $this->db = new Database();

        if ($id > 0) {
            $this-> LoadProfile($id);
        }
    }
}
?>
