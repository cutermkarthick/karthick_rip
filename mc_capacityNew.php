<?php
//==============================================
// Date-written = July 25, 2013                =
// Filename: new_mc_capacity.php               =
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

$_SESSION['pagename'] = 'mc_capacity';
$page = "MES: Cap Master";
////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/mc_capacityClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newmc_capacity = new mc_capacity;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mc_capacity.js"></script>
<html>
<head>
</script>
<title>New Machine Capacity</title>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0">
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
<?php
$newdisplay->dispLinks(''); 
?> -->
<form action='mc_capacityProcess.php' method='post' enctype='multipart/form-data'>
<input type='hidden' name='pagename' id='pagename' value='new_mc_capacity'>
<!-- </td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
	     		     <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
    <tr>
        <td >
        <table width=100% border=0 cellpadding=6 cellspacing=2>
        <tr>
        <td ><span class="pageheading"><b>New Machine Capacity</b>        
</tr>
</table>
</tr>
<tr>
<td>
<table width=800px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr bgcolor="#FFFFFF">
<input type="hidden"  name="mc_id" id="mc_id" value=""></td>
 <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>M/C Name</p></td>
 <td><select id="mc_name"  name="mc_name">
    <option value="select">Select</option>
<option <?php echo ((isset($mc_name)=='BMV 1')?"selected":"")?> value="BMV 1">BMV 1</option>
<option <?php echo ((isset($mc_name)=='VMC 2')?"selected":"")?> value="VMC 2">VMC 2</option>
<option <?php echo ((isset($mc_name)=='DMG 3')?"selected":"")?> value="DMG 3">DMG 3</option>
<option <?php echo ((isset($mc_name)=='DX 4')?"selected":"")?> value="DX 4">DX 4</option>
<option <?php echo ((isset($mc_name)=='HMC 5')?"selected":"")?> value="HMC 5">HMC 5</option>
<option <?php echo ((isset($mc_name) =='HAAS')?"selected":"")?> value="HAAS">HAAS</option>
             <!-- <option value="select">Select</option>
             <option value='BMV 60-1'>BMV 60-1</option>
             <option value='BMV 60-2'>BMV 60-2</option>
             <option value='BMV 45-1'>BMV 45-1</option>
             <option value='BMV 45-2'>BMV 45-2</option>
             <option value='BMV 50'>BMV 50</option>
             <option value='VMC 70L'>VMC 70L</option>
             <option value='DMG 360L'>DMG 360L</option>
             <option value='HMC 440'>HMC 440</option>
             <option value='DX 200-1'>DX 200-1</option>
             <option value='DX 200-2 '>DX 200-2</option>
             <option value='DX 200-3'>DX 200-3</option>
             <option value='HAAS'>HAAS</option>
             <option value='MakinoF3'>MakinoF3</option>
	         <option value='MakinoF5'>MakinoF5</option>
             <option value='HAASVF2SS'>HAASVF2SS</option>
	         <option value='VR11'>VR11</option>
	         <option value='ST20'>ST20</option>
             <option value='HAASVF2SS-2'>HAASVF2SS-2</option>
             <option value='MakinoF5-2'> MakinoF5-2</option>
             <option value='MakinoF5-3'>MakinoF5-3</option>
             <option value='MakinoF5-4'>MakinoF5-4</option>
             <option value='EMAG-1'>EMAG-1</option>
             <option value='A51nx-1'>A51nx-1</option>
			 <option value='QT100S-1'>QT100S-1</option>
			 <option value='QT100S-2'>QT100S-2</option> -->
             </select></td>

<td bgcolor="#FFFFFF"><span class="heading"><b><span class='asterisk'>*</span>Month</b></td>
<td>
<select name="month">
<option value="select">Select</option>
<option <?php echo ((isset($month) =='01')?"selected":"")?> value="01">Jan</option>
<option <?php echo ((isset($month) =='02')?"selected":"")?> value="02">Feb</option>
<option <?php echo ((isset($month) =='03')?"selected":"")?> value="03">Mar</option>
<option <?php echo ((isset($month) =='04')?"selected":"")?> value="04">Apr</option>
<option <?php echo ((isset($month) =='05')?"selected":"")?> value="05">May</option>
<option <?php echo ((isset($month) =='06')?"selected":"")?> value="06">June</option>
<option <?php echo ((isset($month) =='07')?"selected":"")?> value="07">July</option>
<option <?php echo ((isset($month) =='08')?"selected":"")?>  value="08">Aug</option>
<option <?php echo ((isset($month) =='09')?"selected":"")?> value="09">Sep</option>
<option <?php echo ((isset($month) =='10')?"selected":"")?> value="10">Oct</option>
<option <?php echo ((isset($month) =='11')?"selected":"")?> value="11">Nov</option>
<option <?php echo ((isset($month) =='12')?"selected":"")?> value="12">Dec</option>
</select>
</td>
<tr bgcolor="#FFFFFF">
<td bgcolor="#FFFFFF"><span class="heading"><b><span class='asterisk'>*</span>Year</b></td>
<td>
<select name="year" >
<option value="select">Select</option>
<option <?php echo ((isset($year)=='2005')?"selected":"")?> value="2005">2005</option>
<option <?php echo ((isset($year)=='2006')?"selected":"")?> value="2006">2006</option>
<option <?php echo ((isset($year)=='2007')?"selected":"")?> value="2007">2007</option>
<option <?php echo ((isset($year) =='2008')?"selected":"")?> value="2008">2008</option>
<option <?php echo ((isset($year) =='2009')?"selected":"")?> value="2009">2009</option>
<option <?php echo ((isset($year) =='2010')?"selected":"")?> value="2010">2010</option>
<option <?php echo ((isset($year) =='2011')?"selected":"")?> value="2011">2011</option>
<option <?php echo ((isset($year) =='2012')?"selected":"")?> value="2012">2012</option>
<option <?php echo ((isset($year) =='2013')?"selected":"")?> value="2013">2013</option>
<option <?php echo ((isset($year) =='2014')?"selected":"")?> value="2014">2014</option>
<option <?php echo ((isset($year) =='2015')?"selected":"")?> value="2015">2015</option>
<option <?php echo ((isset($year) =='2016')?"selected":"")?> value="2016">2016</option>
<option <?php echo ((isset($year) =='2017')?"selected":"")?> value="2017">2017</option>
</select>
</td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Avail Capacity</font></td>
<td><span class="tabletext"><input type="text"  name="avail_capacity" id="avail_capacity" value=""></td>
<tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>MC Series</p></font></td>
    <td><span class="tabletext"><input type="text"  name="mc_series" id="mc_series" value=""/></td>
    <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Shift</p></font></td>
    <td><span class="tabletext"><input type="text"  name="shift" id="shift" value=""/></td>
</tr>

<tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Units</p></font></td>
    <td>
        <select name="units">
            <option value="select" disabled selected>Select</option>
            <option  value="hrs">Hrs</option>
            <option value="strokes">Strokes</option>
        </select>
    </td>
    <td colspan="2"></td>
</tr>

</table>
<br/>
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
