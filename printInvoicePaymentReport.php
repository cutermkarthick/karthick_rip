<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Jan 30 ,2007                 =
// Filename: printInvoicepaymentReport.php     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays Invoice Payment Report             =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');

// First include the class definition
include('classes/invoiceClass.php');
include('classes/invoiceliClass.php');
include('classes/displayClass.php');
$newinvoice = new invoice;
$newdisplay = new display;
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
<title></title>
</head>


<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Invoice Payment Report</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Serial #</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Company</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Payment Amount</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Payment Date</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Ref.#</b></td>
        </tr>

<?php
            $result = $newinvoice->getInvoicesPayment();
        while ($myrow = mysql_fetch_assoc($result)) {
            printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
                    $myrow["recnum"],$myrow["name"], $myrow["payment_amount"],$myrow["payment_date"],$myrow["ref_num"]);
          }

?>
</table>
</body>
</html>
