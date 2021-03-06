<?php
//==============================================
// Author: FSI                                 =
// Date-written: July 25, 2013                 =
// Filename: production_sch.php                =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Board details                               =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/mc_capacityClass.php');
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'production_sch';
$page = "MES: Production Sch";
////session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newmc_capacity = new mc_capacity;
$dept=$_SESSION['department'];
// $mc_name=$_REQUEST['mc_name'];
// $crnnum=$_REQUEST['crnnum'];

if (isset($mc_name)) 
{
	$mc_name=$_REQUEST['mc_name'];
}
else
{
	$mc_name="";
}
if (isset($crnnum)) 
{
	$crnnum=$_REQUEST['crnnum'];
}
else
{
	$crnnum="";
}

$cond='';

if (isset($_REQUEST['mc_name']) && $_REQUEST['mc_name']!='select' && $_REQUEST['crnnum'] != '') 
{	 
	$cond ="where mc_name ='".$mc_name."' and crn='".$crnnum."'"; 
}
else if($mc_name!='' && $mc_name!='select' && $crnnunm=='')
{	
	$cond ="where mc_name like '$mc_name%' ";
}
else if($mc_name == 'select' && $crnnum != '')
{	
	$cond ="where crn like '$crnnum%' ";
}
else
{
	$cond="where mc_name like '%' and crn like '%' ";
}

?>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mc_capacity.js"></script>
<link rel="stylesheet" href="style.css">
<html>
<head>
<title>PRN Machine Master</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>

<table width=100% border=0 cellpadding=6 cellspacing=2 >
<tr> 
<td><span class="pageheading"><b>PRN Machine Master</b></td>
</tr>
<form action='production_sch.php' method='get' enctype='multipart/form-data'>
<tr>
<td>
<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>PRN Machine Header</b></center></td>
<?

if (isset($_REQUEST['status'])) {
	$status=$_REQUEST['status'];
}
else
{
	$status="";
}
?>
</tr>
<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Machine Name</p></font></td>
<td><select id="mc_name"  name="mc_name">
<option value="select">Select</option>
<option <?php echo ((isset($mc_name)=='BMV 1')?"selected":"")?> value="BMV 1">BMV 1</option>
<option <?php echo ((isset($mc_name) =='VMC 2')?"selected":"")?> value="VMC 2">VMC 2</option>
<option <?php echo ((isset($mc_name) =='DMG 3')?"selected":"")?> value="DMG 3">DMG 3</option>
<option <?php echo ((isset($mc_name)=='DX 4')?"selected":"")?> value="DX 4">DX 4</option>
<option <?php echo ((isset($mc_name) =='HMC 5')?"selected":"")?> value="HMC 5">HMC 5</option>
<option <?php echo ((isset($mc_name) =='HAAS')?"selected":"")?> value="HAAS">HAAS</option>
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
<td><span class="labeltext"><p align="left">PRN #</p></font></td>
<td><span class="tabletext"><input type="text" name="crnnum" id='crnnum' size=10 value="<?php echo $crnnum; ?>"></td>



<input type="hidden" name="action" value="new">
<?php
if ($dept != 'PPC3'&& $dept != 'PPC4')
{
?>
<td><span class="labeltext">

<button class="stdbtn btn_blue" style="background-color:#2d3e50;padding:2px;mardin-right:2px;" >Search</button>
<button class="stdbtn btn_blue" style="background-color:#2d3e50;padding:2px;mardin-right:2px;" onClick="javascript: putfocus()" >Reset</button>

	<!-- <input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Search" name="submit">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onClick="javascript: putfocus()"> -->
					 </td>
<?php
}?>
</tr>
</table>
</table>
</FORM>
<table border=0 bgcolor="#FFFFFF" width=100%  cellspacing=1 cellpadding=3>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor='#FFFFFF'>
<?
if($status=='new')
{
echo "<td><font color='green'>New MC:<font color='red'> ". $_REQUEST['mc_name1']."    </font>Inserted Succesfully.</font></td>";
}?>

<table style="table-layout: fixed;width:100%" border=0>
<div class="contenttitle radiusbottom0">
<h2 class="table"><span>Results

<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='production_schNew.php'" value="New" >
<!-- <a href ="production_schNew.php"><img name="Image8" border="0" style="float:right" src="images/new.gif"></a> -->
</h2></span>
</div><!--contenttitle-->
</table>
<table border=0 bgcolor="#FFFFFF" style="table-layout: fixed;width:100%"  cellspacing=1 cellpadding=3>
<tr>
<td>

<table style="table-layout: fixed;width:100%" border=0 cellpadding=3 cellspacing=1 class="stdtable">
<thead>
	<tr>
<th class="head0">PRN #</th>
<th class="head1">Machine Id</th>
<th class="head0">Machine Name</th>
<th class="head1">Date</th>
<th class="head0">Machine Series</th>
<th class="head1">RunTime in Hrs/Unit</th>
<th class="head1">Parts/Blank</th>
<th class="head0">Operation</th>
</thead>
</tr>
</table>

<div style="width:100%;height:450px;overflow-y:scroll;">
<table style="table-layout: fixed;width:100%" border=0 cellpadding=3 cellspacing=1 class="stdtable">
<?php
	$result = $newmc_capacity->getcrn_mc_summary($cond);
    while ($myrow = mysql_fetch_array($result))
    {   
		if($myrow['month'] == '')
			$month='';
		else
		$month=date('M',mktime(0,0,0,$myrow['month']));
		$year=$myrow['year'];
		$date=$month.' ,'.$year;
     ?>
     <tr bgcolor="#FFCC00">
     <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><a href="production_schDetails.php?recnum=<?echo $myrow['recnum']?>"><?php echo $myrow['crn']?></td>  
     <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow['mc_id'] ?></td>
	 <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow['mc_name'] ?></td>
	 <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $date ?></td>
	 <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow['mc_series'] ?></td>
	 <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow['runtime_hrs'] ?></td>
	 <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow['blank'] ?></td>
	 <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow['operation'] ?></td>

     </tr>

<?php
	}
?>


</table>
</table>
</div>

</td>
<tr>
</tr>
</table>
</FORM>
</table>
</body>
</html>