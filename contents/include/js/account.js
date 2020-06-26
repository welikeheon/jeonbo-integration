


let old_password = document.getElementById('old-password');

let formData = new FormData();

old_password.onkeyup = _.debounce(async function (res) {
    formData.append('password', this.value);
    let password_check = await fetch("/handle/handle-password.php", {
        method: 'POST',
        body: formData
    }).then(res => res.json());
    if (password_check.password_match == true) {
        $('#old-password-helper').html('✔️ 이전 비밀번호와 일치합니다.');
        $('#old-password-helper').css("color", "green");
    } else {
        $('#old-password-helper').html('✗ 이전 비밀번호와 일치하지 않습니다.');
        $('#old-password-helper').css("color", "red");
    }
}, 1000);

$(async function () {
    $('#change_password').prop("disabled", true);
    let new_password = $('#new-password');

    new_password.keyup(function () {
        if (new_password.val().length > 6) {
            $('#new-password-helper').html('✔️ 사용할 수 있습니다.');
            $('#new-password-helper').css("color", "green");
            $('#change_password').prop("disabled", false);
            formData.append('new_password', this.value);
        } else {
            $('#new-password-helper').html('✗ 비밀번호는 7자리 이상 사용해주세요.');
            $('#new-password-helper').css("color", "red");
            $('#change_password').prop("disabled", false);
        }
    });

    $('#change_password').click(async function () {
        formData.append('changepw', 1)
        let password_check = await fetch("/handle/handle-password.php", {
            method: 'POST',
            body: formData
        }).then(res => res.json());
        console.log(password_check)
        if (password_check.status == 'ok') {
            Swal.fire(
                '좋습니다!',
                '비밀번호를 성공적으로 변경했습니다.',
                'success'
            );
            $("#changepassword").modal('hide');
        } else {
            Swal.fire(
                '비밀번호 변경 실패',
                '새로고침하고 다시 시작해주세요.',
                'error'
            )
            $("#changepassword").modal('hide');
        }
    });


    $('#remove').click(async function () {
        Swal.fire({
            title: '아쉬운 작별 인사 드립니다.',
            text: "탈퇴하면 복구할 수 없습니다, 정말 하시겠어요?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "아니요, 다시 생각해볼게요.",
            confirmButtonText: '네, 삭제해주세요!!'
        }).then(async (result) => {
            console.log(result)
            if (result.value == true) {
                let remove = await fetch("/handle/handle-remove.php").then(res => res.json());
                if (remove.status == 'ok') {
                    Swal.fire(
                        '그동안 이용해주셔서 감사합니다',
                        '삭제 완료되었습니다. 로그아웃 합니다.',
                        'success'
                    );
                    location.href="/logout.php";
                } else {
                    Swal.fire(
                        '삭제 실패',
                        '새로고침하고 다시 시작해주세요.',
                        'error'
                    )
                }
            };
        });
    })
});