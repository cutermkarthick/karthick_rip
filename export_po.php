<?
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

include('classes/poClass.php');
include('classes/liClass.php');
include('classes/purchasing_allocClass.php');

$newPO = new po;
$newLI = new po_line_items;
$newpurch = new purchasing_alloc;
$porecnum=$_REQUEST['porecnum'];

$result = $newPO->getPODetails($porecnum);
$myrow = mysql_fetch_assoc($result);
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
$title="PO Details - Exported on  ".$cur_date;

$data.='<table border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=14 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="3" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';

$data.='<table border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td  bgcolor="#F3F781" width=50%><span class="heading"><center><b>Supplier</b></center></td>';
$data.='<td bgcolor="#F3F781" width=50%><span class="heading"><b><center>Ship To</center></b></td>';
$data.='</tr>';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td><span class="tabletext">'.$myrow["name"].'</td>';
$data.='<td ><span class="tabletext"></td>';
$data.='</tr>';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td><span class="tabletext">'.$myrow["addr1"] . " " . $myrow["addr2"].'</td>';
$data.='<td ><span class="tabletext">Plot No. 467-469, Site No. 1D,</td>';
$data.='</tr>';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td ><span class="tabletext">'.$myrow["city"] . " " . $myrow["state"]. " " . $myrow["zipcode"].'</td>';
$data.='<td ><span class="tabletext">12th Cross, 4th Phase,PIA</td>';
$data.='</tr>';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td ><span class="tabletext">'.$myrow["country"].'</td>';
$data.='<td ><span class="tabletext">Bangalore 560 058, Karnataka- INDIA.</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';
//General Po Details
$data.='<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td bgcolor="#F3F781"><span class="labeltext">PO Date</td>';
// echo"to--- ".$myrow["podate"];
              $datearr = split('-',$myrow["podate"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $date=date("M j, Y",$x);
// echo "$date";
$data.='<td align="left"><span class="tabletext"><font size="3" ><b>'.$date.'</b></font></td>';
$data.='<td bgcolor="#F3F781"><span class="labeltext">PO #</td>';
$data.='<td><span class="tabletext"><font size="3" ><b>'.$myrow["ponum"].'</b></font></td>';
$data.='</tr>';
 //echo"++++".$myrow["status"];
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td><span class="labeltext">PO Desc</td>';
$data.='<td ><span class="tabletext">'.$myrow["podescr"].'</td>';
$data.='<td ><span class="labeltext">Status</td>';
$data.='<td ><span class="tabletext">'.$myrow["status"].'</td>';

$data.='</tr>';
$data.='<tr bgcolor="#FFFFFF">';
            $checked="checked";

$data.='<td ><span class="labeltext">Approval</td>';
$data.='<td ><span class="tabletext">'.$myrow["approval"].'</td>';
$data.='<td ><span class="labeltext">Approval Date</td>';

             // echo"to--- ".$myrow["approvaldate"];
              if($myrow["approvaldate"] !='' && $myrow["approvaldate"] !='0000-00-00' && $myrow["approvaldate"] != 'null'){
              $datearr = split('-', $myrow["approvaldate"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
            $x=mktime(0,0,0,$m,$d,$y);
            $date1=date("M j, Y",$x);
            }
            else
            $date1='';
            //echo "$date1";

$data.='<td ><span class="tabletext">'.$date1.'</td>';
$data.='</tr>';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td ><span class="labeltext">Amendment No.</td>';
$data.='<td ><span class="tabletext">'.$myrow["amendment_num"].'</td>';
$data.='<td><span class="labeltext">Amendment Date</td>';
              // echo"to--- ".$myrow["podate"];
              if($myrow["amendmentdate"] !='' && $myrow["amendmentdate"] !='0000-00-00' && $myrow["amendmentdate"] != 'null'){
              $datearr = split('-', $myrow["amendmentdate"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
            $x=mktime(0,0,0,$m,$d,$y);
            $date2=date("M j, Y",$x);
           }
           else{
            $date2='';
           }
           // echo "$date";

$data.='<td><span class="tabletext">'.$date2.'</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';
//Notes
$data.='<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
          $amend_notes=wordwrap($myrow["amendment_notes"],100,"\n",true);
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td ><span class="labeltext"><p align="left">Amendment Notes</p></font></td>';
$data.='<td colspan=5 rowspan=5><span class="tabletext"><textarea rows="5" cols="110" readonly="readonly">'.$amend_notes.'</textarea></td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';
$data.='<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
              $terms=wordwrap($myrow["terms"],100,"\n",true);

$data.='<tr bgcolor="#FFFFFF">';
$data.='<td><span class="labeltext"><p align="left">Header</p></font></td>';
$data.='<td colspan=5 rowspan=5><span class="tabletext"><textarea rows="5" cols="110" readonly="readonly">'.$terms.'</textarea></td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';
$data.='<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$data.='<tr bgcolor="#FFFFFF">';
$remarks=wordwrap($myrow["remarks"],105,"\n",true);
$data.='<td><span class="labeltext"><p align="left">Remarks</p></font></td>
<td colspan=5 rowspan=5><span class="tabletext"><textarea rows="5" cols="110" readonly="readonly">'.$remarks.'</textarea></td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';
$data.='<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=1><span class="labeltext"><p align="left">Communication</p></font></td>';
$comm = $myrow["communication"];
$data.='<td ><span class="tabletext">'.$comm.'</td>';
$data.='</table>';

$data.='<br>';
$data.='<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$data.='<tr>';
$data.='<td bgcolor="#F3F781" ><span class="heading"><b>Line Number</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Delivery<br>Time</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Qty<br>Rej</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Spec Type</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>PRN</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Order<br>Qty</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Mtl Type</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Mtl Spec</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Con</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>UOM</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Dia</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Length</b></td> ';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Width</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Thickness</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>GF</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Max</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>No of<br>Mtr req</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>No of<br>Len req</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Due</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Acc</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Delv Mode</b></td>';

$data.='<td bgcolor="#A0C544"><span class="heading"><b>Quality</b></td>';
$data.='<td bgcolor="#A0C544"><span class="heading"><b>Delivery</b></td>';
$data.='<td bgcolor="#A0C544"><span class="heading"><b>Comm</b></td>';

$data.='<td bgcolor="#659EC7" ><span class="heading"><b>Quality</b></td>';
$data.='<td bgcolor="#659EC7" ><span class="heading"><b>Delivery</b></td>';
$data.='<td bgcolor="#659EC7" ><span class="heading"><b>Comm</b></td>';

$data.='<td bgcolor="#F3F781"><span class="heading"><b>Rate</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Amt</b></td>';
$data.='</tr>';


        $recnum_arr = array();
        $i = 0;
        $netqus=0;
        $netdels=0;
        $netcomms=0;
        $result = $newLI->getLI($porecnum);
        $num_rows=mysql_num_rows($result);
        while ($myLI = mysql_fetch_assoc($result)) {
        $orderQty=$var = number_format($myLI["order_qty"],2);

	   if($myLI["duedate"] != '0000-00-00' && $myLI["duedate"] != '' && $myLI["duedate"] != 'NULL')
           {
              $datearr = split('-', $myLI["duedate"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $date=date("M j, Y",$x);
           }
           else
           {
              $date = '';
           }
		   if($myLI["accepted_date"] != '0000-00-00' && $myLI["accepted_date"] != '' && $myLI["accepted_date"] != 'NULL')
           {
              $datearr = split('-', $myLI["accepted_date"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $accdate=date("M j, Y",$x);
           }
           else
           {
              $accdate = '';
           }
            $qty_ordered = 0;
            //echo "$date";
            $recnum_arr[] = $myLI["recnum"];
            $line_num = $myLI["line_num"];
            $item_name = $myLI["item_name"];
            $item_desc = $myLI["item_desc"];
            $qty = $myLI["qty"];
            $delvby = $myLI["delv_by"];
            $uom = $myLI["uom"];
            $grainflow = $myLI["grainflow"];
            $material_ref = $myLI["material_ref"];
            $material_spec = $myLI["material_spec"];
            $dia ="";
            $thick="";
            $width = $myLI["width"];
            $length = $myLI["length"];
            if (trim($length) == "")
            {
                $dia = $myLI['thick'];
            }
            else
            {
                $thick = $myLI['thick'];
            }
            $qty_per_meter = $myLI["qty_per_meter"];
            $no_of_meterages = number_format($myLI["no_of_meterages"],2);
            $no_of_lengths = number_format($myLI["no_of_lengths"],2);

            $crn = $myLI["crn"];
            $maxruling = $myLI["maxruling"];
            $condition = wordwrap($myLI["condition"],25,"<br />\n");
            $qtyrej = ($myLI["qty_rej"] != 'NULL')?$myLI["qty_rej"]:0;
            if($myLI["delivery_time"] == 1)
            {
              $del = 'On Time';
              $del_rating = '100%';
            }
            else if($myLI["delivery_time"] == 2)
            {
              $del = '<<br>7 days late';
              $del_rating = '66.67%';
            }
            else if($myLI["delivery_time"] == 3)
            {
              $del = '><br>7 days late';
              $del_rating = '33.33%';
            }
            else
            {
              $del = '';
            }
            $qty_ordered = ($no_of_meterages+$no_of_lengths);

            $quality = ((($qty_ordered - $qtyrej)/$qty_ordered)*100);
            $order_qty=$myLI["order_qty"];
            $alt_spec=$myLI["alt_spec_rm"];
            $spec_type=$myLI["spec_type"];

         $i = $i + 1;
         $data.='<tr>';
	     $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$line_num.'</td>';
         $data.='<td bgcolor="#FFFFFF" ><span class="tabletext">'.$del.'</td>';
         $data.='<td bgcolor="#FFFFFF" ><span class="tabletext">'.$qtyrej.'</td>';
          $data.='<td bgcolor="#FFFFFF" ><span class="tabletext">'.$spec_type.'</td>';
         $data.='<td bgcolor="#FFFFFF" ><span class="tabletext">'.$crn.'</td>';
                         $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$orderQty.'</td>';
         //                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
                         $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$material_ref.'</td>';
                         $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$material_spec.'</td>';
                         $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$condition.'</td>';
                        $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$uom.'</td>';
                         $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$dia.'</td>';
                         $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$width.'</td>';
                         $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$length.'</td>';
                         $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$thick.'</td>';
                         $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$grainflow.'</td>';
                         $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$maxruling.'</td>';
                        $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$no_of_meterages.'</td>';
                         $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$no_of_lengths.'</td>';
                         $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$date.'</td>';
                         $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$accdate.'</td>';
                        $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$delvby.'</td>';
                         $data.='<td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$quality.'%</td>';
                         $data.='<td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$del_rating.'%</td>';
                         $data.='<td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$comm.'%</td>';

                         $netqu=($quality*0.6);
			             $netdel=($del_rating*0.3);
                         $netcomm=($comm*0.1);
                         $data.='<td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$netqu.'</td>';
                         $data.='<td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$netdel.'</td>';
                         $data.='<td bgcolor="#FFFFFF" align="right"><span class="tabletext">'.$netcomm.'</td>';

                         $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$myrow["currency"].$myLI["rate"].'</td>';
                         $data.='<td align="right" bgcolor="#FFFFFF"><span class="tabletext">'.$myrow["currency"].$myLI["amount"] .'</td>';
         		 unset($condition);
$netqus = $netqus+$netqu;
$netdels =$netdels+ $netdel;
$netcomms =$netcomms+ $netcomm;
}     //print_r($recnum_arr);
$data.='</tr> ';
        $data.='<tr bgcolor="#FFFFFF"> ';
        $data.='<td colspan=23 align="right"><span class="tabletext"><b>Average</b></td>';

	$netquality=$netqus/$num_rows;
	$netdelivery=$netdels/$num_rows;
        $netcommunication=$netcomms/$num_rows;
	$nettotal = ($netquality+$netdelivery+$comm);

    $data.='<td align=right><span class="tabletext" >'.$netquality.'</td>';
	$data.='<td align=right><span class="tabletext">'.$netdelivery.'</td>';
        $data.='<td align=right><span class="tabletext">'.$netcommunication.'</td>';
        $data.='<td colspan=3></td>';
$data.='</tr> ';
$data.='</tr>';
$data.='<tr bgcolor="#FFFFFF">';
             $data.='<td colspan=22 align="right"><span class="tabletext"><b>Total,pts</b></td>';
$data.='<td colspan=2 align="right"><span class="tabletext" >'.$nettotal.'</td>';
 $data.='<td colspan=5></td>';
$data.='</tr>';

         $data.='<tr bgcolor="#FFFFFF">';
   $data.='<td bgcolor="#FFFFFF"  align="right" colspan=28><span class="tabletext"><b>Total</b></td>';
              $data.='<td align="right" bgcolor="#FFFFFF"><span class="tabletext">'.$myrow["currency"].$myrow["poamount"].'</td>';
$data.='</tr>';

         $data.='<tr bgcolor="#FFFFFF">';
              $data.='<td bgcolor="#FFFFFF" align="right" colspan=28><span class="tabletext"><b>Tax</b></td>';
              $data.='<td align="right" bgcolor="#FFFFFF"><span class="tabletext">'.$myrow["currency"].$myrow["tax"].'</td>';
          $data.='</tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=28 align="right"><span class="tabletext"><b>Shipping</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext">'.$myrow["currency"].$myrow["shipping"].'</td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=28 align="right"><span class="tabletext"><b>Labor</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext">'.$myrow["currency"].$myrow["labor"].'</td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=28 align="right"><span class="tabletext"><b>Total Due</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext">'.$myrow["currency"].$myrow["total_due"].'</td>
          </tr>';
$data.='</table>';
/*$data.='<br>';
$data.='<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$data.='<tr>';
$data.='<td bgcolor="#E0FFFF" colspan=5 align="center"><span class="heading"><b>Purchasing Allocation</b></td>';
$data.='</tr>';
$data.='<tr>';
            $data.='<td bgcolor="#E0FFFF"><span class="heading"><b>Line Num</b></td>';
            $data.='<td bgcolor="#E0FFFF"><span class="heading"><b>PO Num</b></td>    ';
            $data.='<td bgcolor="#E0FFFF"><span class="heading"><b>Material Spec</b></td>';
            $data.='<td bgcolor="#E0FFFF"><span class="heading"><b>PRN</b></td>';
            $data.='<td bgcolor="#E0FFFF"><span class="heading"><b>Qty Allocated</b></td>';
$data.='</tr>';



 $poNum = $myrow["ponum"];
 //echo 'ponum='.$poNum;
 foreach($recnum_arr as $link2poli)
 {
   $result4pur = $newpurch->getpurchDetails($link2poli,$poNum);
    while ($mypur = mysql_fetch_assoc($result4pur)) {


            //echo "$date";
            $line_Num =  $mypur["linenum"];
            $ponum = $mypur["ponum"];
            $qty_alloc = $mypur["qty_allocated"];
            $crn = $mypur["crn"];
            $mat_spec = $mypur["mat_spec"];


                 $data.='<tr><td bgcolor="#FFFFFF"><span class=\"tabletext\">'.$line_Num.'</td>' ;
                 $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$ponum.'</td>';
                 $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$mat_spec.'</td>';
                 $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$crn.'</td>';
                 $data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$qty_alloc.'</td></tr>';
        }
 }

$data.='</table>';
$data.='<table border = 1 cellpadding=0 cellspacing=0 width=100%>';
$data.='<tr>';
$data.='<td align="center" colspan=8><span class="tabletext"><b>If Material is ordered in Meters, the same can be supplied in random lengths but eachlength not exceeding 3 meters</b></td></tr> ';
$data.='</table >';  */
$data.='<br>';
$data.='<table border=2 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>';
        $data.='<tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">'.$myrow["formatnum"].'</td>
            <td colspan=2><span class="labeltext">'.$myrow["formatrev"].'</td>
            <td colspan=4></td>
        </tr>';

$data.='</table>';
$data.='</body></html>';

header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=rmpoDetails.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";


?>

