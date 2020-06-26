<?php

require('../libs/lib-core.php');

$member_id = $_SESSION['member_id'];

$stmt = $mysqli->prepare("UPDATE memberlist SET enabled = 0, withdraw_at = NOW() WHERE member_id = ?");
$stmt->bind_param("i", $member_id);
$stmt->execute();
$stmt->close();


$result = array(
    "status" => "ok"
);

$res = json_encode($result, JSON_UNESCAPED_UNICODE);
echo $res;