Dropzone.options.myAwesomeDropzone = {
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 2048, // MB
    accept: function(file, done) {
        if (file.name == "justinbieber.jpg") {
            done("Naha, you don't.");
        } else {
            done();
        }
    },
    url: "../../handle/handle-upload.php",
    error: function (file, response) {
        console.log("Erro");
        console.log(response);
    },
    success: function (file, response) {
        let res = JSON.parse(response);
        let file_extension = $("input[name='file_extension']").val(res.file_extension);
        let file_format = $("input[name='file_format']").val(res.fileformat);
        let file_path = $("input[name='file_path']").val(res.filepath);
        let file_size = $("input[name='file_size']").val(res.filesize);
        let file_name = $("input[name='file_name']").val(res.realname);
    },
    complete: function (file) {
        console.log("Complete");
    }
};
$(function() {
    let booktitle = $("input[name='book_title'");

    $('#book_title').select2({
        ajax: {
            url: "../../handle/handle-searchbook.php",
            dataType: 'json',
            delay: 400,
            cache: true,
            // 검색 쿼리를 만든다.
            data: function(params) {
                var query = {
                    query: params.term,
                }
                return query;
            },
            // 결과를 표현한다.
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.title,
                            id: item.order,
                            author: item.author,
                            description: item.description,
                            image: item.image,
                            isbn: item.isbn,
                            order: item.order,
                            price: item.price,
                            pubdate: item.pubdate,
                            publisher: item.publisher,
                            title: item.title
                        }
                    })
                };
            }
        },
        placeholder: '책을 검색해주세요.',
        minimumInputLength: 1
    });

    $('#book_title').on("select2:select", function(e) {
        let publisher = $("#book_publisher").val(e.params.data.publisher);
        let author = $("#book_author").val(e.params.data.author);
        let price = $("#book_price").val(e.params.data.price);
        let pubdate = $("#book_pubdate").val(e.params.data.pubdate);
        let description = $("#book_description").val(e.params.data.description);
        let book_title = booktitle.val(e.params.data.title)
        Swal.fire({
            position: 'bottom-start',
            icon: 'success',
            title: '책 정보를 받아왔습니다. \n 나머지는 저희가 처리하겠습니다.',
            showConfirmButton: false,
            timer: 1200
        })
    });

   
    // $("#file").dropzone({
    //     url: "../../handle/handle-upload.php",
    //     maxFilesize: 3,
    //     error: function (file, response) {
    //         console.log("Erro");
    //         console.log(response);
    //     },
    //     success: function (file, response) {
    //         console.log("Sucesso");
    //         console.log(response);
    //     },
    //     complete: function (file) {
    //         console.log("Complete");
    //     }
    // });
});

Dropzone.prototype.defaultOptions.dictDefaultMessage = "이곳에 파일을 떨어트려 업로드하세요.";
Dropzone.prototype.defaultOptions.dictFallbackMessage = "브라우저가 너무 오래되어 Drag & Drop 형태의 업로드를 지원하지 않습니다.";
Dropzone.prototype.defaultOptions.dictFileTooBig = "파일이 너무 큽니다. ({{filesize}}MiB). 파일의 최대 크기는 {{maxFilesize}}MiB 아래여야 합니다.";
Dropzone.prototype.defaultOptions.dictInvalidFileType = "이런 종류의 파일은 업로드할 수 없습니다.";
Dropzone.prototype.defaultOptions.dictResponseError = "서버로부터 {{statusCode}} 응답을 수신했습니다.";
Dropzone.prototype.defaultOptions.dictCancelUpload = "업로드 취소 ";
Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "업로드가 진행중입니다. 정말 취소하시겠습니까?";
Dropzone.prototype.defaultOptions.dictRemoveFile = "파일 삭제";
Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "더 이상의 파일을 업로드할 수 없습니다.";