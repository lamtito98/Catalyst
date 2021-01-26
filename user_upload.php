<?php
require_once("Csv.php");
?>
<!DOCTYPE html>
<html>
<head>
</head>

<body>
    <h1>CSV File import</h1>
    <form method="post" enctype="multipart/form-data" action="Csv.php">
        <input type="file" name= "file">
        <input type="submit" name="sub" value="Import Data">
    </form>
</body>
</html>