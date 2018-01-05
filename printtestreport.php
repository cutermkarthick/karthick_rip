<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 21, 2007                 =
// Filename: printqualityplanDetails.php       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// print Quality Plan Details                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'testreportdetails';
//////session_register('pagename');

// First include the class definition

include('classes/testreportClass.php');
include('classes/chemicalcompliClass.php');
include('classes/mechpropertiesliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newTR = new testreport;
$newCCLI = new chemicalcomp;
$newMPLI = new mechproperties;
$newdisplay = new display;

$trrecnum = $_REQUEST['trrecnum'];

$result = $newTR->gettestreport($trrecnum);
$myrow = mysql_fetch_assoc($result);


?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Test Report Details</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Test Report Details</b></center></td></tr>


 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
 <tr bgcolor="#FFFFFF"></tr>
         <?php

            $d=substr($myrow["inv_date"],8,2);
            $m=substr($myrow["inv_date"],5,2);
            $y=substr($myrow["inv_date"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date1=date("M j, Y",$x);

           // echo "$date";
          ?>

          <?php
            $d=substr($myrow["rm_receipt_date"],8,2);
            $m=substr($myrow["rm_receipt_date"],5,2);
            $y=substr($myrow["rm_receipt_date"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date2=date("M j, Y",$x);
           // echo "$date";
          ?>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Ref. No.</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["refno"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Part Number</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["partno"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Customer</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["customer"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["partname"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Customer Standard</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["cust_standard"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">RM Inv. No.</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["rm_inv_no"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Material Type</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["material_type"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Inv. Date</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $date1 ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Material Specification</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["material_spec"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Date of Receipt of RM</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $date2 ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">RM Supplier</p></font></td>
            <td width=20% colspan=3><span class="tabletext"><?php echo $myrow["rm_supplier"] ?></td>

        </tr>


</table>
 <br>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Chemical Composition Line Items</b></center></td>
</tr>

<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
  <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Line Num.</center></b></td>
  <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>% Chemical Composition as per Standards</center></b></td>
  <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b><center>% Chemical Composition as per RM Supplier</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Test Report by<br> Laboratory</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Remarks</center></b></td>
</tr>
<tr>

  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Constituents</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Min.</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Max.</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Min.</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Max.</center></b></td>
</tr>
<?php
  $i = 1;
      $myCCLI = $newCCLI->getLI($trrecnum);
      while ($CCLI = mysql_fetch_assoc($myCCLI))
      {
	printf('<tr bgcolor="#FFFFFF">');
	$lineno = $CCLI["lineno"];
	$constituents = $CCLI["constituents"];
	$standard_min = $CCLI["standard_min"];
	$standard_max = $CCLI["standard_max"];
    $supplier_min = $CCLI["supplier_min"];
    $supplier_max = $CCLI["supplier_max"];
    $report_lab = $CCLI["report_lab"];
    $remarks = $CCLI["remarks"];

    echo "<td align=\"center\"><span class=\"tabletext\">$lineno</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$constituents</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$standard_min</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$standard_max</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$supplier_min</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$supplier_max</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$report_lab</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$remarks</td>";

	printf('</tr>');
	printf('</tr>');
	$i++;
?>

<?php
   }

?>


</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Mechanical Properties Line Items</b></center></td>
</tr>

<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
 <tr bgcolor="#FFFFFF">
 <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Line Num.</center></b></td>
  <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>% Mechanical Properties as per Standards</center></b></td>
  <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b><center>% Mechanical Properties as per RM Supplier</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Test Report by<br> Laboratory</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Remarks</center></b></td>
</tr>
<tr>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Constituents</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Min.</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Max.</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Min.</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Max.</center></b></td>
 </tr>
<?php
    $j = 1;
      $myMPQI = $newMPLI->getLI($trrecnum);
      while ($MPQI = mysql_fetch_assoc($myMPQI))
      {
	printf('<tr bgcolor="#FFFFFF">');
	$lineno = $MPQI["lineno"];
	$constituents = $MPQI["constituents"];
	$standard_min = $MPQI["standard_min"];
	$standard_max = $MPQI["standard_max"];
    $supplier_min = $MPQI["supplier_min"];
    $supplier_max = $MPQI["supplier_max"];
    $report_lab = $MPQI["report_lab"];
    $remarks = $MPQI["remarks"];

    echo "<td align=\"center\"><span class=\"tabletext\">$lineno</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$constituents</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$standard_min</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$standard_max</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$supplier_min</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$supplier_max</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$report_lab</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$remarks</td>";

	printf('</tr>');
	printf('</tr>');
	$i++;
?>

<?php
    }

?>


</table>

</body>
</html>
