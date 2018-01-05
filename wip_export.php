<?php
// First include the class definition
include_once('classes/reportClass.php');

$newreport = new report;
$crn=$_REQUEST['crn'];

$header='';
$data='';
$username=$_SESSION['username'];
$str='';

$crnnum=trim($_REQUEST['crnnum']);
$grnnum=trim($_REQUEST['grnnum']);
$wonum=trim($_REQUEST['wonum']);
//echo $crnnum;
 $cond0 = "w.crn_num  like '".$crnnum."%'";
 $cond1 = "w.grnnum  like '".$grnnum."%'";
 $cond2 = "w.wonum  like '".$wonum."%'";

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2;
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
$title="WIP Stock Report";
$data.='<body>';
$data.='<table border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" rules="all">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=8 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="2" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';

$data.='<html>
<head>
<title>WIP Stock</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<table width=850px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  >
        <tr>
		  <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>GRN No</b></td>
            <td width="7%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN #</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>WO No</b></td>
             <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty</b></td>
            <td width="7%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Unit Sales Price</b></td>
            <td width="7%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Sales Cost</b></td>
			 <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Unit RM Price</b></td>
            <td width="7%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Cost</b></td>
        </tr> ';

		$total_dollar_unit_cost=0;
		$total_dollar_rm_cost=0;
		$total_rupee_unit_cost=0;
		$total_rupee_rm_cost=0;
		$total_without_unit_cost=0;
		$total_without_rm_cost=0;

        $result = $newreport->getworkinprogress_exp($cond);
        while ($myrow = mysql_fetch_row($result)) {
			$curr=$myrow[8];
			if($curr == '$'){
                $total_dollar_unit_cost += $myrow[5];
                $total_dollar_rm_cost += $myrow[7]*45;
			}
			else if($curr == 'Rs'){
				 $total_rupee_unit_cost += $myrow[5];
				 $total_rupee_rm_cost += $myrow[7];
			}
			else if($curr == ''){
				 $total_without_unit_cost += $myrow[5];
				 $total_without_rm_cost += ($myrow[7]*45);
			}
            $rmcost=number_format(($myrow[7]*45),2,'.',',');
            $data.='<tr><td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[0].'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[1].'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[2].'</td>
					<td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[3].'</td>
					<td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$myrow[8].''.$myrow[4].'</td>
 	     	        <td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$myrow[8].''.$myrow[5].'</td>
                   <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[8].''.$myrow[6].'</td>
		            <td bgcolor="#FFFFFF" align="right"><span class="tabletext">Rs '.$rmcost.'</td>';


}
$tot_dol_cost=number_format($total_dollar_unit_cost,2,'.',',');
$tot_dollar_rm_cost=number_format($total_dollar_rm_cost,2,'.',',');
$tot_rupee_unit_cost=number_format($total_rupee_unit_cost,2,'.',',');
$tot_rupee_rm_cost=number_format($total_rupee_rm_cost,2,'.',',');
$tot_without_unit_cost=number_format($total_without_unit_cost,2,'.',',');
$tot_without_rm_cost=number_format($total_without_rm_cost,2,'.',',');
$data.='</td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan="5" align="right" class="labeltext">Total Cost($)</td>
<td colspan="1" align="right" class="tabletext">$'.$tot_dol_cost.'</td>
<td colspan="1" align="right" class="labeltext">&nbsp;</td>
<td colspan="1" align="right" class="tabletext">Rs'.$tot_dollar_rm_cost.'</td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan="5" align="right" class="labeltext">Total Cost(Rs)</td>
<td colspan="1" align="right" class="tabletext">Rs'.$tot_rupee_unit_cost.'</td>
<td colspan="1" align="right" class="labeltext">&nbsp;</td>
<td colspan="1" align="right" class="tabletext">Rs'.$tot_rupee_rm_cost.'</td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan="5" align="right" class="labeltext">Total Cost(null)</td>
<td colspan="1" align="right" class="tabletext">'.$tot_without_unit_cost.'</td>
<td colspan="1" align="right" class="labeltext">&nbsp;</td>
<td colspan="1" align="right" class="tabletext">Rs'.$tot_without_rm_cost.'</td>
</tr>
</table>';
$data .='</td></tr>
</td></tr>
</table> ';
header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=wipstock_export.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
