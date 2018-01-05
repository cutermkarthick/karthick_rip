<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: edit_nc4qa.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows Editing for QA NC                    =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'edit_nc4qa';
$page = "QA: NC";
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/nc4qaclass.php');
include('classes/displayClass.php');

$dept = $_SESSION['department'];
   //echo $dept."-----";
$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newnc = new nc4qa;
//echo $dept;
$nc4qarecnum = $_REQUEST['nc4qarecnum'];

$result = $newnc->getqanc($nc4qarecnum);
$myrow =  mysql_fetch_row($result);
$sup_name = $myrow[31];
$op_name = $myrow[32];

if((substr($myrow[1],2,2) =='A-') || (substr($myrow[1],2,2) =='K-')) 
      {
      $wo_status=$newnc->getassywostat($myrow[11]);
      }
      else
      {
$wo_status=$newnc->getwostat($myrow[11]);
}
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/nc4qa.js"></script>


<html>
<head>
<script language="javascript" type="text/javascript">
function readOnlyRadio() {
//alert("HERE--");
   return false;
}

</script>
<title>Edit QA NC</title>
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
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>Edit NC</b></td>
    </tr>


     <form action='processnc4qa.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>NC Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Id No.</p></font></td>
            <td colspan=3><input type="text" name="idnum" size=20 value="<?php printf("%05d", $myrow[0]) ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
         </tr>
<?php
// Modified by BM on July 5, 2013 - requested by Mr . V so that QA can Close and also change Disposition status
//if($dept!='QA' && $dept!='Production')
if($dept=='Sales' || 
   ($dept == 'Production' && ($nc4qarecnum =='5214' || 
                              $nc4qarecnum =='5296' )
   ) || 
   ($dept == 'QA' && ($nc4qarecnum == '00003' || 
                      $nc4qarecnum == '00004' || 
                      $nc4qarecnum == '00053' || 
                      $nc4qarecnum == '00066' || 
                      $nc4qarecnum == '00071' || 
                      $nc4qarecnum == '00084' || 
                      $nc4qarecnum == '00090' || 
                      $nc4qarecnum == '00108' || 
                      $nc4qarecnum == '00117' || 
                      $nc4qarecnum == '00134' 
                     )
    )
  )
{
?>
        <tr bgcolor="#FFFFFF">

            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>CIM Ref Num.</p></font></td>
            <td width=25%><span class="tabletext"><input type="text" name="refnum" id="refnum" size=20 value="<?php echo $myrow[1] ?>" onblur="resetWO()"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Stage #</p></font></td>
            <td><input type="text" name="stagenum" id="stagenum" size=20 value="<?php echo $myrow[46] ?>" onblur="resetWO()"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>WO No.</p></font></td>
            <td colspan=4><input type="text" name="wonum" id="wonum" size=20 value="<?php echo $myrow[11] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/getwo.gif" alt="Get wo" onclick="Getwo_qa()"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">WO Type</p></font></td>
            <td><input type="text" name="wotype" id="wotype" size=20 value="<?php echo $myrow[44] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
                </td>
            <td width=25%><span class="labeltext"><p align="left">DN #</p></font></td>
            <td width=25%><span class="tabletext"><input type="text" name="dnnum" id="dnnum" size=20 value="<?php echo $myrow[45] ?>"></td>
        </tr>


        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
            <td width=25%><input type="text" name="customer" id="customer" size=30 value="<?php echo $myrow[2] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
             <input type="hidden" name="custrecnum"></td>
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO No.</p></font></td>
            <td><input type="text" name="ponum" id="ponum" size=20 value="<?php echo $myrow[9] ?>"  style=";background-color:#DDDDDD;" readonly="readonly">
              <input type="hidden" name="porecnum">
              <input type="hidden" name="wo_status" id="wo_status" value="<?php echo $wo_status ?>">
                </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></font></td>
            <td><input type="text" name="partname" id="partname" size=20 value="<?php echo $myrow[3] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part No.</p></font></td>
            <td><input type="text" name="partnum" id="partnum" size=20 value="<?php echo $myrow[5] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Batch No.</p></font></td>
            <td><input type="text" id="bachnum" name="bachnum" size=20 value="<?php echo $myrow[4] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
            </td>
            <td><span class="labeltext"><p align="left">Matl. Spec</p></font></td>
            <td><input type="text" name="matl_spec"  id="matl_spec" size=20 value="<?php echo $myrow[6] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Issue & PS</p></font></td>
            <td><input type="text" name="issues_ps" id="issues_ps" size=20 value="<?php echo $myrow[7] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>


          <td><span class="labeltext"><p align="left">Qty</p></font></td>
            <td><input type="text" name="qty" id="qty" size=20 value="<?php echo $myrow[8] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
             </tr>



           <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Sl No.</p></font></td>
            <td><input type="text" name="part_sl_num" id="part_sl_num" size=20 value="<?php echo $myrow[10] ?>"></td>
            <td><span class="labeltext"><p align="left">DC No.</p></font></td>
            <td><input type="text" name="dcnum" id="dcnum" size=20 value="<?php echo $myrow[12] ?>"></td>
        </tr>


        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">DC Date</p></font></td>
        <td><input type="text" name="dcdate" id="dcdate" size=20 value="<?php echo $myrow[13] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
        <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('dcdate')"></td>
        <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>C of C No.</p></font></td>
        <td><input type="text" name="cofcnum" id="cofcnum"  size=20 value="<?php echo $myrow[29] ?>">
        <img src="images/bu-get.gif" alt="Get Cofc" onclick="Getcofc('cofcnum')"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supervisor Name</p></font></td>
	<td><input type="text" id="sup_name" name="sup_name" size=15 value="<?php echo $sup_name ?>" style=";background-color:#DDDDDD;" 			readonly="readonly">
	<select name="sup_name1" onchange="onSelectsecretary()">
        <option value="select">Select</option>

	<?php
	$result1 = $newnc->geSupnOperNames();
        while ($myrow1 = mysql_fetch_row($result1)){
	if($myrow1[0]==$sup_name){
	?>
		<option selected value="<? echo $myrow1[0]?>">
		<?echo $myrow1[0]; ?> </option>
		<?
		}
		else{
		?>
		<option value="<? echo $myrow1[0]?>">
		<?echo $myrow1[0]; ?> </option>
		<?php
		}
		}
		?>
		</select>
        </td>

        <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Operator Name</p></font></td>
        <td><div id="wo_opnames"><textarea name="op_name" id="op_name" rows=3 cols=30><?php echo $op_name?></textarea>
		</td>
       </tr>

       <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>Cust NC#</p></font></td>
        <td><input type="text" id="cust_ncno" name="cust_ncno" size=20 value="<?php echo $myrow[33] ?>">
        </td>
        <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>Cust NC Date</p></font></td>
        <td><input type="text"  id="cust_ncdate" name="cust_ncdate" size=20 value="<?php echo $myrow[34] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
        <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('cust_ncdate')"></td>
       </tr>

	   <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>RM Cost</p></font></td>
        <td><input type="text" id="rm_cost" name="rm_cost" size=20 value="<?php echo $myrow[38] ?>">
		<span class="tabletext">
		<select name="currency" id="currency"  width=2>
		            <?
		            $currency=array('$','Rs');
					for($j=0;$j<count($currency);$j++){

					if($currency[$j] == $myrow[39]){?>
					<option selected value="<? echo $currency[$j]?>"><?echo $currency[$j]; ?>
					</option>
					<?}
					else{?>
                    <option value="<? echo $currency[$j]?>"><?echo $currency[$j]; ?>
					</option>
					<?}
					}?>

        </td>
         <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td><span class="tabletext"><input type="text" name="status" id="status"
                         readonly="readonly" style=";background-color:#DDDDDD;" value="<?php echo $myrow[40] ?>">
	            <span class="tabletext">
                 <?php
	            if($myrow[40]=='Open')
	             {
	            ?>
                <select name="ncstate" size="1" width="20" onchange="onSelectStatus(this)">
 	            <option value='Select'>Please Specify</option>
	            <option value='Open'>Open</option>
	            <option value='Closed'>Closed</option>
	            </select>
	           <?php
                }
                else
                {
	            ?>
	            <select name="ncstate" size="1" width="20" onchange="onSelectStatus(this)">
 	            <option value='Select'>Please Specify</option>
	            <option value='Open'>Open</option>
	            <option value='Closed'>Closed</option>
	            <option value='Pending'>Pending</option>
	            </select>
	             <?php
                }
   	            ?>
            </td>
         </tr>
		 <input type='hidden' name='op_name1' id='op_name1' value=''>
		   <tr bgcolor="#FFFFFF"> 
 <td><span class="labeltext"><p align="left">Machine Name</p></td>
 <td>
 <div id="machine_name">
 <input type="text" id="mc_name" name="mc_name" size=20 value="<?=$myrow[48]?>" style=";background-color:#DDDDDD;" readonly="readonly">
 </div>
 </td>
 <input type='hidden' name='mc_name1' id='mc_name1' value='<?=$myrow[48]?>'>
<td><span class="labeltext"><p align="left">Created By</p></td>
 <td>
 <input type="text" id="created_by" name="created_by" size=20 value="<?=$myrow[49]?>" style=";background-color:#DDDDDD;" readonly="readonly">
 </td>
 </tr>

    <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Remarks/Attachments:</b><br>
    <textarea name="remarks" id="remarks" rows=6 cols=60 ><?php echo $myrow[35] ?></textarea>
    </td>
    </tr>



<input type="hidden" name="action" value="edit">
<input type="hidden" name="nc4qarecnum" value="<?php echo $nc4qarecnum ?>">

<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#DDDEDD">
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">ERROR TYPE</td>
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">CAUSE</td>
     <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">STAGE</td>
     <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">DISPOSITION</td>
   </tr>

<tr>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">DIMENSIONAL DEVIATION</td>
   <?php

   $checked1="";

   if($myrow[15] == 'yes'){
   $checked1="checked";
   }
   ?>

   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked1 ?> name="chk1"  id="chk1" onclick="JavaScript:toggleValue('dim_deviation',this);">
                         <input type="hidden" name="dim_deviation" value="<?php echo $myrow[15]?>" id="dim_deviation"></td>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">MAN</td>
   <?php

   $checked2="";

   if($myrow[16] == 'yes'){
   $checked2="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked2 ?> name="chk2" id="chk2"  onclick="JavaScript:toggleValue('man',this);">
                         <input type="hidden" name="man"  value="<?php echo $myrow[16]?>" id="man"></td>
   <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">IN PROCESS</td>
    <?php

   $checked3="";

   if($myrow[17] == 'yes'){
   $checked3="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?> name="chk3" id="chk3" onclick="JavaScript:toggleValue('inprocess',this);">
                         <input type="hidden" name="inprocess"  value="<?php echo $myrow[17]?>"  id="inprocess"></td>

  <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">ACCEPTED</td>
    <?php

   $checked3="";

   if($myrow[41] == 'yes'){
   $checked3="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?> name="chk10" id="chk10" onclick="JavaScript:toggleValue('accepted',this);">
                         <input type="hidden" name="accepted" id="accepted" value="<?php echo $myrow[41]?>"  ></td>

</tr>
<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">MATERIAL DEVIATION</td>
  <?php

   $checked4="";

   if($myrow[18] == 'yes'){
   $checked4="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked4 ?> name="chk4" id="chk4" onclick="JavaScript:toggleValue('mat_deviation',this);">
                         <input type="hidden" name="mat_deviation"  value="<?php echo $myrow[18]?>"  id="mat_deviation"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">MACHINE</td>
   <?php

   $checked5="";

   if($myrow[19] == 'yes'){
   $checked5="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked5 ?> name="chk5" id="chk5" onclick="JavaScript:toggleValue('machine',this);">
                         <input type="hidden" name="machine"  value="<?php echo $myrow[19]?>"  id="machine"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">FINAL INSPECTION</td>
   <?php

   $checked6="";

   if($myrow[20] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="chk6" id="chk6" onclick="JavaScript:toggleValue('final_insp',this);">
                         <input type="hidden" name="final_insp"  value="<?php echo $myrow[20]?>" id="final_insp"></td>
    <td bgcolor="#FFFFFF"><span class="labeltext">REJECTED</td>
   <?php

   $checked6="";

   if($myrow[42] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="chk11" id="chk11" onclick="JavaScript:toggleValue('rejected',this);">
                         <input type="hidden" name="rejected"  value="<?php echo $myrow[42]?>" id="rejected"></td>

</tr>
 </tr>
<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">OTHER DEVIATION</td>
  <?php

   $checked7="";

   if($myrow[21] == 'yes'){
   $checked7="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked7 ?> name="chk7" id="chk7" onclick="JavaScript:toggleValue('other_deviation',this);">
                         <input type="hidden" name="other_deviation"  value="<?php echo $myrow[21]?>"  id="other_deviation"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">METHOD</td>
   <?php

   $checked8="";

   if($myrow[22] == 'yes'){
   $checked8="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked8 ?> name="chk8" id="chk8" onclick="JavaScript:toggleValue('method',this);">
                         <input type="hidden" name="method"  value="<?php echo $myrow[22]?>"  id="method"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">CUSTOMER END</td>
   <?php

   $checked9="";

   if($myrow[23] == 'yes'){
   $checked9="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked9 ?> name="chk9"  id="chk9"  id="chk9" onclick="JavaScript:toggleValue('cust_end',this);">
                         <input type="hidden" name="cust_end"  value="<?php echo $myrow[23]?>" id="cust_end"></td>
                          <td bgcolor="#FFFFFF"><span class="labeltext">QUARANTINED</td>
   <?php

   $checked6="";

   if($myrow[43] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="chk12"  id="chk12" onclick="JavaScript:toggleValue('quarantined',this);">
                         <input type="hidden" name="quarantined"  value="<?php echo $myrow[43]?>" id="quarantined"></td>
</tr>
<tr>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>


 <td bgcolor="#FFFFFF"><span class="labeltext">REWORK</td>
   <?php

   $checked6="";

   if($myrow[47] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="chk13" id="chk13" onclick="JavaScript:toggleValue('rework',this);">
                         <input type="hidden" name="rework"  value="<?php echo $myrow[47]?>" id="rework"></td>
</tr>


</tr>
 <?php
 }
 else if($myrow[40] !='Pending'  && $dept != 'PPC2')
 {?>
   <tr bgcolor="#FFFFFF">
             <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>CIM Ref Num.</p></font></td>
            <td width=25%><span class="tabletext"><input type="text" name="refnum" id="refnum" size=20 value="<?php echo $myrow[1] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Stage #</p></font></td>
            <td><input type="text" name="stagenum" id="stagenum" size=20 value="<?php echo $myrow[46] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>

        </tr>
        <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>WO No.</p></font></td>
            <td colspan=4><input type="text" name="wonum" id="wonum" size=20 value="<?php echo $myrow[11] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
                </td>
                </tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">WO Type</p></font></td>
            <td><input type="text" name="wotype" id="wotype" size=20 value="<?php echo $myrow[44] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
                </td>
            <td width=25%><span class="labeltext"><p align="left">DN #</p></font></td>
            <td width=25%><span class="tabletext"><input type="text" name="dnnum" id="dnnum" size=20 value="<?php echo $myrow[45] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
             <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
             <td width=25%><input type="text" name="customer" id="customer" size=30 value="<?php echo $myrow[2] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
             <input type="hidden" name="custrecnum"></td>
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO No.</p></font></td>
             <td><input type="text" name="ponum" id="ponum" size=20 value="<?php echo $myrow[9] ?>"  style=";background-color:#DDDDDD;" readonly="readonly">
                 <input type="hidden" name="porecnum">
                <input type="hidden" name="wo_status" id="wo_status" value="<?php echo $wo_status ?>">
             </td>
         </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></font></td>
            <td><input type="text" name="partname" id="partname" size=20 value="<?php echo $myrow[3] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part No.</p></font></td>
            <td><input type="text" name="partnum" id="partnum" size=20 value="<?php echo $myrow[5] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Batch No.</p></font></td>
            <td><input type="text" id="bachnum" name="bachnum" size=20 value="<?php echo $myrow[4] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
            </td>
            <td><span class="labeltext"><p align="left">Matl. Spec</p></font></td>
            <td><input type="text" name="matl_spec"  id="matl_spec" size=20 value="<?php echo $myrow[6] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Issue & PS</p></font></td>
            <td><input type="text" name="issues_ps" id="issues_ps" size=20 value="<?php echo $myrow[7] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left">Qty</p></font></td>
            <td><input type="text" name="qty" id="qty" size=20 value="<?php echo $myrow[8] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Sl No.</p></font></td>
            <td><input type="text" name="part_sl_num" id="part_sl_num" size=20 value="<?php echo $myrow[10] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left">DC No.</p></font></td>
            <td><input type="text" name="dcnum" id="dcnum" size=20 value="<?php echo $myrow[12] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">DC Date</p></font></td>
            <td><input type="text" name="dcdate" id="dcdate" size=20 value="<?php echo $myrow[13] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
            </td>
            <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>C of C No.</p></font></td>
            <td><input type="text" name="cofcnum" id="cofcnum"  size=20 value="<?php echo $myrow[29] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supervisor Name</p></font></td>
	        <td><input type="text" id="sup_name" name="sup_name" size=15 value="<?php echo $sup_name ?>" style=";background-color:#DDDDDD;" readonly="readonly">
            <?php
            if($dept=='Production')
              {
            ?>
            	<select name="sup_name1" onchange="onSelectsecretary()">
        <option value="select">Select</option>

	<?php
	$result1 = $newnc->geSupnOperNames();
        while ($myrow1 = mysql_fetch_row($result1)){
	if($myrow1[0]==$sup_name){
	?>
		<option selected value="<? echo $myrow1[0]?>">
		<?echo $myrow1[0]; ?> </option>
		<?
		}
		else{
		?>
		<option value="<? echo $myrow1[0]?>">
		<?echo $myrow1[0]; ?> </option>
		<?php
		}
		}
		?>
		</select>
		<?php
		}
		?>
            </td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Operator Name</p></font></td>
            <td><div id="wo_opnames"><textarea name="op_name" id="op_name" rows=3 cols=30 style=";background-color:#DDDDDD;" readonly="readonly"><?php echo $op_name?></textarea>
               </td>
       </tr>

       <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>Cust NC#</p></font></td>
           <td><input type="text" id="cust_ncno" name="cust_ncno" size=20 value="<?php echo $myrow[33] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
           </td>
           <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>Cust NC Date</p></font></td>
           <td><input type="text"  id="cust_ncdate" name="cust_ncdate" size=20 value="<?php echo $myrow[34] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
           </td>
       </tr>

	   <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>RM Cost</p></font></td>
           <td><input type="text" id="rm_cost" name="rm_cost" size=20 value="<?php echo $myrow[38] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
               <input type="text" id="currency" name="currency" size=5 value="<?php echo $myrow[39] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
               </td>
          <td><span class="labeltext"><p align="left">Status</p></font></td>
          <td><span class="tabletext"><input type="text" name="status" id="status"
                         readonly="readonly" style=";background-color:#DDDDDD;" value="<?php echo $myrow[40] ?>">
	            <span class="tabletext">
             	            <?php
                if($dept=='Production')
                {
                 if($myrow[40]=='Open')
                 {?>
                <select name="ncstate" size="1" width="20" onchange="onSelectStatus(this)">
 	            <option value='Select'>Please Specify</option>
	            <option value='Open'>Open</option>
	            </select>
	            <?php
	            }else
	            {
	            ?>
                 <select name="ncstate" size="1" width="20" onchange="onSelectStatus(this)">
 	            <option value='Select'>Please Specify</option>
	            <option value='Open'>Open</option>
	            <option value='Pending'>Pending</option>
	            </select>

	            <?php
	            }
	            }
	            else
	            {
              if($myrow[40]=='Open')
              {
	            ?>
	            <select name="ncstate" size="1" width="20" onchange="onSelectStatus(this)">
 	            <option value='Select'>Please Specify</option>
	            <option value='Open'>Open</option>
	            <option value='Closed'>Closed</option>
	            </select>
	            <?php
	            }
	            else
	            {
	            ?>
	            <select name="ncstate" size="1" width="20" onchange="onSelectStatus(this)">
 	            <option value='Select'>Please Specify</option>
	            <option value='Open'>Open</option>
	            <option value='Closed'>Closed</option>
	            <option value='Pending'>Pending</option>
	            </select>
	            <?php
	            }
	            }
	            ?>
            </td>
       </tr>

	    <input type='hidden' name='op_name1' id='op_name1' value=''>
  <tr bgcolor="#FFFFFF"> 
<td><span class="labeltext"><p align="left">Machine Name</p></td>
 <td>
 <input type="text" id="mc_name" name="mc_name" size=20 value="<?=$myrow[48]?>" style=";background-color:#DDDDDD;" readonly="readonly">
 </td>
 <input type='hidden' name='mc_name1' id='mc_name1' value='<?=$myrow[48]?>'>
<td><span class="labeltext"><p align="left">Created By</p></td>
 <td>
 <input type="text" id="created_by" name="created_by" size=20 value="<?=$myrow[49]?>" style=";background-color:#DDDDDD;" readonly="readonly">
 </td>
 </tr>

    <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Remarks/Attachments:</b><br>
    <textarea name="remarks" id="remarks" rows=6 cols=60 style=";background-color:#DDDDDD;" readonly="readonly" ><?php echo $myrow[35] ?></textarea>
    </td>
    </tr>



<input type="hidden" name="action" value="edit">
<input type="hidden" name="nc4qarecnum" value="<?php echo $nc4qarecnum ?>">



<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#DDDEDD">
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">ERROR TYPE</td>
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">CAUSE</td>
     <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">STAGE</td>
     <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">DISPOSITION</td>
</tr>

<tr>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">DIMENSIONAL DEVIATION</td>
   <?php

   $checked1="";

   if($myrow[15] == 'yes'){
   $checked1="checked";
   }
   ?>

   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked1 ?> name="chk1" id="chk1"  onclick="JavaScript:toggleValue('dim_deviation',this);">
                         <input type="hidden" name="dim_deviation" value="<?php echo $myrow[15]?>" id="dim_deviation"></td>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">MAN</td>
   <?php

   $checked2="";

   if($myrow[16] == 'yes'){
   $checked2="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked2 ?> name="chk2" id="chk2" onclick="JavaScript:toggleValue('man',this);">
                         <input type="hidden" name="man"  value="<?php echo $myrow[16]?>" id="man"></td>
   <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">IN PROCESS</td>
    <?php

   $checked3="";

   if($myrow[17] == 'yes'){
   $checked3="checked";
   }
   if($dept=='QA')
   {
   ?>

   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?> name="chk3" id="chk3" onclick="return readOnlyRadio()" disabled="disabled">
                         <input type="hidden" name="inprocess"  value="<?php echo $myrow[17]?>"  id="inprocess"></td>

                         <?php
                         }
                         else
                         {
                         ?>
                         <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?> name="chk3" id="chk3" onclick="JavaScript:toggleValue('inprocess',this);">
                         <input type="hidden" name="inprocess"  value="<?php echo $myrow[17]?>"  id="inprocess"></td>
<?php
}
?>
  <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">ACCEPTED</td>
    <?php

   $checked3="";

   if($myrow[41] == 'yes'){
   $checked3="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?> name="chk10" id="chk10" onclick="JavaScript:toggleValue('accepted',this);">
                         <input type="hidden" name="accepted" id="accepted" value="<?php echo $myrow[41]?>"  ></td>

</tr>
<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">MATERIAL DEVIATION</td>
  <?php

   $checked4="";

   if($myrow[18] == 'yes'){
   $checked4="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked4 ?> name="chk4" id="chk4" onclick="JavaScript:toggleValue('mat_deviation',this);">
                         <input type="hidden" name="mat_deviation"  value="<?php echo $myrow[18]?>"  id="mat_deviation"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">MACHINE</td>
   <?php

   $checked5="";

   if($myrow[19] == 'yes'){
   $checked5="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked5 ?> name="chk5" id="chk5" onclick="JavaScript:toggleValue('machine',this);">
                         <input type="hidden" name="machine"  value="<?php echo $myrow[19]?>"  id="machine"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">FINAL INSPECTION</td>
   <?php

   $checked6="";

   if($myrow[20] == 'yes'){
   $checked6="checked";
   }

   if($dept=='Production')
   {   // echo"HERE-2222--";
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="chk6" id="chk6" onclick="return readOnlyRadio()" disabled="disabled">
                         <input type="hidden" name="final_insp"  value="<?php echo $myrow[20]?>" id="final_insp"></td>
    <?php
    }
    else
    {  //echo"HERE---";
    ?>
       <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="chk6" id="chk6" onclick="JavaScript:toggleValue('final_insp',this);">
                         <input type="hidden" name="final_insp"  value="<?php echo $myrow[20]?>" id="final_insp"></td>

    <?php
    }
    ?>
    <td bgcolor="#FFFFFF"><span class="labeltext">REJECTED</td>
   <?php

   $checked6="";

   if($myrow[42] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="chk11"  id="chk11" onclick="JavaScript:toggleValue('rejected',this);">
                         <input type="hidden" name="rejected"  value="<?php echo $myrow[42]?>" id="rejected"></td>

</tr>
 </tr>
<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">OTHER DEVIATION</td>
  <?php

   $checked7="";

   if($myrow[21] == 'yes'){
   $checked7="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked7 ?> name="chk7" id="chk7" onclick="JavaScript:toggleValue('other_deviation',this);">
                         <input type="hidden" name="other_deviation"  value="<?php echo $myrow[21]?>"  id="other_deviation"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">METHOD</td>
   <?php

   $checked8="";

   if($myrow[22] == 'yes'){
   $checked8="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked8 ?> name="chk8"  id="chk8" onclick="JavaScript:toggleValue('method',this);">
                         <input type="hidden" name="method"  value="<?php echo $myrow[22]?>"  id="method"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">CUSTOMER END</td>
   <?php

   $checked9="";

   if($myrow[23] == 'yes'){
   $checked9="checked";
   }
   if($dept=='Production')
   {
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked9 ?> name="chk9"  id="chk9" onclick="return readOnlyRadio()" disabled="disabled">
                         <input type="hidden" name="cust_end"  value="<?php echo $myrow[23]?>" id="cust_end"></td>
    <?php
    }
    else
    {
    ?>
       <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked9 ?> name="chk9"  id="chk9" onclick="JavaScript:toggleValue('cust_end',this);">
                         <input type="hidden" name="cust_end"  value="<?php echo $myrow[23]?>" id="cust_end"></td>

    <?php
    }
    ?>
                          <td bgcolor="#FFFFFF"><span class="labeltext">QUARANTINED</td>
   <?php

   $checked6="";

   if($myrow[43] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="chk12" id="chk12" onclick="JavaScript:toggleValue('quarantined',this);">
                         <input type="hidden" name="quarantined"  value="<?php echo $myrow[43]?>" id="quarantined"></td>
</tr>
<tr>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>


 <td bgcolor="#FFFFFF"><span class="labeltext">REWORK</td>
   <?php

   $checked6="";

   if($myrow[47] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="chk13" id="chk13" onclick="JavaScript:toggleValue('rework',this);">
                         <input type="hidden" name="rework"  value="<?php echo $myrow[47]?>" id="rework"></td>
</tr>
<?php
}
 else if($myrow[40] =='Pending' && $dept != 'PPC2' )
{
?>
        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>CIM Ref Num.</p></font></td>
            <td width=25%><span class="tabletext"><input type="text" name="refnum" id="refnum" size=20 value="<?php echo $myrow[1] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Stage #</p></font></td>
            <td><input type="text" name="stagenum" id="stagenum" size=20 value="<?php echo $myrow[46] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>

        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>WO No.</p></font></td>
            <td colspan=4><input type="text" name="wonum" id="wonum" size=20 value="<?php echo $myrow[11] ?>" style=";background-color:#DDDDDD;" readonly="readonly"> </td>
          </tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">WO Type</p></font></td>
            <td><input type="text" name="wotype" id="wotype" size=20 value="<?php echo $myrow[44] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
                </td>
            <td width=25%><span class="labeltext"><p align="left">DN #</p></font></td>
            <td width=25%><span class="tabletext"><input type="text" name="dnnum" id="dnnum" size=20 value="<?php echo $myrow[45] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
            <td width=25%><input type="text" name="customer" id="customer" size=30 value="<?php echo $myrow[2] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
             <input type="hidden" name="custrecnum"></td>
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO No.</p></font></td>
            <td><input type="text" name="ponum" id="ponum" size=20 value="<?php echo $myrow[9] ?>"  style=";background-color:#DDDDDD;" readonly="readonly">
              <input type="hidden" name="porecnum">
              <input type="hidden" name="wo_status" id="wo_status" value="<?php echo $wo_status ?>">
                </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></font></td>
            <td><input type="text" name="partname" id="partname" size=20 value="<?php echo $myrow[3] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part No.</p></font></td>
            <td><input type="text" name="partnum" id="partnum" size=20 value="<?php echo $myrow[5] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Batch No.</p></font></td>
            <td><input type="text" id="bachnum" name="bachnum" size=20 value="<?php echo $myrow[4] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
            </td>
            <td><span class="labeltext"><p align="left">Matl. Spec</p></font></td>
            <td><input type="text" name="matl_spec"  id="matl_spec" size=20 value="<?php echo $myrow[6] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Issue & PS</p></font></td>
            <td><input type="text" name="issues_ps" id="issues_ps" size=20 value="<?php echo $myrow[7] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left">Qty</p></font></td>
            <td><input type="text" name="qty" id="qty" size=20 value="<?php echo $myrow[8] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Sl No.</p></font></td>
            <td><input type="text" name="part_sl_num" id="part_sl_num" size=20 value="<?php echo $myrow[10] ?>"></td>
            <td><span class="labeltext"><p align="left">DC No.</p></font></td>
            <td><input type="text" name="dcnum" id="dcnum" size=20 value="<?php echo $myrow[12] ?>"></td>
        </tr>


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">DC Date</p></font></td>
            <td><input type="text" name="dcdate" id="dcdate" size=20 value="<?php echo $myrow[13] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('dcdate')"></td>
            <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>C of C No.</p></font></td>
            <td><input type="text" name="cofcnum" id="cofcnum"  size=20 value="<?php echo $myrow[29] ?>">
                <img src="images/bu-get.gif" alt="Get Cofc" onclick="Getcofc('cofcnum')"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supervisor Name</p></font></td>
	    <td><input type="text" id="sup_name" name="sup_name" size=15 value="<?php echo $sup_name ?>" style=";background-color:#DDDDDD;" 			readonly="readonly">
            <select name="sup_name1" onchange="onSelectsecretary()">
                    <option value="select">Select</option>

	<?php
	$result1 = $newnc->geSupnOperNames();
        while ($myrow1 = mysql_fetch_row($result1)){
	if($myrow1[0]==$sup_name){
	?>
		<option selected value="<? echo $myrow1[0]?>">
		<?echo $myrow1[0]; ?> </option>
		<?
		}
		else{
		?>
		<option value="<? echo $myrow1[0]?>">
		<?echo $myrow1[0]; ?> </option>
		<?php
		}
		}
		?>
		</select>
        </td>

        <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Operator Name</p></font></td>
        <td><div id="wo_opnames">
        <textarea name="op_name" id="op_name" rows=3 cols=30 style=";background-color:#DDDDDD;" readonly="readonly">
        <?php echo $op_name?></textarea>
		</td>
       </tr>

       <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>Cust NC#</p></font></td>
        <td><input type="text" id="cust_ncno" name="cust_ncno" size=20 value="<?php echo $myrow[33] ?>">
        </td>
        <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>Cust NC Date</p></font></td>
        <td><input type="text"  id="cust_ncdate" name="cust_ncdate" size=20 value="<?php echo $myrow[34] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
        <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('cust_ncdate')"></td>
       </tr>

	   <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>RM Cost</p></font></td>
        <td><input type="text" id="rm_cost" name="rm_cost" size=20 value="<?php echo $myrow[38] ?>">
		<span class="tabletext">
		<select name="currency" id="currency"  width=2>
		            <?
		            $currency=array('$','Rs');
					for($j=0;$j<count($currency);$j++){

					if($currency[$j] == $myrow[39]){?>
					<option selected value="<? echo $currency[$j]?>"><?echo $currency[$j]; ?>
					</option>
					<?}
					else{?>
                    <option value="<? echo $currency[$j]?>"><?echo $currency[$j]; ?>
					</option>
					<?}
					}?>

        </td>
         <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td><span class="tabletext"><input type="text" name="status" id="status"
                         readonly="readonly" style=";background-color:#DDDDDD;" value="<?php echo $myrow[40] ?>">
	            <span class="tabletext">
                	            <?php
                if($dept=='Production')
                {
                 if($myrow[40]=='Open')
                 {?>
                <select name="ncstate" size="1" width="20" onchange="onSelectStatus(this)">
 	            <option value='Select'>Please Specify</option>
	            <option value='Open'>Open</option>
	            </select>
	            <?php
	            }else
	            {
	            ?>
                 <select name="ncstate" size="1" width="20" onchange="onSelectStatus(this)">
 	            <option value='Select'>Please Specify</option>
	            <option value='Open'>Open</option>
	            <option value='Pending'>Pending</option>
	            </select>

	            <?php
	            }
	            }
	            else
	            {
                 if($myrow[40]=='Open')
                 {?>
	            <select name="ncstate" size="1" width="20" onchange="onSelectStatus(this)">
 	            <option value='Select'>Please Specify</option>
	            <option value='Open'>Open</option>
	            <option value='Closed'>Closed</option>
	            </select>
	            <?php
	            }
	            else
	            {
	            ?>
	              <select name="ncstate" size="1" width="20" onchange="onSelectStatus(this)">
 	            <option value='Select'>Please Specify</option>
	            <option value='Open'>Open</option>
	            <option value='Closed'>Closed</option>
	            <option value='Pending'>Pending</option>
	            </select>
	            <?php
	            }
	            }
	            ?>
            </td>
         </tr>
<input type='hidden' name='op_name1' id='op_name1' value=''>
		   <tr bgcolor="#FFFFFF"> 
 <td><span class="labeltext"><p align="left">Machine Name</p></td>
 <td>
 <div id="machine_name">
 <input type="text" id="mc_name" name="mc_name" size=20 value="<?=$myrow[48]?>" style=";background-color:#DDDDDD;" readonly="readonly">
 </div>
 </td>
 <input type='hidden' name='mc_name1' id='mc_name1' value='<?=$myrow[48]?>'>
<td><span class="labeltext"><p align="left">Created By</p></td>
 <td>
 <input type="text" id="created_by" name="created_by" size=20 value="<?=$myrow[49]?>" style=";background-color:#DDDDDD;" readonly="readonly">
 </td>
 </tr>


    <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Remarks/Attachments:</b><br>
    <textarea name="remarks" id="remarks" rows=6 cols=60><?php echo $myrow[35] ?></textarea>
    </td>
    </tr>



<input type="hidden" name="action" value="edit">
<input type="hidden" name="nc4qarecnum" value="<?php echo $nc4qarecnum ?>">

<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#DDDEDD">
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">ERROR TYPE</td>
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">CAUSE</td>
     <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">STAGE</td>
     <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">DISPOSITION</td>
</tr>

<tr>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">DIMENSIONAL DEVIATION</td>
   <?php

   $checked1="";

   if($myrow[15] == 'yes'){
   $checked1="checked";
   }
   ?>

   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked1 ?> name="chk1"  id="chk1" onclick="JavaScript:toggleValue('dim_deviation',this);">
                         <input type="hidden" name="dim_deviation" value="<?php echo $myrow[15]?>" id="dim_deviation"></td>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">MAN</td>
   <?php

   $checked2="";

   if($myrow[16] == 'yes'){
   $checked2="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked2 ?> name="chk2" id="chk2" onclick="JavaScript:toggleValue('man',this);">
                         <input type="hidden" name="man"  value="<?php echo $myrow[16]?>" id="man"></td>
   <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">IN PROCESS</td>
    <?php

   $checked3="";

   if($myrow[17] == 'yes'){
   $checked3="checked";
   }
   if($dept=='QA')
   {
   ?>

   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?> name="chk3" id="chk13" onclick="return readOnlyRadio()" disabled="disabled">
                         <input type="hidden" name="inprocess"  value="<?php echo $myrow[17]?>"  id="inprocess"></td>

                         <?php
                         }
                         else
                         {
                         ?>
                         <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?> name="chk3"  id="chk3" onclick="JavaScript:toggleValue('inprocess',this);">
                         <input type="hidden" name="inprocess"  value="<?php echo $myrow[17]?>"  id="inprocess"></td>
<?php
}
?>
  <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">ACCEPTED</td>
    <?php

   $checked3="";

   if($myrow[41] == 'yes'){
   $checked3="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?> name="chk10"  id="chk10" onclick="JavaScript:toggleValue('accepted',this);">
                         <input type="hidden" name="accepted" id="accepted" value="<?php echo $myrow[41]?>"  ></td>

</tr>
<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">MATERIAL DEVIATION</td>
  <?php

   $checked4="";

   if($myrow[18] == 'yes'){
   $checked4="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked4 ?> name="chk4" id="chk4" onclick="JavaScript:toggleValue('mat_deviation',this);">
                         <input type="hidden" name="mat_deviation"  value="<?php echo $myrow[18]?>"  id="mat_deviation"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">MACHINE</td>
   <?php

   $checked5="";

   if($myrow[19] == 'yes'){
   $checked5="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked5 ?> name="chk5" id="chk5" onclick="JavaScript:toggleValue('machine',this);">
                         <input type="hidden" name="machine"  value="<?php echo $myrow[19]?>"  id="machine"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">FINAL INSPECTION</td>
   <?php

   $checked6="";

   if($myrow[20] == 'yes'){
   $checked6="checked";
   }

   if($dept=='Production')
   {   // echo"HERE-2222--";
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="chk6" id="chk6"  onclick="return readOnlyRadio()" disabled="disabled">
                         <input type="hidden" name="final_insp"  value="<?php echo $myrow[20]?>" id="final_insp"></td>
    <?php
    }
    else
    {  //echo"HERE---";
    ?>
       <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="chk6" id="chk6" onclick="JavaScript:toggleValue('final_insp',this);">
                         <input type="hidden" name="final_insp"  value="<?php echo $myrow[20]?>" id="final_insp"></td>

    <?php
    }
    ?>
      <td bgcolor="#FFFFFF"><span class="labeltext">REJECTED</td>
   <?php

   $checked6="";

   if($myrow[42] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="chk11" id="chk11" onclick="JavaScript:toggleValue('rejected',this);">
                         <input type="hidden" name="rejected"  value="<?php echo $myrow[42]?>" id="rejected"></td>

</tr>
 </tr>
<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">OTHER DEVIATION</td>
  <?php

   $checked7="";

   if($myrow[21] == 'yes'){
   $checked7="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked7 ?> name="chk7" id="chk7" onclick="JavaScript:toggleValue('other_deviation',this);">
                         <input type="hidden" name="other_deviation"  value="<?php echo $myrow[21]?>"  id="other_deviation"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">METHOD</td>

   <?php

   $checked8="";
   if($myrow[22] == 'yes')
   {
      $checked8="checked";
   }?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked8 ?> name="chk8" id="chk8" onclick="JavaScript:toggleValue('method',this);">
                         <input type="hidden" name="method"  value="<?php echo $myrow[22]?>"  id="method"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">CUSTOMER END</td>
   <?php
   $checked10="";

   if($myrow[23] == 'yes'){
   $checked10="checked";
   }
    if($dept=='Production')
   {
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked10 ?> name="chk9"  id="chk9" onclick="return readOnlyRadio()" disabled="disabled">
                         <input type="hidden" name="cust_end"  value="<?php echo $myrow[23]?>" id="cust_end"></td>
    <?php
    }
    else
    {
    ?>
       <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked10 ?> name="chk9"  id="chk9" onclick="JavaScript:toggleValue('cust_end',this);">
                         <input type="hidden" name="cust_end"  value="<?php echo $myrow[23]?>" id="cust_end"></td>

    <?php
    }
    ?>
                          <td bgcolor="#FFFFFF"><span class="labeltext">QUARANTINED</td>
   <?php

   $checked6="";

   if($myrow[43] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="chk12" id="chk12" onclick="JavaScript:toggleValue('quarantined',this);">
                         <input type="hidden" name="quarantined"  value="<?php echo $myrow[43]?>" id="quarantined"></td>
</tr>

<tr>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>


 <td bgcolor="#FFFFFF"><span class="labeltext">REWORK</td>
   <?php

   $checked6="";

   if($myrow[47] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="chk13" id="chk13" onclick="JavaScript:toggleValue('rework',this);">
                         <input type="hidden" name="rework"  value="<?php echo $myrow[47]?>" id="rework"></td>
</tr>

</tr>
<?php
}
 else if($dept == 'PPC2' )
{
?>
        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>CIM Ref Num.</p></font></td>
            <td width=25%><span class="tabletext"><input type="text" name="refnum" id="refnum" size=20 value="<?php echo $myrow[1] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Stage #</p></font></td>
            <td><input type="text" name="stagenum" id="stagenum" size=20 value="<?php echo $myrow[46] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>

        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>WO No.</p></font></td>
            <td colspan=4><input type="text" name="wonum" id="wonum" size=20 value="<?php echo $myrow[11] ?>" style=";background-color:#DDDDDD;" readonly="readonly"> </td>
          </tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">WO Type</p></font></td>
            <td><input type="text" name="wotype" id="wotype" size=20 value="<?php echo $myrow[44] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
                </td>
            <td width=25%><span class="labeltext"><p align="left">DN #</p></font></td>
            <td width=25%><span class="tabletext"><input type="text" name="dnnum" id="dnnum" size=20 value="<?php echo $myrow[45] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
            <td width=25%><input type="text" name="customer" id="customer" size=30 value="<?php echo $myrow[2] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
             <input type="hidden" name="custrecnum"></td>
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO No.</p></font></td>
            <td><input type="text" name="ponum" id="ponum" size=20 value="<?php echo $myrow[9] ?>"  style=";background-color:#DDDDDD;" readonly="readonly">
              <input type="hidden" name="porecnum">
              <input type="hidden" name="wo_status" id="wo_status" value="<?php echo $wo_status ?>">
                </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></font></td>
            <td><input type="text" name="partname" id="partname" size=20 value="<?php echo $myrow[3] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part No.</p></font></td>
            <td><input type="text" name="partnum" id="partnum" size=20 value="<?php echo $myrow[5] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Batch No.</p></font></td>
            <td><input type="text" id="bachnum" name="bachnum" size=20 value="<?php echo $myrow[4] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
            </td>
            <td><span class="labeltext"><p align="left">Matl. Spec</p></font></td>
            <td><input type="text" name="matl_spec"  id="matl_spec" size=20 value="<?php echo $myrow[6] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Issue & PS</p></font></td>
            <td><input type="text" name="issues_ps" id="issues_ps" size=20 value="<?php echo $myrow[7] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left">Qty</p></font></td>
            <td><input type="text" name="qty" id="qty" size=20 value="<?php echo $myrow[8] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Sl No.</p></font></td>
            <td><input type="text" name="part_sl_num" id="part_sl_num" size=20 style=";background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[10] ?>"></td>
            <td><span class="labeltext"><p align="left">DC No.</p></font></td>
            <td><input type="text" name="dcnum" id="dcnum"  style=";background-color:#DDDDDD;" readonly="readonly" size=20 value="<?php echo $myrow[12] ?>"></td>
        </tr>


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">DC Date</p></font></td>
            <td><input type="text" name="dcdate" id="dcdate" size=20 value="<?php echo $myrow[13] ?>" style=";background-color:#DDDDDD;" readonly="readonly">                </td>
            <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>C of C No.</p></font></td>
            <td><input type="text" name="cofcnum" id="cofcnum"  style=";background-color:#DDDDDD;" readonly="readonly" size=20 value="<?php echo $myrow[29] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supervisor Name</p></font></td>
	    <td><input type="text" id="sup_name" name="sup_name" size=15 value="<?php echo $sup_name ?>" style=";background-color:#DDDDDD;" 			readonly="readonly">           
        </td>

        <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Operator Name</p></font></td>
        <td><div id="wo_opnames">
        <textarea name="op_name" id="op_name" rows=3 cols=30 style=";background-color:#DDDDDD;" readonly="readonly">
        <?php echo $op_name?></textarea>
		</td>
       </tr>

       <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>Cust NC#</p></font></td>
        <td><input type="text" id="cust_ncno" name="cust_ncno"  style=";background-color:#DDDDDD;" readonly="readonly" size=20 value="<?php echo $myrow[33] ?>">
        </td>
        <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>Cust NC Date</p></font></td>
        <td><input type="text"  id="cust_ncdate" name="cust_ncdate" size=20 value="<?php echo $myrow[34] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
       </tr>

	   <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>RM Cost</p></font></td>
        <td><input type="text" id="rm_cost" name="rm_cost"  style=";background-color:#DDDDDD;" readonly="readonly" size=20 value="<?php echo $myrow[38] ?>">
		
		

        </td>
         <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td><span class="tabletext"><input type="text" name="status" id="status"
                         readonly="readonly" style=";background-color:#DDDDDD;" value="<?php echo $myrow[40] ?>">	
						  <?
				if($myrow[40]=='Pending')
	            { ?>
                <select name="ncstate" size="1" width="20" onchange="onSelectStatus(this)">
 	            <option value='Select'>Please Specify</option>
	            <option value='Open'>Open</option>	        
	            </select>
				<?}?>
            </td>
         </tr>
<input type='hidden' name='op_name1' id='op_name1' value=''>
		   <tr bgcolor="#FFFFFF"> 
 <td><span class="labeltext"><p align="left">Machine Name</p></td>
 <td>
 <div id="machine_name">
 <input type="text" id="mc_name" name="mc_name" size=20 value="<?=$myrow[48]?>" style=";background-color:#DDDDDD;" readonly="readonly">
 </div>
 </td>
 <input type='hidden' name='mc_name1' id='mc_name1' value='<?=$myrow[48]?>'>
<td><span class="labeltext"><p align="left">Created By</p></td>
 <td>
 <input type="text" id="created_by" name="created_by" size=20 value="<?=$myrow[49]?>" style=";background-color:#DDDDDD;" readonly="readonly">
 </td>
 </tr>


    <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Remarks/Attachments:</b><br>
    <textarea name="remarks" id="remarks" rows=6 cols=60  style=";background-color:#DDDDDD;" readonly="readonly"><?php echo $myrow[35] ?></textarea>
    </td>
    </tr>



<input type="hidden" name="action" value="edit">
<input type="hidden" name="nc4qarecnum" value="<?php echo $nc4qarecnum ?>">

<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#DDDEDD">
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">ERROR TYPE</td>
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">CAUSE</td>
     <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">STAGE</td>
     <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">DISPOSITION</td>
</tr>

<tr>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">DIMENSIONAL DEVIATION</td>
   <?php

   $checked1="";

   if($myrow[15] == 'yes'){
   $checked1="checked";
   }
   ?>

   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked1 ?> name="chk1"  id="chk1" onclick="JavaScript:toggleValue('dim_deviation',this);">
                         <input type="hidden" name="dim_deviation" value="<?php echo $myrow[15]?>" id="dim_deviation"></td>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">MAN</td>
   <?php

   $checked2="";

   if($myrow[16] == 'yes'){
   $checked2="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked2 ?> name="chk2" id="chk2" onclick="JavaScript:toggleValue('man',this);">
                         <input type="hidden" name="man"  value="<?php echo $myrow[16]?>" id="man"></td>
   <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">IN PROCESS</td>
    <?php

   $checked3="";

   if($myrow[17] == 'yes'){
   $checked3="checked";
   }?>  

   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?>  disabled='disabled'  name="chk3" id="chk13" onclick="return readOnlyRadio()" disabled="disabled">
                         <input type="hidden" name="inprocess"  value="<?php echo $myrow[17]?>"  id="inprocess"></td>

 
  <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">ACCEPTED</td>
    <?php

   $checked3="";

   if($myrow[41] == 'yes'){
   $checked3="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?>  disabled='disabled'  name="chk10"  id="chk10" onclick="JavaScript:toggleValue('accepted',this);">
                         <input type="hidden" name="accepted" id="accepted" value="<?php echo $myrow[41]?>"  ></td>

</tr>
<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">MATERIAL DEVIATION</td>
  <?php

   $checked4="";

   if($myrow[18] == 'yes'){
   $checked4="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked4 ?>   name="chk4" id="chk4" onclick="JavaScript:toggleValue('mat_deviation',this);">
                         <input type="hidden" name="mat_deviation"  value="<?php echo $myrow[18]?>"  id="mat_deviation"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">MACHINE</td>
   <?php

   $checked5="";

   if($myrow[19] == 'yes'){
   $checked5="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked5 ?>   name="chk5" id="chk5" onclick="JavaScript:toggleValue('machine',this);">
                         <input type="hidden" name="machine"  value="<?php echo $myrow[19]?>"  id="machine"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">FINAL INSPECTION</td>
   <?php

   $checked6="";

   if($myrow[20] == 'yes'){
   $checked6="checked";
   }?>

   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?>  disabled='disabled'  name="chk6" id="chk6"  onclick="return readOnlyRadio()" disabled="disabled">
                         <input type="hidden" name="final_insp"  value="<?php echo $myrow[20]?>" id="final_insp"></td>
   
      <td bgcolor="#FFFFFF"><span class="labeltext">REJECTED</td>
   <?php

   $checked6="";

   if($myrow[42] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?>  disabled='disabled'  name="chk11" id="chk11" onclick="JavaScript:toggleValue('rejected',this);">
                         <input type="hidden" name="rejected"  value="<?php echo $myrow[42]?>" id="rejected"></td>

</tr>
 </tr>
<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">OTHER DEVIATION</td>
  <?php

   $checked7="";

   if($myrow[21] == 'yes'){
   $checked7="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked7 ?>  name="chk7" id="chk7" onclick="JavaScript:toggleValue('other_deviation',this);">
                         <input type="hidden" name="other_deviation"  value="<?php echo $myrow[21]?>"  id="other_deviation"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">METHOD</td>
   <?php
   $checked8="";
   if($myrow[22] == 'yes')
   {
      $checked8="checked";
   }?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked8 ?>  name="chk8" id="chk8" onclick="JavaScript:toggleValue('method',this);">
                         <input type="hidden" name="method"  value="<?php echo $myrow[22]?>"  id="method"></td>

   <td bgcolor="#FFFFFF"><span class="labeltext">CUSTOMER END</td>
   <?php
   $checked10="";

   if($myrow[23] == 'yes'){
   $checked10="checked";
   }?>  
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked10 ?>  disabled='disabled'  name="chk9"  id="chk9" onclick="return readOnlyRadio()" disabled="disabled">
                         <input type="hidden" name="cust_end"  value="<?php echo $myrow[23]?>" id="cust_end"></td>
   
                          <td bgcolor="#FFFFFF"><span class="labeltext">QUARANTINED</td>
   <?php

   $checked6="";

   if($myrow[43] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> disabled='disabled'   name="chk12" id="chk12" onclick="JavaScript:toggleValue('quarantined',this);">
                         <input type="hidden" name="quarantined"  value="<?php echo $myrow[43]?>" id="quarantined"></td>
</tr>

<tr>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>


 <td bgcolor="#FFFFFF"><span class="labeltext">REWORK</td>
   <?php

   $checked6="";

   if($myrow[47] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?>  disabled='disabled'  name="chk13" id="chk13" onclick="JavaScript:toggleValue('rework',this);">
                         <input type="hidden" name="rework"  value="<?php echo $myrow[47]?>" id="rework"></td>
</tr>

</tr>
<?php
}

if($dept=='Production')
{
?>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Brief Description of Non Conformance:</b><br>
    <textarea name="description" rows=6 cols=60  ><?php echo $myrow[24] ?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Root Cause:</b><br>
    <textarea name="root_cause" rows=6 cols=60  ><?php echo $myrow[25] ?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Corrective Action:</b><br>
    <textarea name="corrective_action" rows=6 cols=60  ><?php echo $myrow[26] ?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Preventive Action:</b><br>
    <textarea name="preventive_action" rows=6 cols=60 ><?php echo $myrow[27] ?></textarea>
    </td>
</tr>

    <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Effectiveness:</b><br>
    <textarea name="effectiveness" rows=6 cols=60  style=";background-color:#DDDDDD;" readonly="readonly"><?php echo $myrow[28] ?></textarea>
    </td>
    </tr>
<?php
}
else if($dept=='QA')
{
?>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Brief Description of Non Conformance:</b><br>
    <textarea name="description" rows=6 cols=60   ><?php echo $myrow[24] ?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Root Cause:</b><br>
    <textarea name="root_cause" rows=6 cols=60 style=";background-color:#DDDDDD;" readonly="readonly" ><?php echo $myrow[25] ?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Corrective Action:</b><br>
    <textarea name="corrective_action" rows=6 cols=60 style=";background-color:#DDDDDD;" readonly="readonly" ><?php echo $myrow[26] ?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Preventive Action:</b><br>
    <textarea name="preventive_action" rows=6 cols=60 style=";background-color:#DDDDDD;" readonly="readonly" ><?php echo $myrow[27] ?></textarea>
    </td>
</tr>

    <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Effectiveness:</b><br>
    <textarea name="effectiveness" rows=6 cols=60  ><?php echo $myrow[28] ?></textarea>
    </td>
    </tr>
<?
}
else if($dept != 'Production' &&  $dept != 'QA' && $dept !='PPC2')
{
?>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Brief Description of Non Conformance:</b><br>
    <textarea name="description" rows=6 cols=60  ><?php echo $myrow[24] ?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Root Cause:</b><br>
    <textarea name="root_cause" rows=6 cols=60  ><?php echo $myrow[25] ?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Corrective Action:</b><br>
    <textarea name="corrective_action" rows=6 cols=60 ><?php echo $myrow[26] ?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Preventive Action:</b><br>
    <textarea name="preventive_action" rows=6 cols=60  ><?php echo $myrow[27] ?></textarea>
    </td>
</tr>

    <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Effectiveness:</b><br>
    <textarea name="effectiveness" rows=6 cols=60  ><?php echo $myrow[28] ?></textarea>
    </td>
    </tr>
<?php
}
elseif($dept=='PPC2')
{?>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Brief Description of Non Conformance:</b><br>
    <textarea name="description" rows=6 cols=60 ><?php echo $myrow[24] ?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Root Cause:</b><br>
    <textarea name="root_cause" rows=6 cols=60  ><?php echo $myrow[25] ?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Corrective Action:</b><br>
    <textarea name="corrective_action" rows=6 cols=60  ><?php echo $myrow[26] ?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Preventive Action:</b><br>
    <textarea name="preventive_action" rows=6 cols=60 ><?php echo $myrow[27] ?></textarea>
    </td>
</tr>

    <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Effectiveness:</b><br>
    <textarea name="effectiveness" rows=6 cols=60  style=";background-color:#DDDDDD;" readonly="readonly"><?php echo $myrow[28] ?></textarea>
    </td>
    </tr>
<?php
}
?>


</table>
	</td>
    </tr>


    </td>

     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">

         <tr bgcolor="#FFFFFF">
          <input type="hidden" id="department" name="department" size=20 value="<?php echo $dept ?>" >

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
<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">

      </FORM>
</table>
</body>
</html>
