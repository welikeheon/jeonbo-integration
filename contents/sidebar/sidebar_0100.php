<div class="col-4">
    <!-- 사이드바 시작 -->
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link <?php if($active == 1) echo 'active' ?>" href="../main/main_0100.php">내 책 보기</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($active == 2) echo 'active' ?>" href="../upload/upload_0100.php">새 책 등록하기</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($active == 3) echo 'active' ?>" href="../account/account_0100.php">계정정보 수정 / 보안</a>
        </li>
        
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">관리자 모드</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
            </div>
        </li>
    </ul>
    <!-- 사이드바 끝 -->
</div>