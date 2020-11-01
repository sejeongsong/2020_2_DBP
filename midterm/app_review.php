<?php
    $link = mysqli_connect("localhost", "root", "rootroot", "apps");

    if(mysqli_connect_errno()){
        echo "DB connection failed. Please contanct your administrator.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }
    
    if(isset($_POST['app_name'])){
        $filtered_id = mysqli_real_escape_string($link, $_POST['app_name']);
    }else if(isset($_GET['app_name'])){
        $filtered_id = mysqli_real_escape_string($link, $_GET['app_name']);
    }else{
        echo "Please enter a value.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }
    
    if(isset($_POST['content'])){
        $filtered_content = mysqli_real_escape_string($link, $_POST['content']);
    }else if(isset($_GET['content'])){
        $filtered_content = mysqli_real_escape_string($link, $_GET['content']);
    }else{
        echo "Please enter a value.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }
    
    
    $query = "SELECT app, translated_review, sentiment FROM googleplaystore_user_reviews 
              WHERE app LIKE '{$filtered_id}'";
    


    $result = mysqli_query($link, $query);
    $app_info = '';
    while($row = mysqli_fetch_array($result)){
        $app_info .= '<tr>';
        $app_info .= '<td>'.$row['app'].'</td>';
        $app_info .= '<td width="1000">'.$row['translated_review'].'</td>';
        $app_info .= '<td>'.$row['sentiment'].'</td>';
        $app_info .= '</tr>';
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Top100 Apps</title>
    <style>
        body{
            font-family: Consolas, monospace;
            font-family: 12px;
        }
        /*
        table{
            width: 100%;
        }
        th, td{
            padding: 10px;
            border-bottom: 1px solid #dadada;
        }
        */
    </style>
</head>

<body>
    <h1 style="display:inline">Review Search Result (App Keword = "<?=$filtered_id?>", Content Keyword = "<?=$filtered_content?>") | </h1> 
    <h2 style="display:inline"> <a href="index.php">Back</a> </h2>
    <table border="1">
        <tr>
            <th>App</th>
            <th>Review</th>
            <th>Sentiment</th>
        </tr>
        <?=$app_info?>
    </table>
</body>

</html>