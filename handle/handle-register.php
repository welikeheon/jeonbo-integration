<?php
require('../libs/lib-core.php');

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$ip_addr = $_SERVER['REMOTE_ADDR'];

$log->info($ip_addr);

// 이메일 형식 체크하기 (true (맞음) , false(틀림) )
function filter_email($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function check_email_already_exist($email)
{
    global $mysqli;

    $stmt = $mysqli->prepare("select `memberlist`.member_id, `confirm_email`.email from memberlist, confirm_email where `memberlist`.member_id = `confirm_email`.member_id and `memberlist`.enabled = 1 and `confirm_email`.email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row_element = $result->num_rows;
    if (!$row_element) {    // 없으면 false
        return false;
    }
    return true;    // 있으면 true
}

$salt = random_bytes(23);
$rstr = random_bytes(23);

$reguser = array(
    "username" => $mysqli->real_escape_string($_POST['username']),
    "email" => $mysqli->real_escape_string($_POST['email']),
    "password" => $mysqli->real_escape_string($_POST['password']),
    "register_key" => sha1("4k3lj42" . $mysqli->real_escape_string($_POST['username']) . $rstr),
    "ip_addr" => $ip_addr,
    "expired_at" => date("Y/m/d H:i:s", strtotime("+30 minutes"))
);

// 이미 이메일이 있는지 체크함
$check_already_exist = check_email_already_exist($reguser['email']);
if ($check_already_exist == true) {
    echo '<script>alert("이미 가입된 이메일이 있습니다.");history.back();</script>';
    die();
}

$opts = array(
    'cost' => 10,
    'salt' => $salt
);
$hashed = password_hash($reguser['password'], PASSWORD_BCRYPT, $opts);
$reguser['password'] = $hashed;

$stmt1 = $mysqli->prepare("INSERT INTO memberlist (username, password, enabled, created_ip, email) VALUES (?, ?, 0, ?, ?)");
$stmt1->bind_param("ssss", $reguser['username'], $reguser['password'], $reguser['ip_addr'], $reguser['email']);
if (!$stmt1->execute()) {
    echo $mysqli->error;
}
$stmt1->close();



$member_id = sql_fetch("memberlist", "member_id", "email", $reguser['email']);

$stmt1 = $mysqli->prepare("INSERT INTO confirm_email (member_id, expired_at, email, secured_key) VALUES (?, ?, ?, ?)");
$stmt1->bind_param("ssss", $member_id, $reguser['expired_at'], $reguser['email'], $reguser['register_key']);
if (!$stmt1->execute()) {
    echo $mysqli->error;
} else {
    echo "<meta charset='utf-8'><script>alert('회원가입 완료!, 로그인 후 전자책을 보관해주세요.');location.href='/index.php';</script>";
}
$stmt1->close();
