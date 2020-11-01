<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> Google Playstore App Information  </title>
    <style>
        body{
            font-family: Consolas, monospace;
            font-family: 12px;
        }
    </style>
</head>

<body>
    <h1> Google Playstore App Information </h1>
    <a href="app_rate.php">Top100 apps </a><br>
    <a href="app_freeApps.php">Free apps</a><br>
    <form action="app_search.php" method="GET">
        Search app :
        <input type="text" name="name" placeholder="name">
        <input type="submit" value="Search">
    </form>
    <form action="app_review_search.php" method="GET">
        Search app review : 
        <input type="text" name="app_name" placeholder="app name">
        <input type="text" name="content" placeholder="content">
        <input type="submit" value="Search">
    </form>
    <a href="app_detail.php?name=best"> </a><br>
</body>

</html>