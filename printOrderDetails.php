<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = October 12, 2006             =
// Filename: printsoDetails.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Print Salesorder Details                    =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'soDetails';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/salesorderClass.php');
include('classes/soliClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newpage = new page;
$newsalesorder = new salesorder;
$soli = new soli;
$newdisplay = new display;
$newCustomer = new company;

$salesorderrecnum = $_REQUEST['salesorderrecnum'];
$userid = $_SESSION['user'];

$myQI = $soli->getQI($salesorderrecnum);
$result = $newsalesorder->getSalesorder($salesorderrecnum);
$myrow = mysql_fetch_assoc($result);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<html>
<head>
<title></title>
</head>
<?php
$title = 'Order Accpetance';
?>
<tr><td><font style="Arial" size=5 color="#000000"><center><b><A HREF="javascript:window.print()"><?php echo $title ?></A></b></center></td></tr>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr>
<td valign='top'>

<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=2 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td valign='top'>

<!-- Plot Nos 101 TO 104, KIADB Industrial Area, SEZ Aerospace Park, Devanahalli,(Near Bengaluru Airport) Bengaluru-562 110.  India -->
<?php
$createdby ='';
$createdby = explode("-", $myrow[9]) ;
?>
<table border=0 bgcolor="#FFFFFF" width=50% cellspacing=0 cellpadding=2 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="labeltext"><b>To,</b></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td width=323px><span class="labeltext"><b><?php echo $myrow['name']?></b></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="tabletext"><?php echo $myrow['addr1']?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="tabletext"><?php echo $myrow['addr2']?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="tabletext"><?php echo $myrow['city']. "- " .$myrow['zipcode']. ", " .$myrow['state']. "," .$myrow['country']?></td>
</tr>

<!-- <tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="tabletext"><left>IE Code: 0797004271, VAT: 29720060144.</td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="tabletext"><left>CST: 73176485</td>
</tr> -->
</table>
</td>
<td valign='top'>
<table border=0 bgcolor="#FFFFFF" width=50% cellspacing=0 cellpadding=2 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="labeltext"><b>&nbsp;</b></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="tabletext"><b>Your RefNo/PO No:</b> <?php echo $myrow['po_num']?></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td><span class="tabletext"><left><b>Po Date:</b> <?php echo $myrow['order_date']?></td>
</tr>


</table>

<tr>
<td colspan="2"><span class="tabletext">
Dear Sir<br/> 
We thank you for your order and are pleased to accept the same subject to terms and conditions as below:
</td>

<table width=100% border=1 cellspacing=0 cellpadding=4 rules="all">
<tr bordercolor=#777777>
<td align="center" width=25%><span class="tabletext"><b><center>Part Description/Drg No.</center></b></td>
<td align="center" width=25%><span class="tabletext"><b><center>Quantity</center></b></td>
<td align="center" width=25%><span class="tabletext"><b><center>Rate</center></b></td>
<td align="center" width=25%><span class="tabletext"><b><center>Amount</center></b></td>
<tr>
<?
$i=1;
$totgen_scrapwt = 0;

// $fgpart_wt = ($myrow1[13]+$myrow1[14])*$myrow1[18];

while ($rowQI = mysql_fetch_assoc($myQI))
{ 

  // echo "<pre>";
  // print_r($rowQI);
      
    
  // $remarks=wordwrap($myrow1[10],10,"<br/>\n",true);
      printf('<tr bgcolor="#FFFFFF">');
      echo "<td align=\"center\"><span class=\"tabletext\">
      $rowQI[partnum]</td>";
      echo "<td align=\"center\"><span class=\"tabletext\">
      $rowQI[qty]</td>";
      echo "<td align=\"center\"><span class=\"tabletext\">
      $rowQI[price]</td>";
      echo "<td align=\"center\"><span class=\"tabletext\">
      $rowQI[amount]</td>";
          printf('</tr>');
        $i++;
}

while($i<=5)
{

      printf('<tr bgcolor="#FFFFFF">');
      echo "<td align=\"center\"><span class=\"tabletext\">&nbsp;</td>";
      echo "<td align=\"center\"><span class=\"tabletext\">&nbsp;</td>";
      echo "<td align=\"center\"><span class=\"tabletext\">&nbsp;</td>";
      echo "<td align=\"center\"><span class=\"tabletext\">&nbsp;</td>";
          printf('</tr>');
          $i++;
}

 printf('</tr>');
?>
 </table>
 </td></tr>
 <tr>
<td colspan=2>
<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all >
<tr><td align='left'><span class="labeltext">
Terms and conditions<br><br>
Delivery: 4 Weeks from the confirmation of Purchase order receipt<br><br>
Payment terms:30 Days from the date of invoice<br><br>
Packing & Forwarding: NA<br><br>
Transport: NA<br><br>
Insurance: NA<br><br>
Consignee: HAL-RWRDC<br><br>
Destination: Bangalore<br><br>
Remarks: NA<br><br>
For Ripple Technologies, 
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>

 </td></tr>
 </table>
 </td></tr>
</table>
</td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
              <td bgcolor="#FFFFFF" colspan=4 border=none><span class="tabletext"><b>Authorized Signatory</b></td>
          </tr>

</table>        
<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr><td>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td colspan=2><span class="labeltext"><?php printf('%s',$myrow['formrev']);?></td>
            <td colspan=4><span class="labeltext"><?php printf('%s',$myrow[12]);?></td>
            <td colspan=14><span class="labeltext">FLUENTERP</td>
</tr>
</table>
</td>
</tr>
</table>
</FORM>
</td>
</tr>
</table>
</body>
</html>