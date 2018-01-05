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
include('classes/helperClass.php');
$newwo = new helper;
$crn=$_REQUEST['crn'];
?>
<html>
<head>
<title>All all WO</title>
</head>
<body onload=self.focus()>
<form>
<link rel="stylesheet" href="style.css">
<html>
<head>
<title>All WO's</title>
</head>
<body onload=self.focus()>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>WO</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>WO#</b></td>
            <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>PRN NUM</b></td>
            <td width=15% bgcolor="#EEEFEE"><span class="tabletext"><b>Customer</b></td>
            <td width=15% bgcolor="#EEEFEE"><span class="tabletext"><b>PoNum</b></td>
            <td width=15% bgcolor="#EEEFEE"><span class="tabletext"><b>PartNum</b></td>
            <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>PartName</b></td>
            <td width=15% bgcolor="#EEEFEE"><span class="tabletext"><b>BatchNum</b></td>
            <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Matl Spec</b></td>			
            <td width=15% bgcolor="#EEEFEE"><span class="tabletext"><b>Issue PS</b></td>	
			<td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>WOType</b></td>	
			<td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>WO Status</b></td>	
			</tr>
</table>
<div style="width:987px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
$assycrn = substr($crn,2,2);
if($assycrn == 'A-')
{
     $result = $newwo->getwos4qa4assy($crn);
}
else
{
    $result = $newwo->getwos4qa($crn);
}
       while ($myrow = mysql_fetch_row($result)) {  ?>
    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="wonum"   value="<?php echo $myrow[5]."|".$myrow[4]."|".$myrow[7]."|".$myrow[6]."|".$myrow[3]."|".$myrow[1]."|".$myrow[8]."|".$myrow[9]."|".$myrow[10].
	"|".$myrow[12]."|".$myrow[13];?>"></td>
	      <td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
	       <td width=10% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td width=15%><span class="tabletext"><?php echo wordwrap($myrow[7],15,"<br/>\n",true) ?></td>
                          <td width=15%><span class="tabletext"><?php echo wordwrap($myrow[6],10,"<br/>\n",true) ?></td>
                          <td width=15%><span class="tabletext"><?php echo wordwrap($myrow[3],10,"<br/>\n",true) ?></td>
                          <td width=10%><span class="tabletext"><?php echo wordwrap($myrow[1],11,"<br/>\n",true)  ?></td>
                          <td width=15%><span class="tabletext"><?php echo $myrow[8] ?></td>
                           <td width=10%><span class="tabletext"><?php echo wordwrap($myrow[9],10,"<br/>\n",true) ?></td>
						    <td width=15%><span class="tabletext"><?php echo wordwrap($myrow[10],10,"<br/>\n",true) ?></td>
							 <td width=10%><span class="tabletext"><?php echo wordwrap($myrow[12],10,"<br/>\n",true) ?></td>
							  <td width=10%><span class="tabletext"><?php echo $myrow[13] ?></td>

       </td></tr>
<?php
      }
?>
</table>
 </div>



<script language=javascript>
function SubmitCIM(etype) {
var flag=0;
 var user_input;

if(document.forms[0].wonum.length)
{
 var ind = document.forms[0].wonum.selectedIndex;
 for (i=0;i<document.forms[0].wonum.length;i++) {
	if (document.forms[0].wonum[i].checked) {
		user_input = document.forms[0].wonum[i].value;	
		flag=1;
	}
}
}
else if(document.forms[0].wonum.checked)
{
  user_input = document.forms[0].wonum.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate WONUM before submitting');
  self.close();
}
//alert(user_input);
 window.opener.Setwo_qa(user_input,'',etype);
   self.close();

}
</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
</form>
</body>
</html>