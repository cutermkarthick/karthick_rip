<?php 
//
//==============================================
// Author: FSI                                 =
// Date-written = April 26,2010                =
// Filename: edit_bom.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new BOMs                    =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'edit_bom';
$page = "BOM";
//////session_register('pagename');
$userrole = $_SESSION['userrole'];
$bomrecnum = $_REQUEST['bomrecnum'];
$dept = $_SESSION['department'];

// First include the class definition
include('classes/displayClass.php');
include('classes/bomClass.php');
include('classes/bomli_mfgClass.php');
include('classes/bomli_treatedClass.php');
include('classes/bomli_boughtClass.php');
include('classes/bomli_consumeClass.php');
include('classes/bomli_opnClass.php');
include('classes/bom_subassyClass.php');

$newBOM = new bom;
$newBOMLI_mfg = new bomli_mfg_items;
$newBOMLI_treat = new bomli_treat_items;
$newBOMLI_bought = new bomli_bought_items;
$newBOMLI_consume = new bomli_consume_items;
$newBOM_oper = new bomli_op;
$newdisplay = new display;
$newBOMLI_subassy = new bomli_subassy_items;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/bom.js"></script>

<html>
<head>
<title>Edit BOM</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processBOM.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td></td></tr>
<tr>
<td>

<?php $newdisplay->dispLinks(''); ?>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table style="width:1305px" border=0 cellpadding=6 cellspacing=0>
<tr><td><span class="heading"><b>New BOM</b></td></tr>
<tr>
<?php
$result = $newBOM->getBOMs($bomrecnum);
$myrow = mysql_fetch_assoc($result);
?>
<tr><td bgcolor="#DDDDD"  colspan=5 align="center"><span class="heading"><b>General Information</b></td></tr>
<table border=0 bgcolor="#DFDEDF" style="width:1305px" cellspacing=1 cellpadding=3 class="stdtable1">

  <tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">Assy Wo#</p></font></td>
    <td><input type="text" size=20 id="assywonum" name="assywonum" value="<?php echo $myrow["assywonum"]?>" style="background-color:#DDDDDD;" readonly="readonly">
    <img src="images/bu-get.gif" alt="Get CIM" onclick="getassyWO4BOM()"></td>
    <td><span class="labeltext"><p align="left">DRG No</p></font></td>
    <td><input type="text" size=15 id="drg_no" name="drg_no" value="<?php echo $myrow["drg_no"]?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
  </tr>


  <tr bgcolor="#FFFFFF" width=100%>
    <input type="hidden" name="bomnum" id="bomnum"  value="<?php echo $myrow["bomnum"]?>">
    <input type="hidden" name="link2assywo" id="link2assywo"  value="<?php echo $myrow["link2assywo"]?>">
    <input type="hidden" name ="bomrecnum" value="<?php echo $myrow["recnum"]?>">
    <input type="hidden" name ="pagename" value="editbompage">
    <input type="hidden" name="create_date" id="create_date" value="<?php echo $myrow["create_date"];?>">
    <td><span class="labeltext"><p align="left">PRN</p></font></td>
    <td><input type="text" id="crn" name="crn" size=15 value="<?php echo $myrow["crn"]?>" style="background-color:#DDDDDD;" readonly="readonly">
    
    </td>
    <td><span class="labeltext"><p align="left">BOM REV#</p></td>
    <td><input type="text" size=15  name="bomrevnum" id="bomrevnum" value="<?php echo $myrow["bom_revnum"]?>"></td>
  </tr>


<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Assy Part No.</p></font></td>
<td><input type="text" size=20 id="assy_part" name="assy_part" value="<?php echo $myrow["assy_partnum"]?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
<td><span class="labeltext"><p align="left">DRG No</p></font></td>
<td><input type="text" size=15 id="drg_no" name="drg_no" value="<?php echo $myrow["drg_no"]?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
<td><input type="text" size=15 id="issue" name="issue" value="<?php echo $myrow["issue"]?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
<td><span class="labeltext"><p align="left">COS Iss</p></font></td>
<td ><input type="text" id="cos_no" name="cos_no" size=25 value="<?php echo $myrow["cos_no"]?>" style="background-color:#DDDDDD;" readonly="readonly">
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Part Issue/Attachments</p></td>
<td><input type="text" size=25  style="background-color:#DDDDDD;" readonly="readonly" name="partiss" id="partiss" value="<?php echo $myrow["partiss"]?>"></td>
<td><span class="labeltext"><p align="left">Title</p></font></td>
<td><input type="text" name="title" id="title" value="<?php echo $myrow["title"]?>"></td>

</tr>
<tr bgcolor="#FFFFFF">
               <td><span class="labeltext"><p align="left">Status</p></font></td>
               <td ><input type='text' name='status' id="status" size=12 value='<?php echo $myrow["status"]; ?>' style="background-color:#DDDDDD;" readonly="readonly">
          <?php
          if($myrow["status"] == 'Pending')
          {
          ?>
               <select  name="status_sel" id="status_sel" size="width:150px"  onclick="javascript:onSelectStatus()">
                    <?php $selected = 'selected'; ?>
                   <option value="Active" <?php if($myrow["status"] == 'Active') echo $selected?>>Active</option>
                   <option value="Inactive" <?php if($myrow["status"] == 'Inactive') echo $selected?>>Inactive</option>
                   </select>
                   <?php
                   }

?></td>
 <td colspan=2></td>
 </tr>
  <?php 
           if($dept=='QA' || $dept=='Sales')
           {
           
            $checked="Checked";
               
  
        ?>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">QA Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow["eng_app"] == 'yes'?$checked:"" ?>  name="eng_app_1" id="eng_app_1" onclick="JavaScript:toggleValue('eng_app_1',this);">
            <? if($myrow['eng_app'] == 'yes')
            {
              ?>
            
            <input type="hidden" value="<?php echo $myrow['eng_app'];?>" name="eng_app_1" id="eng_app_1" >
            <?}?>
   
          <td><span class="labeltext">QA Approved Date</td>
          <td bgcolor="#FFFFFF"><input type='text' name='eng_app_date' id="eng_app_date" value='<?php echo $myrow["eng_app_date"]; ?>' style="background-color:#DDDDDD;" readonly="readonly"> </td>
          <input type="hidden" name="eng_app_by" id="eng_app_by" value="<?php echo $myrow["eng_app_by"]?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>"></td>
           <?php
           }else{
     
           ?>
                       <input type="hidden" name="eng_app_1" value="<?php echo $myrow["eng_app"]?>" id="eng_app_1">
                         <input type="hidden" name="eng_app_date" value="<?php echo $myrow["eng_app_date"]?>" id="eng_app_date">
                         <input type="hidden" name="eng_app_by" id="eng_app_by" value="<?php echo $myrow["eng_app_by"]?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>"></td>

<?}



?>
          </tr>
          <?php
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for %s</b></center></td></tr>',$myrow["bomnum"]);
         $bom_notes = $newBOM->getNotes($bomrecnum);
         printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes1" rows="6" cols="88"  readonly="readonly">');
         while ($mynotes = mysql_fetch_row($bom_notes))
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
</table>
<table border=0 bgcolor="#DFDEDF" style="width:1305px" cellspacing=1 cellpadding=3 class="stdtable">
<tr bgcolor="#DDDDD"><td colspan=12><a href="javascript:addRow4subassy('myTable_subassy',document.forms[0].index_assy.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td>
<td colspan=5 align="left"><span class="heading"><b>Type = Assembly</b></td>
<td colspan=7 align="left"><span class="heading"><b>Sub Assembly</b></td>
</tr>
<tr bgcolor="#FFFFFF">
<table id="myTable_subassy" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
  <thead>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Line</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Item No</b></th>
<!--<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>PRN Type</b></th>-->
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part #</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Part Name</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part Issue/Attachments</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>COS</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>DRG Iss</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Mps#</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Mps Rev</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>QPA</b></th>
</tr>
</thead>

<?php

 $z=1;
 $flag_assy=0;
 $result_assy = $newBOMLI_subassy->get_subassy_li($bomrecnum);
   while ($z<=3)
   {
    if($flag_assy == 0)
    {
      while ($myLI_subassy = mysql_fetch_row($result_assy))
      {
	    printf('<tr bgcolor="#FFFFFF">');
        $as_linenumber="as_linenum" . $z;
        $as_itemno="as_itemno" . $z;
        $as_partno="as_partno" . $z;
        $as_crn="as_crn" . $z;
        $as_partname="as_partname" . $z;
        $as_partiss="as_partiss" . $z;
        $as_drgiss="as_drgiss" . $z;
        $as_mpsnum="as_mpsnum" . $z;
        $as_mpsrev="as_mpsrev" . $z;
        $as_attach="as_attach" . $z;
        $as_qpa="as_qpa" . $z;
        $as_crn_type="as_crn_type" . $z;
        // $as_crn_treat="as_crn_treat" . $z;
        $prevlinenum_assy="prev_line_num_assy" . $z;
        $lirecnum_assy="lirecnum_assy" . $z;
		$as_cos="as_cos" . $z;

		$master_partiss="master_partiss" . $z;
		$master_drgiss="master_drgiss" . $z;		
		$master_cos="master_cos" . $z;


        echo "<input type=\"hidden\" id=\"$prevlinenum_assy\" name=\"$prevlinenum_assy\" value=\"$myLI_subassy[1]\">";
        echo "<input type=\"hidden\" id=\"$lirecnum_assy\" name=\"$lirecnum_assy\" value=\"$myLI_subassy[0]\">";

        echo "<td><span class=\"tabletext\"><input type=\"text\"  id=\"$as_linenumber\" name=\"$as_linenumber\"  value=\"$myLI_subassy[1]\" size=\"2%\"></td>";
        echo "<td><input type=\"text\" id=\"$itemno\" name=\"$as_itemno\" size=\"5%\" value=\"$myLI_subassy[2]\"></td>";
              echo "<td width=\"5%\"><input type=\"text\" id=\"$as_crn\" name=\"$as_crn\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI_subassy[4]\">";
        echo "<img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"GetCIM_sassy('$z')\"></td>";
        echo "<td><input type=\"text\" id=\"$as_partno\" name=\"$as_partno\" size=\"18%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_subassy[3]\"></td>";
        echo "<td><input type=\"text\" id=\"$as_partname\" name=\"$as_partname\" size=\"18%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_subassy[5]\">";


        echo "<td><input type=\"text\" id=\"$as_partiss\" name=\"$as_partiss\" size=\"15%\"   value=\"$myLI_subassy[6]\"></td>";
		 echo "<td><input type=\"text\" id=\"$as_cos\" name=\"$as_cos\" size=\"12%\" value=\"$myLI_subassy[13]\"></td>";
        echo "<td><input type=\"text\" id=\"$as_drgiss\" name=\"$as_drgiss\" size=\"12%\" value=\"$myLI_subassy[7]\"></td>";


        echo "<td><input type=\"text\" id=\"$as_mpsnum\" name=\"$as_mpsnum\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_subassy[10]\"></td>";
        echo "<td><input type=\"text\" id=\"$as_mpsrev\" name=\"$as_mpsrev\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_subassy[11]\"></td>";
        //echo "<td><input type=\"text\" id=\"$as_attach\" name=\"$as_attach\" size=\"12%\" value=\"$myLI_subassy[8]\"></td>";
        echo "<td><input type=\"text\" id=\"$as_qpa\" name=\"$as_qpa\" size=\"3%\" value=\"$myLI_subassy[9]\"></td>";
        printf('</tr>');

       $result = $newBOMLI_subassy->getcrnDetails4bommfg_edit($myLI_subassy[4],'');
	   $myrow = mysql_fetch_row($result);
		
		 
		 echo "<input type='hidden' name='$master_partiss' id='$master_partiss' value=\"$myrow[7]\">";
		echo "<input type='hidden' name='$master_drgiss' id='$master_drgiss' value=\"$myrow[10]\">";
		echo "<input type='hidden' name='$master_cos' id='$master_cos' value=\"$myrow[19]\">";
  echo"<input type=\"hidden\" size=\"8%\" id=\"$as_crn_type\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" name=\"$as_crn_type\" value=\"Assembly\">";
  /* echo"<input type=\"hidden\" size=\"8%\" id=\"$as_crn_treat\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" name=\"$as_crn_treat\" value=\"Assembly\">";*/
       $z++;
      }
      $flag_assy=1;
    }
    if($z<=3)
    {
     printf('<tr bgcolor="#FFFFFF">');
        $as_linenumber="as_linenum" . $z;
        $as_itemno="as_itemno" . $z;
        $as_partno="as_partno" . $z;
        $as_crn="as_crn" . $z;
        $as_partname="as_partname" . $z;
        $as_partiss="as_partiss" . $z;
		    $as_cos="as_cos" . $z;

        $as_drgiss="as_drgiss" . $z;
        $as_mpsnum="as_mpsnum" . $z;
        $as_mpsrev="as_mpsrev" . $z;
        $as_attach="as_attach" . $z;
        $as_qpa="as_qpa" . $z;
        $as_crn_type="as_crn_type" . $z;
        // $as_crn_treat="as_crn_treat" . $z;

        $as_prevlinenum="prev_line_num_assy" . $z;
        $as_lirecnum="lirecnum_assy" . $z;

		$master_partiss="master_partiss" . $z;
		$master_drgiss="master_drgiss" . $z;	
		$master_cos="master_cos" . $z;

        echo "<input type=\"hidden\" id=\"$as_prevlinenum\" name=\"$as_prevlinenum\" value=\"\">";
        echo "<input type=\"hidden\" id=\"$as_lirecnum\" name=\"$as_lirecnum\" value=\"\">";

        echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$as_linenumber\" name=\"$as_linenumber\"  value=\"\" size=\"2%\"></td>";
        echo "<td><input type=\"text\" id=\"$as_itemno\" name=\"$ias_temno\" size=\"5%\" value=\"\"></td>";
      

        echo "<td width=\"5%\"><input type=\"text\" id=\"$as_crn\" name=\"$as_crn\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"\">";
        echo "<img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"GetCIM_sassy('$z')\"></td>";
        echo "<td><input type=\"text\" id=\"$as_partno\" name=\"$as_partno\" size=\"18%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";

        echo "<td><input type=\"text\" id=\"$as_partname\" name=\"$as_partname\" id=\"$as_partname\" size=\"18%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\">";

        echo "<td><input type=\"text\" id=\"$as_partiss\" name=\"$as_partiss\" size=\"15%\" value=\"\"></td>";
		echo "<td><input type=\"text\" id=\"$as_cos\" name=\"$as_cos\" size=\"12%\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$as_drgiss\" name=\"$as_drgiss\" size=\"12%\" value=\"\"></td>";


        echo "<td><input type=\"text\" id=\"$as_mpsnum\" name=\"$as_mpsnum\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$as_mpsrev\" name=\"$as_mpsrev\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
       // echo "<td><input type=\"text\" id=\"$as_attach\" name=\"$as_attach\" size=\"12%\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$as_qpa\" name=\"$as_qpa\" size=\"3%\" value=\"\"></td>";
        printf('</tr>');

		
		echo "<input type='hidden' name='$master_partiss' id='$master_partiss' value=\"\">";
		echo "<input type='hidden' name='$master_drgiss' id='$master_drgiss' value=\"\">";
		echo "<input type='hidden' name='$master_cos' id='$master_cos' value=\"\">";
    echo"<input type=\"hidden\" size=\"8%\" id=\"$as_crn_type\" name=\"$as_crn_type\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"Assembly\">";
      /*  echo"<input type=\"hidden\" size=\"8%\" id=\"$as_crn_treat\" name=\"$as_crn_treat\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"Assembly\">";*/
        $z++;
    }
   }
echo "<input type=\"hidden\" name=\"index_assy\" value=$z>";
echo "<input type=\"hidden\" name=\"curindex_assy\" value=$z>";
?>
</table>
<table border=0 bgcolor="#DFDEDF" style="width:1305px" cellspacing=1 cellpadding=3 class="stdtable">
<tr bgcolor="#DDDDD"><td colspan=12><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td>
<td colspan=5 align="left"><span class="heading"><b>Type = Non Assembly</b></td>
<td colspan=7 align="left"><span class="heading"><b>Untreated Items</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
<thead>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Line</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Item No</b></th>
<!--<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>PRN Type</b></th>-->
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part #</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Part Name</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part Issue/Attachments</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>COS</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>DRG Iss</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Mps#</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Mps Rev</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>QPA</b></th>
</tr>
</thead>

<?php

 $i=1;
 $flag=0;
 $result_mfg = $newBOMLI_mfg->get_Mfg_li($bomrecnum);
   while ($i<=3)
   {
    if($flag == 0)
    {
      while ($myLI_mfg = mysql_fetch_row($result_mfg))
      {
	    printf('<tr bgcolor="#FFFFFF">');
        $linenumber="linenum" . $i;
        $itemno="itemno" . $i;
        $partno="partno" . $i;
        $crn="crn" . $i;
        $partname="partname" . $i;
        $partiss="partiss" . $i;
        $drgiss="drgiss" . $i;
        $mpsnum="mpsnum" . $i;
        $mpsrev="mpsrev" . $i;
        $attach="attach" . $i;
        $qpa="qpa" . $i;
        $crn_type="crn_type" . $i;
        // $crn_treat="crn_treat" . $i;
        $prevlinenum="prev_line_num_mfg" . $i;
        $lirecnum="lirecnum_mfg" . $i;
		$cos="cos" . $i;

		$maf_partiss="maf_partiss" . $i;
		$maf_drgiss="maf_drgiss" . $i;
		$maf_cos="maf_cos" . $i;

        echo "<input type=\"hidden\" id=\"$prevlinenum\" name=\"$prevlinenum\" value=\"$myLI_mfg[1]\">";
        echo "<input type=\"hidden\" id=\"$lirecnum\" name=\"$lirecnum\" value=\"$myLI_mfg[0]\">";

        echo "<td><span class=\"tabletext\"><input type=\"text\"  id=\"$linenumber\" name=\"$linenumber\"  value=\"$myLI_mfg[1]\" size=\"2%\"></td>";
        echo "<td><input type=\"text\" id=\"$itemno\" name=\"$itemno\" size=\"5%\" value=\"$myLI_mfg[2]\"></td>";
               $selected = 'selected';
     

        echo "<td width=\"5%\"><input type=\"text\" id=\"$crn\" name=\"$crn\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI_mfg[4]\">";
        echo "<img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"GetCIM('$i')\"></td>";
        echo "<td><input type=\"text\" id=\"$partno\" name=\"$partno\" size=\"18%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_mfg[3]\"></td>";
        echo "<td><input type=\"text\" id=\"$partname\" name=\"$partname\" id=\"$partname\" size=\"18%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_mfg[5]\">";

        echo "<td><input type=\"text\" id=\"$partiss\" name=\"$partiss\" size=\"15%\" value=\"$myLI_mfg[6]\"></td>";
		 echo "<td><input type=\"text\" id=\"$cos\" name=\"$cos\" size=\"15%\" value=\"$myLI_mfg[13]\"></td>";
        echo "<td><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\" size=\"12%\" value=\"$myLI_mfg[7]\"></td>";

        echo "<td><input type=\"text\" id=\"$mpsnum\" name=\"$mpsnum\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_mfg[10]\"></td>";
        echo "<td><input type=\"text\" id=\"$mpsrev\" name=\"$mpsrev\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_mfg[11]\"></td>";
        //echo "<td><input type=\"text\" id=\"$attach\" name=\"$attach\" size=\"12%\" value=\"$myLI_mfg[8]\"></td>";
        echo "<td><input type=\"text\" id=\"$qpa\" name=\"$qpa\" size=\"3%\" value=\"$myLI_mfg[9]\"></td>";

		   $result1 = $newBOMLI_subassy->getcrnDetails4bommfg_edit($myLI_mfg[4],$myLI_mfg[12]);
	   $myrow = mysql_fetch_row($result1);


        echo "<input type='hidden' name='$maf_partiss' id='$maf_partiss' value=\"$myLI_mfg[6]\">";
		echo "<input type='hidden' name='$maf_drgiss' id='$maf_drgiss' value=\"$myLI_mfg[7]\">";
		echo "<input type='hidden' name='$maf_cos' id='$maf_cos' value=\"$myLI_mfg[13]\">";
    echo"<input type=\"hidden\" size=\"10%\" id=\"$crn_type\" name=\"$crn_type\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"Untreated\">
           ";
          /* echo"<input type=\"hidden\" size=\"10%\" id=\"$crn_treat\" name=\"$crn_treat\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"Non Assembly\">
           ";*/
        printf('</tr>');
       $i++;
      }
      $flag=1;
    }
    if($i<=3)
    {
     printf('<tr bgcolor="#FFFFFF">');
        $linenumber="linenum" . $i;
        $itemno="itemno" . $i;
        $partno="partno" . $i;
        $crn="crn" . $i;
        $partname="partname" . $i;
        $partiss="partiss" . $i;
        $drgiss="drgiss" . $i;
        $mpsnum="mpsnum" . $i;
        $mpsrev="mpsrev" . $i;
        $attach="attach" . $i;
        $qpa="qpa" . $i;
        $crn_type="crn_type" . $i;
        // $crn_treat="crn_treat" . $i;
		    $cos="cos" . $i;

			$maf_partiss="maf_partiss" . $i;
		$maf_drgiss="maf_drgiss" . $i;
		$maf_cos="maf_cos" . $i;

        $prevlinenum="prev_line_num_mfg" . $i;
        $lirecnum="lirecnum_mfg" . $i;

        echo "<input type=\"hidden\" id=\"$prevlinenum\" name=\"$prevlinenum\" value=\"\">";
        echo "<input type=\"hidden\" id=\"$lirecnum\" name=\"$lirecnum\" value=\"\">";

        echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\" name=\"$linenumber\"  value=\"\" size=\"2%\"></td>";
        echo "<td><input type=\"text\" id=\"$itemno\" name=\"$itemno\" size=\"5%\" value=\"\"></td>";
     
        echo "<td width=\"5%\"><input type=\"text\" id=\"$crn\" name=\"$crn\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"\">";
        echo "<img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"GetCIM('$i')\"></td>";
        echo "<td><input type=\"text\" id=\"$partno\" name=\"$partno\" size=\"18%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$partname\" name=\"$partname\" id=\"$partname\" size=\"18%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\">";

        echo "<td><input type=\"text\" id=\"$partiss\" name=\"$partiss\" size=\"15%\"  value=\"\"></td>";
		echo "<td><input type=\"text\" id=\"$cos\" name=\"$cos\" size=\"15%\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\" size=\"12%\" value=\"\"></td>";

        echo "<td><input type=\"text\" id=\"$mpsnum\" name=\"$mpsnum\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$mpsrev\" name=\"$mpsrev\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        //echo "<td><input type=\"text\" id=\"$attach\" name=\"$attach\" size=\"12%\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$qpa\" name=\"$qpa\" size=\"3%\" value=\"\"></td>";
        printf('</tr>');

		echo "<input type='hidden' name='$maf_partiss' id='$maf_partiss' value=\"\">";
		echo "<input type='hidden' name='$maf_drgiss' id='$maf_drgiss' value=\"\">";
		echo "<input type='hidden' name='$maf_cos' id='$maf_cos' value=\"\">";
    echo"<input type=\"hidden\" size=\"10%\" id=\"$crn_type\" name=\"$crn_type\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"Untreated\">
      ";
    /*  echo"<input type=\"hidden\" size=\"10%\" id=\"$crn_treat\" name=\"$crn_treat\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"Non Assembly\">
      ";*/
        $i++;
    }
   }
echo "<input type=\"hidden\" name=\"index\" value=$i>";
echo "<input type=\"hidden\" name=\"curindex\" value=$i>";
  
?>
</tr>
</table>


<table border=0 bgcolor="#DFDEDF" style="width:1305px" cellspacing=1 cellpadding=3 class="stdtable">
<tr bgcolor="#DDDDD"><td colspan=12><a href="javascript:addRow('myTable_treated',document.forms[0].index_treated.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td>
<td colspan=5 align="left"><span class="heading"><b>Type = Non Assembly</b></td>
<td colspan=7 align="left"><span class="heading"><b>Treated Items</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable_treated" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
<thead>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Line</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Item No</b></th>
<!--<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>PRN Type</b></th>-->
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part #</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Part Name</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part Issue/Attachments</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>COS</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>DRG Iss</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Mps#</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Mps Rev</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>QPA</b></th>
</tr>
</thead>

<?php

 $m=1;
 $flag=0;
 $result_tr= $newBOMLI_treat->get_treated_li($bomrecnum);
   while ($m<=3)
   {
    if($flag == 0)
    {
      while ($myLI_tr = mysql_fetch_row($result_tr))
      {
      printf('<tr bgcolor="#FFFFFF">');
        $tr_linenumber="tr_linenum" . $m;
        $tr_itemno="tr_itemno" . $m;
        $tr_partno="tr_partno" . $m;
        $tr_crn="tr_crn" . $m;
        $tr_partname="tr_partname" . $m;
        $tr_partiss="tr_partiss" . $m;
        $tr_drgiss="tr_drgiss" . $m;
        $tr_cos="tr_cos" . $m;
        $tr_mpsnum="tr_mpsnum" . $m;
        $tr_mpsrev="tr_mpsrev" . $m;
        $tr_attach="tr_attach" . $m;
        $tr_qpa="tr_qpa" . $m;
        $tr_crn_type="tr_crn_type" . $m;
         // $tr_crn_treat="tr_crn_treat" . $m;
        $tr_prevlinenum="tr_prev_line_num" . $m;
        $tr_lirecnum="tr_lirecnum" . $m;
        $partiss_tr="partiss_tr" . $m;
        $drgiss_tr="drgiss_tr" . $m;
        $cos_tr="cos_tr" . $m;

        echo "<input type=\"hidden\" id=\"$tr_prevlinenum\" name=\"$tr_prevlinenum\" value=\"$myLI_tr[1]\">";
        echo "<input type=\"hidden\" id=\"$tr_lirecnum\" name=\"$tr_lirecnum\" value=\"$myLI_tr[0]\">";

        echo "<td><span class=\"tabletext\"><input type=\"text\"  id=\"$tr_linenumber\" name=\"$tr_linenumber\"  value=\"$myLI_tr[1]\" size=\"2%\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_itemno\" name=\"$tr_itemno\" size=\"5%\" value=\"$myLI_tr[2]\"></td>";
               $selected = 'selected';
     

        echo "<td width=\"5%\"><input type=\"text\" id=\"$tr_crn\" name=\"$tr_crn\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI_tr[4]\">";
        echo "<img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"GetCIM_treated('$m')\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_partno\" name=\"$tr_partno\" size=\"18%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_tr[3]\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_partname\" name=\"$tr_partname\" id=\"$partname\" size=\"18%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_tr[5]\">";

        echo "<td><input type=\"text\" id=\"$tr_partiss\" name=\"$tr_partiss\" size=\"15%\" value=\"$myLI_tr[6]\"></td>";
     echo "<td><input type=\"text\" id=\"$tr_cos\" name=\"$tr_cos\" size=\"15%\" value=\"$myLI_tr[13]\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_drgiss\" name=\"$tr_drgiss\" size=\"12%\" value=\"$myLI_tr[7]\"></td>";

        echo "<td><input type=\"text\" id=\"$tr_mpsnum\" name=\"$tr_mpsnum\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_tr[10]\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_mpsrev\" name=\"$tr_mpsrev\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_tr[11]\"></td>";
        //echo "<td><input type=\"text\" id=\"$attach\" name=\"$attach\" size=\"12%\" value=\"$myLI_mfg[8]\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_qpa\" name=\"$tr_qpa\" size=\"3%\" value=\"$myLI_tr[9]\"></td>";

       $result1 = $newBOMLI_subassy->getcrnDetails4bommfg_edit($myLI_tr[4],$myLI_tr[12]);
     $myrow = mysql_fetch_row($result1);


        echo "<input type='hidden' name='$partiss_tr' id='$partiss_tr' value=\"$myLI_tr[6]\">";
    echo "<input type='hidden' name='$drgiss_tr' id='$drgiss_tr' value=\"$myLI_tr[7]\">";
    echo "<input type='hidden' name='$cos_tr' id='$cos_tr' value=\"$myLI_tr[13]\">";
    echo"<input type=\"hidden\" size=\"10%\" id=\"$tr_crn_type\" name=\"$tr_crn_type\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"Treated\">
           ";
            /*echo"<input type=\"hidden\" size=\"10%\" id=\"$tr_crn_treat\" name=\"$tr_crn_treat\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"Non Assembly\">
           ";*/
        printf('</tr>');
       $m++;
      }
      $flag=1;
    }
    if($m<=3)
    {
     printf('<tr bgcolor="#FFFFFF">');
        $tr_linenumber="tr_linenum" . $m;
        $tr_itemno="tr_itemno" . $m;
        $tr_partno="tr_partno" . $m;
        $tr_crn="tr_crn" . $m;
        $tr_partname="tr_partname" . $m;
        $tr_partiss="tr_partiss" . $m;
        $tr_drgiss="tr_drgiss" . $m;
        $tr_cos="tr_cos" . $m;
        $tr_mpsnum="tr_mpsnum" . $m;
        $tr_mpsrev="tr_mpsrev" . $m;
        $tr_attach="tr_attach" . $m;
        $tr_qpa="tr_qpa" . $m;
        $tr_crn_type="tr_crn_type" . $m;
        // $tr_crn_treat="tr_crn_treat" . $m;
        $tr_prevlinenum="tr_prev_line_num" . $m;
        $tr_lirecnum="tr_lirecnum" . $m;
        $partiss_tr="partiss_tr" . $m;
        $drgiss_tr="drgiss_tr" . $m;
        $cos_tr="cos_tr" . $m;
        echo "<input type=\"hidden\" id=\"$tr_prevlinenum\" name=\"$tr_prevlinenum\" value=\"\">";
        echo "<input type=\"hidden\" id=\"$tr_lirecnum\" name=\"$tr_lirecnum\" value=\"\">";

        echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$tr_linenumber\" name=\"$tr_linenumber\"  value=\"\" size=\"2%\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_itemno\" name=\"$tr_itemno\" size=\"5%\" value=\"\"></td>";
     
        echo "<td width=\"5%\"><input type=\"text\" id=\"$tr_crn\" name=\"$tr_crn\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"\">";
        echo "<img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"GetCIM_treated('$m')\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_partno\" name=\"$tr_partno\" size=\"18%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_partname\" name=\"$tr_partname\" id=\"$partname\" size=\"18%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\">";

        echo "<td><input type=\"text\" id=\"$tr_partiss\" name=\"$tr_partiss\" size=\"15%\"  value=\"\"></td>";
    echo "<td><input type=\"text\" id=\"$tr_cos\" name=\"$tr_cos\" size=\"15%\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_drgiss\" name=\"$tr_drgiss\" size=\"12%\" value=\"\"></td>";

        echo "<td><input type=\"text\" id=\"$tr_mpsnum\" name=\"$tr_mpsnum\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_mpsrev\" name=\"$tr_mpsrev\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        //echo "<td><input type=\"text\" id=\"$attach\" name=\"$attach\" size=\"12%\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_qpa\" name=\"$tr_qpa\" size=\"3%\" value=\"\"></td>";
        printf('</tr>');

    echo "<input type='hidden' name='$partiss_tr' id='$partiss_tr' value=\"\">";
    echo "<input type='hidden' name='$drgiss_tr' id='$drgiss_tr' value=\"\">";
    echo "<input type='hidden' name='$cos_tr' id='$cos_tr' value=\"\">";
    echo"<input type=\"hidden\" size=\"10%\" id=\"$tr_crn_type\" name=\"$tr_crn_type\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"Treated\">
      ";
       /*echo"<input type=\"hidden\" size=\"10%\" id=\"$tr_crn_treat\" name=\"$tr_crn_treat\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"Non Assembly\">
      ";*/
        $m++;
    }
   }
echo "<input type=\"hidden\" name=\"index_treated\" value=$i>";
echo "<input type=\"hidden\" name=\"curindex_treated\" value=$i>";
  
?>
<table border=0 bgcolor="#DFDEDF" style="width:1305px" cellspacing=1 cellpadding=3 class="stdtable">
<tr bgcolor="#DDDDD"><td><a href="javascript:addRow_bo('myTable_bo',document.forms[0].boindex.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td>
<td colspan=11 align="left"><span class="heading"><b>Bought Out Items&nbsp;&nbsp;&nbsp;</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable_bo" style="width:1305px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
  <thead>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Line</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Item No</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part #</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Description</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part Issue/Attachments</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>DRG #</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Issue</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Make/Supplier</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>QPA</b></th>
</tr>
</thead>
<?php

$j=1;
$flag=0;
$result_bo = $newBOMLI_bought->getLi($bomrecnum);
      while ($j<=3)
      {
       if($flag==0)
       {
        while($myLi_bo = mysql_fetch_row($result_bo))
        {
	     printf('<tr bgcolor="#FFFFFF">');
         $bo_linenumber="bo_linenum" . $j;
         $bo_itemno="bo_itemno" . $j;
         $bo_desc="bo_desc" . $j;
         $bo_partnum="bo_partnum" . $j;
         $bo_partiss="bo_partiss" . $j;
         $bo_drgno="bo_drgno" . $j;
         $bo_issue="bo_issue" . $j;
         $bo_supp="bo_supp" . $j;
         $bo_qpa="bo_qpa" . $j;

         $prevlinenum="prev_line_num_bo" . $j;
         $lirecnum="lirecnum_bo" . $j;

         echo "<input type=\"hidden\" id=\"$prevlinenum\" name=\"$prevlinenum\" value=\"$myLi_bo[1]\">";
         echo "<input type=\"hidden\" id=\"$lirecnum\" name=\"$lirecnum\" value=\"$myLi_bo[0]\">";
         echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$bo_linenumber\"  value=\"$myLi_bo[1]\" size=\"3%\"></td>";
         echo "<td><input type=\"text\" id=\"$bo_itemno\" name=\"$bo_itemno\" size=\"5%\" value=\"$myLi_bo[2]\"></td>";
         echo "<td width=\"5%\"><input type=\"text\" id=\"$bo_partnum\" name=\"$bo_partnum\" size=\"12%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLi_bo[7]\">";
         echo "<img src=\"images/bu-get.gif\" alt=\"Get Part\" onclick=\"GetPart('$j','Bought Out')\"></td>";
         echo "<td><input type=\"text\" id=\"$bo_desc\" name=\"$bo_desc\" size=\"18%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLi_bo[3]\"></td>";
         echo "<td><input type=\"text\" id=\"$bo_partiss\" name=\"$bo_partiss\"  size=\"12%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLi_bo[8]\">";
         echo "<td><input type=\"text\" id=\"$bo_drgno\" name=\"$bo_drgno\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLi_bo[4]\"></td>";
         echo "<td><input type=\"text\" id=\"$bo_issue\" name=\"$bo_issue\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLi_bo[5]\"></td>";
         echo "<td><input type=\"text\" id=\"$bo_supp\" name=\"$bo_supp\" size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLi_bo[6]\"></td>";
         echo "<td><input type=\"text\" id=\"$bo_qpa\" name=\"$bo_qpa\" size=\"5%\" value=\"$myLi_bo[9]\"></td>";
        printf('</tr>');		 
	    $j++;
	   }
	   $flag=1;
      }
      if($j<=3)
      {
        printf('<tr bgcolor="#FFFFFF">');
         $bo_linenumber="bo_linenum" . $j;
         $bo_itemno="bo_itemno" . $j;
         $bo_desc="bo_desc" . $j;
         $bo_partnum="bo_partnum" . $j;
         $bo_partiss="bo_partiss" . $j;
         $bo_drgno="bo_drgno" . $j;
         $bo_issue="bo_issue" . $j;
         $bo_supp="bo_supp" . $j;
         $bo_qpa="bo_qpa" . $j;

         $prevlinenum="prev_line_num_bo" . $j;
         $lirecnum="lirecnum_bo" . $j;

        echo "<input type=\"hidden\" id=\"$prevlinenum\" name=\"$prevlinenum\" value=\"\">";
        echo "<input type=\"hidden\" id=\"$lirecnum\" name=\"$lirecnum\" value=\"\">";

        echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$bo_linenumber\" name=\"$bo_linenumber\"  value=\"\" size=\"3%\"></td>";

        echo "<td><input type=\"text\" id=\"$bo_itemno\" name=\"$bo_itemno\" size=\"5%\" value=\"\"></td>";
        echo "<td width=\"5%\"><input type=\"text\" id=\"$bo_partnum\" name=\"$bo_partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"12%\" value=\"\">";
        echo "<img src=\"images/bu-get.gif\" alt=\"Get Part\" onclick=\"GetPart('$j','Bought Out')\"></td>";
         echo "<td><input type=\"text\" id=\"$bo_desc\" name=\"$bo_desc\" size=\"18%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$bo_partiss\" name=\"$bo_partiss\" size=\"12%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";

        echo "<td><input type=\"text\" id=\"$bo_drgno\" name=\"$bo_drgno\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$bo_issue\" name=\"$bo_issue\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$bo_supp\"  name=\"$bo_supp\" size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$bo_qpa\" name=\"$bo_qpa\" size=\"5%\" value=\"\"></td>";
        printf('</tr>');
	    $j++;		 
      }
     }
echo "<input type=\"hidden\" name=\"boindex\" value=$j>";
echo "<input type=\"hidden\" name=\"bocurindex\" value=$j>";

?>
<table border=0 bgcolor="#DFDEDF" style="width:1305px" cellspacing=1 cellpadding=3 class="stdtable">
<tr bgcolor="#DDDDD"><td><a href="javascript:addRow_co('myTable_co',document.forms[0].coindex.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td>
<td colspan=11 align="left"><span class="heading"><b>Consummables&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable_co" style="width:1305px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
  <thead>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Line</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Item No</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part #</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Description</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Issue</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Make/Suppler</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Specification</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>QPA</b></th>
</tr>
</thead>
<?php

$k=1;
$flag=0;
$result_consumables = $newBOMLI_consume->getLi($bomrecnum);
      while ($k<=3)
      {
       if($flag==0)
       {
        while($myLi_consume = mysql_fetch_row($result_consumables))
        {
         printf('<tr bgcolor="#FFFFFF">');
         $co_linenumber="co_linenum" . $k;
         $co_itemno="co_itemno" . $k;
         $co_desc="co_desc" . $k;
         $co_spec="co_spec" . $k;
         $co_issue="co_issue" . $k;
         $co_supp="co_supp" . $k;
         $co_qpa="co_qpa" . $k;
		 $co_partnum="co_partnum" . $k;

         $prevlinenum="prev_line_num_co" . $k;
         $lirecnum="lirecnum_co" . $k;

         echo "<input type=\"hidden\" id=\"$prevlinenum\" name=\"$prevlinenum\" value=\"$myLi_consume[1]\">";
         echo "<input type=\"hidden\" id=\"$lirecnum\" name=\"$lirecnum\" value=\"$myLi_consume[0]\">";
         echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$co_linenumber\" name=\"$co_linenumber\"  value=\"$myLi_consume[1]\" size=\"3%\"></td>";
         echo "<td width=\"5%\"><input type=\"text\" id=\"$co_itemno\" name=\"$co_itemno\" size=\"11%\" value=\"$myLi_consume[2]\"></td>";
		  echo "<td width=\"5%\"><input type=\"text\" id=\"$co_partnum\" name=\"$co_partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"12%\" value=\"$myLi_consume[9]\">";
        echo "<img src=\"images/bu-get.gif\" alt=\"Get Part\" onclick=\"GetPart('$k','Consummables')\"></td>";

         echo "<td><input type=\"text\" id=\"$co_desc\" name=\"$co_desc\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"25%\" value=\"$myLi_consume[3]\"></td>";
        
         echo "<td><input type=\"text\" id=\"$co_issue\" name=\"$co_issue\" id=\"$co_issue\" size=\"8%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLi_consume[5]\">";
         echo "<td><input type=\"text\" id=\"$co_supp\" name=\"$co_supp\" size=\"17%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLi_consume[6]\"></td>";
		  echo "<td><input type=\"text\" id=\"$co_spec\" name=\"$co_spec\" size=\"13%\" value=\"$myLi_consume[4]\"></td>";
         echo "<td><input type=\"text\" id=\"$co_qpa\" name=\"$co_qpa\" size=\"6%\" value=\"$myLi_consume[7]\"></td>";
         printf('</tr>');	
	     $k++;
	    }
	    $flag=1;
	   }
	   if($k<=3)
	   {		  
	     printf('<tr bgcolor="#FFFFFF">');
         $co_linenumber="co_linenum" . $k;
         $co_itemno="co_itemno" . $k;
         $co_desc="co_desc" . $k;
         $co_spec="co_spec" . $k;
         $co_issue="co_issue" . $k;
         $co_supp="co_supp" . $k;
         $co_qpa="co_qpa" . $k;
		 $co_partnum="co_partnum" . $k;

         $prevlinenum="prev_line_num_co" . $k;
         $lirecnum="lirecnum_co" . $k;

         echo "<input type=\"hidden\" id=\"$prevlinenum\" name=\"$prevlinenum\" value=\"\">";
         echo "<input type=\"hidden\" id=\"$lirecnum\" name=\"$lirecnum\" value=\"\">";

         echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$co_linenumber\"  value=\"\" size=\"3%\"></td>";
         echo "<td><input type=\"text\" name=\"$co_itemno\" size=\"11%\" value=\"\"></td>";
		 echo "<td width=\"5%\"><input type=\"text\" id=\"$co_partnum\" name=\"$co_partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"12%\" value=\"\">";

         echo "<img src=\"images/bu-get.gif\" alt=\"Get Part\" onclick=\"GetPart('$k','Consummables')\"></td>";
         echo "<td><input type=\"text\" name=\"$co_desc\" id=\"$co_desc\" size=\"25%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  value=\"\"></td>";         
         echo "<td><input type=\"text\" name=\"$co_issue\" id=\"$co_issue\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"8%\" value=\"\">";
         echo "<td><input type=\"text\" id=\"$co_supp\" name=\"$co_supp\" size=\"17%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
		  echo "<td><input type=\"text\" id=\"$co_spec\" name=\"$co_spec\" size=\"13%\" value=\"\"></td>";
         echo "<td><input type=\"text\" id=\"$co_qpa\" name=\"$co_qpa\" size=\"6%\" value=\"\"></td>";
         printf('</tr>');		
	     $k++;		
	   }
      }	
echo "<input type=\"hidden\" name=\"coindex\" value=$k>";
echo "<input type=\"hidden\" name=\"cocurindex\" value=$k>";
?>
<table border=0 bgcolor="#DFDEDF" style="width:1305px" cellspacing=1 cellpadding=3 class="stdtable">
<tr bgcolor="#DDDDD"><td><a href="javascript:addRow_op('myTable_op',document.forms[0].opindex.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td>
<td colspan=11 align="left"><span class="heading"><b>Operation Details</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable_op" style="width:1305px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
<thead>
<th class="head0" width="6%" bgcolor="#EEEFEE"><span class="heading"><b>Opn#</b></th>
<th class="head1" width="12%" bgcolor="#EEEFEE"><span class="heading"><b>Stn</b></th>
<th class="head0" width="20%" bgcolor="#EEEFEE"><span class="heading"><b>Operation Description</b></th>
<th class="head1" width="12%" bgcolor="#EEEFEE"><span class="heading"><b>Sign Off</b></th>
<th class="head0" width="18%" bgcolor="#EEEFEE"><span class="heading"><b>Remarks</b></th>
</tr>
</thead>
<?php

$l=1;
$flag=0;
$result_oper = $newBOM_oper->getLI($bomrecnum);
      while ($l<=3)
      {
       if($flag==0)
       {
        while($myLi_oper = mysql_fetch_row($result_oper))
        {
          printf('<tr bgcolor="#FFFFFF">');
          $opn="opn" . $l;
          $stn="stn" . $l;
          $desc="desc" . $l;
          $signoff="signoff" . $l;
          $remarks="remarks" . $l;

         $prevlinenum="prev_line_num_op" . $l;
         $lirecnum="lirecnum_op" . $l;

         echo "<input type=\"hidden\" id=\"$prevlinenum\" name=\"$prevlinenum\" value=\"$myLi_oper[1]\">";
         echo "<input type=\"hidden\" id=\"$lirecnum\" name=\"$lirecnum\" value=\"$myLi_oper[0]\">";
         echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$opn\" name=\"$opn\"  value=\"$myLi_oper[1]\" size=\"3%\"></td>";
         echo "<td width=\"5%\"><input type=\"text\" id=\"$stn\" name=\"$stn\" size=\"15%\" value=\"$myLi_oper[2]\"></td>";
         echo "<td><input type=\"text\" id=\"$desc\" name=\"$desc\" size=\"48%\" value=\"$myLi_oper[3]\"></td>";
         echo "<td><input type=\"text\" id=\"$signoff\" name=\"$signoff\" size=\"16%\" value=\"$myLi_oper[4]\"></td>";
         echo "<td><input type=\"text\" id=\"$remarks\" name=\"$remarks\"size=\"42%\" value=\"$myLi_oper[5]\">";
         printf('</tr>');
	     $l++;
	    }
	    $flag=1;
	   }
	   if($l<=3)
	   {
	      printf('<tr bgcolor="#FFFFFF">');
          $opn="opn" . $l;
          $stn="stn" . $l;
          $desc="desc" . $l;
          $signoff="signoff" . $l;
          $remarks="remarks" . $l;

         $prevlinenum="prev_line_num_op" . $l;
         $lirecnum="lirecnum_op" . $l;

         echo "<input type=\"hidden\" id=\"$prevlinenum\" name=\"$prevlinenum\" value=\"\">";
         echo "<input type=\"hidden\" id=\"$lirecnum\" name=\"$lirecnum\" value=\"\">";
         echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$opn\" name=\"$opn\"  value=\"\" size=\"3%\"></td>";
         echo "<td width=\"5%\"><input type=\"text\" id=\"$stn\" name=\"$stn\" size=\"15%\" value=\"\"></td>";
         echo "<td><input type=\"text\" id=\"$desc\" name=\"$desc\" size=\"48%\" value=\"\"></td>";
         echo "<td><input type=\"text\" id=\"$signoff\" name=\"$signoff\" size=\"12%\" value=\"\"></td>";
         echo "<td><input type=\"text\" id=\"$remarks\" name=\"$remarks\"size=\"42%\" value=\"\">";
         printf('</tr>');
	     $l++;
	   }
      }
echo "<input type=\"hidden\" name=\"opindex\" value=$l>";
echo "<input type=\"hidden\" name=\"opcurindex\" value=$l>";
?>
</table>
</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>
</td>
</tr>
</table>
          <span class="tabletext"><input type="submit"
            style="color=#0066CC;background-color:#DDDDDD;width=130;"
            value="Submit" name="submit" onclick="javascript: return check_req_fields()">
             <INPUT TYPE="RESET"
                 style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">
</FORM>
</body>
</html>
