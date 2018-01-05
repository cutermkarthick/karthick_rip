<?php
//===========================
// Author: FSI                                           
// Date-written = August 12, 2009              
// Filename: crnreport.php                         
// Copyright of Badari Mandyam, FluentSoft 
// Revision: v1.0 WMS                               
// Displays CRN Stock Summary list.            
//===========================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
////////////////session_register('pagename');

// First include the class definition
include_once('classes/reportClass.php');
include_once('classes/helperClass.php');
include_once('classes/displayClass.php');


if ( isset ( $_REQUEST['crn'] ))
{
  $_SESSION[crn]=$_REQUEST['crn'];
}


if ( isset ( $_REQUEST['company'] ))
{
  $_SESSION[company]=$_REQUEST['company'];
}


$newdisplay = new display;
$newreport = new report;
$newhelper = new helper;
$rowsPerPage = 10;
$crn=$_REQUEST['crn'];
$ftrigger=$_REQUEST['ftrigger'];



if (!isset($_REQUEST['ftrigger']) or 
     $ftrigger == '' or
	 ($ftrigger != 'ALL' && 
	  $ftrigger != 'all' && 
	  $ftrigger != 'TREAT' &&
	  $ftrigger != 'treat' && 
	  $ftrigger != 'WO' && 
	  $ftrigger != 'wo' && 
	  $ftrigger != 'RMPO'))
    $ftrigger = 'rmpo';
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

/*$schweekarr = array('2015-07-20','2015-07-27',
					 '2015-08-03','2015-08-10','2015-08-17','2015-08-24','2015-08-31',
					 '2015-09-07','2015-09-14','2015-09-21','2015-09-28','2015-10-05',
					 '2015-10-12','2015-10-19','2015-10-26','2015-11-02','2015-11-09',
					 '2015-11-16','2015-11-23','2015-11-30','2015-12-07','2015-12-14',
					 '2015-12-21','2015-12-28'
					 );
*/
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

//print_r($schweekarr);
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

if(isset($_REQUEST['crnval']))
{

	$crnval1 = $_REQUEST['crnval'] ;
}


 
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>

<html>
<head>
<title>RMPO Projection</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0" >

<form action='crnrmpoproj.php?crnval=<?php echo $crnval1 ?>' method='post' enctype='multipart/form-data'>
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

<td colspan=160>&nbsp;</td>
</tr>
</table>

<table valign="top" width="100%" border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#F5F6F5">
<td align="center" colspan=7><span class="heading"><b>Search Criteria</b></td></tr>
<tr>

<?php if($userid !='ashorrock') 
{
	$flagk = 0;
?>
<td valign='top' bgcolor="#FFFFFF"><span class="schtext"><b>CRN:</b>&nbsp;
<input type="text" size=15% name="crn" value="<?echo $_REQUEST['crn'] ?>">
&nbsp;&nbsp;<span class="schtext"><b>Trigger:</b>&nbsp;
<input type="text" size=15% name="ftrigger" id="ftrigger" value="<?echo $ftrigger; ?>">(RMPO)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="button"><b><input type="submit" name="submit" value="Get"></b>

<input type="hidden" name="user" id="user" value ="<?php echo $userid ?>">
<input type="hidden" name="flagk" id="flagk" value ="0">
<img src="images/export.gif" onclick="export_crn_rmpo();" >


<?php }
else
{
	$flagk = 1;
?>
<td valign='top' bgcolor="#FFFFFF"><span class="schtext"><b>Company:</b>&nbsp;

<select name="company" id="company" onchange="javascript:getcompcrnval()">
<option value="150" selected>AMI Metals UK Ltd </option>
<option value="131">Wilsons Limited</option>
</select>
<input type="hidden" name="compval" id="compval" value="<?php echo $_REQUEST['company']; ?>">
</span</td>
<td valign='top' bgcolor="#FFFFFF"><span class="schtext"><b>CRN:</b>&nbsp;
<span id="crntd"></span>
<span id="crnhome">
<select name="crn" id="crn" onchange="javascript:getcrnval()">
<?php 
$result1 = $newreport->getcrnsforAshorrock('150','') ;
while($myrow1= mysql_fetch_row($result1))
{
?>
<option value='<?php echo $myrow1[0];?>'><?php echo $myrow1[0]?></option>	
<?php }?>
</select>
</span>
<input type="text" name="crnb" id="crnb"  value="<?php echo  $_REQUEST['crnb']; ?>" size="5">

<input type="hidden" name="crnval" id="crnval" value="<?php echo $crnval1 ?>">
&nbsp;&nbsp;<span class="schtext"><b>Trigger:</b>&nbsp;
<input type="text" size=5% name="ftrigger" id="ftrigger" value="<?echo $ftrigger; ?>">(RMPO)
<span class="button"><b><input type="submit" name="submit" value="Get"></b>

<input type="hidden" name="user" id="user" value ="<?php echo $userid ?>">
<input type="hidden" name="flagk" id="flagk" value ="1">

<img src="images/export.gif" onclick="export_crn_rmpo();" >

<?php
}
?>
</td>
</td>
</tr>
</table>
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
$schdtcount = 0;
$actcount = 0;
$qty = 0;

$flag=  0;

	if($userid =='ami' )
	{
		$crn = array("35-022","35-036") ;
		$crn1 = '"' . implode('","', $crn) . '"';
   		$flag = 1;
	}

	$crnval = array();
	$crn = array();


	if($userid =='ashorrock' )
	{


		if($_REQUEST['crn'] =='All')
		{
			$result = $newreport->getcrnsforAshorrock($_REQUEST['company'],$_REQUEST['crnb']) ;
			while($myrow = mysql_fetch_row($result))
			{
				array_push($crn, $myrow[0]) ;
			}

			$crn1 = '"' . implode('","', $crn) . '"';
		//	$crn1 = $_REQUEST['crnb'];
			$flag = 1;
			$flagk = 0;
		}
		else
		{



			$result = $newreport->getcrnsforAshorrock($_REQUEST['company'],$_REQUEST['crnb']) ;
			while($myrow = mysql_fetch_row($result))
			{
				array_push($crn, $myrow[0]) ;
			}

			$crn1 = '"' . implode('","', $crn) . '"';
			
			$crn = $_REQUEST['crnb'];
			$flag = 1 ;
			$flagk = 0;


		}	
	}
	else
	{
		$crn = $_REQUEST['crn'];
		$crn1 = $_REQUEST['crn'];
		$flag = 0 ;

	}	


if($crn !='')
{

	if($flag == 0)
	{

	  $lobresult = $newreport->getlob($crn1,$flagk);	
	}		

	else
	{

		$lobresult = $newreport->getlob_array($crn1);	
	}
    
       if(mysql_num_rows($lobresult) != 0)
	   {
		      while($mylobrow=mysql_fetch_row($lobresult))
              {
	              $crn1 = $mylobrow[0];
                   $date = $mylobrow[1];			       
                   $qty = $mylobrow[2];
				  if ($newhelper->dateDiff('-', $date, $currmnth ) <=0)
		   	     // if ($date < $currmnth)
                  {
				     $crnarr[$crn1][$wwbegindate1] += $qty;
				//	echo "<br>$qty for $date under begindate $wwbegindate1 for $crn1";
			      }
				  else 
				  {
					  $crnarr[$crn1][$date] = $qty;
				   //   echo "<br>$qty for $date under date $date for $crn1";
				  }
                  $crnonlyarr[$crn1] = $crn1;
			  }
				


?>


<table align="top" style="table-layout: fixed" width="750px" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td><span class="tabletext">
</td>
</tr>
</table>


<table align="top" style="table-layout: fixed" width="700px" style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFCC00">
<td width="180px"  align="center" bgcolor="#EEEFEE"><span class="labeltext" align="center"><b>CRN</b></td>
<td width="180px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>PO Qty</b></td>
<td width="100px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Qty per bill</b></td>
<td width="100px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Unit Weight</b></td>
<td width="100px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Total</b></td>
<td width="180px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>RM PO Date</b></td>
<td width="180px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Schedule Date</b></td>
</tr>
</table>

<div style="height:400;overflow:auto;border:" id="dataList">

<table style="table-layout: fixed"   width="700px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
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
$total_recd4stores=0;
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
	$poarray_date = array();
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],'0000-00-00',$currmnth);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty0 = $myrmpo[1];
	$duedate0       = $myrmpo[0];	
	$poarray[0] = $totalrmpoqty0;
	$poarray_date[0] = $duedate0;
	$rmpoqty0 = $myrmpo[1];
	$rmpoqty0ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnth,$currmnthplus1);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty1 = $myrmpo[1];
	$duedate1      = $myrmpo[0];	
	$poarray[1] = $totalrmpoqty1;
	$poarray_date[1] = $duedate1;
	$rmpoqty1 = $myrmpo[1];
	$rmpoqty1ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus1,$currmnthplus2);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty2 = $myrmpo[1];
	$duedate2      = $myrmpo[0];	
	$poarray[2] = $totalrmpoqty2;
	$poarray_date[2] = $duedate2;
	$rmpoqty2 = $myrmpo[1];
	$rmpoqty2ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus2,$currmnthplus3);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty3 = $myrmpo[1];
	$duedate3      = $myrmpo[0];	
	$poarray[3] = $totalrmpoqty3;
	$poarray_date[3] = $duedate3;
	$rmpoqty3 = $myrmpo[1];
	$rmpoqty3ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus3,$currmnthplus4);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty4 = $myrmpo[1];
	$duedate4      = $myrmpo[0];	
	$poarray[4] = $totalrmpoqty4;
	$poarray_date[4] = $duedate4;
	$rmpoqty4 = $myrmpo[1];
	$rmpoqty4ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus4,$currmnthplus5);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty5 = $myrmpo[1];
	$duedate5      = $myrmpo[0];	
	$poarray[5] = $totalrmpoqty5;
	$poarray_date[5] = $duedate5;
	$rmpoqty5 = $myrmpo[1];
	$rmpoqty5ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus5,$currmnthplus6);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty6 = $myrmpo[1];
	$duedate6      = $myrmpo[0];	
	$poarray[6] = $totalrmpoqty6;
	$poarray_date[6] = $duedate6;
	$rmpoqty6 = $myrmpo[1];
	$rmpoqty6ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus6,$currmnthplus7);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty7 = $myrmpo[1];
	$duedate7      = $myrmpo[0];	
	$poarray[7] = $totalrmpoqty7;
	$poarray_date[0] = $duedate7;
	$rmpoqty7 = $myrmpo[1];
	$rmpoqty7ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus7,$currmnthplus8);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty8 = $myrmpo[1];
	$duedate8      = $myrmpo[0];	
	$poarray[8] = $totalrmpoqty8;
	$poarray_date[8] = $duedate8;
	$rmpoqty8 = $myrmpo[1];
	$rmpoqty8ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus8,$currmnthplus9);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty9 = $myrmpo[1];
	$duedate9      = $myrmpo[0];	
	$poarray[9] = $totalrmpoqty9;
	$poarray_date[9] = $duedate9;
	$rmpoqty9 = $myrmpo[1];
	$rmpoqty9ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus9,$currmnthplus10);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty10 = $myrmpo[1];
	$duedate10      = $myrmpo[0];	
	$poarray[10] = $totalrmpoqty10;
	$poarray_date[10] = $duedate10;
	$rmpoqty10 = $myrmpo[1];
	$rmpoqty10ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus10,$currmnthplus11);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty11 = $myrmpo[1];
	$duedate11      = $myrmpo[0];	
	$poarray[11] = $totalrmpoqty11;
	$poarray_date[11] = $duedate11;
	$rmpoqty11 = $myrmpo[1];
	$rmpoqty11ponum = $myrmpo[3];
	$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus11,$currmnthplus12);
	$myrmpo=mysql_fetch_row($result4rmpo);
	$totalrmpoqty12 = $myrmpo[1];
	$duedate12      = $myrmpo[0];	
	$poarray[12] = $totalrmpoqty12;
	$poarray_date[12] = $duedate12;
	$rmpoqty12 = $myrmpo[1];
	$rmpoqty12ponum = $myrmpo[3];


	}

}
// print_r($poarray) ;
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
//var_dump($grnarray);

		$fg = $total+$totaldn_qty+$total4dis+$total_recd4stores;
		$grn = $total4grn;


$bufferqty = 0;
$count = 0;

// print_r($crnarr) ;
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
	   }

	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]))
      {
  	        poequation(2);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
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

	   }

	 else  if ($qtyreq < ($fg+$grn+ $poarray[0]+$poarray[1]+$poarray[2]+$poarray[3]))
      {
  	        poequation(4);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
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

	   }

	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]))
      {
  	        poequation(5);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
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
	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5]))
      {
  	        poequation(6);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
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

	   }

	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6]))
      {  	       
		    poequation(7);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
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

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7]))
      {  	       
  	        poequation(8);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    
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

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + $poarray[8]))
      {  	       
  	        poequation(9);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    
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

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
		                                $poarray[8] + $poarray[9]))
      {  	        
		    poequation(10);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    
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

	   }

	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
		                                $poarray[8] + $poarray[9] + $poarray[10]))	        
      {
  	        poequation(11);
			$equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
		    
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

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
		                                $poarray[8] + $poarray[9] + $poarray[10] + $poarray[11]))	        
      {
  	        poequation(12);
			$equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
		    
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

	   }
	 else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
		                                $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
		                                $poarray[8] + $poarray[9] + $poarray[10] + $poarray[11] + $poarray[12]))	        
      {
  	        poequation(13);
			
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
                  $poqtysum += (int)$poarray[$i];
                  $rmdispatchdate = (int)$poarray_date[$i];
				  //echo "<br> value of po array element for $i is $poarray[$i]";
				  if ($poarray[$i] != 0)
			      {
					   $reqpoqty = (int)$poarray[$i];
                       $totalrmpoqtyeqn .= " + $reqpoqty " .  "po{$i}";
					   $equation = "(" . $totalrmpoqtyeqn . ")";
					   $poarray[$i] = 0;
			      }


		    }



			$equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
		    //$equation = $totalrmpoqtyeqn;
   		   $shortfall = $qtyreq - ($fg+$grn+$poqtysum);
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
//print_r($poarr);
for ($j=0; $j<=50; $j++) 
{
	  //echo "<br> week index is $j";
	  $data = '';
	  $thisweek = $j;
	  $nextweek = $thisweek+1;
	  $fromdate = $schweekarr[$thisweek];
      $todate = $schweekarr[$nextweek];
 	  foreach($poarr as $orddate => $reqqty) 
      {
         $fromdate4po = $fromdate;
	     if (check_in_range($fromdate4po, $todate, $orddate))
	     {
           $potrigger += $reqqty;
		   $po4schdt = $podtarr[$orddate];
		   unset($poarr[$orddate]);	     

		   	$datearr1 = split('-', $fromdate4po);
			 //echo "<br>po ord dt is $po4schdt";
	         $d1=$datearr1[2];
	         $m1=$datearr1[1];
	         $y1=$datearr1[0];
	         $x1=mktime(0,0,0,$m1,$d1,$y1);
	         $sch_date=date("M j, Y",$x1);

		 }

      }
 

  // if ($ftrigger == 'ALL' or $ftrigger == 'RMPO' or
	 //  $ftrigger == 'all' or $ftrigger == 'rmpo')
  //  {
	 if ($potrigger != '')
	 {
	$datearr = split('-', $po4schdt);
	
     $d=$datearr[2];
     $m=$datearr[1];
     $y=$datearr[0];
     $x=mktime(0,0,0,$m,$d,$y);
     $potrigdate=date("M j, Y",$x);

       // $resultk = $newreport->getcrnweight($crn);
       // $totalk = 0;
       // $myrowk=mysql_fetch_row($resultk);
       // if($resultk)
       // {
       // 	 $unit_perbill = $myrowk[0] ;
       // 	 $unit_weight  = $myrowk[1] ;
       	 
       // }
      $data .= "<span class=\"labeltext\">$potrigger </font>";

      // $totalk = $potrigger * $unit_perbill  * $unit_weight ;


      echo "<tr title=%s bgcolor=\"#FFFFFF\" >" ;
      echo "<td align=\"center\" width=\"180px\"><span class=\"labeltext\"><font color=\"black\">$crn</font></td>" ;


      echo "<td width=\"180px\" align=\"center\"" . "$data</td>";

	  // echo "<td width=\"100px\" align=\"center\"><span class=\"labeltext\">$unit_perbill
   //    </span></td>";
   //    echo "<td width=\"100px\" align=\"center\"><span class=\"labeltext\">$unit_weight
   //    </span></td>";
      // echo "<td width=\"100px\" align=\"center\"><span class=\"labeltext\">$totalk
      // </span></td>";
      echo "<td width=\"180px\" align=\"center\"><span class=\"labeltext\">$sch_date
      </span></td>";

      echo "<td width=\"180px\" align=\"center\"><span class=\"labeltext\">$potrigdate 
      </span></td></tr>" ;
	  $potrigger = '';
	 }
   // }

	  //echo "<td align=\"center\" bgcolor=\"#FFFFFF\" width=\"200px\"><span class=\"schtext\">$data</td>";
	

}
echo "</tr>";
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
?>
<table align="top" style="table-layout: fixed" width="700px" style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFCC00">
<td width="55px" bgcolor="#EEEFEE"><span class="schtext" align='center'><b>CRN</b></td>
<td width="70px" bgcolor="#EEEFEE"><span class="schtext" align='center'><b>Part Number</b></td>
<td width="44px" bgcolor="#EEEFEE"><span class="schtext" align='center'><b>WO Qty<br>(WIP)</b></td>
<td width="40px" bgcolor="#EEEFEE"><span class="schtext" align='center'><b>DN<br>Bal</b></td>
<td width="40px" bgcolor="#EEEFEE"><span class="schtext" align='center'><b>FG<br>Stock</b></td>
<td width="40px" bgcolor="#EEEFEE"><span class="schtext" align='center'><b>GRN<br>Stock</b></td>
<td width="80px" bgcolor="#EEEFEE"><span class="schtext" align='center'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RMPO<br>)</b></td></tr>
<?php
printf('
         <td align="center" width="40px"><span class="schtext"><b>%d</b></td>
         <td align="center" width="40px"><span class="schtext"><b>%d</b></td>
	     <td align="center" width="40px"><span class="schtext"><b>%d</b></td>
		 <td align="center" width="40px"><span class="schtext"><b>%d</b></td>
	     <td align="center" width="40px"><span class="schtext"><b>%d</b></td>
 	     <td align="center" width="40px"><span class="schtext"><b>%d</b></td>
		',$crn,0,0,0,0,0,0,0);
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
?>
</tr>
<table>
</div>
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
</td>
<td width="6"><img width="6" src="images/spacer.gif "></td>
</tr>

<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img height="6" src="images/spacer.gif "></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
</table>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>

</table>
</table>
</table>
</table>
</FORM>
</body>
</html>
