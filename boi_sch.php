<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 12, 2013                =
// Filename: boi_sch.php                       =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays Partwise Summary.                  =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header( "Location: login.php" );
}
$userid = $_SESSION['user'];
include_once('classes/reportClass.php');

$newreport = new report;
$rowsPerPage = 10;
$partnum=$_REQUEST['partnum'];
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
$offset = ($pageNum - 1) * $rowsPerPage;
$userrole = $_SESSION['userrole'];
//echo "BIOSCHEDUEL";
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<div id='boischedule' style="width:619px; overflow-y:scroll;height:300;">
<table align="top" style="table-layout: fixed" width="100%" style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">

<?
if($partnum!='')
{
    $lobresult = $newreport->getlob4boi($partnum);
    $prev_partnum='#';
	$prev_grn='';
	$prev_schdate='';
	$balance=0;
while($myrow=mysql_fetch_array($lobresult))
{ 
	$total4grn=0;
	$resultall = $newreport->getCRN4boi($partnum);
	$myrow4all=mysql_fetch_row($resultall);
	$total4grn=$myrow4all[3];

	printf('<tr bgcolor="#FFFFFF">');
    if($myrow[0] != $prev_partnum)
	{
			echo '<td align="center" width="15%" ><span class="tabletext">'.$myrow[0].'</td>';
    }
	else
	{
            echo '<td align="center" width="15%" >&nbsp;</td>';
	}
    if($total4grn != $prev_grn)
	{
	   echo '<td align="center" width="18%" ><span class="tabletext">'.$total4grn.'</td>';
	}
	else
	{
		 echo '<td align="center" width="18%" >&nbsp;</td>';
	}
    $date1=date("M j, Y",strtotime($myrow[3]));
	if($myrow[3]!=$prev_schdate)
	{
	      echo '<td align="center" width="15%" ><span class="tabletext">'.$date1.'</td>';
	}
	else
	{	
		  echo '<td align="center" width="15%" >&nbsp;</td>';
	}
	echo '<td align="center" width="15%" ><span class="tabletext">'.$myrow[1].'</td>';
	
    echo '<td align="center" width="15%" ><span class="tabletext">'.$myrow[2].'</td>';
    if($prev_partnum!= $myrow[0])
	{
      $balance=$total4grn-$myrow[2];
	}
	else
	{	
		$balance=$balance-$myrow[2];
	}
	if($balance <0)
	$colour='#FF0000';
    else
	$colour='#FFFFFF';	
		
	echo "<td align=\"right\" width=\"15%\" bgcolor='$colour'><span class=\"tabletext\">$balance</td>";	
	$prev_partnum=$myrow[0];
	$prev_grn=$total4grn;
	$prev_schdate=$myrow[3];
}
}
?>
</tr>
</table>
</tr>
</table>
</tr>
</table>
</body>
</html>