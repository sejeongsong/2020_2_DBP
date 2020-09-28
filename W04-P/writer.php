<?php
  $link = mysqli_connect('localhost', 'root', 'rootroot', 'dbp');

  $query = "SELECT * FROM writer";
  $result = mysqli_query($link, $query);
  $writer_info = '';

  while ($row = mysqli_fetch_array($result)) {
      $filtered = array(
      'id' => htmlspecialchars($row['id']),
      'name' => htmlspecialchars($row['name']),
      'profile' => htmlspecialchars($row['profile'])
    );
      $writer_info .= '<tr>';
      $writer_info .= '<td>'.$filtered['id'].'</td>';
      $writer_info .= '<td>'.$filtered['name'].'</td>';
      $writer_info .= '<td>'.$filtered['profile'].'</td>';
      $writer_info .= '<td><a href="writer.php?id='.$filtered['id'].'">수정하기</a></td>';
      $writer_info .= '
        <td>
          <form action="process_delete_writer.php" method="post">
            <input type="hidden" name="id" value="'.$filtered['id'].'">
            <input type="submit" value="삭제">
          </form>
        </td>
        ';
      $writer_info .= '</tr>';
  };

    $escaped = array(
      'name' => '',
      'profile'=> ''
    );

$form_action = 'process_create_writer.php';
$label_submit = '작성자 추가';
$form_id = '';

    if (isset($_GET['id'])) {
        $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
        settype($filtered_id, 'integer');
        $query = "SELECT * FROM writer WHERE id = {$filtered_id}";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
        $escaped['name'] = htmlspecialchars($row['name']);
        $escaped['profile'] = htmlspecialchars($row['profile']);

        $form_action = 'process_update_writer.php';
        $label_submit = '수정';
        $form_id = '<input type="hidden" name="id" value="'.$_GET['id'].'">';
    }


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset = "utf-8">
  <title>영화</title>
</head>
<body>
  <h1><a href="index.php">영화</a></h1>
  <p><a href="index.php">돌아가기</a><p>

  <table border = "1">
    <tr>
      <th>아이디</th>
      <th>이름</th>
      <th>프로필</th>
      <th></th> <!--수정-->
      <th></th> <!--삭제-->
    </tr>
      <?= $writer_info ?>
  </table>
  <br>
    <form action="<?= $form_action ?>" method="post">
      <?= $form_id ?>
      <label for="fname">이름:</label><br>
      <input type="text" id="name" name="name" placeholder="이름" value="<?=$escaped['name']?>"<br><br>
      <label for="lname">프로필:</label><br>
      <input type="text" id="profile" name="profile" placeholder="프로필" value="<?=$escaped['profile']?>"><br><br>
      <input type="submit" value="<?= $label_submit?>">
</body>
</html>
