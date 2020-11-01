<?php
    $link = mysqli_connect("localhost", "root", "rootroot", "apps");

    if(mysqli_connect_errno()){
        echo "DB connection failed. Please contanct your administrator.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }

    if(isset($_POST['category'])){
        $filtered_id = mysqli_real_escape_string($link, $_POST['category']);
    }else if(isset($_GET['category'])){
        $filtered_id = mysqli_real_escape_string($link, $_GET['category']);
    }else{
        $filtered_id = "ART_AND_DESIGN";
    }

    $query = "
        SELECT distinct app, category, installs, rating, reviews, `Last Updated`, price
        FROM googleplaystore
        WHERE price = 0 and category='{$filtered_id}'
        ORDER BY category ASC
        ";

    $result = mysqli_query($link, $query);

    $article = '';
    while($row = mysqli_fetch_array($result)){
        $article .= '<tr><td width="450"><a href="app_detail.php?name='.$row['app'].'">';
        $article .= $row['app'];
        $article .= '</a></td><td>';
        $article .= str_replace("_", " ", $row['category']);
        $article .= '</td><td>';
        $article .= $row['installs'];
        $article .= '</td><td>';
        $article .= $row['rating'];
        $article .= '</td><td>';
        $article .= $row['reviews'];
        $article .= '</td><td>';
        $article .= $row['Last Updated'];
        $article .= '</td></tr>';
    }

    $query_get_option = "
        SELECT distinct category
        FROM googleplaystore 
        WHERE price = 0 ORDER BY category ASC
        ";

    $get_option = mysqli_query($link, $query_get_option);

    $select_form = '<select name="category" >';
    while ($row = mysqli_fetch_array($get_option)) {
        $select_form .= '<option value="'.$row['category'].'">'.str_replace("_", " ", $row['category']).'</option>';
    }
    $select_form .= '</select>';

    mysqli_free_result($result);
    mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Free Apps</title>
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
    <h1 style="display:inline"> <?=str_replace("_", " ", $filtered_id)?> Free Apps | </h1> 
    <h2 style="display:inline"> <a href="index.php">Google Playstore App Information</a> </h2>
    <form method="GET" action="app_freeApps.php">
        <h3>Category :
            <?= $select_form ?>
        <input type="submit" value="Submit"/>
        </h3>
    </form>
    <table border="1">
        <tr>
            <th>App</th>
            <th>Category</th>
            <th>Installs</th></th>
            <th>Rating</th>
            <th>Reviews</th>
            <th>Last Updated</th>
        </tr>
        <?= $article ?>
    </table>
</body>
</html>