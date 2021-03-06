<?php
require_once('include/Validation.php');
require_once("include/db_connection.php");
require 'vendor/autoload.php';
session_start();
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if(isset($_POST['sub']))
{
    $extension = ['csv', 'xls'];
    $file_name = $_FILES['file']['name'];
    $cheking = explode(".", $file_name);
    $file_extension = end($cheking);

    if(in_array($file_extension,$extension)){
        $csv_path = $_FILES['file']['tmp_name'];
        /** Load $inputFileName to a Spreadsheet object **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($csv_path);
        $csv_data = $spreadsheet->getActiveSheet()->toArray();

        //loop into the csv
        foreach($csv_data as $row)
        {
           $name = Validation::validateData($row['0']);
           $surname = Validation::validateData($row['1']);
           $email = Validation::validateEmail($row['2']);

           $query = $connection->prepare("SELECT email from user where email=:email");
           $query -> bindParam(":email", $email);
           $query->execute();
           $count = $query->rowCount();
           // update the datas
           if($count > 0){
               $updateCsv = $connection->prepare("UPDATE user set name=:name, surname=:surname where email=:email");
               $updateCsv -> bindParam(":name", $name);
               $updateCsv -> bindParam(":surname", $surname);
               $updateCsv -> bindParam(":email", $email);
               $updateCsv->execute();
           }
           // insert the dcsv into the database
           else{
               $insertCsv = $connection->prepare("INSERT into user(name,surname,email) VALUES (:name, :surname, :email)");
               $insertCsv -> bindParam(":name", $name);
               $insertCsv-> bindParam(":surname", $surname);
               $insertCsv -> bindParam(":email", $email);
               $insertCsv->execute();


           }
        }
    }
    else{
        echo "Invalid file extension";
        header("Location:user_upload.php");
        exit(0);
    }

}
?>