<?php
require_once('../database.php');

class ProfileDAL {
    protected $profile;
    protected $user;
    protected $email;
    protected $address;
    protected $phone;
    protected $userRoles;
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

        $sql = "SELECT * FROM user WHERE iduser = " . intval($id);
        $this->user = $this->db->getArray($sql);

        $sql = "SELECT * FROM profile WHERE iduser = " . intval($id);
        $this->profile = $this->db->getArray($sql);

        $sql = "SELECT * FROM address WHERE iduser = " . intval($id);
        $this->address = $this->db->getAll($sql);

        $sql = "SELECT * FROM phone WHERE iduser = " . intval($id);
        $this->phone = $this->db->getAll($sql);

        $sql = "SELECT * FROM email WHERE iduser = " . intval($id);
        $this->email = $this->db->getAll($sql);

        $sql = "SELECT * FROM vwuser WHERE iduser = " . intval($id);
        $this->userRoles = $this->db->getAll($sql);

        $sql = "SELECT * FROM role";
        $this->allRoles = $this->db->getAll($sql);
    }

    function SaveProfilePicture($picture) {
        if (empty($picture)) {
            return "Error: Invalid operation, the picture was not defined!";
        }

        $profileId = $this->profile['idprofile'];
        $sql = "UPDATE profile SET picture=? WHERE idprofile=?";
        $msg = "";

        $cn = $this->db->NewConnection();
        $stmt = $cn->prepare($sql);

        if (!$stmt->bind_param("si", $picture, $profileId)) {
            $msg = "Error: Parameter Binding Failed";
        } elseif (!$stmt->execute()) {
            $msg = "Error: Execute Failed: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            $msg = "Success: Profile picture saved";
        }

        $this->db->CloseConnection();
        return $msg;
    }

    function SaveProfile($userid, $firstname, $lastname, $middlename, $dateofbirth, $color, $about, $active, $mode) {
        $msg = "";
        $isActive = $active == "on" ? 1 : 0;
        $cn = $this->db->NewConnection();

        if ($mode == 'edit') {
            $profileid = $this->profile['idprofile'];
            $sql = "UPDATE profile SET firstname=?, lastname=?, middlename=?, date_of_birth=?, color=?, about=?, active=? WHERE idprofile=?";
            $stmt = $cn->prepare($sql);

            if (!$stmt->bind_param("ssssssii", $firstname, $lastname, $middlename, $dateofbirth, $color, $about, $isActive, $profileid)) {
                return "Error: Parameter Binding Failed";
            }

        } elseif ($mode == 'new') {
            $sql = "INSERT INTO profile (iduser, firstname, lastname, middlename, date_of_birth, color, about, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $cn->prepare($sql);

            if (!$stmt->bind_param("issssssi", $userid, $firstname, $lastname, $middlename, $dateofbirth, $color, $about, $isActive)) {
                return "Error: Parameter Binding Failed";
            }

        } else {
            return "Error: Invalid operation mode!";
        }

        if (!$stmt->execute()) {
            $msg = "Error: Execute Failed: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            $msg = "Success: Profile saved";
        }

        $this->db->CloseConnection();
        return $msg;
    }

    function RefreshProfile($id) {
        $this->cn = $this->db->CloseConnection();
        $sql = "SELECT * FROM profile WHERE iduser=" . intval($id);
        $this->profile = $this->db->getArray($sql);
        $this->db->CloseConnection();
        return $this->profile;
    }

    function RefreshUser($id) {
        $this->cn = $this->db->CloseConnection();
        $sql = "SELECT * FROM user WHERE iduser=" . intval($id);
        $this->user = $this->db->getArray($sql);
        $this->db->CloseConnection();
        return $this->user;
    }

    function RefreshEmails($id) {
        $this->cn = $this->db->CloseConnection();
        $sql = "SELECT * FROM email WHERE iduser=" . intval($id);
        $this->email = $this->db->getAll($sql);
        $this->db->CloseConnection();
        return $this->email;
    }

    function __construct($id = 0) {
        $this->db = new Database();

        if ($id > 0) {
            $this->LoadProfile($id);
        }
    }
}
?>
