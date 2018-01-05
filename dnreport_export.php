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
$company=trim($_REQUEST['company']);
//echo $company;
 $cond0 = "d.crn  like '".$crnnum."%'";
 $cond1 = " d.sent_treat_to like '" . $company."%'";

$cond = $cond0 . ' and ' . $cond1;
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
$title="DN Stock Report";
$data.='<body>';
$data.='<table border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" rules="all">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=9 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="2" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';

$data.='<html>
<head>
<title>DN Stock</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<table width=850px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  >
        <tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Sl.No</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>DN #.</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>DN Date</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>WO#</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Part No.(after treatment)</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>SP PO#</b></td>
	    <td  bgcolor="#EEEFEE"><span class="tabletext"><b>DN Qty</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Unreturned Qty</b></td>
        </tr> ';


    $result = $newreport->getdeliverDetails_exp($cond);

            while ($myrow = mysql_fetch_row($result)) {
              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
                $datearr = split('-', $myrow[2]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $deliver_date=date("M j, Y",$x);
	          }
	      else
              {
                $deliver_date="";
	      }
              $dnqty=$myrow[6] ? $myrow[6] : 0;
              $dliqty_recd=$myrow[7] ? $myrow[7] : 0;

              $unretured_qty = $dnqty-$dliqty_recd;

   	       $data .='<tr bgcolor="#FFFFFF">
                        <td><span class="tabletext">'.$myrow[0].'</td>
                        <td><span class="tabletext">'.$myrow[1].'</td>
                        <td><span class="tabletext">'.$deliver_date.'</td>
                        <td><span class="tabletext">'.$myrow[3].'</td>
                         <td><span class="tabletext">'.$myrow[9].'</td>
                        <td><span class="tabletext">'.$myrow[4].'</td>
                        <td><span class="tabletext">'.$myrow[5].'</td>
                        <td><span class="tabletext">'.$myrow[6].'</td>
                        <td><span class="tabletext">'.$unretured_qty.'</td>
</td></tr>';

        }
$data.='
</table>';
$data .='</td></tr>
</table> ';
header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=dnstock_export.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";

