<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: workflow                          =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Workflow details                            =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
if ( !isset ( $_REQUEST['wftype'] ) )
{
     header ( "Location: login.php" );
}
$wftype = $_REQUEST['wftype'];

// Includes
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/workflowClass.php');


$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'wfdetails';
$page ="Work Flow";
//////session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisplay = new display;
$newWF = new workflow;

?>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/workflow.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>List of Workflows</title>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0">
<form action='processWF.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% border=0 cellspacing="1" cellpadding="6">
    <tr>
        <td align="left"><span class="pageheading"><b>Workflow for <?php echo $wftype ?></b></td>
        <td width="5%">&nbsp;</td>
	<td><!- <a href ="addwfstage.php"><img name="Image8" border="0" src="images/bu-newwf.gif"></a> --></td>
    <!-- </tr> -->

    <!-- </tr> -->


    <table width=100% border=0>
<tr>
<td><span class="pageheading"><b>New WF Stage</b></td>
</tr>
</table>
</td></tr>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td width="25%" ><span class="heading"><p align="left">Stage #</p></font></td>
<td colspan=3><span class="heading"><input type="text" name="stage" size=20 value="" onKeyup="javascript:validate(stage)"></td>
<td ><span class="heading"><p align="left">Type</p></font></td>
<td  colspan=4><input type="text" name="type" maxlength="32"></td>
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
</select>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td ><span class="heading"><p align="left">Stage Name</p></font></td>
<td  colspan=3><input type="text" name="status" maxlength="32"></td>
<td ><span class="heading"><p align="left">Approval Type</p></font></td>
<td  colspan=4><input type="text" name="apprtype" maxlength="32"></td>
</tr>                         

<tr bgcolor="#FFFFFF">
<td ><span class="heading"><p align="left">Approval By</p></font></td>
<td  colspan=3><input type="text" name="apprby" maxlength="32"></td>
<td ><span class="heading"><p align="left">Email List</p></font></td>
<td  colspan=4><input type="text" name="emaillist" maxlength="100"></td>
</tr> 

<tr bgcolor="#FFFFFF">
<td ><span class="heading"><p align="left">Allow Customer Display (Y/N)</p></font></td>
<td  colspan=3><input type="text" name="allowcustdisp" maxlength="100"></td>
<td ><span class="heading"><p align="left">Allow Print (Y/N)</p></font></td>
<td  colspan=4><input type="text" name="allowprintdisp" maxlength="100"></td>
</tr> 

<tr bgcolor="#FFFFFF">
<td ><span class="heading"><p align="left">Allow Reporting (Y/N)</p></font></td>
<td  colspan=3><input type="text" name="allowreportdisp" maxlength="100"></td>
<td ><span class="heading"><p align="left">Customer Status Display</p></font></td>
<td  colspan=4><input type="text" name="custstatusdisp" maxlength="100"></td>
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
<td  colspan=4><input type="text" name="est_cost" maxlength="3" onKeyup="javascript:validate(est_cost)">
<select name="currency" id="currency">
<option value="$">$</option>
<option value="Rs">Rs</option>

</select>
</td>
</tr>

<tr bgcolor="#FFFFFF">
 <td ><span class="heading"><p align="left">Status</p></font></td>
<td  colspan=3><span class="heading"><select name="act_status" size="1" width="100">
<option selected>Active
<option value>Inactive
<option value>Obsolete
</select>
<input type="hidden" name="activeval">
</td>
<td ><span class="heading"><p align="left">Dependency</p></font></td>
<td  colspan=4><input type="text" name="dependency" maxlength="15" onKeyup=" "></td>
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

<td ><span class="heading"><p align="left">Primary Resposibility</p></span></td>
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

<table style="table-layout: fixed;width:100%;" border=0 cellpadding=3 cellspacing=1 class="stdtable" >
<tr> <td align="center"><span class="tabletext"><input type="submit" 
       style="color=#0066CC;background-color:#DDDDDD;width=130;"
       value="Submit" name="submit" onclick="javascript: return check_req_fields()">
      <INPUT TYPE="RESET"
        style="color=#0066CC;background-color:#DDDDDD;width=130;"
    VALUE="Reset" onclick="javascript: putfocus()">
    </INPUT>
    </span>
    </td>
    </tr>
    </table>

              <div class="contenttitle radiusbottom0">
                <h2>
                  <span>Workflow  Details for Type <?php echo $wftype ?>
                  </span>
                </h2>
              </div>
            


  <table style="table-layout: fixed;width:100%" border=0 cellpadding=3 cellspacing=1 class="stdtable">

      <tr>
	      <td bgcolor="#EEEFEE" width = "20px"><span class="heading"><b>Stage</b></td>
<!--         <td bgcolor="#EEEFEE" width = "20px"><span class="heading"><b>Type</b></td>
 -->      
      	<td bgcolor="#EEEFEE" width = "20px"><span class="heading"><b>Doc Type</b></td>
        <td bgcolor="#EEEFEE" width = "30px"><span class="heading"><b>Dept</b></td>
        <td bgcolor="#EEEFEE" width="30px"><span class="heading"><b>Stage Name</b></td>
        <td bgcolor="#EEEFEE" width="67px"><span class="heading"><b>Secondary<br/> Resposibility</b></td>
        <td bgcolor="#EEEFEE" width="67px"><span class="heading"><b>Primary<br/>Resposibility</b></td>
        <!-- <td bgcolor="#EEEFEE"><span class="heading"><b>Status</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Est<br> Time</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Est<br> Cost</b></td>
	      <td bgcolor="#EEEFEE"><span class="heading"><b>Appr<br> Type</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Customer</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Print</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Report</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Approval By</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Email<br> List</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Customer<br>Status</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Dependency</b></td> -->
      </tr>
</table>

<div style="width:101%;height:250px;overflow-y:scroll;">
<table style="table-layout: fixed;width:100%" border=0 cellpadding=3 cellspacing=1 class="stdtable">
<?php
      $result = $newWF->getWFdetails($wftype);

      while ($myrow = mysql_fetch_row($result)) {
?>
<tr>
<td bgcolor="#FFFFFF" width="20px"><span class="heading"><a href="editwf.php?wftype=<?php echo $wftype ?>&wfrecnum=<?php echo $myrow[4] ?>"><?php echo $myrow[1] ?></td>
<!-- <td bgcolor="#FFFFFF" width="20px"><span class="heading"><?php echo $myrow[0] ?></td> -->
<td bgcolor="#FFFFFF" width="20px"><span class="heading"><?php echo $myrow[7] ?></td>
<td bgcolor="#FFFFFF" width="30px"><span class="heading"><?php echo $myrow[2] ?></td>
<td bgcolor="#FFFFFF" width="30px"><span class="heading"><?php echo $myrow[3] ?></td>
<td bgcolor="#FFFFFF" width="67px"><span class="heading"><?php echo $myrow[17] ?></td>
<td bgcolor="#FFFFFF" width="67px"><span class="heading"><?php echo $myrow[18] ?></td>
 	<!-- <td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[3] ?></td>
        <td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[13] ?></td>
        <td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[15] ?></td>
        <td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[5] ?></td>
        <td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[9] ?></td>
        <td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[10] ?></td>
        <td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[11] ?></td>
 	<td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[6] ?></td>
 	<td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[8] ?></td>
 	<td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[12] ?></td>
 	<td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[16] ?></td> --> 	
      </tr>
<?php
      }
?>
        </table>
</td>
		</table>

      </FORM>


</table>



</body>
</html>
