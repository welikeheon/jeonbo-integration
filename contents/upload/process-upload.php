<?php
require_once "../../libs/lib-core.php";
$title = '업로드';
$auth = new Authentication();
if(!is_array($auth->islogged())) {
    echo "로그인 후 다시 접속해주세요.";
    die();
}

$progress = true;

$res = array(
    "book_title" => $_POST["book_title"],
    "book_author" => $_POST["book_author"],
    "book_publisher" => $_POST["book_publisher"],
    "book_price" => $_POST["book_price"],
    "book_pubdate" => $_POST["book_pubdate"],
    "book_description" => $_POST["book_description"],
    "file_name" => $_POST["file_name"],
    "file_path" => $_POST["file_path"],
    "file_extension" => $_POST["file_extension"],
    "file_size" => $_POST["file_size"],
    "file_format" => $_POST["file_format"],
);

// Insert some values
$sql1 = "insert into book_detail (book_fulltext_title, book_author, book_description, book_publisher, book_pubdate, book_price) values (?,?,?,?,?,?)";
$stmt1 = $mysqli->prepare($sql1);
$stmt1->bind_param('sssssi', $res['book_title'], $res['book_author'], $res['book_description'], $res['book_publisher'], $res['book_pubdate'], $res['book_price']);
if (!$stmt1->execute()) {
    // echo "executed stmt1 failed";
    // echo $stmt1->error();
    $progress == false;
    // exit();
}

$book_detail_id = $stmt1->insert_id;
$member_id = $_SESSION['member_id'];
$sql2 = "INSERT INTO books (author, title, created_ip, detail) values (?,?,?,?)";
$stmt2 = $mysqli->prepare($sql2);
$stmt2->bind_param('issi', $_SESSION['member_id'], $res['book_title'], $_SERVER['REMOTE_ADDR'], $book_detail_id);

if (!$stmt2->execute()) {
    // echo $mysqli -> error;
    // echo "executed stmt2 failed";
    $progress == false;
    // exit();
}

$book_id = $stmt2->insert_id;

$sql3 = "insert into attachment (book_id, filename, filepath, filesize, file_extension) values (?,?,?,?,?)";
$stmt3 = $mysqli->prepare($sql3);
$stmt3->bind_param('issis', $book_id, $res['file_name'], $res['file_path'], $res['file_size'], $res['file_extension']);
if (!$stmt3->execute()) {
    // echo "executed stmt3 failed";
    // echo $stmt3->error();
    $progress == false;
    // exit();
}


if ($progress == true) {
    $status = array(
        "status" => "ok",
    );
    $res = json_encode($status, JSON_UNESCAPED_UNICODE);
    echo "<meta charset='utf-8'><script>alert('성공적으로 업로드되었습니다.');location.href='/contents/main/main_0100.php';</script>";
}

if ($progress == false) {
    $status = array(
        "status" => "error",
    );
    $res = json_encode($status, JSON_UNESCAPED_UNICODE);
    echo "<meta charset='utf-8'><script>alert('업로드에 실패했습니다. 다시 시도해주세요.'); location.href='/contents/upload/upload_0100.php';</script>";
}