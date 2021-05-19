<?php
    session_start();
    if(isset($_SESSION['user_id'])) {
        echo ("<script>location.href='/contents/index.php'</script>");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>blog</title>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel='stylesheet' href='style.css'>
        <script type='text/javascript' src="https://code.jquery.com/jquery.min.js"></script>
        <script>
            $('document').ready(function() {
                $('.main-view').hide();
                $('.first-view').click(function() {
                    $('.first-view').fadeOut(500, function() {
                        $('.main-view').fadeIn(500);
                    }); 
                });
            });
        </script>
    </head>
    <body>
        <div class='first-view'>
            Hi-jin Dev Blog
        </div>
        <div class='main-view'>
            <form method='post' action='/user/login.php'>
                <input type="text" placeholder="아이디를 입력하세요." name="userid"><br>
                <input type="password" placeholder="비밀번호를 입력하세요." name="userpw"><br>
                <button type="submit" class="btn btn-outline-primary">로그인</button>
                <button type="button" class="btn btn-outline-primary" onclick="location.href='user/register.html'">회원가입</button>
            </form>
        </div>
    </body>
</html>