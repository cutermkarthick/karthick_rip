<?php
// First include the class definition
include_once('classes/reportClass.php');

$newreport = new report;
$crn=$_REQUEST['crn'];

$header='';
$data='';
$username=$_SESSION['username'];
$str='';

$crnnum=trim($_REQUEST['crn']);
//echo $crnnum;
 $cond0 = "wo.crn_num  like '".$crnnum."%'";

$cond = $cond0;
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
$title="FG Stock Report";
$data.='<body>';
$data.='<table border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" rules="all">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=4 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="2" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';

$data.='<html>
<head>
<title>FG Stock</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<table width=850px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  >
        <tr>
            <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN</b></td>
            <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>FG Stock</b></td>
             <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Unit RM Price</b></td>
            <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Cost</b></td>';
            //<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Machine Name</b></td>
            //<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Time Taken <br>To Complete</b></td> -->
        $data.='</tr>
</table>
<table style="table-layout: fixed" width=850px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" > ';
        if($flag==0)
        {
         $total_cost_dollar=0;
         $total_cost_rupee=0;
         $total_r=0;
         $total_d=0;
         $total_cost_nocurr=0;
         $total_n=0;
          $result = $newreport->get_fggoods_totalcost($cond,$crnnum);
        //$temp_result = $result;
         while ($myrow = mysql_fetch_row($result)) {
        //echo $from_row_count;
            $result4rmprice = $newreport->getunit_price4fg($myrow[0]);
            $myrow4rmprice = mysql_fetch_row($result4rmprice);
            if($myrow4rmprice[0] == '')
            {
              $price = 0;
              $currency ='$';
            }
            else
            {
             $price = $myrow4rmprice[0];
             $currency = $myrow4rmprice[1];
            }
           /* if($myrow[3] == '')
            {
              $disp_qty = 0;
            }
            else
            {
              $disp_qty = $myrow[3];
            }*/
            if($currency == '$')
            {
             $total_cost_dollar += (($myrow[2])*$price);
            }
            else if($currency == 'Rs')
            {
             $total_cost_rupee += (($myrow[2])*$price);
             }
           else if($currency == '')
            {
             $total_cost_nocurr += (($myrow[2])*$price);
            }
           }
          $total_d= number_format($total_cost_dollar,2,'.',',');
          $total_r=number_format($total_cost_rupee,2,'.',',');
          $total_n=number_format($total_cost_nocurr,2,'.',',');
        }


        $data .='<tr bgcolor="#FFFFFF"><td colspan=4 align="right"><span class="labeltext">Total Cost(Rs) : Rs '.$total_r .' Total Cost($) : $'. $total_d.' Total Cost() : $'. $total_n.'</td></tr>';


        $result = $newreport->get_fggoods($cond,$crnnum);
        //$temp_result = $result;
        $total_page_cost_dollar=0;
        $total_page_cost_rupee=0;
        $total_page_cost_nocurr=0;
        while ($myrow = mysql_fetch_row($result)) {
        //echo $from_row_count;
            $result4rmprice = $newreport->getunit_price4fg($myrow[0]);
            $myrow4rmprice = mysql_fetch_row($result4rmprice);
            if($myrow4rmprice[0] == '')
            {
              $price = 0;
              $currency ='$';
            }
            else
            {
             $price = $myrow4rmprice[0];
             $currency = $myrow4rmprice[1];
            }

            /*if($myrow[3] == '')
            {
              $disp_qty = 0;
            }
            else
            {
              $disp_qty = $myrow[3];
            }*/
            if($currency == '$')
            {
             $total_page_cost_dollar += (($myrow[2])*$price);
            }
            else if($currency == 'Rs')
            {
             $total_page_cost_rupee += (($myrow[2])*$price);
            }
            else if($currency == '')
            {
             $total_page_cost_nocurr += (($myrow[2])*$price);
            }
           // echo $myrow[0]."--**--".$myrow[2]."<br>";
            $data .='<tr><td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[0].'</td>';
            $data .='<td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[2].'</td>';
            $data .='<td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$currency.''.$price.'</td>';
            $data .='<td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$currency.''.(($myrow[2])*$price).'</td>';
           /* printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%.2f</td>',

                      $myrow[4],
                      $myrow[3]); */

          }
$to_pagecnt=number_format($total_page_cost_rupee,2,'.',',') ;
$tot_page_dol_cst=number_format($total_page_cost_dollar,2,'.',',');
$tot_page_nc_cst=number_format($total_page_cost_nocurr,2,'.',',');
$data .='</td></tr>
<tr>
<td bgcolor="#FFFFFF" colspan=3 align="right"><span class="heading"><b>Total</b></td>
<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">Rs'.$to_pagecnt.'</td>
<tr>
<td bgcolor="#FFFFFF" colspan=3 align="right"><span class="heading"><b>Total</b></td>
<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">$'.$tot_page_dol_cst.' </td>
<tr>
<td bgcolor="#FFFFFF" colspan=3 align="right"><span class="heading"><b>Total</b></td>
<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">$'.$tot_page_nc_cst.' </td>
</td></tr>
</table> ';
header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=fgstock_export.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
