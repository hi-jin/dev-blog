<?php
    $conn = mysqli_connect("localhost", "root", "1284", "blog", 3306);
	$username = $_POST['username'];
    $userid = $_POST['userid'];
    $userpw = $_POST['userpw'];
    
    $sql = "SELECT no FROM user WHERE user_id='{$userid}';";
    $result = mysqli_query($conn, $sql);
    $no = mysqli_fetch_row($result)[0];
    
    if ($no > 0) {
        echo("<script>alert('{$userid}는 중복되는 아이디입니다.')</script>");
    } else {
        $sql = "INSERT INTO user(user_name, user_id, user_pw) VALUES('{$username}', '{$userid}', '{$userpw}');";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo("<script>alert('회원가입 성공');</script>");
        } else {
            echo("<script>alert('ERROR...');</script>");
        }
    }
?>
<script>location.href="/index.php";</script>