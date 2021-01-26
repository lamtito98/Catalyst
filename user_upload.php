<?php
require_once("include/db_connection.php");
require_once("include/csv.php");
?>

<!DOCTYPE html>
<html>
<head>
</head>

<body>
    <h1>CSV File import</h1>
    <form method="post" enctype="multipart/form-data" action="csv.php">
        <input type="file" name= "file">
        <input type="submit" name="sub" value="Import Data">
    </form>
</body>
</html>