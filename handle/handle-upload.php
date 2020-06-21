<?php
require("../libs/lib-s3.php");
$auth = new Authentication();

$tmp_dir = ini_get('upload_tmp_dir') ? ini_get('upload_tmp_dir') : sys_get_temp_dir();

if(!is_array($auth->islogged())) {
    return header("HTTP/1.1 403 Not Found");
} else {
    
    $date = date('YmdHisu'); // 20200617115012826395
    $fileformat = $date.$_FILES['file']['name'];
    $stream = fopen($_FILES['file']['tmp_name'], 'r+');
    $result = array(
        "fileformat" => $fileformat,
        "tmp_name" => $_FILES['file']['tmp_name'],
        "realname" => $_FILES['file']['name'],
        "filepath" => 'uploads/' . $date . '_'. $_FILES['file']['name'],
        "filesize" => $_FILES['file']['size'],
        "file_extension" => pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)
    );
    
    $response = $filesystem->writeStream(
        'uploads/' . $date . $_FILES['file']['name'],
        $stream
    );
    if (is_resource($stream)) {
        fclose($stream);
        
    }

    if ($response == true) {
        $res = json_encode($result, JSON_UNESCAPED_UNICODE);
        echo $res;
    }
}





// if(!is_array($auth->islogged())) {
    
//     return header("HTTP/1.1 404 Not Found");
// } else {
//     $date = date('YmdHisu'); // 20200617115012826395
//     $path = "upload/" . $_SESSION['email'];

//     try {
//         $filesystem->writeStream($path, $stream, $config);
//     } catch (FilesystemError | UnableToWriteFile $exception) {
//         // handle the error
//     }
// }


