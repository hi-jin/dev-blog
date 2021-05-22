<?php
session_start();
if ( $_SESSION['is_admin'] == 1 ) {
    $no = $_POST['no'];
    $conn = mysqli_connect("localhost", "root", "1284", "blog", 3306);
    $sql = "DELETE FROM board WHERE no={$no}";
    $result = mysqli_query($conn, $sql);
    
    echo $no;
} else {
    echo "<script>alert('관리자만 삭제할 수 있습니다... 잡았다 요놈'); history.back();</script>";
}
?>