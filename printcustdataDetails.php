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

$_SESSION['pagename'] = 'custdatadetails';
//////session_register('pagename');

// First include the class definition

include('classes/custdataClass.php');
include('classes/custdataliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newcustdata = new custdata;
$newLI = new custdatali;
$newdisplay = new display;

$custdatarecnum = $_REQUEST['custdatarecnum'];

$myQI = $newLI->getcustdatali($custdatarecnum);
$result = $newcustdata->getcustdata($custdatarecnum);
$myrow = mysql_fetch_assoc($result);

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Data Validation of Customer supplied model</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Data Validation Details</b></center></td></tr>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
 <tr bgcolor="#FFFFFF"></tr>
         <?php
            $d=substr($myrow["Date"],8,2);
            $m=substr($myrow["Date"],5,2);
            $y=substr($myrow["Date"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";
          ?>
        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Part Number</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["partnum"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Customer Ref No.</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["cust_ref_num"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["partname"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Customer Rev No.</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["cust_rev_num"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Supplied Model Format</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["sup_mod_format"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Translated To</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["translated_to"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="heading"><b>Note:</b></td>
            <td colspan=3><?php echo $myrow["note"] ?></td>

        </tr>
        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Approved By</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["approved_by"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Approved By</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["prepared_by"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Issue</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["Issue"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Date</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["Date"] ?></td>
        </tr>


</table>
 <br>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Line Items</b></center></td>
</tr>

<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
  <td bgcolor="#EEEFEE" rowspan=3><span class="heading"><b><center>Ref No.</center></b></td>
  <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>Point Co-ordinates as given</center></b></td>
  <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>Measured Co-ordinates</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=3><span class="heading"><b><center>Remarks/<br>Deviation</center></b></td>
<tr>
<tr>

  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>X-Value</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Y-Value</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Z-Value</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>X-Value</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Y-Value</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Z-Value</center></b></td>

</tr>
<?php
    $i = 1;
      $myQI = $newLI->getcustdatali($custdatarecnum);
      while ($QI = mysql_fetch_assoc($myQI))
      {
	printf('<tr bgcolor="#FFFFFF">');
	$refnum = $QI["refnum"];
	$px = $QI["px"];
	$py = $QI["py"];
    $pz = $QI["pz"];
    $mx = $QI["mx"];
    $my = $QI["my"];
    $mz = $QI["mz"];
    $remarks = $QI["remarks"];

	echo "<td align=\"center\"><span class=\"tabletext\">$refnum</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$px</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$py</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$pz</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$mx</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$my</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$mz</td>";
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
