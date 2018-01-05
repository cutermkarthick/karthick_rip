<?php
//==============================================
// Author: FSI                                 =
// Date-written =  Mar 20, 2007                =
// Filename: qualityplanSummary.php            =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of CRN Time Master            =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'mc_master_summary';
$page = "CRM: Time Master";
//////session_register('pagename');

//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George
// how many rows to show per page
$rowsPerPage = 5;

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

$cond1 = "crn_num like '%'";

$oper1='like';

$cond=$cond1;

if ( isset ( $_REQUEST['final_refno'] ) )
{
$finalref_match = $_REQUEST['final_refno'];
if ( isset ( $_REQUEST['refno_oper'] ) ) {
$oper1 = $_REQUEST['refno_oper'];
}
else {
$oper1 = 'like';
}
if ($oper1 == 'like') {
$final_refno = "'" . $_REQUEST['final_refno'] . "%" . "'";
}
else {
$final_refno = "'" . $_REQUEST['final_refno'] . "'";
}

$cond1 = "crn_num " . $oper1 . " " . $final_refno;

}
else {
$finalref_match = '';
}

//echo $_REQUEST['final_refno'];
$cond = $cond1 ;
//echo $cond;


// First include the class definition
include('classes/mc_masterClass.php');
include_once('classes/displayClass.php');
$newdisplay = new display;
$newmc_master = new mc_master;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mc_master.js"></script>

<html>
<head>
<title>Time Master Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/logout_mo.gif',1)"><img name="Image15" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>
<?php $newdisplay->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=5>
<tr><td><span class="heading"><i>Please click on the PRN No. link to Edit</i></td></tr>
<tr><td>

<tr>
<td>

<form action='mc_master_summary.php' method='post' enctype='multipart/form-data'>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 align="center">
<button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button>
<input type="button" class="stdbtn btn_blue" onClick="location.href='new_timemaster.php'" value="New" >

<input type="hidden" name="refno_oper">
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN No</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="refno_oper" size="1" width="50">
<?php
if ( isset ( $_REQUEST['refno_oper'] ) ){
$check2 = $_REQUEST['refno_oper'];

if ($check2 =='like'){
?>
<option value>=
<option selected>like
<?php
}else{
?>
<option selected>=
<option value >like

<?php
}
}else{
?>
<option selected>like
<option value>=
<?PHP
}
?>
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_refno" size=15 value="<?php echo $finalref_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
</table>
</td></tr>


<!--<div style="overflow:auto; width=1200px; height:400px;">--><td colspan=2>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#DDDEDD">

<td colspan=30><span class="heading"><center><b>TIME MASTER</b></center></td>
</tr>
<tr bgcolor="99FFFF" height=10px>
<td colspan=30><span class="heading"></td></tr>


<?php
$iter=0;

$result = $newmc_master->getmc_masters($offset,$rowsPerPage,$cond);
while ($myrow = mysql_fetch_assoc($result)) {
//echo '=='.$myrow['crn_num'].'-----';
$result2 = $newmc_master->getstage_data4total_hrs($myrow['recnum']);
$myrow2 = mysql_fetch_assoc($result2);
if($myrow['from_date']!='' && $myrow['from_date']!='0000-00-00')
{
$datearr=split("-",$myrow['from_date']);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0] ;
$x=mktime(0,0,0,$m,$d,$y) ;
$fromdate=date('M j,Y',$x);
}
else
{
$fromdate='';
}

if($myrow['to_date']!='' && $myrow['to_date']!='0000-00-00')
{
$datearr=split("-",$myrow['to_date']);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0] ;
$x=mktime(0,0,0,$m,$d,$y) ;
$todate=date('M j,Y',$x);
}
else
{
$todate='';
}
?>
<table width=100% border=0 cellpadding=3 cellspacing=1>
<tr>
<td colspan=15>
<table width=100% style="border:1px solid" cellpadding=3 cellspacing=1 class="stdtable">
<tr bordercolor="black">
<td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>PRN</b></font></td>
<td style=";background-color:#DDDDDD;"><span class="tabletext"><a href="edit_mc_master.php?mc_masterrecnum=<?php echo $myrow['recnum'] ?>"><font color="0000ff"><b><?php echo $myrow['crn_num'] ?></b></font></a></td>
</tr></table>
</td>
<td colspan=15>&nbsp;</td>
<td colspan=3>

<table width=90% class="stdtable" style="border:1px solid" cellpadding=3 cellspacing=1 bordercolor="black">
<tr>
<td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>MPS Revision </b></font></td>
<td  style=";background-color:#DDDDDD;"><span class="tabletext"><font color="red"><b>
<?php            
printf("%s", $myrow['mps_revision']);             
?></b></font></td>
</table>
</td>

<td colspan=15>&nbsp;</td>
<td colspan=3>

<table width=90%  class="stdtable" style="border:1px solid" cellpadding=3 cellspacing=1 bordercolor="black">
<tr><td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>Total Run Time</b></font></td><td  style=";background-color:#DDDDDD;"><span class="tabletext"><font color="red"><b>
<?php
$total_mins = (($myrow2['tot_runtime'] * 60) + $myrow2['tot_runtime_mins']);
$total_hrs = ($total_mins / 60);
$total_mins1 = ($total_mins % 60);
printf("%d", $total_hrs);
printf("%s%02d",":", $total_mins1);
?></b></font></td>
</table>
</td>
<td colspan=6>&nbsp</td>
<td colspan=3>

<table width=90% class="stdtable" style="border:1px solid" cellpadding=3 cellspacing=1 bordercolor="black">
<tr><td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>Total Setting Time</b></font></td><td  style=";background-color:#DDDDDD;"><span class="tabletext"><font color="red"><b><?php
$total_mins = (($myrow2['tot_settime'] * 60) + $myrow2['tot_settime_mins']);
$total_hrs = ($total_mins / 60);
$total_mins1 = ($total_mins % 60);
printf("%d", $total_hrs);
printf("%s%02d",":", $total_mins1);
?></b></font></td>
</table>
</td>
<td colspan=6>&nbsp</td>
<td colspan=3>

<table width=90% style="border:1px solid"  class="stdtable" cellpadding=3 cellspacing=1 bordercolor="black">
<tr><td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>Bench  Time</b></font></td>
<td  style=";background-color:#DDDDDD;"><span class="tabletext"><font color="red"><b><?php
printf("%d", $myrow['fitting_time_hrs']);
printf("%s%02d",":",$myrow['fitting_time_mins']);
?></b></font></td>
</table>
</td>
<td colspan=6>&nbsp</td>
<td colspan=3>

<table width=90% class="stdtable" style="border:1px solid" cellpadding=3 cellspacing=1 bordercolor="black">
<tr><td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>Inspection Time</b></font></td>
<td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="red"><b><?php
printf("%d", $myrow['insp_time_hrs']);
printf("%s%02d",":",$myrow['insp_time_mins']);
?></b></font></td>
</table>
</td>
<td colspan=6>&nbsp</td>
<td colspan=3>
<table width=25% class="stdtable" style="border:1px solid" cellpadding=0 cellspacing=1 bordercolor="black">
<tr><td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>From Date</b></font>
<td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="red"><b><?php echo $fromdate?></td>
<td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>To Date</b></font>
<td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="red"><b><?php echo $todate?></td>
</table>

</td>
</tr>
</table>


<table width=80% style="border:1px solid" cellpadding=3 cellspacing=1 rows=all cols=all class="stdtable">

<tr>
<td width=1%><span class="tabletext"><i>Qty</i></td>
<td rowspan=3><span class="tabletext"><i>Stage<br>Details</i></td>
<td width=1%><p align="center"><span class="tabletext"><i>Stages</i></p></td>
<?php
$i=1;
while($i<=24)

{
?>
<td width=1%><span class="labeltext"><p align="left"><?php echo $i ?></p></font></td>
<?php
$i++;
}
$result1 = $newmc_master->getstage_data($myrow['recnum']);

while($myrow1 = mysql_fetch_assoc($result1))
{
//echo $myrow1['stage_num'];
$running_time1[$myrow1['stage_num']] = $myrow1['running_time'];
$setting_time1[$myrow1['stage_num']] = $myrow1['setting_time'];
$running_time_mins1[$myrow1['stage_num']] = $myrow1['running_time_mins'];
$setting_time_mins1[$myrow1['stage_num']] = $myrow1['setting_time_mins'];
$stage_cost1[$myrow1['stage_num']] = $myrow1['cost'];
//echo $myrow1['cost'] . ',';

}
//mysql_free_result($result1);

?>       </tr>
<tr>
<td width=1%><span class="tabletext"><i>1</i></td>
<td width=1%><span class="labeltext1"><p align="center"><i>Setting Time</i></p></font></td>
<?php
$x=1;
while($x<=24)
{

echo '<td width=1%><span class="tabletext">';
if (isset($setting_time1[$x]))
{
printf("%d", $setting_time1[$x]);
}
else 
{
printf("%d","0");

}

if (isset($setting_time_mins1[$x]))
{
printf("%s%02d",":", $setting_time_mins1[$x]);
}
else 
{
printf("%s%02d",":","0");

}
echo "</td>";

$x++;
}
unset($setting_time1);
unset($setting_time_mins1);

if ($iter == 0)
{
echo '</tr><tr bgcolor="#FFFFFF">';
}
else 
{
echo '</tr><tr bgcolor="#FFFFFF">';
}
?>

<td width=1%><span class="tabletext"><font color="339933"><i>Val/<br>pc</i></font></td>
<td width=1%><span class="labeltext1"><p align="center"><i>Running Time</i></p></font></td>
<?php
$x=1;
while($x<=24)
{

echo '<td width=1% bgcolor="#FFFFFF"><span class="tabletext">';
if (isset($running_time1[$x]))
{
printf("%d", $running_time1[$x]);
//echo "$running_time1[$x]". " h ";
}
else 
{
printf("%d","0");
}

if (isset($running_time_mins1[$x]))
{
printf("%s%02d",":", $running_time_mins1[$x]);
//echo "$running_time_mins1[$x]" . " m ";
}
else 
{
printf("%s%02d",":","0");
//echo "0 m";
}
echo "</td>";

$x++;
}
unset($running_time1);
unset($running_time_mins1);
if ($iter == 0)
{
echo '</tr><tr bgcolor="#FFFFFF">';
}
else 
{
echo '</tr><tr bgcolor="#FFFFFF">';
}
if ($dept == 'Sales') 
{
?>
<td width=1%><span class="tabletext"><i><?php echo $myrow['val_per_part']?></i></td>
<?php
print('<td width=1% style="border:0px">&nbsp;</td>');
print('<td width=1%><span class="labeltext1"><p align="center"><font color="339933"><i>Stage Cost</i></font></p></td>');

$x=1;
while($x<=24)
{
echo '<td width=1%><span class="tabletext"><font color="339933">';
if (isset($stage_cost1[$x]))
{

echo "$stage_cost1[$x]";
}
else
{
echo "0.00";
}

echo "</font></td>";

$x++;
}
echo('<tr bgcolor="#99FFFF" height=10px><td  border="0" colspan=27 ><span class="heading"></td></tr>');
unset($stage_cost1);

if ($iter == 0)
{
$iter=1;
}
else 
{
$iter=0;
}
}
}
?>


</table>
</td>
</tr>
<tr>
<td>
<?php

//Additions on Dec 29 04 by Jerry George to implement pagination
//$numrows=10;
$numrows = $newmc_master->getmc_mastercount($offset,$rowsPerPage,$cond);
$numrows = mysql_fetch_row($numrows);
//echo "     hi " . $numrows[0];
// how many pages we have when using paging?
$maxPage = ceil($numrows[0]/$rowsPerPage);
//echo "<br>$maxPage</br>";
if (!isset($_REQUEST['page']))
{
//echo "page is set";
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
$prev = " <a href=\"mc_master_summary.php?page=$page&totpages=$totpages&final_refno=$finalref_match\">[Prev]</a> ";

$first = " <a href=\"mc_master_summary.php?page=1&totpages=$totpages&final_refno=$finalref_match\">[First Page]</a> ";
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
$next = " <a href=\"mc_master_summary.php?page=$page&totpages=$totpages&final_refno=$finalref_match\">[Next]</a> ";

$last = " <a href=\"mc_master_summary.php?page=$totpages&totpages=$totpages&final_refno=$finalref_match\">[Last Page]</a> ";
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

</table>
</td>
</tr>
</table>
</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " hieght="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>

</div>
</FORM> 
</table>
</body>
</html>

<!--<fieldset>
<legend>
<span class="pageheading"><b>PRN Cycle Time</b>
</legend>

<table width=100% border=0 cellpadding=6 cellspacing=0>
<form action='processmc_master.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>PRN Cycle</b></center></td>
</tr>
<table width=80% border=0 cellpadding=3 cellspacing=1>
<tr>
<td colspan=15>
<table width=60% border=1 cellpadding=0 cellspacing=1><tr bordercolor="black">
<td width=45px style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>PRN</b></font</td>
<td width=50px style=";background-color:#FFFFFF;"><span class="tabletext"><input type="text" name="crn_num" style=";background-color:#DDDDDD;" readonly size=10 value="">
<img src='images/bu-get.gif' onClick="Getcrns()">
</tr></table>
</td> -->

<!--<td><img src='images/bu-get.gif' onClick="Getcrns()">-->
<!--	<input type="hidden" name="crnrecnum" size=5 value=""></td></td>
<td colspan=3>


<table width=50% border=1 cellpadding=0 cellspacing=1 bordercolor="black">
<tr><td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>Bench  Time</b></font></td>
<td width=65px style=";background-color:#FFFFFF;"><span class="tabletext"><input type="text" name="fitting_time_hrs" maxlength=2  style="width:50%;Border:none" size=3 value=""><b>:</b>
<input type="text" name="fitting_time_mins" maxlength=2 style="width:50%;Border:none" size=3 value="">

</table>
</td>
<td colspan=6>&nbsp</td>
<td colspan=3>

<table width=50% border=1 cellpadding=0 cellspacing=1 bordercolor="black">
<tr><td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>Inspection Time</b></font></td>
<td width=65px style=";background-color:#FFFFFF;"><span class="tabletext"><input type="text" name="insp_time_hrs" maxlength=2 style="width:50%;Border:none" size=3 value=""><b>:</b>
<input type="text" name="insp_time_mins" maxlength=2 style="width:50%;Border:none" size=3 value="">

</table>
</td>
</tr>
</table>


<table width=80% border=1 cellpadding=3 cellspacing=1 rows=all columns=all>

<tr>
<td width=1%><span class="tabletext"><i>Qty</i></td>
<td rowspan=3><span class="tabletext"><i>Stage Details</i></td>
<td width=1%><p align="center"><span class="tabletext"><i>Stages</i></p></td>
<?php
$i=1;
while($i<=24)
{
?>
<td width=1%><span class="labeltext"><p align="left"><?php echo $i ?></p></font></td>
<?php
$i++;
}

?>       </tr>
<tr>
<td width=1%><span class="tabletext"><input type="text" name="qty" value="1"style=";background-color:#DDDDDD;" readonly="readonly" size=4></td>
<td width=1%><span class="labeltext1"><p align="center"><i>Setting Time</i></p></font></td>
<?php
$x=1;
while($x<=24)
{

$setting_time = 'setting_time' . $x;
$setting_time_mins = 'setting_time_mins' . $x;
?>
<td width=30px><span class="tabletext"><input type="text" name="<?php echo $setting_time ?>" style="width:50%;Border:none" maxlength=2 size=3 value=""><b>:</b>
<input type="text" name="<?php echo $setting_time_mins ?>" style="width:50%;Border:none" maxlength=2 size=3 value=""></td>
<?php
$x++;
}
?>



</tr><tr bgcolor="#FFFFFF">

<td width=1%><span class="tabletext"><font color="339933"><i>Val/pc</i></font></td>
<td width=1%><span class="labeltext1"><p align="center"><i>Running Time</i></p></font></td>
<?php
$x=1;
while($x<=24)
{

$running_time = 'running_time' . $x;
$running_time_mins = 'running_time_mins' . $x;
?>
<td width=30px ><span class="tabletext"><input type="text" name="<?php echo $running_time ?>" style="width:50%;Border:none" maxlength=2 size=3 value=""><b>:</b>
<input type="text" name="<?php echo $running_time_mins ?>" style="width:50%;Border:none" maxlength=2 size=3 value=""></td>
<?php
$x++;
}
?>

</tr><tr bgcolor="#FFFFFF">

<td width=1%><span class="tabletext"><input type="text" name="valperpart" value="" size=5></td>
<?php
print('<td width=1% style="border:0px">&nbsp;</td>');
print('<td width=1%><span class="labeltext1"><p align="center"><font color="339933"><i>Stage Cost</i></font></p></td>');

$x=1;
while($x<=24)
{
$stage_cost = 'stage_cost' . $x;
?>
<td><span class="tabletext"><input type="text" name="<?php echo $stage_cost ?>" size=3 value="">
</td>
<?php
$x++;
}
?>

<tr bgcolor="#99FFFF" height=10px><td  border="0" colspan=27><span class="heading"></td></tr>


</table>
</td>
</tr>


</table> 
<span class="labeltext"><input type="submit"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
value="Submit" name="submit" onclick="javascript: return check_req_fields()">
<INPUT TYPE="RESET"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
VALUE="Reset" onclick="javascript: putfocus()">
</td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</fieldset>

</table>


</FORM> 


</table>

</td>
</tr>
</table>
</body>
</html>
