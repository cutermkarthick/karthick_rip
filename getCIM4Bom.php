<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2013                =
// Filename: getCIM4Bom.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Popup for selecting RM                      =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

include('classes/bomli_mfgClass.php');
$newbom_mfg = new bomli_mfg_items;
// $mtype= $_REQUEST['mtype'];
$mtreat= $_REQUEST['mtreat'];
// echo $mtype . "hello";
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All CRN's</title>
</head>
<body onload=self.focus()>
<form action='getCIM4Bom.php' method='post' enctype='multipart/form-data'>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
<table>
<tr><td><span class="pageheading"><b>PRN</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
        <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
        <td width=6% bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
        <td width=14% bgcolor="#EEEFEE"><span class="tabletext"><b>Part #</b></td>
        <td width=7% bgcolor="#EEEFEE"><span class="tabletext"><b>Part<br>Name</b></td>
        <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Part<br>Issue</b></td>
		  <td width=5% bgcolor="#EEEFEE"><span class="tabletext"><b>COS</b></td>
        <td width=5% bgcolor="#EEEFEE"><span class="tabletext"><b>Drg Iss</b></td>
        <td width=5% bgcolor="#EEEFEE"><span class="tabletext"><b>MPS #</b></td>
        <td width=5% bgcolor="#EEEFEE"><span class="tabletext"><b>MPS Rev</b></td>
       </tr>
</table>
<div style="width:987px; height:300; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?
       $result = $newbom_mfg->getcrnDetails4bommfg($mtreat);
       while ($myrow = mysql_fetch_row($result)) {
       
         if($myrow[22] != '')
         {
           $mps_rev = $myrow[16];
         }
         else
         {
           $mps_rev = $myrow[23];
         }

?>

    <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" width=5%><input type="radio" id="crn"  name="crn"  value="<?php echo $myrow[9]."|".$myrow[4]."|".$myrow[1]."|".$myrow[7]."|".$myrow[10]."|".$myrow[17]."|".$mps_rev."|".$myrow[19]."|".$myrow[24]?>"></td>
	<td width=6% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[9] ?></td>
    <td width=14%><span class="tabletext"><?php echo $myrow[4] ?></td>
    <td width=7%><span class="tabletext"><?php echo wordwrap($myrow[1],14,"<br>\n",true) ?></td>
    <td width=10%><span class="tabletext"><?php echo wordwrap($myrow[7],20,"<br>\n",true)  ?></td>

    <td width=5%><span class="tabletext"><?php echo wordwrap($myrow[19],10,"<br>\n",true)  ?></td>

    <td width=5%><span class="tabletext"><?php echo $myrow[10] ?></td>
    <td width=5%><span class="tabletext"><?php echo $myrow[17] ?></td>
    <td width=5%><span class="tabletext"><?php echo $mps_rev ?></td>
      </tr>
<?php
 }
?>
</table>
 </div>
<script language=javascript>
function SubmitCIM(ctype,mtype,mtreat){
 var flag=0;
 var user_input;
 //alert(document.forms[0].crn.length);
//alert(user_input);
// alert(ctype);
if(document.forms[0].crn.length)
{
 for (i=0;i<document.forms[0].crn.length;i++) {



	if (document.forms[0].crn[i].checked) {
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
  alert('Please select appropriate CRN before submitting');
  self.close();
}
if(mtreat=='Assembly')
{

 window.opener.Setcrn4assy(user_input,ctype);
 self.close();
}
else if(mtreat == 'Treated')
  {
  window.opener.Setcrn4treated(user_input,ctype);
 self.close();
}

else if(mtreat == "Untreated")
{
 window.opener.Setcrn(user_input,ctype);
 self.close();
}
}
</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name,'<?php echo $mtype ?>','<?php echo $mtreat ?>')">
</form>
</body>
</html>

