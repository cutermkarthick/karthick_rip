<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = March 21, 2005               =
// Filename: newsr.php                         =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
//==============================================
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'new_wotype'; 
$page= "Template";
//////session_register('pagename');

include('classes/displayClass.php'); 
$newdisp = new display;

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/wotype.js"></script>
<html>
<head>
<title>New WO Type</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<form  action="processwotype.php" method='post' enctype='multipart/form-data'>

<?php
    include('header.html');
?>

<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">

<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td><span class="welcome"><b>Welcome 	</b></td>
<td align="right">&nbsp;
    <a href="exit.php" onMouseOut="MM_swapImgRestore()"        
    onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0"         src="images/logout.gif"></a>
</td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>
<?php
	$newdisp->dispLinks(''); 
?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF"> -->

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">
<tr bgcolor="#FFFFFF" width=100%>
<td><span class="labeltext"><p align="left">Parent Page</p></td>
<td align="center"><span class="tabletext"><select name="parent" size="1" width="100"  onchange="onSelectparent()">
	        <option selected>WorkOrder
	         <option value>Quote
</td>
<td><span class="labeltext"><p align="left">Type Name</p></td>
<td ><input type="text" size=30  name="pname"></td>
</tr>
<input type="hidden" name="parentval" value="WorkOrder">
<tr bgcolor="#FFFFFF" width=100%>
<td><span class="labeltext"><p align="left">Group1</p></td>
<td ><input type="text" size=30  name="grp1"></td>
<td><span class="labeltext"><p align="left">Group2</p></td>
<td ><input type="text" size=30  name="grp2"></td>
</tr>
<tr bgcolor="#FFFFFF" width=100%>
<td><span class="labeltext"><p align="left">Group3</p></td>
<td ><input type="text" size=30  name="grp3"></td>
<td><span class="labeltext"><p align="left">Group4</p></td>
<td ><input type="text" size=30  name="grp4"></td>
</tr>
<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index1.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>

<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Seq #</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Label</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Controls</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Mandatory</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Group</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Status</center></b></td>
</tr>

<?php
      $i=1;
      while ($i<=5) 
     {	
	printf('<tr bgcolor="#FFFFFF">');
	$seqnum="seqnum" . $i;
	$lname="lname" . $i;
	$type="type" . $i;
	$typeval="typeval" . $i;
	$mandatory="mandatory" . $i;
	$getbut="getbut" . $i;
	$getbutval="getbutval" . $i;
	$status="status" . $i;
	$statusval="statusval" . $i;
	$group="group" . $i;
	$groupval="groupval" . $i;
	echo "<td align=\"center\"><span class=\"tabletext\"><input type=\"text\"  name=\"$seqnum\"  value=\"\" size=\"5%\"></td>";
	echo "<td align=\"center\"><input type=\"text\" name=\"$lname\" size=\"20%\" value=\"\"></td>";
	echo "<td align=\"center\"><span class=\"tabletext\"><select name=\"$type\" size=\"1\" width=\"100\" onchange=\"onSelecttype($i)\">";
	echo "<option selected>Text
	         <option value>Desc Text
	         <option value>Long
	         <option value>Numeric
	         <option value>Decimal
	         <option value>Date
	         <option value>Check Box
	         <option value>Part With Qty
	         <option value>Part 
	          </td>";
	echo "<td align=\"center\"><span class=\"tabletext\"><input type=\"checkbox\" name=\"$mandatory\" size=13 value=\"\"></td>";
	echo "<td align=\"center\"><span class=\"tabletext\"><select name=\"$group\" size=\"1\" width=\"100\"  onchange=\"onSelectbut($i)\">";
	echo "<option selected>Group1
	         <option value>Group2
	         <option value>Group3
	         <option value>Group4
	          </td>";
	echo "<td align=\"center\"><span class=\"tabletext\"><select name=\"$status\" size=\"1\" width=\"100\"  onchange=\"onSelectbut($i)\">";
	echo "<option selected>Active
	         <option value>InActive
	          </td>";

	echo "<input type=\"hidden\" name=\"$typeval\" value=\"Text\">";
	echo "<input type=\"hidden\" name=\"$groupval\" value=\"Group1\">";
	echo "<input type=\"hidden\" name=\"$statusval\" value=\"Active\">";

	printf('</tr>');
	$i++;     

    }    
echo "<input type=\"hidden\" name=\"index1\" value=$i>";
										
?>

</table>
</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
<span class="labeltext"><input type="submit" 
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

					</FORM>
		</body>
</html>
