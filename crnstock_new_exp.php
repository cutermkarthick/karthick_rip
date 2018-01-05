<?php
// First include the class definition
include_once('classes/reportClass.php');

$newreport = new report;
$crn=$_REQUEST['crn'];

$header='';
$data='';
$username=$_SESSION['username'];
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
$cond='and w.crn_num like '."'".$crn."%'";
$cond1='where w.crn_num like '."'".$crn."%'".$cond;
}
else
{
$cond='';
$cond1=''.$cond;
}

$total=0;
$total4dis=0;
$total4grn=0;
$totalgrn_quar=0;
$totalbalance=0;
$totalbalance_quar=0;
$totaldn_qty=0;
$totalrecd_qty=0;
$totalrmpoqty=0;
$total_recd4stores=0;
 $woprocarr = array("Assembly","Manufacture Only","With Treatment","For Assembly");

$procarray = array();
$crnarray = array($procarray);
$rmpoarray = array();
$ft = 1;
$compqty = 0;
$dispqty = 0;
$dnbal = 0;
$fg = 0;
$wip = 0;
$dnbalst = 0;

$result = $newreport->getstock4crnnew($cond1,$crn,$woprocarr);
while($myrow4stock=mysql_fetch_row($result))
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
      $fg = $myrow4stock[5];
	  $wip = $myrow4stock[6];
      $cond = $myrow4stock[7];
      $dnbalst = $myrow4stock[8];
	//  echo "<br>proc is $fg<br>";

         if($cond == 'Closed')
         {
           $procarray[$proc][2] = $fg;
           $total4dis += $fg;
         }
         else
	  {
          if($fg!=0)
          {
            $procarray[$proc][2] = $fg;
            $total4dis += $fg;
          }
           if($fg==0)
          {
           $dnbal_st = $myrow4stock[8]-$myrow4stock[2];
          }
          $procarray[$proc][0] = $wip;
		  $procarray[$proc][1] = $dnbal;
		  $procarray[$proc][3] = $dnbal_st;
		  $total += $wip;
		  $totaldn_qty += $dnbal;
		  $total_recd4stores +=  $dnbalst;
		 // echo "<br>qty is $wip<br>";
	   }
         //echo "<br>cqty is $fg<br>";
	   //}
	  $crnarray[$prevcrndb]=$procarray;
      $ft = 0;
}
//var_dump($crnarray);
//var_dump($rmpoarray);

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


$bg = 0;

$result = $newreport->getallCRN4report($cond1,$crn);
while($myrow4crn=mysql_fetch_row($result))
{

$part_num=$myrow4crn[3];
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
$data .='<tr bgcolor='. $bgcolor .' valign="top">
        <td align="center" width="55px"><span class="tabletext"><font color="red">'. $myrow4crn[1] .'</font></td>
        <td align="center" width="77px"><span class="tabletext">'. $part_num .'</td>';
foreach ($woprocarr as $proc)
{

    if ($proc != 'Assembly')
	{
		$data .='<tr><td></td><td></td>';
    }
   $openflag=0;
   $crninp = $myrow4crn[1];
   $data .='<td  width="111px" align="center" bgcolor='. $bgcolor .'><span class="tabletext">'. $proc .'</td>';
   $wip= $crnarray[$crninp][$proc][0] ;
   $wip = $wip ? $wip : "&nbsp";
   $data.='<td  width="44px" align="center" bgcolor='. $bgcolor .'><span class="tabletext">'. $wip .'</td>';
   $dn = $crnarray[$crninp][$proc][1];
   $dn = $dn ? $dn : "&nbsp";
   $dnst = $crnarray[$crninp][$proc][3];
   $dnst = $dnst ? $dnst : "&nbsp";
   if($proc == 'With Treatment')
   {
      $data.='<td  width="40px" align="center" bgcolor='. $bgcolor .'><span class="tabletext">'. $dn .'</td>';
      $data.='<td  width="50px" align="center" bgcolor='. $bgcolor .'><span class="tabletext">'. $dnst .'</td>';
   }
   else
	{
       $data.='<td  width="80px" align="center" bgcolor='. $bgcolor .'><span class="tabletext">&nbsp</td>';
       $data.='<td  width="80px" align="center" bgcolor='. $bgcolor .'><span class="tabletext">&nbsp</td>';
	}
   $fg = $crnarray[$crninp][$proc][2];
   $fg = $fg ? $fg : "&nbsp";
   $data.='<td  width="40px" align="center" bgcolor='. $bgcolor .'><span class="tabletext">'. $fg .'</td>';
   $grnstock = $grnarray[$crninp][0];
   $grnstockquar = $grnarray[$crninp][1];
   if($proc == 'Manufacture Only')
   {
      $data.='<td align="center" width="90px" bgcolor='. $bgcolor .'><span class="tabletext">'. $grnstock .' </td>';
      $data.='<td align="center" width="90px" bgcolor='. $bgcolor .'><span class="tabletext">'. $grnstockqua .' </td>';
   }
   else
	{
       $data.='<td  width="80px" align="center" bgcolor='. $bgcolor .'><span class="tabletext">&nbsp</td>';
       $data.='<td  width="80px" align="center" bgcolor='. $bgcolor .'><span class="tabletext">&nbsp</td>';
	}
    $result4rmpo=$newreport->get_rmpotqty($myrow4crn[1]);
    $myrmpo=mysql_fetch_row($result4rmpo);
    if($proc == 'Manufacture Only')
    {
     $end_date='';$duedate='';
     if($myrmpo[7] != '0000-00-00' && $myrmpo[7] != '' && $myrmpo[7] != 'NULL')
     {
       $duedate=$myrmpo[7] ;
     }else if($myrmpo[6] != '0000-00-00' && $myrmpo[6] != '' && $myrmpo[6] != 'NULL')
     {
        $duedate=$myrmpo[6] ;
     }else
     {
        $duedate=$myrmpo[0] ;
     }
// echo "===$duedate<br>" ;
     if($duedate != '0000-00-00' && $duedate != '' && $duedate != 'NULL')
     {
        $date_arr=split('-',$duedate) ;
        $year=$date_arr[0];
        $month=$date_arr[1];
        $day=$date_arr[2];
        $d = mktime(0,0,0,$month,$day,$year);
        if($myrmpo[4]=='SEA')
        {
          $end_date = date('M j, Y',strtotime('+60 days',$d));
        }
         if($myrmpo[4]=='AIR')
        {
         $end_date = date('M j, Y',strtotime('+20 days',$d));
         }
  //echo $end_date.'date---<br>'.$myrmpo[4].'<br>';
       }

       $rmpoqty=$myrmpo[5];
//}
       $data.='<td align="center" width="90px" bgcolor='. $bgcolor .'><span class="tabletext">'. $myrmpo[1] .'/<br>'. $rmpoqty .'/<br> '. $end_date.' </td>';
        $totalrmpoqty += $rmpoqty;
//$data.='</td>');
       }else
        {
          $data.='<td align="center" width="90px" bgcolor='. $bgcolor .'><span class="tabletext">&nbsp;</td>';
        }
 } // for loop ends here

}

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
        <td align="center" width="80px"><span class="tabletext"><b>'.$totalrmpoqty.'</b></td></tr>


</table>';

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
header("Content-Disposition: attachment; filename=crnstock_new_exp.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
