<?php
require "inc/config.php";


$bquery = mysqli_query($mysqli,"select m.* FROM members m JOIN plans AS p ON m.email = p.email  WHERE p.exp_date < DATE(NOW()) AND p.status = 'waiting_withdrawal' ");
while($erow = mysqli_fetch_array($bquery)){
$name = ucwords($erow['name']);
$email = $erow['email'];
//sending email
$query = mysqli_query ($mysqli, "SELECT * FROM plans AS p WHERE p.exp_date < DATE(NOW()) AND p.status = 'waiting_withdrawal' AND NOT EXISTS(SELECT *
  FROM sent_mails AS e WHERE p.email = e.email AND p.exp_date = e.exp_date AND p.plan = e.plan) AND p.email='$email' " );

$count = mysqli_num_rows($query($query));

if($count > 0){

$to      = $email;
$from = 'info@app.gapp.ng'; 
$fromName = 'Ganado Farm'; 
 
$subject = "Payment awaiting withdrawal.";

$htmlContent .= '
<html> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
          <title>Payment awaiting withdrawal</title> 
         <style type="text/css">
          .table_view {
width: 100%;
font-size:12px;
font-family:"Lucida Grande", "Lucida Sans Unicode", Arial, Helvetica, sans-serif;
border-collapse:collapse;
border:none;
color: #336699;
}
.table_view thead th {
font-size:14px;
background: #666666;
font-family:"Lucida Grande", "Lucida Sans Unicode", Arial, Helvetica, sans-serif;
padding:5px;
color: #00CCCC;
text-transform:  capitalize;
white-space: nowrap;
}
.table_view th:last-child{
  width:100%;
}



table_view > tbody > tr:nth-child(odd)
{
 background: #b3e5fc;
}

table_view > tbody > tr:nth-child(even)
{
 background: #e1f5fe;
}


.table_view > tbody > tr > td {
font-size:12px;
white-space: nowrap;
font-family:"Lucida Grande", "Lucida Sans Unicode", Arial, Helvetica, sans-serif;
}

          </style>

    </head> 
    <body> 
<p>Hello ' .$name. '</p>
<p>Please find below all payment awaiting withdrawal. </p>


<table class="table_view"  cellspacing="0" cellpadding="0" border="0">
<thead>
<th>Farm Plan</th>
<th>Duration</th>
<th>Invested Amt</th>
<th>Interest Rate</th>
<th>Total Interest Returns</th>
<th>Total Returns</th>
</thead>
<tbody>
';

    
    while($order = mysqli_fetch_array($query))
        {    
             
        $htmlContent .= "<tr>
        
        <td >".$order['plan']."</td>
        <td>".$order['duration']."</td>
        <td >".number_format($order['amount_invested'])."</td>
        <td >".$order['interest']."</td>
        <td>".number_format($order['totInterest'])."</td>
         <td>".number_format($order['Amt_to_get'])."</td>
        
      </tr>";

      mysqli_query($mysqli,"insert into sent_mails(email,plan,exp_date)values('".$order['email']."','".$order['plan']."','".$order['exp_date']."' )") or die(mysqli_error($mysqli));
    }

$htmlContent .= '</tbody></<table>
<p></p>
<p>To withdraw please use our your app.</p>
<p></p>
<p></p>
<p>Thank you.</p>
<p></p>
<p></p>
<p></p>
<p>Ganado Farm Team.</p>
</body> 
    </html>';


// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 


$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail($to, $subject, $htmlContent, $headers,'-finfo@app.gapp.ng');
    
   }
    
}
?>