<?php
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../vendor/autoload.php';


use Monolog\Logger;
use Monolog\Handler\StreamHandler;



$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../config/');
$dotenv->load();


require_once('lib-auth.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

global $mysqli;

$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "어어, 문제가 발생했습니다. 잠시 후 다시 접속해주세요.";
    die();
}



// create a log channel

global $log;
$log = new Logger('DEBUG ====> ');
$log->pushHandler(new StreamHandler(__DIR__ .'/../monolog.log' , Logger::WARNING));

function sql_checknum($table, $row, $where, $value) {
    global $mysqli;
    $table = $mysqli->real_escape_string($table);
    $row = $mysqli->real_escape_string($row);
    $where = $mysqli->real_escape_string($where);
    $value = $mysqli->real_escape_string($value);

    $stmt = $mysqli->prepare("select {$row} from {$table} where {$where} = ?");
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $result = $stmt->get_result();
    $row_element = $result->num_rows;
    if (!$row_element) {    // 없으면 false
        return false;
    }
    return $row_element;    // 있으면 true
}

function sql_fetch($table, $row, $where, $value) {
    global $mysqli;
    $table = $mysqli->real_escape_string($table);
    $row = $mysqli->real_escape_string($row);
    $where = $mysqli->real_escape_string($where);
    $value = $mysqli->real_escape_string($value);

    $stmt = $mysqli->prepare("select {$row} from {$table} where {$where} = ?");
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $result = $stmt->get_result();
    $res = mysqli_fetch_assoc($result);
    return $res[$row];
}