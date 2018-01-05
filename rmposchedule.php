<?php
session_start();
header("Cache-control: private");
if(!isset($_SESSION['user']))
{
  header("Location: login.php");
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');

// First include the class definition
include_once('classes/reportClass.php');
include_once('classes/displayClass.php');

$newreport = new report;
$rowsPerPage = 10;
$crn=$_REQUEST['crn_rmpo'];
$pageNum = 1;
$crnarr = array();
$crnonlyarr = array();
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<?php
$udate='0000-00-00';
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
//echo "HERE---";
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
                   $crnarr[$crn1][$date] = $qty;
				  //echo $crnarr[$crn1][$date];
                  $crnonlyarr[$crn1] = $crn1;
                }
				//print_r($crnarr);
?>

<table align="top" style="table-layout: fixed" width="590px"  border=0 cellpadding=3 cellspacing=1 class="stdtable">
<tr>
<thead>
<th width="90px" class="head0"><span class="labeltext" align="center"><b>PRN</b></th>
<th width="90px"  class="head1"><span class="labeltext" align="center"><b>Sch Date</b></th>
<th width="90px" class="head0"><span class="labeltext" align="center"><b>Sch Po Qty</b></th>
<th width="90px"  class="head1"><span class="labeltext" align="center"><b>PO Projection</b></th>
</tr>
<?php
foreach($crnarr as $crn2 => $values) 
{ 
   foreach($values as $date => $qty) 
   {    $udate=$date;	 
        $datearr = split('-', $date);
        $d=$datearr[2];
        $m=$datearr[1];
        $y=$datearr[0];
        $x=mktime(0,0,0,$m,$d,$y);
        $date1=date("M j, Y",$x);
   } 
   break;
}
$i = 0;
$suffix = '';
while ($i < 13)
{
    $nextdate=mktime(0,0,0,date("m")+$i,date("d"),date("Y"));
    $nextmonth = date("Y-m-d", $nextdate);
    $datearr = split('-', $nextmonth);
    $d=$datearr[2];
    $m=$datearr[1];
    $y=$datearr[0];
    $x=mktime(0,0,0,$m,$d,$y);
    $rmpodate1=date("M j, Y",$x);
  $i++;
}
?>
</table>
<table style="table-layout: fixed;width:100%" border=0 cellpadding=3 cellspacing=1 class="stdtable">
<?php
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

$result = $newreport->getcrnfromlob($cond1,$crn);
$total=0;
$total4dis=0;
$total4grn=0;
$totalgrn_quar=0;
$totalbalance=0;
$totalbalance_quar=0;
$totaldn_qty=0;
$totalrecd_qty=0;
$totalrmpoqty=0;
$woprocarr = array("Assembly","Untreated","Treated");
while($myrow4crn=mysql_fetch_row($result))
{
 $dnSent_qty=0;
 $dnRecd_qty=0; 
 $part_num=wordwrap($myrow4crn[4],30,"<br>\n");

foreach ($woprocarr as $proc)
{
//echo "process is $proc<br>";

$openflag=0;
$results = $newreport->getallCRN4open($myrow4crn[1],$proc);
while($myrow4=mysql_fetch_row($results))
{
 if($proc == "Treated")
 {
  $dn = $newreport->getdn_qty($myrow4crn[1],$proc);
  $dn_sent = split("\|",$dn);
  $dnSent_qty = $dn_sent[0];
  $dnRecd_qty = $dn_sent[1];
  $total = $total + ($myrow4[2]-$dn_sent[0]);
  $totalrecd_qty += $dn_sent[0];
 }
 else
 {
  $total = $total + $myrow4[2];
 }
}
if($proc == 'Treated')
{
  $totaldn_qty += ($dnSent_qty-$dnRecd_qty);
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

$resultall = $newreport->getCRN($myrow4crn[1],'Regular');
while($myrow4all=mysql_fetch_row($resultall))
{
$result2 = $newreport->getallGRN4Details($myrow4all[2],$myrow4all[0],$myrow4all[1],'Regular');
$num_rows = mysql_num_rows($result2);
if($num_rows=='0')
{
}
while($myrow4grn=mysql_fetch_row($result2))
{
 $result4 = $newreport->get_woretqty($myrow4grn[0]);
 $myrow= mysql_fetch_row($result4);
 $balance=$myrow[1]+$myrow4grn[2];
 if ($proc == 'Untreated')
 {
 $total4grn = $total4grn + $balance;
 $totalbalance =$totalbalance+$balance;
 }
}
}
$totalbalance='&nbsp';
$result_crn_quar = $newreport->getCRN($myrow4crn[1],'Quarantined');
while($myrow4crn_quar=mysql_fetch_row($result_crn_quar))
{
 $result_grnDet_quar = $newreport->getallGRN4Details($myrow4crn_quar[2],$myrow4crn_quar[0],$myrow4crn_quar[1],'Quarantined');
 $num_rows = mysql_num_rows($result_grnDet_quar);
while($myrow4grn_quar=mysql_fetch_row($result_grnDet_quar))
{
  $result_ret_quar = $newreport->get_woretqty($myrow4grn_quar[0]);
  $myrow_ret= mysql_fetch_row($result_ret_quar);
  $balance_quar=$myrow_ret[1]+$myrow4grn_quar[2];
  if ($proc == 'Manufacture Only')
  {
   $totalgrn_quar = $totalgrn_quar+$balance_quar;
   $totalbalance_quar = $totalbalance_quar+$balance_quar;
  }
 }
}

$totalbalance='&nbsp';
$totalbalance_quar='&nbsp';
$poarray = array();
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],'0000-00-00',$currmnth);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty0 = $myrmpo[1];
 $poarray[0] = $totalrmpoqty0;
$rmpoqty0 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnth,$currmnthplus1);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty1 = $myrmpo[1];
$poarray[1] = $totalrmpoqty1;
$rmpoqty1 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus1,$currmnthplus2);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty2 = $myrmpo[1];
$poarray[2] = $totalrmpoqty2;
$rmpoqty2 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus2,$currmnthplus3);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty3 = $myrmpo[1];
$poarray[3] = $totalrmpoqty3;
$rmpoqty3 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus3,$currmnthplus4);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty4 = $myrmpo[1];
$poarray[4] = $totalrmpoqty4;
$rmpoqty4 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus4,$currmnthplus5);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty5 = $myrmpo[1];
$poarray[5] = $totalrmpoqty5;
$rmpoqty5 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus5,$currmnthplus6);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty6 = $myrmpo[1];
$poarray[6] = $totalrmpoqty6;
$rmpoqty6 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus6,$currmnthplus7);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty7 = $myrmpo[1];
$poarray[7] = $totalrmpoqty7;
$rmpoqty7 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus7,$currmnthplus8);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty8 = $myrmpo[1];
$poarray[8] = $totalrmpoqty8;
$rmpoqty8 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus8,$currmnthplus9);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty9 = $myrmpo[1];
$poarray[9] = $totalrmpoqty9;
$rmpoqty9 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus9,$currmnthplus10);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty10 = $myrmpo[1];
$poarray[10] = $totalrmpoqty10;
$rmpoqty10 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus10,$currmnthplus11);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty11 = $myrmpo[1];
$poarray[11] = $totalrmpoqty11;
$rmpoqty11 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus11,$currmnthplus12);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty12 = $myrmpo[1];
$poarray[12] = $totalrmpoqty12;
$rmpoqty12 = $myrmpo[1];
}
$crndataarray[$crn]=$myrow4crn[1];
}
$reqfrompo='';
$totalrmpoqtycomp='';
$totalrmpoqtyeqn='';
		$fg = $total+$totaldn_qty+$total4dis;
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
   $bufferavg = $bufferqty / $count;
}
else
{
   $bufferavg = 0;
}
foreach ($crnarr[$crn] as $date => $qtyreq) 
{	
	//echo $qtyreq.'======';
	if ($qtyreq != 0)
	{	   
	   if ($qtyreq == $fg)
	   {
		   $equation=$fg . "fg";	     
	   }  	   // Next check if req qty is < Finished Goods qty (fg); if so, color green
	   else if ($qtyreq < $fg)
	   {
    		$equation=$qtyreq . "fg";	       
	        $fg = $fg - $qtyreq;
	    }

	  else if ($qtyreq < ($fg+$grn))
      {
				  $nextdate=mktime(0,0,0,date("m")+1,date("d"),date("Y"));
                  $grn2mfrdate = date("Y-m-d", $nextdate);
				 /* echo "<br>grnmfrdate is $grn2mfrdate";
				  echo "<br>date is $date";
				  echo "<br>fg is $fg";*/
				  $reqfromgrn = $qtyreq-$fg;
				  $equation = $fg . "fg + " . $reqfromgrn . "grn";
				
			      $grn = $grn + $fg - $qtyreq;
				  $fg=0;
	   }


	 else  if ($qtyreq < ($fg+$grn+$poarray[0]))
      {
		    //echo "<br>Here poarray0 is $poarray[0]";
  	        poequation(1);
			$equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]))
      {
		    //echo "<br>Here poarray1 is $poarray[1]";
  	        poequation(2);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;	

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]))
      {
		    //echo "<br>Here poarray2 is $poarray[2]";
  	        poequation(3);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;

	   }

	 else  if ($qtyreq < ($fg+$grn+ $poarray[0]+$poarray[1]+$poarray[2]+$poarray[3]))
      {
  	        poequation(4);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;

	   }

	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]))
      {
  	        poequation(5);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5]))
      {
  	        poequation(6);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;		

	   }

	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6]))
      {  	       
		    poequation(7);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;		
	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7]))
      {  	       
  	        poequation(8);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;		  
	   }
	 else  if($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + $poarray[8]))
      {  	       
  	        poequation(9);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;		  
	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
		                                $poarray[8] + $poarray[9]))
      {  	        
		    poequation(10);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;		

	   }

	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
		                                $poarray[8] + $poarray[9] + $poarray[10]))	        
      {
  	        poequation(11);
			$equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;		 
	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
		                                $poarray[8] + $poarray[9] + $poarray[10] + $poarray[11]))	        
      {
  	        poequation(12);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;		

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
		                                $poarray[8] + $poarray[9] + $poarray[10] + $poarray[11] + $poarray[12]))	        
      {
  	        poequation(13);
			$equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
		
	   }
  	// Else color red if none of the above succeeds
      else
	  {
		  	$totalrmpoqtycomp = 0;
	        $totalrmpoqtyeqn = "";
		  	for ($i = 0; $i <= 12; $i++)
	       {
                  $poqtysum += $poarray[$i];				  
				  if ($poarray[$i] != 0)
			      {
                       $totalrmpoqtyeqn .= "+ $poarray[$i]" .  "po{$i}";
					    $poarray[$i] = 0;
			      }
		    }
		  $equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;	
   		  $shortfall = $qtyreq - ($fg+$grn+$poqtysum);
	      $poqtysum = 0;
		 
		  $datearr=split('-',$date);
		  $d=$datearr[2];
          $m=$datearr[1];
          $y=$datearr[0];		
		  if($proc=='Untreated')
		  {
             $x=mktime(0,0,0,$m-4,$d,$y);
		  }
		  else
		  {
             $x=mktime(0,0,0,$m-5,$d,$y);
		  }          
          $date2=date("M j, Y",$x);
          $schdate=date('M d,Y',strtotime($date));	
          // echo $prevcrn . " " . $crn;
		  if($prevcrn!=$crn)
            {

                 echo "<td align=\"center\" bgcolor=\"#FFFFFF\"  width=\"90px\"><span class=\"tabletext\">$crn</td>";
				 echo "<td align=\"center\" bgcolor=\"#FFFFFF\"  width=\"90px\"><span class=\"tabletext\">$schdate</td>";
				  echo "<td align=\"center\" bgcolor=\"#FFFFFF\"  width=\"90px\"><span class=\"tabletext\">$qtyreq($schdate)</td>";
				echo "<td align=\"center\" bgcolor=\"#FFFFFF\"  width=\"90px\"><span class=\"tabletext\">$date2</td>";
				
            }
		  else
		  {


				  echo "<td align=\"center\" bgcolor=\"#FFFFFF\"  width=\"90px\"><span class=\"tabletext\">&nbsp;</td>";
				  echo "<td align=\"center\" bgcolor=\"#FFFFFF\"  width=\"90px\"><span class=\"tabletext\">$schdate</td>";
			      echo "<td align=\"center\" bgcolor=\"#FFFFFF\" width=\"90px\"><span class=\"tabletext\">$qtyreq($schdate)</td>";
				  echo "<td align=\"center\" bgcolor=\"#FFFFFF\"  width=\"90px\"><span class=\"tabletext\">$date2</td>";
				  echo "</tr>";
				  $prevcrn=$crn;
				  $fg = 0;
				  $grn = 0;
				  $poqtysum=0;
		}
	  }
	}
	else
	{
		    // echo "<td align=\"center\" bgcolor=\"#FFFFFF\" width=\"100px\"><span class=\"labeltext\">$qtyreq</td>";
	}
   }   
 }
}
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

?>
</tr>
</table>
</td>

</table>
</table>
</FORM>
</body>
</html>