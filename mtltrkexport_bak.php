<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 10, 2015                =
// Filename: mtltrksummary.php                 =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays Material Tracker Summary list.     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'mtltrk_summary';
////////////session_register('pagename');
$usertype = $_SESSION['usertype'];

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/mtl_trackerclass.php');
include_once('classes/displayClass.php');
include('classes/companyClass.php');

$newMT = new mtl_trk;
$newdisplay = new display;
$company = new company;

$dept=$_SESSION['department'];

$cond=$_REQUEST['cond'];
$vendcond=$_REQUEST['vendcond'];

if ($usertype == 'VEND') 
{
   $result = $newMT->getmtltrks4vend($userid,$vendcond);

}
else
{
   $result = $newMT->getmtltrks($userid,$cond);
   
} 



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
$title="Material Tracker Details - Exported on  ".$cur_date;

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
           <td  bgcolor="#EEEFEE" ><span class="tabletext"><b>PO#</b></td>
            <td  bgcolor="#EEEFEE" ><span class="tabletext"><b>Line#</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PO Date</b></td>  
            <td  bgcolor="#EEEFEE" ><span class="tabletext"><b>Dispatch Due <br>Date</b></td>
            <td  bgcolor="#EEEFEE" ><span class="tabletext"><b>Supplier Agreed Dispatch Date1</b></td>
            <td  bgcolor="#EEEFEE" ><span class="tabletext"><b>Supplier Agreed Dispatch Date2</b></td>
             <td  bgcolor="#EEEFEE" ><span class="tabletext"><b>B/L Date</b></td>
            <td  bgcolor="#EEEFEE" ><span class="tabletext"><b>Recd Date</b></td>
            <td  bgcolor="#EEEFEE" ><span class="tabletext"><b>RM Type</b></td>
            <td  bgcolor="#EEEFEE" ><span class="tabletext"><b>NO of Len</b></td>
            <td  bgcolor="#EEEFEE" ><span class="tabletext"><b>Recd Qty</b></td>
            <td  bgcolor="#EEEFEE" ><span class="tabletext"><b>Status</b></td>
            <td  bgcolor="#EEEFEE" ><span class="tabletext"><b>Chart</b></td>
           </tr>';


if ($usertype == 'VEND') {

         while($myrow=mysql_fetch_row($result))
         {

                if ($myrow[3] != 0)
                { 
                    $qty = $myrow[3];
                }
                else 
                {
                    $qty = $myrow[5];
                }
                  $order_qty=$myrow[13];
                  $recd_qty=$myrow[14];
                  if ($myrow[7] == '')
                { 
                    $accdate = '0000-00-00';
                }
                
        if(($myrow[7] == '0000-00-00' || $myrow[7]  == NULL) && $myrow[8] > 7){
          $bgcolor='red';
        }
        else{
          $bgcolor='#FFFFFF';
        }

        if($myrow[7] != '0000-00-00' && $myrow[7] != '' && $myrow[7] != 'NULL')
            {
              $datearr = split('-', $myrow[7]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $acc_date=date("M j, Y",$x);
            }
            else
            {
              $acc_date = '';
            }
        if($myrow[10] != '0000-00-00' && $myrow[10] != '' && $myrow[10] != 'NULL')
            {
              $datearr = split('-', $myrow[10]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $due_date=date("M j, Y",$x);
            }
           else
           {
              $due_date = '';
           }
              if($myrow[6] != '0000-00-00' && $myrow[6] != '' && $myrow[6] != 'NULL')
            {
              $datearr = split('-', $myrow[6]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $po_date=date("M j, Y",$x);
            }
            else
            {
              $po_date = '';
            }
            if($myrow[11] != '0000-00-00' && $myrow[11] != '' && $myrow[11] != 'NULL')
            {
              $datearr = split('-', $myrow[11]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $due_date1=date("M j, Y",$x);
            }
           else
           {
              $due_date1 = '';
           }
            if($myrow[12] != '0000-00-00' && $myrow[12] != '' && $myrow[12] != 'NULL')
            {
              $datearr = split('-', $myrow[12]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $due_date2=date("M j, Y",$x);
            }
           else
           {
              $due_date2 = '';
           }

           if($myrow[16] != '0000-00-00' && $myrow[16] != '' && $myrow[16] != 'NULL')
            {
              $datearr = split('-', $myrow[16]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $bl_date=date("M j, Y",$x);
            }
           else
           {
              $bl_date = '';
           }

            if($ponum != $myrow[1])
            {

            $data.='<tr bgcolor='.$bgcolor.'>';
            $data.='<td >'.$myrow[1].'</td>'; 
            $data.='<td >'.$myrow[9].'</td>';          
            $data.='<td >'.$podate.'</td>';
            $data.='<td >'.$due_date.'</td>';
            $data.='<td >'.$due_date1.'</td>';
            $data.='<td >'.$due_date2.'</td>';
            $data.='<td >'.$bl_date.'</td>';
            $data.='<td >'.$acc_date.'</td>';
            $data.='<td >'.$myrow[2].'</td>';
            $data.='<td >'.$qty.'</td>';
            $data.='<td >'.$recd_qty.'</td>';
            $data.='<td >'.$myrow[15].'</td>';
            $data.='<td >'.$myrow[1].'</td>';
            $data.='</td></tr>';
          }
          else{
            $data.='<tr bgcolor='.$bgcolor.'>';
            $data.='<td >'.''.'</td>'; 
            $data.='<td >'.$myrow[9].'</td>';
            $data.='<td >'.''.'</td>'; 
            $data.='<td >'.$due_date.'</td>';
            $data.='<td >'.$due_date1.'</td>';
            $data.='<td >'.$due_date2.'</td>';
            $data.='<td >'.$bl_date.'</td>';
            $data.='<td >'.$acc_date.'</td>';
            $data.='<td >'.$myrow[2].'</td>';
            $data.='<td >'.$order_qty.'</td>';
            $data.='<td >'.$recd_qty.'</td>';
            $data.='<td >'.$myrow[15].'</td>';
            $data.='</td></tr>';
          }

            $ponum = $myrow[1];

    }


  }else{
       while ($myrow = mysql_fetch_row($result)) 
      {
                if ($myrow[3] != 0)
                { 
                    $qty = $myrow[3];
                }
                else 
                {
                    $qty = $myrow[5];
                }
        $order_qty=$myrow[13];
        $recd_qty=$myrow[14];
        if ($myrow[7] == '')
                { 
                    $accdate = '0000-00-00';
                }
        if(($myrow[7] == '0000-00-00' || $myrow[7]  == NULL) && $myrow[8] > 7)
          $bgcolor='red';
        else
          $bgcolor='#FFFFFF';
        if($myrow[7] != '0000-00-00' && $myrow[7] != '' && $myrow[7] != 'NULL')
            {
              $datearr = split('-', $myrow[7]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $acc_date=date("M j, Y",$x);
            }
            else
            {
              $acc_date = '';
            }
        if($myrow[10] != '0000-00-00' && $myrow[10] != '' && $myrow[10] != 'NULL')
            {
              $datearr = split('-', $myrow[10]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $due_date=date("M j, Y",$x);
            }
           else
           {
              $due_date = '';
           }
              if($myrow[6] != '0000-00-00' && $myrow[6] != '' && $myrow[6] != 'NULL')
            {
              $datearr = split('-', $myrow[6]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $po_date=date("M j, Y",$x);
            }
            else
            {
              $po_date = '';
            }
            if($myrow[11] != '0000-00-00' && $myrow[11] != '' && $myrow[11] != 'NULL')
            {
              $datearr = split('-', $myrow[11]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $due_date1=date("M j, Y",$x);
            }
           else
           {
              $due_date1 = '';
           }
            if($myrow[12] != '0000-00-00' && $myrow[12] != '' && $myrow[12] != 'NULL')
            {
              $datearr = split('-', $myrow[12]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $due_date2=date("M j, Y",$x);
            }
           else
           {
              $due_date2 = '';
           }
            if($ponum != $myrow[1])
            {
            $data.='<tr bgcolor='.$bgcolor.'>';
            $data.='<td >'.$myrow[1].'</td>'; 
            $data.='<td >'.$myrow[9].'</td>';          
            $data.='<td >'.$podate.'</td>';
            $data.='<td >'.$due_date.'</td>';
            $data.='<td >'.$due_date1.'</td>';
            $data.='<td >'.$due_date2.'</td>';
            $data.='<td >'.$bl_date.'</td>';
            $data.='<td >'.$acc_date.'</td>';
            $data.='<td >'.$myrow[2].'</td>';
            $data.='<td >'.$qty.'</td>';
            $data.='<td >'.$recd_qty.'</td>';
            $data.='<td >'.$myrow[15].'</td>';
            $data.='<td >'.$myrow[1].'</td>';
            $data.='</td></tr>';
          }
          else{
            $data.='<tr bgcolor='.$bgcolor.'>';
            $data.='<td >'.''.'</td>'; 
            $data.='<td >'.$myrow[9].'</td>';
            $data.='<td >'.''.'</td>'; 
            $data.='<td >'.$due_date.'</td>';
            $data.='<td >'.$due_date1.'</td>';
            $data.='<td >'.$due_date2.'</td>';
            $data.='<td >'.$bl_date.'</td>';
            $data.='<td >'.$acc_date.'</td>';
            $data.='<td >'.$myrow[2].'</td>';
            $data.='<td >'.$order_qty.'</td>';
            $data.='<td >'.$recd_qty.'</td>';
            $data.='<td >'.$myrow[15].'</td>';
            $data.='</td></tr>';
          }

            $ponum = $myrow[1];
  }

}

$data.='</table>';
$data.='<br>';
$data.='</body></html>';

header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=mtltrackerDetails.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";


?>

