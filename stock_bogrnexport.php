<?php
// First include the class definition
include_once('classes/reportClass.php');

$newreport = new report;
$crn=$_REQUEST['crn'];

$header='';
$data='';
$username=$_SESSION['username'];
$str='';
$fdate=$_REQUEST['fdate'];
$tdate=$_REQUEST['tdate'];

if (( $fdate !='' && $fdate !='0000-00-00' ) ||  ( $tdate !='' && $tdate !='0000-00-00' ) )
{
     $ddate1_match = $fdate;
     $ddate2_match = $tdate;
     if ( ( $fdate !='' && $fdate !='0000-00-00' )  )
     {
          $date1 =$fdate;
          $cond21 = "to_days(grn.recieved_date) " . ">= to_days('" . $date1 . "')";
          $condw1 = "to_days(w.assydate) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(grn.recieved_date)-to_days('1582-01-01') > 0 || grn.recieved_date is null || grn.recieved_date = '0000-00-00')";
          $condw1 = "(to_days(w.assydate)-to_days('1582-01-01') > 0 || w.assydate is null ||w.assydate = '0000-00-00')";

     }

     if ( ( $tdate !='' && $tdate !='0000-00-00' ))
     {
          $date2 = $tdate;
          $cond22 = "to_days(grn.recieved_date) " . "<= to_days('" . $date2 . "')";
          $condw2 = "to_days(w.assydate) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(grn.recieved_date)-to_days('2050-12-31') < 0 || grn.recieved_date is null || grn.recieved_date = '0000-00-00')";
          $condw2 = "(to_days(w.assydate)-to_days('2050-12-31') < 0 || w.assydate is null || w.assydate = '0000-00-00')";
     }
     $cond2 = $cond21 . ' and ' . $cond22;
     $condw = $condw1 . ' and ' . $condw2;

}else
{
   $cond2 = "(to_days(grn.recieved_date)-to_days('1582-01-01') > 0 ||
                    grn.recieved_date = '0000-00-00' ||
                    grn.recieved_date is null ) and
           (to_days(grn.recieved_date)-to_days('2050-12-31') < 0 ||
                    grn.recieved_date = '0000-00-00' ||
                    grn.recieved_date is null)";
   $condw = "(to_days(w.assydate)-to_days('1582-01-01') > 0 ||
                    w.assydate = '0000-00-00' ||
                    w.assydate is null ) and
           (to_days(w.assydate)-to_days('2050-12-31') < 0 ||
                    w.assydate = '0000-00-00' ||
                    w.assydate is null)";

}
$rawmtlspec=trim($_REQUEST['raw_mat_spec']);
$rawmtltype=trim($_REQUEST['raw_mat_type']);
$grnnum=trim($_REQUEST['grnnum']);
$crnnum=trim($_REQUEST['crnnum']);
//echo $crnnum;
if($crnnum !='')
{
 $cond0 = "grn.crn like '".$crnnum."%'";
}else
{
 $cond0 = "(grn.crn like '%' || grn.crn is NULL)";
}
$cond1 = "grn.raw_mat_spec like '".$rawmtlspec."%'";
$cond4 = "grn.raw_mat_type like '".$rawmtltype."%'";
$cond3 = "grn.grnnum like '".$grnnum."%'";

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4;
//echo $cond."----<br>";

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
$title="GRN Stock Report";
$data.='<body>';
$data.='<table border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" rules="all">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=12 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="2" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';

$data.='<html>
<head>
<title>GRN Stock</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

				<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" rules="all">
        <tr>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>GRN #</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Received Date</b></td>
            <td width="7%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Type</b></td>
            <td width="7%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Spec</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>QTM</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty <br>Iss</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty <br>Ret</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Balance<br>(qtm+ ret -woqty)</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Unit<br>RM Price</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Balance<br>Cost</b></td>
             <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Conversion Cost<br>(In Rs.)</b></td>
        </tr> ';


$conversionrate=0;

        $convert_array=array(55,54,54,53,56,56,55,56,56,56,56,55);

        $total_issued_cost = 0;
        $total_balance_cost = 0;
        $total_balance_cost_rupee = 0;
        $total_balance_cost_dollar = 0;
        $total_balance_cost_null = 0;
        $total_conversion=0;
        $result = $newreport->get_stockbygrn4dir4bo_exp($cond);
        while ($myrow = mysql_fetch_row($result)) {
	    if($myrow[1] != '0000-00-00' && $myrow[1] != '' && $myrow[1] != 'NULL')
            {
                $datearr = split('-', $myrow[1]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $recddate=date("M j, Y",$x);
            }
            else
            {
               $recddate = '';
            }

            $datecheck=split('-',$myrow[1]);
        $d=$datecheck[2];
        $m=$datecheck[1];
        $y=$datecheck[0];
        //echo "HERE1----$m---$y---<br>";
        if(($m>='04' && $y=='2012')||(($m>='01'&&$m<='03') && $y=='2013'))
        {
           $ind=$m;
          //echo "HERE----$ind---$y---<br>";
          $conversionrate=$convert_array[$ind-1];
          //echo "HERE44---$conversionrate----$m---$y---<br>";

        }else if(($m>='04' && $y=='2011')||(($m>='01' && $m<='03') && $y=='2012'))
        {
          $conversionrate=48.3;
          //echo "HERE48---$conversionrate----$m---$y---<br>";
        }else if(($m>='04' && $y=='2010')||(($m>='01' && $m<='03') && $y=='2011'))
        {
           $conversionrate=46.25;
        }
        else if(($m>='04' && $y=='2009')||(($m>='01' && $m<='03') && $y=='2010'))
        {
           $conversionrate=48.38;
        }  else
        {
           $conversionrate=45;
        }

            $balance = 0;

            $woqtyres = $newreport->get_woqty_new4bo($myrow[0],$condw);
            $woqtyrow = mysql_fetch_row($woqtyres);
            $woqty = $woqtyrow[1];
            $woretqtyres = $newreport->get_woretqty_new4bo($myrow[0],$condw);
            $woretqtyrow = mysql_fetch_row($woretqtyres);
            $woretqty = $woretqtyrow[1];

            $balance = 0;

            $balance = $myrow[4] - $woqty + $woretqty ;
           /* $result4rmprice = $newreport->getrmprice($myrow[5]);
            $myrow4rmprice = mysql_fetch_row($result4rmprice); */
            $currency = array("$");
            $rm_price = str_replace($currency, "", $myrow[9]);
            if($myrow[11]!=0 && $myrow[11] !="")
            {
              $rmprice = ($rm_price/$myrow[11]);
            } else
            {
             $rmprice = ($rm_price);
            }

           //echo $rm_price."---***----".$myrow[11]."<br>";
            $currency = $myrow[10];
            if($currency == '$')
            {
              $total_balance_cost_dollar += ($balance*$rmprice);
            }
            else if($currency == 'Rs')
            {
              $total_balance_cost_rupee += ($balance*$rmprice);
            }
            else if($currency == '')
            {
              $total_balance_cost_null += ($balance*$rmprice);
            }
            $total_conversion+=($balance*$rmprice*$conversionrate);
           // echo $balance."---**--";
          if ($balance > 0) {
          $data .='<tr>';
              $data .='<td bgcolor="#FFFFFF" align="center"><span class="tabletext">'. $myrow[0] .'</td>';
              $data .='<td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$recddate.'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[2].'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[3].'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[5].'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[4].'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$woqty.'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$woretqty.'</td>';
		       $total_issued_cost += $myrow[7] * $rmprice;
		       $total_balance_cost += ($balance*$rmprice);
             if ($balance < 0)
             {
                $data .='<td bgcolor="#FF0000" align="center"><span class="tabletext">'.$balance.'</td>';
             }
             else
             {
                 $data .='<td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$balance.'</td>';
             }
              $balprice=number_format(($balance*$rmprice),2,'.',',');
              $converted_price= number_format(($balance*$rmprice*$conversionrate),2,'.',',');
              $data .='<td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$currency.''. $rmprice.'</td>';
              $data .='<td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$currency.''. $balprice.'</td>';
              $data .='<td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$converted_price.'</td>';
		    }
          }

$data .='</td></tr>
<tr>
<td bgcolor="#FFFFFF" colspan=11 align="right"><span class="heading"><b>Total(Rs)</b></td>

<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">Rs'.$total_balance_cost_rupee.' </td>
<tr>
<td bgcolor="#FFFFFF" colspan=11 align="right"><span class="heading"><b>Total($)</b></td>
<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">$'.$total_balance_cost_dollar.'</td>
<tr>
<td bgcolor="#FFFFFF" colspan=11 align="right"><span class="heading"><b>Total(Null)</b></td>
<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">'. $total_balance_cost_null.'</td>

</td></tr>
<tr>
<td bgcolor="#FFFFFF" colspan=11 align="right"><span class="heading"><b>Total(Conversion)</b></td>

<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">Rs.'.number_format(($total_conversion),2,'.',',').'</td>

</td></tr>
</table> ';
header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=stockbogrn_export.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
