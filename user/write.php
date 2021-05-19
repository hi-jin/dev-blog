<?php
    session_start();
    if ( $_SESSION['is_admin'] == 1 ) {
        $conn = mysqli_connect("localhost", "root", "1284", "blog", 3306);
    } else {
        $msg = "로그인 후 작성할 수 있습니다.";
        echo("<script>alert('{$msg}');</script>");
    }
?>
<script>history.back();</script>