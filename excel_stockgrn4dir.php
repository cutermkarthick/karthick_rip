<?php
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

$newlogin = new userlogin;
$newlogin->dbconnect();
$months=array( 'Jan','Feb','Mar','Aprl','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec' );

$cond=$_REQUEST['cond'];
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


include('classes/reportClass.php');
$newreport = new report;

$rowsPerPage = 10000;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
	//echo "i am set";
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

$cond1 = "grn.raw_mat_spec like '%'";
$cond2 = "grn.raw_mat_type like '%'";
$cond3 = "(to_days(grn.recieved_date)-to_days('1582-01-01') > 0 ||
                    grn.recieved_date = '0000-00-00' ||
                    grn.recieved_date = 'NULL' ) and
           (to_days(grn.recieved_date)-to_days('2050-12-31') < 0 ||
                    grn.recieved_date = '0000-00-00' ||
                    grn.recieved_date = 'NULL')";
$cond4 = "grn.grnnum like '%'";
$cond5 = "(grn.crn like '%' || grn.crn is NULL)";
//$cond5 = "m.CIM_refnum like '%'";
$cond = $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5;

$oper1='like';
$oper2='like';
$oper3='like';
$oper4='like';

$sess=session_id();
if ( isset ( $_REQUEST['flag'] ) )
{
     $flag = 1;
}
else
{
     $flag = 0;
}
if ( isset ( $_REQUEST['tcd'] ) )
{
     $total_cost_dollar = $_REQUEST['tcd'];
}
else
{
     $total_cost_dollar = 0;
}

if ( isset ( $_REQUEST['tcr'] ) )
{
     $total_cost_rupee = $_REQUEST['tcr'];
}
else
{
     $total_cost_rupee = 0;
}
if ( isset ( $_REQUEST['tcn'] ) )
{
     $total_cost_null = $_REQUEST['tcn'];
}
else
{
     $total_cost_null = 0;
}

if ( isset ( $_REQUEST['scomp'] ) )
{
     $company_match = $_REQUEST['scomp'];
     $scomp = "'" . $_REQUEST['scomp'] . "%'";
     $cond1 = "grn.raw_mat_spec like " . $scomp;

}
else {
     $company_match = '';
}

if ( isset ( $_REQUEST['swonum'] ) )
{
     $wonum_match = $_REQUEST['swonum'];
     if ( isset ( $_REQUEST['wonum_oper'] ) ) {
          $oper2 = $_REQUEST['wonum_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $swonum = "'" . $_REQUEST['swonum'] . "%" . "'";
     }
     else {
         $swonum = "'" . $_REQUEST['swonum'] . "'";
     }

     $cond2 = "grn.raw_mat_type " . $oper2 . " " . $swonum;

}
else {
     $wonum_match = '';
}

if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond31 = "to_days(grn.recieved_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(grn.recieved_date)-to_days('1582-01-01') > 0 || grn.recieved_date = 'NULL' || grn.recieved_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond32 = "to_days(grn.recieved_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(grn.recieved_date)-to_days('2050-12-31') < 0 || grn.recieved_date = 'NULL'
                       || grn.recieved_date = '0000-00-00')";
     }
     $cond3 = $cond31 . ' and ' . $cond32;

}
else
{
     $date1_match = '';
     $date2_match = '';
}
if ( isset ( $_REQUEST['grn'] ) )
{
     $grn_match = $_REQUEST['grn'];
     if ( isset ( $_REQUEST['grn_oper'] ) ) {
          $oper3 = $_REQUEST['grn_oper'];
     }
     else {
         $oper3 = 'like';
     }
     if ($oper3 == 'like') {
         $grn = "'" . $_REQUEST['grn'] . "%" . "'";
     }
     else {
         $grn = "'" . $_REQUEST['grn'] . "'";
     }

     $cond4 = "grn.grnnum " . $oper3 . " " . $grn;

}
else {
     $grn_match = '';
}

if ( isset ( $_REQUEST['crn'] ) )
{
     $crn_match = $_REQUEST['crn'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper4 = $_REQUEST['crn_oper'];
     }
     else {
         $oper4 = 'like';
     }
     if ($oper4 == 'like') {
         $crn = "'" . $_REQUEST['crn'] . "%" . "'";
     }
     else {
         $crn = "'" . $_REQUEST['crn'] . "'";
     }
     if($crn_match=='')
         $cond5 = "(grn.crn " . $oper4 . " " . $crn ." || grn.crn is null)" ;
     else
         $cond5 = "grn.crn " . $oper4 . " " . $crn ;

}
else {
     $cim_match = '';
}
if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}
if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}

//$cond1 = "c.name like '%'";
$cond = $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5;


$data .= '<table width=60% align="center" cellpadding=2 cellspacing=1 border=1 rules=all>';
$data .= '<tr>';
$data .= '<td colspan=11 align="center"  bgcolor="#F9E05B"><b>Stock(GRN) Status Report';
$data .= $year.'-'.$month;
$data .='; Date: '.date("d-m-Y");
$data .= '</b></td>';
$data .= '</tr>';
$data .= '<tr>';
$data .= '<td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>GRN #</b></td>';
$data .= '<td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Received Date</b></td>';
$data .= '<td width="7%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Type</b></td>';
$data .= '<td width="7%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Spec</b></td>';
$data .= '<td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN</b></td>';
$data .= '<td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty <br>To<br>Make</b></td>';
$data .= '<td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty <br>Iss</b></td>';
$data .= '<td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty<br>Ret</b></td>';
$data .= '<td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Balance<br>(qtm+ret-woqty)</b></td>';
$data .= '<td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Unit<br>RM<br> Price</b></td>';
$data .= '<td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Balance<br>Cost</b></td>';
$data .= '</tr>';

$total_issued_cost = 0;
$total_balance_cost = 0;
$total_balance_cost_rupee = 0;
$total_balance_cost_dollar = 0;
$total_balance_cost_null = 0;
$result = $newreport->get_stockbygrn_excel($cond);
while ($myrow = mysql_fetch_row($result)) {
 if($myrow[1] != '0000-00-00' && $myrow[1] != '' && $myrow[1] != 'NULL')
            {
                $datearr = split('-', $myrow[1]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];                
                $recddate=$months[$m-1].' '.$d.','.$y;
            }
            else
            {
               $recddate = '';
            }
            $woqty = 0;
            $woretqty = 0;

            $woqtyres = $newreport->get_woqty4stock_grn($myrow[0]);
            while($woqtyrow = mysql_fetch_row($woqtyres)){
            
             $woqty += $woqtyrow[1];
             $woretqty += $woqtyrow[2];            
            }

            $balance = 0;
            $balance = $myrow[4] + $woretqty - $woqty;
            $result4rmprice = $newreport->getrmprice($myrow[5]);
            $myrow4rmprice = mysql_fetch_row($result4rmprice);

            $rmprice = $myrow4rmprice[1];
            $currency = $myrow4rmprice[4];
			$rm_spec = wordwrap($myrow[3],15,"\n");
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
			if($myrow[5]!='')
	       {
            $crn=str_pad($myrow[5], 2 , "00",STR_PAD_LEFT);
		   }else
	       {
			  $crn='';
	       }
            if($myrow[6] == 'YES' || $myrow[6] == 'Yes' || $myrow[6] == 'yes' || $myrow[6] == 'Y' || $myrow[6] == 'y')
            {

            $data .= '<tr bgcolor="#FFFFFF">';
            $data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$myrow[0]. '</td>';
            $data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$recddate. '</td>';
			$data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$myrow[2]. '</td>';
			$data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$rm_spec. '</td>';
			$data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$crn. '</td>';
			$data .= '<td bgcolor="#FFFFFF" align="center"><span class="tabletext">' .$myrow[4]. '</td>';
			$data .= '<td bgcolor="#FFFFFF" align="center"><span class="tabletext">' .$woqty. '</td>';
			$data .= '<td bgcolor="#FFFFFF" align="center"><span class="tabletext">' .$woretqty. '</td>';		
			$total_issued_cost += $woqty * $rmprice;
		    $total_balance_cost += ($balance*$rmprice);
			}
		    else
		    {
			$data .= '<tr bgcolor="#FFFFFF">';
            $data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$myrow[0]. '</td>';
            $data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$recddate. '</td>';
			$data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$myrow[2]. '</td>';
			$data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$rm_spec. '</td>';
			$data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$crn. '</td>';
			$data .= '<td bgcolor="#FFFFFF" align="center"><span class="tabletext">' .$myrow[4]. '</td>';
			$data .= '<td bgcolor="#FFFFFF" align="center"><span class="tabletext">' .$woqty. '</td>';
			$data .= '<td bgcolor="#FFFFFF" align="center"><span class="tabletext">' .$woretqty. '</td>';		
            }
            if ($balance < 0)
            {
           $data .= '<td bgcolor="#FFFFFF" align="center"><span class="tabletext">' .$balance. '</td>';
		    }
            else
            {
            $data .= '<td bgcolor="#FFFFFF" align="center"><span class="tabletext">' .$balance. '</td>';
			}
			if($myrow[6] == 'YES' || $myrow[6] == 'Yes' || $myrow[6] == 'yes' || $myrow[6] == 'Y' || $myrow[6] == 'y')
            {
			$data .= '<td bgcolor="#FFFFFF" align="center"><span class="tabletext">' .$currency.' '.$rmprice.'</td>';
            $data .= '<td bgcolor="#FFFFFF" align="right"><span class="tabletext">' .$currency.' '.($balance*$rmprice).'</td>';
			}
            else
            {
            $data .= '<td bgcolor="#FFFFFF" align="center"><span class="tabletext">NA</td>';
            $data .= '<td bgcolor="#FFFFFF" align="right"><span class="tabletext">NA</td>';
			 }
          }
		  $data .= '</td></tr>';
          $data .= '<tr>';
		  $data .= '<td bgcolor="#FFFFFF" colspan=10 align="right"><span class="heading"><b>Total(Rs)</b></td>';
		  $data .= '<td bgcolor="#FFFFFF" align="right"><span class="tabletext">'. 'Rs'.$total_balance_cost_rupee.'</td>';
		  $data .= '<tr>';
          $data .= '<td bgcolor="#FFFFFF" colspan=10 align="right"><span class="heading"><b>Total($)</b></td>';
          $data .= '<td bgcolor="#FFFFFF" align="right"><span class="tabletext">'. '$'.$total_balance_cost_dollar.'</td>';
		  $data .= '<tr>';
$data .= '<td bgcolor="#FFFFFF" colspan=10 align="right"><span class="heading"><b>Total(Null)</b></td>';
$data .= '<td bgcolor="#FFFFFF"><span class="tabletext">'. ' '.$total_balance_cost_null.'</td>';
$data .= '</table>';
header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment;filename=StockGrnReport.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";