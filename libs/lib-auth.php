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
            $_SESSION['email'] = $_POST['email'];
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
        if (@$_SESSION['listed'] !== sha1('listed')) {
            return false;
        } else {
            $data['username'] = $_SESSION['username'];
            $data['email'] = $_SESSION['email'];
            $data['role'] = $_SESSION['role'];
            return $data;
        }
    }

    

    public function isadminli() {
        if ($_SESSION['listed'] !== sha1('listed')) {
            return false;
        } else {
            if ($_SESSION['role'] == 'adm') {
                return true;
            } else {
                return false;
            }
        }
    }

    public function isadmin ($user) {
        if ($this->getrole($user) == 'adm') {
            return true;
        } else {
            return false;
        }
    }

    public function headblock () {
        if (is_array($this->islogged())) {
            echo "<!--";
        }
    }

    // public function headendblock ($ar = false) {
    //     if (is_array($this->islogged())) {
    //         $authinfo = $this->islogged();
    //         echo "-->";
    //         $text = '<div class=\'nav pull-right navbar-nav\' style=\'color: white\'>
    //                     <li class=\'dropdown\'>
    //                     <a class="dropdown-toggle" href="#" data-toggle="dropdown" style=\'padding-right: 10px\'>' . $authinfo['username'] . ' <strong class="caret"></strong></a>
    //                         <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu">
    //                             <li><a tabindex="-1" href="/dashboard/index.php">대시보드</a></li>
    //                             <!--li><a tabindex="-1" href="/dashboard/index.php#settings">설정</a></li-->
    //                             <li><a tabindex="-1" href="/logout.php">로그아웃</a></li>
    //                         </ul>
    //                     </li>
    //                 </div>';
    //         if ($ar == true) {
    //             # if called from UCP
    //             $text = '<div class=\'nav pull-right navbar-nav\' style=\'color: white\'>
    //                         <li class=\'dropdown\'>
    //                         <a class="dropdown-toggle" href="#" data-toggle="dropdown" style=\'padding-right: 10px\'>' . $authinfo['username'] . ' <strong class="caret"></strong></a>
    //                             <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu">
    //                                 <li><a tabindex="-1" href="index.php">대시보드</a></li>
    //                                 <!--li><a tabindex="-1" href="index.php#settings">설정</a></li-->
    //                                 <li><a tabindex="-1" href="/logout.php">로그아웃</a></li>
    //                             </ul>
    //                         </li>
    //                     </div>';
    //         }


    //         echo $text;
    //     }
    // }

    public function getRole($email) {
        global $mysqli;
        $stmt = $mysqli->prepare("select role from memberlist where email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $query_result = mysqli_fetch_assoc($result);
        return $query_result['role'];
    }

    public function getUsername($email) {
        global $mysqli;
        $stmt = $mysqli->prepare("select username from memberlist where email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $query_result = mysqli_fetch_assoc($result);
        return $query_result['username'];
    }

    public function getinfomu ($username) {
        global $mysqli;
        $username = $mysqli->real_escape_string($username);
        $a = "SELECT `role`,`username`,`ip`,`theme`,`rkey` FROM `auth` WHERE username='{$username}';";
        $b = $mysqli->query($a) or showerror();

        $numrows = $b->num_rows;
        if (!$numrows) {
            return false;
        }
        $c = mysqli_fetch_assoc($b);
        return $c;
    }
    
    public function getsettingvalue ($username) {
        global $mysqli;
        $username = $mysqli->real_escape_string($username);
        $a = "SELECT `nickname`, `email`, `sex` FROM `auth` WHERE username='{$username}';";
        $b = $mysqli->query($a) or showerror();
        $numrows = $b->num_rows;
        if (!$numrows) {
            return false;
        }
        $c = mysqli_fetch_assoc($b);
        return $c;
    }

    public function getinfome ($email) {
        global $mysqli;
        $email = $mysqli->real_escape_string($email);
        //$a = "SELECT `role`,`username`,`ip,`theme`,`rkey` FROM `auth` WHERE email='{$email}';";
        $a = "SELECT `role`,`username`,`ip`,`theme`,`rkey` FROM `auth` WHERE email='{$email}';";
        $b = $mysqli->query($a) or showerror();

        $numrows = $b->num_rows;
        if (!$numrows) {
            return false;
        }
        $c = mysqli_fetch_assoc($b);
        return $c;
    }

    public function crkey ($username) {
        global $mysqli;
        $nrkey = sha1($username . (string) (rand(100, 4434555)) . date('yDm'));
        $usernamesan = $mysqli->real_escape_string($username);
        $qr = "UPDATE auth SET rkey='{$nrkey}' WHERE username='$usernamesan';";
        $e = $mysqli->query($qr) or showerror();
    }
}