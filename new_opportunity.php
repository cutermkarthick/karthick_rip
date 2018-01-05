<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 12, 2006                =
// Filename: new_opportunity.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new opportunity             =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

if (!isset($_SESSION['userrole']))
{
     header ( "Location: login.php" );
}

if ($_SESSION['userrole'] == 'SU'|| $_SESSION['userrole'] == 'SALES')
{
    $_SESSION['pagename'] = 'newopportunity';
}
else
{
    $_SESSION['pagename'] = 'newopportunity';
}
//session_register('pagename');
$dept = $_SESSION['department'];
$source=$_REQUEST['source'];
$leadname=$_REQUEST['name'];
$account=$_REQUEST['account'];
$leadnum=$_REQUEST['leadrecnum'];
//echo $leadnum; exit;
$page = "CRM: Opportunity";
// First include the class definition
//include('classes/companyClass.php');

include('classes/opportunityClass.php');
include('classes/displayClass.php');
$newopportunity = new opportunity;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/opportunity.js"></script>

<html>
<head>
<title>New Opportunity</title>
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
	<tr>
   	<td><span class="pageheading"><b>New Opportunity</b></td>
	</tr>
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
  <input type="hidden" name="link2lead" id="link2lead" value="<?php echo $leadnum?>">

    <input type="hidden" name="proposal_date" value="">
    <input type="hidden" name="negotiate_date" value="">
    <td><span class="labeltext"><p align="left">Opportunity Name</p></font></td>
    <td><span class="labeltext"><input type="text" name="opp_name" size=25  value=""></td>
    <td><span class="labeltext"><p align="left">Account Name</p></font></td>
    <?php if($account=='')
    {?>

    <td ><span class="labeltext"><input type="text" name="acc_name" 
    id="acc_name" size=25  style="background-color:#DDDDDD;"
                   readonly="readonly" value=""></td>

    <?php }
    else
      {?>
    <td ><span class="labeltext"><input type="text" name="acc_name" size=25 style="background-color:#DDDDDD;"
                   readonly="readonly" value="<?php echo $account ?>"></td>
    <?php } ?>
    </tr>
    <tr bgcolor="#FFFFFF" >
   
    <td><span class="labeltext"><p align="left">Lead Name</p></font></td>
<?php if($leadname=='')
{
?>
        <td ><span class="labeltext"><input type="text" name="leadname" id="leadname" size=25 style="background-color:#DDDDDD;"
                   readonly="readonly"  value="">
        <img src="images/bu-get.gif" alt="Get Lead" onclick="Getleads()"></td>
<?php
}
else
{
?>
    <td ><span class="labeltext"><input type="text" name="leadname" id="leadname" size=25 style="background-color:#DDDDDD;"
                   readonly="readonly" value="<?php echo $leadname ?>"></td>
<?php
}
?>
     <td><span class="labeltext"><p align="left">Lead Source</p></font></td>
    <td><span class="labeltext"><select name="lead_source" size="1" width="100">

<?php
$source_array=array('Cold Call','Existing Customer','Self Generated','Employee','Partner','Public Relations','Direct Mail','Conference','Trade Show','Web Site','Word of mouth','Email','Other');
for($j=0;$j<count($source_array);$j++)
{      

     if($source_array[$j] == $source)
     {
      ?>
            <option selected value="<? echo $source_array[$j]?>"><?echo $source_array[$j]; ?> 
            </option>
    <?
    }
    else
    {
    ?>
          <option value="<? echo $source_array[$j]?>"><?echo $source_array[$j]; ?> 
          </option>
      <?
      }
}
?>
</select>
</td>
                    

     </tr>
      <tr bgcolor="#FFFFFF">
        
        <td><span class="labeltext"><p align="left">Create Date</p></font></td>
        <td ><input type="text" name="create_date"
                   style="background-color:#DDDDDD;"
                   readonly="readonly" size=25 value="<?php echo date('Y-m-d') ?>">
                    <!-- <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('create_date')"> -->
         </td>
         <td><span class="labeltext"><p align="left">Expected close date</p></font></td>
        <td ><input type="text" name="expected_close_date"
                   style="background-color:#DDDDDD;"
                   readonly="readonly" size=25 value="">
                   <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('expected_close_date')">
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Sales Stage</p></font></td>
        <td><span class="labeltext"><input type="text" name="sales_stage" size="25" id="sales_stage" style="background-color:#DDDDDD;"
                   readonly="readonly" value="">
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
        <td ><span class="labeltext"><select name="type" size="1" width="100">
        			<option selected>Existing Business     </option>
        			<option value>New Business </option>
            		</select>
                    </tr>
        <tr bgcolor="#FFFFFF" >
       
       <td><span class="labeltext"><p align="left">Amount & Currency</p></font></td>
       <td><span class="labeltext"><input type="text" name="amount_currency" size=25  value="">
       <span class="labeltext"><select name="currency" size="1" width="100">
       				<option selected>$     </option>
       				<option value>Rs </option>
        			 </select></td>
               <td><span class="labeltext"><p align="left">Assigned to</p></font></td>
       <td ><span class="labeltext"><input type="text" name="assigned_to" id="assigned_to" size=25 style="background-color:#DDDDDD;"
                   readonly="readonly"  value="">
       <img src="images/bu-get.gif" alt="Get Lead" onclick="GetAllEmps()"></td></td>
                    </tr>
       <tr bgcolor="#FFFFFF" >
       
       <td><span class="labeltext"><p align="left">Probability Percentage</p></font></td>
       <td ><span class="labeltext"><input type="text" name="probability" size=25  value=""></td>
        <td ><span class="labeltext"><p align="left">Next Step</p></font></td>
       <td ><input type="text" name="next_step" size=25 value=""></td>
       </tr>
       <tr bgcolor="#FFFFFF">
      
       </tr>
       <tr bgcolor="#FFFFFF"  >
       <td><span class="labeltext">Sales Note</font></td>
       <td colspan=4><textarea name="link2salesnotes" rows="4" cols="45" value=""></textarea></td>
       </tr>
       </table>
       </table>
 <!--      	<td width="6"><img src="images/spacer.gif " width="6"></td>
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
        <span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields1()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
</FORM>
</body>
</html>