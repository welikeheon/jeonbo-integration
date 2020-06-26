<?php

require('../libs/lib-core.php');

$pw = $_POST['password'];
$type = $_POST['changepw'];
if (!isset($_POST['new_password'])) {
    $stmt = $mysqli->prepare("SELECT `password` FROM `memberlist` WHERE `enabled` = 1 and `member_id` = ?");
    $stmt->bind_param("s", $_SESSION['member_id']);
    $stmt->execute();
    $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    if(!$arr) exit('Error');
    
    $hashed_password = $arr[0]['password'];
    $password_verify = password_verify($pw, $hashed_password);
    
    $result = array(
        "status" => "ok",
        "password_match" => $password_verify
    );
    $stmt->close();
    
    $res = json_encode($result, JSON_UNESCAPED_UNICODE);
    echo $res;
}


if ($type == 1 && isset($_POST['new_password'])) {
    $salt = random_bytes(23);
    $opts = array(
        'cost' => 10,
        'salt' => $salt
    );
    $hashed = password_hash($_POST['new_password'], PASSWORD_BCRYPT, $opts);
    

    $stmt = $mysqli->prepare("UPDATE memberlist SET password = ? WHERE member_id = ?");
    $stmt->bind_param("si", $hashed, $_SESSION['member_id']);
    if (!$stmt->execute()) {
        $result = array(
            "status" => "Error"
        );

    }
    $stmt->close();

    $result = array(
        "status" => "ok"
    );

    $res = json_encode($result, JSON_UNESCAPED_UNICODE);
    echo $res;
}