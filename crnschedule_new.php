<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = August 12, 2009              =
// Filename: crnreport.php                     =
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
include_once('classes/displayClass.php');

$newdisplay = new display;
$newreport = new report;
$rowsPerPage = 10;
$crn=$_REQUEST['crn'];
// by default we show first page
$pageNum = 1;
$crnarr = array();
$crnonlyarr = array();

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

$userrole = $_SESSION['userrole'];


?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>CRN Schedule</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<form action='crnschedule_new.php' method='post' enctype='multipart/form-data'>
<?php

include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        		<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        		<td align="right">&nbsp;
       			<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        		</tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
     <tr><td>
		</tr>
  <tr>
<td>
</td></tr>
<tr><td valign="top">
<table valign="top" width="100%" border=0>
<tr>
<td valign='top'><span class="pageheading"><b>PRN Schedule</b></td>
<td colspan=160>&nbsp;</td>
</tr>
</table>

<table valign="top" width="100%" align="center" border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#F5F6F5">
<td align="center" colspan=7><span class="heading"><b>Search Criteria</b></td></tr>
<tr>
<td valign='top' bgcolor="#FFFFFF"><span class="labeltext"><b>PRN:</b>&nbsp;
<input type="text" size=15% name="crn" value="<?echo $_REQUEST['crn'] ?>">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="button"><b><input type="submit" name="submit" value="Get"></b></td>
</tr>
</table>

<table valign="top" width="100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td valign='top'>
<?php
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


?>
<table align="top" style="table-layout: fixed" width="650px" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td ><span class="labeltext"><a href="crnschedule_new_export.php?crn=<?php echo $_REQUEST['crn'] ?>"><b>EXPORT</b></a></td>
</tr></table>
<table align="top" style="table-layout: fixed" width="650px" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>LEGEND:</b></td>
<td width="20px" height="20px" bgcolor="#00FF00"><span class="labeltext" align='center'>&nbsp</td>
<td width="55px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Safe</b></td>
<td width="20px" bgcolor="#FFFF00"><span class="labeltext" align='center'>&nbsp</td>
<td width="90px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Borderline</b></td>
<td width="20px" bgcolor="#00DDFF"><span class="labeltext" align='center'>&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Qty from PO</b></td>
<td width="20px" bgcolor="#FF0000"><span class="labeltext" align='center'>&nbsp</td>
<td width="70px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Danger</b></td>
<td width="20px" bgcolor="#FFA500"><span class="labeltext" align='center'>&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>GRN Problem</b></td>
<td width="20px" bgcolor="#0000FF"><span class="labeltext" align='center'>&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>PO Date Issue</b></td>
 </tr>
</table>
<table align="top" style="table-layout: fixed" width="700px" style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFCC00">
<td width="90px"  align="center" bgcolor="#EEEFEE"><span class="labeltext" align="center"><b>PRN</b></td>
<td width="180px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Part Number</b></td>
<td width="60px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>WIP (fg)</b></td>
<td width="60px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>DN (fg)</b></td>
<td width="60px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>FG (fg)</b></td>
<td width="65px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>GRN (grn)</b></td>
<td width="65px"  align="center" bgcolor="#3BE8D4"><span class="labeltext"><b>Buffer</b></td>
<?php

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
		echo "<td width=\"100px\" bgcolor=\"#FFCCFF\" align=\"center\"><span class=\"labeltext\" ><b>$date1</b></td>";
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
?>
<td width="100px" bgcolor="#EEEFEE"  align="center"><span class="labeltext">
<b>PO <?php echo $i ?><br><?php echo $rmpodate1 ?></b></td>

<?php
  $i++;
}
?>
</table>
<div style="height:400;overflow:auto;border:" id="dataList">

<table style="table-layout: fixed" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
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
$procarray = array();
$crnarray = array($procarray);
$woprocarr = array("Assembly","Manufacture Only","With Treatment");
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
         //echo "<br>cqty is $dispqty<br>";
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
printf('<tr bgcolor="#FFFFFF" >
        <td align="center" width="90px"><span class="labeltext"><font color="black">%s</font></td>
        <td align="center" width="180px"><span class="labeltext">%s</td>',$myrow4crn[1],$part_num);
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
printf('
         <td align="center" width="60px"><span class="labeltext"><b>%d</b></td>
         <td align="center" width="60px"><span class="labeltext"><b>%d</b></td>
	     <td align="center" width="60px"><span class="labeltext"><b>%d</b></td>
		 <td align="center" width="65px"><span class="labeltext"><b>%d</b></td>
       ',$wip_qty,$dn,$fgqty,$grnqty);
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
if ($bufferavg > $fgqty)
{
     printf('<td align="center" bgcolor="#FF0000" width="65px"><span class="labeltext">%d</td>' , $bufferavg);
}
else if ($bufferavg == $fgqty)
{
     printf('<td align="center" bgcolor="#FFFF00" width="65px"><span class="labeltext">%d</td>' , $bufferavg);
}
else
{
     printf('<td align="center" bgcolor="#00FF00" width="65px"><span class="labeltext">%d</td>' , $bufferavg);
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
	      echo "<td align=\"center\" bgcolor=\"#FFFF00\" width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";
	      $fg = $fg - $qtyreq;
	   }

  	   // Next check if req qty is < Finished Goods qty (fg); if so, color green
	   else if ($qtyreq < $fg)
	   {
    		$equation=$qtyreq . "fg";
	        echo "<td align=\"center\" bgcolor=\"#00FF00\" width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";
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
	                  echo "<td align=\"center\" bgcolor=\"#00FF00\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";

				   }
				   else
				   {
		                  echo "<td align=\"center\" bgcolor=\"#FFA500\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";

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
	                  echo "<td align=\"center\" bgcolor=\"#00DDFF\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  echo "<td align=\"center\" bgcolor=\"#0000FF\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";
			   }

	   }

	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]))
      {
		    //echo "<br>Here poarray1 is $poarray[1]";
  	        poequation(2);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus1 < $date)
		    {
	                  echo "<td align=\"center\" bgcolor=\"#00DDFF\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  echo "<td align=\"center\" bgcolor=\"#EEEFEE\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";
			   }

	   }


	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]))
      {
		    //echo "<br>Here poarray2 is $poarray[2]";
  	        poequation(3);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus2 < $date)
		    {
	                  echo "<td align=\"center\" bgcolor=\"#00DDFF\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  echo "<td align=\"center\" bgcolor=\"#EEEFEE\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";
			   }

	   }

	 else  if ($qtyreq < ($fg+$grn+ $poarray[0]+$poarray[1]+$poarray[2]+$poarray[3]))
      {
  	        poequation(4);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus3 < $date)
		    {
	                  echo "<td align=\"center\" bgcolor=\"#00DDFF\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  echo "<td align=\"center\" bgcolor=\"#EEEFEE\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";
			   }

	   }

	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] +
		                                $poarray[4]))
      {
  	        poequation(5);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus4 < $date)
		    {
	                  echo "<td align=\"center\" bgcolor=\"#00DDFF\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  echo "<td align=\"center\" bgcolor=\"#EEEFEE\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";
			   }

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] +
		                                $poarray[4]+$poarray[5]))
      {
  	        poequation(6);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus5 < $date)
		    {
	                  echo "<td align=\"center\" bgcolor=\"#00DDFF\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  echo "<td align=\"center\" bgcolor=\"#EEEFEE\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";
			   }

	   }

	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] +
		                                $poarray[4]+$poarray[5] + $poarray[6]))
      {
		    poequation(7);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus6 < $date)
		    {
	                  echo "<td align=\"center\" bgcolor=\"#00DDFF\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  echo "<td align=\"center\" bgcolor=\"#EEEFEE\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";
			   }

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] +
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7]))
      {
  	        poequation(8);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus7 < $date)
		    {
	                  echo "<td align=\"center\" bgcolor=\"#00DDFF\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  echo "<td align=\"center\" bgcolor=\"#EEEFEE\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";
			   }

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] +
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + $poarray[8]))
      {
  	        poequation(9);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    if ($currmnthplus8 < $date)
		    {
	                  echo "<td align=\"center\" bgcolor=\"#00DDFF\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  echo "<td align=\"center\" bgcolor=\"#EEEFEE\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";
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
	                  echo "<td align=\"center\" bgcolor=\"#00DDFF\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  echo "<td align=\"center\" bgcolor=\"#EEEFEE\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";
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
	                  echo "<td align=\"center\" bgcolor=\"#00DDFF\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {

	                  echo "<td align=\"center\" bgcolor=\"#EEEFEE\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";
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
	                  echo "<td align=\"center\" bgcolor=\"#00DDFF\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {
	                  echo "<td align=\"center\" bgcolor=\"#EEEFEE\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";
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
	                  echo "<td align=\"center\" bgcolor=\"#00DDFF\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";

					  $fg=0;
					  $grn=0;
			   }
			   else
			   {
	                  echo "<td align=\"center\" bgcolor=\"#EEEFEE\"  width=\"100px\"><span class=\"labeltext\">$qtyreq($equation)</td>";
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
	       echo "<td align=\"center\" bgcolor=\"#FF0000\" width=\"100px\"><span class=\"labeltext\">$qtyreq($shortfall)<br> ($equation)</td>";
		   $fg = 0;
		   $grn = 0;
		   $poqtysum=0;
	  }
	}
	else
	{
		     echo "<td align=\"center\" bgcolor=\"#FFFFFF\" width=\"100px\"><span class=\"labeltext\">$qtyreq</td>";
	}
   }
   printf('
		 <td align="center" width="100px"><span class="labeltext"><b>%d</b></td>
	     <td align="center" width="100px"><span class="labeltext"><b>%d</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>%d</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>%d</b></td>
	     <td align="center" width="100px"><span class="labeltext"><b>%d</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>%d</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>%d</b></td>
	     <td align="center" width="100px"><span class="labeltext"><b>%d</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>%d</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>%d</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>%d</b></td>
	     <td align="center" width="100px"><span class="labeltext"><b>%d</b></td>
		 <td align="center" width="100px"><span class="labeltext"><b>%d</b></td>

		',$rmpoqty0,$rmpoqty1,$rmpoqty2,$rmpoqty3,
		  $rmpoqty4,$rmpoqty5,$rmpoqty6,
		  $rmpoqty7,$rmpoqty8,$rmpoqty9,
		  $rmpoqty10,$rmpoqty11,$rmpoqty12
			);
 }

}
else {
?>
<table align="top" style="table-layout: fixed" width="700px" style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFCC00">
<td width="55px" bgcolor="#EEEFEE"><span class="labeltext" align='center'><b>PRN</b></td>
<td width="70px" bgcolor="#EEEFEE"><span class="labeltext" align='center'><b>Part Number</b></td>
<td width="44px" bgcolor="#EEEFEE"><span class="labeltext" align='center'><b>WO Qty<br>(WIP)</b></td>
<td width="40px" bgcolor="#EEEFEE"><span class="labeltext" align='center'><b>DN<br>Bal</b></td>
<td width="40px" bgcolor="#EEEFEE"><span class="labeltext" align='center'><b>FG<br>Stock</b></td>
<td width="40px" bgcolor="#EEEFEE"><span class="labeltext" align='center'><b>GRN<br>Stock</b></td>
<td width="80px" bgcolor="#EEEFEE"><span class="labeltext" align='center'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RMPO<br>)</b></td></tr>
<?php
printf('
         <td align="center" width="40px"><span class="labeltext"><b>%d</b></td>
         <td align="center" width="40px"><span class="labeltext"><b>%d</b></td>
	     <td align="center" width="40px"><span class="labeltext"><b>%d</b></td>
		 <td align="center" width="40px"><span class="labeltext"><b>%d</b></td>
	     <td align="center" width="40px"><span class="labeltext"><b>%d</b></td>
 	     <td align="center" width="40px"><span class="labeltext"><b>%d</b></td>
		',$crn,0,0,0,0,0,0,0);
   }
   echo"</tr>";
   echo"</table>";
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


</td>
<br>
</br>
<td valign='top'>
<table width="200px"  border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF" >
<tr  bgcolor="#FFFFFF">
<td valign='top'>
<div id='cust'>
</td>
<tr>
</table>
</td></tr>
</table>
</td></tr>
</table>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table>
</table>
</table>
</table>
</FORM>
</body>
</html>
