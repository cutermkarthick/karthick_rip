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

// For paging - Added on Dec 6,04

// how many rows to show per page
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
$title="WIP REPORT EXPORT";
$data.='<table border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" rules="all">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=7 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="2" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';

$machine=$_REQUEST['machine'];

if ( isset ($machine) )
{

     if ($machine == 'All') {
     //echo "HERE---111--";
         $final_mcname = "like '%" . "'";
     }
     else {
     //echo "HERE---222--";
         $final_mcname = "='" . $machine . "'";
     }

     $cond = "op.mc_name ". $final_mcname;

}

$data .='<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN </b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>QTY</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>WONUM</b></td>
            <td width="15%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Machine Name </b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Estimated Time</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Actual Time</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Hours Balance</b></td>
        </tr> ';

        $result = $newreport->getwipdets($cond);
        while ($myrow = mysql_fetch_row($result))
        {      $esti_time=($myrow[4]);
               $act_time=($myrow[3]);
               $hour_balance=$esti_time-$act_time;
               if($hour_balance<0)
               {
                 $color='#FF0000';
               }else
               {
                 $color='#FFFFFF';
               }
               $hbalance=number_format(($hour_balance),2,'.',',');

              $data .='<tr><td bgcolor="#FFFFFF" ><span class="tabletext">'.$myrow[0].'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[2].'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[1].'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[5].'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$esti_time.'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$act_time.'</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$hour_balance.'</td>';

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
header("Content-Disposition: attachment; filename=wiptimereportexport.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
