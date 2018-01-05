<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 29, 2013                =
// Filename: production_sch_details.php        =
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
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mc_capacity.js"></script>

<html>
<head>
</script>
<title>PRN Machine Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>

        <table width=100% border=0 cellpadding=6 cellspacing=5 class="stdtable1">
        <tr>
        <td><span class="pageheading"><b>PRN Machine Details</b></td>
<?
$status=$_REQUEST['status'];
if($status=='edit')
{
echo "<td><font color='green'>Machine : <font color='red'> ". $myrow['mc_name']."</font>  Updated succesfully.</font></td>";
}
if($myrow['month'] == '')
$month='';
else
$month=date('F',mktime(0,0,0,$myrow['month']));
?>
<td  align="right"><input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="location.href='production_schEdit.php?recnum=<?php echo $recnum ?>'" value="Edit" >

<!-- <a href ="production_schEdit.php?recnum=<?php echo $recnum ?>"><img name="Image8" border="0" src="images/bu-edit.gif" ></a> --></td>




</tr>
</table>
</tr>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable1" bgcolor="#DFDEDF">

        <tr bgcolor="#FFFFFF">          
          <td  width='20%'><span class="labeltext"><p align="left">Machine ID</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow['mc_id'] ?></td>   
           <td  width='20%'><span class="labeltext"><p align="left">Machine Name</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow['mc_name'] ?></td>
        </tr>

		 <tr bgcolor="#FFFFFF">          
          <td  width='20%'><span class="labeltext"><p align="left">Month</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $month ?></td>   
           <td  width='20%'><span class="labeltext"><p align="left">Year</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow['year'] ?></td>
        </tr>


   <tr bgcolor="#FFFFFF">
  <td width='20%'><span class="labeltext"><p align="left">PRN</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow['crn'] ?></td>
             <td  width='20%'><span class="labeltext"><p align="left">MC Series</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow['mc_series'] ?></td>
        </tr> 
		  <tr bgcolor="#FFFFFF">
		<td width='20%'><span class="labeltext"><p align="left">RunTime</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow['runtime_hrs'] ?></td>
              <td width='20%'><span class="labeltext"><p align="left">Parts / Blank</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow['blank'] ?></td>
        </tr>  

     <tr bgcolor="#FFFFFF">
   
            <td  width='20%'><span class="labeltext"><p align="left">Operation</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow['operation'] ?></td>
             <td  width='20%'></td>
            <td width='30%'></td>
        </tr> 

</table>
</table>
</td>

</tr>

</table>

</table>
</body>
</html>
