<?php

$title = '회원상세정보 | 큰 힘에는 큰 책임이 따릅니다';
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

$userinfo = $_GET['id'];


$stmt = $mysqli->prepare("SELECT * FROM memberlist WHERE member_id = ?");
$stmt->bind_param('i', $userinfo);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_all(MYSQLI_ASSOC);


$stmt = $mysqli->prepare("SELECT `books`.id, `books`.title, `memberlist`.username FROM memberlist, books where `books`.author = `memberlist`.member_id and member_id = ?");
$stmt->bind_param('i', $userinfo);
$stmt->execute();
$result = $stmt->get_result();
$books = $result->fetch_all(MYSQLI_ASSOC);

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

            <h2 class="mb-4">회원 상세 정보</h2>

            <form>
                <input type="hidden" name="member_id" value="<?php echo $row[0]['member_id'];?>">
                <div class="form-group row">
                    <label for="staticName" class="col-sm-2 col-form-label">이름</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticName" value="<?php echo $row[0]['username'];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">이메일</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $row[0]['email'];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_reset" class="col-sm-2 col-form-label">비밀번호 초기화</label>
                    <div class="col-sm-10">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changepassword" >비밀번호 초기화</button>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticIPAddress" class="col-sm-2 col-form-label">IP Address</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticIPAddress" value="<?php echo $row[0]['created_ip'];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticCreatedAt" class="col-sm-2 col-form-label">생성일</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticCreatedAt" value="<?php echo $row[0]['created_at'];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticCreatedAt" class="col-sm-2 col-form-label">탈퇴일</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticCreatedAt" value="<?php echo ($row[0]['withdraw_at'] == null) ? "탈퇴하지 않은 사용자" : "탈퇴한 사용자";?>">
                    </div>
                </div>
            </form>

            <h2 class="mb-4">회원 도서 정보</h2>
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
                <?php foreach ($books as $key => $value) { ?>
                    <tr>
                        <th scope="books"><?php echo $books[$key]['id']; ?></th>
                        <td class="text"><?php echo $books[$key]['title']; ?></td>
                        <td><?php echo $books[$key]['username']; ?></td>
                        <td><a href="admin_0210.php?id=<?php echo $books[$key]['id'] ?>"><button type="button" class="btn btn-outline-info">수정</button></a></td>
                    </tr>
                <?php } ?>


                </tbody>
            </table>
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
