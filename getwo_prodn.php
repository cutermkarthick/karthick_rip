<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getboarddes.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Popup for selecting board designers         =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
   header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
include('classes/workorderClass.php');
include('classes/operatorClass.php');
$newwo = new workorder;
$newoperator = new operator;
$mcname = $_REQUEST['mcname'];
//echo 'Oper name='.$oper_name;
$entdate = $_REQUEST['entdate'];
//echo 'Entered Date='.$entdate;
$shift = $_REQUEST['shift'];
$crn = $_REQUEST['crn'];
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All WO Nos</title>
</head>
<body onload=self.focus()>

<form action='getwo_prodn.php' method='post' enctype='multipart/form-data'>
<?
$result2 = $newoperator->getprevtime($mcname,$entdate,$shift);
$myrow2 = mysql_fetch_row($result2);
$total_prev_mins = ((($myrow2[2] * 60) + $myrow2[3] + ($myrow2[4] * 60) + $myrow2[5] + ($myrow2[6] * 60) + $myrow2[7] + ($myrow2[8] * 60) + $myrow2[9]));
?>
<input type="hidden"  name="total_prev_mins" id="total_prev_mins" size=3 value="<?echo $total_prev_mins;?>">

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
<table>
<tr><td><span class="pageheading"><b>Work Orders</b></td></tr>
<tr><td>
<?php
$result = $newoperator->get_prev_rec($mcname,$entdate,$shift);
$myrow = mysql_fetch_row($result);
$numrows = mysql_num_rows($result);
$total_time = ($myrow[2] * 60) + $myrow[3] + ($myrow[4] * 60) + $myrow[5] + ($myrow[6] * 60) + $myrow[7] + ($myrow[8] * 60) + $myrow[9];
//echo 'Total time='.$total_time;
if($numrows > 0)
{
 if($total_time != 480)
 {
  $valid_flag = 1;
 }
 else
 {
  $valid_flag = 0;
 }
}
else
{
 $valid_flag = 0;
}
$flag = $valid_flag;

?>
<table style="table-layout: fixed" width=770px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
             <td width=5% bgcolor="#EEEFEE"><span class="tabletext"><b>WO#</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Part Name</b></td>
            <td width=15% bgcolor="#EEEFEE"><span class="tabletext"><b>Part Num</b></td>
            <td width=5% bgcolor="#EEEFEE"><span class="tabletext"><b>WO Qty</b></td>

</tr>
</table>
<div style="width:787px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=770px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
        $result = $newoperator->getwonum4CIM($crn);
        while ($myrow = mysql_fetch_row($result)) {
?>

    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="crn"   value="<?php echo $myrow[6]."|".$myrow[5]."|".$myrow[1]."|".$myrow[4]."|".$myrow[7]."|".$myrow[8]."|".$myrow[9]."|".$myrow[10]."|".$myrow[11]."|".$myrow[12]."|".$myrow[13]?>"></td>
	      <td width=5% bgcolor="#FFFFFF" ><span class="tabletext"><?php echo $myrow[6] ?></td>
                          <td width=8%><span class="tabletext"><?php echo $myrow[5] ?></td>
                          <td width=20%><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td width=15%><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td width=5%><span class="tabletext"><?php echo $myrow[7] ?></td>

              </td></tr>
<?php
        }
?>

</table>
 </div>


<script language=javascript>
function SubmitCIM(etype){
 var flag=0;
 var user_input;
 //alert(document.forms[0].crn.length);
//alert(user_input);
//alert(ctype);
if(document.forms[0].crn.length)
{
 for (i=0;i<document.forms[0].crn.length;i++) {
	if (document.forms[0].crn[i].checked)
	{
		user_input = document.forms[0].crn[i].value;
		flag=1;
	}
}
}
else if(document.forms[0].crn.checked)
{
  user_input = document.forms[0].crn.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate CRNs before submitting');
  self.close();
}
//alert(user_input);
window.opener.Setwo_crn(user_input,etype,'<?php echo $flag?>',document.forms[0].total_prev_mins.value);
//window.opener.Setwo_crn(user_input,etype,'<?php echo $flag?>');
self.close();
}

</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
</form>
</body>
</html>

