<?php
	include("connection.php");
    if(isset($_GET["phoneno"])){
        $messages=array();
        $array=array();
        $phoneno=mysqli_real_escape_string($conn,$_GET["phoneno"]);
        $statement="SELECT * FROM tblchats WHERE fldphoneno_sender='$phoneno' or fldphoneno_sender='123456789' or fldphoneno_receiver='123456789' or fldphoneno_receiver='$phoneno'";
        $query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
        
        while($record=mysqli_fetch_assoc($query)){
            $temp=array();
            $host= gethostname();
            $ip = gethostbyname($host);
            $temp["messageId"]=$record["fldmessageid"];
            $temp["userId"]=$record["fldphoneno_sender"];
            //$temp["userName"]=$record["fldchatid"];
            $temp["userImgUrl"]="http://$ip/ama/account/avatars/".$record["fldphoneno_sender"].".jpg";
            $temp["toUserId"]=$record["fldphoneno_receiver"];
            //$temp["toUsernName"]=$record["fldchatid"];
            $temp["userAvatar"]="http://$ip/ama/account/avatars/".$record["fldphoneno_receiver"].".jpg";
            $temp["time"]=$record["fldtimestamp"];
            $temp["message"]=$record["fldmessage"];
            $temp["status"]=$record["fldstatus"];

            $statement="SELECT * FROM tblclients WHERE fldphoneno='$record[fldphoneno_receiver]' or fldphoneno='$record[fldphoneno_sender]'";
            $client_query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
            while($client=mysqli_fetch_assoc($client_query)){
                if($client["fldphoneno"]==$record["fldphoneno_receiver"]){
                    //$record["fldreceiver_username"]=$client["fldcompany"];
                    $temp["userName"]=$client["fldcompany"];
                }elseif($client["fldphoneno"]==$record["fldphoneno_sender"]){
                   // $record["fldsender_username"]=$client["fldcompany"];
                    $temp["toUserName"]=$client["fldcompany"];
                }
            }
            $array[]=$temp;
        }
        $messages["array"]=$array;
        echo json_encode($messages);
    }
?>