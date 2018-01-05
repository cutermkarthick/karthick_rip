<?php
//==============================================
// Author: FSI                                 =
// Date-written = Aug 27, 2008                 =
// Filename: getmccost                         =
// Copyright (C) FluentSoft Inc.               =
// Revision: v1.0                              =
//==============================================
include_once('classes/reportClass.php');
       $mcname = $_REQUEST['mcname'];
       $tblid = $_REQUEST['tblid'];
       $divid = $_REQUEST['divid'];
       
       $mc = strtolower($mcname);
       $mc = str_replace(" ","",$mcname);
       $mc = str_replace("-","",$mc);
       $main_div = $mc.'d';
       $table_id = $mc;
       $from_id =  'f'.$mc;
       $to_id  = 't'.$mc;
       
       $stdate = $_REQUEST['stdate'];
       $enddate = $_REQUEST['enddate'];
       $cond = "op.st_date >= '$stdate' and op.st_date <= '$enddate'";
//  echo "INside getmccost";
// echo '<table id="$tblid" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
//  echo "<tr><td>Hello World</td></tr>";


   $newreport = new report;
   //$result = $newreport->get_mccost($mcname,$cond);
   echo "<table id=\"$table_id\" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\">";
   echo "<tr>
         <td colspan=2 bgcolor=\"#FFFFFF\"><span class=\"labeltext\"><b>From &nbsp&nbsp</b>
         <input type=\"text\" name=\"$from_id\" id=\"$from_id\" size=10 value=\"$stdate\"
            style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
           onkeypress=\"javascript: return checkenter(event)\">
         <img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\" onclick='GetDate(\"$from_id\")'>
          <span class=\"labeltext\"><b>&nbsp;&nbsp;To</b>
         <input type=\"text\" name=\"$to_id\" id=\"$to_id\" size=10 value=\"$enddate\"
          style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
          onkeypress=\"javascript: return checkenter(event)\">
         <img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\" onclick='GetDate(\"$to_id\")'>
         <input type=\"image\" src=\"images/bu-get.gif\"";
     echo "onclick=\"javascript: getcost('$mcname','$main_div','$table_id','$from_id','$to_id')\">";
     echo '</td>';
     echo "<td colspan=2 align=\"center\" bgcolor=\"#00DDFF\"><span class=\"heading\"><b>$mcname</b></td>";
     $result = $newreport->get_mccost($mcname,$cond);
     $totcost = 0;
     while ($myrow = mysql_fetch_row($result)) {
            $totcost += $myrow[4];
      }
      echo "<td colspan=2  align=\"right\" bgcolor=\"#FFFFFF\"><span class=\"heading\"><b>Total:";
      printf('%.2f',$totcost);
      echo '</b></td></tr>
            <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Date</b></td>
            <td bgcolor="#00DDFF" width=16%><span class="heading"><b>Shift</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Qty</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Cost</b></td>
        </tr>';
/*
        $cond = "(to_days(op.st_date)-to_days('1582-01-01') > 0 ||
                    op.st_date = '0000-00-00' ||
                    op.st_date = 'NULL' ) and
           (to_days(op.st_date)-to_days('2050-12-31') < 0 ||
                    op.st_date = '0000-00-00' ||
                    op.st_date = 'NULL')";
*/
         $result = $newreport->get_mccost($mcname,$cond);
         while ($myrow = mysql_fetch_row($result)) {
              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
                  $datearr = split('-', $myrow[2]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                  $date1 = '';
              }
            echo '<tr>';
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$date1</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[3]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[1]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">";
            printf('%.2f',$myrow[6]);
            echo "</td>";
            echo "<td  align=\"right\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">";
            printf('%.2f',$myrow[4]);
            echo "</td>";
            echo '</tr>';
         }
         echo '</table>';

?>
