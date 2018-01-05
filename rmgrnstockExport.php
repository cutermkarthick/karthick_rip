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

$newlogin = new userlogin;
$newlogin->dbconnect();


include('classes/reportClass.php');
include('classes/displayClass.php');
$newreport = new report;
$newdisplay = new display;
$header='';
$data='';
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
$title="GRN REPORT EXPORT";
$data.='<table border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" rules="all">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=6 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="2" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';

$crn=$_REQUEST['crn'];
$fdate=$_REQUEST['fdate'];
$tdate=$_REQUEST['tdate'];

$rm_mat_type=$_REQUEST['rm_mat_type'];
$barplate=$_REQUEST['barplate'];


$cond1 = "grn.raw_mat_type like '".$rm_mat_type."%'";
$cond3 = "rm.rm_bars_plates like '".$barplate."%'";

if ( $crn!='' )
{

       $cond2 = "grn.crn like '" . $crn ."%'" ;
}else
{
      $cond2 = "grn.crn like '%'" ;
}

  //echo $cond5;
$cond=$cond1 . ' and ' . $cond2 . ' and ' . $cond3;  //$cond,$offset,$rowsPerPage
//echo $cond;
$data.='<table align="center" width="770px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td>
<table  width="870px" border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
         <td width="100px" bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN</b></td>
         <td width="250px" bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Type</b></td>
         <td width="60px" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Balance</b></td>
	     <td width="60px" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Rate</b></td>
         <td width="200px" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Value</b></td>
         <td width="200px" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Conversion<br>Value</b></td>
        </tr>
        </table>
<table width="870px" border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >';

$total_dollar_cost=0;  $total_dollar_cost_others=0;  $total_print=0;  $rmpo_qty_tot=0;  $pricetoprint_tot=0;
$prev_rmtype="#";
$typearr=array("aluminium","titanium","bronze","steel","Others");
//for($i=0;$i<count($typearr);$i++)
//{
$resultall = $newreport->getoverallstock4rm($cond,$typearr[$i]);
        while($myrowall = mysql_fetch_row($resultall))
        {
          $total_print+=($myrowall[1]*$myrowall[3]);
          $total_print_convert+=($myrowall[1]*$myrowall[3]*50);
          $price=number_format(($myrowall[1]*$myrowall[3]),2,'.',',');
          $print_convert=number_format(($myrowall[1]*$myrowall[3]*50),2,'.',',');
          $rate=number_format(($myrowall[1]),2,'.',',');
          $data.='<tr><td width="100px" bgcolor="#FFFFFF" ><span class="tabletext">'.$myrowall[4].'</td>';
          $data.='<td width="250px" bgcolor="#FFFFFF" ><span class="tabletext">'.$myrowall[0].'-'.$myrowall[2].'</td>';
          $data.='<td width="60px" align="right" bgcolor="#FFFFFF" ><span class="tabletext">'.$myrowall[3].'</td>';
		  $data.='<td width="60px" align="right" bgcolor="#FFFFFF" ><span class="tabletext">'.$rate.'</td>';
          $data.='<td bgcolor="#FFFFFF" align="right" width="200px" ><span class="tabletext">$'.$price.'</td>';
          $data.='<td bgcolor="#FFFFFF" align="right" width="200px" ><span class="tabletext">$'.$print_convert.'</td>';
          $prev_rmtype=$myrowall[0];
       }
         $tot_price= number_format($total_print,2,'.',',');
         $tot_convert=number_format($total_print_convert,2,'.',',')  ;
         $data.='<tr><td  colspan=4 bgcolor="#FFFFFF"><span class="labeltext">Total:</span></td>';
         $data.='<td bgcolor="#FFFFFF" align="right" width="250px" ><span class="tabletext">$'.$tot_price.'</td>';
         $data.='<td bgcolor="#FFFFFF" align="right"  ><span class="tabletext">Rs'. $tot_convert.'</td>';

$data.='</table>
</div>
</td></tr>
</table>

</td>
</tr></table>
</form>
</body>
</html>';

header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=grnrmstock_export.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
