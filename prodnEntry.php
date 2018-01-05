<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: quoteDetailsEntry.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new quotes                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ))
{
   header( "Location: login.php" );
}
$userid = $_SESSION['user'];
$status=$_REQUEST['status'];
if ( isset ( $_REQUEST['objid'] ))
{
   $opmcobjid=$_REQUEST['objid'];
   $ncrecnum=$_REQUEST['ncrecnum'];
}
//echo "opmcobjid is $ncrecnum";
$_SESSION['pagename'] = 'prodnEntry';
//////session_register('pagename');

// First include the class definition
include('classes/displayClass.php');
include('classes/operatorClass.php');
include_once('classes/empClass.php');

$newdisplay = new display;
$op = new operator();
$newEmp = new emp();
?>
<input type="hidden"  name="total_prev_mins" id="total_prev_mins" size=3 value="<?echo $total_prev_mins;?>">

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/operator1.js"></script>


<html>
<head>
<title>New Production</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0" onload="javascript:createTab('prodnEntry');toggle_visibility()">
<table width=100% cellspacing="0" cellpadding="6" border="0">
 <tr bgcolor="#FFFFFF">
 <td colspan="25" align="center">
<?php
include('header.html');
include('header2.html');
?>
</td>
</tr>
</table>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
  					<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
  					<td align="right">&nbsp;
  					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
  				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr><td></td></tr>
				<tr>
					<td>

</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>

	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0>

<form action='processProdnEntry.php' method='post' enctype='multipart/form-data'>
<tr bgcolor="#FFFFFF">
<td align="center">

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#A5EEFD">
<td colspan=2><span class="heading"><center><b><font size="2">Production Entry</b></center></td>
</tr>
<?php
$result = $newEmp->getEmp4Prodn();
?>
<tr bgcolor="#FFFFFF">
<td valign='top'>

<table width=80% border=1 height='510px' cellpadding=3 align='center' cellspacing=1 bgcolor="#DFDEDF" BORDERCOLOR="#804000">
        <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">Operator No</p></font></td>
              <td><select id="oper_no" name="oper_no" onchange="getoperName()">
                               <option selected>Please Select
                                <?php
                                   while($row = mysql_fetch_row($result))
                                   {
                                     echo "<option value='$row[0] $row[1]|$row[2]'>$row[2]";
                                   }
                                ?>
                                   </select></td>
               <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">Operator Name</p></font></td>
         <td><span class="tabletext"><input type="text"  id="oper_name" name="oper_name" size="20" value="" style="background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">M/C Name</p></font></td>
            <td><select id="mc_name"  name="mc_name" onchange="getNext('pdate')">
             <option value='BMV 60-1'>BMV 60-1
             <option value='BMV 60-2'>BMV 60-2
             <option value='BMV 45-1'>BMV 45-1
             <option value='BMV 45-2'>BMV 45-2
             <option value='BMV 50'>BMV 50
             <option value='VMC 70L'>VMC 70L
             <option value='DMG 360L'>DMG 360L
             <option value='HMC 440'>HMC 440
             <option value='DX 200-1'>DX 200-1
             <option value='DX 200-2 '>DX 200-2
             <option value='DX 200-3'>DX 200-3
             <option value='HAAS'>HAAS
             <option value='MakinoF3'>MakinoF3
	         <option value='MakinoF5'>MakinoF5
             <option value='HAASVF2SS'>HAASVF2SS
	         <option value='VR11'>VR11
	         <option value='ST20'>ST20
	         <option value='ST20Y1'>ST20Y1
             <option value='HAASVF2SS-2'>HAASVF2SS-2
             <option value='MakinoF5-2'> MakinoF5-2
             <option value='MakinoF5-3'>MakinoF5-3
             <option value='MakinoF5-4'>MakinoF5-4
             <option value='EMAG-1'>EMAG-1
             <option value='A51nx-1'>A51nx-1
	     <option value='QT100S-1'>QT100S-1
	     <option value='QT100S-2'>QT100S-2
       	     <option value='QT100S-3'>QT100S-3
	     <option value='QT100S-4'>QT100S-4
	     <option value='QT100S-5'>QT100S-5

             </select></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">Date</p></font></td>
              <td><span class="tabletext"><input type="text" name="st_date" style="background-color:#DDDDDD;" readonly="readonly" size=8 value="">
               <img src="images/bu-getdateicon.gif" id= "pdate" name="pdate" alt="Get BookDate"  onclick="GetDate('st_date')"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">Shift</p></font></td>
             <td><select id="shift"  name="shift"  onchange="getsetting_time('crn');getchangewo();">
             <option value='1'>1
             <option value='2'>2
             <option value='3'>3
             </select></td>
            </td>
              <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">CRN#</p></font></td>
            <td><span class="tabletext"><input type="text" name="crn" id="crn" size=5 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">WO#</p></font></td>
              <td><span class="tabletext"><input type="text"  name="wo_num" id="wo_num" size=8 value="" style="background-color:#DDDDDD;"
                    readonly="readonly">
                   <img src='images/getwo.gif' name='cim' onclick='Getwo_crn4new("<?php echo 'wo_num' ?>")'>
            </td>

            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">Stage</p></font></td>
             <td><select id="stage"  name="stage" onchange="getsetting_time('setting_time')">
             <option value='1'>1
             <option value='3'>3
             <option value='5'>5
             <option value='7'>7
             <option value='9'>9
             <option value='11'>11
             <option value='13'>13
             <option value='15'>15
             <option value='17'>17
             <option value='19'>19
             <option value='21'>21
             <option value='23'>23
             </select></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">Setting Time</p></font></td>
           <td><span class="tabletext"><select id="setting_time"  name="setting_time" onchange="getsetting_time('setting_time_mins')">
		    <?
			for($i=0;$i<=8;$i++)
			{?>
            <option value=<?echo $i?>><?echo $i?>
			<?}?>
             </select>H
             <select id="setting_time_mins"  name="setting_time_mins" onchange="getsetting_time('running_time')">
			 <?for($i=0;$i<=59;$i++){?>
             <option value=<?echo $i?>><?echo $i?>
			 <?}?>
             </select>M</td>

             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">Running Time</p></font></td>
            <td><span class="tabletext"><select id="running_time"  name="running_time" onchange="getsetting_time('running_time_mins')">
		    <?
			for($i=0;$i<=8;$i++)
			{?>
            <option value=<?echo $i?>><?echo $i?>
			<?}?>
             </select>H
			  <select id="running_time_mins"  name="running_time_mins" onchange="getsetting_time('idle_time')">
			 <?for($i=0;$i<=59;$i++){?>
             <option value=<?echo $i?>><?echo $i?>
			 <?}?>
             </select>M</td>
			 </tr>
         <input type='hidden' name='partnum' id='partnum' value='<?php echo $myrow["partnum"];?>'></td>
         <input type='hidden' name='masterdatarecnum' value=""></td>
        </tr>

         <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left"><font size="2">Idle Time</p></font></td>
           <td><span class="tabletext">
		   <select id="idle_time"  name="idle_time" onchange="getsetting_time('idle_time_mins')">
		    <?
			for($i=0;$i<=8;$i++)
			{?>
            <option value=<?echo $i?>><?echo $i?>
			<?}?>
             </select>H
            <select id="idle_time_mins"  name="idle_time_mins" onchange="getsetting_time('breakdown_time')">
			 <?for($i=0;$i<=59;$i++){?>
             <option value=<?echo $i?>><?echo $i?>
			 <?}?>
             </select>M
			 </td>
			  <td><span class="labeltext"><p align="left"><font size="2">Breakdown Time</p></font></td>
           <td><span class="tabletext">
		   <select id="breakdown_time"  name="breakdown_time" onchange="getsetting_time('breakdown_time_mins')">
		    <?
			for($i=0;$i<=8;$i++)
			{?>
            <option value=<?echo $i?>><?echo $i?>
			<?}?>
             </select>H
            <select id="breakdown_time_mins"  name="breakdown_time_mins" onchange="getsetting_time('qty')">
			 <?for($i=0;$i<=59;$i++){?>
             <option value=<?echo $i?>><?echo $i?>
			 <?}?>
             </select>M
			 </td>
			 </tr>
          <input type="hidden" name="customer" id="customer" size=5 value="">
          <input type="hidden" name="ponum" id="ponum" size=5 value="">
          <input type="hidden" name="partname" id="partname" size=5 value="">
          <input type="hidden" name="bachnum" id="bachnum" size=5 value="">
          <input type="hidden" name="rm_spec" id="rm_spec" size=5 value="">
          <input type="hidden" name="attachments" id="attachments" size=5 value="">

         <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left"><font size="2">Qty Prod</p></font></td>
         <td><span class="tabletext"><input type="text"  id="qty" name="qty" size=2 value=""></td>
         <td><span class="labeltext"><p align="left"><font size="2">Qty Acc</p></font></td>
         <td><span class="tabletext"><input type="text"  id="qty_acc" name="qty_acc" size=2 value=""></td>
		 </tr>

         <tr bgcolor="#FFFFFF">
		 <td><span class="labeltext"><p align="left"><font size="2">Qty Rew</p></font></td>
         <td><span class="tabletext"><input type="text"  id="qty_rew" name="qty_rew" size=2 value=""></td>
         <td><span class="labeltext"><p align="left"><font size="2">Qty Rej</p></font></td>
         <td><span class="tabletext"><input type="text"  id="qty_rej" name="qty_rej" size=2 value="" onKeyUp="toggle_visibility()"></td>
         </tr>

         <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left"><font size="2">Sl No. From</p></font></td>
         <td><span class="tabletext"><input type="text"  id="sl_from" name="sl_from" size=5 value=""></td>
         <td><span class="labeltext"><p align="left"><font size="2">Sl No. To</p></font></td>
         <td><span class="tabletext"><input type="text" id="sl_to" name="sl_to" size=5 value="" ></td>
         </tr>

		 <tr bgcolor="#FFFFFF">
		 <td><span class="labeltext"><font size="2">Remarks</font></td>
         <td colspan=3><textarea id="remarks" name="remarks" rows="2"
			              style=";background-color:#FFFFF;"
			              cols="20" value=""></textarea>
		 </td>
		 </tr>
		 </table>
        <input type="hidden"  name="wo_qty" size=3 value="">
         <br/>
        <table width=80% border=1 cellpadding=3 align='center' id='description' cellspacing=1 bgcolor="#DFDEDF" BORDERCOLOR="#804000">
         <tr bgcolor="#FFFFFF">
         <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Breif Description of Non Conformance:</b><br>
         <textarea  name="brief_desc" id="brief_desc" rows=6 cols=60></textarea>
        </td>
        </tr>
        </table>

<?
if($status == 'submit')
{?>
</td>
<td valign='top'>
<?
$result4disp = $op->getmachine_details4graph($opmcobjid);
$myrow4disp = mysql_fetch_row($result4disp);

?>
<table width=100% border=1  cellpadding=3 align='center' cellspacing=1 bgcolor="#DFDEDF" BORDERCOLOR="#804000">
<tr bgcolor="#C9C299">
<td colspan='4'><span class="labeltext"><p align="center"><font size="2">Operator Production Details</p></font></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=8%><span class="labeltext"><p align="left"><font size="2">Operator Name</p></font></td>
<td><span class="tabletext" size=2><?php echo $myrow4disp[0]; ?></td>
<td width=8%><span class="labeltext"><p align="left"><font size="2">Machine Name</p></font></td>
<td><span class="tabletext" size=2><?php echo $myrow4disp[1]; ?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=8%><span class="labeltext"><p align="left"><font size="2">Qty</p></font></td>
<td><span class="tabletext" size=2><?php echo $myrow4disp[8]; ?></td>
<td width=8%><span class="labeltext"><p align="left"><font size="2">Qty Acc</p></font></td>
<td><span class="tabletext" size=2><?php echo $myrow4disp[19]; ?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=8%><span class="labeltext"><p align="left"><font size="2">Qty Rew</p></font></td>
<td><span class="tabletext" size=2><?php echo $myrow4disp[20]; ?></td>
<td width=8%><span class="labeltext"><p align="left"><font size="2">Qty Rej</p></font></td>
<td><span class="tabletext" size=2><?php echo $myrow4disp[18]; ?></td>
</tr>
<?php

if($myrow4disp[18] != 0 && $myrow4disp[18] != '' )
{

 $resultnc4disp = $op->getncdetails($ncrecnum);
 $myrownc4disp = mysql_fetch_row($resultnc4disp);
 if($myrownc4disp[1] != '' && $myrownc4disp[1] != '0000-00-00')
               {
                 $datearr = split('-', $myrownc4disp[1]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $create_date=date("M j, Y",$x);
               }
               else
               {
                 $create_date = '';
               }
?>
<tr bgcolor="#FFFFFF">
<td width=8%><span class="labeltext"><p align="left"><font size="2">NC #</p></font></td>
<td bgcolor="#E41B17"><span class="tabletext" size=2><b><?php echo $myrownc4disp[0]; ?><b></td>
<td width=8%><span class="labeltext"><p align="left"><font size="2">NC Date</p></font></td>
<td bgcolor="#E41B17"><span class="tabletext" size=2><b><?php echo $create_date; ?><b></td>
</tr>
<?php
}
?>
<tr bgcolor="#FFFFFF">
<td width=8%><span class="labeltext"><p align="left"><font size="2">CRN #</p></font></td>
<td><span class="tabletext" size=2><?php echo $myrow4disp[15]; ?></td>
<td width=8%><span class="labeltext"><p align="left"><font size="2">Shift</p></font></td>
<td><span class="tabletext" size=2><?php echo $myrow4disp[3]; ?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=8%><span class="labeltext"><p align="left"><font size="2">WO #</p></font></td>
<td><span class="tabletext" size=2><?php echo $myrow4disp[17]; ?></td>
<td width=8%><span class="labeltext"><p align="left"><font size="2">Stage</p></font></td>
<td><span class="tabletext" size=2><?php echo $myrow4disp[16]; ?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=8%><span class="labeltext"><p align="left"><font size="2">Setting Time</p></font></td>
<?
if($myrow4disp[4] == '0' && $myrow4disp[5] == '0' || $myrow4disp[4]=='')
{?>
 <td><span class="tabletext" size=2><p align="left">&nbsp;</p></font></td>
<?
}
else
{
printf('<td><span class="tabletext" size=2><p align="left">%.0f h : %.0f m</p></font></td>',
	     $myrow4disp[4],$myrow4disp[5] );
}?>
</td>
<td width=8%><span class="labeltext"><p align="left"><font size="2">Running Time</p></font></td>
<?
if($myrow4disp[6] == '0' && $myrow4disp[7] == '0' || $myrow4disp[6]=='')
{?>
 <td><span class="tabletext" size=2><p align="left">&nbsp;</p></font></td>
<?
}
else
{
printf('<td><span class="tabletext" size=2><p align="left">%.0f h : %.0f m</p></font></td>',
	     $myrow4disp[6],$myrow4disp[7] );
}?>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=8%><span class="labeltext"><p align="left"><font size="2">Idle Time</p></font></td>
<?
if($myrow4disp[9] == '0' && $myrow4disp[10] == '0' || $myrow4disp[9]=='')
{?>
 <td><span class="tabletext" size=2><p align="left">&nbsp;</p></font></td>
<?
}
else
{
printf('<td><span class="tabletext" size=2><p align="left">%.0f h : %.0f m</p></font></td>',
	     $myrow4disp[9],$myrow4disp[10] );
}?>
</td>
<td width=8%><span class="labeltext"><p align="left"><font size="2">BreakDown Time</p></font></td>
<?
if($myrow4disp[11] == '0' && $myrow4disp[12] == '0' || $myrow4disp[11]=='')
{?>
 <td><span class="tabletext" size=2><p align="left">&nbsp;</p></font></td>
<?
}
else
{
printf('<td><span class="tabletext" size=2><p align="left">%.0f h : %.0f m</p></font></td>',
	     $myrow4disp[11],$myrow4disp[12] );
}
$accept_efficiency = 0;

$running_in_timemaster=(($myrow4disp[13]*60)+$myrow4disp[14]) * $myrow4disp[19];

$timemaster_running=(($myrow4disp[13]*60)+$myrow4disp[14]);
$running_time_operator=($myrow4disp[6]*60)+$myrow4disp[7];
$accqty_rejqty = $myrow4disp[18]+$myrow4disp[19];
$totidealtime=($accqty_rejqty*$timemaster_running);
$optime_with_rej=$running_time_operator+($myrow4disp[18] * $timemaster_running);

if($running_time_operator == '0' || $running_time_operator == '')
{
$accept_efficiency = 0;
$total_efficiency = 0;
}
else
{
$accept_efficiency = ($running_in_timemaster / $running_time_operator)*100;
$total_efficiency = ($totidealtime/$optime_with_rej)*100;
}
//echo $accept_efficiency."------------------".$total_efficiency;
?>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=8%><span class="labeltext"><p align="left"><font size="2">Date</p></font></td>
<?
  if( $myrow4disp[2] != '0000-00-00' &&  $myrow4disp[2] != '' &&  $myrow4disp[2] != 'NULL')
  {
	$datearr = split('-', $myrow4disp[2]);
	$d=$datearr[2];
	$m=$datearr[1];
	$y=$datearr[0];
	$x=mktime(0,0,0,$m,$d,$y);
	$date=date("M j, Y",$x);
  }
?>
<td><span class="tabletext" size=2><?php echo $date; ?></td>
<td width=8%><span class="labeltext"><p align="left"><font size="2">Remarks</p></font></td>
  <td><textarea rows="2"
			              style=";background-color:#FFFFF;"
			              cols="18" readonly><?echo $myrow4disp[21];?></textarea>
		 </td>
</tr>
<?
$result = $op->getmachine_details4graph($opmcobjid);
$num_rows=mysql_num_rows($result);
if($num_rows != 0)
{
?>
<tr bgcolor="#FFFFFF">
<td colspan=4 align='center'>
<?
include_once 'ofc-library/open_flash_chart_object.php';
open_flash_chart_object( 350, 200, 'http://'.$_SERVER['SERVER_NAME'] .'/wms/prodnentry-data.php?accept_efficiency='.$accept_efficiency.'&total_efficiency='.$total_efficiency,false );
?>
</td>
</tr>
</table>
<?}
else
{
?>
<table width=100% border=0  cellpadding=3 align='center' cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td colspan='4'><span class="labeltext"><p align="center"><font size="2" color='red'>No Entry in Time Master for  CRN# :<?echo $myrow4disp[15];?></p></font></td>
</tr>
</table>
<?}?>
</td></tr>
</table>
<?}?>
</table>
</td>
 	</table>
<tr><td align="center">
<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()"></td></tr>
</FORM>
</table>
</body>
</html>
