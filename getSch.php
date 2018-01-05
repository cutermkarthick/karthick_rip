<?php
//
//===================================================
// Author: FSI                                 =
// Date-written = July 21, 2012             =
// Filename: getSch.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                         =
// Popup for selecting Schedule date and qty from CRN Sch    =
//===================================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$crnnum = $_REQUEST['crnnum'];
include('classes/delivery_schClass.php');
$newDelsch = new deliverye_sch;
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All Schedules</title>
</head>
<body onload=self.focus()>

<form action='getSch.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>PRN</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width="985px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Part Num</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Sch Date</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Sch Qty #</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Wo Issue Qty</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Disp UTD</b></td>
       </tr>
</table>
<div style="width:987px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=985px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
      $result = $newDelsch->getAllSchs($crnnum);
      while ($myrow = mysql_fetch_row($result)) 
	  {

?>
    <tr bgcolor="#FFFFFF">
	<td bgcolor="#FFFFFF" ><input type="radio" name="crn"   id="crn" value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$myrow[4]."|".$myrow[5]."|".$myrow[6]."|".$myrows[7]."|".$myrow[8] ?>"></td>
	      <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[7] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[2] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[9] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[8] ?></td>
       </td></tr>
<?php
      }
echo $myrow[24];
?>
</table>
 </div>


<script language=javascript>
function SubmitSch(etype){
 var flag=0;
 var user_input;
//  alert(document.forms[0].crn.value);
 //alert(document.forms[0].crn.length);
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
  alert('Please select appropriate Schedule before submitting');
  self.close();
}
//alert(user_input);
window.opener.SetSch(user_input,etype);
self.close();}


</script>

<input type=button value="Submit" onclick=" javascript: return SubmitSch(window.name)">
</form>
</body>
</html>

