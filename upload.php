<?php
   
    function getValue($string){
        if($string=="NULL" || $string == ""){
            return '';
        }else{
            return $string;
        }
    }
    
if (isset($_POST["import"])) {
    $csv_file = $_FILES["file"]["tmp_name"];
    if ($_FILES["file"]["size"] > 0) {
        if (!file_exists($csv_file)) {
            die('File not found. Make sure you specified the correct path.');
        }
        $table="";
        $valid=false;
        $input = fopen($csv_file, 'a+');
        $input2 = fopen($csv_file, 'a+');
        $first_row = fgetcsv($input, 1024, '|');
        foreach ($first_row as $name) {
            $values_array[] = ':' . trim($name);
        }
        $columns = implode('| ', fgetcsv($input2, 1024, '|'));
        $values = implode('| ', $values_array);
        $countinserted = 0;
        $countupdated = 0;
        $row = 1;
        //set maximal char per line 
        $mx_name =40;
        $mx_term =90;
        if (($handle = fopen($csv_file, "r")) !== FALSE) {
            $row1=1;
            while (($data = fgetcsv($handle, 10000, "|")) !== FALSE) {
                $num = count($data);
                $row++;
                if($row1>1){
                    if($number_of_rows==0){
                        if($table=='tb_ul_tl'){
                            $sql = "INSERT INTO $table 
                                    (   POLICY_HOLDER_NAME,POLICY_HOLDER_DATE_OF_BIRTH,POLICY_NUMBER,INSURED_NAME,      SUM_ASSURED,PREMIUM_AMOUNT,PAYMENT_FREQUENCY,PAYMENT_METHOD,AGENT_NAME,  POLICY_HOLDER_PHONE_NUMBER,EMAIL_POLICY_HOLDER_NAME)
                                    VALUES(?,?,?,?
                                            ?,?,?,?,?,
                                            ?,?)";
                            $query = $pdo->prepare($sql);
                            $query->execute(array(getValue($data[0]),
                                getValue($data[1]),getValue($data[2]),getValue($data[3]),
                                getValue($data[4]),getValue($data[5]),getValue($data[6]),
                                getValue($data[7]),getValue($data[8]),getValue($data[9])));
                            $countinserted++;
                        }
                    }
                }   
                $row1++;
          }
          fclose($handle);
        }
        echo "<div class='alert alert-primary' role='alert'>";
        echo '[UPLOAD]Total = ' . ($countinserted+$countupdated) . '(' . $countinserted . ' Ditambahkan,' . $countupdated . ' Diperbarui)';
        echo "</div>";
    }
}
 //19870808 thn bulan tgl
        

?>