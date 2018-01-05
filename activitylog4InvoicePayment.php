<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 28, 2006                 =
// Filename: activitylog4InvoicePayment.php    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// activitylog for Invoice Payment.php         =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];
$invoicerecnum = $_REQUEST['invoicerecnum'];
include('classes/userClass.php');
include('classes/invoiceClass.php');
$newuser = new user;
$newinvoice = new invoice;
?>

<html>
<head>
    <title>Activty Log for Invoice Payment</title>
</head>

<form>
<tr>
<td>

<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>
</td></tr><tr width=100% bgcolor="DEDEDF"><td><img width="5" src="images/spacer.gif" height="1">
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">

<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
                <td><span class="pageheading"><b>Activty Log for Invoice Payment</b></td>
</tr>

</tr>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Date</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Amout</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Ref Num</center></b></td>
</tr>

<?php
$result=$newinvoice->getInventory($invoicerecnum);
while ($myrow = mysql_fetch_assoc($result)) {

    $payment_date = $myrow["payment_date"];
    $payment_amount = $myrow["payment_amount"];
    $ref_num = $myrow["ref_num"];

	printf('<tr bgcolor="#FFFFFF">');
	echo "<td align=\"center\"><span class=\"tabletext\">$payment_date</td>";
	printf('<td align="right"><span class="tabletext">$%.2f</td>',$payment_amount);
    echo " <td><span class=\"tabletext\">$ref_num</td>";
	printf('</tr>');

?>





<?php
}
?>

</table>
</td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table>


</html>