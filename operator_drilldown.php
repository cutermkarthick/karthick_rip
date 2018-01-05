<?php
//
//==============================================
// Author: FSI                                                                       =
// Date-written = March 15,2005                                           =
// Filename:operator_drilldown.php                                   =
// Copyright (C) FluentSoft Inc.                                          =
// Contact bmandyam@fluentsoft.com                              =
// Revision: v1.0 OWT                                                         =
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
include('classes/reportClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newreport = new report;

$operator = $_REQUEST['op'];
//echo $operator;
$cond = $_SESSION['cond'];
//echo $cond;
$condnc= $_SESSION['condnc'];
$from = $_REQUEST['from'];
$to = $_REQUEST['to'];

 if($from != '0000-00-00' && $from != '' && $from != 'NULL')
 {
      $datearr = split('-', $from);
      $d=$datearr[2];
      $m=$datearr[1];
      $y=$datearr[0];
      $x=mktime(0,0,0,$m,$d,$y);
      $fromdate=date("M j, Y",$x);
 }
 else
 {
      $fromdate="";
 }

 if($to != '0000-00-00' && $to != '' && $to != 'NULL')
 {
      $datearr = split('-', $to);
      $d=$datearr[2];
      $m=$datearr[1];
      $y=$datearr[0];
      $x=mktime(0,0,0,$m,$d,$y);
      $todate=date("M j, Y",$x);
 }
 else
 {
      $todate="";
 }
 
$rejtimearr = array();
$rec_arr = array();
$crn_arr = array();

 $result_rev=$newreport->getrev_crn($operator,$cond);
 $result_rev4op=$newreport->getoperdetails($operator,$cond);
 //echo mysql_num_rows($result_rev4op)."--------------".mysql_num_rows($result_rev);

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/review.js"></script>

<html>
<head>
<title>Operator Details</title>
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
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0>
    <tr>
        <td><span class="pageheading"><b>Operator Efficiency - Drilldown Details</b></td>

    </tr>


 <tr>

<td colspan=2>
<?php
$resultRev=$newreport->getcrnstagenumdata($operator,$cond);
$result_stRev=$newreport->getcrnstagenum_data($operator,$cond);
//echo mysql_num_rows($result_stRev)."---numrow";
if(mysql_num_rows($resultRev) != 0)
{
if(mysql_num_rows($result_rev) != 0)
{

 while($myrow_crn_rev=mysql_fetch_row($result_rev))
 {
    $rec_arr[]=$myrow_crn_rev[4];
    $crn_arr[]=$myrow_crn_rev[0];
    //$stage_num[]=
 }

$result = $newreport->geteffdetails($operator,$cond,$rec_arr);
?>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Operator: <?php echo $operator ?>&nbsp&nbspFrom:<?php echo $fromdate?>&nbspTo:<?php echo $todate?></b></center></td>
        </tr>
 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="center">PRN</p></font></td>
             <td><span class="labeltext"><p align="center">Wonum</p></font></td>
            <td><span class="labeltext"><p align="center">Stage Date</p></font></td>
            <td><span class="labeltext"><p align="center">Stage</p></font></td>
            <td><span class="labeltext"><p align="center">Act Qty</p></font></td>
            <td><span class="labeltext"><p align="center">Est Time</p></font></td>
            <td><span class="labeltext"><p align="center">Actual Time</p></font></td>
            <td><span class="labeltext"><p align="center">Est Qty</p></font></td>
            <td><span class="labeltext"><p align="center">Rej Time</p></font></td>
            <td><span class="labeltext"><p align="center">Inprocess<br> Rej Qty</p></font></td>
             <td><span class="labeltext"><p align="center">Final Insp <br>Rejection<br>(NC Rej)</p></font></td>
            <td><span class="labeltext"><p align="center">Gain</p></font></td>
            <td><span class="labeltext"><p align="center">Loss</p></font></td>
        </tr>

<?php   
	    $prev_wonum='#';
        $total_act_qty = 0;
        $total_est_qty = 0;
        $total_rej_qty = 0;
        $total_est_time = 0;
        $total_act_time = 0;
        $total_rej_time = 0;
        $total_rejnc_qty=0;  $loss=0;$gain=0;
		$crn_count1=0;$final_insp=0;
        while($myrow=mysql_fetch_row($result))
        {
             $rejtime = 0;
             $est_qty = $myrow[8] != 0? round($myrow[9]/$myrow[8]):0;
             $loss_gain = ($myrow[10]-$est_qty);
             if($loss_gain>0)
             {
              $gain=$loss_gain;
             }
             else
              {
               $gain=0;
              }
              if($loss_gain<0)
             {
              $loss=$loss_gain;
             } else
             {
               $loss=0;
             }
             $result4eff = $newreport->geteffdetails4summary($op,$cond,$rec_arr);
             $myrow4eff=mysql_fetch_row($result4eff);
             $result4rejtime = $newreport->getmaster_rejtime($myrow[0],$myrow[1],$myrow[11],$rec_arr);
             $myrow4rejtime=mysql_fetch_row($result4rejtime);
             $rejtime =  $myrow4rejtime[2];
             
             $total_act_qty += $myrow[10];
             $total_est_qty += $est_qty;
             $total_rej_qty += $myrow[11];
             $total_est_time += $myrow[8];
             $total_act_time += $myrow[9];
             $total_rej_time += $rejtime;
             /*else
             {
                if($prev_stage !=$myrow[1])
                {
                  $total_rejnc_qty += $mycrnipnc[2];
                  $prev_stage=$myrow[1];
                }

             }
             */

              $resultipnc=$newreport->getnc4operators4drilldown($myrow[13],$operator,$condnc,$myrow[0],$myrow[1]);
              $mycrnipnc=mysql_fetch_row($resultipnc);
		    $resultfinc=$newreport->getfinc4operators4drilldown($myrow[13],$operator,$condnc,$myrow[0],$myrow[1]);
              $mycrnfinc=mysql_fetch_row($resultfinc);

			 // echo $prev_wonum."----".$myrow[13]."<br>";
               if($prev_wonum != $myrow[13])
             {    //echo "$prev_st-----------$prev_wonum<BR> ";
                  $prev_st="#";
                  if($prev_st!=$myrow[1])
                  {
                   $total_rejnc_qty += $mycrnipnc[2];
				   $total_firejnc_qty += $mycrnfinc[2];
                   $prev_st=$myrow[1];
                  }

                  $prev_wonum = $myrow[13];
             }else
             {
                  if($prev_st!=$myrow[1])
                  {
                   $total_rejnc_qty += $mycrnipnc[2];
				   $total_firejnc_qty += $mycrnfinc[2];
                   $prev_st=$myrow[1];
                  }
             }

   ?>
             <tr bgcolor="#FFFFFF">
             <td align="center"><span class="tabletext"><?php echo $myrow[0] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myrow[13] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myrow[12] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myrow[1] ?></td>
             <td align="center"><span class="tabletext"><?php echo number_format($myrow[10],2,".",""); ?></td>
             <td align="center"><span class="tabletext"><?php echo  round($myrow[8]);  ?></td>
             <td align="center"><span class="tabletext"><?php echo $myrow[9] ?></td>
             <td align="center"><span class="tabletext"><?php echo $est_qty ?></td>
             <td align="center"><span class="tabletext"><?php printf('%.2f',$rejtime); ?></td>
             
             <td align="center"><span class="tabletext"><?php echo round($mycrnipnc[2]); ?></td>
			 <td align="center"><span class="tabletext"><?php echo round($mycrnfinc[2]); ?></td>
             <td align="center"><span class="tabletext"><?php echo round($gain); ?></td>
             <td align="center"><span class="tabletext"><?php echo round($loss); ?></td>
             </tr>
<?php
        }
        //$total_rejnc_qty
        
?>
     <tr><td colspan=4 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
     <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php echo round($total_act_qty)?></td>
     <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php printf('%.2f',$total_est_time); ?></td>
     <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php printf('%.2f',$total_act_time); ?></td>
     <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php echo round($total_est_qty) ?></td>
     <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php printf('%.2f',$total_rej_time); ?></td>
      <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php echo round($_REQUEST['to_rejqty']) ?></td>
	  <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php echo round($total_firejnc_qty) ?></td>
     <td colspan=2 align="center" bgcolor="#00DDFF"><span class="tabletext"><?php echo round($total_act_qty-$total_est_qty)?></td>

   </table>
   <?php
   }
   //}
   if(mysql_num_rows($result_rev4op) != 0)
  {
  
        $total_act_qty4op = 0;
        $total_est_qty4op = 0;
        $total_rej_qty4op = 0;
        $total_est_time4op = 0;
        $total_act_time4op = 0;
        $total_rej_time4op = 0;
		$crn_count2=0;
   ?>
       <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Time Master Not Present For Following CRN's</b></center></td>

        </tr>
    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="center">PRN</p></font></td>
            <td><span class="labeltext"><p align="center">Wonum</p></font></td>
            <td><span class="labeltext"><p align="center">Stage Date</p></font></td>
            <td><span class="labeltext"><p align="center">Stage</p></font></td>
            <td><span class="labeltext"><p align="center">Act Qty</p></font></td>
            <td><span class="labeltext"><p align="center">Setting Time</p></font></td>
            <td><span class="labeltext"><p align="center">Running Time</p></font></td>
            <td><span class="labeltext"><p align="center">Est Qty</p></font></td>
            <td><span class="labeltext"><p align="center">Rej Qty(In Process)</p></font></td>
            <td><span class="labeltext"><p align="center">Rej Qty(FI)</p></font></td>
            <td><span class="labeltext"><p align="center">Gain/Loss</p></font></td>
        </tr>
 <?php

   while($myoprow=mysql_fetch_row($result_rev4op))
   {

				   $resultncoprow=$newreport->getnc4operators4drilldown($myoprow[4],$operator,$condnc,$myoprow[0],$myoprow[8]);
              $mycrnipncoprow=mysql_fetch_row($resultncoprow);
			  $resultfincoprow=$newreport->getfinc4operators4drilldown($myoprow[4],$operator,$condnc,$myoprow[0],$myoprow[8]);
              $mycrnfincoprow=mysql_fetch_row($resultfincoprow);
  ?>         <tr bgcolor="#FFFFFF">
             <td align="center"><span class="tabletext"><?php echo $myoprow[0] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myoprow[4] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myoprow[1] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myoprow[8] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myoprow[9] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myoprow[3] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myoprow[5] ?></td>
             <td align="center"><span class="tabletext">&nbsp;</td>
             <td align="center"><span class="tabletext"><?php echo round($mycrnipncoprow[2]); ?></td>
			 <td align="center"><span class="tabletext"><?php echo round($mycrnfincoprow[2]); ?></td>
             <td align="center"><span class="tabletext">&nbsp;</td>
             </tr>

             <?php
             $total_act_qty4op += $myoprow[9];
             //$total_est_qty += $est_qty;
             $total_rej_qty4op += $myoprow[12];
             $total_est_time4op += $myoprow[5];
             $total_act_time4op += $myoprow[3];       
			
   }
   ?>
     <tr><td colspan=4 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
     <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php echo round($total_act_qty4op)?></td>
     <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php printf('%.2f',$total_act_time4op); ?></td>
     <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php printf('%.2f',$total_est_time4op); ?></td>
     <td align="center" bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
      <td align="center" bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
     <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php echo round($total_rej_qty4op) ?></td>
     <td align="center" colspan=2 bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
      </table>
   <?php
   }
   ?>
   </table>
   <?php
   }if(mysql_num_rows($result_stRev) != 0)
   {

   while($myrow_crn_rev=mysql_fetch_row($result_rev))
 {
    $rec_arr[]=$myrow_crn_rev[4];
    $crn_arr[]=$myrow_crn_rev[0];
 }
  $result = $newreport->geteff_details($operator,$cond,$rec_arr);
  
   ?>
   <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Time Master(Stage) Not Present For Following CRN's</b></center></td>
        </tr>
 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="center">PRN</p></font></td>
             <td><span class="labeltext"><p align="center">Wonum</p></font></td>
            <td><span class="labeltext"><p align="center">Stage Date</p></font></td>
            <td><span class="labeltext"><p align="center">Stage</p
			></font></td>
            <td><span class="labeltext"><p align="center">Act Qty</p></font></td>
            <td><span class="labeltext"><p align="center">Est Time</p></font></td>
            <td><span class="labeltext"><p align="center">Actual Time</p></font></td>
            <td><span class="labeltext"><p align="center">Est Qty</p></font></td>
            <td><span class="labeltext"><p align="center">Rej Time</p></font></td>
            <td><span class="labeltext"><p align="center">Inprocess<br> Rej Qty</p></font></td>
             <td><span class="labeltext"><p align="center">Final Insp <br>Rejection</p></font></td>
            <td><span class="labeltext"><p align="center">Gain</p></font></td>
            <td><span class="labeltext"><p align="center">Loss</p></font></td>
        </tr>

<?php   $prev_wonum='#';
        $total_act_qty = 0;
        $total_est_qty = 0;
        $total_rej_qty = 0;
        $total_est_time = 0;
        $total_act_time = 0;
        $total_rej_time = 0;
        $total_rejnc_qty=0;  $loss=0;$gain=0;		
        while($myrow=mysql_fetch_row($result))
        {
             $rejtime = 0;
             $est_qty = $myrow[8] != 0? round($myrow[9]/$myrow[8]):0;
             $loss_gain = ($myrow[10]-$est_qty);
             if($loss_gain>0)
             {
              $gain=$loss_gain;
             }
             else
              {
               $gain=0;
              }
              if($loss_gain<0)
             {
              $loss=$loss_gain;
             } else
             {
               $loss=0;
             }
             $result4eff = $newreport->geteffdetails4summary($op,$cond,$rec_arr);
             $myrow4eff=mysql_fetch_row($result4eff);
             $result4rejtime = $newreport->getmaster_rejtime($myrow[0],$myrow[1],$myrow[11],$rec_arr);
             $myrow4rejtime=mysql_fetch_row($result4rejtime);
             $rejtime =  $myrow4rejtime[2];

             $total_act_qty += $myrow[10];
             $total_est_qty += $est_qty;
             $total_rej_qty += $myrow[11];
             $total_est_time += $myrow[8];
             $total_act_time += $myrow[9];
             $total_rej_time += $rejtime;
             /*else
             {
                if($prev_stage !=$myrow[1])
                {
                  $total_rejnc_qty += $mycrnipnc[2];
                  $prev_stage=$myrow[1];
                }

             }
             */

              $resultnc=$newreport->getnc4operators4drilldown($myrow[13],$operator,$condnc,$myrow[0],$myrow[1]);
              $mycrnipnc=mysql_fetch_row($resultnc);
			  $resultfinc=$newreport->getfinc4operators4drilldown($myrow[13],$operator,$condnc,$myrow[0],$myrow[1]);
              $mycrnfinc=mysql_fetch_row($resultfinc);
			  
               if($prev_wonum != $myrow[13])
             {    //echo "$prev_st-----------$prev_wonum<BR> ";
                  $prev_st="#";
                  if($prev_st!=$myrow[1])
                  {
                   $total_rejnc_qty += $mycrnipnc[2];
                   $prev_st=$myrow[1];
                  }

                  $prev_wonum = $myrow[13];
             }else
             {
                  if($prev_st!=$myrow[1])
                  {
                   $total_rejnc_qty += $mycrnipnc[2];
                   $prev_st=$myrow[1];
                  }
             }

   ?>
             <tr bgcolor="#FFFFFF">
             <td align="center"><span class="tabletext"><?php echo $myrow[0] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myrow[13] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myrow[12] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myrow[1] ?></td>
             <td align="center"><span class="tabletext"><?php echo number_format($myrow[10],2,".",""); ?></td>
             <td align="center"><span class="tabletext"><?php echo $myrow[8] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myrow[9] ?></td>
             <td align="center"><span class="tabletext"><?php echo $est_qty ?></td>
             <td align="center"><span class="tabletext"><?php printf('%.2f',$rejtime); ?></td>
              <td align="center"><span class="tabletext"><?php echo round($mycrnipnc[2]); ?></td>
			 <td align="center"><span class="tabletext"><?php echo round($mycrnfinc[2]); ?></td>
             <td align="center"><span class="tabletext"><?php echo round($gain); ?></td>
             <td align="center"><span class="tabletext"><?php echo round($loss); ?></td>
             </tr>
<?php
        }    
//echo "--------".$_REQUEST['to_rejqty'];
?>
     <tr><td colspan=4 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
     <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php echo round($total_act_qty)?></td>
     <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php printf('%.2f',$total_est_time); ?></td>
     <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php printf('%.2f',$total_act_time); ?></td>
     <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php echo round($total_est_qty) ?></td>
     <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php printf('%.2f',$total_rej_time); ?></td>
     
     <td align="center" bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
	 <td align="center" bgcolor="#00DDFF"><span class="tabletext"><?php echo round($total_rej_qty) ?></td>
     <td colspan=2 align="center" bgcolor="#00DDFF"><span class="tabletext"><?php echo round($total_act_qty-$total_est_qty)?></td>
	 </tr>
 <?php
   }
   ?>

	  <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Operator Entry Not Present For Following CRN's</b></center></td>

        </tr>
    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="center">PRN</p></font></td>
            <td><span class="labeltext"><p align="center">Wonum</p></font></td>
            <td><span class="labeltext"><p align="center">NC Date</p></font></td>
            <td><span class="labeltext"><p align="center">Stage</p></font></td>
            <td><span class="labeltext"><p align="center">Act Qty</p></font></td>
            <td><span class="labeltext"><p align="center">Setting Time</p></font></td>
            <td><span class="labeltext"><p align="center">Running Time</p></font></td>
            <td><span class="labeltext"><p align="center">Est Qty</p></font></td>
            <td><span class="labeltext"><p align="center">Rej Time</p></font></td>
            <td><span class="labeltext"><p align="center">Final <br>Rej Qty</p></font></td>
        </tr>
 <?php
$resultncopfi=$newreport->getncdets4opfi($operator,$condnc,$cond);
   while($myrownc4op=mysql_fetch_row($resultncopfi))
   {
  ?>         <tr bgcolor="#FFFFFF">
             <td align="center"><span class="tabletext"><?php echo $myrownc4op[0] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myrownc4op[2] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myrownc4op[3] ?></td>
             <td align="center"><span class="tabletext">&nbsp;</td>
             <td align="center"><span class="tabletext">&nbsp;</td>
             <td align="center"><span class="tabletext">&nbsp;</td>
             <td align="center"><span class="tabletext">&nbsp;</td>
             <td align="center"><span class="tabletext">&nbsp;</td>
             <td align="center"><span class="tabletext">&nbsp;</td>
             <td align="center"><span class="tabletext"><?php echo $myrownc4op[1] ?></td>
             </tr>
 <?php
   }
   ?>
    <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Operator Entry Not Present For Following CRN's</b></center></td>

        </tr>
    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="center">PRN</p></font></td>
            <td><span class="labeltext"><p align="center">Wonum</p></font></td>
            <td><span class="labeltext"><p align="center">NC Date</p></font></td>
            <td><span class="labeltext"><p align="center">Stage</p></font></td>
            <td><span class="labeltext"><p align="center">Act Qty</p></font></td>
            <td><span class="labeltext"><p align="center">Setting Time</p></font></td>
            <td><span class="labeltext"><p align="center">Running Time</p></font></td>
            <td><span class="labeltext"><p align="center">Est Qty</p></font></td>
            <td><span class="labeltext"><p align="center">Rej Time</p></font></td>
            <td><span class="labeltext"><p align="center">Inprocess<br>Rej Qty</p></font></td>
        </tr>
 <?php
$resultncopip=$newreport->getncdets4opip($operator,$condnc,$cond);
   while($myrowncip4op=mysql_fetch_row($resultncopip))
   {
  ?>         <tr bgcolor="#FFFFFF">
             <td align="center"><span class="tabletext"><?php echo $myrowncip4op[0] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myrowncip4op[2] ?></td>
             <td align="center"><span class="tabletext"><?php echo $myrowncip4op[3] ?></td>
             <td align="center"><span class="tabletext">&nbsp;</td>
             <td align="center"><span class="tabletext">&nbsp;</td>
             <td align="center"><span class="tabletext">&nbsp;</td>
             <td align="center"><span class="tabletext">&nbsp;</td>
             <td align="center"><span class="tabletext">&nbsp;</td>
             <td align="center"><span class="tabletext">&nbsp;</td>
             <td align="center"><span class="tabletext"><?php echo $myrowncip4op[1] ?></td>
             </tr>
 <?php
   }
   ?>
   </table>
   
	</td>
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
</body>
</html>
