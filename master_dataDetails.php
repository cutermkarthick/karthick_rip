<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = april 04, 2007               =
// Filename: reviewDetails.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Review Details                              =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'master_datadetails';
//////session_register('pagename');

// First include the class definition

include('classes/masterdataClass.php');
include('classes/displayClass.php');
$dept=$_SESSION['department'];
$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];
$page = "Master Data";

$newMD = new masterdata;
$newdisplay = new display;

$masterdatarecnum = $_REQUEST['masterdatarecnum'];

$result = $newMD->getmasterdata($masterdatarecnum);
$myrow = mysql_fetch_assoc($result);

$result4mps = $newMD->getmasterdata_mps($masterdatarecnum);
$result4wo=  $newMD->getmasterdetails4wo($masterdatarecnum);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/master_data.js"></script>

<html>
<head>
<title>Master Data Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
       <tr>
          <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
          <td align="right">&nbsp;
          <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
       </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>

<?php
$newdisplay->dispLinks('');
?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>Master data</b><td colspan=250></td>
    <td bgcolor="#FFFFFF" rowspan=2 align="right">
    <?php
       if($myrow["status"] !='Inactive')
       {
    ?>
    <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='edit_master_data.php?masterdatarecnum=<?php echo $masterdatarecnum ?>'" value="Edit Master" >
   <!-- <a href ="edit_master_data.php?masterdatarecnum=<?php echo $masterdatarecnum ?>" ><img name="Image8" border="0" src="images/bu_editmaster.gif" ></a> -->
         <!-- <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript: printmaster_data(<?php //echo $masterdatarecnum ?>)"> -->
     <?php
       }
     ?>
     <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='export_masterdata.php?masterdatarecnum=<?echo $masterdatarecnum?>'" value="Export" >
             <!-- <a href="export_masterdata.php?masterdatarecnum=<?echo $masterdatarecnum?>"><img name="Image8" border="0" src="images/export.gif" ></a> -->

</td>
  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6 class="stdtable1">
<tr bgcolor="#659EC7"><td colspan=4><span class="heading"><center><b>Master Data Details</b></center></td></tr>


 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
 <tr bgcolor="#FFFFFF"></tr>
 
         <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Host Ref No.</p></font></td>
            <td><span class="tabletext"><span class="tabletext"><?php echo $myrow["CIM_refnum"] ?></td>
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["customer"] ?>
            </td>
        </tr>


         <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Treatment</p></font></td>
            <td><span class="tabletext"><span class="tabletext"><?php echo $myrow["treat"] ?></td>
            <td><span class="labeltext"><p align="left"></p></font></td>
            <td><span class="tabletext"></td>
        </tr>



        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow["partname"] ?>
            </td>
             <td><span class="labeltext"><p align="left">RM by Customer</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["RM_by_customer"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["partnum"] ?></td>
            <td><span class="labeltext"><p align="left">RM by Host</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["RM_by_CIM"] ?>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Secondary Part Num</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["secondary_partname"] ?></td>
            <td><span class="labeltext"><p align="left">Attachments</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["attachments"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Drawing#</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["drawing_num"] ?></td>
            <td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["drg_issue"] ?></td>
        </tr>

      <!-- <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["rm_type"] ?></td>
            <td><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["rm_spec"] ?></td>
        </tr> -->
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">MPS Rev</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["mps_rev"] ?></td>
            <td><span class="labeltext"><p align="left">MPS#</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["mps_num"] ?></td>
        </tr>
        
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COS</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["cos"] ?></td>
            <td><span class="labeltext"><p align="left">Project</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["project"] ?></td>
          </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Maxruling</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["maxruling"] ?></td>
            <td><span class="labeltext"><p align="left">Grainflow</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["grainflow"] ?></td> 
            
         </tr>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Control(Machine Name)</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["machine_name"] ?></td>
            <td><span class="labeltext"><p align="left">Type</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["type"] ?></td>
        </tr>
        <?php
           if($myrow["status"]=='Active')
           {
                $color="#00FF00";
           }
           else if($myrow["status"]=='Inactive')
           {
               $color="#FF0000";
           }
           else
           {
                $color="#FFFFFF";
           }

           if($myrow["revstat"]=='Active' )
           {
                $color1="#00FF00";
           }
           else if($myrow["revstat"]=='Obsolete' )
           {
               $color1="#FF0000";
           }
           else
           {
                $color1="#FFFFFF";
           }

        ?>
         <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">PRN Status</p></font></td>
           <td bgcolor=<?php echo $color ?>><span class="tabletext"><?php echo $myrow["status"] ?></td>
            <td><span class="labeltext"><p align="left">Rev Status</p></font></td>
            <td bgcolor=<?php echo $color1 ?>><span class="tabletext"><?php echo $myrow["revstat"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">Condition</p></font></td>
           <?php
            $condition = wordwrap($myrow["condition"],10,"<br />\n");
           ?>
            <td><span class="tabletext"><?php echo $condition ?></td>
            <td colspan=2></td>
           <!--  <td><span class="labeltext"><p align="left">Type</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["type"] ?></td> -->
        </tr>

        <tr bgcolor="#FFFFFF">
            <td rowspan=3><span class="labeltext"><p align="left">Required Unit Size of RM</p></font></td>
            <td ><span class="labeltext"><p align="left">Dim 1</p></font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["rm_dim1"] ?></td>
         </tr>
         <tr bgcolor="#FFFFFF">
            <td ><span class="labeltext"><p align="left">Dim 2</p></font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["rm_dim2"] ?></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Dim 3</p></font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["rm_dim3"] ?></td>
        </tr>
          <?php
          if($myrow["eng_app_date"] != '0000-00-00' && $myrow["eng_app_date"] != '')
          {
                         $datearr = split('-', $myrow["eng_app_date"]);
                		 $d=$datearr[2];
                		 $m=$datearr[1];
                 		 $y=$datearr[0];
                 		 $x=mktime(0,0,0,$m,$d,$y);
                 		 $eng_date=date("M j, Y",$x);
              		 }
				  else
               		 {
                	     $eng_date = '';
              		 }
              		 $checked="checked";

          ?>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Engineering Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow["eng_app"] == 'yes'?$checked:"" ?>  id="eng_app_1" name="eng_app_1" disabled onClick="return readOnlyCheckBox()">
                         <input type="hidden" name="eng_app" value="<?php echo $myrow["eng_app"]?>" id="eng_app">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>"></td></td>
            <td><span class="labeltext">Engineering Approved By</td>
            <td><span class="tabletext"><?php echo $myrow["eng_app_by"] ." , ". $eng_date ?></td>

          </tr>


        <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">Remarks</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo wordwrap($myrow["remarks"],15,"<br />\n") ?></td>
        </tr>
<table border=0 width=100% cellspacing=1 cellpadding=6 class="stdtable">
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>MPS</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
  <thead>
<th class="head0" width=8% bgcolor="#EEEFEE"><span class="heading"><b><center>Line number</center></b></th>
<th class="head1" width=15% bgcolor="#EEEFEE"><span class="heading"><b><center>Mps Rev</center></b></th>
<th class="head0" width=12% bgcolor="#EEEFEE"><span class="heading"><b><center>Rev Status</center></b></th>
<th class="head1" width=10% bgcolor="#EEEFEE"><span class="heading"><b><center>Rev Date</center></b></th>
<th class="head0" width=15% bgcolor="#EEEFEE"><span class="heading"><b><center>Control(Machine Name)</center></b></th>
<th class="head1" width=40% bgcolor="#EEEFEE"><span class="heading"><b><center>Remarks</center></b></th>
</tr>
</thead>
<?php
  while($myrow4mps = mysql_fetch_row($result4mps))
  {
  if($myrow4mps[6] != '' && $myrow4mps[6] != '0000-00-00')
               {
                 $datearr = split('-', $myrow4mps[6]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $rev_date=date("M j, Y",$x);
               }
               else
               {
                 $rev_date = '';
               }
?>
      <tr>
      <td width=8% bgcolor="#FFFFFF"  align=center><span class="tabletext"><?php echo $myrow4mps[1] ?></td>
	  <td width=15% bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow4mps[2] ?></td>
	  <td width=12% bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow4mps[5] ?></td>
	  <td width=10% bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $rev_date     ?></td>
      <td width=15% bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow4mps[3] ?></td>
      <td width=40% bgcolor="#FFFFFF" align=left>  <span class="tabletext"><?php echo $myrow4mps[4] ?></td>
      </tr>
<?php
  }
?>
</tr>
 </table>
 <br>

<?php
$result_md = $newMD->getrmmasterdata_md($myrow["CIM_refnum"]);
//$myrow_rm = mysql_fetch_assoc($result_md);


?>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#7F462C"><td colspan=4><span class="heading"><center><b>RM Master Data Details</b></center></td></tr>
<br>
 <?php
  while($myrow_rm = mysql_fetch_assoc($result_md))
  {
  ?>
 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
 <tr bgcolor="#FFFFFF"></tr>
<?php
  //while($myrow_rm = mysql_fetch_assoc($result_md))
  //{
     $masterdatarecnum=$myrow_rm["recnum"];
     $result_note_md= $newMD->getnotes_md($masterdatarecnum);
     $mynotes_rm= mysql_fetch_row($result_note_md);
     $color_sp='#646D7E';
  ?>
 		 <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PRN#</p></font></td>
            <td><span class="tabletext"><?php echo $myrow_rm["crnnum"] ?></td>
            <td width=25%><span class="labeltext"><p align="left">Spec Type</font></td>
            <td width=25% bgcolor=<?php echo $color_sp ?>><span class="tabletext"><?php echo $myrow_rm["rm_altrm"] ?>
            </td>
        </tr>
        <?php
          $rm_spec=wordwrap($myrow_rm["rm_spec"],25,"<br>\n",true);
          $rm_cond=wordwrap($myrow_rm["rm_condition"],100,"<br>\n",true);

         ?>
        <tr bgcolor="#FFFFFF">
         	<td ><span class="labeltext"><p align="left">RM Spec</p></font></td>
            <td><span class="tabletext"><?php echo $rm_spec ?></td>
            <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><span class="tabletext"><?php echo $myrow_rm["rm_type"] ?>
        </tr>

         <tr bgcolor="#FFFFFF">
         	<td><span class="labeltext"><p align="left">RM Condition</p></font></td>
            <td colspan="3"><span class="tabletext"><?php $rm_cond ?></td>

        </tr>

        <tr bgcolor="#FFFFFF">
         <td width=25%><span class="labeltext"><p align="left">UOM</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow_rm["rm_uom"] ?>
             <td><span class="labeltext"><p align="left">Dia</p></font></td>
            <td><span class="tabletext"><?php echo $myrow_rm["rm_dia"] ?></td>

        </tr>
        <tr bgcolor="#FFFFFF">
         <td width=25%><span class="labeltext"><p align="left">Length</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow_rm["length"] ?>
            </td>
        <td width=25%><span class="labeltext"><p align="left">Width</p></font></td>
            <td><span class="tabletext"><?php echo $myrow_rm["width"] ?></td>


        </tr>

        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Thickness</p></font></td>
            <td><span class="tabletext"><?php echo $myrow_rm["thickness"] ?></td>
         <td><span class="labeltext"><p align="left">Grainflow</p></font></td>
            <td><span class="tabletext"><?php echo $myrow_rm["rm_grainflow"] ?></td>


        </tr>


        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">LT</p></font></td>
            <td><span class="tabletext"><?php echo $myrow_rm["rm_lt"] ?></td>
        <td><span class="labeltext"><p align="left">ST</p></font></td>
            <td><span class="tabletext"><?php echo $myrow_rm["rm_st"] ?></td>


        </tr>
        <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">Qty/Billet</p></font></td>
            <td><span class="tabletext"><?php echo $myrow_rm["rm_qty_perbill"] ?></td>
        <td><span class="labeltext"><p align="left">MRS</p></font></td>
            <td><span class="tabletext"><?php echo $myrow_rm["rm_mrs"] ?></td>

        </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Unit Price</p></font></td>
            <td><span class="tabletext"><?php echo $myrow_rm["rm_unitprize"] ?></td>
         <td  width=25%><span class="labeltext"><p align="left"><span class='asterisk'></span>Supplier</p></font></td>
            <td><span class="tabletext"><?php echo $myrow_rm["name"] ?></td>

        </tr>
         <?php
          if($myrow_rm["eng_app_date"] != '0000-00-00' && $myrow_rm["eng_app_date"] != '')
          {
                         $datearr = split('-', $myrow_rm["eng_app_date"]);
                		 $d=$datearr[2];
                		 $m=$datearr[1];
                 		 $y=$datearr[0];
                 		 $x=mktime(0,0,0,$m,$d,$y);
                 		 $eng_date=date("M j, Y",$x);
              		 }
				  else
               		 {
                	     $eng_date = '';
              		 }
              		 $checked="checked";


            if($dept == 'ENGAPP' || $dept == 'Sales'|| $dept == 'PPC')
            {
        ?>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Engineering Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow_rm["enggapproved"] == 'yes'?$checked:"" ?>  id="engineering_approved" name="engineering_approved" disabled onClick="return readOnlyCheckBox()">
                         <input type="hidden" name="eng_app_rm" value="<?php echo $myrow_rm["enggapproved"]?>" id="eng_app_rm">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>"></td></td>
            <td><span class="labeltext">Engineering Approved By</td>
            <td><span class="tabletext"><?php echo $myrow_rm["engapprovedby"] . ' , ' . $eng_date ?></td>
          </tr>

        <?php
          }
        ?>

        <?php
                   if($myrow_rm["rm_status"] == 'Inactive')
                   {
                      $color = '"#FF0000"';
                   }
                   else if($myrow_rm["rm_status"] == 'Active' ||$myrow_rm["rm_status"] == 'Pending')
                       {
                         $color = '"#00FF00"';

                       }
                       else
                       {
                          $color = '"#FFFFFF"';

                       }

        ?>
        <tr bgcolor="#FFFFFF">
          <td width=25%><span class="labeltext"><p align="left">Status</p></font></td>
            <td bgcolor=<?php echo $color ?>><span class="tabletext"><span class="tabletext"><?php echo $myrow_rm["rm_status"] ?></td>
          <td width=25%><span class="labeltext"><p align="left">Remarks</p></td>
          <td><span class="tabletext"><textarea name="rm_remarks" id="rm_remarks" rows="3" cols="60" readonly="readonly" style="background-color:#DDDDDD;"><?php echo $myrow_rm["rm_remarks"] ?></textarea></td>

    <!--    <tr bgcolor="#FFFFFF">
          <td width=25%><span class="labeltext"><p align="left">RM Code</p></font></td>
            <td><span class="tabletext"><span class="tabletext"><?php //echo $myrow["rmcode"] ?></td>
            <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><span class="tabletext"><?php //echo $myrow["rm_type"] ?>
         </tr> -->
   <!--     <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">Alt Spec</p></font></td>
            <td><span class="tabletext"><?php //echo $myrow["rm_altrm"] ?></td>

            <td colspan="2"><span class="tabletext"></td> -->
        </tr>
        
           <tr bgcolor="#FFFFFF">

        <?php



            printf('<tr  bgcolor="#DDDEDD"><td colspan=12><span class="heading"><center><b>RM Notes</b></center></td></tr>');
            //$result2 = $newMD->getNotes_md($masterdatarecnum);
            printf('<tr bgcolor="#FFFFFF"><td colspan=12><textarea name="notes" rows="6" cols="89" readonly="readonly" style="background-color:#DDDDDD;">');
            while ($mynotes = mysql_fetch_row($result_note_md)) {
                  printf("\n");
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
                  printf("********Added by $userid on $create_date *******");
                  printf("\n");
                  printf($mynotes[1]);
                  printf("   \n");
            }

?>
  </textarea></tr>
</table>
<?php
}
?>
<!-- 
		<td width="6"><img src="images/spacer.gif " width="6"></td>
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
