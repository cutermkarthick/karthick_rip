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
$myrow = mysql_fetch_row($result);
?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>
  <body>
<table width=100% border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Sales Order Details</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=5>
   <tr><td>&nbsp; </td> </tr>
</table>

    <table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=5>
     <tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Sales Order Details</b></center></td></tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Cust PO</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[16]?></td>
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
             <td ><span class="tabletext"><?php echo $myrow[1]?></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Description</font></td>
            <td><span class="tabletext"><?php echo $myrow[3]?></td>
            <td><span class="labeltext">Contract Review Ref No.</td>
            <td ><span class="tabletext"><?php echo $myrow[42] ?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Date</font></td>
            <td><span class="tabletext">
            <?php
	      if($myrow[5] != '0000-00-00' && $myrow[5] != '' && $myrow[5] != 'NULL')
          {
              $datearr = split('-', $myrow[5]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $date=date("M j, Y",$x);
            //$date=date("F jS Y",$x);
             echo "$date";
		  }
		  else
		  {
			  echo "";
		  }
	      if($myrow[46] != '0000-00-00' && $myrow[46] != '' && $myrow[46] != 'NULL')
          {
              $datearr = split('-', $myrow[46]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $amenddate=date("M j, Y",$x);
		  }
		  else
		  {
                      $amenddate="";
		  }
            ?>
            </td>
            <td><span class="labeltext">Order/Quote Ref</font></td>
            <td><span class="tabletext"><?php echo $myrow[39] ?></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext">Amendment No.</td>
            <td><span class="tabletext"><?php echo $myrow[45] ?></td>
            <td><span class="labeltext">Amendment Date</td>
            <td><span class="tabletext"><?php echo $amenddate ?></td>
        </tr>
        </table>
        <table border=1 bgcolor="#DFDEDF"  width=100% cellspacing=1 cellpadding=5>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="heading"><p align="left"><b>Special Instruction</b></p></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="tabletext"><pre><?php echo $myrow[7] ?></pre></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Contact Information</b></center></td>
        </tr>
      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Contact</p></font></td>
            <td colspan=3><span class="tabletext"><p align="left"><?php echo $myrow[37] ?></td>
            </td>
      </tr>
        <tr bgcolor="#FFFFFF">

          <td><span class="labeltext"><p align="left">Email</p></font></td>
          <td><span class="tabletext"><p align="left"><?php echo $myrow[29]?></td>
          <td><span class="labeltext"><p align="left">Phone</p></font></td>
          <td><span class="tabletext"><p align="left"><?php echo $myrow[38]?></td>
       </tr>


</table>


<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#DDDEDD">
<td colspan=24><span class="heading"><center><b>Line Items</b></center></td>
</tr>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b><center>Item No.</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>PRN No.</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Part Name</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Part Num</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>RM Type</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>RM Spec</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Condition</center></b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>UOM</center></b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Dia</center></b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Length</center></b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Width</center></b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Thick</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Grain Flow</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Max Ruling</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Alt Spec</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Drg Iss</center></b></td>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Drg Iss</center></b></td>-->
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Iss/Attach</center></b></td>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Part Iss/Attach</center></b></td> -->
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>PO Cos</center></b></td>-->
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Cos</center></b></td>-->
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Cos Iss/Attach</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Model Issue</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Qty</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Unit Price</center></b></td>
<td bgcolor="#EEEFEE" width=9%><span class="heading"><b><center>Amount</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>RM Unit Price</center></b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b><center>RM Amount</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>M/C Unit Price</center></b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b><center>M/C Amount</center></b></td>
</tr>
<?php
 $i = 1;
      while ($QI = mysql_fetch_row($myQI))
      {
	printf('<tr bgcolor="#FFFFFF">');
	$line_num = $QI[0];
	$qty = $QI[2];
	$item_desc = $QI[1];
    $partnum = $QI[6];
    $rmtype = $QI[7];
    $rmspec = wordwrap($QI[8],15,"<br />\n");
    //$rmspec = $QI[8];
    //$partiss = $QI[9];
    $partiss = wordwrap($QI[9],15,"<br />\n");
   // $hcpartiss = $QI[16];
    $po_cos = $QI[15];
  //  $hc_cos = $QI[18];
    $model_iss = $QI[16];
    $cosiss = $QI[25];
    $drgiss = $QI[10];
  //  $hcdrgiss = $QI[15];
	$price = $QI[3];
	$amount = $QI[4];
	$rmprice = $QI[11];
	$rmamount = $QI[12];
	$mcprice = $QI[13];
	$mcamount = $QI[14];
    $uom = $QI[17];
    $dia = $QI[18];
    $length = $QI[19];
    $width = $QI[20];
    $thickness = $QI[21];
    $gf = $QI[22];
    $maxruling = $QI[23];
    $altspec = $QI[24];
    $crnnum = $QI[26];
    $cond = wordwrap($QI[27],15,"<br />\n");

	echo "<td align=\"center\"><span class=\"tabletext\">$line_num</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$crnnum</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$item_desc</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$partnum</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$rmtype</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$rmspec</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$cond</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$uom</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$dia</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$length</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$width</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$thickness</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$gf</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$maxruling</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$altspec</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$drgiss</td>";
   // echo "<td align=\"center\"><span class=\"tabletext\">$hcdrgiss</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$partiss</td>";
   // echo "<td align=\"center\"><span class=\"tabletext\">$hcpartiss</td>";
   // echo "<td align=\"center\"><span class=\"tabletext\">$po_cos</td>";
   // echo "<td align=\"center\"><span class=\"tabletext\">$hc_cos</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$cosiss</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$model_iss</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$qty</td>";
	printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[30],$price);
	printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[30],$amount);
	printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[30],$rmprice);
	printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[30],$rmamount);
	printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[30],$mcprice);
	printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[30],$mcamount);
	printf('</tr>');

	printf('</tr>');
	$i++;
	?>
 <?php
    }

?>
<tr bgcolor="#EEEFEE">
            <td colspan=21><span class="labeltext"><p align="right">Total</p></font></td>
            <td align="right"><span class="labeltext">
            <?php

            	printf('%s%.2f</td>',$myrow[30],$myrow[17]);

            ?>
            <td>&nbsp</td>
            <td align="right"><span class="labeltext">
            <?php

            	printf('%s%.2f</td>',$myrow[30],$myrow[43]);

            ?>
            <td>&nbsp</td>
            <td align="right"><span class="labeltext">
            <?php

            	printf('%s%.2f</td>',$myrow[30],$myrow[44]);

            ?>

        </tr>


        </tr>
    </table>
    <table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td colspan=2><span class="labeltext"><?php echo $myrow[49]." ".$myrow[50] ?></td>
            <td colspan=2>&nbsp;</td>
        </tr>

</table>
    </table>

</body>
</html>
