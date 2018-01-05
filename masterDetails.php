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
$_SESSION['pagename'] = 'master_details';
//////session_register('pagename');

$masterrecnum = $_REQUEST['masterrecnum'];

include('classes/masterclass.php');
include('classes/masterliClass.php');
include('classes/displayClass.php');

$newdisplay = new display;
$newMA = new master;
$newLI = new master_line_items;

$result = $newMA->getmasterdetails($masterrecnum);
$myrow = mysql_fetch_assoc($result);
$myQI = $newLI->getLI($masterrecnum);

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/masterprocesssheet.js"></script>

<html>
<head>
<title>Master Process Sheet Details</title>
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
<td><span class="pageheading"><b>Master Process Sheet Details</b><td colspan=250></td>
    <td bgcolor="#FFFFFF" rowspan=2 align="right">
          <a href ="edit_master.php?masterrecnum=<?php echo $masterrecnum ?>" ><img name="Image8" border="0" src="images/bu_editmps.gif" ></a>
          <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript: printmaster(<?php echo $masterrecnum ?>)">
</td>
  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>

  <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
  
        <?php
            $d=substr($myrow['issue_date'],8,2);
            $m=substr($myrow['issue_date'],5,2);
            $y=substr($myrow['issue_date'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date1=date("M j, Y",$x);
           // echo "$date";
          ?>
          
          <?php
            $d=substr($myrow['revdate'],8,2);
            $m=substr($myrow['revdate'],5,2);
            $y=substr($myrow['revdate'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date2=date("M j, Y",$x);
           // echo "$date";
          ?>

       <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext">Reference No.</td>
            <td  bgcolor="#FFFFFF" width=25%><span class="tabletext"> <?php echo $myrow['refnum']?></td>
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext">Issue Date.</td>
            <td  bgcolor="#FFFFFF" width=25%><span class="tabletext"><?php echo $date1?></td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part Number</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['partnum']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Rev. No.</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['revnum']?></td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part Name</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['partname']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Rev. Date</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date2?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Attachments</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['attachments']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Drg. Issue</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['drg_issue']?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Customer</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['customer']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Project</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['project']?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Material Type</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['material_type']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Material Specification</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['material_sp']?></td>
       </tr>
      </table>

 <br>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Opn. No.</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Operation Description</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Work Center</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Opn. Reference No.</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Rev. No.</b></td>
       </tr>
<?php
 $i = 1;
      while ($QI = mysql_fetch_assoc($myQI))
      {
	printf('<tr bgcolor="#FFFFFF">');
	$opnnum = $QI["opnnum"];
	$opn_desc = $QI["opn_desc"];
	$work_center = $QI["work_center"];
    $opn_ref_no = $QI["opn_ref_no"];
    $revnum = $QI["revnum"];

	echo "<td align=\"left\"><span class=\"tabletext\">$opnnum</td>";
	echo "<td align=\"left\"><span class=\"tabletext\">$opn_desc</td>";
	echo "<td align=\"left\"><span class=\"tabletext\">$work_center</td>";
	echo "<td align=\"left\"><span class=\"tabletext\">$opn_ref_no</td>";
    echo "<td align=\"left\"><span class=\"tabletext\">$revnum</td>";
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
