 <?php
    error_reporting(0);
    $principle = $_POST['principle'];
    $rate = $_POST['rate'];
    $time = $_POST['time'];
    
    
    if ($_POST['clear'])
    {
    $principle = "";
    $rate = "";
    $time = "";
    $display_results = "";
    }
    if ($_POST['compute']) 
    {
    $interest =($principle*$rate*$time)/100;
    $display_results = round($interest,2);
    }
    ?>
    <html>
    <style>
    body {
    font-family:arial;
    font-size:12;
    }
    </style>
    <title> Simple Interest Solver in PHP</title>
    <form action = "" method = "POST">
    <body>
    <h2> Simple Interest Solver in PHP </h2>
    <br>
    <table border = 3>
    <tr>
    <td> Principle Amount : </td>
    <td> <input type = text name = "principle" value = "<?php echo $principle;?>" size="10" autofocus>
    </tr>
    <tr>
    <td> Rate of Interest : </td>
    <td> <input type = text name = "rate" value = "<?php echo $rate;?>" size="5">
    </tr>
    <tr>
    <td> Time Period : </td>
    <td> <input type = text name = "time" value = "<?php echo $time;?>" size="10" >
    </tr>
    <tr>
    <td> &nbsp; </td>
    </tr>
    <tr>
    <td>Interest Rate Php </td>
    <td> <input type = text name = "solve_interest" value = "<?php echo $display_results;?>" size="12" readonly >
    </tr>
    <tr>
    <td> &nbsp; </td>
    </tr>
    <td colspan = 3>
    <input type = "submit" name="compute" value = "Compute Interest" title="Click here to compute for interest rate.">
    <input type = "submit" name="clear" value = "Clear" title="Click here to clear text boxes.">
    </td>
    </tr>
    </table>
    </form>
    </body>
    </html>
