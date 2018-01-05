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
include('classes/grnclass.php');
$newgrn = new grn;

$ponum=str_replace("and","&",$_REQUEST['ponum']);
//echo"";
$polinenum=$_REQUEST['polinenum'];
$wotype=$_REQUEST['wotype'];
//$me=str_replace("and","&","iandme");
//echo$ponum."-here";
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All HOST Ref Nos</title>
</head>
<body onload=self.focus()>

<form action='getCIM.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>Host</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=300px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
       </tr>
</table>
<div style="width:320px; height:250; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=300px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php

  if($wotype == 'Assy')
  {
    $result = $newgrn->getAll_assy_CIMs();
  }
  else
  {
     if($ponum != '')
     { 
       $result = $newgrn->getpocrn4grn($ponum,$polinenum);	  
     }
     else
     {  	
       $result = $newgrn->getallCIM4rm_master();   
     }
  }
while ($myrow = mysql_fetch_row($result))
{
?>
    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="crn"   value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$myrow[4]."|".$myrow[5]."|".$myrow[6]?>"></td>
	      <td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[0] ?></td>
       </td></tr>
<?php
}
//echo $myrow[24];
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
//alert(user_input);
window.opener.SetCIM(user_input,etype);
self.close();}


</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
</form>
</body>
</html>

