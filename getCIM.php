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
include('classes/masterdataClass.php');
$newMD = new masterdata;
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All PRN Ref Nos</title>
</head>
<body onload=self.focus()>

<form action='getCIM.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>PRN</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Part Name</b></td>
            <td width=15% bgcolor="#EEEFEE"><span class="tabletext"><b>Part Num</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>COS</b></td>
            <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>MPS #</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>MPS Rev</b></td>
            <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Control</b></td>
			<td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Treatment</b></td>
       </tr>
<!-- </table>
<div style="width:987px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" > -->
<?php
      $result = $newMD->getAllCIMs();
      while ($myrow = mysql_fetch_row($result)) 
	  {


      
         if($myrow[22] != '')
         {
           $mps_rev = $myrow[16];
         }
         else
         {
           $mps_rev = $myrow[23];
         }

       /*  if($myrow[24] == 'Manufacture Only')
         {

           $myrow[24] = 'Untreated';
         }else
         {
             $myrow[24] = 'Treated';

         }*/

         $partiss = htmlspecialchars($myrow[7]);
		 $drgiss = htmlspecialchars($myrow[10]);
?>
    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="crn"   value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$myrow[4]."|".$myrow[5]."|".$myrow[6]."|".$partiss."|".$myrow[8]."|".$myrow[9]."|".$drgiss."|".$myrow[11]."|".$myrow[12]."|".$myrow[13]."|".$myrow[14]."|".$myrow[15]."|".$mps_rev."|".$myrow[17]."|".$myrow[18]."|".$myrow[19]."|".$myrow[22]."|".$myrow[24] ?>"></td>
	      <td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[9] ?></td>
                          <td width=20%><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td width=15%><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td width=8%><span class="tabletext"><?php echo $myrow[19] ?></td>
                          <td width=10%><span class="tabletext"><?php echo $myrow[17] ?></td>
                          <td width=8%><span class="tabletext"><?php echo $mps_rev ?></td>
                          <td width=10%><span class="tabletext"><?php echo $myrow[20] ?></td>
						   <td width=10%><span class="tabletext"><?php echo $myrow[24] ?></td>
       </td></tr>
<?php
      }
echo $myrow[24];
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

