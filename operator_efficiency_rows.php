<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = March 15,2005                =
// Filename:operator_efficiency_rows           =
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

$operator = $_REQUEST['operator'];
//echo $operator;
$cond = $_SESSION['cond'];
//echo $cond;
$rejtimearr = array();

 $rec_arr = array();
 $crn_arr = array();
 ?>
 <link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/review.js"></script>

<html>
<head>
<title>Operator data</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
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


<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Operator: <?php echo $operator ?></b></center></td>

        </tr>
        <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td rowspan=2><span class="labeltext"><p align="center">WO/PRN</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Date</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Shift</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">M/C</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Stage</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Qty</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Qty<br>Rej</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Rej<br>Time</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Mark<br>Up+/Down-</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Idle</p></font></td>
            <td colspan=2 bgcolor="#00DDFF"><span class="labeltext"><p align="center">Oper Time</p></font></td>
            <td colspan=3 bgcolor="#00DDFF"><span class="labeltext"><p align="center">Master Time</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">RT<br>Lost/Gain</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">ST<br> Lost/Gain</p></font></td>

        </tr>
        <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="center">ST</p></font></td>
           <td><span class="labeltext"><p align="center">RT</p></font></td>
           <td><span class="labeltext"><p align="center">ST</p></font></td>
           <td><span class="labeltext"><p align="center">RT TM</p></font></td>
           <td><span class="labeltext"><p align="center">RT</p></font></td>
        </tr>
<?php
 $result_rev=$newreport->getrev_crn($operator,$cond);
 $result_rev4op=$newreport->getoperdetails($operator,$cond);
 if(mysql_num_rows($result_rev) != 0)
{
 while($myrow_crn_rev=mysql_fetch_row($result_rev))
 {
    $rec_arr[]=$myrow_crn_rev[4];
    $crn_arr[]=$myrow_crn_rev[0];
 }
//print_r($rec_arr);
$result = $newreport->getopdrilldown($operator,$cond,$rec_arr);
//$result4rejtime = $newreport->getopdrilldown($operator,$cond);
/*while($myrow4rejtime = mysql_fetch_row($result4rejtime))
{
 if($myrow4rejtime[20] != 0)
 {
  $result4master_rejtime = $newreport->getmaster_rejtime($myrow4rejtime[0],$myrow4rejtime[16],$myrow4rejtime[20]);
  $myrow4master_rejtime = mysql_fetch_row($result4master_rejtime);
  $rejtimearr["'" . $myrow4rejtime[0] . $myrow4rejtime[16] . "'"] = $myrow4master_rejtime[2];
 }
 else
 {
  $rejtimearr["'" . $myrow4rejtime[0] . $myrow4rejtime[16] ."'"] = 0;
 }
}*/
$result4settime = $newreport->getsettime4row($operator,$cond,$rec_arr);
//$master_settimearr = array();
while($myrow4settime=mysql_fetch_row($result4settime))
{
   $index = "'" . $myrow4settime[0] . $myrow4settime[1] . $myrow4settime[2] . $myrow4settime[3] . $myrow4settime[6] ."'";
   $master_settimearr[$index] = $myrow4settime[4];
//echo  "<br>$index --";
}
//echo sizeof($master_settimearr);
//print_r($master_settimearr);
?>


<?php
        $dispflag = 0;
        $total_rejtime = 0;
        $total_idealtime = 0;
        $total_markup_time = 0;
        $total_markdown_time = 0;
        $total_op_settime = 0;
        $total_op_runtime = 0;
        $total_master_settime = 0;
        $total_master_runtime = 0;
        $total_run_lossrgain = 0;
        $total_set_lossrgain = 0;
        $total_mc_runtime = 0;
        while($myrow=mysql_fetch_row($result))
        {
            $index = "'" . $myrow[1] . $myrow[0] . $myrow[6] . $myrow[2] . $myrow[16] . "'";

           if ($dispflag == 0)
           {
              echo "<tr bgcolor=\"#FFFFFF\">";
              $dispflag = 1;
           }
           else 
           {
              echo "<tr bgcolor=\"#DEDEDE\">";
              $dispflag = 0;
           }
?>
             <td><span class="tabletext"><?php echo $myrow[6] . '/' . $myrow[0] ?></td>
             <td><span class="tabletext"><?php echo $myrow[1] ?></td>
             <td><span class="tabletext"><?php echo $myrow[2] ?></td>
             <td><span class="tabletext"><?php echo $myrow[18] ?></td>
             <td><span class="tabletext"><?php echo $myrow[16] ?></td>
             <td><span class="tabletext"><?php echo $myrow[17] ?></td>
             <td><span class="tabletext"><?php echo $myrow[20] ?></td>
             <td><span class="tabletext"><?php if($myrow[20] != 0)
              {
              $result4master_rejtime = $newreport->getmaster_rejtime($myrow[0],$myrow[16],$myrow[20],$rec_arr);
              $myrow4master_rejtime = mysql_fetch_row($result4master_rejtime);
              $rejection_time = $myrow4master_rejtime[2];
              echo $rejection_time;
              $total_rejtime += $rejection_time;
              }
              else
              {
              echo '0';
              $rejection_time=0;
              }?></td>
              <td><span class="tabletext"><?php
                printf("%.0f",$myrow[21]);
                  echo ' m/';
                 printf("%.0f",$myrow[22]);
                 echo ' m';
                $total_markup_time += $myrow[21];
                $total_markdown_time += $myrow[22];
               ?></td>
             <td><span class="tabletext"><?php echo "$myrow[19] m" ?></td>
             <td><span class="tabletext"><?php echo "$myrow[7] t" ?></td>
             <td><span class="tabletext"><?php echo "$myrow[3] m" ?></td>
             <td><span class="tabletext">
<?php 
             if (isset($master_settimearr[$index]))
             {
                     printf("%.2f",$master_settimearr[$index]);
                     echo ' m';
                     
             }
             else {
                     echo "NA";
             }

?>
             </td>
             <td><span class="tabletext"><?php
             printf("%.2f",$myrow[17]!=0?($myrow[4]/$myrow[17]):0);
              //echo $myrow[4];
              echo ' m'; ?></td>
             <td><span class="tabletext"><?php
              printf("%.2f",$myrow[4]);
              //echo $myrow[4];
              echo ' m'; ?></td>

<?php
             $rtloss_gain=(($myrow[4])-($myrow[3]+$rejection_time+$myrow[21]-$myrow[22]));
             if ($rtloss_gain >= 0) {
?>
                <td><span class="tabletext"><?php  printf("%.2f",$rtloss_gain); ?></td>
                
<?php
             }
             else {
?>
                 <td bgcolor="#FF0000"><span class="tabletext"><b><?php  printf("%.2f",$rtloss_gain); ?></b></td>
<?php
             }

?>


<?php
             if (isset($master_settimearr[$index]))
             {
                  $st = $master_settimearr[$index] - $myrow[7] ;
             }
             else {
                     $st = "NA";
             }
             if ($st != "NA") {
                 if ($st >= 0) {
?>
                    <td><span class="tabletext"><?php echo $st ?></td>
<?php
                 }
                 else {
?>
                     <td bgcolor="#FF0000"><span class="tabletext"><b><?php echo $st ?></b></td>
<?php
                 }
             }
             else 
             {
?>
                <td><span class="tabletext"><?php echo "NA"; ?></td>

<?php
             }
?>

           </tr>

<?php

       $total_idealtime += $myrow[19];
       $total_op_settime += $myrow[7];
       $total_op_runtime += $myrow[3];
       $total_master_settime += $master_settimearr[$index];
       $total_master_runtime += $myrow[4];
       $total_run_lossrgain += $rtloss_gain;
       $total_set_lossrgain += $st;
       $total_mc_runtime += $myrow[17]!=0?($myrow[4]/$myrow[17]):0;
     }
?>
<tr><td colspan=7 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
<td bgcolor="#00DDFF"><span class="tabletext"><?php echo "$total_rejtime m";?></td>
<td bgcolor="#00DDFF"><span class="tabletext"><?php echo "$total_markup_time m" .'/'."$total_markdown_time m";?></td>
<td bgcolor="#00DDFF"><span class="tabletext"><?php echo "$total_idealtime m";?></td>
<td bgcolor="#00DDFF"><span class="tabletext"><?php echo "$total_op_settime m";?></td>
<td bgcolor="#00DDFF"><span class="tabletext"><?php echo "$total_op_runtime m";?></td>
<td bgcolor="#00DDFF"><span class="tabletext"><?php echo "$total_master_settime m";?></td>
<td bgcolor="#00DDFF"><span class="tabletext"><?php echo "$total_mc_runtime m";?></td>
<td bgcolor="#00DDFF"><span class="tabletext"><?php
                                                   printf("%.2f",$total_master_runtime);
                                                   echo " m";
                                              ?></td>
<td bgcolor="#00DDFF"><span class="tabletext"><?php
                                                   printf("%.2f",$total_run_lossrgain);
                                                   echo " m";
                                                   ?></td>
<td bgcolor="#00DDFF"><span class="tabletext"><?php echo "$total_set_lossrgain m";?></td>

<?php
  }
?>
</table>
<?php
  if(mysql_num_rows($result_rev4op) != 0)
  {
  ?>
   <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Time Master Not Present<br> For Following CRN's</b></center></td>

        </tr>
    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
    <tr bgcolor="#FFFFFF">
            <td rowspan=2><span class="labeltext"><p align="center">WO/PRN</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Date</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Shift</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">M/C</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Stage</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Qty</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Qty<br>Rej</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Rej<br>Time</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Mark<br>Up+/Down-</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">Idle</p></font></td>
            <td colspan=2 bgcolor="#00DDFF"><span class="labeltext"><p align="center">Oper Time</p></font></td>
            <td colspan=3 bgcolor="#00DDFF"><span class="labeltext"><p align="center">Master Time</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">RT<br>Lost/Gain</p></font></td>
            <td rowspan=2><span class="labeltext"><p align="center">ST<br> Lost/Gain</p></font></td>

        </tr>
        <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="center">ST</p></font></td>
           <td><span class="labeltext"><p align="center">RT</p></font></td>
           <td><span class="labeltext"><p align="center">ST</p></font></td>
           <td><span class="labeltext"><p align="center">RT TM</p></font></td>
           <td><span class="labeltext"><p align="center">RT</p></font></td>
        </tr>
 <?php

   while($myoprow=mysql_fetch_row($result_rev4op))
   {
  ?>         <tr bgcolor="#FFFFFF">
             <td><span class="tabletext"><?php echo $myoprow[4] . '/' . $myoprow[0] ?></td>
             <td><span class="tabletext"><?php echo $myoprow[1] ?></td>
             <td><span class="tabletext"><?php echo $myoprow[2] ?></td>
             <td><span class="tabletext"><?php echo $myoprow[10] ?></td>
             <td><span class="tabletext"><?php echo $myoprow[8] ?></td>
             <td><span class="tabletext"><?php echo $myoprow[9] ?></td>
             <td><span class="tabletext"><?php echo $myoprow[12] ?></td>
             <td><span class="tabletext">&nbsp;</td>
             <td><span class="tabletext"><?php echo "$myoprow[13] m".'/'."$myoprow[14] m" ?></td>
             <td><span class="tabletext"><?php echo "$myoprow[11] m" ?></td>
              <td><span class="tabletext"><?php echo "$myoprow[5] m" ?></td>
              <td><span class="tabletext"><?php echo "$myoprow[3] m" ?></td>
              <td><span class="tabletext">&nbsp;</td>
              <td><span class="tabletext">&nbsp;</td>
              <td><span class="tabletext">&nbsp;</td>
             <td><span class="tabletext">&nbsp;</td>
             <td><span class="tabletext">&nbsp;</td>
             </tr>

             <?php
             $total_markup_time += $myrow[13];
             $total_markdown_time += $myrow[14];
             $total_idealtime += $myrow[11];
             $total_op_settime += $myrow[5];
             $total_op_runtime += $myrow[3];
             
   }
   ?>
   <tr><td colspan=7 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
<td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
<td bgcolor="#00DDFF"><span class="tabletext"><?php echo "$total_markup_time m" .'/'."$total_markdown_time m";?></td>
<td bgcolor="#00DDFF"><span class="tabletext"><?php echo "$total_idealtime m";?></td>
<td bgcolor="#00DDFF"><span class="tabletext"><?php echo "$total_op_settime m";?></td>
<td bgcolor="#00DDFF"><span class="tabletext"><?php echo "$total_op_runtime m";?></td>
<td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
<td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
<td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
<td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
<td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
<?php
  
  }
?>
</table>
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
