<?php
//
//==============================================
// Author: FSI                                 =
// Date-modified = Nov 8, 2006                 =
// Filename: vendpartDetails.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays Vendor Part Details                =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'vendPartDetails';
$page = "Purchasing: Part Master";
//////session_register('pagename');
$partrecnum=$_REQUEST['partrecnum'];
$_SESSION['partrecnum'] = $partrecnum;
//////session_register('partrecnum');
// First include the class definition

include('classes/vendPartClass.php');
include('classes/displayClass.php');
$newVend = new vendPart;
$newdisplay = new display;

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/vendPart.js"></script>

<html>
<head>
<title>Vend Part Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
$result = $newVend->getPartDetails($partrecnum);
$myrow=mysql_fetch_row($result);

?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td></td></tr>
<tr>
<td>
<?php
$newdisplay->dispLinks('');
?>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table style="width:100%" border=0 cellpadding=6 cellspacing=0 class="stdtable1">
<table style="width:100%" border=0>
<tr>
<td><span class="pageheading"><b>Vendor Part Details</b></td>
<td colspan=50>&nbsp;</td>
<td bgcolor="#FFFFFF" rowspan=2 align="right">

<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="location.href='edit_vendPart.php?partrecnum=<?php echo $partrecnum ?>'" value="Edit" >
<!-- <a href ="edit_vendPart.php?partrecnum=<?php echo $partrecnum ?>" ><img name="Image8" border="0" src="images/bu-edit.gif" ></a> -->
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="location.href='javascript: printvendPart(<?php echo $partrecnum ?>)'" value="Print" >
<!-- <input type= "image" name="Print" src="images/bu-print.gif" value="Print"  onclick="javascript: printvendPart(<?php echo $partrecnum ?>)"> -->
</td>
</tr>
</table>
</td></tr>

<tr>
<td>
<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr bgcolor="#FFFFFF">
<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable" >
<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable" >
<form>
<tr bgcolor="#FFFFFF">
<tr bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Vendor Part Details</b></center></td></tr>
<tr bgcolor="#FFFFFF">
<td   width=25%><span class="labeltext"><p align="left">Part Number #</p></font></td>
<td width=25%><span class="tabletext"><?php echo "$myrow[1]";?></td>
<td  width=25%><span class="labeltext"><p align="left">Mfr/Vendor PartNum #</p></font></td>
<td width=25%><span class="tabletext"><?php echo "$myrow[2]";?></td>

</tr>
<tr bgcolor="#FFFFFF">
<td  width=25%><span class="labeltext"><p align="left">DigiKey PartNum</p></font></td>
<td  width=25%><span class="tabletext"><?php echo "$myrow[3]";?></td>
<td  width=25%><span class="labeltext"><p align="left">Serial Num</p></font></td>
<td  width=25%><span class="tabletext"><?php echo "$myrow[4]";?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td   width=25%><span class="labeltext"><p align="left">Manufacturer</p></font></td>
<td  width=25%><span class="tabletext"><?php echo "$myrow[5]";?></td>
<td  width=25%><span class="labeltext"><p align="left">Min Qty</p></font></td>
<td  width=25%><span class="tabletext"><?php echo "$myrow[7]";?></td>
</tr>
<?php
if ($myrow[9] == 'y')
{
$html=  "<td ><span class=\"labeltext\"><p align=\"left\">Lead Time</p></font></td>
<td><span class=\"tabletext\">$myrow[8]
<span class=\"tabletext\">Weeks&nbsp
<input type=\"radio\" disabled name=\"lead_unit\" value=\"yes\" checked>
<span class=\"tabletext\">Months&nbsp
<input type=\"radio\" disabled name=\"lead_unit\" value=\"no\"></td>";
}
else
{
$html=  "<td ><span class=\"labeltext\"><p align=\"left\">Lead Time</p></font></td>
<td><span class=\"tabletext\">$myrow[8]
<span class=\"tabletext\">Weeks&nbsp
<input type=\"radio\" disabled name=\"lead_unit\" value=\"yes\" >
<span class=\"tabletext\">Months&nbsp
<input type=\"radio\" disabled name=\"lead_unit\" value=\"no\" checked></td>";
}
?>

<tr bgcolor="#FFFFFF">
<?php echo $html;?>
<td><span class="labeltext"><p align="left">Part Iss</p></font></td>
<td><span class="tabletext"><?php echo "$myrow[17]";?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td  width=25%><span class="labeltext"><p align="left">Drg #</p></font></td>
<td  width=25%><span class="tabletext"><?php echo "$myrow[18]";?></td>
<td  width=25%><span class="labeltext"><p align="left">Drg Iss</p></font></td>
<td  width=25%><span class="tabletext"><?php echo "$myrow[19]";?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td   width=25%><span class="labeltext"><p align="left">Part Description</p></font></td>
<td   colspan=3><span class="tabletext"><?php echo "$myrow[10]";?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=25%><span class="labeltext"><p align="left">Inventory Count</p></font></td>
<td colspan=3><span class="tabletext"><input type="text" name="invent_cnt"
style=";background-color:#DDDDDD;"
readonly="readonly" size=18 value="<?php echo "$myrow[12]";?>">
<!--<img src="images/bu-activitylog.gif" alt="Get InvXsactions"  onclick="javscript:GetInvXsaction()">-->
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td  width=25% ><span class="labeltext"><p align="left">Value</p></font></td>
<td  width=25%><span class="tabletext"><?php echo "$myrow[11]";?></td>
<td   width=25%><span class="labeltext">Rate</font></td>
<td><span class="tabletext">$<?php echo "$myrow[6]";?></td>
</tr>

</tr>
<tr bgcolor="#FFFFFF">
<td   width=25%><span class="labeltext">Vendor</td>
<td><span class="tabletext"><?php echo "$myrow[21]";?></td>
<td   width=25%><span class="labeltext">Type</font></td>
<td><span class="tabletext"><?php echo "$myrow[15]";?></td>
</tr>

<table width=100% border=0 cellpadding=3 cellspacing=1  class="stdtable" >
<tr bgcolor="#FFFFFF">
<tr bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Issues/Receipts Log</b></center></td></tr>

<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
	<thead>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Date</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Type</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Reference Type</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Reference #</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Qty</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Balance</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Invoice #</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Invoice Date</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Issues/Receipts<br>Emp #</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>CRN</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>M/C Name</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Invoice Value</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Status</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Closing Date</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b></b></td>

</tr>
</thead>

<!-- <table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable"> -->
<?php



$result = $newVend->getInventory($partrecnum);
while ($myrow = mysql_fetch_row($result)) {
if($myrow[2] == "Receipts")
{
if($myrow[9] != '0000-00-00' && $myrow[9] != '' && $myrow[9] != 'NULL')
{
$datearr = split('-', $myrow[9]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date=date("M j, Y",$x);
}
else
{
$date = '';
}
if($myrow[6] != '0000-00-00' && $myrow[6] != '' && $myrow[6] != 'NULL')
{
$datearr = split('-', $myrow[6]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date1=date("M j, Y",$x);
}
else
{
$date1= '';
}



// Added for po2Wo link enhancement on Dec 20

printf('<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>',
$date,$myrow[2], $myrow[5],$myrow[4],$myrow[3],$myrow[8],$myrow[7],$date1,$myrow[10],$myrow[12],$myrow[13],$myrow[11],'','','');

}




else if($myrow[2] == "Issues")
{

$recnum = $myrow[0];

if($myrow[9] != '0000-00-00' && $myrow[9] != '' && $myrow[9] != 'NULL')
{
$datearr = split('-', $myrow[9]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date=date("M j, Y",$x);
}
else
{
$date = '';
}
if($myrow[15] != '0000-00-00' && $myrow[15] != '' && $myrow[15] != 'NULL')
{
$datearr = split('-', $myrow[15]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date1=date("M j, Y",$x);
}
else
{
$date1 = '';
}

if($date1 == "" || $myrow[14] =='Scrap')
{
$editbutton = "<input type=\"button\" class=\"stdbtn btn_blue\" style=\"float:right;padding:2px;margin-right:2px;\" onClick=\"location.href='edit_updateinvcount.php?recnum=".$recnum."&partrecnum=".$partrecnum."'\" value=\"Edit\" >";

// $editbutton = "<a href =\"edit_updateinvcount.php?recnum=".$recnum."&partrecnum=".$partrecnum."\"><img name=\"Image8\" border=\"0\" src=\"images/bu-edit.gif\" ></a></tr>";

}
printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext"></td>
<td bgcolor="#FFFFFF"><span class="tabletext"></td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext"></td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>',
$date,$myrow[2], $myrow[5],$myrow[4],$myrow[3],$myrow[8],$myrow[10],$myrow[12],$myrow[13],$myrow[14],$date1,$editbutton);
}



}
?>
<input type ="hidden" name="recnum" value="<?php echo $recnum?>">

</table>
</div>
</td>
</tr>
</table>
</td>
<!-- 	<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>

</td>
</tr>
</table>
</FORM>
</body>
</html>
