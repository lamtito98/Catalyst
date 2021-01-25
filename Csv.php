<?php
class CSV{
    public function importFile($file)
    {
        $file = fopen($file,'r');
        while ($row = fgetcsv($file)){
            //var_dump($row);
            print "<prev>";
            print_r($row);
            print "</prev>";
        }
    }
}

?>