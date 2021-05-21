<?php
    session_start();
    if ( $_SESSION['is_admin'] == 1 ) {
        $conn = mysqli_connect("localhost", "root", "1284", "blog", 3306);
        $sql = "INSERT INTO board(title, content, user_name, date, tag)";
        $msg = $_POST['posting_text'];
        echo("<script>alert('{$msg}');</script>");
    } else {
        $msg = "로그인 후 작성할 수 있습니다.";
        echo("<script>alert('{$msg}'); location.href='/user/login.php'; </script>");
    }
?>
<script>location.href="/contents/index.php"</script>