<?php
//==============================================
// Author: FSI                                 =
// Date-written: Nov 20, 2016                 =
// Filename: capacity_req.php                  =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v2.0 WMS                        =
// Capacity Plan                             =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
header("Location: login.php");
}
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/mc_capacityClass.php');
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'capacity_req';


$page = "MES: Cap Plan";
//session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newmc_capacity = new mc_capacity;
$dept=$_SESSION['department'];
// $mc_series=$_REQUEST['mc_series']; 

if(isset($_REQUEST['Submit'])){
$subvalue = $_REQUEST['Submit'];
}else{
$subvalue = "";
}

if(isset($_REQUEST['mc_series'])){
$mc_series = $_REQUEST['mc_series'];
}else{
$mc_series = "";
}


if(isset($_REQUEST['pl_month'])){
$frm = $_REQUEST['pl_month'];
}else{
$frm = "";
}

if(isset($_REQUEST['pl_year'])){
$to = $_REQUEST['pl_year'];
}else{
$to = "";
}

if(isset($_REQUEST['crnnum'])){
$crnnum = $_REQUEST['crnnum'];
}else{
$crnnum = "";
}


$st_date1 = $to."-".$frm."-"."01";
$ed_date = date("Y-m-t", strtotime($st_date1));



if(isset($_REQUEST['mc_series'])){
$mc = $_REQUEST['mc_series'];
}else{
$mc = "all";
}

list($year,$month, $day ) = explode("-",$st_date1);

?>
<html>
<head>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mc_capacity.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>
<script language="javascript" src="js/chartjs.min.js"></script>

<link rel="stylesheet" href="style.css">

<title>M/C Capacity Plan</title>


<?php
include('header.html');
?>
<form action='capacity_req.php' method='POST' enctype='multipart/form-data'>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Machine Capacity Plan</b></center></span></td>
<?
// $status=$_REQUEST['status'];
if(isset($_REQUEST['status'])){
$status = $_REQUEST['status'];
}else{
$status = "";
}
?>
</tr>
</td>
<table width=100% border=0 cellpadding=3 cellspacing=1 style="border: 1px solid grey;">
<tr>
<td  width="30%" bgcolor="#8daf43" style="vertical-align: top;padding: 5px;font-weight:bold;text-align:center;width:30%"><span style='font-size:18px;color:#343f60'>Production Scheduling Template V 1.0<br/>
<span style='color:white;font-size:11px;text-align:center'>Flexible on Shift Capacity and Powerful Visual Scheduling
</span><br/>
<span style='font-size:12px'>
www.fluentsoft.com

<td width="30%">
<table width=100% border=0 cellpadding=3 cellspacing=1 style="border: 1px solid grey;">
<tr>
<td width="10%"><span class="labeltext"><p align="left">M/C Series</p></span>

<span class="tabletext">
<?php        
$result=$newmc_capacity->get_all_mc();        
?>
<select name="mc_series" onchange="javascript:getmc_series(this)">
<option value="select">Select</option>
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
</select></span>&nbsp&nbsp&nbsp&nbsp

	</td>
	<td>
<span class="labeltext"><p align="left">PRN#</p></span>
<span class="tabletext"><input type="text" name="crnnum" id='crnnum' size=10 value="<?php echo $crnnum; ?>"></span></td>

<td  bgcolor="#FFFFFF"><span class="labeltext"><b>Month: &nbsp&nbsp</b></span>
<br /><select name="pl_month" id="pl_month"> 
<option value="select" disabled="disabled" >Select</option>
<option <?php echo (($frm=='01')?"selected":"")?> value="01">Jan</option>
<option <?php echo (($frm=='02')?"selected":"")?> value="02">Feb</option>
<option <?php echo (($frm=='03')?"selected":"")?> value="03">Mar</option>
<option <?php echo (($frm=='04')?"selected":"")?> value="04">Apr</option>
<option <?php echo (($frm=='05')?"selected":"")?> value="05">May</option>
<option <?php echo (($frm=='06')?"selected":"")?> value="06">June</option>
<option <?php echo (($frm=='07')?"selected":"")?> value="07">July</option>
<option <?php echo (($frm=='08')?"selected":"")?>  value="08">Aug</option>
<option <?php echo (($frm=='09')?"selected":"")?> value="09">Sep</option>
<option <?php echo (($frm=='10')?"selected":"")?> value="10">Oct</option>
<option <?php echo (($frm=='11')?"selected":"")?> value="11">Nov</option>
<option <?php echo (($frm=='12')?"selected":"")?> value="12">Dec</option>
</select></td>
<td><span class="heading"><b>Year: </b></span> <br />
<select name="pl_year" id="pl_year" >
<option value="select" disabled="disabled" >Select</option>
<option <?php echo (($to=='2005')?"selected":"")?> value="2005">2005</option>
<option <?php echo (($to=='2006')?"selected":"")?> value="2006">2006</option>
<option <?php echo (($to=='2007')?"selected":"")?> value="2007">2007</option>
<option <?php echo (($to=='2008')?"selected":"")?> value="2008">2008</option>
<option <?php echo (($to=='2009')?"selected":"")?> value="2009">2009</option>
<option <?php echo (($to=='2010')?"selected":"")?> value="2010">2010</option>
<option <?php echo (($to=='2011')?"selected":"")?> value="2011">2011</option>
<option <?php echo (($to=='2012')?"selected":"")?> value="2012">2012</option>
<option <?php echo (($to=='2013')?"selected":"")?> value="2013">2013</option>
<option <?php echo (($to=='2014')?"selected":"")?> value="2014">2014</option>
<option <?php echo (($to=='2015')?"selected":"")?> value="2015">2015</option>
<option <?php echo (($to=='2016')?"selected":"")?> value="2016">2016</option>
<option <?php echo (($to=='2017')?"selected":"")?> value="2017">2017</option>
<option <?php echo (($to=='2018')?"selected":"")?> value="2014">2018</option>
<option <?php echo (($to=='2019')?"selected":"")?> value="2015">2019</option>
<option <?php echo (($to=='2020')?"selected":"")?> value="2016">2020</option>
<option <?php echo (($to=='2021')?"selected":"")?> value="2017">2021</option>

</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="labeltext">
<input type="submit" name="Submit"  value="Get" onclick="javascript: return fetch_cap_req()">
<input type="submit" name="Submit"  value="Get_Schedule" onclick="javascript: return fetch_cap_req()"></span>
</td>
</tr>

</td>
</tr>
</table>





</table>
</table>

<table border=0 bgcolor="#FFFFFF" width=100%  cellspacing=1 cellpadding=3  class="stdtable1">

<?


if ($mc == "all") 
{
$mc = "";

}


if(isset($_REQUEST['Submit']) == 'Get')
{
$numrows = $newmc_capacity->getlob_crnmc_cnt($crnnum,$mc,$month,$year);
}
else if(isset($_REQUEST['Submit']) == 'Get_Schedule')
{
$numrows = $newmc_capacity->get_capacity_plan_cnt($crnnum,$mc,$month,$year);    

}
else
{
$numrows = 0;
}


if (!isset($_REQUEST['mc_series']) || ($numrows == 0) && $subvalue != "SAVE") 
{ ?>


<tr>
<td>
<table width=80% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFCC00">
<td bgcolor="#FFA500" width='10px' rowspan="2"><span class="tabletext"><b>Avail. <br/>Cap <?php echo $strokes_hrs; ?></b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan="2" ><span class="tabletext"><b>PRN</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan="2" ><span class="tabletext"><b>Oper</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan="2" ><span class="tabletext"><b><br/>Sch<br/>Date</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan="2"> <span class="tabletext"><b>Sch <br>Qty</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan="2"><span class="tabletext"><b>Fg<br/>Qty</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan="2"><span class="tabletext"><b>Rej<br/>Qty</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan="2"><span class="tabletext"><b>Rem<br/>Qty</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan="2"><span class="tabletext"><b>GRN<br/>Qty</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan="2"><span class="tabletext"><b>RT/Ut<br/>Hrs</b></span></td>
<td bgcolor="#FFA500 " width='10px' rowspan="2"><span class="tabletext"><b>FF<br/>Qty</b></span></td>
<td bgcolor="#FFA500 " width='10px' rowspan="2"><span class="tabletext"><b>UF<br/>Qty</b></span></td>
<td bgcolor="#FFA500 " width='10px' rowspan="2"><span class="tabletext"><b>Req <br/> <?php echo $strokes_hrs; ?></b></span></td>
<td bgcolor="#FFA500 " width='10px' rowspan="2"><span class="tabletext"><b>FF<br/>Hrs</b></span></td>
<td bgcolor="#FFA500 " width='10px' rowspan="2"><span class="tabletext"><b>UF<br/>Hrs</b></span></td>
<td bgcolor="#FFA500 " width='10px' rowspan="2"><span class="tabletext"><b>C/F<br/><?php echo $strokes_hrs; ?> </b></span></td>

<td bgcolor="#FFFF00" width='35px'><span class="tabletext"><b>Mfg Start Date/Time&nbsp;&nbsp;&nbsp;&nbsp;</b></span></td>
<?php echo $parts_blank;?>
</tr>
<tr>
	<td bgcolor="#FFFF00" width='25px'><span class="tabletext"><b>Mfg End Date/time</b></span></td>

</tr>
</table>
</td>
</tr>
</tr>
<?php 
}
else
{

if($_REQUEST['Submit'] == 'Get' || $subvalue == "SAVE")
{

echo "<tr>";
echo "<td>";

$z=1; 
$p=1;
$i=1;

$prev_mc='';
$prev_avail_mc_hrs='';
$prev_mc_series='';
$balance_crn_qty=0;
$balance_mc_hrs=0;
$prev_crn  = "";
$prevschdate  = "";
$prevname4mc  = "";

$crnarr = array();  // Store the qty requirement, mc capacity and crn_mc data in 3 arrays.
$crnmcsch = array(); // just to store crnwise qty - if qty is > 0 , then line will be in red since unfulfilled balance
$mccapmaster = array();  // stores each machine capacity ie, avail hours
$crnmc  = array(); // Stores runtime hours for each crn mcwise



$lobresult = $newmc_capacity->getlob($crnnum, $st_date1, $ed_date);
while($mylobrow=mysql_fetch_row($lobresult))
{
	$crn = $mylobrow[0];
	$schdate = $mylobrow[1];             
	$schqty = $mylobrow[2];
	$crnarr[$crn][$schdate]= $schqty;
}
// echo "<pre>";
// print_r($crnarr);



$mccapresult = $newmc_capacity->getmc_capacitys4req($mc,$month,$year);
while($mymccaprow=mysql_fetch_row($mccapresult))
{
	$mcname = $mymccaprow[2];
	$availhrs = $mymccaprow[3];            
	$shift = $mymccaprow[7];            
	$units = $mymccaprow[8];            
	// $mccapmaster[$mcname] = $availhrs;
	$mccapmaster[$mcname] = array($availhrs,$shift,$units);
}

// echo "<pre>";
// print_r($mccapmaster);

$cond = "where crn like '$crnnum%' and mc_name like '$mc%'";
$crnmcresult = $newmc_capacity->getcrn_mc_summary($cond);
while($mycrnmcrow=mysql_fetch_row($crnmcresult))
{
	$mcname = $mycrnmcrow[2];
	$crn = $mycrnmcrow[4]; 
	$mcseries = $mycrnmcrow[3];             
	$crnmc[$crn][$mcname]= $mycrnmcrow[5];

}
// echo "reached" .$mc_series;

$fgqty = 0;
$grn_bal_qty = 0;
$fg_arr = array();
$chart = 1;

/* -------------- get fg qty from crn_fg table and create fg array -------------------------- */

$result4fg = $newmc_capacity->getfg_qty();
while ($myresult4fg = mysql_fetch_row($result4fg)) 
{
	$fg_arr[$myresult4fg[1]] = $myresult4fg[2];
	// $rej_arr[$myresult4fg[0]] = $myresult4fg[1];

}

// echo "<pre>";
// print_r($fg_arr);


$crn_usage_hrs = array();

$crnmcschresult = $newmc_capacity->getlob_crnmc($crnnum,$mc,$month,$year);
$total_ffhrs = 0;
while($mycrnmcschrow=mysql_fetch_row($crnmcschresult))
{


$fg_qty1 = $newmc_capacity->getfg_qty($mycrnmcschrow[0]);
$grn_bal_qty = $newmc_capacity->getgrnbal_qty($mycrnmcschrow[0]);



$crn = $mycrnmcschrow[0];
if ($mycrnmcschrow[8] =="" || $mycrnmcschrow[8]== null) 
{
	$mycrnmcschrow[8] = 1;    
}

$runtime_hrs = $mycrnmcschrow[1];
$blank_hrs = ($mycrnmcschrow[1] / $mycrnmcschrow[8]);
$operation = $mycrnmcschrow[2];
$mc_name = $mycrnmcschrow[3];
$schdate = $mycrnmcschrow[4];            
$schqty = $mycrnmcschrow[5];
$schhrs = $mycrnmcschrow[6];
$blank = $mycrnmcschrow[8];
$mc_id = $mycrnmcschrow[3];
// $mc_sr = $mycrnmcschrow[9];
$prity = $mycrnmcschrow[2];

//FG total

// $result4fg = $newmc_capacity->getfg_qty($crn);
// while ($myresult4fg = mysql_fetch_row($result4fg)) 
// {
	// $fg_arr[$myresult4fg[0]] = $myresult4fg[2];
	// $rej_arr[$myresult4fg[0]] = $myresult4fg[1];

	// $fg_qty1 = $myresult4fg[1];
	// $rej_qty1 = $myresult4fg[2];

// }

	// $fg_qty1 = 0;
	$rej_qty1 = 0;

$fg_qty1 = $fg_arr[$crn];
// $rej_qty1 = $rej_arr[$crn];



$totalfgqty = $schqty - $fg_qty1 + $rej_qty1;

// $totalfgqty = 0;

$fg_arr[$crn] = $fg_qty1 - $fg_arr[$crn];


$crnmcsch[$crn][$mc]= $schhrs;
if (isset($mccapmaster[$mc_name][0])) {
$mc_avail_hrs = $mccapmaster[$mc_name][0];    
}

if (isset($mccapmaster[$mc_name][0])) {
$avail_capacity1 = $mccapmaster[$mc_name][0];   
$mcavail_capacity = $mccapmaster[$mc_name][0]; 
	
	// echo "mcavail_capacity $mcavail_capacity <br>";

}


if (isset($mccapmaster[$mc_name][1])) {
$avail_shift = $mccapmaster[$mc_name][1]; 
}

if (isset($mccapmaster[$mc_name][2])) {
$avail_units = $mccapmaster[$mc_name][2]; 

}

if ($avail_units == "strokes") {
$strokes_hrs = "Strs.";
$parts_blank = '<td bgcolor="#33cc99"  rowspan="2" width="10px"><span class="tabletext"><b>Parts/<br/>Blanks</b></span></td>';
}else{
$strokes_hrs = "Hrs.";
$parts_blank = '';
}

if($prev_mc == $mc_name)
{
  	$mc_avail_hrs=$prev_avail_mc_hrs;
	$avail_capacity=$prev_avail_mc_hrs;     
}
else
{

	$mc_avail_hrs=$avail_capacity1;
	$avail_capacity=$avail_capacity1;
}

$crn_qty = $crnarr[$crn][$schdate];


$crn_qty=($crn_qty == '')?'0':$crn_qty;


$req_qty = $crnarr[$crn][$schdate];

$bal_sch_qty = $crn_qty - $fg_qty1 + $rej_qty1;

if ($bal_sch_qty < $grn_bal_qty ) 
{
	$bal_crn_qty = $bal_sch_qty;
}
else
{
	// $bal_crn_qty = $bal_sch_qty - $grn_bal_qty;
	$bal_crn_qty = $bal_sch_qty;
}

// echo "bal crn qty " . $bal_crn_qty . "<br>";

// $req_crn_hrs=round($blank_hrs*$bal_sch_qty);
$req_crn_hrs=round($blank_hrs*$bal_crn_qty);

// echo "req crn hrs " . $req_crn_hrs . "<br>";

$runtime_hrs = ($runtime_hrs == '')?'0':$runtime_hrs;



if($runtime_hrs>0)
{
	$possible_qty=round($avail_capacity/$blank_hrs);
	
}
else
{
	$possible_qty=0;
	
}

if($avail_capacity >= $runtime_hrs)
{

	// if($possible_qty > $crn_qty)
	if($possible_qty > $bal_crn_qty)
	{
		$balance_crn_qty=0;

		if($bal_crn_qty !='' && $bal_crn_qty!='0')
		{
			$balance_mc_hrs=round($avail_capacity-($bal_crn_qty*$blank_hrs));
			$balance_crn_hrs=0; 

			$crn_usage_hrs[$mc_name][] = array('crn'=> $crn, 'used_hrs' => round($bal_crn_qty*$blank_hrs),'mc_hrs'=> $avail_capacity);
		}
		else
		{
			$balance_mc_hrs=$avail_capacity;
			$balance_crn_hrs=0; 
		}


		$ff_qty = $bal_sch_qty;
		$ff_hrs = ($ff_qty*$blank_hrs);
		$ff_hrs = number_format((float)round($ff_hrs), 2, '.', '');

		$uf_hrs = round(($balance_crn_qty*$blank_hrs));
	}

	elseif($possible_qty <= $bal_crn_qty)
	{       

		$balance_crn_qty=$bal_crn_qty-$possible_qty;  


		if($bal_crn_qty !='' && $bal_crn_qty !='0')
		{
			$balance_mc_hrs=round($avail_capacity-($possible_qty*$blank_hrs));

			$crn_usage_hrs[$mc_name][] = array('crn'=> $crn, 'used_hrs' => round($possible_qty*$blank_hrs),'mc_hrs'=> $avail_capacity);

		}
		else
		{

			$balance_mc_hrs=$avail_capacity;
			$balance_crn_hrs=round($req_crn_hrs-($possible_qty*$blank_hrs));  
		}

		$ff_qty = $possible_qty;
		$ff_hrs = ($ff_qty*$blank_hrs);
		$ff_hrs = number_format((float)round($ff_hrs), 2, '.', '');
		$uf_hrs = ($balance_crn_qty*$blank_hrs);
		$uf_hrs = number_format((float)round($uf_hrs), 2, '.', '');
	}

}
elseif($avail_capacity < $runtime_hrs)
{


	$balance_crn_hrs=$req_crn_hrs;
	$balance_crn_qty=$bal_crn_qty;
	$balance_mc_hrs=$avail_capacity;  
	$crn_usage_hrs[$mc_name][] = array('crn'=> $crn, 'used_hrs' => 0,'mc_hrs'=> $avail_capacity);    
	$ff_qty = 0;
	$ff_hrs = ($ff_qty*$blank_hrs);
	$ff_hrs = number_format((float)round($ff_hrs), 2, '.', '');
	$uf_hrs = ($balance_crn_qty*$blank_hrs);
	$uf_hrs = number_format((float)round($uf_hrs), 2, '.', '');

}

elseif($runtime_hrs == '')
{

	$balance_mc_hrs=$avail_capacity; 
	$crn_usage_hrs[$mc_name][] = array('crn'=> $crn, 'used_hrs' => 0,'mc_hrs'=> $avail_capacity); 
	$ff_qty = 0; 
	$ff_hrs = number_format((float)round(($ff_qty*$blank_hrs)));
}





if($_REQUEST['Submit'] == 'SAVE')
{       

$month=$month;
$year=$year;

$mc_series1="mc_sr_".$i;

if (isset($_REQUEST[$mc_series1])) {
$mc_series=$_REQUEST[$mc_series1];
}
$mc_id1="mc_id_".$i;
$mc_id=$_REQUEST[$mc_id1];

$mc_name1="mc_name".$i;
$mc_name=$_REQUEST[$mc_name1];

// $mc_cap_hrs=$avail_capacity;
$mc_cap_hrs=$mcavail_capacity;
$mc_avail_hrs1="mc_avail_hrs".$i;
$mc_avail_hrs=$_REQUEST[$mc_avail_hrs1];        
$crn1=$crn;
$req_crn_qty='req_crn_qty'.$i;
$crn_qty=$_REQUEST[$req_crn_qty];


$req_rt_perunit='req_rt_perunit'.$i;
$runtime_units=$_REQUEST[$req_rt_perunit];
$req_crn_hrs1='req_crn_hrs'.$i;
$req_crn_hrs=$_REQUEST[$req_crn_hrs1];
$balance_crn_hrs1='balance_crn_hrs'.$i;
$balance_crn_hrs=$_REQUEST[$balance_crn_hrs1];
$balance_crn_qty1='balance_crn_qty'.$i;
$balance_crn_qty=$_REQUEST[$balance_crn_qty1];
$balance_mc_hrs_1='balance_mc_hrs'.$i;
$balance_mc_hrs=$_REQUEST[$balance_mc_hrs_1];
$priority1='priority'.$i;
$priority=$_REQUEST[$priority1];
$operation_1='operation_'.$i;
$operation=$_REQUEST[$operation_1];
$start_date1='start_date'.$i;
$start_date2=$_REQUEST[$start_date1];     
$end_date1='end_date'.$i;
$end_date2=$_REQUEST[$end_date1];    
$time1='time'.$i;
$time2=$_REQUEST[$time1];    
$ed_time1='ed_time'.$i;
$ed_time2=$_REQUEST[$ed_time1];    

$avail_units1="units".$i;
$avail_units=$_REQUEST[$avail_units1];
$avail_shift1="shift".$i;
$avail_shift=$_REQUEST[$avail_shift1];

$schqty1="schqty_".$i;
$sch_schqty=$_REQUEST[$schqty1];
$schedule_date='schedule_date_'.$i;
$schedule_date1=$_REQUEST[$schedule_date];
$fg_qty='fg_qty_'.$i;
$fgqty=$_REQUEST[$fg_qty];
$rej_qty='rej_qty_'.$i;
$rejqty=$_REQUEST[$rej_qty];
$totalfgqty1='totalfgqty_'.$i;
$totalfgqty=$_REQUEST[$totalfgqty1];
$grnqty1='grnqty_'.$i;
$grn_qty=$_REQUEST[$grnqty1];

$ff_qty1='ff_qty'.$i;
$ff_qty=$_REQUEST[$ff_qty1];
$ff_qty_hrs1='ff_qty_hrs'.$i;
$ff_qty_hrs=$_REQUEST[$ff_qty_hrs1];
$mcount='mcount'.$i;



if (isset($time)) {
$start_meridiem=substr($time,-2);    
}
else
{
$start_meridiem="";
}
$end_meridiem=substr($ed_time2,-2);

$blank1='blank'.$i;
$blank=$_REQUEST[$blank1];

$newmc_capacity->setmc_series($mcseries);
$newmc_capacity->setplan_month($month);
$newmc_capacity->setplan_year($year);
$newmc_capacity->setmc_id($mc_id);
$newmc_capacity->setmc_name($mc_name);
$newmc_capacity->setmc_cap_hrs($mc_cap_hrs);
$newmc_capacity->setmc_avail_hrs($mc_avail_hrs);
$newmc_capacity->setcrnnum($crn1);
$newmc_capacity->setcrn_qty($crn_qty);
$newmc_capacity->setruntime_units($runtime_units);
$newmc_capacity->setreq_crn_hrs($req_crn_hrs);
$newmc_capacity->setbalance_crn_hrs($balance_crn_hrs);
$newmc_capacity->setbalance_crn_qty($balance_crn_qty);
$newmc_capacity->setbalance_mc_hrs($balance_mc_hrs);
$newmc_capacity->setoperation($operation);
$newmc_capacity->setdept($dept);        
$newmc_capacity->setoperation($operation);  
$newmc_capacity->setpriority($priority);    
$newmc_capacity->setstart_date($start_date2);         
$newmc_capacity->setstart_time($time2);
$newmc_capacity->setend_date($end_date2); 
$newmc_capacity->setend_time($ed_time2);
$newmc_capacity->setstart_time_meridiem($start_meridiem);
$newmc_capacity->setend_time_meridiem($end_meridiem);
$newmc_capacity->setpartsperblank($blank);
$newmc_capacity->setunits($avail_units);
$newmc_capacity->setshift($avail_shift);

$newmc_capacity->setsch_schqty($sch_schqty);
$newmc_capacity->setschedule_date($schedule_date1);
$newmc_capacity->setfgqty($fgqty);
$newmc_capacity->setrejqty($rejqty);
$newmc_capacity->settotalfgqty($totalfgqty);
$newmc_capacity->setgrn_qty($grn_qty);

$newmc_capacity->setff_qty($ff_qty);
$newmc_capacity->setff_qty_hrs($ff_qty_hrs);

if ($crnarr[$crn][$schdate] > 0) 
{
	$insert_res=$newmc_capacity->addcapacity_plan();            
}


}

if(($prev_crn == $crn) && ($crn!=' ') && ($prev_month==$month)  && ($prev_operation== $operation) )
{       

$crn_qty1=$prev_balance_qty;           
}
else
{   
$crn_qty1=$crn_qty;         
}



if ($crnarr[$crn][$schdate] > 0) 
{



if ($prev_mc != $mc_name ) 
{  

	// $first_mcname = $mc_name; 
	// echo "mc name $mc_name <br>";
	
	
	if($prev_mc !='')
	{

			
    echo "<tr><td colspan=7 bgcolor=\"#FFFFFF\"><b>Avail Mc Hrs ". $mccapmaster[$first_mcname][0] . "</b></td>
		  <td colspan=7 bgcolor=\"#FFFFFF\"><b>Total FF Hrs ". $total_ffhrs . "</b></td>
		  <td colspan=7 bgcolor=\"#FFFFFF\"><b>Remaining Mc Hrs ". ($mccapmaster[$first_mcname][0] - $total_ffhrs ). "</b></td>
		</tr>";

		$total_ffhrs = 0;
	}
	else
	{
		$first_mcname = $mc_name;
	}
	echo "<table  class=\"stdtable1\"><tr><td align=\"center\" colspan=16 bgcolor=\"#99CCFF\" style=\"padding:5px;\"><center><span class=\"heading\"><b>M/C Name: ". $mc_name . ",  Avail Capacity: ".$avail_capacity."</b></span></center></td></tr></table>";

?>
<table border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" style="margin: -269px 39 40 0;vertical-align: center;width:30%;">
<tr bgcolor="#FFCC00">
<td bgcolor="#FFA500"  width='10px'  rowspan='2'><span class="tabletext"><b>Avail. <br/>Cap <br/><?php echo $strokes_hrs; ?></b></span></td>
<td bgcolor="#00DDFF"  width='10px'  rowspan='2'><span class="tabletext"><b>PRN</b></span></td>
<td bgcolor="#00DDFF"  width='10px'  rowspan='2'><span class="tabletext"><b>Oper</b></span></td>
<td bgcolor="#00DDFF"  width='10px'  rowspan='2'><span class="tabletext"><b><br/>Sch<br/>Date</b></span></td>
<td bgcolor="#00DDFF"  width='10px'  rowspan='2'><span class="tabletext"><b>Sch <br>Qty</b></span></td>
<td bgcolor="#00DDFF"  width='10px'  rowspan='2'><span class="tabletext"><b>Fg<br/>Qty</b></span></td>
<td bgcolor="#00DDFF"  width='10px'  rowspan="2"><span class="tabletext"><b>Rej<br/>Qty</b></span></td>
<td bgcolor="#00DDFF"  width='10px'  rowspan='2'><span class="tabletext"><b>Rem<br/>Qty</b></span></td>
<td bgcolor="#00DDFF"  width='10px'  rowspan='2'><span class="tabletext"><b>GRN<br/>Qty</b></span></td>
<td bgcolor="#00DDFF"  width='10px'  rowspan='2'><span class="tabletext"><b>RT/Ut<br/><?php echo $strokes_hrs; ?></b></span></td>
<?php echo $parts_blank;?>
<td bgcolor="#FFA500 "  width='10px' rowspan='2'><span class="tabletext"><b>FF<br/>Qty</b></span></td>
<td bgcolor="#FFA500 "  width='10px' rowspan='2'><span class="tabletext"><b>UF<br/>Qty</b></span></td>
<td bgcolor="#FFA500 "  width='10px' rowspan='2'><span class="tabletext"><b>Req <br/> <?php echo $strokes_hrs; ?></b></span></td>
<td bgcolor="#FFA500 "  width='10px' rowspan='2'><span class="tabletext"><b>FF<br/><?php echo $strokes_hrs; ?></b></span></td>
<td bgcolor="#FFA500 "  width='10px' rowspan='2'><span class="tabletext"><b>UF<br/><?php echo $strokes_hrs; ?></b></span></td>
<td bgcolor="#FFA500 "  width='10px' rowspan='2'><span class="tabletext"><b>C/F<br/><?php echo $strokes_hrs; ?> </b></span></td>
<td bgcolor="#FFFF00" width='35px'><span class="tabletext"><b>Mfg Start Date/Time&nbsp;&nbsp;&nbsp;&nbsp;</b></span></td>


</tr>
<tr>
	<td bgcolor="#FFFF00" width='25px'  ><span class="tabletext"><b>Mfg End Date/time</b></span></td>

</tr>

<?php 
}



echo "<tr bgcolor=\"#FFCC00\"> ";
echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">$mc_avail_hrs</span><input type=\"hidden\" size=4  name=\"mc_avail_hrs$z\" id=\"mc_avail_hrs$z\" value=\"$mc_avail_hrs\"   readonly=\"readonly\"></td>";


if((trim($prev_mc) == trim($mc_name) || trim($prev_mc) =='') || (trim($prev_mc) != trim($mc_name) ) )
{   

	if($crn_qty1 == $balance_crn_qty)
	{
		echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px'><span class=\"tabletext\"><font color =\"#FF0000\" size=2>$crn</span></td>";
	}
	elseif($balance_crn_qty == 0)
	{
		echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px'><span class=\"tabletext\"><font color =\"#00FF00\" size=2>$crn</span></td>";
	}
	elseif($crn_qty1-$balance_crn_qty >0)
	{
		echo "<td bgcolor=\"#FFFFFF\"  align=\"center\" rowspan='2' width='10px'><span class=\"tabletext\"><font color =\"#FFAA00\" size=2>$crn</span></td>";
	}

	
 
}


if($prev_mc != $mc_name) 
{ 


	echo'<script type="text/javascript"> 
			$(document).ready(function()
			{	
				var chart = ' . $chart .' 
				var mc = "' . $mc_name . '"
				var mc_hrs = "' . $avail_capacity . '"
				drawChart(chart,mc,mc_hrs); 
			});
		</script>';
	?>
 	<div style="margin-left:870px;" >
		<canvas id="myChart<?php echo $chart ?>" ></canvas>	
	</div>
 
	<?php 

	$chart++;
	$start_date=$st_date1;
	$prev_mc=$mc_name;
	
	$time = '';
	$time24 = '';


	
}



echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' ><span class=\"tabletext\">$operation</span></td>";
echo "<td bgcolor=\"#FFFFFF\"  align=\"center\" rowspan='2' ><span class=\"tabletext\">$schdate</span></td>";
echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2'><span class=\"tabletext\">$schqty</span></td>";
echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2'><span class=\"tabletext\">$fg_qty1</span></td>";
echo "<td bgcolor=\"#FFFFFF\" align=\"center\"  rowspan='2'><span class=\"tabletext\">$rej_qty1</span></td>";
echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2'><span class=\"tabletext\">$totalfgqty</span></td>";
echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2'><span class=\"tabletext\">$grn_bal_qty</span></td>";



echo "<input type=\"hidden\" name=\"schqty_$i\" id=\"schqty_$i\" value=\"$schqty\">";
echo "<input type=\"hidden\" name=\"schedule_date_$i\" id=\"schedule_date_$i\" value=\"$schdate\">";
echo "<input type=\"hidden\" name=\"fg_qty_$i\" id=\"fg_qty_$i\" value=\"$fg_qty1\">";
echo "<input type=\"hidden\" name=\"rej_qty_$i\" id=\"rej_qty_$i\" value=\"$rej_qty1\">";
echo "<input type=\"hidden\" name=\"totalfgqty_$i\" id=\"totalfgqty_$i\" value=\"$totalfgqty\">";
echo "<input type=\"hidden\" size=4  name=\"req_crn_qty$i\" id=\"req_crn_qty$i\"  value=\"$req_qty\"  ></td>";
echo "<input type=\"hidden\" name=\"grnqty_$i\" id=\"grnqty_$i\" value=\"$grn_bal_qty\">";

echo "<td bgcolor=\"#FFFFFF\"  align=\"center\" rowspan='2' width=\"10px\"><span class=\"tabletext\">$runtime_hrs</span>
		<input type=\"hidden\"  size=4  name=\"req_rt_perunit$i\" id=\"req_rt_perunit$i\" value=\"$runtime_hrs\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

if ($avail_units == "strokes") 
{
	echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width=\"10px\" rowspan='2'><span class=\"tabletext\">$blank</span><input type=\"hidden\" size=4  name=\"blank$i\" id=\"blank$i\" value=\"$blank\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
}
else
{
	echo "<input type=\"hidden\" size=4  name=\"blank$i\" id=\"blank$i\" value=\"$blank\" >";
}

echo "<td bgcolor=\"#FFFFFF\"  align=\"center\"rowspan='2' width=\"10px\"><span class=\"tabletext\">$ff_qty</span>
		<input type=\"hidden\" size=4  name=\"ff_qty$i\" id=\"ff_qty$i\" value=\"$ff_qty\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";



if ($crn_qty == $balance_crn_qty)
{
	echo "<td bgcolor=\"#FFFFFF\" align=\"center\" width=\"10px\"  rowspan='2'   style=\"background-color:#FF0000;\"><span class=\"tabletext\"  >$balance_crn_qty</span><input type=\"hidden\" size=4  name=\"balance_crn_qty$i\" id=\"balance_crn_qty$i\" value=\"$balance_crn_qty\"  readonly=\"readonly\"></td>";
}
elseif ($balance_crn_qty == 0)
{
	echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2'  width=\"10px\" style=\"background-color:#00FF00;\"><span class=\"tabletext\">$balance_crn_qty</span><input type=\"hidden\" size=4  name=\"balance_crn_qty$i\" id=\"balance_crn_qty$i\" value=\"$balance_crn_qty\"  readonly=\"readonly\"></td>";
}
elseif ($crn_qty-$balance_crn_qty >0)
{
	echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width=\"10px\" style=\"background-color:#ffc600;\"><span class=\"tabletext\">$balance_crn_qty</span><input type=\"hidden\" size=4  name=\"balance_crn_qty$i\" id=\"balance_crn_qty$i\" value=\"$balance_crn_qty\"  readonly=\"readonly\"></td>";
}


echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width=\"10px\"><span class=\"tabletext\">$req_crn_hrs</span>
	<input type=\"hidden\" size=4  name=\"req_crn_hrs$i\" id=\"req_crn_hrs$i\" value=\"$req_crn_hrs\" >
	</td>";

echo "<td bgcolor=\"#FFFFFF\" align=\"center\"  rowspan='2' width=\"10px\"><span class=\"tabletext\">$ff_hrs</span>
		<input type=\"hidden\" size=4  name=\"ff_qty_hrs$i\" id=\"ff_qty_hrs$i\" value=\"$ff_hrs\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width=\"10px\"><span class=\"tabletext\">$uf_hrs</span>
		<input type=\"hidden\" size=4  name=\"balance_crn_hrs$i\" id=\"balance_crn_hrs$i\" value=\"$uf_hrs\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width=\"10px\"><span class=\"tabletext\">$balance_mc_hrs</span>
	  <input type=\"hidden\" size=4  name=\"balance_mc_hrs$i\" id=\"balance_mc_hrs$i\" value=\"$balance_mc_hrs\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";




if (!isset($time24)) 
{
	$time24 = '';  
	$now_hour = 0;
}
else
{		
	$now_hour = $time24;
}


echo "<td bgcolor=\"#FFFFCC\"  align=\"center\" width=\"35px\"><span class=\"tabletext\"><input type=\"text\" name=\"start_date$i\" id=\"start_date$i\" size=9 value=\"$start_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onClick=\"GetDate('start_date$i')\">&nbsp;&nbsp;&nbsp;<input type=\"tex\"  name=\"time$i\"  id=\"time$i\" size=4 value=\"$time\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"><select name=\"time_sel$i\" id=\"time_sel$i\" onchange=\"onSelecttime($i)\">
<option value=\"select\">Select</option>  ";


for($s = 0; $s < 24 ; $s++)  
{ 
	
	
switch ($s)  
{ 
	

case 0; 
echo "<option value=\"$s\""; 
if ($now_hour == $s) { echo " selected"; } 
echo "> 12 AM\n"; 
break; 

case 12: 
echo "<option value=\"$s\""; 
if ($now_hour == $s) { echo " selected"; } 
echo "> 12 PM\n"; 
break; 

case ($s < 13): 
echo "    <option value=\"$s\""; 
if ($now_hour == $s) { echo " selected"; } 
echo "> $s AM\n"; 
break; 



case ($s > 12); 
echo "    <option value=\"$s\""; 
if ($now_hour == $s) { echo " selected"; } 
echo "> " . ($s-12) . " PM\n"; 
break; 

} 
} 
echo "</select> </td>";







if($start_date!='' && $start_date!='0000-00-00' )
{

	$orderdate = explode('-', $start_date);
	$month_s = $orderdate[1];
	$day   = $orderdate[2];
	$year_s  = $orderdate[0];

	$jd = GregorianToJD($month_s, $day, $year_s);

	if ($avail_units == "strokes") 
	{
		if ($avail_shift == 1 ) {
		$t_hrs = $mc_avail_hrs/24;
		$shift_hr = 8;
		}else if($avail_shift == 2){
		$t_hrs = $mc_avail_hrs/24;
		$shift_hr = 16;
		}else if ($avail_shift == 3) {
		$t_hrs = $mc_avail_hrs/24;
		$shift_hr = 24;
		}

		// $per_hr = $t_hrs/$shift_hr;
		// $total_hrs = $ff_hrs/$per_hr;
		// $days=intval($total_hrs/$shift_hr);
		// $hours=$total_hrs%$shift_hr;

		$perday_hrs=intval($mc_avail_hrs/(24*$shift_hr));
		$storesperreq = intval($ff_hrs/$perday_hrs);
		$days=intval($storesperreq/$shift_hr);
		$hours=$storesperreq%$shift_hr;

		// echo "per day $perday_hrs <br>";
		// echo "days  $days <br>";
		// echo "hours hrs $hours <br>";

	}
	else
	{
		
		$days=intval($ff_hrs/24);
		$hours=$ff_hrs%24;
	}


	if ($time24 =="" || $time24 == 0 || $time24 > 23)  
	{
	  	$time=0;
	  	$time24=0;

	}

	$hours1 = $time24 + $hours;

	$days  = ($days + intval($hours1/24));

	$hours1 = ($hours1%24);



	$check=(0+$hours1);

	$end_time=$check; 

	$ed_time24 = $check; 



	$suffex = ($end_time >= 12 && $end_time <= 23 ) ? 'PM' : 'AM'; 

	

	if (isset($jd)) 
	{
		$total_days=($jd+$days);	
	}




$end_date=$total_days;

$end_date = JDToGregorian($end_date);

$end_datearr = explode('/', $end_date);
$month1 = $end_datearr[0];

if($month1 <=9)
{
 $month1='0'.$month1;
}
else
{
  $month1=$month1;
 }

$day1   = $end_datearr[1];
if($day1 <=9)
{
 $day1='0'.$day1;
}
else
{
 $day1=$day1;
}

$year1  = $end_datearr[2];

$end_date=$year1.'-'.$month1.'-'.$day1;

$end_time = (($end_time + 11) % 12 + 1);

// echo "end time $end_time <br>";

$end_time = ($end_time == '00')? 12 : $end_time;
$end_time=$end_time.' '.$suffex;
$end_time1=$end_time.' '.$suffex;



}
else
{
	$end_date=$end_date;
	$end_time=$end_time;

}


echo "<input type=\"hidden\" size=2  name=\"priority$i\" id=\"priority$i\"   value=\"$prity\"  ></td>";
echo "<input type=\"hidden\" size=2  name=\"units$i\" id=\"units$i\"   value=\"$avail_units\"  ></td>";
echo "<input type=\"hidden\" size=2  name=\"shift$i\" id=\"shift$i\"   value=\"$avail_shift\"  ></td>";

echo "</tr>" ;


echo "<td bgcolor=\"#FFFFCC\"   width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=9  name=\"end_date$i\" id=\"end_date$i\" value=\"$end_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span><span class=\"tabletext\">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type=\"text\" size=4  name=\"ed_time$i\" id=\"ed_time$i\" value=\"$end_time\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";


echo "<input type=\"hidden\" name=\"crn_$i\" id=\"crn_$i\" value=\"$crn\">";
echo "<input type=\"hidden\" name=\"mc_id_$i\" id=\"mc_id_$i\" value=\"$mc_id\">";
echo "<input type=\"hidden\" name=\"mc_name$z\" id=\"mc_name$z\" value=\"$mc_name\">";
echo "<input type= \"hidden\" size=4  name=\"prev_mc$z\" id=\"prev_mc$z\" value=\"$prev_mc\">";
echo "<input type=\"hidden\" name=\"prev_avail_mc_hrs$z\" id=\"prev_avail_mc_hrs$z\" value=\"$prev_avail_mc_hrs\">";
echo "<input type=\"hidden\" name=\"operation_$z\" id=\"operation_$z\" value=\"$operation\">";

// if ($prevname4mc != $mcname) 
// {
// 	echo "string <br> i val $i <br>";
// }

echo "</tr>";

$prev_avail_mc_hrs=$balance_mc_hrs; 
$prev_crn=$crn;
$prevschdate=$schdate;
$prev_balance_qty=$balance_crn_qty; 
$crnarr[$crn][$schdate]=$balance_crn_qty;
$prev_month=$month; 
$prev_operation=$operation;


if($prev_mc == '' || $prev_mc == $mc_name)
{
	$prev_mc=$mc_name;
	$start_date=$end_date;
	$time=$end_time;
	$time24 = $ed_time24;
    $availmchrs = $mccapmaster[$mc_name][0];
}




$prevname4mc = $mc_name;

$total_ffhrs += $ff_hrs;


$z++;
$i++;



}

}


echo "<tr><td colspan=7 bgcolor=\"#FFFFFF\"><b>Avail Mc ". $strokes_hrs. " " . $availmchrs . "</b></td>
		  <td colspan=7 bgcolor=\"#FFFFFF\"><b>Total FF ". $strokes_hrs. " " . $total_ffhrs . "</b></td>
		  <td colspan=7 bgcolor=\"#FFFFFF\"><b>Remaining Hrs ". $strokes_hrs. " " . ($availmchrs - $total_ffhrs ). "</b></td>
		</tr>";



echo "<input type=\"hidden\" name=\"max_val\" id=\"max_val\" value=\"$i\">";
echo "</table>";
echo "</td></tr>";





?>

<input type="hidden" name="chart_det" id="chart_det"  value='<?php echo json_encode($crn_usage_hrs); ?>'>
	
<script type="text/javascript">

		function drawChart(i,mc_name,mc_hrs)
		{
			
            var subfactor = 0;
			var crnusage = document.getElementById("chart_det").value;
			var monthselect = document.getElementById("pl_month");
			var month = monthselect.options[monthselect.selectedIndex].text;
			var year = document.getElementById("pl_year").value;
			var result = JSON.parse(crnusage);
			// console.log(JSON.stringify(result));
		
			var ctx = document.getElementById("myChart"+i).getContext('2d');
			ctx.canvas.width = 250;
			 ctx.canvas.height = 300;
	
			var myChart = new Chart(ctx, {
		  	type: 'bar',
		  	data: {
			    labels: [month +' '+ year ],
			    datasets: []
		  	},
			  	options: {
				    scales: {
				      xAxes: [{
				        stacked: true
				      }],
				      yAxes: [{
				        stacked: true,
				        ticks: {
				            beginAtZero: true,
                            steps: 7
				        }
				      }]
				    },
				    responsive: false,
				    legend: {
				    	position:"right",
				    	display: true

				    },

				    tooltips: {
				      callbacks: {

				        title: function(tooltipItem, data) {
				           return  tooltipItem[0].xLabel;
				        },
				        label : function(tooltipItem, data) {
                        	var t_label = "Used Hrs " + ': ' + tooltipItem.yLabel + "\n" + " Total Hrs "  + myChart.data.datasets[0].t_hrs ;
                        	return t_label;
                    	},
				      }
				    },
		        	animation: {
				      onComplete: function () {
				        var chartInstance = this.chart;
				        var ctx = chartInstance.ctx;
				        var height = chartInstance.controller.boxes[0].bottom;
				        ctx.textAlign = "center";
				        ctx.fillStyle="white";
				        ctx.font = '15px Arial';
				        Chart.helpers.each(this.data.datasets.forEach(function (dataset, i) {
				          var meta = chartInstance.controller.getDatasetMeta(i);
				          Chart.helpers.each(meta.data.forEach(function (bar, index) {
				            ctx.fillText(dataset.data[index], bar._model.x, bar._model.y+5);
				           }),this)
				        }),this);
				      }
				    }
			  	}


			});


			var randomColorGenerator = function (j) { 
			    // return '#' + (Math.random().toString(16) + '0000000').slice(2, 8); 
			    $colrs = new Array( '#ADFF2F', '#00FFFF', '#7D7B6A','#0066CC' ,'#D2691E','#006400','#556B2F','#FF00FF','#50284A','#C4D318');
			    return $colrs[j];
			};

			for (var key in result) {
			  	if (result.hasOwnProperty(key)) {
				    var val = result[key];
				    if (key == mc_name) 
				    {
				    	for (var j = 0; j < val.length; j++) 
				    	{
			    			myChart.data.datasets.push({
							    type: 'bar',
							    label: val[j].crn,
						        backgroundColor: randomColorGenerator(j), 
						        data: [val[j].used_hrs],
						        't_hrs': val[j].mc_hrs,
							})

							

			    		}
				    }

				    
				    myChart.options.scales.yAxes[0].ticks['max'] = parseFloat(mc_hrs.trim());
				    myChart.update();
			    	
			  	}
			}

			
		}


</script>

<?php

?>
</tr>
<tr>
<td align='left'>
<span class="labeltext"><input type="submit" style="color=#0066CC;background-color:#DDDDDD;width=130;" value="SAVE" name="Submit"></span>
</tr>


<?php

}
else
{   

echo "<tr>";
echo "<td>";


$i = 1;
$z = 1;

$prev_mc = "";
$prev_avail_mc_hrs='';
$prev_mc_series='';
$balance_crn_qty=0;
$balance_mc_hrs=0;
$prev_month = "";
$prev_operation ="";
$prev_crn ="";
$total_ffhrs = 0;

$crn_usage_hrs = array();
$chart = 1;

$mc_cap_plan = $newmc_capacity->get_capacity_plan($crnnum,$mc,$month,$year);
while ($mycapplan = mysql_fetch_assoc($mc_cap_plan) )
{
$mc_avail_hrs = $mycapplan['mc_avail_hrs'];
$mc_cap_hrs = $mycapplan['mc_cap_hrs'];
$crn = $mycapplan['crn'];
$operation = $mycapplan['operation'];
$schqty = $mycapplan['crn_qty'];
$req_qty = $mycapplan['crn_qty'];
$crn_qty = $mycapplan['crn_qty'];
$start_date = $mycapplan['start_date'];
$time = $mycapplan['start_time'];

$req_crn_hrs = $mycapplan['req_crn_hrs'];
$runtime_hrs = $mycapplan['runtime_units'];
$balance_crn_hrs = $mycapplan['balance_crn_hrs'];
$balance_crn_qty = $mycapplan['balance_crn_qty'];
$balance_mc_hrs = $mycapplan['balance_mc_hrs'];
$priority = $mycapplan['priority'];
$end_date = $mycapplan['end_date'];
$ed_time = $mycapplan['end_time'];


$mc_id = $mycapplan['mc_id'];
$mc_sr = $mycapplan['mc_series'];
$mc_name = $mycapplan['mc_name'];
$month = $mycapplan['plan_month'];

$start_meridiem = $mycapplan['start_meridiem'];
$end_meridiem = $mycapplan['end_meridiem'];
$st_meri = $time." ". $start_meridiem;
$ed_meri = $ed_time." ". $end_meridiem;

$blank = $mycapplan['blank'];
$units = $mycapplan['units'];
$shift = $mycapplan['shift'];

$schqty = $mycapplan['sch_qty'];
$schdate = $mycapplan['schedule_date'];
$fgqty1 = $mycapplan['fgqty'];
// $rejqty1 = $mycapplan['rejqty'];
$totalfgqty = $mycapplan['totalfgqty'];
$grn_qty = $mycapplan['grn_qty'];

$ff_qty = $mycapplan['ff_qty'];
$ff_qty_hrs = $mycapplan['ff_qty_hrs'];

if ($units == "strokes") {
$strokes_hrs = "Strs.";
}else{
$strokes_hrs = "Hrs.";
}


$crn_usage_hrs[$mc_name][] = array('crn'=> $crn, 'used_hrs' => $ff_qty_hrs,'mc_hrs'=> $mc_avail_hrs);


if ($prev_mc != $mc_name ) 
{  

	$availmchrs = $mc_avail_hrs;
	if($prev_mc !='')
	{

			
    echo "<tr><td colspan=7 bgcolor=\"#FFFFFF\"><b>Avail Mc ". $first_strokes_hrs. " " . $first_mc_cap_hrs . " </b></td>
		  <td colspan=7 bgcolor=\"#FFFFFF\"><b>Total FF ". $first_strokes_hrs. " " . $total_ffhrs . " </b></td>
		  <td colspan=7 bgcolor=\"#FFFFFF\"><b>Remaining Mc  ". $first_strokes_hrs. " " .  ($first_mc_cap_hrs - $total_ffhrs ). " </b></td>
		</tr>";

		$total_ffhrs = 0;
	}
	else
	{
		$first_mcname = $mc_name;
		$first_mc_cap_hrs = $mc_cap_hrs;
		$first_strokes_hrs = $strokes_hrs;

	}


echo "<table class=\"stdtable1\"><tr><td align=\"center\" colspan=16 bgcolor=\"#99CCFF\" style=\"padding:5px;\"><center><span class=\"heading\"><b>M/C Name: ". $mc_name . ",  Avail Capacity: ".$mc_avail_hrs."</b></span></center></td></tr></table>";

?>


<table width=80% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" style="margin: -269px 39 40 0;vertical-align: center;width:30%;">
<tr bgcolor="#FFCC00">
<td bgcolor="#FFA500" width='10px' rowspan='2'  ><span class="tabletext"><b>Avail. <br/>Cap <br/><?php echo $strokes_hrs; ?></b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan='2' ><span class="tabletext"><b>PRN</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan='2' ><span class="tabletext"><b>Oper</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan='2' ><span class="tabletext"><b><br/>Sch<br/>Date</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan='2' ><span class="tabletext"><b>Sch <br>Qty</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan='2' ><span class="tabletext"><b>Fg<br/>Qty</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan='2' ><span class="tabletext"><b>Rej<br/>Qty</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan='2' ><span class="tabletext"><b>Rem<br/>Qty</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan='2' ><span class="tabletext"><b>GRN<br/>Qty</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan='2' ><span class="tabletext"><b>RT/Ut<br/><?php echo $strokes_hrs; ?></b></span></td>
<?php	
if ($strokes_hrs == "Strs.") 
{ ?>
<td bgcolor="#33cc99" width='10px' rowspan='2'><span class="tabletext"><b>Parts/<br/>Blanks</b></span></td>
<?php } ?>
<td bgcolor="#FFA500" width='10px' rowspan='2' ><span class="tabletext"><b>FF<br/>Qty</b></span></td>
<td bgcolor="#FFA500" width='10px' rowspan='2' ><span class="tabletext"><b>UF<br/>Qty</b></span></td>
<td bgcolor="#FFA500" width='10px' rowspan='2' ><span class="tabletext"><b>Req <br/> <?php echo $strokes_hrs; ?></b></span></td>
<td bgcolor="#FFA500" width='10px' rowspan='2' ><span class="tabletext"><b>FF<br/><?php echo $strokes_hrs; ?></b></span></td>
<td bgcolor="#FFA500" width='10px' rowspan='2' ><span class="tabletext"><b>UF<br/><?php echo $strokes_hrs; ?></b></span></td>
<td bgcolor="#FFA500" width='10px' rowspan='2' ><span class="tabletext"><b>C/F<br/><?php echo $strokes_hrs; ?> </b></span></td>

<td bgcolor="#FFFF00" width='35px'><span class="tabletext"><b>Mfg Start Date/Time&nbsp;&nbsp;&nbsp;&nbsp;</b></span></td>

</tr>
<tr>
	<td bgcolor="#FFFF00" width='25px'><span class="tabletext"><b>Mfg End Date/time</b></span></td>

</tr>
<?php 
}



echo "<tr bgcolor=\"#FFCC00\"> ";
echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px'><span class=\"tabletext\">$mc_avail_hrs</span>
	  <input type=\"hidden\" size=4  name=\"mc_avail_hrs$i\" id=\"mc_avail_hrs$i\" value=\"$mc_avail_hrs\"   readonly=\"readonly\"></td>";

if($crn_qty == $balance_crn_qty)
{
	echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px'><span class=\"tabletext\"><font color =\"#FF0000\" size=2>$crn</span></td>";
}
else if($balance_crn_qty == 0)
{
echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px'><span class=\"tabletext\"><font color =\"#00FF00\" size=2>$crn</span></td>";
}
else if($crn_qty-$balance_crn_qty >0)
{
echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2'  width='10px'><span class=\"tabletext\"><font color =\"#ffc600\" size=2>$crn</span></td>";
}


echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' ><span class=\"tabletext\">$operation</span></td>";
echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2'><span class=\"tabletext\">$schdate</span></td>";
echo "<td bgcolor=\"#FFFFFF\" align=\"center\"  rowspan='2'><span class=\"tabletext\">$schqty</span></td>";
echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2'><span class=\"tabletext\">$fgqty1</span></td>";
echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2'><span class=\"tabletext\">$fgqty1</span></td>";
echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2'><span class=\"tabletext\">$totalfgqty</span></td>";
echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2'><span class=\"tabletext\">$grn_qty</span></td>";

echo "<input type=\"hidden\" size=4   name=\"req_crn_qty$i\" id=\"req_crn_qty$i\"  value=\"$req_qty\"  >";


echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"  rowspan='2'> <span class=\"tabletext\">$runtime_hrs</span>
	  <input type=\"hidden\" size=4  name=\"req_rt_perunit$i\" id=\"req_rt_perunit$i\" value=\"$runtime_hrs\" ></td>";

if ($strokes_hrs == "Hrs.") 
{
echo "<input type=\"hidden\" size=4  name=\"blank$i\" id=\"blank$i\" value=\"$blank\" >";
}
else
{
echo "<td bgcolor=\"#FFFFFF\" width=\"10px\" rowspan='2'><span class=\"tabletext\">$blank</span>
	  <input type=\"hidden\" size=4  name=\"blank$i\" id=\"blank$i\" value=\"$blank\" ></td>";
}

echo "<td bgcolor=\"#FFFFFF\" width=\"10px\" rowspan='2'><span class=\"tabletext\">$ff_qty</span>
	  <input type=\"hidden\" size=4  name=\"ff_qty$i\" id=\"ff_qty$i\" value=\"$ff_qty\" ></td>";


if ($crn_qty == $balance_crn_qty)
{
	echo "<td bgcolor=\"#FFFFFF\" align=\"center\" width=\"10px\" rowspan='2'  style=\"background-color:#FF0000;\"><span class=\"tabletext\">$balance_crn_qty</span>
		  <input type=\"hidden\" size=4  name=\"balance_crn_qty$i\" id=\"balance_crn_qty$i\" value=\"$balance_crn_qty\" >
		  </td>";
}
else if ($balance_crn_qty == 0)
{
	echo "<td bgcolor=\"#FFFFFF\" align=\"center\" width=\"10px\" rowspan='2' style=\"background-color:#00FF00;\"><span class=\"tabletext\">$balance_crn_qty</span>
		  <input type=\"hidden\" size=4  name=\"balance_crn_qty$i\" id=\"balance_crn_qty$i\" value=\"$balance_crn_qty\" ></td>";
}
else if ($crn_qty-$balance_crn_qty >0)
{
	echo "<td bgcolor=\"#FFFFFF\" align=\"center\" width=\"10px\" rowspan='2' style=\"background-color:#ffc600;\"><span class=\"tabletext\">$balance_crn_qty</span>
		  <input type=\"hidden\" size=4  name=\"balance_crn_qty$i\" id=\"balance_crn_qty$i\" value=\"$balance_crn_qty\" >
		  </td>";
}

echo "<td bgcolor=\"#FFFFFF\" align=\"center\" width=\"10px\" rowspan='2' ><span class=\"tabletext\">$req_crn_hrs</span>
	  <input type=\"hidden\" size=4  name=\"req_crn_hrs$i\" id=\"req_crn_hrs$i\" value=\"$req_crn_hrs\" >
	  </td>";


echo "<td bgcolor=\"#FFFFFF\" align=\"center\" width=\"10px\" rowspan='2'><span class=\"tabletext\">$ff_qty_hrs</span>
	  <input type=\"hidden\" size=4  name=\"ff_qty_hrs$i\" id=\"ff_qty_hrs$i\" value=\"$ff_qty_hrs\" ></td>";


echo "<td bgcolor=\"#FFFFFF\" align=\"center\" width=\"10px\" rowspan='2'><span class=\"tabletext\">$balance_crn_hrs</span>
	  <input type=\"hidden\" size=4  name=\"balance_crn_hrs$i\" id=\"balance_crn_hrs$i\" value=\"$balance_crn_hrs\" >
	  </td>";


echo "<td bgcolor=\"#FFFFFF\" align=\"center\" width=\"10px\" rowspan='2'><span class=\"tabletext\">$balance_mc_hrs</span>
	  <input type=\"hidden\" size=4  name=\"balance_mc_hrs$i\" id=\"balance_mc_hrs$i\" value=\"$balance_mc_hrs\" >
	  </td>";


echo "<td bgcolor=\"#FFFFCC\" width=\"35px\"><span class=\"tabletext\"><input type=\"text\" name=\"start_date$i\" id=\"start_date$i\" size=9 value=\"$start_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">&nbsp;&nbsp <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onClick=\"GetDate('start_date$i')\">&nbsp;&nbsp;<input type=\"tex\"  name=\"time$i\"  id=\"time$i\" size=4 value=\"$st_meri\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"><select name=\"time_sel$i\" id=\"time_sel$i\" onchange=\"onSelecttime($i)\">
<option value=\"select\">Select</option>  ";


$now_hour=$time;
for($s = 0; $s < 24 ; $s++)  
{ 
switch ($s)  
{ 
case 0; 
echo "<option value=\"$s\""; 
if ($now_hour == $s) { echo " selected"; } 
echo "> 12 Mid\n"; 
break; 
case 12: 
echo "<option value=\"$s\""; 
if ($now_hour == $s) { echo " selected"; } 
echo "> 12 Noon\n"; 
break; 
case ($s< 13): 
echo "    <option value=\"$s\""; 
if ($now_hour == $s) { echo " selected"; } 
echo "> $s AM\n"; 
break; 
case ($s > 12); 
echo "    <option value=\"$s\""; 
if ($now_hour == $s) { echo " selected"; } 
echo "> " . ($s-12) . " PM\n"; 
break; 
} 
} 
echo "</select> </td>";


echo "<input type=\"hidden\" size=2  name=\"priority$i\" id=\"priority$i\"   value=\"$priority\"  ></td>";

echo "<input type=\"hidden\" size=2  name=\"units$i\" id=\"units$i\"   value=\"$units\"  ></td>";
echo "<input type=\"hidden\" size=2  name=\"shift$i\" id=\"shift$i\"   value=\"$shift\"  ></td>";



echo "</tr>" ;
echo "<td bgcolor=\"#FFFFCC\"  width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=9  name=\"end_date$i\" id=\"end_date$i\" value=\"$end_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span><span class=\"tabletext\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" size=4  name=\"ed_time$i\" id=\"ed_time$i\" value=\"$ed_meri\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";



echo "<input type=\"hidden\" name=\"crn_$i\" id=\"crn_$i\" value=\"$crn\">";
echo "<input type=\"hidden\" name=\"mc_id_$i\" id=\"mc_id_$i\" value=\"$mc_id\">";
echo "<input type=\"hidden\" name=\"mc_sr_$i\" id=\"mc_sr_$i\" value=\"$mc_sr\">";
echo "<input type=\"hidden\" name=\"mc_name$i\" id=\"mc_name$i\" value=\"$mc_name\">";
echo "<input type= \"hidden\" size=4  name=\"prev_mc$i\" id=\"prev_mc$i\" value=\"$prev_mc\">";
echo "<input type=\"hidden\" name=\"prev_avail_mc_hrs$i\" id=\"prev_avail_mc_hrs$i\" value=\"$prev_avail_mc_hrs\">";
echo "<input type=\"hidden\" name=\"operation_$i\" id=\"operation_$i\" value=\"$operation\">";

echo "<input type=\"hidden\" name=\"schqty_$i\" id=\"schqty_$i\" value=\"$schqty\">";
echo "<input type=\"hidden\" name=\"schedule_date_$i\" id=\"schedule_date_$i\" value=\"$schdate\">";
echo "<input type=\"hidden\" name=\"fg_qty_$i\" id=\"fg_qty_$i\" value=\"$fgqty1\">";
echo "<input type=\"hidden\" name=\"totalfgqty_$i\" id=\"totalfgqty_$i\" value=\"$totalfgqty\">";
echo "<input type=\"hidden\" name=\"grnqty_$i\" id=\"grnqty_$i\" value=\"$grn_qty\">";


if($prev_mc != $mc_name) 
{ 

	echo'<script type="text/javascript"> 
			$(document).ready(function()
			{	
				var chart = ' . $chart .' 
				var mc = "' . $mc_name . '"
				var mc_hrs = "' . $mc_cap_hrs . '"
				drawChart1(chart,mc,mc_hrs); 
			});
		</script>';


	?>
	<div style="margin-left:870px;">
		<canvas id="myChart<?php echo $chart ?>"></canvas>	
	</div>

	<?php 

	$chart++;

}



$prev_avail_mc_hrs=$balance_mc_hrs; 
$prev_crn=$crn;
$prev_balance_qty=$balance_crn_qty; 
$crnarr[$crn][$schdate]=$balance_crn_qty;
$prev_month=$month; 
$prev_operation=$operation;
$prev_mc=$mc_name;


$total_ffhrs += $ff_qty_hrs;

echo "</tr>";

$i++;


}

echo "<tr><td colspan=7 bgcolor=\"#FFFFFF\"><b>Avail Mc ". $strokes_hrs. " " . $availmchrs . "</b></td>
		  <td colspan=7 bgcolor=\"#FFFFFF\"><b>Total FF ". $strokes_hrs. " " . $total_ffhrs . "</b></td>
		  <td colspan=7 bgcolor=\"#FFFFFF\"><b>Remaining Mc ". $strokes_hrs. " " .  ($availmchrs - $total_ffhrs ). "</b></td>
		</tr>";

echo "<input type=\"hidden\" name=\"max_val\" id=\"max_val\" value=\"$i\">";
echo "</table>";
echo "</td></tr>";
?>
<input type="hidden" name="chart_det" id="chart_det"  value='<?php echo json_encode($crn_usage_hrs); ?>'>
	
<script type="text/javascript">

		function drawChart1(i,mc_name, mchrs)
		{

			var crnusage = document.getElementById("chart_det").value;
			var monthselect = document.getElementById("pl_month");
			var month = monthselect.options[monthselect.selectedIndex].text;
			var year = document.getElementById("pl_year").value;

			var result = JSON.parse(crnusage);
		
			var ctx = document.getElementById("myChart"+i).getContext('2d');
			ctx.canvas.width = 250;
			ctx.canvas.height = 300;
			var myChart = new Chart(ctx, {
		  	type: 'bar',
		  	data: {
			    labels: [month +' '+ year ],
			    datasets: []
		  	},
			  	options: {
				    scales: {
				      xAxes: [{
				        stacked: true
				      }],
				      yAxes: [{
				        stacked: true,
				        ticks: {
				            beginAtZero: true,
                            steps: 7
				        }
				      }]
				    },
				    responsive: false,
				    legend: {
				    	position:"right",
				    	display: true
				    },

				    tooltips: {
				      callbacks: {

				        title: function(tooltipItem, data) {
				           return  tooltipItem[0].xLabel;
				        },
				        label : function(tooltipItem, data) {
                        	var t_label = "Used Hrs " + ': ' + tooltipItem.yLabel + "\n" + " Total Hrs "  + myChart.data.datasets[0].t_hrs ;
                        	return t_label;
                    	},
				      }
				    },
		        	animation: {
				      onComplete: function () {
				        var chartInstance = this.chart;
				        var ctx = chartInstance.ctx;
				        var height = chartInstance.controller.boxes[0].bottom;
				        ctx.textAlign = "center";
				        ctx.fillStyle = "white";
				        ctx.font = '15px Arial';
				        Chart.helpers.each(this.data.datasets.forEach(function (dataset, i) {
				          var meta = chartInstance.controller.getDatasetMeta(i);
				          Chart.helpers.each(meta.data.forEach(function (bar, index) {
				            ctx.fillText(dataset.data[index], bar._model.x,  bar._model.y + 5);
				          }),this)
				        }),this);
				      }
				    }
			  	}


			});


			var randomColorGenerator = function (j) { 
			    // return '#' + (Math.random().toString(16) + '0000000').slice(2, 8); 
			    $colrs = new Array( '#ADFF2F', '#00FFFF', '#7D7B6A','#0066CC' ,'#D2691E','#006400','#556B2F','#FF00FF','#50284A','#C4D318');
			    return $colrs[j];
			};

			for (var key in result) {
			  	if (result.hasOwnProperty(key)) {
				    var val = result[key];
				    if (key == mc_name) 
				    {
				    	for (var j = 0; j < val.length; j++) 
				    	{

			    			myChart.data.datasets.push({
							    type: 'bar',
							    label: val[j].crn,
						        backgroundColor: randomColorGenerator(j), 
						        data: [val[j].used_hrs],
						        't_hrs': val[0].mc_hrs,
							})

							

			    		}
				    }

				   	myChart.options.scales.yAxes[0].ticks['max'] = parseFloat(mchrs.trim());
				   	myChart.update(); 
			    	
			  	}
			}

			
		}


</script>

</tr>
<tr>
<td align='left'>
<span class="labeltext"><input type="submit" style="color=#0066CC;background-color:#DDDDDD;width=130;" value="SAVE" name="Submit"></span>
</tr>

<?php 
}

}
?>



</table>

<!--  </td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>

<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
</form>
</table>

</body>
</html>