<?php
require_once('lib-core.php');
require_once('lib-password.php');

class Authentication {
    public $authcreds = array();

    public function processlogin ($email, $password) {
        global $mysqli;
        $sql = "SELECT `password`,`enabled` FROM `memberlist` WHERE `email`=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $query_result = mysqli_fetch_assoc($result);

        $enabled = $query_result['enabled'];
        $hashed_password = $query_result['password'];

        if ((!$hashed_password) || (!$enabled)) {
            return false;
        }

        $pwf = password_verify($password, $hashed_password);
        if ($pwf && ($enabled = 1)) {
            session_regenerate_id();
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $this->getRole($this->getMemberID($_SESSION['email']));
            $_SESSION['member_id'] = $this->getMemberID($_SESSION['email']);
            return true;
        } else {
            return false;
        }
    }

    public function sanitize($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    public function islogged() {
        if (!$_SESSION['member_id']) {
            return false;
        } else {
            $data['username'] = $_SESSION['username'];
            $data['email'] = $_SESSION['email'];
            $data['member_id'] = $_SESSION['member_id'];
            $data['role'] = $_SESSION['role'];
            return $data;
        }
    }
    

    public function isAdmin ($member_id) {
        if ($this->getRole($member_id) == 'Administrator') {
            return true;
        } else {
            return false;
        }
    }

    public function getRole($member_id) {
        global $mysqli;
        $stmt = $mysqli->prepare("select role from memberlist where member_id = ?");
        $stmt->bind_param('i', $member_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row['role'] == NULL) {
            return "User";
        }
        return $row['role'];
    }

    public function getUsername($member_id) {
        global $mysqli;
        $stmt = $mysqli->prepare("select username from memberlist where member_id = ?");
        $stmt->bind_param('i', $member_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['username'];
    }

    public function getMemberID ($email) {
        global $mysqli;
        $sql = "SELECT `member_id` FROM `memberlist` WHERE email=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['member_id'];
    }
}