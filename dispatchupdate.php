<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: dispatchupdate.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays Dispatchupdate                     =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
if ( !isset ( $_REQUEST['disprecnum']) )
{
   header ( "Location: login.php" );
}
$disprecnum = $_REQUEST['disprecnum'];

//$pageNum = 1;

//$_SESSION['disprecnum'] = $disprecnum;
////////session_register('disprecnum');
//echo "$porecnum";
$_SESSION['pagename'] = 'dispatchupdate';
$page = "Dispatch";
$dept = $_SESSION['department'];
//////session_register('pagename');

// First include the class definition

include('classes/dispatchClass.php');
include('classes/dispatchliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newDispatch = new dispatch;
$newdisplay = new display;
$newLI = new dispatch_line_items;

$result = $newDispatch->getdispatchDetails($disprecnum);
$myrow = mysql_fetch_row($result);
/* echo "i am 12 :$myrow[12]";
 echo "i am 11 :$myrow[11]";
 echo "i am 10 :$myrow[10]";*/
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/dispatch.js"></script>

<html>
<head>
<title>Dispatch Edit</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
 <form action='processDispatch.php' method='post' enctype='multipart/form-data'>
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
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
</td></tr>
<tr>
<td>

<?php  $newdisplay->dispLinks(''); ?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<table width=100% border=0 cellpadding=0 cellspacing=0 class="stdtable1" style="width:58%!important">
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6" class="stdtable1" style="width:58%!important">
<tr>
<td><span class="pageheading"><b>Dispatch Details</b></td>
</tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1" style="width:58%!important">
<?php
?>
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1" class="sdtatble1" style="width:58%!important">
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Dispatch Editing</b></center></td>
<input type="hidden" name="disprecnum" value="<?php echo $myrow[0] ?>">
</tr>
</td>
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><span class='asterisk'>*</span>Rel Note#</td>
            <td><span class="tabletext"><input type="text" id="relnotenum"  name="relnotenum" value="<?php echo $myrow[1] ?>" style="background-color:#DDDDDD;" readonly="readonly" ></td>
		
			<td><span class="labeltext"><p align="left">Type</p></font></td>
            <td><select id="type" name="type">
			<?php $selected = 'selected'; ?>
			<option value="Untreated" <?php if($myrow[36] == 'Untreated') echo $selected?>>Untreated</option>
			<!--<option value="Manufacture for Assembly" <?php if($myrow[36] == 'Manufacture for Assembly') echo $selected?>>Manufacture for Assembly</option>-->
			<option value="Treated" <?php if($myrow[36] == 'Treated') echo $selected?>>Treated</option>
            <option value="Assembly" <?php if($myrow[36] == 'Assembly') echo $selected?>>Assembly</option>
            <option value="Kit" <?php if($myrow[36] == 'Kit') echo $selected?>>Kit</option>
                 </select>
			</td>
	</tr>
    <tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><span class='asterisk'>*</span>Dispatch Date</td>
             <?php
              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
               $datearr = split('-', $myrow[2]);
               $d=$datearr[2];
               $m=$datearr[1];
               $y=$datearr[0];
               $x=mktime(0,0,0,$m,$d,$y);
               $dispdate=date("M j, Y",$x);
		      }
		      else
              {
               $dispdate="";
		      }
            ?>
            <td><span class="tabletext"><input type="text"  id="disp_date" name="disp_date" value="<?php echo $myrow[2] ?>" style="background-color:#DDDDDD;" readonly="readonly">
            <img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('disp_date')"></td>
			<td><span class="labeltext"><span class='asterisk'>*</span>Dispatch to Customer</font></td>
             <td><input type="text" name="disp2company"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[4] ?>"> <img src="images/bu-getcompany.gif" alt="Get Company"  onclick="GetCompany()">
             <input type="hidden" name="companyrecnum" value="<?php echo $myrow[9] ?>">
            </td>
			</tr>


  <tr bgcolor="#FFFFFF">
           <td><span class="labeltext">Dispatch Desc</font></td>
		    <td colspan=3><textarea name="disp_desc" rows="3"
			      style="background-color:#FFFFFF;"
			      cols="100"><?php echo $myrow[3] ?></textarea></td>                    
     </tr>

        </tr>

     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Via</font></td>
           <td><span class="tabletext"><input type="text"  name="via" value="<?php echo $myrow[5] ?>" style="background-color:#FFFFFF;"></td>
           <td><span class="labeltext">Ref No</td>
            <td><span class="tabletext"><input type="text"  name="refno" value="<?php echo $myrow[6] ?>" style="background-color:#FFFFFF;" ></td>
      </tr>

      <tr bgcolor="#FFFFFF">
      <td><span class="labeltext"><p align="left">PRN</p></font></td>
      <td><span class="tabletext"><input type="text" id="crnnum" name="crnnum" size=20 value="<?php echo $myrow[10] ?>" readonly='readonly'></td>
      <td><span class="labeltext"><p align="left">Status</p></font></td>
      <td colspan=3><span class="tabletext"><input type="text" name="status"  
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[19] ?>"
	<span class="tabletext"><select name="dispstat" size="1" width="20" onchange="onSelectStatus()">
 	<option selected>Please Specify
	<option value>Open
	<option value>Signed & Closed
       	<option value>Cancelled
	</select>
      </td>
      </tr>
      <tr bgcolor="#FFFFFF" width=100%>
<td><span class="labeltext"><p align="left">Export Invoice #</p></font></td>
<td colspan=3><span class="tabletext"><input type="text" id="expinvnum" name="expinvnum" size=20 value="<?php echo $myrow[39] ?>"></td>
</tr>
      <tr bgcolor="#FFFFFF">
      <td><span class="labeltext"><p align="left">Remarks</p></font></td>
      <td colspan=3><textarea name="remarks" rows="3"
			      style="background-color:#FFFFFF;"
			      cols="100"><?php echo $myrow[18] ?></textarea></td>   
      </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Create Date</td>
            <?php

              if($myrow[7] != '0000-00-00' && $myrow[7] != '' && $myrow[7] != 'NULL')
              {
               $datearr = split('-', $myrow[7]);
               $d=$datearr[2];
               $m=$datearr[1];
               $y=$datearr[0];
               $x=mktime(0,0,0,$m,$d,$y);
               $createdate=date("M j, Y",$x);
		      }
		      else
              {
               $createdate="";
		      }
            ?>
            <td><span class="tabletext"><input type="text"  name="create_date" value="<?php echo $myrow[7] ?>" style="background-color:#DDDDDD;" readonly="readonly">
            <td><span class="labeltext">Modified Date</td>
            <?php

              if($myrow[8] != '0000-00-00' && $myrow[8] != '' && $myrow[8] != 'NULL')
              {
               $datearr = split('-', $myrow[8]);
               $d=$datearr[2];
               $m=$datearr[1];
               $y=$datearr[0];
               $x=mktime(0,0,0,$m,$d,$y);
               $moddate=date("M j, Y",$x);
		      }
		      else
              {
               $moddate="";
		      }
            ?>
             <td><span class="tabletext"><input type="text"  name="mod_date" value="<?php echo $myrow[8] ?>" style="background-color:#DDDDDD;" readonly="readonly">
        </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Deliver Address</p></font></td>
        <td><select id="deliver" name="deliver" >
        <?php $selected = 'selected'; ?>
        <option value="Primary" <?php if($myrow[20] == 'Primary') echo $selected?>>Primary</option>
        <option value="Billing" <?php if($myrow[20] == 'Billing') echo $selected?>>Billing</option>
        <option value="Shipping" <?php if($myrow[20] == 'Shipping') echo $selected?>>Shipping</option>
        </select></td>
        <td><span class="labeltext"><p align="left">Invoice Address</p></font></td>
        <td><select id="invoice" name="invoice" >
         <?php $selected = 'selected'; ?>
        <option value="Primary" <?php if($myrow[21] == 'Primary') echo $selected?>>Primary</option>
        <option value="Billing" <?php if($myrow[21] == 'Billing') echo $selected?>>Billing</option>
        <option value="Shipping" <?php if($myrow[21] == 'Shipping') echo $selected?>>Shipping</option>
        </select></td>
         </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Scheduled Date</td>
            <?php

              if($myrow[34] != '0000-00-00' && $myrow[34] != '' && $myrow[34] != 'NULL')
              {
               $datearr = split('-', $myrow[34]);
               $d=$datearr[2];
               $m=$datearr[1];
               $y=$datearr[0];
               $x=mktime(0,0,0,$m,$d,$y);
               $schdate=date("M j, Y",$x);
		      }
		      else
              {
               $schdate="";
		      }
            ?>
<td colspan=3><span class="tabletext"><input type="text"  style="background-color:#DDDDDD;" readonly="readonly" id="sch_date" name="sch_date" size=20 value="<?php echo $myrow[34] ?>" >                                        <img src="images/bu-getdate.gif" name='cim' onclick='GetSch("<?php echo 'CIM_refnum' ?>")'></td>

  </tr>

<input type="hidden" id="schqty" name="schqty" value="<?php echo $myrow[35] ?>">


<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Line Items</b></center></td>
</tr>
</table>
<div style="width:58%;overflow-x:scroll">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" style="width:58%!important">

       <tr>
            <td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line</b></td>
            <td bgcolor="#EEEFEE" width=13%><span class="heading"><b>WO#</b></td>
             <td bgcolor="#EEEFEE" width=13%><span class="heading"><b>Dnnum</b></td>
			<td bgcolor="#EEEFEE" width=13%><span class="heading"><b>Supplier<br>WO#</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Part #</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Part <br>Name</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>RM Spec</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Part<br>Iss</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Drg<br>Iss</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>COS</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>GRN Num</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Batch No</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Custpo Num</b></td>
			  <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Item<br>Num</b></td>

			<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Dispatch Cust PO Num</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Dispatch Cust PO<br/>Item</b></td>

          
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>WO Comp<br> Date</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>WO Qty</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Acc Qty</b></td>            
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Disp<br>UTD</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Disp<br>Qty</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Packing<br>Slip No</b></td>

       </tr>

<?php
        $liresult = $newLI->getLI($disprecnum,$myrow[36]);
        $i = 1;$flag=0;

        while($i<=6)
        {
          if($flag==0)
		  {

            while ($myLI = mysql_fetch_row($liresult))
            {
            
            printf('<tr bgcolor="#FFFFFF">');//echo "$date";
            $linenumber = "line_num" . $i;
            $wonum = "wonum" . $i;
             $dnnum = "dnnum" . $i;
			 $supplier_wonum = "supplier_wonum" . $i;
            $partnum = "partnum" . $i;

            $partname = "partname" . $i;
            $drgiss = "drgiss" . $i;
            $partiss = "partiss" . $i;
            $cos = "cos" . $i;
            $itemnum = "itemnum" . $i;
            $datecode = "datecode" . $i;
            $rmspec = "rmspec" . $i;

            $grnnum = "grnnum" . $i;
            $wo_qty="wo_qty" . $i;
            $comp_qty="comp_qty" . $i;
            //$delvby = $myLI["delv_by"];
            $custpo_num = "custpo_num" . $i;

			   $disp_custpo_no="disp_custpo_no" .$i;
   $disp_custpo_item="disp_custpo_item" .$i;

            $custpoqty = "custpo_qty" . $i;
            $disp_qty = "disp_qty" . $i;
            $custpo_date = "custpo_date" . $i;
            $disp_update="disp_update" . $i;
            $batchnum="batchnum".$i;
            $psn="psn".$i;
            $prev_qty="prev_qty".$i;
            $prevlinenum="prev_line_num" . $i;
            $lirecnum="lirecnum" . $i;
            $exp_invnum="exp_invnum" .$i;

          if($myrow[36] == 'With Treatment')
          {
            $wosumqty = $newLI->getdisputd4treat($myLI[1],$myLI[19]);
            $mywoqtyres = mysql_fetch_row($wosumqty);
            $disputd = $mywoqtyres[9] - $myLI[10];
          }
		  else  if($myrow[36] == 'Assembly')
          {
            $wosumqty = $newLI->getdisputd4assy($myLI[1],$myLI[19]);
            $mywoqtyres = mysql_fetch_row($wosumqty);
            $disputd = $mywoqtyres[9] - $myLI[10];
          }
		  else
          {
            $wosumqty = $newLI->getdispqty($myLI[1]);
            $mywoqtyres = mysql_fetch_row($wosumqty);
            $disputd = $mywoqtyres[9] - $myLI[10];
          }


          echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[0]\">";
          echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[9]\">";
    
          echo "<td ><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$myLI[0]\" size=\"5%\"></td>";
          echo "<td><input type=\"text\" id=\"$wonum\" name=\"$wonum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI[1]\">";
?>
<img src="images/bu_getwo.gif" alt="Get WO"  onclick="Getwo4dc('<?php echo "$i";?>')"></td>
<?php
 echo "<td><input type=\"text\" id=\"$dnnum\" name=\"$dnnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI[24]\">";
	   echo "<td><input type=\"text\" id=\"$supplier_wonum\" name=\"$supplier_wonum\"  size=\"10%\" value=\"$myLI[19]\"></td>";
       echo "<td><input type=\"text\" id=\"$partnum\" name=\"$partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"15%\" value=\"$myLI[2]\"></td>";
       echo "<td><input type=\"text\" id=\"$partname\" name=\"$partname\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"15%\" value=\"$myLI[11]\"></td>";
       echo "<td><input type=\"text\" id=\"$rmspec\" name=\"$rmspec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"15%\" value=\"$myLI[16]\"></td>";
       echo "<td><input type=\"text\" id=\"$partiss\" name=\"$partiss\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"6%\" value=\"$myLI[13]\"></td>";
       echo "<td><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"6%\" value=\"$myLI[12]\"></td>";
       echo "<td><input type=\"text\" id=\"$cos\" name=\"$cos\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"6%\" value=\"$myLI[18]\"></td>";
       echo "<td><input type=\"text\" id=\"$grnnum\" name=\"$grnnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"6%\" value=\"$myLI[3]\"></td>";
        echo "<td><input type=\"text\" id=\"$batchnum\" name=\"$batchnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"6%\" value=\"$myLI[20]\"></td>";
       echo "<td><input type=\"text\" id=\"$custpo_num\" name=\"$custpo_num\" size=\"10%\" value=\"$myLI[4]\"></td>";	   
       echo "<td><input type=\"text\" id=\"$itemnum\" name=\"$itemnum\" size=\"4%\" value=\"$myLI[14]\"></td>";

	     echo "<td><input type=\"text\" id=\"$disp_custpo_no\" name=\"$disp_custpo_no\" size=\"10%\" value=\"$myLI[22]\"></td>";
		   echo "<td><input type=\"text\" id=\"$disp_custpo_item\" name=\"$disp_custpo_item\" size=\"10%\" value=\"$myLI[23]\"></td>";



       echo "<td><input type=\"text\" id=\"$custpo_date\" name=\"$custpo_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"8%\" value=\"$myLI[6]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDate('$custpo_date')\">";
       echo "<td><input type=\"text\" id=\"$wo_qty\" name=\"$wo_qty\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"4%\" value=\"$myLI[7]\"></td>";
       echo "<td><input type=\"text\" id=\"$comp_qty\" name=\"$comp_qty\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"4%\" value=\"$myLI[8]\">";
       echo "<td><input type=\"text\" id=\"$disp_update\" name=\"$disp_update\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"4%\" value=\"$disputd\"></td>";
       echo "<td><input type=\"text\" id=\"$disp_qty\"  name=\"$disp_qty\" size=\"4%\" value=\"$myLI[10]\">
        <input type=\"hidden\" id=\"$prev_disp_qty\"  name=\"$prev_disp_qty\" size=\"4%\" value=\"$myLI[10]\">
       <input type=\"hidden\" id=\"$prev_qty\"  name=\"$prev_qty\" size=\"4%\" value=\"$myLI[10]\"></td>";
       echo "<td><input type=\"text\" id=\"$psn\"  name=\"$psn\" size=\"8%\" value=\"$myLI[21]\"></td>";
       echo "<input type=\"hidden\" name=\"$exp_invnum\" id=\"$exp_invnum\" value=\"$myrow[39]\">";
       //echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$delvby</td>";
       printf('</tr>');
           $i++;
        }

        $flag=1;
      }
         printf('<tr bgcolor="#FFFFFF">');//echo "$date";
            $linenumber = "line_num" . $i;
            $wonum = "wonum" . $i;
            $dnnum = "dnnum" . $i;
			 $supplier_wonum = "supplier_wonum" . $i;
            $partnum = "partnum" . $i;
            $grnnum = "grnnum" . $i;
            $wo_qty="wo_qty" . $i;
            $comp_qty="comp_qty" . $i;
            //$delvby = $myLI["delv_by"];
            $custpo_num = "custpo_num" . $i;
            $custpoqty = "custpo_qty" . $i;
            $disp_qty = "disp_qty" . $i;
            $custpo_date = "custpo_date" . $i;
            $disp_update="disp_update" . $i;
            $prevlinenum="prev_line_num" . $i;
            $lirecnum="lirecnum" . $i;

            $partname = "partname" . $i;
            $drgiss = "drgiss" . $i;
            $partiss = "partiss" . $i;
            $cos = "cos" . $i;
            $itemnum = "itemnum" . $i;
            $datecode = "datecode" . $i;
            $rmspec = "rmspec" . $i;
            $batchnum="batchnum".$i;
            $psn="psn".$i;
            $prev_qty="prev_qty".$i;
            $exp_invnum="exp_invnum" .$i;

			$disp_custpo_no="disp_custpo_no" .$i;
			$disp_custpo_item="disp_custpo_item" .$i;

            echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
            echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"\">";

            echo "<td ><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"\" size=\"5%\"></td>";
            echo "<td><input type=\"text\" id=\"$wonum\" name=\"$wonum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"\">";
?>
<img src="images/bu_getwo.gif" alt="Get WO"  onclick="Getwo4dc('<?php echo "$i";?>')"></td>
<?php	
            echo "<td><input type=\"text\" id=\"$dnnum\" name=\"$dnnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"\">";
            echo "<td><input type=\"text\" id=\"$supplier_wonum\" name=\"$supplier_wonum\"  size=\"10%\" value=\"\"></td>";
			echo "<td><input type=\"text\" id=\"$partnum\" name=\"$partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"15%\" value=\"\"></td>";

            echo "<td><input type=\"text\" id=\"$partname\" name=\"$partname\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"15%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$rmspec\" name=\"$rmspec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"15%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$partiss\" name=\"$partiss\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"6%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"6%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$cos\" name=\"$cos\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"6%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$grnnum\" name=\"$grnnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"6%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$batchnum\" name=\"$batchnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"6%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$custpo_num\" name=\"$custpo_num\"  size=\"10%\" value=\"\"></td>";
			echo "<td><input type=\"text\" id=\"$itemnum\" name=\"$itemnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"4%\" value=\"\"></td>";

			 echo "<td><input type=\"text\" id=\"$disp_custpo_no\" name=\"$disp_custpo_no\" size=\"10%\" value=\"\"></td>";
		   echo "<td><input type=\"text\" id=\"$disp_custpo_item\" name=\"$disp_custpo_item\" size=\"10%\" value=\"\"></td>";


            
            echo "<td><input type=\"text\" id=\"$custpo_date\" name=\"$custpo_date\" style=\"background-color:#DDDDDD;\" size=\"8%\" value=\"\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDate('$custpo_date')\"></td>";
  	        echo "<td><input type=\"text\" id=\"$wo_qty\" name=\"$wo_qty\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"4%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$comp_qty\" name=\"$comp_qty\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"4%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$disp_update\" name=\"$disp_update\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"4%\" value=\"\">";
            echo "<td><input type=\"text\" id=\"$disp_qty\"  name=\"$disp_qty\" size=\"4%\" value=\"\">
            <input type=\"hidden\" id=\"$prev_qty\"  name=\"$prev_qty\" size=\"4%\" value=\"$myLI[10]\"></td>";
            echo "<td><input type=\"text\" id=\"$psn\"  name=\"$psn\" size=\"8%\" value=\"\"></td>";
            echo "<input type=\"hidden\" name=\"$exp_invnum\" value=\"$myrow[39]\">";
       	    printf('</tr>');
        $i++;
        }
         echo "<input type=\"hidden\" name=\"index\" value=$i>";

?>

<td><input type="hidden"  id="totdispqty" name="totdispqty"  value="<?=$myLI[10]?>" ></td>
<input type="hidden"  id="delivery_sch_qty" name="delivery_sch_qty"  value="<?=$myrow[40]?>" >
<input type="hidden" name="pagename" id="pagename" value='dispatchupdate'>
											</table>
 											</td>
										
									
								</td>
						<!-- 		<td width="6"><img src="images/spacer.gif " width="6"></td>
							</tr>
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/box-left-bottom.gif"></td>
								<td><img src="images/spacer.gif " height="6"></td>
								<td width="6"><img src="images/box-right-bottom.gif"></td>
							</tr> -->
						</table>

        <span class="tabletext">
        <input type="submit"
        style="color=#0066CC;background-color:#DDDDDD;width=130;"
        value="Submit" name="submit" onclick="javascript: return check_req_fields1();">
        <INPUT TYPE="RESET"
        style="color=#0066CC;background-color:#DDDDDD;width=130;"
        VALUE="Reset" onclick="javascript: putfocus()">
</form>
</body>
</html>
