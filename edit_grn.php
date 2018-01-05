<?
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: edit_grn.php                      =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows editing of GRN                       =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'edit_grn';
$page = "Stores: GRN";

//////session_register('pagename');
// First include the class definition

include('classes/userClass.php');
include('classes/grnclass.php');
include('classes/displayClass.php');
include('classes/grncofcclass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newgrn = new grn;
$newcofc=new cofc;
$grnrecnum = $_REQUEST['grnrecnum'];
$result = $newgrn->getgrn($grnrecnum);
$myrow = mysql_fetch_row($result);
$grnli = $newgrn->getgrnli($grnrecnum);
$grnli4am = $newgrn->getgrnli($grnrecnum);
$cofc=$newcofc->getcofc($grnrecnum);

$result3 = $newgrn->get_MI_details($myrow[25]);

$approved =  $dept . ' ' . $userid . ' ' . date('M d, m');
$status= $myrow[37];
$checked='checked disabled';
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/grn.js"></script>

<html>
<head>
<script language="javascript" type="text/javascript">
function readOnlyRadio()
{
   return false;
}
</script>
<title>Edit GRN</title>
</head>
<?php
//echo $myrow[37];
/*if($myrow[37]=='Pending')
{
?>
<!--<body leftmargin="0"topmargin="0" marginwidth="0" onload="javascript: show_diff(<?php echo $grnrecnum ?>)">-->
<?php
/*}
else
{ */
?>
 <body leftmargin="0"topmargin="0" marginwidth="0" onload="javascript:get_total(this);" >
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
			<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0>
    <tr>
        <td><span class="pageheading"><b>Edit GRN</b></td>
    </tr>


     <form action='processgrn.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" style="width:67%">
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>GRN Header</b></center></td>
        </tr>
<table border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" style="width:67%">
<?
if($dept != 'Stores' &&  $dept != 'CAD')
{
        if($dept!='Purchasing' )
        {?>	
		    <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>GRN Classification</p></font>
			<td width=25%><span class="tabletext"><input type="text" name="wotype" id="wotype"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[58] ?>">
	             <span class="tabletext"><select name="wotype1" id="wotype1" size="1" width="20" onchange="onSelectWOType('new_grn')">
 	             <option selected>Please Specify
	             <option value="Regular">Regular
	             <option value="Assy">Assy
				 </select>
				 </td>
			<td width='25%'><span class="labeltext"><p align="left"> QTM Req.</p></font></td>           
			<td><input type="text" name="qtm_req" id="qtm_req" size=20 value="<?=$myrow[62]?>" style="background-color:#DDDDDD;" readonly="readonly" ></td>
			</tr>
			<?
         if($myrow[51] !='' )
         {?>
         <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Parent GRN No.</p></font></td>
            <td width=25%><input type="text" name="parentgrnnum" id="parentgrnnum" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $myrow[51] ?>"></td>
            <td colspan=2></td>
           </tr>
         <?php
         }?>
            <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>GRN No.</p></font></td>
            <td width=25%><input type="text" name="grnnum" id="grnnum" size=20 style=";background-color:#DDDDDD;" readonly = 'readonly' value="<?php echo $myrow[25] ?>">
            <input type="hidden" name="parentgrnnum" id="parentgrnnum" size=20 value="<?php echo $myrow[51] ?>"></td>
            <td  width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supplier</p></font></td>
            <td  colspan=1><span class="tabletext"><input type="text" name="vendor"
               style=";background-color:#DDDDDD;"
		       readonly="readonly" size=20 value="<?php echo "$myrow[23]";?>">
   		     <img src="images/bu-getvendor.gif" alt="Get Vendor"
                     onclick="javscript:GetAllVendors()"></td>
                 <input type="hidden" name="vendrecnum" id="vendrecnum" value="<?php echo "$myrow[24]";?>">
             </td>

        </tr>


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Raw Material Type</p></font></td>
            <td><input type="text" name="raw_mat_type" id="raw_mat_type" size=20 value="<?php echo $myrow[4] ?>">
            </td>
            <td><span class="labeltext"><p align="left">Raw Material Spec</p></font></td>
            <td><input type="text" name="raw_mat_spec" id="raw_mat_spec" size=20 value="<?php echo $myrow[5] ?>"></td>
         </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Raw Material Code</p></font></td>
            <td><input type="text" name="raw_mat_code" size=19 value="<?php echo $myrow[12] ?>"></td>
            <td><span class="labeltext"><p align="left">MGP/DC No.</p></font></td>
            <td><input type="text" name="mgp_num" size=20 value="<?php echo $myrow[18] ?>"></td>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Invoice No.</p></font></td>
            <td><input type="text" name="invoice_num" size=20 value="<?php echo $myrow[13] ?>"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Invoice Date</p></font></td>
            <td><input type="text" name="invoice_date" id="invoice_date" size=20 value="<?php echo $myrow[14] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
            <img src="images/bu-getdateicon.gif" alt="Get BookDate" onClick="GetDate('invoice_date')"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Test Reports & COC</p></font></td>
            <td><input type="text" name="test_report" size=20 value="<?php echo $myrow[16] ?>"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Received Date</p></font></td>
            <td><input type="text" name="recieved_date" id="recieved_date" size=20 value="<?php echo $myrow[15] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
            <img src="images/bu-getdateicon.gif" alt="Get BookDate" onClick="GetDate('recieved_date')"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Batch No.</p></font></td>
            <td><input type="text" name="batch_num" size=20 value="<?php echo $myrow[17] ?>"></td>
             <td><span class="labeltext"><p align="left">Remarks</p></font></td>
             <td colspan=1><textarea name="remarks" size=20><?php echo $myrow[33] ?></textarea></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COC Ref#</p></font></td>
            <td><input type="text" name="coc_refnum" size=20 value="<?php echo $myrow[26] ?>"></td>
            <td colspan="2"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM by Host</p></font></td>
             <td><input type="text" name="rmbycim" id="rmbycim" size=20 value="<?php echo $myrow[28] ?>"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM by Cust</p></font></td>
            <td><input type="text" name="rmbycust" id="rmbycust" size=20 value="<?php echo $myrow[29] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>CIM PO Num</p></font></td>
            <td><input type="text" name="cimponum" id="cimponum" size=20 value="<?php echo $myrow[30] ?>"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RMPO Line#</p></font></td>
            <td><input type="text" name="rmpoline_num" id="rmpoline_num" size=4 value="<?php echo $myrow[49] ?>">
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">GRN Type</p></font>
			<td><span class="tabletext"><input type="text" name="grntype" id="grntype"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[35] ?>">
	             <span class="tabletext"><select name="grntype1" size="1" width="20" onchange="onSelectGRNType()">
 	             <option selected>Please Specify
	             <option value="Regular">Regular
	             <option value="Rework">Rework
	             <option value="Semifinish">Semifinish
       	         <option value="Subcontracted">Subcontracted
				 <option value="Consummables">Consummables
				 <option value="Quarantined">Quarantined
				 <option value="Boughtout">Boughtout
	         </select>
            </td>
			<input type="hidden" name="prevgrntype" id="prevgrntype" value="<?php echo $myrow[35] ?>">
            <td><span class="labeltext"><p align="left">QA NC Ref#</p></font></td>
            <td><input type="text" name="nc_refnum" id="nc_refnum" size=20 value="<?php echo $myrow[34] ?>"></td>
        </tr>
        <?php		
        if($myrow[51] != '')
        {?>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PRN</p></font></td>
            <td><input type="text" name="crn" id="crn" size=20 value="<?php echo $myrow[36] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            <img src='images/bu-get.gif' name='cim' onclick='GetCIM4altcrn("<?php echo 'crn' ?>")'></td>
           <td><span class="labeltext"><p align="left">To PRN (Alternate)</p></font></td>
			<td><input type="text" name="altcrn" id="altcrn" size=20 value="<?php echo $myrow[50] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            </td>
			</tr>
			<input type="hidden" name="pocrn" id="pocrn" size=20 value="<?php echo $myrow[52] ?>">
         <?php
         }
         else
         {
         ?>
         <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">PO PRN</p></font></td>
            <td><input type="text" name="pocrn" id="pocrn" size=20 value="<?php echo $myrow[52] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            <img src='images/bu-get.gif' name='cim' onclick='GetCIM4pocrn("<?php echo 'pocrn' ?>")'><input type="hidden" name="altcrn" id="altcrn" size=20 value="<?php echo $myrow[50] ?>"</td>
            <td><span class="labeltext"><p align="left">PRN</p></font></td>
            <td><input type="text" name="crn" id="crn" size=20 value="<?php echo $myrow[36] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            <img src='images/bu-get.gif' name='cim' onclick='GetCIM("<?php echo 'crn' ?>")'><input type="hidden" name="altcrn" id="altcrn" size=20 value="<?php echo $myrow[50] ?>"</td>
         </tr>
         <?php
         }
         ?>
         <tr bgcolor="#FFFFFF">
	     <td><span class="labeltext"><p align="left">RM Checked By</p></font></td>
             <td><input type="text" name="rmempcode" id ="rmempcode" size=20 value="<?php echo $myrow[42] ?>"></td>
			 <td><span class="labeltext"><p align="left">RM Checked Date</p></font></td>
	        <td><input type="text" name="rmcheckdate" id="rmcheckdate" size=20
			style=";background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow[43] ?>">
            <img  src="images/bu-getdateicon.gif" alt="Get RmCheckDate" onClick="GetDate('rmcheckdate')"></td>
         </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Unit RM Cost</p></td>
            <td><input type="text" id="rm_cost" name="rm_cost" size=20 value="<?php echo $myrow[46] ?>">
   <span class="tabletext">
		<select name="currency" id="currency"  width=2>
		            <?
		            $currency=array('$','Rs');
					for($j=0;$j<count($currency);$j++){

					if($currency[$j] == $myrow[47]){?>
					<option selected value="<? echo $currency[$j]?>"><?echo $currency[$j]; ?>
					</option>
					<?}
					else{?>
                    <option value="<? echo $currency[$j]?>"><?echo $currency[$j]; ?>
					</option>
					<?}
					}?>

        </td>	

    <!-- <td><span class="labeltext"><p align="left">Approval Remarks</p></font></td>
             <td colspan=3><textarea name="approval_remarks" size=20 id="approval_remarks" value=''><?php echo trim($myrow[53]) ?></textarea>
             </td> -->            
     <td colspan=2></td>
			</tr>
			 <tr bgcolor="#FFFFFF">
	     <td><span class="labeltext"><p align="left">GRN Entered By</p></font></td>
             <td><input type="text" name="grnempcode" id ="grnempcode" size=20 value="<?php echo $myrow[44] ?>"></td>
			 <td><span class="labeltext"><p align="left">GRN Entered Date</p></font></td>
	        <td><input type="text" name="grncheckdate" id="grncheckdate" size=20
			style=";background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow[45] ?>">
            <img  src="images/bu-getdateicon.gif" alt="Get GrnCheckDate" onClick="GetDate('grncheckdate')"></td>
         </tr>
         <tr bgcolor="#FFFFFF">
		     <td><span class="labeltext"><p align="left">Quarantine Remarks</p></font></td>
<?php
     if ($myrow[35] == 'Quarantined' && $myrow[40] != '')
	 {
?>
          <td><textarea style=";background-color:#DDDDDD;" readonly="readonly"
		     name="quarremarks" id ="quarremarks" size=20><?php echo $myrow[40] ?></textarea></td>
	       <td><span class="labeltext"><p align="left">Conversion(to Regular) Date</p></font></td>
	        <td><input type="text" name="conversion_date" id="conversion_date" size=20 value="<?php echo $myrow[39]  ?>" 
			style=";background-color:#DDDDDD;" readonly="readonly">
            <img src="images/bu-getdateicon.gif" alt="Get ShippingDate" onClick="GetDate('conversion_date')"></td>
<?php
	 }
	 else 
	 {
?>
          <td><textarea name="quarremarks" id ="quarremarks" size=20><?php echo $myrow[40] ?></textarea></td>
	       <td><span class="labeltext"><p align="left">Conversion(to Regular) Date</p></font></td>
	        <td><input type="text" name="conversion_date" id="conversion_date" size=20 value="<?php echo $myrow[39]  ?>" 
			style=";background-color:#DDDDDD;" readonly="readonly">
            <img src="images/bu-getdateicon.gif" alt="Get ShippingDate" onClick="GetDate('conversion_date')">

</td>
<?php
	 }
?>
         </tr>

         <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">Quarantined Date</p></font></td>
            <td><input type="text" name="Quarantined_date" id="Quarantined_date" size=20 value="<?php echo $myrow[41] ?>" style="background-color:#DDDDDD;" readonly="readonly">
            <?php if($myrow[35] != "Quarantined") 
			{
				echo "<img src=\"images/bu-getdateicon.gif\" id='image' alt=\"Get BookDate\"          onClick=\"GetDate('Quarantined_date')\">";
			}
			?> 
			</td>
    <td width=20%><span class="labeltext"><p align="left">Status</p></font></td>
    <td ><span class="tabletext"><input type="text" name="status" id="status"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $status ?>"

	<span class="tabletext"><select name="grnstat" size="1" width="20" onchange="onSelectStatus()">
 	<option selected>Please Specify
	<option value='Open'>Open
	<option value='Closed'>Closed
	<option value='Cancelled'>Cancelled
       	
	</select>
	<input type="hidden" name="validate_flag" id="validate_flag" value=""></td></tr>
	<?php
  //echo $myrow[48]."in ed";
//if($status == 'Pending' && $dept !='Stores' && $dept !='CAD' )

/*if($status == 'Pending' && $dept== 'Purchasing' )
	{

            $checked="checked";
        ?>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Purchasing Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow[48] == 'yes'?$checked:"" ?>  id="approved_grn_1" name="approved_grn_1" onclick="JavaScript:toggleValue('approved_grn',this);">
                         <input type="hidden" name="approved_grn" value="<?php echo $myrow[48]?>" id="approved_grn">
                         <input type="hidden" name="prev_approved_grn" value="<?php echo $myrow[48]?>" id="prev_approved_grn">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
                         <input type="text" name="userid_app" id="userid_app" value="<?php echo $myrow[55]?>"></td>
           <td><span class="labeltext">Approved Date</td>
          <td ><span class="tabletext"><input type="text" name="approval_date" id="approval_date"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[54] ?>"></td>
          </tr>

		<input type="hidden" name="cad_approved_grn" value="<?php echo $myrow[59]?>" id="cad_approved_grn">
        <input type="hidden" name="userid_app_cad" id="userid_app_cad" value="<?php echo $myrow[60]?>">
         <input type="hidden" name="cad_approval_date" id="cad_approval_date"  value="<?php echo $myrow[61] ?>">



	<?}
	//elseif($status == 'Pending' && $dept !='Stores' && $dept !='Purchasing' )
	elseif($status == 'Pending' && $dept== 'CAD' )
	{?>
		  <tr bgcolor="#FFFFFF">
          <td><span class="labeltext">CAD Approved</td>
          <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow[59] == 'yes'?$checked:"" ?>  id="cad_approved_grn_1" name="cad_approved_grn_1" onclick="JavaScript:toggleValue_cad('cad_approved_grn',this);">
                         <input type="hidden" name="cad_approved_grn" value="<?php echo $myrow[59]?>" id="cad_approved_grn">
                         <input type="hidden" name="prev_cad_approved_grn" value="<?php echo $myrow[59]?>" id="prev_cad_approved_grn">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
                         <input type="text" name="userid_app_cad" id="userid_app_cad" value="<?php echo $myrow[60]?>"></td>
          <td><span class="labeltext">Approved Date</td>
          <td ><span class="tabletext"><input type="text" name="cad_approval_date" id="cad_approval_date"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[61] ?>"></td>
          </tr>
		  <input type="hidden" name="approved_grn" value="<?php echo $myrow[48]?>" id="approved_grn">
		  <input type="hidden" name="userid_app" id="userid_app" value="<?php echo $myrow[55]?>">
		  <input type="hidden" name="approval_date" id="approval_date" value="<?php echo $myrow[54]?>">

<?php
	}*/
	if(($myrow[37] != 'Pending' || $dept =='Stores' ) && $dept != 'Sales')
	{
     ?>
        <input type="hidden" name="approved_grn" value="<?php echo $myrow[48]?>" id="approved_grn">
        <input type="hidden" name="prev_approved_grn" value="<?php echo $myrow[48]?>" id="prev_approved_grn">
        <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
        <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
        <input type="hidden" name="userid_app" id="userid_app" value="<?php echo $myrow[55]?>">
        <input type="hidden" name="approval_date" id="approval_date" value="<?php echo $myrow[54] ?>">
		<input type="hidden" name="cad_approved_grn" value="<?php echo $myrow[59]?>" id="cad_approved_grn">
        <input type="hidden" name="userid_app_cad" id="userid_app_cad" value="<?php echo $myrow[60]?>">
        <input type="hidden" name="cad_approval_date" id="cad_approval_date"  value="<?php echo $myrow[61] ?>">
     
     <?php
     }
	 ?>
	 <tr bgcolor="#FFFFFF">
<td><span class="labeltext">Purchasing Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow[48] == 'yes'?$checked:"" ?>  id="approved_grn_1" name="approved_grn_1" onclick="JavaScript:toggleValue('approved_grn',this);" >
                         <input type="hidden" name="approved_grn" value="<?php echo $myrow[48]?>" id="approved_grn">
                         <input type="hidden" name="prev_approved_grn" value="<?php echo $myrow[48]?>" id="prev_approved_grn">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
						 <?
						 if($myrow[48] == 'yes')
			             {?>
                            <input type="text" name="userid_app" id="userid_app" value="<?php echo $myrow[55]?>" style="background-color:#DDDDDD;" readonly="readonly" ></td>
						 <?}
						 else
			             {?>
		                     <input type="text" name="userid_app" id="userid_app" value="<?php echo $myrow[55]?>"  ></td>
			             <?}?>
           <td><span class="labeltext">Approved Date</td>
          <td ><span class="tabletext"><input type="text" name="approval_date" id="approval_date"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[54] ?>"></td>
          </tr>
		  <tr bgcolor="#FFFFFF">
          <td><span class="labeltext">CAD Approved</td>
          <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow[59] == 'yes'?$checked:"" ?>  id="cad_approved_grn_1" name="cad_approved_grn_1" onclick="javaScript:toggleValue_cad('cad_approved_grn',this);" >
                         <input type="hidden" name="cad_approved_grn" value="<?php echo $myrow[59]?>" id="cad_approved_grn">
                         <input type="hidden" name="prev_cad_approved_grn" value="<?php echo $myrow[59]?>" id="prev_cad_approved_grn">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
						 <?
						 if($myrow[59] == 'yes')
						{?>
                              <input type="text" name="userid_app_cad" id="userid_app_cad" value="<?php echo $myrow[60]?>"   style="background-color:#DDDDDD;" readonly="readonly" ></td>
						<?}
						else
						{?>
					          <input type="text" name="userid_app_cad" id="userid_app_cad" value="<?php echo $myrow[60]?>"  ></td>
			            <?}?>
          <td><span class="labeltext">Approved Date</td>
          <td ><span class="tabletext"><input type="text" name="cad_approval_date" id="cad_approval_date"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo ($myrow[61] == '0000-00-00')?'':$myrow[61] ?>" ></td>
          </tr>
		         <tr bgcolor="#FFFFFF">
     <td><span class="labeltext"><p align="left">Approval Remarks</p></font></td>
             <td colspan=3><textarea name="approval_remarks" id="approval_remarks" rows=3 cols=40 ><?php echo trim($myrow[53]) ?></textarea>
             </td>
			 </tr>  

	 <tr bgcolor="#FFFFFF">
  	<td><span class="labeltext"><p align="left">Wo Ref</p></font></td>
            <td><input type="text" name="wo_ref" id="wo_ref" size=20 value="<?php echo $myrow[57] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'><img src='images/getwo.gif' name='WO' onclick='Get_all_wo()'></td>
				<td colspan=2></td>
			<?
		
     $j=1;
     while ($mygrnli4am = mysql_fetch_row($grnli4am))
  {
     $j++;
  }
     ?>

 </td>
 </tr>
<?php
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for %s</b></center></td></tr>',$myrow[25]);
         $grn_notes = $newgrn->getNotes($grnrecnum);
         printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes1" rows="6" cols="88"  readonly="readonly">');
         while ($mynotes = mysql_fetch_row($grn_notes))
         {
          print("\n");
          print("********Added by $mynotes[2] *********** on $mynotes[1] ");
          print("\n");
          print(" $mynotes[0]");
          print("   \n");
         }
      ?>
      </textarea></td>
      </tr>
     <?php printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
       <td colspan=4><textarea name="notes" id="notes" rows="3" cols="88%" value=""></textarea>
       </td> </tr>

<!--<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value,<?php echo $j ?>)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr> -->
<input type="hidden" name="action" value="edit">
<input type="hidden" name="grnrecnum" id="grnrecnum" value="<?php echo $grnrecnum ?>">
<table  style="width:67% border=0 cellpadding=3 cellspacing=1 class="stdtable">
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Unit RM Size</b></center></td>
</tr>


<tr bgcolor="#FFFFFF">
</table>
<div style="width:67%; overflow-x: scroll;">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr >
    <thead>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>Line</center></b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Amend Line</center></b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>Layout Ref#</center></b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Partnum</center></b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>Part Desc</center></b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Batch</center></b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>UOM</center></b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Exp Date<br>(yyyy-mm-dd)</center></b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>No Of<br>Pieces</center></b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Dim1(L)</center></b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>Dim2(W/ID)</center></b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Dim3(T/OD)</center></b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>Qty</center></b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Qty/Billet</center></b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>Qty Rej</center></b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>QTM</center></b></th>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Amend</center></b></td>-->
</tr>
</head>
<tr>
<?php
   $i=1;   $flag=0;
  $total=0;$total_prevqty=0;
  while($i<=10)
{
 if($flag==0)
 {
  while ($mygrnli = mysql_fetch_row($grnli))
  {
	 
      $prevlinenum = "prevlinenum" . $i;
      $lirecnum = "lirecnum" . $i;
      
      echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$mygrnli[0]\">";
      echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$mygrnli[7]\">";
	
?>
      <tr bgcolor="#FFFFFF">
      <td><center><input type="text" id="line_num<?php echo $i?>" name="line_num<?php echo $i?>" value="<?php echo $mygrnli[0] ?>" size=2></center></td>
      <td><center><input type="text" id="amend_line_num<?php echo $i?>" name="amend_line_num<?php echo $i?>" value="<?php echo $mygrnli[17] ?>" size=2 onblur="javascript:getstat(this,'<?php echo $i ?>');"></center></td>
      <td><center><input type="text" id="layout_ref<?php echo $i?>" name="layout_ref<?php echo $i?>" value="<?php echo $mygrnli[18] ?>" size=8></center></td>
      <td><center><input type="text" id="partnum<?php echo $i?>" name="partnum<?php echo $i?>" value="<?php echo $mygrnli[11] ?>" size=6></center></td>
      <td><center><input type="text" id="partdesc<?php echo $i?>" name="partdesc<?php echo $i?>" value="<?php echo $mygrnli[12] ?>" size=25></center></td>

      <td><center><input type="text" id="batchnum<?php echo $i?>" name="batchnum<?php echo $i?>" value="<?php echo $mygrnli[13] ?>" size=6></center></td>
      <td><center><input type="text" id="uom<?php echo $i?>" name="uom<?php echo $i?>" value="<?php echo $mygrnli[14] ?>" onkeyup="javascript:getuom(this);" size=5></center></td>
      <td><center><input type="text" id="expdate<?php echo $i?>" name="expdate<?php echo $i?>" value="<?php echo $mygrnli[15] ?>" size=10></center></td>

      <td><center><input type="text" id="noofpieces<?php echo $i ?>" name="noofpieces<?php echo $i ?>" value="<?php echo $mygrnli[20] ?>" size=3 onkeyup="javascript:getQty(this);" ></center></td>

      <td><center><input type="text" id="dim1<?php echo $i ?>" name="dim1<?php echo $i ?>" value="<?php echo $mygrnli[2] ?>" size=5 onkeyup="javascript:getQty(this);" ></center></td>
      <td><center><input type="text" id="dim2<?php echo $i ?>" name="dim2<?php echo $i ?>" value="<?php echo $mygrnli[3] ?>" size=5></center></td>
      <td><center><input type="text" id="dim3<?php echo $i ?>" name="dim3<?php echo $i ?>" value="<?php echo $mygrnli[4] ?>" size=5></center></td>

    <?	
	  if($mygrnli[20] == 0)
	  {?>
			   <td><center><input type="text" id="qty<?php echo $i ?>" name="qty<?php echo $i ?>"   value="<?php echo $mygrnli[1] ?>" onkeyup="javascript:getqtm_value(<?echo $i ?>)" size=3></center></td>
	  <?}
	  else
	  {?>      
      <td><center><input type="text" id="qty<?php echo $i ?>" name="qty<?php echo $i ?>" style=";background-color:#DDDDDD;"
		       readonly="readonly"  value="<?php echo $mygrnli[1] ?>" onkeyup="javascript:getqtm_value(<?echo $i ?>)" size=3></center></td>
	  <?}?>

     <td><center><input  type="text" id="qty4billet<?php echo $i?>" name="qty4billet<?php echo $i?>" value="<?php echo $mygrnli[10] ?>" style="background-color:#DDDDDD;"  size=5></center></td>
      <td><center><input type="text" id="qty_rej<?php echo $i?>" name="qty_rej<?php echo $i?>" value="<?php echo $mygrnli[8] ?>" size=5></center></td>
      <td><center><input type="text" id="qty_to_make<?php echo $i?>" name="qty_to_make<?php echo $i?>" value="<?php echo $mygrnli[9] ?>" size=5 onblur="javascript:get_total(this);"></center></td>
     <!--<td align=center>
     <select id=amendstatus<?php echo $i?> name=amendstatus<?php echo $i?> onclick="javascript:get_total(this);">
     <option selected value="<?php echo $mygrnli[19]?>"><?php echo $mygrnli[19]?></option>
                   <option value=Active>Active</option>
                   <option value=Inactive>Inactive</option>
                </select>
                 </td> -->

      </tr>
<?php
   //onblur="javascript:setAmendstat(echo $i )
      $i++;
      //$total = $total + $mygrnli[9];
      if($mygrnli[17] == '')
      {
        $total = $total + $mygrnli[9];
        $total_prevqty = $total_prevqty + $mygrnli[1];
      }
  }
  $flag=1;
  }
     $prevlinenum = "prevlinenum" . $i;
      $lirecnum = "lirecnum" . $i;

      echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
      echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"\">";
?>
      <tr bgcolor="#FFFFFF">
      <td><center><input type="text" id="line_num<?php echo $i?>" name="line_num<?php echo $i?>" value="" size=2></center></td>
      <td><center><input type="text" id="amend_line_num<?php echo $i?>" name="amend_line_num<?php echo $i?>" value="" size=2 onblur="javascript:getstat(this,'<?php echo $i ?>');"></center></td>
      <td><center><input type="text" id="layout_ref<?php echo $i?>" name="layout_ref<?php echo $i?>" value="" size=8></center></td>
      <td><center><input type="text" id="partnum<?php echo $i?>" name="partnum<?php echo $i?>" value="" size=6></center></td>
      <td><center><input type="text" id="partdesc<?php echo $i?>" name="partdesc<?php echo $i?>" value="" size=25></center></td>
      <td><center><input type="text" id="batchnum<?php echo $i?>" name="batchnum<?php echo $i?>" value="" size=6></center></td>
      <td><center><input type="text" id="uom<?php echo $i?>" name="uom<?php echo $i?>" value="" onkeyup="javascript:getuom(this);" size=5></center></td>
      <td><center><input type="text" id="expdate<?php echo $i?>" name="expdate<?php echo $i?>" value="" size=10></center></td>
      <td><center><input type="text" id="noofpieces<?php echo $i ?>" name="noofpieces<?php echo $i ?>" value="" size=3 onkeyup="javascript:getQty(this);"></center></td>
      <td><center><input type="text" id="dim1<?php echo $i ?>" name="dim1<?php echo $i ?>" value="" size=5 onkeyup="javascript:getQty(this);"></center></td>
      <td><center><input type="text" id="dim2<?php echo $i ?>" name="dim2<?php echo $i ?>" value="" size=5></center></td>
      <td><center><input type="text" id="dim3<?php echo $i ?>" name="dim3<?php echo $i ?>" value="" size=5></center></td>
      <td><center><input type="text" id="qty<?php echo $i ?>" name="qty<?php echo $i ?>" value="" onkeyup="javascript:getqtm_value(<?echo $i ?>)"  size=3></center></td>
     <td><center><input  type="text" id="qty4billet<?php echo $i?>" name="qty4billet<?php echo $i?>" value="" size=5  style="background-color:#DDDDDD;" ></center></td>
      <td><center><input type="text" id="qty_rej<?php echo $i?>" name="qty_rej<?php echo $i?>" value="" size=5></center></td>
      <td><center><input type="text" id="qty_to_make<?php echo $i?>" name="qty_to_make<?php echo $i?>" value="" size=5 onblur="javascript:get_total(this);"></center></td>
     <!--<td align=center>
     <select id=amendstatus<?php //echo $i?> name=amendstatus<?php //echo $i?> onclick="javascript:get_total(this);">
     <option selected value="<?php //echo $mygrnli[19]?>"><?php //echo $mygrnli[19]?></option>
                   <option value=Active>Active</option>
                   <option value=Inactive>Inactive</option>
                </select>
                 </td> -->

      </tr>
<?php
   //onblur="javascript:setAmendstat(echo $i )
      $i++;
}
echo "<input type=\"hidden\" name=\"index\" id=\"index\" value=$i>";
echo "<input type=\"hidden\" name=\"qty_tot\" id=\"qty_tot\" value= $total_prevqty >";
?>
</tr>
</table>


	<?
	$row=mysql_fetch_object($cofc);
  $dimenssion=$row->dimensional;
  $ndt=$row->ndt;
 $visual=$row->visual;
 $grain=$row->grain;
 $mech=$row->mech;
 $conductivity=$row->conductivity;
  $chemical=$row->chemical;
 $hardness=$row->hardness;
 $quantity=$row->quantity;
 $temper=$row->temper;
 $cus=$row->cusserial;
 $from=$row->frmserial;
 $to=$row->toserial;
 $noncon=$row->noncon;
 $ncref=$row->ncref;
 $ncdate=$row->ncdate;
 $comm=$row->comm;
 $dcomm=$row->dcomm;
 $remarks=$row->remarks;
 $approval=$row->approval;

             if($ncdate != '' && $ncdate != '0000-00-00')
             {
              $d=substr($ncdate,8,2);
              $m=substr($ncdate,5,2);
              $y=substr($ncdate,0,4);
              $x=mktime(0,0,0,$m,$d,$y);
              $date1=date("M j, Y",$x);
             }
             else
             {
               $date1 = '';
             }
        
?>
	
	
	<tr bgcolor="#FFFFFF">
	

       <table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

       	<tr bgcolor="#FFFFFF">
      <td colspan=6 align=right class=labeltext>Total Qty</td>
      <td align=center colspan=2><input type=text name=total_qty_make id=total_qty_make value='<?php echo $total?>'size=8></td>
   </tr>

         <!-- <tr bgcolor="#DDDEDD">
<td align="center" colspan=8><span class="heading"><b>Validation of Certificate of Compliance by RM Supplier</b></span></td>

        </tr>
		 <tr bgcolor="#FFFFFF">
	<td  width=30%> <span class="heading"><b><left>Standard for Verification</left></b></td>
	<td width=70% colspan=7> <span class="heading"><b><left></left></b></td>	
		</tr>
		<tr bgcolor="#FFFFFF">
		<td width=35%><span class="labeltext"><p align="left">Description</p></td>

	<td width=5%> <span class="labeltext"><p align="left">Yes</p></td>
	<td width=5%> <span class="labeltext"><p align="left">No</p></td>
	<td width=5%> <span class="labeltext"><p align="left">N/A</p></td>
	<td width=35%> <span class="labeltext"><p align="left">Description</p></td>
	<td width=5%> <span class="labeltext"><p align="left">Yes</p></td>
	<td width=5%> <span class="labeltext"><p align="left">No</p></td>
	<td width=5%> <span class="labeltext"><p align="left">N/A</p></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=35%><span class="tabletext"><p align="left">Dimensional Inspection</p></td>
	<td width=5%> <b><input name="dimensional" type="radio" value="1" <?php if ($dimenssion=='1'){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="dimensional" type="radio" value="2" <?php if ($dimenssion==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="dimensional" type="radio" value="3" <?php if ($dimenssion==3){?>checked="checked" <?php }?>></b></td>
	<td width=35%> <span class="tabletext"><p align="left">NDT Procedures correct,where applicable</p></td>
	<td width=5%> <b><input name="ndt" type="radio" value="1" <?php if ($ndt==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="ndt" type="radio" value="2" <?php if ($ndt==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="ndt" type="radio" value="3" <?php if ($ndt==3){?>checked="checked" <?php }?>></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=35%><span class="tabletext"><p align="left">Visual Examination for Omission of Damages</p></td>
	<td width=5%> <b><input name="visual" type="radio" value="1" <?php if ($visual==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="visual" type="radio" value="2" <?php if ($visual==2){?>checked="checked" <?php }?> ></b></td>
	<td width=5%> <b><input name="visual" type="radio" value="3" <?php if ($visual==3){?>checked="checked" <?php }?>></b></td>
	<td width=35%> <span class="tabletext"><p align="left">Is Grain Flow Mentioned</p></td>
	<td width=5%> <b><input name="grain" type="radio" value="1" <?php if ($grain==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="grain" type="radio" value="2" <?php if ($grain==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="grain" type="radio" value="3" <?php if ($grain==3){?>checked="checked" <?php }?>></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Mechanical Properties verified against Standered</p></td>
	<td width=5%> <b><input name="mechanical" type="radio" value="1" <?php if ($mech==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="mechanical" type="radio" value="2" <?php if ($mech==2){?>checked="checked" <?php }?> ></b></td>
	<td width=5%> <b><input name="mechanical" type="radio" value="3" <?php if ($mech==3){?>checked="checked" <?php }?>></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Conductivity</p></td>
	<td width=5%> <b><input name="conductivity" type="radio" value="1" <?php if ($conductivity==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="conductivity" type="radio" value="2" <?php if ($conductivity==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="conductivity" type="radio" value="3" <?php if ($conductivity==3){?>checked="checked" <?php }?>></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Chemical Properties verified against Standered</p></td>
	<td width=5%> <b><input name="chemical" type="radio" value="1"  <?php if ($chemical==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="chemical" type="radio" value="2" <?php if ($chemical==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="chemical" type="radio" value="3" <?php if ($chemical==3){?>checked="checked" <?php }?>></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Hardness</p></td>
	<td width=5%> <b><input name="hardness" type="radio" value="1" <?php if ($hardness==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="hardness" type="radio" value="2" <?php if ($hardness==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="hardness" type="radio" value="3" <?php if ($hardness==3){?>checked="checked" <?php }?>></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Quantity received agrees with Certification</p></td>
	<td width=5%> <b><input name="quantity" type="radio" value="1"  <?php if ($quantity==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="quantity" type="radio" value="2"  <?php if ($quantity==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="quantity" type="radio" value="3"  <?php if ($quantity==3){?>checked="checked" <?php }?>></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Temper</p></td>
	<td width=5%> <b><input name="temper" type="radio" value="1" <?php if ($temper==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="temper" type="radio" value="2"  <?php if ($temper==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="temper" type="radio" value="3"  <?php if ($temper==3){?>checked="checked" <?php }?>></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Serialization Requirements?</p></td>
<td width=10% colspan="2"><span class="tabletext"><p align="left">Customer Serialization</p></td>
	
	 <td  width="%"><span class="tabletext">Yes<input name="cus" type="radio" value="1" <?php if ($cus==1){?>checked="checked" <?php }?> >
  <span class="tabletext">No &nbsp;<input name="cus" type="radio" value="2" <?php if ($cus==2){?>checked="checked" <?php }?>></td>

	<td width=30%><span class="tabletext"><p align="left">CIM Serialization
	<span class="tabletext">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes<input name="cus" type="radio" value="3" <?php if ($cus==3){?>checked="checked" <?php }?>>
	<span class="tabletext">No<input name="cim" type="hidden" value="2" checked="checked">
	<input name="cus" type="radio" value="4" <?php if ($cus==4){?>checked="checked" <?php }?> ></p></td>
	<td width=8% colspan="2"> <span class="tabletext"><p align="left">Serialization not Required</p></td>
	<td width=3%> <b><input name="cus" type="radio" value="5" <?php if ($cus==5){?>checked="checked" <?php }?>></b></td>
		</tr><input name="not" type="hidden" value="5" >
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">If yes Mention Serial No. </p></td>
	<td width=5% colspan=2> <span class="tabletext"><p align="left">From </p></td>
	<td width=5%> <input name="frmserial" type="text" value="<?php echo $from?>"></td>
	<td width=5% colspan=4> <span class="tabletext"><p align="left">To     <input name="toserial" type="text" value="<?php echo $to?>"> </b></td>

	</tr>
	<tr bgcolor="#DDDEDD">
     <td align="center" colspan=8><span class="heading"><b>Non-Conformance</b></span></td>
    </tr>
	<tr bgcolor="#FFFFFF">
	 <td width=30%><span class="labeltext"><p align="left">Are any Non Conformance Observed</p></td>
	<td width=6%> <span class="labeltext"><b>Yes</b></span>
	<input name="conformance" type="radio" value="1"  <?php if ($noncon==1){?>checked="checked" <?php }?>></td>
	<td width=5% colspan=2> <b><span class="labeltext"><b>No</b></span>
	
	<input name="conformance" type="radio" value="2"  <?php if ($noncon==2){?>checked="checked" <?php }?> ></b></td>
	
	<td width=5% colspan=4 align=top><b><span class="labeltext">NCR Ref No.</b></span> <input name="ncref" id="ncref" type="text" value="<?php echo $ncref?>"><br>
	<span class="labeltext">NCR Date</b></span>
     &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="ncrdate" size=20 value="<?php echo $ncdate?>" style="background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getdateicon.gif" alt="Get BookDate" onClick="GetDate('ncrdate')"></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30% colspan=4><span class="labeltext"><p align="left">Is the Observed Non-Conformance communicated to the respective authorities</p></td>
	<td colspan=6> <b><span class="labeltext">Yes<input name="comm" type="radio" value="1"<?php if ($comm==1){?>checked="checked" <?php }?> ></b>
	<span class="labeltext">No <b><input name="comm" type="radio" value="2" <?php if ($comm==2){?>checked="checked" <?php }?> ></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Details of Communication</p></td>
	<td width=5% colspan=12><textarea name="dcomm" cols="70" rows=""><?php echo $dcomm?></textarea></td>
	
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Additional Notes/Remarks</p></td>
	<td width=5% colspan=7><textarea name="anotes" cols="70" rows=""><?php echo $remarks?></textarea></td>
	
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Authorised Signatory With Date<br>
     (Store Department)</p></td> -->
	<!-- <td width=5% colspan=7 class="tabletext">

    <?php

       if($approval != '')
       {
         //echo $approval . 'hiiiiii';
    ?>
         <input type="hidden" name="approval" value="<?php echo $approval?>">
    <?php
       }
       else
       {
    ?>
         Yes<input name="approval" type="radio" value="<?php echo $approved; ?>" >
         No<input name="approval" type="radio" value=" " checked>
    <?php
       }
    ?>

    </td>
	
		</tr> -->
	
	</td>
    </tr>


    </td>
     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

         <tr bgcolor="#FFFFFF">


        </tr>


</table>
  <table style="width:100%" border=0 cellpadding=3 cellspacing=1 id='grn_issue' bgcolor="#EEEEEE" class="stdtable">
      <tr bgcolor="#DDDEDD">
        <thead>
            <td height="34" colspan=13><span class="heading">
              <center><b>Material Issue</b></center></td>
     </tr>
   <!--  <tr bgcolor="#FFFFFF"><td colspan=8><a href="javascript:addRow4grn_issue('grn_issue',document.forms[0].grniss_index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr> -->
        <tr>
           
             <th class="head0" bgcolor="#FFFFFF" align=center><span class="labeltext">Line Num</font></th>
             <th class="head1" bgcolor="#FFFFFF" align=center><span class="labeltext">WO Num</font></th>
             <th class="head0" align=center><span class="labeltext">Wo Date</font></td>
             <th class="head1" bgcolor="#FFFFFF" align=center><span class="labeltext">WO Qty</font></th>
             <!-- <th class="head0" bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Accepted</font></th> -->
             <th class="head1" bgcolor="#FFFFFF" align=center><span class="labeltext">Rework</font></th>
             <th class="head0" bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Rejected</font></th>
             <th class="head1" bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Returned</font></th>
             <th class="head0" bgcolor="#FFFFFF" align=center><span class="labeltext">Balance</font></th>
        </tr>
    </thead>
   <?php
     $i=1;
       while($myrow3 = mysql_fetch_row($result3))
       {
       
          $line_no = 'line_no' . $i;
          $iss_date = 'issdate' . $i;
          $iss_qty = 'issqty' . $i;
          $iss4wo = 'iss4wo' . $i;
          $accqty = 'accqty' . $i;
          $rework = 'rework' . $i;
          $rejqty = 'rejqty' . $i;
          $retqty = 'retqty' . $i;
          $balance = 'balance' . $i;
          
          $prevlinenum="prevlineno" . $i;
		  $lirecnum="lirecno" . $i;
          
          $fields = $iss4wo . '_' . $iss_date . '_' . $iss_qty;
   ?>
        <tr bgcolor="#FFFFFF">
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $line_no?>' value='<?php echo $i ?>' size=8 style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $iss4wo?>' value='<?php echo $myrow3[0] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly">
                                   <!--<img src="images/getwo.gif" onClick="javascript:GetWo('<?php echo $fields ?>')">--></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $iss_date?>' value='<?php echo $myrow3[1] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $iss_qty?>' value='<?php echo $myrow3[6] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly"></td>
             <!-- <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $accqty?>' value='<?php echo $myrow3[2] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly"></td> -->
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $rework?>' value='<?php echo $myrow3[3] ?>' size=8  style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $rejqty?>' value='<?php echo $myrow3[4] ?>' size=8  style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $retqty?>' value='<?php echo $myrow3[5] ?>' size=8  style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td align=center><input type=text name='<?php echo $balance?>' value='<?php echo ($total-$myrow3[6]+$myrow3[5]) ?>' size=8 style="background-color:#DDDDDD;" readonly='readonly'></td>

         </tr>

   <?php
	    $total = $total-$myrow3[6]+$myrow3[5];
        $i++;
       }
       echo "<input type=\"hidden\" name=\"balance\" value=$total>";
       echo "<input type=\"hidden\" name=\"grniss_index\" value=$i>";
   ?>
   
   



    </table>
 <?php
 }
 if($dept=='Purchasing' && $myrow[37]=='Pending')
 {
 ?>
    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
	<tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>GRN Classification</p></font>
			<td width=25%><span class="tabletext"><input type="text" name="wotype" id="wotype"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[58] ?>">	             
				 </td>
				 <td width='25%'><span class="labeltext"><p align="left"> QTM Req.</p></font></td>             
			<td><input type="text" name="qtm_req" id="qtm_req" size=20 value="<?=$myrow[62]?>" style="background-color:#DDDDDD;" readonly="readonly" ></td>
			</tr>
         <?php
         if($myrow[51] !='' )
         {
         ?>
         <tr bgcolor="#FFFFFF">

            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Parent GRN No.</p></font></td>
            <td width=25%><input type="text" name="parentgrnnum" id="parentgrnnum" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $myrow[51] ?>"></td>
            <td colspan=2></td>
           </tr>
         <?php
         }
        ?>
        <tr bgcolor="#FFFFFF">

            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>GRN No.</p></font></td>
            <td width=25%><input type="text" name="grnnum" id="grnnum" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $myrow[25] ?>">
            <input type="hidden" name="parentgrnnum" id="parentgrnnum" size=20 value="<?php echo $myrow[51] ?>"></td>
            <td  width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supplier</p></font></td>
            <td  colspan=1><span class="tabletext"><input type="text" name="vendor"
               style=";background-color:#DDDDDD;"
		       readonly="readonly" size=20 value="<?php echo "$myrow[23]";?>">
   		     </td>
                 <input type="hidden" name="vendrecnum" id="vendrecnum" value="<?php echo "$myrow[24]";?>">
             </td>

        </tr>


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Raw Material Type</p></font></td>
            <td><input type="text" name="raw_mat_type" id="raw_mat_type" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $myrow[4] ?>">
            </td>
            <td><span class="labeltext"><p align="left">Raw Material Spec</p></font></td>
            <td><input type="text" name="raw_mat_spec" id="raw_mat_spec" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $myrow[5] ?>"></td>
         </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Raw Material Code</p></font></td>
            <td><input type="text" name="raw_mat_code" size=19 style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $myrow[12] ?>"></td>
            <td><span class="labeltext"><p align="left">MGP/DC No.</p></font></td>
            <td><input type="text" name="mgp_num" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $myrow[18] ?>"></td>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Invoice No.</p></font></td>
            <td><input type="text" name="invoice_num" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $myrow[13] ?>"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Invoice Date</p></font></td>
            <td><input type="text" name="invoice_date" id="invoice_date" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $myrow[14] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Test Reports & COC</p></font></td>
            <td><input type="text" name="test_report" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $myrow[16] ?>"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Received Date</p></font></td>
            <td><input type="text" name="recieved_date" id="recieved_date" size=20 value="<?php echo $myrow[15] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Batch No.</p></font></td>
            <td><input type="text" name="batch_num" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $myrow[17] ?>"></td>
             <td><span class="labeltext"><p align="left">Remarks</p></font></td>
             <td colspan=1><textarea name="remarks" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly"><?php echo $myrow[33] ?></textarea></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COC Ref#</p></font></td>
            <td><input type="text" name="coc_refnum" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $myrow[26] ?>"></td>
            <td colspan="2"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM by Host</p></font></td>
             <td><input type="text" name="rmbycim" id="rmbycim" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $myrow[28] ?>"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM by Cust</p></font></td>
            <td><input type="text" name="rmbycust" id="rmbycust" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $myrow[29] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>CIM PO Num</p></font></td>
            <td><input type="text" name="cimponum" id="cimponum" size=20  style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $myrow[30] ?>"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RMPO Line#</p></font></td>
            <td><input type="text" name="rmpoline_num" id="rmpoline_num" size=4 style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $myrow[49] ?>">
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">GRN Type</p></font>
			<td><span class="tabletext"><input type="text" name="grntype" id="grntype"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[35] ?>">

            </td>
			<input type="hidden" name="prevgrntype" id="prevgrntype" value="<?php echo $myrow[35] ?>">
            <td><span class="labeltext"><p align="left">QA NC Ref#</p></font></td>
            <td><input type="text" name="nc_refnum" id="nc_refnum" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $myrow[34] ?>"></td>
        </tr>
        <?php
        if($myrow[51] != '')
        {
        ?>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PRN</p></font></td>
            <td><input type="text" name="crn" id="crn" size=20 value="<?php echo $myrow[36] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            <img src='images/bu-get.gif' name='cim' onclick='GetCIM4altcrn("<?php echo 'crn' ?>")'></td>
           <td><span class="labeltext"><p align="left">To PRN (Alternate)</p></font></td>
			<td><input type="text" name="altcrn" id="altcrn" size=20 value="<?php echo $myrow[50] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            </td>
			</tr>
			<input type="hidden" name="pocrn" id="pocrn" size=20 value="<?php echo $myrow[52] ?>">
         <?php
         }
         else
         {
         ?>
         <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">PO PRN</p></font></td>
            <td><input type="text" name="pocrn" id="pocrn" size=20 value="<?php echo $myrow[52] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            <input type="hidden" name="altcrn" id="altcrn" size=20 value="<?php echo $myrow[50] ?>"</td>
            <td><span class="labeltext"><p align="left">PRN</p></font></td>
            <td><input type="text" name="crn" id="crn" size=20 value="<?php echo $myrow[36] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            <input type="hidden" name="altcrn" id="altcrn" size=20 value="<?php echo $myrow[50] ?>"></td>
         </tr>
         <?php
         }

         ?>
         <tr bgcolor="#FFFFFF">
	     <td><span class="labeltext"><p align="left">RM Checked By</p></font></td>
             <td><input type="text" name="rmempcode" id ="rmempcode" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $myrow[42] ?>"></td>
			 <td><span class="labeltext"><p align="left">RM Checked Date</p></font></td>
	        <td><input type="text" name="rmcheckdate" id="rmcheckdate" size=20
			style=";background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow[43] ?>">
            </td>
         </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Unit RM Cost</p></td>
            <td><input type="text" id="rm_cost" name="rm_cost" size=20 style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow[46] ?>">


        </td>
			<td colspan=2></td>
			</tr>
			 <tr bgcolor="#FFFFFF">
	     <td><span class="labeltext"><p align="left">GRN Entered By</p></font></td>
             <td><input type="text" name="grnempcode" id ="grnempcode" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $myrow[44] ?>"></td>
			 <td><span class="labeltext"><p align="left">GRN Entered Date</p></font></td>
	        <td><input type="text" name="grncheckdate" id="grncheckdate" size=20
			style=";background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow[45] ?>">
            </td>
         </tr>
         <tr bgcolor="#FFFFFF">
		     <td><span class="labeltext"><p align="left">Quarantine Remarks</p></font></td>

          <td><textarea style=";background-color:#DDDDDD;" readonly="readonly"
		     name="quarremarks" id ="quarremarks" size=20><?php echo $myrow[40] ?></textarea></td>
	       <td><span class="labeltext"><p align="left">Conversion(to Regular) Date</p></font></td>
	        <td><input type="text" name="conversion_date" id="conversion_date" size=20 value="<?php echo ($myrow[39] == '0000-00-00')?'':$myrow[39]  ?>"
			style=";background-color:#DDDDDD;" readonly="readonly"></td>

         </tr>

         <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">Quarantined Date</p></font></td>
            <td><input type="text" name="Quarantined_date" id="Quarantined_date" size=20 value="<?php echo ($myrow[41] == '0000-00-00')?'':$myrow[41] ?>" style="background-color:#DDDDDD;" readonly="readonly">

			</td>
    <td width=20%><span class="labeltext"><p align="left">Status</p></font></td>
    <td ><span class="tabletext"><input type="text" name="status" id="status"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[37] ?>"
	<input type="hidden" name="validate_flag" id="validate_flag" value="">
    
	<?php
  //echo $myrow[48]."in ed";
if($myrow[37] == 'Pending')
	{
	
        ?>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Purchasing Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow[48] == 'yes'?$checked:"" ?>  id="approved_grn_1" name="approved_grn_1" onclick="JavaScript:toggleValue('approved_grn',this);">
                         <input type="hidden" name="approved_grn" value="<?php echo $myrow[48]?>" id="approved_grn">
                         <input type="hidden" name="prev_approved_grn" value="<?php echo $myrow[48]?>" id="prev_approved_grn">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
						 <?
						 if($myrow[48] == 'yes')
		                 {?>
                              <input type="text" name="userid_app" id="userid_app" value="<?php echo $myrow[55]?>" style="background-color:#DDDDDD;" readonly="readonly" ></td>
						<?}
						else
		                {?>
                              <input type="text" name="userid_app" id="userid_app" value="<?php echo $myrow[55]?>"></td>
		                <?}?>
           <td><span class="labeltext">Approved Date</td>
          <td ><span class="tabletext"><input type="text" name="approval_date" id="approval_date"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo ($myrow[54] == '0000-00-00')?'':$myrow[54]?>"></td>
          </tr>

		   <tr bgcolor="#FFFFFF">
          <td><span class="labeltext">CAD Approved</td>
          <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow[59] == 'yes'?$checked:"" ?>  id="cad_approved_grn_1" name="cad_approved_grn_1" onclick="JavaScript:toggleValue_cad('cad_approved_grn',this);" disabled>
                         <input type="hidden" name="cad_approved_grn" value="<?php echo $myrow[59]?>" id="cad_approved_grn">
                         <input type="hidden" name="prev_cad_approved_grn" value="<?php echo $myrow[59]?>" id="prev_cad_approved_grn">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
                         <input type="text" name="userid_app_cad" id="userid_app_cad" value="<?php echo $myrow[60]?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
          <td><span class="labeltext">Approved Date</td>
          <td ><span class="tabletext"><input type="text" name="cad_approval_date" id="cad_approval_date"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo ($myrow[61] == '0000-00-00')?'':$myrow[61] ?>" ></td>
          </tr>

          <tr bgcolor="#FFFFFF">
     <td><span class="labeltext"><p align="left">Approval Remarks</p></font></td>
             <td colspan=3><textarea name="approval_remarks" id="approval_remarks" rows=3 cols=40 style="background-color:#DDDDDD;" readonly="readonly" ><?php echo trim($myrow[53]) ?></textarea>
             </td> </tr>
                 <input type="hidden" name="cad_approved_grn" value="<?php echo $myrow[59]?>" id="cad_approved_grn">
                         <input type="hidden" name="prev_cad_approved_grn" value="<?php echo $myrow[59]?>" id="prev_cad_approved_grn">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
                         <input type="hidden" name="userid_app_cad" id="userid_app_cad" value="<?php echo $myrow[60]?>"></td>
         <input type="hidden" name="cad_approval_date" id="cad_approval_date"  value="<?php echo $myrow[61] ?>"></td>
          </tr>

		   <tr bgcolor="#FFFFFF">
  	<td><span class="labeltext"><p align="left">Wo Ref</p></font></td>
            <td><input type="text" name="wo_ref" id="wo_ref" size=20 value="<?php echo $myrow[57] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
				<td colspan=2></td>
			<?
		
     $j=1;
     while ($mygrnli4am = mysql_fetch_row($grnli4am))
  {
     $j++;
  }
     ?>

 </td>
 </tr>



<?php
	}
    else if($myrow[37] != 'Pending')
	{
     ?>
        <input type="hidden" name="approved_grn" value="<?php echo $myrow[48]?>" id="approved_grn">
        <input type="hidden" name="prev_approved_grn" value="<?php echo $myrow[48]?>" id="prev_approved_grn">
        <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
        <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
        <input type="hidden" name="userid_app" id="userid_app" value="<?php echo $myrow[55]?>">
        <input type="hidden" name="approval_date" id="approval_date" value="<?php echo $myrow[54] ?>">

		<input type="hidden" name="cad_approved_grn" value="<?php echo $myrow[59]?>" id="cad_approved_grn">
        <input type="hidden" name="prev_cad_approved_grn" value="<?php echo $myrow[59]?>" id="prev_cad_approved_grn">
		<input type="hidden" name="userid_app_cad" id="userid_app_cad" value="<?php echo $myrow[60]?>">
		<input type="hidden" name="cad_approval_date" id="cad_approval_date"  value="<?php echo $myrow[61] ?>">

        <tr bgcolor="#FFFFFF">
     <td><span class="labeltext"><p align="left">Approval Remarks</p></font></td>
             <td colspan=3><textarea name="approval_remarks" id="approval_remarks" style="background-color:#DDDDDD;" readonly="readonly" rows=3 cols=40><?php echo trim($myrow[53]) ?></textarea>
             </td> </tr>

     <?php
     }
     ?>

             <?php

     $j=1;
     while ($mygrnli4am = mysql_fetch_row($grnli4am))
  {
     $j++;
  }
     ?>

 </td>
 </tr>
 <?php
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for %s</b></center></td></tr>',$myrow[25]);
         $grn_notes = $newgrn->getNotes($grnrecnum);
         printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes1" rows="6" cols="88"  readonly="readonly">');
         while ($mynotes = mysql_fetch_row($grn_notes))
         {
          print("\n");
          print("********Added by $mynotes[2] *********** on $mynotes[1] ");
          print("\n");
          print(" $mynotes[0]");
          print("   \n");
         }
      ?>
      </textarea></td>
      </tr>
     <?php printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
       <td colspan=4><textarea name="notes" id="notes" rows="3" cols="88%" value=""></textarea>
       </td> </tr>


<tr bgcolor="#FFFFFF"><td colspan=5></td></tr>
<input type="hidden" name="action" value="edit">
<input type="hidden" name="grnrecnum" id="grnrecnum" value="<?php echo $grnrecnum ?>">

<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Unit RM Size</b></center></td>
</tr>


<tr bgcolor="#FFFFFF">


<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Line</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Amend Line</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Layout Ref#</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Partnum</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Desc</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Batch</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>UOM</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Exp Date<br>(yyyy-mm-dd)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>No Of<br>Pieces</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim1(L)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim2(W/ID)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim3(T/OD)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty/Billet</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty Rej</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>QTM</center></b></td>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Amend</center></b></td>-->
</tr>
<tr>
<?php
   $i=1;
  $total=0;$total_prevqty=0;
  while ($mygrnli = mysql_fetch_row($grnli))
  {
      $prevlinenum = "prevlinenum" . $i;
      $lirecnum = "lirecnum" . $i;

      echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$mygrnli[0]\">";
      echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$mygrnli[7]\">";
?>
      <tr bgcolor="#FFFFFF">
      <td><center><input type="text" id="line_num<?php echo $i?>" name="line_num<?php echo $i?>" style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $mygrnli[0] ?>" size=2></center></td>
      <td><center><input type="text" id="amend_line_num<?php echo $i?>" name="amend_line_num<?php echo $i?>" style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $mygrnli[17] ?>" size=2 ></center></td>
      <td><center><input type="text" id="layout_ref<?php echo $i?>" name="layout_ref<?php echo $i?>" style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $mygrnli[18] ?>" size=8></center></td>
      <td><center><input type="text" id="partnum<?php echo $i?>" name="partnum<?php echo $i?>" style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $mygrnli[11] ?>" size=6></center></td>
      <td><center><input type="text" id="partdesc<?php echo $i?>" name="partdesc<?php echo $i?>" style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $mygrnli[12] ?>" size=25></center></td>
      <td><center><input type="text" id="batchnum<?php echo $i?>" name="batchnum<?php echo $i?>" style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $mygrnli[13] ?>" size=6></center></td>
      <td><center><input type="text" id="uom<?php echo $i?>" name="uom<?php echo $i?>" style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $mygrnli[14] ?>" size=5 onkeyup="javascript:getuom(this);"></center></td>
      <td><center><input type="text" id="expdate<?php echo $i?>" name="expdate<?php echo $i?>" style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $mygrnli[15] ?>" size=10></center></td>
      <td><center><input type="text" id="noofpieces<?php echo $i ?>" name="noofpieces<?php echo $i ?>" value="<?php echo $mygrnli[20] ?>" size=3 onkeyup="javascript:getQty(this);" style=";background-color:#DDDDDD;" readonly = 'readonly'></center></td>
      <td><center><input type="text" id="dim1<?php echo $i ?>" name="dim1<?php echo $i ?>" style=";background-color:#DDDDDD;" onkeyup="javascript:getQty(this);" 
		       readonly="readonly" value="<?php echo $mygrnli[2] ?>" size=5 ></center></td>
      <td><center><input type="text" id="dim2<?php echo $i ?>" name="dim2<?php echo $i ?>" style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $mygrnli[3] ?>" size=5></center></td>
      <td><center><input type="text" id="dim3<?php echo $i ?>" name="dim3<?php echo $i ?>" style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $mygrnli[4] ?>" size=5></center></td>
      <?	
	  if($mygrnli[20] == 0)
	  {?>
			   <td><center><input type="text" id="qty<?php echo $i ?>" name="qty<?php echo $i ?>"   value="<?php echo $mygrnli[1] ?>" onkeyup="javascript:getqtm_value(<?echo $i ?>)" size=3></center></td>
	  <?}
	  else
	  {?>      
      <td><center><input type="text" id="qty<?php echo $i ?>" name="qty<?php echo $i ?>" style=";background-color:#DDDDDD;"
		       readonly="readonly"  value="<?php echo $mygrnli[1] ?>" onkeyup="javascript:getqtm_value(<?echo $i ?>)" size=3></center></td>
	  <?}?>

     <td><center><input  type="text" id="qty4billet<?php echo $i?>" name="qty4billet<?php echo $i?>" style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $mygrnli[10] ?>" size=5></center></td>
      <td><center><input type="text" id="qty_rej<?php echo $i?>" name="qty_rej<?php echo $i?>" style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $mygrnli[8] ?>" size=5></center></td>
      <td><center><input type="text" id="qty_to_make<?php echo $i?>" name="qty_to_make<?php echo $i?>"  style=";background-color:#DDDDDD;"
		       readonly="readonly"value="<?php echo $mygrnli[9] ?>" size=5 </center></td>
     <!--<td align=center>
     <select id=amendstatus<?php echo $i?> name=amendstatus<?php echo $i?> onclick="javascript:get_total(this);">
     <option selected value="<?php echo $mygrnli[19]?>"><?php echo $mygrnli[19]?></option>
                   <option value=Active>Active</option>
                   <option value=Inactive>Inactive</option>
                </select>
                 </td> -->

      </tr>
<?php
   //onblur="javascript:setAmendstat(echo $i )
      $i++;
      //$total = $total + $mygrnli[9];
      if($mygrnli[17] == '')
      {
        $total = $total + $mygrnli[9];
        $total_prevqty = $total_prevqty + $mygrnli[1];
      }
  }
echo "<input type=\"hidden\" name=\"index\" id=\"index\" value=$i>";
echo "<input type=\"hidden\" name=\"qty_tot\" id=\"qty_tot\" value= $total_prevqty >";
?>
</tr>
</table>


	<?
	$row=mysql_fetch_object($cofc);
  $dimenssion=$row->dimensional;
  $ndt=$row->ndt;
 $visual=$row->visual;
 $grain=$row->grain;
 $mech=$row->mech;
 $conductivity=$row->conductivity;
  $chemical=$row->chemical;
 $hardness=$row->hardness;
 $quantity=$row->quantity;
 $temper=$row->temper;
 $cus=$row->cusserial;
 $from=$row->frmserial;
 $to=$row->toserial;
 $noncon=$row->noncon;
 $ncref=$row->ncref;
 $ncdate=$row->ncdate;
 $comm=$row->comm;
 $dcomm=$row->dcomm;
 $remarks=$row->remarks;
 $approval=$row->approval;

             if($ncdate != '' && $ncdate != '0000-00-00')
             {
              $d=substr($ncdate,8,2);
              $m=substr($ncdate,5,2);
              $y=substr($ncdate,0,4);
              $x=mktime(0,0,0,$m,$d,$y);
              $date1=date("M j, Y",$x);
             }
             else
             {
               $date1 = '';
             }

?>


	<tr bgcolor="#FFFFFF">


       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">

       	<tr bgcolor="#FFFFFF">
      <td colspan=6 align=right class=labeltext>Total Qty</td>
      <td align=center colspan=2><input type=text name=total_qty_make id=total_qty_make style=";background-color:#DDDDDD;"
		       readonly="readonly" value='<?php echo $total?>'size=8></td>
   </tr>

         <tr bgcolor="#DDDEDD">
<td align="center" colspan=8><span class="heading"><b>Validation of Certificate of Compliance by RM Supplier</b></span></td>

        </tr>
		 <tr bgcolor="#FFFFFF">
	<td  width=30%> <span class="heading"><b><left>Standard for Verification</left></b></td>
	<td width=70% colspan=7> <span class="heading"><b><left></left></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		<td width=35%><span class="labeltext"><p align="left">Description</p></td>

	<td width=5%> <span class="labeltext"><p align="left">Yes</p></td>
	<td width=5%> <span class="labeltext"><p align="left">No</p></td>
	<td width=5%> <span class="labeltext"><p align="left">N/A</p></td>
	<td width=35%> <span class="labeltext"><p align="left">Description</p></td>
	<td width=5%> <span class="labeltext"><p align="left">Yes</p></td>
	<td width=5%> <span class="labeltext"><p align="left">No</p></td>
	<td width=5%> <span class="labeltext"><p align="left">N/A</p></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=35%><span class="tabletext"><p align="left">Dimensional Inspection</p></td>
	<td width=5%> <b><input name="dimensional" type="radio" value="1" <?php if ($dimenssion=='1'){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="dimensional" type="radio" value="2" <?php if ($dimenssion==2){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="dimensional" type="radio" value="3" <?php if ($dimenssion==3){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>
	<td width=35%> <span class="tabletext"><p align="left">NDT Procedures correct,where applicable</p></td>
	<td width=5%> <b><input name="ndt" type="radio" value="1" <?php if ($ndt==1){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="ndt" type="radio" value="2" <?php if ($ndt==2){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="ndt" type="radio" value="3" <?php if ($ndt==3){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=35%><span class="tabletext"><p align="left">Visual Examination for Omission of Damages</p></td>
	<td width=5%> <b><input name="visual" type="radio" value="1" <?php if ($visual==1){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="visual" type="radio" value="2" <?php if ($visual==2){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="visual" type="radio" value="3" <?php if ($visual==3){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"> </b></td>
	<td width=35%> <span class="tabletext"><p align="left">Is Grain Flow Mentioned</p></td>
	<td width=5%> <b><input name="grain" type="radio" value="1" <?php if ($grain==1){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="grain" type="radio" value="2" <?php if ($grain==2){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="grain" type="radio" value="3" <?php if ($grain==3){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Mechanical Properties verified against Standered</p></td>
	<td width=5%> <b><input name="mechanical" type="radio" value="1" <?php if ($mech==1){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="mechanical" type="radio" value="2" <?php if ($mech==2){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="mechanical" type="radio" value="3" <?php if ($mech==3){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Conductivity</p></td>
	<td width=5%> <b><input name="conductivity" type="radio" value="1" <?php if ($conductivity==1){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="conductivity" type="radio" value="2" <?php if ($conductivity==2){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="conductivity" type="radio" value="3" <?php if ($conductivity==3){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Chemical Properties verified against Standered</p></td>
	<td width=5%> <b><input name="chemical" type="radio" value="1"  <?php if ($chemical==1){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="chemical" type="radio" value="2" <?php if ($chemical==2){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="chemical" type="radio" value="3" <?php if ($chemical==3){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Hardness</p></td>
	<td width=5%> <b><input name="hardness" type="radio" value="1" <?php if ($hardness==1){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="hardness" type="radio" value="2" <?php if ($hardness==2){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="hardness" type="radio" value="3" <?php if ($hardness==3){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Quantity received agrees with Certification</p></td>
	<td width=5%> <b><input name="quantity" type="radio" value="1"  <?php if ($quantity==1){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="quantity" type="radio" value="2"  <?php if ($quantity==2){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="quantity" type="radio" value="3"  <?php if ($quantity==3){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Temper</p></td>
	<td width=5%> <b><input name="temper" type="radio" value="1" <?php if ($temper==1){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="temper" type="radio" value="2"  <?php if ($temper==2){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
	<td width=5%> <b><input name="temper" type="radio" value="3"  <?php if ($temper==3){?>checked="checked" <?php }?>onClick="return readOnlyRadio()"></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Serialization Requirements?</p></td>
<td width=10% colspan="2"><span class="tabletext"><p align="left">Customer Serialization</p></td>

	 <td  width="%"><span class="tabletext">Yes<input name="cus" type="radio" value="1" <?php if ($cus==1){?>checked="checked" <?php }?> >
  <span class="tabletext">No &nbsp;<input name="cus" type="radio" value="2" <?php if ($cus==2){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></td>

	<td width=30%><span class="tabletext"><p align="left">CIM Serialization
	<span class="tabletext">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes<input name="cus" type="radio" value="3" <?php if ($cus==3){?>checked="checked" <?php }?>>
	<span class="tabletext">No<input name="cim" type="hidden" value="2" checked="checked">
	<input name="cus" type="radio" value="4" <?php if ($cus==4){?>checked="checked" <?php }?> ></p></td>
	<td width=8% colspan="2"> <span class="tabletext"><p align="left">Serialization not Required</p></td>
	<td width=3%> <b><input name="cus" type="radio" value="5" <?php if ($cus==5){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>
		</tr><input name="not" type="hidden" value="5" >
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">If yes Mention Serial No. </p></td>
	<td width=5% colspan=2> <span class="tabletext"><p align="left">From </p></td>
	<td width=5%> <input name="frmserial" type="text" style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $from?>"></td>
	<td width=5% colspan=4> <span class="tabletext"><p align="left">To     <input name="toserial" type="text" style="background-color:#DDDDDD;" readonly="readonly"
    value="<?php echo $to?>" > </b></td>

	</tr>
	<tr bgcolor="#DDDEDD">
     <td align="center" colspan=8><span class="heading"><b>Non-Conformance</b></span></td>
    </tr>
	<tr bgcolor="#FFFFFF">
	 <td width=30%><span class="labeltext"><p align="left">Are any Non Conformance Observed</p></td>
	<td width=6%> <span class="labeltext"><b>Yes</b></span>
	<input name="conformance" type="radio" value="1"  <?php if ($noncon==1){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></td>
	<td width=5% colspan=2> <b><span class="labeltext"><b>No</b></span>

	<input name="conformance" type="radio" value="2"  <?php if ($noncon==2){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>

	<td width=5% colspan=4 align=top><b><span class="labeltext">NCR Ref No.</b></span> <input name="ncref" id="ncref" type="text" value="<?php echo $ncref?>" style=";background-color:#DDDDDD;" readonly = 'readonly'><br>
	<span class="labeltext">NCR Date</b></span>
     &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="ncrdate" size=20 value="<?php echo $ncdate?>" style="background-color:#DDDDDD;" readonly="readonly">
                </td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30% colspan=4><span class="labeltext"><p align="left">Is the Observed Non-Conformance communicated to the respective authorities</p></td>
	<td colspan=6> <b><span class="labeltext">Yes<input name="comm" type="radio" value="1"<?php if ($comm==1){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b>
	<span class="labeltext">No <b><input name="comm" type="radio" value="2" <?php if ($comm==2){?>checked="checked" <?php }?> onClick="return readOnlyRadio()"></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Details of Communication</p></td>
	<td width=5% colspan=12><textarea name="dcomm" cols="70" rows="" style="background-color:#DDDDDD;" readonly="readonly"><?php echo $dcomm?></textarea></td>

		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Additional Notes/Remarks</p></td>
	<td width=5% colspan=7><textarea name="anotes" cols="70" rows="" style="background-color:#DDDDDD;" readonly="readonly"><?php echo $remarks?></textarea></td>

		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Authorised Signatory With Date<br>
     (Store Department)</p></td>
	<td width=5% colspan=7 class="tabletext">

    <?php

       if($approval != '')
       {
         //echo $approval . 'hiiiiii';
    ?>
         <input type="hidden" name="approval" value="<?php echo $approval?>">
    <?php
       }
       else
       {
    ?>
         Yes<input name="approval" type="radio" value="<?php echo $approved; ?>" onClick="return readOnlyRadio()">
         No<input name="approval" type="radio" onClick="return readOnlyRadio()" value=" " checked >
    <?php
       }
    ?>

    </td>

		</tr>

	</td>
    </tr>


    </td>
     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

         <tr bgcolor="#FFFFFF">


        </tr>


</table>

  <table>

     <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" id='grn_issue'>
      <tr bgcolor="#DDDEDD">
            <td height="34" colspan=8><span class="heading">
              <center><b>Material Issue</b></center></td>
     </tr>
   <!--  <tr bgcolor="#FFFFFF"><td colspan=8><a href="javascript:addRow4grn_issue('grn_issue',document.forms[0].grniss_index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr> -->
        <tr bgcolor="#FFFFFF">
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Line Num</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">WO Num</font></td>
             <td align=center><span class="labeltext">Wo Date</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">WO Qty</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Accepted</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Rework</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Rejected</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Returned</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Balance</font></td>
        </tr>
   <?php
     $i=1;
       while($myrow3 = mysql_fetch_row($result3))
       {

          $line_no = 'line_no' . $i;
          $iss_date = 'issdate' . $i;
          $iss_qty = 'issqty' . $i;
  
          $iss4wo = 'iss4wo' . $i;
          $accqty = 'accqty' . $i;
          $rework = 'rework' . $i;
          $rejqty = 'rejqty' . $i;
          $retqty = 'retqty' . $i;
          $balance = 'balance' . $i;

          $prevlinenum="prevlineno" . $i;
		  $lirecnum="lirecno" . $i;

          $fields = $iss4wo . '_' . $iss_date . '_' . $iss_qty;
   ?>
        <tr bgcolor="#FFFFFF">
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $line_no?>' value='<?php echo $i ?>' size=8 style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $iss4wo?>' value='<?php echo $myrow3[0] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly">
                                   <!--<img src="images/getwo.gif" onClick="javascript:GetWo('<?php echo $fields ?>')">--></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $iss_date?>' value='<?php echo $myrow3[1] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $iss_qty?>' value='<?php echo $myrow3[6] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $accqty?>' value='<?php echo $myrow3[2] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $rework?>' value='<?php echo $myrow3[3] ?>' size=8  style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $rejqty?>' value='<?php echo $myrow3[4] ?>' size=8  style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $retqty?>' value='<?php echo $myrow3[5] ?>' size=8  style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td align=center><input type=text name='<?php echo $balance?>' value='<?php echo ($total-$myrow3[6]+$myrow3[5]) ?>' size=8 style="background-color:#DDDDDD;" readonly='readonly'></td>

         </tr>

   <?php
	    $total = $total-$myrow3[6]+$myrow3[5];
        $i++;
       }
       echo "<input type=\"hidden\" name=\"balance\" value=$total>";
       echo "<input type=\"hidden\" name=\"grniss_index\" value=$i>";
   ?>


</table>
<?php
}
}
else if($dept == 'Stores')
{?>
		 <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>GRN Classification</p></font>
			<td width=25%><span class="tabletext"><input type="text" name="wotype" id="wotype"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[58] ?>">
	             <span class="tabletext"><select name="wotype1" id="wotype1" size="1" width="20" onchange="onSelectWOType('new_grn')">
 	             <option selected>Please Specify
	             <option value="Regular">Regular
	             <option value="Assy">Assy
				 </select>
				 </td>
				 <td width='25%'><span class="labeltext"><p align="left"> QTM Req.</p></font></td>           
			<td><input type="text" name="qtm_req" id="qtm_req" size=20 value="<?=$myrow[62]?>" style="background-color:#DDDDDD;" readonly="readonly" ></td>
			</tr>      
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
         <?php
         if($myrow[51] !='' )
         {
         ?>
            <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Parent GRN No.</p></font></td>
            <td width=25%><input type="text" name="parentgrnnum" id="parentgrnnum" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $myrow[51] ?>"></td>
            <td colspan=2></td>
            </tr>
         <?php
         }
        ?>
        <tr bgcolor="#FFFFFF">

            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>GRN No.</p></font></td>
            <td width=25%><input type="text" name="grnnum" id="grnnum" size=20 style=";background-color:#DDDDDD;" readonly = 'readonly' value="<?php echo $myrow[25] ?>">
            <input type="hidden" name="parentgrnnum" id="parentgrnnum" size=20 value="<?php echo $myrow[51] ?>"></td>
            <td  width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supplier</p></font></td>
            <td  colspan=1><span class="tabletext"><input type="text" name="vendor"
               style=";background-color:#DDDDDD;"
		       readonly="readonly" size=20 value="<?php echo "$myrow[23]";?>">
   		     </td>
                 <input type="hidden" name="vendrecnum" id="vendrecnum" value="<?php echo "$myrow[24]";?>">
             </td>

        </tr>


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Raw Material Type</p></font></td>
            <td><input type="text" name="raw_mat_type" id="raw_mat_type" size=20 value="<?php echo $myrow[4] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            </td>
            <td><span class="labeltext"><p align="left">Raw Material Spec</p></font></td>
            <td><input type="text" name="raw_mat_spec" id="raw_mat_spec" size=20 value="<?php echo $myrow[5] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
         </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Raw Material Code</p></font></td>
            <td><input type="text" name="raw_mat_code" size=19 value="<?php echo $myrow[12] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
            <td><span class="labeltext"><p align="left">MGP/DC No.</p></font></td>
            <td><input type="text" name="mgp_num" size=20 value="<?php echo $myrow[18] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Invoice No.</p></font></td>
            <td><input type="text" name="invoice_num" size=20 value="<?php echo $myrow[13] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Invoice Date</p></font></td>
            <td><input type="text" name="invoice_date" id="invoice_date" size=20 value="<?php echo $myrow[14] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Test Reports & COC</p></font></td>
            <td><input type="text" name="test_report" size=20 value="<?php echo $myrow[16] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Received Date</p></font></td>
            <td><input type="text" name="recieved_date" id="recieved_date" size=20 value="<?php echo $myrow[15] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Batch No.</p></font></td>
            <td><input type="text" name="batch_num" size=20 value="<?php echo $myrow[17] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
             <td><span class="labeltext"><p align="left">Remarks</p></font></td>
             <td colspan=1><textarea name="remarks" size=20 style=";background-color:#DDDDDD;" readonly = 'readonly'><?php echo $myrow[33] ?></textarea></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COC Ref#</p></font></td>
            <td><input type="text" name="coc_refnum" size=20 value="<?php echo $myrow[26] ?>" style="background-color:#DDDDDD;" readonly = 'readonly'></td>
            <td colspan="2"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM by Host</p></font></td>
             <td><input type="text" name="rmbycim" id="rmbycim" size=20 value="<?php echo $myrow[28] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM by Cust</p></font></td>
            <td><input type="text" name="rmbycust" id="rmbycust" size=20 value="<?php echo $myrow[29] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
        </tr>
        <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>CIM PO Num</p></font></td>
            <td><input type="text" name="cimponum" id="cimponum" size=20 value="<?php echo $myrow[30] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RMPO Line#</p></font></td>
            <td><input type="text" name="rmpoline_num" id="rmpoline_num" size=4 value="<?php echo $myrow[49] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">GRN Type</p></font>
			<td><span class="tabletext"><input type="text" name="grntype" id="grntype"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[35] ?>">	      
            </td>
			<input type="hidden" name="prevgrntype" id="prevgrntype" value="<?php echo $myrow[35] ?>">
            <td><span class="labeltext"><p align="left">QA NC Ref#</p></font></td>
            <td><input type="text" name="nc_refnum" id="nc_refnum" size=20 value="<?php echo $myrow[34] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
        </tr>
        <?php
        if($myrow[51] != '')
        {
        ?>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PRN</p></font></td>
            <td><input type="text" name="crn" id="crn" size=20 value="<?php echo $myrow[36] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            <img src='images/bu-get.gif' name='cim' onclick='GetCIM4altcrn("<?php echo 'crn' ?>")'></td>
           <td><span class="labeltext"><p align="left">To PRN (Alternate)</p></font></td>
			<td><input type="text" name="altcrn" id="altcrn" size=20 value="<?php echo $myrow[50] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            </td>
			</tr>
			<input type="hidden" name="pocrn" id="pocrn" size=20 value="<?php echo $myrow[52] ?>" >

         <?php
         }
         else
         {
         ?>
         <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">PO PRN</p></font></td>
            <td><input type="text" name="pocrn" id="pocrn" size=20 value="<?php echo $myrow[52] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            <input type="hidden" name="altcrn" id="altcrn" size=20 value="<?php echo $myrow[50] ?>"</td>
            <td><span class="labeltext"><p align="left">PRN</p></font></td>
            <td><input type="text" name="crn" id="crn" size=20 value="<?php echo $myrow[36] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'><input type="hidden" name="altcrn" id="altcrn" size=20 value="<?php echo $myrow[50] ?>"</td>
         </tr>
         <?php
         }

         ?>
         <tr bgcolor="#FFFFFF">
	     <td><span class="labeltext"><p align="left">RM Checked By</p></font></td>
             <td><input type="text" name="rmempcode" id ="rmempcode" size=20 value="<?php echo $myrow[42] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
			 <td><span class="labeltext"><p align="left">RM Checked Date</p></font></td>
	        <td><input type="text" name="rmcheckdate" id="rmcheckdate" size=20
			style=";background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow[43] ?>">
            </td>
         </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Unit RM Cost</p></td>
            <td><input type="text" id="rm_cost" name="rm_cost" size=20 value="<?php echo $myrow[46] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'> 
        </td>	 
     <!--<td><span class="labeltext"><p align="left">Approval Remarks</p></font></td>
             <td colspan=3><textarea name="approval_remarks" size=20 id="approval_remarks" style="background-color:#DDDDDD;" readonly="readonly" ><?php echo trim($myrow[53]) ?></textarea>
             </td>   -->  
			 <td colspan=2></td>
			</tr>
			 <tr bgcolor="#FFFFFF">
	     <td><span class="labeltext"><p align="left">GRN Entered By</p></font></td>
             <td><input type="text" name="grnempcode" id ="grnempcode" size=20 value="<?php echo $myrow[44] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
			 <td><span class="labeltext"><p align="left">GRN Entered Date</p></font></td>
	        <td><input type="text" name="grncheckdate" id="grncheckdate" size=20
			style=";background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow[45] ?>"></td>
         </tr>
         <tr bgcolor="#FFFFFF">
		     <td><span class="labeltext"><p align="left">Quarantine Remarks</p></font></td>
<?php
     if ($myrow[35] == 'Quarantined' && $myrow[40] != '')
	 {
?>
          <td><textarea style=";background-color:#DDDDDD;" readonly="readonly"
		     name="quarremarks" id ="quarremarks" size=20><?php echo $myrow[40] ?></textarea></td>
	       <td><span class="labeltext"><p align="left">Conversion(to Regular) Date</p></font></td>
	        <td><input type="text" name="conversion_date" id="conversion_date" size=20 value="<?php echo $myrow[39]  ?>" 
			style=";background-color:#DDDDDD;" readonly="readonly"> </td>
<?php
	 }
	 else 
	 {
?>
          <td><textarea name="quarremarks" id ="quarremarks" size=20 style=";background-color:#DDDDDD;" readonly="readonly"><?php echo $myrow[40] ?></textarea></td>
	       <td><span class="labeltext"><p align="left">Conversion(to Regular) Date</p></font></td>
	        <td><input type="text" name="conversion_date" id="conversion_date" size=20 value="<?php echo ($myrow[39] == '0000-00-00')?'':$myrow[39] ?>" 
			style=";background-color:#DDDDDD;" readonly="readonly">

</td>
<?php
	 }
?>
         </tr>

         <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">Quarantined Date</p></font></td>
            <td><input type="text" name="Quarantined_date" id="Quarantined_date" size=20 value="<?php echo ($myrow[41] == '0000-00-00')?'':$myrow[41] ?>" style="background-color:#DDDDDD;" readonly="readonly">
            <?php if($myrow[35] != "Quarantined") 
			{
				//echo "<img src=\"images/bu-getdateicon.gif\" id='image' alt=\"Get BookDate\"          onClick=\"GetDate('Quarantined_date')\">";
			}
			?> 
			</td>
    <td width=20%><span class="labeltext"><p align="left">Status</p></font></td>
    <td ><span class="tabletext"><input type="text" name="status" id="status"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[37] ?>">	<input type="hidden" name="validate_flag" id="validate_flag" value=""></td></tr>
	<?php
  //echo $myrow[48]."in ed";
   if($myrow[37] != 'Pending')
	{
     ?>
        <input type="hidden" name="approved_grn" value="<?php echo $myrow[48]?>" id="approved_grn">
        <input type="hidden" name="prev_approved_grn" value="<?php echo $myrow[48]?>" id="prev_approved_grn">
        <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
        <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
        <input type="hidden" name="userid_app" id="userid_app" value="<?php echo $myrow[55]?>">
        <input type="hidden" name="approval_date" id="approval_date" value="<?php echo $myrow[54] ?>">
     
     <?php
     }
	 ?>
	 <tr bgcolor="#FFFFFF">
<td><span class="labeltext">Purchasing Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow[48] == 'yes'?$checked:"" ?>  id="approved_grn_1" name="approved_grn_1" onclick="JavaScript:toggleValue('approved_grn',this);" disabled>
                         <input type="hidden" name="approved_grn" value="<?php echo $myrow[48]?>" id="approved_grn">
                         <input type="hidden" name="prev_approved_grn" value="<?php echo $myrow[48]?>" id="prev_approved_grn">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
                         <input type="text" name="userid_app" id="userid_app" value="<?php echo $myrow[55]?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
           <td><span class="labeltext">Approved Date</td>
          <td ><span class="tabletext"><input type="text" name="approval_date" id="approval_date"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo ($myrow[54] == '0000-00-00')?'':$myrow[54] ?>"></td>
          </tr>
		  <tr bgcolor="#FFFFFF">
          <td><span class="labeltext">CAD Approved</td>
          <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow[59] == 'yes'?$checked:"" ?>  id="cad_approved_grn_1" name="cad_approved_grn_1" onclick="JavaScript:toggleValue_cad('cad_approved_grn',this);" disabled>
                         <input type="hidden" name="cad_approved_grn" value="<?php echo $myrow[59]?>" id="cad_approved_grn">
                         <input type="hidden" name="prev_cad_approved_grn" value="<?php echo $myrow[59]?>" id="prev_cad_approved_grn">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
                         <input type="text" name="userid_app_cad" id="userid_app_cad" value="<?php echo $myrow[60]?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
          <td><span class="labeltext">Approved Date</td>
          <td ><span class="tabletext"><input type="text" name="cad_approval_date" id="cad_approval_date"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo ($myrow[61] == '0000-00-00')?'':$myrow[61] ?>" ></td>
          </tr>
		         <tr bgcolor="#FFFFFF">
     <td><span class="labeltext"><p align="left">Approval Remarks</p></font></td>
             <td colspan=3><textarea name="approval_remarks" id="approval_remarks" rows=3 cols=40 style=";background-color:#DDDDDD;" readonly = 'readonly'><?php echo trim($myrow[53]) ?></textarea>
             </td>
			 </tr>  



	 <tr bgcolor="#FFFFFF">
  	<td><span class="labeltext"><p align="left">Wo Ref</p></font></td>
            <td><input type="text" name="wo_ref" id="wo_ref" size=20 value="<?php echo $myrow[57] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
				<td colspan=2></td>
			<?
		
     $j=1;
     while ($mygrnli4am = mysql_fetch_row($grnli4am))
  {
     $j++;
  }
     ?>

 </td>
 </tr>
<?php
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for %s</b></center></td></tr>',$myrow[25]);
         $grn_notes = $newgrn->getNotes($grnrecnum);
         printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes1" rows="6" cols="88"  readonly="readonly" style="background-color:#DDDDDD;" >');
         while ($mynotes = mysql_fetch_row($grn_notes))
         {
          print("\n");
          print("********Added by $mynotes[2] *********** on $mynotes[1] ");
          print("\n");
          print(" $mynotes[0]");
          print("   \n");
         }
      ?>
      </textarea></td>
      </tr>

	   <?php printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
       <td colspan=4><textarea name="notes" id="notes" rows="3" cols="88%" value=""></textarea>
       </td> </tr>

  

<!--<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value,<?php echo $j ?>)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr> -->
<input type="hidden" name="action" value="edit">
<input type="hidden" name="grnrecnum" id="grnrecnum" value="<?php echo $grnrecnum ?>">

<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Unit RM Size</b></center></td>
</tr>


<tr bgcolor="#FFFFFF">


<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Line</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Amend Line</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Layout Ref#</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Partnum</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Desc</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Batch</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>UOM</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Exp Date<br>(yyyy-mm-dd)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>No Of<br>Pieces</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim1(L)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim2(W/ID)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim3(T/OD)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty/Billet</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty Rej</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>QTM</center></b></td>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Amend</center></b></td>-->
</tr>
<tr>
<?php
   $i=1;   $flag=0;
  $total=0;$total_prevqty=0;
  while($i<=10)
{
 if($flag==0)
 {
  while ($mygrnli = mysql_fetch_row($grnli))
  {
      $prevlinenum = "prevlinenum" . $i;
      $lirecnum = "lirecnum" . $i;
      
      echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$mygrnli[0]\">";
      echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$mygrnli[7]\">";
?>
      <tr bgcolor="#FFFFFF">
      <td><center><input type="text" id="line_num<?php echo $i?>" name="line_num<?php echo $i?>" value="<?php echo $mygrnli[0] ?>"   style="background-color:#DDDDDD;" readonly="readonly"  size=2></center></td>
      <td><center><input type="text" id="amend_line_num<?php echo $i?>" name="amend_line_num<?php echo $i?>" value="<?php echo $mygrnli[17] ?>" size=2 style="background-color:#DDDDDD;" readonly="readonly"  onblur="javascript:getstat(this,'<?php echo $i ?>');"></center></td>
      <td><center><input type="text" id="layout_ref<?php echo $i?>" name="layout_ref<?php echo $i?>" value="<?php echo $mygrnli[18] ?>" style="background-color:#DDDDDD;" readonly="readonly"  size=8></center></td>
      <td><center><input type="text" id="partnum<?php echo $i?>" name="partnum<?php echo $i?>" value="<?php echo $mygrnli[11] ?>" style="background-color:#DDDDDD;" readonly="readonly"  size=6></center></td>
      <td><center><input type="text" id="partdesc<?php echo $i?>" name="partdesc<?php echo $i?>" value="<?php echo $mygrnli[12] ?>" style="background-color:#DDDDDD;" readonly="readonly"  size=25></center></td>
      <td><center><input type="text" id="batchnum<?php echo $i?>" name="batchnum<?php echo $i?>" value="<?php echo $mygrnli[13] ?>" style="background-color:#DDDDDD;" readonly="readonly"  size=6></center></td>
      <td><center><input type="text" id="uom<?php echo $i?>" name="uom<?php echo $i?>" value="<?php echo $mygrnli[14] ?>" size=5 style="background-color:#DDDDDD;" readonly="readonly"	onkeyup="javascript:getuom(this);"></center></td>
      <td><center><input type="text" id="expdate<?php echo $i?>" name="expdate<?php echo $i?>" value="<?php echo $mygrnli[15] ?>" style="background-color:#DDDDDD;" readonly="readonly"  size=10></center></td>
      <td><center><input type="text" id="noofpieces<?php echo $i ?>" name="noofpieces<?php echo $i ?>" value="<?php echo $mygrnli[20] ?>" size=3 style="background-color:#DDDDDD;" readonly="readonly"  onkeyup="javascript:getQty(this);"></center></td>
      <td><center><input type="text" id="dim1<?php echo $i ?>" name="dim1<?php echo $i ?>" value="<?php echo $mygrnli[2] ?>" size=5 style="background-color:#DDDDDD;"  onkeyup="javascript:getQty(this);" readonly="readonly"  onkeyup="javascript:getQty(this);"></center></td>
      <td><center><input type="text" id="dim2<?php echo $i ?>" name="dim2<?php echo $i ?>" value="<?php echo $mygrnli[3] ?>" size=5 style="background-color:#DDDDDD;" readonly="readonly" ></center></td>
      <td><center><input type="text" id="dim3<?php echo $i ?>" name="dim3<?php echo $i ?>" value="<?php echo $mygrnli[4] ?>" size=5 style="background-color:#DDDDDD;" readonly="readonly" ></center></td>

     <?	
	  if($mygrnli[20] == 0)
	  {?>
			   <td><center><input type="text" id="qty<?php echo $i ?>" name="qty<?php echo $i ?>"   value="<?php echo $mygrnli[1] ?>" onkeyup="javascript:getqtm_value(<?echo $i ?>)" size=3></center></td>
	  <?}
	  else
	  {?>      
      <td><center><input type="text" id="qty<?php echo $i ?>" name="qty<?php echo $i ?>" style=";background-color:#DDDDDD;"
		       readonly="readonly"  value="<?php echo $mygrnli[1] ?>" onkeyup="javascript:getqtm_value(<?echo $i ?>)" size=3></center></td>
	  <?}?>

     <td><center><input  type="text" id="qty4billet<?php echo $i?>" name="qty4billet<?php echo $i?>" value="<?php echo $mygrnli[10] ?>" style="background-color:#DDDDDD;"   size=5></center></td>
      <td><center><input type="text" id="qty_rej<?php echo $i?>" name="qty_rej<?php echo $i?>" value="<?php echo $mygrnli[8] ?>" size=5 style="background-color:#DDDDDD;" readonly="readonly"  ></center></td>
      <td><center><input type="text" id="qty_to_make<?php echo $i?>" name="qty_to_make<?php echo $i?>" value="<?php echo $mygrnli[9] ?>" size=5 onblur="javascript:get_total(this);"  ></center></td>
     <!--<td align=center>
     <select id=amendstatus<?php echo $i?> name=amendstatus<?php echo $i?> onclick="javascript:get_total(this);">
     <option selected value="<?php echo $mygrnli[19]?>"><?php echo $mygrnli[19]?></option>
                   <option value=Active>Active</option>
                   <option value=Inactive>Inactive</option>
                </select>
                 </td> -->

      </tr>
<?php
   //onblur="javascript:setAmendstat(echo $i )
      $i++;
      //$total = $total + $mygrnli[9];
      if($mygrnli[17] == '')
      {
        $total = $total + $mygrnli[9];
        $total_prevqty = $total_prevqty + $mygrnli[1];
      }
  }
  $flag=1;
  }
     $prevlinenum = "prevlinenum" . $i;
      $lirecnum = "lirecnum" . $i;

      echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
      echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"\">";
?>
      <tr bgcolor="#FFFFFF">
      <td><center><input type="text" id="line_num<?php echo $i?>" name="line_num<?php echo $i?>" value="" size=2></center></td>
      <td><center><input type="text" id="amend_line_num<?php echo $i?>" name="amend_line_num<?php echo $i?>" value="" size=2 onblur="javascript:getstat(this,'<?php echo $i ?>');"></center></td>
      <td><center><input type="text" id="layout_ref<?php echo $i?>" name="layout_ref<?php echo $i?>" value="" size=8></center></td>
      <td><center><input type="text" id="partnum<?php echo $i?>" name="partnum<?php echo $i?>" value="" size=6></center></td>
      <td><center><input type="text" id="partdesc<?php echo $i?>" name="partdesc<?php echo $i?>" value="" size=25></center></td>
      <td><center><input type="text" id="batchnum<?php echo $i?>" name="batchnum<?php echo $i?>" value="" size=6></center></td>
      <td><center><input type="text" id="uom<?php echo $i?>" name="uom<?php echo $i?>" value="" size=5 onkeyup="javascript:getuom(this);"></center></td>
      <td><center><input type="text" id="expdate<?php echo $i?>" name="expdate<?php echo $i?>" value="" size=10></center></td>
      <td><center><input type="text" id="noofpieces<?php echo $i ?>" name="noofpieces<?php echo $i ?>" value="" size=3 onblur="javascript:getQty(this);"></center></td>
      <td><center><input type="text" id="dim1<?php echo $i ?>" name="dim1<?php echo $i ?>" value="" size=5 onblur="javascript:getQty(this);"></center></td>
      <td><center><input type="text" id="dim2<?php echo $i ?>" name="dim2<?php echo $i ?>" value="" size=5></center></td>
      <td><center><input type="text" id="dim3<?php echo $i ?>" name="dim3<?php echo $i ?>" value="" size=5></center></td>
      <td><center><input type="text" id="qty<?php echo $i ?>" name="qty<?php echo $i ?>" value="" onkeyup="javascript:getqtm_value(<?echo $i ?>)" size=3></center></td>
     <td><center><input  type="text" id="qty4billet<?php echo $i?>" name="qty4billet<?php echo $i?>" value="" size=5></center></td>
      <td><center><input type="text" id="qty_rej<?php echo $i?>" name="qty_rej<?php echo $i?>" value="" size=5></center></td>
      <td><center><input type="text" id="qty_to_make<?php echo $i?>" name="qty_to_make<?php echo $i?>" value="" size=5 onblur="javascript:get_total(this);"></center></td>
     <!--<td align=center>
     <select id=amendstatus<?php //echo $i?> name=amendstatus<?php //echo $i?> onclick="javascript:get_total(this);">
     <option selected value="<?php //echo $mygrnli[19]?>"><?php //echo $mygrnli[19]?></option>
                   <option value=Active>Active</option>
                   <option value=Inactive>Inactive</option>
                </select>
                 </td> -->

      </tr>
<?php
   //onblur="javascript:setAmendstat(echo $i )
      $i++;
}
echo "<input type=\"hidden\" name=\"index\" id=\"index\" value=$i>";
echo "<input type=\"hidden\" name=\"qty_tot\" id=\"qty_tot\" value= $total_prevqty >";
?>
</tr>
</table>


	<?
	$row=mysql_fetch_object($cofc);
  $dimenssion=$row->dimensional;
  $ndt=$row->ndt;
 $visual=$row->visual;
 $grain=$row->grain;
 $mech=$row->mech;
 $conductivity=$row->conductivity;
  $chemical=$row->chemical;
 $hardness=$row->hardness;
 $quantity=$row->quantity;
 $temper=$row->temper;
 $cus=$row->cusserial;
 $from=$row->frmserial;
 $to=$row->toserial;
 $noncon=$row->noncon;
 $ncref=$row->ncref;
 $ncdate=$row->ncdate;
 $comm=$row->comm;
 $dcomm=$row->dcomm;
 $remarks=$row->remarks;
 $approval=$row->approval;

             if($ncdate != '' && $ncdate != '0000-00-00')
             {
              $d=substr($ncdate,8,2);
              $m=substr($ncdate,5,2);
              $y=substr($ncdate,0,4);
              $x=mktime(0,0,0,$m,$d,$y);
              $date1=date("M j, Y",$x);
             }
             else
             {
               $date1 = '';
             }
        
?>
	
	
	<tr bgcolor="#FFFFFF">
	

       <table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

     <tr bgcolor="#FFFFFF">
      <td colspan=7 align='right' class=labeltext>Total Qty</td>
      <td align=center ><input type=text name='total_qty_make' id='total_qty_make' value='<?php echo $total?>'size=5    style="background-color:#DDDDDD;" readonly="readonly" ></td>
      </tr>

         <tr bgcolor="#DDDEDD">
<td align="center" colspan=8><span class="heading"><b>Validation of Certificate of Compliance by RM Supplier</b></span></td>

        </tr>
		 <tr bgcolor="#FFFFFF">
	<td  width=30%> <span class="heading"><b><left>Standard for Verification</left></b></td>
	<td width=70% colspan=7> <span class="heading"><b><left></left></b></td>	
		</tr>
		<tr bgcolor="#FFFFFF">
		<td width=35%><span class="labeltext"><p align="left">Description</p></td>

	<td width=5%> <span class="labeltext"><p align="left">Yes</p></td>
	<td width=5%> <span class="labeltext"><p align="left">No</p></td>
	<td width=5%> <span class="labeltext"><p align="left">N/A</p></td>
	<td width=35%> <span class="labeltext"><p align="left">Description</p></td>
	<td width=5%> <span class="labeltext"><p align="left">Yes</p></td>
	<td width=5%> <span class="labeltext"><p align="left">No</p></td>
	<td width=5%> <span class="labeltext"><p align="left">N/A</p></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=35%><span class="tabletext"><p align="left">Dimensional Inspection</p></td>
	<td width=5%> <b><input name="dimensional" type="radio" value="1" <?php if ($dimenssion=='1'){?>checked="checked" <?php }?> disabled ></b></td>
	<td width=5%> <b><input name="dimensional" type="radio" value="2" <?php if ($dimenssion==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="dimensional" type="radio" value="3" <?php if ($dimenssion==3){?>checked="checked" <?php }?> disabled></b></td>
	<td width=35%> <span class="tabletext"><p align="left">NDT Procedures correct,where applicable</p></td>
	<td width=5%> <b><input name="ndt" type="radio" value="1" <?php if ($ndt==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="ndt" type="radio" value="2" <?php if ($ndt==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="ndt" type="radio" value="3" <?php if ($ndt==3){?>checked="checked" <?php }?> disabled></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=35%><span class="tabletext"><p align="left">Visual Examination for Omission of Damages</p></td>
	<td width=5%> <b><input name="visual" type="radio" value="1" <?php if ($visual==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="visual" type="radio" value="2" <?php if ($visual==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="visual" type="radio" value="3" <?php if ($visual==3){?>checked="checked" <?php }?> disabled></b></td>
	<td width=35%> <span class="tabletext"><p align="left">Is Grain Flow Mentioned</p></td>
	<td width=5%> <b><input name="grain" type="radio" value="1" <?php if ($grain==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="grain" type="radio" value="2" <?php if ($grain==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="grain" type="radio" value="3" <?php if ($grain==3){?>checked="checked" <?php }?> disabled></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Mechanical Properties verified against Standered</p></td>
	<td width=5%> <b><input name="mechanical" type="radio" value="1" <?php if ($mech==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="mechanical" type="radio" value="2" <?php if ($mech==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="mechanical" type="radio" value="3" <?php if ($mech==3){?>checked="checked" <?php }?> disabled></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Conductivity</p></td>
	<td width=5%> <b><input name="conductivity" type="radio" value="1" <?php if ($conductivity==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="conductivity" type="radio" value="2" <?php if ($conductivity==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="conductivity" type="radio" value="3" <?php if ($conductivity==3){?>checked="checked" <?php }?> disabled></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Chemical Properties verified against Standered</p></td>
	<td width=5%> <b><input name="chemical" type="radio" value="1"  <?php if ($chemical==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="chemical" type="radio" value="2" <?php if ($chemical==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="chemical" type="radio" value="3" <?php if ($chemical==3){?>checked="checked" <?php }?> disabled></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Hardness</p></td>
	<td width=5%> <b><input name="hardness" type="radio" value="1" <?php if ($hardness==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="hardness" type="radio" value="2" <?php if ($hardness==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="hardness" type="radio" value="3" <?php if ($hardness==3){?>checked="checked" <?php }?> disabled></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Quantity received agrees with Certification</p></td>
	<td width=5%> <b><input name="quantity" type="radio" value="1"  <?php if ($quantity==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="quantity" type="radio" value="2"  <?php if ($quantity==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="quantity" type="radio" value="3"  <?php if ($quantity==3){?>checked="checked" <?php }?> disabled></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Temper</p></td>
	<td width=5%> <b><input name="temper" type="radio" value="1" <?php if ($temper==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="temper" type="radio" value="2"  <?php if ($temper==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="temper" type="radio" value="3"  <?php if ($temper==3){?>checked="checked" <?php }?> disabled></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Serialization Requirements?</p></td>
<td width=10% colspan="2"><span class="tabletext"><p align="left">Customer Serialization</p></td>
	
	 <td  width="%"><span class="tabletext">Yes<input name="cus" type="radio" value="1" <?php if ($cus==1){?>checked="checked" <?php }?> disabled>
  <span class="tabletext">No &nbsp;<input name="cus" type="radio" value="2" <?php if ($cus==2){?>checked="checked" <?php }?> disabled></td>

	<td width=30%><span class="tabletext"><p align="left">CIM Serialization
	<span class="tabletext">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes<input name="cus" type="radio" value="3" <?php if ($cus==3){?>checked="checked" <?php }?> disabled>
	<span class="tabletext">No<input name="cim" type="hidden" value="2" checked="checked">
	<input name="cus" type="radio" value="4" <?php if ($cus==4){?>checked="checked" <?php }?> disabled></p></td>
	<td width=8% colspan="2"> <span class="tabletext"><p align="left">Serialization not Required</p></td>
	<td width=3%> <b><input name="cus" disabled  type="radio" value="5" <?php if ($cus==5){?>checked="checked" <?php }?>></b></td>
		</tr><input name="not" type="hidden" value="5" >
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">If yes Mention Serial No. </p></td>
	<td width=5% colspan=2> <span class="tabletext"><p align="left">From </p></td>
	<td width=5%><input name="frmserial" type="text" value="<?php echo $from?>" disabled></td>
	<td width=5% colspan=4><span class="tabletext"><p align="left">To     <input name="toserial" type="text" value="<?php echo $to?>" disabled> </b></td>

	</tr>
	<tr bgcolor="#DDDEDD">
     <td align="center" colspan=8><span class="heading"><b>Non-Conformance</b></span></td>
    </tr>
	<tr bgcolor="#FFFFFF">
	 <td width=30%><span class="labeltext"><p align="left">Are any Non Conformance Observed</p></td>
	<td width=6%> <span class="labeltext"><b>Yes</b></span>
	<input name="conformance" type="radio" value="1"  <?php if ($noncon==1){?>checked="checked" <?php }?> disabled></td>
	<td width=5% colspan=2> <b><span class="labeltext"><b>No</b></span>
	
	<input name="conformance" type="radio" value="2"  <?php if ($noncon==2){?>checked="checked" <?php }?> disabled></b></td>
	
	<td width=5% colspan=4 align=top><b><span class="labeltext">NCR Ref No.</b></span> <input name="ncref" id="ncref" type="text" value="<?php echo $ncref?>" disabled><br>
	<span class="labeltext">NCR Date</b></span>
     &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="ncrdate" size=20 value="<?php echo $ncdate?>" style="background-color:#DDDDDD;" readonly="readonly" disabled>
                </td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30% colspan=4><span class="labeltext"><p align="left">Is the Observed Non-Conformance communicated to the respective authorities</p></td>
	<td colspan=6> <b><span class="labeltext">Yes<input name="comm" type="radio" value="1"<?php if ($comm==1){?>checked="checked" <?php }?>disabled ></b>
	<span class="labeltext">No <b><input name="comm" type="radio" value="2" <?php if ($comm==2){?>checked="checked" <?php }?> disabled></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Details of Communication</p></td>
	<td width=5% colspan=12><textarea name="dcomm" cols="70" rows="" readonly="readonly" style="background-color:#DDDDDD;" ><?php echo $dcomm?></textarea></td>
	
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Additional Notes/Remarks</p></td>
	<td width=5% colspan=7><textarea name="anotes" cols="70" rows="" readonly="readonly" style="background-color:#DDDDDD;"><?php echo $remarks?></textarea></td>
	
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Authorised Signatory With Date<br>
     (Store Department)</p></td>
	<td width=5% colspan=7 class="tabletext">

    <?php

       if($approval != '')
       {
         //echo $approval . 'hiiiiii';
    ?>
         <input type="hidden" name="approval" value="<?php echo $approval?>">
    <?php
       }
       else
       {
    ?>
         Yes<input name="approval" type="radio" value="<?php echo $approved; ?>" disabled>
         No<input name="approval" type="radio" value=" " checked disabled>
    <?php
       }
    ?>

    </td>
	
		</tr>
	
	</td>
    </tr>


    </td>
     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

         <tr bgcolor="#FFFFFF">


        </tr>


</table>

  <table>

     <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" id='grn_issue'>
      <tr bgcolor="#DDDEDD">
            <td height="34" colspan=8><span class="heading">
              <center><b>Material Issue</b></center></td>
     </tr>
   <!--  <tr bgcolor="#FFFFFF"><td colspan=8><a href="javascript:addRow4grn_issue('grn_issue',document.forms[0].grniss_index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr> -->
        <tr bgcolor="#FFFFFF">
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Line Num</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">WO Num</font></td>
             <td align=center><span class="labeltext">Wo Date</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">WO Qty</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Accepted</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Rework</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Rejected</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Returned</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Balance</font></td>
        </tr>
   <?php
     $i=1;
       while($myrow3 = mysql_fetch_row($result3))
       {
       
          $line_no = 'line_no' . $i;
          $iss_date = 'issdate' . $i;
          $iss_qty = 'issqty' . $i;
          $iss4wo = 'iss4wo' . $i;
          $accqty = 'accqty' . $i;
          $rework = 'rework' . $i;
          $rejqty = 'rejqty' . $i;
          $retqty = 'retqty' . $i;
          $balance = 'balance' . $i;
          
          $prevlinenum="prevlineno" . $i;
		  $lirecnum="lirecno" . $i;
          
          $fields = $iss4wo . '_' . $iss_date . '_' . $iss_qty;
   ?>
        <tr bgcolor="#FFFFFF">
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $line_no?>' value='<?php echo $i ?>' size=8 style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $iss4wo?>' value='<?php echo $myrow3[0] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly">
                                   <!--<img src="images/getwo.gif" onClick="javascript:GetWo('<?php echo $fields ?>')">--></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $iss_date?>' value='<?php echo $myrow3[1] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $iss_qty?>' value='<?php echo $myrow3[6] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $accqty?>' value='<?php echo $myrow3[2] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $rework?>' value='<?php echo $myrow3[3] ?>' size=8  style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $rejqty?>' value='<?php echo $myrow3[4] ?>' size=8  style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $retqty?>' value='<?php echo $myrow3[5] ?>' size=8  style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td align=center><input type=text name='<?php echo $balance?>' value='<?php echo ($total-$myrow3[6]+$myrow3[5]) ?>' size=8 style="background-color:#DDDDDD;" readonly='readonly'></td>

         </tr>

   <?php
	    $total = $total-$myrow3[6]+$myrow3[5];
        $i++;
       }
       echo "<input type=\"hidden\" name=\"balance\" value=$total>";
       echo "<input type=\"hidden\" name=\"grniss_index\" value=$i>";
   ?>
    </table>

 <?
}
 else if($dept == 'CAD' && $status == 'Pending')
{?>
<tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>GRN Classification</p></font>
			<td width=25%><span class="tabletext"><input type="text" name="wotype" id="wotype"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[58] ?>">	             
				 </td>
				  <td width='25%'><span class="labeltext"><p align="left"> QTM Req.</p></font></td>          
			<td><input type="text" name="qtm_req" id="qtm_req" size=20 value="<?=$myrow[62]?>" style="background-color:#DDDDDD;" readonly="readonly" ></td>
			</tr>

	     
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
         <?php
         if($myrow[51] !='' )
         {
         ?>
            <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Parent GRN No.</p></font></td>
            <td width=25%><input type="text" name="parentgrnnum" id="parentgrnnum" size=20 style=";background-color:#DDDDDD;"
		       readonly="readonly" value="<?php echo $myrow[51] ?>"></td>
            <td colspan=2></td>
            </tr>
         <?php
         }
        ?>
        <tr bgcolor="#FFFFFF">

            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>GRN No.</p></font></td>
            <td width=25%><input type="text" name="grnnum" id="grnnum" size=20 style=";background-color:#DDDDDD;" readonly = 'readonly' value="<?php echo $myrow[25] ?>">
            <input type="hidden" name="parentgrnnum" id="parentgrnnum" size=20 value="<?php echo $myrow[51] ?>"></td>
            <td  width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supplier</p></font></td>
            <td  colspan=1><span class="tabletext"><input type="text" name="vendor"
               style=";background-color:#DDDDDD;"
		       readonly="readonly" size=20 value="<?php echo "$myrow[23]";?>">
   		     </td>
                 <input type="hidden" name="vendrecnum" id="vendrecnum" value="<?php echo "$myrow[24]";?>">
             </td>

        </tr>


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Raw Material Type</p></font></td>
            <td><input type="text" name="raw_mat_type" id="raw_mat_type" size=20 value="<?php echo $myrow[4] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            </td>
            <td><span class="labeltext"><p align="left">Raw Material Spec</p></font></td>
            <td><input type="text" name="raw_mat_spec" id="raw_mat_spec" size=20 value="<?php echo $myrow[5] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
         </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Raw Material Code</p></font></td>
            <td><input type="text" name="raw_mat_code" size=19 value="<?php echo $myrow[12] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
            <td><span class="labeltext"><p align="left">MGP/DC No.</p></font></td>
            <td><input type="text" name="mgp_num" size=20 value="<?php echo $myrow[18] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Invoice No.</p></font></td>
            <td><input type="text" name="invoice_num" size=20 value="<?php echo $myrow[13] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Invoice Date</p></font></td>
            <td><input type="text" name="invoice_date" id="invoice_date" size=20 value="<?php echo $myrow[14] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Test Reports & COC</p></font></td>
            <td><input type="text" name="test_report" size=20 value="<?php echo $myrow[16] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Received Date</p></font></td>
            <td><input type="text" name="recieved_date" id="recieved_date" size=20 value="<?php echo $myrow[15] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Batch No.</p></font></td>
            <td><input type="text" name="batch_num" size=20 value="<?php echo $myrow[17] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
             <td><span class="labeltext"><p align="left">Remarks</p></font></td>
             <td colspan=1><textarea name="remarks" size=20 style=";background-color:#DDDDDD;" readonly = 'readonly'><?php echo $myrow[33] ?></textarea></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COC Ref#</p></font></td>
            <td><input type="text" name="coc_refnum" size=20 value="<?php echo $myrow[26] ?>" style="background-color:#DDDDDD;" readonly = 'readonly'></td>
            <td colspan=2>&nbsp;</td>
        </tr>
        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM by Host</p></font></td>
             <td><input type="text" name="rmbycim" id="rmbycim" size=20 value="<?php echo $myrow[28] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM by Cust</p></font></td>
            <td><input type="text" name="rmbycust" id="rmbycust" size=20 value="<?php echo $myrow[29] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
        </tr>
        <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>CIM PO Num</p></font></td>
            <td><input type="text" name="cimponum" id="cimponum" size=20 value="<?php echo $myrow[30] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RMPO Line#</p></font></td>
            <td><input type="text" name="rmpoline_num" id="rmpoline_num" size=4 value="<?php echo $myrow[49] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">GRN Type</p></font>
			<td><span class="tabletext"><input type="text" name="grntype" id="grntype"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[35] ?>">	      
            </td>
			<input type="hidden" name="prevgrntype" id="prevgrntype" value="<?php echo $myrow[35] ?>">
            <td><span class="labeltext"><p align="left">QA NC Ref#</p></font></td>
            <td><input type="text" name="nc_refnum" id="nc_refnum" size=20 value="<?php echo $myrow[34] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
        </tr>
        <?php
        if($myrow[51] != '')
        {
        ?>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PRN</p></font></td>
            <td><input type="text" name="crn" id="crn" size=20 value="<?php echo $myrow[36] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            <img src='images/bu-get.gif' name='cim' onclick='GetCIM4altcrn("<?php echo 'crn' ?>")'></td>
           <td><span class="labeltext"><p align="left">To PRN (Alternate)</p></font></td>
			<td><input type="text" name="altcrn" id="altcrn" size=20 value="<?php echo $myrow[50] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            </td>
			</tr>
         <input type="hidden" name="pocrn" id="pocrn" size=20 value="<?php echo $myrow[52] ?>" >
         <?php
         }
         else
         {
         ?>
         <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">PO PRN</p></font></td>
            <td><input type="text" name="pocrn" id="pocrn" size=20 value="<?php echo $myrow[52] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
            <input type="hidden" name="altcrn" id="altcrn" size=20 value="<?php echo $myrow[50] ?>"</td>
            <td><span class="labeltext"><p align="left">PRN</p></font></td>
            <td><input type="text" name="crn" id="crn" size=20 value="<?php echo $myrow[36] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
			<input type="hidden" name="altcrn" id="altcrn" size=20 value="<?php echo $myrow[50] ?>">
			</td>
         </tr>
         <?php
         }

         ?>
         <tr bgcolor="#FFFFFF">
	     <td><span class="labeltext"><p align="left">RM Checked By</p></font></td>
             <td><input type="text" name="rmempcode" id ="rmempcode" size=20 value="<?php echo $myrow[42] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
			 <td><span class="labeltext"><p align="left">RM Checked Date</p></font></td>
	        <td><input type="text" name="rmcheckdate" id="rmcheckdate" size=20
			style=";background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow[43] ?>">
            </td>
         </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Unit RM Cost</p></td>
            <td><input type="text" id="rm_cost" name="rm_cost" size=20 value="<?php echo $myrow[46] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>   
        </td>
		<td colspan=2>&nbsp;</td>
			</tr>
			 <tr bgcolor="#FFFFFF">
	     <td><span class="labeltext"><p align="left">GRN Entered By</p></font></td>
             <td><input type="text" name="grnempcode" id ="grnempcode" size=20 value="<?php echo $myrow[44] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
			 <td><span class="labeltext"><p align="left">GRN Entered Date</p></font></td>
	        <td><input type="text" name="grncheckdate" id="grncheckdate" size=20
			style=";background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow[45] ?>"></td>
         </tr>
         <tr bgcolor="#FFFFFF">
		     <td><span class="labeltext"><p align="left">Quarantine Remarks</p></font></td>
<?php
     if ($myrow[35] == 'Quarantined' && $myrow[40] != '')
	 {
?>
          <td><textarea style=";background-color:#DDDDDD;" readonly="readonly"
		     name="quarremarks" id ="quarremarks" size=20><?php echo $myrow[40] ?></textarea></td>
	       <td><span class="labeltext"><p align="left">Conversion(to Regular) Date</p></font></td>
	        <td><input type="text" name="conversion_date" id="conversion_date" size=20 value="<?php echo $myrow[39]  ?>" 
			style=";background-color:#DDDDDD;" readonly="readonly"> </td>
<?php
	 }
	 else 
	 {
?>
          <td><textarea name="quarremarks" id ="quarremarks" size=20 style=";background-color:#DDDDDD;" readonly="readonly"><?php echo $myrow[40] ?></textarea></td>
	       <td><span class="labeltext"><p align="left">Conversion(to Regular) Date</p></font></td>
	        <td><input type="text" name="conversion_date" id="conversion_date" size=20 value="<?php echo ($myrow[39] == '0000-00-00')?'':$myrow[39]  ?>" 
			style=";background-color:#DDDDDD;" readonly="readonly">

</td>
<?php
	 }
?>
         </tr>

         <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">Quarantined Date</p></font></td>
            <td><input type="text" name="Quarantined_date" id="Quarantined_date" size=20 value="<?php echo ($myrow[41] == '0000-00-00')?'':$myrow[41] ?>" style="background-color:#DDDDDD;" readonly="readonly">
            <?php if($myrow[35] != "Quarantined") 
			{
				//echo "<img src=\"images/bu-getdateicon.gif\" id='image' alt=\"Get BookDate\"          onClick=\"GetDate('Quarantined_date')\">";
			}
			?> 
			</td>
    <td width=20%><span class="labeltext"><p align="left">Status</p></font></td>
    <td ><span class="tabletext"><input type="text" name="status" id="status"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[37] ?>">	<input type="hidden" name="validate_flag" id="validate_flag" value=""></td></tr>
	<tr bgcolor="#FFFFFF">
<td><span class="labeltext">Purchasing Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow[48] == 'yes'?$checked:"" ?>  id="approved_grn_1" name="approved_grn_1" onclick="JavaScript:toggleValue('approved_grn',this);" disabled>
                         <input type="hidden" name="approved_grn" value="<?php echo $myrow[48]?>" id="approved_grn">
                         <input type="hidden" name="prev_approved_grn" value="<?php echo $myrow[48]?>" id="prev_approved_grn">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
                         <input type="text" name="userid_app" id="userid_app" value="<?php echo $myrow[55]?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
           <td><span class="labeltext">Approved Date</td>
          <td ><span class="tabletext"><input type="text" name="approval_date" id="approval_date"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo ($myrow[54] == '0000-00-00')?'':$myrow[54] ?>"></td>
          </tr>

<tr bgcolor="#FFFFFF">
          <td><span class="labeltext">CAD Approved</td>
          <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow[59] == 'yes'?$checked:"" ?>  id="cad_approved_grn_1" name="cad_approved_grn_1" onclick="JavaScript:toggleValue_cad('cad_approved_grn',this);">
                         <input type="hidden" name="cad_approved_grn" value="<?php echo $myrow[59]?>" id="cad_approved_grn">
                         <input type="hidden" name="prev_cad_approved_grn" value="<?php echo $myrow[59]?>" id="prev_cad_approved_grn">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
						 <?
	 if($myrow[59] == 'yes')
	{?>
                         <input type="text" name="userid_app_cad" id="userid_app_cad" value="<?php echo $myrow[60]?>"  style="background-color:#DDDDDD;" readonly="readonly"></td>
	 <?}else
	{?>
	 <input type="text" name="userid_app_cad" id="userid_app_cad" value="<?php echo $myrow[60]?>"></td>
	<?}?>
          <td><span class="labeltext">Approved Date</td>
          <td ><span class="tabletext"><input type="text" name="cad_approval_date" id="cad_approval_date"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[61] ?>"></td>
          </tr>
		         <tr bgcolor="#FFFFFF">
     <td><span class="labeltext"><p align="left">Approval Remarks</p></font></td>
             <td colspan=3><textarea name="approval_remarks" id="approval_remarks" rows=3 cols=40 ><?php echo trim($myrow[53]) ?></textarea>
             </td> </tr>                
         

		  <input type="hidden" name="userid_app" id="userid_app" value="<?php echo $myrow[55]?>">
		  <input type="hidden" name="approval_date" id="approval_date" value="<?php echo $myrow[54]?>">
	
	 <tr bgcolor="#FFFFFF">
  	<td><span class="labeltext"><p align="left">Wo Ref</p></font></td>
            <td><input type="text" name="wo_ref" id="wo_ref" size=20 value="<?php echo $myrow[57] ?>" style=";background-color:#DDDDDD;" readonly = 'readonly'></td>
				<td colspan=2></td>
			<?
		
     $j=1;
     while ($mygrnli4am = mysql_fetch_row($grnli4am))
  {
     $j++;
  }
     ?>

 </td>
 </tr>
<?php
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for %s</b></center></td></tr>',$myrow[25]);
         $grn_notes = $newgrn->getNotes($grnrecnum);
         printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes1" rows="6" cols="88"  readonly="readonly" style="background-color:#DDDDDD;" >');
         while ($mynotes = mysql_fetch_row($grn_notes))
         {
          print("\n");
          print("********Added by $mynotes[2] *********** on $mynotes[1] ");
          print("\n");
          print(" $mynotes[0]");
          print("   \n");
         }
      ?>
      </textarea></td>
      </tr>
	  <?php printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
       <td colspan=4><textarea name="notes" id="notes" rows="3" cols="88%" value=""></textarea>
       </td> </tr>
  

<!--<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value,<?php echo $j ?>)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr> -->
<input type="hidden" name="action" value="edit">
<input type="hidden" name="grnrecnum" id="grnrecnum" value="<?php echo $grnrecnum ?>">

<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Unit RM Size</b></center></td>
</tr>


<tr bgcolor="#FFFFFF">


<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Line</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Amend Line</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Layout Ref#</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Partnum</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Desc</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Batch</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>UOM</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Exp Date<br>(yyyy-mm-dd)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>No Of<br>Pieces</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim1(L)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim2(W/ID)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim3(T/OD)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty/Billet</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty Rej</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>QTM</center></b></td>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Amend</center></b></td>-->
</tr>
<tr>
<?php
  $i=1;   
  $flag=0;
  $total=0;
  $total_prevqty=0;

  while($mygrnli = mysql_fetch_row($grnli))
  {
      $prevlinenum = "prevlinenum" . $i;
      $lirecnum = "lirecnum" . $i;
     
      echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$mygrnli[0]\">";
      echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$mygrnli[7]\">";
?>
      <tr bgcolor="#FFFFFF">
      <td><center><input type="text" id="line_num<?php echo $i?>" name="line_num<?php echo $i?>" value="<?php echo $mygrnli[0] ?>"   style="background-color:#DDDDDD;" readonly="readonly"  size=2></center></td>
      <td><center><input type="text" id="amend_line_num<?php echo $i?>" name="amend_line_num<?php echo $i?>" value="<?php echo $mygrnli[17] ?>" size=2 style="background-color:#DDDDDD;" readonly="readonly"  onblur="javascript:getstat(this,'<?php echo $i ?>');"></center></td>
      <td><center><input type="text" id="layout_ref<?php echo $i?>" name="layout_ref<?php echo $i?>" value="<?php echo $mygrnli[18] ?>" style="background-color:#DDDDDD;" readonly="readonly"  size=8></center></td>
      <td><center><input type="text" id="partnum<?php echo $i?>" name="partnum<?php echo $i?>" value="<?php echo $mygrnli[11] ?>" style="background-color:#DDDDDD;" readonly="readonly"  size=6></center></td>
      <td><center><input type="text" id="partdesc<?php echo $i?>" name="partdesc<?php echo $i?>" value="<?php echo $mygrnli[12] ?>" style="background-color:#DDDDDD;" readonly="readonly"  size=25></center></td>
      <td><center><input type="text" id="batchnum<?php echo $i?>" name="batchnum<?php echo $i?>" value="<?php echo $mygrnli[13] ?>" style="background-color:#DDDDDD;" readonly="readonly"  size=6></center></td>
      <td><center><input type="text" id="uom<?php echo $i?>" name="uom<?php echo $i?>" value="<?php echo $mygrnli[14] ?>" size=5 onkeyup="javascript:getuom(this);" style="background-color:#DDDDDD;" readonly="readonly"	></center></td>
      <td><center><input type="text" id="expdate<?php echo $i?>" name="expdate<?php echo $i?>" value="<?php echo $mygrnli[15] ?>" style="background-color:#DDDDDD;" readonly="readonly"  size=10></center></td>
      <td><center><input type="text" id="noofpieces<?php echo $i ?>" name="noofpieces<?php echo $i ?>" value="<?php echo $mygrnli[20] ?>" size=3  onkeyup="javascript:getQty(this);" style=";background-color:#DDDDDD;" readonly = 'readonly'></center></td>
      <td><center><input type="text" id="dim1<?php echo $i ?>" name="dim1<?php echo $i ?>" value="<?php echo $mygrnli[2] ?>" size=5 onkeyup="javascript:getQty(this);" style="background-color:#DDDDDD;" readonly="readonly"  ></center></td>
      <td><center><input type="text" id="dim2<?php echo $i ?>" name="dim2<?php echo $i ?>" value="<?php echo $mygrnli[3] ?>" size=5 style="background-color:#DDDDDD;" readonly="readonly" ></center></td>
      <td><center><input type="text" id="dim3<?php echo $i ?>" name="dim3<?php echo $i ?>" value="<?php echo $mygrnli[4] ?>" size=5 style="background-color:#DDDDDD;" readonly="readonly" ></center></td>
  

	  <?	
	  if($mygrnli[20] == 0)
	  {?>
			   <td><center><input type="text" id="qty<?php echo $i ?>" name="qty<?php echo $i ?>"   value="<?php echo $mygrnli[1] ?>" onkeyup="javascript:getqtm_value(<?echo $i ?>)" size=3></center></td>
	  <?}
	  else
	  {?>      
      <td><center><input type="text" id="qty<?php echo $i ?>" name="qty<?php echo $i ?>" style=";background-color:#DDDDDD;"
		       readonly="readonly"  value="<?php echo $mygrnli[1] ?>" onkeyup="javascript:getqtm_value(<?echo $i ?>)" size=3></center></td>
	  <?}?>


     <td><center><input  type="text" id="qty4billet<?php echo $i?>" name="qty4billet<?php echo $i?>" value="<?php echo $mygrnli[10] ?>" style="background-color:#DDDDDD;" readonly="readonly"  size=5></center></td>
      <td><center><input type="text" id="qty_rej<?php echo $i?>" name="qty_rej<?php echo $i?>" value="<?php echo $mygrnli[8] ?>" size=5 style="background-color:#DDDDDD;" readonly="readonly"  ></center></td>
      <td><center><input type="text" id="qty_to_make<?php echo $i?>" name="qty_to_make<?php echo $i?>" value="<?php echo $mygrnli[9] ?>" size=5 onblur="javascript:get_total(this);"  style="background-color:#DDDDDD;" readonly="readonly" ></center></td>
    </tr>
<?php
   //onblur="javascript:setAmendstat(echo $i )
      $i++;
      //$total = $total + $mygrnli[9];
      if($mygrnli[17] == '')
      {
        $total = $total + $mygrnli[9];
        $total_prevqty = $total_prevqty + $mygrnli[1];
      } 
  }


     $prevlinenum = "prevlinenum" . $i;
      $lirecnum = "lirecnum" . $i;

      echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
      echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"\">";

   //onblur="javascript:setAmendstat(echo $i )
 
echo "<input type=\"hidden\" name=\"index\" id=\"index\" value=$i>";
echo "<input type=\"hidden\" name=\"qty_tot\" id=\"qty_tot\" value= $total_prevqty >";
?>
</tr>
</table>


	<?
	$row=mysql_fetch_object($cofc);
  $dimenssion=$row->dimensional;
  $ndt=$row->ndt;
 $visual=$row->visual;
 $grain=$row->grain;
 $mech=$row->mech;
 $conductivity=$row->conductivity;
  $chemical=$row->chemical;
 $hardness=$row->hardness;
 $quantity=$row->quantity;
 $temper=$row->temper;
 $cus=$row->cusserial;
 $from=$row->frmserial;
 $to=$row->toserial;
 $noncon=$row->noncon;
 $ncref=$row->ncref;
 $ncdate=$row->ncdate;
 $comm=$row->comm;
 $dcomm=$row->dcomm;
 $remarks=$row->remarks;
 $approval=$row->approval;

             if($ncdate != '' && $ncdate != '0000-00-00')
             {
              $d=substr($ncdate,8,2);
              $m=substr($ncdate,5,2);
              $y=substr($ncdate,0,4);
              $x=mktime(0,0,0,$m,$d,$y);
              $date1=date("M j, Y",$x);
             }
             else
             {
               $date1 = '';
             }
        
?>
	
	
	<tr bgcolor="#FFFFFF">
	

       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

     <tr bgcolor="#FFFFFF">
      <td colspan=7 align='right' class=labeltext>Total Qty</td>
      <td align=center ><input type=text name='total_qty_make' id='total_qty_make' value='<?php echo $total?>'size=5    style="background-color:#DDDDDD;" readonly="readonly" ></td>
      </tr>

         <tr bgcolor="#DDDEDD">
<td align="center" colspan=8><span class="heading"><b>Validation of Certificate of Compliance by RM Supplier</b></span></td>

        </tr>
		 <tr bgcolor="#FFFFFF">
	<td  width=30%> <span class="heading"><b><left>Standard for Verification</left></b></td>
	<td width=70% colspan=7> <span class="heading"><b><left></left></b></td>	
		</tr>
		<tr bgcolor="#FFFFFF">
		<td width=35%><span class="labeltext"><p align="left">Description</p></td>

	<td width=5%> <span class="labeltext"><p align="left">Yes</p></td>
	<td width=5%> <span class="labeltext"><p align="left">No</p></td>
	<td width=5%> <span class="labeltext"><p align="left">N/A</p></td>
	<td width=35%> <span class="labeltext"><p align="left">Description</p></td>
	<td width=5%> <span class="labeltext"><p align="left">Yes</p></td>
	<td width=5%> <span class="labeltext"><p align="left">No</p></td>
	<td width=5%> <span class="labeltext"><p align="left">N/A</p></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=35%><span class="tabletext"><p align="left">Dimensional Inspection</p></td>
	<td width=5%> <b><input name="dimensional" type="radio" value="1" <?php if ($dimenssion=='1'){?>checked="checked" <?php }?> disabled ></b></td>
	<td width=5%> <b><input name="dimensional" type="radio" value="2" <?php if ($dimenssion==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="dimensional" type="radio" value="3" <?php if ($dimenssion==3){?>checked="checked" <?php }?> disabled></b></td>
	<td width=35%> <span class="tabletext"><p align="left">NDT Procedures correct,where applicable</p></td>
	<td width=5%> <b><input name="ndt" type="radio" value="1" <?php if ($ndt==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="ndt" type="radio" value="2" <?php if ($ndt==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="ndt" type="radio" value="3" <?php if ($ndt==3){?>checked="checked" <?php }?> disabled></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=35%><span class="tabletext"><p align="left">Visual Examination for Omission of Damages</p></td>
	<td width=5%> <b><input name="visual" type="radio" value="1" <?php if ($visual==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="visual" type="radio" value="2" <?php if ($visual==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="visual" type="radio" value="3" <?php if ($visual==3){?>checked="checked" <?php }?> disabled></b></td>
	<td width=35%> <span class="tabletext"><p align="left">Is Grain Flow Mentioned</p></td>
	<td width=5%> <b><input name="grain" type="radio" value="1" <?php if ($grain==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="grain" type="radio" value="2" <?php if ($grain==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="grain" type="radio" value="3" <?php if ($grain==3){?>checked="checked" <?php }?> disabled></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Mechanical Properties verified against Standered</p></td>
	<td width=5%> <b><input name="mechanical" type="radio" value="1" <?php if ($mech==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="mechanical" type="radio" value="2" <?php if ($mech==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="mechanical" type="radio" value="3" <?php if ($mech==3){?>checked="checked" <?php }?> disabled></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Conductivity</p></td>
	<td width=5%> <b><input name="conductivity" type="radio" value="1" <?php if ($conductivity==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="conductivity" type="radio" value="2" <?php if ($conductivity==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="conductivity" type="radio" value="3" <?php if ($conductivity==3){?>checked="checked" <?php }?> disabled></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Chemical Properties verified against Standered</p></td>
	<td width=5%> <b><input name="chemical" type="radio" value="1"  <?php if ($chemical==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="chemical" type="radio" value="2" <?php if ($chemical==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="chemical" type="radio" value="3" <?php if ($chemical==3){?>checked="checked" <?php }?> disabled></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Hardness</p></td>
	<td width=5%> <b><input name="hardness" type="radio" value="1" <?php if ($hardness==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="hardness" type="radio" value="2" <?php if ($hardness==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="hardness" type="radio" value="3" <?php if ($hardness==3){?>checked="checked" <?php }?> disabled></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Quantity received agrees with Certification</p></td>
	<td width=5%> <b><input name="quantity" type="radio" value="1"  <?php if ($quantity==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="quantity" type="radio" value="2"  <?php if ($quantity==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="quantity" type="radio" value="3"  <?php if ($quantity==3){?>checked="checked" <?php }?> disabled></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Temper</p></td>
	<td width=5%> <b><input name="temper" type="radio" value="1" <?php if ($temper==1){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="temper" type="radio" value="2"  <?php if ($temper==2){?>checked="checked" <?php }?> disabled></b></td>
	<td width=5%> <b><input name="temper" type="radio" value="3"  <?php if ($temper==3){?>checked="checked" <?php }?> disabled></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Serialization Requirements?</p></td>
<td width=10% colspan="2"><span class="tabletext"><p align="left">Customer Serialization</p></td>
	
	 <td  width="%"><span class="tabletext">Yes<input name="cus" type="radio" value="1" <?php if ($cus==1){?>checked="checked" <?php }?> disabled>
  <span class="tabletext">No &nbsp;<input name="cus" type="radio" value="2" <?php if ($cus==2){?>checked="checked" <?php }?> disabled></td>

	<td width=30%><span class="tabletext"><p align="left">CIM Serialization
	<span class="tabletext">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes<input name="cus" type="radio" value="3" <?php if ($cus==3){?>checked="checked" <?php }?> disabled>
	<span class="tabletext">No<input name="cim" type="hidden" value="2" checked="checked">
	<input name="cus" type="radio" value="4" <?php if ($cus==4){?>checked="checked" <?php }?> disabled></p></td>
	<td width=8% colspan="2"> <span class="tabletext"><p align="left">Serialization not Required</p></td>
	<td width=3%> <b><input name="cus" disabled  type="radio" value="5" <?php if ($cus==5){?>checked="checked" <?php }?>></b></td>
		</tr><input name="not" type="hidden" value="5" >
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">If yes Mention Serial No. </p></td>
	<td width=5% colspan=2> <span class="tabletext"><p align="left">From </p></td>
	<td width=5%><input name="frmserial" type="text" value="<?php echo $from?>" disabled></td>
	<td width=5% colspan=4><span class="tabletext"><p align="left">To     <input name="toserial" type="text" value="<?php echo $to?>" disabled> </b></td>

	</tr>
	<tr bgcolor="#DDDEDD">
     <td align="center" colspan=8><span class="heading"><b>Non-Conformance</b></span></td>
    </tr>
	<tr bgcolor="#FFFFFF">
	 <td width=30%><span class="labeltext"><p align="left">Are any Non Conformance Observed</p></td>
	<td width=6%> <span class="labeltext"><b>Yes</b></span>
	<input name="conformance" type="radio" value="1"  <?php if ($noncon==1){?>checked="checked" <?php }?> disabled></td>
	<td width=5% colspan=2> <b><span class="labeltext"><b>No</b></span>
	
	<input name="conformance" type="radio" value="2"  <?php if ($noncon==2){?>checked="checked" <?php }?> disabled></b></td>
	
	<td width=5% colspan=4 align=top><b><span class="labeltext">NCR Ref No.</b></span> <input name="ncref" id="ncref" type="text" value="<?php echo $ncref?>" style=";background-color:#DDDDDD;" readonly = 'readonly'><br>
	<span class="labeltext">NCR Date</b></span>
     &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="ncrdate" size=20 value="<?php echo $ncdate?>" style="background-color:#DDDDDD;" readonly="readonly" disabled>
                </td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30% colspan=4><span class="labeltext"><p align="left">Is the Observed Non-Conformance communicated to the respective authorities</p></td>
	<td colspan=6> <b><span class="labeltext">Yes<input name="comm" type="radio" value="1"<?php if ($comm==1){?>checked="checked" <?php }?>disabled ></b>
	<span class="labeltext">No <b><input name="comm" type="radio" value="2" <?php if ($comm==2){?>checked="checked" <?php }?> disabled></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Details of Communication</p></td>
	<td width=5% colspan=12><textarea name="dcomm" cols="70" rows="" readonly="readonly" style="background-color:#DDDDDD;" ><?php echo $dcomm?></textarea></td>
	
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Additional Notes/Remarks</p></td>
	<td width=5% colspan=7><textarea name="anotes" cols="70" rows="" readonly="readonly" style="background-color:#DDDDDD;"><?php echo $remarks?></textarea></td>
	
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Authorised Signatory With Date<br>
     (Store Department)</p></td>
	<td width=5% colspan=7 class="tabletext">

    <?php

       if($approval != '')
       {
         //echo $approval . 'hiiiiii';
    ?>
         <input type="hidden" name="approval" value="<?php echo $approval?>">
    <?php
       }
       else
       {
    ?>
         Yes<input name="approval" type="radio" value="<?php echo $approved; ?>" disabled>
         No<input name="approval" type="radio" value=" " checked disabled>
    <?php
       }
    ?>

    </td>
	
		</tr>
	
	</td>
    </tr>


    </td>
     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

         <tr bgcolor="#FFFFFF">


        </tr>


</table>

  <table>

     <table style="width:139%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" id='grn_issue' class="stdtable">
      <tr bgcolor="#DDDEDD">
            <td height="34" colspan=8><span class="heading">
              <center><b>Material Issue</b></center></td>
     </tr>
   <!--  <tr bgcolor="#FFFFFF"><td colspan=8><a href="javascript:addRow4grn_issue('grn_issue',document.forms[0].grniss_index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr> -->
        <tr bgcolor="#FFFFFF">
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Line Num</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">WO Num</font></td>
             <td align=center><span class="labeltext">Wo Date</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">WO Qty</font></td>
             <!-- <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Accepted</font></td> -->
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Rework</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Rejected</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Returned</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Balance</font></td>
        </tr>
   <?php
     $i=1;
       while($myrow3 = mysql_fetch_row($result3))
       {
       
          $line_no = 'line_no' . $i;
          $iss_date = 'issdate' . $i;
          $iss_qty = 'issqty' . $i;
          $iss4wo = 'iss4wo' . $i;
          $accqty = 'accqty' . $i;
          $rework = 'rework' . $i;
          $rejqty = 'rejqty' . $i;
          $retqty = 'retqty' . $i;
          $balance = 'balance' . $i;
          
          $prevlinenum="prevlineno" . $i;
		  $lirecnum="lirecno" . $i;
          
          $fields = $iss4wo . '_' . $iss_date . '_' . $iss_qty;
   ?>
        <tr bgcolor="#FFFFFF">
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $line_no?>' value='<?php echo $i ?>' size=8 style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $iss4wo?>' value='<?php echo $myrow3[0] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly">
                                   <!--<img src="images/getwo.gif" onClick="javascript:GetWo('<?php echo $fields ?>')">--></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $iss_date?>' value='<?php echo $myrow3[1] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $iss_qty?>' value='<?php echo $myrow3[6] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly"></td>
             <!-- <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $accqty?>' value='<?php echo $myrow3[2] ?>' style="background-color:#DDDDDD;" size=8 style="background-color:#DDDDDD;" readonly="readonly"></td> -->
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $rework?>' value='<?php echo $myrow3[3] ?>' size=8  style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $rejqty?>' value='<?php echo $myrow3[4] ?>' size=8  style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td bgcolor="#FFFFFF" align=center><input type=text name='<?php echo $retqty?>' value='<?php echo $myrow3[5] ?>' size=8  style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td align=center><input type=text name='<?php echo $balance?>' value='<?php echo ($total-$myrow3[6]+$myrow3[5]) ?>' size=8 style="background-color:#DDDDDD;" readonly='readonly'></td>

         </tr>

   <?php
	    $total = $total-$myrow3[6]+$myrow3[5];
        $i++;
       }
       echo "<input type=\"hidden\" name=\"balance\" value=$total>";
       echo "<input type=\"hidden\" name=\"grniss_index\" value=$i>";
   ?>
    </table>

 <?
}
?>

	<!-- 	<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->

		</table>
		<?php	
		if($myrow[51]=='' && $dept !='Purchasing')
		{
		?>
  <img  src="images/validate.gif" alt="validate" onClick="validate_grn()">
  <?php
  }
  	else if($myrow[51]!='' && $dept !='Purchasing')
		{
		?>
  <img  src="images/validate.gif" alt="validate" onClick="validate_copygrn()">
  <?php
  }
$result=$newgrn->getpo_items($myrow[30],$myrow[52]);
$myrow_po=mysql_fetch_row($result);

$result=$newgrn->getrm_qty_perbill($myrow[36]);
$myrow_rm=mysql_fetch_row($result);
  ?>
<input type="hidden" name="material_ref" id="material_ref" value="<?=$myrow_po[0]?>">
<input type="hidden" name="material_spec" id="material_spec" value="<?php echo $myrow_po[1] ?>">
<input type="hidden" name="length" id="length" value="<?=$myrow_po[3]?>">
<input type="hidden" name="width" id="width" value="<?=$myrow_po[2]?>">
<input type="hidden" name="thick" id="thick" value="<?=$myrow_po[4]?>">

<input type="hidden" name="rm_qty_perbill" id="rm_qty_perbill" value='<?=$myrow_rm[0]?>'>
<input type="hidden" name="rm_length" id="rm_length" value='<?=$myrow_rm[1]?>'>
<input type="hidden" name="rm_dia" id="rm_dia" value='<?=$myrow_rm[2]?>'>
<input type="hidden" name="rm_uom" id="rm_uom" value='<?=$myrow_rm[3]?>'>
<input type="hidden" name="rm_width" id="rm_width" value='<?=$myrow_rm[4]?>'>
<input type="hidden" name="rm_thickness" id="rm_thickness" value='<?=$myrow_rm[5]?>'>


<input type="hidden" name="pagename" id="pagename" value="edit_grn">
<input type="hidden" name="department" id="department" value="<?php echo $dept ?>">

<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onClick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onClick="javascript: putfocus()">

      </FORM>
</table>
</body>
</html>
