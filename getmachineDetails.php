<?php
//===================================================
// Author: Fluent Technologies                                
// Date-written: Sep 20, 2009            
// Filename: getmachineDetails.php         
// Copyright of Fluent Technologies, Bangalore,India.            
// Revision: v1.0 CJT                  
//===================================================

include_once('classes/operatorClass.php');
$newoperator = new operator;
?>
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

$estimated_qty = $running_time/$running_in_timemaster;
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
<table width="95%"  ALIGN="center" border="1" cellpadding=3 cellspacing=1 bgcolor="#FFFFFF"  height="400px" BORDERCOLOR="#804000">
<tr bgcolor="#C9C299" height='35px'>
<td colspan=10><span class="tabletext"><p align="center"><font size="3"><b>MACHINE DETAILS</font></b></td>
</tr>

<tr><td>

<table width="100%" ALIGN="center" border="1" cellpadding=3 cellspacing=1 bgcolor="#FFFFFF" height="400px"  >
<tr bgcolor="#FFFFFF" height='30px'>
<td bgcolor="#A5EEFD" colspan='2'><span class="tabletext"><p align="left"><font size="3" color="#E77471"><b>Machine Name:</font></b></td>
<td bgcolor="#A5EEFD"><span class="tabletext"><font size="3"><p align="left"><b><?echo $myrow[2];?></b></p></font></td>
</tr>
<tr bgcolor="#FFFFFF" height='30px'>
<td colspan=2><span class="tabletext"><p align="left"><font size="3" color="#E77471"><b>PRN:</font></b></td>
<td><span class="tabletext"><p align="left"><font size="3"><?echo $myrow[1];?></p></font></td>
</tr>
<tr bgcolor="#FFFFFF" height='30px'>
<td colspan=2><span class="tabletext"><p align="left"><font size="3" color="#E77471"><b>WO No:</font></b></td>
<td><span class="tabletext"><font size="3"><p align="left"><?echo $myrow[5];?></p></font></td>
</tr>

<tr height="30px" bgcolor="#FFFFFF">
<td colspan=2><span class="tabletext"><p align="left"><font size="3" color="#E77471"><b>Shift:</font></b></td>
<td><span class="tabletext"><font size="3"><p align="left"><?echo $myrow[3];?></p></font></td>
</tr>
<tr height="30px" bgcolor="#FFFFFF">
<td colspan=2><span class="tabletext"><p align="left"><font size="3" color="#E77471"><b>Stage:</font></b></td>
<td><span class="tabletext"><font size="3"><p align="left"><?echo $myrow[16];?></p></font></td>
</tr>
</table>

</td>
<td>&nbsp;</td>
<td>


<table width="100%" ALIGN="center" border="1" cellpadding=3 cellspacing=1 bgcolor="#FFFFFF" height="400px" >
<tr bgcolor="#FFFFFF" height='30px'>
<td bgcolor="#A5EEFD" colspan='2'><span class="tabletext"><p align="left"><font size="3" color="#E77471"><b>Operator Name:</font></b></td>
<td  bgcolor="#A5EEFD"><span class="tabletext"><font size="3"><p align="left"><?echo $myrow[0];?></p></font></td>
</tr>
<tr bgcolor="#FFFFFF" height='30px'>
<td colspan=2><span class="tabletext"><p align="left"><font size="3" color="#E77471"><b>Setting Time:</font></b></td>
<?
if($myrow[9] == '0' && $myrow[10] == '0' || $myrow[9]=='')
{?>
 <td><span class="tabletext"><p align="left">&nbsp;</p></font></td>
<?
}
else
{
printf('<td ><span class="tabletext"><font size="3"><p align="left">%.0f h : %.0f m</p></font></td>',
	     $myrow[9],$myrow[10] );
}?>
</td>
</tr>
<tr bgcolor="#FFFFFF" height='30px'>
<td colspan=2><span class="tabletext"><p align="left"><font size="3" color="#E77471"><b>Running Time:</font></b></td>
<?
if($myrow[11] == '0' && $myrow[12] == '0' || $myrow[11] == '')
{?>
 <td><span class="tabletext"><font size="3"><p align="left"></p></font></td>
<?}
else
{
printf('<td><span class="tabletext"><font size="3"><p align="left">%.0f h : %.0f m</p></font></td>',
	     $myrow[11],$myrow[12] );
}
?>
</td>
</tr>
<tr bgcolor="#FFFFFF" height='30px'>
<td colspan=2><span class="tabletext"><p align="left"><font size="3" color="#E77471"><b>Idle Time:</font></b></td>
<?
if($myrow[13] == '0' && $myrow[14] == '0' || $myrow[13] == '')
{?>
<td><span class="tabletext"><font size="3"><p align="left"></p></font></td>
<?
}
else
{
printf('<td><span class="tabletext"><font size="3"><p align="left">%.0f h : %.0f m</p></font></td>',
	     $myrow[13],$myrow[14] );
}

?>
</td>
</tr>
<tr bgcolor="#FFFFFF" height='30px'>
<td colspan=2><span class="tabletext"><p align="left"><font size="3" color="#E77471"><b>BreakDown Time:</font></b></td>
<?
if($myrow[19] == '0' && $myrow[20] == '0' || $myrow[19] == '')
{?>
 <td><span class="tabletext"><font size="3"><p align="left"></p></font></td>
<?}
else
{
printf('<td><span class="tabletext"><font size="3"><p align="left">%.0f h : %.0f m</p></font></td>',
	     $myrow[19],$myrow[20]);
}
?>
</td>
</tr>
</table>

</td>
<td>&nbsp;</td>
<td>

<table width="100%" ALIGN="center" border="1" cellpadding=3 cellspacing=1 bgcolor="#FFFFFF" height="400px">
<tr height="30px" bgcolor="#FFFFFF">
<td bgcolor="#A5EEFD" colspan='2'><span class="tabletext"><p align="left"><font size="3" color="#E77471"><b>Date:</font></b></td>
<td bgcolor="#A5EEFD" colspan=5><span class="tabletext"><font size="3"><p align="left"><?echo $date;?></p></font></td>
</tr>
<tr height="30px" bgcolor="#FFFFFF">
<td colspan=2><span class="tabletext"><p align="left"><font size="3" color="#E77471"><b>Qty Prod:</font></b></td>
<td colspan=5><span class="tabletext"><font size="3"><p align="left"><?echo $myrow[4];?></p></font></td>
</tr>
<tr height="30px" bgcolor="#FFFFFF">
<td colspan=2><span class="tabletext"><p align="left"><font size="3" color="#E77471"><b>Estimated Qty:</font></b></td>
<td colspan=5 ><span class="tabletext"><font size="3"><p align="left"><?echo number_format($estimated_qty,2);?></p></font></td>
</tr>
<tr height="30px" bgcolor="#FFFFFF">
<td colspan=2><span class="tabletext"><p align="left"><font size="3" color="#E77471"><b>Loss/Gain:</font></b></td>
<td colspan=5 ><span class="tabletext"><font size="3"><p align="left"><?echo $los;?></p></font></td>
</tr>
<tr height="30px" bgcolor="#FFFFFF">
<td colspan=2><span class="tabletext"><p align="left"><font size="3" color="#E77471"><b>Qty Rej:</font></b></td>
<td colspan=5 ><span class="tabletext"><font size="3"><p align="left"><?echo $myrow[15];?></p></font></td>
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