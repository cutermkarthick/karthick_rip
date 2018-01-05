<?php
//==============================================
// Author: FSI                                 =
// Date-written = Sep 20, 2009                 =
// Filename: machine_data.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays Machine Deatils                    =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
  header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$userrole = $_SESSION['userrole'];

$_SESSION['pagename'] = 'machine_data';
//////session_register('pagename');

// First include the class definition
include('classes/displayClass.php');
include('classes/operatorClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newoperator = new operator;
$timer=60000;

include('header3.html');
?>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mcdisplay.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>
<script language="javascript" src="scripts/jquery.innerfade.js"></script>
<script type="text/javascript">
 $(document).ready(
				function(){
					$('#news').innerfade({
						animationtype: 'slide',
						speed: 5000,
						timeout: 12000,
						type: 'sequence',
						containerheight: '150px'
					});					

			});
  	</script>
	<script type=&quot;text/javascript>
	$(document).ready(
		function(){
			$('#news').innerfade({
				animationtype: 'slide',
				speed: 5000,
				timeout: 12000,
				type: 'sequence',
				containerheight: '150px'
			});			
		});
</script>

<html>
<head>

<title>Machine data</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0" onload="setInterval('ShowDetails()',<?echo $timer?>);"/>
<div id='machine' style="height: 400px" >

<ul id="news">
<?php
$machine_names=array('BMV 60-1','BMV 60-2','BMV 45-1','BMV 45-2','BMV 50','VMC 70L','DMG 360L','HMC 440','DX 200-1','DX 200-2','DX 200-3','HAAS');

for($i=0;$i<count($machine_names);$i++)
{
$result = $newoperator->getmachine_data($machine_names[$i]);	
if(mysql_num_rows($result) != '0')
{
while($myrow = mysql_fetch_row($result))
{ 
$datearr = split('-', $myrow[8]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date=date("M j, Y",$x);
$running_time=($myrow[11]*60)+$myrow[12];
$running_in_timemaster=($myrow[17]*60)+$myrow[18];

if($running_in_timemaster == '0' || $running_in_timemaster == '')
{
$estimated_qty = 0;
}
else
{
$estimated_qty = $running_time/$running_in_timemaster;
}

if($estimated_qty  > $myrow[4])
{
$los='<font color="red"><b>Loss</b></font>';
}
else if($estimated_qty  < $myrow[4]) 
{
$los='<font color="green"><b>Gain</b></font>';
}
else if($estimated_qty == $myrow[4]) 
{
 $los='<font color="#0000ff"><b>Neutral</b></font>';
}

?>
<li>
<table width="95%"  ALIGN="center" border="1" cellpadding=3 cellspacing=1 bgcolor="#FFFFFF" BORDERCOLOR="#00AAFF">
<tr bgcolor="#00CC00">
<td colspan=10><span class="tabletext"><p align="center"><font size="3"><b>MACHINE DETAILS</font></b></td>
</tr>

<tr><td>

<table width="100%" ALIGN="center" border="0" cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" height="350px"  >
<tr bgcolor="#FFFFFF" height='20px'>
<td bgcolor="#A5EEFD"><span class="tabletext"><p align="left"><font size="3" color="#0000FF"><b>Machine Name:</font></b></td>
<td bgcolor="#A5EEFD"><span class="tabletext"><font size="3"><p align="left"><b><?echo $myrow[2];?></b></p></font></td>
</tr>
<tr bgcolor="#FFFFFF" height='20px'>
<td><span class="tabletext"><p align="left"><font size="3" color="#0000FF"><b>PRN:</font></b></td>
<td><span class="tabletext"><p align="left"><font size="3"><b><?echo $myrow[1];?></p></font></td>
</tr>
<tr bgcolor="#FFFFFF" height='20px'>
<td><span class="tabletext"><p align="left"><font size="3" color="#0000FF"><b>WO No:</font></b></td>
<td><span class="tabletext"><font size="3"><p align="left"><b><?echo $myrow[5];?></p></font></td>
</tr>

<tr height="20px" bgcolor="#FFFFFF">
<td><span class="tabletext"><p align="left"><font size="3" color="#0000FF"><b>Shift:</font></b></td>
<td><span class="tabletext"><font size="3"><p align="left"><b><?echo $myrow[3];?></p></font></td>
</tr>
<tr height="20px" bgcolor="#FFFFFF">
<td><span class="tabletext"><p align="left"><font size="3" color="#0000FF"><b>Stage:</font></b></td>
<td><span class="tabletext"><font size="3"><p align="left"><b><?echo $myrow[16];?></p></font></td>
</tr>
</table>

</td>
<td>&nbsp;</td>
<td>


<table width="100%" ALIGN="center" border="0" cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" height="350px" >
<tr bgcolor="#FFFFFF" height='20px'>
<td bgcolor="#A5EEFD"><span class="tabletext"><p align="left"><font size="3" color="#0000FF"><b>Operator Name:</font></b></td>
<td  bgcolor="#A5EEFD"><span class="tabletext"><font size="3"><p align="left"><b><?echo $myrow[0];?></p></font></td>
</tr>
<tr bgcolor="#FFFFFF" height='20px'>
<td><span class="tabletext"><p align="left"><font size="3" color="#0000FF"><b>Setting Time:</font></b></td>
<?
if($myrow[9] == '0' && $myrow[10] == '0' || $myrow[9]=='')
{?>
 <td><span class="tabletext"><p align="left">&nbsp;</p></font></td>
<?
}
else
{
printf('<td><span class="tabletext"><font size="3"><b><p align="left">%.0f h : %.0f m</p></font></td>',
	     $myrow[9],$myrow[10] );
}?>
</td>
</tr>
<tr bgcolor="#FFFFFF" height='20px'>
<td><span class="tabletext"><p align="left"><font size="3" color="#0000FF"><b>Running Time:</font></b></td>
<?
if($myrow[11] == '0' && $myrow[12] == '0' || $myrow[11] == '')
{?>
 <td><span class="tabletext"><font size="3"><p align="left"></p></font></td>
<?}
else
{
printf('<td><span class="tabletext"><font size="3"><b><p align="left">%.0f h : %.0f m</p></font></td>',
	     $myrow[11],$myrow[12] );
}
?>
</td>
</tr>
<tr bgcolor="#FFFFFF" height='20px'>
<td><span class="tabletext"><p align="left"><font size="3" color="#0000FF"><b>Idle Time:</font></b></td>
<?
if($myrow[13] == '0' && $myrow[14] == '0' || $myrow[13] == '')
{?>
<td><span class="tabletext"><font size="3"><p align="left"></p></font></td>
<?
}
else
{
printf('<td><span class="tabletext"><font size="3"><b><p align="left">%.0f h : %.0f m</p></font></td>',
	     $myrow[13],$myrow[14] );
}

?>
</td>
</tr>
<tr bgcolor="#FFFFFF" height='20px'>
<td><span class="tabletext"><p align="left"><font size="3" color="#0000FF"><b>BreakDown Time:</font></b></td>
<?
if($myrow[19] == '0' && $myrow[20] == '0' || $myrow[19] == '')
{?>
 <td><span class="tabletext"><font size="3"><p align="left"></p></font></td>
<?}
else
{
printf('<td><span class="tabletext"><font size="3"><b><p align="left">%.0f h : %.0f m</p></font></td>',
	     $myrow[19],$myrow[20]);
}
?>
</td>
</tr>
</table>

</td>
<td>&nbsp;</td>
<td>

<table width="100%" ALIGN="center" border="0" cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" height="350px">
<tr height="20px" bgcolor="#FFFFFF">
<td bgcolor="#A5EEFD"><span class="tabletext"><p align="left"><font size="3" color="#0000FF"><b>Date:</font></b></td>
<td bgcolor="#A5EEFD"><span class="tabletext"><font size="3"><b><p align="left"><?echo $date;?></p></font></td>
</tr>
<tr height="20px" bgcolor="#FFFFFF">
<td><span class="tabletext"><p align="left"><font size="3" color="#0000FF"><b>Qty Prod:</font></b></td>
<td><span class="tabletext"><font size="3"><p align="left"><b><?echo $myrow[4];?></p></font></td>
</tr>
<tr height="20px" bgcolor="#FFFFFF">
<td><span class="tabletext"><p align="left"><font size="3" color="#0000FF"><b>Estimated Qty:</font></b></td>
<td><span class="tabletext"><font size="3"><p align="left"><b><?echo number_format($estimated_qty,2);?></p></font></td>
</tr>
<tr height="20px" bgcolor="#FFFFFF">
<td><span class="tabletext"><p align="left"><font size="3" color="#0000FF"><b>Loss/Gain:</font></b></td>
<td><span class="tabletext"><font size="3"><p align="left"><b><?echo $los;?></p></font></td>
</tr>
<tr height="20px" bgcolor="#FFFFFF">
<td><span class="tabletext"><p align="left"><font size="3" color="#0000FF"><b>Qty Rej:</font></b></td>
<td><span class="tabletext"><font size="3"><p align="left"><b><?echo $myrow[15];?></p></font></td>
</tr>
</table>
</td></tr>
</table>

</li>
<?
}
}
}
?>
</ul>



</div>
<table  width="90%" ALIGN="center" border="0" cellpadding=3 cellspacing=1  bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td><span class="tabletext"><font size="2"><p align="right"><b>Powered By<img src="images/fluent_logo1.gif" align="right" border="0" width="60" height="60"></font></i></b></p></font></td>
</tr>
</table>
</FORM>
</body>
</html>
