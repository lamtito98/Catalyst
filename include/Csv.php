<?php
require_once('Validation.php');
require_once("db_connection.php");
require 'vendor/autoload.php';
session_start();
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset($_POST['sub'])){
    $allow_extension = "csv";
    $file_name = $_FILES['file']['name'];
    $check_file = explode(".",$file_name);
    $import_file = end($check_file);



    if(in_array($import_file,$extension)){
        $csv_path = $_FILES['file']['tmp_name'];
        /** Load $inputFileName to a Spreadsheet object **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($csv_path);
        $csv_data = $spreadsheet->getActiveSheet()->toArray();

        //loop into the csv
        foreach($csv_data as $row)
        {
           $names = Validation::validateData($row['0']);
           $surname = Validation::validateData($row['1']);
           $email = Validation::validateEmail($row['2']);

          // $verifiedData = "SELECT email from user where email='$email'";
           $query = $connection->prepare("SELECT email from user where email=:email");
           //$result = bindParam(":email", $email);
           $query->execute();
           $count = $query->columnCount();
           if($count > 0){
               $updateCsv = $connection->prepare("UPDATE users set names=:names, surname=:surname where email=:email");
               $updateCsv -> bindParam(":names", $names);
               $updateCsv -> bindParam(":surname", $surname);
               $updateCsv -> bindParam(":email", $email);
               $updateCsv->execute();
           }
           else{
               $insertCsv = $connection->prepare("INSERT into users(names,surname,email) VALUES (:names, :surname, :email)");
               $insertCsv -> bindParam(":names", $names);
               $insertCsv-> bindParam(":surname", $surname);
               $insertCsv -> bindParam(":email", $email);
               $insertCsv->execute();


           }
        }
    }
    else{
        $_SESSION['status'] = "invalid file extension";
        header("Location:index.php");
        exit(0);
    }

}



?>