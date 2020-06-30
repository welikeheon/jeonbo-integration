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

<div class="card img-fluid text-white" style="width:100%; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.6)),url('/images/main/library-1.JPG') center center; height: 450px; background-size: cover; margin-top:-30px">
    <div class="card-img-overlay">

        <div class="container">
            <h1 class="card-title">로그인</h1>
            <h3 class="card-text">전자책을 안전하게 보관할 준비가 되었나요? <br><b>이제 로그인하겠습니다.</b></h3>
        </div>
        <div class="my-4"></div>
        <div class="row">
            <div class="container">
                <form action="/login.php" method="post">
                    <div class="form-group">
                        <label for="email">이메일 주소</label>
                        <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="이메일 주소">
                        <small id="emailHelp" class="form-text text-white">안전한 <b>전</b>자책 <b>보</b>관 서비스인 전보는, 업계 표준 암호화를 사용하여 제출된 고객 비밀 정보를 보호합니다.</small>
                    </div>
                    <div class="form-group">
                        <label for="password">비밀번호</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="비밀번호">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">로그인</button>
                    <p id="newuser" class="form-text text-white">새로 오셨나요? <a href="../register/register_0100.php">이곳을 클릭하고 계정을 만들어서 전자책 보관을 시작하세요.</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<hr class="my-4">

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>전자책을 가장 잘 보관하는 방법</h2>
            <p>"전에 스캔했던 책인데..." 연구실에 있었나, 집에 있었나.. 혹시 전자책을 잃어버린 경험이 있지 않나요? 실컷 고생해서 스캔한 책을 파일 보관을 잘못해서 잃어버리셨다구요? 저런.. 전자책을 보관해주는 서비스가 여기에 있습니다.</p>
            <!-- <p><a class="btn btn-secondary" href="#" role="button">더 알아보기 »</a></p> -->
        </div>
        <div class="col-md-6">
            <h2>안전한 서비스! 좋아! 좋아! 좋아! 👏 👏 👏 </h2>
            <p>업계 표준의 암호화 처리를 비롯한 다양한 기술을 통해 여러분의 전자책을 안전하게 보관해드립니다. 특히 회원님의 책은 여러 시스템에 걸쳐 모든 복사본을 자동으로 생성하고 저장하기 때문에 99.999999999%의 데이터 내구성을 제공하도록 설계되었습니다. 기술적인 부분은 자세히 몰라도 됩니다, 나머지는 저희가 알아서 책임지겠습니다..</p>
            <!-- <p><a class="btn btn-secondary" href="#" role="button">더 알아보기 »</a></p> -->
        </div>
    </div>
</div>




<?php
require('../include/footer.php');
