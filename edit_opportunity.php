<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 12, 2006                =
// Filename: edit_opportunity.php              =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows editing of Opportunity               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

if (!isset($_SESSION['userrole']))
{
     header ( "Location: login.php" );
}

if (isset($_REQUEST['opportunityrecnum']))
{
	$opportunityrecnum=$_REQUEST['opportunityrecnum'];
  }
else
{
          header ( "Location: login.php" );
}
if ($_SESSION['userrole'] == 'SU'|| $_SESSION['userrole'] == 'SALES')
{
    $_SESSION['pagename'] = 'editopportunity';
}
else
{
    $_SESSION['pagename'] = 'editopportunity';
}
$page = "CRM: Opportunity";
//session_register('pagename');


// First include the class definition
//include('classes/companyClass.php');

include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/opportunityClass.php');
include('classes/quoteliClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');
include('classes/leadsClass.php');

$newdisplay = new display;
$newlogin = new userlogin;
$newlogin->dbconnect();

$newpage = new page;
$newopportunity = new opportunity;
$newdisplay = new display;
$newCustomer = new company;

$result = $newopportunity->getOpp($opportunityrecnum);
$myrow = mysql_fetch_assoc($result);

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/opportunity.js"></script>

<html>
<head>
<title>Edit Opportunity</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='processOpportunity.php' method='post'>
<?php
	include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        		<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        		<td align="right">&nbsp;
       			<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        	    </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0   >
    <tr><td></td></tr>
	<tr>
	  <td>
<?php
  $newdisplay->dispLinks('');
?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
  <tr bgcolor="DEDFDE">
  	<td width="6"><img src="images/spacer.gif " width="6"></td> -->
	<td bgcolor="#FFFFFF">
		<table width=100% border=0 cellpadding=6 cellspacing=0  >
		<tr><td>
		 <table width=100% border=0>

<td><span class="pageheading"><b>Edit Opportunity</b></td>
<td colspan=20>&nbsp;</td>
	<!-- <td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
	</td> -->
         </table>
	</td></tr>
   <tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% >
    <tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
    </tr>
<table width=100% border=0 cellpadding=1 cellspacing=1 bgcolor="DEDFDE" class="stdtable1" >
    <tr bgcolor="#FFFFFF" >
    <input type="hidden" name="link2lead" value="<?php echo $myrow['link2lead']?>">
    <input type="hidden" name="proposal_date" value="<?php echo $myrow['proposal_date']?>">
    <input type="hidden" name="negotiate_date" value="<?php echo $myrow['negotiate_date']?>">
    <td><span class="labeltext"><p align="left">Opportunity Name</p></font></td>
    <td><span class="labeltext"><input type="text" name="opp_name" size=20  value="<?php echo $myrow["opp_name"]?>"></td>
    <td><span class="labeltext"><p align="left">Account Name</p></font></td>
    <td colspan=2><span class="labeltext"><input type="text" name="acc_name" size=20  value="<?php echo $myrow["acc_name"]?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF" >
    <td><span class="labeltext"><p align="left">Lead Name</p></font></td>
    <td><span class="labeltext"><input type="text" name="leadname" size=20 style="background-color:#DDDDDD;"
         readonly="readonly" value="<?php echo $myrow["leadsnum"]?>"></td>
    <td><span class="labeltext"><p align="left">Lead Source</p></font></td>
    <td colspan=2><span class="labeltext"><input type="text" name="leadsnum" size=20 style="background-color:#DDDDDD;"
         readonly="readonly"  value="<?php echo $myrow["lead_source"]?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
     <td><span class="labeltext"><p align="left">Create Date</p></font></td>
    <td ><input type="text" name="create_date"
        style="background-color:#DDDDDD;"
        readonly="readonly" size=20 value="<?php echo $myrow["create_date"]?>">
              </td>
    <td><span class="labeltext"><p align="left">Expected close date</p></font></td>
    <td><input type="text" name="expected_close_date"
         style="background-color:#DDDDDD;"
         readonly="readonly" size=20 value="<?php echo $myrow["expected_close_date"]?>">
         <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('expected_close_date')">
   
    
    <tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">Sales Stage</p></font></td>
    <td><span class="labeltext"><input type="text" name="sales_stage" size="15" id="sales_stage" value="<?php echo $myrow["sales_stage"]?>">
    <span class="tabletext"><select name="sales_stage1" id="sales_stage1" size="1" width="100" onchange="onSelectSalesstage()">
       	 <option value='Select'>Select</option>
         <option value='Needs Analysis|110'>Needs Analysis </option>
         <option value='Value Proposition|120'>Value Proposition </option>
         <option value='Perception Analysis|130'>Perception Analysis</option>
         <option value='Proposal/Quote|140'>Proposal/Quote </option>
         <option value='Negotiation|150'>Negotiation </option>
         <option value='Closed Won|160'>Closed Won </option>
         <option value='Closed cost|170'>Closed cost </option>
         </select>
         <input type="hidden" name="opp_stagenum" id="opp_stagenum" value="<?php echo $myrow['opp_stagenum'] ?>">
		 </td>
    <td><span class="labeltext"><p align="left">Type</p></font></td>
    <td colspan=2><span class="labeltext"><input type="text" name="type" size="15" value="<?php echo $myrow["type"]?>">
    <span class="tabletext"><select name="type1" size="1" width="100" onchange="onSelectType()" >
        <option selected>Existing Business </option>
    	<option value>New Business </option>
        </select>
        </tr>
        <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">Proposal Date</p></font></td>
    <td ><input type="text" name="proposal_date"
        style="background-color:#DDDDDD;"
        readonly="readonly" size=20 value="<?php echo $myrow["proposal_date"]?>">
              </td>
               <td><span class="labeltext"><p align="left">Negotiation Date</p></font></td>
        <td ><input type="text" name="negotiate_date"
        style="background-color:#DDDDDD;"
        readonly="readonly" size=20 value="<?php echo $myrow["negotiate_date"]?>">
              </td>
    </tr>
        <tr bgcolor="#FFFFFF" >
        <td><span class="labeltext"><p align="left">Amount & Currency</p></font></td>
    <td><span class="labeltext"><input type="text" name="amount_currency" size=20  value="<?php echo $myrow["amount_currency"]?>"><span class="labeltext"><input type="text" name="currency" size="1" value="<?php echo $myrow["currency"] ?>">
    <span class="labeltext"><select name="currency1" size="1" width="1" onchange="onSelectcurrency()">
            <option selected>$ </option>
    		<option value>Rs </option>
    		 </select>
             </td>
             <td><span class="labeltext"><p align="left">Assigned to</p></font></td>
    <td><span class="labeltext"><input type="text" name="assigned_to" size=20  value="<?php echo $myrow["assigned_to"]?>"></td>
    
             </tr>
    <tr bgcolor="#FFFFFF" >
    <td><span class="labeltext"><p align="left">Probability Percentage</p></font></td>
    <td ><span class="labeltext"><input type="text" name="probability" size=20  value="<?php echo $myrow["probability"]?>"></td>
     <td><span class="labeltext"><p align="left">Next Step</p></font></td>
    <td ><input type="text" name="next_step" size=20 value="<?php echo $myrow["next_step"]?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"  >
    <td><span class="labeltext">Sales Note</font></td>
        <td colspan=4><textarea name="link2salesnotes" rows="4" cols=45% value=""><?php echo  $myrow["link2salesnotes"];?></textarea>
    </tr>
    </table>
    </table>
<!--     <td width="6"><img src="images/spacer.gif " width="6"></td>
      <tr bgcolor="DEDFDE">
  		<td width="6"><img src="images/box-left-bottom.gif"></td>
	    	<td><img src="images/spacer.gif " height="6"></td>
			<td width="6"><img src="images/box-right-bottom.gif"></td>
				</tr> -->
		</table>
    <table border = 0 cellpadding=0 cellspacing=0 width=100%>
                <tr>
					<td align=left> </td>
				</tr>
	 </table>
	 <input type="hidden" name="deleteflag" value="">
	 <input type="hidden" name="opportunityrecnum" value="<?php echo $opportunityrecnum; ?>">
        <span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields1()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
</FORM>
</body>
</html>