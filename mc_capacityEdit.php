<?php
//==============================================
// Date-written = July 25, 2013                =
// Filename: edit_mc_capacity.php               =
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
$recnum=$_REQUEST['recnum'];
$cond='where recnum='.$recnum;
$result = $newmc_capacity->getmc_capacitys($cond);
$myrow = mysql_fetch_row($result);
$month=$myrow[5];
$year=$myrow[6];
$mc_name=$myrow[2];
$units=$myrow[8];

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mc_capacity.js"></script>
<html>
<head>
</script>
<title>Edit Machine Capacity</title>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0">
<?php
include('header.html');
?>

<form action='mc_capacityProcess.php' method='post' enctype='multipart/form-data'>
<input type='hidden' name='recnum' id='recnum' value=<?=$recnum?>>
<input type='hidden' name='pagename' id='pagename' value='edit_mc_capacity'>

	     		     <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
    <tr>
        <td >
        <table width=100% border=0 cellpadding=6 cellspacing=1>
        <tr>
        <td ><span class="pageheading"><b>Edit Machine Capacity</b>        
</tr>
</table>
</tr>
<tr>
<td>
<table bgcolor="#DFDEDF" width=800px style="border:1px solid" cellpadding=3 cellspacing=1 class="stdtable" >
<tr bgcolor="#FFFFFF">
<input type="hidden"  name="mc_id" id="mc_id" value="<?=$myrow[1]?>">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Machine Name.</p></font></td>
<td><select id="mc_name"  name="mc_name">
<option value="select">Select</option>
<option <?php echo (($mc_name=='BMV 1')?"selected":"")?> value="BMV 1">BMV 1</option>
<option <?php echo (($mc_name=='VMC 2')?"selected":"")?> value="VMC 2">VMC 2</option>
<option <?php echo (($mc_name=='DMG 3')?"selected":"")?> value="DMG 3">DMG 3</option>
<option <?php echo (($mc_name=='DX 4')?"selected":"")?> value="DX 4">DX 4</option>
<option <?php echo (($mc_name=='HMC 5')?"selected":"")?> value="HMC 5">HMC 5</option>
<option <?php echo (($mc_name=='HAAS')?"selected":"")?> value="HAAS">HAAS</option>
<!-- <option value="select">Select</option>
<option <?php echo (($mc_name=='BMV 60-1')?"selected":"")?> value="BMV 60-1">BMV 60-1</option>
<option <?php echo (($mc_name=='BMV 60-2')?"selected":"")?> value="BMV 60-2">BMV 60-2</option>
<option <?php echo (($mc_name=='BMV 45-1')?"selected":"")?> value="BMV 45-1">BMV 45-1</option>
<option <?php echo (($mc_name=='BMV 45-2')?"selected":"")?> value="BMV 45-2">BMV 45-2</option>
<option <?php echo (($mc_name=='BMV 50')?"selected":"")?> value="BMV 50">BMV 50</option>
<option <?php echo (($mc_name=='VMC 70L')?"selected":"")?> value="VMC 70L">VMC 70L</option>
<option <?php echo (($mc_name=='DMG 360L')?"selected":"")?> value="DMG 360L">DMG 360L</option>
<option <?php echo (($mc_name=='HMC 440')?"selected":"")?>  value="HMC 440">HMC 440</option>
<option <?php echo (($mc_name=='DX 200-1')?"selected":"")?> value="DX 200-1">DX 200-1</option>
<option <?php echo (($mc_name=='DX 200-2')?"selected":"")?> value="DX 200-2">DX 200-2</option>
<option <?php echo (($mc_name=='DX 200-3')?"selected":"")?> value="DX 200-3">DX 200-3</option>
<option <?php echo (($mc_name=='HAAS')?"selected":"")?> value="HAAS">HAAS</option>
<option <?php echo (($mc_name=='MakinoF3')?"selected":"")?> value="MakinoF3">MakinoF3</option>
<option <?php echo (($mc_name=='MakinoF5')?"selected":"")?> value="MakinoF5">MakinoF5</option>
<option <?php echo (($mc_name=='HAASVF2SS')?"selected":"")?> value="HAASVF2SS">HAASVF2SS</option>
<option <?php echo (($mc_name=='VR11')?"selected":"")?> value="VR11">VR11</option>
<option <?php echo (($mc_name=='ST20')?"selected":"")?> value="ST20">ST20</option>
<option <?php echo (($mc_name=='HAASVF2SS-2')?"selected":"")?> value="HAASVF2SS-2">HAASVF2SS-2</option>

<option <?php echo (($mc_name=='MakinoF5-2')?"selected":"")?> value="MakinoF5-2">MakinoF5-2</option>
<option <?php echo (($mc_name=='MakinoF5-3')?"selected":"")?> value="MakinoF5-3">MakinoF5-3</option>
<option <?php echo (($mc_name=='MakinoF5-4')?"selected":"")?> value="MakinoF5-4">MakinoF5-4</option>
<option <?php echo (($mc_name=='EMAG-1')?"selected":"")?> value="EMAG-1">EMAG-1</option>

<option <?php echo (($mc_name=='A51nx-1')?"selected":"")?> value="A51nx-1">A51nx-1</option>
<option <?php echo (($mc_name=='QT100S-1')?"selected":"")?> value="QT100S-1">QT100S-1</option>
<option <?php echo (($mc_name=='QT100S-2')?"selected":"")?> value="QT100S-2">QT100S-2</option> -->
</select>
</td>

<td bgcolor="#FFFFFF"><span class="heading"><b><span class='asterisk'>*</span>Month</b></td>
<td>
<select name="month">
<option value="select">Select</option>
<option <?php echo (($month=='01')?"selected":"")?> value="01">Jan</option>
<option <?php echo (($month=='02')?"selected":"")?> value="02">Feb</option>
<option <?php echo (($month=='03')?"selected":"")?> value="03">Mar</option>
<option <?php echo (($month=='04')?"selected":"")?> value="04">Apr</option>
<option <?php echo (($month=='05')?"selected":"")?> value="05">May</option>
<option <?php echo (($month=='06')?"selected":"")?> value="06">June</option>
<option <?php echo (($month=='07')?"selected":"")?> value="07">July</option>
<option <?php echo (($month=='08')?"selected":"")?>  value="08">Aug</option>
<option <?php echo (($month=='09')?"selected":"")?> value="09">Sep</option>
<option <?php echo (($month=='10')?"selected":"")?> value="10">Oct</option>
<option <?php echo (($month=='11')?"selected":"")?> value="11">Nov</option>
<option <?php echo (($month=='12')?"selected":"")?> value="12">Dec</option>
</select>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td bgcolor="#FFFFFF"><span class="heading"><b><span class='asterisk'>*</span>Year</b></td>
<td>
<select name="year" >
<option value="select">Select</option>
<option <?php echo (($year=='2005')?"selected":"")?> value="2005">2005</option>
<option <?php echo (($year=='2006')?"selected":"")?> value="2006">2006</option>
<option <?php echo (($year=='2007')?"selected":"")?> value="2007">2007</option>
<option <?php echo (($year=='2008')?"selected":"")?> value="2008">2008</option>
<option <?php echo (($year=='2009')?"selected":"")?> value="2009">2009</option>
<option <?php echo (($year=='2010')?"selected":"")?> value="2010">2010</option>
<option <?php echo (($year=='2011')?"selected":"")?> value="2011">2011</option>
<option <?php echo (($year=='2012')?"selected":"")?> value="2012">2012</option>
<option <?php echo (($year=='2013')?"selected":"")?> value="2013">2013</option>
<option <?php echo (($year=='2014')?"selected":"")?> value="2014">2014</option>
<option <?php echo (($year=='2015')?"selected":"")?> value="2015">2015</option>
<option <?php echo (($year=='2016')?"selected":"")?> value="2016">2016</option>
<option <?php echo (($year=='2017')?"selected":"")?> value="2017">2017</option>
</select>
</td>
<td><span class="labeltext"><p align="left">Avail Capacity</font></td>
<td><span class="tabletext"><input type="text"  name="avail_capacity" id="avail_capacity" value="<?=$myrow[3]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">MC Series</p></font></td>
<td><span class="tabletext"><input type="text"  name="mc_series" id="mc_series" value="<?=$myrow[4]?>"/></td>
<td><span class="labeltext"><p align="left">Shift</p></font></td>
<td><span class="tabletext"><input type="text"  name="shift" id="shift" value="<?=$myrow[7]?>"/></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><span class='asterisk'>*</span>Units</p></font></td>
<td>
    <select name="units" id="units" >
        <option value="select" disabled>select</option>
        <option <?php if($units == "hrs" || $units == ""){ echo "selected='selected'";}?> value="hrs">Hrs</option>
        <option <?php if($units == "strokes"){ echo "selected='selected'"; } ?> value="strokes">Strokes</option>
    </select>
</td>
<td colspan="2"></td>
</tr>

</table>


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
</table>
</table>
</body>
</html>