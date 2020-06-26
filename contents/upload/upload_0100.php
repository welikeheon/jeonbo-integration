<?php

$title = '새 책 업로드하기';
$active = 2;

require_once("../../libs/lib-core.php");
$auth = new Authentication();
if (!is_array($auth->islogged())) {
    echo "로그인 후 다시 접속해주세요.";
    die();
}

require('../include/header.php');


?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.min.js" integrity="sha256-fegGeSK7Ez4lvniVEiz1nKMx9pYtlLwPNRPf6uc8d+8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.min.css" integrity="sha256-iDg4SF4hvBdxAAFXfdNrl3nbKuyVBU3tug+sFi1nth8=" crossorigin="anonymous" />


<div class="jumbotron">
    <div class="container">
        <h1 class="display-4">새 책 업로드하기</h1>
        <p class="lead">새 책을 업로드하고, 전자책을 안전하게 보관하세요!</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php include "../sidebar/sidebar_0100.php"; ?>
        <div class="col 8">
            <!-- 본문 시작 -->
            <form action="./process-upload.php" id="uploadbook" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="book_title">책 제목</label>
                    <select class="form-control border-primary" autocomplete="off" id="book_title" aria-describedby="title_helper"></select>
                    <small id="title_helper" class="form-text text-muted">책 이름을 입력해주세요.</small>
                </div>
                <div class="form-group">
                    <label for="book_publisher">출판사</label>
                    <input type="text" class="form-control" id="book_publisher" name="book_publisher">
                </div>
                <div class="form-group">
                    <label for="book_author">지은이</label>
                    <input type="text" class="form-control" id="book_author" name="book_author">
                </div>
                <div class="form-group">
                    <label for="book_price">책값</label>
                    <input type="text" class="form-control" id="book_price" name="book_price">
                </div>
                <div class="form-group">
                    <label for="book_pubdate">출판일</label>
                    <input type="text" class="form-control" id="book_pubdate" name="book_pubdate">
                </div>
                <div class="form-group">
                    <label for="book_description">책 설명</label>
                    <input type="textarea" class="form-control" id="book_description" name="book_description">
                </div>

                <input type="hidden" name="book_title"/>
                <input type="hidden" name="file_name" />
                <input type="hidden" name="file_path" />
                <input type="hidden" name="file_extension" />
                <input type="hidden" name="file_size" />
                <input type="hidden" name="file_format" />


            </form>

            <form action="../../handle/handle-upload.php" enctype="multipart/form-data" method="post" class="dropzone" id="my-awesome-dropzone">
                <div class="form-group">
                    <label for="book_description">책 올리기</label>
                    <div class="mydropzone" id="#file"></div>
                </div>
            </form>


            <div class="my-4">
            <button type="button" id="submit" class="btn btn-primary">확인</button>
            <small class=""></small>
            <!-- 본문 끝 -->
        </div>
    </div>
</div>

<script src="../include/js/upload.js"></script>


<?php
require('../include/footer.php');
