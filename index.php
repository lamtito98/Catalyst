<?php
require_once("include/db_connection.php");
require_once("csv.php");
$import_csv = new Csv();
if(isset($_POST['sub'])){
    var_dump($_FILES['file']);
    $import_csv->importFile($_FILES['file']['tmp_name']);
    //$csv1 ->im
    
}
?>

<!DOCTYPE html>
<html>
<head>
</head>

<body>
    <h1>CSV File import</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name= "file">
        <input type="submit" name="sub" value="Import Data">
    </form>
</body>
</html>