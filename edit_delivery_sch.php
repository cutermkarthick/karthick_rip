<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 29, 2010                =
// Filename: edit_delivery_sch.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays Delivery Sch Details               =
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

$recnum = $_REQUEST['recnum'];
$cond='where recnum='.$recnum;
$result = $newdelivery_sh->getdelivery_sch_dets($cond);
$myrow = mysql_fetch_row($result);
$remarks=wordwrap($myrow[4],105,"\n",true);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/delivery_sch.js"></script>


<html>
<head>
</script>
<title>Edit Delivery Schedule</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
<form action='processdelivery_sch.php' method='GET' enctype='multipart/form-data'>
<!--<table width=100% cellspacing="0" cellpadding="6" border="0">
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
	     		     <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
    <tr>
        <td >
        <table width=100% border=0 cellpadding=6 cellspacing=0>
        <tr>
        <td ><span class="pageheading"><b>Edit Delivery Schedule</b>        
</tr>
</table>
</tr>
<tr>
<td>
<table id='bnm' width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">

<tr bgcolor="#FFFFFF">
<td width='20%'><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Scheduled Qty</p></font></td>
<td width='30%' id='sch'><input type="text"  name="schedule_qty" id="schedule_qty" value="<?php echo $myrow[3] ?>"  
onblur="javascript:SetCIM('','delivery_sch')"></td>

<td  width='20%'><span class="labeltext"><p align="left">Dispatch UTD</p></font></td>
<td width='30%'><input type="text"  name="disp_qty" id="disp_qty"
            value="<?php echo $myrow[8] ?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width='20%'><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PRN.</p></font></td>
<td width='30%'><span class="tabletext"><input type="text"  name="crnnum" id="crnnum" value="<?php echo $myrow[1] ?>"  style="background-color:#DDDDDD;" readonly='readonly'><img src='images/bu-get.gif' name='cim' onclick='GetCIM("<?php echo 'CIM_refnum' ?>")'></td>
<td width='20%'><span class="labeltext"><p align="left">Partnumber</td>
<td width='30%' id='sch'><input type="text"  name="partnum" id="partnum" style="background-color:#DDDDDD;"  readonly='readonly' value="<?php echo $myrow[7] ?>"</td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Scheduled Date</p></font></td>
<td><span class="tabletext"><input type="text"  name="schedule_date" id="schedule_date" value="<?php echo $myrow[2] ?>" style="background-color:#DDDDDD;" readonly="readonly"><img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('schedule_date')"></td>
<td><span class="labeltext"><p align="left">Required Time(in Mins)</p></font></td>
<?
$hours = ($myrow[5] % 60);
$mins = intval($myrow[5] / 60);
if($hours == '0')
{
$req_time = $mins.' Mins';
}else{
$req_time = $hours.' H '.$mins. '  Mins ';
}
?>
<td width='25%'>
<div id='details'>
<input type="text"  name="time_required" id="time_required" style="background-color:#DDDDDD;"  readonly='readonly' value="<?php echo $myrow[5] ?>"/>
</div>
</td>
</tr>


<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Status</p></font></td>
<td><span class="labeltext">
<select id="status" name="status">
<?
$status=array('Open','Closed','Cancelled');
for($j=0;$j<count($status);$j++)
{
if($status[$j] == $myrow[6])
{?>
<option selected value="<? echo $status[$j]?>"><?echo $status[$j]; ?>
</option>
<?}
else{?>
<option value="<? echo $status[$j]?>"><?echo $status[$j]; ?>
</option>
<?}
}?>
</select>
</td>
<td><span class="labeltext">Customer</td>
<td><span class="tabletext"><input type="text"  name="custcode" id="custcode" value="<?php echo $myrow[9] ?>"></td>


</tr>


<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Remarks.</p></font></td>
<td colspan=3><span class=\"tabletext\"><textarea  name="remarks" id="remarks" rows="4"                
			              cols="100" value=""><?php echo $myrow[4] ?></textarea></td>
</td>
</tr>
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Update" name="submit" onClick="javascript: return check_req_fields()">
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onClick="javascript: putfocus()">
</td>   
</tr>
<input type='hidden' name='recnum' value=<?echo $recnum?>>
<input type="hidden"  name="time" id="time" value="<?php echo $myrow[5] ?>"/>

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
</form>
</table>
</body>
</html>
