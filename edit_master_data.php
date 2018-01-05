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

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'edit_master_data';
$page = "Master Data";
//////session_register('pagename');

// First include the class definition
include('classes/masterdataClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];
$dept =  $_SESSION['department'];
$newMD = new masterdata;
$newdisplay = new display;

$masterdatarecnum = $_REQUEST['masterdatarecnum'];

$result = $newMD->getmasterdata($masterdatarecnum);
$myrow = mysql_fetch_assoc($result);

$result4mps = $newMD->getmasterdata_mps($masterdatarecnum);

$result4wo=  $newMD->getmasterdetails4wo($masterdatarecnum);


$result4assywo=  $newMD->getmasterdetails4assywo($masterdatarecnum);


?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/master_data.js"></script>


<html>
<head>
<title>Edit Master</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processMaster_data.php' method='post' enctype='multipart/form-data'>
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
        <td><span class="pageheading"><b>Edit Master</b></td>
    </tr>


     
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Edit Master Header</b></center></td>
        </tr>

        <?php
         if(($dept=='Sales' || $dept=='PPC') && ($result4wo == 0 && $result4assywo == 0))
     {

     // echo $myrow["remarks"]."sales";
?>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Host Ref No.</p></font></td>
            <td><span class="tabletext"><input type="text" name="CIM_refnum" size=20 value="<?php echo $myrow["CIM_refnum"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><input type="text" name="customer" size=20 value="<?php echo $myrow["customer"] ?>" style="background-color:#DDDDDD;" readonly="readonly" >
            </td>
        </tr>

       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></font></td>
            <td><input type="text" name="partname" size=20 value="<?php echo $myrow["partname"] ?>" >
            </td>
             <td><span class="labeltext"><p align="left">RM by Customer</p></font></td>
            <td><input type="text" name="RM_by_customer" size=20 value="<?php echo $myrow["RM_by_customer"] ?>" ></td>


        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part No.</p></font></td>
            <td><input type="text" name="partnum" size=20 value="<?php echo $myrow["partnum"] ?>" ></td>
            <td><span class="labeltext"><p align="left">RM by Host</p></font></td>
            <td><input type="text" name="RM_by_CIM" size=20 value="<?php echo $myrow["RM_by_CIM"] ?>" ></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Secondary Part Num</p></font></td>
            <td><input type="text" name="sec_partname" size=20 value="<?php echo $myrow["secondary_partname"] ?>" ></td>
            <td><span class="labeltext"><p align="left">Attachments</p></font></td>
            <td><input type="text" name="attachment" size=20 value="<?php echo $myrow["attachments"] ?>" ></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Drawing#</p></font></td>
            <td><input type="text" name="drawing_num" size=20 value="<?php echo $myrow["drawing_num"] ?>" >
            </td>
            <td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
            <td><input type="text" name="drg_issue" size=20 value="<?php echo $myrow["drg_issue"] ?>" ></td>
            <input type="hidden" name="rm_type" size=20 value="<?php echo $myrow["rm_type"] ?>" >
            <input type="hidden" name="rm_spec" size=20 value="<?php echo $myrow["rm_spec"] ?>" >
        </tr>

      <!--<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><input type="text" name="rm_type" size=20 value="<?php echo $myrow["rm_type"] ?>" ></td>
            <td><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td><input type="text" name="rm_spec" size=20 value="<?php echo $myrow["rm_spec"] ?>" ></td>
        </tr>-->

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">MPS Rev</p></font></td>
            <td><input type="text" name="mps_rev" size=20 value="<?php echo $myrow["mps_rev"] ?>" ></td>
            <td><span class="labeltext"><p align="left">MPS#</p></font></td>
            <td><input type="text" name="mps_num" size=20 value="<?php echo $myrow["mps_num"] ?>" ></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COS</p></font></td>
            <td><input type="text" name="cos" size=20 value="<?php echo $myrow["cos"] ?>"></td>
            <td><span class="labeltext"><p align="left">Project</p></font></td>
            <td><input type="text" name="project" size=20 value="<?php echo $myrow["project"] ?>" ></td>
          </tr>
          
            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Maxruling</p></font></td>
            <td><input type="text" name="max" size=20 value="<?php echo $myrow["maxruling"] ?>" ></td>
         <td><span class="labeltext"><p align="left">Grainflow</p></font></td>
            <td><input type="text" name="gf" size=20 value="<?php echo $myrow["grainflow"] ?>" ></td> 
            
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Control(Machine Name)</p></font></td>
            <td ><input type="text" name="machine_name" size=20 value="<?php echo $myrow["machine_name"] ?>" ></td>
            <td><span class="labeltext"><p align="left">Type</p></font></td>
           <td><input type="text" name="type" size=20  id="type" value="<?php echo $myrow["type"] ?>" style="background-color:#DDDDDD;" readonly="readonly" >
          <select  name="typesel" id="typesel" onchange="onSelectType(this)">
 
                   <option value="Assembly">Assembly</option>
                     <option value="Non Assembly">Non Assembly</option>
                   <option value="Kit">Kit</option></select></td>
         </tr>
        <tr bgcolor="#FFFFFF">

               <td><span class="labeltext"><p align="left">PRN Status</p></font></td>
               <td><select  name="crnstatus" id="crnstatus" size="width:120px" >
                    <?php $selected = 'selected'; ?>
                   <option value="Active" <?php if($myrow["status"] == 'Active') echo $selected?>>Active</option>
                   <option value="Inactive" <?php if($myrow["status"] == 'Inactive') echo $selected?>>Inactive</option>
                   </select></td>
                   <td><span class="labeltext"><p align="left">Rev Status</p></font></td>
              <td><select  name="master_rev_status" id="master_rev_status" >
                    <?php $selected = 'selected'; ?>
                   <option value="Active" <?php if($myrow["revstat"] == 'Active') echo $selected?>>Active</option>
                   <option value="Obsolete" <?php if($myrow["revstat"] == 'Obsolete') echo $selected?>>Obsolete</option>
                   </select></td>



                     </tr>

            
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Treatment</p></font></td>
            <td colspan="3"><input type="text" id="treat" name="treat" size=20 value="<?php echo $myrow["treat"] ?>" style="background-color:#DDDDDD;" readonly="readonly">&nbsp;&nbsp;
    <select id="treattype" name="treattype" onchange="onChangeTreat(this.value)">
          <option value="Treated">Treated</option>
                   <option value="Untreated">Untreated</option>
                        <option value="Assembly">Assembly</option>
                </select></td>
</tr>
        <tr bgcolor="#FFFFFF">
   <td><span class="labeltext"><p align="left">Condition</p></font></td>
            <td><textarea id="condition" name="condition" rows="2"
                        cols="30" value=""><?php echo $myrow["condition"] ?></textarea></td>
             <td><span class="labeltext"><p align="left">Remarks</p></font></td>
            <td><textarea name="crnremarks" id="crnremarks"rows="2" cols="30"
                  value=""><?php echo $myrow["remarks"] ?></textarea></td>
        </tr>

     <tr bgcolor="#FFFFFF">
            <td rowspan=3><span class="labeltext"><p align="left">Required Unit Size of RM</p></font></td>
            <td ><span class="labeltext"><p align="left">Dim 1</p></font></td>
            <td colspan=2><input type="text" name="rm_dim1" size=20 value="<?php echo $myrow["rm_dim1"] ?>" ></td>
         </tr>
         <tr bgcolor="#FFFFFF">
            <td ><span class="labeltext"><p align="left">Dim 2</p></font></td>
            <td colspan=2><input type="text" name="rm_dim2" size=20 value="<?php echo $myrow["rm_dim2"] ?>" ></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Dim 3</p></font></td>
            <td colspan=2><input type="text" name="rm_dim3" size=20 value="<?php echo $myrow["rm_dim3"] ?>" >
             </tr>

                           <input type='hidden' name='masterdatarecnum' value='<?php echo $masterdatarecnum; ?>' ></td>
                           <input type='hidden' name='create_date' value='<?php echo $myrow["create_date"]; ?>' ></td>
    

         <?php
         
           if($dept == 'Sales')
           {


                $checked="checked";
        ?>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Engineering Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow["eng_app"] == 'yes'?$checked:"" ?>  id="eng_app_1" name="eng_app_1" onclick="JavaScript:toggleValue('eng_app',this);">

          <td><span class="labeltext">Engineering Approved Date</td>
          <td bgcolor="#FFFFFF"><input type='text' name='eng_app_date' id="eng_app_date" value='<?php echo $myrow["eng_app_date"]; ?>' style="background-color:#DDDDDD;" readonly="readonly"> </td>
           <?php
           }
           ?>
                         <input type="hidden" name="eng_app" value="<?php echo $myrow["eng_app"]?>" id="eng_app">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
                         <input type="hidden" name="eng_app_by" id="eng_app_by" value="<?php echo $myrow["eng_app_by"]?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>"></td>

          </tr>
</table>
<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.getElementById('index').value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>MPS</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Line number</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Mps Rev</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Rev Status</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Rev Date</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Control(Machine Name)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Remarks</center></b></td>
</tr>
<?php
  $i=1;
  while ($myrow4mps = mysql_fetch_row($result4mps))
  {



      $prevlinenum = "prevlinenum" . $i;
      $lirecnum = "lirecnum" . $i;
      //$mpsDate = "mpsdate" . $i;

      echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myrow4mps[1]\">";
      echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myrow4mps[0]\">";
?>
      <tr bgcolor="#FFFFFF">
      <td><center><input type="text" id="line_num<?php echo $i?>" name="line_num<?php echo $i?>" value="<?php echo $myrow4mps[1] ?>" size=6 ></center></td>
      <td><center><input type="text" id="mps_revision<?php echo $i ?>" name="mps_revision<?php echo $i ?>" value="<?php echo $myrow4mps[2] ?>" size=10 ></center></td>
      <!--<td><center><input type="text" id="rev_status<?php //echo $i ?>" name="rev_status<?php //echo $i ?>" value="<?php //echo $myrow4mps[5] ?>" size=10></center></td>-->
       <td><center><select  name="rev_status<?php echo $i ?>" id="rev_status<?php echo $i ?>"  >
                    <?php $selected = 'selected'; ?>
                   <option value="Active" <?php if($myrow4mps[5] == 'Active') echo $selected?>>Active</option>
                   <option value="Obsolete" <?php if($myrow4mps[5] == 'Obsolete') echo $selected?>>Obsolete</option>
                   </select></center></td>
                   <td><input type="text" id="rev_date<?php echo $i ?>"  name="rev_date<?php echo $i?>" style="background-color:#DDDDDD;" readonly="readonly"
           size="10%" value="<?php echo $myrow4mps[6] ?>"><img src="images/bu-getdateicon.gif" alt="Get Date"
           onclick="GetDate('rev_date<?php echo $i ?>')"> </td>
      <td><center><input type="text" id="control<?php echo $i ?>" name="control<?php echo $i ?>" value="<?php echo $myrow4mps[3] ?>" size=12 ></center></td>
      <td><center><input type="text" id="remarks<?php echo $i ?>" name="remarks<?php echo $i ?>" value="<?php echo $myrow4mps[4] ?>" size=50 ></center></td>
      </tr>
<?php

      $i++;
  }
  //echo$i."IN PHP";
echo "<input type=\"hidden\" name=\"index\" id=\"index\" value=$i>";
echo "<input type=\"hidden\" name=\"curindex\" id=\"curindex\" value=$i>";
?>

</table>
<?php
  }
  else
  {
  
  
?>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Host Ref No.</p></font></td>
            <td><span class="tabletext"><input type="text" name="CIM_refnum" size=20 value="<?php echo $myrow["CIM_refnum"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><input type="text" name="customer" size=20 value="<?php echo $myrow["customer"] ?>" style="background-color:#DDDDDD;" readonly="readonly">
            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Treatment</p></font></td>
            <td colspan="3"><input type="text" id="treat" name="treat" size=20 value="<?php echo $myrow["treat"] ?>" style="background-color:#DDDDDD;" readonly="readonly">&nbsp;&nbsp;
		<select id="treattype" name="treattype" onchange="onChangeTreat(this.value)">
	   	    <option value="Treated">Treated</option>
                   <option value="Untreated">Untreated</option>
                        <option value="Assembly">Assembly</option>
                </select></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></font></td>
            <td><input type="text" name="partname" size=20 value="<?php echo $myrow["partname"] ?>" style="background-color:#DDDDDD;" readonly="readonly">
            </td>
             <td><span class="labeltext"><p align="left">RM by Customer</p></font></td>
            <td><input type="text" name="RM_by_customer" size=20 value="<?php echo $myrow["RM_by_customer"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>






        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part No.</p></font></td>
            <td><input type="text" name="partnum" size=20 value="<?php echo $myrow["partnum"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left">RM by Host</p></font></td>
            <td><input type="text" name="RM_by_CIM" size=20 value="<?php echo $myrow["RM_by_CIM"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Secondary Part Num</p></font></td>
            <td><input type="text" name="sec_partname" size=20 value="<?php echo $myrow["secondary_partname"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left">Attachments</p></font></td>
            <td><input type="text" name="attachment" size=20 value="<?php echo $myrow["attachments"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Drawing#</p></font></td>
            <td><input type="text" name="drawing_num" size=20 value="<?php echo $myrow["drawing_num"] ?>" style="background-color:#DDDDDD;" readonly="readonly">
            </td>
            <td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
            <td><input type="text" name="drg_issue" size=20 value="<?php echo $myrow["drg_issue"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><input type="text" name="rm_type" size=20 value="<?php echo $myrow["rm_type"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td><input type="text" name="rm_spec" size=20 value="<?php echo $myrow["rm_spec"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">MPS Rev</p></font></td>
            <td><input type="text" name="mps_rev" size=20 value="<?php echo $myrow["mps_rev"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left">MPS#</p></font></td>
            <td><input type="text" name="mps_num" size=20 value="<?php echo $myrow["mps_num"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COS</p></font></td>
            <td><input type="text" name="cos" size=20 value="<?php echo $myrow["cos"] ?>"style="background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left">Project</p></font></td>
            <td><input type="text" name="project" size=20 value="<?php echo $myrow["project"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
       </tr>
          <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Maxruling</p></font></td>
            <td><input type="text" name="max" size=20 value="<?php echo $myrow["maxruling"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left">Grainflow</p></font></td>
            <td><input type="text" name="gf" size=20 value="<?php echo $myrow["grainflow"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
            
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Control(Machine Name)</p></font></td>
            <td ><input type="text" name="machine_name" size=20 value="<?php echo $myrow["machine_name"] ?>" style="background-color:#DDDDDD;" readonly="readonly" ></td>
             <td><span class="labeltext"><p align="left">Type</p></font></td>
          <td><input type="text" name="type" size=20  id="type" value="<?php echo $myrow["type"] ?>" style="background-color:#DDDDDD;" readonly="readonly" >
          <select  name="typesel" id="typesel" onchange="onSelectType(this)">
                  <option value="Assembly">Assembly</option>
                  <option value="Non Assembly">Non Assembly</option>

                   <option value="Kit">Kit</option></select></td>

        </tr>
        <tr bgcolor="#FFFFFF">

               <td><span class="labeltext"><p align="left">PRN Status</p></font></td>
               <td><select  name="crnstatus" id="crnstatus" size="width:120px" >
                    <?php $selected = 'selected'; ?>
                   <option value="Active" <?php if($myrow["status"] == 'Active') echo $selected?>>Active</option>
                   <option value="Inactive" <?php if($myrow["status"] == 'Inactive') echo $selected?>>Inactive</option>
                   </select></td>
                   <td><span class="labeltext"><p align="left">Rev Status</p></font></td>
            <td><select  name="master_rev_status" id="master_rev_status" >
                    <?php $selected = 'selected'; ?>
                   <option value="Active" <?php if($myrow["revstat"] == 'Active') echo $selected?>>Active</option>
                   <option value="Obsolete" <?php if($myrow["revstat"] == 'Obsolete') echo $selected?>>Obsolete</option>
                   </select></td>

                     </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Condition</p></font></td>
            <td><textarea id="condition" name="condition" rows="2"
                        cols="30" value=""><?php echo $myrow["condition"] ?></textarea></td>
             <td><span class="labeltext"><p align="left">Remarks</p></font></td>
            <td><textarea name="crnremarks" id="crnremarks"rows="2" cols="30"
                  value=""><?php echo $myrow["remarks"] ?></textarea></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td rowspan=3><span class="labeltext"><p align="left">Required Unit Size of RM</p></font></td>
            <td ><span class="labeltext"><p align="left">Dim 1</p></font></td>
            <td colspan=2><input type="text" name="rm_dim1" size=20 value="<?php echo $myrow["rm_dim1"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
         </tr>
         <tr bgcolor="#FFFFFF">
            <td ><span class="labeltext"><p align="left">Dim 2</p></font></td>
            <td colspan=2><input type="text" name="rm_dim2" size=20 value="<?php echo $myrow["rm_dim2"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Dim 3</p></font></td>
            <td colspan=2><input type="text" name="rm_dim3" size=20 value="<?php echo $myrow["rm_dim3"] ?>" style="background-color:#DDDDDD;" readonly="readonly">
</tr>
                           <input type='hidden' name='masterdatarecnum' value='<?php echo $masterdatarecnum; ?>' style="background-color:#DDDDDD;" readonly="readonly"></td>
                           <input type='hidden' name='create_date' value='<?php echo $myrow["create_date"]; ?>' ></td>

 <?php
            $checked="checked";
        ?>
          <!--<tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Directors Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php //echo $myrow["director_app"] == 'yes'?$checked:"" ?>  id="director_app_1" name="director_app_1" onclick="JavaScript:toggleValue('director_app',this);">-->
                         <input type="hidden" name="eng_app" value="<?php echo $myrow["eng_app"]?>" id="eng_app">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
                         <input type="hidden" name="eng_app_by" id="eng_app_by" value="<?php echo $myrow["eng_app_by"]?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>"></td>
                         <input type="hidden" name="eng_app_date" id="eng_app_date" value="<?php echo $myrow["eng_app_date"]; ?>">
          <!--<td><span class="labeltext">Director Approved Date</td>
          <td bgcolor="#FFFFFF"><input type='text' name='director_date' id="director_date" value='<?php //echo $myrow["director_date"]; ?>' style="background-color:#DDDDDD;" readonly="readonly"> </td>-->

</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable1">
<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>MPS</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
  <thead>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>Line number</center></b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Mps Rev</center></b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>Rev Status</center></b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Rev Date</center></b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>Control(Machine Name)</center></b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Remarks</center></b></th>
</tr>
</thead>
<?php
  $i=1;
  while ($myrow4mps = mysql_fetch_row($result4mps))
  {
      $prevlinenum = "prevlinenum" . $i;
      $lirecnum = "lirecnum" . $i;

      echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myrow4mps[1]\" id=\"$prevlinenum\">";
      echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myrow4mps[0]\" id=\"$lirecnum\">";
?>
      <tr bgcolor="#FFFFFF">
      <td><center><input type="text" id="line_num<?php echo $i?>" name="line_num<?php echo $i?>" value="<?php echo $myrow4mps[1] ?>" size=6 style="background-color:#DDDDDD;" readonly="readonly"></center></td>
      <td><center><input type="text" id="mps_revision<?php echo $i ?>" name="mps_revision<?php echo $i ?>" value="<?php echo $myrow4mps[2] ?>" size=10 style="background-color:#DDDDDD;" readonly="readonly"></center></td>
      <!--<td><center><input type="text" id="rev_status<?php //echo $i ?>" name="rev_status<?php //echo $i ?>" value="<?php //echo $myrow4mps[5] ?>" size=10></center></td>-->
       <td><center><select  name="rev_status<?php echo $i ?>" id="rev_status<?php echo $i ?>"  >
                    <?php $selected = 'selected'; ?>
                   <option value="Active" <?php if($myrow4mps[5] == 'Active') echo $selected?>>Active</option>
                   <option value="Obsolete" <?php if($myrow4mps[5] == 'Obsolete') echo $selected?>>Obsolete</option>
                   </select></center></td>
      <td><input type="text" id="rev_date<?php echo $i ?>"  name="rev_date<?php echo $i?>" style="background-color:#DDDDDD;" readonly="readonly"
           size="10%" value="<?php echo $myrow4mps[6] ?>"><img src="images/bu-getdateicon.gif" alt="Get Date"
           onclick="GetDate('rev_date<?php echo $i ?>')"> </td>
      <td><center><input type="text" id="control<?php echo $i ?>" name="control<?php echo $i ?>" value="<?php echo $myrow4mps[3] ?>" size=12 style="background-color:#DDDDDD;" readonly="readonly"></center></td>
      <td><center><input type="text" id="remarks<?php echo $i ?>" name="remarks<?php echo $i ?>" value="<?php echo $myrow4mps[4] ?>" size=50 style="background-color:#DDDDDD;" readonly="readonly"></center></td>
      </tr>
<?php

      $i++;
  }
echo "<input type=\"hidden\" name=\"index\" value=$i id=\"index\">";
echo "<input type=\"hidden\" name=\"curindex\" id=\"curindex\" value=$i>";
?>
 
</table>
<?php
  }
  ?>
</td>
        <input type='hidden' name='page_name'id='page_name' value='edit_master_data'></td>
<!-- 		<td width="6"><img src="images/spacer.gif " width="6"></td>
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

      
</table>
</form>
</body>
</html>
