<?php
    $link = mysqli_connect("localhost", "admin", "admin", "employees");
    $query = "SELECT * FROM employees ORDER BY emp_no DESC LIMIT 10";
    $result = mysqli_query($link, $query);
    //print_r($result);
    //print_r($row);
    $emp_info = '';
    while($row = mysqli_fetch_array($result)){
        $emp_info .= '<tr>';
        $emp_info .= '<td>'.$row['emp_no'].'</td>';
        $emp_info .= '<td>'.$row['birth_date'].'</td>';
        $emp_info .= '<td>'.$row['first_name'].'</td>';
        $emp_info .= '<td>'.$row['last_name'].'</td>';
        $emp_info .= '<td>'.$row['gender'].'</td>';
        $emp_info .= '<td>'.$row['hire_date'].'</td>';
        $emp_info .= '
        <td>
          <form action="emp_update.php" method="post">
            <input type="hidden" name="emp_no" value="'.$row['emp_no'].'">
            <input type="submit" value="update">
          </form>
        </td>
        ';
        $emp_info .= '
        <td>
          <form action="emp_delete.php" method="post">
            <input type="hidden" name="emp_no" value="'.$row['emp_no'].'">
            <input type="submit" value="delete">
          </form>
        </td>
        ';
        $emp_info .= '</tr>';

       /*$writer_info .= '<td><a href="writer.php?id='.$filtered['id'].'">수정하기</a></td>';
        $writer_info .= '
          <td>
            <form action="emp_update.php" method="post">
              <input type="hidden" name="emp_no" value="'.$row['emp_no'].'">
              <input type="submit" value="수정">
            </form>
          </td>
          ';
          */
        
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> 직원 관리 시스템 </title>
</head>

<body>
    <h2><a href="index.php">직원 관리 시스템</a> | 직원 정보 조회</h2>
    <table border="1">
        <tr>
            <th>emp_no</th>
            <th>birth_date</th>
            <th>first_name</th>
            <th>last_name</th>
            <th>gender</th>
            <th>hire_date</th>
            <th>update</th>
            <th>delete</th>
        </tr>
        <?=$emp_info?>
    </table>
</body>

</html>