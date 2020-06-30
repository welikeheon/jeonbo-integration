<?php

$title = '도서관리 | 큰 힘에는 큰 책임이 따릅니다';
$active = 5;

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

$stmt = $mysqli->prepare("SELECT `books`.id as id, title, `memberlist`.username FROM books, book_detail, attachment, memberlist WHERE books.detail = book_detail.id AND books.id = attachment.book_id AND memberlist.member_id = books.author");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_all(MYSQLI_ASSOC);



?>
    <link rel="stylesheet" href="../include/css/admin_0200.css">
    <div class="jumbotron bg-warning text-white">
        <div class="container">
            <h1 class="display-4">도서관리</h1>
            <p class="lead">큰 힘에는 큰 책임이 따릅니다.</p>
        </div>
    </div>

    <div class="container">
    <div class="row">
        <?php include "../sidebar/sidebar_0100.php"; ?>
        <div class="col-8">

            <h2 class="mb-4">도서 관리</h2>


            <table class="table">
                <thead>
                <tr>
                    <th scope="col" class="width: 5%">#</th>
                    <th scope="col" class="width: 55%">도서명</th>
                    <th scope="col" class="width: 10%">소유자</th>
                    <th scope="col" class="width: 10%">상세보기</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($row as $key => $value) { ?>
                    <tr>
                        <th scope="row"><?php echo $row[$key]['id']; ?></th>
                        <td class="text"><?php echo $row[$key]['title']; ?></td>
                        <td><?php echo $row[$key]['username']; ?></td>
                        <td><a href="admin_0210.php?id=<?php echo $row[$key]['id'] ?>"><button type="button" class="btn btn-outline-info">수정</button></a></td>
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
