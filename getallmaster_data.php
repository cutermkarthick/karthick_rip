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
include('classes/salesorderClass.php');
$newsalesorder = new salesorder;
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All Master Data</title>
</head>
<body onload=self.focus()>

<form action='getCIM.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=970px border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>CRN</b></td></tr>
<tr><td>
<table width="500px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Partnum</b></td>

           <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Dim1</b></td>
           <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Dim2</b></td>
           <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Dim3</b></td>  
           <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Attachments</b></td>  
           <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Drg Issue</b></td>  
           <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>COS</b></td>  
            </tr>
           </table>
           <div style="width:581px; height:200; overflow:auto;border:">
<table width="500px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
      $result = $newsalesorder->getallmaster_data();
      while ($myrow = mysql_fetch_row($result)) 
    {

?>
    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="crn"   value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]
    ."|".$myrow[3]."|".$myrow[4]."|".$myrow[5]."|".$myrow[6]."|".$myrow[7]."|".$myrow[8]?>"></td>
     <td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
      <td width=8%><span class="tabletext"><?php echo $myrow[2] ?></td>
      <td width=8%><span class="tabletext"><?php echo $myrow[3] ?></td>
      <td width=8%><span class="tabletext"><?php echo $myrow[4] ?></td>
      <td width=8%><span class="tabletext"><?php echo $myrow[5] ?></td>
      <td width=8%><span class="tabletext"><?php echo $myrow[6] ?></td>
      <td width=8%><span class="tabletext"><?php echo $myrow[7] ?></td>
      <td width=8%><span class="tabletext"><?php echo $myrow[8] ?></td>
      </td></tr>
<?php
      }

?>
</table>
 </div>




<script language=javascript>
function SubmitCIM(etype)
{

 var flag=0;
 var user_input;
/* alert(document.forms[0].crn.length);
alert(user_input);
alert(ctype);*/
// alert(etype);
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
window.opener.SetCIM(user_input,etype);
self.close();
}


</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
</form>
</body>
</html>

