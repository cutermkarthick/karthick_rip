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

$_SESSION['pagename'] = 'qualityplanDetails';
//////session_register('pagename');

// First include the class definition

include('classes/qualityplanClass.php');
include('classes/qualityplanliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newqualityplan = new qualityplan;
$newLI = new qualityplanli;
$newdisplay = new display;

$qualityplanrecnum = $_REQUEST['qualityplanrecnum'];

$myQI = $newLI->getQualityplanli($qualityplanrecnum);
$result = $newqualityplan->getQualityplan($qualityplanrecnum);
$myrow = mysql_fetch_assoc($result);

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/qualityplan.js"></script>

<html>
<head>
<title>Quality Plan Details</title>
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
<td><span class="pageheading"><b>Quality Plan Details</b><td colspan=250></td>
    <td bgcolor="#FFFFFF" rowspan=2 align="right">
          <a href ="edit_qualityplan.php?qualityplanrecnum=<?php echo $qualityplanrecnum ?>" ><img name="Image8" border="0" src="images/bu_editqualityplan.gif" ></a>
          <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript: printqualityplan(<?php echo $qualityplanrecnum ?>)">
</td>
  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Quality Plan Details</b></center></td></tr>


 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
 <tr bgcolor="#FFFFFF"></tr>
         <?php
            $d=substr($myrow["revdate"],8,2);
            $m=substr($myrow["revdate"],5,2);
            $y=substr($myrow["revdate"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";
          ?>
        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Opn.Ref.No</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["opnrefno"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Operation No</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["operationnumber"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Part Number</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["partnumber"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Rev.No</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["revnumber"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["partname"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Rev.Date</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $date ?></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Attachments</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["attachments"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Drg Issue</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["drgissue"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Part Type</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["parttype"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Note</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["note"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Approved By</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["approvedby"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Prepared By</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["preparedby"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Issue No</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["issuesnumber"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Sheet</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["sheet"] ?></td>
        </tr>

</table>
 <br>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Sl.No.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Drawing Dimension</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Measuring Instrument</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Sample Size</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Remarks</center></b></td>
</tr>
<?php
 $i = 1;
      while ($QI = mysql_fetch_assoc($myQI))
      {
	printf('<tr bgcolor="#FFFFFF">');
	$sl_num = $QI["sl_num"];
	$drawing_dim = $QI["drawing_dim"];
	$measuring_istrument = $QI["measuring_istrument"];
    $samplesize = $QI["samplesize"];
    $remarks = $QI["remarks"];

	echo "<td align=\"left\"><span class=\"tabletext\">$sl_num</td>";
	echo "<td align=\"left\"><span class=\"tabletext\">$drawing_dim</td>";
	echo "<td align=\"left\"><span class=\"tabletext\">$measuring_istrument</td>";
	echo "<td align=\"left\"><span class=\"tabletext\">$samplesize</td>";
    echo "<td align=\"left\"><span class=\"tabletext\">$remarks</td>";
	printf('</tr>');
	printf('</tr>');
	$i++;
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
