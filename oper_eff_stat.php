<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = March 15,2005                =
// Filename: operator_efficiency.php           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');

// First include the class definition
include('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/operatorClass.php');
include('classes/reportClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newreport = new report;

$month = date('m');
$year = date('Y');
$date = "$year-$month-01";
$oper3= 'like';
$cond0 = "(to_days(op.st_date) > to_days('". $date ."')) and
           (to_days(op.st_date)-to_days('2050-12-31') < 0)";
$cond1 = "op.oper_name like 'Rames%'";
$cond = $cond0;

$cond2 = "employee.fname like 'Rames%'";

$condnc = "(to_days(create_date) >= to_days('". $date ."')) and
           (to_days(create_date)-to_days('2050-12-31') < 0)";

if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond01 = "to_days(op.st_date) " . "> to_days('" . $date1 . "')";
          $cond11 = "to_days(create_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond01 = "(to_days(op.st_date)-to_days('1582-01-01') > 0 || op.st_date = 'NULL' || op.st_date = '0000-00-00')";
          $cond11 = "(to_days(create_date)-to_days('1582-01-01') > 0 || create_date = '0000-00-00')";
}

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond02 = "to_days(op.st_date) " . "< to_days('" . $date2 . "')";
          $cond22 = "to_days(create_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond02 = "(to_days(op.st_date)-to_days('2050-12-31') < 0 || op.st_date = 'NULL' || op.st_date = '0000-00-00')";
          $cond22 = "(to_days(create_date)-to_days('2050-12-31') < 0 || create_date = '0000-00-00')";
     }
     $cond0 = $cond01 . ' and ' . $cond02;
     $condnc=  $cond11 . ' and ' . $cond22;
}
else
{
     $date1_match = "$year-$month-01";
     $date2_match = '';
}

if ( isset ( $_REQUEST['crn'] ) )
{
     $name_match = $_REQUEST['crn'];
     //echo "Name selected is : $name_match<br>";
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper3 = $_REQUEST['crn_oper'];
     }
     else {
         $oper3 = 'like';
     }
     if ($oper3 == 'like') {
         $crn =  $_REQUEST['crn'] ;
     }
     else {
         $crn =  $_REQUEST['crn'];
     }

     $cond1 = "op.oper_name " . $oper3 . " " . $crn;
    // $pnamearr = split(' ',$crn);

    $suffix = strrchr($crn, " ");
    $pos = strpos  ( $crn  , $suffix);
    $name = substr_replace ($crn, "", $pos);
    $fname =  "'" . $name."%'";
    
//echo $suffix . "<br><br>". $name;
     if(!isset($suffix))
     {
       $lname = "'%'";
     }
     else
     {
       $lname = "'" .trim($suffix) . "%'";
     }
	 $cond2 = "employee.fname " . $oper3 . " " . $fname . ' and  employee.lname ' . $oper3 . " " . $lname ;
}
else
{
     $name_match = '';
}

$cond = $cond0;

$_SESSION['cond'] = $cond;
$_SESSION['cond1'] = $cond1;
$_SESSION['cond2'] = $cond2;
$_SESSION['condnc'] = $condnc;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<script language="javascript">
function openPrintWindow(){
window.open("tabchart.html", "Efficiency", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=1000" + ",height=650");
}
</script>
<html>
<head>
<title>Operator data</title>
</head>

<?
if($_SESSION['department'] == 'Operator')
{?>
<body leftmargin="0"topmargin="0" marginwidth="0" onload="javascript:createTab('oper_eff_stat');toggle_visibility()">
<?}
else
{?>
<body leftmargin="0" topmargin="0" marginwidth="0">
<?}?>
<form name="operator_efficiency" action='oper_eff_stat.php' method='post' enctype='multipart/form-data'>

<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<?php
include('header.html');
if($_SESSION['department'] == 'Operator')
{
include('header2.html');
}
?>
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
<?php
     $newdisplay->dispLinks('');
?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=70% border=1 cellpadding=6 cellspacing=0>
<tr>
<td colspan=2 bgcolor="#F5F6F5"><span class="heading"><b><center>Search Criteria</center></b></td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>From</b>
        <input type="text" name="sdate1" size=7 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp;To</b>
        <input type="text" name="sdate2" size=7 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
<span class="labeltext"><b>&nbsp;Oper Name</b>
       <select name="crn_oper" size="1" width="100">
<?php
      if ($oper3 == 'like')
      {
?>
	<option selected>like
	<option value>=
<?php
      }
      else
      {
?>
	<option selected>=
	<option value>like
<?php
      }
?>
</select>
       <select id="crn" name="crn">
<option selected value="<?php echo $name_match ?>"><?php echo $name_match ?></option>
<?php
$result_oper = $newreport->getallops();
while($myrow_oper = mysql_fetch_row($result_oper))
{
 $opername = $myrow_oper[0]  . ' ' . $myrow_oper[1];
  printf('<option value="%s">%s',$opername,$opername);
}
?>
</select></td>

</td>
<td align="right" bgcolor="#FFFFFF"><span class="tabletext">
<input type="submit" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: return searchsort_fields()">
<?
if($_SESSION['department'] != 'Operator')
{?>
<input type="button" name="Print" src="images/bu-print.gif" value="Print"
onclick='javascript: return openPrintWindow()'>
<?}?>
</td>
</tr>
<?php
 $rejcrnarr = array();
 $rejcount = 0;
 $result = $newreport->getops($cond2);
 $prev_crn="#";
 if($opername!='' && $_REQUEST['sdate1'] !='' && $_REQUEST['sdate1'] !='0000-00-00')
 {
 while($myrow=mysql_fetch_row($result))
    {
       $op = $myrow[0].' '.$myrow[1];
      // echo $op;
       $eff_runtime=0;
       $eff_settime=0;
       $runtimediff=0;
       $settimediff=0;
       $rejtime=0;
       $crn_count=0;
       $total_qty=0;
	   $total_qty_op=0;
       $qty_est =0;
       $total_qty_rej=0;
       $total_rej_time=0;
       $total_actual_time=0;
       $total_ideal_time=0;
       $actual_time4set_eff=0;
       $ideal_time4set_eff=0;
       $actual_time4run_eff=0;
       $ideal_time4run_eff=0;  $nc_rejqty=0; $totRMcost=0; $rmcurr=''; $ncnum=0;$finc_rejqty=0;$ipnc_rejqty=0;

       $rec_arr = array();
       $crn_arr = array();
       $result_rev=$newreport->getrev_crn($op,$cond);
       $resultRev=$newreport->getcrnstagenumdata($op,$cond);
      //if(mysql_num_rows($resultRev) != 0)
     //{
      if(mysql_num_rows($result_rev) != 0)
      {
       while($myrow_crn_rev=mysql_fetch_row($result_rev))
       {
           $rec_arr[]=$myrow_crn_rev[4];
           $crn_arr[]=$myrow_crn_rev[0];
       }
      // print_r($crn_arr);
       $setting_arr = array();
       $worked_days = $newreport->getNo_of_days($op,$cond);
       $result4settime = $newreport->getsettime4eff($op,$cond,$rec_arr);
        while($myrow4seteff=mysql_fetch_row($result4settime))
        {
         $setting_arr[$op] = $myrow4seteff[0].'|'.$myrow4seteff[1];
        }
        $settimearr = split('\|',$setting_arr[$op]);
        $ideal_settime = $settimearr[0];
        $actual_settime = $settimearr[1];
         
	    //Get all NCs that are FI and disposition = rejected
        $resultnc=$newreport->getfinc4operators($op,$condnc);
        $ncnum= mysql_num_rows($resultnc);
		$price_array=array();
		$rej_array1=array();
		$rej_array2=array();
        while($mycrnnc=mysql_fetch_row($resultnc))
        {    
			  $crn = $mycrnnc[1];
			 if (array_key_exists($crn, $rejcrnarr))
			 {
			 }
			 else
			 {
                $rejcrnarr[$crn] = $crn;
				$rejcount++;
			 }

             $resultrmcost4nc= $newreport->getrmcostdetails($mycrnnc[1]);
             $myrmcost4nc=mysql_fetch_row($resultrmcost4nc);
             $currency = array('$','RS','Rs','rs','GBP');
             $rm_curr=$myrmcost4nc[0];
             $curr=preg_replace("/[0-9,+]/","",$rm_curr);
             //echo $curr."-------<br>".$rm_curr;
             $rm_price4nc = str_replace($currency, "", $myrmcost4nc[0]);
			 $price_array[$mycrnnc[1]]=$rm_price4nc;
			 $rej_array1[$mycrnnc[1]]=$mycrnnc[2];	
			 //echo $mycrnnc[1].'----'.$mycrnnc[2].'----------'.$rm_price4nc.'<br/>';
			
			 if ($rm_curr == '$')
			 {
                 $totRMcost+= $mycrnnc[2]*$rm_price4nc*50;
		     }
			 else if ($rm_curr == 'GBP')
			 {
                 $totRMcost+= $mycrnnc[2]*$rm_price4nc*80;
		     }
			 else if ($rm_curr == 'Rs')
			 {
                 $totRMcost+= $mycrnnc[2]*$rm_price4nc;
		     }
			 else
			 {
                 $totRMcost+= $mycrnnc[2]*$rm_price4nc*50;
		     }

             if($myrmcost4nc[2]=='')
             {
                $rmcurr=$curr;
             }
			 else
             {
              $rmcurr=$myrmcost4nc[2];
             }
             $finc_rejqty += $mycrnnc[2];
         }
	// Get all NCs that are InProcess and disposition = rejected
        $resultnc=$newreport->getipnc4operators($op,$condnc);
        $ncnum= mysql_num_rows($resultnc);
        while($mycrnnc=mysql_fetch_row($resultnc))
        {
			 $crn = $mycrnnc[1];
			 if (array_key_exists($crn, $rejcrnarr))
			 {
			 }
			 else
			 {
                $rejcrnarr[$crn] = $crn;
				$rejcount++;
			 }

             $resultrmcost4nc= $newreport->getrmcostdetails($mycrnnc[1]);
             $myrmcost4nc=mysql_fetch_row($resultrmcost4nc);
             $currency = array('$','RS','Rs','rs','GBP');
             $rm_curr=$myrmcost4nc[0];
             $curr=preg_replace("/[0-9,+]/","",$rm_curr);
             //echo $curr."-------<br>".$rm_curr;
             $rm_price4nc = str_replace($currency, "", $myrmcost4nc[0]);
			 
			 if ($rm_curr == '$')
			 {
                 $totRMcost+= $mycrnnc[2]*$rm_price4nc*50;
		     }
			 else if ($rm_curr == 'GBP')
			 {
                 $totRMcost+= $mycrnnc[2]*$rm_price4nc*80;
		     }
			 else if ($rm_curr == 'Rs')
			 {
                 $totRMcost+= $mycrnnc[2]*$rm_price4nc;
		     }
			 else
			 {
                 $totRMcost+= $mycrnnc[2]*$rm_price4nc*50;
		     }
             if($myrmcost4nc[2]=='')
             {
                $rmcurr=$curr;
             }
			 else
             {
              $rmcurr=$myrmcost4nc[2];
             }
             $ipnc_rejqty += $mycrnnc[2];
         }

         //print_r ($setting_arr);
		 $numcrnarr = array();
		 $numcrncount = 0;
         $result4effcrn = $newreport->geteffdetails4crn($op,$cond,$rec_arr);
         while($myrow4eff4crn=mysql_fetch_row($result4effcrn))
         {  // echo $prev_crn ."-----". $myrow4eff4crn[0]."<br>";

		     $crn = $myrow4eff4crn[0];
			 if (array_key_exists($crn, $numcrnarr))
			 {
			 }
			 else
			 {
                $numcrnarr[$crn] = $crn;
				$crn_count++;
			 }

           if($prev_crn != $myrow4eff4crn[0])
           {
            $numcrncount++;
          }
          $prev_crn = $myrow4eff4crn[0];
         }
         $result4eff = $newreport->geteffdetails4summary($op,$cond,$rec_arr);
         while($myrow4eff=mysql_fetch_row($result4eff))
         {         
           $total_qty += $myrow4eff[10];
           $ideal_runtime += $myrow4eff[6];
           $actual_runtime += $myrow4eff[9];
           $qty_est += $myrow4eff[8] != 0?($myrow4eff[9]/$myrow4eff[8]):0;
           $total_qty_rej += $myrow4eff[11];
           $result4rejtime = $newreport->getmaster_rejtime($myrow4eff[0],$myrow4eff[1],$myrow4eff[11],$rec_arr);
           $myrow4rejtime=mysql_fetch_row($result4rejtime);
           $rejtime +=  $myrow4rejtime[2];
           //$prev_crn = $myrow4eff[0];
           //echo $myrow4eff[0].'--'.$actual_runtime.'--'.$myrow4eff[7].'<br>';
         }
		  $result4eff_op = $newreport->getoperdetails($op,$cond);
          while($myrow4eff_op=mysql_fetch_row($result4eff_op))
          {         
		   $total_qty_op += $myrow4eff_op[9];
		   $crn = $myrow4eff_op[0];
		   if (array_key_exists($crn, $numcrnarr))
		   {
		   }
		   else
		   {
                $numcrnarr[$crn] = $crn;
				$crn_count++;
		   }
		   //echo $total_qty_op ."------<br>"; 
          }
         //echo 'actualruntime='.$total_actual_time.'<br>';
         //echo 'idealruntime='.$total_ideal_time;
		 //Added by BM to get total qty produced by an Operator
        //$result4qtyprod = $newreport->getqtyproduced4oper($op,$cond);
		//$myrow4qtyprod=mysql_fetch_row($result4qtyprod);
		//$total_qty = $myrow4qtyprod[0];

       $result4stg = $newreport->getstagenum($op,$cond);
       while($myrow4stg=mysql_fetch_row($result4stg))
       {
          $crn = $myrow4stg[1];
          $stagenum = $myrow4stg[2];
          $qty_rej = $myrow4stg[3];        
       }
         $actual_runtime = $actual_runtime +  $rejtime;
         //echo $actual_runtime."---**---".$ideal_runtime;
         $eff_settime =  $actual_settime != 0 ? (($ideal_settime/$actual_settime)*100) : 0;
         $eff_runtime =  $actual_runtime != 0 ? (($ideal_runtime/$actual_runtime)*100) : 0;
         $settimediff = ($ideal_settime-$actual_settime);
         $runtimediff = ($ideal_runtime-$actual_runtime);
         $net_eff = (($eff_settime+$eff_runtime)/2);
         //$qty_est = $total_ideal_time != 0?(round($total_actual_time/$total_ideal_time)):0;
         $qty_est = round($qty_est);
         $gain_loss = (($total_qty+$total_qty_op)-$qty_est);
        }      
      }
	  }
$crn_count1=0;	$crn_count2=0;$final_isnp_rej=0;
$result_rev=$newreport->getrev_crn($op,$cond);
$resultRev=$newreport->getcrnstagenumdata($op,$cond);
$crn_array=array();
 if(mysql_num_rows($resultRev) != 0)
{
if(mysql_num_rows($result_rev) != 0)
{

 while($myrow_crn_rev=mysql_fetch_row($result_rev))
 {
    $rec_arr[]=$myrow_crn_rev[4];
 }

$result = $newreport->geteffdetails($op,$cond,$rec_arr);
 while($myrow=mysql_fetch_row($result))
 {
	  if(round($myrow[11])>0)
	  {
			 $crn_count1=$crn_count1+count(round($myrow[11]));	
			 $crn_array[]=$myrow[14];			
	  }	
	  $resultnc=$newreport->getnc4operators4drilldown($myrow[13],$op,$condnc,$myrow[0],$myrow[1]);
      $mycrnnc=mysql_fetch_row($resultnc);
	  if(round($mycrnnc[2]) >0)
	  {
           $final_isnp_rej=$final_isnp_rej+count($mycrnnc[2]);	
		   $crn_array[]=$mycrnnc[1];		   
	  }
 }
 $result_rev4op=$newreport->getoperdetails($op,$cond);
 while($myoprow=mysql_fetch_row($result_rev4op))
 {
	         if(round($myoprow[12])>0)
	         {
		     	 $crn_count2=$crn_count2+count(round($myoprow[12]));		
				 $crn_array[]=$myrow[15];
			 }		
 } 
 $crn_counts= $crn_count1+$crn_count2+$final_isnp_rej;
}
}
$tot_rej_qty1=0;$tot_rej_qty2=0;
for($i=0;$i<count($crn_array);$i++)
{	
	$cd=$condnc." and nc.refnum='".$crn_array[$i]."'";	
	$resultnc=$newreport->getfinc4operators($op,$cd);
	while($mycrnnc=mysql_fetch_row($resultnc))
    {			     
             $resultrmcost4nc= $newreport->getrmcostdetails($mycrnnc[1]);
             $myrmcost4nc=mysql_fetch_row($resultrmcost4nc);
             $currency = array('$','RS','Rs','rs','GBP');
             $rm_curr=$myrmcost4nc[0];                      
             $rm_price4nc = str_replace($currency, "", $myrmcost4nc[0]);		
		     $tot_rej_qty1 += $mycrnnc[2]*$rm_price4nc*50;		

    }
	$resultnc=$newreport->getipnc4operators($op,$cd);
    while($mycrnnc=mysql_fetch_row($resultnc))
    {		 
			 $resultrmcost4nc= $newreport->getrmcostdetails($mycrnnc[1]);
             $myrmcost4nc=mysql_fetch_row($resultrmcost4nc);
             $currency = array('$','RS','Rs','rs','GBP');
             $rm_curr=$myrmcost4nc[0];                        
             $rm_price4nc = str_replace($currency, "", $myrmcost4nc[0]);
			 $tot_rej_qty2+= $mycrnnc[2]*$rm_price4nc*50;		
	}
}
$tot_rej_cost=$tot_rej_qty1+$tot_rej_qty2;

if($crn_count>0)
{
	$rej_crn=($crn_counts/$crn_count);
}
else
{
	$rej_crn=0;
}
if(($total_qty+$total_qty_op) >0)
{
	$rej_qty=($finc_rejqty+$ipnc_rejqty)/($total_qty+$total_qty_op);
}
else
{
	$rej_qty=0;
}

$total_per=($rejcount/$crn_count)+(($finc_rejqty+$ipnc_rejqty)/($total_qty+$total_qty_op));

$total_per_rej=$total_per*100;



//echo count($crn_array);
?>
<tr>
<td id="chartdata">
 <?php
    
       include_once 'ofc-library/open_flash_chart_object.php';
      open_flash_chart_object(550, 350, 'http://'. $_SERVER['SERVER_NAME'].'/wms/chart-data6.php?cond='.$cond.'&op='.$op.'&from='.$date1_match.'&to='.$date2_match, false);
	 // echo $ipnc_rejqty."fi--qty";
 ?>
</td>
<td  width=40% align="left" valign="top" id="details">
<table border=1 cellpadding=6 cellspacing=0>
<tr>
<tr  bgcolor="#FFCC00">
<td bgcolor="#FFFFFF"><span class="labeltext"><b>No. of PRN's<br>worked</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><a href="operator_drilldown.php?op=<?php echo $op?>&cond=<?php echo $cond?>&from=<?php echo $date1_match?>&to=<?php echo $date2_match?>&condnc=<?php echo $condnc?>&to_rejqty=<?php echo $ipnc_rejqty?>"><?php echo $crn_count?></td>
<tr>
<tr  bgcolor="#FFCC00">
<td bgcolor="#FFFFFF"><span class="labeltext"><b>No. of Days<br>worked</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $worked_days ?></td>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Total Qty<br>Prod</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%d",( $total_qty+$total_qty_op))?></td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>No. of Rej CRN</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $rejcount?></td>
</tr>
<!--<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Est Qty</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%d",$qty_est)?></td>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Gain/Loss</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%d",$gain_loss)?></td>
</tr>-->
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Rej Qty (FI)</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo round($finc_rejqty)?></td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Rej Qty(Inprocess)</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo round($ipnc_rejqty)?></td>
</tr>

<!--<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>NC</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $ncnum?></td>
</tr>-->
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Total Rej<br>Cost</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext">Rs. <?php printf("%.2f",$tot_rej_cost)?></td><tr>
<tr>
<!--
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Total RM<br>Cost</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext">Rs. <?php printf("%.2f",$totRMcost)?></td><tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Run Time Eff</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%.2f%s",$eff_runtime,'%')?></td>
</tr>
-->
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Average Time Eff </b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%.2f%s",$net_eff,'%')?></td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Total % Rej</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%.2f%s",$total_per_rej,'%')?></td>
</tr>
</table>
</td></tr>
<table width=70% border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
</table>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">F8401-S</td>
            <td colspan=2><span class="labeltext">Rev No:1 dt July 7, 2010 (new operator eff stats)</td>
		    <td colspan=2><span class="labeltext">This is ERP generated information - Signature not required</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>
</table>
</td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table>
</FORM>
</table>
</body>
</html>
