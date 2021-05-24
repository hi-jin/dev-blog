<?php
header("Content-Type: application/json");

$conn = mysqli_connect("localhost", "root", "1284", "blog", 3306);
$keyWord = $_GET['key'];

$sql = "SELECT no, title, content, user_name, date, tag FROM board WHERE tag LIKE '%{$keyWord}%' OR title LIKE '%{$keyWord}%' ORDER BY date DESC;";

$result = mysqli_query($conn, $sql);

$list_response = array();
while ($row = mysqli_fetch_assoc($result)) {
    $row_data = array("no" => $row['no'], "title" => $row['title'], "content" => $row['content'], "user_name" => $row['user_name'], "date" => $row['date'], "tag" => $row['tag']);
    array_push($list_response, $row_data);
}

$response = array("data" => $list_response);

echo json_encode($response);
?>