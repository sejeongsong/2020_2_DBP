<?php
$link = mysqli_connect('localhost', 'root', 'rootroot', 'dbp');
$query = "SELECT * FROM movie";
$result = mysqli_query($link, $query);
$list = '';
while($row = mysqli_fetch_array($result)){
  $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
}

$article = array(
  'title' => '환영합니다.',
  'description' => '영화는 우리가 살고 있는 세상에서 가장 영향력이 큰 대중매체라고 할 수 있다. 전 세계에서 하루에도 수백만 명이 영화를 보고 있다. 영화 관람 방식도 영화관만 이용하는 시대는 지났다. 관객들은 다양한 윈도(TV, 인터넷, SNS, 스마트폰, DVD, VOD, 기타 저장장치 등)를 통해 언제 어디서나 영화를 관람하는 시대가 되었다. 영화는 더 이상 취미가 아니라 우리 생활의 일부가 되어 버렸다. 관객들은 저마다 각양각색의 이유로 영화를 관람한다.

영화는 인간에게 ‘희로애락(喜怒哀樂)’을 선물한다. 영화는 꿈과 희망, 기쁨과 슬픔, 낭만과 사랑, 그리움과 기다림, 시련과 아픔 혹은 악몽과 불안감 등을 반영하여 다양한 형태로 세상에 나와 인간의 삶과 조우한다. 영화를 이해한다는 것은 사람들의 삶을 이해하는 것이다. 그것과 함께 영화가 추구하는 최고의 궁극적 목적은 어떤 형태로든 사람들을 ‘즐겁게’ 하기 위한 것이다.
[네이버 지식백과] 영화란 무엇인가 (영화의이해, 2014. 2. 28., 민경원)
'
);

if( isset($_GET['id']) ){
  $query = "SELECT * FROM movie WHERE id={$_GET['id']}";
  $result = mysqli_query($link, $query);
  $row = mysqli_fetch_array($result);
  $article = array(
    'title' => $row['title'],
    'description' => $row['description']
  );
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title> DATABASE </title>
</head>
<body>
  <h1> <a href="index.php"> 영화 </a></h1>
  <ol> <?=$list ?> </ol>
  <form action="process_create.php" method="post">
  <p><input type="text" name="title" placeholder="제목"></p>
  <p><textarea name="description" placeholder="설명"></textarea></p>
  <p><input type="submit"></p>
</form>
</body>
</html>
