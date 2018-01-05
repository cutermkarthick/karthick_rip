<?php
//==============================================
// Author: FSI                                                                      =
// Date-written = July 27, 2013                                            =
// Filename: crn_schedule.php                                          =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays CRN Stock Summary list.            =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');

// First include the class definition
include_once('classes/reportClass.php');
include_once('classes/helperClass.php');

$newhelper = new helper;
$newreport = new report;

$crn=$_REQUEST['crn_schedule'];

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
 <script language="javascript" src="scripts/jquery.js"></script>

<div id='schedule'>
<table  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
<td colspan=8 align="center" bgcolor="#bababa"><span class="heading"><b>Schedule Report</b></td>
</tr>
<tr>
<td valign='top' bgcolor="#FFFFFF"><span class="labeltext"><b>PRN:</b>&nbsp;
<input type="text" size=15% name="crn_schedule" id="crn_schedule" value="<?echo $_REQUEST['crn_schedule'] ?>"></td>
<td  bgcolor='#FFFFFF'> <img src="images/bu-get.gif" value="Get"
            onclick="javascript: getschedule_report('schedule')"></td>
</tr>
</table>
<div style="width:524px; overflow:auto;height:300;">
<table valign="top" width="100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td valign='top'>
<?php

$schweekarr = array();

// Create the work-week(52 weeks from today) array starting from 
// run date week's beginning Monday
$wwbegindate1= date("Y-m-d", strtotime('monday this week'));
$wwbegindate= date("Y-m-d", strtotime('monday this week'));
array_push($schweekarr,$wwbegindate);
$newdate = date("Y-m-d", strtotime($wwbegindate . "+7 day"));
for ($x = 0; $x <= 49; $x++) {
    $newdate = date("Y-m-d", strtotime($wwbegindate . "+7 day"));
	array_push($schweekarr,$newdate);
	$wwbegindate = $newdate;
} 
$crnonlyarr = array();

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
       $lobresult = $newreport->getlob1($crn);
       if(mysql_num_rows($lobresult) != 0)
	   {
		        while($mylobrow=mysql_fetch_row($lobresult))
              {
	              $crn1 = $mylobrow[0];
                   $date = $mylobrow[1];			       
                   $qty = $mylobrow[2];
                   if($qty  >0 )
                   {
            $datedi  = date("Y-m-d", strtotime($wwbegindate1 . "+7 day"));
                   	
                   	// echo $date . "  " . $currmnth ."<BR>" ;
				  if ($newhelper->dateDiff('-', $date, $datedi ) <=0)
		   	     {
		   	     	// echo $crn1 .  "--" . $qty ."<BR>";

				     $crnarr[$crn1][$wwbegindate1]
				      += $qty;
			      }
				  else 
				  { 
					  $crnarr[$crn1][$date] = $qty;
    			  }
 					$crnonlyarr[$crn1] = $crn1;
 				}
			}
		

?>
<table align="top" style="table-layout: fixed" width="650px" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>LEGEND:</b></td>
<td width="20px" height="20px" bgcolor="#00FF00"><span class="tabletext" align='center'>&nbsp</td>
<td width="55px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Safe</b></td>
<td width="20px" bgcolor="#FFFF00"><span class="labeltext" align='center'>&nbsp</td>
<td width="90px" bgcolor="#FFFFFF" ><span class="labeltext" align='center'><b>Borderline</b></td>
<td width="20px" bgcolor="#00DDFF"><span class="labeltext" align='center'>&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Qty from PO</b></td>
<td width="20px" bgcolor="#FF0000"><span class="labeltext" align='center'>&nbsp</td>
<td width="70px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Danger</b></td>
<td width="20px" bgcolor="#FFA500"><span class="labeltext" align='center'>&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>GRN-to-Prodn</b></td>
<td width="20px" bgcolor="#cccc33"><span class="labeltext" align='center'>&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>PO Date Issue</b></td>
 </tr>
</table>
<table align="top" style="table-layout: fixed" width="700px" style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" scrolling='yes' class="stdtable">
<tr>
<thead>
<th width="120px"  class="head0"><span class="labeltext" align="center"><b>PRN</b></th>
<th width="180px" class="head1"><span class="labeltext"><b>Part Number</b></th>
<th width="100px"  class="head0"><span class="labeltext"><b>WIP (fg)</b></th>
<th width="100px"  class="head1"><span class="labeltext"><b>DN (fg)</b></th>
<th width="100px"  class="head0"><span class="labeltext"><b>FG (fg)</b></th>
<th width="100px" class="head1"><span class="labeltext"><b>GRN (grn)</b></th>
<th width="100px"  class="head0"><span class="labeltext"><b>Buffer</b></th>
<?php
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
	    echo "<td align=\"center\" width=\"200px\" bgcolor=\"#00DDFF\" align=\"left\"><span class=\"schtext\" ><b>WW starting<br> $schdate1<br>(Potential Backlog)</b></td>";
    }
	else
	{
       $schdate1=date("M j, Y",$x);
	    echo "<td align=\"center\" width=\"200px\" bgcolor=\"#00DDFF\" align=\"left\"><span class=\"schtext\" ><b>WW starting<br> $schdate1</b></td>";
    }
	$ft = 1;
}
	$i = 0;
	$suffix = '';
while ($i < 13)
{
    $nextdate=mktime(0,0,0,date("m")+$i,date("d"),date("Y"));
    $nextmonth = date("Y-m-d", $nextdate);
 
?>

<td width="100px" bgcolor="#EEEFEE"  align="center"><span class="schtext">
<b>PO <?php echo $i, "<br>", $rmpodate1 ?></b>

<?php
  $i++;
}
?>

</table>
<div style="overflow:auto;border:" id="dataList">

<table style="table-layout: fixed" width="650px"  border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
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



$crnvalold ="" ;


foreach ($crnonlyarr as $uniquecrn =>$value) 
{
$crnvalk = '';
$crnv='';
$crn = $uniquecrn;
if(strpos($crn, "/") == true)
{

$crnv = explode("/", $crn) ;
}
else
{
$crnv[0] = $crn ;
}

if($crnv[1] !='' )
{
$crnvalk = $crnv[1];
}
else
{
$crnvalk = $crnv[0];
}

	$flagcrn = 0;
	//print "\ncrn1 is $crn1";

$result = $newreport->getcrnfromlob($cond1,$crnvalk);
$total=0;
$total4dis=0;
$total4grn=0;
$grnbbal =0 ;
$totalgrn_quar=0;
$totalbalance=0;
$totalbalance_quar=0;
$totaldn_qty=0;
$total_recd4stores=0;
$totalrecd_qty=0;
$grnbal =0;
$totalrmpoqty=0;
$wip = 0 ;
$woprocarr = array("Assembly","Untreated","Treated");
while($myrow4crn=mysql_fetch_row($result))
{


	$dnSent_qty=0;
	$dnRecd_qty=0; 

	
	$part_num=wordwrap($myrow4crn[4],30,"<br>\n");
	
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
		 $wip = $total ;
	  }
	  if($proc == 'Treated' && $myrow4[3] == 'Open')
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
	$totalrmpoqty0 = $myrmpo[1];
	$poarray[0] = $totalrmpoqty0;
	$rmpoqty0 = $myrmpo[1];
	$rmpoqty0ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnth,$currmnthplus1);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty1 = $myrmpo[1];
	$poarray[1] = $totalrmpoqty1;
	$rmpoqty1 = $myrmpo[1];
	$rmpoqty1ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus1,$currmnthplus2);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty2 = $myrmpo[1];
	$poarray[2] = $totalrmpoqty2;
	$rmpoqty2 = $myrmpo[1];
	$rmpoqty2ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus2,$currmnthplus3);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty3 = $myrmpo[1];
	$poarray[3] = $totalrmpoqty3;
	$rmpoqty3 = $myrmpo[1];
	$rmpoqty3ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus3,$currmnthplus4);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty4 = $myrmpo[1];
	$poarray[4] = $totalrmpoqty4;
	$rmpoqty4 = $myrmpo[1];
	$rmpoqty4ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus4,$currmnthplus5);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty5 = $myrmpo[1];
	$poarray[5] = $totalrmpoqty5;
	$rmpoqty5 = $myrmpo[1];
	$rmpoqty5ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus5,$currmnthplus6);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty6 = $myrmpo[1];
	$poarray[6] = $totalrmpoqty6;
	$rmpoqty6 = $myrmpo[1];
	$rmpoqty6ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus6,$currmnthplus7);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty7 = $myrmpo[1];
	$poarray[7] = $totalrmpoqty7;
	$rmpoqty7 = $myrmpo[1];
	$rmpoqty7ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus7,$currmnthplus8);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty8 = $myrmpo[1];
	$poarray[8] = $totalrmpoqty8;
	$rmpoqty8 = $myrmpo[1];
	$rmpoqty8ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus8,$currmnthplus9);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty9 = $myrmpo[1];
	$poarray[9] = $totalrmpoqty9;
	$rmpoqty9 = $myrmpo[1];
	$rmpoqty9ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus9,$currmnthplus10);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty10 = $myrmpo[1];
	$poarray[10] = $totalrmpoqty10;
	$rmpoqty10 = $myrmpo[1];
	$rmpoqty10ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus10,$currmnthplus11);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty11 = $myrmpo[1];
	$poarray[11] = $totalrmpoqty11;
	$rmpoqty11 = $myrmpo[1];
	$rmpoqty11ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus11,$currmnthplus12);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty12 = $myrmpo[1];
	$poarray[12] = $totalrmpoqty12;
	$rmpoqty12 = $myrmpo[1];
	$rmpoqty12ponum = $myrmpo[3];
	}

	$crnvalold = $myrow4crn[1] ;

}

$reqfrompo='';
$totalrmpoqtycomp='';
$totalrmpoqtyeqn='';

// Get GRN stock
if(strpos($crn,'BOI') == false )
{
$result = $newreport->getgrnqty4crnnew($crnvalk);
while($mygrn=mysql_fetch_row($result))
{

$grnbal = 0;

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
//var_dump($grnarray);

}
if(strpos($crn, "/") == true)
{

$crnvk = explode("/", $crn) ;
}
else
{
$crnvk[0] = $crn ;
}


$subcrndisplay = 1 ;
$crnflag = 1;
$crndispflag = 1;
$qtyreqold =0;
foreach ($crnarr[$crn] as $date => $qtyreq) 
{

$fg = $totaldn_qty+$total4dis+$total_recd4stores;
if($crn !='')
{
$crnkval = explode("/", $crn) ;
$crnk = $crnkval[0] ;
if($crnkval[1] == "")
{
	$qtyreqold += $qtyreq ; 
if($qtyreq == $fg || $qtyreqold <= $fg)
{

$crnflag = 1;
$crndispflag = 1;
$dispcrnarr1[$crnk][$date] = $crndispflag ;
$dispcrnarr[$crnk] = $crnflag ;
$subcrndisplay = 1 ;
$qtyreqold = $qtyreqold ;
}
else 
{
$qtyreq += $qtyreq ; 
$crnflag = 0;
$crndispflag = 1;
$dispcrnarr1[$crnk][$date] = $crnflag ;
$dispcrnarr[$crnk] = $crnflag ;
$subcrndisplay = 1 ;
$qtyreqold = $qtyreq ;
break;

}
}
else
{
if ($dispcrnarr[$crnk] == 0) {
   
$crndispflag1 = $dispcrnarr1[$crnk][$date] ;
$dispcrnarr1[$crn][$date] = $crndispflag1  ;
$subcrndisplay = 1 ;
}
else
{

	$subcrndisplay = 0 ;
	$crndispflag = 1;
	$dispcrnarr1[$crn][$date] = $crndispflag  ;
}
}
}
}

if($subcrndisplay ==1 )
{
if(strpos($crn,'BOI') == true )
{
	$crnkpartnum ='';
	$crnk1 ='';
    $assy_crn = substr($crn,2,2);
	$crnv1 = explode("/", $crn) ;
	if($assy_crn =='K-' && $crnv1[3] !='')
	{
		$crnk1 = $crnv1[1] ;
		$crnkpartnum = $crnv1[2] ;
	}
	else
	{
	$crnk1 = $crnv1[0] ;
	$crnkpartnum = $crnv1[1] ;
	}	


$result = $newreport->getpartnumboughtout1($crnk1,$crnkpartnum);
if($result)
{
	$row = mysql_fetch_row($result) ;

	$boqpval = $row[1] ;

	$partnumk = trim($row[0]) ;

$result1 = $newreport->getfgforboughtout($partnumk);
if($result1)
{
	$fg =0;

	$row1 = mysql_fetch_row($result1);
	$qtmb =  $row1[0] ;
	$qtyb_used = $row1[1] ;
	$qtyb_quar =  $row1[2] ;
	$partnum1 =  $row1[3] ;
	$qtyb_ret   = $row1[4] ;

	$grnbbal = $qtmb - $qtyb_used +$qtyb_ret;


$colorval2 ="style=background-color:#00DDFF" ;

	printf('<tr bgcolor="#FFFFFF" >
		<td bgcolor="#FFFFFF" align="center" width="55px" %s><span class="labeltext"><font color="black">%s</font></td>
		<td bgcolor="#FFFFFF" align="center" width="60px" ><span class="labeltext">%s</td>',
	$colorval2,wordwrap($crn,10,"\n",true),$partnum1);

 printf('<td bgcolor="#00FF00" align="center" width="50px"><span class="labeltext">%d</td>' , $myrow4crn[5]);


printf('
     <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
     <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
     <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
	 <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
	 <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
   ','','','','',$grnbbal);
	
$grn = $grnbbal ;
 }

	
}

}
else
{
$crnv2 = explode("/", $crn) ;


$colorval ="style=background-color:#FFFFFF" ;
if($crnv2[1] !='' )
{
$colorval1 ="style=background-color:#00DDFF" ;	
}
else
{
$colorval1 ="style=background-color:#3BE8D4" ;

}
$fg = 0;


	printf('<tr title=%s bgcolor="#FFFFFF" >
			<td bgcolor="#FFFFFF" align="center" width="55px" %s><span class="labeltext"><font color="black">%s</font></td>
			<td bgcolor="#FFFFFF" align="center" width="60px"><span class="labeltext">%s</td>',
				$crn,$colorval1,wordwrap($crn,10,"\n",true),$part_num);

     printf('<td  align="center" bgcolor="#00FF00" width="60px"><span class="labeltext">%d</td>' , $myrow4crn[5]);


printf('
         <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
         <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
	    
		 <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%s</b></td>
		 <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
       ',$total,$totaldn_qty,$total4dis,$total4grn);
		$fg = $totaldn_qty+$total4dis+$total_recd4stores;
		$grn = $total4grn;

}
}


$bufferqty = 0;
$count = 0;

// echo "<pre>" ;
// print_r($crnarr) ;
if($subcrndisplay == 1 )
{

foreach ($crnarr[$crn] as $date => $qtyreq) 
{
	//echo $crn ." " .  $crndispflag ."  " . $date  ."<BR>" ;
	if ($qtyreq != 0)
	{
	   //echo "<br>qtyreq is $qtyreq as on $date for crn $crn";
	   //echo "<br>fg is $fg";
	   //echo "<br>grn is $grn";
	   // First check if req qty is equal to Finished Goods qty (fg); if so, color yellow

	   if ($qtyreq == $wip)
	   {
		  $equation=$wip . "wip";
		  $disparr[$date] =  " bgcolor=\"#FFFF00\"><span class=\"schtext\">$qtyreq<br>($equation)";
	      $wip = $wip- $qtyreq;
	   }

	  else if ($qtyreq < $wip)
	   {

    		$equation=$qtyreq . "wip";
			$disparr[$date] =  " bgcolor=\"#00FF00\"><span class=\"schtext\">$qtyreq<br>($equation)";
	        $wip = $wip - $qtyreq;
	    }
	   // if ($qtyreq == $fg + $wip)
	   // {

		  // $equation=$wip ."wip +" . $fg . "fg";
		  // $disparr[$date] =  " bgcolor=\"#FFFF00\"><span class=\"schtext\">$qtyreq<br>($equation)";
	   //    $fg = $wip-$fg - $qtyreq;
	   // }


  // Next check if req qty is < Finished Goods qty (fg); if so, color green
	   else if ($qtyreq < $fg + $wip)
	   {

	   		$reqfromfg = $qtyreq - $wip;
    		$equation=$wip ."wip +" . $reqfromfg . "fg";
			$disparr[$date] =  " bgcolor=\"#00FF00\"><span class=\"schtext\">$qtyreq<br>($equation)";
	        $fg = $wip + $fg - $qtyreq;
	        $wip=0;
	    }

  // Else check if req qty is < fg+grn; if so, color green
  // For grn qty check you need to add 4 weeks to today and check
  // to see if the date falls within the req date and color green else red
	  else if ($qtyreq < ($fg+$grn+$wip))
      {

     

		  $nextdate=mktime(0,0,0,date("m")+1,date("d"),date("Y"));
		  $grn2mfrdate = date("Y-m-d", $nextdate);
		  //echo "<br>grnmfrdate is $grn2mfrdate";
		  //echo "<br>date is $date";
		  //echo "<br>fg is $fg";
		  $reqfromgrn = $qtyreq-$wip -$fg;
// Added code to check if qty used from grn; if so need WO create trigger
		   if ($reqfromgrn > 0)
		   {	
              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
			  //echo "<br>date is $date wo cr date is $wocrdate";
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
			   {
			     $wotrigarr[$wwbegindate1] = $reqfromgrn;
				 $wodtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
				  $wotrigarr[$wocrdate] = $reqfromgrn;
			      $wodtarr[$wocrdate] = $date;
			   }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
			   {
			     $treattrigarr[$wwbegindate1] = $reqfromgrn;
			     $treatdtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $treattrigarr[$wotrdate] = $reqfromgrn;
			      $treatdtarr[$wotrdate] = $date;
			   }		  

	       }

		  $equation =$wip . "wip +" . $fg . "fg + " . $reqfromgrn . "grn";
		  if ($grn2mfrdate <= $date) 
		  {
			  $disparr[$date] =  " bgcolor=\"#00FF00\"><span class=\"schtext\">$qtyreq<br>($equation)";

		   }
		   else 
		   {
			  $disparr[$date] =  " bgcolor=\"#FFA500\"><span class=\"schtext\">$qtyreq<br>($equation)";

		   }
		  $grn = $grn + $fg + $wip - $qtyreq;
		  $fg=0;
		  $wip=0;
	   }


	 else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]))
      {
      
		    //echo "<br>Here poarray0 is $poarray[0]";
  	        poequation(1);
			$equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));		  
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
			   {
			     $wotrigarr[$wwbegindate1] = $qtyreq;
				 $wodtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
				  $wotrigarr[$wocrdate] = $qtyreq;
			      $wodtarr[$wocrdate] = $date;
			   }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
			   {
			     $treattrigarr[$wwbegindate1] = $qtyreq;
			     $treatdtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $treattrigarr[$wotrdate] = $qtyreq;
			      $treatdtarr[$wotrdate] = $date;
			   }       
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
					  $wip=0;
					   
	   }

	 else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]))
      {
      	    poequation(2);
			$equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
// Added code to check if qty used from grn; if so need WO create trigger
             $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
			   {
			     $wotrigarr[$wwbegindate1] = $qtyreq;
				 $wodtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
				  $wotrigarr[$wocrdate] = $qtyreq;
			      $wodtarr[$wocrdate] = $date;
			   }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
			   {
			     $treattrigarr[$wwbegindate1] = $qtyreq;
			     $treatdtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $treattrigarr[$wotrdate] = $qtyreq;
			      $treatdtarr[$wotrdate] = $date;
			   } 
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
			  $wip=0;			  

	   }


	 else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]))
      {
		    //echo "<br>Here poarray2 is $poarray[2]";
  	        poequation(3);
		    $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
			$equation =  $wip . "wip+" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
// Added code to check if qty used from grn; if so need WO create trigger
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
			   {
			     $wotrigarr[$wwbegindate1] = $qtyreq;
				 $wodtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
				  $wotrigarr[$wocrdate] = $qtyreq;
			      $wodtarr[$wocrdate] = $date;
			   }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
			   {
			     $treattrigarr[$wwbegindate1] = $qtyreq;
			     $treatdtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $treattrigarr[$wotrdate] = $qtyreq;
			      $treatdtarr[$wotrdate] = $date;
			   } 
			
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
					  $wip =0;

	   }

	 else  if ($qtyreq < ($fg+$grn+ $poarray[0]+$poarray[1]+$poarray[2]+$poarray[3]))
      {
  	        poequation(4);
			$wocrdate = date('Y-m-d',strtotime("$date -84 days"));
			$equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
// Added code to check if qty used from grn; if so need WO create trigger
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
			   {
			     $wotrigarr[$wwbegindate1] = $qtyreq;
				 $wodtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
				  $wotrigarr[$wocrdate] = $qtyreq;
			      $wodtarr[$wocrdate] = $date;
			   }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
			   {
			     $treattrigarr[$wwbegindate1] = $qtyreq;
			     $treatdtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $treattrigarr[$wotrdate] = $qtyreq;
			      $treatdtarr[$wotrdate] = $date;
			   } 
			
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
					  $wip=0;

	   }

	 else  if ($qtyreq < ($wip + $fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]))
      {
  	        poequation(5);
			$wocrdate = date('Y-m-d',strtotime("$date -84 days"));
			$equation =$wip . "wip +" .  $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
// Added code to check if qty used from grn; if so need WO create trigger
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
			   {
			     $wotrigarr[$wwbegindate1] = $qtyreq;
				 $wodtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
				  $wotrigarr[$wocrdate] = $qtyreq;
			      $wodtarr[$wocrdate] = $date;
			   }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
			   {
			     $treattrigarr[$wwbegindate1] = $qtyreq;
			     $treatdtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $treattrigarr[$wotrdate] = $qtyreq;
			      $treatdtarr[$wotrdate] = $date;
			   }    
			
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
					  $wip =0;
	   }
	 else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5]))
      {
  	        poequation(6);
			$wocrdate = date('Y-m-d',strtotime("$date -84 days"));
			$equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
// Added code to check if qty used from grn; if so need WO create trigger
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
			   {
			     $wotrigarr[$wwbegindate1] = $qtyreq;
				 $wodtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
				  $wotrigarr[$wocrdate] = $qtyreq;
			      $wodtarr[$wocrdate] = $date;
			   }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
			   {
			     $treattrigarr[$wwbegindate1] = $qtyreq;
			     $treatdtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $treattrigarr[$wotrdate] = $qtyreq;
			      $treatdtarr[$wotrdate] = $date;
			   } 
			
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
					  $wip=0;

	   }

	 else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6]))
      {  	       
		    poequation(7);
			$wocrdate = date('Y-m-d',strtotime("$date -84 days"));
			$equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
// Added code to check if qty used from grn; if so need WO create trigger
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
			   {
			     $wotrigarr[$wwbegindate1] = $qtyreq;
				 $wodtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
				  $wotrigarr[$wocrdate] = $qtyreq;
			      $wodtarr[$wocrdate] = $date;
			   }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
			   {
			     $treattrigarr[$wwbegindate1] = $qtyreq;
			     $treatdtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $treattrigarr[$wotrdate] = $qtyreq;
			      $treatdtarr[$wotrdate] = $date;
			   }     
			
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
					  $wip=0;

	   }
	 else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7]))
      {  	       
  	        poequation(8);
			$wocrdate = date('Y-m-d',strtotime("$date -84 days"));
			$equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    
// Added code to check if qty used from grn; if so need WO create trigger
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
			   {
			     $wotrigarr[$wwbegindate1] = $qtyreq;
				 $wodtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
				  $wotrigarr[$wocrdate] = $qtyreq;
			      $wodtarr[$wocrdate] = $date;
			   }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
			   {
			     $treattrigarr[$wwbegindate1] = $qtyreq;
			     $treatdtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $treattrigarr[$wotrdate] = $qtyreq;
			      $treatdtarr[$wotrdate] = $date;
			   } 
			
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
					  $wip=0;

	   }
	 else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + $poarray[8]))
      {  	       
  	        poequation(9);
			$wocrdate = date('Y-m-d',strtotime("$date -84 days"));
			$equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    
// Added code to check if qty used from grn; if so need WO create trigger
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
			   {
			     $wotrigarr[$wwbegindate1] = $qtyreq;
				 $wodtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
				  $wotrigarr[$wocrdate] = $qtyreq;
			      $wodtarr[$wocrdate] = $date;
			   }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
			   {
			     $treattrigarr[$wwbegindate1] = $qtyreq;
			     $treatdtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $treattrigarr[$wotrdate] = $qtyreq;
			      $treatdtarr[$wotrdate] = $date;
			   } 
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
					  $wip=0;

	   }
	 else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
		                                $poarray[8] + $poarray[9]))
      {  	        
		    poequation(10);
			$wocrdate = date('Y-m-d',strtotime("$date -84 days"));
			$equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    
// Added code to check if qty used from grn; if so need WO create trigger
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
			   {
			     $wotrigarr[$wwbegindate1] = $qtyreq;
				 $wodtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
				  $wotrigarr[$wocrdate] = $qtyreq;
			      $wodtarr[$wocrdate] = $date;
			   }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
			   {
			     $treattrigarr[$wwbegindate1] = $qtyreq;
			     $treatdtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $treattrigarr[$wotrdate] = $qtyreq;
			      $treatdtarr[$wotrdate] = $date;
			   } 
			
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
					  $wip=0;

	   }

	 else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
		                                $poarray[8] + $poarray[9] + $poarray[10]))	        
      {
  	        poequation(11);
			$wocrdate = date('Y-m-d',strtotime("$date -84 days"));
			$equation =$wip ."wip+ " . $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
		    
// Added code to check if qty used from grn; if so need WO create trigger
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
			   {
			     $wotrigarr[$wwbegindate1] = $qtyreq;
				 $wodtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
				  $wotrigarr[$wocrdate] = $qtyreq;
			      $wodtarr[$wocrdate] = $date;
			   }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
			   {
			     $treattrigarr[$wwbegindate1] = $qtyreq;
			     $treatdtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $treattrigarr[$wotrdate] = $qtyreq;
			      $treatdtarr[$wotrdate] = $date;
			   } 
			
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
					  $wip=0;

	   }
	 else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
		                                $poarray[8] + $poarray[9] + $poarray[10] + $poarray[11]))	        
      {
  	        poequation(12);
			$wocrdate = date('Y-m-d',strtotime("$date -84 days"));
			$equation = $wip ."wip + " . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    
// Added code to check if qty used from grn; if so need WO create trigger
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
			   {
			     $wotrigarr[$wwbegindate1] = $qtyreq;
				 $wodtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
				  $wotrigarr[$wocrdate] = $qtyreq;
			      $wodtarr[$wocrdate] = $date;
			   }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
			   {
			     $treattrigarr[$wwbegindate1] = $qtyreq;
			     $treatdtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $treattrigarr[$wotrdate] = $qtyreq;
			      $treatdtarr[$wotrdate] = $date;
			   } 
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
					  $wip =0;

	   }
	 else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
		                                $poarray[8] + $poarray[9] + $poarray[10] + $poarray[11] + $poarray[12]))	        
      {
  	        poequation(13);
			$wocrdate = date('Y-m-d',strtotime("$date -84 days"));
// Added code to check if qty used from grn; if so need WO create trigger
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
			   {
			     $wotrigarr[$wwbegindate1] = $qtyreq;
				 $wodtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
				  $wotrigarr[$wocrdate] = $qtyreq;
			      $wodtarr[$wocrdate] = $date;
			   }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
			   {
			     $treattrigarr[$wwbegindate1] = $qtyreq;
			     $treatdtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $treattrigarr[$wotrdate] = $qtyreq;
			      $treatdtarr[$wotrdate] = $date;
			   } 
			$equation = $wip ."wip+ " . $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
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
					  $wip=0;

	   }


  	// Else color red if none of the above succeeds
      else
	  {

	        $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
		  	$totalrmpoqtycomp = 0;
	        $totalrmpoqtyeqn = "";
			$equation = '';
		  	for ($i = 0; $i <= 12; $i++)
	        {
                  $poqtysum += (int)$poarray[$i];
				  //echo "<br> value of po array element for $i is $poarray[$i]";
				  if ($poarray[$i] != 0)
			      {
					   $reqpoqty = (int)$poarray[$i];
                       $totalrmpoqtyeqn .= " + $reqpoqty " .  "po{$i}";
					   $equation = "(" . $totalrmpoqtyeqn . ")";
					   $poarray[$i] = 0;
			      }
		    }
			$equation = $wip . "wip + " . $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
		    //$equation = $totalrmpoqtyeqn;
   		   $shortfall = $qtyreq - ($wip+$fg+$grn+$poqtysum);
	       $poqtysum = 0;
		   if ($shortfall > 0)
		   {	
               $poorddate = date('Y-m-d',strtotime("$date -199 days"));
			   if ($newhelper->dateDiff('-', $poorddate, $wwbegindate1) <=0)
			   {
			      $poarr[$wwbegindate1] = $shortfall;
			      $podtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $poarr[$poorddate] = $shortfall;
			      $podtarr[$poorddate] = $date;
			   }
              
              //$poorddate = date('Y-m-d',strtotime("$date -10 days"));
	       }
			  if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
			   {
			     $wotrigarr[$wwbegindate1] = $qtyreq;
				 $wodtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
				  $wotrigarr[$wocrdate] = $qtyreq;
			      $wodtarr[$wocrdate] = $date;
			   }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
			  if ($newhelper->dateDiff('-', $wotrdate, $wwbegindate1) <0)
			   {
			     $treattrigarr[$wwbegindate1] = $qtyreq;
			     $treatdtarr[$wwbegindate1] = $date;
			   }
			  else 
			   {
			      $treattrigarr[$wotrdate] = $qtyreq;
			      $treatdtarr[$wotrdate] = $date;
			   } 
		   $disparr[$date] = " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq($shortfall)<br>($equation)";
		   $wip=0;
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

}


    //echo "<br>actcount for $crn is $actcount";
	//echo "<br>schdtcount is $schdtcount";
   	while ($actcount < $schdtcount)
	{
	    $disparr[$date] = '';
		//echo "<tr bgcolor=\"#FFCC00\"><td align=\"center\" bgcolor=\"#FFFFFF\" width=\"200px\"><span class=\"schtext\">&nbsp</td></tr>";
       $actcount++;
	}
    $actcount = 0;

//echo "<br>po array is ";
//print_r($poarr);
//echo "<br>Here";
 // Print data from array
 $skip = 0;
 $wotrigger = '';
 $potrigger = '';
 $dispdate = '';
 $dataflag = 0;
 //echo "<br>before for loop";


if($subcrndisplay == 1) 
{
for ($j=0; $j<=50; $j++) 
{
	  //echo "<br> week index is $j";
	  $data = '';
	  $thisweek = $j;
	  $nextweek = $thisweek+1;
	  $fromdate = $schweekarr[$thisweek];
      $todate = $schweekarr[$nextweek];
      foreach ($disparr as $dispdate => $data1) 
      {
		 //echo "here - from date = $fromdate; todate = $todate and $dispdate $data1";
	     if (check_in_range($fromdate, $todate, $dispdate) && $data1 != '')
		 {
		 	$flagdisp = 0;
		 	$crne = explode("/",$crn) ;
		 	if($crne[1] =='')
		 	{
		 		$flagdisp = 1;	
		 	}
		 	
		 	if($dispcrnarr1[$crn][$dispdate] == 1 && $flagdisp != 1)
		 	{
			$data .= "&nbsp;<br>";
		 	}
		 	else
		 	{
		    $data .= "$data1<br>";
			}
			//unset($disparr[$dispdate]);
			//echo "<br>Here $data";
			$dataflag = 1;
		 }
      }
	  $dataflag = 0;

	  foreach($poarr as $orddate => $reqqty) 
      {
         $fromdate4po = $fromdate;
	     if (check_in_range($fromdate4po, $todate, $orddate))
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

	     	$flagdisp2 = 0;
		 	$crne2 = explode("/",$crn) ;
		 	if($crne2[1] =='')
		 	{
		 		$flagdisp2 = 1;	
		 	}



	 	       $wotrigger += $woqty;

         
		   $wo4schdt = $wodtarr[$wocrdate];
		   //echo "<br>fromdate is $fromdate todae is $todate  crdate is $wocrdate";
		   //echo "<br>wo4schdt is $wo4schdt";
		   unset($wotrigarr[$wocrdate]);
	     }
      }
// Check for WO Treatment trigger
	  foreach($treattrigarr as $trtrdate => $wotrqty) 
      {
	     if (check_in_range($fromdate, $todate, $trtrdate))
	     {

	     	$flagdisp3 = 0;
		 	$crne3 = explode("/",$crn) ;
		 	if($crne3[1] =='')
		 	{
		 		$flagdisp3 = 1;	
		 	}



	 	       $treattrigger += $wotrqty;
			 $treattrigger += "" ;

           
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


	     $data = $data . "<br><b><font color=\"#990000\">(WO for $wotrigger nos. for <br>$wotrdate)</b></font>";
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
	     $data = $data . "<br><b><font color=\"#990000\">($treattrigger nos. to Treatment for <br>$trtrdate)</b></font>";
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

            $flagdisp1 = 0;
		 	$crne1 = explode("/",$crn) ;
		 	if($crne1[1] =='')
		 	{
		 		$flagdisp1 = 1;	
		 	}



	 	     $data .= "<br><b><font color=\"#990000\">(RM PO $potrigger nos. for <br>$potrigdate)</b></font>";
		  $potrigger = '';
	 }
   }

	  //echo "<td align=\"center\" bgcolor=\"#FFFFFF\" width=\"200px\"><span class=\"schtext\">$data</td>";
	  echo "<td width=\"200px\" align=\"center\"" . "$data</td>";
}


   printf('
		 <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>	
	     <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>
		 <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>
		 <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>
	     <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>
		 <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>	
		 <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>	
	     <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>
		 <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>	
		 <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>	
		 <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>	
	     <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>
		 <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>	
		',$rmpoqty0,$rmpoqty0ponum,$rmpoqty1,$rmpoqty1ponum,
		  $rmpoqty2,$rmpoqty2ponum,$rmpoqty3,$rmpoqty3ponum,
		  $rmpoqty4,$rmpoqty4ponum,$rmpoqty5,$rmpoqty5ponum,
		  $rmpoqty6,$rmpoqty6ponum,$rmpoqty7,$rmpoqty7ponum,
		  $rmpoqty8,$rmpoqty8ponum,$rmpoqty9,$rmpoqty9ponum,
		  $rmpoqty10,$rmpoqty10ponum,$rmpoqty11,$rmpoqty11ponum,
		  $rmpoqty12,$rmpoqty12ponum
			); 
echo "</tr>";




 $disparr = array();
$poarr = array();
$podtarr = array();
$wotrigarr = array();
$wodtarr = array(); 
$treattrigarr = array();
$treatdtarr = array();

} }



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
    GLOBAL $poarray, $qtyreq, $fg, $grn, $wip, $reqfrompo, $totalrmpoqtycomp,$totalrmpoqtyeqn;
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
				  $reqfrompo = $qtyreq-($wip+$fg+$grn)-$usedfrompo;
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
	$reqfrompo = $qtyreq-($wip+$fg+$grn+$totalrmpoqtycomp);
	//echo "<br>In function value of reqfrom po is $reqfrompo and pocount is $pocount";
	//echo "<br>In function value of poarray for $index is $poarray[$index]";

}
?>
</tr>
</table>