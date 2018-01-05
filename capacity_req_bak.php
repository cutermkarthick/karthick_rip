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
	<link rel="stylesheet" href="style.css">

	<title>M/C Capacity Plan</title>


	<?php
	include('header.html');
	?>


	<td><span class="pageheading"><b>M/C Capacity Plan</b></span></td>
	</tr>

	<form action='capacity_req.php' method='POST' enctype='multipart/form-data'>
	<tr>
	<td>
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


	<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
	<tr bgcolor="#FFFFFF">
	<td><span class="labeltext"><p align="left">M/C Series</p></span></td>
	<td><span class="tabletext">
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
	</select></span>
	</td>

	<td><span class="labeltext"><p align="left">PRN #</p></span></td>
	<td><span class="tabletext"><input type="text" name="crnnum" id='crnnum' size=10 value="<?php echo $crnnum; ?>"></span></td>

	<td  bgcolor="#FFFFFF" width='40%'><span class="labeltext"><b>Month &nbsp&nbsp</b></span>

	<select name="pl_month">
	<option value="select" disabled="disabled" selected="selected">Select</option>
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
	</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	<span class="heading"><b>Year</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<select name="pl_year" >
	<option value="select" disabled="disabled" selected="selected">Select</option>
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

	</select>&nbsp;&nbsp;&nbsp;&nbsp;
	</td>
	<td bgcolor="#FFFFFF"><span class="labeltext">
	<input type="submit" name="Submit"  value="Get" onclick="javascript: return fetch_cap_req()">
	<input type="submit" name="Submit"  value="Get_Schedule" onclick="javascript: return fetch_cap_req()"></span>

	</td>
	</tr>



	</table>
	</table>

	<table border=0 bgcolor="#FFFFFF" width=100%  cellspacing=1 cellpadding=3 height='150' class="stdtable1">

	<?
	// if(isset($_REQUEST['Submit']) == 'DELETE')
	// {
	//     $plan_month=$_REQUEST['plan_month'];
	//     $plan_year=$_REQUEST['plan_year'];
	//     $p_m=date("M", mktime(0, 0, 0, $plan_month, 10));   
	//     $r=$newmc_capacity->delete_capacity_plan($plan_month,$plan_year,$mc_series);
	//     if($r == 1)
	//     {       
	//          echo "<font color='green'>Data for $p_m,$plan_year Deleted Succesfully....</font>";

	//     }

	// }



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
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>Avail. <br/>M/C Hrs</b></span></td>
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>PRN</b></span></td>
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>Oper</b></span></td>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Qty <br/>from<br/>Sch</b></span></td>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Req <br/>PRN<br/>Qty</b></span></td>
	<td bgcolor="#33cc99" width='20px'><span class="tabletext"><b>Start Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span></td>
	<td bgcolor="#33cc99" width='20px'><span class="tabletext"><b>Start Time&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span></td>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>RunTime/<br/>Unit</b></span></td>

	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Parts/<br/>Blanks</b></span></td>

	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Req PRN<br/> Hrs.</b></span></td>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Balance<br/>PRNs Hrs.</b></span></td>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Balance<br/>PRN Qty</b></span></td>
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>Balance<br/> M/C Hrs.</b></span></td>

	<!-- <td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>Status</b></span></td> -->

	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>Priority</b></span></td>
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>End Date</b></span></td>
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>End<br/>Time</b></span></td>
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
	$crnarr[$crn]= $schqty;
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
	$crnmc[$crn][$mcname]= $mycrnmcrow[5];;
	}

	// echo "<pre>";
	// print_r($crnmc);

	$crnmcschresult = $newmc_capacity->getlob_crnmc($crnnum,$mc,$month,$year);
	while($mycrnmcschrow=mysql_fetch_row($crnmcschresult))
	{


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

	$crnmcsch[$crn][$mc]= $schhrs;
	if (isset($mccapmaster[$mc_name][0])) {
	$mc_avail_hrs = $mccapmaster[$mc_name][0];    
	}
	if (isset($mccapmaster[$mc_name][0])) {
	$avail_capacity = $mccapmaster[$mc_name][0];   
	}
	if (isset($mccapmaster[$mc_name][1])) {
	$avail_shift = $mccapmaster[$mc_name][1]; 
	}
	if (isset($mccapmaster[$mc_name][2])) {
	$avail_units = $mccapmaster[$mc_name][2]; 

	}

	if ($avail_units == "strokes") {
	$strokes_hrs = "Strokes.";
	$parts_blank = '<td bgcolor="#33cc99" width="10px"><span class="tabletext"><b>Parts/<br/>Blanks</b></span></td>';
	}else{
	$strokes_hrs = "Hrs.";
	}

	if($prev_mc == $mc_name)
	{

	$mc_avail_hrs=$prev_avail_mc_hrs;
	$avail_capacity=$prev_avail_mc_hrs;     
	}
	else
	{

	$mc_avail_hrs=$avail_capacity;
	$avail_capacity=$avail_capacity;
	}

	$crn_qty = $crnarr[$crn];

	$crn_qty=($crn_qty == '')?'0':$crn_qty;


	$req_qty = $crnarr[$crn];

	// $req_crn_hrs=round($runtime_hrs*$crn_qty);
	$req_crn_hrs=round($blank_hrs*$crn_qty);
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


	if($possible_qty > $crn_qty)
	{
	$balance_crn_qty=0;
	if($crn_qty !='' && $crn_qty!='0')
	$balance_mc_hrs=round($avail_capacity-($crn_qty*$blank_hrs));
	else
	$balance_mc_hrs=$avail_capacity;
	$balance_crn_hrs=0; 

	}
	elseif($possible_qty <= $crn_qty)
	{       

	$balance_crn_qty=$crn_qty-$possible_qty;  

	if($crn_qty !='' && $crn_qty !='0')
	$balance_mc_hrs=round($avail_capacity-($possible_qty*$blank_hrs));
	else
	$balance_mc_hrs=$avail_capacity;

	$balance_crn_hrs=round($req_crn_hrs-($possible_qty*$blank_hrs));  


	}

	}
	elseif($avail_capacity < $runtime_hrs)
	{


	$balance_crn_hrs=$req_crn_hrs;
	$balance_crn_qty=$crn_qty;
	$balance_mc_hrs=$avail_capacity;      

	}
	elseif($runtime_hrs == '')
	{
	$balance_mc_hrs=$avail_capacity; 
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

	$mc_cap_hrs=$avail_capacity;
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

	$newmc_capacity->setmc_series($mc_series);
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

	if ($crnarr[$crn] > 0) 
	{
	$insert_res=$newmc_capacity->addcapacity_plan();            
	}
	}

	if(($prev_crn == $crn) && ($crn!=' ') && ($prev_month==$month)  && ($prev_operation== $operation) )
	{       
	// echo "prev bal qty $prev_balance_qty <br>";
	$crn_qty1=$prev_balance_qty;           
	}
	else
	{   
	$crn_qty1=$crn_qty;         
	}


	if ($crnarr[$crn] > 0) 
	{


	if ($prev_mc != $mc_name ) 
	{  

	echo"<table><tr><td><br></td></tr></table>";
	echo "<table  class=\"stdtable1\"><tr><td align=\"center\" colspan=16 bgcolor=\"#00DDFF\" style=\"padding:5px;\"><center><span class=\"heading\"><b>M/C Name: ". $mc_name . ",  Avail Capacity: ".$avail_capacity."</b></span></center></td></tr></table>";

	?>


	<table width=80% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
	<tr bgcolor="#FFCC00">
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>Avail. <br/>M/C <?php echo $strokes_hrs; ?></b></span></td>
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>PRN</b></span></td>
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>Oper</b></span></td>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Qty <br/>from<br/>Sch</b></span></td>
	<!-- <td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Req <br/>PRN<br/>Qty</b></span></td> -->
	<td bgcolor="#33cc99" width='20px'><span class="tabletext"><b>Start Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span></td>
	<td bgcolor="#33cc99" width='20px'><span class="tabletext"><b>Start Time&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span></td>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>RunTime/<br/>Unit</b></span></td>
	<?php echo $parts_blank;?>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Req PRN<br/> <?php echo $strokes_hrs; ?></b></span></td>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Balance<br/>PRNs <?php echo $strokes_hrs; ?> </b></span></td>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Balance<br/>PRN Qty</b></span></td>
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>Balance<br/> M/C <?php echo $strokes_hrs; ?> </b></span></td>
	<!-- <td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>Status</b></span></td> -->
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>Priority</b></span></td>
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>End Date</b></span></td>
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>End<br/>Time</b></span></td>
	</tr>

	<?php 
	}




	echo "<tr bgcolor=\"#FFCC00\"> ";
	echo "<td bgcolor=\"#FFFFFF\" width='10px'><span class=\"tabletext\"><input type=\"text\" size=4  name=\"mc_avail_hrs$z\" id=\"mc_avail_hrs$z\" value=\"$mc_avail_hrs\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";

	if($prev_crn != $crn || $prev_mc != $mc_name || $prev_mc =='')
	{   

	if($crn_qty1 == $balance_crn_qty)
	{
	echo "<td bgcolor=\"#FFFFFF\" width='10px'><span class=\"tabletext\"><font color =\"#FF0000\" size=2>$crn</span></td>";
	}
	elseif($balance_crn_qty == 0)
	{
	echo "<td bgcolor=\"#FFFFFF\" width='10px'><span class=\"tabletext\"><font color =\"#00FF00\" size=2>$crn</span></td>";
	}
	elseif($crn_qty1-$balance_crn_qty >0)
	{
	echo "<td bgcolor=\"#FFFFFF\" width='10px'><span class=\"tabletext\"><font color =\"#FFAA00\" size=2>$crn</span></td>";
	}
	}

	if($prev_mc != $mc_name) 
	{ 

	$start_date=$st_date1;
	// $time="";
	$prev_mc=$mc_name;
	}


	echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$operation</span></td>";
	echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$schqty</span></td>";

	// echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"req_crn_qty$i\" id=\"req_crn_qty$i\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$req_qty\"  ></span></td>";
	// 
	echo "<input type=\"hidden\" size=4  name=\"req_crn_qty$i\" id=\"req_crn_qty$i\"  value=\"$req_qty\"  ></td>";

	echo "<td bgcolor=\"#FFFFFF\" width=\"20px\"><span class=\"tabletext\"><input type=\"text\" name=\"start_date$i\" id=\"start_date$i\" size=9 value=\"$start_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onClick=\"GetDate('start_date$i')\"></span></td>";
	if (isset($time)) 
	{
	$time = $time;  
	}else{
	$time = "";
	}
	echo "<td  bgcolor=\"#FFFFFF\" width=\"20px\"><input type=\"tex\"  name=\"time$i\"  id=\"time$i\" size=4 value=\"$time\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"><select name=\"time_sel$i\" id=\"time_sel$i\" onchange=\"onSelecttime($i)\">
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



	echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"req_rt_perunit$i\" id=\"req_rt_perunit$i\" value=\"$runtime_hrs\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";
	if ($avail_units == "strokes") 
	{
		echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"blank$i\" id=\"blank$i\" value=\"$blank\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";
    }
    else
    {
    	echo "<input type=\"hidden\" size=4  name=\"blank$i\" id=\"blank$i\" value=\"$blank\" >";
    }

	echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"req_crn_hrs$i\" id=\"req_crn_hrs$i\" value=\"$req_crn_hrs\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";

	echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"balance_crn_hrs$i\" id=\"balance_crn_hrs$i\" value=\"$balance_crn_hrs\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";

	// echo "crn qty $crn_qty"."<br>";
	// echo "balance_crn_qty $balance_crn_qty"."<br>";

	if ($crn_qty == $balance_crn_qty)
	{
	echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"balance_crn_qty$i\" id=\"balance_crn_qty$i\" value=\"$balance_crn_qty\" style=\"background-color:#FF0000;\" readonly=\"readonly\"></span></td>";
	}
	elseif ($balance_crn_qty == 0)
	{
	echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"balance_crn_qty$i\" id=\"balance_crn_qty$i\" value=\"$balance_crn_qty\" style=\"background-color:#00FF00;\" readonly=\"readonly\"></span></td>";
	}
	elseif ($crn_qty-$balance_crn_qty >0)
	{
	echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"balance_crn_qty$i\" id=\"balance_crn_qty$i\" value=\"$balance_crn_qty\" style=\"background-color:#FFAA00;\" readonly=\"readonly\"></span></td>";
	}

	echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"balance_mc_hrs$i\" id=\"balance_mc_hrs$i\" value=\"$balance_mc_hrs\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";






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
	// $stores_per_shift = 2000;
	$t_hrs = $mc_avail_hrs/24;
	$shift_hr = 8;
	}else if($avail_shift == 2){
	// $stores_per_shift = 4000;
	$t_hrs = $mc_avail_hrs/24;
	$shift_hr = 16;
	}else if ($avail_shift == 3) {
	// $stores_per_shift = 6000;
	$t_hrs = $mc_avail_hrs/24;
	$shift_hr = 24;
	}

	$per_hr = $t_hrs/$shift_hr;
	$total_hrs = $req_crn_hrs/$per_hr;
	$days=intval($total_hrs/$shift_hr);
	$hours=$total_hrs%$shift_hr;

	// echo "req_crn_hrs  $t_hrs <br>";
	// echo "hrs  $total_hrs <br>";
	// echo "bal hrs  $hours <br>";
	}else{
	$days=intval($req_crn_hrs/24);
	$hours=$req_crn_hrs%24;
	}




	if ($time !="" || $time != 0) 
	{
	$hours1 = $time + $hours;
	// echo "hours if $hours +  time $time <br>";
	// echo "hours1 if $hours1  <br>";
	}
	else
	{
	$hours1 = $hours;
	// echo "hours1 else $hours1 <br>";
	}


	$total_days=($jd+$days);
	// echo "total_days $total_days <br>";

	$check=(0+$hours1);
	// echo "check $check <br>";
	$end_date=$total_days;
	// echo "end_date $end_date <br>";
	$end_date = JDToGregorian($end_date);
	$end_datearr = explode('/', $end_date);
	$month1 = $end_datearr[0];

	if($month1 <=9)
	$month1='0'.$month1;
	else
	$month1=$month1;

	$day1   = $end_datearr[1];
	if($day1 <=9)
	$day1='0'.$day1;
	else
	$day1=$day1;

	$year1  = $end_datearr[2];

	$end_date=$year1.'-'.$month1.'-'.$day1;
	// echo "year $year1 <br>";
	// echo "month $month1 <br>";
	// echo "day $day1 <br>";
	// echo "end date $end_date <br>";
	$end_time=$check;  
	// echo "end_time $end_time <br>";
	//only -12 from hours if it is greater than 12 (if not back at mid night)
	//if 00 then it is 12 am
	$end_time = (($end_time + 11) % 12 + 1);
	// echo "end_time one $end_time <br>";

	$suffex = ($end_time >= 12)? 'PM' : 'AM';    
	// echo "suffex $suffex <br>";           
	//if 00 then it is 12 am
	$end_time = ($end_time == '00')? 12 : $end_time;
	$end_time=$end_time.' '.$suffex;
	$end_time1=$end_time.' '.$suffex;

	}
	else
	{
	$end_date=$end_date;
	$end_time=$end_time;

	}


	echo "<td bgcolor=\"#FFFFFF\" width='10px'><span class=\"tabletext\"><font color =\"#FFAA00\" size=2>$prity</span></td>";

	echo "<input type=\"hidden\" size=2  name=\"priority$i\" id=\"priority$i\"   value=\"$prity\"  ></td>";
	echo "<input type=\"hidden\" size=2  name=\"units$i\" id=\"units$i\"   value=\"$avail_units\"  ></td>";
	echo "<input type=\"hidden\" size=2  name=\"shift$i\" id=\"shift$i\"   value=\"$avail_shift\"  ></td>";


	echo "<td bgcolor=\"#FFFFFF\"  width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=9  name=\"end_date$i\" id=\"end_date$i\" value=\"$end_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";

	echo "<td bgcolor=\"#FFFFFF\"  width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"ed_time$i\" id=\"ed_time$i\" value=\"$end_time\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";



	echo "<input type=\"hidden\" name=\"crn_$i\" id=\"crn_$i\" value=\"$crn\">";
	echo "<input type=\"hidden\" name=\"mc_id_$i\" id=\"mc_id_$i\" value=\"$mc_id\">";
	// echo "<input type=\"hidden\" name=\"mc_sr_$i\" id=\"mc_sr_$i\" value=\"$mc_sr\">";
	echo "<input type=\"hidden\" name=\"mc_name$z\" id=\"mc_name$z\" value=\"$mc_name\">";
	echo "<input type= \"hidden\" size=4  name=\"prev_mc$z\" id=\"prev_mc$z\" value=\"$prev_mc\">";
	echo "<input type=\"hidden\" name=\"prev_avail_mc_hrs$z\" id=\"prev_avail_mc_hrs$z\" value=\"$prev_avail_mc_hrs\">";
	echo "<input type=\"hidden\" name=\"operation_$z\" id=\"operation_$z\" value=\"$operation\">";
	echo "</tr>";



	$prev_avail_mc_hrs=$balance_mc_hrs; 
	$prev_crn=$crn;
	$prev_balance_qty=$balance_crn_qty; 
	$crnarr[$crn]=$balance_crn_qty;
	$prev_month=$month; 
	$prev_operation=$operation;

	if($prev_mc == '' || $prev_mc == $mc_name)
	{
	$prev_mc=$mc_name;
	$start_date=$end_date;
	$time=$end_time;
	}

	$z++;
	$i++;


	}


	}

	echo "<input type=\"hidden\" name=\"max_val\" id=\"max_val\" value=\"$i\">";
	echo "</table>";
	echo "</td></tr>";


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

	$mc_cap_plan = $newmc_capacity->get_capacity_plan($crnnum,$mc,$month,$year);
	while ($mycapplan = mysql_fetch_assoc($mc_cap_plan) )
	{
	$mc_avail_hrs = $mycapplan['mc_avail_hrs'];
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

	if ($units == "strokes") {
	$strokes_hr = "Strokes.";
	}else{
	$strokes_hr = "Hrs.";
	}

	if ($prev_mc != $mc_name ) 
	{  

	echo"<table><tr><td><br></td></tr></table>";
	echo "<table class=\"stdtable1\"><tr><td align=\"center\" colspan=16 bgcolor=\"#00DDFF\" style=\"padding:5px;\"><center><span class=\"heading\"><b>M/C Name: ". $mc_name . ",  Avail Capacity: ".$mc_avail_hrs."</b></span></center></td></tr></table>";

	?>


	<table width=80% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
	<tr bgcolor="#FFCC00">
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>Avail. <br/>M/C <?php echo $strokes_hr; ?></b></span></td>
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>PRN</b></span></td>
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>Oper</b></span></td>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Qty <br/>from<br/>Sch</b></span></td>
	<!-- <td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Req <br/>PRN<br/>Qty</b></span></td> -->
	<td bgcolor="#33cc99" width='20px'><span class="tabletext"><b>Start Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span></td>
	<td bgcolor="#33cc99" width='20px'><span class="tabletext"><b>Start Time&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span></td>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>RunTime/<br/>Unit</b></span></td>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Parts/<br/>Blanks</b></span></td>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Req PRN<br/> <?php echo $strokes_hr; ?></b></span></td>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Balance<br/>PRNs <?php echo $strokes_hr; ?></b></span></td>
	<td bgcolor="#33cc99" width='10px'><span class="tabletext"><b>Balance<br/>PRN Qty</b></span></td>
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>Balance<br/> M/C <?php echo $strokes_hr; ?></b></span></td>
	<!-- <td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>Status</b></span></td> -->
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>Priority</b></span></td>
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>End Date</b></span></td>
	<td bgcolor="#EEEFEE" width='10px'><span class="tabletext"><b>End<br/>Time</b></span></td>
	</tr>

	<?php 
	}

	echo "<tr bgcolor=\"#FFCC00\"> ";
	echo "<td bgcolor=\"#FFFFFF\" width='10px'><span class=\"tabletext\"><input type=\"text\" size=4  name=\"mc_avail_hrs$i\" id=\"mc_avail_hrs$i\" value=\"$mc_avail_hrs\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";


	if($crn_qty == $balance_crn_qty)
	{
	echo "<td bgcolor=\"#FFFFFF\" width='10px'><span class=\"tabletext\"><font color =\"#FF0000\" size=2>$crn</span></td>";
	}
	elseif($balance_crn_qty == 0)
	{
	echo "<td bgcolor=\"#FFFFFF\" width='10px'><span class=\"tabletext\"><font color =\"#00FF00\" size=2>$crn</span></td>";
	}
	elseif($crn_qty-$balance_crn_qty >0)
	{
	echo "<td bgcolor=\"#FFFFFF\" width='10px'><span class=\"tabletext\"><font color =\"#FFAA00\" size=2>$crn</span></td>";
	}


	echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$operation</span></td>";
	echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$schqty</span></td>";

	// echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"req_crn_qty$i\" id=\"req_crn_qty$i\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$req_qty\"  ></span></td>";
	// 
	echo "<input type=\"hidden\" size=4  name=\"req_crn_qty$i\" id=\"req_crn_qty$i\"  value=\"$req_qty\"  >";

	echo "<td bgcolor=\"#FFFFFF\" width=\"20px\"><span class=\"tabletext\"><input type=\"text\" name=\"start_date$i\" id=\"start_date$i\" size=9 value=\"$start_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onClick=\"GetDate('start_date$i')\"></span></td>";

	echo "<td  bgcolor=\"#FFFFFF\" width=\"20px\"><input type=\"tex\"  name=\"time$i\"  id=\"time$i\" size=4 value=\"$st_meri\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"><select name=\"time_sel$i\" id=\"time_sel$i\" onchange=\"onSelecttime($i)\">
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



	echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"req_rt_perunit$i\" id=\"req_rt_perunit$i\" value=\"$runtime_hrs\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";
	
	echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"blank$i\" id=\"blank$i\" value=\"$blank\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";

	echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"req_crn_hrs$i\" id=\"req_crn_hrs$i\" value=\"$req_crn_hrs\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";

	echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"balance_crn_hrs$i\" id=\"balance_crn_hrs$i\" value=\"$balance_crn_hrs\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";


	if ($crn_qty == $balance_crn_qty)
	{
	echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"balance_crn_qty$i\" id=\"balance_crn_qty$i\" value=\"$balance_crn_qty\" style=\"background-color:#FF0000;\" readonly=\"readonly\"></span></td>";
	}
	elseif ($balance_crn_qty == 0)
	{
	echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"balance_crn_qty$i\" id=\"balance_crn_qty$i\" value=\"$balance_crn_qty\" style=\"background-color:#00FF00;\" readonly=\"readonly\"></span></td>";
	}
	elseif ($crn_qty-$balance_crn_qty >0)
	{
	echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"balance_crn_qty$i\" id=\"balance_crn_qty$i\" value=\"$balance_crn_qty\" style=\"background-color:#FFAA00;\" readonly=\"readonly\"></span></td>";
	}

	echo "<td bgcolor=\"#FFFFFF\" width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"balance_mc_hrs$i\" id=\"balance_mc_hrs$i\" value=\"$balance_mc_hrs\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";



	echo "<td bgcolor=\"#FFFFFF\" width='10px'><span class=\"tabletext\"><font color =\"#FFAA00\" size=2>$priority</span></td>";

	echo "<input type=\"hidden\" size=2  name=\"priority$i\" id=\"priority$i\"   value=\"$priority\"  ></td>";

	echo "<input type=\"hidden\" size=2  name=\"units$i\" id=\"units$i\"   value=\"$units\"  ></td>";
	echo "<input type=\"hidden\" size=2  name=\"shift$i\" id=\"shift$i\"   value=\"$shift\"  ></td>";

	echo "<td bgcolor=\"#FFFFFF\"  width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=9  name=\"end_date$i\" id=\"end_date$i\" value=\"$end_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";

	echo "<td bgcolor=\"#FFFFFF\"  width=\"10px\"><span class=\"tabletext\"><input type=\"text\" size=4  name=\"ed_time$i\" id=\"ed_time$i\" value=\"$ed_meri\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></span></td>";



	echo "<input type=\"hidden\" name=\"crn_$i\" id=\"crn_$i\" value=\"$crn\">";
	echo "<input type=\"hidden\" name=\"mc_id_$i\" id=\"mc_id_$i\" value=\"$mc_id\">";
	echo "<input type=\"hidden\" name=\"mc_sr_$i\" id=\"mc_sr_$i\" value=\"$mc_sr\">";
	echo "<input type=\"hidden\" name=\"mc_name$i\" id=\"mc_name$i\" value=\"$mc_name\">";
	echo "<input type= \"hidden\" size=4  name=\"prev_mc$i\" id=\"prev_mc$i\" value=\"$prev_mc\">";
	echo "<input type=\"hidden\" name=\"prev_avail_mc_hrs$i\" id=\"prev_avail_mc_hrs$i\" value=\"$prev_avail_mc_hrs\">";
	echo "<input type=\"hidden\" name=\"operation_$i\" id=\"operation_$i\" value=\"$operation\">";
	echo "</tr>";



	$prev_avail_mc_hrs=$balance_mc_hrs; 
	$prev_crn=$crn;
	$prev_balance_qty=$balance_crn_qty; 
	$crnarr[$crn]=$balance_crn_qty;
	$prev_month=$month; 
	$prev_operation=$operation;
	$prev_mc=$mc_name;

	$i++;
	}
	echo "<input type=\"hidden\" name=\"max_val\" id=\"max_val\" value=\"$i\">";
	echo "</table>";
	echo "</td></tr>";
	?>
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