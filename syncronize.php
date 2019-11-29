<?php
require_once 'vendor/autoloader.php'; // Replace with your path to guzzle autoload file
require_once 'autoloader.php';
use EOV\ApiClient;
use EOV\Purl;
use EOV\Exception\RequestFailureException;
    if(isset($_POST["create-uid"])){
        try{
            $table  = 'tb_data_zurcih';
            $sql    = "SELECT * FROM $table where STATUS_FLAG='PARSED'";
            $query  = $pdo->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            $countupdated=0;
            $link_zurich="https://preprod.rtcvid.net/zurichpro8/?uid=";
            if(count($result)>0){
                foreach($result as $val){
                    $status = false;
                    $data = array(
                            'POLICY_HOLDER_NAME' => $val['POLICY_HOLDER_NAME'],
                            'POLICY_HOLDER_NAME_ROW_2' => $val['POLICY_HOLDER_NAME_ROW_2'],
                            'POLICY_HOLDER_DATE_OF_BIRTH' => $val['POLICY_HOLDER_DATE_OF_BIRTH'],
                            'POLICY_NUMBER' => $val['POLICY_NUMBER'],
                            'INSURED_NAME' => $val['INSURED_NAME'],
                            'SUM_ASSURED' => $val['SUM_ASSURED'],
                            'PREMIUM_AMOUNT' => $val['PREMIUM_AMOUNT'],
                            'PAYMENT_FREQUENCY' => $val['PAYMENT_FREQUENCY'],
                            'PAYMENT_METHOD' => $val['PAYMENT_METHOD'],
                            'AGENT_NAME' => $val['AGENT_NAME'],
                            'POLICY_HOLDER_PHONE_NUMBER' => $val['POLICY_HOLDER_PHONE_NUMBER'],
                            'EMAIL_POLICY_HOLDER_NAME' => $val['EMAIL_POLICY_HOLDER_NAME'],
                            'COMPONENT_DESCRIPTION' => $val['COMPONENT_DESCRIPTION'],
                            'CURRENCY' => $val['CURRENCY'],
                            'verif' => '',
                            'verif_b' => '',
                            'check' => '',
                            'survey' => '',
                            );
                    $username = 'apizurich';
                    $password = 'Zur|ch@34L!2'; 
                    $api_client = ApiClient::factory('https://preprod.rtcvid.net', 'zurichpro8', $username,$password);
                    $purl = new Purl($api_client);
                    $puid = $purl->create($data);
                    $countupdated++;
                    $id=$val['ID'];
                    $linked=$link_zurich."".$puid;
                    $stmt = $pdo->prepare("UPDATE $table 
                            SET STATUS_FLAG = 'CONVERTED', LANDING_PAGE=:link,UID = :uid,GENERATED_AT=:tgl
                            WHERE ID = :id");
                    $stmt->execute(array(
                        'link'  => $linked,
                        'uid'   => $puid,
                        'id'    => $val['ID'],
                        'tgl'   => date('Y-m-d H:i:s'),
                     ));

                }
                echo "<div class='alert alert-primary' role='alert'>";
                echo '[UPLOAD]Total ('.$countupdated.') diperbarui';
                echo "</div>";
            }
        } catch (Exception $e) {
            echo $e->code . "\n" . $e->message . "\n";         // Output http status code and message
            if (!empty($e->message)) {                              // Output validation messages
                echo implode("\n", $e->message);
            }
        }
    }
?>