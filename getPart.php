<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getpart.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Popup for selecting Part #                  =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$type=$_REQUEST['type'];

include('classes/vendPartClass.php');
$newpart = new vendPart;
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All Part No.</title>
</head>
<body onload=self.focus()>
<form action='getPart.php' method='post' enctype='multipart/form-data'>
<input type='hidden' name='type' id='type' value='<?=$type?>'>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">

<table>
<tr><td>
	<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
        <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
        <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Part #</b></td>
        <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Part<br>Issue</b></td>
        <td width=12% bgcolor="#EEEFEE"><span class="tabletext"><b>Description</b></td>
        <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Drg #</b></td>
        <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Drg Iss</b></td>
        <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Make/Supplier</b></td>
       </tr>
</table>
<div style="width:987px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?
       $result = $newpart->getPart($type);
       while ($myrow = mysql_fetch_row($result)) {
?>
    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" id="part"  name="part" value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$myrow[4]."|".$myrow[5]?>"></td>
	<td width=10% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[0] ?></td>
    <td width=10%><span class="tabletext"><?php echo $myrow[1] ?></td>
    <td width=12%><span class="tabletext"><?php echo $myrow[2] ?></td>
    <td width=8%><span class="tabletext"><?php echo $myrow[3] ?></td>
    <td width=8%><span class="tabletext"><?php echo $myrow[4] ?></td>
    <td width=10%><span class="tabletext"><?php echo wordwrap($myrow[5],20,"<br>\n",true) ?></td>
      </tr>
<?php
        }
?>
</table>
 </div>
<script language=javascript>
function SubmitPart(ctype,type)
{
 var flag=0;
 var user_input;
if(document.forms[0].part.length)
{
 for (i=0;i<document.forms[0].part.length;i++) {
	if (document.forms[0].part[i].checked) {
		user_input = document.forms[0].part[i].value;
		flag=1;
	}
}
}
else if(document.forms[0].part.checked)
{
  user_input = document.forms[0].part.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate Part # before submitting');
  self.close();
}
if(type == 'Bought Out')
{
    window.opener.Setpart(user_input,ctype);
	 self.close();
}
else
{
   window.opener.Setpart_cons(user_input,ctype);
    self.close();
}
}
</script>
</table></table>
<input type=button value="Submit" onclick=" javascript: return SubmitPart(window.name,'<?php echo $type ?>')">
</form>
</body>
</html>