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
	
$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];

// echo $cond;
// how many rows to show per page


 //echo $offset;


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
		    <td  bgcolor="#EEEFEE"><span class="tabletext"><b>BOND Dt</b></td>
		    <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td>
 
        </tr>';

            $result=$newconsumption->getbondsummary4export();
            while ($myrow = mysql_fetch_array($result))
			{

                  $data.=' <td bgcolor="#FFCC00"><span class="tabletext">'.$myrow['bond_num'].'</a></td>
                                 <td><span class="tabletext">'.$myrow['bonddate'].'</td>
								 <td><span class="tabletext">'.$myrow['status'].'</td>';

                  $data.='</tr>';

			}


$data.='</table>
      </table>
';

header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment;filename=export_bondstatus_report.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";

