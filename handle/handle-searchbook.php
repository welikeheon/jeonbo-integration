<?php

use function GuzzleHttp\json_decode;

require "../libs/lib-core.php";

$query = $_GET['query'];

$client = new GuzzleHttp\Client();


$res = $client->request('GET', 'https://openapi.naver.com/v1/search/book.json', [
    'headers' => [
        'X-Naver-Client-Id' => $NAVER_CLIENT_ID,
        'X-Naver-Client-Secret' => $NAVER_CLIENT_SECRET
    ],
    'query' => ['query' => $query]
]);

$result = $res->getBody();

$result = strip_tags($result); // 자바스크립트에 영향을 줄 수 있는 불필요한 html 태그 제거

$bookinfo = array();

$response = json_decode($result, true);
// var_dump($response);

foreach ($response['items'] as $key => $value) {
    $order = $key + 1;
    $title = $response['items'][$key]['title'];
    $publisher = $response['items'][$key]['publisher'];
    $image = $response['items'][$key]['image'];
    $author = $response['items'][$key]['author'];
    $price = $response['items'][$key]['price'];
    $pubdate = $response['items'][$key]['pubdate'];
    $isbn = $response['items'][$key]['isbn'];
    $description = $response['items'][$key]['description'];
    array_push($bookinfo, [
        "order" => $order,
        "title" => $title,
        "publisher" => $publisher,
        "image" => $image,
        "author" => $author,
        "price" => $price,
        "pubdate" => $pubdate,
        "isbn" => $isbn,
        "description" => $description,
        "title_on_search" => $title . ' / ' . $publisher . ' / ' . $author
    ]);
}

$result = json_encode($bookinfo, JSON_UNESCAPED_UNICODE);
echo $result;