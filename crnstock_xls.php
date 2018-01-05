<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = August 12, 2009              =
// Filename: crnstock_xls.php                  =
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


$header='';
$data='';
$username=$_SESSION['username'];
$str='';

$condwd = "(to_days(w.book_date)-to_days('1582-01-01') > 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL' ) and
           (to_days(w.book_date)-to_days('2050-12-31') < 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL')";
$confd ="(to_days(d.disp_date)-to_days('1582-01-01') > 0 ||
                   d.disp_date = '0000-00-00' ||
                    d.disp_date = 'NULL' ) and
           (to_days(d.disp_date)-to_days('2050-12-31') < 0 ||
                    d.disp_date = '0000-00-00' ||
                    d.disp_date = 'NULL')";
$condelvd ="(to_days(d.deliver_date)-to_days('1582-01-01') > 0 ||
                   d.deliver_date = '0000-00-00' ||
                    d.deliver_date = 'NULL' ) and
           (to_days(d.deliver_date)-to_days('2050-12-31') < 0 ||
                    d.deliver_date = '0000-00-00' ||
                    d.deliver_date = 'NULL')";
$congrnd ="(to_days(g.recieved_date)-to_days('1582-01-01') > 0 ||
                   g.recieved_date = '0000-00-00' ||
                    g.recieved_date = 'NULL' ) and
           (to_days(g.recieved_date)-to_days('2050-12-31') < 0 ||
                    g.recieved_date = '0000-00-00' ||
                    g.recieved_date = 'NULL')";

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
if($crn!='')
{

$data.='<table style="table-layout: fixed" width="1003px" style="border:1px solid #000000;" border=1 rules=all cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$data.='<tr bgcolor="#FFCC00">';
$data.='<td width="58px" bgcolor="#EEEFEE"><span class="tabletext" align=\'center\'><b>PRN</b></td>';
$data.='<td width="90px" bgcolor="#EEEFEE"><span class="tabletext" align=\'center\'><b>Part Number</b></td>';
$data.='<td width="145px" bgcolor="#EEEFEE"><span class="tabletext" align=\'center\'><b>WO Process</b></td>';
$data.='<td width="60px" bgcolor="#EEEFEE"><span class="tabletext" align=\'center\'><b>WO Qty<br>(WIP)</b></td>';
$data.='<td valign="top" width="50px" bgcolor="#EEEFEE"><span class="tabletext" align=\'center\'><b>DN Bal</b></td>';
$data.='<td valign="top" width="50px" bgcolor="#EEEFEE"><span class="tabletext" align=\'center\'><b>DN Bal<br>Stores</b></td>';
$data.='<td width="60px" bgcolor="#EEEFEE"><span class="tabletext" align=\'center\'><b>FG<br>Stock</b></td>';
$data.='<td width="60px" bgcolor="#EEEFEE"><span class="tabletext" align=\'center\'><b>GRN<br>Stock</b></td>';
$data.='<td width="60px" bgcolor="#EEEFEE"><span class="tabletext" align=\'center\'><b>GRN<br>Stock<br>(Quar)</b></td>';
$data.='<td width="60px" bgcolor="#EEEFEE"><span class="tabletext" align=\'center\'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RMPO<br>&nbsp;&nbsp;&nbsp;(po#/qty/<br>&nbsp;&nbsp;&nbsp;&nbsp;Duedate)</b></td>';
$data.='</tr>';
$data.='</table>';

$data.='<table width="1003px" style="border:1px solid #000000;" border=1 cellpadding=3 cellspacing=1 rules=all bgcolor="#FFFFFF">';

$cond='';
if($crn!='')
{
//$cond='and w.CIM_refnum like '."'".$crn."%'";
$cond1='where w.crn_num like '."'".$crn."%'";
}
else
{
//$cond='';
$cond1='';
}
$result = $newreport->getallCRN4all($cond1,$crn);
$total=0;
$total4dis=0;
$total4grn=0;
$totalgrn_quar=0;
$totalbalance=0;
$totalbalance_quar=0;
$totaldn_qty=0;
$totalrecd_qty=0;
$totalrmpoqty=0;
$count=0;
$flag=0;
$total_recd4stores=0;
$woprocarr = array("Assembly","Manufacture Only","With Treatment");
while($myrow4crn=mysql_fetch_row($result))
{
 ++$count;
 $flag=$count%2;
 $dnSent_qty=0;
 $dnRecd_qty=0;
 $dn_recd4stores=0;

$cim=$myrow4crn[1];

foreach ($woprocarr as $proc)
{
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td valign=\'top\'>';
$data.='<table style="table-layout: fixed" width="100%" rules=all border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';

$openflag=0;
$data.='<tr valign="top">';
if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="58px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="58px">';
//$flag=0;
	}
$data.='<span class="tabletext"><b>'.$cim.'</b></td>';
if($proc=='Assembly')
{
 if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="90px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="90px">';
//$flag=0;
	}
  $data.='<span class="tabletext">'.$myrow4crn[3].'</td>';
//}
} else
{
  if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="90px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="90px">';
//$flag=0;
	}
  $data.='<span class="tabletext">&nbsp;</td>';
}
$data.='</tr>';
$data.='</table>';

$data.='</td>';

$data.='<td valign=\'top\'>';
$data.='<table style="table-layout: fixed" width="100%" rules=all border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';

$openflag=0;
$data.='<tr valign="top">';
if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
$data.='<span class="tabletext">'.$proc.'</td>';
$results = $newreport->getallCRN4open($myrow4crn[1],$proc);
if(mysql_num_rows($results) == '0')
{
if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
$data.='<span class="tabletext">'.'&nbsp'.'</td>';
}

while($myrow4=mysql_fetch_row($results))
{
if($proc == "With Treatment")
 {
  $recdqty4dn=$newreport->getdn_qty4storesrecd($myrow4crn[1],$proc);
  $dn4stores = split("\|",$recdqty4dn);
  //echo $dn_sent[0];
  //$dnSent_qty = $dn4stores[0];
  $dn_recd4stores = $dn4stores[1];
  $dn = $newreport->getdn_qty4wo($myrow4crn[1],$procc,$condwd);
   //echo 'DD='.$dn;
  $dn_sent = split("\|",$dn);
  //echo $dn_sent[0];
  $dnSent_qty = $dn_sent[0];
  $dnRecd_qty = $dn_sent[1];
  $wip = $myrow4[2]-$dn_sent[0];
 if($flag == 0)
{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';

}
	else
{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
}
  $data.='<span class="tabletext">'.$wip.'</td>';
  $total = $total + ($myrow4[2]-$dn_sent[0]);
  ///$totaldn_qty += $dn_sent[0];
  $totalrecd_qty += ($dnSent_qty-$dnRecd_qty);
  $total_recd4stores += $dn_recd4stores;
 }
 else
 {
if($flag == 0)
{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
}
else
{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
}
   $data.='<span class="tabletext">'.$myrow4[2].'</td>';
   $total = $total + $myrow4[2];
 }

}
$data.='</td></tr>';
$data.='</table>';

$data.='</td>';
$data.='<td valign=\'top\'>';

$data.='<table style="table-layout: fixed" width="100%" rules=all border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';

if($proc == 'Manufacture Only')
{
 if($flag == 0)
{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
}
else
{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';

}
 $data.='<span class="tabletext">'.'&nbsp'.'</td></tr>';
}
else if($proc == 'With Treatment')
{
if($flag == 0)
{
  $data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
}
else
{
  $data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
}
 $data.='<span class="tabletext">'.($dnSent_qty-$dnRecd_qty).'</td>';
 $data.='</td>';
}else
	{
	if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
 $data.='<span class="tabletext">'.'&nbsp'.'</td>';
 $data.='</td></tr>';
	}

$data.='</table>';
$data.='</td>';

$data.='<td valign=\'top\'>';

$data.='<table style="table-layout: fixed" width="100%" rules=all border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';

if($proc == 'Manufacture Only')
{
 if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
 $data.='<span class="tabletext">'.'&nbsp'.'</td></tr>';
}
else if($proc == 'With Treatment')
{
 //$data.='<tr>';
if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
 $data.='<span class="tabletext">'.$dn_recd4stores.'</td>';
 $data.='</td>';
}else
	{
	if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
 $data.='<span class="tabletext">'.'&nbsp'.'</td>';
 $data.='</td></tr>';
	}

$data.='</table>';
$data.='</td>';
$data.='<td valign=\'top\'>';
$data.='<table style="table-layout: fixed" width="100%"  border=1 rules=all cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';

$result4closed = $newreport->getallCRN4closed($myrow4crn[1],$proc);
if(mysql_num_rows($result4closed) == '0')
{
if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
 $data.='<span class="tabletext">'.''.'</td></tr>';
}
while($myrow4closed=mysql_fetch_row($result4closed))
{
//printf('<tr>');
$result1 = $newreport->getallCRNDetails($myrow4closed[0],$myrow4closed[2],$proc);
$num_rows = mysql_num_rows($result1);
if($num_rows=='0')
{
if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
 $data.='<span class="tabletext">'.$myrow4closed[2].'</td>';
 $total4dis = $total4dis + $myrow4closed[2];
}
while($myrow4dispatch=mysql_fetch_row($result1))
{
if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
$data.='<span class="tabletext">'.$myrow4dispatch[0].'</td>';
$total4dis = $total4dis + $myrow4dispatch[0];
}
$data.='</td></tr>';
}
// }
//}

$data.='</table></td>';

$data.='<td valign=\'top\'>';

$data.='<table style="table-layout: fixed" width="100%" border=1 rules=all cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';

$data.='<tr>';
$resultall = $newreport->getCRN($myrow4crn[1],'Regular');
while($myrow4all=mysql_fetch_row($resultall))
{
$result2 = $newreport->getallGRN4Details($myrow4all[2],$myrow4all[0],$myrow4all[1],'Regular');
$num_rows = mysql_num_rows($result2);
if($num_rows=='0')
{
if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
$data.='<span class="tabletext">'.''.'</td>';
$data.='</td></tr>';
}
while($myrow4grn=mysql_fetch_row($result2))
{
 $result4 = $newreport->get_woretqty($myrow4grn[0]);
 $myrow= mysql_fetch_row($result4);
 $balance=$myrow[1]+$myrow4grn[2];
 if ($proc == 'Manufacture Only')
 {
 $total4grn = $total4grn + $balance;
 $totalbalance =$totalbalance+$balance;
 }
}
}
 if ($proc == 'Manufacture Only')
 {
 if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
    $data.='<span class="tabletext">'.$totalbalance.'</td>';
    $data.='</td></tr>';
 }
 else
 {
if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
    $data.='<span class="tabletext">'.''.'</td></tr>';
 }
$totalbalance='&nbsp';

$data.='</table>';
$data.='</td>';
$data.='<td valign=\'top\'>';

$data.='<table style="table-layout: fixed" width="100%" border=1 rules=all cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';

$data.='<tr>';
$result_crn_quar = $newreport->getCRN($myrow4crn[1],'Quarantined');
while($myrow4crn_quar=mysql_fetch_row($result_crn_quar))
{
 $result_grnDet_quar = $newreport->getallGRN4Details($myrow4crn_quar[2],$myrow4crn_quar[0],$myrow4crn_quar[1],'Quarantined');
 $num_rows = mysql_num_rows($result_grnDet_quar);
if($num_rows=='0')
{
if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
 $data.='<span class="tabletext">'.''.'</td>';
 $data.='</td></tr>';
}
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
 if ($proc == 'Manufacture Only')
 {
 if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
    $data.='<span class="tabletext">'.$totalbalance_quar.'</td>';
    $data.='</td></tr>';
 }
 else
 {
 if($flag == 0)
{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
}
else
{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
}
    $data.='<span class="tabletext">'.''.'</td></tr>';
 }
$totalbalance='&nbsp';
$totalbalance_quar='&nbsp';

$data.='</table>';
$data.='</td>';

$data.='<td valign=\'top\'>';

$data.='<table style="table-layout: fixed" width="100%" rules=all border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$result4rmpo=$newreport->get_rmpotqty($myrow4crn[1]);
 $num_rows = mysql_num_rows($result4rmpo);
 if($num_rows=='0')
{
if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
 $data.='<span class="tabletext">'.''.'</td>';
 $data.='</td></tr>';
}

while($myrmpo=mysql_fetch_row($result4rmpo)){
if($proc == 'With Treatment')
{
if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
 $data.='<span class="tabletext">'.'&nbsp'.'</td></tr>';
}
if($proc == 'Assembly')
{
if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
 $data.='<span class="tabletext">'.'&nbsp'.'</td></tr>';
}

if($proc == 'Manufacture Only')
{
$end_date='';
if($myrow[2] != '0.00' && $myrow[2] != '0' && $myrow[2] != '' && $myrow[2] != '-'){
if($myrmpo[0] != '0000-00-00' && $myrmpo[0] != '' && $myrmpo[0] != 'NULL')
{
  $date_arr=split('-',$myrmpo[0]) ;
  $year=$date_arr[0];
  $month=$date_arr[1];
  $day=$date_arr[2];
  $d = mktime(0,0,0,$month,$day,$year);
  if($myrmpo[4]=='SEA'){
   $end_date = date('M j, Y',strtotime('+60 days',$d));
  }
  if($myrmpo[4]=='AIR'){
    $end_date = date('M j, Y',strtotime('+20 days',$d));
  }

   //echo $end_date.'    date---<br>'.$myrmpo[4].'<br>';
}
$rmpoqty=$myrmpo[2];
}
else if($myrmpo[2] ==0)
{
if($myrmpo[0] != '0000-00-00' && $myrmpo[0] != '' && $myrmpo[0] != 'NULL')
{
  $date_arr=split('-',$myrmpo[0]) ;
  $year=$date_arr[0];
  $month=$date_arr[1];
  $day=$date_arr[2];
  $d = mktime(0,0,0,$month,$day,$year);
  if($myrmpo[4]=='SEA'){
   $end_date = date('M j, Y',strtotime('+60 days',$d));
  }
  if($myrmpo[4]=='AIR'){
    $end_date = date('M j, Y',strtotime('+20 days',$d));
  }

   //echo $end_date.'    date---<br>'.$myrmpo[4].'<br>';
}

 $rmpoqty=$myrmpo[3];
}

 $data.='<tr>';
if($flag == 0)
	{
$data.='<td bgcolor="#DFDEDF" align="center" width="145px">';
//$flag=1;
	}
	else
	{
$data.='<td bgcolor="#FFFFFF" align="center" width="145px">';
//$flag=0;
	}
 $data.='<span class="tabletext">'.$myrmpo[1].'/'.$rmpoqty.'/'.$end_date.'</td>';
 $totalrmpoqty += $rmpoqty;
 $data.='</td></tr>';
}
}
$data.='</table>';
$data.='</td>';
$data.='</tr>';
  }
 }
$data.='</table>';
$data.='<table style="table-layout: fixed" width="1003px" style="border:1px solid #000000;"  border=1 rules=all cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$t='Total';
$data.='<tr bgcolor="#F5F6F5">
         <td width="58px"><span class="tabletext"><b>'.$t.'</b></td>
         <td align="center" width="115px"><span class="tabletext"><b>'.''.'</b></td>
		<td align="center" width="115px"><span class="tabletext"><b>'.''.'</b></td>
         <td align="center" width="60px"><span class="tabletext"><b>'.$total.'</b></td>
        <td align="center" width="50px"><span class="tabletext"><b>'.$totalrecd_qty.'</b></td>
        <td align="center" width="50px"><span class="tabletext"><b>'.$total_recd4stores.'</b></td>
		<td align="center" width="60px"><span class="tabletext"><b>'.$total4dis.'</b></td>
         <td align="center" width="60px"><span class="tabletext"><b>'.$total4grn.'</b></td>
        <td align="center" width="60px"><span class="tabletext"><b>'.$totalgrn_quar.'</b></td>
        <td align="center" width="80px"><span class="tabletext"><b>'.$totalrmpoqty.'</b></td></tr>';


$data.='</tr>';
$data.='</table>';
}
$data.='</body></html>';

header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=crnreport.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";

?>
