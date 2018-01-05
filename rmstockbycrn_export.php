<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 19, 2008                =
// Filename: crn_status.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Displays WO Status report                   =
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


include_once('classes/loginClass.php');
include('classes/reportClass.php');

$newreport = new report;
$newlogin = new userlogin;
$newlogin->dbconnect();

$header='';
$data='';
$username=$_SESSION['username'];
$str='';

$crn=$_REQUEST['crnnum'];
$fdate=$_REQUEST['fdate'];
$tdate=$_REQUEST['tdate'];

$rm_mat_type=$_REQUEST['raw_mat_type'];
$barplate=$_REQUEST['barplate'];


$cond1 = "grn.raw_mat_type like '".$rm_mat_type."%'";
//$cond3 = "rm.rm_bars_plates like '".$barplate."%'";
//echo $crn."--*--";
if ( $crn!='' )
{

       $cond2 = "grn.crn like '" . $crn ."%'" ;
}else
{
      $cond2 = "grn.crn like '%'" ;
}
if($fdate!='' && $tdate!= '')
{
if ( $fdate!=''  )
     {
          $date1 = $fdate;
          $cond31 = "to_days(grn.recieved_date) " . ">= to_days('" . $date1 . "')";
          $condw1 = "to_days(w.book_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(grn.recieved_date)-to_days('1582-01-01') > 0 || grn.recieved_date = 'NULL' || grn.recieved_date = '0000-00-00')";
          $condw1 = "(to_days(w.book_date)-to_days('1582-01-01') > 0 || w.book_date = 'NULL' ||w.book_date = '0000-00-00')";

     }

     if ($tdate!= '')
     {
          $date2 = $tdate;
          $cond32 = "to_days(grn.recieved_date) " . "<= to_days('" . $date2 . "')";
          $condw2 = "to_days(w.book_date) " . "<= to_days('" . $date2 . "')";

     }
     else
     {
          $cond32 = "(to_days(grn.recieved_date)-to_days('2050-12-31') < 0 || grn.recieved_date = 'NULL'
                       || grn.recieved_date = '0000-00-00')";
          $condw2 = "(to_days(w.book_date)-to_days('2050-12-31') < 0 || w.book_date = 'NULL'
                       || w.book_date = '0000-00-00')";
     }
     $cond3 = $cond31 . ' and ' . $cond32;
     $condw = $condw1 . ' and ' . $condw2;
}else
{

  $cond3 = "(to_days(grn.recieved_date)-to_days('1582-01-01') > 0 ||
                    grn.recieved_date = '0000-00-00' ||
                    grn.recieved_date = 'NULL' ) and
           (to_days(grn.recieved_date)-to_days('2050-12-31') < 0 ||
                    grn.recieved_date = '0000-00-00' ||
                    grn.recieved_date = 'NULL')";
  $condw = "(to_days(w.book_date)-to_days('1582-01-01') > 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL' ) and
           (to_days(w.book_date)-to_days('2050-12-31') < 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL')";
}
  //echo $cond5;
$cond=$cond1 . ' and ' . $cond2 . ' and ' . $cond3;  //$cond,$offset,$rowsPerPage
//echo $cond;

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
$title="RM Stock By CRN - Exported on  ".$cur_date;
$data.='<table border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=8 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="3" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';
$data.='
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
           <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN</b></td>
            <td width="7%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Type</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>QTM</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty <br>Iss</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty <br>Ret</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Balance<br>(qtm+ ret -woqty)</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Balance<br>Cost</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Conversion Cost<br>(In Rs.)</b></td>
        </tr>';

   $conversionrate=0;
   $convert_array=array(55,54,54,53,56,56,55,56,56,56,56,55);
   $total_issued_cost = 0;
   $total_balance_cost = 0;
   $total_balance_cost_rupee = 0;
   $total_balance_cost_dollar = 0;
   $total_balance_cost_null = 0;
   $total_conversion=0;
   $crn_issued_cost = 0;
   $crn_balance = 0;
   $crn_balance_cost = 0;
   $crn_balance_cost_rupee = 0;
   $crn_balance_cost_dollar = 0;
   $crn_conversion=0;
   $qtm = 0;
   $qtyiss = 0;
   $qtyret = 0;
   $ft = 0;
   $prevcrn = '';
   $result = $newreport->get_rmstockbycrn_export($cond);
   $rm_type='';

   while ($myrow = mysql_fetch_row($result))
   {
      $rm_type=$myrow[2];
	  if ($ft == 0)
	  {
		  $prevcrn = $myrow[5];
	  }

      if ($myrow[5] != $prevcrn && $ft == 1)
      {
              $crnbalcst=number_format(($crn_balance_cost_dollar),2,'.',',') ;
              $crnbalcstconvert=number_format(($crn_conversion),2,'.',',');

            if ($crn_balance > 0)
	     {
              $data.='<tr>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$prevcrn.'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[2].'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$qtm.'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$qtyiss.'</td>
                     <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$qtyret.'</td>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$crn_balance.'</td>
            <td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$currency.' '.$crnbalcst.'</td>
             <td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$crnbalcstconvert.'</td>';
	      }
		  $prevcrn = $myrow[5];
          $crn_balance_cost = 0;
          $crn_balance_cost_rupee = 0;
          $crn_balance_cost_dollar = 0;
          $crn_balance = 0;
		  $crn_conversion=0;
		  $qtm = 0;
          $qtyiss = 0;
          $qtyret = 0;
      }
      //else
     // {
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

            }
			else if(($m>='04' && $y=='2011')||(($m>='01' && $m<='03') && $y=='2012'))
            {
               $conversionrate=48.3;
               //echo "HERE48---$conversionrate----$m---$y---<br>";
            }
			else if(($m>='04' && $y=='2010')||(($m>='01' && $m<='03') && $y=='2011'))
           {
               $conversionrate=46.25;
           }
           else if(($m>='04' && $y=='2009')||(($m>='01' && $m<='03') && $y=='2010'))
           {
             $conversionrate=48.38;
           }
		   else
           {
            $conversionrate=45;
           }

            $balance = 0;

            $woqtyres = $newreport->get_woqty_new($myrow[0],$condw);
            $woqtyrow = mysql_fetch_row($woqtyres);
            $woqty = $woqtyrow[1];
            $woretqtyres = $newreport->get_woretqty_new($myrow[0],$condw);
            $woretqtyrow = mysql_fetch_row($woretqtyres);
            $woretqty = $woretqtyrow[1];

            $balance = 0;
            $qtm += $myrow[4];
			$qtyiss += $myrow[7];
			$qtyret += $woretqty;
            $balance = $myrow[4] - $woqty + $woretqty ;
			$crn_balance += $balance;
            $currency = array("$");
            $rm_price = str_replace($currency, "", $myrow[9]);
            if($myrow[11]!=0 && $myrow[11] !="")
            {
              $rmprice = ($rm_price/$myrow[11]);
            }
			else
            {
             $rmprice = ($rm_price);
            }

           //echo $rm_price."---***----".$myrow[11]."<br>";
            $currency = $myrow[10];
            if($currency == '$' || $currency == '')
            {
              $total_balance_cost_dollar += ($balance*$rmprice);
			  $crn_balance_cost_dollar += ($balance*$rmprice);
            }
            else if($currency == 'Rs')
            {
              $total_balance_cost_rupee += ($balance*$rmprice);
			  $crn_balance_cost_rupee += ($balance*$rmprice);
            }
            $total_conversion+=($balance*$rmprice*$conversionrate);
            $crn_conversion+=($balance*$rmprice*$conversionrate);
      // }

	   $ft = 1;
   }
         if ($crn_balance > 0)
	     {
              $crnbal_cst=number_format(($crn_balance_cost_dollar),2,'.',',') ;
              $crnbalcst_convert=number_format(($crn_conversion),2,'.',',');
              $data.='<tr>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$prevcrn.'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$rm_type.'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$qtm.'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$qtyiss.'</td>
                     <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$qtyret.'</td>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$crn_balance.'</td>
            <td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$currency.' '.$crnbal_cst.'</td>
             <td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$crnbalcst_convert.'</td>';
	      }

$total_cstre=number_format(($total_balance_cost_rupee),2,'.',',');
$total_cstd=number_format(($total_balance_cost_dollar),2,'.',',');
$toal_cstn=number_format(($total_balance_cost_null),2,'.',',');
$toal_cstconversion=number_format(($total_conversion),2,'.',',');
$data .='</td></tr>
<tr>
<td bgcolor="#FFFFFF" colspan=7 align="right"><span class="heading"><b>Total(Rs)</b></td>
<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">Rs'.$total_cstre.'</td>;
<tr>
<td bgcolor="#FFFFFF" colspan=7 align="right"><span class="heading"><b>Total($)</b></td>
<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">$'.$total_cstd.'</td>
<tr>
<td bgcolor="#FFFFFF" colspan=7 align="right"><span class="heading"><b>Total(Null)</b></td>
<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext"> '.$toal_cstn.'</td>
</td></tr>
<tr>
<td bgcolor="#FFFFFF" colspan=7 align="right"><span class="heading"><b>Total(Conversion)</b></td>
<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">Rs'.$toal_cstconversion.'</td>

</td></tr>
</table> ';
$data .='</td>
<br>
</table>
</td>
</tr></table>
</form>
</body>
</html>';

header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=rmstockbycrnexp.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
