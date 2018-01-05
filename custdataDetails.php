<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 20, 2007                 =
// Filename: qualityplanDetails.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Quality Plan Details                        =
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


$result = $newcustdata->getcustdata($custdatarecnum);
$myrow = mysql_fetch_assoc($result);

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/custdata.js"></script>

<html>
<head>
<title>Customer Data Validation Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
       <tr>
          <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
          <td align="right">&nbsp;
          <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
       </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>

<?php  $newdisplay->dispLinks(''); ?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>Customer Data Validation Details</b><td colspan=250></td>
    <td bgcolor="#FFFFFF" rowspan=2 align="right">
          <a href ="edit_custdata.php?custdatarecnum=<?php echo $custdatarecnum ?>" ><img name="Image8" border="0" src="images/bu_editdatamodel.gif" ></a>
          <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript: printcustdataDetails(<?php echo $custdatarecnum ?>)">
</td>
  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Customer Data Validation Details</b></center></td></tr>


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
            <td width=20%><span class="tabletext"><?php echo $date ?></td>
        </tr>


</table>
 <br>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Line Items</b></center></td>
</tr>

<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
  <td bgcolor="#EEEFEE" rowspan=3 width=3%><span class="heading"><b><center>Ref No.</center></b></td>
  <td bgcolor="#EEEFEE" colspan=3 width=45%><span class="heading"><b><center>Point Co-ordinates as given</center></b></td>
  <td bgcolor="#EEEFEE" colspan=3 width=45%><span class="heading"><b><center>Measured Co-ordinates</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=3 width=7%><span class="heading"><b><center>Remarks/<br>Deviation</center></b></td>
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



 </td>
		<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
		</table>
      </FORM>
</table>
</body>
</html>
