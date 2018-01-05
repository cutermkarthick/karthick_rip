<?php
//==============================================
// Author: FSI                                 =
// Date-written = Nov 7, 2013                  =
// Filename: dnexcel.php                     =
// Copyright of Fluent Technologies            =
// Revision: v1.0 WMS                          =
// Displays list of DNs                        =
//==============================================
// First include the class definition
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
include_once('classes/reportClass.php');
$newdn = new report;
//$nc4qarecnum = $_REQUEST['nc4qarecnum'];


//echo $nc4qarecnum."***-*-*";
//$myrow = mysql_fetch_row($result);
$header='';
$data='';
$username=trim($_SESSION['username']);
$final_crn = trim($_REQUEST['final_crn']);
$ddate1 = trim($_REQUEST['ddate1']);
$ddate2 = trim($_REQUEST['ddate2']);
$final_dn = trim($_REQUEST['final_dn']);
$status_val = trim($_REQUEST['status_val']);
$supplier = trim($_REQUEST['supplier']);

$str='';

	if($ddate1 !='')
	{
 $fromdate=$ddate1;
 $datearr = split('-',$fromdate);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $dfdate=date("M j, Y",$x);
	}
	else
	{
 $fromdate='0000-00-00';
 $dfdate='';
	}
	if($ddate2 !='')
	{
 $todate= $ddate2;
 $datearr = split('-',$todate);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $dtdate=date("M j, Y",$x);
	}
	else
	{
 $todate='0000-00-00';
 $dtdate='';
	}
//echo $cause."-------";
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
$curdate = date("Y-m-d");
$datearr = split('-',$curdate);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $cur_date=date("M j, Y",$x);
if($dfdate=='' && $dtdate=='')
{
 $title="DN Report  Date: ".$cur_date;
}
else if($dfdate!='' && $dtdate=='')
{
 $title="DN Report From ".$dfdate ." To ". $cur_date ;
}
else
{
 $title="DN Report From ".$dfdate ." To ". $dtdate;
}
$data.='<table border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" rules="all">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=15 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="2" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';

date_default_timezone_set('Asia/Calcutta');
$todate1 = date("Y-m-d");
$today = split('-',$todate1);
$days = $today[2]-1;
$fromdate1 = date("Y-m-d",strtotime("-$days days"));

if ( isset ( $_REQUEST['final_crn'] ) )
{
    $finalcrn_match = $_REQUEST['final_crn'];       
    $final_crn = "'" . $_REQUEST['final_crn'] . "%" . "'";    
    $cond0 = "d.crn like " . $final_crn;
}
else {
     $finalcrn_match = '';
}

if ( isset ( $_REQUEST['final_dn'] ) )
{
    $finaldn_match = $_REQUEST['final_dn'];       
    $final_dn = "'" . "%" . $_REQUEST['final_dn'] . "%" . "'";
    $cond2 = "d.dnnum like " . $final_dn;
}
else {
     $finaldn_match = '';
}


if ( isset ( $_REQUEST['ddate1'] ) || isset ( $_REQUEST['ddate2'] ) )
{
     $ddate1_match = $_REQUEST['ddate1'];
     $ddate2_match = $_REQUEST['ddate2'];
     if ( isset ( $_REQUEST['ddate1']) &&  $_REQUEST['ddate1'] != '' )
     {
          $date1 = $_REQUEST['ddate1'];
          $cond21 = "to_days(d.deliver_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(d.deliver_date)-to_days('1582-01-01') > 0 || d.deliver_date = 'NULL' || d.deliver_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['ddate2'] )  &&  $_REQUEST['ddate2'] != '')
     {
          $date2 = $_REQUEST['ddate2'];
          $cond22 = "to_days(d.deliver_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(d.deliver_date)-to_days('2050-12-31') < 0 || d.deliver_date = 'NULL' || d.deliver_date = '0000-00-00')";
     }
     $cond1 = $cond21 . ' and ' . $cond22;

}
else
{
     $ddate1_match = '';
     $ddate2_match = '';
}

if(isset ($_REQUEST['status_val'] ) )
{
      $sval = $_REQUEST['status_val'];
      //echo $sval.'-----';

      if ($sval== 'Open')
      {
         $cond3 = "(status = '" . $sval . "' || status is NULL || status = '')";
      }
     else if ($sval == 'Closed')
      {
         $cond3 = "status = '" . $sval . "'" ;
      }
     else if ($sval == 'All')
      {
         $cond3 = "(status like '%' || status is NULL)";
      }   
      else if ($sval == 'Cancelled')
      {
         $cond3 = "status = '" . $sval . "'" ;
      } 
}
else
{
     $sval = 'Open';
     $cond3 = "(status = '" . $sval . "' || status is NULL || status = '')";
}


if ( isset ( $_REQUEST['supplier'] ) )
{
    $supplier_match = $_REQUEST['supplier'];       
    $supplier = "'". $_REQUEST['supplier'] . "%" . "'";
    $cond4 = "d.sent_treat_to like " . $supplier;
}
else {
     $supplier_match = '';
}

$cond = $cond0 . ' and ' . $cond1. ' and ' . $cond2. ' and ' . $cond3. ' and ' . $cond4;


 $data.='
<table width=1000px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  rules="all">
<tr  bgcolor="#FFCC00">
<td width="4%" bgcolor="#EEEFEE"><span class="tabletext"><b>DN #</b></td>
<td width="4%" bgcolor="#EEEFEE"><span class="tabletext"><b>PRN #</b></td>
<td width="6%" bgcolor="#EEEFEE"><span class="tabletext"><b>Sent for treatment To</b></td>
<td width="6%" bgcolor="#EEEFEE"><span class="tabletext"><b>After treatment deliver To</b></td>
<td width="6%" bgcolor="#EEEFEE"><span class="tabletext"><b>PO No.</b></td>
<td width="5%" bgcolor="#EEEFEE"><span class="tabletext"><b>WO#</b></td>
<td width="5%" bgcolor="#EEEFEE"><span class="tabletext"><b>Delivery Date</b></td>

<td width="5%" bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td>
<td width="4%" bgcolor="#EEEFEE"><span class="tabletext"><b>Type</b></td>

<td width="5%" bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></td>
<td width="4%" bgcolor="#EEEFEE"><span class="tabletext"><b>Qty<br>Recd</b></td>
<td width="4%" bgcolor="#EEEFEE"><span class="tabletext"><b>DN<br>Bal</b></td>
<td width="4%" bgcolor="#EEEFEE"><span class="tabletext"><b>QA <br>Pending</b></td>
<td width="4%" bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc#</b></td>
<td width="6%" bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc Date </b></td>
</tr>';

 $result = $newdn->getdeliver4excel($cond);
 while ($myrow = mysql_fetch_row($result))
 {
 $bgcolor = "#FFFFFF";
 if($myrow[5] != '' && $myrow[5] != '0000-00-00')
 {
	 $datearr = split('-', $myrow[5]);
	 $d=$datearr[2];
	 $m=$datearr[1];
	 $y=$datearr[0];
	 $x=mktime(0,0,0,$m,$d,$y);
	 $deliver_date=date("M j, Y",$x);
  }
  else
  {
	 $deliver_date = '';
  }
  if($myrow[26] != '' && $myrow[26] != '0000-00-00')
{
 $datearr = split('-', $myrow[26]);
 $d=$datearr[2];
 $m=$datearr[1];
 $y=$datearr[0];
 $x=mktime(0,0,0,$m,$d,$y);
 $cofc_date=date("M j, Y",$x);
}
else
{
 $cofc_date = '';
}
if($prev_dn != $myrow[1])
{
	if ($myrow[21] > 0)
	{
	$qty_recd = $myrow[21];
	$dnbal = $myrow[18] - $myrow[21];			
	}
	else
	{
	$qty_recd = 0;
	$dnbal = $myrow[18];
	}
}
else
{
	if ($myrow[21] > 0)
	{
	$qty_recd = $myrow[21];
	$dnbal = $dnbal - $myrow[21];			
	}
	else
	{
	$qty_recd = 0;
	$dnbal = $dnbal;
	}
}
if ($myrow[21] > 0)
{
$dnqabal = $myrow[21] - ($myrow[22] + $myrow[23] + $myrow[24]);			   
}
else
{
$dnqabal = 'NA';
}

if ($myrow[21] > 0)
{	
if ($dnbal > 0 || $dnqabal > 0 )
{	
	$bgcolor = "#FF3300";	
}
else if ($dnbal == 0 && $dnqabal == 0)
{	
	$bgcolor = "#00FF00";
}
}
else
{
 $bgcolor = "#FFFFFF";
}
$data .= "<tr bgcolor=\"$bgcolor\">";
if($prev_dn != $myrow[1])
{
    $data.='<td bgcolor="#EEEFEE" >'. $myrow[1].'</td>';
	$data.='<td bgcolor="#EEEFEE" >'. $myrow[4].'</td>';
	$data.='<td bgcolor="#EEEFEE" >'. $myrow[2].'</td>';
	$data.='<td bgcolor="#EEEFEE" >'. $myrow[3].'</td>';
	$data.='<td bgcolor="#EEEFEE" >'. $myrow[6].'</td>';
	$data.='<td bgcolor="#EEEFEE" >'. $myrow[9].'</td>';
	$data.='<td bgcolor="#EEEFEE" >'. $deliver_date.'</td>';
	$data.='<td bgcolor="#EEEFEE" >'. $myrow[19].'</td>';
	$data.='<td bgcolor="#EEEFEE" >'. $myrow[20].'</td>';
	$data.='<td bgcolor="#EEEFEE" >'. $myrow[18].'</td>';
}
else
{
	$data.='<td bgcolor="#EEEFEE" >&nbsp;</td>';
	$data.='<td bgcolor="#EEEFEE" >&nbsp;</td>';
	$data.='<td bgcolor="#EEEFEE" >&nbsp;</td>';
	$data.='<td bgcolor="#EEEFEE" >&nbsp;</td>';
	$data.='<td bgcolor="#EEEFEE" >&nbsp;</td>';
	$data.='<td bgcolor="#EEEFEE" >&nbsp;</td>';
	$data.='<td bgcolor="#EEEFEE" >&nbsp;</td>';
	$data.='<td bgcolor="#EEEFEE" >&nbsp;</td>';
	$data.='<td bgcolor="#EEEFEE" >&nbsp;</td>';
	$data.='<td bgcolor="#EEEFEE" >&nbsp;</td>';
}	
	$data.='<td bgcolor="#EEEFEE" >'. $qty_recd.'</td>';
	$data.='<td bgcolor="#EEEFEE" >'. $dnbal.'</td>';
	$data.='<td bgcolor="#EEEFEE" >'. $dnqabal.'</td>';

$data.='<td bgcolor="#EEEFEE" >'. $myrow[25].'</td>';
$data.='<td bgcolor="#EEEFEE" >'. $cofc_date.'</td>';
	
	$data.='</tr>'; 
	$prev_dn=$myrow[1];
 }
$data.='
    </table>
</form>
</body>
</html>';

header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=dnDetails.xls",false);
header("Pragma: no-cache");
header("Expires: 0");



print "$header\n$data";
