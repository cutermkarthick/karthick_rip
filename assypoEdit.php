<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: assypoEdit.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays assypo update                      =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
if ( !isset ( $_REQUEST['delrecnum']) )
{
//echo "i am not set in podetails";
   header ( "Location: login.php" );

}
$delrecnum=$_REQUEST['delrecnum'];
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'assypoEdit';
//////session_register('pagename');


// First include the class definition

include('classes/assypoClass.php');
include('classes/assypoliClass.php');
include('classes/displayClass.php');
include('classes/helperClass.php');
$newlogin = new userlogin;
$newlogin->dbconnect();

$newassyPo = new assyPo;
$newdisplay = new display;
$newLI = new assypo_line_items;

$result = $newassyPo->getassyPoDetails($delrecnum);
$myrow = mysql_fetch_assoc($result);
$liresult = $newLI->getLI($delrecnum);
$dept=$_SESSION['department'];
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/assypo.js"></script>

<html>
<head>
<title>SP PO Edit</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
 <form action='assypoProcess.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
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

<?php  $newdisplay->dispLinks(''); ?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>SP PO Edit</b>	</td>

  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>SP PO Edit</b></center></td>
<input type="hidden" name="delrecnum" value="<?php echo $myrow["recnum"] ?>">
</tr>
</td>
   <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
  <td  bgcolor="#F5F6F5" width=50%><span class="heading"><center><b>From</b></center></td>
  <td bgcolor="#F5F6F5" width=50%><span class="heading"><b><center>Order To</center></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext">CIMTools Pvt Ltd.</td>
<td width=50%><span class="tabletext"><?php echo $myrow["name"]?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext">Plot No. 467-469, Site No. 1D,</td>
<td width=50%><span class="tabletext"><?php echo $myrow["addr1"] . " " . $myrow["addr2"]; ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext">12th Cross, 4th Phase,PIA</td>
<td width=50%><span class="tabletext"><?php echo $myrow["city"] . " " . $myrow["state"]. " " . $myrow["zipcode"]; ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="tabletext">Bangalore 560 058, Karnataka- INDIA.</td>
<td><span class="tabletext"><?php echo $myrow["country"]; ?></td>
</tr>
<input type="hidden" name="page" value="edit">
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
    <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><span class='asterisk'>*</span>SP PO No.</font></td>
           <td><span class="tabletext"><input type="text" id="po_num" name="po_num" value="<?php echo $myrow["assyPonum"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>

          <td><span class="labeltext"><span class='asterisk'>*</span>PO Date.</font></td>
            <td><input type="text" name="podate" id='podate'
			 style=";background-color:#DDDDDD;"
			readonly="readonly" size=10 value="<?php echo $myrow["podate"]?>">
			<? if($dept != 'QA' && $dept != 'QAAPP'){?>
     <img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('podate')"></td>
			<?}?>
     </tr>
      <tr bgcolor="#FFFFFF">
 <td><span class="labeltext"><p align="left">Approval</p></font></td>
<?php
if($myrow["approval"] == 'yes')
{
$checked1="checked";
}
$newHelper = new helper;
$date=$newHelper->getdate4Timezone();
if($myrow["approval"] == 'yes')
{?>
<td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked1 ?> name="chk1"  onclick="return false"><input type="hidden" name="approval" value="<?php echo $myrow["approval"]?>" id="approval"></td>
 <td width=20%><span class="labeltext"><p align="left">Approval Date</p></font></td>
<td><input type="text" name="approvaldate" id="approvaldate"style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["approval_date"] ?>">
</td>
<?}
else
{?>
<td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked1 ?> name="chk1"  onclick="JavaScript:toggleValue('approval',chk1,'<?php echo $date ?>');"><input type="hidden" name="approval" value="<?php echo $myrow["approval"]?>" id="approval"></td>
 <td width=20%><span class="labeltext"><p align="left">Approval Date</p></font></td>
<td><input type="text" name="approvaldate" id="approvaldate"style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["approval_date"] ?>">
</td>
<?}?>

 </tr>
 <tr bgcolor="#FFFFFF">
 <td><span class="labeltext"><p align="left">Approval By</p></font></td>
<td colspan=3><span class="tabletext"><?php echo $myrow["approval_by"]?></td>
</tr>
<?
if($dept !='QA' && $dept != 'QAAPP')
{?>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Amendment No.</p></font></td>
 <td><span class="tabletext"><input type="text"  name="amendment_num" id="amendment_num" value="<?php echo $myrow["amnd_no"] ?>"></td>
<td><span class="labeltext"><p align="left">Amendment Date</p></font></td>
<td><input type="text" name="amendmentdate" id="amendmentdate" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["amnd_date"] ?>">
	<img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('amendmentdate')"></td>
 </tr> 
 <?
$amend_notes=wordwrap($myrow["amnd_notes"],100,"\n",true);
?>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Amendment Notes</p></font></td>
<td colspan=3><span class="tabletext"><textarea  name="amendment_notes" id="amendment_notes" rows="3"
			              cols="100" value=""><?php echo $amend_notes ." \n"?></textarea></td>

</tr>

<?
//$terms=wordwrap($myrow["terms"],100,"\n",true);
$terms=wordwrap($myrow["terms"],100,"\n",true);
?>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO Desc</p></font></td>
<td colspan=3><span class="tabletext"><input type="text" name="podesc"  size =40% value="<?php echo $myrow["po_desc"] ?>">
<input type="hidden" name="order_to"  id="order_to" value="<?php echo $myrow["link2vend"]?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Header</p></font></td>
<td colspan=3><span class="tabletext"><textarea  name="terms" rows="2"
			              cols="100" value=""><?php echo $terms?></textarea></td>
</tr>

<?
//$remarks=wordwrap($myrow["remarks"],100,"\n",true);
$remarks=wordwrap($myrow["remarks"],100,"\n",true);
?>
 <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Remarks</p></font></td>
<td colspan=3><span class=\"tabletext\"><textarea  name="remarks" rows="3"
			              cols="100" value=""><?php echo $remarks ?></textarea></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Currency</p></font></td>
     <td><span class="tabletext"><input type="text" name="currency"
              style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow["currency"] ?>"
	<span class="tabletext"><select name="pocurr" size="1" width="100" onchange="onSelectCurr()">
 	<option selected>Please Specify
	<option value>$
 	<option value>Rs
	<option value>GBP
       	<option value>Euro
	</select>
 </td>
<?}
elseif($dept =='QAAPP')
{?>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Amendment No.</p></font></td>
 <td><span class="tabletext"><input type="text" style="background-color:#DDDDDD;" readonly="readonly"  name="amendment_num" id="amendment_num" value="<?php echo $myrow["amnd_no"] ?>"></td>
<td><span class="labeltext"><p align="left">Amendment Date</p></font></td>
<td><input type="text" name="amendmentdate" id="amendmentdate" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["amnd_date"] ?>"></td>
 </tr> 
 <?
$amend_notes=wordwrap($myrow["amnd_notes"],100,"\n",true);
?>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Amendment Notes</p></font></td>
<td colspan=3><span class="tabletext"><textarea  name="amendment_notes" id="amendment_notes" rows="3"
			              style="background-color:#DDDDDD;" readonly="readonly" cols="100" value=""><?php echo $amend_notes ." \n"?></textarea></td>

</tr>

<?
//$terms=wordwrap($myrow["terms"],100,"\n",true);
$terms=wordwrap($myrow["terms"],100,"\n",true);
?>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO Desc</p></font></td>
<td colspan=3><span class="tabletext"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" name="podesc"  size =40% value="<?php echo $myrow["po_desc"] ?>">
<input type="hidden" name="order_to"  id="order_to" value="<?php echo $myrow["link2vend"]?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Header</p></font></td>
<td colspan=3><span class="tabletext"><textarea  name="terms" rows="2"
			              style="background-color:#DDDDDD;" readonly="readonly" cols="100" value=""><?php echo $terms?></textarea></td>
</tr>

<?
//$remarks=wordwrap($myrow["remarks"],100,"\n",true);
$remarks=wordwrap($myrow["remarks"],100,"\n",true);
?>
 <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Remarks</p></font></td>
<td colspan=3><span class=\"tabletext\"><textarea  name="remarks" rows="3"
			              style="background-color:#DDDDDD;" readonly="readonly" cols="100" value=""><?php echo $remarks ?></textarea></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Currency</p></font></td>
     <td><span class="tabletext"><input type="text" name="currency"
              style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow["currency"] ?>">
	 </td>
<?}
else
{?>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Amendment No.</p></font></td>
 <td><span class="tabletext"><input type="text"  name="amendment_num" id="amendment_num" value="<?php echo $myrow["amnd_no"] ?>" readonly></td>
<td><span class="labeltext"><p align="left">Amendment Date</p></font></td>
<td><input type="text" name="amendmentdate" id="amendmentdate" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["amnd_date"] ?>">
<!--
	<img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('amendmentdate')">-->
	</td>
 </tr> 
 <?
$amend_notes=wordwrap($myrow["amnd_notes"],100,"\n",true);
?>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Amendment Notes</p></font></td>
<td colspan=3><span class="tabletext"><textarea  name="amendment_notes" id="amendment_notes" rows="3"
			              cols="100" value="" readonly><?php echo $amend_notes ." \n"?></textarea></td>

</tr>

<?
//$terms=wordwrap($myrow["terms"],100,"\n",true);
$terms=wordwrap($myrow["terms"],100,"\n",true);
?>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO Desc</p></font></td>
<td colspan=3><span class="tabletext"><input type="text" name="podesc"  size =40% value="<?php echo $myrow["po_desc"] ?>" readonly>
<input type="hidden" name="order_to"  id="order_to" value="<?php echo $myrow["link2vend"]?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Header</p></font></td>
<td colspan=3><span class="tabletext"><textarea  name="terms" rows="2"
			              cols="100" value="" readonly><?php echo $terms?></textarea></td>
</tr>

<?
//$remarks=wordwrap($myrow["remarks"],100,"\n",true);
$remarks=wordwrap($myrow["remarks"],100,"\n",true);
?>
 <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Remarks</p></font></td>
<td colspan=3><span class=\"tabletext\"><textarea  name="remarks" rows="3"
			              cols="100" value="" readonly><?php echo $remarks ?></textarea></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Currency</p></font></td>
     <td><span class="tabletext"><input type="text" name="currency"
              style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow["currency"] ?>">
			  <!--

	<span class="tabletext"><select name="pocurr" size="1" width="100" onchange="onSelectCurr()">
 	<option selected>Please Specify
	<option value>$
 	<option value>Rs
	<option value>GBP
       	<option value>Euro
	</select>
	-->
</td>
<?}?>
<td><span class="labeltext"><p align="left">Status</p></font></td>
<td><span class="tabletext"><input type="text" name="status" id="status"
              style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow["status"] ?>">
			 
	<span class="tabletext"><select name="postat" id="postat" size="1" width="20" onchange="onSelectStatus()">
  <option selected>Please Specify
	<option value='Open'>Open
 	<option value='Issued'>Issued
	<option value='Closed'>Closed
	<option value='Cancelled'>Cancelled
	<option value='Pending'>Pending
	</select>
	
 </td>
<input type="hidden" id="prevstatus" name="prevstatus" value="<?php echo $myrow["status"] ?>">
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Type</p></font></td>
<td colspan=1><span class="tabletext"><input type="text" name="type" id="type"
              style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow["type"] ?>"</tr>
<td colspan=3></td>
</tr>
<tr bgcolor="#DDDEDD">
<?
if($dept !='QA' && $dept !='QAAPP')
{?>
<tr bgcolor="#FFFFFF"><td colspan=12><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<?}?>

<td bgcolor="#DDDEDD" colspan=12><span class="heading"><center><b>Line Items</b></center></td>
</tr>
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
       <tr>
           <td bgcolor="#EEEFEE" width=2%><span class="heading"><b>Line</b></td>
           <td bgcolor="#EEEFEE" width=8%><span class="heading"><b>PRN</b></td>
           <td bgcolor="#EEEFEE" width=14%><span class="heading"><b>Part# Before<br>NDT/SP</b></td>
           <td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Part# After<br>SP</b></td>
           <td bgcolor="#EEEFEE" width=14%><span class="heading"><b>Part Name</b></td>
           <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Part<br>Iss</b></td>
           <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Drg<br>Iss</b></td>
           <td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Mtl Spec</b></td>
           <td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Mtl Type</b></td>
           <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>COS</b></td>
           <td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Qty</b></td>
           <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Price</b></td>
           <td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Extended<br>Price</b></td>
       </tr>

<?php

        $i = 1;$flag=0;
        while($i<=6)
        {
          if($flag==0)
		  {

            while ($myLI = mysql_fetch_row($liresult))
            {

             printf('<tr bgcolor="#FFFFFF">');//echo "$date";
               $linenumber="line_num" . $i;
               $crn="crn" . $i;
               $pri_partnum="pri_partnum" . $i;
               $sec_partnum="sec_partnum" . $i;
               $partname="partname" . $i;
               $partiss="partiss" . $i;
               $drgiss="drgiss" . $i;
               $mtlspec="mtlspec" . $i;
               $mtltype="mtltype" . $i;
               $cos="cos" . $i;
               $qty="qty" . $i;
               $price="price" . $i;
               $ext_price="ext_price" . $i;
               
              $prevlinenum="prev_line_num" . $i;
              $lirecnum="lirecnum" . $i;

            //$disputd = $mywoqtyres[9];
            echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[1]\">";
            echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[0]\">";

if($dept !='QA' && $dept !='QAAPP' )
{
            echo "<td ><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$myLI[1]\" size=\"3%\"></td>";
            echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\"  size=\"10%\" value=\"$myLI[2]\">";
}else
{
			echo "<td ><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$myLI[1]\" size=\"3%\" style=\"background-color:#DDDDDD;\" readonly></td>";
            echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\"  size=\"10%\" value=\"$myLI[2]\" style=\"background-color:#DDDDDD;\" readonly>";
}


if($dept !='QA' && $dept !='QAAPP')
{?>
<img src="images/bu-get.gif" alt="Get Details"  onclick="GetPartDetails('<?php echo "$i";?>')">
<?}?>
</td>
<?php
       echo "<td><input type=\"text\" id=\"$pri_partnum\" name=\"$pri_partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"20%\" value=\"$myLI[3]\"></td>";
       echo "<td><input type=\"text\" id=\"$sec_partnum\" name=\"$sec_partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"15%\" value=\"$myLI[4]\"></td>";
       echo "<td><input type=\"text\" id=\"$partname\" name=\"$partname\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[5]\"></td>";

if($dept !='QA' && $dept !='QAAPP')
{
       echo "<td><input type=\"text\" id=\"$partiss\" name=\"$partiss\"  size=\"3%\" value=\"$myLI[6]\"></td>";
       echo "<td><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\"  size=\"3%\" value=\"$myLI[7]\"></td>";
       echo "<td><input type=\"text\" id=\"$mtlspec\" name=\"$mtlspec\"  size=\"8%\" value=\"$myLI[8]\"></td>";
       echo "<td><input type=\"text\" id=\"$mtltype\" name=\"$mtltype\"  size=\"10%\" value=\"$myLI[9]\"></td>";
       echo "<td><input type=\"text\" id=\"$cos\" name=\"$cos\"  size=\"10%\" value=\"$myLI[14]\"></td>";
       echo "<td><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"5%\" value=\"$myLI[11]\">";
       echo "<td><input type=\"text\" id=\"$price\" name=\"$price\"  size=\"6%\" value=\"$myLI[12]\"></td>";
}else
{
       echo "<td><input type=\"text\" id=\"$partiss\" name=\"$partiss\"  size=\"3%\" value=\"$myLI[6]\" style=\"background-color:#DDDDDD;\" readonly></td>";
       echo "<td><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\"  size=\"3%\" value=\"$myLI[7]\" style=\"background-color:#DDDDDD;\" readonly></td>";
       echo "<td><input type=\"text\" id=\"$mtlspec\" name=\"$mtlspec\"  size=\"8%\" value=\"$myLI[8]\" style=\"background-color:#DDDDDD;\" readonly></td>";
       echo "<td><input type=\"text\" id=\"$mtltype\" name=\"$mtltype\"  size=\"10%\" value=\"$myLI[9]\" style=\"background-color:#DDDDDD;\" readonly></td>";
       echo "<td><input type=\"text\" id=\"$cos\" name=\"$cos\"  size=\"10%\" value=\"$myLI[14]\" style=\"background-color:#DDDDDD;\" readonly></td>";
       echo "<td><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"5%\" value=\"$myLI[11]\" style=\"background-color:#DDDDDD;\" readonly></td>";
       echo "<td><input type=\"text\" id=\"$price\" name=\"$price\"  size=\"6%\" value=\"$myLI[12]\" style=\"background-color:#DDDDDD;\" readonly></td>";
}

       echo "<td><input type=\"text\" id=\"$ext_price\" name=\"$ext_price\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  value=\"$myLI[13]\"></td>";

       printf('</tr>');
           $i++;
        }

        $flag=1;
      }
         printf('<tr bgcolor="#FFFFFF">');//echo "$date";
              $linenumber="line_num" . $i;
               $crn="crn" . $i;
               $pri_partnum="pri_partnum" . $i;
               $sec_partnum="sec_partnum" . $i;
               $partname="partname" . $i;
               $partiss="partiss" . $i;
               $drgiss="drgiss" . $i;
               $mtlspec="mtlspec" . $i;
               $mtltype="mtltype" . $i;
               $cos="cos" . $i;
               $qty="qty" . $i;
               $price="price" . $i;
               $ext_price="ext_price" . $i;
              $prevlinenum="prev_line_num" . $i;
              $lirecnum="lirecnum" . $i;


            echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
            echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"\">";

if($dept !='QA'  && $dept !='QAAPP')
{
            echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"\" size=\"3%\"></td>";
            echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\"  size=\"10%\" value=\"\">";
}
else
{
echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"\" size=\"3%\" style=\"background-color:#DDDDDD;\" readonly></td>";
            echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\"  size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly>";
}

if($dept !='QA'  && $dept !='QAAPP')
{?>
<img src="images/bu-get.gif" alt="Get Details"  onclick="GetPartDetails('<?php echo "$i";?>')">
<?}?>
</td>
<?php
          echo "<td><input type=\"text\" id=\"$pri_partnum\" name=\"$pri_partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"20%\" value=\"\"></td>";
          echo "<td><input type=\"text\" id=\"$sec_partnum\" name=\"$sec_partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"15%\" value=\"\"></td>";
          echo "<td><input type=\"text\" id=\"$partname\" name=\"$partname\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"\"></td>";
if($dept !='QA' && $dept !='QAAPP')
{
          echo "<td><input type=\"text\" id=\"$partiss\" name=\"$partiss\"  size=\"3%\" value=\"\"></td>";
          echo "<td><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\"  size=\"3%\" value=\"\"></td>";
          echo "<td><input type=\"text\" id=\"$mtlspec\" name=\"$mtlspec\"  size=\"8%\" value=\"\"></td>";
          echo "<td><input type=\"text\" id=\"$mtltype\" name=\"$mtltype\"  size=\"10%\" value=\"\"></td>";
          echo "<td><input type=\"text\" id=\"$cos\" name=\"$cos\"  size=\"10%\" value=\"\"></td>";
          echo "<td><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"5%\" value=\"\">";
          echo "<td><input type=\"text\" id=\"$price\" name=\"$price\"  size=\"6%\" value=\"\"></td>";
}else
			{
          echo "<td><input type=\"text\" id=\"$partiss\" name=\"$partiss\"  size=\"3%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly></td>";
          echo "<td><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\"  size=\"3%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly></td>";
          echo "<td><input type=\"text\" id=\"$mtlspec\" name=\"$mtlspec\"  size=\"8%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly></td>";
          echo "<td><input type=\"text\" id=\"$mtltype\" name=\"$mtltype\"  size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly></td>";
          echo "<td><input type=\"text\" id=\"$cos\" name=\"$cos\"  size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly></td>";
          echo "<td><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"5%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly></td>";
          echo "<td><input type=\"text\" id=\"$price\" name=\"$price\"  size=\"6%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly></td>";
			}

          echo "<td><input type=\"text\" id=\"$ext_price\" name=\"$ext_price\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"6%\" value=\"\"></td>";
       	    printf('</tr>');
        $i++;
        }
         echo "<input type=\"hidden\" name=\"index\" value=$i>";

?>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td align="right"><span class="pageheading"><b></b></td><td width="12%"></td></tr>
<tr bgcolor="#FFFFFF">
<td align="right"><span class="tabletext"><b>Total</b></td>
<td><span class="tabletext" align=right><?php printf('%s %.2f',$myrow["currency"],$myrow["poamount"]); ?></td>
<tr>
<tr bgcolor="#FFFFFF">
<td align="right"><span class="tabletext"><b>Tax</b></td>
<td><span class="tabletext"><input type='text' name='tax' readonly="readonly" value='<?php printf('%.2f',$myrow["tax"]); ?>'></td>
<tr>
<tr bgcolor="#FFFFFF">
<td align="right"><span class="tabletext"><b>Shipping</b></td>
<td><span class="tabletext"><input type='text' name='shipping' readonly="readonly" value='<?php printf('%.2f',$myrow["shipping"]); ?>'></td>
<tr>
<tr bgcolor="#FFFFFF">
<td align="right"><span class="tabletext"><b>Labor</b></td>
<td><span class="tabletext"><input type='text' name='labor' readonly="readonly" value='<?php printf('%.2f',$myrow["labour"]); ?>'></td>
<tr>
<tr bgcolor="#FFFFFF">
<td align="right"><span class="tabletext"><b>Total Due</b></td>
<td><span class="tabletext" align=right><?php printf('%s %.2f',$myrow["currency"],$myrow["total_due"]); ?></td>
<tr>
</tr>
</table>
<?
if($dept !='QA')
{?>
<input type='hidden' name='pagen' value='assypo'>
<?}
else
{?>
<input type='hidden' name='pagen' value='view_assypo'>
<?}?>
								</td>
								<input type="hidden" name="page_name"  id="page_name" value="edit_assypo">
								<td width="6"><img src="images/spacer.gif " width="6"></td>
							</tr>
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/box-left-bottom.gif"></td>
								<td><img src="images/spacer.gif " height="6"></td>
								<td width="6"><img src="images/box-right-bottom.gif"></td>
							</tr>
						</table>

        <span class="tabletext">
        <input type="submit"
        style="color=#0066CC;background-color:#DDDDDD;width=130;"
        value="Submit" name="submit" onclick="javascript: return check_req_fields();">
        <INPUT TYPE="RESET"
        style="color=#0066CC;background-color:#DDDDDD;width=130;"
        VALUE="Reset" onclick="javascript: putfocus()">
</FORM>
</body>
</html>
