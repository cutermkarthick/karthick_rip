<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getassyCIM.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Popup for selecting CRN                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];


include('classes/assywoClass.php');
$newassywo = new assywo;
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All PO's</title>
</head>
<body onload=self.focus()>
<form action='getpo_assy.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

<table>
<tr><td><span class="pageheading"><b>PO</b></td></tr>
<tr><td>
	<table style="table-layout: fixed" width=350px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
        <td width=4% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
        <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Cust PO#</b></td>
        <td width=6% bgcolor="#EEEFEE"><span class="tabletext"><b>PO Qty</b></td>
       </tr>
</table>
<div style="width:367px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=350px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?
       $result = $newassywo->getcustpos();
       while ($myrow = mysql_fetch_row($result)) {
?>

    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=4%><input type="radio" id="custpo"  name="custpo"   value="<?php echo $myrow[0]."|".$myrow[1]?>"></td>
	<td width=10% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[0] ?></td>
    <td width=6%><span class="tabletext"><?php echo $myrow[1] ?></td>
      </tr>
<?php
        }
?>
</table>
 </div>
<script language=javascript>
function Submitcustpo(ctype){
 var flag=0;
 var user_input;
 //alert(document.forms[0].custpo.length);
//alert(user_input);
//alert(ctype);
if(document.forms[0].custpo.length)
{
 for (i=0;i<document.forms[0].custpo.length;i++) {
	if (document.forms[0].custpo[i].checked) {
		user_input = document.forms[0].custpo[i].value;
		flag=1;
	}
}
}
else if(document.forms[0].crn.checked)
{
  user_input = document.forms[0].custpo.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate PO before submitting');
  self.close();
}
window.opener.Setcustpo(user_input,ctype);
self.close();}

</script>

<input type=button value="Submit" onclick=" javascript: return Submitcustpo(window.name)">
</form>
</body>
</html>

