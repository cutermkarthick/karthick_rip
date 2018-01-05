<?php


//====================================
// Author: FSI
// Date-written = Auguest 02, 2015
// Filename: export_crnoutlook.php
// Maintains the class for all reports
// Revision: v1.0
// Modifications History
//====================================

include_once('classes/reportClass.php');

$newreport = new report;

$crn=$_REQUEST['crn'];
$ftrigger=$_REQUEST['ftrigger'];


// echo "<pre>"; print_r($_REQUEST); exit;
if (!isset($_REQUEST['ftrigger']) or 
     $ftrigger == '' or
	 ($ftrigger != 'ALL' && 
	  $ftrigger != 'all' && 
	  $ftrigger != 'TREAT' &&
	  $ftrigger != 'treat' && 
	  $ftrigger != 'WO' && 
	  $ftrigger != 'wo' && 
	  $ftrigger != 'RMPO'))
{
	$ftrigger = 'rmpo';
}

 // by default we show first page
$pageNum = 1;
$crnarr = array();
$crnonlyarr = array();
$disparr = array();
// poarr stores the key as order date (60 days subtracted from sch date)
$poarr = array();
// podtarr stores the sch date with order date as key needed for printing
$podtarr = array();
// wotrigarr stores the key as wo create date 
// (60 days subtracted from sch date)
$wotrigarr = array();
// wodtarr stores the sch date with wo create date as key 
//  needed for printing
$wodtarr = array();

// treattrigarr stores the key as wo create date 
// (60 days subtracted from sch date)
$treattrigarr = array();
// wodtarr stores the sch date with wo create date as key 
//  needed for printing
$treatdtarr = array();

$schweekarr = array();

// Create the work-week(52 weeks from today) array starting from 
// run date week's beginning Monday
$wwbegindate= date("Y-m-d", strtotime('monday this week'));
array_push($schweekarr,$wwbegindate);
$newdate = date("Y-m-d", strtotime($wwbegindate . "+7 day"));

for ($x = 0; $x <= 50; $x++) {
    $newdate = date("Y-m-d", strtotime($wwbegindate . "+7 day"));
	array_push($schweekarr,$newdate);
	$wwbegindate = $newdate;
} 


$currmnth = date("Y-m-d");
$nextdate=mktime(0,0,0,date("m")+1,date("d"),date("Y"));
$currmnthplus1 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+2,date("d"),date("Y"));
$currmnthplus2 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+3,date("d"),date("Y"));
$currmnthplus3 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+4,date("d"),date("Y"));
$currmnthplus4 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+5,date("d"),date("Y"));
$currmnthplus5 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+6,date("d"),date("Y"));
$currmnthplus6 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+7,date("d"),date("Y"));
$currmnthplus7 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+8,date("d"),date("Y"));
$currmnthplus8 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+9,date("d"),date("Y"));
$currmnthplus9 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+10,date("d"),date("Y"));
$currmnthplus10 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+11,date("d"),date("Y"));
$currmnthplus11 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+12,date("d"),date("Y"));
$currmnthplus12 = date("Y-m-d", $nextdate);
$schdtcount = 0;
$actcount = 0;

if($crn!='')
{
       $lobresult = $newreport->getlob($crn);
       if(mysql_num_rows($lobresult) != 0)
	   {
		      while($mylobrow=mysql_fetch_row($lobresult))
              {
	              $crn1 = $mylobrow[0];
		          // echo "<br>inside while $crn1-----";
                   $date = $mylobrow[1];			       
                   $qty = $mylobrow[2];
		   	      if ($date < $currmnth)
                  {
				     $crnarr[$crn1][$currmnth] += $qty;
			      }
				  else 
					  $crnarr[$crn1][$date] = $qty;
				  //echo $crnarr[$crn1][$date];
                  $crnonlyarr[$crn1] = $crn1;
			  }




$data .= '<table align="top" style="table-layout: fixed" width="650px" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">';
$data .= '<tr bgcolor="#FFFFFF">';
$data .= '<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align="center"><b>LEGEND:</b></td>';
$data .= '<td width="20px" height="20px" bgcolor="#00FF00"><span class="labeltext" align="center">&nbsp</td>';
$data .= '<td width="55px" bgcolor="#FFFFFF"><span class="labeltext" align="center"><b>Safe</b></td>';
$data .= '<td width="20px" bgcolor="#FFFF00"><span class="labeltext" align="center">&nbsp</td>';
$data .= '<td width="90px" bgcolor="#FFFFFF"><span class="labeltext" align="center"><b>Borderline</b></td>';
$data .= '<td width="20px" bgcolor="#00DDFF"><span class="labeltext" align="center">&nbsp</td>';
$data .= '<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align="center"><b>Qty from PO</b></td>';
$data .= '<td width="20px" bgcolor="#FF0000"><span class="labeltext" align="center">&nbsp</td>';

$data .= '<td width="70px" bgcolor="#FFFFFF"><span class="labeltext" align="center"><b>Danger</b></td>';
$data .= '<td width="20px" bgcolor="#FFA500"><span class="labeltext" align="center">&nbsp</td>';
$data .= '<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align="center"><b>GRN-to-Prodn</b></td>';


$data .= '<td width="20px" bgcolor="#990000"><span class="labeltext" align="center">&nbsp</td>';
$data .= '<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align="center"><b>Trigger text</b></td>';
$data .= '<td width="39px" bgcolor="#FFFFFF"><span class="labeltext" align="center">WW = </td>';
$data .= '<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align="center"><b>Work Week</b></td>';
 $data .= '</tr>';
$data .= '</table>';

$data .= '<table align="top" style="table-layout: fixed" width="700px" border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">';
$data .= '<tr bgcolor="#FFCC00">';

$data .= '<td width="90px"  align="center" bgcolor="#EEEFEE"><span class="labeltext" align="center"><b>PRN</b></td>';
$data .= '<td width="180px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Part Number</b></td>';
$data .= '<td width="100px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>WIP (fg)</b></td>';
$data .= '<td width="100px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>DN (fg)</b></td>';
$data .= '<td width="100px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>DN-Stores (fg)</b></td>';
$data .= '<td width="100px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>FG (fg)</b></td>';
$data .= '<td width="100px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>GRN (grn)</b></td>';
$data .= '<td width="100px"  align="center" bgcolor="#3BE8D4"><span class="labeltext"><b>Buffer</b></td>';

			$ft = 0;
			foreach ($schweekarr as $date1) 
			{
				$datearr = split('-', $date1);
			    $d=$datearr[2];
			    $m=$datearr[1];
			    $y=$datearr[0];
			    $x=mktime(0,0,0,$m,$d,$y);
				if ($ft == 0)
				{
			       $schdate1=date("M j, Y",$x);
				    $data .= '<td align="center" width="200px" bgcolor="#00DDFF" align="left"><span class="schtext" ><b>WW starting<br>'. $schdate1.'<br>(Potential Backlog)</b></td>';
			    }
				else
				{
			       $schdate1=date("M j, Y",$x);
				    $data .= '<td align="center" width="200px" bgcolor="#00DDFF" align="left"><span class="schtext" ><b>WW starting<br>'.$schdate1.'</b></td>';
			    }	
				$ft = 1;
			}

			$i = 0;
			$suffix = '';

			while ($i < 13)
			{
			    $nextdate=mktime(0,0,0,date("m")+$i,date("d"),date("Y"));
			    $nextmonth = date("Y-m-d", $nextdate);
			 


			$data .= '<td width="100px" bgcolor="#EEEFEE"  align="center"><span class="schtext"><b>PO '.$i.'</b>';


			  $i++;
			}
			// $data .= '</tr>';
			$data .= '</table>';

			$data .= '<table style="table-layout: fixed" border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >';

			$cond='';
			if($crn!='')
			{
				$cond='and w.crn_num like '."'".$crn."%'";
				$cond1='where w.crn_num like '."'".$crn."%'".$cond;
			}
			else
			{
				$cond='';
				$cond1=''.$cond;
			}

			foreach ($crnonlyarr as $uniquecrn) 
			{
				$crn = $uniquecrn;
					//print "\ncrn1 is $crn1";
				$result = $newreport->getcrnfromlob($cond1,$crn);
				$total=0;
				$total4dis=0;
				$total4grn=0;
				$totalgrn_quar=0;
				$totalbalance=0;
				$totalbalance_quar=0;
				$totaldn_qty=0;
				$total_recd4stores=0;
				$totalrecd_qty=0;
				$totalrmpoqty=0;

				$woprocarr = array("Assembly","Manufacture Only","With Treatment");
					while($myrow4crn=mysql_fetch_row($result))
					{
						$dnSent_qty=0;
						$dnRecd_qty=0; 
						$part_num=wordwrap($myrow4crn[4],30,"<br>\n");
						$data .= '<tr title='.$myrow4crn[1].' bgcolor="#FFFFFF" >';
						$data .= '<td align="center" width="90px"><span class="labeltext"><font color="black">'.$myrow4crn[1].'</font></td>' ;
						$data .= '<td align="center" width="180px"><span class="labeltext">'.$part_num.'</td>';	  


						foreach ($woprocarr as $proc)
						{

							$openflag=0;
							$results = $newreport->getallCRN4open($myrow4crn[1],$proc);

							if(mysql_num_rows($results) == '0')
							{

							  //printf('<td width="50px" align="center" bgcolor="#FFFFFF"><span class="schtext">%s</td>','&nbsp');
							}


							while($myrow4=mysql_fetch_row($results))
							{

							   if ($myrow4[3] == 'Open')
							  {
							     $total = $total + $myrow4[2];
							      
							  }
							  if($proc == 'With Treatment' && $myrow4[3] == 'Open')
							  {
							    $totaldn_qty += $myrow4[4];
							    
								$total_recd4stores += $myrow4[5]-$myrow4[6];
								
							  }
							}

							$result4closed = $newreport->getallCRN4closed($myrow4crn[1],$proc);
							while($myrow4closed=mysql_fetch_row($result4closed))
							{
							$result1 = $newreport->getallCRNDetails($myrow4closed[0],$myrow4closed[2],$proc);
							$num_rows = mysql_num_rows($result1);
							if($num_rows=='0')
							{
							$total4dis = $total4dis + $myrow4closed[2];
							}
							while($myrow4dispatch=mysql_fetch_row($result1))
							{
							$total4dis = $total4dis + $myrow4dispatch[0];
							
							}
							}

							$totalbalance='&nbsp';
							$totalbalance_quar='&nbsp';
							$poarray = array();

							$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],'0000-00-00',$currmnth);
							$myrmpo=mysql_fetch_row($result4rmpo);
							$totalrmpoqty0 = $myrmpo[1] - $myrmpo[3];
							$poarray[0] = $totalrmpoqty0;
							$rmpoqty0 = $myrmpo[1]  - $myrmpo[3];

							$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnth,$currmnthplus1);
							$myrmpo=mysql_fetch_row($result4rmpo);
							$totalrmpoqty1 = $myrmpo[1] - $myrmpo[3];
							$poarray[1] = $totalrmpoqty1;
							$rmpoqty1 = $myrmpo[1] - $myrmpo[3];

							$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus1,$currmnthplus2);
							$myrmpo=mysql_fetch_row($result4rmpo);
							$totalrmpoqty2 = $myrmpo[1] - $myrmpo[3];
							$poarray[2] = $totalrmpoqty2;
							$rmpoqty2 = $myrmpo[1] - $myrmpo[3];

							$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus2,$currmnthplus3);
							$myrmpo=mysql_fetch_row($result4rmpo);
							$totalrmpoqty3 = $myrmpo[1] - $myrmpo[3];
							$poarray[3] = $totalrmpoqty3;
							$rmpoqty3 = $myrmpo[1] - $myrmpo[3];


							$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus3,$currmnthplus4);
							$myrmpo=mysql_fetch_row($result4rmpo);
							$totalrmpoqty4 = $myrmpo[1] - $myrmpo[3];
							$poarray[4] = $totalrmpoqty4;
							$rmpoqty4 = $myrmpo[1] - $myrmpo[3];

							$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus4,$currmnthplus5);
							$myrmpo=mysql_fetch_row($result4rmpo);
							$totalrmpoqty5 = $myrmpo[1] - $myrmpo[3];
							$poarray[5] = $totalrmpoqty5;
							$rmpoqty5 = $myrmpo[1] - $myrmpo[3];

							$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus5,$currmnthplus6);
							$myrmpo=mysql_fetch_row($result4rmpo);
							$totalrmpoqty6 = $myrmpo[1] - $myrmpo[3];
							$poarray[6] = $totalrmpoqty6;
							$rmpoqty6 = $myrmpo[1] - $myrmpo[3];

							$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus6,$currmnthplus7);
							$myrmpo=mysql_fetch_row($result4rmpo);
							$totalrmpoqty7 = $myrmpo[1] - $myrmpo[3];
							$poarray[7] = $totalrmpoqty7;
							$rmpoqty7 = $myrmpo[1] - $myrmpo[3];

							$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus7,$currmnthplus8);
							$myrmpo=mysql_fetch_row($result4rmpo);
							$totalrmpoqty8 = $myrmpo[1] - $myrmpo[3];
							$poarray[8] = $totalrmpoqty8;
							$rmpoqty8 = $myrmpo[1] - $myrmpo[3];

							$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus8,$currmnthplus9);
							$myrmpo=mysql_fetch_row($result4rmpo);
							$totalrmpoqty9 = $myrmpo[1] - $myrmpo[3];
							$poarray[9] = $totalrmpoqty9;
							$rmpoqty9 = $myrmpo[1] - $myrmpo[3];

							$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus9,$currmnthplus10);
							$myrmpo=mysql_fetch_row($result4rmpo);
							$totalrmpoqty10 = $myrmpo[1] - $myrmpo[3];
							$poarray[10] = $totalrmpoqty10;

							$rmpoqty10 = $myrmpo[1] - $myrmpo[3];
							$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus10,$currmnthplus11);
							$myrmpo=mysql_fetch_row($result4rmpo);
							$totalrmpoqty11 = $myrmpo[1] - $myrmpo[3];
							$poarray[11] = $totalrmpoqty11;

							$rmpoqty11 = $myrmpo[1] - $myrmpo[3];
							$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus11,$currmnthplus12);
							$myrmpo=mysql_fetch_row($result4rmpo);
							$totalrmpoqty12 = $myrmpo[1] - $myrmpo[3];
							$poarray[12] = $totalrmpoqty12;
							$rmpoqty12 = $myrmpo[1] - $myrmpo[3];

						}

					}

				$reqfrompo='';
				$totalrmpoqtycomp='';
				$totalrmpoqtyeqn='';

				// Get GRN stock
				$result = $newreport->getgrnqty4crnnew($crn);

				while($mygrn=mysql_fetch_row($result))
				{
				      $crndb = $mygrn[3];
				      $grnqtm=$mygrn[0];
				      $grnqtyused = $mygrn[1];
				      $qty_ret=  $mygrn[4];
				      $grnquar = $mygrn[2];
				     // echo $grnquar."-**---";
					  $grnbal = $grnqtm - $grnqtyused+$qty_ret;
					  $grnarray[$crndb][0] = $grnbal;
					  $grnarray[$crndb][1] = $grnquar;
					  $total4grn += $grnbal;
					  $totalgrn_quar += $grnquar;
				}

			$data .= '<td align="center" width="100px"><span class="schtext"><b>'.$total.'</b></td>';
			$data .= '<td align="center" width="100px"><span class="schtext"><b>'.$totaldn_qty.'</b></td>';
			$data .= '<td align="center" width="100px"><span class="schtext"><b>'.$total_recd4stores.'</b></td>';
			$data .= '<td align="center" width="100px"><span class="schtext"><b>'.$total4dis.'</b></td>';
			$data .= '<td align="center" width="100px"><span class="schtext"><b>'.$total4grn.'</b></td>';
			        

				$fg = $total+$totaldn_qty+$total4dis+$total_recd4stores;
				$grn = $total4grn;



			$bufferqty = 0;
			$count = 0;
			foreach ($crnarr[$crn] as $date => $qtyreq) 
			{
				   if ($qtyreq != 0)
				   {
				       $bufferqty += $qtyreq;
				       $count++;
				   }
			}
			if ($bufferqty > 0)
			{
			   $bufferavg = (int)($bufferqty / $count);
			}
			else
			{
			   $bufferavg = 0;
			}
			if ($bufferavg > $fg)
			{
			    $data .= '<td align="center" bgcolor="#FF0000" width="100px"><span class="labeltext">'.$bufferavg.'</td>';
			}
			else if ($bufferavg == $fg)
			{
			     $data .= '<td align="center" bgcolor="#FFFF00" width="100px"><span class="labeltext">'.$bufferavg.'</td>';
			}
			else 
			{
			     $data .= '<td align="center" bgcolor="#00FF00" width="100px"><span class="labeltext">'.$bufferavg.'</td>';
			}


			foreach ($crnarr[$crn] as $date => $qtyreq) 
			{
				if ($qtyreq != 0)
				{
					   if ($qtyreq == $fg)
					   {
						  //echo "<br>qtyreq got from fg";
						  $equation=$fg . "fg";
						  $disparr[$date] =  " bgcolor=\"#FFFF00\"><span class=\"schtext\">$qtyreq<br>($equation)";
					      $fg = $fg - $qtyreq;
					   }

				  // Next check if req qty is < Finished Goods qty (fg); if so, color green
					   else if ($qtyreq < $fg)
					   {
						    //echo "<br>qtyreq got from fg <";
				    		$equation=$qtyreq . "fg";
							$disparr[$date] =  " bgcolor=\"#00FF00\"><span class=\"schtext\">$qtyreq<br>($equation)";
					        $fg = $fg - $qtyreq;
					    }

					    else if ($qtyreq < ($fg+$grn))
					      {
							  $nextdate=mktime(0,0,0,date("m")+1,date("d"),date("Y"));
							  $grn2mfrdate = date("Y-m-d", $nextdate);
							  //echo "<br>grnmfrdate is $grn2mfrdate";
							  //echo "<br>date is $date";
							  //echo "<br>fg is $fg";
							  $reqfromgrn = $qtyreq-$fg;
					// Added code to check if qty used from grn; if so need WO create trigger
							   if ($reqfromgrn > 0)
							   {	
					              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
								  //echo "<br>wo cr date is $wocrdate";
								  $wotrigarr[$wocrdate] = $reqfromgrn;
								  $wodtarr[$wocrdate] = $date;
					              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
								  //echo "<br>wo tr date is $wotrdate";
								  $treattrigarr[$wotrdate] = $reqfromgrn;
								  $treatdtarr[$wotrdate] = $date;
						       }

							  $equation = $fg . "fg + " . $reqfromgrn . "grn";
							  if ($grn2mfrdate <= $date) 
							  {
								  $disparr[$date] =  " bgcolor=\"#00FF00\"><span class=\"schtext\">$qtyreq<br>($equation)";

							   }
							   else 
							   {
								  $disparr[$date] =  " bgcolor=\"#FFA500\"><span class=\"schtext\">$qtyreq<br>($equation)";

							   }
							  $grn = $grn + $fg - $qtyreq;
							  $fg=0;
						   }

						   else  if ($qtyreq < ($fg+$grn+$poarray[0]))
					      {
							    //echo "<br>Here poarray0 is $poarray[0]";
					  	        poequation(1);
								$equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
								//$totalrmpoqty0 = $grn + $fg + $totalrmpoqty0 - $qtyreq;
					// Added code to check if qty used from grn; if so need WO create trigger
							  // if ($grn > 0)
							 //  {	
					              $wocrdate = date('Y-m-d',strtotime("$date -84days"));
					              //echo "<br>date is $date wo 1 cr date is $wocrdate";
								  $wotrigarr[$wocrdate] = $qtyreq;
								  $wodtarr[$wocrdate] = $date;
					              $wotrdate = date('Y-m-d',strtotime("$date -32days"));
								  //echo "<br>wo tr date is $wotrdate";
								  $treattrigarr[$wotrdate] = $qtyreq;
								  $treatdtarr[$wotrdate] = $date;

						     //  }
							    if ($currmnth < $date)			   
							    {
									  $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

								   }
								   else 
								   {
					                  $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
								   }
										  $fg=0;
										  $grn=0;
						   }

						else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]))
						      {
								    //echo "<br>Here poarray1 is $poarray[1]";
						  	        poequation(2);
									$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
						// Added code to check if qty used from grn; if so need WO create trigger
								   // if ($grn > 0)
								   // {	
						              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
						              //echo "<br>wo 1 cr date is $wocrdate";
									  $wotrigarr[$wocrdate] = $qtyreq;
									  $wodtarr[$wocrdate] = $date;
							          $wotrdate = date('Y-m-d',strtotime("$date -32 days"));
									  //echo "<br>wo tr date is $wotrdate";
									  $treattrigarr[$wotrdate] = $qtyreq;
									  $treatdtarr[$wotrdate] = $date;
							        //}
								    if ($currmnthplus1 < $date)			   
								    {
										$disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

									}
									else 
									{
						                $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
									}
									  $fg=0;
									  $grn=0;

							   }

						else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]))
						      {
								    //echo "<br>Here poarray2 is $poarray[2]";
						  	        poequation(3);
									$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
						// Added code to check if qty used from grn; if so need WO create trigger
								   // if ($grn > 0)
								   // {	
						              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
						              //echo "<br>wo 1 cr date is $wocrdate";
									  $wotrigarr[$wocrdate] = $qtyreq;
									  $wodtarr[$wocrdate] = $date;
						              $wotrdate = date('Y-m-d',strtotime("$date -32 days"));
									  //echo "<br>wo tr date is $wotrdate";
									  $treattrigarr[$wotrdate] = $qtyreq;
									  $treatdtarr[$wotrdate] = $date;
							       // }		    
									
									if ($currmnthplus2 < $date)			   
								    {
										$disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

									   }
									   else 
									   {
						                   $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
									   }
											  $fg=0;
											  $grn=0;

							   }
						else  if ($qtyreq < ($fg+$grn+ $poarray[0]+$poarray[1]+$poarray[2]+$poarray[3]))
						      {
						  	        poequation(4);
									$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
						// Added code to check if qty used from grn; if so need WO create trigger
								   // if ($grn > 0)
								   // {	
						              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
						              //echo "<br>wo 1 cr date is $wocrdate";
									  $wotrigarr[$wocrdate] = $qtyreq;
									  $wodtarr[$wocrdate] = $date;
						              $wotrdate = date('Y-m-d',strtotime("$date -32 days"));
									  //echo "<br>wo tr date is $wotrdate";
									  $treattrigarr[$wotrdate] = $qtyreq;
									  $treatdtarr[$wotrdate] = $date;
							       // }	   
									
									if ($currmnthplus3 < $date)			   
								    {
							           $disparr[$date] = " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

									   }
									   else 
									   {
						                  $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
									   }
											  $fg=0;
											  $grn=0;

							   }
							else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] +  $poarray[4]))
							      {
							  	        poequation(5);
										$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
							// Added code to check if qty used from grn; if so need WO create trigger
									  //  if ($grn > 0)
									  //  {	
							              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
							              //echo "<br>wo 1 cr date is $wocrdate";
										  $wotrigarr[$wocrdate] = $qtyreq;
										  $wodtarr[$wocrdate] = $date;
							              $wotrdate = date('Y-m-d',strtotime("$date -32 days"));
										  //echo "<br>wo tr date is $wotrdate";
										  $treattrigarr[$wotrdate] = $qtyreq;
										  $treatdtarr[$wotrdate] = $date;
								      //  }			    
										
										if ($currmnthplus4 < $date)			   
									    {
								             $disparr[$date] = " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
										   }
										   else 
										   {
							                  $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
										   }

												  $fg=0;
												  $grn=0;
								   }

						else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
								                                $poarray[4]+$poarray[5]))
						      {
						  	        poequation(6);
									$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
						// Added code to check if qty used from grn; if so need WO create trigger
								   // if ($grn > 0)
								    //{	
						              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
						              //echo "<br>wo 1 cr date is $wocrdate";
									  $wotrigarr[$wocrdate] = $qtyreq;
									  $wodtarr[$wocrdate] = $date;
						              $wotrdate = date('Y-m-d',strtotime("$date -32 days"));
									  //echo "<br>wo tr date is $wotrdate";
									  $treattrigarr[$wotrdate] = $qtyreq;
									  $treatdtarr[$wotrdate] = $date;
							       // }		    
									
									if ($currmnthplus5 < $date)			   
								    {
										 $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

									   }
									   else 
									   {
						                  $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
									   }
											  $fg=0;
											  $grn=0;

							   }

							 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
								                                $poarray[4]+$poarray[5] + $poarray[6]))
						      {  	       
								    poequation(7);
									$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
						// Added code to check if qty used from grn; if so need WO create trigger
								   // if ($grn > 0)
								   // {	
						              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
						              //echo "<br>wo 1 cr date is $wocrdate";
									  $wotrigarr[$wocrdate] = $qtyreq;
									  $wodtarr[$wocrdate] = $date;
						              $wotrdate = date('Y-m-d',strtotime("$date -32 days"));
									  //echo "<br>wo tr date is $wotrdate";
									  $treattrigarr[$wotrdate] = $qtyreq;
									  $treatdtarr[$wotrdate] = $date;
							       // }			    
									
									if ($currmnthplus6 < $date)			   
								    {
										$disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

									   }
									   else 
									   {
						                 $disparr[$date] = " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
									   }
											  $fg=0;
											  $grn=0;

							   }
							 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
								                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7]))
						      {  	       
						  	        poequation(8);
									$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
								    
						// Added code to check if qty used from grn; if so need WO create trigger
								   // if ($grn > 0)
								   // {	
						              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
						              //echo "<br>wo 1 cr date is $wocrdate";
									  $wotrigarr[$wocrdate] = $qtyreq;
									  $wodtarr[$wocrdate] = $date;
						              $wotrdate = date('Y-m-d',strtotime("$date -32 days"));
									  //echo "<br>wo tr date is $wotrdate";
									  $treattrigarr[$wotrdate] = $qtyreq;
									  $treatdtarr[$wotrdate] = $date;
							      //  }				
									
									if ($currmnthplus7 < $date)			   
								    {
										$disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

									   }
									   else 
									   {
						                  $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
									   }
											  $fg=0;
											  $grn=0;

							   }

							   
							 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
								                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + $poarray[8]))
						      {  	       
						  	        poequation(9);
									$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
								    
						// Added code to check if qty used from grn; if so need WO create trigger
								  //  if ($grn > 0)
								  //  {	
						              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
						              //echo "<br>wo 1 cr date is $wocrdate";
									  $wotrigarr[$wocrdate] = $qtyreq;
									  $wodtarr[$wocrdate] = $date;
						              $wotrdate = date('Y-m-d',strtotime("$date -32 days"));
									  //echo "<br>wo tr date is $wotrdate";
									  $treattrigarr[$wotrdate] = $qtyreq;
									  $treatdtarr[$wotrdate] = $date;
							      //  }				
									if ($currmnthplus8 < $date)			   
								    {
										$disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

									   }
									   else 
									   {
						                  $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
									   }
											  $fg=0;
											  $grn=0;

							   }
							 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
								                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
								                                $poarray[8] + $poarray[9]))
						      {  	        
								    poequation(10);
									$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
								    
						// Added code to check if qty used from grn; if so need WO create trigger
								  //  if ($grn > 0)
								 //   {	
						              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
						              //echo "<br>wo 1 cr date is $wocrdate";
									  $wotrigarr[$wocrdate] = $qtyreq;
									  $wodtarr[$wocrdate] = $date;
						              $wotrdate = date('Y-m-d',strtotime("$date -32 days"));
									  //echo "<br>wo tr date is $wotrdate";
									  $treattrigarr[$wotrdate] = $qtyreq;
									  $treatdtarr[$wotrdate] = $date;
							      //  }	
									
									if ($currmnthplus9 < $date)			   
								    {
							             $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

									   }
									   else 
									   {
						                  $disparr[$date] =  " bgcolor=\"#FF0000\"  width=\"200px\"><span class=\"schtext\">$qtyreq<br>($equation)";
									   }
											  $fg=0;
											  $grn=0;

							   }

							 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
								                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
								                                $poarray[8] + $poarray[9] + $poarray[10]))	        
						      {
						  	        poequation(11);
									$equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
								    
						// Added code to check if qty used from grn; if so need WO create trigger
								  //  if ($grn > 0)
								 //   {	
						              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
						              //echo "<br>wo 1 cr date is $wocrdate";
									  $wotrigarr[$wocrdate] = $qtyreq;
									  $wodtarr[$wocrdate] = $date;
						              $wotrdate = date('Y-m-d',strtotime("$date -32 days"));
									  //echo "<br>wo tr date is $wotrdate";
									  $treattrigarr[$wotrdate] = $qtyreq;
									  $treatdtarr[$wotrdate] = $date;
							       // }	
									
									if ($currmnthplus10 < $date)			   
								    {
							            $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

									   }
									   else 
									   {
						                  $disparr[$date] =   " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
									   }
											  $fg=0;
											  $grn=0;

							   }
							 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
								                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
								                                $poarray[8] + $poarray[9] + $poarray[10] + $poarray[11]))	        
						      {
						  	        poequation(12);
									$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
								    
						// Added code to check if qty used from grn; if so need WO create trigger
								  //  if ($grn > 0)
								   // {	
						              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
						              //echo "<br>wo 1 cr date is $wocrdate";
									  $wotrigarr[$wocrdate] = $qtyreq;
									  $wodtarr[$wocrdate] = $date;
						              $wotrdate = date('Y-m-d',strtotime("$date -32 days"));
									  //echo "<br>wo tr date is $wotrdate";
									  $treattrigarr[$wotrdate] = $qtyreq;
									  $treatdtarr[$wotrdate] = $date;
							       // }			
									if ($currmnthplus11 < $date)			   
								    {
										$disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

									   }
									   else 
									   {
										  $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
									   }
											  $fg=0;
											  $grn=0;

							   }
							 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
								                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
								                                $poarray[8] + $poarray[9] + $poarray[10] + $poarray[11] + $poarray[12]))	        
						      {
						  	        poequation(13);
									
						// Added code to check if qty used from grn; if so need WO create trigger
								  //  if ($grn > 0)
								   // {	
						              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
						              //echo "<br>wo 1 cr date is $wocrdate";
									  $wotrigarr[$wocrdate] = $qtyreq;
									  $wodtarr[$wocrdate] = $date;
						              $wotrdate = date('Y-m-d',strtotime("$date -32 days"));
									  //echo "<br>wo tr date is $wotrdate";
									  $treattrigarr[$wotrdate] = $qtyreq;
									  $treatdtarr[$wotrdate] = $date;
							      //  }				
									$equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
								    if ($currmnthplus12 < $date)			   
								    {
						                $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

									   }
									   else 
									   {
							              $disparr[$date] = " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
									   }
											  $fg=0;
											  $grn=0;

							   }

					// Else color red if none of the above succeeds
					      else
						  {
							  	$totalrmpoqtycomp = 0;
						        $totalrmpoqtyeqn = "";
								$equation = '';
							  	for ($i = 0; $i <= 12; $i++)
						        {
					                  $poqtysum += $poarray[$i];
									  //echo "<br> value of po array element for $i is $poarray[$i]";
									  if ($poarray[$i] != 0)
								      {
					                       $totalrmpoqtyeqn .= " + $poarray[$i]" .  "po{$i}";
										   $equation = "(" . $totalrmpoqtyeqn . ")";
										   $poarray[$i] = 0;
								      }
							    }
								$equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
								//$equation = $totalrmpoqtyeqn;
							  //echo "<br> po qty sum is $poqtysum";
					   		   $shortfall = $qtyreq - ($fg+$grn+$poqtysum);
						       $poqtysum = 0;
							   if ($shortfall > 0)
							   {	
							      //$orderpo = "- Order PO";
								  //echo "<br> date is $date<br>";
					              $poorddate = date('Y-m-d',strtotime("$date -199 days"));
								  $poarr[$poorddate] = $qtyreq;
								  $podtarr[$poorddate] = $date;
						       }

					           $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
					           //echo "<br>wo 1 cr date is $wocrdate";
							   $wotrigarr[$wocrdate] = $qtyreq;
							   $wodtarr[$wocrdate] = $date;
					           $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
							 //echo "<br>wo tr date is $wotrdate";
							   $treattrigarr[$wotrdate] = $qtyreq;
							   $treatdtarr[$wotrdate] = $date;

							   $disparr[$date] = " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq($shortfall)<br>($equation)";
							   $fg = 0;
							   $grn = 0;
							   $poqtysum=0;
						  }

				}

					else
					{
					   //$disparr[$date] = $qtyreq;
					   $disparr[$date] ="$qtyreq";
					}

					$actcount++;
					if ($actcount == $schdtcount)
						break;

			}

			  	while ($actcount < $schdtcount)
				{
				    $disparr[$date] = '';
					//echo "<tr bgcolor=\"#FFCC00\"><td align=\"center\" bgcolor=\"#FFFFFF\" width=\"200px\"><span class=\"schtext\">&nbsp</td></tr>";
			       $actcount++;
				}
			    $actcount = 0;

			     $skip = 0;
				 $wotrigger = '';
				 $potrigger = '';
				 $dispdate = '';
				 $dataflag = 0;


for ($j=0; $j<=51; $j++) 
{
	 
	   $data2 = '';
	  $thisweek = $j;
	  $nextweek = $thisweek+1;
	  $fromdate = $schweekarr[$thisweek];
      $todate = $schweekarr[$nextweek];

     foreach ($disparr as $dispdate => $data1) 
      {
		 //echo "from date = $fromdate; todate = $todate and $dispdate $data1";
	     if (check_in_range($fromdate, $todate, $dispdate) && $data1 != '')
		 {
			
		    $data2 .= $data1."<br>";
			
			$dataflag = 1;
		 }
		
      }

      $dataflag = 0;

	  foreach($poarr as $orddate => $reqqty) 
      {
	     if (check_in_range($fromdate, $todate, $orddate))
	     {
           $potrigger += $reqqty;
		   $po4schdt = $podtarr[$orddate];
		   unset($poarr[$orddate]);	     
		 }
      }

       foreach($wotrigarr as $wocrdate => $woqty) 
      {
	     if (check_in_range($fromdate, $todate, $wocrdate))
	     {
           $wotrigger += $woqty;
		   $wo4schdt = $wodtarr[$wocrdate];
		   unset($wotrigarr[$wocrdate]);
	     }
      }

      // Check for WO Treatment trigger
	  foreach($treattrigarr as $trtrdate => $wotrqty) 
      {
	     if (check_in_range($fromdate, $todate, $trtrdate))
	     {
           $treattrigger += $wotrqty;
		   $tr4schdt = $treatdtarr[$trtrdate];
		   unset($treattrigarr[$trtrdate]);

	     }
      }

        if ($ftrigger == 'ALL' or $ftrigger == 'WO' or
	   $ftrigger == 'all' or $ftrigger == 'wo')
	   {
			 if ($wotrigger != '')
			 {
				 $datearr = split('-', $wo4schdt);
		         $d=$datearr[2];
		         $m=$datearr[1];
		         $y=$datearr[0];
		         $x=mktime(0,0,0,$m,$d,$y);
		         $wotrdate=date("M j, Y",$x);
			     $data2 = $data2 . "<br><b><font color=\"#990000\">(WO for $wotrigger nos. for <br>$wotrdate)</b></font>";
				  $wotrigger = '';
			 }
	   }

	     if ($ftrigger == 'ALL' or $ftrigger == 'TREAT' or
	   $ftrigger == 'all' or $ftrigger == 'treat')
	   {
		 if ($treattrigger != '')
		 {
			 $datearr = split('-', $tr4schdt);
	         $d=$datearr[2];
	         $m=$datearr[1];
	         $y=$datearr[0];
	         $x=mktime(0,0,0,$m,$d,$y);
	         $trtrdate=date("M j, Y",$x);
		     $data2 = $data2 . "<br><b><font color=\"#990000\">($treattrigger nos. to Treatment for <br>$trtrdate)</b></font>";
			  $treattrigger = '';
		 }

	   }


	   if ($ftrigger == 'ALL' or $ftrigger == 'RMPO' or
	  $ftrigger == 'all' or $ftrigger == 'rmpo')
	   {
		 if ($potrigger != '')
		 {
			 $datearr = split('-', $po4schdt);
			 //echo "<br>po ord dt is $po4schdt";
	         $d=$datearr[2];
	         $m=$datearr[1];
	         $y=$datearr[0];
	         $x=mktime(0,0,0,$m,$d,$y);
	         $potrigdate=date("M j, Y",$x);
		      $data2 .= "<br><b><font color=\"#990000\">(RM PO $potrigger nos. for <br>$potrigdate)</b></font>";
			  $potrigger = '';
		 }
	   }


	  $data .= '<td width="200px" align="center"'.$data2. '</td>';

}


   $data .='<td align="center" width="100px"><span class="schtext"><b>'.$rmpoqty0.'</b></td>';

   $data .='<td align="center" width="100px"><span class="schtext"><b>'.$rmpoqty1.'</b></td>';
   $data .='<td align="center" width="100px"><span class="schtext"><b>'.$rmpoqty2.'</b></td>';
   $data .='<td align="center" width="100px"><span class="schtext"><b>'.$rmpoqty3.'</b></td>';
   $data .='<td align="center" width="100px"><span class="schtext"><b>'.$rmpoqty4.'</b></td>';
   $data .='<td align="center" width="100px"><span class="schtext"><b>'.$rmpoqty5.'</b></td>';
   $data .='<td align="center" width="100px"><span class="schtext"><b>'.$rmpoqty6.'</b></td>';
   $data .='<td align="center" width="100px"><span class="schtext"><b>'.$rmpoqty7.'</b></td>';
   $data .='<td align="center" width="100px"><span class="schtext"><b>'.$rmpoqty8.'</b></td>';
   $data .='<td align="center" width="100px"><span class="schtext"><b>'.$rmpoqty9.'</b></td>';
   $data .='<td align="center" width="100px"><span class="schtext"><b>'.$rmpoqty10.'</b></td>';
   $data .='<td align="center" width="100px"><span class="schtext"><b>'.$rmpoqty11.'</b></td>';
   $data .='<td align="center" width="100px"><span class="schtext"><b>'.$rmpoqty12.'</b></td>';

$data .= '</tr>';
$disparr = array();
$poarr = array();
$podtarr = array();
$wotrigarr = array();
$wodtarr = array(); 
$treattrigarr = array();
$treatdtarr = array();

			}


		}	 


	else {

	$data .= '<table align="top" style="table-layout: fixed" width="700px" style="border:1px solid #000000;" border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
	$data .= '<tr bgcolor="#FFCC00">';
	$data .= '<td width="55px" bgcolor="#EEEFEE"><span class="schtext" align="center"><b>PRN</b></td>';
	$data .= '<td width="70px" bgcolor="#EEEFEE"><span class="schtext" align="center"><b>Part Number</b></td>';
	$data .= '<td width="44px" bgcolor="#EEEFEE"><span class="schtext" align="center"><b>WO Qty<br>(WIP)</b></td>';
	$data .= '<td width="40px" bgcolor="#EEEFEE"><span class="schtext" align="center><b>DN<br>Bal</b></td>';
	$data .= '<td width="40px" bgcolor="#EEEFEE"><span class="schtext" align="center"><b>FG<br>Stock</b></td>';
	$data .= '<td width="40px" bgcolor="#EEEFEE"><span class="schtext" align="center"><b>GRN<br>Stock</b></td>';
	$data .= '<td width="80px" bgcolor="#EEEFEE"><span class="schtext" align="center"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RMPO<br>)</b></td></tr>';

	$data .= ' <td align="center" width="40px"><span class="schtext"><b>'.$crn.'</b></td>';
	$data .= '<td align="center" width="40px"><span class="schtext"><b>'."0".'</b></td>';
	$data .= '<td align="center" width="40px"><span class="schtext"><b>'."0".'</b></td>';
	$data .= '<td align="center" width="40px"><span class="schtext"><b>'."0".'</b></td>';
	$data .= '<td align="center" width="40px"><span class="schtext"><b>'."0".'</b></td>';
	$data .= '<td align="center" width="40px"><span class="schtext"><b>'."0".'</b></td>';

   }



}



function check_in_range($start_date, $end_date, $date_from_user)
{
  // Convert to timestamp
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($date_from_user);

  // Check that user date is between start & end
  return (($user_ts >= $start_ts) && ($user_ts < $end_ts));
}

function poequation($pocount)
{
   // GLOBAL $totalrmpoqty0, $totalrmpoqty1, $totalrmpoqty2, $totalrmpoqty3, 
//		             $totalrmpoqty4, $totalrmpoqty5, $totalrmpoqty6, $totalrmpoqty7, 
//		             $totalrmpoqty8, $totalrmpoqty9, $totalrmpoqty10, $totalrmpoqty11,
//	                  $totalrmpoqty12, $reqfrompo;
    GLOBAL $poarray, $qtyreq, $fg, $grn, $reqfrompo, $totalrmpoqtycomp,$totalrmpoqtyeqn;
	$totalrmpoqtycomp = 0;
	$totalrmpoqtyeqn = "";
	$usedfrompo = 0;
	for ($i = 0; $i < $pocount; $i++)
	{
		    $index = $pocount -1;
			
			if ($poarray[$i] == '' || $poarray[$i] == 0)
		    {
				$poarray[$i] = 0;
		     }
            else
			{
	              $totalrmpoqtycomp = $totalrmpoqtycomp + $poarray[$i];
				  //echo "<br>totalpo till now is $totalrmpoqtycomp";
				  $reqfrompo = $qtyreq-($fg+$grn)-$usedfrompo;
				  //echo "<br>reqfrom po for $i is $reqfrompo";
				  if ($reqfrompo > $poarray[$i])
				  {
			  	      $usedfrompo = $poarray[$i];
					  $poarray[$i] = 0;
					  $totalrmpoqtyeqn .= "+ $usedfrompo" . "po{$i}";
				  }
				  else
				  {
			  	      $usedfrompo = $reqfrompo;
					  $poarray[$i] = $poarray[$i] - $reqfrompo;
					  $totalrmpoqtyeqn .= "+ $usedfrompo" . "po{$i}";
				  }
			      
				  //echo "<br>reqfrom po for $i is $reqfrompo";
				  //echo "<br>In function value of poarray for $i is $poarray[$i]";
				  //var_dump($poarray);
	         }
            //$poarray[$index] = 0;
	}
	$reqfrompo = $qtyreq-($fg+$grn+$totalrmpoqtycomp);
	//echo "<br>In function value of reqfrom po is $reqfrompo and pocount is $pocount";
	//echo "<br>In function value of poarray for $index is $poarray[$index]";

}	



$data .= '</tr>';
$data .= '<table>';
$data .= '</td>';
$data .= '</tr>';
$data .= '</table>';
$data .= '</td></tr>';
$data .= '</table>';
$data .= '</tr>';

$data .= '</table>';
$data .= '</table>';
$data .= '</table>';
$data .= '</table>';

$data .= '</body>';
$data .= '</html>';

header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=export_crnoutlook.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";

    
// echo "<pre>";
// print_r($_REQUEST); exit;


?>