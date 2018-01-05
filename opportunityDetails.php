<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 12, 2006                =
// Filename: opportunityDetails.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Opportunity Details                         =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'opportunityDetails';
$page = "CRM: Opportunity";
//session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/opportunityClass.php');
include('classes/displayClass.php');
include('classes/leadsClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newopportunity = new opportunity;
$newdisplay = new display;

if (isset($_REQUEST['opportunityrecnum']))
{
	$opportunityrecnum=$_REQUEST['opportunityrecnum'];
  }
  else if (isset($_SESSION['opportunityrecnum']))
  {

}
$userid = $_SESSION['user'];
$result = $newopportunity->getOpp($opportunityrecnum);
$myrow = mysql_fetch_assoc($result);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/quote.js"></script>
<script language="javascript" src="scripts/opportunity.js"></script>

<html>
<head>
<title>Opportunity Deatails</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td> -->
<?php
   // $newdisplay->dispLinks('');
   $newopportunity->UpdNotes($opportunityrecnum,'opportunityDetails');
 ?>
<!-- </td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>

<td><span class="pageheading"><b>Opportunity Details</b><td colspan=50>&nbsp;</td>
 <td bgcolor="#FFFFFF" rowspan=2 align="right">
  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="location.href='edit_opportunity.php?opportunityrecnum=<?php echo $opportunityrecnum ?>'" value="Edit Opportunity" >
  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="location.href='addNotes4opportunity.php?opportunityrecnum=<?php echo $opportunityrecnum ?>'" value="Add Notes" >
  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="javascript: printopportunityDetails(<?php echo $opportunityrecnum ?>)" value="Print" >
       <!--  <a href ="edit_opportunity.php?opportunityrecnum=<?php echo $opportunityrecnum ?>" ><img name="Image8" border="0" src="images/eo.gif" ></a>
        <a href ="addNotes4opportunity.php?opportunityrecnum=<?php echo $opportunityrecnum ?>" ><img name="Image88" border="0" src="images/bu_addnotes.gif" ></a>
        <input type= "image" src="images/bu-print.gif" onclick="javascript: printopportunityDetails(<?php echo $opportunityrecnum ?>)"> -->
 </td>

  </tr>
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Opportunity Name</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["opp_name"]?></td>
             <td><span class="labeltext"><p align="left">Account Name </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["acc_name"]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Lead Name</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["leadsnum"]?></td>
             <td><span class="labeltext"><p align="left">Lead Source </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["lead_source"]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Expected Close Date</p></font></td>
            <td ><span class="tabletext">
             <?php
            $d=substr($myrow["expected_close_date"],8,2);
            $m=substr($myrow["expected_close_date"],5,2);
            $y=substr($myrow["expected_close_date"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
            echo "$date";
            ?>
            </td>

            <td><span class="labeltext"><p align="left">Create Date</p></font></td>
            <td ><span class="tabletext">

            <?php
            $d=substr($myrow["create_date"],8,2);
            $m=substr($myrow["create_date"],5,2);
            $y=substr($myrow["create_date"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
            echo "$date";
            ?>
            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Sales Stage</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["sales_stage"]?></td>
             <td><span class="labeltext"><p align="left">Type </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["type"]?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Proposal Date</p></font></td>
            <td ><span class="tabletext">
             <?php
            $d=substr($myrow["proposal_date"],8,2);
            $m=substr($myrow["proposal_date"],5,2);
            $y=substr($myrow["proposal_date"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
            echo "$date";
            ?>
            </td>

            <td><span class="labeltext"><p align="left">Negotiation Date</p></font></td>
            <td ><span class="tabletext">

            <?php
            $d=substr($myrow["negotiate_date"],8,2);
            $m=substr($myrow["negotiate_date"],5,2);
            $y=substr($myrow["negotiate_date"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
            echo "$date";
            ?>
            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            
             <td><span class="labeltext"><p align="left">Amount & Currency </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["currency"] .' '. $myrow["amount_currency"]?></td>
             <td><span class="labeltext"><p align="left">Assigned to</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["assigned_to"]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
           
             <td><span class="labeltext"><p align="left">Probability Percentage </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["probability"]?></td>
            <td><span class="labeltext"><p align="left">Next Step</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow["next_step"]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Sales Notes</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow["link2salesnotes"]?></td>
        </tr>

         <?php
            printf('<tr  bgcolor="#DDDEDD"><td colspan=8><span class="heading"><center><b>Engineering Notes</b></center></td></tr>');
            $result = $newopportunity->getNotes($opportunityrecnum);
            printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes" rows="6" cols="89">');
            while ($mynotes = mysql_fetch_row($result)) {
                  printf("\n");
                  printf("********Added by $mynotes[2] on $mynotes[0]*******");
                  printf("\n");
                  printf($mynotes[1]);
                  printf("   \n");
            }

            ?>
            </textarea></td>
            </tr>

 </table>

    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

        <tr>
       </tr>
        </table>
</td>
	<!-- 			<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->
		</table>
      </FORM>
</table> <!--
     <?php
          $todayis = date("l, F j, Y, g:i a") ;
      ?>
      <span class="labeltext"><p align="center">
      Date: <?php echo $todayis ?>
      <br />
      Thank You : -->
</body>
</html>