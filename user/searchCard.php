<?php
$conn = mysqli_connect("localhost", "root", "1284", "blog", 3306);
$keyWord = $_GET['keyWord'];
$sql = "SELECT no, title, content, user_name, date, tag FROM board WHERE tag LIKE '%{$keyWord}%' OR title LIKE '%{$keyWord}%' ORDER BY date DESC;";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result);) {
    
}
?>