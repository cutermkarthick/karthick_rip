<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = October 12, 2006             =
// Filename: printquoteDetails.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Print Quote Detaols                         =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'quoteDetails';
//session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/quoteClass.php');
include('classes/quoteliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newQuote = new quote;
$quoteli = new quoteli;
$newdisplay = new display;

$quoterecnum =$_SESSION['quoterecnum'];
if ( !isset ( $quoterecnum ) )
{
     header ( "Location: login.php" );

}

$myQI = $quoteli->getQI($quoterecnum);
$result = $newQuote->getQuote($quoterecnum);
$myrow = mysql_fetch_row($result);

?>
<link rel="stylesheet" href="style.css">


 
<html>
<head>
<title></title>
</head>



<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Quotes</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>


 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Quote Header</b></center></td></tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Quote ID</p></font></td>
            <input type="hidden" name="salesperson"><td><span class="tabletext"><?php echo $myrow[0]?></td>
            <td><span class="labeltext"><p align="left">Terms</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[7]?></td>
             <input type="hidden" name="quoteid" value="<?php echo  $myrow[0]?>">
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[2]?></td>
             <td><span class="labeltext"><p align="left">Sales Person</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[12].' '.$myrow[13]?></td>
             <input type="hidden" name="companyrecnum" value="<?php echo  $myrow[17]?>">
             <input type="hidden" name="salespersonrecnum" value="<?php echo  $myrow[15]?>">
             <input type="hidden" name="quoterecnum" value="<?php echo  $quoterecnum?>">
             <input type="hidden" name="currency" value="<?php echo  $myrow[11]?>">
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Quote Description</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[3]?></td>

        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Quote Date</p></font></td>
            <td><span class="tabletext">
            <?php
            $d=substr($myrow[1],8,2);
            $m=substr($myrow[1],5,2);
            $y=substr($myrow[1],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
            echo "$date";
            ?>

            </td>
            <td><span class="labeltext"><p align="left">Delivery Date</p></font></td>
            <td><span class="tabletext">
             <?php
            $d=substr($myrow[6],8,2);
            $m=substr($myrow[6],5,2);
            $y=substr($myrow[6],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
            echo "$date";
            ?>

            </td>

        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RFQ ID</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[5]?></td>
           <td style='vertical-align: middle'><span class="labeltext"><p align="left">Excel File</td>
           <td><span class="tabletext"><?php echo $myrow[4]?>
           </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Comments</p></font></td>
            <td><span class="tabletext"><?php echo  $myrow[10]?></td>
            <td><span class="labeltext"><p align="left">BOM</p></font></td>
            <td><span class="tabletext"><?php echo  $myrow[22] ?></td>                
            
       </tr>


   </table>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Items</center></b></td>
<td bgcolor="#EEEFEE" width=30%><span class="heading"><b><center>Description</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Qty</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Unit Price</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Total</center></b></td>
</tr>
<?php
      $i = 1;
      while ($QI = mysql_fetch_row($myQI))
      {
	printf('<tr bgcolor="#FFFFFF">');

	$line_num="line_num" . $i;
	$item_desc="item_desc" . $i;
	$qty="qty" . $i;
	$price="price" . $i;
	$amount="amount" . $i;

	echo "<td align=\"center\"><span class=\"tabletext\">$QI[1]</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$QI[2]</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$QI[3]</td>";
    printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[11],$QI[4]);
	printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[11],$QI[5]);
	printf('</tr>');
	$i++;

?>
 <input type="hidden" name="<?php echo $line_num ?>" value="<?php echo  $QI[1]?>">
 <input type="hidden" name="<?php echo $qty ?>" value="<?php echo  $QI[3]?>">
 <input type="hidden" name="<?php echo $item_desc ?>" value="<?php echo  $QI[2]?>">
 <input type="hidden" name="<?php echo $price ?>" value="<?php echo  $QI[4]?>">
 <input type="hidden" name="<?php echo $amount ?>" value="<?php echo  $QI[5]?>">
<?php
    }
?>
 <tr>
  </tr>




       <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr>
         <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
          <td align="right"><span class="pageheading"><b></b></td><td width="14.5%"></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Gross Total</p></font></td>
            <td align="right"><span class="tabletext">
            <?php

             printf('%s %.2f</td>',$myrow[11],$myrow[16]);
               
            ?>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Tax</p></font></td>
            <td align="right"><span class="tabletext">
            <?php

             printf('%s %.2f</td>',$myrow[11],$myrow[18]);
               
            ?>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Labor</p></font></td>
            <td align="right"><span class="tabletext">
            <?php

             printf('%s %.2f</td>',$myrow[11],$myrow[20]);
               
            ?>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Shipping</p></font></td>
            <td align="right"><span class="tabletext">
            <?php

             printf('%s %.2f</td>',$myrow[11],$myrow[19]);
               
            ?>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Misc</p></font></td>
            <td align="right"><span class="tabletext">
            <?php

             printf('%s %.2f</td>',$myrow[11],$myrow[21]);
               
            ?>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Total Due</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
             $totaldue=$myrow[16]+$myrow[18]+$myrow[19]+$myrow[20]+$myrow[21];
             printf('%s %.2f</td>',$myrow[11],$totaldue);
               
            ?>
        </tr>





</table>
</body>
</html>
