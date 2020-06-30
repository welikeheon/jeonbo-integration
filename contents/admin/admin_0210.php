<?php

$title = '도서상세정보 | 큰 힘에는 큰 책임이 따릅니다';
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

$book_id = $_GET['id'];


$stmt = $mysqli->prepare("SELECT `book_detail`.*, `attachment`.*, `books`.is_visible  FROM books, book_detail, attachment WHERE `books`.detail = `book_detail`.id AND books.id = attachment.book_id AND books.id = ?");
$stmt->bind_param('i', $book_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_all(MYSQLI_ASSOC);

?>

<div class="jumbotron bg-warning text-white">
    <div class="container">
        <h1 class="display-4">도서상세정보</h1>
        <p class="lead">큰 힘에는 큰 책임이 따릅니다.</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php include "../sidebar/sidebar_0100.php"; ?>
        <div class="col-8">

            <h2 class="mb-4">도서 상세 정보</h2>

            <form>
                <input type="hidden" name="member_id" value="<?php echo $row[0]['member_id']; ?>">
                <div class="form-group row">
                    <label for="staticName" class="col-sm-2 col-form-label">도서명</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticName" value="<?php echo $row[0]['book_fulltext_title']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticAuthor" class="col-sm-2 col-form-label">지은이</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticAuthor" value="<?php echo $row[0]['book_author']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticPublisher" class="col-sm-2 col-form-label">출판사</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticPublisher" value="<?php echo $row[0]['book_publisher']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticPubdate" class="col-sm-2 col-form-label">출판일</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticPubdate" value="<?php echo $row[0]['book_pubdate']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticPrice" class="col-sm-2 col-form-label">책값</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticPrice" value="<?php echo $row[0]['book_price']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticCreatedAt" class="col-sm-2 col-form-label">생성일</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticCreatedAt" value="<?php echo $row[0]['created_at']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticDisable" class="col-sm-2 col-form-label">사용가능 여부</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticDisable" value="<?php echo ($row[0]['is_visible'] ? "사용 가능" : "사용 불가") ?>">
                    </div>
                </div>
            </form>
            <!-- 본문 끝 -->
        </div>
    </div>

    <!-- 비밀번호 변경 -->
    <div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="changepasswordLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changepasswordLabel">비밀번호 변경</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="new-password" class="col-form-label">바꿀 비밀번호:</label>
                            <input type="password" class="form-control" id="new-password">
                            <small id="new-password-helper"></small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                    <button type="button" class="btn btn-primary" id="change_password">비밀번호 변경</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 비밀번호 변경 끝 -->

    <script src="../include/js/admin.js"></script>


    <?php

    require('../include/footer.php');
