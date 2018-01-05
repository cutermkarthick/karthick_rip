<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 8, 2006                  =
// Filename: printinvoiceDetails.php           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// print invoice Details                       =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'invoiceDetails';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/invoiceClass.php');
include('classes/invoiceliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newinvoice = new invoice;
$newLI = new invoiceli;
$newdisplay = new display;
$invoicerecnum = $_REQUEST['invoicerecnum'];
$myQI = $newLI->getInvoiceli($invoicerecnum);
$result = $newinvoice->getInvoice($invoicerecnum);
$myrow = mysql_fetch_assoc($result);
$result1 =$newinvoice->customeraddress($invoicerecnum);
$myrow1 = mysql_fetch_assoc($result1);
?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>


<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Invoice Details</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Invoice Details</b></center></td></tr>

<tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">Customer</p></font></td>
    <td colspan=2><span class="tabletext"><?php echo $myrow["name"] ?></td>
</tr>

   <td  bgcolor="#F5F6F5" width=50%><span class="heading"><center><b>Bill To</b></center></td>
   <td bgcolor="#F5F6F5" width=50%><span class="heading"><b><center>Ship To</center></b></td>

  <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
       <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext"><?php echo $myrow1["baddr1"] . "," . $myrow1["baddr2"]?></td>
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext"><?php echo $myrow1["saddr1"] . "," . $myrow1["saddr2"]?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext"><?php echo $myrow1["bcity"] . "," . $myrow1["bstate"] . "," . $myrow1["bzipcode"] ?></td>
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext"><?php echo $myrow1["scity"] . "," . $myrow1["sstate"] . "," . $myrow1["szipcode"]?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext"><?php echo $myrow1["bcountry"]?></td>
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext"><?php echo $myrow1["scountry"]?></td>
       </tr>

    </table>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
 <tr bgcolor="#FFFFFF"></tr>

         <?php
            $d=substr($myrow["invdate"],8,2);
            $m=substr($myrow["invdate"],5,2);
            $y=substr($myrow["invdate"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";
          ?>
        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Invoice Number</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["invnum"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Invoice Date</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $date ?></td>
        </tr>
            <?php
            $d=substr($myrow["duedate"],8,2);
            $m=substr($myrow["duedate"],5,2);
            $y=substr($myrow["duedate"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";
            ?>
            <?php
           if ($myrow["status"]=='')
                 $status='Partial Payment';
               else
                  $status= $myrow["status"];
           if ($myrow["totaldue"]==0)
               $due='Nill';
                else
               $due= $myrow["totaldue"];
           ?>
        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Terms</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["terms"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Due Date</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $date ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Customer PO No.</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["customerponum"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Ammount Due</p></font></td>
            <td width=20%><span class="tabletext">Rs <?php printf('%.2f',$due); ?></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Description</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["invdesc"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Status</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $status ?></td>
        </tr>
</table>
 <br>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Seq#</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Item ID</center></b></td>
<td bgcolor="#EEEFEE" width=30%><span class="heading"><b><center>Description</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Quantity</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>UM</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Disc%</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Price</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Amount</center></b></td>
</tr>
<?php
 $i = 1;
      while ($QI = mysql_fetch_assoc($myQI))
      {
	printf('<tr bgcolor="#FFFFFF">');
	$line_num = $QI["line_num"];
	$item_id = $QI["item_id"];
	$item_desc = $QI["item_desc"];
    $qty = $QI["qty"];
    $um = $QI["um"];
    $disc_perc = $QI["disc_perc"];
	$rate = $QI["rate"];
	$amount = $QI["amount"];

	echo "<td align=\"center\"><span class=\"tabletext\">$line_num</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$item_id</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$item_desc</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$qty</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$um</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$disc_perc</td>";
    printf('<td align="right"><span class="tabletext">Rs %.2f</td>',$rate);
	printf('<td align="right"><span class="tabletext">Rs %.2f</td>',$amount);
	printf('</tr>');
	printf('</tr>');
	$i++;
	?>
 <?php
    }

?>
</table>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr>
         <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
          <td align="right"><span class="pageheading"><b></b></td><td width="10.4%"></td></tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Subtotal</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            	printf('Rs %.2f',$myrow["subtotal"]);
            //printf('%s%.2f</td>',$myrow[30],$myrow[18]);
            // echo  "$myrow[21]"?>
        </tr>

       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Shipping Charges</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            	printf('Rs %.2f',$myrow["shipping"]);
           //printf('%s%.2f</td>',$myrow[30],$myrow[19]);
           // echo  "$myrow[21]"?>
        </tr>

      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Sales Tax</p></font></td>

           <td align="right"><span class="tabletext">
            <?php
            	printf('Rs %.2f',$myrow["salestax"]);
           //printf('%s%.2f</td>',$myrow[""],$myrow[""]);
           // echo  "$myrow[21]"?>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Total </p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            	printf('Rs %.2f',$myrow["total"]);
            //printf('%s%.2f</td>',$myrow[30],$myrow[21]); ?>
        </tr>

        </tr>
    </table>

</body>
</html>
