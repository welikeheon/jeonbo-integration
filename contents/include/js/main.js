async function download_file(bookid) {
    let url = await fetch("/handle/handle-download.php?books_id="+bookid);
    let body = await url.json();
    let download_link = body.url;
    console.log(download_link)
    return window.open(download_link);
}
$(function() {});