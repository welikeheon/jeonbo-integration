<?php

$title = '회원관리 | 큰 힘에는 큰 책임이 따릅니다';
$active = 4;

require_once("../../libs/lib-core.php");
$auth = new Authentication();
if (!is_array($auth->islogged())) {
    echo "로그인 후 다시 접속해주세요.";
    die();
}

if ($auth->isAdmin($_SESSION['member_id']) == false) {
    die();
}

require('../include/header.php');

$stmt = $mysqli->prepare("SELECT `username`, `email`, `member_id` FROM memberlist WHERE `enabled` = 1;");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_all(MYSQLI_ASSOC);

?>

<div class="jumbotron bg-warning text-white">
    <div class="container">
        <h1 class="display-4">회원관리</h1>
        <p class="lead">큰 힘에는 큰 책임이 따릅니다.</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php include "../sidebar/sidebar_0100.php"; ?>
        <div class="col-8">

            <h2 class="mb-4">회원 관리</h2>


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">사용자명</th>
                        <th scope="col">이메일</th>
                        <th scope="col">상세보기</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($row as $key => $value) { ?>
                    <tr>
                        <th scope="row"><?php echo $row[$key]['member_id']; ?></th>
                            <td><?php echo $row[$key]['username']; ?></td>
                            <td><?php echo $row[$key]['email']; ?></td>
                        <td><a href="admin_0110.php?id=<?php echo $row[$key]['member_id'] ?>"><button type="button" class="btn btn-outline-info">수정</button></a></td>
                    </tr>
                    <?php } ?>

                    
                </tbody>
            </table>
            <!-- 본문 끝 -->
        </div>
    </div>



    <script src="../include/js/admin.js"></script>


    <?php

    require('../include/footer.php');
