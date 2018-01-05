<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 22, 2007                 =
// Filename: feedbackDetails.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Feedback Details                            =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'feedbackdetails';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/feedbackClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newfeedback = new feedback;
if (isset($_REQUEST['feedbackrecnum']))
{
	$feedbackrecnum=$_REQUEST['feedbackrecnum'];
  }
  else if (isset($_SESSION['feedbackrecnum']))
  {

}

$userid = $_SESSION['user'];
$result = $newfeedback->getFeedback($feedbackrecnum);
$myrow = mysql_fetch_assoc($result);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/feedback.js"></script>

<html>
<head>
<title>Track Competitors Details</title>
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
<?php    $newdisplay->dispLinks('');
 ?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td align="left"><span class="pageheading"><b>Feedback Details</b></td>
<td bgcolor="#FFFFFF" rowspan=2 align="right">
        <a href ="edit_feedback.php?feedbackrecnum=<?php echo $feedbackrecnum ?>" ><img name="Image8" border="0" src="images/bu_editfeedback.gif" ></a>
        <input type= "image" src="images/bu-print.gif" onclick="javascript: printfeedbackDetails(<?php echo $feedbackrecnum ?>)">
 </td>
</tr>
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
    <?php
            $d=substr($myrow["docdate"],8,2);
            $m=substr($myrow["docdate"],5,2);
            $y=substr($myrow["docdate"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";
          ?>
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PRN</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["crn"]?></td>
            <td><span class="labeltext"><p align="left">Reference No. </p></font></td>
            <td><span class="tabletext"><?php echo $myrow["refno"]?></td>
        </tr>
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Number</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["partnumber"]?></td>
             <td><span class="labeltext"><p align="left">Requested By</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["requestedby"]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["partname"]?></td>
             <td><span class="labeltext"><p align="left">Date </p></font></td>
            <td ><span class="tabletext"><?php echo $date?></td>
        </tr>
  <tr bgcolor="#EEEEEE"><td colspan=4><span class="heading"><center><b>Change Required in</b></center></td></tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Process</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["process"]?></td>
            <td><span class="labeltext"><p align="left">Program</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["program"]?></td>
     </tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Fixture</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["fixture"]?></td>
            <td><span class="labeltext"><p align="left">Tools</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["tools"]?></td>
    </tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Description</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow["description"]?></td>
     </tr>
</table>

    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

        <tr>
       </tr>
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
