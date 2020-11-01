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
    
    $query = "SELECT app, category, installs, rating, price, reviews, size, `type`,`content rating`, genres, `Last Updated`, `current ver`, `android ver` FROM googleplaystore WHERE app='{$filtered_id}'";
    


    $result = mysqli_query($link, $query);
    $app_info = '';
    while($row = mysqli_fetch_array($result)){
        $app_info .= '<tr>';
        $app_info .= '<td>'.$row['app'].'</td>';
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

    $get_sentiment_query = "SELECT subG.sentiment, count(subG.sentiment) 
                            FROM (SELECT app, sentiment FROM googleplaystore_user_reviews WHERE app LIKE '{$filtered_id}') subG
                            GROUP BY subG.sentiment
                            HAVING count(subG.sentiment) > 0
                            ORDER BY subG.sentiment DESC";

    $get_sentiment = mysqli_query($link, $get_sentiment_query);
    $get_sentiment_cnt = mysqli_query($link, $get_sentiment_query);
    $sentiment_info = '<tr>';

    while($row = mysqli_fetch_array($get_sentiment)) {
        $sentiment_info .= '<th>'.$row['sentiment'].'</th>';
    }
    $sentiment_info .= '</tr><tr>';
    while($row = mysqli_fetch_array($get_sentiment_cnt)) {
        $sentiment_info .= '<td>'.$row['count(subG.sentiment)'].'</td>';
    }
    $sentiment_info .= '</tr>';

    //$sentiment_info .= '<td>'.$row['count(subG.sentiment)'].'</td>';

    $get_review_query = "SELECT row_number() over (), app, translated_review, sentiment FROM googleplaystore_user_reviews 
              WHERE app LIKE '{$filtered_id}'";
    
    $get_review = mysqli_query($link, $get_review_query);
    $review_info = '';
    while($row = mysqli_fetch_array($get_review)){
        $review_info .= '<tr>';
        $review_info .= '<td>'.$row['row_number() over ()'].'</td>';
        //$review_info .= '<td>'.$row['app'].'</td>';
        $review_info .= '<td width="1000">'.$row['translated_review'].'</td>';
        $review_info .= '<td>'.$row['sentiment'].'</td>';
        $review_info .= '</tr>';
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
    <h1 style="display:inline"><?=$filtered_id?> | </h1> 
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
    <br>
    <h1>Reviews</h1>
    <table border="1">
        <?=$sentiment_info?>
    </table>
    <table border="1">
        <tr>
            <th></th>
            <!--<th>App</th>-->
            <th>Review</th>
            <th>Sentiment</th>
        </tr>
        <?=$review_info?>
    </table>

</body>

</html>