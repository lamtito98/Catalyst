<?php
$host="localhost";
$port="5432";
$dbname="catalyst";
$username="postgres";
$password="mardi2020.";
$database_string = "pgsql:host=$host;port=$port;dbname=$dbname;user=$username;password=$password";

try{
// creates the PostgreSQL database connection
$connection = new PDO($database_string);

/* message if connected to the PostgreSQL successfully
if($connection){
echo "Connected to the $dbname database successfully!";
}*/
}catch (PDOException $e){
// should there be an error lets get that and show it to the user.
echo $e->getMessage();
}



?>