<?php
    $conn = mysqli_connect("localhost", "root", "1284", "blog", 3306);
	$userid = $_POST['userid'];
    $userpw = $_POST['userpw'];

    $sql = "SELECT * FROM user WHERE user_id='{$userid}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    
    if ($row['user_pw'] === $userpw) {
        session_start();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['is_admin'] = $row['is_admin'];
        echo ("<script>alert('로그인 성공'); location.href='/contents/index.php'</script>");
    } else {
        echo ("<script>alert('로그인 실패')</script>");
    }
?>
<script>location.href="/index.php";</script>