<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: competitorsDetails.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// competitors Details                         =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'competitorsDetails';
$page = "CRM: Competitor";
//session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/competitorsClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newpage = new page;
$newdisplay = new display;
$newcompetitor = new competitor;
if (isset($_REQUEST['competitorrecnum']))
{
	$competitorrecnum=$_REQUEST['competitorrecnum'];
  }
  else if (isset($_SESSION['competitorrecnum']))
  {

}

$userid = $_SESSION['user'];
$result = $newcompetitor->getcompetitor($competitorrecnum);
$myrow = mysql_fetch_row($result);
$revenue=$myrow[2];
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/competitor.js"></script>

<html>
<head>
<title>Track Competitors Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
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
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td align="left"><span class="pageheading"><b>Track Competitors Details for <?php echo $myrow[1]?></b></td>
<td bgcolor="#FFFFFF" rowspan=2 align="right">
  <!-- <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="location.href='edit_leads.php?leadsrecnum=<?php echo $leadsrecnum ?>'" value="Edit Lead" > -->
  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onclick="location.href='edit_competitors.php?competitorrecnum=<?php echo $competitorrecnum ?>'" value="Edit Competitor">
      <!--   <a href ="edit_competitors.php?competitorrecnum=<?php echo $competitorrecnum ?>" ><img name="Image8" border="0" src="images/bu_editcompetitor.gif" ></a> -->
    <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onclick="javascript:printcompetitorsDetails(<?php echo $competitorrecnum ?>)" value="print">
        <!-- <input type= "image" src="images/bu-print.gif" onclick="javascript: printcompetitorsDetails(<?php echo $competitorrecnum ?>)"> -->
 </td>
</tr>
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>

    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Company Name</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[1]?></td>
            <td><span class="labeltext"><p align="left">Revenue </p></font></td>
            <td><span class="tabletext">$<?php printf('%.2f',$revenue); ?></td>
        </tr>
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Industry Segment</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[3]?></td>
             <td><span class="labeltext"><p align="left">Product</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[4]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[5]?></td>
             <td><span class="labeltext"><p align="left">Email </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[6]?></td>
        </tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">GUID</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[8]?></td>
     </tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Notes</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[7]?></td>
     </tr>
  <tr bgcolor="#EEEEEE"><td colspan=4><span class="heading"><center><b>Address</b></center></td></tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Address1</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[9]?></td>
            <td><span class="labeltext"><p align="left">Address2</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[10]?></td>
     </tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">City</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[11]?></td>
            <td><span class="labeltext"><p align="left">State</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[12]?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Zip</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[13]?></td>
            <td><span class="labeltext"><p align="left">Country</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[14]?></td>
    </tr>
</table>

    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

        <tr>
       </tr>
        </table>
</td>
	<!-- 	<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->

		</table>

      </FORM>

</table>

</body>
</html>