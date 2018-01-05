<?php
//==============================================
// Author: FSI                                 =
// Date-written = dec 21, 2007                 =
// Filename: processplaylist.php               =
// Copyright (C) FluentSoft Inc.               =
// Revision: v1.0                              =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];
 include_once('classes/reportClass.php');

   $wo = $_REQUEST['wonum'];
  // echo '--'.$wo;
   $prodn_shift = new report;
   $result = $prodn_shift->get_prod_shift($wo);
   echo '<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
   echo '<tr bgcolor="#EEEFEE"><td colspan=12><span class="heading"><b><center>Production Details for WO '.$wo.'</center></b></td></tr>';
   echo '<tr bgcolor="#FFFFFF">';
   echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>M/C Name</center></b></td>";
   echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>Date</center></b></td>";
   echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>Shift</center></b></td>";
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Operator</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>PRN</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>WO</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Stage</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Setting Time</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Running Time</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Idle Time</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Remarks</center></b></td>';
   echo '</tr>';
   $totalSettime = 0;
   $totalRuntime = 0;
   $totalIdletime = 0;
 while($myrow = mysql_fetch_row($result))
 {
 
    if($myrow[1] != '0000-00-00' && $myrow[1] != '' && $myrow[1] != 'NULL')
              {
                  $datearr = split('-', $myrow[1]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $stdate=date("M j, Y",$x);
              }
              else
              {
                  $stdate = '';
              }
      $totalSettime += (($myrow[8]*60)+$myrow[9]);
      $totalRuntime += (($myrow[10]*60)+$myrow[11]);
      $totalIdletime += (($myrow[12]*60)+$myrow[13]);
    printf('<tr bgcolor="#FFFFFF">');
    echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[0]</td>";
	echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$stdate</td>";
	echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[2]</td>";
	echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[3]</td>";
	echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[4]</td>";
	echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[5]</td>";
	echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[6]</td>";
	echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[7]</td>";
	echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$myrow[8]." h ".$myrow[9]." m</td>";
	echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$myrow[10]." h ".$myrow[11]." m</td>";
	echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$myrow[12]." h ".$myrow[13]." m</td>";
	echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\"><textarea rows=\"2\" cols=\"30\"
                       style=\"background-color:#DDDDDD;\" readonly=\"readonly\">$myrow[14]</textarea>";

 }
 $setTime = floor($totalSettime / 60)." h ". ($totalSettime % 60)." m ";
 $runTime = floor($totalRuntime / 60)." h ". ($totalRuntime % 60)." m ";
 $idleTime = floor($totalIdletime / 60)." h ". ($totalIdletime % 60)." m ";
 echo '<tr>';
 echo '<td  colspan=8 bgcolor="#EEEFEE" align="right"><span class="heading"><b>Total</b></td>';
 echo "<td colspan=1 bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$setTime</td>";
 echo "<td colspan=1 bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$runTime</td>";
 echo "<td colspan=1 bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$idleTime</td>";
 echo "<td colspan=1 bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
 echo '</table>';

?>
