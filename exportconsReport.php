<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
include_once('classes/userClass.php');
include_once('classes/reportClass.php');
include_once('classes/displayClass.php');
include_once('classes/consumptionClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newconsumption = new report;
$newdisplay = new display;
$newconsumption = new consumption;


$crn_num=$_REQUEST['crn_num'];
$invnum=$_REQUEST['invnum'];
$fdate=$_REQUEST['fdate'];
$tdate=$_REQUEST['tdate'];
$bond_num=$_REQUEST['bond_num'];
$be_num=$_REQUEST['be_num'];
$rmtype=$_REQUEST['rmtype'];
$rmspec=$_REQUEST['rmspec'];
$grn=$_REQUEST['grn'];
$status=$_REQUEST['status'];
$cond0 = "g.crn like '".$crn_num."%'";
$cond1 = "g.invoice_num like '".$invnum."%'";
$cond7 = "g.grnnum like '".$grn."%'";
if($status=='All')
{
$cond8 = "g.status like '%'";
}
else if($status=='Open')
{
 $cond8 = "(g.status = '" . $status . "' || g.status is NULL ||g.status = '')";
}
else
{
 $cond8 = "g.status like '".$status."%'";
}

//echo $bond_num."-----------------".$be_num;
if($bond_num=='')
{
 $cond2 = "(bond_num like '%' || bond_num is null)";
}else
{ //echo "HERE---2222--";
 $cond2 = "bond_num like '".$bond_num."%'" ;
}if($be_num=='')
{
  $cond3 = "(be_num like '%' || be_num is null)";
}else
{ // echo "HERE-----";
 $cond3 = "be_num like '".$be_num."%'" ;
}
if($rmtype=='')
{
 $cond6 = "(rmtype like '%' || rmtype is null)";
}else
{ //echo "HERE---2222--";
 $cond6 = "rmtype like '".$rmtype."%'" ;
}if($rmspec=='')
{
  $cond5 = "(description like '%' || description is null)";
}else
{ // echo "HERE-----";
 $cond5 = "description like '".$rmspec."%'" ;
}






if ( $fdate!=''  || $tdate!='' )
{

     if ( $fdate!='' )
     {
          $date1 = $fdate;
          $cond01 = "to_days(grn_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond01 = "(to_days(grn_date)-to_days('1582-01-01') > 0 || grn_date is NULL || grn_date = '0000-00-00')";
     }

     if ( $tdate!='')
     {
          $date2 = $tdate;
          $cond02 = "to_days(grn_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond02 = "(to_days(grn_date)-to_days('2050-12-31') < 0 || grn_date is NULL || grn_date = '0000-00-00')";
     }
     $cond4 = $cond01 . ' and ' . $cond02;

}
else
{
    $cond4 = "(to_days(g.recieved_date)-to_days('1582-01-01') > 0 ||
                    g.recieved_date= '0000-00-00' ||
                    g.recieved_date = 'NULL') and
          (to_days(g.recieved_date)-to_days('2050-12-31') < 0 ||
                   g.recieved_date = '0000-00-00' ||
                 g.recieved_date = 'NULL')";

}

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond4 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond5 . ' and ' . $cond6 . ' and ' . $cond7 . ' and ' . $cond8;
//echo $cond."----fcond";
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
	if($fdate !='')
	{
 $fromdate=$fdate;
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
	if($tdate !='')
	{
 $todate = $tdate;
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

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond4 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond5 . ' and ' . $cond6 . ' and ' . $cond7 . ' and ' . $cond8;

$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];

// echo $cond;
// how many rows to show per page


 //echo $offset;

if($dfdate=='' && $dtdate=='')
{
 $title="Consumption Report";
}
else if($dfdate!='' && $dtdate=='')
{
 $title="Consumption Report From ".$dfdate ." To Till Date ";
}
else
{
 $title="Consumption Report From ".$dfdate ." To ". $dtdate;
}

$data.='<table border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" rules="all">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=27 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="2" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';

		$data.='<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" rules="all">

        <tr>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>BOND #</b></td>
		   <td  bgcolor="#EEEFEE"><span class="tabletext"><b>BOND <br>Dt</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>BE #</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>BE<br>Dt</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Assess.<br>Value</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>CIF<br>Value</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Duty<br>Amount</b></td>
		    <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Invoice #</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Inv Dt</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Inv Amt</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Export<br>Invoice #</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Supplier</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>GRN #</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>GRN Dt</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Parent<br>GRN #</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PRN #</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>RM Spec</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>RM Type</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>UOM</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Qty <br>GRN</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Qty <br>Recd</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Qty <br>Rej</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc #</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc<br>Qty</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Bal<br>Qty</b></td>
        </tr>';



$prevgrnnum="#";  $closingbal=0; $prev_grn='#';
             $result=$newconsumption->getgrndets4export($cond);
             $close_bal=0; $qty_recd=0;$qty_cons=0;$wastage=0;
            while ($myrow = mysql_fetch_array($result))
			{
                    $rmspec= wordwrap($myrow["description"],20,"<br>\n");
					$supplier = wordwrap($myrow['company'],20,"<br>\n");
                    if($myrow['grn_date'] != '0000-00-00' && $myrow['grn_date'] != 'NULL' && $myrow['grn_date'] != '')
                    {
                     $datearr = split('-', $myrow['grn_date']);
                     $d=$datearr[2];
                     $m=$datearr[1];
                     $y=$datearr[0];
                     $x=mktime(0,0,0,$m,$d,$y);
                     $gdate=date("M j, Y",$x);
                     }
                     else
                     {
                     $gdate = '';
                     }

                     if($myrow['invoice_date'] != '0000-00-00' && $myrow['invoice_date'] != 'NULL' && $myrow['invoice_date'] != '')
                    {
                     $datearr = split('-', $myrow['invoice_date']);
                     $d=$datearr[2];
                     $m=$datearr[1];
                     $y=$datearr[0];
                     $x=mktime(0,0,0,$m,$d,$y);
                     $idate=date("M j, Y",$x);
                     }
                     else
                     {
                     $idate = '';
                     }
                    //echo $prevgrnnum."----111----".$myrow[2]."----------<br>";
                    if($prevgrnnum!=$myrow['grnnum'])
                    {
						$prevgrnnum=$myrow['grnnum'];
                        $close_bal=$myrow['qty_recd']-($myrow['qty_cons']+$myrow['qty_rej']);
                        $closingbal=$close_bal;
                        //echo $close_bal."----in----<br>";

                    }
					else
                    {//echo $closingbal."----222----".$close_bal."----------$myrow[7]<br>";
                      $closingbal= $closingbal-$myrow['qty_cons'];
                    }
                     //echo $closingbal."----1222----".$close_bal;
    	$data.='<tr  bgcolor="#FFFFFF">';
	if ($myrow['bond_num'] != '')
	{

     $data.=' <td bgcolor="#FFCC00"><span class="tabletext">'.$myrow['bond_num'].'</a></td>
      <td><span class="tabletext">'.$myrow['bonddate'].'</td>';


    }
	else
	{

       $data.=' <td><span class="tabletext">&nbsp</td>
      <td><span class="tabletext">&nbsp</td>';

	}
	if ($myrow['be_num'] != '')
	{

      $data.='<td bgcolor="00FF00"><span class="tabletext">'.$myrow['be_num'].'</a></td>
      <td><span class="tabletext">'.$myrow['bedate'].'</td>';


    }
	else
	{

      $data.='<td><span class="tabletext">&nbsp</td>
      <td><span class="tabletext">&nbsp</td>';

	}
                       $data.='<td><span class="tabletext">'. $myrow['assessval'] .'</td>
						<td><span class="tabletext">'. $myrow['cifval'] .'</td>
                        <td><span class="tabletext">'.$myrow['dutyamt'].'</td>';
                       if($prev_grn!=$myrow['grnnum'])
                       {
		                $data.='<td bgcolor="#00DDFF"><span class="tabletext">
					    '. $myrow['invoice_num'].'</a></td>
					    <td><span class="tabletext">'.$myrow['invoice_date'].'</td>
						<td><span class="tabletext">'. $myrow['currency']." ".$myrow['invamt'].'</td>
						<td><span class="tabletext">'. $myrow['expinvnum'] .'</td>
                        <td><span class="tabletext">'. $supplier .'</td>
                        <td><span class="tabletext">'. $myrow['grnnum'] .'</td>
                        <td><span class="tabletext">'. $myrow['grn_date'].'</td>
                        <td><span class="tabletext">'. $myrow['parentgrnnum'].'</td>
                        <td><span class="tabletext">'. $myrow['crn'].'</td>
                        <td><span class="tabletext">'. $rmspec .'</td>
                        <td><span class="tabletext">'. $myrow['rmtype'] .'</td>
		                <td><span class="tabletext">'. $myrow['uom'].'</td>
		                <td><span class="tabletext">'. number_format($myrow['qty'] ,2) .'</td>
                        <td><span class="tabletext">'. $myrow['qty_recd'] .'</td>
                        <td><span class="tabletext">'. $myrow['qty_rej'] .'</td>
                        <td><span class="tabletext">'. $myrow['cofc_num'] .'</td>
                        <td><span class="tabletext">'. $myrow['qty_cons'] .'</td>
                        <td><span class="tabletext">'. $closingbal .'</td>';
                        $prev_grn=$myrow['grnnum'];
                       }else
                       {
                         $data.='
		                <td bgcolor="#00DDFF"><span class="tabletext">
					    &nbsp;</a></td>
					    <td><span class="tabletext">&nbsp;</td>
						<td><span class="tabletext">&nbsp;</td>
                        <td><span class="tabletext">'. $myrow['expinvnum'] .'</td>
                        <td><span class="tabletext">&nbsp;</td>
                        <td><span class="tabletext">&nbsp;</td>
                        <td><span class="tabletext">&nbsp;</td>
                        <td><span class="tabletext">&nbsp;</td>
                        <td><span class="tabletext">&nbsp;</td>
                        <td><span class="tabletext">&nbsp;</td>
                        <td><span class="tabletext">&nbsp;</td>
		                <td><span class="tabletext">&nbsp;</td>
		                <td><span class="tabletext">&nbsp;</td>
                        <td><span class="tabletext">&nbsp;</td>
                        <td><span class="tabletext">&nbsp;</td>
                        <td><span class="tabletext">'. $myrow['cofc_num'] .'</td>
                        <td><span class="tabletext">'. $myrow['qty_cons'] .'</td>
                        <td><span class="tabletext">'. $closingbal .'</td>';
                       
                       }

            $data.='</tr>';

			}


$data.='</table>
      </table>
';

header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment;filename=export_consumption_report.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";

