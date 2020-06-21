<?php
require_once('./libs/lib-core.php');
require_once('./libs/lib-auth.php');
require_once('./libs/lib-password.php');

$ip = $_SERVER['REMOTE_ADDR'];


if (!isset($_POST['email'], $_POST['password'])) {
	echo "<meta charset='utf-8'><script>alert('이메일과 비밀번호가 일치하지 않습니다! 다시 시도해주세요!');history.back(1);</script>";
}

$authform = array(
    'email' => $_POST['email'],
    'password' => $_POST['password']
);

$auth = new Authentication();

// 아이디 중 띄운 부분이 있다면 합쳐줌
$auth->sanitize($authform['email']);

// 로그인 진행
$login = $auth->processlogin($authform['email'], $authform['password']);


if ($login == true) {
    // 로그인 성공하면 토큰키를 저장함
    $token_key = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789^/';
    for ($i = 0; $i <= 63; $i++) {
        $token .= $token_key[rand(0, 63)];
    }
    // 방금 만든 토큰을 데이터베이스에 업데이트한다.
    // 입력받은 아이디가 있는 위치에 업데이트.
    // update auth set token '$token' where username=?

    $_SESSION['token'] = $token; // 세션에 토큰 값 기록

    $_SESSION['listed'] = sha1('listed');
    $_SESSION['username'] = $auth->getUsername($authform['email']);
    $_SESSION['email'] = $authform['email'];
    $_SESSION['role'] = $auth->getRole($authform['email']);

    header('Location: /index.php');
} else {
    echo "<meta charset='utf-8'><script>alert('이메일과 비밀번호가 일치하지 않습니다! 다시 시도해주세요!');history.back(1);</script>";
}