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
            $(document).ready(function() {
                loadContents();
            });
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
                var keyWord = $('#searchField').val().trim();
                loadContents(keyWord);
                $('#searchField').val('');
            }
            
            function loadContents(keyWord) {
                $.ajax({
                    type: "GET",
                    url: "/contents/contents.php",
                    data: {"key": keyWord},
                }).done(function(data) {
                    $('.main-view').html('');
                    for (var i = 0; i < data.data.length; i++) {
                        var no = data.data[i].no;
                        var title = data.data[i].title;
                        var content = data.data[i].content;
                        var user_name = data.data[i].user_name;
                        var date = data.data[i].date;
                        var tag = data.data[i].tag;
                        
                        var card = $('<div no=' + no + ' class="card" style="width: 80vw;"></div>');
                        var card_body = $('<div class="card-body"></div>');
                        var delete_btn = $("<button onclick='deleteCard(" + no + ")'} style='position: absolute; right: 10px;' type='button' class='btn-close' aria-label='Close'></button>");
                        var card_title = $('<h4 class="card-title">' + title + '</h4>');
                        tag = tag.replace(/;/gi, ", ");
                        tag = tag.substring(0, tag.length-2);
                        var card_subtitle = $('<h6 class="card-subtitle mb-2 text-muted">' + tag + '</h6>')
                        var content_body = $('<p>' + content + '</p>');
                        var card_text = $('<p class="card-text">' + user_name + ' - ' + date + '</p>');
                        
                        var is_admin = <?php 
                            if ( $_SESSION['is_admin'] == 1 ) echo 1;
                            else echo 0;
                            ?>;
                        
                        if (is_admin == 1) {
                            delete_btn.appendTo(card_body);
                        }
                        card_title.appendTo(card_body);
                        card_subtitle.appendTo(card_body);
                        content_body.appendTo(card_body);
                        card_text.appendTo(card_body);
                        card_body.appendTo(card);
                        card.appendTo($('.main-view'));
                        $('.main-view').append($('<br>'));
                    }
                });
            }
        </script>
    </head>
    <body>
        <nav style='z-index: 100; position: fixed; width: 100vw;' class="navbar navbar-light bg-light">
          <div style="padding: 0px 30px;" class="container-fluid">
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
            <div style='flex: 1;' class="d-flex">
              <input style='flex: 1;' onKeyPress="if (event.keyCode == 13) {searchCard();}" class="form-control me-2" type="search" placeholder="게시글 검색하기" aria-label="Search" id="searchField">
              <button class="btn btn-outline-success" onClick="searchCard()">검색하기</button>
            </div>
          </div>
        </nav>
        <div class='main-view'>
        </div>
    </body>
</html>