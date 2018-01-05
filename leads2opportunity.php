<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Oct 18, 2006                 =
// Filename: leads2opportunity.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Coded by Suresh Devadiga
// For displaying Opp related to specific leads
// Modifications History                       =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$cond = "c.name like '%'";
$leadsrecnum=$_REQUEST['leadsrecnum'];
$add='';
$_SESSION['pagename'] = 'leads2opportunity';
$page = "CRM: Leads";
//session_register('pagename');

// First include the class definition

include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/leadsClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$dept = $_SESSION['department'];
$newLead = new leads;
$newdisplay = new display;

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage =10;

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

// End additions on Dec 6,04
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/wo.js"></script>

<html>
<head>
<title>Opportunity</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action="leads_link_unlink.php?leadsrecnum=<?php echo "$leadsrecnum";?>" method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right"><a href="chPassword.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/chpwd_mo.gif',1)"><img name="Image15" border="0" src="images/chpwd.gif"></a>
<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>

</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>
<?php $newdisplay->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">

<table width=100% border=0 cellpadding=6 cellspacing=0  >

<tr><td>
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td><span class="pageheading"><b>List of Opportunities Linked With Leads : <?php echo "$leadsrecnum";?></b></td><td colspan=500>&nbsp;</td>
<td bgcolor="#FFFFFF" rowspan=2 align="right">
<input type="button" class="stdbtn btn_blue" style="float:right;height:25px;margin-top:-2px;" onclick="location.href='leads_link_unlink.php?submit=LinkOpportunity&leadsrecnum=<?php echo "$leadsrecnum";?>'" value="Link opportunity">
<input type="button" class="stdbtn btn_blue" style="float:right;height:25px;margin-top:-2px;" onclick="location.href='leads_link_unlink.php?submit=UnlinkOpportunity&leadsrecnum=<?php echo "$leadsrecnum";?>'" value="Unlink opportunity">
<!-- <a href ="leads_link_unlink.php?submit=LinkOpportunity&leadsrecnum=<?php echo "$leadsrecnum";?>"><img name="Image7" border="0" src="images/bu-linkOpp.gif"></a> -->
<!-- <a href ="leads_link_unlink.php?submit=UnlinkOpportunity&leadsrecnum=<?php echo "$leadsrecnum";?>"><img name="Image7" border="0" src="images/bu-unlinkOpp.gif"></a> -->
</td></tr>
</table>
</td></tr>
<tr><td>

<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" >
<thead>
<tr>
<th class="head0"><span class="heading"><b>Opportunity#</b></th>
<th class="head1"><span class="heading"><b><center>Opportunity Name</center></b></th>
<th class="head0"><span class="heading"><b><center>Account Name</center></b></th>
<th class="head1"><span class="heading"><b><center>Expected Close Date</center></b></th>
<th class="head0"><span class="heading"><b><center>Sales Stage</center></b></th>
<th class="head1"><span class="heading"><b>Type</b></th>
</tr>
</thead>
<?php
$result = $newLead->getOpp4Leads($leadsrecnum);
$flag = 0;
while ($myrow = mysql_fetch_row($result)) {
printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
$myrow[0]
);

?>                        <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[6] ?></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[7] ?></td>

</tr>

<?php
}
?>

</table>

</td></tr>

</table>
</td>
<!-- 		<td width="6"><img src="images/spacer.gif " width="6"></td>
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


<?php

$numrows = $newLead->getWocount4Po($leadsrecnum);
// how many pages we have when using paging?
//echo "row num  :$numrows";
$maxPage = ceil($numrows/$rowsPerPage);

//echo "max pages  :$maxPage";
if (!isset($_REQUEST['page']))
{
$totpages = $maxPage;
//echo "</br>page set total pages  :$totpages";

}
//echo "</br>total pages  :$totpages";
$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one
if ($pageNum > 1)
{
$page = $pageNum - 1;
$prev = "<a href=\"leads2opportunity.php?page=$page&leadsrecnum=$leadsrecnum&totpages=$totpages\">[Prev]</a> ";

$first = "<a href=\"leads2opportunity.php?page=1&leadsrecnum=$leadsrecnum&totpages=$totpages\">[First Page]</a> ";
}
else
{
$prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
$first = ' [First Page] '; // nor 'first page' link
}

// print 'next' link only if we're not
// on the last page
if ($pageNum < $totpages)
{
$page = $pageNum + 1;
$next = "<a href=\"leads2opportunity.php?page=$page&leadsrecnum=$leadsrecnum&totpages=$totpages\">[Next]</a> ";

$last = " <a href=\"leads2opportunity.php?page=$totpages&leadsrecnum=$leadsrecnum&totpages=$totpages\">[Last Page]</a> ";
}
else
{
$next = ' [Next] ';      // we're on the last page, don't enable 'next' link
$last = ' [Last Page] '; // nor 'last page' link
}

// print the page navigation link echo ;
echo "<span class=\"labeltext\">" . $first . $prev . "Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last;

// End additions

?>

</td>
</tr></table>
</form>
</body>
</html>