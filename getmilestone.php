<?php
 include('classes/reportClass.php');
 $newreport = new report;

     $selectedstage ='';
     $stagearray = array();
	 $stagearray[200] = "Stores - WO Received";
     $stagearray[210] = "Production - Docs Received";
     $stagearray[220] = "Production - Received Material";
	 $stagearray[230] = "Production - Stage Insp Done";
	 $stagearray[240] = "Production - Fitting";
	 $stagearray[250] = "QA -  Received FG";
	 $stagearray[260] = "QA- FI Completed";
	 $stagearray[270] = "PPC - FG Received";

	   $selected_stage = $_REQUEST['stage'];
       //echo $selected_stage."===--===";
/*	 if ($selected_stage != '')
	 {
		   $arrindex = $selected_stage;
		   $selected_stagedesc = $stagearray[$arrindex];
	       echo "<span class=\"milestonetext\">Selected stage is $selected_stagedesc";
	 }
    else
	 {
	       echo "<span class=\"milestonetext\">No Stage has been selected";
	 } */
?>

<table style="table-layout: fixed" width=1210px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
    $i=0;
    $prev_wo="#";
    $image_tick='<img name="Imaget" width=20px height=20px border="0" src="images/tick.gif">';
   $result=$newreport->getWoapproveStatus($cond,$offset,$rowsPerPage);
   $bg = 0;
   $ft = 1;
   $st200='';
   $st210='';
   $st220='';
   $st230='';
   $st240='';
   $st250='';
   $st260='';
   $st270='';
   $st280='';
   while($myrow=mysql_fetch_row($result))
   {
	   if ($ft == 1)
	   {
	       $prevwo = $myrow[0];
               $prevcrn = $myrow[6];
	       $prevwodt = $myrow[7];
	       $prevpriority = $myrow[8];
	   }
	   if ($ft != 1 && $prevwo != $myrow[0])
	   {

	        $st = '';
		if ($selected_stage != '')
		{
				$nextstage = $selected_stage + 10;
				if ($selected_stage == '240')
				{
                    $nextstage = $selected_stage + 10;
					$selected_stage = $selected_stage - 10;
				}
				if ($selected_stage == '230')
				{
                    $nextstage = $selected_stage + 20;
				}
				$nextstgchk = "st" . $nextstage;
			    $stcheck = "st" . $selected_stage;
		    }

		if ($$stcheck != '' && $$nextstgchk == '')
		{
		    if ($bg == 1)
                    {
	                 $bgcolor = "#DDDEEE";
	                 $bg = 0;
                    }
                    else if ($bg == 0)
                    {
	                $bgcolor = "#FFFFFF";
	                $bg = 1;
                    }
                    if ($prevpriority == 'P1')
                    {
                       $bgcolor = "#FF0000";
                    }

		    if($prevwodt != '0000-00-00' && $prevwodt != '' && $prevwodt != 'NULL')
                    {
                     $datearr = split('-', $prevwodt);
                     $d=$datearr[2];
                     $m=$datearr[1];
                     $y=$datearr[0];
                     $x=mktime(0,0,0,$m,$d,$y);
                     $bookdate=date("M j, Y",$x);
                  }
                 else
                 {
                    $bookdate = '';
                 }
                 echo "<tr bgcolor=\"$trcolor\"><td bgcolor=\"$bgcolor\"><span class=\"milestonetext\">$prevcrn</td>
                    <td bgcolor=\"$bgcolor\"><span class=\"milestonetext\">$prevwo</td>
				    <td bgcolor=\"$bgcolor\"><span class=\"milestonetext\">$bookdate</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st200</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st210</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st220</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st230</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st240</td>";
			   echo "<td bgcolor=\"$bgcolor\"align=\"center\"><span class=\"milestonetext\">$st250</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st260</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st270</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st280</td>";
			   $st200='';
               $st210='';
               $st220='';
               $st230='';
               $st240='';
               $st250='';
               $st260='';
               $st270='';
               $st280='';
		   }
			$prevwo = $myrow[0];
	        $prevcrn = $myrow[6];
		    $prevwodt = $myrow[7];
		    $prevpriority = $myrow[8];

	   }
	   if ($myrow[4] != '' && $myrow[4] != '0000-00-00')
	   {
		   $stage= $image_tick;
       }
	   else
	   {
		   $stage= '';
       }
	  $stagenum = "st" . $myrow[1];
         $$stagenum = $stage;
	  $ft = 0;
   }
            if ($bg == 1)
            {
	             $bgcolor = "#EEEFFF";
	             $bg = 0;
             }
            else if ($bg == 0)
            {
	            $bgcolor = "#FFFFFF";
	            $bg = 1;
            }
                    if ($myrow[8] == 'P1')
                    {
                       $bgcolor = "#FF0000";
                    }

 			$st = '';
			if ($selected_stage != '')
		    {
				$nextstage = $selected_stage + 10;
				if ($selected_stage == '240')
				{
                    $nextstage = $selected_stage + 10;
					$selected_stage = $selected_stage - 10;
				}
				if ($selected_stage == '230')
				{
                    $nextstage = $selected_stage + 20;
				}
				$nextstgchk = "st" . $nextstage;
			    $stcheck = "st" . $selected_stage;
		    }

			if ($$stcheck != '' && $$nextstgchk == '')
		   {
			  	 if ($bg == 1)
                {
	                 $bgcolor = "#DDDEEE";
	                 $bg = 0;
                 }
                else if ($bg == 0)
                {
	                $bgcolor = "#FFFFFF";
	                $bg = 1;
                }
                    if ($prevpriority == 'P1')
                    {
                       $bgcolor = "#FF0000";
                    }
	       if($prevwodt != '0000-00-00' && $prevwodt != '' && $prevwodt != 'NULL')
               {
                   $datearr = split('-', $prevwodt);
                   $d=$datearr[2];
                   $m=$datearr[1];
                   $y=$datearr[0];
                   $x=mktime(0,0,0,$m,$d,$y);
                   $bookdate=date("M j, Y",$x);
                }
               else
               {
                  $bookdate = '';
               }
               echo "<tr bgcolor=\"$trcolor\"><td bgcolor=\"$bgcolor\"><span class=\"milestonetext\">$prevcrn</td>
                    <td bgcolor=\"$bgcolor\"><span class=\"milestonetext\">$prevwo</td>
				    <td bgcolor=\"$bgcolor\"><span class=\"milestonetext\">$bookdate</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st200</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st210</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st220</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st230</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st240</td>";
			   echo "<td bgcolor=\"$bgcolor\"align=\"center\"><span class=\"milestonetext\">$st250</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st260</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st270</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st280</td>";
			   $st200='';
               $st210='';
               $st220='';
               $st230='';
               $st240='';
               $st250='';
               $st260='';
               $st270='';
               $st280='';
		   }
?>
</table>
