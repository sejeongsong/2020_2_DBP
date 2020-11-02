<?php
    $link = mysqli_connect("localhost", "root", "rootroot", "apps");

    if(mysqli_connect_errno()){
        echo "DB connection failed. Please contanct your administrator.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }
    
    if(isset($_POST['name'])){
        $filtered_id = mysqli_real_escape_string($link, $_POST['name']);
    }else if(isset($_GET['name'])){
        $filtered_id = mysqli_real_escape_string($link, $_GET['name']);
    }else{
        echo "Please enter a value.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }
    
    $query = "SELECT app, category, installs, rating, price, reviews, size, `type`,`content rating`, genres, `Last Updated`, `current ver`, `android ver` FROM googleplaystore WHERE app LIKE '%{$filtered_id}%'";
    


    $result = mysqli_query($link, $query);
    $app_info = '';
    while($row = mysqli_fetch_array($result)){
        $app_info .= '<tr>';
        $app_info .= '<td><a href="app_detail.php?name='.$row['app'].'">'.$row['app'].'</a></td>';
        $app_info .= '<td>'.$row['category'].'</td>';
        $app_info .= '<td>'.$row['installs'].'</td>';
        $app_info .= '<td>'.$row['rating'].'</td>';
        $app_info .= '<td>'.$row['price'].'</td>';
        $app_info .= '<td>'.$row['reviews'].'</td>';
        $app_info .= '<td>'.$row['size'].'</td>';
        $app_info .= '<td>'.$row['type'].'</td>';
        $app_info .= '<td>'.$row['content rating'].'</td>';
        $app_info .= '<td>'.$row['genres'].'</td>';
        $app_info .= '<td>'.$row['Last Updated'].'</td>';
        $app_info .= '<td>'.$row['current ver'].'</td>';
        $app_info .= '<td>'.$row['android ver'].'</td>';
        $app_info .= '</tr>';
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Search Result</title>
    <style>
        body{
            font-family: Consolas, monospace;
            font-family: 12px;
        }
    </style>
</head>

<body>
    <h1 style="display:inline">App Search Result (Keyword = "<?=$filtered_id?>") | </h1> 
    <h2 style="display:inline"> <a href="index.php">Google Playstore App Information</a> </h2>
    <table border="1">
        <tr>
            <th>App</th>
            <th>Category</th>
            <th>Installs</th>
            <th>Rating</th>
            <th>Price</th>
            <th>Reviews</th>
            <th>Size</th>
            <th>Type</th>
            <th>Content Rating</th>
            <th>Genres</th>
            <th>Last Updated</th>
            <th>Current Ver</th>
            <th>Android Ver</th>
        </tr>
        <?=$app_info?>
    </table>
</body>

</html>