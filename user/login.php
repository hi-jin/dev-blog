<?php
session_start();
if ( isset($_SESSION['user_name']) ) {
    echo("<script>history.back();</script>");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>blog</title>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel='stylesheet' href='/css/style.css'>
        <script type='text/javascript' src="https://code.jquery.com/jquery.min.js"></script>
        <script>
        </script>
    </head>
    <body>
        <div class='main-view'>
            <form method='post' action='/user/login_ok.php'>
                <a href='/user/guest.php'>GUEST 계정으로 접속하기</a><br>
                <input type="text" placeholder="아이디를 입력하세요." name="userid"><br>
                <input type="password" placeholder="비밀번호를 입력하세요." name="userpw"><br>
                <div style='display: flex; justify-content: space-between;'>
                    <button style='flex: 1;' type="submit" class="btn btn-outline-primary">로그인</button>
                    <button style='flex: 1;' type="button" class="btn btn-outline-primary" onclick="location.href='/user/register.html'">회원가입</button>
                </div>
            </form>
        </div>
    </body>
</html>