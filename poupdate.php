<?php
//==============================================
// Author: FSI                                 =
// Date-written = Oct 2004                     =
// Filename: poUpdate.php                      =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Displays PO for update                      =
//==============================================
    session_start();
    header("Cache-control: private");
    if ( !isset ( $_SESSION['user'] ) )
    {
       header ( "Location: login.php" );
    }
    $userid = $_SESSION['user'];
    if ( !isset ( $_SESSION['user'] ) )
    {
      header ( "Location: login.php" );
    }
    $porecnum = $_REQUEST['porecnum'];

    $dept = $_SESSION['department'];
    $cond = "c.name like '%'";
    $rowsPerPage = 6;
    $pageNum = 1;
    $offset = ($pageNum - 1) * $rowsPerPage;
    $_SESSION['pagename'] = 'poupdate';
    $page = "Purchasing: PO";
    //////session_register('pagename');

// First include the class definition

    include('classes/poClass.php');
    include('classes/liClass.php');
    include('classes/displayClass.php');
    $newdisp = new display;
    $newPO = new po;
    $newLI = new po_line_items;

    $result = $newPO->getPODetails($porecnum);
    $myrow = mysql_fetch_assoc($result);


    $result1 = $newPO->getPODetails($porecnum);
    $myrow1 = mysql_fetch_row($result1);
    $remarks=wordwrap($myrow["remarks"],155,"\n",true);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/po.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>
<script language="javascript" type="text/javascript">
function readOnlyCheckBox() 
{
   return false;
}
</script>

<html>
<head>
<title>PO Update</title>
<script language="javascript">

    function onPageLoad() {
        window.setInterval(sendPing, 120000);
    }
    function sendPing() {
       $.ajax({
      url : "getsession4so.php",
      type : "POST",
      dataType: "html",
      success : function (msg){
    // alert(msg);
              $('#sessiondets').html(msg);
              }
          })
    }
</script>
</head>
<body leftmargin="0"topmargin="0" margin width="0" onload="onPageLoad()">
<form action='processPo.php' method='post' enctype='multipart/form-data'>
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
<?php
	$newdisp->dispLinks('');
?>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<!-- <td bgcolor="#FFFFFF"> -->
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td>
<table width=100% border=0 bgcolor="#FFFFFF">
<tr>
<td colspan=2><span class="pageheading"><b>Edit PO</b></td>
<td colspan=20>&nbsp;</td>
</tr>
</table>
</td></tr>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr bgcolor="#FFFFFF">
<td width=5% bgcolor="#EEEFEE" ><span class="heading"><left><b>Supplier</b></left></td>
<td width=10% bgcolor="#EEEFEE" ><span class="heading"><b><left>Ship To</left></b></td>
<input type="hidden" name="activeval" value="<?php echo $myrow1[7] ?>">
<input type="hidden" name="vendrecnum" id="vendrecnum"value="<?php echo $myrow1[8] ?>">
<input type="hidden" name="vendor" value="<?php echo $myrow["name"] ?>">
<input type="hidden" name="porecnum" value="<?php echo $myrow1[9] ?>">
<input type="hidden" name="deptname" id="deptname" value="<?php echo $dept ?>">
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td width=30%><span class="tabletext"><?php echo $myrow["name"]?></td>
<td width=70%><span class="tabletext">Fluent Technologies</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="tabletext">&nbsp</td>
<td width=70%><span class="tabletext">Basaweshwarnagar</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="tabletext">&nbsp</td>
<td width=70%><span class="tabletext">Bangalore, India.</td>
</tr>
</table>
<?php
if($dept =='Sales')
{

?>
<input type="hidden" name="noedit"  id="noedit" value="">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td width=10%><span class="labeltext"><p align="left">PO Date</p></font></td>
<td width=20% ><input type="text" id="podate" name="podate" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["podate"] ?>">
	<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('podate')"></td>
<td width=10%><span class="labeltext"><p align="left">PO #</p></font></td>
 <td width=60%><span class="tabletext"><input type="text"  name="ponum" value="<?php echo $myrow["ponum"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
 </tr>
 <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">PO Desc</p></font></td>
<td ><span class="tabletext"><input type="text"   name="desc"  size =40% value="<?php echo $myrow["podescr"] ?>"></td>
<td><span class="labeltext"><p align="left">Currency</p></font></td>
<td><span class="tabletext"><input type="text" name="currency"  
              style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow["currency"] ?>"
	<span class="tabletext"><select name="pocurr" size="1" width="20" onchange="onSelectCurr()">
 	<option selected>Please Specify
	<option value>$
 	<option value>Rs
	<option value>GBP
       	<option value>Euro
	</select>
 </td>
</tr>
<tr bgcolor="#FFFFFF">

  <td><span class="labeltext"><p align="left">Status</p></font></td>
<td colspan=3><span class="tabletext"><input type="text" name="status" id="status"
              style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow["status"] ?>"
	<span class="tabletext"><select name="postat" id="postat" size="1" width="20" onchange="onSelectStatus()">
  <option selected>Please Specify
	<option value>Open
 	<option value>Issued
	<option value>Closed
	<option value>Cancelled
	<option value>Pending
	</select>
 </td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Approval</p></font></td>
<?php
if($myrow["approval"] == 'yes')
{
   $checked1="checked";
}
$date=date("Y-m-d");
//echo"+ + +".$date;
?>
<td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked1 ?> name="chk1"  onclick="JavaScript:toggleValue('approval',chk1,'<?php echo $date ?>');">
                         <input type="hidden" name="approval" value="<?php echo $myrow["approval"]?>" id="approval"></td>
                         <td width=20%><span class="labeltext"><p align="left">Approval Date</p></font></td>
<td width=60% ><input type="text" name="approvaldate" id="approvaldate" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["approvaldate"] ?>">
</td>
                         
</tr>
<tr bgcolor="#FFFFFF" >

<td width=10%><span class="labeltext"><p align="left">Amendment No.</p></font></td>
<td width=20%><span class="tabletext"><input type="text"  name="amendment_num" id="amendment_num" value="<?php echo $myrow["amendment_num"] ?>"></td>
<td width=10%><span class="labeltext"><p align="left">Amendment Date</p></font></td>
<td width=60% ><input type="text" name="amendmentdate" id="amendmentdate" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow['amendmentdate'] ?>">
	<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('amendmentdate')"></td>
 </tr>
 <?
$amend_notes=wordwrap($myrow["amendment_notes"],100,"\n",true);
?>
<tr bgcolor="#FFFFFF" >
<td><span class="labeltext"><p align="left">Amendment Notes</p></font></td>
<td colspan=3><span class="tabletext"><textarea  name="amendment_notes" id="amendment_notes" rows="3"
			              cols="110" value=""><?php echo $amend_notes ." \n"?></textarea></td>
</tr>
 
<?
$terms=wordwrap($myrow["terms"],100,"\n",true);
?>
  <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Header</p></font></td>
<td colspan=3><span class="tabletext"><textarea  name="terms" rows="2"                          
			              cols="110" value=""><?php echo $terms?></textarea></td>
</tr>
 <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Remarks</p></font></td>
<td colspan=3><span class=\"tabletext\"><textarea  name="remarks" rows="3"                          
			              cols="110" value=""><?php echo $remarks ?></textarea></td>
</tr>
<tr bgcolor="#FFFFFF">
<td ><span class="labeltext"><p align="left">Type</p></font></td>
 <td colspan=8><span class="tabletext">
 <input type="text" name="potype" id="potype" style="background-color:#DDDDDD;" readonly="readonly"  size=15 value="<?php echo $myrow["type"] ?>">
 <select name="potype_sel" id="potype_sel" size="1" width="100" onchange="onSelecttype()">
 <option selected value="Regular">Regular
        					<option value="Consummables">Consummables
							<option value="Bought Out">Bought Out
        	 </select></td>
 </tr>
<tr bgcolor="#FFFFFF">
<td colspan=1><span class="labeltext"><p align="left">Communication</p></font></td>
<?php
$comm = $myrow["communication"];
($comm == 10)?$checked='checked':$checked='';
echo "<td colspan=8><span class=\"tabletext\"><input type=\"radio\" id=\"communication\" name=\"communication\" value=\"10\" $checked>10";
($comm == 20)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"20\" $checked>20";
($comm == 30)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"30\" $checked>30";
($comm == 40)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"40\" $checked>40";
($comm == 50)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"50\" $checked>50";
($comm == 60)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"60\" $checked>60";
($comm == 70)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"70\" $checked>70";
($comm == 80)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"80\" $checked>80";
($comm == 90)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"90\" $checked>90";
($comm == 100)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"100\" $checked>100</td>";
?>
<input type="hidden" id="comm" name="comm" value=" <?php echo $comm?>">
 <br>
</table>

<?php 
  }
  else if($dept == "Stores")
  {  
  ?>

    <input type="hidden" name="noedit"  id="noedit" value="">
    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
      <tr bgcolor="#FFFFFF">
        <td width=10%><span class="labeltext"><p align="left">PO Date</p></font></td>
        <td width=20% ><input type="text" id="podate" name="podate" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["podate"] ?>"></td>
        <td width=10%><span class="labeltext"><p align="left">PO #</p></font></td>
        <td width=60%><span class="tabletext"><input type="text"  name="ponum" value="<?php echo $myrow["ponum"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
       </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">PO Desc</p></font></td>
          <td ><span class="tabletext"><input type="text"   name="desc"  size =40% value="<?php echo $myrow["podescr"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
          <td><span class="labeltext"><p align="left">Currency</p></font></td>
          <td><span class="tabletext"><input type="text" name="currency"  style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow["currency"] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Status</p></font></td>
          <td colspan=3><span class="tabletext"><input type="text" name="status" id="status" style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow["status"] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Approval</p></font></td>
          <?php
            if($myrow["approval"] == 'yes')
            {
              $checked1="checked";
            }
            $date=date("Y-m-d");
          ?>
          <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked1 ?> name="chk1"  onclick="JavaScript:toggleValue('approval',chk1,'<?php echo $date ?>');">
            <input type="hidden" name="approval" value="<?php echo $myrow["approval"]?>" id="approval"></td>
          <td width=20%><span class="labeltext"><p align="left">Approval Date</p></font></td>
          <td width=60% ><input type="text" name="approvaldate" id="approvaldate" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["approvaldate"] ?>"></td>                     
        </tr>

        <tr bgcolor="#FFFFFF" >
          <td width=10%><span class="labeltext"><p align="left">Amendment No.</p></font></td>
          <td width=20%><span class="tabletext"><input type="text"  name="amendment_num" id="amendment_num" value="<?php echo $myrow["amendment_num"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
          <td width=10%><span class="labeltext"><p align="left">Amendment Date</p></font></td>
          <td width=60% ><input type="text" name="amendmentdate" id="amendmentdate" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow['amendmentdate'] ?>" ></td>
        </tr>

        <?php
          $amend_notes=wordwrap($myrow["amendment_notes"],100,"\n",true);
        ?>

        <tr bgcolor="#FFFFFF" >
          <td><span class="labeltext"><p align="left">Amendment Notes</p></font></td>
          <td colspan=3><span class="tabletext"><textarea style="background-color:#DDDDDD;" readonly="readonly" name="amendment_notes" id="amendment_notes" rows="3" cols="110" value=""><?php echo $amend_notes ." \n" ?> </textarea></td>
        </tr>
     
        <?php
          $terms=wordwrap($myrow["terms"],100,"\n",true);
        ?>
        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Header</p></font></td>
          <td colspan=3><span class="tabletext"><textarea  name="terms" rows="2"  cols="110" value=""><?php echo $terms ?></textarea></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Remarks</p></font></td>
          <td colspan=3><span class=\"tabletext\"><textarea  name="remarks" rows="3"  cols="110" value=""><?php echo $remarks ?></textarea></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td ><span class="labeltext"><p align="left">Type</p></font></td>
          <td colspan=8><span class="tabletext">
          <input type="text" name="potype" id="potype" style="background-color:#DDDDDD;" readonly="readonly"  size=15 value="<?php echo $myrow["type"] ?>"></td>
        </tr>


        <tr bgcolor="#FFFFFF">
          <td colspan=1><span class="labeltext"><p align="left">Communication</p></font></td>
          <?php
          $comm = $myrow["communication"];
          ($comm == 10)?$checked='checked':$checked='';
          echo "<td colspan=8><span class=\"tabletext\"><input type=\"radio\" id=\"communication\" name=\"communication\" value=\"10\" $checked disabled>10";
          ($comm == 20)?$checked='checked':$checked='';
          echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"20\" $checked disabled>20";
          ($comm == 30)?$checked='checked':$checked='';
          echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"30\" $checked disabled>30";
          ($comm == 40)?$checked='checked':$checked='';
          echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"40\" $checked disabled>40";
          ($comm == 50)?$checked='checked':$checked='';
          echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"50\" $checked disabled>50";
          ($comm == 60)?$checked='checked':$checked='';
          echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"60\" $checked disabled>60";
          ($comm == 70)?$checked='checked':$checked='';
          echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"70\" $checked disabled>70";
          ($comm == 80)?$checked='checked':$checked='';
          echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"80\" $checked disabled>80";
          ($comm == 90)?$checked='checked':$checked='';
          echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"90\" $checked disabled>90";
          ($comm == 100)?$checked='checked':$checked='';
          echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"100\" $checked disabled>100</td>";
          ?>
          <input type="hidden" id="comm" name="comm" value=" <?php echo $comm?>">
         <br>
        </table>
      <?php
      }
      ?>


<?php 
if($dept == "Sales" || $dept == "Stores")
{
?>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td colspan=39><span class="heading"><center><b>Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=39 bgcolor="#FFFFFF"><span class="tabletext">To delete line items - blankout line number</td></tr>
<!-- <tr bgcolor='#FFFFFF'>
<td colspan=29></td>
<td bgcolor="#A0C544" colspan=3 align='center'><span class="heading"><b>Compliance</b></td>
<td bgcolor="#659EC7" colspan=3 align='center'><span class="heading"><b>Rating</b></td>
<td colspan=6></td>
</tr> -->

<tr>
<td bgcolor="#EEEFEE"><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Layout Ref#</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>On Time</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>< 7<br/> days late</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>>7 days<br/>late</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Qty<br>Rej</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Spec Type</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Order<br>Qty</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Material Type</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Material Spec</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>RM Con</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>UOM</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Dia</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Length</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Width</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Thick</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>GF</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Max</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>No. of<br/>Units</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Measuring<br/>Unit</b></td>

<td bgcolor="#EEEFEE"><span class="heading"><b>No. Length</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Due </b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Due 1</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Due2</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Delivery By</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>GRN #</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Qty Recd</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Acc. Date</b></td>

<!-- <td bgcolor="#A0C544"><span class="heading"><b>Quality</b></td>
<td bgcolor="#A0C544"><span class="heading"><b>Delivery</b></td>
<td bgcolor="#A0C544"><span class="heading"><b>Comm</b></td>

<td bgcolor="#659EC7" width=4%><span class="heading"><b>Quality</b></td>
<td bgcolor="#659EC7" width=4%><span class="heading"><b>Delivery</b></td>
<td bgcolor="#659EC7" width=4%><span class="heading"><b>Comm</b></td> -->

<td bgcolor="#EEEFEE"><span class="heading"><b>Rate</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Amount</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Status</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Remarks</b></td>


</tr>

  <?php
		$result = $newLI->getLI($porecnum);
		$num_rows=mysql_num_rows($result);
		$i=1;$flag=0;
    $netqus=0;
 		$netdels=0;
		while($i<=30)
		{
			if($flag==0)
			{
				while ($myLI = mysql_fetch_row($result))
  	 		{ 
  	 		  $orderQty=$var = $myLI[25];
  	 		  $no_meters = $myLI[14];
 	 		    $no_length = $myLI[18];
          $qty_ordered = 0;

					printf('<tr bgcolor="#FFFFFF">');
					$linenumber="line_num" . $i;
					$layoutrefnum="layoutrefnum" . $i;
					$crn="crn" . $i;
					$condition="condition" . $i;
					$itemname="rmcode" . $i;
					$itemdesc="item_desc" . $i;
					$qty="qty" . $i;
					$material_ref="material_ref" . $i;
					$material_spec="material_spec" . $i;
					$uom="uom" . $i;
					$dia="dia" . $i;
					$thick="thick" . $i;
					$width="width" . $i;
          $len="len" . $i;
					$grainflow="grainflow" . $i;
					$maxruling="maxruling" . $i;
					$qty_per_meter="qty_per_meter" . $i;
					$no_of_meterages="no_of_meterages" . $i;
					$no_of_lengths="no_of_lengths" . $i;
					$duedate="due_date" . $i;
          $delvby="delvby" . $i;
     			$del="del" . $i;
					$accepted_date="accepted_date" . $i;
					$rate="rate" . $i;
					$amount="amount" . $i;
					$delivery_time = "delivery_time" . $i;
          $delivery = "delivery" . $i;
       		$qty_rej = "qty_rej". $i;
					$prevlinenum="prev_line_num" . $i;
					$lirecnum="lirecnum" . $i;
					$order_qty = "order_qty". $i;
					$alt_spec="alt_spec".$i;
					$spec_type="spec_type".$i;
					$qty_recd="qty_recd".$i;
					$remarks_li="remarks_li".$i;
					$grn_num="grn_num".$i;
					$dia1 = "";
					$thick1 = "";
					$due_datef="due_datef" . $i;
          $due_dates="due_dates" . $i;					
					$num_of_units_req="num_of_units_req" .$i;
					$length1 =  $myLI[12];

				  if (trim($length1) == "")
          {
            $dia1 = $myLI[10];
          }
          else
          {
            $thick1 = $myLI[10];
          }

          $qtyrej = ($myLI[23] != 'NULL')?$myLI[23]:0;
          $on_checked = "";
          $less_checked = "";
          $greater_checked = "";
          //echo'qtyrej='.$myLI["qty_rej"];
          if($myLI[24] == 1)
          {
            $del = 'On Time';
            $del_rating = '100%';
            $on_checked = 'checked';
          }
          else if($myLI[24] == 2)
          {
            $del = '<<br>7 days late';
            $del_rating = '66.67%';
            $less_checked = 'checked';
          }
          else if($myLI[24] == 3)
          {
            $del = '><br>7 days late';
            $del_rating = '33.33%';
            $greater_checked = 'checked';
          }

          $qty_ordered = ($myLI[14]+$myLI[18]);
		      if($qty_ordered > 0)
            $quality = ((($qty_ordered - $qtyrej)/$qty_ordered)*100);
		      else
				    $quality=0;

          if($dept == "Sales" )
          {

  					echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$myLI[0]\" size=\"2%\"></td>";
  					echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$layoutrefnum\"  name=\"$layoutrefnum\"  value=\"$myLI[28]\" size=\"4%\"></td>";

            echo "<input type=\"hidden\" id=\"$prevlinenum\" name=\"$prevlinenum\" value=\"$myLI[0]\">";
  					echo "<input type=\"hidden\" id=\"$lirecnum\" name=\"$lirecnum\" value=\"$myLI[7]\">";
  			    echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"1\" $on_checked size=\"3%\"></td>";

            echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"2\" $less_checked size=\"3%\"></td>";
            echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"3\" $greater_checked size=\"3%\"></td>";
            echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\" value=\"$qtyrej\" size=\"3%\"></td>";
            echo"<td><select name=\"$spec_type\" id=\"$spec_type\" >";
            ?>

            <option selected value="<?php echo $myLI[27]?>"><?php echo $myLI[27]?></option>
            <option value="Primary Spec">Primary Spec</option>
            <option value="Alt Spec1">Alt Spec1</option>
            <option value="Alt Spec2">Alt Spec2</option><</select></td>
           <?php
            echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\"  size=\"8%\" value=\"$myLI[20]\">";
            echo "<img src=\"images/get.gif\" title=\"Get CIM\"  alt=\"Get CIM\" onclick=\"GetCIM4Po('$i')\"></td>";
            echo "<td><input type=\"text\" id=\"$order_qty\" name=\"$order_qty\" size=\"5%\" value=\"$orderQty\"></td>";

  					//	echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"20%\" value=\"$myLI[2]\"></td>";
  					//echo "<td><input type=\"text\" name=\"$qty\" size=\"2%\" value=\"$myLI[3]\"></td>";

  					echo "<td><input type=\"text\" id=\"$material_ref\"  name=\"$material_ref\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[8]\"></td>";
  					echo "<td><input type=\"text\" id=\"$material_spec\" name=\"$material_spec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[9]\"></td>";

  		      echo "<td><span class=\"tabletext\"><textarea id=\"$condition\" name=\"$condition\" rows=\"2\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  cols=\"15\" value=\"\">$myLI[21]</textarea></td>";
  					echo "<td><input type=\"text\" id=\"$uom\" name=\"$uom\" size=\"5%\" value=\"$myLI[16]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

  					echo "<td><input type=\"text\" id=\"$dia\" name=\"$dia\" size=\"5%\" value='$dia1' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
            echo "<td><input type=\"text\" id=\"$width\" name=\"$width\" size=\"5%\" value='$myLI[11]' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
            echo "<td><input type=\"text\" id=\"$len\" name=\"$len\" size=\"5%\"  value='$myLI[12]' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
            echo "<td><input type=\"text\" id=\"$thick\" name=\"$thick\" size=\"5%\" value='$thick1' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

  					echo "<td><input type=\"text\" id=\"$grainflow\" name=\"$grainflow\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[17]'></td>";
  					echo "<td><input type=\"text\" id=\"$maxruling\" name=\"$maxruling\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[22]'></td>";
            echo "<td><input type=\"text\" id=\"$no_of_meterages\" name=\"$no_of_meterages\" size=\"5%\" value=\"$no_meters\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

            if(strtoupper($myLI[16]) == 'MM')
  					  $no_units_req='Mts';
  				  else if(strtoupper($myLI[16]) == 'INCHES')
  					  $no_units_req='Ft';
  			    else
    					$no_units_req='';

            echo "<td><input type=\"text\" id=\"$num_of_units_req\" name=\"$num_of_units_req\" size=\"5%\" value=\"$no_units_req\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
  		      echo "<td><input type=\"text\" id=\"$no_of_lengths\" name=\"$no_of_lengths\" size=\"5%\" value=\"$no_length\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

            echo "<input type=\"hidden\" id=\"$alt_spec\" name=\"$alt_spec\" value=\"$myLI[26]\"></td>";
            echo "<td><input type=\"text\" id=\"$duedate\" name=\"$duedate\"	style=\"background-color:#DDDDDD;\"	readonly=\"readonly\" size=\"7%\" value=\"$myLI[4]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$duedate')\">";
            echo "<td><input type=\"text\" id=\"$due_datef\" name=\"$due_datef\"	style=\"background-color:#DDDDDD;\"	readonly=\"readonly\" size=\"7%\" value=\"$myLI[33]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$due_datef')\">";

            echo "<td><input type=\"text\" id=\"$due_dates\" name=\"$due_dates\"	style=\"background-color:#DDDDDD;\"	readonly=\"readonly\" size=\"7%\" value=\"$myLI[34]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$due_dates')\">";

            echo "<td> <span class=\"tabletext\"><input type=\"text\" id=\"$delvby\" name=\"$delvby\" readonly=\"readonly\" size=\"4%\" value=\"$myLI[15]\"
                <span class=\"tabletext\"><select id=\"$del\" name=\"$del\" onchange=\"onSelectDel($i)\">
                  <option value>SEA
                  <option value>AIR
                <option value>LAND
                </select></td>";

      				echo "<td><input type=\"text\" id=\"$grn_num\"  name=\"$grn_num\"  size=\"10%\" value=\"$myLI[32]\"></td>";
              echo "<td><input type=\"text\" id=\"$qty_recd\" name=\"$qty_recd\" size=\"5%\" value=\"$myLI[29]\" </td>";
              echo "<td><input type=\"text\" id=\"$accepted_date\" name=\"$accepted_date\"	style=\"background-color:#DDDDDD;\"
                    readonly=\"readonly\" size=\"8%\" value=\"$myLI[19]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$accepted_date')\">";

                      // printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f%s"></td>',$quality,'%');
                      // printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f%s"></td>',$del_rating,'%');
                      // printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f%s"></td>',$comm,'%');
                      // $netqu=($quality*0.6);
                      // $netdel=($del_rating*0.3);
                      // $netcomm=($comm*0.1);

                      // printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f"></td>',$netqu);
                      // printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f"></td>',$netdel);
                      // printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f"></td>',$netcomm);


              echo "<td><input type=\"text\" name=\"$rate\"  id=\"$rate\" size=\"5%\" value=\"$myLI[5]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
              echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\"	readonly=\"readonly\" size=\"5%\" value=\"$myLI[6]\">";
              echo "<input type=\"hidden\" name=\"$delivery\" id=\"$delivery\"  value=\"\">";
              ?>
              <td><center><select  name="li_status<?php echo $i ?>" id="li_status<?php echo $i ?>"  >
                  <?php $selected = 'selected'; ?>
                 <option value="Open" <?php if($myLI[30] == 'Open') echo $selected?>>Open</option>
                 <option value="Close" <?php if($myLI[30] == 'Close') echo $selected?>>Close</option>
                 <option value="Amend Close" <?php if($myLI[30] == 'Amend Close') echo $selected?>>Amend Close</option>
                 </select></center>
              </td>

              <?php
                $remarksli=wordwrap($myLI[31],12,"\n",true);
                echo "<td><span class=\"tabletext\"><textarea id=\"$remarks_li\" name=\"$remarks_li\" rows=\"2\"
                cols=\"15\" >$remarksli</textarea></td>";
                printf('</tr>');


              }
              else 
              {
                echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$myLI[0]\" size=\"2%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
                echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$layoutrefnum\"  name=\"$layoutrefnum\"  value=\"$myLI[28]\" size=\"4%\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";

                echo "<input type=\"hidden\" id=\"$prevlinenum\" name=\"$prevlinenum\" value=\"$myLI[0]\">";
                echo "<input type=\"hidden\" id=\"$lirecnum\" name=\"$lirecnum\" value=\"$myLI[7]\">";

                echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"1\" $on_checked size=\"3%\" disabled></td>";
                echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"2\" $less_checked size=\"3%\" disabled></td>";
                echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"3\" $greater_checked size=\"3%\" disabled></td>";

                echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\" value=\"$qtyrej\" size=\"3%\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";
                echo"<td><select name=\"$spec_type\" id=\"$spec_type\" >";
                ?>

                <option value="<?php echo $myLI[27]?>" <?php if($myLI[27] == "Primary Spec"){ echo "selected='selected'";} ?> >Primary Spec</option>
                <option value="Alt Spec1" <?php if($myLI[27] == "Alt Spec1"){ echo "selected='selected'";} ?> >Alt Spec1</option>
                <option value="Alt Spec2" <?php if($myLI[27] == "Alt Spec2"){ echo "selected='selected'";} ?> >Alt Spec2</option><</select></td>

               <?php
                echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\"  size=\"8%\" value=\"$myLI[20]\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";
                echo "<td><input type=\"text\" id=\"$order_qty\" name=\"$order_qty\" size=\"5%\" value=\"$orderQty\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";

                //  echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"20%\" value=\"$myLI[2]\"></td>";
                //echo "<td><input type=\"text\" name=\"$qty\" size=\"2%\" value=\"$myLI[3]\"></td>";

                echo "<td><input type=\"text\" id=\"$material_ref\"  name=\"$material_ref\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[8]\"></td>";
                echo "<td><input type=\"text\" id=\"$material_spec\" name=\"$material_spec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[9]\"></td>";

                echo "<td><span class=\"tabletext\"><textarea id=\"$condition\" name=\"$condition\" rows=\"2\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  cols=\"15\" value=\"\">$myLI[21]</textarea></td>";
                echo "<td><input type=\"text\" id=\"$uom\" name=\"$uom\" size=\"5%\" value=\"$myLI[16]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

                echo "<td><input type=\"text\" id=\"$dia\" name=\"$dia\" size=\"5%\" value='$dia1' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
                echo "<td><input type=\"text\" id=\"$width\" name=\"$width\" size=\"5%\" value='$myLI[11]' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
                echo "<td><input type=\"text\" id=\"$len\" name=\"$len\" size=\"5%\"  value='$myLI[12]' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
                echo "<td><input type=\"text\" id=\"$thick\" name=\"$thick\" size=\"5%\" value='$thick1' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

                echo "<td><input type=\"text\" id=\"$grainflow\" name=\"$grainflow\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[17]'></td>";
                echo "<td><input type=\"text\" id=\"$maxruling\" name=\"$maxruling\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[22]'></td>";
                echo "<td><input type=\"text\" id=\"$no_of_meterages\" name=\"$no_of_meterages\" size=\"5%\" value=\"$no_meters\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

                if(strtoupper($myLI[16]) == 'MM')
                  $no_units_req='Mts';
                else if(strtoupper($myLI[16]) == 'INCHES')
                  $no_units_req='Ft';
                else
                  $no_units_req='';

                echo "<td><input type=\"text\" id=\"$num_of_units_req\" name=\"$num_of_units_req\" size=\"5%\" value=\"$no_units_req\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
                echo "<td><input type=\"text\" id=\"$no_of_lengths\" name=\"$no_of_lengths\" size=\"5%\" value=\"$no_length\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

                echo "<input type=\"hidden\" id=\"$alt_spec\" name=\"$alt_spec\" value=\"$myLI[26]\"></td>";
                echo "<td><input type=\"text\" id=\"$duedate\" name=\"$duedate\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"7%\" value=\"$myLI[4]\">";
                echo "<td><input type=\"text\" id=\"$due_datef\" name=\"$due_datef\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"7%\" value=\"$myLI[33]\">";

                echo "<td><input type=\"text\" id=\"$due_dates\" name=\"$due_dates\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"7%\" value=\"$myLI[34]\">";

                echo "<td> <span class=\"tabletext\"><input type=\"text\" id=\"$delvby\" name=\"$delvby\" readonly=\"readonly\" size=\"4%\" value=\"$myLI[15]\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

                  echo "<td><input type=\"text\" id=\"$grn_num\"  name=\"$grn_num\"  size=\"10%\" value=\"$myLI[32]\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";
                  echo "<td><input type=\"text\" id=\"$qty_recd\" name=\"$qty_recd\" size=\"5%\" value=\"$myLI[29]\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\" > </td>";
                  echo "<td><input type=\"text\" id=\"$accepted_date\" name=\"$accepted_date\"  style=\"background-color:#DDDDDD;\"  readonly=\"readonly\" size=\"8%\" value=\"$myLI[19]\">";

                          // printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f%s"></td>',$quality,'%');
                          // printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f%s"></td>',$del_rating,'%');
                          // printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f%s"></td>',$comm,'%');
                          // $netqu=($quality*0.6);
                          // $netdel=($del_rating*0.3);
                          // $netcomm=($comm*0.1);

                          // printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f"></td>',$netqu);
                          // printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f"></td>',$netdel);
                          // printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f"></td>',$netcomm);


                  echo "<td><input type=\"text\" name=\"$rate\"  id=\"$rate\" size=\"5%\" value=\"$myLI[5]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
                  echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\" size=\"5%\" value=\"$myLI[6]\">";
                  echo "<input type=\"hidden\" name=\"$delivery\" id=\"$delivery\"  value=\"\">";

                  echo "<td><input type=\"text\" name=\"li_status$i\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\" size=\"5%\" value=\"$myLI[30]\">";

                  $remarksli=wordwrap($myLI[31],12,"\n",true);
                  echo "<td><span class=\"tabletext\"><textarea id=\"$remarks_li\" name=\"$remarks_li\" rows=\"2\"
                  cols=\"15\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\">$remarksli</textarea></td>";
                  printf('</tr>');
              }

              $i++;

              $netqus = $netqus+$netqu;
              $netdels =$netdels+ $netdel;
              $netcomms =$netcomms+ $netcomm;
        }
        $flag=1;
      }
      if ($i <= 30) 
      {

		    printf('<tr bgcolor="#FFFFFF">');
    		$linenumber="line_num" . $i;
    		$layoutrefnum="layoutrefnum" . $i;
  			$itemname="rmcode" . $i;
  			$crn="crn" . $i;
  			$qty="qty" . $i;
  			$material_ref="material_ref" . $i;
  			$duedate="due_date" . $i;
        $delvby="delvby" . $i;
        $del="del" . $i;
  			$accepted_date="accepted_date" . $i;
  			$rate="rate" . $i;
  			$amount="amount" . $i;
  			$prevlinenum="prev_line_num" . $i;
  			$lirecnum="lirecnum" . $i;
  			$material_spec="material_spec" . $i;
  			$dia = "dia" . $i;
        $thick="thick" . $i;
        $width="width" . $i;
		    $len="len" . $i;
		    $qty_per_meter="qty_per_meter" . $i;
		    $no_of_meterages="no_of_meterages" . $i;
  			$uom="uom" . $i;
  			$no_of_lengths="no_of_lengths" . $i;
  			$grainflow="grainflow" . $i;
  			$maxruling="maxruling" . $i;
  			$condition="condition" . $i;
  			$delivery_time = "delivery_time" . $i;
        $delivery = "delivery" . $i;
        $qty_rej = "qty_rej". $i;
        $order_qty="order_qty".$i;
        $alt_spec="alt_spec".$i;
        $spec_type="spec_type".$i;
        $qty_recd="qty_recd".$i;
        $remarks_li="remarks_li".$i;
        $grn_num="grn_num".$i;
        $due_datef="due_datef" . $i;
		    $due_dates="due_dates" . $i;

		    if($dept == "Sales" )
        {
    	    echo "<td><span class=\"tabletext\"><input type=\"text\"  id=\"$linenumber\" name=\"$linenumber\"  value=\"\" size=\"3%\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";
    		  echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$layoutrefnum\"  name=\"$layoutrefnum\"  value=\"\" size=\"4%\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";
          echo "<input type=\"hidden\" id=\"$prevlinenum\" name=\"$prevlinenum\" value=\"\">";
    	    echo "<input type=\"hidden\" id=\"$lirecnum\" name=\"$lirecnum\" value=\"$myLI[7]\">";

    	    echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"1\" size=\"3%\" disabled></td>";
          echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"2\" size=\"3%\" disabled></td>";
          echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"3\" size=\"3%\" disabled></td>";

          echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\" value=\"\" size=\"3%\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";
          echo"<td><select name=\"$spec_type\" id=\"$spec_type\" >";
          ?>

          <option value="Primary Spec">Primary Spec</option>
          <option value="Alt Spec1">Alt Spec1</option>
          <option value="Alt Spec2">Alt Spec2</option><</select></td>

          <?php
          echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\"  size=\"8%\" value=\"\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";

          echo "<td><input type=\"text\" id=\"$order_qty\" name=\"$order_qty\" size=\"5%\" value=\"$myLI[25]\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";

          echo "<td><input type=\"text\" id=\"$material_ref\" name=\"$material_ref\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[8]\"></td>";
    	    echo "<td><input type=\"text\" id=\"$material_spec\" name=\"$material_spec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[9]\"></td>";
    	    echo "<td><span class=\"tabletext\"><textarea  id=\"$condition\" name=\"$condition\" rows=\"2\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\"   cols=\"15\" value=\"\"></textarea></td>";
    	    echo "<td><input type=\"text\" id=\"$uom\" name=\"$uom\" size=\"5%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

    	    echo "<td><input type=\"text\" id=\"$dia\" name=\"$dia\" size=\"5%\"  value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
          echo "<td><input type=\"text\" id=\"$width\" name=\"$width\" size=\"5%\"  value='' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
          echo "<td><input type=\"text\" id=\"$len\" name=\"$len\"  size=\"5%\" value=''style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
          echo "<td><input type=\"text\" id=\"$thick\" name=\"$thick\"  size=\"5%\"  value='' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

    			echo "<td><input type=\"text\" id=\"$grainflow\" name=\"$grainflow\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[17]'></td>";
    			echo "<td><input type=\"text\" id=\"$maxruling\" name=\"$maxruling\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[22]'></td>";
          echo "<td><input type=\"text\" id=\"$no_of_meterages\" name=\"$no_of_meterages\" size=\"5%\" value=\"$myLI[14]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

          if(strtoupper($myLI[16]) == 'MM')
    				$no_units_req='Mts';
    			else if(strtoupper($myLI[16]) == 'INCHES')
    				$no_units_req='Ft';
    			else
    				$no_units_req='';

          echo "<td><input type=\"text\" id=\"$num_of_units_req\" name=\"$num_of_units_req\" size=\"5%\" value=\"$no_units_req\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    		  echo "<td><input type=\"text\" id=\"$no_of_lengths\" name=\"$no_of_lengths\" size=\"5%\" value=\"$myLI[18]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
          echo "<input type=\"hidden\" id=\"$alt_spec\" name=\"$alt_spec\" value=\"$myLI[26]\"></td>";

          echo "<td><input type=\"text\" id=\"$duedate\" name=\"$duedate\"	style=\"background-color:#DDDDDD;\"	readonly=\"readonly\" size=\"7%\" value=\"\">";
          echo "<td><input type=\"text\" id=\"$due_datef\" name=\"$due_datef\"	style=\"background-color:#DDDDDD;\"	readonly=\"readonly\" size=\"7%\" value=\"$myLI[33]\">";
                        
          echo "<td><input type=\"text\" id=\"$due_dates\" name=\"$due_dates\"	style=\"background-color:#DDDDDD;\"	readonly=\"readonly\" size=\"7%\" value=\"$myLI[34]\">";

          echo "<td>  <span class=\"tabletext\"><input type=\"text\" id=\"$delvby\" name=\"$delvby\" readonly=\"readonly\" size=\"4%\" value=\"$myLI[15]\"
             <span class=\"tabletext\"><select id=\"$del\" name=\"$del\" size=\"1\" onchange=\"onSelectDel($i)\">
               <option value>SEA
               <option value>AIR
             <option value>LAND
             </select></td>";

          echo "<td><input type=\"text\" id=\"$grn_num\"  name=\"$grn_num\"  size=\"10%\" value=\"$myLI[32]\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";
          echo "<td><input type=\"text\" id=\"$qty_recd\" name=\"$qty_recd\" size=\"5%\" value=\"$myLI[29]\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"
           ></td>";

          echo "<td><input type=\"text\" id=\"$accepted_date\" name=\"$accepted_date\"	style=\"background-color:#DDDDDD;\"	readonly=\"readonly\" size=\"8%\" value=\"\">";

    	 	  echo "<td align=\"right\"><input type=\"text\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"\"></td>";
    			echo "<td align=\"right\"><input type=\"text\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"\"></td>";

           //  echo "<td align=\"right\"><input type=\"text\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"5%\" value=\"\"></td>";
           //   echo "<td><input type=\"text\" id=\"$netquality\" name=\"$netquality\" style=\"background-color:#DDDDDD;\"
      	  		// 	readonly=\"readonly\" size=\"5%\" value=\"\">";
           //   echo "<td><input type=\"text\" id=\"$netdelivery\" name=\"$netdelivery\" style=\"background-color:#DDDDDD;\"
      	  		// 	readonly=\"readonly\" size=\"5%\" value=\"\">";
           //   echo "<td><input type=\"text\" id=\"$netcomm\" name=\"$netcomm\" style=\"background-color:#DDDDDD;\"
      	  		// 	readonly=\"readonly\" size=\"5%\" value=\"\">";

           //  echo "<td><input type=\"text\" id=\"$rate\" name=\"$rate\" size=\"5%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
              // echo "<td><input type=\"text\" id=\"$amount\" name=\"$amount\" style=\"background-color:#DDDDDD;\"
      	  		// 	readonly=\"readonly\" size=\"5%\" value=\"\">";
          echo "<input type=\"hidden\" name=\"$delivery\" id=\"$delivery\"  value=\"\">";
          echo "<td align=\"right\"><input type=\"text\" name=\"li_status$i\" id=\"li_status$i\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"\"></td>";

          $remarksli=wordwrap($myLI[31],12,"\n",true);
          echo "<td><span class=\"tabletext\"><textarea id=\"$remarks_li\" name=\"$remarks_li\" rows=\"2\"
          cols=\"15\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">$remarksli</textarea></td>";
      		printf('</tr>');
        }
        else
        {
          echo "<td><span class=\"tabletext\"><input type=\"text\"  id=\"$linenumber\" name=\"$linenumber\"  value=\"\" size=\"3%\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";
          echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$layoutrefnum\"  name=\"$layoutrefnum\"  value=\"\" size=\"4%\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";
          echo "<input type=\"hidden\" id=\"$prevlinenum\" name=\"$prevlinenum\" value=\"\">";
          echo "<input type=\"hidden\" id=\"$lirecnum\" name=\"$lirecnum\" value=\"$myLI[7]\">";

          echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"1\" size=\"3%\" disabled></td>";
          echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"2\" size=\"3%\" disabled></td>";
          echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"3\" size=\"3%\" disabled></td>";

          echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\" value=\"\" size=\"3%\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";
          echo"<td><select name=\"$spec_type\" id=\"$spec_type\" >";
          ?>

          <option value="Primary Spec">Primary Spec</option>
          <option value="Alt Spec1">Alt Spec1</option>
          <option value="Alt Spec2">Alt Spec2</option><</select></td>

          <?php
          echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\"  size=\"8%\" value=\"\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";

          echo "<td><input type=\"text\" id=\"$order_qty\" name=\"$order_qty\" size=\"5%\" value=\"$myLI[25]\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";

          echo "<td><input type=\"text\" id=\"$material_ref\" name=\"$material_ref\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[8]\"></td>";
          echo "<td><input type=\"text\" id=\"$material_spec\" name=\"$material_spec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[9]\"></td>";
          echo "<td><span class=\"tabletext\"><textarea  id=\"$condition\" name=\"$condition\" rows=\"2\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\"   cols=\"15\" value=\"\"></textarea></td>";
          echo "<td><input type=\"text\" id=\"$uom\" name=\"$uom\" size=\"5%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

          echo "<td><input type=\"text\" id=\"$dia\" name=\"$dia\" size=\"5%\"  value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
          echo "<td><input type=\"text\" id=\"$width\" name=\"$width\" size=\"5%\"  value='' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
          echo "<td><input type=\"text\" id=\"$len\" name=\"$len\"  size=\"5%\" value=''style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
          echo "<td><input type=\"text\" id=\"$thick\" name=\"$thick\"  size=\"5%\"  value='' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

          echo "<td><input type=\"text\" id=\"$grainflow\" name=\"$grainflow\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[17]'></td>";
          echo "<td><input type=\"text\" id=\"$maxruling\" name=\"$maxruling\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[22]'></td>";
          echo "<td><input type=\"text\" id=\"$no_of_meterages\" name=\"$no_of_meterages\" size=\"5%\" value=\"$myLI[14]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

          if(strtoupper($myLI[16]) == 'MM')
            $no_units_req='Mts';
          else if(strtoupper($myLI[16]) == 'INCHES')
            $no_units_req='Ft';
          else
            $no_units_req='';

          echo "<td><input type=\"text\" id=\"$num_of_units_req\" name=\"$num_of_units_req\" size=\"5%\" value=\"$no_units_req\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
          echo "<td><input type=\"text\" id=\"$no_of_lengths\" name=\"$no_of_lengths\" size=\"5%\" value=\"$myLI[18]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
          echo "<input type=\"hidden\" id=\"$alt_spec\" name=\"$alt_spec\" value=\"$myLI[26]\"></td>";

          echo "<td><input type=\"text\" id=\"$duedate\" name=\"$duedate\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"7%\" value=\"\">";
          echo "<td><input type=\"text\" id=\"$due_datef\" name=\"$due_datef\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"7%\" value=\"$myLI[33]\">";
                        
          echo "<td><input type=\"text\" id=\"$due_dates\" name=\"$due_dates\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"7%\" value=\"$myLI[34]\">";

          echo "<td>  <span class=\"tabletext\"><input type=\"text\" id=\"$delvby\" name=\"$delvby\" readonly=\"readonly\" size=\"4%\" value=\"$myLI[15]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

          echo "<td><input type=\"text\" id=\"$grn_num\"  name=\"$grn_num\"  size=\"10%\" value=\"$myLI[32]\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"></td>";
          echo "<td><input type=\"text\" id=\"$qty_recd\" name=\"$qty_recd\" size=\"5%\" value=\"$myLI[29]\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\"
           ></td>";

          echo "<td><input type=\"text\" id=\"$accepted_date\" name=\"$accepted_date\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"8%\" value=\"\">";

          echo "<td align=\"right\"><input type=\"text\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"\"></td>";
          echo "<td align=\"right\"><input type=\"text\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"\"></td>";

           //  echo "<td align=\"right\"><input type=\"text\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"5%\" value=\"\"></td>";
           //   echo "<td><input type=\"text\" id=\"$netquality\" name=\"$netquality\" style=\"background-color:#DDDDDD;\"
              //  readonly=\"readonly\" size=\"5%\" value=\"\">";
           //   echo "<td><input type=\"text\" id=\"$netdelivery\" name=\"$netdelivery\" style=\"background-color:#DDDDDD;\"
              //  readonly=\"readonly\" size=\"5%\" value=\"\">";
           //   echo "<td><input type=\"text\" id=\"$netcomm\" name=\"$netcomm\" style=\"background-color:#DDDDDD;\"
              //  readonly=\"readonly\" size=\"5%\" value=\"\">";

           //  echo "<td><input type=\"text\" id=\"$rate\" name=\"$rate\" size=\"5%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
              // echo "<td><input type=\"text\" id=\"$amount\" name=\"$amount\" style=\"background-color:#DDDDDD;\"
              //  readonly=\"readonly\" size=\"5%\" value=\"\">";
          echo "<input type=\"hidden\" name=\"$delivery\" id=\"$delivery\"  value=\"\">";
          echo "<td align=\"right\"><input type=\"text\" name=\"li_status$i\" id=\"li_status$i\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"\"></td>";

          $remarksli=wordwrap($myLI[31],12,"\n",true);
          echo "<td><span class=\"tabletext\"><textarea id=\"$remarks_li\" name=\"$remarks_li\" rows=\"2\"
          cols=\"15\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">$remarksli</textarea></td>";
          printf('</tr>');
        }

  		  $i++;
      }
    }
?>

  <input type="hidden" name="page" value="edit">
  <!-- <tr bgcolor="#FFFFFF">
  <td colspan=30 align="right"><span class="tabletext"><b>Average</b></td> -->
  <?
    $netquality=$netqus/$num_rows;
    $netdelivery=$netdels/$num_rows;
    $netcommunication=$netcomms/$num_rows;
    $nettotal = ($netquality+$netdelivery+$comm);
  ?>

  <!-- <td align=right><span class="tabletext" ><?php printf('%.2f',$netquality); ?></td>
  <td align=right><span class="tabletext"><?php printf('%.2f',$netdelivery); ?></td>
  <td align=right><span class="tabletext"><?php printf('%.2f',$netcommunication); ?></td>
  <td colspan=6></td>
  </tr>

  <tr bgcolor="#FFFFFF">
  <td colspan=31 align="right"><span class="tabletext"><b>Total,pts</b></td>
  <td colspan=2 align="right"><span class="tabletext" ><?php printf('%.2f',$nettotal); ?></td>
  <td colspan=6></td>
  </tr> -->


  <tr bgcolor="#FFFFFF">
    <td align="right" colspan=30><span class="tabletext"><b>Total</b></td>
    <td><span class="tabletext" align=right><?php printf('%s %.2f',$myrow["currency"],$myrow["poamount"]); ?></td>
    <td colspan=5>&nbsp;</td>
  </tr>


  <tr bgcolor="#FFFFFF">
    <td  align="right" colspan=30><span class="tabletext"><b>Tax</b></td>
    <td><span class="tabletext"><input type='text' name='tax' size='5%' value='<?php printf('%.2f',$myrow["tax"]); ?>'></td>
    <td colspan=5>&nbsp;</td>
  </tr>


  <tr bgcolor="#FFFFFF">
    <td colspan=30 align="right"><span class="tabletext"><b>Shipping</b></td>
    <td><span class="tabletext"><input type='text' name='shipping' size='5%' value='<?php printf('%.2f',$myrow["shipping"]); ?>'></td>
    <td colspan=5>&nbsp;</td>
  </tr>


  <tr bgcolor="#FFFFFF">
    <td colspan=30 align="right"><span class="tabletext"><b>Labor</b></td>
    <td><span class="tabletext"><input type='text' name='labor' size='5%' value='<?php printf('%.2f',$myrow["labor"]); ?>'></td>
    <td colspan=5>&nbsp;</td>
  </tr>


  <tr bgcolor="#FFFFFF">
    <td colspan=30 align="right"><span class="tabletext"><b>Total Due</b></td>
    <td><span class="tabletext" align=right><?php printf('%s %.2f',$myrow["currency"],$myrow["total_due"]); ?></td>
    <td colspan=5>&nbsp;</td>
  </tr>

  </tr>
  <input type="hidden" name="deleteflag" value="">
</table>
</td>
</tr>
</table>
</td>
<?php
}
  
if($dept=='Purchasing' && $myrow["approval"] != 'yes')
{
?>
  <input type="hidden" name="noedit"  id="noedit" value="">
  <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

  <tr bgcolor="#FFFFFF" >
    <td width=20%><span class="labeltext"><p align="left">PO Date</p></font></td>
    <td width=40% ><input type="text" name="podate"   id="podate"  style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["podate"] ?>">
    <img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('podate')"></td>
    <td width=15%><span class="labeltext"><p align="left">PO #</p></font></td>
     <td width=20%><span class="tabletext"><input type="text"  name="ponum" value="<?php echo $myrow["ponum"] ?>" style="background-color:#DDDDDD;" readonly="readonly" ></td>
  </tr>

  <tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">PO Desc</p></font></td>
    <td ><span class="tabletext"><input type="text"   name="desc"  size =40% value="<?php echo $myrow["podescr"] ?>"></td>
    <td><span class="labeltext"><p align="left">Currency</p></font></td>
    <td><span class="tabletext"><input type="text" name="currency"  style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow["currency"] ?>">
  	<span class="tabletext"><select name="pocurr" size="1" width="20" onchange="onSelectCurr()">
   	<option selected>Please Specify
  	<option value>$
   	<option value>Rs
  	<option value>GBP
     	<option value>Euro
  	</select>
   </td>
  </tr>

  <tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">Status</p></font></td>
    <td colspan=3><span class="tabletext"><input type="text" name="status" id="status"  style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow["status"] ?>">
    	<span class="tabletext"><select name="postat" id="postat" size="1" width="20" onchange="onSelectStatus()">
        <option selected>Please Specify
    	<option value>Open
     	<option value>Issued
    	<option value>Closed
    	<option value>Cancelled
     	</select>
    </td>
  </tr>
  <!--<td></td><td></td>
  <td><span class="labeltext"><p align="left">Status</p></font></td>
  <td colspan=2><span class="tabletext"><input type="text" name="status"
                  style="background-color:#DDDDDD;" readonly="readonly"  value="<?php// echo $myrow["status"] ?>"
  	<span class="tabletext"><select name="postat" size="1" width="20" onchange="onSelectStatus()">
   	<option selected>Please Specify
  	<option value>Open
   	<option value>Issued
  	<option value>Closed
         	<option value>Cancelled
  	</select>
   </td>-->
 
  <tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">Approval</p></font></td>
    <?php
    if($myrow["approval"] == 'yes'){
      $checked1="checked";
    }
    $date=date("Y-m-d");
    ?>
    <td bgcolor="#FFFFFF">
      <input type="checkbox" <?php echo $checked1 ?> name="chk1"  onClick="return readOnlyCheckBox()">
      <input type="hidden" name="approval" value="<?php echo $myrow["approval"]?>" id="approval">
    </td>
    <td width=20%><span class="labeltext"><p align="left">Approval Date</p></font></td>
    <td width=40% ><input type="text" name="approvaldate" id="approvaldate"style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["approvaldate"] ?>">
    </td>
  </tr>

  <tr bgcolor="#FFFFFF">
    <td width=15%><span class="labeltext"><p align="left">Amendment No.</p></font></td>
    <td width=20%><span class="tabletext"><input type="text"  name="amendment_num" id="amendment_num" value="<?php echo $myrow["amendment_num"] ?>"></td>
    <td width=20%><span class="labeltext"><p align="left">Amendment Date</p></font></td>
    <td width=40% ><input type="text" name="amendmentdate" id="amendmentdate" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["amendmentdate"] ?>">
	 <img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('amendmentdate')"></td>
  </tr>

  <?
    $amend_notes=wordwrap($myrow["amendment_notes"],100,"<br />",true);
  ?>
  <tr bgcolor="#FFFFFF" >
    <td><span class="labeltext"><p align="left">Amendment Notes</p></font></td>
    <td colspan=3><span class="tabletext"><textarea  name="amendment_notes" id="amendment_notes" rows="3" cols="100" value=""><?php echo $amend_notes." \n"?></textarea></td>
  </tr>

  <?
    $terms=wordwrap($myrow["terms"],100,"\n");
  ?>

  <tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">Header</p></font></td>
    <td colspan=3><span class="tabletext"><textarea  name="terms" rows="2" cols="100" value=""><?php echo $terms?></textarea></td>
  </tr>

  <tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">Remarks</p></font></td>
    <td colspan=5><span class=\"tabletext\"><textarea  name="remarks" rows="3"  cols="170" value=""><?php echo $remarks ?></textarea></td>
  </tr>

  <tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">Type</p></font></td>
    <td colspan=8><span class="tabletext">
    <input type="text" name="potype" id="potype" style="background-color:#DDDDDD;" readonly="readonly"  size=15 value="<?php echo $myrow["type"] ?>">
    <select name="potype_sel" id="potype_sel" size="1" width="100" onchange="onSelecttype()">
      <option selected value="Bought Out">Bought Out
      <option value="Regular">Regular
    </select></td>
   </tr>

  <tr bgcolor="#FFFFFF">
    <td colspan=1><span class="labeltext"><p align="left">Communication</p></font></td>
    <?php
    $comm = $myrow["communication"];
    ($comm == 10)?$checked='checked':$checked='';
    echo "<td colspan=8><span class=\"tabletext\"><input type=\"radio\" id=\"communication\" name=\"communication\" value=\"10\" $checked>10";
    ($comm == 20)?$checked='checked':$checked='';
    echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"20\" $checked>20";
    ($comm == 30)?$checked='checked':$checked='';
    echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"30\" $checked>30";
    ($comm == 40)?$checked='checked':$checked='';
    echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"40\" $checked>40";
    ($comm == 50)?$checked='checked':$checked='';
    echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"50\" $checked>50";
    ($comm == 60)?$checked='checked':$checked='';
    echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"60\" $checked>60";
    ($comm == 70)?$checked='checked':$checked='';
    echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"70\" $checked>70";
    ($comm == 80)?$checked='checked':$checked='';
    echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"80\" $checked>80";
    ($comm == 90)?$checked='checked':$checked='';
    echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"90\" $checked>90";
    ($comm == 100)?$checked='checked':$checked='';
    echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"100\" $checked>100</td>";
    ?>
    <input type="hidden" id="comm" name="comm" value=" <?php echo $comm?>">
  <br>
  </tr>
  </table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td colspan=38><span class="heading"><center><b>Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=38 bgcolor="#FFFFFF"><span class="tabletext">To delete line items - blankout line number</td></tr>
<tr bgcolor='#FFFFFF'>
<td colspan=28></td>
<td bgcolor="#A0C544" colspan=3 align='center'><span class="heading"><b>Compliance</b></td>
<td bgcolor="#659EC7" colspan=3 align='center'><span class="heading"><b>Rating</b></td>
<td colspan=4></td>
</tr>
<tr>
<td bgcolor="#EEEFEE"><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Layout Ref#</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>On Time</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>< 7<br/> days late</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>>7 days<br/>late</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Qty<br>Rej</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Spec Type</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Order Qty</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Material Type</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Material Spec</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>RM Con</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>UOM</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Dia</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Length</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Width</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Thick</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>GF</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Max</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>No. Meter</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>No. Length</b></td>

<td bgcolor="#EEEFEE"><span class="heading"><b>Due </b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Due 1</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Due2</b></td>


<td bgcolor="#EEEFEE"><span class="heading"><b>Delivery By</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>GRN #</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Qty Recd</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Acc. Date</b></td>
<td bgcolor="#A0C544"><span class="heading"><b>Quality</b></td>
<td bgcolor="#A0C544"><span class="heading"><b>Delivery</b></td>
<td bgcolor="#A0C544"><span class="heading"><b>Comm</b></td>

<td bgcolor="#659EC7" width=4%><span class="heading"><b>Quality</b></td>
<td bgcolor="#659EC7" width=4%><span class="heading"><b>Delivery</b></td>
<td bgcolor="#659EC7" width=4%><span class="heading"><b>Comm</b></td>

<td bgcolor="#EEEFEE"><span class="heading"><b>Rate</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Amount</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Status</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Remarks</b></td>
<?php
  		$result = $newLI->getLI($porecnum);
  		$num_rows=mysql_num_rows($result);
		$i=1;$flag=0;
		while($i<=30)
		{
			if($flag==0)
			{
				while ($myLI = mysql_fetch_row($result))
	  	 		{
                    $orderQty=$myLI[25];
                    $no_meters = $myLI[14];
 	 		        $no_length = $myLI[18];
                    $qty_ordered = 0;
					//echo "i am inside inner while loop";
					printf('<tr bgcolor="#FFFFFF">');
					$linenumber="line_num" . $i;
					$layoutrefnum="layoutrefnum" . $i;
					$crn="crn" . $i;
					$condition="condition" . $i;
					$itemname="rmcode" . $i;
					$itemdesc="item_desc" . $i;
					$qty="qty" . $i;
					$material_ref="material_ref" . $i;
					$material_spec="material_spec" . $i;
					$uom="uom" . $i;
					$dia="dia" . $i;
					$thick="thick" . $i;
					$width="width" . $i;
				    $len="len" . $i;
					$grainflow="grainflow" . $i;
					$maxruling="maxruling" . $i;
					$qty_per_meter="qty_per_meter" . $i;
					$no_of_meterages="no_of_meterages" . $i;
					$no_of_lengths="no_of_lengths" . $i;
					$duedate="due_date" . $i;
                    $delvby="delvby" . $i;
                    $del="del" . $i;
					$accepted_date="accepted_date" . $i;
					$rate="rate" . $i;
					$amount="amount" . $i;
				    $delivery_time = "delivery_time" . $i;
 	                $delivery = "delivery" . $i;
                    $qty_rej = "qty_rej". $i;
                    $order_qty = "order_qty". $i;
                    $alt_spec = "alt_spec". $i;
                    $spec_type="spec_type".$i;
					$prevlinenum="prev_line_num" . $i;
					$lirecnum="lirecnum" . $i;
					$qty_recd="qty_recd".$i;
                     $remarks_li="remarks_li".$i;
                     $grn_num="grn_num".$i;
                     $due_datef="due_datef" . $i;
					 $num_of_units_req="num_of_units_req" .$i;
		  $due_dates="due_dates" . $i;
					$dia1 = "";
					$thick1 = "";
					$length1 =  $myLI[12];
					 if (trim($length1) == "")
                     {
                        $dia1 = $myLI[10];
                     }
                     else
                     {
                        $thick1 = $myLI[10];
                     }
               $qtyrej = ($myLI[23] != 'NULL')?$myLI[23]:0;
               $on_checked = "";
            $less_checked = "";
            $greater_checked = "";
            //echo'qtyrej='.$myLI["qty_rej"];
            if($myLI[24] == 1)
            {
              $del = 'On Time';
              $del_rating = '100%';
              $on_checked = 'checked';
            }
            else if($myLI[24] == 2)
            {
              $del = 'Less than<br>7 days late';
              $del_rating = '66.67%';
              $less_checked = 'checked';
            }
            else if($myLI[24] == 3)
            {
              $del = 'Greater than<br>7 days late';
              $del_rating = '33.33%';
              $greater_checked = 'checked';
            }

             $qty_ordered = ($myLI[14]+$myLI[18]);
			 if($qty_ordered > 0)
             $quality = ((($qty_ordered - $qtyrej)/$qty_ordered)*100);
			 else
				 $quality=0;
             //echo 'qtyorderd='.$qty_ordered;

					//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
					echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$myLI[0]\" size=\"2%\"></td>";
					echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$layoutrefnum\"  name=\"$layoutrefnum\"  value=\"$myLI[28]\" size=\"4%\"></td>";
                    echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[0]\">";
					echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[7]\">";
				    echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" $on_checked value=\"1\"  size=\"3%\"></td>";
                    echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" $less_checked value=\"2\" size=\"3%\"></td>";
                    echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" $greater_checked value=\"3\" size=\"3%\"></td>";
                    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\" value=\"$myLI[23]\" size=\"3%\"></td>";
                    echo"<td><select name=\"$spec_type\" id=\"$spec_type\" >"
                    ?>
                   <option selected value="<?php echo $myLI[27]?>"><?php echo $myLI[27]?></option>
                   <option value="Primary Spec">Primary Spec</option>
                   <option value="Alt Spec1">Alt Spec1</option>
                   <option value="Alt Spec2">Alt Spec2</option></select></td>
                   <?php
                                        echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\"  size=\"8%\" value=\"$myLI[20]\">";
                    echo "<img src=\"images/bu-get.gif\" alt=\"Get CIM\"  onclick=\"GetCIM4Po('$i')\"></td>";
					//	echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"20%\" value=\"$myLI[2]\"></td>";
					//echo "<td><input type=\"text\" name=\"$qty\" size=\"2%\" value=\"$myLI[3]\"></td>";
                                        echo "<td><input type=\"text\" id=\"$order_qty\" name=\"$order_qty\" size=\"5%\" value=\"$orderQty\"></td>";

                    echo "<td><input type=\"text\" id=\"$material_ref\"  name=\"$material_ref\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[8]\"></td>";
					echo "<td><input type=\"text\" id=\"$material_spec\" name=\"$material_spec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[9]\"></td>";
				    echo "<td><span class=\"tabletext\"><textarea id=\"$condition\" name=\"$condition\" rows=\"2\"
                          style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
			              cols=\"20\" value=\"\">$myLI[21]</textarea></td>";
					echo "<td><input type=\"text\" id=\"$uom\" name=\"$uom\" size=\"5%\" value=\"$myLI[16]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
					echo "<td><input type=\"text\" id=\"$dia\" name=\"$dia\" size=\"5%\" value='$dia1' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
                    echo "<td><input type=\"text\" id=\"$width\" name=\"$width\" size=\"5%\" value='$myLI[11]' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
                    echo "<td><input type=\"text\" id=\"$len\" name=\"$len\" size=\"5%\"  value='$myLI[12]' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
                    echo "<td><input type=\"text\" id=\"$thick\" name=\"$thick\" size=\"5%\" value='$thick1' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
					echo "<td><input type=\"text\" id=\"$grainflow\" name=\"$grainflow\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[17]'></td>";
					echo "<td><input type=\"text\" id=\"$maxruling\" name=\"$maxruling\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[22]'></td>";
                    echo "<td><input type=\"text\" id=\"$no_of_meterages\" name=\"$no_of_meterages\" size=\"5%\" value=\"$no_meters\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

					             if(strtoupper($myLI[16]) == 'MM')
							$no_units_req='Mts';
						else if(strtoupper($myLI[16]) == 'INCHES')
							$no_units_req='Ft';
						else
							$no_units_req='';
                    echo "<input type=\"hidden\" id=\"$num_of_units_req\" name=\"$num_of_units_req\" size=\"5%\" value=\"$no_units_req\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">";


				    echo "<td><input type=\"text\" id=\"$no_of_lengths\" name=\"$no_of_lengths\" size=\"5%\" value=\"$no_length\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
                         echo "<input type=\"hidden\" id=\"$alt_spec\" name=\"$alt_spec\" value=\"$myLI[26]\"></td>";
                   echo "<td><input type=\"text\" name=\"$duedate\"  id=\"$duedate\"
                   			style=\"background-color:#DDDDDD;\"
                  	  		readonly=\"readonly\" size=\"7%\" value=\"$myLI[4]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$duedate')\">";
                   echo "<td><input type=\"text\" id=\"$due_datef\" name=\"$due_datef\"
                   			style=\"background-color:#DDDDDD;\"
                  	  		readonly=\"readonly\" size=\"7%\" value=\"$myLI[33]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$due_datef')\">";
                    echo "<td><input type=\"text\" id=\"$due_dates\" name=\"$due_dates\"
                   			style=\"background-color:#DDDDDD;\"
                  	  		readonly=\"readonly\" size=\"7%\" value=\"$myLI[34]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$due_dates')\">";

                    echo "<td>
                          <span class=\"tabletext\"><input type=\"text\" name=\"$delvby\" readonly=\"readonly\" size=\"4%\" value=\"$myLI[15]\"
	                      <span class=\"tabletext\"><select name=\"$del\" onchange=\"onSelectDel($i)\">
 	                      <option value>SEA
 	                      <option value>AIR
	                      <option value>LAND
	                      </select>
                          </td>";
                          echo "<td><input type=\"text\" id=\"$grn_num\"  name=\"$grn_num\"  size=\"10%\" value=\"$myLI[32]\"></td>";
                          echo "<td><input type=\"text\" id=\"$qty_recd\" name=\"$qty_recd\" size=\"5%\" value=\"$myLI[29]\"></td>";
                 $netqu=($quality*0.6);
                 $netdel=($del_rating*0.3);
                 $netcomm=($comm*0.1);
                    echo "<td><input type=\"text\" name=\"$accepted_date\" id=\"$accepted_date\"
                   			style=\"background-color:#DDDDDD;\"
                  	  		readonly=\"readonly\" size=\"8%\" value=\"$myLI[19]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$accepted_date')\">";
                    printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f%s"></td>',$quality,'%');
                    printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f%s"></td>',$del_rating,'%');
                    printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f%s"></td>',$comm,'%');
                    printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f"></td>',$netqu);
                    printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f"></td>',$netdel);
                    printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f"></td>',$netcomm);

					echo "<td><input type=\"text\" name=\"$rate\" id=\"$rate\" size=\"10%\" value=\"$myLI[5]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
					echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\"
                  			readonly=\"readonly\" size=\"10%\" value=\"$myLI[6]\">";
                    echo "<input type=\"hidden\" name=\"$delivery\" id=\"$delivery\"  value=\"\">";
                    ?>
<td><center><select  name="li_status<?php echo $i ?>" id="li_status<?php echo $i ?>"  >
                    <?php $selected = 'selected'; ?>
                   <option value="Open" <?php if($myLI[30] == 'Open') echo $selected?>>Open</option>
                   <option value="Close" <?php if($myLI[30] == 'Close') echo $selected?>>Close</option>
                   <option value="Amend Close" <?php if($myLI[30] == 'Amend Close') echo $selected?>>Amend Close</option>
                   </select></center></td>
<?php
$remarksli=wordwrap($myLI[31],12,"\n",true);
echo "<td><span class=\"tabletext\"><textarea id=\"$remarks_li\" name=\"$remarks_li\" rows=\"2\"
cols=\"15\">$remarksli</textarea></td>";
					printf('</tr>');
					$i++;
					$netqus = $netqus+$netqu;
                    $netdels =$netdels+ $netdel;
                    $netcomms =$netcomms+$netcomm;
				}
				$flag=1;
			}
                        if ($i <= 30) {
			//echo "i am in outside while loop";
			printf('<tr bgcolor="#FFFFFF">');
    		$linenumber="line_num" . $i;
    		$layoutrefnum="layoutrefnum" . $i;
			$itemname="rmcode" . $i;
			$crn="crn" . $i;
			$qty="qty" . $i;
			$material_ref="material_ref" . $i;
			$duedate="due_date" . $i;
            $delvby="delvby" . $i;
            $del="del" . $i;
			$accepted_date="accepted_date" . $i;
			$rate="rate" . $i;
			$amount="amount" . $i;
			$prevlinenum="prev_line_num" . $i;
			$lirecnum="lirecnum" . $i;
			$material_spec="material_spec" . $i;
			$dia = "dia" . $i;
            $thick="thick" . $i;
            $width="width" . $i;
		    $len="len" . $i;
		    $qty_per_meter="qty_per_meter" . $i;
		    $no_of_meterages="no_of_meterages" . $i;
			$uom="uom" . $i;
			$no_of_lengths="no_of_lengths" . $i;
			$grainflow="grainflow" . $i;
			$maxruling="maxruling" . $i;
			$condition="condition" . $i;
			$delivery_time = "delivery_time" . $i;
            $delivery = "delivery" . $i;
            $qty_rej = "qty_rej". $i;
            $order_qty="order_qty".$i;
            $alt_spec="alt_spec".$i;
            $spec_type="spec_type".$i;
            $qty_recd="qty_recd".$i;
            $remarks_li="remarks_li".$i;
            $grn_num="grn_num".$i;
            $due_datef="due_datef" . $i;
		  $due_dates="due_dates" . $i;
		  $num_of_units_req="num_of_units_req" .$i;
			//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
		    echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\"  id=\"$linenumber\"   value=\"\" size=\"3%\"></td>";
			echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$layoutrefnum\"  name=\"$layoutrefnum\"  value=\"$myLI[28]\" size=\"4%\"></td>";
            echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
			echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[7]\">";
	        echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"1\"  size=\"3%\"></td>";
            echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"2\" size=\"3%\"></td>";
            echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"3\" size=\"3%\"></td>";
            echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\" value=\"\" size=\"3%\"></td>";
            echo"<td><select name=\"$spec_type\" id=\"$spec_type\" >";
                    ?>
                    <!--<option selected value="<?php //echo $myLI[27]?>"><?php //echo $myLI[27]?></option> -->
                   <option value="Primary Spec">Primary Spec</option>
                   <option value="Alt Spec1">Alt Spec1</option>
                   <option value="Alt Spec2">Alt Spec2</option><</select></td>
                   <?php
            echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\"  size=\"8%\" value=\"\">";
            echo "<img src=\"images/bu-get.gif\" alt=\"Get CIM\"  onclick=\"GetCIM4Po('$i')\"></td>";
		//	echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"20%\" value=\"\"></td>";
			//echo "<td><input type=\"text\" name=\"$qty\" size=\"5%\" value=\"\"></td>";
                    echo "<td><input type=\"text\" id=\"$order_qty\" name=\"$order_qty\" size=\"5%\" value=\"$myLI[25]\"></td>";

                    echo "<td><input type=\"text\" name=\"$material_ref\" id=\"$material_ref\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[8]\"></td>";
					echo "<td><input type=\"text\" name=\"$material_spec\"  id=\"$material_spec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[9]\"></td>";
				    echo "<td><span class=\"tabletext\"><textarea id=\"$condition\" name=\"$condition\" rows=\"2\"
                    style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
			              cols=\"20\" value=\"\"></textarea></td>";
					echo "<td><input type=\"text\" name=\"$uom\" id=\"$uom\" size=\"5%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
					echo "<td><input type=\"text\" name=\"$dia\"  id=\"$dia\" size=\"5%\"  value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
                    echo "<td><input type=\"text\" name=\"$width\"  id=\"$width\" size=\"5%\"  value='' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
                    echo "<td><input type=\"text\" name=\"$len\"   id=\"$len\"  size=\"5%\" value='' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
                    echo "<td><input type=\"text\" name=\"$thick\" id=\"$thick\"  size=\"5%\"  value='' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

					echo "<td><input type=\"text\" name=\"$grainflow\" id=\"$grainflow\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[17]'></td>";
					echo "<td><input type=\"text\" id=\"$maxruling\" name=\"$maxruling\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[22]'></td>";
                    echo "<td><input type=\"text\" name=\"$no_of_meterages\"  id=\"$no_of_meterages\"  size=\"5%\" value=\"$myLI[14]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

					             if(strtoupper($myLI[16]) == 'MM')
							$no_units_req='Mts';
						else if(strtoupper($myLI[16]) == 'INCHES')
							$no_units_req='Ft';
						else
							$no_units_req='';
                    echo "<input type=\"hidden\" id=\"$num_of_units_req\" name=\"$num_of_units_req\" size=\"5%\" value=\"$no_units_req\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">";


					echo "<td><input type=\"text\" name=\"$no_of_lengths\" id=\"$no_of_lengths\"  size=\"5%\" value=\"$myLI[18]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
                        echo "<input type=\"hidden\" id=\"$alt_spec\" name=\"$alt_spec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI[26]\"></td>";
                      echo "<td><input type=\"text\" name=\"$duedate\"  id=\"$duedate\"
            				style=\"background-color:#DDDDDD;\"
            	  			readonly=\"readonly\" size=\"7%\" value=\"\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$duedate')\">";
                   echo "<td><input type=\"text\" id=\"$due_datef\" name=\"$due_datef\"
                   			style=\"background-color:#DDDDDD;\"
                  	  		readonly=\"readonly\" size=\"7%\" value=\"$myLI[33]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$due_datef')\">";
                    echo "<td><input type=\"text\" id=\"$due_dates\" name=\"$due_dates\"
                   			style=\"background-color:#DDDDDD;\"
                  	  		readonly=\"readonly\" size=\"7%\" value=\"$myLI[34]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$due_dates')\">";

                   echo "<td>
                   <span class=\"tabletext\"><input type=\"text\" name=\"$delvby\" readonly=\"readonly\" size=\"4%\" value=\"$myLI[15]\"
	               <span class=\"tabletext\"><select name=\"$del\" size=\"1\" onchange=\"onSelectDel($i)\">
 	               <option value>SEA
 	               <option value>AIR
	               <option value>LAND
	               </select>
                   </td>";
                   echo "<td><input type=\"text\" id=\"$grn_num\"  name=\"$grn_num\"  size=\"10%\" value=\"$myLI[32]\"></td>";
                   echo "<td><input type=\"text\" id=\"$qty_recd\" name=\"$qty_recd\" size=\"5%\" value=\"$myLI[29]\"></td>";
            echo "<td><input type=\"text\" name=\"$accepted_date\" id=\"$accepted_date\"
            				style=\"background-color:#DDDDDD;\"
            	  			readonly=\"readonly\" size=\"8%\" value=\"\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$accepted_date')\">";
                   echo "<td><input type=\"text\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"\"></td>";
					echo "<td><input type=\"text\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"\"></td>";
                    echo "<td><input type=\"text\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"5%\" value=\"\"></td>";

                   echo "<td><input type=\"text\" id=\"$netquality\" name=\"$netquality\" style=\"background-color:#DDDDDD;\"
            	  			readonly=\"readonly\" size=\"5%\" value=\"\">";
                  echo "<td><input type=\"text\" id=\"$netdelivery\" name=\"$netdelivery\" style=\"background-color:#DDDDDD;\"
            	  			readonly=\"readonly\" size=\"5%\" value=\"\">";
                  echo "<td><input type=\"text\" id=\"$netcomm\" name=\"$netcomm\" style=\"background-color:#DDDDDD;\"
            	  			readonly=\"readonly\" size=\"5%\" value=\"\">";
			echo "<td><input type=\"text\" name=\"$rate\" id=\"$rate\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
			echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\"
            	  			readonly=\"readonly\" size=\"10%\" value=\"\">";
            echo "<input type=\"hidden\" name=\"$delivery\" id=\"$delivery\"  value=\"\">";
            ?>
<td><center><select  name="li_status<?php echo $i ?>" id="li_status<?php echo $i ?>"  >
                    <?php $selected = 'selected'; ?>
                   <option value="Open" <?php if($myLI[30] == 'Open') echo $selected?>>Open</option>
                   <option value="Close" <?php if($myLI[30] == 'Close') echo $selected?>>Close</option>
                   <option value="Amend Close" <?php if($myLI[30] == 'Amend Close') echo $selected?>>Amend Close</option>
                   </select></center></td>
<?php
$remarksli=wordwrap($myLI[31],12,"\n",true);
echo "<td><span class=\"tabletext\"><textarea id=\"$remarks_li\" name=\"$remarks_li\" rows=\"2\"
cols=\"15\">$remarksli</textarea></td>";
			printf('</tr>');
			$i++;
		}
          }
?>
<input type="hidden" name="page" value="edit">
<tr bgcolor="#FFFFFF">
<td colspan=31 align="right"><span class="tabletext"><b>Average</b></td>
<?
$netquality=$netqus/$num_rows;
$netdelivery=$netdels/$num_rows;
$netcommunication=$netcomms/$num_rows;
$nettotal = ($netquality+$netdelivery+$comm);
?>
<td align=right><span class="tabletext" ><?php printf('%.2f',$netquality); ?></td>
<td align=right><span class="tabletext"><?php printf('%.2f',$netdelivery); ?></td>
<td align=right><span class="tabletext"><?php printf('%.2f',$netcommunication); ?></td>
<td colspan=5></td>
</tr>

<tr bgcolor="#FFFFFF">
<td colspan=32 align="right"><span class="tabletext"><b>Total,pts</b></td>
<td colspan=2 align="right"><span class="tabletext" ><?php printf('%.2f',$nettotal); ?></td>
<td colspan=6></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=35 align="right"><span class="tabletext"><b>Total</b></td>
<td><span class="tabletext" align=right><?php printf('%s %.2f',$myrow["currency"],$myrow["poamount"]); ?></td>
<td colspan=5>&nbsp;</td><tr>
<tr bgcolor="#FFFFFF">
<td colspan=35 align="right"><span class="tabletext"><b>Tax</b></td>
<td><span class="tabletext"><input type='text' name='tax' value='<?php printf('%.2f',$myrow["tax"]); ?>'></td>
<td colspan=5>&nbsp;</td><tr>
<tr bgcolor="#FFFFFF">
<td colspan=35 align="right"><span class="tabletext"><b>Shipping</b></td>
<td><span class="tabletext"><input type='text' name='shipping' value='<?php printf('%.2f',$myrow["shipping"]); ?>'></td>
<td colspan=5>&nbsp;</td><tr>
<tr bgcolor="#FFFFFF">
<td colspan=35 align="right"><span class="tabletext"><b>Labor</b></td>
<td><span class="tabletext"><input type='text' name='labor' value='<?php printf('%.2f',$myrow["labor"]); ?>'></td>
<td colspan=5>&nbsp;</td><tr>
<tr bgcolor="#FFFFFF">
<td colspan=35 align="right"><span class="tabletext"><b>Total Due</b></td>
<td><span class="tabletext" align=right><?php printf('%s %.2f',$myrow["currency"],$myrow["total_due"]); ?></td>
<td colspan=5>&nbsp;</td><tr>
</tr>
<input type="hidden" name="deleteflag" value="">
</table>
</td>
</tr>
</table>
</td>
<?php
  }
  
  else if($dept=='Purchasing' && $myrow["approval"] == 'yes')
  {
 ?>
 <input type="hidden" name="noedit"  id="noedit" value="<?php echo $myrow["approval"]?>">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF" >
<td width=20%><span class="labeltext"><p align="left">PO Date</p></font></td>
<td width=40% ><input type="text" name="podate"  id="podate"   style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["podate"] ?>">
</td>
<td width=15%><span class="labeltext"><p align="left">PO #</p></font></td>
 <td width=20%><span class="tabletext"><input type="text"  name="ponum" style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow["ponum"] ?>" style="background-color:#DDDDDD;" readonly="readonly" ></td>
 </tr>
 <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">PO Desc</p></font></td>
<td ><span class="tabletext"><input type="text"   name="desc" style="background-color:#DDDDDD;"  readonly="readonly" size =40% value="<?php echo $myrow["podescr"] ?>"></td>
<td><span class="labeltext"><p align="left">Currency</p></font></td>
<td><span class="tabletext"><input type="text" name="currency"
              style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow["currency"] ?>"

 </td>
</tr>
<tr bgcolor="#FFFFFF">

  <td><span class="labeltext"><p align="left">Status</p></font></td>
<td colspan=3><span class="tabletext"><input type="text" name="status" id="status"
              style="background-color:#DDDDDD;" value="<?php echo $myrow["status"] ?>"
	<span class="tabletext"><select name="postat" id="postat" size="1" width="20" onchange="onSelectStatus()">
    <option selected>Please Specify
	<option value>Open
 	<option value>Issued
	<option value>Closed
	<option value>Cancelled
   	</select>
 </td>
<!--<td></td><td></td>
<td><span class="labeltext"><p align="left">Status</p></font></td>
<td colspan=2><span class="tabletext"><input type="text" name="status"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php// echo $myrow["status"] ?>"
	<span class="tabletext"><select name="postat" size="1" width="20" onchange="onSelectStatus()">
 	<option selected>Please Specify
	<option value>Open
 	<option value>Issued
	<option value>Closed
       	<option value>Cancelled
	</select>
 </td>-->
 </tr>
 <tr bgcolor="#FFFFFF">
 <td><span class="labeltext"><p align="left">Approval</p></font></td>
<?php
if($myrow["approval"] == 'yes'){
   $checked1="checked";
   }
   $date=date("Y-m-d");
   ?>
   <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked1 ?> name="chk1"  onclick="return readOnlyCheckBox()">
                         <input type="hidden" name="approval" readonly="readonly" value="<?php echo $myrow["approval"]?>" id="approval"></td>
                         <td width=20%><span class="labeltext"><p align="left">Approval Date</p></font></td>
<td width=40% ><input type="text" name="approvaldate" id="approvaldate" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["approvaldate"] ?>">
</td>
 </tr>
 <tr bgcolor="#FFFFFF" >

<td width=15%><span class="labeltext"><p align="left">Amendment No.</p></font></td>
 <td width=20%><span class="tabletext"><input type="text"  name="amendment_num" id="amendment_num" style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow["amendment_num"] ?>"></td>
<td width=20%><span class="labeltext"><p align="left">Amendment Date</p></font></td>
<td width=40% ><input type="text" name="amendmentdate" id="amendmentdate" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["amendmentdate"] ?>">
</td>
 </tr>
 <?
$amend_notes=wordwrap($myrow["amendment_notes"],100,"<br />",true);
?>
<tr bgcolor="#FFFFFF" >
<td><span class="labeltext"><p align="left">Amendment Notes</p></font></td>
<td colspan=3><span class="tabletext"><textarea  name="amendment_notes" id="amendment_notes" style="background-color:#DDDDDD;" readonly="readonly"  rows="3"
			              cols="100" value=""><?php echo $amend_notes." \n"?></textarea></td>
</tr>
<?
$terms=wordwrap($myrow["terms"],100,"\n");
?>
  <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Header</p></font></td>
<td colspan=3><span class="tabletext"><textarea  name="terms" style="background-color:#DDDDDD;" readonly="readonly" rows="2"
			              cols="100" value=""><?php echo $terms?></textarea></td>
</tr>
 <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Remarks</p></font></td>
<td colspan=5><span class=\"tabletext\"><textarea  name="remarks" style="background-color:#DDDDDD;"   readonly="readonly" rows="3"
			              cols="170" value=""><?php echo $remarks ?></textarea></td>
</tr>
<tr bgcolor="#FFFFFF">
<td ><span class="labeltext"><p align="left">Type</p></font></td>
 <td colspan=8><span class="tabletext">
 <input type="text" name="potype" id="potype" style="background-color:#DDDDDD;" readonly="readonly"  size=15 value="<?php echo $myrow["type"] ?>">
 <select name="potype_sel" id="potype_sel" size="1" width="100" onchange="onSelecttype()">
 <option selected value="Bought Out">Bought Out
        					<option value="Regular">Regular
        	 </select></td>
 </tr>
<tr bgcolor="#FFFFFF">
<td colspan=1><span class="labeltext"><p align="left">Communication</p></font></td>
<?php
$comm = $myrow["communication"];
($comm == 10)?$checked='checked':$checked='';
echo "<td colspan=8><span class=\"tabletext\"><input type=\"radio\" id=\"communication\" name=\"communication\" value=\"10\" $checked>10";
($comm == 20)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"20\" $checked>20";
($comm == 30)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"30\" $checked>30";
($comm == 40)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"40\" $checked>40";
($comm == 50)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"50\" $checked>50";
($comm == 60)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"60\" $checked>60";
($comm == 70)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"70\" $checked>70";
($comm == 80)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"80\" $checked>80";
($comm == 90)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"90\" $checked>90";
($comm == 100)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" id=\"communication\" name=\"communication\" value=\"100\" $checked>100</td>";
?>
<input type="hidden" id="comm" name="comm" value=" <?php echo $comm?>">
 <br>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td colspan=38><span class="heading"><center><b>Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=38 bgcolor="#FFFFFF"><span class="tabletext">To delete line items - blankout line number</td></tr>
<tr bgcolor='#FFFFFF'>
<td colspan=28></td>
<td bgcolor="#A0C544" colspan=3 align='center'><span class="heading"><b>Compliance</b></td>
<td bgcolor="#659EC7" colspan=3 align='center'><span class="heading"><b>Rating</b></td>
<td colspan=5></td>
</tr>
<td bgcolor="#EEEFEE"><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Layout Ref#</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>On Time</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>< 7<br/> days late</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>>7 days<br/>late</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Qty<br>Rej</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Spec Type</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Order Qty</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Material Type</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Material Spec</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>RM Con</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>UOM</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Dia</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Length</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Width</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Thick</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>GF</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Max</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>No. Meter</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>No. Length</b></td>

<td bgcolor="#EEEFEE"><span class="heading"><b>Due </b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Due 1</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Due2</b></td>

<td bgcolor="#EEEFEE"><span class="heading"><b>Delivery By</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>GRN #</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Qty Recd</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Acc. Date</b></td>
<td bgcolor="#A0C544"><span class="heading"><b>Quality</b></td>
<td bgcolor="#A0C544"><span class="heading"><b>Delivery</b></td>
<td bgcolor="#A0C544"><span class="heading"><b>Comm</b></td>

<td bgcolor="#659EC7" width=4%><span class="heading"><b>Quality</b></td>
<td bgcolor="#659EC7" width=4%><span class="heading"><b>Delivery</b></td>
<td bgcolor="#659EC7" width=4%><span class="heading"><b>Comm</b></td>

<td bgcolor="#EEEFEE"><span class="heading"><b>Rate</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Amount</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Status</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Remarks</b></td>
<?php
  		$result = $newLI->getLI($porecnum);
  		$num_rows=mysql_num_rows($result);
		$i=1;$flag=0;
		while($i<=30)
		{
			if($flag==0)
			{
				while ($myLI = mysql_fetch_row($result))
	  	 		{
                    $orderQty=$myLI[25];
                     $no_meters = $myLI[14];
 	 		        $no_length = $myLI[18];
                    $qty_ordered = 0;
					//echo "i am inside inner while loop";
					printf('<tr bgcolor="#FFFFFF">');
					$linenumber="line_num" . $i;
					$layoutrefnum="layoutrefnum" . $i;
					$crn="crn" . $i;
					$condition="condition" . $i;
					$itemname="rmcode" . $i;
					$itemdesc="item_desc" . $i;
					$qty="qty" . $i;
					$material_ref="material_ref" . $i;
					$material_spec="material_spec" . $i;
					$uom="uom" . $i;
					$dia="dia" . $i;
					$thick="thick" . $i;
					$width="width" . $i;
				    $len="len" . $i;
					$grainflow="grainflow" . $i;
					$maxruling="maxruling" . $i;
					$qty_per_meter="qty_per_meter" . $i;
					$no_of_meterages="no_of_meterages" . $i;
					$no_of_lengths="no_of_lengths" . $i;
					$duedate="due_date" . $i;
                    $delvby="delvby" . $i;
                    $del="del" . $i;
					$accepted_date="accepted_date" . $i;
					$rate="rate" . $i;
					$amount="amount" . $i;
				 	$delivery_time = "delivery_time" . $i;
 	                $delivery = "delivery" . $i;
                    $qty_rej = "qty_rej". $i;
                    $order_qty="order_qty".$i;
                    $alt_spec="alt_spec".$i;
                    $spec_type="spec_type".$i;
					$prevlinenum="prev_line_num" . $i;
					$lirecnum="lirecnum" . $i;
					$qty_recd="qty_recd".$i;
                    $remarks_li="remarks_li".$i;
                    $grn_num="grn_num".$i;
                    $due_datef="due_datef" . $i;
		           $due_dates="due_dates" . $i;
				   $num_of_units_req="num_of_units_req" .$i;
					$dia1 = "";
					$thick1 = "";
					
					$length1 =  $myLI[12];
					 if (trim($length1) == "")
                     {
                        $dia1 = $myLI[10];
                     }
                     else
                     {
                        $thick1 = $myLI[10];
                     }
            $qtyrej = ($myLI[23] != 'NULL')?$myLI[23]:0;
            $on_checked = "";
            $less_checked = "";
            $greater_checked = "";
            //echo'qtyrej='.$myLI["qty_rej"];
            if($myLI[24] == 1)
            {
              $del = 'On Time';
              $del_rating = '100%';
              $on_checked = 'checked';
            }
            else if($myLI[24] == 2)
            {
              $del = 'Less than<br>7 days late';
              $del_rating = '66.67%';
              $less_checked = 'checked';
            }
            else if($myLI[24] == 3)
            {
              $del = 'Greater than<br>7 days late';
              $del_rating = '33.33%';
              $greater_checked = 'checked';
            }

             $qty_ordered = ($myLI[14]+$myLI[18]);
             $quality = ((($qty_ordered - $qtyrej)/$qty_ordered)*100);

					//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
					echo "<td ><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\" readonly=\"readonly\"  value=\"$myLI[0]\" size=\"2%\"></td>";
   					echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$layoutrefnum\"  name=\"$layoutrefnum\"  value=\"$myLI[28]\" size=\"4%\"></td>";
                    echo "<input type=\"hidden\" name=\"$prevlinenum\"  readonly=\"readonly\" value=\"$myLI[0]\">";
					echo "<input type=\"hidden\" name=\"$lirecnum\" readonly=\"readonly\" value=\"$myLI[7]\">";
				    echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" id=\"$delivery_time\" $on_checked value=\"1\"  size=\"3%\"></td>";
                    echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" $less_checked value=\"2\" size=\"3%\"></td>";
                    echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" $greater_checked value=\"3\" size=\"3%\"></td>";
                    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\" value=\"$myLI[23]\" size=\"3%\"></td>";
                    echo "<td><input type=\"text\" name=\"$spec_type\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI[27]\"></td>";
                    echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"10%\" value=\"$myLI[20]\">";

                    //echo "<img src=\"images/bu-get.gif\" alt=\"Get CIM\"  onclick=\"GetCIM4Po('$i')\"></td>";
					//	echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"20%\" value=\"$myLI[2]\"></td>";
					//echo "<td><input type=\"text\" name=\"$qty\" size=\"2%\" value=\"$myLI[3]\"></td>";
                     echo "<td><input type=\"text\" id=\"$order_qty\" name=\"$order_qty\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"5%\" value=\"$orderQty\"></td>";

                	echo "<td><input type=\"text\" id=\"$material_ref\"  name=\"$material_ref\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[8]\"></td>";
					echo "<td><input type=\"text\" id=\"$material_spec\" name=\"$material_spec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[9]\"></td>";
				    echo "<td><span class=\"tabletext\"><textarea id=\"$condition\" name=\"$condition\" rows=\"2\"
                          style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
			              cols=\"20\" value=\"\">$myLI[21]</textarea></td>";
					echo "<td><input type=\"text\" id=\"$uom\" name=\"$uom\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI[16]\"></td>";
					echo "<td><input type=\"text\" id=\"$dia\" name=\"$dia\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$dia1'></td>";
                    echo "<td><input type=\"text\" id=\"$width\" name=\"$width\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"size=\"5%\" value='$myLI[11]'></td>";
                    echo "<td><input type=\"text\" id=\"$len\" name=\"$len\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\"  value='$myLI[12]'></td>";
                    echo "<td><input type=\"text\" id=\"$thick\" name=\"$thick\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$thick1'></td>";
					echo "<td><input type=\"text\" id=\"$grainflow\" name=\"$grainflow\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[17]'></td>";
					echo "<td><input type=\"text\" id=\"$maxruling\" name=\"$maxruling\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[22]'></td>";
                    echo "<td><input type=\"text\" id=\"$no_of_meterages\" name=\"$no_of_meterages\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$no_meters\"></td>";

					             if(strtoupper($myLI[16]) == 'MM')
							$no_units_req='Mts';
						else if(strtoupper($myLI[16]) == 'INCHES')
							$no_units_req='Ft';
						else
							$no_units_req='';
                    echo "<input type=\"hidden\" id=\"$num_of_units_req\" name=\"$num_of_units_req\" size=\"5%\" value=\"$no_units_req\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">";

				    echo "<td><input type=\"text\" id=\"$no_of_lengths\" name=\"$no_of_lengths\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"5%\" value=\"$no_length\"></td>";
                        echo "<input type=\"hidden\" id=\"$alt_spec\" name=\"$alt_spec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI[26]\"></td>";

                    echo "<td><input type=\"text\" name=\"$duedate\" id=\"$duedate\"
                   			style=\"background-color:#DDDDDD;\"
                  	  		readonly=\"readonly\" size=\"7%\" value=\"$myLI[4]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$duedate')\">";
                   echo "<td><input type=\"text\" id=\"$due_datef\" name=\"$due_datef\"
                   			style=\"background-color:#DDDDDD;\"
                  	  		readonly=\"readonly\" size=\"7%\" value=\"$myLI[33]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$due_datef')\">";
                    echo "<td><input type=\"text\" id=\"$due_dates\" name=\"$due_dates\"
                   			style=\"background-color:#DDDDDD;\"
                  	  		readonly=\"readonly\" size=\"7%\" value=\"$myLI[34]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$due_dates')\">";

                    echo "<td>
                          <span class=\"tabletext\"><input type=\"text\" name=\"$delvby\" readonly=\"readonly\" size=\"4%\" value=\"$myLI[15]\"
                          </td>";
                          echo "<td><input type=\"text\" id=\"$grn_num\"  name=\"$grn_num\"  size=\"10%\" value=\"$myLI[32]\"></td>";
                          echo "<td><input type=\"text\" id=\"$qty_recd\" name=\"$qty_recd\" size=\"5%\" value=\"$myLI[29]\"
                   ></td>";
                     $netqu=($quality*0.6);
                     $netdel=($del_rating*0.3);
                     $netcomm=($comm*0.1);
                    echo "<td><input type=\"text\" name=\"$accepted_date\" id=\"$accepted_date\"
                   			style=\"background-color:#DDDDDD;\"
                  	  		readonly=\"readonly\" size=\"8%\" value=\"$myLI[19]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$accepted_date')\">";
  	                printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f%s"></td>',$quality,'%');
                    printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f%s"></td>',$del_rating,'%');
                    printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f%s"></td>',$comm,'%');
                    printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f"></td>',$netqu);
                    printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f"></td>',$netdel);
                    printf('<td bgcolor="#FFFFFF" align="right"><input type="text" style="background-color:#DDDDDD;" readonly="readonly" size="5" value="%.2f"></td>',$netcomm);
					echo "<td><input type=\"text\" name=\"$rate\" id=\"$rate\" size=\"10%\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI[5]\"></td>";
					echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\"
                  			readonly=\"readonly\" size=\"10%\" value=\"$myLI[6]\">";
                    echo "<input type=\"hidden\" name=\"$delivery\" id=\"$delivery\"  value=\"\">";

                   ?>
<td><center><select  name="li_status<?php echo $i ?>" id="li_status<?php echo $i ?>"  >
                    <?php $selected = 'selected'; ?>
                   <option value="Open" <?php if($myLI[30] == 'Open') echo $selected?>>Open</option>
                   <option value="Close" <?php if($myLI[30] == 'Close') echo $selected?>>Close</option>
                   <option value="Amend Close" <?php if($myLI[30] == 'Amend Close') echo $selected?>>Amend Close</option>
                   </select></center></td>
<?php
$remarksli=wordwrap($myLI[31],12,"\n",true);
echo "<td><span class=\"tabletext\"><textarea id=\"$remarks_li\" name=\"$remarks_li\" rows=\"2\"
cols=\"15\" >$remarksli</textarea></td>";
					printf('</tr>');
					$i++;
					$netqus = $netqus+$netqu;
                    $netdels =$netdels+ $netdel;
                    $netcomms =$netcomms+$netcomm;
				}
				$flag=1;
			}
           if ($i <= 30) {
			//echo "i am in outside while loop";
			printf('<tr bgcolor="#FFFFFF">');
    		$linenumber="line_num" . $i;
    		$layoutrefnum="layoutrefnum" . $i;
			$itemname="rmcode" . $i;
			$crn="crn" . $i;
			$qty="qty" . $i;
			$material_ref="material_ref" . $i;
			$duedate="due_date" . $i;
            $delvby="delvby" . $i;
            $del="del" . $i;
			$accepted_date="accepted_date" . $i;
			$rate="rate" . $i;
			$amount="amount" . $i;
			$prevlinenum="prev_line_num" . $i;
			$lirecnum="lirecnum" . $i;
			$material_spec="material_spec" . $i;
			$dia = "dia" . $i;
            $thick="thick" . $i;
            $width="width" . $i;
		    $len="len" . $i;
		    $qty_per_meter="qty_per_meter" . $i;
		    $no_of_meterages="no_of_meterages" . $i;
			$uom="uom" . $i;
			$no_of_lengths="no_of_lengths" . $i;
			$grainflow="grainflow" . $i;
			$maxruling="maxruling" . $i;
			$condition="condition" . $i;
			$delivery_time = "delivery_time" . $i;
            $delivery = "delivery" . $i;
            $qty_rej = "qty_rej". $i;
            $order_qty = "order_qty". $i;
            $alt_spec="alt_spec".$i;
            $spec_type="spec_type".$i;
            $qty_recd="qty_recd".$i;
            $remarks_li="remarks_li".$i;
            $grn_num="grn_num".$i;
            $due_datef="due_datef" . $i;
		  $due_dates="due_dates" . $i;
		  $num_of_units_req="num_of_units_req" .$i;
			//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
		    echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\"  id=\"$linenumber\" readonly=\"readonly\" value=\"\" size=\"3%\"></td>";
			echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$layoutrefnum\"  name=\"$layoutrefnum\"  value=\"\" size=\"4%\"></td>";
            echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
			echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[7]\">";
			 echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"1\"  size=\"3%\"></td>";
            echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"2\" size=\"3%\"></td>";
            echo "<td><span class=\"tabletext\"><input type=\"radio\" name=\"$delivery_time\" value=\"3\" size=\"3%\"></td>";
            echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\" value=\"\" size=\"3%\"></td>";
            echo "<td><input type=\"text\" name=\"$spec_type\" id=\"$spec_type\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI[27]\"></td>";
            echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\" readonly=\"readonly\" size=\"10%\" style=\"background-color:#DDDDDD;\" value=\"\">";
            echo "<td><input type=\"text\" name=\"$order_qty\"  id=\"$order_qty\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI[25]\"></td>";

            //echo "<img src=\"images/bu-get.gif\" alt=\"Get CIM\"  onclick=\"GetCIM4Po('$i')\"></td>";
		//	echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"20%\" value=\"\"></td>";
			//echo "<td><input type=\"text\" name=\"$qty\" size=\"5%\" value=\"\"></td>";
			echo "<td><input type=\"text\" name=\"$material_ref\" id=\"$material_ref\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[8]\"></td>";
			echo "<td><input type=\"text\" name=\"$material_spec\" id=\"$material_spec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[9]\"></td>";
            echo "<td><span class=\"tabletext\"><textarea id=\"$condition\" name=\"$condition\" rows=\"2\"
                    style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
			              cols=\"20\" value=\"\"></textarea></td>";
			echo "<td><input type=\"text\" name=\"$uom\" id=\"$uom\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"5%\" value=\"\"></td>";
			echo "<td><input type=\"text\" name=\"$dia\" id=\"$dia\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\"  value=\"\"></td>";
            echo "<td><input type=\"text\" name=\"$width\" id=\"$width\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\"  value=''></td>";
            echo "<td><input type=\"text\" name=\"$len\" id=\"$len\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=''></td>";
            echo "<td><input type=\"text\" name=\"$thick\"   id=\"$thick\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\"  value=''></td>";

            echo "<td><input type=\"text\" name=\"$grainflow\" id=\"$grainflow\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[17]'></td>";
            echo "<td><input type=\"text\" id=\"$maxruling\" name=\"$maxruling\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value='$myLI[22]'></td>";
            echo "<td><input type=\"text\" name=\"$no_of_meterages\"  id=\"$grainflow\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI[14]\"></td>";

			             if(strtoupper($myLI[16]) == 'MM')
							$no_units_req='Mts';
						else if(strtoupper($myLI[16]) == 'INCHES')
							$no_units_req='Ft';
						else
							$no_units_req='';
                    echo "<input type=\"hidden\" id=\"$num_of_units_req\" name=\"$num_of_units_req\" size=\"5%\" value=\"$no_units_req\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">";


            echo "<td><input type=\"text\" name=\"$no_of_lengths\" id=\"$no_of_lengths\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI[18]\"></td>";
            echo "<input type=\"hidden\" id=\"$alt_spec\" name=\"$alt_spec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI[26]\"></td>";
            echo "<td><input type=\"text\" name=\"$duedate\" id=\"$duedate\"
            				style=\"background-color:#DDDDDD;\"
            	  			readonly=\"readonly\" size=\"7%\" value=\"\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$duedate')\">";
                   echo "<td><input type=\"text\" id=\"$due_datef\" name=\"$due_datef\"
                   			style=\"background-color:#DDDDDD;\"
                  	  		readonly=\"readonly\" size=\"7%\" value=\"$myLI[33]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$due_datef')\">";
                    echo "<td><input type=\"text\" id=\"$due_dates\" name=\"$due_dates\"
                   			style=\"background-color:#DDDDDD;\"
                  	  		readonly=\"readonly\" size=\"7%\" value=\"$myLI[34]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$due_dates')\">";

            echo "<td>
                   <span class=\"tabletext\"><input type=\"text\" name=\"$delvby\" id=\"$delvby\"  readonly=\"readonly\" size=\"4%\" value=\"$myLI[15]\"
                 </td>";
                 echo "<td><input type=\"text\" id=\"$grn_num\"  name=\"$grn_num\"  size=\"10%\" value=\"$myLI[32]\"></td>";
                 echo "<td><input type=\"text\" id=\"$qty_recd\" name=\"$qty_recd\" size=\"5%\" value=\"$myLI[29]\"
                   ></td>";
            echo "<td><input type=\"text\" name=\"$accepted_date\" id=\"$accepted_date\"
            				style=\"background-color:#DDDDDD;\"
            	  			readonly=\"readonly\" size=\"8%\" value=\"\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$accepted_date')\">";
            echo "<td><input type=\"text\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"\"></td>";
            echo "<td><input type=\"text\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"\"></td>";
            echo "<td><input type=\"text\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"5%\" value=\"\"></td>";

            echo "<td><input type=\"text\" id=\"$netquality\" name=\"$netquality\" style=\"background-color:#DDDDDD;\"
            	  			readonly=\"readonly\" size=\"5%\" value=\"\">";
            echo "<td><input type=\"text\" id=\"$netdelivery\" name=\"$netdelivery\" style=\"background-color:#DDDDDD;\"
            	  			readonly=\"readonly\" size=\"5%\" value=\"\">";
            echo "<td><input type=\"text\" id=\"$netcomm\" name=\"$netcomm\" style=\"background-color:#DDDDDD;\"
            	  			readonly=\"readonly\" size=\"5%\" value=\"\">";
			echo "<td><input type=\"text\" name=\"$rate\" id=\"$rate\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"\"></td>";
			echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\"
            	  			readonly=\"readonly\" size=\"10%\" value=\"\">";
            echo "<input type=\"hidden\" name=\"$delivery\" id=\"$delivery\"  value=\"\">";
?>
<td><center><select  name="li_status<?php echo $i ?>" id="li_status<?php echo $i ?>"  >
                    <?php $selected = 'selected'; ?>
                   <option value="Open" <?php if($myLI[30] == 'Open') echo $selected?>>Open</option>
                   <option value="Close" <?php if($myLI[30] == 'Close') echo $selected?>>Close</option>
                   <option value="Amend Close" <?php if($myLI[30] == 'Amend Close') echo $selected?>>Amend Close</option>
                   </select></center></td>
<?php
$remarksli=wordwrap($myLI[31],12,"\n",true);
echo "<td><span class=\"tabletext\"><textarea id=\"$remarks_li\" name=\"$remarks_li\" rows=\"2\"
cols=\"15\"  >$remarksli</textarea></td>";
			printf('</tr>');
			$i++;
		}
          }
?>
<input type="hidden" name="page" value="edit">
<tr bgcolor="#FFFFFF">
<td colspan=31 align="right"><span class="tabletext"><b>Average</b></td>
<?
$netquality=$netqus/$num_rows;
$netdelivery=$netdels/$num_rows;
$netcommunication=$netcomms/$num_rows;
$nettotal = ($netquality+$netdelivery+$comm);
?>
<td align=right><span class="tabletext" ><?php printf('%.2f',$netquality); ?></td>
<td align=right><span class="tabletext"><?php printf('%.2f',$netdelivery); ?></td>
<td align=right><span class="tabletext"><?php printf('%.2f',$netcommunication); ?></td>
<td colspan=5></td>
</tr>

<tr bgcolor="#FFFFFF">
<td colspan=31 align="right"><span class="tabletext"><b>Total,pts</b></td>
<td colspan=2 align="right"><span class="tabletext" ><?php printf('%.2f',$nettotal); ?></td>
<td colspan=6></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=35 align="right"><span class="tabletext"><b>Total</b></td>
<td><span class="tabletext" align=right><?php printf('%s %.2f',$myrow["currency"],$myrow["poamount"]); ?></td>
<td colspan=5>&nbsp;</td>
<tr>
<tr bgcolor="#FFFFFF">
<td colspan=35 align="right"><span class="tabletext"><b>Tax</b></td>
<td><span class="tabletext"><input type='text' name='tax' readonly="readonly" value='<?php printf('%.2f',$myrow["tax"]); ?>'></td>
<td colspan=5>&nbsp;</td><tr>
<tr bgcolor="#FFFFFF">
<td colspan=35 align="right"><span class="tabletext"><b>Shipping</b></td>
<td><span class="tabletext"><input type='text' name='shipping' readonly="readonly" value='<?php printf('%.2f',$myrow["shipping"]); ?>'></td>
<td colspan=5>&nbsp;</td><tr>
<tr bgcolor="#FFFFFF">
<td colspan=35 align="right"><span class="tabletext"><b>Labor</b></td>
<td><span class="tabletext"><input type='text' name='labor' readonly="readonly" value='<?php printf('%.2f',$myrow["labor"]); ?>'></td>
<td colspan=5>&nbsp;</td><tr>
<tr bgcolor="#FFFFFF">
<td colspan=35 align="right"><span class="tabletext"><b>Total Due</b></td>
<td><span class="tabletext" align=right><?php printf('%s %.2f',$myrow["currency"],$myrow["total_due"]); ?></td>
<td colspan=5>&nbsp;</td><tr>
</tr>
<input type="hidden" name="deleteflag" value="">
</table>
</td>
</tr>
</table>
</td>
<?php
  }
?>
<input type="hidden" name="page" id="page" value="edit">
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>
<span class="tabletext">
   <input type="submit"
   style="color=#0066CC;background-color:#DDDDDD;width=130;"
   value="Submit" name="submit" onclick="javascript: return check_req_fields1()">
</FORM>
</body>
</html>
