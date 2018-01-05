<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = April 26,2010                =
// Filename: bom_details.php                   =
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
$_SESSION['pagename'] = 'editbomview';
//////session_register('pagename');
$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];
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
<title>BOM Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processBOM.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');

?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
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
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td><span class="heading"><b>BOM Details</b></td></tr>
<tr>
<?php
$result = $newBOM->getBOMs($bomrecnum);
$myrow = mysql_fetch_assoc($result);
?>
<tr>
<td bgcolor="#DDDDD"  align="center"><span class="heading"><b>General Information</b></td></tr>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF" width=100%>
<td width=20%><span class="labeltext"><p align="left">*BOM Ref#</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["bomnum"]?>
<input type="hidden" name ="pagename" value="editbomviewpage"></td>
</td>
<input type="hidden" name ="bomrecnum" value="<?php echo $myrow["recnum"] ?>">
<td width="20%"><span class="labeltext"><p align="left">BOM REV#</p></td>
<td width="30%"><span class="tabletext"><?php echo $myrow["bom_revnum"]?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=20%><span class="labeltext"><p align="left">PRN</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["crn"]?></td>
<td width=20%><span class="labeltext"><p align="left">Assy Part No.</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["assy_partnum"]?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=20%><span class="labeltext"><p align="left">Title</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["title"]?></td>
<td width=20%><span class="labeltext"><p align="left">Issue</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["issue"]?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=20%><span class="labeltext"><p align="left">COS Iss</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["cos_no"]?></td>
<td width=20%><span class="labeltext">&nbsp</td>
<td width=30%><span class="tabletext">&nbsp</td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=20%><span class="labeltext"><p align="left">DRG No</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["drg_no"]?></td>
<td width="20%"><span class="labeltext"><p align="left">BOM Issue</p></td>
<td width="30%"><span class="tabletext"><?php echo $myrow["bom_issue"]?></td>
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

           if($dept=='QA')
           {
            $checked="checked";
        ?>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">QA Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow["eng_app"] == 'yes'?$checked:"" ?>  id="eng_app_1" name="eng_app_1" onclick="JavaScript:toggleValue('eng_app',this);">

          <td><span class="labeltext">QA Approved Date</td>
          <td bgcolor="#FFFFFF"><input type='text' name="eng_app_date" id="eng_app_date" value='<?php echo $myrow["eng_app_date"]; ?>' style="background-color:#DDDDDD;" readonly="readonly"> </td>
           <?php
           } else
           {
           ?>
            <input type="hidden" name="eng_app_date" id="eng_app_date" value="<?php echo $myrow["eng_app_date"]?>">
          <?php
           }
           ?>
                         <input type="hidden" name="eng_app" value="<?php echo $myrow["eng_app"]?>" id="eng_app">

                         <input type="hidden" name="eng_app_by" id="eng_app_by" value="<?php echo $myrow["eng_app_by"]?>">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
                         <input type="hidden" name="prev_status" id="prev_status" size=12 value="<?php echo $myrow["status"]; ?>"></td>

          </tr>
          <?php
          if($dept=='CAD' && $myrow["status"]!='Inactive')
          {
          ?>
           <tr bgcolor="#FFFFFF">

               <td><span class="labeltext"><p align="left">Status</p></font></td>
               <td ><input type='text' name='status' id="status" size=12 value='<?php echo $myrow["status"]; ?>' style="background-color:#DDDDDD;" readonly="readonly">
               <select  name="status_sel" id="status_sel" size="width:150px"  onclick="javascript:onSelectStatus()">
                    <?php $selected = 'selected'; ?>
                   <option value="Active" <?php if($myrow["status"] == 'Active') echo $selected?>>Active</option>
                   <option value="Inactive" <?php if($myrow["status"] == 'Inactive') echo $selected?>>Inactive</option>
                   </select>
                   <td colspan=2></td>
          </tr>
          <?php
          }else
          {
          ?>
           <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">Status</p></font></td>
           <td bgcolor=<?php echo $color ?>><span class="tabletext"><?php echo $myrow["status"] ?></td>
           <td colspan=2></td>
           <?php
           }
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
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>Part Iss</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>COS</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>DRG Iss</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>Mps#</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>Mps Rev</b></td>
<td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Attach</b></td>
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
	  $cos_asy = wordwrap($myLI_subassy['cos'],10,"<br>\n",true);
	    printf('<tr bgcolor="#FFFFFF">');
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$item_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partno_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crntype_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crn_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partname_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partiss_asy</td>" ;
		echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cos_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drgiss_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mpsnum_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mpsrev_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$attachment_asy</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qpa_asy</td>" ;
        printf('</tr>');

      }

?>
</tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDDD"><td colspan=12 align="center"><span class="heading"><b>Manufactured Items</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Item No</b></td>
<td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Part #</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>PRN type</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>PRN</b></td>
<td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Part Name</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>Part Iss</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>COS</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>DRG Iss</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>Mps#</b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b>Mps Rev</b></td>
<td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Attach</b></td>
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
	  $cos = wordwrap($myLi_mfg['cos'],10,"<br>\n",true);
	    printf('<tr bgcolor="#FFFFFF">');
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$item</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partno</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crntype</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crn</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partname</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partiss</td>" ;
		echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cos</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drgiss</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mpsnum</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mpsrev</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$attachment</td>" ;
        echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qpa</td>" ;
        printf('</tr>');

      }

?>
</tr>
</table>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDDD"><td align="center"><span class="heading"><b>Bought Out Items</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable_bo" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
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
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDDD"><td align="center"><span class="heading"><b>Consummables</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable_co" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
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
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDDD"><td align="center"><span class="heading"><b>Operation Details</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable_op" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
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
</td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>

</tr>
</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>
</td>
</tr>
<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
</table>
</FORM>
</body>
</html>
