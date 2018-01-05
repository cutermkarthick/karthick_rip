<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = March 16,2005                =
// Filename: addwfstage.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows adding stages to WF                  =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'addwfstage'; 
$page ="Work Flow";
//////session_register('pagename');

// First include the class definition 

include_once('classes/workflowClass.php'); 
include('classes/displayClass.php');
$newWF = new workflow; 
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/crypt.js"></script>
<script language="javascript" src="scripts/workflow.js"></script>



<html>
<head>
<title>New Stage</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='processWF.php' method='post' enctype='multipart/form-data'>
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
<?php 
	 $newdisplay->dispLinks(''); 
?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td> -->
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>New WF Stage</b></td>
</tr>
</table>
</td></tr>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<input type="hidden" name ="pagename" id="pagename" value ="addwfstage">
<tr bgcolor="#FFFFFF">
<td width="25%" ><span class="heading"><p align="left">Stage #</p></font></td>
<td colspan=3><span class="heading"><input type="text" name="stage" size=20 value="" onKeyup="javascript:validate(stage)"></td>
<td ><span class="heading"><p align="left">Type</p></font></td>
<td  colspan=3><input type="text" name="type" maxlength="32"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td ><span class="heading"><p align="left">Parent Doc Type</p></font></td>
<td colspan=3 ><span class="tabletext"><input type="text" name="doctype" id="doctype" size=20 readonly="readonly" style="background-color:#DDDDDD" value="">
<select name="doc_type" id="doc_type" onchange="OnSelectdoc()">
<option value="Please Specify">Please Specify</option>
<option value="WO">WO</option>
</select>
</td>
<td ><span class="heading"><p align="left">Dept</p></font></td>
<td colspan=4><span class="tabletext"><input type="text" name="dept"  id="dept" size=20  readonly="readonly" style="background-color:#DDDDDD" value="">
<select name="department" id="department" onchange="onSelectdept()">
<option value="Please Specify">Please Specify</option>
<option value="Management">Management</option>
<option value="Stores">Stores</option>
<option value="Engineering">Engineering</option>
<option value="PPC">PPC</option>
<option value="Production">Production</option>
<option value="QA">QA</option>
<option value="Assembly">Assembly</option>
<option value="Packing">Packing</option>
<option value="Purchasing">Purchasing</option>
<option value="Pattern">Pattern</option>
<option value="Print">Print</option>
<option value="Assy Kit">Assy Kit</option>
<option value="Scanout">Scanout</option>
<option value="Tailored">Tailored</option>
<option value="Marketing">Marketing</option>
<option value="DAFNY">DAFNY</option>
<option value="Account">Account</option>
</select></tr>

<tr bgcolor="#FFFFFF">
<td ><span class="heading"><p align="left">Stage Name</p></font></td>
<td  colspan=3><input type="text" name="status" maxlength="32"></td>
<td ><span class="heading"><p align="left">Approval Type</p></font></td>
<td  colspan=3><input type="text" name="apprtype" maxlength="32"></td>
</tr>													

<tr bgcolor="#FFFFFF">
<td ><span class="heading"><p align="left">Approval By</p></font></td>
<td  colspan=3><input type="text" name="apprby" maxlength="32"></td>
<td ><span class="heading"><p align="left">Email List</p></font></td>
<td  colspan=3><input type="text" name="emaillist" maxlength="100"></td>
</tr>	

<tr bgcolor="#FFFFFF">
<td ><span class="heading"><p align="left">Allow Customer Display (Y/N)</p></font></td>
<td  colspan=3><input type="text" name="allowcustdisp" maxlength="100"></td>
<td ><span class="heading"><p align="left">Allow Print (Y/N)</p></font></td>
<td  colspan=3><input type="text" name="allowprintdisp" maxlength="100"></td>
</tr>	

<tr bgcolor="#FFFFFF">
<td ><span class="heading"><p align="left">Allow Reporting (Y/N)</p></font></td>
<td  colspan=3><input type="text" name="allowreportdisp" maxlength="100"></td>
<td ><span class="heading"><p align="left">Customer Status Display</p></font></td>
<td  colspan=3><input type="text" name="custstatusdisp" maxlength="100"></td>
</tr>	

<tr bgcolor="#FFFFFF">
<td ><span class="heading"><p align="left">Estimated Time</p></font></td>
<td  colspan=3>
<select id="est_time"  name="est_time" onchange="getsetting_time('est_time')">
 <? 
      for($i=0;$i<=8;$i++)
      {?>
            <option value=<?echo $i?>><?echo $i?>
      <?}?>
             </select>H
             <select id="est_mins"  name="est_mins" onchange="getsetting_time('est_mins')">
       <?for($i=0;$i<=59;$i++){?>
             <option value=<?echo $i?>><?echo $i?>
       <?}?>
             </select>M</td>    
</td>
<td ><span class="heading"><p align="left">Estimated Cost</p></font></td>
<td  colspan=3><input type="text" name="est_cost" id="est_cost" maxlength="3" onKeyup="javascript:validate(est_cost)">
<select name="currency" id="currency">
<option value="$">$</option>
<option value="Rs">Rs</option>

</select></td>
</tr>

<tr bgcolor="#FFFFFF">
 <td ><span class="heading"><p align="left">Active</p></font></td>
<td  colspan=3><span class="heading"><select name="act_status" size="1" width="100">
<option selected>Active
<option value>Inactive
<option value>Obsolete
</select>
<input type="hidden" name="activeval">
</td>
<td ><span class="heading"><p align="left">Dependency</p></font></td>
<td  colspan=3><input type="text" name="dependency" maxlength="15" onKeyup=" "></td>
</tr>

<tr bgcolor="#FFFFFF">
<td ><span class="heading"><p align="left">Secondary Resposibility</p></span></td>
<td  colspan=3><input type="text" name="sec_respose" id="sec_respose" style="background-color: #DFDEDF" readonly="readonly">
<select name="secondary" id="secondary" size="1" width="100" 
onchange="Onselectemp('secondary')">
<option selected>Please Specify</option>
<?php
$resultemp = $newWF->getallemployes();
while ($rowemp = mysql_fetch_row($resultemp))
{
   echo "<option value='" . $rowemp[1] . "'>" . $rowemp[1] . "</option>";

}
?>
</select>
</td>
<td ><span class="heading"><p align="left">Process</p></span></td>
<td  colspan=4><input type="text" name="primary_respose" id="primary_respose" style="background-color: #DFDEDF" readonly="readonly">
<select name="primary" id="primary" size="1" width="100" 
onchange="Onselectemp('primary')">
<option selected>Please Specify</option>
<?php
$resultemp = $newWF->getallemployes();
while ($rowemp = mysql_fetch_row($resultemp))
{
   echo "<option value='" . $rowemp[1] . "'>" . $rowemp[1] . "</option>";

}
?>
</select>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td ><span class="heading"><p align="left">Process</p></span></td>
<td  colspan=3><textarea name="process" id="process" rows=3 cols=30></textarea></td>

<td ><span class="heading"><p align="left">ETA</p></span></td>
<td  colspan=3><textarea name="when_process" id="when_process" rows=3 cols=30></textarea></td>
<td >
  <input type="hidden" name ="pagename" id="pagename" value ="addwfstage">
</td>

</tr>



</table>
</td>
</tr>
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
<table border = 0 cellpadding=0 cellspacing=0 width=100%>
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
