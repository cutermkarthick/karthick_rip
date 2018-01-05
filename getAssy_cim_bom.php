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

$assy_type=$_REQUEST['assy_type'];
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All Assembly CRN's</title>
</head>
<body onload=self.focus()>
<form action='getAssy_cim_bom.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

<table>
<tr><td><span class="pageheading"><b>Assembly CRN</b></td></tr>
<tr><td>
	<table style="table-layout: fixed" width=1000px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
        <td width=15px bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
        <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
        <td width=15px bgcolor="#EEEFEE"><span class="tabletext"><b>BOM#</b></td>
        <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>BOM Iss</b></td>
        <td width=20px bgcolor="#EEEFEE"><span class="tabletext"><b>Assy Part#</b></td>
        <td width=15px bgcolor="#EEEFEE"><span class="tabletext"><b>Part Iss</b></td>
        <td width=15px bgcolor="#EEEFEE"><span class="tabletext"><b>Drg#</b></td>
        <td width=15px bgcolor="#EEEFEE"><span class="tabletext"><b>Drg Iss</b></td>
        <td width=15px bgcolor="#EEEFEE"><span class="tabletext"><b>Cos Iss</b></td>
        <td width=15px bgcolor="#EEEFEE"><span class="tabletext"><b>MPS #</b></td>
        <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>MPS Rev</b></td>
        <td width=20px bgcolor="#EEEFEE"><span class="tabletext"><b>Description</b></td>
	    	<td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>GRNNum</b></td>
       </tr>
</table>
<div style="width:1020px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=1000px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?
       $result = $newassywo->getcim_bom($assy_type);
       
       while ($myrow = mysql_fetch_row($result)) {
       
       if($myrow[18]=='')
       {
         $mps_rev = $myrow[16];
       }
	   else
       {
         $mps_rev = $myrow[9];
       }

$var=explode('/',$myrow[1]);
$v1=implode('/<br/> ',$var); 

?>
<tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=10px><input type="radio" id="crn"  name="crn"   value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$myrow[4]."|".$myrow[5]."|".$myrow[6]."|".$myrow[7]."|".$myrow[8]."|".$myrow[10]."|".$mps_rev."|".$myrow[18]."|".$myrow[19]."|".$myrow[21]."|".$myrow[20]?>"></td>
	<td width=15px bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[0] ?></td>
    <td width=15px><span class="tabletext"><?php echo $v1 ?></td>
    <td width=10px><span class="tabletext"> <?php echo $myrow[2] ?></td>
    <td width=20px><span class="tabletext"><?php echo wordwrap($myrow[3],10,'<br>',true) ?></td>
    <td width=15px><span class="tabletext"><?php echo wordwrap($myrow[4],10,'<br>',true) ?></td>
    <td width=15px><span class="tabletext"><?php echo $myrow[5] ?></td>
    <td width=15px><span class="tabletext"><?php echo $myrow[6] ?></td>
    <td width=15px><span class="tabletext"><?php echo wordwrap($myrow[7],10,'<br>',true) ?></td>
     <td width=15px><span class="tabletext"><?php echo wordwrap($myrow[10],10,'<br>',true) ?></td>
    <td width=10px><span class="tabletext"><?php echo $mps_rev ?></td>
    <td width=20px><span class="tabletext"><?php echo wordwrap($myrow[19],14,"<br>\n",true)  ?></td>
	 <td width=10px><span class="tabletext"><?php echo $myrow[20] ?></td>
      </tr>
<?php
        }
?>
</table>
 </div>
<script language=javascript>
function SubmitCIM(ctype)
{
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
window.opener.Setcrn_assy(user_input,ctype);
self.close();
}

</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
</form>
</body>
</html>

