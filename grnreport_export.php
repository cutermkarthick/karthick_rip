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
$data.='<td colspan=4 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="2" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';

$company=$_REQUEST['company'];
$fdate=$_REQUEST['fdate'];
$tdate=$_REQUEST['tdate'];

//echo $company."---c---o---";
if($company=='B ')
{
  $company="B & S Alloy";
}
if($company=='')
{ $company='All'  ;

}

if ( $fdate!=''  )
     {
          $date1 = $fdate;
          $cond31 = "to_days(grn.recieved_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(grn.recieved_date)-to_days('1582-01-01') > 0 || grn.recieved_date = 'NULL' || grn.recieved_date = '0000-00-00')";
     }

     if ($tdate!= '')
     {
          $date2 = $tdate;
          $cond32 = "to_days(grn.recieved_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(grn.recieved_date)-to_days('2050-12-31') < 0 || grn.recieved_date = 'NULL'
                       || grn.recieved_date = '0000-00-00')";
     }
     $cond1 = $cond31 . ' and ' . $cond32;
if ( $company!='' )
{

     if($company=='All')
     {
       $cond2 = "c.name like '%'" ;
     }else
     {
       $cond2 = "c.name = '" . $company ."'" ;
     }

  //echo $cond5;
}
$cond=$cond1 . ' and ' . $cond2;
//echo $cond;
$data.='<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Company </b></td>
            <td width="7%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Invoice #</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>GRN</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Received Date</b></td>
        </tr>';

        $result = $newreport->getgrndets4reportexport($cond);
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

             $data.='<tr><td bgcolor="#FFFFFF" ><span class="tabletext">'.$myrow[3].'</td>
                         <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'. $myrow[2].'</td>
                         <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$myrow[0].'</td>
                         <td bgcolor="#FFFFFF" align="center"><span class="tabletext">'.$recddate.'</td></tr>';

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
header("Content-Disposition: attachment; filename=grnreportexport.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
