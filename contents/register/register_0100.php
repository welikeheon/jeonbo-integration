<?php

$title = '홈화면';

require('../include/header.php');

?>

<div class="jumbotron">
    <div class="container">
        <h1 class="display-4">안전한 전자책 보관을 책임지는, 전보</h1>
        <p class="lead">스캔한 전자책, 전보가 안전하게 보관해드립니다.</p>
    </div>
</div>

<div class="card img-fluid text-white" style="width:100%; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.6)),url('/images/main/library-1.JPG') center center; height: 50vh; background-size: cover; margin-top:-30px">
    <div class="card-img-overlay">

        <div class="container">
            <h1 class="card-title">회원가입</h1>
            <h3 class="card-text">처음 뵙겠습니다, <br><b>가입은 매우 간단하게 끝납니다.</b></h3>
        </div>
        <div class="my-4"></div>
        <div class="row">
            <div class="container">
                <form action="../../handle/handle-register.php" method="post">
                    <div class="form-group">
                        <label for="email">이메일 주소</label>
                        <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="이메일 주소">
                        <small id="emailHelp" class="form-text text-white">이메일은 회원 확인 목적으로 사용되며 성가신 스팸을 발송하지 않습니다.</small>
                    </div>
                    <div class="form-group">
                        <label for="username">이름</label>
                        <input name="username" type="username" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="실명을 입력해주세요">
                    </div>
                    <div class="form-group">
                        <label for="password">비밀번호</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="비밀번호">
                        <small id="passwordHelp" class="form-text text-white"></small>
                    </div>
                    
                    <button type="submit" class="btn btn-success">회원가입</button>
                    <a href="../hello/hello_0100.php" class="btn btn-primary" role="button">돌아가기</a>
                    <p id="newuser" class="form-text text-white">회원가입을 하게 되면 전보의 서비스 약관과 개인정보보호정책에 동의하는 것으로 간주합니다.</p>
                </form>
            </div>
        </div>
    </div>
</div>

<hr class="my-4">

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>안전한 전자책 보관</h2>
            <p>"전에 스캔했던 책인데..." 연구실에 있었나, 집에 있었나.. 혹시 전자책을 잃어버린 경험이 있지 않나요? 실컷 고생해서 스캔한 책을 파일 보관을 잘못해서 잃어버리셨다구요? 전자책을 보관해주는 서비스가 여기에 있습니다.</p>
            <!-- <p><a class="btn btn-secondary" href="#" role="button">더 알아보기 »</a></p> -->
        </div>
        <div class="col-md-6">
            <h2>안전한 서비스! 좋아! 좋아! 좋아! </h2>
            <p>업계 표준의 암호화 처리를 비롯한 다양한 기술을 통해 여러분의 전자책을 안전하게 보관해드립니다. 특히 회원님의 책은 여러 시스템에 걸쳐 모든 복사본을 자동으로 생성하고 저장하기 때문에 99.999999999%의 데이터 내구성을 제공하도록 설계되었습니다</p>
            <!-- <p><a class="btn btn-secondary" href="#" role="button">더 알아보기 »</a></p> -->
        </div>
    </div>
</div>




<?php
require('../include/footer.php');
