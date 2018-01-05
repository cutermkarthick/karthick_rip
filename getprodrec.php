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
       $stdate = $_REQUEST['stdate'];
       $enddate = $_REQUEST['enddate'];
       $crn = $_REQUEST['crn'];
       $crnnum = $crn ? "$crn" . "%" : "%";
       $stage = $_REQUEST['stage'];
       $stagenum = $stage ? "$stage" . "%" : '%';
       $shift = $_REQUEST['shift'];
       $shiftnum = $shift ? "$shift" . "%" : '%';
       $cond = "op.st_date >= '$stdate' and op.st_date <= '$enddate'";
       $cond = $cond . " and op.crn like '$crnnum'";
       $cond = $cond . " and op_mc.stage_num like '$stagenum'";
       $cond = $cond . " and op.shift like '$shiftnum'";


     //echo "INside getprodrec $mcname";
     // echo '<table id="$tblid" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
     //echo "<tr><td>Hello World</td></tr>";

//echo '3333'.$_REQUEST[mc];
   $newreport = new report;
   //$result = $newreport->get_prodrecord($mcname,$cond);
 echo "<input type=\"hidden\" id='mc' value=\"$mcname\">";
   echo "<table id=\"$tblid\" width=1100px border=1 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\" class=\"stdtable\">";
   echo "<tr><td  colspan=12 align=\"center\" bgcolor=\"#00DDFF\"><span class=\"heading\"><b>$mcname</b></td></tr>";
  
   echo "<tr>
         <td colspan=12 align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"labeltext\"><b>From &nbsp&nbsp</b>
         <input type=\"text\" name=\"f$tblid\" id=\"f$tblid\" size=10 value=\"$stdate\"
            style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
           onkeypress=\"javascript: return checkenter(event)\">
         <img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\" onclick='GetDate(\"f$tblid\")'>
          <span class=\"labeltext\"><b>&nbsp;&nbsp;To</b>
         <input type=\"text\" name=\"t$tblid\" id=\"t$tblid\" size=10 value=\"$enddate\"
          style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
          onkeypress=\"javascript: return checkenter(event)\">
         <img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\" onclick='GetDate(\"t$tblid\")'>
         <b>&nbsp&nbspCRN &nbsp&nbsp;</b>
         <input type=\"text\" id=\"crn$tblid\" name=\"crn$tblid\" size=10 value=\"$crn\">
         <b>&nbsp&nbspShift &nbsp&nbsp;</b>
         <input type=\"text\" id=\"shift$tblid\" name=\"shift$tblid\" size=10 value=\"$shift\">
         <b>&nbsp&nbspStage &nbsp&nbsp;</b>
         <input type=\"text\" id=\"stage$tblid\" name=\"stage$tblid\" size=10 value=\"$stage\"> 
         <input type=\"image\" src=\"images/bu-get.gif\"";
     echo "onclick=\"javascript: getprodrec('$mcname','$divid','$tblid','f$tblid','t$tblid','crn$tblid','stage$tblid','shift$tblid')\">";          
     echo '</td></tr>';

     echo'          <tr>

            <td bgcolor="#FFFFCC" width=100px><span class="heading"><b>Date</b></td>
            <td bgcolor="#FFFFCC" width=60px><span class="heading"><b>Shift</b></td>
            <td bgcolor="#FFFFCC" width=140px><span class="heading"><b>Operator</b></td>
            <td bgcolor="#FFFFCC" width=90px><span class="heading"><b>PRN</b></td>
            <td bgcolor="#FFFFCC" width=90px><span class="heading"><b>WO</b></td>
            <td bgcolor="#FFFFCC" width=60px><span class="heading"><b>Qty</b></td>
            <td bgcolor="#FFFFCC" width=60px><span class="heading"><b>Stage</b></td>
            <td bgcolor="#FFFFCC" width=60px><span class="heading"><b>Rej Qty</b></td>
            <td bgcolor="#FFFFCC" width=120px><span class="heading"><b>Setting Time</b></td>
            <td bgcolor="#FFFFCC" width=120px><span class="heading"><b>Running Time</b></td>
            <td bgcolor="#FFFFCC" width=120px><span class="heading"><b>Idle Time</b></td>
            <td bgcolor="#FFFFCC" width=160px><span class="heading"><b>Remarks</b></td>

        </tr>';

$totalQuantity=0;
$rejectQuantity=0;
         $result = $newreport->get_prodrecord($mcname,$cond);
	
         while ($myrow = mysql_fetch_row($result)) 
         {
              if($myrow[1] != '0000-00-00' && $myrow[1] != '' && $myrow[1] != 'NULL')
              {
                  $datearr = split('-', $myrow[1]);
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

 $totalQuantity=$totalQuantity+$myrow[6];
 $rejectQuantity=$rejectQuantity+$myrow[15];
$array[machine]=$totalQuantity;
             echo "<tr>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$date1</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[2]</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[3]</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[4]</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[5]</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[6]</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[7]</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[15]</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[8]" ." h " .  $myrow[9] . " m </td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[10]" ." h " .  $myrow[11] . " m </td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[12]" ." h " .  $myrow[13] . " m </td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\"><textarea rows=\"2\" cols=\"30\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">$myrow[14]</textarea></td>";         
             echo "</tr>";
         }

 
		     echo "<tr>";
             echo "<td ></td><td></td><td></td><td></td><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\"> <b>Total Qty:</b></td><td id='tQ".$mcname."' bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$totalQuantity</td>";
echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\"> <b>Total Rej Qty:</b></td><td id='tQ1".$mcname."' bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$rejectQuantity</td>";
 echo "</tr>";

         echo '</table><br>';

?>

