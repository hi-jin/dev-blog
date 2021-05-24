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
            function deleteCard(no) {
                $.ajax({
                    url: "/user/deleteCard.php",
                    type: "post",
                    data: {"no": no},
                }).done(function(data) {
                    if (typeof parseInt(data) == "number") {
                        $("div[no = " + data + "]").remove();
                        alert("게시글이 삭제되었습니다.");
                    } else {
                        alert(data);
                    }
                });
            }
            
            function searchCard() {
                var keyWord = $('searchField').val();
                loadContents(keyWord);
            }
            
            function loadContents(keyWord) {
                $.ajax({
                    type: "GET",
                    url: "/contents/contents.php",
                    data: {key: keyWord},
                }).done(function(data) {
                    console.log(data.data.length);
                });
            }
        </script>
    </head>
    <body>
        <nav style='z-index: 100; position: fixed; width: 100vw;' class="navbar navbar-light bg-light">
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
        <nav style='z-index: 100; width: 80vw; position: fixed; left: 50%; top: 60px; transform: translate(-50%)' class="navbar navbar-light">
          <div class="container-fluid">
            <form style='flex: 1;' class="d-flex">
              <input style='flex: 1;' class="form-control me-2" type="search" placeholder="게시글 검색하기" aria-label="Search" id="searchField">
              <button class="btn btn-outline-success" onClick="searchCard()">검색하기</button>
            </form>
          </div>
        </nav>
        <div onload='loadContents()' class='main-view'>
            <?php
            $conn = mysqli_connect("localhost", "root", "1284", "blog", 3306);
            $sql = "SELECT no, title, content, user_name, date, tag FROM board WHERE tag LIKE '%{$keyWord}%' OR title LIKE '%{$keyWord}%' ORDER BY date DESC;";
            
            $result = mysqli_query($conn, $sql);
            
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div no="<?php echo $row['no']; ?>" class="card" style="width: 80vw;">
                <div class="card-body">
                    <?php
                    $admin = $_SESSION['is_admin'];
                  if ($admin == 1) {
                      $no = $row['no'];
                      echo("<button onclick='deleteCard({$no})'} style='position: absolute; right: 10px;' type='button' class='btn-close' aria-label='Close'></button>");
                    }
                    ?>
                    
                    <h4 class="card-title"><?php echo $row['title'] ?></h4>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo substr(str_replace(";", ", ", $row['tag']), 0, -2) ?></h6>
                    <p><?php echo $row['content'] ?></p>
                    <p class="card-text"><?php echo $row['user_name'];?> - <?php echo $row['date'] ?></p>
                </div>
            </div>
            <br>
            <?php
            }
            ?>
        </div>
    </body>
</html>