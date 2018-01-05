<?php
//
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
$page = "PRODN: Operator";

$_SESSION['pagename'] = 'edit_operator_data';
//////session_register('pagename');

// First include the class definition
include('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/operatorClass.php');
include_once('classes/empClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$operatorrecnum = $_REQUEST['operatorrecnum'];

$newdisplay = new display;
$newoperator = new operator;
$newEmp = new emp();
$result = $newoperator->getoper_data_4_edit($operatorrecnum);
$myrow = mysql_fetch_assoc($result);


$result1 = $newoperator->getstage_data($operatorrecnum);
$myrow1 = mysql_fetch_assoc($result1);
$datearr = split(' ', $myrow['oper_name']);

$result2 = $newoperator->getmcs();
$result4qty = $newoperator->getwo_qty($myrow['wo_num']);
$myrow4qty = mysql_fetch_row($result4qty);

$result2=$newoperator->getEditcurrenttime($myrow['mc_name'],$myrow['st_date'],$myrow['shift'],$operatorrecnum);
$myrow2 = mysql_fetch_row($result2);
$total_prev_mins = ((($myrow2[2] * 60) + $myrow2[3] + ($myrow2[4] * 60) + $myrow2[5] + ($myrow2[6] * 60) + $myrow2[7]));
$approval_flag = '0';
$result_approval=$newoperator->wo_approval($myrow['wo_num']);
if(mysql_num_rows($result_approval) == 0)
{
   $approval_flag = '1';
}
?>
<input type="hidden"  name="total_prev_mins" id="total_prev_mins" size=3 value="<?echo $total_prev_mins;?>">
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/operator.js"></script>

<html>
<head>
<title>Operator data</title>
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
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF"> -->
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>Operator Data Form</b></td>
    </tr>


     <form action='processoperator_data.php' method='post' enctype='multipart/form-data'>
<tr>
<td>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#A5EEFD">
<td colspan=2><span class="heading"><center><b><font size="2">Edit Production Entry</b></center></td>
</tr>
<?php
$result2 = $newoperator->getselectedOperName($datearr[0]);
$myrow4oper = mysql_fetch_assoc($result2);
?>
<tr bgcolor="#FFFFFF">
<td valign='top'>

<table width=80% border=1 height='435px' cellpadding=3 align='center' cellspacing=1 bgcolor="#DFDEDF" BORDERCOLOR="#804000" class="stdtable1">
        <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">Operator No</p></font></td>
              <td><span class="labeltext"><?echo $myrow4oper['empcode'];?></td>
               <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">Operator Name</p></font></td>
         <td><span class="labeltext"><?echo $myrow['oper_name'];?></td>
        </tr>
           <tr bgcolor="#FFFFFF">

            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">M/C Name</p></font></td>			
           <td><span class="labeltext"><?php echo $myrow['mc_name'] ?></td>   

            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">Date</p></font></td>
              <td><span class="tabletext"><input type="text" id="st_date" name="st_date" style="background-color:#DDDDDD;" readonly="readonly" size=8 value="<?echo $myrow['st_date'];?>">
               <img src="images/bu-getdateicon.gif" id= "pdate" name="pdate" alt="Get BookDate"  onclick="GetDate('')"></td>
        </tr>
        <input type="hidden" id="mc_name" name="mc_name" value="<?echo $myrow['mc_name'];?>">
		   <input type="hidden" name="operatorrecnum" value="<?echo $operatorrecnum?>">
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">Shift</p></font></td>
           <td>
			<select name="shift" id="shift"  width=4 onchange="javascript:getWO()">
            <?
              $shift=array(1,2,3);			  
			  for($i=0;$i<3;$i++)
			  {
			  if($myrow['shift'] == $shift[$i]){?>
              <option selected value="<? echo $shift[$i]?>"><?echo $shift[$i]; ?> 
			  </option>
			  <?}
			  else
			  {?>
               <option value="<? echo $shift[$i]?>"><?echo $shift[$i]; ?> 
			  </option>
			  <?}
			  }?>
			  </select>
              </td>
        
              <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">CRN#</p></font></td>			 
            <td><span class="tabletext"><input type="text" name="crn" id="crn" size=5 value="<?php echo $myrow['crn'] ?>" onchange="getchangewo4crn();"></td>              
        </tr>
        
        <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">WO#</p></font></td>
              <td><span class="tabletext"><input type="text"  name="wo_num" id="wo_num" size=8 value="<?php echo $myrow['wo_num'] ?>" style="background-color:#DDDDDD;"
                    readonly="readonly">
                   <img src='images/getwo.gif' name='cim' onclick='Getwo_crnprodn("<?php echo 'wo_num' ?>")'>
            </td>

            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">Stage</p></font></td>
             <td><select id="stage"  name="stage" onchange="getsetting_time('setting_time')">
			 <?$stage=array('1','3','5','7','9','11','13','15','17','19','21','23');  
					
					for($x=0;$x<count($stage);$x++){					
					if($stage[$x] == $myrow1['stage_num']){?>
					<option selected value="<? echo $stage[$x]?>"><?echo $stage[$x]; ?> 
					</option>
					<?}
					else{?>
                    <option value="<? echo $stage[$x]?>"><?echo $stage[$x]; ?> 
					</option>
					<?}
					}?>
				
             </td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">Setting Time</p></font></td>		
           <td><span class="tabletext"><select id="setting_time"  name="setting_time" onchange="getsetting_time('setting_time_mins')">
		    <? 
			for($i=0;$i<=8;$i++)
			{
			if($i == $myrow1['setting_time'])
			{?>
            <option selected value=<?echo $i?>><?echo $i?>
			</option>
			<?}
			else{?>
			<option value=<?echo $i?>><?echo $i?>
			</option>
			<?}
			}?>

             </select>H
             <select id="setting_time_mins"  name="setting_time_mins" onchange="getsetting_time('running_time')">
			 <?for($i=0;$i<=59;$i++){
			 if($i == $myrow1['setting_time_mins'])
			 {?>
             <option selected value=<?echo $i?>><?echo $i?>
	         </option>
			 <?}
			 else{?>
			 <option value=<?echo $i?>><?echo $i?>
			 </option>
			 <?}
			 }?>


             </select>M</td>           

             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span><font size="2">Running Time</p></font></td>
            <td><span class="tabletext"><select id="running_time"  name="running_time" onchange="getsetting_time('running_time_mins')">
		    <? 					
			for($x=0;$x<=8;$x++)
			{
			if($x == $myrow1['running_time'])
			{?>
             <option selected value=<?echo $x?>><?echo $x?>
             </option>
			 <?}
			 else{?>
			  <option  value=<?echo $x?>><?echo $x?>
              </option>
			<?}
			}?>
             </select>H
			  <select id="running_time_mins"  name="running_time_mins" onchange="getsetting_time('idle_time')">
			 <?for($j=0;$j<=59;$j++){
			if($j == $myrow1['running_time_mins'])
			 {?>
             <option selected value=<?echo $j?>><?echo $j?>
            </option>
			 <?}
			 else{?>
             <option  value=<?echo $j?>><?echo $j?>
            </option>
			 <?}
			}?>
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
			{
			if($i == $myrow1['idle_time'])
			{?>
            <option selected value=<?echo $i?>><?echo $i?>
			</option>
			<?}
			else{?>
			<option value=<?echo $i?>><?echo $i?>
            </option>
			 <?}
			}?>

             </select>H
            <select id="idle_time_mins"  name="idle_time_mins" onchange="getsetting_time('breakdown_time')">
			 <?for($i=0;$i<=59;$i++){
			 if($i == $myrow1['idle_time_mins'])
			 {?>
              <option selected value=<?echo $i?>><?echo $i?>
              </option>
			  <?}
			  else{?>
			  <option value=<?echo $i?>><?echo $i?>
              </option>
			 <?}
			 }?>
             </select>M
			 </td>		
			  <td><span class="labeltext"><p align="left"><font size="2">Breakdown Time</p></font></td>
           <td><span class="tabletext">
		   <select id="breakdown_time"  name="breakdown_time" onchange="getsetting_time('breakdown_time_mins')">
		    <? 
			for($i=0;$i<=8;$i++)
			{
			if($i == $myrow1['breakdown_time'])
			{?>
            <option selected value=<?echo $i?>><?echo $i?>
			 </option>
			<?}else{?>
           <option value=<?echo $i?>><?echo $i?>
		   </option>
			 <?}
			 }?>
             </select>H
            <select id="breakdown_time_mins"  name="breakdown_time_mins" onchange="getsetting_time('qty')">
			 <?for($i=0;$i<=59;$i++)
			 {
			 if($i == $myrow1['breakdown_time_mins'])
			 {?>
             <option selected value=<?echo $i?>><?echo $i?>
            </option>
			<?}else{?>
            <option value=<?echo $i?>><?echo $i?>
            </option>
			 <?}
			 }?>
             </select>M
			 </td>		
			 </tr>
       
         <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left"><font size="2">Qty Prod</p></font></td>
         <td><span class="tabletext"><input type="text"  id="qty" name="qty" size=2 value="<?echo $myrow1['qty'];?>">
         <input type="hidden"  id="prev_prod_qty" name="prev_prod_qty" size=2 value="<?echo $myrow1['qty'];?>"></td>
         <td><span class="labeltext"><p align="left"><font size="2">Qty Acc</p></font></td>
         <td><span class="tabletext"><input type="text"  id="qty_acc" name="qty_acc" size=2 value="<?echo $myrow1['qty_acc'];?>"></td>  
		 </tr>

         <tr bgcolor="#FFFFFF">
		 <td><span class="labeltext"><p align="left"><font size="2">Qty Rew</p></font></td>
         <td><span class="tabletext"><input type="text"  id="qty_rew" name="qty_rew" size=2 value="<?echo $myrow1['qty_rew'];?>"></td>        
         <td><span class="labeltext"><p align="left"><font size="2">Qty Rej</p></font></td>
         <td><span class="tabletext"><input type="text"  id="qty_rej" name="qty_rej" size=2 value="<?echo $myrow1['qty_rej'];?>"></td>         
         </tr>

         <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left"><font size="2">Sl No. From</p></font></td>
         <td><span class="tabletext"><input type="text"  id="sl_from" name="sl_from" size=5 value="<?echo $myrow1['sl_from'];?>"></td>
         <td><span class="labeltext"><p align="left"><font size="2">Sl No. To</p></font></td>
         <td><span class="tabletext"><input type="text" id="sl_to" name="sl_to" size=5 value="<?echo $myrow1['sl_to'];?>"></td>
         </tr>  

		 <tr bgcolor="#FFFFFF">	       
		 <td><span class="labeltext"><font size="2">Status</font></td>
					<td><span class="tabletext">
					<select name="status" id="status"  width=4>
					<?$status=array('Pending','Approved','Cancelled');					
					for($j=0;$j<count($status);$j++){
					
					if($status[$j] == $myrow['status']){?>
					<option selected value="<? echo $status[$j]?>"><?echo $status[$j]; ?> 
					</option>
					<?}
					else{?>
                    <option value="<? echo $status[$j]?>"><?echo $status[$j]; ?> 
					</option>
					<?}
					}?>
					</td>
					<td><span class="labeltext">Remarks</font></td>
            <td colspan=27><textarea name="remarks"
			        style="background-color:#FFFFF;"
                    rows="3"  cols="45"><?php echo $myrow['remarks'] ?></textarea></td>
						  </tr>
        <input type="hidden"  name="wo_qty" id="wo_qty" size=3 value="<?php echo $myrow4qty[0]?>">
        <input type="hidden"  id="approval_flag" name="approval_flag" size=3 value="<?php echo $approval_flag ?>"> 
        
</table>
</td></tr></table>






		<?
		$result = $newoperator->getqty1($operatorrecnum);	
		$myrow=mysql_fetch_row($result);?>
        <input type="hidden" name="currentqty" size=2 value="<?php echo $myrow[1]; ?>">            
            <input type="hidden" id="wo_qty"  name="wo_qty" size=3 value="<? echo $myrow4qty[0]?>">

            
    
	</td>
    </tr>

</table>

</td>
<!-- 		<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
 -->
		</table>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Update" name="submit" onclick="javascript: return edit_check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">

</FORM>
</table>
</body>
</html>
