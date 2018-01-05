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


$page = "MES: RCCP";
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

if(isset($_REQUEST['start_dt'])){
	$start_dt = $_REQUEST['start_dt'];
}else{
	$start_dt = "01";
}

if(isset($_REQUEST['crnnum'])){
$crnnum = $_REQUEST['crnnum'];
}else{
$crnnum = "";
}


$st_date1 = $to."-".$frm."-".$start_dt;
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

<title>RCCP</title>


<style type="text/css">
	
	.mainleft { width: 140px !important; }

</style>

<?php
include('header.html');
?>
<form action='capacity_rccp.php' method='POST' enctype='multipart/form-data'>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>RCCP</b></center></span></td>
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

<td><span class="heading"><b>Start Date </b></span> <br />
	<select name="start_dt" id="start_dt" >
	<option value="select" disabled="disabled" >Select</option>
	<?php 
	for ($j = 1; $j < 32 ; $j++) 
	{
		if ($j < 10) 
        {
          	$j = "0".$j;
        }
	?>
	  <option <?php echo (($start_dt == $j)?"selected":"")?> value="<?php echo $j; ?>"><?php echo $j; ?></option>  
	<?php
	}
	?>
	</select>
</td>

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
        
  	</select>
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
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="labeltext">
<input type="submit" name="Submit"  value="Get" onclick="javascript: return fetch_cap_req()">

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



if (($numrows == 0) && $subvalue != "SAVE") 
{ ?>


<tr>
<td>
<table width=80% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFCC00">
<td bgcolor="#FFA500" width='10px' rowspan="2"><span class="tabletext"><b>M/C</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan="2" ><span class="tabletext"><b>PRN</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan="2" ><span class="tabletext"><b>Avail Cap </b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan="2" ><span class="tabletext"><b>Req Cap</b></span></td>
<td bgcolor="#00DDFF" width='10px' rowspan="2"><span class="tabletext"><b>Over / Under</b></span></td>
</tr>
</table>
</td>
<table width=80% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFCC00">
<td bgcolor="#FFFFFF" width='10px' rowspan="2"><span class="tabletext"><b>There is no reccords for Selected Date and Month</b></span></td>
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

// echo "<pre>";
// print_r($crnmc);


$crn_usage_hrs = array();
$total_ffhrs = 0;
$mccap_arr = array();

$crnmcschresult = $newmc_capacity->getlob_crnmc($crnnum,$mc,$month,$year);

while($mycrnmcschrow=mysql_fetch_row($crnmcschresult))
{

	$crn = $mycrnmcschrow[0];
	$blank = $mycrnmcschrow[8];
	if ($blank =="" || $blank == null) 
	{
		$blank = 1;    
	}

	$runtime_hrs = $mycrnmcschrow[1];
	$blank_hrs = ($mycrnmcschrow[1] / $mycrnmcschrow[8]);
	$operation = $mycrnmcschrow[2];
	$mc_name = $mycrnmcschrow[3];
	$schdate = $mycrnmcschrow[4];            
	$schhrs = $mycrnmcschrow[6];
	$schqty = $mycrnmcschrow[5];
	$wip_qty = $mycrnmcschrow[13];
	$disp_qty = $mycrnmcschrow[12];
	$fg_qty = $mycrnmcschrow[11];
	$rej_qty = $mycrnmcschrow[10];
	$wip_qty = $wip_qty - $disp_qty;


	if (isset($mccapmaster[$mc_name][0])) 
	{
		$avail_capacity = $mccapmaster[$mc_name][0];   
	}

	if (isset($mccapmaster[$mc_name][1])) 
	{
		$avail_shift = $mccapmaster[$mc_name][1]; 
	}

	if (isset($mccapmaster[$mc_name][2])) 
	{
		$avail_units = $mccapmaster[$mc_name][2]; 
	}

	if ($avail_units == "strokes") 
	{
		$strokes_hrs = "Strs.";
		$parts_blank = 'yes';
	}
	else
	{
		$strokes_hrs = "Hrs.";
		$parts_blank = 'no';
	}


	if($prev_mc == $mc_name)
	{
	  	$mc_avail_hrs = $prev_avail_mc_hrs;    
	}
	else
	{
		$mc_avail_hrs = $avail_capacity;
	}

	$totalfgqty = $schqty - ( $fg_qty + $wip_qty + $disp_qty + $rej_qty);
	$bal_crn_qty = $totalfgqty;

	$req_crn_hrs=round($blank_hrs*$bal_crn_qty);
	$runtime_hrs = ($runtime_hrs == '')?'0':$runtime_hrs;

	if($runtime_hrs > 0)
	{
		$possible_qty=round($mc_avail_hrs/$blank_hrs);
	}
	else
	{
		$possible_qty=0;
	}

	if($mc_avail_hrs >= $runtime_hrs)
	{

		if($possible_qty > $bal_crn_qty)
		{
			$balance_crn_qty=0;

			if($bal_crn_qty !='' && $bal_crn_qty!='0')
			{
				$balance_mc_hrs=round($mc_avail_hrs-($bal_crn_qty*$blank_hrs));
				$balance_crn_hrs=0; 

				$crn_usage_hrs[$mc_name][] = array('crn'=> $crn, 'used_hrs' => $bal_crn_qty*$blank_hrs,'mc_hrs'=> $mc_avail_hrs);
			}
			else
			{
				$balance_mc_hrs=$mc_avail_hrs;
				$balance_crn_hrs=0; 
			}


			$ff_qty = $bal_crn_qty;
			$ff_hrs = ($ff_qty*$blank_hrs);

			$uf_hrs = ($balance_crn_qty*$blank_hrs);
		}

		elseif($possible_qty <= $bal_crn_qty)
		{       

			$balance_crn_qty = $bal_crn_qty - $possible_qty;  


			if($bal_crn_qty !='' && $bal_crn_qty !='0')
			{
				$balance_mc_hrs=round($mc_avail_hrs-($possible_qty*$blank_hrs));

				$crn_usage_hrs[$mc_name][] = array('crn'=> $crn, 'used_hrs' => $possible_qty*$blank_hrs,'mc_hrs'=> $mc_avail_hrs);

			}
			else
			{

				$balance_mc_hrs=$mc_avail_hrs;
				$balance_crn_hrs=round($req_crn_hrs-($possible_qty*$blank_hrs));  
			}

			$ff_qty = $possible_qty;
			$ff_hrs = ($ff_qty*$blank_hrs);
			$uf_hrs = ($balance_crn_qty*$blank_hrs);
		}

	}
	elseif($mc_avail_hrs < $runtime_hrs)
	{


		$balance_crn_hrs = $req_crn_hrs;
		$balance_crn_qty = $bal_crn_qty;
		$balance_mc_hrs = $mc_avail_hrs;  
		$crn_usage_hrs[$mc_name][] = array('crn'=> $crn, 'used_hrs' => 0,'mc_hrs'=> $mc_avail_hrs);    
		$ff_qty = 0;
		$ff_hrs = ($ff_qty*$blank_hrs);
		$uf_hrs = ($balance_crn_qty*$blank_hrs);

	}

	elseif($runtime_hrs == '')
	{
		$balance_mc_hrs = $mc_avail_hrs; 
		$crn_usage_hrs[$mc_name][] = array('crn'=> $crn, 'used_hrs' => 0,'mc_hrs'=> $mc_avail_hrs); 
		$ff_qty = 0; 
		$ff_hrs = ($ff_qty*$blank_hrs);
	}

	if ($prev_mc != $mc_name) 
	{
		$mccap_arr[$mc_name] = array('mc_avail_hrs' => $avail_capacity, 'req_crn_hrs' => $req_crn_hrs, 'crns' => array($crn), 'used_crns' => $crn, 'remaing_crn_hrs' => ( $avail_capacity -  $req_crn_hrs) );
	}
	else
	{


		$mccap_arr[$mc_name]['crns'][] = $crn;
		$mccap_arr[$mc_name]['req_crn_hrs'] = $mccap_arr[$mc_name]['req_crn_hrs'] + $req_crn_hrs;
		$mccap_arr[$mc_name]['used_crns'] = $mccap_arr[$mc_name]['used_crns'] .', '. $crn;
		$mccap_arr[$mc_name]['remaing_crn_hrs'] = ($mccap_arr[$mc_name]['mc_avail_hrs'] - $mccap_arr[$mc_name]['req_crn_hrs']);
	}

	$prev_avail_mc_hrs = $balance_mc_hrs;
	$prev_mc=$mc_name; 

}

$mcrows = 1;

foreach ($mccap_arr as $mckey => $value) 
{	
	if ($mcrows == 1) 
	{


		
	?>
		<table width="100%">
			<tr bgcolor="#DDDEDD">
				<td colspan=4><span class="heading"><center><b>RCCP for <?php echo $month_names[$month] .', '. $year ?> </b></center></span></td>
			</tr>
		</table>

		<table border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
			<tr bgcolor="#FFCC00">
				<td bgcolor="#FFA500" width='10px' align="center"><span class="tabletext"><b>M/C</b></span></td>
				<td bgcolor="#00DDFF" width='10px'  align="center"  ><span class="tabletext"><b>PRN</b></span></td>
				<td bgcolor="#00DDFF" width='10px'  align="center" ><span class="tabletext"><b>Avail Cap </b></span></td>
				<td bgcolor="#00DDFF" width='10px'  align="center" ><span class="tabletext"><b>Req Cap</b></span></td>
				<td bgcolor="#00DDFF" width='10px' align="center" ><span class="tabletext"><b>Over / Under</b></span></td>
			</tr>

	<?php
	}



	if ($value['mc_avail_hrs'] - $value['remaing_crn_hrs'] > 0) 
	{
		$status_color = "background-color: #00FF00";
	}
	else
	{
		$status_color = "background-color: #FF0000";
	}

	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" align=\"center\"  width='10px' ><span class=\"tabletext\">".$mckey."</span></td>";

	echo "<td bgcolor=\"#FFFFFF\" align=\"center\"  width='10px' ><span class=\"tabletext\">".$value['used_crns']."</span></td>";

	echo "<td bgcolor=\"#FFFFFF\" align=\"center\"  width='10px' ><span class=\"tabletext\">".$value['mc_avail_hrs']."</span></td>";

	echo "<td bgcolor=\"#FFFFFF\" align=\"center\"  width='10px' ><span class=\"tabletext\">".$value['req_crn_hrs']."</span></td>";

	echo "<td bgcolor=\"#FFFFFF\" align=\"center\"  width='10px' style=\"".$status_color."\"><span class=\"tabletext\">".$value['remaing_crn_hrs']."</span></td>";

	echo "</tr>";

	$mcrows++;
	
}

// echo "<pre>";
// print_r($mccap_arr);

echo "</table>";
echo "</td></tr>";


?>




<?php

?>

</tr>
<tr>


<?php

}


}
?>



</table>

</table>
</form>
</table>

</body>
</html>