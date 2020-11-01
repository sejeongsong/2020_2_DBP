<?php
    $link = mysqli_connect("localhost", "root", "rootroot", "apps");

    if(mysqli_connect_errno()){
        echo "DB connection failed. Please contanct your administrator.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }
    
    if(isset($_POST['rank_option'])){
        $filtered_id = mysqli_real_escape_string($link, $_POST['rank_option']);
    }else if(isset($_GET['rank_option'])){
        $filtered_id = mysqli_real_escape_string($link, $_GET['rank_option']);
    }else{
        $filtered_id = "Installs";
    }
    
    if($filtered_id == "Installs"){
        $query = "SELECT row_number() over (ORDER BY cast(replace(left($filtered_id, char_length(installs)-1), ',', '') as unsigned) DESC, rating DESC) 'rank', app, category, installs, rating, price, reviews FROM googleplaystore ORDER BY cast(replace(left($filtered_id, char_length(installs)-1), ',', '') as unsigned) DESC, rating DESC LIMIT 100";
    }else {
        $query = "SELECT row_number() over (ORDER BY $filtered_id DESC, cast(replace(left(installs, char_length(installs)-1), ',', '') as unsigned) DESC) 'rank', app, category, installs, rating, price, reviews FROM googleplaystore ORDER BY $filtered_id DESC, cast(replace(left(installs, char_length(installs)-1), ',', '') as unsigned) DESC LIMIT 100";
    }


    $result = mysqli_query($link, $query);
    $app_info = '';
    while($row = mysqli_fetch_array($result)){
        $app_info .= '<tr>';
        $app_info .= '<td>'.$row['rank'].'</td>';
        $app_info .= '<td width="450"><a href="app_detail.php?name='.$row['app'].'">'.$row['app'].'</a></td>';
        $app_info .= '<td>'.$row['category'].'</td>';
        $app_info .= '<td>'.$row['installs'].'</td>';
        $app_info .= '<td>'.$row['rating'].'</td>';
        $app_info .= '<td>'.$row['price'].'</td>';
        $app_info .= '<td>'.$row['reviews'].'</td>';
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

    </style>
</head>

<body>
    <h1 style="display:inline"><?=$filtered_id?> Top100 Apps | </h1> 
    <h2 style="display:inline"> <a href="index.php">Google Playstore App Information</a> </h2>
    <form method="POST" action="app_rate.php">
        <h3>Order by :
            <select name = "rank_option">
                <option value="Installs">Installs</option>
                <option value="Rating">Rating</option>
                <option value="Reviews">Reviews</option>
            </select>
            <input type="submit" value="Submit"/>
        </h3>
    </form>
    <table border="1">
        <tr>
            <th>rank</th>
            <th>App</th>
            <th>Category</th>
            <th>Installs</th>
            <th>Rating</th>
            <th>Price</th>
            <th>Reviews</th>
        </tr>
        <?=$app_info?>
    </table>
</body>

</html>