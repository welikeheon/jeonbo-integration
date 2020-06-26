<?php
require __DIR__ . '/../vendor/autoload.php';
require("../libs/lib-s3.php");


use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;  
use Aws\Exception\AwsException;


ini_set('max_execution_time', 0); 




$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../config/');
$dotenv->load();

$auth = new Authentication();

if (!is_array($auth->islogged())) {
    die();
}

$userinfo = $auth->islogged();

$books_id = $_GET['books_id'];
$member_id = $userinfo['member_id'];

$stmt = $mysqli->prepare("SELECT a.id, a.author, a.is_visible, b.filename, b.filepath FROM books a, attachment b WHERE a.id = b.`book_id` AND a.is_visible = 1 AND a.author = ? AND a.id = ?");
$stmt->bind_param("ii", $member_id, $books_id);
$stmt->execute();
$arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
if(!$arr) exit('Error');
$filepath = $arr[0]['filepath'];
$stmt->close();



# S3 클라이언트
$s3Client = new Aws\S3\S3Client([
    'version' => 'latest',
    'region' => 'ap-northeast-2',
    'credentials' => [
        'key'    => $AWS_ACCESS_KEY_ID,
        'secret' => $AWS_SECRET,
    ],
]);

//Creating a presigned URL
$cmd = $s3Client->getCommand('GetObject', [
    'Bucket' => 'jeonbo-service',
    'Key' => 'books/'. $filepath
]);

$request = $s3Client->createPresignedRequest($cmd, '+10 minutes');

// Get the actual presigned-url
$presignedUrl = (string)$request->getUri();

$result = array(
    "result"=> "ok",
    "url"=> $presignedUrl,
);

$res = json_encode($result, JSON_UNESCAPED_UNICODE);
echo $res;

// $stream = $filesystem->readStream($filepath);


// header("Pragma: public");
// header("Expires: 0");
// header("Content-Type: application/octet-stream");
// header("Content-Disposition: attachment; filename='$stream'");
// header("Content-Transfer-Encoding: binary");
// header("Content-Length: $filesize");

// ob_clean();
// flush();
// readfile($filepath);

// while (!feof($stream)) { echo fread($stream, 1024); } $contents = stream_get_contents($stream); fclose($stream);
// return $stream;
// fclose($stream);
