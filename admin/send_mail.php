<?php 
require_once('../includes/functions.php');

if($_POST){

$addr = $_POST['email'];
$emailist = explode(";",$addr);

try
    {

        //-------------------log email invite into db-------------------
foreach ($emailist AS $addy) {
    $title = $_POST['subject'];
    $body = $_POST['body'];
    
   $stmt = $db_con->prepare("INSERT INTO emailinvite_log(sentto_addresses,title,body)VALUES(:onum, :ttle, :same )");
   $stmt->bindParam(":onum", $addy);
   $stmt->bindParam(":ttle", $title);
   $stmt->bindParam(":same", $body);

   
   if($stmt->execute() && Send_Email($body,$addy,$title))
   {
     echo  "sm";    
   }
   else  if($stmt->execute() && !Send_Email($body,$addy,$title))
   {
     echo  "db";
   }
   else
   {
       echo "Query could not execute !";
   }
     }
		
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }








}
									
																								
?>

												
												
												
												
												
												



													

