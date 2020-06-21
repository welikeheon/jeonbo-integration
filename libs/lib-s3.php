<?php
require __DIR__ . '/../config/config.php';
require __DIR__ . '/lib-core.php';


use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

$client = new S3Client([
    'credentials' => [
        'key'    => $AWS_ACCESS_KEY_ID,
        'secret' => $AWS_SECRET,
    ],
    'region' => $AWS_DEFAULT_REGION,
    'version' => 'latest',
]);

$adapter = new AwsS3Adapter($client, $AWS_BUCKET, 'books/');

$filesystem = new Filesystem($adapter);


// try {
//     $filesystem->writeStream($path, $stream, $config);
// } catch (FilesystemError | UnableToWriteFile $exception) {
//     // handle the error
// }


// try {
//     $filesystem->write('path.txt', 'contents');
//     // it is ok!
// } catch (FilesystemError $exception) {
//     // it failed!
// }



// $stream = fopen($_FILES['upload']['tmp_name'], 'r+');
// $filesystem->writeStream(
//     'uploads/'.$_FILES['upload']['name'],
//     $stream
// );
// if (is_resource($stream)) {
//     fclose($stream);
// }