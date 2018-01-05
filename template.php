<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 2, 2005               =
// Filename: edit_wotype.php                         =
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
$_SESSION['pagename'] = 'edit_wotype'; 
//////session_register('pagename');

include('classes/userClass.php'); 
include_once('classes/loginClass.php');
include('classes/displayClass.php'); 
include('classes/pagefieldsClass.php'); 
include('classes/pageClass.php'); 

$newpage = new page; 
$newPfields = new pagefields; 
$newdisp = new display;
$parent=$_REQUEST['parent'];
$pname=$_REQUEST['pname'];

$newlogin = new userlogin;
$newlogin->dbconnect();

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/wotype.js"></script>
<html>
<head>
<title>New WO Type</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<table width=500 cellspacing="0" cellpadding="6" border="0">
<tr>
<?php echo "<td align=\"center\"><span class=\"labeltext\">View of Type  :$pname  ;  Parent Page :$parent   </h5>";?>
</t></tr>
</table>
<table width=500 cellspacing="0" cellpadding="6" border="0">

<tr>
<td>

<table width=550 border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">

<table border=0 bgcolor="#DFDEDF" width=550 cellspacing=1 cellpadding=3>

<input type="hidden" name="action" value="new">
<?php
// echo "wotype:$wotype";
// $ctrls=$newpage->createjs($parent,$pname) ;
 $ctrls=$newpage->createctrls4template($parent,$pname) ;
echo "$ctrls";
?>

</table>
</td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table>
					</FORM>
		</body>
</html>
