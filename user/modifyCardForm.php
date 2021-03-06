<?php
session_start();
if ($_SESSION['is_admin'] == 1) {
    $no = $_GET['no'];
    $conn = mysqli_connect("localhost", "root", "1284", "blog", 3306);
    $query = "SELECT title, content, user_name, date, tag, hit FROM board WHERE no={$no}";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('관리자만 수정할 수 있습니다... 잡았다 요놈'); history.back();</script>";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>blog</title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel='stylesheet' href='/css/style.css'>
        <script src="https://kit.fontawesome.com/685c30fde6.js" crossorigin="anonymous"></script>
        <script type='text/javascript' src="https://code.jquery.com/jquery.min.js"></script>
        <script>
            var tag_divs = [];
            var tags = [];
            var tag_count = 0;
            var tag_unum = 0;
            $(document).ready(function() {
                $('#text-editor-div').keypress(function(event){
                   if (event.keyCode == 13) {
                       event.preventDefault();
                       var sel = document.getSelection();
                       range = sel.getRangeAt(0);
                       br = document.createElement("br");
                       textNode = document.createTextNode('\u200C');
                       range.insertNode(br);
                       range.collapse(false);
                       range.insertNode(textNode);
                       range.selectNodeContents(textNode);
                   } 
                });
                $('#submit').click(function() {
                    $('#text-editor').val($('#text-editor-div').html());
                    var tags_str = ""
                    for (var i = 0; i < tags.length; i++) {
                        if (tags[i].trim() == "") {
                            continue;
                        }
                        tags_str += tags[i] + ";";
                    }
                    $('#tag').val(tags_str);
                    modifyCard();
                });
                $('#tag_input').keypress(function(event){
                    if (event.keyCode == 13) {
                        event.preventDefault();
                        var tag = $('#tag_input').val();
                        create_tag(tag);
                    }
                });
            });
            
            function create_tag(tag) {
                $(document).ready(function() {
                    $('#tag_input').val('');
                    if ( tag.trim() == "" ) {
                        return;
                    }
                    if ( tag_count === 5 ) {
                        alert("태그는 5개까지 설정할 수 있습니다.");
                        return;
                    }
                    for (var i = 0; i < tags.length; i++) {
                        if (tags[i] == tag) {
                            return;
                        }
                    }
                    var tag_idx = tag_unum++;
                    tag_count++;
                    var tag_div = $('<div></div>');
                    tag_div.attr("onclick", "remove_tag(" + tag_idx + ")");
                    tag_div.attr("class", "tag");
                    tag_div.text(tag);
                    tag_div.append($('<button type="button" class="btn-close" disabled aria-label="Close"></button>'));
                    tags.push(tag);
                    tag_divs.push(tag_div);
                    $('#posting_tag').append(tag_div);
                    });
            }
            
            function addText(addString) {
                var element     =         document.getElementById("text-editor");
                var strOriginal  =         element.innerHtml;
                var iStartPos    =         element.selectionStart;
                var iEndPos     =         element.selectionEnd;
                var strFront     =         "";
                var strEnd       =         "";

                if(iStartPos == iEndPos) {
                    strFront = strOriginal.substring(0, iStartPos);
                    strEnd = strOriginal.substring(iStartPos, strOriginal.length);
                } else return;
                
                element.value = strFront + addString + strEnd;
            }
            
            function remove_tag(idx) {
                tag_divs[idx].remove();
                tags[idx] = "";
                tag_count--;
            }
            
            function create_table() {
                var data = $('.text-editor').html()
                var row = prompt("행 길이를 입력하세요.", '0');
                var col = prompt("열 길이를 입력하세요.", '0');
                if ( (row === '0') || (col === '0') ) {
                    return;
                }
                var table = '<table>';
                for (var i = 0; i < row; i++) {
                    table += "<tr>";
                    for (var j = 0; j < col; j++) {
                        table += "<td></td>";
                    }
                    table += "</tr>";
                }
                table += "</table>";
                $('.text-editor').html(data + table);
            }
            
            function change(str) {
                document.execCommand(str, false, true);
            }
            
            function modifyCard() {
                var no = <?php echo $no ?>;
                var title = $('[name=posting_title]').val();
                var content = $('[name=posting_text]').val();
                var tag = $('[name=tag]').val();
                $.ajax({
                    url: "/user/modifyCard.php",
                    type: "POST",
                    data: {
                        "no": no,
                        "title": title,
                        "content": content,
                        "tag": tag,
                    }
                }).done(function(data) {
                    if (parseInt(data) == 1) {
                        alert("수정 완료되었습니다.");
                        location.href = "/contents/index.php";
                    } else {
                        //alert(data);
                    }
                });
            }
        </script>
        <style>
            .main-view > form > div > div > a {
                color: black;
            }
        </style>
    </head>
    <body>
        <nav style='z-index: 100; position: fixed; width: 100vw;' class="navbar navbar-light bg-light">
          <div style="padding: 0px 30px;" class="container-fluid">
            <a class="navbar-brand" href='/index.php'>hi-jin dev blog</a>
              <div>
                  <button type="button" class="btn btn-outline-primary" onclick="location.href='/user/logout.php'">로그아웃</button>
              </div>
            </div>
        </nav>
        <div class='main-view'>
            <div style="display: inline-block">
                <input style="width: 80vw;" type="text" name="posting_title" placeholder="제목을 입력하세요." value="<?php echo $row['title']; ?>"><br><br>
                <input style="width: 80vw;" id='tag_input' type="text" placeholder="태그를 입력하고 Enter키를 누르세요.">
                <?php
                $tag_str = explode(";", $row['tag']);
                foreach ($tag_str as $tag) {
                    echo "<script>create_tag('{$tag}')</script>";
                }
                ?>
                <input type='hidden' name='tag' id='tag'>
                <br>
                태그 : <div style="display: inline-block; margin: 5px 0px;" id='posting_tag' name="posting_tag"></div><br>
                <div style="display: flex;">
                    <div contenteditable="true" id='text-editor-div' class='text-editor bg-light'>
                    <?php
                    echo $row['content'];    
                    ?>
                    </div>
                    <input id='text-editor' name='posting_text' type="hidden">
                    <div style="display: flex; flex-direction: column; margin-left: 10px;">
                        <a href='javascript:void(0);' onclick='change("bold");'><i class="fas fa-bold fa-2x"></i></a>
                        <a href='javascript:void(0);' onclick='create_table()'><i class="fas fa-table fa-2x"></i></a>
                    </div>
                </div><br>
                <input id='submit' class="btn btn-primary" type="button" value="수정하기">
            </div>
        </div>
    </body>
</html>