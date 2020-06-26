<?php

$title = '전자책 보관함';
$active = 1;

require_once("../../libs/lib-core.php");
$auth = new Authentication();
if(!is_array($auth->islogged())) {
    echo "로그인 후 다시 접속해주세요.";
    die();
}
require('../include/header.php');

$stmt = $mysqli->prepare("SELECT `books`.id,  `books`.created_at, title, book_author, book_description, book_publisher, book_pubdate, book_price, filepath, filesize, file_extension FROM books, book_detail, attachment WHERE books.detail = book_detail.id AND books.id = attachment.book_id AND books.author = ? ORDER BY created_at desc");
$stmt->bind_param("s", $_SESSION['member_id']);
$stmt->execute();
$row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

?>

<div class="jumbotron">
    <div class="container">
        <h1 class="display-4">전자책 보관함</h1>
        <p class="lead">전자책을 안전하게 보관하세요!</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php include "../sidebar/sidebar_0100.php"; ?>
        <div class="col-8">
            <!-- 본문 시작 -->
            <?php if (!$row) { ?>
                <img src="../../images/main/bookshelf_empty.png" class="img-fluid" alt="책이 없습니다. 사이드바의 새 책 등록하기로 등록을 진행해주세요.">
                <?php } ?>
                <div class="accordion" id="listbook">
                <?php
                foreach ($row as $key => $value) {
                ?>
                <div class="card">
                    <div class="card-header" id="heading_<?=$row[$key]['id'] ?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse_<?=$row[$key]['id'] ?>" aria-expanded="true" aria-controls="collapse_<?=$row[$key]['id'] ?>">
                                <?= $row[$key]['title'] ?>
                            </button>
                        </h2>
                    </div>

                    <div id="collapse_<?=$row[$key]['id'] ?>" class="collapse" aria-labelledby="heading_<?=$row[$key]['id'] ?>" data-parent="#listbook">
                        <div class="card-body">
                            <h3><?=$row[$key]['title']?></h3>
                            <hr class="my-2"/>
                            <h3>책 소개</h3>
                            <p><?=$row[$key]['book_description']?></p>
                            <h3>출판사</h3>
                            <p><?=$row[$key]['book_publisher']?></p>
                            <h3>출판일</h3>
                            <p><?=$row[$key]['book_pubdate']?></p>
                            <h3>가격</h3>
                            <p><?=$row[$key]['book_price']?></p>
                            <h3>책 등록일</h3>
                            <p><?=$row[$key]['created_at']?></p>
                            <hr class="my-2"/>
                            <button type="button" class="btn btn-primary btn-block" onclick="download_file(<?=$row[$key]['id'] ?>)">다운로드</button>
                            <button type="button" class="btn btn-danger btn-block">삭제하기</button>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
            <!-- 본문 끝 -->
        </div>
    </div>
</div>



<script src="../include/js/main.js"></script>


<?php

require('../include/footer.php');
