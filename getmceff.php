<?php
//==============================================
// Author: FSI                                 =
// Date-written = Aug 27, 2008                 =
// Filename: getmceff                         =
// Copyright (C) FluentSoft Inc.               =
// Revision: v1.0                              =
//==============================================
include_once('classes/reportClass.php');
include_once 'ofc-library/open_flash_chart_object.php';
       $mcname = $_REQUEST['mcname'];
       $tblid = $_REQUEST['tblid'];
       $divid = $_REQUEST['divid'];
       $stdate = $_REQUEST['stdate'];
       $enddate = $_REQUEST['enddate'];
       $cond = "op.st_date >= '$stdate' and op.st_date <= '$enddate'";
      // $_SESSION['ccond'] = $cond;
       //echo $cond
//  echo "INside getmceff";
// echo '<table id="$tblid" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
//  echo "<tr><td>Hello World</td></tr>";


   $newreport = new report;
   $tbldivid=$tblid.'div';
   //$result = $newreport->get_mccost($mcname,$cond);
   echo "<table id=\"$tblid\" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\">";
   echo "<tr>
         <td width=40%  bgcolor=\"#FFFFFF\"><span class=\"labeltext\"><b>From &nbsp&nbsp</b>
         <input type=\"text\" name=\"f$tblid\" id=\"f$tblid\" size=10 value=\"$stdate\"
            style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
           onkeypress=\"javascript: return checkenter(event)\">
         <img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\" onclick='GetDate(\"f$tblid\")'>
          <span class=\"labeltext\"><b>&nbsp;&nbsp;To</b>
         <input type=\"text\" name=\"t$tblid\" id=\"t$tblid\" size=10 value=\"$enddate\"
          style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
          onkeypress=\"javascript: return checkenter(event)\">
         <img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\" onclick='GetDate(\"t$tblid\")'>
         <input type=\"image\" src=\"images/bu-get.gif\"";
     echo "onclick=\"javascript: getmc_eff('$mcname','$divid','$tblid','f$tblid','t$tblid')\">";
     echo '</td>';
     echo "<td width=30%  align=\"center\" bgcolor=\"#00DDFF\"><span class=\"heading\"><b>$mcname</b></td>";
     echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
     echo "<input type=\"image\" name=\"Print\" src=\"images/bu-print.gif\" value=\"Get\"
          onclick=\"javascript: openPrintWindow(new Array('chart$tblid','$tbldivid'))\">";
     echo '</td>';

	 echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
     echo "<input type=\"image\" name=\"Print\" src=\"images/printchart.gif\" value=\"Get\"
          onclick=\"javascript: openPrintWindow(new Array('chart$tblid','bmv61div'))\">";
     echo '</td>';

     echo '</tr>
     </table>';
     echo "<div id=\"$tbldivid\">
     <table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\">
        <tr>
            <td bgcolor=\"#00DDFF\" width=20%><span class=\"heading\"><b>PRN</b></td>
            <td bgcolor=\"#00DDFF\" width=10%><span class=\"heading\"><b>Stage</b></td>
            <td bgcolor=\"#00DDFF\" width=10%><span class=\"heading\"><b>Qty Mfg</b></td>
            <td bgcolor=\"#00DDFF\"><span class=\"heading\"><b>Est<br>Time</b></td>
            <td bgcolor=\"#00DDFF\"><span class=\"heading\"><b>Actual<br>Time</b></td>
            <td bgcolor=\"#00DDFF\"><span class=\"heading\"><b>Rej<br>Qty</b></td>
            <td bgcolor=\"#00DDFF\"><span class=\"heading\"><b>Rej<br>Time</b></td>
            <td bgcolor=\"#00DDFF\" width=10%><span class=\"heading\"><b>Lost or<br>Gained</b></td>

        </tr>";
/*
        $cond = "(to_days(op.st_date)-to_days('1582-01-01') > 0 ||
                    op.st_date = '0000-00-00' ||
                    op.st_date = 'NULL' ) and
           (to_days(op.st_date)-to_days('2050-12-31') < 0 ||
                    op.st_date = '0000-00-00' ||
                    op.st_date = 'NULL')";
*/
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab($mcname,$cond);
         while ($myrow = mysql_fetch_row($result)) {
            echo '<tr>';
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[1]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[2]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">";
            printf("%.2f",$myrow[3]);
            echo "</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">";
            printf("%.2f",($myrow[4]+$myrow[7]));
            echo "</td>";
            $total_est_time += ($myrow[4]+$myrow[7]);
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">";
            printf("%.2f",($myrow[5]+$myrow[6]));
            echo "</td>";
            $total_actual_time += ($myrow[5]+$myrow[6]);
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[8]</td>";
            if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 //echo $rej_time;
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                 //echo $rej_time;
                 $total_rej_time += $rej_time;
               }
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">";
            printf("%.2f",$rej_time);
            echo "</td>";
            $lossrgain=(($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">";
            printf("%.2f",$lossrgain);
            echo "</td>";
            $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
            echo '</tr>';
         }
         unset($rej_time);
         echo'<tr bgcolor="#FFFFFF">';
         echo'<td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>';
         echo "<td bgcolor=\"#00DDFF\"><span class=\"tabletext\">";
         printf("%.2f",$total_est_time);
         echo "</td>";
         echo "<td bgcolor=\"#00DDFF\"><span class=\"tabletext\">";
         printf("%.2f",$total_actual_time);
         echo "</td>";
         echo "<td bgcolor=\"#00DDFF\"><span class=\"tabletext\"></td>";
         echo "<td bgcolor=\"#00DDFF\"><span class=\"tabletext\">";
         printf("%.2f",$total_rej_time);
         echo "</td>";
         echo "<td bgcolor=\"#00DDFF\"><span class=\"tabletext\">";
         printf("%.2f",$total_lossrgain_time);
         echo "</td>";
         echo '</tr>';
         echo '</table>';
         echo "<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\">";
         echo '<tr bgcolor="#FFFFFF">';
         echo '<td colspan=4 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>';
         $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
         echo'<td colspan=4 bgcolor="#99FFFF"><span class="tabletext">';
         printf("%.2f",$machine_eff);
         echo '%';
         echo '</td>';
         echo '</tr>';          

 ?> 
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext">CIMTOOLS PRIVATE LIMITED</td>
        </tr>

</table>
<?php
         echo '</div>';
         echo '</div>';

         echo '<table>';
         echo '<tr>';
         echo "<td id=\"chart$tblid\">";
         //echo 'table done';
         $mc=urlencode($mcname);
        // $wcond = htmlentities($cond);
         open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$stdate.'&edate='.$enddate, false );
         echo "<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\">";
         echo '<tr bgcolor="#FFFFFF">';
         echo '<td colspan=4 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>';
         $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
         echo'<td colspan=4 bgcolor="#99FFFF"><span class="tabletext">';
         printf("%.2f",$machine_eff);
         echo '%';
         echo '</td>';
         echo '</tr>';          

 ?> 
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext">CIMTOOLS PRIVATE LIMITED</td>
        </tr>
         
<?php
         echo '</td></tr></table>';
?>


