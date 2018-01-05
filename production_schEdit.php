<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 29, 2013                =
// Filename: edit_production_Sch.php           =
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

$_SESSION['pagename'] = 'production_sch';
$page = "MES: Production Sch";
////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/mc_capacityClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newmc_capacity = new mc_capacity;

$recnum = $_REQUEST['recnum'];
$result = $newmc_capacity->getcrn_mc($recnum);
$myrow = mysql_fetch_array($result);

$month=$myrow['month'];
$year=$myrow['year'];
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mc_capacity.js"></script>
<html>
<head>
</script>
<title>Edit Production Schedule</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>

<form action='mc_capacityProcess.php' method='post' enctype='multipart/form-data'>
<input type='hidden' name='pagename' id='pagename' value='edit_crn_mc'>
<input type='hidden' name='recnum' id='recnum' value='<?=$recnum?>'>
<!-- </td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr>
<td>
<table width=100% border=0 cellpadding=6 cellspacing=5 bgcolor="#EEEEEE" class="stdtable1">
<tr>
<td><span class="pageheading"><b>Edit CRN Machine Master</b>        
</tr>
</table>
</tr>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td width='20%'><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Machine Id</p></font></td>
<td width='30%' colspan=3><span class="tabletext"><input type="text"  name="mc_id" id="mc_id" value="<?=$myrow['mc_id']?>" style="background-color:#DDDDDD;" readonly='readonly' > <img src='images/bu-get.gif' name='cim' onclick='Getmachine("<?php echo $myrow['mc_id'] ?>")'></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Machine Name</p></font></td>
<td width='25%'><span class="tabletext"><input type="text"  name="mc_name" id="mc_name" style="background-color:#DDDDDD;" readonly='readonly' value="<?=$myrow['mc_name']?>"/>
</td>
<td><span class="labeltext"><p align="left">Machine Series</p></font></td>
<td width='25%'><span class="tabletext"><input type="text"  name="mc_series" id="mc_series" style="background-color:#DDDDDD;" readonly='readonly' value="<?=$myrow['mc_series']?>"/>
</td>
</tr>

<tr bgcolor="#FFFFFF">
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
</tr>  

<tr bgcolor="#FFFFFF">
<td width='20%'><span class="labeltext"><p align="left"><span class='asterisk'>*</span>CRN.</p></font></td>
<td width='30%'><span class="tabletext"><input type="text"  name="crnnum" id="crnnum" value="<?=$myrow['crn']?>"  style="background-color:#DDDDDD;" readonly='readonly'><img src='images/bu-get.gif' name='cim' onclick='GetCIM("<?php echo crnnum ?>")'></td>
<td width='20%'><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RunTime.Hrs</p></font></td>
<td width='30%'><span class="tabletext"><input type="text"  name="runtime" id="runtime" value="<?=$myrow['runtime_hrs']?>" ></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Operation</p></font></td>
<td><span class="tabletext"><input type="text"  name="operation" id="operation" value="<?=$myrow['operation']?>"/></td>
<td width='20%'><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Parts/Blank</p></font></td>
<td width='30%'><span class="tabletext"><input type="text"  name="blank" id="blank" value="<?=$myrow['blank']?>" ></td>
</td>
</tr>
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onClick="javascript: return check_req_fields_prodn_sch()">
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