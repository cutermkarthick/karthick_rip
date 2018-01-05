<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 18,2008                 =
// Filename: rmeditmaster.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows editing of RM Master                 =
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
//////session_register('pagename');
       // echo $dept;
// First include the class definition
include('classes/rmmasterClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];
$page= "Purchasing: RM Master";

$newMD = new rmmaster;
$newdisplay = new display;

$masterdatarecnum = $_REQUEST['masterdatarecnum'];

$result = $newMD->getrmmasterdata($masterdatarecnum);
$myrow = mysql_fetch_assoc($result);
$result1= $newMD->getnotes($masterdatarecnum);
$mynotes= mysql_fetch_assoc($result1);

$resultrmpo=$newMD->getrmpodetails4rm($myrow["rm_altrm"],$masterdatarecnum);
//echo $resultrmpo."------------";
//echo $mynotes["create_date"]."hai";

?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/rmmaster.js"></script>


<html>
<head>
<script language="javascript" type="text/javascript">
function readOnlyRadio() {
   return false;
}

</script>
<title>Edit RM Master</title>
</head>
<?php
if($myrow["rm_status"]=='Inactive')
{
?>
  <body leftmargin="0"topmargin="0" marginwidth="0" onload="javascript: getspec('crn_spec')">
<?
}
else
{
?>
 <body leftmargin="0"topmargin="0" marginwidth="0">

<?php
}
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
        <td><span class="pageheading"><b>Edit RM Master</b></td>
    </tr>


     <form action='processRMMaster.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Edit RM Master</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
        <?php
        //$dept!='Purchasing' &&
       // if($resultrmpo == 0)
        //{
        ?>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">PRN#</p></font></td>
            <td><input type="text" id="crnnum" name="crnnum" size=20 value='<?php echo $myrow["crnnum"] ?>'>
            <div id="crn_spec"></div></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Alt Spec</p></font></td>
           <td><input type="text" style=width:150px name="spec_val" id="spec_val" value='<?php echo $myrow["rm_altrm"] ?>' readonly="readonly" style="background-color:#DDDDDD;">
                   <select style=width:120px name="spec_val_type" size="1"  id="spec_val_type" onchange="javascript: getspec();change_spec_type();">
            	<option value='Please Specify'>Please Specify</option>
				<option value='Primary Spec'>Primary Spec</option>
				<option value='Alt Spec1'>Alt Spec1</option>
    			<option value='Alt Spec2'>Alt Spec2</option>
			    <option value='Alt Spec2'>Alt SpecP</option>
				</select>
                </td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
        <td ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM Spec</p></font></td>
            <td><input type="text" name="rm_spec" size=20 value='<?php echo $myrow["rm_spec"] ?>'></td>
           <td ><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td ><input type="text" name="rm_type" size=20 value='<?php echo $myrow["rm_type"] ?>'></td>

        </tr>
        <tr bgcolor="#FFFFFF">
        <td width="30%" ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM Bars/Plates</p></font></td>
            <td><input type="text" name="rm_bars_plates" size=20 value="<?php echo $myrow["rm_bars_plates"] ?>" id="rm_bars_plates" style=";background-color:#DDDDDD;"
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
        <td ><span class="labeltext"><p align="left">RM Condition</p></font></td>
            <td colspan="3"><input type="text" name="rm_condition" size=99 value='<?php echo $myrow["rm_condition"] ?>'></td>



        </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">UOM</p></font></td>
            <td><input type="text" name="rm_uom" size=20 value='<?php echo $myrow["rm_uom"] ?>'></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Dia</p></font></td>
            <td><input type="text" name="rm_dia" size=20 value='<?php echo $myrow["rm_dia"] ?>'></td>

        </tr>

        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Length</p></font></td>
            <td><input type="text" name="rm_dim1" size=20 value='<?php echo $myrow["length"] ?>'></td>
            <td><span class="labeltext"><p align="left">Width</p></font></td>
            <td><input type="text" name="rm_dim2" size=20 value='<?php echo $myrow["width"] ?>'></td>

        </tr>
         <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">Thickness</p></font></td>
            <td><input type="text" name="rm_dim3" size=20 value='<?php echo $myrow["thickness"] ?>'></td>
            <td><span class="labeltext"><p align="left">Grainflow</p></font></td>
            <td><input type="text" name="rm_grainflow" size=20 value='<?php echo $myrow["rm_grainflow"] ?>'></td>


        </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">LT</p></font></td>
            <td><input type="text" name="rm_lt" size=20 value='<?php echo $myrow["rm_lt"] ?>'></td>
        <td><span class="labeltext"><p align="left">ST</p></font></td>
            <td><input type="text" name="rm_st" size=20 value='<?php echo $myrow["rm_st"] ?>'></td>



        </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Qty/Billet</p></font></td>
            <td><input type="text" name="rm_qty_perbill" size=20 value='<?php echo $myrow["rm_qty_perbill"] ?>'></td>
        <td><span class="labeltext"><p align="left">MRS</p></font></td>
            <td><input type="text" name="rm_mrs" size=20 value='<?php echo $myrow["rm_mrs"] ?>'></td>

        </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Unit Price</p></font></td>
            <td><input type="text" name="rm_unitprize" size=20 value='<?php echo $myrow["rm_unitprize"] ?>'>
            <select name="currency" id="currency"  width=2>
		            <?
		            $currency=array('$','Rs','GBP');
					for($j=0;$j<count($currency);$j++){

					if($currency[$j] == $myrow["currency"]){
                    ?>
					<option selected value="<? echo $currency[$j]?>"><?echo $currency[$j]; ?>
					</option>
					<?}
					else{?>
                    <option value="<? echo $currency[$j]?>"><?echo $currency[$j]; ?>
					</option>
					<?}
					}?>
                    </span></td>
            <td  width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supplier</p></font></td>
            <td><span class="tabletext"><input type="text" name="vendor"
               style=";background-color:#DDDDDD;"
		       readonly="readonly" size=20 value="<?php echo "$myrow[name]";?>">
   		     <img src="images/bu-getvendor.gif" alt="Get Vendor"
                     onclick="javscript:GetAllVendors()"></td>
                 <input type="hidden" name="vendrecnum" value="<?php echo "$myrow[link2vendor]";?>">
                 <input type="hidden" name="create_date" value="<?php echo $myrow["createdate"];?>">
                 <input type="hidden" name="status_copy"  id="status_copy" value="<?php echo $_REQUEST['status'];?>">

             </td>

        </tr>
        <?php
       // echo $dept."------------";
        if($dept!='Purchasing')
         {
            $checked="checked";
        ?>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Directors Approved</td>
            <?php
            if($myrow["directorsapproved"] != 'yes')
            {
            ?>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow["directorsapproved"] == 'yes'?$checked:"" ?>  id="directors_approved" name="directors_approved" onclick="JavaScript:toggleValue('director_app',this);">
            <?php
            }
            else
            {
            ?>
           <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow["directorsapproved"] == 'yes'?$checked:"" ?>  id="directors_approved" name="directors_approved" onclick="return readOnlyRadio();">
            <?php
            }
            ?>
                         <input type="hidden" name="director_app" value="<?php echo $myrow["directorsapproved"]?>" id="director_app">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
                         <input type="hidden" name="director_app_by" id="director_app_by" value="<?php echo $myrow["directorsapprovedby"]?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>"></td>
          <td><span class="labeltext">Director Approved Date</td>
          <td bgcolor="#FFFFFF"><input type='text' name='director_app_date' id="director_app_date" value='<?php echo $myrow["director_app_date"]?>' style="background-color:#DDDDDD;" readonly="readonly"> </td>

          </tr>
       <?php
            $checked_engg="checked";
            //if($dept == 'ENGAPP')
            //{
        ?>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Engineering Approved</td>
             <?php
            if($myrow["enggapproved"] != 'yes')
            {
            ?>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow["enggapproved"] == 'yes'?$checked_engg:"" ?>  id="engineering_approved" name="engineering_approved" onclick="JavaScript:toggleValue('eng_app',this);">
             <?php
            }
            else
            {
            ?>
             <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow["enggapproved"] == 'yes'?$checked_engg:"" ?>  id="engineering_approved" name="engineering_approved" onclick="return readOnlyRadio();">
            <?php
            }
            ?>
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>"></td>
                         <input type="hidden" name="eng_app" value="<?php echo $myrow["enggapproved"]?>" id="eng_app">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>"></td></td>
                         <input type="hidden" name="eng_app_by" value="<?php echo $myrow["enggapprovedby"]?>" id="eng_app_by">
         <td><span class="labeltext">Engineering Approved Date</td>
          <td bgcolor="#FFFFFF"><input type='text' name='eng_app_date' id="eng_app_date" value='<?php echo $myrow["eng_app_date"]?>' style="background-color:#DDDDDD;" readonly="readonly"> </td>


          </tr>

        <?php
          }
          // $dept=='Purchasing' ||
       //}
      /* else if($resultrmpo !=0)
       { */
       ?>
       <!-- <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">PRN#</p></font></td>
            <td><input type="text" id="crnnum" name="crnnum" size=20 readonly="readonly" style="background-color:#DDDDDD;" value='<?php echo $myrow["crnnum"] ?>'>
            <div id="crn_spec"></div></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Alt Spec</p></font></td>
           <td><input type="text" style=width:150px name="spec_val" id="spec_val" readonly="readonly" style="background-color:#DDDDDD;"
           value='<?php echo $myrow["rm_altrm"] ?>' readonly="readonly" style="background-color:#DDDDDD;"><div id="crn_spec"></div>
                   </td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
        <td ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM Spec</p></font></td>
            <td><input type="text" name="rm_spec" size=20 readonly="readonly" style="background-color:#DDDDDD;" value='<?php echo $myrow["rm_spec"] ?>'></td>
           <td ><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><input type="text" name="rm_type" size=20 readonly="readonly" style="background-color:#DDDDDD;"
            value='<?php echo $myrow["rm_type"] ?>'><input type="hidden" name="rm_curstat_edit" id="rm_curstat_edit" value="0"></td>

        </tr>
        <tr bgcolor="#FFFFFF">
        <td ><span class="labeltext"><p align="left">RM Condition</p></font></td>
            <td colspan="3"><input type="text" name="rm_condition" size=99 readonly="readonly" style="background-color:#DDDDDD;"
            value='<?php echo $myrow["rm_condition"] ?>'></td>



        </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">UOM</p></font></td>
            <td><input type="text" name="rm_uom" size=20 readonly="readonly" style="background-color:#DDDDDD;" value='<?php echo $myrow["rm_uom"] ?>'></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Dia</p></font></td>
            <td><input type="text" name="rm_dia" size=20 readonly="readonly" style="background-color:#DDDDDD;" value='<?php echo $myrow["rm_dia"] ?>'></td>

        </tr>

        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Length</p></font></td>
            <td><input type="text" name="rm_dim1" size=20 readonly="readonly" style="background-color:#DDDDDD;" value='<?php echo $myrow["length"] ?>'></td>
            <td><span class="labeltext"><p align="left">Width</p></font></td>
            <td><input type="text" name="rm_dim2" size=20 readonly="readonly" style="background-color:#DDDDDD;" value='<?php echo $myrow["width"] ?>'></td>

        </tr>
         <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">Thickness</p></font></td>
            <td><input type="text" name="rm_dim3" size=20 readonly="readonly" style="background-color:#DDDDDD;" value='<?php echo $myrow["thickness"] ?>'></td>
            <td><span class="labeltext"><p align="left">Grainflow</p></font></td>
            <td><input type="text" name="rm_grainflow" size=20 readonly="readonly" style="background-color:#DDDDDD;" value='<?php echo $myrow["rm_grainflow"] ?>'></td>


        </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">LT</p></font></td>
            <td><input type="text" name="rm_lt" size=20 readonly="readonly" style="background-color:#DDDDDD;" value='<?php echo $myrow["rm_lt"] ?>'></td>
        <td><span class="labeltext"><p align="left">ST</p></font></td>
            <td><input type="text" name="rm_st" size=20 readonly="readonly" style="background-color:#DDDDDD;" value='<?php echo $myrow["rm_st"] ?>'></td>



        </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Qty/Billet</p></font></td>
            <td><input type="text" name="rm_qty_perbill" size=20 readonly="readonly" style="background-color:#DDDDDD;" value='<?php echo $myrow["rm_qty_perbill"] ?>'></td>
        <td><span class="labeltext"><p align="left">MRS</p></font></td>
            <td><input type="text" name="rm_mrs" size=20 readonly="readonly" style="background-color:#DDDDDD;" value='<?php echo $myrow["rm_mrs"] ?>'></td>

        </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Unit Price</p></font></td>
            <td><input type="text" name="rm_unitprize" size=20 readonly="readonly" style="background-color:#DDDDDD;"
            value='<?php// echo $myrow["rm_unitprize"] ?>'><span class="tabletext">
		<select name="currency" id="currency"  width=2>
		            <?
		            //$currency=array('$','Rs','GBP');
					//for($j=0;$j<count($currency);$j++){

				//	if($currency[$j] == $myrow["currency"]){?>
					<option selected value="<? //echo $currency[$j]?>"><?//echo $currency[$j]; ?>
					</option>
					<?//}
					//else//{?>
                    <option value="<? //echo $currency[$j]?>"><?//echo $currency[$j]; ?>
					</option>
					<?//}
					//}?>
                    </span>
                    </td>
            <td  width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supplier</p></font></td>
            <td><span class="tabletext"><input type="text" name="vendor"
               style=";background-color:#DDDDDD;"
		       readonly="readonly" size=20 value="<?php //echo "$myrow[name]";?>">
   		     <!--<img src="images/bu-getvendor.gif" alt="Get Vendor"
                     onclick="javscript:GetAllVendors()"></td>-->
                 <!--<input type="hidden" name="vendrecnum" value="<?php //echo "$myrow[link2vendor]";?>">
                 <input type="hidden" name="create_date" value="<?php //echo $myrow["createdate"];?>">
             </td>

        </tr> -->

         <?php
         //$myrow["rm_status"] == 'Pending'
         //if($dept!='Purchasing')
         //{
           // $checked="checked";
        ?>
         <!-- <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Directors Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow["directorsapproved"] == 'yes'?$checked:"" ?>  id="directors_approved" name="directors_approved" onclick="JavaScript:toggleValue('director_app',this);">
                         <input type="hidden" name="director_app" value="<?php echo $myrow["directorsapproved"]?>" id="director_app">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>">
                         <input type="hidden" name="director_app_by" id="director_app_by" value="<?php echo $myrow["directorsapprovedby"]?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>"></td>
          <td><span class="labeltext">Director Approved Date</td>
          <td bgcolor="#FFFFFF"><input type='text' name='director_app_date' id="director_app_date" value='<?php echo $myrow["director_app_date"]?>' style="background-color:#DDDDDD;" readonly="readonly"> </td>

          </tr> -->
       <?php
            //$checked_engg="checked";
            //if($dept == 'ENGAPP')
            //{
        ?>
         <!-- <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Engineering Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow["enggapproved"] == 'yes'?$checked_engg:"" ?>  id="engineering_approved" name="engineering_approved" onclick="JavaScript:toggleValue('eng_app',this);">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>"></td>
                         <input type="hidden" name="eng_app" value="<?php echo $myrow["enggapproved"]?>" id="eng_app">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>"></td></td>
                         <input type="hidden" name="eng_app_by" value="<?php echo $myrow["enggapprovedby"]?>" id="eng_app_by">
         <td><span class="labeltext">Engineering Approved Date</td>
          <td bgcolor="#FFFFFF"><input type='text' name='eng_app_date' id="eng_app_date" value='<?php echo $myrow["eng_app_date"]?>' style="background-color:#DDDDDD;" readonly="readonly"> </td>


          </tr> -->

       <?php
      // }
      // } */
       ?>
       <tr bgcolor="#FFFFFF">
          <!-- <td><span class="labeltext"><p align="left">Alt Spec</p></font></td>
            <td colspan="4"><input type="text" name="rm_altrm" size=20 value='<?php //echo $myrow["rm_altrm"] ?>'></td> -->
           <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td><input type="text" name="rm_status" id="rm_status" size=20 readonly="readonly" style="background-color:#DDDDDD;" value='<?php echo $myrow["rm_status"] ?>'>
            <?php
            //echo "HERE-----".$myrow["rm_status"];
            if($myrow["rm_status"] != 'Pending' && $_REQUEST['status'] !='copy_rm')
            {
            ?>
            <select style=width:130px  name="rm_status_togle" id="rm_status_togle" onchange="javascript: onSelectStat(),getspec('crn_spec')" >
                    <?php $selected = 'selected'; ?>
                    <option value="Inactive" <?php if($myrow["rm_status"] == 'Active') echo $selected?>>Active</option>
                   <option value="Inactive" <?php if($myrow["rm_status"] == 'Inactive') echo $selected?>>Inactive</option>
                   </select>
                   <?php
                   }
                   ?>
                   <div id="crn_spec"></div>
                   </td>
                   <td><span class="labeltext"><p align="left">Remarks</p></font></td>
            <td><textarea name="rm_remarks" id="rm_remarks" rows="3" cols="35"><?php echo $myrow["rm_remarks"];?></textarea></td>

             </tr>
               <tr bgcolor="#FFFFFF">
                <?php



            printf('<tr  bgcolor="#DDDEDD"><td align="center" colspan=3><span class="heading"><b>RM Notes</b></center></td><td align="center" colspan=2><span class="heading"><b>Add Notes</b></td></tr>');
            $result2 = $newMD->getNotes($masterdatarecnum);
            printf('<tr bgcolor="#FFFFFF"><td colspan="2"><textarea name="notes" rows="6" cols="70" readonly="readonly" style="background-color:#DDDDDD;">');
            while ($mynotes = mysql_fetch_row($result2)) {
            		$d1=$mynotes[0];
            	   if($d1 != '' && $d1 != '0000-00-00')
                     {
                		 $datearr = split('-', $d1);
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
                  printf("\n");
                  printf("********Added by $userid on $create_date *******");
                  printf("\n");
                  printf($mynotes[1]);
                  printf("   \n");
            }

?>      </textarea>
					<td colspan="3"><textarea name="addnotes" id="addnotes" rows="6" cols="70"></textarea>

         <input type='hidden' name='partnum' value='<?php echo $myrow["partnum"]; ?>'></td>
         <input type='hidden' name='masterdatarecnum' id='masterdatarecnum' value='<?php echo $masterdatarecnum; ?>'></td>
          <input type='hidden' name='pagename' id='pagename' value="edit_rmentry"></td>
        </tr>



</table>
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
