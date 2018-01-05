<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = March 6,05                   =
// Filename: printBOM.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows entry of new BOMs                    =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'bomdetails';
//////session_register('pagename');
$userrole = $_SESSION['userrole'];
$bomrecnum = $_REQUEST['bomrecnum'];
// First include the class definition
include('classes/displayClass.php');
include('classes/bomClass.php');
include('classes/bomli_mfgClass.php');
include('classes/bomli_boughtClass.php');
include('classes/bomli_consumeClass.php');
include('classes/bomli_opnClass.php');
include('classes/bom_subassyClass.php');

// Next, create an instance of the classes required
$newBOM = new bom;
$newBOMLI_mfg = new bomli_mfg_items;
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
<title></title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr>
<?php
$result = $newBOM->getBOMs($bomrecnum);
$myrow = mysql_fetch_assoc($result);
?>
<tr><td><center><span class="style16"><A HREF="javascript:window.print()"><?php echo "BOM Details" ?></A></center></td</tr>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr><td bgcolor="#DDDDD"  align="center"><span class="heading"><b>General Information</b></td></tr>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=20%><span class="labeltext"><p align="left">*BOM Ref#</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["bomnum"]?></td>
</td>
<input type="hidden" name ="bomrecnum" value="<?php echo $myrow["recnum"] ?>">
<td width="20%"><span class="labeltext"><p align="left">BOM REV#</p></td>
<td width="30%"><span class="tabletext"><?php echo $myrow["bom_revnum"]?></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=20%><span class="labeltext"><p align="left">PRN</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["crn"]?></td>
<td width=20%><span class="labeltext"><p align="left">Assy Part No.</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["assy_partnum"]?></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=20%><span class="labeltext"><p align="left">Title</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["title"]?></td>
<td width=20%><span class="labeltext"><p align="left"> Drg Issue</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["issue"]?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=20%><span class="labeltext"><p align="left">COS Iss</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["cos_no"]?></td>
<td width=20%><span class="labeltext"><p align="left">COS Iss Dt.</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["cos_iss"]?></td>
</td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=20%><span class="labeltext"><p align="left">DRG No</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["drg_no"]?></td>
<td width=20%><span class="labeltext"><p align="left">Part Issue/Attachments</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["partiss"]?></td>
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
                         <input type="hidden" name="eng_app" value="<?php echo $myrow["eng_app"]?>" id="eng_app"></td>
            <td><span class="labeltext">Engineering Approved By</td>
            <td><span class="tabletext"><?php echo $myrow["eng_app_by"] ." , ". $eng_date ?></td>

          </tr>
</table>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDDD"><td colspan=12 align="center"><span class="heading"><b>Sub Assembly</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Item No</b></td>
<td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Part #</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>PRN type</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>PRN</b></td>
<td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Part Name</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>Part Issue<br>Attachments</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>DRG Iss</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>Mps#</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>Mps Rev</b></td>

<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>QPA</b></td>
</tr>

<?php


 $result_assy = $newBOMLI_subassy->get_subassy_li($bomrecnum);

      while ($myLI_subassy = mysql_fetch_assoc($result_assy))
      {
      $line_asy = $myLI_subassy['line_num'];
      $item_asy = $myLI_subassy['item_no'];
      $partno_asy = $myLI_subassy['partnum'];
      $crn_asy = $myLI_subassy['crn'];
      $partname_asy = $myLI_subassy['partname'];
      $partiss_asy = $myLI_subassy['partiss'];
      $drgiss_asy = $myLI_subassy['drgiss'];
      $attachment_asy = $myLI_subassy['attach'];
      $qpa_asy = $myLI_subassy['qpa'];
      $mpsnum_asy = $myLI_subassy['mpsnum'];
      $mpsrev_asy = $myLI_subassy['mpsrev'];
      $crntype_asy = $myLI_subassy['crn_type'];
	    printf('<tr bgcolor="#FFFFFF">');
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$item_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partno_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crntype_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crn_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partname_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partiss_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drgiss_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mpsnum_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mpsrev_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qpa_asy</td>" ;
        printf('</tr>');

      }

?>
</tr>
</table>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td colspan=12 align="center" bgcolor="#DDDDD"><span class="heading"><b>Manufactured Items</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Item No</b></td>
<td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Part #</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>PRN type</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>PRN</b></td>
<td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Part Name</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>Part Issue<br>Attachments</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>DRG Iss</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>Mps#</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>Mps Rev</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>QPA</b></td>
</tr>

<?php

 $i=1;
 $result_mfg = $newBOMLI_mfg->get_Mfg_li($bomrecnum);
 
      while ($myLi_mfg = mysql_fetch_assoc($result_mfg))
      {
      $line = $myLi_mfg['line_num'];
      $item = $myLi_mfg['item_no'];
      $partno = $myLi_mfg['partnum'];
      $crn = $myLi_mfg['crn'];
      $partname = $myLi_mfg['partname'];
      $partiss = $myLi_mfg['partiss'];
      $drgiss = $myLi_mfg['drgiss'];
      $attachment = $myLi_mfg['attach'];
      $qpa = $myLi_mfg['qpa'];
      $mpsnum = $myLi_mfg['mpsnum'];
      $mpsrev = $myLi_mfg['mpsrev'];
       $crntype = $myLi_mfg['crn_type'];
	    printf('<tr class="bgcolor2" bordercolor="#CCCCCC">');
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$item</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partno</td>" ;
         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crntype</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crn</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partname</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partiss</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drgiss</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mpsnum</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mpsrev</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qpa</td>" ;
        printf('</tr>');

      }

?>
</tr>
</table>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 bordercolor="#000000">
<tr bgcolor="#DDDDD"><td align="center"><span class="heading"><b>Bought Out Items</b></td></tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<table id="myTable_bo" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Item No</b></td>
<td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Description</b></td>
<td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Part #</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Part Iss</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>DRG #</b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Issue</b></td>
<td bgcolor="#EEEFEE" width=25%><span class="heading"><b>Make/Supplier</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>QPA</b></td>
</tr>
<?php
 $result_bo = $newBOMLI_bought->getLi($bomrecnum);
      while ($myLi_bo = mysql_fetch_assoc($result_bo))
      {
	    printf('<tr bgcolor="#FFFFFF">');
       $line = $myLi_bo['line_num'];
       $item = $myLi_bo['item_no'];
       $desc = $myLi_bo['descr'];
       $drgno = $myLi_bo['drg_no'];
       $issue = $myLi_bo['issue'];
       $supp = $myLi_bo['supplier'];
       $partnum = $myLi_bo['partnum'];
       $partiss = $myLi_bo['partiss'];
       $qpa = $myLi_bo['qpa'];

        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$item</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$desc</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partnum</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partiss</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drgno</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$issue</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$supp</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qpa</td>" ;
        printf('</tr>');

      }
?>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 bordercolor="#000000">
<tr bgcolor="#DDDDD"><td align="center"><span class="heading"><b>Consummables</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable_co" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Item No</b></td>
<td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Description</b></td>
<td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Specification</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Issue</b></td>
<td bgcolor="#EEEFEE" width=25%><span class="heading"><b>Make/Suppler</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>QPA</b></td>
</tr>
<?php

 $result_co = $newBOMLI_consume->getLi($bomrecnum);
      while ($myLi_co = mysql_fetch_assoc($result_co))
      {
	    printf('<tr bgcolor="#FFFFFF">');
       $line = $myLi_co['line_num'];
       $item = $myLi_co['item_no'];
       $desc = $myLi_co['descr'];
       $spec = $myLi_co['spec'];
       $issue = $myLi_co['issue'];
       $supp = $myLi_co['supplier'];
       $qpa = $myLi_co['qpa'];
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$item</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$desc</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$spec</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$issue</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$supp</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qpa</td>" ;

        printf('</tr>');

      }
?>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDDD"><td align="center"><span class="heading"><b>Operation Details</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable_op" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td width="6%" bgcolor="#EEEFEE"><span class="heading"><b>Opn#</b></td>
<td width="12%" bgcolor="#EEEFEE"><span class="heading"><b>Stn</b></td>
<td width="20%" bgcolor="#EEEFEE"><span class="heading"><b>Operation Description</b></td>
<td width="12%" bgcolor="#EEEFEE"><span class="heading"><b>Signoff</b></td>
<td width="18%" bgcolor="#EEEFEE"><span class="heading"><b>Remarks</b></td>
</tr>
<?php

 $result_op = $newBOM_oper->getLI($bomrecnum);
      while ($myLi_op = mysql_fetch_assoc($result_op))
      {
	    printf('<tr bgcolor="#FFFFFF">');
       $op = $myLi_op['opn_num'];
       $stn = $myLi_op['stn'];
       $desc = $myLi_op['oper_desc'];
       $so = $myLi_op['signoff'];
       $remarks = $myLi_op['remarks'];
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$op</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$stn</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$desc</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$so</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$remarks</td>" ;
        printf('</tr>');
      }
?>
</table>

