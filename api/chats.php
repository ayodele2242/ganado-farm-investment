<?php
	include("connection.php");
    if(isset($_GET["phoneno"])){
        $chats=array();
        $phoneno=mysqli_real_escape_string($conn,$_GET["phoneno"]);
        $statement="SELECT DISTINCT fldphoneno_sender,fldphoneno_receiver FROM tblchats WHERE fldphoneno_sender='$phoneno' or fldphoneno_receiver='$phoneno'";
        $query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
        
        while($record=mysqli_fetch_assoc($query)){
            $temp=array();
            if($phoneno==$record["fldphoneno_receiver"]){
                $temp["phoneno"]=$record["fldphoneno_sender"];
            }else{
                $temp["phoneno"]=$record["fldphoneno_receiver"];
            }
            $host= gethostname();
            $ip = gethostbyname($host);
            $temp["avatar"]="http://$ip/ama/account/avatars/".$temp["phoneno"].".jpg";
            $statement="SELECT * FROM tblclients WHERE fldphoneno='$record[fldphoneno_receiver]' or fldphoneno='$record[fldphoneno_sender]'";
            $client_query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
            while($client=mysqli_fetch_assoc($client_query)){
                if($client["fldphoneno"]==$temp["phoneno"]){
                    $temp["company"]=$client["fldcompany"];
                    $temp["fullname"]="$client[fldfirstname] $client[fldlastname]";
                }
            }
            $chats[]=$temp;
        }
        $chats=(array)array_unique($chats, SORT_REGULAR);
        $chats=array_values($chats);
        echo json_encode($chats);
    }
?>