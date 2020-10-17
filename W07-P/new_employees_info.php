<?php
    $link = mysqli_connect('localhost', 'admin', 'admin', 'employees');

    if(mysqli_connect_errno()){
        echo "MariaDB 접속에 실패했습니다. 관리자에게 문의하세요.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }

    $query = "
        SELECT e.first_name, e.last_name, e.hire_date, d.dept_name, t.title
        FROM dept_emp de
        INNER JOIN employees e on e.emp_no=de.emp_no
        LEFT JOIN departments d on d.dept_no=de.dept_no
        INNER JOIN salaries s on s.emp_no=e.emp_no
        LEFT JOIN titles t on t.emp_no=e.emp_no
        WHERE s.to_date='9999-01-01'
        ORDER BY e.hire_date DESC LIMIT 10
        ";

    $result = mysqli_query($link, $query);

    $article = '';
    while($row = mysqli_fetch_array($result)){
        $article .= '<tr><td>';
        $article .= $row['first_name'];
        $article .= '</td><td>';
        $article .= $row['last_name'];
        $article .= '</td><td>';
        $article .= $row['hire_date'];
        $article .= '</td><td>';
        $article .= $row['dept_name'];
        $article .= '</td><td>';
        $article .= $row['title'];
        $article .= '</td></tr>';
    }

    mysqli_free_result($result);
    mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> 신입 사원 소개 </title>
    <style>
        body{
            font-family: consolas, monospace;
            font-family: 12px;
        }
        table{
            width: 100%;
        }
        th, td{
            padding: 10px;
            border-bottom: 1px solid #dadada;
        }
    </style>
</head>
<body>
        <h2><a href="index.php">직원 관리 시스템</a> | 신입 사원 소개 </h2>
        <h1>WELCOME!!</h1>
        <table>
            <tr>
                <th>first_name</th>
                <th>last_name</th>
                <th>hire_date</th></th>
                <th>dept_name</th>
                <th>title</th>
            </tr>
            <?= $article ?>
        </table>
</body>
</html>