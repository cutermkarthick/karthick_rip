<?php
//==============================================
// Author: FSI                                 =
// Date-written: July 18, 2008                 =
// Filename: mc_capacity_master.php            =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Board details                               =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}

// Includes
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/mc_capacityClass.php');

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'mc_capacity';
$page = "MES: Cap Master";
//////session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisplay = new display;
$newmc_capacity = new mc_capacity;
$rowsPerPage =100;
$dept = $_SESSION['department'];
// by default we show first page
$pageNum = 1;
$status=$_REQUEST['status'];
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

if (isset($_REQUEST['crnnum'])) 
{
    $crn=$_REQUEST['crnnum'];      
}
else
{
	   $crn = '';
}
if (isset($_REQUEST['mc_name']) && $_REQUEST['mc_name']!='select') 
{
	$mc_name=$_REQUEST['mc_name'];
	$cond="where mc_name ='".$mc_name."'"; 
}
else 
{
	$mc_name='';
	$cond="where mc_name like '%'";
}
?>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mc_capacity.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>MC Capacity Master</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>
<?php
$newdisplay->dispLinks('');
?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=2>
<tr>
<td><span class="pageheading"><b>MC Capacity Master</b></td>
</tr>
<form action='mc_capacitySummary.php' method='get' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr bgcolor="#DDDEDD">
<td ><span class="heading"><center><b>MC Capacity Master</b></center></td>
</tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Machine Name</p></font></td>
<td><select id="mc_name"  name="mc_name">
<option value="select">Select</option>
<option <?php echo (($mc_name=='BMV 1')?"selected":"")?> value="BMV 1">BMV 1</option>
<option <?php echo (($mc_name=='VMC 2')?"selected":"")?> value="VMC 2">VMC 2</option>
<option <?php echo (($mc_name=='DMG 3')?"selected":"")?> value="DMG 3">DMG 3</option>
<option <?php echo (($mc_name=='DX 4')?"selected":"")?> value="DX 4">DX 4</option>
<option <?php echo (($mc_name=='HMC 5')?"selected":"")?> value="HMC 5">HMC 5</option>
<option <?php echo (($mc_name=='HAAS')?"selected":"")?> value="HAAS">HAAS</option>
<!-- <option <?php echo (($mc_name=='DMG 360L')?"selected":"")?> value="DMG 360L">DMG 360L</option>
<option <?php echo (($mc_name=='HMC 440')?"selected":"")?>  value="HMC 440">HMC 440</option>
<option <?php echo (($mc_name=='DX 200-1')?"selected":"")?> value="DX 200-1">DX 200-1</option>
<option <?php echo (($mc_name=='DX 200-2')?"selected":"")?> value="DX 200-2">DX 200-2</option>
<option <?php echo (($mc_name=='DX 200-3')?"selected":"")?> value="DX 200-3">DX 200-3</option>
<option <?php echo (($mc_name=='HAAS')?"selected":"")?> value="HAAS">HAAS</option>
<option <?php echo (($mc_name=='MakinoF3')?"selected":"")?> value="MakinoF3">MakinoF3</option>
<option <?php echo (($mc_name=='MakinoF5')?"selected":"")?> value="MakinoF5">MakinoF5</option>
<option <?php echo (($mc_name=='HAASVF2SS')?"selected":"")?> value="HAASVF2SS">HAASVF2SS</option>
<option <?php echo (($mc_name=='VR11')?"selected":"")?> value="VR11">VR11</option>
<option <?php echo (($mc_name=='ST20')?"selected":"")?> value="ST20">ST20</option>
<option <?php echo (($mc_name=='HAASVF2SS-2')?"selected":"")?> value="HAASVF2SS-2">HAASVF2SS-2</option>
<option <?php echo (($mc_name=='MakinoF5-2')?"selected":"")?> value="MakinoF5-2">MakinoF5-2</option>
<option <?php echo (($mc_name=='MakinoF5-3')?"selected":"")?> value="MakinoF5-3">MakinoF5-3</option>
<option <?php echo (($mc_name=='MakinoF5-4')?"selected":"")?> value="MakinoF5-4">MakinoF5-4</option>
<option <?php echo (($mc_name=='EMAG-1')?"selected":"")?> value="EMAG-1">EMAG-1</option>
<option <?php echo (($mc_name=='A51nx-1')?"selected":"")?> value="A51nx-1">A51nx-1</option>
<option <?php echo (($mc_name=='QT100S-1')?"selected":"")?> value="QT100S-1">QT100S-1</option>
<option <?php echo (($mc_name=='QT100S-2')?"selected":"")?> value="QT100S-2">QT100S-2</option> -->
</select>
</td>
<td>
<span class="labeltext">
<button class="stdbtn btn_blue" style="background-color:#2d3e50;padding:2px;margin-right:2px;">Search</button>
<button class="stdbtn btn_blue" style="background-color:#2d3e50;padding:2px;margin-right:2px;" onclick="javascript: putfocus()">Reset</button>
</td>
    
                
</tr>
</table>
<tr><td>
<table width=500px border=0>
<div class="contenttitle radiusbottom0">
<h2><span>List of Machine Series
<?
if($status=='new')
{
echo "<td><font color='green'>New MC:<font color='red'> ". $_REQUEST['mc_name1']."    </font>Inserted Succesfully.</font></td>";
}
else if($status =='delete')
{
$cond1='where recnum='.$_REQUEST['recnum'];
$newmc_capacity->delete_mc_capacity($cond1);
echo "<td><font color='green'>Machine:<font color='red'> ". $_REQUEST['mc_name1']."    </font>Deleted Succesfully.</font></td>";
}?>
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='mc_capacityNew.php'" value="New" >
</h2>
</span>
</tr>
</table>

</td></tr></table>
<table style="table-layout: fixed;width:100%"
 " border=0 bgcolor="#FFFFFF" cellspacing=1 cellpadding=3>
<table style="table-layout: fixed;width:100%" border=0 cellpadding=3 cellspacing=1 class="stdtable">
    <thead>
<tr>
<th class="head0" ><span class="tabletext"><b>MC #</b></td>
<th class="head1"><span class="tabletext"><b>MC Name</b></td>
<th class="head0"><span class="tabletext"><b>Date</b></td>
<th class="head1"><span class="tabletext"><b>Avail Capacity</b></td>
<th class="head0"><span class="tabletext"><b>MC Series</b></td>
<th class="head1"><span class="tabletext"><b>Units</b></td>
<th class="head0"><span class="tabletext"><b>Shift</b></td>
</thead>
</tr>
<!-- </table>

<div style="width:1333px;height:200px;overflow-y:scroll;">
<table  style="table-layout: fixed;width:1000px" border=0 cellpadding=3 cellspacing=1 class="stdtable"> -->
<!-- <table style="table-layout: fixed" width=550px border=0 cellpadding=3 cellspacing=1 class="stdtable" > -->
<?php	
    $result = $newmc_capacity->getmc_capacity_master($cond,$offset,$rowsPerPage);
    while ($myrow = mysql_fetch_row($result))
    {
		if($myrow[5] == '')
			$month='';
		else
			$month=date('M',mktime(0,0,0,$myrow[5]));?>  
	 <tr bgcolor="#FFCC00">
     <td bgcolor="#FFFFFF" align="center" ><span class="tabletext"><a href="mc_capacityDetails.php?recnum=<?echo $myrow[0]?>"><?php echo $myrow[1]?></td>
     <td bgcolor="#FFFFFF" align="center" ><span class="tabletext"><?php echo $myrow[2] ?></td>

     <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $month.', '.$myrow[6] ?></td>


     <td bgcolor="#FFFFFF" align="center" ><span class="tabletext"><?php echo $myrow[3] ?></td>
     <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow[4] ?></td>  
          <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow[7] ?></td>  
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow[8] ?></td>     
     </tr>
<?php
    }

?>

</table>
</table>
</div>
</td>
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

<?php
$numrows = $newmc_capacity->getmc_capacity_masterCount($cond,$offset,$rowsPerPage);
//echo $numrows;

   // how many pages we have when using paging?
   $maxPage = ceil($numrows/$rowsPerPage);
//echo "$maxPage</br>";
if (!isset($_REQUEST['page']))
{
//   echo "page is set";
    $totpages = $maxPage;
}

//echo "total pages :$totpages</br>";
$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one
if ($pageNum > 1)
{
    $page = $pageNum - 1;
    $prev = " <a href=\"mc_capacitySummary.php?page=$page&totpages=$totpages&mc_id=$mc_id&mc_name=$mc_name\">[Prev]</a> ";

    $first = " <a href=\"mc_capacitySummary.php?page=1&totpages=$totpages&mc_id=$mc_id&mc_name=$mc_name\">[First Page]</a> ";
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
    $next = " <a href=\"mc_capacitySummary.php?page=$page&totpages=$totpages&mc_id=$mc_id&mc_name=$mc_name\">[Next]</a> ";

    $last = " <a href=\"mc_capacitySummary.php?page=$totpages&totpages=$totpages&mc_id=$mc_id&mc_name=$mc_name\">[Last Page]</a> ";
}
else
{
    $next = ' [Next] ';      // we're on the last page, don't enable 'next' link
    $last = ' [Last Page] '; // nor 'last page' link
}
if($totpages!=0)
{
//$pageNum=0;
// print the page navigation link
echo "<span class=\"labeltext\">" . $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last;
}
else
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";
// End additions on Dec 29,04

?>
								</td>
							</tr>
						</table>
</FORM>
</table>
</body>
</html>