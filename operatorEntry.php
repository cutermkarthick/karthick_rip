<?php
//==============================================
// Author: FSI                                 =
// Date-written = april 04, 2007               =
// Filename: new_review.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of reviews                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
  header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$userrole = $_SESSION['userrole'];

$_SESSION['pagename'] = 'operator_details';
//////session_register('pagename');

// First include the class definition
include('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/operatorClass.php');
include_once('classes/empClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$oper_name = $_REQUEST['oper_name'];
$mc_name = $_REQUEST['mc_name'];
$crn = $_REQUEST['crn_num'];
$dept=$_SESSION['department'];
$page = "PRODN: Operator";
$newdisplay = new display;
$newoperator = new operator;
$newEmp = new emp();


?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/operator.js"></script>
<!--<script language="javascript" src="scripts/woentry.js"></script>-->


<html>
<head>
<title>Operator data</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>

<table  width=100% border=0 cellpadding=0 cellspacing=0 align=center valign=middle>
<tr>
<td>
<?php
if($dept !='PPC1' && $dept !='PPC2'&& $dept !='PPC3'&& $dept !='PPC4'&& $dept !='PPC5')
{
?>

<fieldset style="border: 1px solid black;padding:5px;">
<legend>
  <span class="pageheading"><b>Operator Data Form</b></span>
</legend>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=5 cellspacing=0  >
  
<form name='adddata' action='processoperator_data.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=82% border=0 cellpadding=3 cellspacing=2 bgcolor="#FFFFFF" style="margin-left:10%;border:1px solid black;">
<tr bgcolor="#A5EEFD">
<td colspan=2><span class="heading"><center><b><font size="2">Production Entry</b></center></td>
</tr>
<?php
$result = $newEmp->getEmp4Prodn();
?>
<tr bgcolor="#FFFFFF">
<td valign='top'>

<table width=80% height='435px' cellpadding=3 align='center' cellspacing=2 bgcolor="#DFDEDF" BORDERCOLOR="#804000" style="margin-left:80px;margin-right:30px;border:1px solid black;">
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
             <option value='BMV 1'>BMV 1
             <option value="VMC 2">VMC 2</option>
            <option  value="DMG 3">DMG 3</option>
            <option  value="DX 4">DX 4</option>
            <option value="HMC 5">HMC 5</option>
            <option value="HAAS">HAAS</option>
            <!-- <option value='BMV 60-2'>BMV 60-2
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
			       <option value='QT100S-5'>QT100S-5-->

             </select></td>

            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">Date</p></font></td>
              <td><span class="tabletext"><input type="text" id="st_date"  name="st_date" style="background-color:#DDDDDD;" readonly="readonly" size=8 value="">
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
              <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">PRN#</p></font></td>			 
            <td><span class="tabletext"><input type="text" id="crn" name="crn"  size=5 value="" onchange="getchangewo4crn();"></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">WO#</p></font></td>
              <td><span class="tabletext"><input type="text" id="wo_num" name="wo_num"  size=8 value="" style="background-color:#DDDDDD;"
                    readonly="readonly">
   <!-- <input type="button" class="stdbtn btn_blue" style="height:24px;margin-top:-2px;" onclick='Getwo_crnprodn("<?php echo 'wo_num' ?>")' value="Get WO" >                  -->
                   <img src='images/getwo.gif' name='cim' onclick='Getwo_crnprodn("<?php echo 'wo_num' ?>")'>
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
         <input type='hidden' name='partnum' value='<?php echo $myrow["partnum"];?>'></td>
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
         <td><span class="tabletext"><input type="text"  id="qty_rej" name="qty_rej" size=2 value=""></td>         
         </tr>

         <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left"><font size="2">Sl No. From</p></font></td>
         <td><span class="tabletext"><input type="text"  id="sl_from" name="sl_from" size=5 value=""></td>
         <td><span class="labeltext"><p align="left"><font size="2">Sl No. To</p></font></td>
         <td><span class="tabletext"><input type="text" id="sl_to" name="sl_to" size=5 value=""></td>
         </tr>  

		 <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left"><font size="2">Status</p></font></td>
         <td><span class="tabletext">
		 <?$stat=array('Approved','Pending','Cancelled');?>
		<select name="status">	
		<?php
		for($i=0;$i<count($stat);$i++){	
		if($stat[$i]==$_REQUEST['status']){
		?>
		<option selected value="<? echo $stat[$i]?>">
		<?echo $stat[$i] ?> </option>
		<?
		}
		else{
		?>
		<option value="<? echo $stat[$i]?>">
		<?echo $stat[$i]; ?> </option>
		<?php
		}
		}
		?>
		</select>
		</td>
		 <td><span class="labeltext"><font size="2">Remarks</font></td>
               <td><textarea id="remarks" name="remarks" rows="2"
			              style=";background-color:#FFFFF;"
			              cols="20" value=""></textarea></td>
        <input type="hidden"  id="wo_qty" name="wo_qty" size=3 value="">
</table>
</td></tr>
    </table>

	</td></tr>
    </table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()"></td></tr>
	

      </FORM>

</table>

</fieldset>
<?php
}
?>
</td></tr></table>

	</td>
    </tr>
    


</table>

</td>
	<!-- 	<td width="6"><img src="images/spacer.gif " width="6"></td>
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
