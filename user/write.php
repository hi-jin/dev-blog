<?php
    session_start();
    if ( $_SESSION['is_admin'] == 1 ) {
        $conn = mysqli_connect("localhost", "root", "1284", "blog", 3306);
        
        date_default_timezone_set("Asia/Seoul");
        $title = $_POST['posting_title'];
        $content = $_POST['posting_text'];
        $user_name = $_SESSION['user_name'];
        $date = date("Y-m-d H:i:s");
        $tag = $_POST['tag'];
        
        $sql = "INSERT INTO board(title, content, user_name, date, tag) VALUES('{$title}', '{$content}', '{$user_name}', '{$date}', '{$tag}')";
        $result = mysqli_query($conn, $sql);
        
        if ( $result ) {
            echo('<script>alert("게시글이 정상적으로 작성되었습니다.");</script>');
        } else {
            echo('<script>alert("게시글 작성 실패");</script>');
        }
    } else {
        $msg = "로그인 후 작성할 수 있습니다.";
        echo("<script>alert('{$msg}'); location.href='/user/login.php'; </script>");
    }
?>
<script>location.href="/contents/index.php"</script>