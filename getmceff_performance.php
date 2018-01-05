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
       $i = $_REQUEST['i'];
       $cond = "op.st_date >= '$stdate' and op.st_date <= '$enddate'";

   $newreport = new report;
   $tbldivid=$tblid.'div';
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
     echo "onclick=\"javascript: getmc_eff_performance('$mcname','$divid','$tblid','f$tblid','t$tblid')\">";
     echo '</td>';
     echo "<td width=30%  align=\"center\" bgcolor=\"#00DDFF\"><span class=\"heading\"><b>$mcname</b></td>";
     echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
     echo "<input type=\"image\" name=\"Print\" src=\"images/bu-print.gif\" value=\"Get\"
          onclick=\"javascript: openPrintWindow(new Array('chart$tblid','$tbldivid'))\">";
     echo '</td>';
     echo '</tr>
     </table>';

	 echo '<table width=100% border=1 cellpadding=3 cellspacing=1>';
     echo '<tr>';
     echo '<td  width=60% valign="top">';
     echo "<div id=\"$tbldivid\">
     <table style=\"table-layout: fixed\" width=900px border=1 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\">
        <tr>
            <td bgcolor=\"#00DDFF\"  width=50px><span class=\"heading\"><b>PRN</b></td>
            <td bgcolor=\"#00DDFF\"  width=30px><span class=\"heading\"><b>Stg</b></td>
            <td bgcolor=\"#00DDFF\"  width=50px><span class=\"heading\"><b>Qty Mfg</b></td>
            <td bgcolor=\"#00DDFF\"  width=50px><span class=\"heading\"><b>Est<br>Time</b></td>
			<td bgcolor=\"#00DDFF\" width=50px><span class=\"heading\"><b>Est<br>Setting<br>Time</b></td> 
            <td bgcolor=\"#00DDFF\" width=50px><span class=\"heading\"><b>Est<br>Running<br>Time</b></td> 
            <td bgcolor=\"#00DDFF\"  width=50px><span class=\"heading\"><b>Actual<br>Time</b></td>
			<td bgcolor=\"#00DDFF\"  width=50px><span class=\"heading\"><b>Setting<br>Time</b></td> 
            <td bgcolor=\"#00DDFF\"  width=50px><span class=\"heading\"><b>Running<br>Time</b></td> 
            <td bgcolor=\"#00DDFF\"  width=50px><span class=\"heading\"><b>Rej<br>Qty</b></td>
            <td bgcolor=\"#00DDFF\"  width=50px><span class=\"heading\"><b>Rej<br>Time</b></td>			
			<td bgcolor=\"#00DDFF\"  width=50px><span class=\"heading\"><b>B/down<br>Time</b></td> 
			<td bgcolor=\"#00DDFF\"  width=50px><span class=\"heading\"><b>Idle<br>Time</b></td> 
            <td bgcolor=\"#00DDFF\"  width=50px><span class=\"heading\"><b>Lost or<br>Gained</b></td>

        </tr>";
		?>
		</table>
  <div style="width:900px; height:100;border:" id="dataList">
  <table style="table-layout: fixed" width=900px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
  <?
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
		$total_setting_time = 0;
		$total_running_time = 0;
		$total_breakdown_time = 0;
		$total_idle_time = 0;
		$esttotal_setting_time = 0;
		$esttotal_running_time = 0;
        $result = $newreport->gettime4mu_eff_tab($mcname,$cond);
         while ($myrow = mysql_fetch_row($result)) {
			$setting_time=$myrow[5];
   			$estsetting_time=$myrow[4];
			$estrunning_time=$myrow[7];
            $idle_time=$myrow[9];
			$breakdown_time=$myrow[10];				
			$running_time=$myrow[11];	

			$total_setting_time += $myrow[5];
		    $total_running_time +=  $myrow[11];
		    $total_breakdown_time += $myrow[10];
		    $total_idle_time +=  $myrow[9];

		  $esttotal_setting_time += $myrow[4];
		 $esttotal_running_time += $myrow[7];

            echo '<tr>';
            echo "<td bgcolor=\"#FFFFFF\"  width=50px><span class=\"tabletext\">$myrow[1]</td>";
            echo "<td bgcolor=\"#FFFFFF\"  width=30px><span class=\"tabletext\">$myrow[2]</td>";
            echo "<td bgcolor=\"#FFFFFF\"  width=50px><span class=\"tabletext\">";
            printf("%.2f",$myrow[3]);
            echo "</td>";
            echo "<td bgcolor=\"#FFFFFF\"  width=50px><span class=\"tabletext\">";
            printf("%.2f",($myrow[4]+$myrow[7]));
            echo "</td>";
			 echo "<td bgcolor=\"#FFFFFF\"  width=50px><span class=\"tabletext\">";
            printf("%.2f",$myrow[4]);
            echo "</td>";
			 echo "<td bgcolor=\"#FFFFFF\"  width=50px><span class=\"tabletext\">";
            printf("%.2f",$myrow[7]);
            echo "</td>";         
            $total_est_time += ($myrow[4]+$myrow[7]);
            echo "<td bgcolor=\"#FFFFFF\"  width=50px><span class=\"tabletext\">";
            printf("%.2f",($myrow[5]+$myrow[6]));
            echo "</td>";
           echo "<td bgcolor=\"#FFFFFF\"  width=50px><span class=\"tabletext\">$myrow[5]</td>";
		   echo "<td bgcolor=\"#FFFFFF\"  width=50px><span class=\"tabletext\">$myrow[11]</td>";
            $total_actual_time += ($myrow[5]+$myrow[6]);
            echo "<td bgcolor=\"#FFFFFF\"  width=50px><span class=\"tabletext\">$myrow[8]</td>";
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
                 $total_rej_time += $rej_time;
               }
            echo "<td bgcolor=\"#FFFFFF\"  width=50px><span class=\"tabletext\">";
            printf("%.2f",$rej_time);
            echo "</td>";
			?>
			
			<td bgcolor="#FFFFFF"  width=50px><span class="tabletext"><?php echo  $myrow[10] ?></td>
			<?
			echo "<td bgcolor=\"#FFFFFF\"  width=50px><span class=\"tabletext\">";
            printf("%.2f",$myrow[9]);
            echo "</td>";
			 
            $lossrgain=(($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
            echo "<td bgcolor=\"#FFFFFF\"  width=50px><span class=\"tabletext\">";
            printf("%.2f",$lossrgain);
            echo "</td>";
            $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
            echo '</tr>';
         }
         unset($rej_time);
		 ?>
		 </table>
 </div>

<table border=1 width="900px" cellspacing=1 cellpadding=3 bgcolor="#DFDEDF">
<?
         echo'<tr bgcolor="#FFFFFF">';
         echo'<td width=140px bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>';
         echo "<td width=50px bgcolor=\"#00DDFF\"><span class=\"tabletext\">";
         printf("%.2f",$total_est_time);
         echo "</td>";
		 ?>
		 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $esttotal_setting_time); ?></td>
         <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $esttotal_running_time); ?></td>
	     <?
         echo "<td width=50px bgcolor=\"#00DDFF\"><span class=\"tabletext\">";
         printf("%.2f",$total_actual_time);
         echo "</td>";
		 ?>
		 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_setting_time); ?></td>
	     <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_running_time); ?></td>
	     <?
         echo "<td width=50px bgcolor=\"#00DDFF\"><span class=\"tabletext\"></td>";
         echo "<td width=50px bgcolor=\"#00DDFF\"><span class=\"tabletext\">";
         printf("%.2f",$total_rej_time);
         echo "</td>";
		 ?>
	    <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_breakdown_time); ?></td>
	    <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_idle_time); ?></td>
	    <?
         echo "<td width=50px bgcolor=\"#00DDFF\"><span class=\"tabletext\">";
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
            <td colspan=2><span class="labeltext">FLUENTWMS</td>
        </tr>

</table>
<?php
         echo '</div>';
         echo '</div>';
 ?>
		  </td>
          </tr>
          <td width=30% valign="top">
         <div id="layer<?echo $i?>">
         <table id="myTable" width=100%  border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
		  <tr>
         <td>
         <?php
         include_once 'ofc-library/open_flash_chart_object.php';
          open_flash_chart_object( 450, 200, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/pie_chart_prodn.php?setting_time='.$total_setting_time.'&idle_time='.$total_idle_time.'&breakdown_time='.$total_breakdown_time.'&running_time='.$total_running_time.'&machine='.$mcname,false );
         ?>
		 </td>
		 </tr>
         </table>
        </div>
         </td>
         </tr>
        </table>

<?
         echo '<table width=100% border=1 cellpadding=3 cellspacing=1>';
		 echo '<tr>';
		 echo "<td align=\"right\" bgcolor=\"#FFFFFF\">";
         echo "<input type=\"image\" name=\"Print\" src=\"images/printchart.gif\" value=\"Get\"
               onclick=\"javascript: openPrintWindow(new Array('chart$tblid'))\">";
         echo '</td>';
		 echo '</tr>';

         echo '<tr>';
         echo "<td id=\"chart$tblid\">";        
         $mc=urlencode($mcname);     
		  include_once 'ofc-library/open_flash_chart_object.php';
         open_flash_chart_object( 990, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/chart-prodneff1.php?mcrypt_get_cipher_name(cipher)='.$mc.'&sdate='.$stdate.'&edate='.$enddate, false );
       
         echo "<table width=990px border=1 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\">";
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
            <td colspan=2><span class="labeltext">FLUENTWMS</td>
        </tr>
		<?
		 echo '</table>';
		
         echo '</td></tr></table>';

		 echo '<table width=100% border=1 cellpadding=3 cellspacing=1>';
		 echo '<tr>';
		 echo "<td align=\"right\" bgcolor=\"#FFFFFF\">";
         echo "<input type=\"image\" name=\"Print\" src=\"images/printchart.gif\" value=\"Get\"
               onclick=\"javascript: openPrintWindow(new Array('chartst$tblid'))\">";
         echo '</td>';
		 echo '</tr>';

         echo '<tr>';   
        echo "<td id=\"chartst$tblid\">"; 
        $mc=urlencode($mcname); 
        // $total_setting_time=($total_setting_time !='')? $total_setting_time:0;
        //$esttotal_setting_time=($esttotal_setting_time !='')? $esttotal_setting_time:0;
	    include_once 'ofc-library/open_flash_chart_object.php';
	   open_flash_chart_object( 990, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/chart-eststeff1.php?mcname='.$mc.'&sdate='.$stdate.'&edate='.$enddate, false );
	    echo "<table width=990px border=1 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\">";
         echo '<tr bgcolor="#FFFFFF">';
         echo '<td colspan=4 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>';
        $total_setting_time!=0 && $esttotal_setting_time !=0 ?$machine_eff =(($esttotal_setting_time/$total_setting_time)*100):$machine_eff=0;
         echo'<td colspan=4 bgcolor="#99FFFF"><span class="tabletext">';
         printf("%.2f",$machine_eff);
         echo '%';
         echo '</td>';
         echo '</tr>';
		 ?>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext">FLUENTWMS</td>
        </tr>
		<?
		 echo '</table>';

        echo '</td>';
         echo '</tr>'; 
		 echo '</table>';

         echo '<table width=100% border=1 cellpadding=3 cellspacing=1>';
		 echo '<tr>';
		 echo "<td align=\"right\" bgcolor=\"#FFFFFF\">";
         echo "<input type=\"image\" name=\"Print\" src=\"images/printchart.gif\" value=\"Get\"
               onclick=\"javascript: openPrintWindow(new Array('chartrt$tblid'))\">";
         echo '</td>';
		 echo '</tr>';
        echo '<tr>';   
        echo "<td id=\"chartrt$tblid\">";  
      $mc=urlencode($mcname);  
        //$total_running_time=($total_running_time !='')? $total_running_time:0;
        //$esttotal_running_time=($esttotal_running_time !='')? $esttotal_running_time:0;
	   include_once 'ofc-library/open_flash_chart_object.php';
      open_flash_chart_object( 990, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/chart-estrteff1.php?mcname='.$mc.'&sdate='.$stdate.'&edate='.$enddate, false );
       echo "<table width=990px border=1 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\">";
         echo '<tr bgcolor="#FFFFFF">';
         echo '<td colspan=4 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>';
        $total_running_time!=0 && $esttotal_running_time !=0 ?$machine_eff =(($esttotal_running_time/$total_running_time)*100):$machine_eff=0;
         echo'<td colspan=4 bgcolor="#99FFFF"><span class="tabletext">';
         printf("%.2f",$machine_eff);
         echo '%';
         echo '</td>';
         echo '</tr>';
		 ?>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext">FLUENTWMS</td>
        </tr>
		<?
		 echo '</table>';

        echo '</td>';
         echo '</tr>'; 
		 echo '</table>';
