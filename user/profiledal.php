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
        $conn = $this->db->NewConnection();

        $sql = "SELECT * FROM user WHERE iduser = ?";
        $this->user = $this->db->getArray($sql, [$id]);

        $sql = "SELECT * FROM profile WHERE iduser = ?";
        $this->profile = $this->db->getArray($sql, [$id]);

        $sql = "SELECT * FROM address WHERE iduser = ?";
        $this->address = $this->db->getAll($sql, [$id]);

        $sql = "SELECT * FROM phone WHERE iduser = ?";
        $this->phone = $this->db->getAll($sql, [$id]);

        $sql = "SELECT * FROM email WHERE iduser = ?";
        $this->email = $this->db->getAll($sql, [$id]);

        $sql = "SELECT * FROM vwuser WHERE iduser = ?";
        $this->userRoles = $this->db->getAll($sql, [$id]);

        $sql = "SELECT * FROM role";
        $this->allRoles = $this->db->getAll($sql);

        $this->db->CloseConnection();
    }

    function SaveProfilePicture($picture) {
        if (empty($picture)) {
            return "Error: Invalid operation, the picture was not defined!";
        }

        $profileId = $this->profile['idprofile'];
        $sql = "UPDATE profile SET picture=? WHERE idprofile=?";
        $msg = "";

        $conn = $this->db->NewConnection();
        $stmt = $conn->prepare($sql);

        if (!$stmt->bind_param("si", $picture, $profileId)) {
            $msg = "Error: Parameter Binding Failed";
        } elseif (!$stmt->execute()) {
            $msg = "Error: Execute Failed: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            $msg = "Success: Profile picture saved";
        }

        $stmt->close();
        $this->db->CloseConnection();
        return $msg;
    }

    function SaveProfile($userid, $firstname, $lastname, $middlename, $dateofbirth, $color, $about, $active, $mode) {
        $msg = "";
        $isActive = $active == "on" ? 1 : 0;
        $conn = $this->db->NewConnection();

        if ($mode == 'edit') {
            $profileid = $this->profile['idprofile'];
            $sql = "UPDATE profile SET firstname=?, lastname=?, middlename=?, date_of_birth=?, color=?, about=?, active=? WHERE idprofile=?";
            $stmt = $conn->prepare($sql);

            if (!$stmt->bind_param("ssssssii", $firstname, $lastname, $middlename, $dateofbirth, $color, $about, $isActive, $profileid)) {
                return "Error: Parameter Binding Failed";
            }

        } elseif ($mode == 'new') {
            $sql = "INSERT INTO profile (iduser, firstname, lastname, middlename, date_of_birth, color, about, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

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

        $stmt->close();
        $this->db->CloseConnection();
        return $msg;
    }

    function RefreshProfile($id) {
        $conn = $this->db->NewConnection();
        $sql = "SELECT * FROM profile WHERE iduser=?";
        $this->profile = $this->db->getArray($sql, [$id]);
        $this->db->CloseConnection();
        return $this->profile;
    }

    function RefreshUser($id) {
        $conn = $this->db->NewConnection();
        $sql = "SELECT * FROM user WHERE iduser=?";
        $this->user = $this->db->getArray($sql, [$id]);
        $this->db->CloseConnection();
        return $this->user;
    }

    function RefreshEmails($id) {
        $conn = $this->db->NewConnection();
        $sql = "SELECT * FROM email WHERE iduser=?";
        $this->email = $this->db->getAll($sql, [$id]);
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
