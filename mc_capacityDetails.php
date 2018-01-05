<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 29, 2013                =
// Filename: mc_capacity_details.php           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays mc capacity Details                =
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

$recnum = $_REQUEST['recnum'];
$cond='where recnum='.$recnum;
$result = $newmc_capacity->getmc_capacitys($cond);
$myrow = mysql_fetch_row($result);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mc_capacity.js"></script>

<html>
<head>
</script>
<title>MC Capacity Details</title>
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
<?php
$newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
	     		     <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
    <tr>
        <td >
        <table width=100% border=0 cellpadding=6 cellspacing=1>
        <tr>
        <td><span class="pageheading"><b>Machine Capacity Details</b></td>
<?
$status=$_REQUEST['status'];
if($status=='edit')
{
echo "<td><font color='green'>Machine : <font color='red'> ". $myrow[2]."</font>  Updated succesfully.</font></td>";
}
if($myrow[5] == '')
$month='';
else
$month=date('F',mktime(0,0,0,$myrow[5]));
?>
<td bgcolor="#FFFFFF" align="right">

<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="location.href='mc_capacitySummary.php?recnum=<?php echo $recnum ?>&status=delete&mc_name1=<?=$myrow[2]?>'" value="Delete" >
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="location.href='mc_capacityEdit.php?recnum=<?php echo $recnum ?>'" value="Edit" >
  <!-- <a href ="mc_capacityEdit.php?recnum=<?php echo $recnum ?>"><img name="Image8" border="0" src="images/bu-edit.gif" ></a>
  <a href ="mc_capacitySummary.php?recnum=<?php echo $recnum ?>&status=delete&mc_name1=<?=$myrow[2]?>"><img name="Image8" border="0" src="images/bu-delete.gif" ></a></td> -->
</tr>
</table>
</tr>
<tr>
<td>
<table bgcolor="#DFDEDF" width=800px style="border:1px solid " cellpadding=3 cellspacing=1 class="stdtable">

        <tr bgcolor="#FFFFFF">          
          <td  width='20%'><span class="labeltext"><p align="left">Machine ID</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow[1] ?></td>   
           <td  width='20%'><span class="labeltext"><p align="left">Machine Name</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow[2] ?></td>
        </tr>
		  <tr bgcolor="#FFFFFF">          
          <td  width='20%'><span class="labeltext"><p align="left">Month</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $month ?></td>   
           <td  width='20%'><span class="labeltext"><p align="left">Year</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow[6] ?></td>
        </tr>

   <tr bgcolor="#FFFFFF">
      <td width='20%'><span class="labeltext"><p align="left">Avail Capacity</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow[3] ?></td>
             <td  width='20%'><span class="labeltext"><p align="left">MC Series</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow[4] ?></td>
        </tr>  

        <tr bgcolor="#FFFFFF">
            <td width='20%'><span class="labeltext"><p align="left">Shift</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow[7] ?></td>
            <td width='20%'><span class="labeltext"><p align="left">Units</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow[8] ?></td>
        </tr>  

</table></table>
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
