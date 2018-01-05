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
include('classes/opportunityClass.php');
$newopportunity = new opportunity;
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All Leads</title>
</head>
<body onload=self.focus()>

<form action='getCIM.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>Leads</b></td></tr>
<tr><td>
<table width="150%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Name</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Company</b></td>
       </tr>
<?php
      $result = $newopportunity->getAllleads();
      while ($myrow = mysql_fetch_row($result)) 
	  {

?>
    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="crn"   value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]?>"></td>
	    <td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
      <td width=20%><span class="tabletext"><?php echo $myrow[2] ?></td>
                          
       </td></tr>
<?php
      }

?>
</table>
 </div>




<script language=javascript>
function Submitlead(etype)
{

 var flag=0;
 var user_input;
/* alert(document.forms[0].crn.length);
alert(user_input);
alert(ctype);*/
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
// alert(user_input);
window.opener.Setlead(user_input,etype);
self.close();
}


</script>

<input type=button value="Submit" onclick=" javascript: return Submitlead(window.name)">
</form>
</body>
</html>

