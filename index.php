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
        <link rel='stylesheet' href='/css/style.css'>
        <script type='text/javascript' src="https://code.jquery.com/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $(document).click(function() {
                    $('.main-view').fadeOut(500, function() {
                        location.href='/contents/index.php';
                    }); 
                });
            });
        </script>
    </head>
    <body>
        <div style='font-size: 30px;' class='main-view'>
            <div>
            hi-jin Dev Blog
            </div>
            <button onclick="location.href='/user/login.php'" type="button" class="btn btn-link">로그인</button>
        </div>
    </body>
</html>