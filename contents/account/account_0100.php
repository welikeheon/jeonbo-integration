<?php

$title = '계정보안';
$active = 3;

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
        <h1 class="display-4">계정 보안</h1>
        <p class="lead">계정보안, 안전하게 책임집니다.</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php include "../sidebar/sidebar_0100.php"; ?>
        <div class="col 8">
            <!-- 본문 시작 -->
            <div class="card">
                <h5 class="card-header">회원정보</h5>
                <div class="card-body">
                    <h5 class="card-title">비밀번호 수정</h5>
                    <p class="card-text">이 곳에서 비밀번호를 안전하게 변경하세요!</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changepassword">
                    비밀번호 변경하기
                    </button>
                </div>
            </div>

            <div class="my-4"></div>

            <div class="card border-danger mb-3">
                <h5 class="card-header">회원정보</h5>
                <div class="card-body">
                    <h5 class="card-title">탈퇴하기</h5>
                    <p class="card-text">회원 탈퇴는 이 곳에서 하면 됩니다.</p>
                    <button type="button" class="btn btn-warning" id="remove">
                        회원 탈퇴하기
                    </button>
                </div>
            </div>
            <!-- 본문 끝 -->
        </div>
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
            <label for="old-password" class="col-form-label">이전 비밀번호:</label>
            <input type="password" class="form-control" id="old-password">
            <small id="old-password-helper"></small>
          </div>
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


<script src="../include/js/account.js"></script>


<?php
require('../include/footer.php');
