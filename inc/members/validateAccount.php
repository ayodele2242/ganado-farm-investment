<?php   

require_once '../functions.php';
$ac_no = $mysqli->real_escape_string($_POST['ac_no']);
$bank = $mysqli->real_escape_string($_POST['bank_code']);

$curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=".$ac_no."&bank_code=".$bank,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer sk_live_226cf64eb7dbd6d20d29eb42c04f7153eea5697f",
            "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if($err){
        	echo "cURL Error #: ". $err; 
        }else{
        	echo $response;
        }






?>