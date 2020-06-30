<?php

require('../libs/lib-core.php');

$member_id = $_SESSION['member_id'];
$book_id = $_POST['book_id'];


$stmt = $mysqli->prepare("UPDATE books SET is_visible = 0 WHERE author = ? and id = ?");
$stmt->bind_param("ii", $member_id, $book_id);
$stmt->execute();
$stmt->close();


$result = array(
    "status" => "ok"
);

$res = json_encode($result, JSON_UNESCAPED_UNICODE);
echo $res;