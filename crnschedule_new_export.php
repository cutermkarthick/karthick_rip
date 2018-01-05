<?php
// First include the class definition
include_once('classes/reportClass.php');
include_once('classes/displayClass.php');


$newreport = new report;

$username=$_SESSION['username'];
$header='';
$data='';
$str='';
$data .='<html><head><style type="text/css">
			.Heading {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; font-style: normal; line-height: normal;
font-weight: font-variant: normal; text-transform: none; color: #000000}

.pageheading {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; font-style: normal; line-height: normal;
font-weight: font-variant: normal; text-transform: none; color: #000000}

.labeltext {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt; font-style: normal;
line-height: normal; font-weight: bold; font-variant: normal; text-transform: none; color: #000000}

.tabletext {  font-family: Verdana, sans-serif; font-size: 8pt; font-style: normal;
line-height: normal; font-weight: normal; font-variant: normal; text-transform: none; color: #000000}

.linktext {  font-family: Verdana, sans-serif; font-size: 9pt; font-style: normal;
line-height: normal; font-weight: normal; font-variant: normal; text-transform: none; color: #0066CC}

.welcome {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-style: normal;
line-height: normal; font-weight: normal; font-variant: normal; text-transform: none; color: #000000}

.customer {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-style: normal;
line-height: normal; font-weight: normal; font-variant: normal; text-transform: none; color: #00FFCC}

.ptext {  font-family: Verdana, sans-serif; font-size: 9pt; font-style: normal;
line-height: normal; font-weight: bold; font-variant: normal; text-transform: none; color: #000000}

			</style></head>';
$data.='<body>';
$title="CRN SCHEDULE EXPORT";
$data.='<table border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" rules="all">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=20 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="2" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';

$crn=$_REQUEST['crn'];
// by default we show first page
$pageNum = 1;
$crnarr = array();
$crnonlyarr = array();
$userrole = $_SESSION['userrole'];

$data .= '<table valign="top" width="100%" border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td valign="top"> ';

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



$data .='<table align="top" style="table-layout: fixed" width="650px" border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align="center"><b>LEGEND:</b></td>
<td width="20px" height="20px" bgcolor="#00FF00"><span class="labeltext" align="center">&nbsp</td>
<td width="55px" bgcolor="#FFFFFF"><span class="labeltext" align="center"><b>Safe</b></td>
<td width="20px" bgcolor="#FFFF00"><span class="labeltext" align="center">&nbsp</td>
<td width="90px" bgcolor="#FFFFFF"><span class="labeltext" align="center"><b>Borderline</b></td>
<td width="20px" bgcolor="#00DDFF"><span class="labeltext" align="center">&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align="center"><b>Qty from PO</b></td>
<td width="20px" bgcolor="#FF0000"><span class="labeltext" align="center">&nbsp</td>
<td width="70px" bgcolor="#FFFFFF"><span class="labeltext" align="center"><b>Danger</b></td>
<td width="20px" bgcolor="#FFA500"><span class="labeltext" align="center">&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align="center"><b>GRN Problem</b></td>
<td width="20px" bgcolor="#0000FF"><span class="labeltext" align="center">&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align="center"><b>PO Date Issue</b></td>
 </tr>
</table>
<table align="top" style="table-layout: fixed" width="700px" style="border:1px solid #000000;" border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFCC00">
<td width="90px"  align="center" bgcolor="#EEEFEE"><span class="labeltext" align="center"><b>PRN</b></td>
<td width="180px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Part Number</b></td>
<td width="60px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>WIP (fg)</b></td>
<td width="60px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>DN (fg)</b></td>
<td width="60px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>FG (fg)</b></td>
<td width="65px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>GRN (grn)</b></td>
<td width="65px"  align="center" bgcolor="#3BE8D4"><span class="labeltext"><b>Buffer</b></td> ';

foreach($crnarr as $crn2 => $values)
{
   foreach($values as $date => $qty)
   {
        $datearr = split('-', $date);
        $d=$datearr[2];
        $m=$datearr[1];
        $y=$datearr[0];
        $x=mktime(0,0,0,$m,$d,$y);
        $date1=date("M j, Y",$x);
		$data .='<td width="100px" bgcolor="#FFCCFF" align="center"><span class="labeltext" ><b>'. $date1 .'</b></td>';
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
/*
	if ($i >0 )
	{
		$suffix = $i;
	}
	*/

$data .='<td width="100px" bgcolor="#EEEFEE"  align="center"><span class="labeltext">
<b>PO '. $i .'<br>'. $rmpodate1 .'</b></td> ';


  $i++;
}

$data .='</table>
<div style="height:400;overflow:auto;border:" id="dataList">

<table style="table-layout: fixed" border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >  ';

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
$totalrecd_qty=0;
$totalrmpoqty=0;
$woprocarr = array("Assembly","Manufacture Only","With Treatment","For Assembly");
//while($myrow4crn=mysql_fetch_row($result))
//{
 $dnSent_qty=0;
 $dnRecd_qty=0;
/*$part_num=wordwrap($myrow4crn[4],30,"<br>\n");
printf('<tr bgcolor="#FFFFFF" >
        <td align="center" width="90px"><span class="labeltext"><font color="black">%s</font></td>
        <td align="center" width="180px"><span class="labeltext">%s</td>',$myrow4crn[1],$part_num);*/
$result_new = $newreport->getstock4crnnew($cond1,$crn,$woprocarr);
while($myrow4stock=mysql_fetch_row($result_new))
{
	  if ($ft == 1)
	  {
	       $prevcrndb = $myrow4stock[0];
	  }
	  if ($ft != 1 && $prevcrndb != $myrow4stock[0])
	  {
	       $procarray = array();
           $prevcrndb = $myrow4stock[0];
	  }
      //$crndb = $myrow4stock[0];
      $proc = $myrow4stock[1];
      //echo $proc."---**----";
	  $compqty = $myrow4stock[2];
	  $dispqty = $myrow4stock[3];
	  $dnbal = $myrow4stock[4];
      $fg_qty = $myrow4stock[5];
	  $wip = $myrow4stock[6];
      $cond = $myrow4stock[7];
      $dnbalst = $myrow4stock[8];
	  //echo "<br>proc is $fg_qty<br>";

         if($cond == 'Closed')
         {
           $procarray[2] += $fg_qty;
           $total4dis += $fg_qty;
         }
         else
	  {
          if($fg_qty!=0)
          {
            $procarray[2] += $fg_qty;
            $total4dis += $fg_qty;
          }
          //echo "<br>proc are $fg_qty<br>";
          $procarray[0] = $wip;
		  $procarray[1] = $dnbal;
		  $procarray[3] = $dnbalst;
		 // echo $wip."--**---".$myrow4stock[0]."<br>";
		  $total += $wip;
		  if($proc=='With Treatment')
		  {
		      $totaldn_qty += $dnbal;
		      $total_recd4stores +=  $dnbalst;
		  }

		 // echo "<br>qty is $wip<br>";
	   }
         //echo "<br>cqty is $fg_qty<br>";
	   //}
	  $crnarray[$prevcrndb]=$procarray;
      $ft = 0;
}
// Get GRN stock
$result_grn = $newreport->getgrnqty4crnnew($crn);
while($mygrn=mysql_fetch_row($result_grn))
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
	  if($mygrn[5]=='Manufacture Only')
	  {   //echo
	      $total4grn += $grnbal;
	      $totalgrn_quar += $grnquar;
	  }

}
while($myrow4crn=mysql_fetch_row($result))
{
 $dnSent_qty=0;
 $dnRecd_qty=0;
$part_num=wordwrap($myrow4crn[4],30,"<br>\n");
$data .='<tr bgcolor="#FFFFFF" >
        <td align="center" width="90px"><span class="labeltext"><font color="black">'. $myrow4crn[1] .'</font></td>
        <td align="center" width="180px"><span class="labeltext">'. $part_num .'</td>';
foreach ($woprocarr as $proc)
{
//echo "process is $proc<br>";

$openflag=0;

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
 $crninp = $myrow4crn[1];
}
$reqfrompo='';
$totalrmpoqtycomp='';
$totalrmpoqtyeqn='';

$wip_qty= $crnarray[$crninp][0] ;
$dn= $crnarray[$crninp][1] ;
$fgqty= $crnarray[$crninp][2] ;
$grnqty= $grnarray[$crninp][0] ;
//echo $fgqty."/////////$crninp<br>";
$data .='
         <td align="center" width="60px"><span class="labeltext"><b>'. $wip_qty .'</b></td>
         <td align="center" width="60px"><span class="labeltext"><b>'. $dn .'</b></td>
	     <td align="center" width="60px"><span class="labeltext"><b>'. $fgqty .'</b></td>
		 <td align="center" width="65px"><span class="labeltext"><b>'. $grnqty .'</b></td>';
		$fg = $wip_qty+$dn+$fgqty;
		$grn = $grnqty;
$bufferqty = 0;
$count = 0;
//echo $fgqty."---**---".$qtyreq."<br>";
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
$buffer_avg=number_format($bufferavg ,2,'.','');
//echo $fgqty."--**---$bufferavg<br>";
if ($bufferavg > $fgqty)
{
      $data .='<td align="center" bgcolor="#FF0000" width="65px"><span class="labeltext">'. $buffer_avg .'</td>' ;
}
else if ($bufferavg == $fgqty)
{
      $data .='<td align="center" bgcolor="#FFFF00" width="65px"><span class="labeltext">'. $buffer_avg .'</td>' ;
}
else
{
     $data .='<td align="center" bgcolor="#00FF00" width="65px"><span class="labeltext">'. $buffer_avg .'</td>' ;
}
foreach ($crnarr[$crn] as $date => $qtyreq)
{
	if ($qtyreq != 0)
	{
	   //echo "<br>qtyreq is $qtyreq as on $date for crn $crn";
	   //echo "<br>fg is $fg";
	   //echo "<br>grn is $grn";
	   // First check if req qty is equal to Finished Goods qty (fg); if so, color yellow
	   if ($qtyreq == $fg)
	   {
		   $equation=$fg . "fg";
	     $data .='<td align="center" bgcolor="#FFFF00" width="100px"><span class="labeltext">'. $qtyreq .'</td>';
	      $fg = $fg - $qtyreq;
	   }

  	   // Next check if req qty is < Finished Goods qty (fg); if so, color green
	   else if ($qtyreq < $fg)
	   {
    		$equation=$qtyreq . "fg";
	        $data .='<td align="center" bgcolor="#00FF00" width="100px"><span class="labeltext">'. $qtyreq .'</td>';
	        $fg = $fg - $qtyreq;
	    }

  	   // Else check if req qty is < fg+grn; if so, color green
	  // For grn qty check you need to add 4 weeks to today and check
	  // to see if the date falls within the req date and color green else red
	  else if ($qtyreq < ($fg+$grn))
      {
				  $nextdate=mktime(0,0,0,date("m")+1,date("d"),date("Y"));
                  $grn2mfrdate = date("Y-m-d", $nextdate);
				  //echo "<br>grnmfrdate is $grn2mfrdate";
				  //echo "<br>date is $date";
				  //echo "<br>fg is $fg";
				  $reqfromgrn = $qtyreq-$fg;
				  $equation = $fg . "fg + " . $reqfromgrn . "grn";
				  if ($grn2mfrdate <= $date)
				  {
	                  $data .='<td align="center" bgcolor=#00FF00"  width="100px"><span class="labeltext">'.$qtyreq .'</td>';

				   }
				   else
				   {
		                  $data .='<td align="center" bgcolor="#FFA500"  width="100px">'. $qtyreq .'</td>';

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
		    if ($currmnth < $date)
		    {
	                  $data .='<td align="center" bgcolor="#00DDFF"  width="100px"><span class="labeltext"> '. $qtyreq .'</td>';

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                 $data .='<td align="center" bgcolor="#0000FF"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';
			   }

	   }

	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]))
      {
		    //echo "<br>Here poarray1 is $poarray[1]";
  	        poequation(2);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus1 < $date)
		    {
	                  $data .='<td align="center" bgcolor="#00DDFF"  width="100px"><span class="labeltext"> '. $qtyreq .'</td>';

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  $data .='<td align="center" bgcolor="#EEEFEE"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';
			   }

	   }


	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]))
      {
		    //echo "<br>Here poarray2 is $poarray[2]";
  	        poequation(3);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus2 < $date)
		    {
	                  $data .='<td align="center" bgcolor="#00DDFF"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  $data .='<td align="center" bgcolor="#EEEFEE"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';
			   }

	   }

	 else  if ($qtyreq < ($fg+$grn+ $poarray[0]+$poarray[1]+$poarray[2]+$poarray[3]))
      {
  	        poequation(4);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus3 < $date)
		    {
	                  $data .='<td align="center" bgcolor="#00DDFF"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  $data .='<td align="center" bgcolor="#EEEFEE"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';
			   }

	   }

	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] +
		                                $poarray[4]))
      {
  	        poequation(5);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus4 < $date)
		    {
	                  $data .='<td align="center" bgcolor="#00DDFF"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  $data .='<td align="center" bgcolor="#EEEFEE"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';
			   }

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] +
		                                $poarray[4]+$poarray[5]))
      {
  	        poequation(6);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus5 < $date)
		    {
	                  $data .='<td align="center" bgcolor="#00DDFF"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  $data .='<td align="center" bgcolor="#EEEFEE"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';
			   }

	   }

	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] +
		                                $poarray[4]+$poarray[5] + $poarray[6]))
      {
		    poequation(7);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus6 < $date)
		    {
	                  $data .='<td align="center" bgcolor="#00DDFF"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  $data .='<td align="center" bgcolor="#EEEFEE"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';
			   }

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] +
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7]))
      {
  	        poequation(8);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus7 < $date)
		    {
	                  $data .='<td align="center" bgcolor="#00DDFF"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                 $data .='<td align="center" bgcolor="#EEEFEE"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';
			   }

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] +
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + $poarray[8]))
      {
  	        poequation(9);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus8 < $date)
		    {
	                  $data .='<td align="center" bgcolor="#00DDFF"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                 $data .='<td align="center" bgcolor="#EEEFEE"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';
			   }

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] +
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] +
		                                $poarray[8] + $poarray[9]))
      {
		    poequation(10);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus9 < $date)
		    {
	                  $data .='<td align="center" bgcolor="#00DDFF"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  $data .='<td align="center" bgcolor="#EEEFEE"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';
			   }

	   }

	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] +
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] +
		                                $poarray[8] + $poarray[9] + $poarray[10]))
      {
  	        poequation(11);
			$equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
		    if ($currmnthplus10 < $date)
		    {
	                  $data .='<td align="center" bgcolor="#00DDFF"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  $data .='<td align="center" bgcolor="#EEEFEE"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';
			   }
	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] +
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] +
		                                $poarray[8] + $poarray[9] + $poarray[10] + $poarray[11]))
      {
  	        poequation(12);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus11 < $date)
		    {
	                  $data .='<td align="center" bgcolor="#00DDFF"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {
	                  $data .='<td align="center" bgcolor="#EEEFEE"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';
			   }

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] +
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] +
		                                $poarray[8] + $poarray[9] + $poarray[10] + $poarray[11] + $poarray[12]))
      {
  	        poequation(13);
			$equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
		    if ($currmnthplus12 < $date)
		    {
	                 $data .='<td align="center" bgcolor="#00DDFF"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {
	                  $data .='<td align="center" bgcolor="#EEEFEE"  width="100px"><span class="labeltext">'. $qtyreq .'</td>';
			   }

	   }


  	// Else color red if none of the above succeeds
      else
	  {
		  	$totalrmpoqtycomp = 0;
	        $totalrmpoqtyeqn = "";
		  	for ($i = 0; $i <= 12; $i++)
	       {
                  $poqtysum += $poarray[$i];
				  //echo "<br> value of po array element for $i is $poarray[$i]";
				  if ($poarray[$i] != 0)
			      {
                       $totalrmpoqtyeqn .= "+ $poarray[$i]" .  "po{$i}";
					    $poarray[$i] = 0;
			      }
		    }
			$equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
		  //echo "<br> po qty sum is $poqtysum";
   		   $shortfall = $qtyreq - ($fg+$grn+$poqtysum);
	       $poqtysum = 0;
	       $data .='<td align="center" bgcolor="#FF0000" width="100px"><span class="labeltext">'. $qtyreq .'</td>';
		   $fg = 0;
		   $grn = 0;
		   $poqtysum=0;
	  }
	}
	else
	{
		     $data .='<td align="center" bgcolor="#FFFFFF" width="100px"><span class="labeltext">'. $qtyreq .'</td>';
	}
   }
   $data .='
		 <td align="center" width="100px"><span class="labeltext"><b>'. $rmpoqty0 .'</b></td>
	     <td align="center" width="100px"><span class="labeltext"><b>'. $rmpoqty1 .'</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>'. $rmpoqty2 .'</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>'. $rmpoqty3 .'</b></td>
	     <td align="center" width="100px"><span class="labeltext"><b>'. $rmpoqty4 .'</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>'. $rmpoqty5 .'</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>'. $rmpoqty6 .'</b></td>
	     <td align="center" width="100px"><span class="labeltext"><b>'. $rmpoqty7 .'</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>'. $rmpoqty8 .'</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>'. $rmpoqty9 .'</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>'. $rmpoqty10 .'</b></td>
	     <td align="center" width="100px"><span class="labeltext"><b>'. $rmpoqty11 .'</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>'. $rmpoqty12 .'</b></td>';
 }
}
else {

$data .='<table align="top" style="table-layout: fixed" width="700px" style="border:1px solid #000000;" border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFCC00">
<td width="55px" bgcolor="#EEEFEE"><span class="labeltext" align="center"><b>PRN</b></td>
<td width="70px" bgcolor="#EEEFEE"><span class="labeltext" align="center"><b>Part Number</b></td>
<td width="44px" bgcolor="#EEEFEE"><span class="labeltext" align="center"><b>WO Qty<br>(WIP)</b></td>
<td width="40px" bgcolor="#EEEFEE"><span class="labeltext" align="center"><b>DN<br>Bal</b></td>
<td width="40px" bgcolor="#EEEFEE"><span class="labeltext" align="center"><b>FG<br>Stock</b></td>
<td width="40px" bgcolor="#EEEFEE"><span class="labeltext" align="center"><b>GRN<br>Stock</b></td>
<td width="80px" bgcolor="#EEEFEE"><span class="labeltext" align="center"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RMPO<br>)</b></td></tr>';

$data .='
         <td align="center" width="40px"><span class="labeltext"><b>'. $crn .'</b></td>
         <td align="center" width="40px"><span class="labeltext"><b>'. 0 .'</b></td>
	     <td align="center" width="40px"><span class="labeltext"><b>'. 0 .'</b></td>
		 <td align="center" width="40px"><span class="labeltext"><b>'. 0 .'</b></td>
	     <td align="center" width="40px"><span class="labeltext"><b>'. 0 .'</b></td>
 	     <td align="center" width="40px"><span class="labeltext"><b>'. 0 .'</b></td>';

   }
   $data .='</tr>
            </table>';
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

$data .='</td>
<br>
</table>
</td>
</tr></table>
</form>
</body>
</html>';

header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=crnschedule_new_export.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
