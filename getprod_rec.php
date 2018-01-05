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
       $opername = $_REQUEST['opername'];
       if($opername=='All'||$opername=='')
       {
        $oper_name = '%';
        $condo= " and op.oper_name like '$oper_name'";
       }else
       {
         $oper_name = $opername ? "$opername" : '%';
          $condo= " and op.oper_name = '$oper_name'";
       }
       if($mcname=='All'||$mcname=='')
       {
        $mc_name = '%';
        $condm="and op.mc_name like '$mc_name'";
       }else
       {
         $mc_name = $mcname ? "$mcname": '%';
         $condm="and op.mc_name = '$mc_name'";
       }
       $wonum = $_REQUEST['wonum'];
       $wo_num = $wonum ? "$wonum" . "%" : '%';
       $cond = "op.st_date >= '$stdate' and op.st_date <= '$enddate'";
       $cond = $cond . " and op.crn like '$crnnum'";
       $cond = $cond . $condo;
       $cond = $cond . $condm;
       $cond = $cond . " and op.wo_num like '$wo_num'";

  //echo $cond."-***---";

     //echo "INside getprodrec $mcname";
     // echo '<table id="$tblid" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
     //echo "<tr><td>Hello World</td></tr>";
      //echo"<input type=\"text\" id=\"operno$tblid\" name=\"operno$tblid\" size=10 value=\"$opername\"> ";
//echo '3333'.$_REQUEST[mc];
   $newreport = new report;
   $result_p = $newreport->getEmp4Prodnrec();

 echo "<input type=\"hidden\" id='mc' value=\"$mcname\">";
   echo "<table id=\"$tblid\" width=1100px border=1 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\">";
   //echo "<tr><td  colspan=12 align=\"center\" bgcolor=\"#00DDFF\"><span class=\"heading\"><b>$mcname</b></td></tr>";



     echo'          <tr>
           <td bgcolor="#FFFFCC" ><span class="heading"><b>Machine Name</b></td>
            <td bgcolor="#FFFFCC" ><span class="heading"><b>Date</b></td>
            <td bgcolor="#FFFFCC" ><span class="heading"><b>Shift</b></td>
            <td bgcolor="#FFFFCC" ><span class="heading"><b>Operator</b></td>
            <td bgcolor="#FFFFCC" ><span class="heading"><b>PRN</b></td>
            <td bgcolor="#FFFFCC" ><span class="heading"><b>WO</b></td>
             <td bgcolor="#FFFFCC" ><span class="heading"><b>WO Date</b></td>
            <td bgcolor="#FFFFCC" ><span class="heading"><b>Qty</b></td>
            <td bgcolor="#FFFFCC" ><span class="heading"><b>Stage</b></td>
        </tr>';

$totalQuantity=0;
$rejectQuantity=0;
         $result = $newreport->getprod_record($mcname,$cond);

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
              if($myrow[16] != '0000-00-00' && $myrow[16] != '' && $myrow[16] != 'NULL')
              {
                  $datearr = split('-', $myrow[16]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date2=date("M j, Y",$x);
              }
              else
              {
                  $date2 = '';
              }

 $totalQuantity=$totalQuantity+$myrow[6];
 $rejectQuantity=$rejectQuantity+$myrow[15];
$array[machine]=$totalQuantity;
             echo "<tr>";
              echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[0]</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$date1</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[2]</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[3]</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[4]</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[5]</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$date2</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[6]</td>";
             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[7]</td>";
             echo "</tr>";
         }


		     echo "<tr>";
             echo "<td ></td><td ></td><td ></td><td></td><td></td><td></td><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\"> <b>Total Qty:</b></td><td id='tQ".$mcname."' bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$totalQuantity</td>";
//echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\"> <b>Total Rej Qty:</b></td><td id='tQ1".$mcname."' bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$rejectQuantity</td>";
 echo "</tr>";

         echo '</table><br>';
  // }
?>

