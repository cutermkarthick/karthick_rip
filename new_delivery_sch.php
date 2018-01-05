<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 29, 2010                =
// Filename: new_delivery_sch.php              =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'delivery_sch';
$page = "MES: delivery Sch";
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/delivery_schClass.php');
include('classes/displayClass.php');


$newlogin = new userlogin;
$newlogin->dbconnect();


$newdisplay = new display;
$newdelivery_sh = new deliverye_sch;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/delivery_sch.js"></script>


<html>
<head>
</script>
<title>New Delivery Schedule</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

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
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>

</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
        <form action='processdelivery_sch.php' method='post' enctype='multipart/form-data'>
	     		     <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
    <tr>
        <td >
        <table width=100% border=0 cellpadding=6 cellspacing=0>
        <tr>
        <td ><span class="pageheading"><b>New Delivery Schedule</b>        
</tr>
</table>
</tr>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">

<tr bgcolor="#FFFFFF">
<td width='20%'><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Scheduled Qty</p></font></td>
<td width='30%'><span class="tabletext"><input type="text"  name="schedule_qty" id="schedule_qty" value="" onfocus="javascript:resetcrn()"></td>
<td><span class="labeltext"><p align="left">Customer</p></font></td>
<td width='25%'><span class="tabletext"><input type="text"  name="custcode" id="custcode" value=""/>
</tr>
<tr bgcolor="#FFFFFF">
<td width='20%'><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PRN </p></font></td>
<td width='30%'><span class="tabletext"><input type="text"  name="crnnum" id="crnnum" value=""  style="background-color:#DDDDDD;" readonly='readonly'>
    <img src='images/bu-get.gif' name='cim' onclick='GetCIM("crnnum")'></td>
<td><span class="labeltext"><p align="left">Partnumber</p></font></td>
<td width='25%'><span class="tabletext"><input type="text"  name="partnum" id="partnum" style="background-color:#DDDDDD;" readonly='readonly' value=""/>
</td>

</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Scheduled Date</p></font></td>
<td><span class="tabletext"><input type="text"  name="schedule_date" id="schedule_date" value="" style="background-color:#DDDDDD;" readonly="readonly"><img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('schedule_date')"></td>
<td><span class="labeltext"><p align="left">Required Time</p></font></td>

<td width='25%' id='details'><span class="tabletext"><input type="text"  name="time_required" id="time_required" style="background-color:#DDDDDD;" readonly='readonly' value=""/>
</td>

</tr>
<input type="hidden"  name="time" id="time" value=""/>
<input type="hidden"  name="status" id="status" value="Open"/>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Remarks.</p></font></td>
<td colspan=3><span class=\"tabletext\"><textarea  name="remarks" id="remarks" rows="4"                
			              cols="100" value=""></textarea></td>
</td>
</tr>
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onClick="javascript: return check_req_fields()">
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onClick="javascript: putfocus()">
</td>   
</tr>
</table>
</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->

</table>

</table>
</body>
</html>
