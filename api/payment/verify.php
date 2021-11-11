<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../functions.php");


require_once "../vendor/autoload.php";

  use Matscode\Paystack\Transaction;
  use Matscode\Paystack\Utility\Debug;

$secretKey = 'sk_test_ffc7333ca80038a2b9f3ccfabbb81d7168a95484';


$amount = $_POST['amount'];
$reference = $_POST['reference'];

// creating the transaction object
  $Transaction = new Transaction( $secretKey );

  // transaction can be verified by doing manual check on the response Obj
  
  $response = $Transaction->verify();
  Debug::print_r( $response);

 //update transaction details in 
$mysqli