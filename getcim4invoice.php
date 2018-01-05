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
$index=$_REQUEST['index'];
//echo "<br>index is $index";
$userid = $_SESSION['user'];
$companyrecnum=$_REQUEST['companyrecnum'];
$invdate=$_REQUEST['invdate'];
//echo$companyrecnum."herererereer";
include('classes/priceClass.php');
$newinv = new price;
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All CIM Ref Nos</title>
</head>
<body onload=self.focus()>

<form action='getCIM.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>CIM</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>CRN</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Partnum</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Partname</b></td>
            <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Price</b></td>
            <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Type</b></td>
		<!--	<td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Currency</b></td>
			<td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Price</b></td>
		    <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Valid From</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Valid To</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td> -->

       </tr>
</table>
<div style="width:987px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
      $result = $newinv->getprice4invoice($companyrecnum,$invdate);
      while ($myrow = mysql_fetch_row($result))
	  {

?>
    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="crn"   id="crn" value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$myrow[4]?>"></td>
                          <td width=8%><span class="tabletext"><?php echo $myrow[0] ?></td>
                          <td width=20%><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td width=20%><span class="tabletext"><?php echo $myrow[2] ?></td>
	                      <td width=10%><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td width=10%><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <!--<td width=8%><span class="tabletext"><?php echo $myrow[6] ?></td>
			              <td width=8%><span class="tabletext"><?php echo $myrow[7] ?></td>-->

       </td></tr>
<?php
      }
?>
</table>
 </div>


<script language=javascript>
function SubmitCRNdet(etype,index){
 var flag=0;
 var user_input;
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
window.opener.SetCRNdet(user_input,index);
self.close();}


</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCRNdet(window.name,<?php echo $index ?>)">
</form>
</body>
</html>

