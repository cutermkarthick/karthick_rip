<?php
//==============================================
// Author: FSI                                 =
// Date-written: July 25, 2013                 =
// Filename: capacity_chart.php                =
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
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/mc_capacityClass.php');
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'capacity_chart';
$page = "MES: Cap Chart";
//////session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newmc_capacity = new mc_capacity;
$dept=$_SESSION['department'];

$mc_series=$_REQUEST['mc_series']; 
$result=$newmc_capacity->get_all_mc();  
$r=mysql_fetch_array($result);

$mc_series=($_REQUEST['mc_series'] == '')?'select':$_REQUEST['mc_series'];
$start_date=$_REQUEST['frm'];
$end_date=$_REQUEST['to'];

if($_REQUEST['frm'] == '')
{
$end_date = date("Y-m-d");
$start_date = date("Y-m-d",strtotime('last month'));
}
?>

<html>
<head>
<style>
p.serif 
{
    font-family: "Times New Roman", Times, serif;color:blue;font-size:25px;
}
p.sansserif
{
    font-family: "Times New Roman", Times, serif;font-size:20px;color:red;
}
</style>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mc_capacity.js"></script>
<script src="//code.jquery.com/jquery-1.2.6.min.js"></script>
<!-- <script type="text/javascript" src="scripts/prototype.js"></script> -->

<link rel="stylesheet" href="style.css">
<script type="text/javascript">
 
OFC = {};
 
OFC.jquery = {
    name: "jQuery",
    version: function(src) { return $('#'+ src)[0].get_version() },
    rasterize: function (src, dst) { $('#'+ dst).replaceWith(OFC.jquery.image(src)) },
    image: function(src) { return "<img src='data:image/png;base64," + $('#'+src)[0].get_img_binary() + "' />"},
    popup: function(src) {
        var img_win = window.open('', 'Charts: Export as Image')
        with(img_win.document) {
            write('<html><head><title>Charts: Export as Image<\/title><\/head><body>' + OFC.jquery.image(src) + '<\/body><\/html>') }
		// stop the 'loading...' message
		img_win.document.close();
     }
}
 
// Using an object as namespaces is JS Best Practice. I like the Control.XXX style.
//if (!Control) {var Control = {}}
//if (typeof(Control == "undefined")) {var Control = {}}
if (typeof(Control == "undefined")) {var Control = {OFC: OFC.jquery}}
 
 
// By default, right-clicking on OFC and choosing "save image locally" calls this function.
// You are free to change the code in OFC and call my wrapper (Control.OFC.your_favorite_save_method)
// function save_image() { alert(1); Control.OFC.popup('my_chart') }
function save_image() { alert(1); OFC.jquery.popup('my_chart') }
function moo() { alert(99); };
</script>

<title>M/C Capacity Chart</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" >
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
<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr> -->
<td><span class="pageheading"><b>M/C Capacity Chart</b></td>
</tr>
<form action='capacity_chart.php' method='get' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Machine Capacity Chart</b></center></td>
</tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">

<tr bgcolor="#FFFFFF">
<td><span class="labeltext">M/C </p></font></td>
<td><span class="tabletext">
<?php        
$result=$newmc_capacity->get_all_mc();        
?>
<select name="mc_series" onchange="javascript:getmc_series(this)">
<option <?php echo (($mc_series=='select')?"selected":"")?> value="select">Please Select</option>
<option <?php echo (($mc_series=='all')?"selected":"")?> value="all">ALL</option>
<?php
while ($myrow = mysql_fetch_row($result))
{
if($myrow[0]==$_REQUEST['mc_series']){
?>
<option selected value="<? echo $myrow[0]?>">
<?echo $myrow[0]; ?> </option>
<?
}
else
{?>
<option value="<? echo $myrow[0]?>">
<?echo $myrow[0]; ?> </option>
<?php
}
}
?>
</select>
</td>

<td  bgcolor="#FFFFFF" width='40%'><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="frm" name="frm" size=10 value="<?php echo $start_date ?>"
          style="background-color:#DDDDDD;">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('frm')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="to" name="to" size=10 value="<?php echo $end_date ?>"
          style="background-color:#DDDDDD;">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('to')">  
		 </td>

<td><span class="labeltext"><input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: return fetch_cap_req()">
</td>

</tr>
</table>
<br/>
<?
if($mc_series!= 'select' && $start_date!='' && $end_date!='')
{
	if($mc_series=='all')
      $mc_series='%';	
   else
      $mc_series=trim("$mc_series");
   $color=array( '#ADFF2F', '#00FFFF', '#7D7B6A','#0066CC' ,'#D2691E','#006400','#556B2F','#FF00FF','#50284A','#C4D318');

	$width='270';
	$start_array=explode('-',$start_date);
	$start_year=$start_array[0];
	$start_month=$start_array[1];
	if($start_month < 10)
		$start_month=(int)$start_month;
	$end_array=explode('-',$end_date);
	$end_year=$end_array[0];
	$end_month=$end_array[1];
	
	if($end_month < 10)
		$end_month=(int)$end_month;
	
	     $cond4series=" plan_year between $start_year and $end_year ";
		 $mcseries=array();
		 $j=1;
		 $mc_id=array();
		 $result_series=$newmc_capacity->get_all_series($cond4series,$mc_series); 	
		 while($row_series=mysql_fetch_row($result_series))
	     {			
			$mc_id[]=preg_replace('/\s/', '',$row_series[0]);	
			 if($j <10)
			   $j='0'.$j;	
			 $width='470';
			 $prev_mc='';
			 $crnarr=array();
			 // $cond="plan_month = trim('$row_series[1]') and plan_year=trim('$row_series[2]') and mc_series  like '$row_series[0]'";	
			 $cond="plan_month = trim('$row_series[1]') and plan_year=trim('$row_series[2]') and mc_name  like '$row_series[3]'";	
            $res2=$newmc_capacity->get_capacity_plan4reqcrnhrs($cond);	
			while($myrow1=mysql_fetch_array($res2))
		    {
				 $count=0;				
			     $crn_qty[]=(int)$myrow1['req_crn_hrs'];					 
				 $m_machine=$myrow1[1];
				 $crnarr[]=$myrow1[23];
			} 
			$width=$width+10;	
			$cond1=$cond.' group by mc_name';
			$res3=$newmc_capacity->get_capacity_plan4chart($cond1);	
			while($mcr=mysql_fetch_array($res3))
			{
			   if($mcr[5] != $prev_mc || $prev_mc == '')
			   {
			     $count++;	
			   }
			   $prev_mc=$mcr[5];
			}		
		?>		
        <table style="border: 1px solid black"; bgcolor="#DFDFDF" width=50%  cellspacing=2 cellpadding=3 height='150'>
		<tr bgcolor='#FFFFFF'>
		<td >
		<div id="my_chart<?echo preg_replace('/\s/', '',$row_series[3]) ?>">
		</div>
		<script type="text/javascript" src="scripts/swfobject.js"></script>
		<script type="text/javascript">
		swfobject.embedSWF(
		"open-flash-chart1.swf", "my_chart<? echo preg_replace('/\s/', '',$row_series[3])?>",
		<?=$width?>, "400", "9.0.0", "expressInstall.swf",
		{"data-file":"chart-capacity.php?param= <? echo $row_series[3] ?> |<? echo $start_date ?>|<? echo $end_date ?>"} );
		</script>	
			<INPUT TYPE=BUTTON OnClick="OFC.jquery.rasterize('my_chart<?echo preg_replace('/\s/', '',$row_series[3]) ?>', 'my_chart<?echo preg_replace('/\s/', '',$row_series[3]) ?>');" VALUE="SAVE"> 
	</td>

<td style="margin-bottom:10px;padding:10px;vertical-align:top;">
<table class="stdtable" border=0 cellpadding=6 cellspacing=1 align='center'>
<tr>
<td colspan=2 ><span class="labeltext"><p align="center"><font color='#F24062'><?=$m_machine?></font></p></font></td>
</tr>

<tr>
<td><span class="tabletext"><p align="left">Total Available</p></font></td>
<td><span class="tabletext">
<div style="width: 15px; height: 4px; background: #FFFF00;">&nbsp;</div>
</td>
</tr>
<tr>
<td><span class="tabletext"><p align="left">Spare Hrs.</p></font></td>
<td><span class="tabletext">
<div style="width: 15px; height: 15px; background: #ff00ff;">&nbsp;</div>
</td>
</tr>
<tr>
<td><span class="tabletext"><p align="left">Utilization upto 85% </p></font></td>
<td><span class="tabletext"><div style="width: 15px; height: 15px; background: #ADFF2F;">&nbsp;</div></td>
</tr>
<?
for($i=0;$i<count($crnarr);$i++)
{
    $crn=$crnarr[$i];
	$crncolor=$color[$i];
	if($crn != '')
	{
	?>
	<tr>
	<td><span class="tabletext"><p align="left"><?php echo $crn ?></p></font></td>
	<td><span class="tabletext"><div style='width: 15px; height: 15px; 
	background: <?php echo  $crncolor ?> '>&nbsp;</div></td>
	</tr>
<?
	}
}?>

</table>
</table>

	</tr>
  <?	
		$j++;
	   }
	$mc_name = implode(",", $mc_id);
	echo "<input type='hidden' name='mc_name' id='mc_name' value='$mc_name'>";
}?>
</table>
<!-- </td>

<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table></table>
  
</body>
</html>