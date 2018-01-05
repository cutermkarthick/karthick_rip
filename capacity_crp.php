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


$page = "MES: CRP";
//session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newmc_capacity = new mc_capacity;
$dept=$_SESSION['department'];

$month_names = array('01' => 'Jan',
                      '02' => 'Feb',
                      '03' => 'Mar',
                      '04' => 'Apr',
                      '05' => 'May',
                      '06' => 'June',
                      '07' => 'July',
                      '08' => 'Aug',
                      '09' => 'Sep',
                      '10' => 'Oct',
                      '11' => 'Nov',
                      '12' => 'Dec');

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

if(isset($_REQUEST['params'])){
$params = $_REQUEST['params'];
}else{
$params = "";
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

<title>CRP</title>


<style type="text/css">
	
	.mainleft { width: 140px !important; }

</style>

<?php
include('header.html');
?>
<form action='capacity_crp.php' method='POST' enctype='multipart/form-data'>
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
<td  width="30%" bgcolor="#8daf43" style="vertical-align: top;padding: 5px;font-weight:bold;text-align:center;width:23%"><span style='font-size:18px;color:#343f60'>Production Scheduling Template V 1.0<br/>
<span style='color:white;font-size:11px;text-align:center'>Flexible on Shift Capacity and Powerful Visual Scheduling
</span><br/>
<span style='font-size:12px'>
www.fluentsoft.com

<td width="30%">
<table width=100% border=0 cellpadding=3 cellspacing=1 style="border: 1px solid grey;">
<tr>

<td width="10%"><span class="labeltext"><p align="left">Params </p></span>
	<span class="tabletext"><select name="params" id="params">
		<option value="please select" disabled>Please Select</option>
		<option value="All" <?php if($params == "All" || $params == ""){echo "selected='selected'";} ?> >ALL</option>
		<option value="None" <?php if($params == "None" ){echo "selected='selected'";} ?> >None</option>
		<option value="GRN" <?php if($params == "GRN" ){echo "selected='selected'";} ?>>GRN</option>
		<option value="WIP" <?php if($params == "WIP" ){echo "selected='selected'";} ?>>WIP</option>
		<option value="FG" <?php if($params == "FG" ){echo "selected='selected'";} ?>>FG</option>
	</select></span>
</td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

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
<span class="tabletext"><input type="text" name="crnnum" id='crnnum' size=10 value="<?php echo $crnnum; ?>"></span>&nbsp&nbsp&nbsp&nbsp</td>

<td  bgcolor="#FFFFFF"><span class="labeltext"><b>Month: &nbsp&nbsp</b></span><br />
	<select name="pl_month" id="pl_month"> 
        <option value="select" disabled="disabled" >Select</option>
        <?php 
        for ($m=1; $m < 13 ; $m++) 
        { 
        if ($m < 10) 
        {
          $m = "0".$m;
        }
        ?>
          <option <?php echo (($frm==$m)?"selected":"")?> value="<?php echo $m; ?>"><?php echo $month_names[$m]; ?></option>  
        <?php
        }
        ?>
        
  	</select>&nbsp&nbsp&nbsp&nbsp
</td>


<td><span class="heading"><b>Year: </b></span> <br />
	<select name="pl_year" id="pl_year" >
	<option value="select" disabled="disabled" >Select</option>
	<?php 
	for ($y=2010; $y < 2021 ; $y++) 
	{?>
	  <option <?php echo (($to==$y)?"selected":"")?> value="<?php echo $y; ?>"><?php echo $y; ?></option>  
	<?php
	}
	?>
	</select>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
$fisrt_ln_mc = 0;

/* -------------- get fg qty from crn_fg table and create fg array -------------------------- */

// $result4fg = $newmc_capacity->getfg_qty();
// while ($myresult4fg = mysql_fetch_row($result4fg)) 
// {
// 	$fg_arr[$myresult4fg[1]] = $myresult4fg[2];

// }

// echo "<pre>";
// print_r($fg_arr);


$crn_usage_hrs = array();

$crnmcschresult = $newmc_capacity->getlob_crnmc($crnnum,$mc,$month,$year);

$total_ffhrs = 0;
	
$mccap_arr = array();
$mccap_month_arr = array();


$mcname_check = "";
$rowCount = mysql_num_rows($crnmcschresult);
$currentRow=0;

while($mycrnmcschrow=mysql_fetch_row($crnmcschresult))
{
	$currentRow++;

	// $fg_qty1 = $newmc_capacity->getfg_qty($mycrnmcschrow[0]);
	


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
	$schhrs = $mycrnmcschrow[6];
	$blank = $mycrnmcschrow[8];
	$mc_id = $mycrnmcschrow[3];
	$prity = $mycrnmcschrow[2];

	$grn_bal_qty = $newmc_capacity->getgrnbal_qty($mycrnmcschrow[0]);
	$schqty = $mycrnmcschrow[5];
	$wip_qty = $mycrnmcschrow[13];
	$disp_qty = $mycrnmcschrow[12];
	$fg_qty = $mycrnmcschrow[11];
	$rej_qty = $mycrnmcschrow[10];

	$wip_qty = $wip_qty - $disp_qty;

	// $rej_qty1 = 0;	
	// $fg_qty1 = $fg_arr[$crn];
	// $fg_arr[$crn] = $fg_qty1 - $fg_arr[$crn];


	

	if($mcname_check == "") 
	{
		$mcname_check = $mc_name;
	}

	// echo "mcname_check $mcname_check <br>";
	// echo "mcname  $mc_name  <br>";

	$crnmcsch[$crn][$mc]= $schhrs;
	if (isset($mccapmaster[$mc_name][0])) {
		$mc_avail_hrs = $mccapmaster[$mc_name][0];    
	}

	if (isset($mccapmaster[$mc_name][0])) {
		$avail_capacity1 = $mccapmaster[$mc_name][0];   
		$mcavail_capacity = $mccapmaster[$mc_name][0]; 
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

	if ($params == "All") 
	{
		$totalfgqty = $schqty - ( $fg_qty + $wip_qty + $disp_qty + $rej_qty);
	}
	elseif($params == "None")
	{
		$totalfgqty = $schqty ;
	}
	elseif($params == "WIP")
	{
		$totalfgqty = $schqty - ($wip_qty + $rej_qty) ;
	}
	elseif($params == "FG")
	{
		$totalfgqty = $schqty - ( $fg_qty + $rej_qty );
	}
	else
	{
		$totalfgqty = $schqty ;
	}

	// $totalfgqty = $schqty - $fg_qty + $rej_qty;
	// $req_qty = $crnarr[$crn][$schdate];

	$bal_sch_qty = $totalfgqty;
	$bal_crn_qty = $bal_sch_qty;

	if($params == "GRN")
	{
		if ($bal_sch_qty < $grn_bal_qty ) 
		{
			$bal_crn_qty = $bal_sch_qty;
		}
		else
		{
			$bal_crn_qty = $bal_sch_qty;
		}
	}

	

	$req_crn_hrs=round($blank_hrs*$bal_crn_qty);


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

		if($possible_qty > $bal_crn_qty)
		{
			$balance_crn_qty=0;

			if($bal_crn_qty !='' && $bal_crn_qty!='0')
			{
				$balance_mc_hrs=round($avail_capacity-($bal_crn_qty*$blank_hrs));
				$balance_crn_hrs=0; 

				$crn_usage_hrs[$mc_name][] = array('crn'=> $crn, 'used_hrs' => $bal_crn_qty*$blank_hrs,'mc_hrs'=> $avail_capacity);
			}
			else
			{
				$balance_mc_hrs=$avail_capacity;
				$balance_crn_hrs=0; 
			}


			$ff_qty = $bal_sch_qty;
			$ff_hrs = ($ff_qty*$blank_hrs);

			$uf_hrs = ($balance_crn_qty*$blank_hrs);
		}

		elseif($possible_qty <= $bal_crn_qty)
		{       

			$balance_crn_qty=$bal_crn_qty-$possible_qty;  


			if($bal_crn_qty !='' && $bal_crn_qty !='0')
			{
				$balance_mc_hrs=round($avail_capacity-($possible_qty*$blank_hrs));

				$crn_usage_hrs[$mc_name][] = array('crn'=> $crn, 'used_hrs' => $possible_qty*$blank_hrs,'mc_hrs'=> $avail_capacity);

			}
			else
			{

				$balance_mc_hrs=$avail_capacity;
				$balance_crn_hrs=round($req_crn_hrs-($possible_qty*$blank_hrs));  
			}

			$ff_qty = $possible_qty;
			$ff_hrs = ($ff_qty*$blank_hrs);
			$uf_hrs = ($balance_crn_qty*$blank_hrs);
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
		$uf_hrs = ($balance_crn_qty*$blank_hrs);

	}

	elseif($runtime_hrs == '')
	{

		$balance_mc_hrs=$avail_capacity; 
		$crn_usage_hrs[$mc_name][] = array('crn'=> $crn, 'used_hrs' => 0,'mc_hrs'=> $avail_capacity); 
		$ff_qty = 0; 
		$ff_hrs = ($ff_qty*$blank_hrs);
	}



	

	if(($prev_crn == $crn) && ($crn != '') && ($prev_month == $month)  && ($prev_operation== $operation) )
	{       
		$crn_qty1=$prev_balance_qty;           
	}
	else
	{   
		$crn_qty1=$crn_qty;         
	}

	if($st_date1 !='' && $st_date1!='0000-00-00' )
	{


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

			$perday_hrs=intval($mc_avail_hrs/(24*$shift_hr));
			$storesperreq = intval($ff_hrs/$perday_hrs);
			$days=intval($storesperreq/$shift_hr);
			$hours=$storesperreq%$shift_hr;

		}
		else
		{
			$days=intval($ff_hrs/24);
			$hours=$ff_hrs%24;
		}


		// if ($time24 =="" || $time24 == 0 || $time24 > 23)  
		// {
		//   	$time=0;
		//   	$time24=0;
		// }

		// $hours1 = $time24 + $hours;
		$hours1 = $hours;

		$days  = ($days + intval($hours1/24));

		$hours1 = ($hours1%24);

		$check=(0+$hours1);

		$end_time=$check; 

		$ed_time24 = $check; 
	}

	
	

	if ($prev_mc != $mc_name) 
	{
		$start_date = $st_date1;
		$time = "12 AM";
		$start_time_mrdn = "AM";
		$sttime_wo_mrdn =  "12";
		$start_time24 = "0";


		$date = date_create($start_date . $sttime_wo_mrdn.":00 " . $start_time_mrdn ) ;


		if ($days == 0 || $days == 1) 
		{
			
			if ($hours1 == 0 || $hours1 == 1) 
			{
				date_add($date, date_interval_create_from_date_string($days . ' day ' . $hours1 .  ' hour'));
			}
			else
			{
				date_add($date, date_interval_create_from_date_string($days . ' days ' . $hours1 .  ' hours'));
			}
		}
		else
		{
			if ($hours1 == 0 || $hours1 == 1) 
			{
				date_add($date, date_interval_create_from_date_string($days . ' days ' . $hours1 .  ' hour'));
			}
			else
			{

				date_add($date, date_interval_create_from_date_string($days . ' days ' . $hours1 .  ' hours'));
			}
		}


		$ed_st_date =  date_format($date, 'Y-m-d|H A'); 
		$ed_dt_split =  explode("|", $ed_st_date);
		$end_date = $ed_dt_split[0];
		$ed_time_split =  explode(" ", $ed_dt_split[1]);
		$edtime24 = $ed_time_split[0];
		$time24 = $start_time24;	

		// if ($time24[0] == '0') 
		// {
		// 	$time24 = $time24[1];
		// }

		$ed_time = (($ed_time_split[0] + 11) % 12 + 1);
		$end_time = $ed_time .' ' . $ed_time_split[1]  ;

		$end_time_split = explode(" ", $end_time);
		$end_time_mrdn = $end_time_split[1];
		$endtime_wo_mrdn = $end_time_split[0];

		$prevln_eddate = $end_date;
		$prevln_edtime = $end_time;
		$prevln_end_time_mrdn = $end_time_mrdn;
		$prevln_endtime_wo_mrdn = $endtime_wo_mrdn;
		$prevln_time24 = $edtime24;
		$prevln_sttime24 = $time24;



	}
	else
	{	
		
		$start_date = $prevln_eddate;
		$time = $prevln_edtime;
		$start_time_mrdn = $prevln_end_time_mrdn;
		$sttime_wo_mrdn =  $prevln_endtime_wo_mrdn;
		$time24 =  $prevln_time24;
		$start_time24 =  $prevln_sttime24;

		$eddate = date_create($start_date . $sttime_wo_mrdn.":00 " . $start_time_mrdn ) ;


		if ($days == 0 || $days == 1) 
		{
			
			if ($hours1 == 0 || $hours1 == 1) 
			{
				date_add($eddate, date_interval_create_from_date_string($days . ' day ' . $hours1 .  ' hour'));
			}
			else
			{
				date_add($eddate, date_interval_create_from_date_string($days . ' days ' . $hours1 .  ' hours'));
			}
		}
		else
		{
			if ($hours1 == 0 || $hours1 == 1) 
			{
				date_add($eddate, date_interval_create_from_date_string($days . ' days ' . $hours1 .  ' hour'));
			}
			else
			{
				
				date_add($eddate, date_interval_create_from_date_string($days . ' days ' . $hours1 .  ' hours'));
			}
		}


		$ed_st_date =  date_format($eddate, 'Y-m-d|H A'); 
		$ed_dt_split =  explode("|", $ed_st_date);
		$end_date = $ed_dt_split[0];

		$ed_time_split =  explode(" ", $ed_dt_split[1]);
		$edtime24 = $ed_time_split[0];

		$ed_time = (($ed_time_split[0] + 11) % 12 + 1);
		$end_time = $ed_time .' ' . $ed_time_split[1]  ;

		$end_time_split = explode(" ", $end_time);
		$end_time_mrdn = $end_time_split[1];
		$endtime_wo_mrdn = $end_time_split[0];

		$prevln_eddate = $end_date;
		$prevln_edtime = $end_time;
		$prevln_end_time_mrdn = $end_time_mrdn;
		$prevln_endtime_wo_mrdn = $endtime_wo_mrdn;
		$prevln_time24 = $edtime24;
		$prevln_sttime24 = $endtime_wo_mrdn;



	}


	if ($mc_name == $mcname_check) 
	{

		$mccap_arr[$mc_name][$schdate][$crn] = array('mcname' => $mc_name,
												'crn' => $crn,
												'mc_avail_hrs' => $mc_avail_hrs,
												'operation' => $operation,
												'schdate' => $schdate,
												'schqty' => $schqty,
												'fg_qty' => $fg_qty,
												'rej_qty' => $rej_qty,
												'crn_qty' => $totalfgqty,
												'wip_qty' => $wip_qty,
												'disp_qty' => $disp_qty,
												'grn_qty' => $grn_bal_qty,
												'runtime_hrs' => $runtime_hrs,
												'blank' => $blank,
												'ff_qty' =>$ff_qty,
												'uf_qty' =>$balance_crn_qty,
												'uf_qty' =>$balance_crn_qty,
												'req_crn_hrs' => $req_crn_hrs,
												'ff_qty_hrs' => $ff_hrs,
												'uf_qty_hrs' => $uf_hrs,
												'cf_qty_hrs' => $balance_mc_hrs,
												'start_date' => $start_date,
												'start_time' => $time,
												'start_time_meridian' => $start_time_mrdn,
												'sttime_wo_meridian' => $sttime_wo_mrdn,
												'end_date' => $end_date,
												'end_time' => $end_time,
												'end_time_meridian' => $end_time_mrdn,
												'endtime_wo_mrdn' => $endtime_wo_mrdn,
												'time24' => $time24,
												'units' => $avail_units,
												'shifts' => $avail_shift,
												'days' => $days,
												'mcavail_capacity' => $mcavail_capacity
												);
		// echo "time24 $time24 <br>";
		if ($time24 == 0) {
			$time24 == "00";
		}

		$datetime1 = new DateTime( $start_date.' '.$sttime_wo_mrdn.':00:00 '. $start_time_mrdn);
		$datetime2 = new DateTime($end_date.' '.$endtime_wo_mrdn.':00:00 '. $end_time_mrdn);
		$interval = $datetime1->diff($datetime2);
		$elapsed = $interval->format('%a Days & %h Hours ');

		// $elapsed = '';

		$mccap_month_arr[] = array('mcname' => $mc_name,
										'crn' => $crn,
										'mc_avail_hrs' => $mc_avail_hrs,
										'operation' => $operation,
										'schdate' => $schdate,
										'schqty' => $schqty,
										'crn_qty' => $totalfgqty,
										'start_date' => $start_date,
										'start_time' => $time,
										'start_time_meridian' => $start_time_mrdn,
										'sttime_wo_meridian' => $sttime_wo_mrdn,
										'end_date' => $end_date,
										'end_time' => $end_time,
										'end_time_meridian' => $end_time_mrdn,
										'endtime_wo_mrdn' => $endtime_wo_mrdn,
										'time24' => $time24,
										'end_time24' => $edtime24,
										'days' => $days,
										'timediff' => $elapsed,
										'mcavail_capacity' => $mcavail_capacity);

		
		$prev_avail_mc_hrs = $balance_mc_hrs;
		$prev_mc=$mc_name; 

	}
	else
	{		
		if($currentRow >= $rowCount)
		{
			

				$mccap_arr[$mc_name][$schdate][$crn] = array('mcname' => $mc_name,
												'crn' => $crn,
												'mc_avail_hrs' => $mc_avail_hrs,
												'operation' => $operation,
												'schdate' => $schdate,
												'schqty' => $schqty,
												'fg_qty' => $fg_qty,
												'rej_qty' => $rej_qty,
												'crn_qty' => $totalfgqty,
												'wip_qty' => $wip_qty,
												'disp_qty' => $disp_qty,
												'grn_qty' => $grn_bal_qty,
												'runtime_hrs' => $runtime_hrs,
												'blank' => $blank,
												'ff_qty' =>$ff_qty,
												'uf_qty' =>$balance_crn_qty,
												'uf_qty' =>$balance_crn_qty,
												'req_crn_hrs' => $req_crn_hrs,
												'ff_qty_hrs' => $ff_hrs,
												'uf_qty_hrs' => $uf_hrs,
												'cf_qty_hrs' => $balance_mc_hrs,
												'start_date' => $start_date,
												'start_time' => $time,
												'start_time_meridian' => $start_time_mrdn,
												'sttime_wo_meridian' => $sttime_wo_mrdn,
												'end_date' => $end_date,
												'end_time' => $end_time,
												'end_time_meridian' => $end_time_mrdn,
												'endtime_wo_mrdn' => $endtime_wo_mrdn,
												'time24' => $time24,
												'units' => $avail_units,
												'shifts' => $avail_shift,
												'days' => $days,
												'mcavail_capacity' => $mcavail_capacity
												);

			$datetime1 = new DateTime( $start_date.' '.$sttime_wo_mrdn.':00:00 '. $start_time_mrdn);
			$datetime2 = new DateTime($end_date.' '.$endtime_wo_mrdn.':00:00 '. $end_time_mrdn);
			$interval = $datetime1->diff($datetime2);
			$elapsed = $interval->format('%a Days & %h Hours ');
			// $elapsed = '';

			$mccap_month_arr[] = array('mcname' => $mc_name,
										'crn' => $crn,
										'mc_avail_hrs' => $mc_avail_hrs,
										'operation' => $operation,
										'schdate' => $schdate,
										'schqty' => $schqty,
										'crn_qty' => $totalfgqty,
										'start_date' => $start_date,
										'start_time' => $time,
										'start_time_meridian' => $start_time_mrdn,
										'sttime_wo_meridian' => $sttime_wo_mrdn,
										'end_date' => $end_date,
										'end_time' => $end_time,
										'end_time_meridian' => $end_time_mrdn,
										'endtime_wo_mrdn' => $endtime_wo_mrdn,
										'time24' => $time24,
										'end_time24' => $edtime24,
										'days' => $days,
										'timediff' => $elapsed,
										'mcavail_capacity' => $mcavail_capacity);
		}

		// echo "<pre>";
		// print_r($mccap_arr);



		$mcrows = 1;
		$total_ffhrs = 0;

		

		foreach ($mccap_arr as $mckey => $schdate_arr) 
		{	
			// echo "key $mckey <br>";	

			foreach ($schdate_arr as $datekey => $prnarr) {
				// echo "datekey $datekey <br>";

				// arsort($prnarr);

				foreach ($prnarr as $prnkey => $value) 
				{
					// echo "prnkey $prnkey <br>";	
					// echo "mcrows $mcrows <br>";

					if ($mcrows == 1) 
					{	
		
						echo "<div name=\"mc_main_div\" style=\"width: 100%;\">";

						echo"<div style=\"float: left; width: 80%;\">";

						echo "<table  class=\"stdtable1\"><tr><td align=\"center\" colspan=16 bgcolor=\"#99CCFF\" style=\"padding:5px;\"><center><span class=\"heading\"><b>M/C Name: ". $mckey . ",  Avail Capacity: ".$value['mc_avail_hrs']."</b></span></center></td></tr></table>";
					?>
						<table border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
							<tr bgcolor="#FFCC00">
								<td bgcolor="#FFA500"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>Avail. <br/>Cap <br/><?php echo $strokes_hrs; ?></b></span></td>
								<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>PRN</b></span></td>
								<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>Oper</b></span></td>
								<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b><br/>Sch<br/>Date</b></span></td>
								<td bgcolor="#00DDFF"  width='10px' style="text-align: center;"  rowspan='2'><span class="tabletext"><b>Sch <br>Qty</b></span></td>
								<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>Fg<br/>Qty</b></span></td>
								<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan="2"><span class="tabletext"><b>Rej<br/>Qty</b></span></td>
								<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>Rem<br/>Qty</b></span></td>
								<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>Wip<br/>Qty</b></span></td>
								<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>Disp<br>Qty</b></span></td>
								<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>GRN<br/>Qty</b></span></td>
								<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>RT/Ut<br/><?php echo $strokes_hrs; ?></b></span></td>
								<?php echo $parts_blank;?>
								<td bgcolor="#FFA500 "  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>FF<br/>Qty</b></span></td>
								<td bgcolor="#FFA500 "  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>UF<br/>Qty</b></span></td>
								<td bgcolor="#FFA500 "  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>Req <br/> <?php echo $strokes_hrs; ?></b></span></td>
								<td bgcolor="#FFA500 "  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>FF<br/><?php echo $strokes_hrs; ?></b></span></td>
								<td bgcolor="#FFA500 "  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>UF<br/><?php echo $strokes_hrs; ?></b></span></td>
								<td bgcolor="#FFA500 "  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>C/F<br/><?php echo $strokes_hrs; ?> </b></span></td>
								<td bgcolor="#FFFF00" width='35px'><span class="tabletext"><b>Mfg Start Date/Time&nbsp;&nbsp;&nbsp;&nbsp;</b></span></td>
							</tr>
							<tr>
								<td bgcolor="#FFFF00" width='25px'  ><span class="tabletext"><b>Mfg End Date/time</b></span></td>
							</tr>
					
					<?php
					}
					
						echo "<tr bgcolor=\"#FFCC00\"> ";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['mc_avail_hrs']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['crn']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['operation']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['schdate']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['schqty']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['fg_qty']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['rej_qty']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['crn_qty']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['wip_qty']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['disp_qty']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['grn_qty']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['runtime_hrs']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['ff_qty']."</span></td>";

						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['uf_qty']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['req_crn_hrs']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['ff_qty_hrs']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['uf_qty_hrs']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$value['cf_qty_hrs']."</span></td>";

						echo "<td bgcolor=\"#FFFFCC\"  align=\"center\" width=\"35px\"><span class=\"tabletext\"><input type=\"text\" name=\"start_date$i\" id=\"start_date$i\" size=9 value=\"$value[start_date]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onClick=\"GetDate('start_date$i')\">&nbsp;&nbsp;&nbsp;<input type=\"tex\"  name=\"time$i\"  id=\"time$i\" size=4 value=\"$value[start_time]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">
							<select name=\"time_sel$i\" id=\"time_sel$i\" onchange=\"onSelecttime($i)\">
							<option value=\"select\">Select</option> ";

							for($s = 0; $s < 24 ; $s++)  
							{ 
							
								switch ($s)  
								{ 
								
									case 0; 
									echo "<option value=\"$s\""; 
									if ($value['time24'] == $s) { echo " selected='selected'"; } 
									echo "> 12 AM\n"; 
									break; 

									case 12: 
									echo "<option value=\"$s\""; 
									if ($value['time24'] == $s) { echo " selected='selected'"; } 
									echo "> 12 PM\n"; 
									break; 

									case ($s < 13): 
									echo "    <option value=\"$s\""; 
									if ($value['time24'] == $s) { echo " selected='selected'"; } 
									echo "> $s AM\n"; 
									break; 

									case ($s > 12); 
									echo "    <option value=\"$s\""; 
									if ($value['time24'] == $s) { echo " selected='selected'"; } 
									echo "> " . ($s-12) . " PM\n"; 
									break; 

								} 
							} 
						echo "</select> </td>";

						echo "</tr>";
					
						echo "<tr>";
							echo "<td bgcolor=\"#FFFFCC\"   width=\"10px\"><span class=\"tabletext\" style=\"margin-left: 40px;\"><input type=\"text\" name=\"end_date$i\" id=\"end_date$i\" size=9 value=\"$value[end_date]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"tex\"  name=\"ed_time$i\"  id=\"ed_time$i\" size=4 value=\"$value[end_time]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
						echo "</tr>";


						echo "<input type=\"hidden\"  name=\"mc_avail_hrs$i\" id=\"mc_avail_hrs$i\" value=\"".$value['mc_avail_hrs']."\"   >";
						echo "<input type=\"hidden\" name=\"schqty_$i\" id=\"schqty_$i\" value=\"".$value['schqty']."\">";
						echo "<input type=\"hidden\" name=\"schedule_date_$i\" id=\"schedule_date_$i\" value=\"".$value['schdate']."\">";
						echo "<input type=\"hidden\" name=\"fg_qty_$i\" id=\"fg_qty_$i\" value=\"".$value['fg_qty']."\">";
						echo "<input type=\"hidden\" name=\"rej_qty_$i\" id=\"rej_qty_$i\" value=\"".$value['rej_qty']."\">";
						echo "<input type=\"hidden\" name=\"totalfgqty_$i\" id=\"totalfgqty_$i\" value=\"".$value['crn_qty']."\">";
						echo "<input type=\"hidden\" size=4  name=\"req_crn_qty$i\" id=\"req_crn_qty$i\"  value=\"".$value['wip_qty']."\"  >";
						echo "<input type=\"hidden\" name=\"grnqty_$i\" id=\"grnqty_$i\" value=\"".$value['grn_qty']."\">";
						echo "<input type=\"hidden\"   name=\"req_rt_perunit$i\" id=\"req_rt_perunit$i\" value=\"".$value['runtime_hrs']."\" >";
						echo "<input type=\"hidden\" name=\"blank$i\" id=\"blank$i\" value=\"".$value['blank']."\" >";
						echo"<input type=\"hidden\"  name=\"ff_qty$i\" id=\"ff_qty$i\" value=\"".$value['ff_qty']."\" >";
						echo"<input type=\"hidden\"  name=\"balance_crn_qty$i\" id=\"balance_crn_qty$i\" value=\"".$value['uf_qty']."\" >";
						echo"<input type=\"hidden\"  name=\"req_crn_hrs$i\" id=\"req_crn_hrs$i\" value=\"".$value['req_crn_hrs']."\" >";
						echo"<input type=\"hidden\"  name=\"ff_qty_hrs$i\" id=\"ff_qty_hrs$i\" value=\"".$value['ff_qty_hrs']."\" >";
						echo"<input type=\"hidden\"  name=\"balance_crn_hrs$i\" id=\"balance_crn_hrs$i\" value=\"".$value['uf_qty_hrs']."\" >";
						echo"<input type=\"hidden\"  name=\"balance_mc_hrs$i\" id=\"balance_mc_hrs$i\" value=\"".$value['cf_qty_hrs']."\" >";
						echo "<input type=\"hidden\" size=2  name=\"units$i\" id=\"units$i\"   value=\"".$value['units']."\"  >";
						echo "<input type=\"hidden\" size=2  name=\"shift$i\" id=\"shift$i\"   value=\"".$value['shifts']."\"  >";
						echo "<input type=\"hidden\" name=\"crn_$i\" id=\"crn_$i\" value=\"".$value['crn']."\">";
						echo "<input type=\"hidden\" name=\"operation_$i\" id=\"operation_$i\" value=\"".$value['operation']."\">";
						echo "<input type=\"hidden\" name=\"mc_name$i\" id=\"mc_name$i\" value=\"".$mckey."\">";
						echo "<input type=\"hidden\" name=\"days$i\" id=\"days$i\" value=\"".$value['operation']."\">";
						echo "<input type=\"hidden\" name=\"priority$i\" id=\"priority$i\" value=\"\">";

						echo "<input type=\"hidden\" name=\"start_time_meridian$i\" id=\"start_time_meridian$i\" value=\"".$value['start_time_meridian']."\">";
						echo "<input type=\"hidden\" name=\"sttime_wo_meridian$i\" id=\"sttime_wo_meridian$i\" value=\"".$value['sttime_wo_meridian']."\">";
						echo "<input type=\"hidden\" name=\"end_time_meridian$i\" id=\"end_time_meridian$i\" value=\"".$value['end_time_meridian']."\">";
						echo "<input type=\"hidden\" name=\"endtime_wo_mrdn$i\" id=\"endtime_wo_mrdn$i\" value=\"".$value['endtime_wo_mrdn']."\">";
						echo "<input type=\"hidden\" name=\"mcavail_capacity$i\" id=\"mcavail_capacity$i\" value=\"".$value['mcavail_capacity']."\">";
						echo "<input type=\"hidden\" name=\"time24_$i\" id=\"time24_$i\" value=\"".$value['time24']."\">";
						echo "<input type=\"hidden\" name=\"wip_qty$i\" id=\"wip_qty$i\" value=\"".$value['wip_qty']."\">";
						echo "<input type=\"hidden\" name=\"disp_qty$i\" id=\"disp_qty$i\" value=\"".$value['disp_qty']."\">";

					$total_ffhrs += $value['ff_qty_hrs'];

						


					$mcrows++;
					$i++;	
				}
			}	
			echo "<tr><td colspan=7 bgcolor=\"#FFFFFF\"><b>Avail Mc ". $value['units'] . " " .$value['mcavail_capacity'] . "</b></td>
				  <td colspan=7 bgcolor=\"#FFFFFF\"><b>Total FF ". $value['units']. " " . $total_ffhrs . "</b></td>
				  <td colspan=7 bgcolor=\"#FFFFFF\"><b>Remaining Mc ". $value['units'] . " " . ($value['mcavail_capacity'] - $total_ffhrs ). "</b></td>
				</tr>";

				

			echo "</table>";
			echo "</div>";

			
			echo "<script type=\"text/javascript\"> 
                  $(document).ready(function()
                  { 
                    var chart = " . $chart ." 
                    var mc = '" . $value['mcname'] . "'
                    var mc_hrs = '" . $value['mcavail_capacity'] . "'
                    drawChart(chart,mc,mc_hrs); 
                  });
                </script>";

			echo "<div style=\"float: right; margin-top: 30px; width: 20%;\">
	          <canvas id=\"myChart$chart\" ></canvas>
	        </div>";
	        echo "<div style=\"clear:both;\"></div>";
			echo "</div>";

			echo "<br>";

			?>




			<?php
			$chart++;
		}
		
		// echo "<pre>";
		// print_r($mccap_month_arr);
		
		?>	

		
		<div style ="width:65% !important;">
			<table  class="stdtable1">
				<tr>
					<td align="center" colspan=16 bgcolor="#99CCFF" style="padding:5px;"><center><span class="heading"><b>Summary CRP Plan for <?php echo $month_names[$month] .', '. $year; ?></b></span></center>
					</td>
				</tr>
				<tr>
					<td bgcolor="#FFA500"  width='10px' style="text-align: center;" ><span class="tabletext"><b>M/C Name</b></span></td>
					<td bgcolor="#FFA500"  width='10px' style="text-align: center;" ><span class="tabletext"><b>Avail. <br/>Cap </b></span></td>
					<td bgcolor="#FFA500"  width='10px' style="text-align: center;" ><span class="tabletext"><b>PRN</b></span></td>
					<td bgcolor="#FFA500"  width='10px' style="text-align: center;" ><span class="tabletext"><b>Total Days & hours</b></span></td>
					<td bgcolor="#FFA500"  width='10px' style="text-align: center;" ><span class="tabletext"><b>Start Date </b></span></td>
					<td bgcolor="#FFA500"  width='10px' style="text-align: center;" ><span class="tabletext"><b>Start Time</b></span></td>
					<td bgcolor="#FFA500"  width='10px' style="text-align: center;" ><span class="tabletext"><b>End Date</b></span></td>
					<td bgcolor="#FFA500"  width='10px' style="text-align: center;" ><span class="tabletext"><b>End Time</b></span></td>
				</tr>
				<?php 
					foreach ($mccap_month_arr as $mckey => $value) 
					{	
						echo "<tr bgcolor=\"#FFCC00\"> ";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" width='10px' ><span class=\"tabletext\">".$value['mcname']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\"  width='10px' ><span class=\"tabletext\">".$value['mc_avail_hrs']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\"  width='10px' ><span class=\"tabletext\">".$value['crn']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\"  width='10px' ><span class=\"tabletext\">".$value['timediff']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\"  width='10px' ><span class=\"tabletext\">".$value['start_date']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\"  width='10px' ><span class=\"tabletext\">".$value['start_time']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\"  width='10px' ><span class=\"tabletext\">".$value['end_date']."</span></td>";
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\"  width='10px' ><span class=\"tabletext\">".$value['end_time']."</span></td>";
						echo "</tr>";
					}
				?>
			</table>
		</div>

		<table  class="stdtable1"><tr><td align="center" colspan=16 bgcolor="#99CCFF\" style="padding:5px;"><center><span class="heading"><b>CRP Plan for <?php echo $month_names[$month] .', '. $year; ?></b></span></center></td></tr></table>

		<table width=80% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

		<?php
			$no_of_days_month = cal_days_in_month(CAL_GREGORIAN, $month, $year); 
			for ($tr = 0; $tr <= $no_of_days_month; $tr++) 
			{
				echo "<tr >";

				if($tr == 0)
				{	
					echo "<td bgcolor=\"#FFFFFF\" align=\"center\" width='10px' ><span class=\"tabletext\"> Time  <hr> Days </span></td>";

					for ($td = 0; $td < 24; $td++) 
					{ 
						
						switch ($td)  
						{	
							
							case 0;
								echo "<td bgcolor=\"#00DDFF\" align=\"center\" width='10px' ><span class=\"tabletext\">12 AM  </span></td>";
							break;

							case 12;
								echo "<td bgcolor=\"#00DDFF\" align=\"center\" width='10px' ><span class=\"tabletext\">12 PM</span></td>";
							break;

							case ($td < 13):
								echo "<td bgcolor=\"#00DDFF\" align=\"center\" width='10px' ><span class=\"tabletext\">$td AM</span></td>";
							break;

							case ($td > 12):
								echo "<td bgcolor=\"#00DDFF\" align=\"center\" width='10px' ><span class=\"tabletext\">".($td-12) ." PM </span></td>";
							break; 
						}
						
					}
				}
				else if ($tr > 0) 
				{
					if ($tr < 10) 
					{
						$monthdate = '0'.$tr;
					}
					else
					{
						$monthdate = $tr;
					}

					$curr_date = $year.'-'.$month.'-'. $monthdate;

					echo "<td bgcolor=\"#FFA500\" align=\"center\" width='10px' ><span class=\"tabletext\">$month_names[$month] $tr </span></td>";

					for ($td = 0; $td < 24; $td++) 
					{
	
						echo "<td bgcolor=\"#FFFFFF\" align=\"center\" width='10px' >";
						$cnt = 1;
						foreach ($mccap_month_arr as $mckey => $value) 
						{
							// echo "count $cnt <br>";
							$datediff = $newmc_capacity->check_in_range($value['start_date'], $value['end_date'], $curr_date);
							if ($datediff == 1) 
							{	
								if ($curr_date == $value['end_date']) 
								{

									if ($td >= $value['time24'] && $td < $value['end_time24']) 
									{
										

										echo "<span class=\"tabletext\">".$value['crn'].' '."(".$value['crn_qty'].") </span>";
										
									}
									elseif ($value['end_time24'] == $td) 
									{
										echo "<span class=\"tabletext\" style=\"background-color: green;\">".$value['crn'].' '."(".$value['crn_qty'].")<br> </span>";
									}
									else
									{
										if ($td < $value['end_time24'] ) 
										{
											echo "<span class=\"tabletext\">".$value['crn'].' '."(".$value['crn_qty'].") </span>";
										}
									}

								
								}
								else
								{	
									if ($curr_date == $value['start_date']) 
									{
										if ($td == $value['time24']) 
										{
											echo "<span class=\"tabletext\" style=\"background-color: #c047ab;\">".$value['crn'].' '."(".$value['crn_qty'].") </span>";
										}
										else
										{	
											if ($td < $value['time24']) 
											{
												echo "<span class=\"tabletext\"></span>";
											}
											else
											{
												echo "<span class=\"tabletext\">".$value['crn'].' '."(".$value['crn_qty'].") </span>";
											}
											
										}
									}
									else
									{
										echo "<span class=\"tabletext\">".$value['crn'].' '."(".$value['crn_qty'].") </span>";
									}
									
									
								}
								
								
							}
							else
							{	
								echo "<span class=\"tabletext\"></span>";
							}

							$cnt++;
						}
						echo "</td>";
						
					}

				}
					

				echo "</tr>";
			}	

		?>

		</table>

		<?php
		unset($mccap_arr);
		unset($mccap_month_arr);
		
		$mccap_arr = array();
		$mccap_month_arr = array();

		$mccap_arr[$mc_name][$schdate][$crn] = array('mcname' => $mc_name,
												'crn' => $crn,
												'mc_avail_hrs' => $mc_avail_hrs,
												'operation' => $operation,
												'schdate' => $schdate,
												'schqty' => $schqty,
												'fg_qty' => $fg_qty,
												'rej_qty' => $rej_qty,
												'crn_qty' => $totalfgqty,
												'wip_qty' => $wip_qty,
												'disp_qty' => $disp_qty,
												'grn_qty' => $grn_bal_qty,
												'runtime_hrs' => $runtime_hrs,
												'blank' => $blank,
												'ff_qty' =>$ff_qty,
												'uf_qty' =>$balance_crn_qty,
												'uf_qty' =>$balance_crn_qty,
												'req_crn_hrs' => $req_crn_hrs,
												'ff_qty_hrs' => $ff_hrs,
												'uf_qty_hrs' => $uf_hrs,
												'cf_qty_hrs' => $balance_mc_hrs,
												'start_date' => $start_date,
												'start_time' => $time,
												'start_time_meridian' => $start_time_mrdn,
												'sttime_wo_meridian' => $sttime_wo_mrdn,
												'end_date' => $end_date,
												'end_time' => $end_time,
												'end_time_meridian' => $end_time_mrdn,
												'endtime_wo_mrdn' => $endtime_wo_mrdn,
												'time24' => $time24,
												'units' => $avail_units,
												'shifts' => $avail_shift,
												'days' => $days,
												'mcavail_capacity' => $mcavail_capacity
												);
		$datetime1 = new DateTime( $start_date.' '.$sttime_wo_mrdn.':00:00 '. $start_time_mrdn);
		$datetime2 = new DateTime($end_date.' '.$endtime_wo_mrdn.':00:00 '. $end_time_mrdn);
		$interval = $datetime1->diff($datetime2);
		$elapsed = $interval->format('%a Days & %h Hours ');
		// $elapsed = '';


		$mccap_month_arr[] = array('mcname' => $mc_name,
										'crn' => $crn,
										'mc_avail_hrs' => $mc_avail_hrs,
										'operation' => $operation,
										'schdate' => $schdate,
										'schqty' => $schqty,
										'crn_qty' => $totalfgqty,
										'start_date' => $start_date,
										'start_time' => $time,
										'start_time_meridian' => $start_time_mrdn,
										'sttime_wo_meridian' => $sttime_wo_mrdn,
										'end_date' => $end_date,
										'end_time' => $end_time,
										'end_time_meridian' => $end_time_mrdn,
										'endtime_wo_mrdn' => $endtime_wo_mrdn,
										'time24' => $time24,
										'end_time24' => $edtime24,
										'days' => $days,
										'timediff' => $elapsed,
										'mcavail_capacity' => $mcavail_capacity);

		
		
		$prev_avail_mc_hrs = $balance_mc_hrs;
		$prev_mc=$mc_name;

		
	}

	$mcname_check == $mc_name;


}

// echo "i value is $i <br>";

echo "<input type=\"hidden\" name=\"max_val\" id=\"max_val\" value=\"$i\">";
echo "</table>";
echo "</td></tr>";

	if($subvalue == "SAVE")
	{	
		
		$licnt = $i;
		$j = 1;
		while ( $j < $i) 
		{
		
			$mc_id = "mc_id".$j;
			$mc_name = "mc_name".$j;
			$crn = "crn_".$j;
			$mc_avail_hrs = "mc_avail_hrs".$j;
			$schqty = "schqty_".$j;
			$schedule_date = "schedule_date_".$j;
			$fg_qty = "fg_qty_".$j;
			$rej_qty = "rej_qty_".$j;
			$totalfgqty = "totalfgqty_".$j;
			$req_crn_qty = "req_crn_qty".$j;
			$grnqty = "grnqty_".$j;
			$req_rt_perunit = 'req_rt_perunit'.$j;
			$blank = 'blank'.$j;
			$ff_qty = 'ff_qty'.$j;
			$balance_crn_qty = 'balance_crn_qty'.$j;
			$req_crn_hrs = 'req_crn_hrs'.$j;
			$ff_qty_hrs = 'ff_qty_hrs'.$j;
			$balance_crn_hrs = 'balance_crn_hrs'.$j;
			$balance_mc_hrs = 'balance_mc_hrs'.$j;
			$units = 'units'.$j;
			$shift = 'shift'.$j;
			$operation = 'operation_'.$j;
			$days = 'days'.$j;
			$start_date = 'start_date'.$j;
			$start_time = 'time'.$j;
			$start_time_meridian = 'start_time_meridian'.$j;
			$sttime_wo_meridian = 'sttime_wo_meridian'.$j;

			$end_date = 'end_date'.$j;
			$ed_time = 'ed_time'.$j;
			$end_time_meridian = 'end_time_meridian'.$j;
			$endtime_wo_mrdn = 'endtime_wo_mrdn'.$j;
			$mcavail_capacity = 'mcavail_capacity'.$j;
			$priority = 'priority'.$j;
			$time24 = 'time24_'.$j;
			$wip_qty = 'wip_qty_'.$j;
			$disp_qty = 'disp_qty_'.$j;

			$mc_id = $_REQUEST[$mc_id];
			$mc_name = $_REQUEST[$mc_name];
			$crn = $_REQUEST[$crn];
			$mc_avail_hrs = $_REQUEST[$mc_avail_hrs];
			$schqty = $_REQUEST[$schqty];
			$schedule_date = $_REQUEST[$schedule_date];
			$fg_qty = $_REQUEST[$fg_qty];
			$rej_qty = $_REQUEST[$rej_qty];
			$totalfgqty = $_REQUEST[$totalfgqty];
			$req_crn_qty = $_REQUEST[$req_crn_qty];
			$grnqty = $_REQUEST[$grnqty];
			$req_rt_perunit = $_REQUEST[$req_rt_perunit];
			$blank = $_REQUEST[$blank];
			$ff_qty = $_REQUEST[$ff_qty];
			$balance_crn_qty = $_REQUEST[$balance_crn_qty];
			$req_crn_hrs = $_REQUEST[$req_crn_hrs];
			$ff_qty_hrs = $_REQUEST[$ff_qty_hrs];
			$balance_crn_hrs = $_REQUEST[$balance_crn_hrs];
			$balance_mc_hrs = $_REQUEST[$balance_mc_hrs];
			$units = $_REQUEST[$units];
			$shift = $_REQUEST[$shift];
			$operation = $_REQUEST[$operation];
			$days = $_REQUEST[$days];
			$start_date = $_REQUEST[$start_date];
			$start_time = $_REQUEST[$start_time];
			$start_time_meridian = $_REQUEST[$start_time_meridian];
			$sttime_wo_meridian = $_REQUEST[$sttime_wo_meridian];

			$end_date = $_REQUEST[$end_date];
			$ed_time = $_REQUEST[$ed_time];
			$end_time_meridian = $_REQUEST[$end_time_meridian];
			$endtime_wo_mrdn = $_REQUEST[$endtime_wo_mrdn];
			$mcavail_capacity = $_REQUEST[$mcavail_capacity];
			$priority = $_REQUEST[$priority];
			$time24 = $_REQUEST[$time24];
			$wip_qty = $_REQUEST[$wip_qty];
			$disp_qty = $_REQUEST[$disp_qty];

			$month = $month;
			$year = $year;

			$newmc_capacity->setmc_id($mc_id);
			$newmc_capacity->setmc_name($mc_name);
			$newmc_capacity->setmc_series($mc_name);
			$newmc_capacity->setplan_month($month);
			$newmc_capacity->setplan_year($year);
			$newmc_capacity->setcrnnum($crn);
			$newmc_capacity->setmc_avail_hrs($mc_avail_hrs);
			$newmc_capacity->setmc_cap_hrs($mcavail_capacity);
			$newmc_capacity->setsch_schqty($schqty);
			$newmc_capacity->setschedule_date($schedule_date);
			$newmc_capacity->setfgqty($fg_qty);
			$newmc_capacity->setrejqty($rejqty);
			$newmc_capacity->settotalfgqty($totalfgqty);
			$newmc_capacity->setcrn_qty($schqty);
			$newmc_capacity->setgrn_qty($grnqty);
			$newmc_capacity->setruntime_units($req_rt_perunit);
			$newmc_capacity->setpartsperblank($blank);
			$newmc_capacity->setff_qty($ff_qty);
			$newmc_capacity->setbalance_crn_qty($balance_crn_qty);
			$newmc_capacity->setreq_crn_hrs($req_crn_hrs);
			$newmc_capacity->setff_qty_hrs($ff_qty_hrs);
			$newmc_capacity->setbalance_crn_hrs($balance_crn_hrs);
			$newmc_capacity->setbalance_mc_hrs($balance_mc_hrs);
			$newmc_capacity->setunits($units);
			$newmc_capacity->setshift($shift);
			$newmc_capacity->setoperation($operation);
			$newmc_capacity->setstart_date($start_date);
			$newmc_capacity->setstart_time($sttime_wo_meridian);
			$newmc_capacity->setstart_time_meridiem($start_time_meridian);
			$newmc_capacity->setend_date($end_date);
			$newmc_capacity->setend_time($endtime_wo_mrdn);
			$newmc_capacity->setend_time_meridiem($end_time_meridian);
			$newmc_capacity->setpriority($priority); 
			$newmc_capacity->settime24($time24); 
			$newmc_capacity->setwip_qty($wip_qty); 
			$newmc_capacity->setdisp_qty($disp_qty); 

			// $newmc_capacity->setdept($dept);        

			$insert_res = $newmc_capacity->addcapacity_plan(); 
			$j++;
		}
	}

// echo "<pre>";
// print_r($mccap_arr);


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
		$crn_qty = $mycapplan['crn_qty'];
		$req_qty = $mycapplan['crn_qty'];
		$crn_qty = $mycapplan['crn_qty'];
		$start_date = $mycapplan['start_date'];
		$time = $mycapplan['start_time'];

		$req_crn_hrs = $mycapplan['req_crn_hrs'];
		$runtime_hrs = $mycapplan['runtime_units'];
		$uf_qty_hrs = $mycapplan['balance_crn_hrs'];
		$uf_qty = $mycapplan['balance_crn_qty'];
		$cf_qty_hrs = $mycapplan['balance_mc_hrs'];
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
		$fgqty = $mycapplan['fgqty'];
		$rej_qty = $mycapplan['rej_qty'];
		$totalfgqty = $mycapplan['totalfgqty'];
		$grn_qty = $mycapplan['grn_qty'];

		$ff_qty = $mycapplan['ff_qty'];
		$ff_qty_hrs = $mycapplan['ff_qty_hrs'];
		$wip_qty = $mycapplan['wip_qty'];
		$disp_qty = $mycapplan['disp_qty'];
		$time24 = $mycapplan['time24'];

		if ($units == "strokes") {
			$strokes_hrs = "Strs.";
		}else{
			$strokes_hrs = "Hrs.";
		}


		$crn_usage_hrs[$mc_name][] = array('crn'=> $crn, 'used_hrs' => $ff_qty_hrs,'mc_hrs'=> $mc_avail_hrs);


		if ($prev_mc != $mc_name ) 
		{

			
			if($prev_mc !='')
			{

		    	echo "<tr><td colspan=7 bgcolor=\"#FFFFFF\"><b>Avail Mc ". $units . " " .$first_mc_avail_hrs . "</b></td>
					  	<td colspan=7 bgcolor=\"#FFFFFF\"><b>Total FF ". $strokes_hrs. " " . $total_ffhrs . "</b></td>
					  	<td colspan=7 bgcolor=\"#FFFFFF\"><b>Remaining Mc ". $strokes_hrs. " " .  ($first_mc_avail_hrs - $total_ffhrs ). "</b></td>
					</tr>

				</table>";
				echo "</div>";

				echo'<script type="text/javascript"> 
					$(document).ready(function()
					{	
						var chart = ' . $chart .' 
						var mc = "' . $first_mcname . '"
						var mc_hrs = "' . $first_mc_avail_hrs . '"
						drawChart1(chart,mc,mc_hrs); 
					});
				</script>';

				echo "<div style=\"float: right;  width: 20%;\">
			          		<canvas id=\"myChart$chart\" ></canvas>
				        </div>";

		        echo "<div style=\"clear:both;\"></div>";
				echo "</div>";
				echo "</br>";
				echo "</br>";

				$total_ffhrs = 0;
				$chart++;
			}
			else
			{
				$first_mcname = $mc_name;
				$first_mc_avail_hrs = $mc_avail_hrs;
				// $first_mcname = $mc_name;


			}

			$availmchrs = $mc_avail_hrs;

			echo "<div name=\"mc_main_div\" style=\"width: 100%;\">";
			
			echo"<div style=\"float: left; width: 80%;\">";

			echo "<table class=\"stdtable1\"><tr><td align=\"center\" colspan=16 bgcolor=\"#99CCFF\" style=\"padding:5px;\"><center><span class=\"heading\"><b>M/C Name: ". $mc_name . ",  Avail Capacity: ".$mc_avail_hrs."</b></span></center></td></tr></table>";
			?>

			<table width=80% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
				<tr bgcolor="#FFCC00">
					<td bgcolor="#FFA500"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>Avail. <br/>Cap <br/><?php echo $strokes_hrs; ?></b></span></td>
					<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>PRN</b></span></td>
					<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>Oper</b></span></td>
					<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b><br/>Sch<br/>Date</b></span></td>
					<td bgcolor="#00DDFF"  width='10px' style="text-align: center;"  rowspan='2'><span class="tabletext"><b>Sch <br>Qty</b></span></td>
					<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>Fg<br/>Qty</b></span></td>
					<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan="2"><span class="tabletext"><b>Rej<br/>Qty</b></span></td>
					<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>Rem<br/>Qty</b></span></td>
					<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>Wip<br/>Qty</b></span></td>
					<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>Disp<br>Qty</b></span></td>
					<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>GRN<br/>Qty</b></span></td>
					<td bgcolor="#00DDFF"  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>RT/Ut<br/><?php echo $strokes_hrs; ?></b></span></td>
					<?php echo $parts_blank;?>
					<td bgcolor="#FFA500 "  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>FF<br/>Qty</b></span></td>
					<td bgcolor="#FFA500 "  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>UF<br/>Qty</b></span></td>
					<td bgcolor="#FFA500 "  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>Req <br/> <?php echo $strokes_hrs; ?></b></span></td>
					<td bgcolor="#FFA500 "  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>FF<br/><?php echo $strokes_hrs; ?></b></span></td>
					<td bgcolor="#FFA500 "  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>UF<br/><?php echo $strokes_hrs; ?></b></span></td>
					<td bgcolor="#FFA500 "  width='10px' style="text-align: center;" rowspan='2'><span class="tabletext"><b>C/F<br/><?php echo $strokes_hrs; ?> </b></span></td>
					<td bgcolor="#FFFF00" width='35px'><span class="tabletext"><b>Mfg Start Date/Time&nbsp;&nbsp;&nbsp;&nbsp;</b></span></td>
				</tr>
				<tr>
					<td bgcolor="#FFFF00" width='25px'  ><span class="tabletext"><b>Mfg End Date/time</b></span></td>
				</tr>
			
		<?php

		}
		
			echo "<tr bgcolor=\"#FFCC00\"> ";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$mc_avail_hrs."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$crn."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$operation."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$schdate."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$crn_qty."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$fgqty."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$rej_qty."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$schqty."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$wip_qty."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$disp_qty."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$grn_qty."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$runtime_hrs."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$ff_qty."</span></td>";

			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$uf_qty."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$req_crn_hrs."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$ff_qty_hrs."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$uf_qty_hrs."</span></td>";
			echo "<td bgcolor=\"#FFFFFF\" align=\"center\" rowspan='2' width='10px' ><span class=\"tabletext\">".$cf_qty_hrs."</span></td>";
		
			echo "<td bgcolor=\"#FFFFCC\"  align=\"center\" width=\"35px\"><span class=\"tabletext\"><input type=\"text\" name=\"start_date$i\" id=\"start_date$i\" size=9 value=\"$start_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onClick=\"GetDate('start_date$i')\">&nbsp;&nbsp;&nbsp;<input type=\"tex\"  name=\"time$i\"  id=\"time$i\" size=4 value=\"$st_meri\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">
				<select name=\"time_sel$i\" id=\"time_sel$i\" onchange=\"onSelecttime($i)\">
					<option value=\"select\">Select</option>";

				for($s = 0; $s < 24 ; $s++)  
				{ 
				
					switch ($s)  
					{ 
					
						case 0; 
						echo "<option value=\"$s\""; 
						if ($time24 == $s) { echo " selected='selected'"; } 
						echo "> 12 AM\n"; 
						break; 

						case 12: 
						echo "<option value=\"$s\""; 
						if ($time24 == $s) { echo " selected='selected'"; } 
						echo "> 12 PM\n"; 
						break; 

						case ($s < 13): 
						echo "    <option value=\"$s\""; 
						if ($time24 == $s) { echo " selected='selected'"; } 
						echo "> $s AM\n"; 
						break; 

						case ($s > 12); 
						echo "    <option value=\"$s\""; 
						if ($time24 == $s) { echo " selected='selected'"; } 
						echo "> " . ($s-12) . " PM\n"; 
						break; 

					} 
				} 
			echo "</select> </td>";
			
			echo "</tr>";

			echo "<tr>";
			echo "<td bgcolor=\"#FFFFCC\"  width=\"10px\"><span class=\"tabletext\" style=\"margin-left: 40px;\"><input type=\"text\" size=9  name=\"end_date$i\" id=\"end_date$i\" value=\"$end_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span><span class=\"tabletext\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" size=4  name=\"ed_time$i\" id=\"ed_time$i\" value=\"$ed_meri\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";
			echo "</tr>";


		$prev_mc = $mc_name;
		$total_ffhrs += $ff_qty_hrs;

		$i++;


	}

	echo "<tr><td colspan=7 bgcolor=\"#FFFFFF\"><b>Avail Mc ". $strokes_hrs. " " . $availmchrs . "</b></td>
			  <td colspan=7 bgcolor=\"#FFFFFF\"><b>Total FF ". $strokes_hrs. " " . $total_ffhrs . "</b></td>
			  <td colspan=7 bgcolor=\"#FFFFFF\"><b>Remaining Mc ". $strokes_hrs. " " .  ($availmchrs - $total_ffhrs ). "</b></td>
			</tr>";

	echo "</table>";

	echo "</div>";

	echo'<script type="text/javascript"> 
		$(document).ready(function()
		{	
			var chart = ' . $chart .' 
			var mc = "' . $mc_name . '"
			var mc_hrs = "' . $mc_cap_hrs . '"
			drawChart1(chart,mc,mc_hrs); 
		});
	</script>';

	echo "<div style=\"float: right;  width: 20%;\">
          		<canvas id=\"myChart$chart\" ></canvas>
	        </div>";

    echo "<div style=\"clear:both;\"></div>";
	echo "</div>";
	

	
	// echo "<pre>";
	// print_r($crn_usage_hrs); 

	?>
	<input type="hidden" name="chart_det" id="chart_det"  value='<?php echo json_encode($crn_usage_hrs); ?>'>
	
	<script type="text/javascript">

		function drawChart1(i,mc_name, mchrs)
		{
			console.log("mc hrs " + mchrs);
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