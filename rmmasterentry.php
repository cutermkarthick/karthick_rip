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

$_SESSION['pagename'] = 'rmmasterentry';
$page = "Purchasing: RM Master";
//////session_register('pagename');

// First include the class definition
include('classes/displayClass.php');

$newdisplay = new display;
?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/rmmaster.js"></script>


<html>
<head>
<title>New Master</title>
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
        <td><span class="pageheading"><b>New RM Master</b></td>
    </tr>


     <form action='processRMMaster.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>New RM Master</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

        <tr bgcolor="#FFFFFF">
        <td width="20%"><span class="labeltext"><p align="left">PRN#</p></font></td>
            <td width="30%"><input type="text" name="crnnum" id="crnnum" size=20 value="" id="crnnum" >
           <div id="crn_spec"></div></td>
           <td><span class="labeltext"><p align="left">Spec Type</p></font></td>
              <td bgcolor="#FFFFFF" colspan="1"><span class="tabletext"><select style=width:120px name="spec_val" size="1"  id="spec_val" onchange="javascript: getspec('crn_spec')">
            	<option value='Please Specify'>Please Specify</option>
				<option value='Primary Spec'>Primary Spec</option>
				<option value='Alt Spec1'>Alt Spec1</option>
    			<option value='Alt Spec2'>Alt Spec2</option> 
				<option value='Alt Spec2'>Alt Spec3</option> 
				</select>
				<div id='crn_spec'></div>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
        <td width="30%" ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM Spec</p></font></td>
            <td><input type="text" name="rm_spec" size=20 value="">   
		 <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM Type</p></font></td>
            <td><input type="text" name="rm_type" size=20 value="">    
 		</tr> 
 		<tr bgcolor="#FFFFFF">
        <td width="30%" ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM Bars/Plates</p></font></td>
            <td><input type="text" name="rm_bars_plates" size=20 value="Plates" id="rm_bars_plates" style=";background-color:#DDDDDD;"
		     readonly="readonly">
            <span class="labeltext"><select name="rm_bars_platessel" size="1" width="100" onchange="onSelectrmtype();">
                   <option selected value="Plates">Plates</option>
                   <option value="Bars">Bars</option>
                   <option value="Pipe">Pipe</option>
                   <option value="Forging">Forging</option>
                   <option value="Extrusion">Extrusion</option>
				   </select></td>
		<td colspan=2></td>
 		</tr>
        <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">RM Condition</p></font></td>
            <td colspan="3"><input type="text" name="rm_condition" size=93 value=""></td>
            
        </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">UOM</p></font></td>
            <td><input type="text" name="rm_uom" size=10   value="MM" style=";background-color:#DDDDDD;"
		     readonly="readonly">
			   <span class="labeltext"><select name="rm_uom1" size="1" width="100" onchange="onSelectrm_UOM();">
                   <option selected value="MM">MM</option>
                   <option value="Inches">Inches</option>              
				   </select></td>
			
			</td>
            <td><span class="labeltext"><p align="left">Dia</p></font></td>
            <td><input type="text" name="rm_dia" size=20 value=""></td>
            
        </tr>

        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Length</p></font></td>
            <td><input type="text" name="rm_dim1" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">Width</p></font></td>
            <td><input type="text" name="rm_dim2" size=20 value=""></td>
            
        </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Thickness</p></font></td>
            <td><input type="text" name="rm_dim3" size=20 value=""></td>
         <td><span class="labeltext"><p align="left">Grainflow</p></font></td>
            <td><input type="text" name="rm_grainflow" size=20 value=""></td>
             
        </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">LT</p></font></td>
            <td><input type="text" name="rm_lt" size=20 value=""></td>
         <td><span class="labeltext"><p align="left">ST</p></font></td>
            <td><input type="text" name="rm_st" size=20 value=""></td>   
           
        </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Qty/Billet</p></font></td>
            <td><input type="text" name="rm_qty_perbill" size=20 value=""></td>
         <td><span class="labeltext"><p align="left">MRS</p></font></td>
            <td><input type="text" name="rm_mrs" size=20 value=""></td>  
            
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Unit Price</p></font></td>
            <td><input type="text" name="rm_unitprize" size=20 value="">
            <span class="labeltext"><select name="currency" size="1" width="100">
                   <option selected>$</option>
                   <option value>Rs</option>
                   <option value>GBP</option>
				   </select></td>
        <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supplier Name</p></font></td>
	         <td><span class="tabletext"><input type="text" name="vendor"
		     style=";background-color:#DDDDDD;"
		     readonly="readonly" size=20 value="">
   		     <img src="images/bu-getvendor.gif" alt="Get Vendor" onClick="GetAllVendors()">
   		     <input type="hidden" name="vendrecnum"></td>
       
         <tr bgcolor="#FFFFFF">
         <td><span class="labeltext">Directors Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" id="directors_approved" name="directors_approved"  onclick="JavaScript:toggleValue('director_app',this);">
                         <input type="hidden" name="director_app" value="" id="director_app">
                          <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
                          <input type="hidden" name="director_app_by" id="director_app_by" value=""></td>
          <td><span class="labeltext">Director Approved Date</td>
          <td bgcolor="#FFFFFF"><input type='text' name='director_app_date' id="director_app_date" value='' style="background-color:#DDDDDD;" readonly="readonly"> </td>

                </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Engineering Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow["enggapproved"] == 'yes'?$checked:"" ?>  id="engineering_approved" name="engineering_approved" onclick="JavaScript:toggleValue('eng_app',this);">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>"></td>
                         <input type="hidden" name="eng_app" value="" id="eng_app">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>"></td></td>
                         <input type="hidden" name="eng_app_by" value="" id="eng_app_by">
          <td><span class="labeltext">Engineering Approved Date</td>
          <td bgcolor="#FFFFFF"><input type='text' name='eng_app_date' id="eng_app_date" value='' style="background-color:#DDDDDD;" readonly="readonly"> </td>


          </tr>
        </tr>

          <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Remarks</p></td>
           <td><textarea name="rm_remarks" id="rm_remarks" rows="3" cols="35"></textarea></td>
            <td colspan=2></td>
                      </tr>

      <!--  <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM Code</p></font></td>
            <td><span class="tabletext"><input type="text" name="rmcode" size=20 value="<?php echo $myrow["rmcode"] ?>"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM Type</p></font></td>
            <td><input type="text" name="rm_type" size=20 value="">           
            </td>   
             
        </tr> -->
        <tr bgcolor="#FFFFFF">
        
     <!--       <td colspan><span class="labeltext"><p align="left">Alt Spec</p></font></td>
            <td><input type="text" name="rm_altspec" size=20 value=""></td>            
           <td colspan="2"></td>-->
           <!--<td colspan><span class="labeltext"><p align="left">Status</p></font></td>
            <td><select id="rm_status" name="rm_status" style="width:100px">
                   <option value="Active">Active</option>
                   <option value="Inactive">Inactive</option>
                </select>           
           <td colspan="2"></td>-->
        </tr> 
         <input type='hidden' name='partnum' value='<?php echo $myrow["partnum"]; ?>'></td>
         <input type='hidden' name='masterdatarecnum' id='masterdatarecnum' value=""></td>
          <input type='hidden' name='pagename' id='pagename' value="new_entry"></td>
            <input type='hidden' name='rm_curstat' id='rm_curstat' value=""></td>
        </tr>



</table>
</table>

</td>
<!-- 
		<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
 -->
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
