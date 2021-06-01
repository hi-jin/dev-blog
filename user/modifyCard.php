<?php
session_start();
if ( $_SESSION['is_admin'] == 1 ) {
    $no = $_POST['no'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    date_default_timezone_set("Asia/Seoul");
    $date = date("Y-m-d H:i:s");
    $tag = $_POST['tag'];
    
    $conn = mysqli_connect("localhost", "root", "1284", "blog", 3306);
    $query = "UPDATE board SET title='{$title}', content='{$content}', date='{$date}', tag='{$tag}' WHERE no={$no}";
    $result = mysqli_query($conn, $query);
    
    echo $result;
} else {
    echo "<script>alert('관리자만 수정할 수 있습니다... 잡았다 요놈'); history.back();</script>";
}
?>