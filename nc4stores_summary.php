<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Oct 23, 2009                 =
// Filename: nc4stores_summary.php             =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays list of comapnies.                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'nc4stores_summary';
$page="Stores: NC";
//////session_register('pagename');

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/nc4storesClass.php');
include_once('classes/displayClass.php');


$newnc4stores = new nc4stores;
$newdisplay = new display;

$cond0 = "refnum like '%'";
$cond1 = "(to_days(date)-to_days('1582-01-01') >= 0 ||
date = '0000-00-00' ||
date is NULL) and
(to_days(date)-to_days('2050-12-31') <= 0 ||
date = '0000-00-00' ||
date is NULL)";
$cond2 = "supplier like '%'";
$cond3 = "cofcnum like '%'";
$cond4 = "rm_po_num like '%'";
$cond5 = "invoice_num like '%'";

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5;

if ( isset ( $_REQUEST['refnum'] ) )
{
$refnum = "'" . $_REQUEST['refnum'] . "%" . "'";        

$cond0 = "refnum like ". $refnum;

}
else 
{  
$refnum='';
}

if ( isset ( $_REQUEST['fdate'] ) || isset ( $_REQUEST['fdate2'] ) )
{
if ( isset ( $_REQUEST['fdate1']) &&  $_REQUEST['fdate1'] != '' )
{
$fdate1 = $_REQUEST['fdate1'];
$cond11 = "(to_days(date) " . ">= to_days('" . $fdate1 . "'))";

}
else
{
$cond11 = "((to_days(date)-to_days('1582-01-01') >= 0 || date is NULL || date = '0000-00-00'))";
}

if ( isset ( $_REQUEST['fdate2'] )  &&  $_REQUEST['fdate2'] != '')
{
$fdate2 = $_REQUEST['fdate2'];
$cond12 = "(to_days(date) " . "<= to_days('" . $fdate2 . "'))";
}
else
{
$cond12 = "((to_days(date)-to_days('2050-12-31') <= 0 || date is NULL || date = '0000-00-00'))";
}
$cond1 = $cond11 . ' and ' . $cond12;

}
else
{
$fdate1 = '';
$fdate2 = '';
}

if ( isset ( $_REQUEST['supplier'] ) )
{
$supplier = $_REQUEST['supplier'];
$supplier = "'" . $_REQUEST['supplier'] . "%" . "'";

$cond2 = "supplier like " . $supplier;

}
else {
$supplier = '';
}

if ( isset ( $_REQUEST['cofcnum'] ) )
{
$cofcnum = $_REQUEST['cofcnum'];
$cofcnum = "'" . $_REQUEST['cofcnum'] . "%" . "'";

$cond3 = "cofcnum like " . $cofcnum;

}
else {
$cofcnum = '';
}

if ( isset ( $_REQUEST['rm_po_num'] ) )
{
$rm_po_num = $_REQUEST['rm_po_num'];
$rm_po_num = "'" . $_REQUEST['rm_po_num'] . "%" . "'";

$cond4 = "rm_po_num like " . $rm_po_num;

}
else {
$rm_po_num = '';
}

if ( isset ( $_REQUEST['invoice_num'] ) )
{
$invoice_num = $_REQUEST['invoice_num'];
$invoice_num = "'" . $_REQUEST['invoice_num'] . "%" . "'";

$cond5 = "invoice_num like " . $invoice_num;

}
else {
$invoice_num = '';
}

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5;
$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];
// how many rows to show per page
$rowsPerPage = 100;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
$pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
$totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

//echo $offset;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/nc4qa.js"></script>

<html>
<head>
<title>QA Stores</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='nc4stores_summary.php' method='GET' enctype='multipart/form-data'>
<?php
include('header.html');
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
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=2>
<tr><td>
<tr><td><span class="heading"><i>Please click on the Ref No. to Edit/Delete</i></td></tr>
</tr>
<tr>
<td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td bgcolor="#F5F6F5" colspan="13"><span class="heading"><b><center>Search Criteria</center></b></td>
</tr>

<tr>
<td bgcolor="#FFFFFF"><span class="heading"><b>Ref No:</b></td>
<td bgcolor="#FFFFFF"><span class="heading"><input type="text" size=8% name="refnum" value="<?echo $_REQUEST['refnum'] ?>"></td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Create Date: </b></td>
<td bgcolor="#FFFFFF"><span class="heading"><b> From</b><input type="text" name="fdate1" size=10 value="<?php echo $_REQUEST['fdate1'] ?>"
onkeypress="javascript: return checkenter(event)">
<img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("fdate1")'>
<span class="labeltext"><b>&nbsp;&nbsp;To</b>
<input type="text" name="fdate2" size=10 value="<?php echo $_REQUEST['fdate2'] ?>"
onkeypress="javascript: return checkenter(event)">
<img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("fdate2")'>
</td>	     
<td bgcolor="#FFFFFF"><span class="heading"><b>Supplier:</b></td>
<td bgcolor="#FFFFFF"><span class="heading"><input type="text" size=15% name="supplier" value="<?echo $_REQUEST['supplier'] ?>"></td>
<td bgcolor="#FFFFFF" rowspan=3 align='center'><span class="heading">
<button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button>
<!-- <input type= "image" name="submit" src="images/bu-get.gif" value="Get"> -->
</td>	
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="heading"><b>C of C No:</b></td>
<td bgcolor="#FFFFFF"><span class="heading"><input type="text" size=15% name="cofcnum" value="<?echo $_REQUEST['cofcnum']?>"></td>
<td bgcolor="#FFFFFF"><span class="heading"><b>RM Po No:</b></td>
<td bgcolor="#FFFFFF"><span class="heading"><input type="text" size=15% name="rm_po_num" value="<?echo $_REQUEST['rm_po_num']?>"></td>
<td bgcolor="#FFFFFF"><span class="heading"><b>Invoice No:</b></td>
<td bgcolor="#FFFFFF"><span class="heading"><input type="text" size=15% name="invoice_num" value="<?echo $_REQUEST['invoice_num']?>"></td>
</tr>
</table>


</td></tr>
<tr><td>
<table style="table-layout:fixed;width:1000px" border=0>
<div class="contenttitle radiusbottom0">
<h2><span>List Of NC Stores
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='new_nc4stores.php'" value="New NC" >	
<!-- <a href ="new_nc4stores.php"><img style="float:right" name="Image8" border="0" src="images/new_nc.gif"></a> -->
</h2>
</span>
</td>
</table>
<table style="table-layout: fixed;width:1000px"
 " border=0 bgcolor="#FFFFFF" cellspacing=1 cellpadding=3>
<tr>
<td>
<table style="table-layout:fixed;width:1000px" border=0 cellpadding=3 cellspacing=1 class="stdtable">
	<thead>
<tr>
<th class="head0"><span class="tabletext"><b>Id No.</b></td>
<th class="head1"><span class="tabletext"><b>Ref No.</b></td>
<th class="head0"><span class="tabletext"><b>Create Date.</b></td>
<th class="head1"><span class="tabletext"><b>Supplier.</b></td>
<th class="head0"><span class="tabletext"><b>RM Po No.</b></td>
<th class="head1"><span class="tabletext"><b>Receipt Date.</b></td>
<th class="head0"><span class="tabletext"><b>Invoice No.</b></td>
<th class="head1"><span class="tabletext"><b>BOL/BOE No.</b></td>
<th class="head0"><span class="tabletext"><b>C Of C No.</b></td>           
</tr>
</thead>
</table>
<div style="width:1016px;height:100px;overflow-y:scroll;">
<table style="table-layout:fixed;width:1000px" border=0 cellpadding=3 cellspacing=1 class="stdtable">
<?php
$result = $newnc4stores->get_nc4stores($cond);
while ($myrow = mysql_fetch_row($result))
{            
if($myrow[2] != '' && $myrow[2] != '0000-00-00')
{
$datearr = split('-', $myrow[2]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$create_date=date("M j, Y",$x);
}
else
{
$create_date = '';
}
if($myrow[5] != '' && $myrow[5] != '0000-00-00')
{
$datearr = split('-', $myrow[5]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$receipt_date=date("M j, Y",$x);
}
else
{
$receipt_date = '';
}


printf('<tr bgcolor="#FFFFFF"><td align="center"><span class="tabletext">
<a href="nc4stores_details.php?recnum=%s">%05d</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
',
$myrow[0],$myrow[0],
$myrow[1],
$create_date,
$myrow[3],
$myrow[4],
$receipt_date,
$myrow[6],
$myrow[7],
$myrow[8]);



printf('</td></tr>');

}

?>
</table>
</table>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
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

