async function download_file(bookid) {
    let url = await fetch("/handle/handle-download.php?books_id="+bookid);
    let body = await url.json();
    let download_link = body.url;
    console.log(download_link)
    return window.open(download_link);
}

async function remove_file(bookid) {
    let formData = new FormData();
    formData.append('book_id', bookid);

    Swal.fire({
        title: '정말 삭제하시겠습니까?',
        text: "삭제하면 복구할 수 없습니다.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "아니요, 다시 생각해볼게요.",
        confirmButtonText: '네, 삭제해주세요!!'
    }).then(async (result) => {
        if (result.value == true) {
            let remove = await fetch("/handle/handle-removefile.php",
            {
                method: 'POST',
                body: formData
            }).then(res => res.json());
            if (remove.status == 'ok') {
                Swal.fire(
                    '삭제 완료!',
                    '삭제가 잘 처리되었습니다.',
                    'success'
                );
                
            } else {
                Swal.fire(
                    '삭제 실패',
                    '다시 시도해주세요.',
                    'error'
                )
            }
        };
    });
}
$(function() {});