<div class="col-4">
    <!-- 사이드바 시작 -->
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link <?php if ($active == 1) echo 'active' ?>" href="../main/main_0100.php">내 책 보기</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($active == 2) echo 'active' ?>" href="../upload/upload_0100.php">새 책 등록하기</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($active == 3) echo 'active' ?>" href="../account/account_0100.php">계정정보 수정 / 보안</a>
        </li>

        <?php if ($auth->isAdmin($_SESSION['member_id']) == true) { ?>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">관리자 모드</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($active == 4) echo 'active' ?>" href="../admin/admin_0100.php">회원관리</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($active == 5) echo 'active' ?>" href="../admin/admin_0200.php">도서관리</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($active == 6) echo 'active' ?>" href="../admin/admin_0100.php"></a>
        </li>

        <?php } ?>
    </ul>
    <!-- 사이드바 끝 -->
</div>