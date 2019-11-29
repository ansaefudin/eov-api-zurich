<?php
    function convertDate($stringtgl){
        $tgl=trim($stringtgl);
        if(strlen($tgl)==8){
            $tahun = substr($tgl, 0,4);
            $bulan = substr($tgl, 4,2);
            $tangg = substr($tgl, 6,2);
            $arraybln=array(" ","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
            $strbln=$arraybln[intval($bulan)];
            return "$tangg $strbln $tahun";    
        }else{
            return 'invalid date!';
        }
    }

    function convertNominal($value)
    {
        return number_format((int)$value, 0, ',', '.');
    }
    function setDash($string){
        if($string=='')
            return "-";
        else
            return $string;
        
    }
    function parsing($string,$max_char_per_line,$row){
        $splited_string=explode(' ', $string);
        $tempresult='';
        $baris=1;
        $result = array(
            1   => "",
            2   => "",
            3   => "",
            4   => "",
            5   => "",
        );
        foreach ($splited_string as $val) {
            if(strlen($tempresult." ".$val)<=$max_char_per_line){
                $tempresult = $tempresult." ".$val;
                $result[$baris] = $tempresult;
            }else{
                $baris++;
                $tempresult=$val;
                $result[$baris]=$tempresult;
            }
        }
        return $result[$row];   
    }
    
    if (isset($_POST["parsing-data"])) {
        $table = $_POST['tipe-produk'];
        $sql = "SELECT  *  FROM $table  where STATUS_FLAG='CREATED'";
        $check = $pdo->prepare($sql);
        $check->execute();
        $result=$check->fetchALL();
        $number_of_rows= count($result);
        $mx_add = 20;
        $countupdated=0;
        if($number_of_rows>0){
            foreach($result as $data){  
                if($table=="tb_ul_tl"){
                    $sql = "UPDATE $table SET 
                        NOMINALRow1 = ?,
                        NOMINALRow2 = ?,
                        NOMINALRow3 = ?,
                        PRODUCT_TYPE_KS = ?,
                        SUM_INSURED= ?, 
                        CUSTOMER_ADDRESS_ROW_1= ?, CUSTOMER_ADDRESS_ROW_2= ?, 
                        CUSTOMER_ADDRESS_ROW_3= ?, CUSTOMER_ADDRESS_ROW_4= ?, 
                        CUSTOMER_ADDRESS_ROW_5= ?, 
                        ISSUED_DATE=?, DOB=?, PARSED_AT=?,STATUS_FLAG='PARSED' WHERE POLICY_NUMBER=?";
                    $stmt= $pdo->prepare($sql);
                    $stmt->execute([
                        setDash($data['NOMINALRow1']),
                        setDash($data['NOMINALRow2']),
                        setDash($data['NOMINALRow3']),
                        getProdType($data['PRODUCT_NAME']),
                        convertNominal($data['SUM_INSURED']),
                        trim(parsing($data['CUSTOMER_ADDRESS'],$mx_add,1)),
                        trim(parsing($data['CUSTOMER_ADDRESS'],$mx_add,2)),
                        trim(parsing($data['CUSTOMER_ADDRESS'],$mx_add,3)),
                        trim(parsing($data['CUSTOMER_ADDRESS'],$mx_add,4)),
                        trim(parsing($data['CUSTOMER_ADDRESS'],$mx_add,5)),
                        convertDate($data['ISSUED_DATE']),
                        convertDate($data['DOB']),date('Y-m-d H:i:s'),
                        $data['POLICY_NUMBER']]);
                    $countupdated++;
                }
            } 
            echo "<div class='alert alert-primary' role='alert'>";
            echo '[PARSED]Total = '. $countupdated . ' record diperbarui';
            echo "</div>";
        }else{
            echo "<div class='alert alert-primary' role='alert'>";
            echo '[PARSED]Data tidak ditemukan!';
            echo "</div>";
        }
    }
?>