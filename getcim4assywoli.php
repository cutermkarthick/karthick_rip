<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = May 29, 2012                 =
// Filename: getcim4assywoli.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// To select CRN for Assy Wo li                =
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

$bomnum=$_REQUEST['bomnum'];
$assy_qty=$_REQUEST['assy_qty'];
$index=$_REQUEST['index'];
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>CRN</title>
</head>
<body onload=self.focus()>
<form action='getAssy_cim_bom.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">

<table>
<tr><td><span class="pageheading"><b>PRN for Assembly WO</b></td></tr>
<tr><td>
        <table style="table-layout: fixed" width=950px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr  bgcolor="#FFCC00">
        <td width=10px bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
        <td width=15px bgcolor="#EEEFEE"><span class="tabletext"><b>BOM Type</b></td>
        <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Item No.</b></td>
        <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
        <td width=15px bgcolor="#EEEFEE"><span class="tabletext"><b>PRN Type</b></td>
        <td width=20px bgcolor="#EEEFEE"><span class="tabletext"><b>Part #</b></td>
        <td width=15px bgcolor="#EEEFEE"><span class="tabletext"><b>Part Iss</b></td>
        <td width=25px bgcolor="#EEEFEE"><span class="tabletext"><b>Description</b></td>
        <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Qty/Assy</b></td>
       </tr>
</table>
<div style="width:970px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=950px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?
       $result = $newassywo->getbom_assyWo_partDetails($bomnum);
       while ($myrow = mysql_fetch_row($result))
       {
         $assyQty=$assy_qty*$myrow[6];
         //bom_mfg.item_no as itn,bom_mfg.partnum,bom_mfg.partname, bom_mfg.partiss,'Manufactured',
    // bom_mfg.crn,bom_mfg.qpa,bom_mfg.crn_type
?>

    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=10px><input type="radio" id="crn"  name="crn" value="<?php echo $myrow[4]."|".$myrow[0]."|".$myrow[5]."|".$myrow[7]."|".$myrow[1]."|".$myrow[3]."|".$myrow[2]."|".$myrow[6]."|".$assyQty?>"></td>
	<td width=15px bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4] ?></td>
    <td width=10px><span class="tabletext"><?php echo $myrow[0] ?></td>
    <td width=10px><span class="tabletext"><?php echo $myrow[5] ?></td>
    <td width=15px><span class="tabletext"><?php echo $myrow[7] ?></td>
    <td width=20px><span class="tabletext"><?php echo $myrow[1] ?></td>
    <td width=15px><span class="tabletext"><?php echo wordwrap($myrow[3],15,"<br>\n",true) ?></td>
    <td width=25px><span class="tabletext"><?php echo wordwrap($myrow[2],30,"<br>\n",true) ?></td>
    <td width=10px><span class="tabletext"><?php echo $myrow[6]?></td>
    </tr>
<?php
        }
?>
</table>
 </div>
<script language=javascript>
function SubmitCIM(ctype,index){
 var flag=0;
 var user_input;
 //alert(document.forms[0].crn.length);
//alert(user_input);
//alert(ctype);
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
window.opener.Setcrn_assy4li(user_input,index);
self.close();}

</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name,'<?php echo $index ?>')">
</form>
</body>
</html>

