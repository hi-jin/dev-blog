<?php
	session_start();
?>
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
        <nav style='position: fixed; width: 100vw;' class="navbar navbar-light bg-light">
          <div class="container-fluid">
            <a class="navbar-brand" href='/index.php'>hi-jin dev blog</a>
              <div>
                <?php 
                  if ( isset($_SESSION['user_name']) ) {
                      $username = $_SESSION['user_name'];
                      echo("{$username}님 안녕하세요?   ");
                  }
                  $admin = $_SESSION['is_admin'];
                  if ($admin == 1) {
                      $on_action = "location.href='/user/write.html'";
                      echo("<button type='button' onclick=location.href={$on_action} class='btn btn-outline-secondary'>글쓰기</button>");
                    }
                  if ( isset($_SESSION['user_name']) ) {   
                      ?>
                      <button type="button" class="btn btn-outline-primary" onclick="location.href='/user/logout.php'">로그아웃</button>
                  <?php
                  } else {
                      ?>
                      <button type="button" class="btn btn-outline-primary" onclick="location.href='/user/login.php'">로그인</button>
                  <?php
                  }
                  ?>
              </div>
            </div>
        </nav>
        <nav style='width: 80vw; position: absolute; left: 50%; top: 60px; transform: translate(-50%)' class="navbar navbar-light">
          <div class="container-fluid">
            <form style='flex: 1;' class="d-flex">
              <input style='flex: 1;' class="form-control me-2" type="search" placeholder="게시글 검색하기" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">검색하기</button>
            </form>
          </div>
        </nav>
        <div class='main-view'>
        </div>
    </body>
</html>