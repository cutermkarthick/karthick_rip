<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 18, 2008                =
// Filename: rmmastersummary.php               =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays RM Master Summary list.            =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'rmmastersummary';
//////session_register('pagename');

// First include the class definition
include_once('classes/rmmasterClass.php');
include_once('classes/displayClass.php');

$newdisplay = new display;
$newRM = new rmmaster;
$dept=$_SESSION['department'];

$header='';
$data='';
$username=$_SESSION['username'];
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
$curdate = date("Y-m-d");
$datearr = split('-',$curdate);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $cur_date=date("M j, Y",$x);
$title="RM Master Details - Exported on  ".$cur_date;

 $data.='<table border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=11 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="3" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';
$data.='<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PRN#</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>RM Status</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>RM Spec</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Spec Type</b></td>
	        <td  bgcolor="#EEEFEE"><span class="tabletext"><b>MRS</b></td>
	        <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Dia</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Length</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Width</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Thickness</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Qty/Billet</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Price</b></td>
        </tr>';


          $cond=$_REQUEST['cond'];
        

         // echo $cond;
         $result = $newRM->getrmmaster4export($cond);

         while($myrow=mysql_fetch_row($result))
         {
   	       /*printf('<tr bgcolor="#FFFFFF">');
   	              if($myrow[22] == 'Inactive')
                  {
                      $color = '"#FF0000"';
                  }
                   else
                       {
                         $color = '"#FFFFFF"';
                       }  */
                       //echo $myrow[10]."-----------".$myrow[18];
                       $data.='<tr bgcolor="#FFFFFF">';
                      $data.='<td >'.$myrow[10].'</td>';
                      $data.='<td >'.$myrow[22].'</td>';
                      $data.='<td >'.$myrow[4].'</td>';
                      $data.='<td >'.$myrow[20].'</td>';
                      $data.='<td >'.$myrow[17].'</td>';
                      $data.='<td >'.$myrow[8].'</td>';
                      $data.='<td >'.$myrow[5].'</td>';
                      $data.='<td >'.$myrow[6].'</td>';
                      $data.='<td >'.$myrow[7].'</td>';
                      $data.='<td >'.$myrow[16].'</td>';
                      $data.='<td >'.$myrow[29]." ".$myrow[18].'</td>';

              $data.='</td></tr>';

        }

$data.='</table>';
$data.='<br>';
$data.='</body></html>';

header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=rmmasterDetails.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";


?>

