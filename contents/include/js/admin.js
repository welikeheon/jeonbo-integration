
let formData = new FormData();
let member_id = $("input[name=member_id]").val();
$(async function () {
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
        formData.append('changepw', 2)
        formData.append('member_id', member_id);
        formData.append('new_password', new_password.val());
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
    })
});