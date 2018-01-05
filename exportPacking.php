<?
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'packingdetails';
//////session_register('pagename');

include('classes/packingClass.php');
include('classes/packingliClass.php');
include('classes/displayClass.php');
$newPO = new packing;
$newli = new packingli;
$newdisp = new display;
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
$recnum=$_REQUEST['recnum'];
$result=$newPO->getpackingdetails($recnum);
$myrow=mysql_fetch_assoc($result);

$curdate = date("Y-m-d");
$datearr = split('-',$curdate);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $cur_date=date("M j, Y",$x);
$title="Packing Details";

$data.='<table border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=7 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="2" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';

$data.='<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext">Customer</font></td>
<td colspan=3><span class="labeltext">'.$myrow['name'].'</td>
<td><span class="labeltext">Packing No.</td>
<td colspan=2><p align="left"><span class="tabletext">'.$myrow['packingnum'].'</td>
</tr>
<input type="hidden" name="companyrecnum" id="companyrecnum">
<tr bgcolor="#FFFFFF">
<td><p align="left"><span class="labeltext">PO #</td>
<td colspan=3><p align="left"><span class="tabletext">'. $myrow['ponum'].'</td>';

 if($myrow["podate"] != '0000-00-00' && $myrow["podate"]!= '' && $myrow["podate"] != 'NULL')
                {
                    $datearr = split('-', $myrow["podate"]);
                    $d=$datearr[2];
                    $m=$datearr[1];
                    $y=$datearr[0];
                    $x=mktime(0,0,0,$m,$d,$y);
                    $podate=date("M j, Y",$x);
               }
              else
              {
                   $podate = '';
              }
              
               if($myrow["pack_date"] != '0000-00-00' && $myrow["pack_date"]!= '' && $myrow["pack_date"] != 'NULL')
                {
                    $datearr = split('-', $myrow["pack_date"]);
                    $d=$datearr[2];
                    $m=$datearr[1];
                    $y=$datearr[0];
                    $x=mktime(0,0,0,$m,$d,$y);
                    $pdate=date("M j, Y",$x);
               }
              else
              {
                   $pdate = '';
              }

$data.='<td><span class="labeltext"><p align="left">PO Date</p></td>
<td colspan=2><p align="left"><span class="tabletext">'. $podate.'</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">CIM Invoice No.</p></td>
<td colspan=3><p align="left"><span class="tabletext">'.$myrow['cim_invoice'].'</td>
<td><span class="labeltext"><p align="left">Work Order #</p></td>
<td colspan=2><p align="left"><span class="tabletext">'.$myrow['wonum'].'</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Item Description</p></td>
<td colspan=6><span class="tabletext">'.$myrow['descr'] .'</td>
</tr>
</table>
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td rowspan=2><span class="labeltext"><p align="left">Quantity</p></td>
<td align="center" colspan=2><span class="labeltext">Order Qty.</p></td>
<td align="center" colspan=2><span class="labeltext">Qty ThisShipment</p></td>
<td align="center" colspan=2><span class="labeltext">Bal Qty To Be Dispatched</p></td>
</tr>
<tr bgcolor="#FFFFFF">
<td align="center" colspan=2><span class="tabletext">'.$myrow['order_qty'].'</td>
<td align="center" colspan=2><span class="tabletext">'.  $myrow['qty_dispatch'].'</td>
<td align="center" colspan=2><span class="tabletext">'. $myrow['qty_balance'].'</td>
</tr>
</table>
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Packing List Dated:</p></td>
<td align="left" colspan=6><span class="tabletext">'. $pdate .'</td>
</tr>
</table>
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td colspan=3 align="center"><span class="labeltext">No. Of Packings</td>
<td colspan=4 align="center"><span class="labeltext">Type Of Packing And Contents</td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=3 align="center"><span class="tabletext">'.$myrow['no_packings'].'</td>
<td  colspan=4 align="center"><span class="tabletext">'. $myrow['type_packing'].'</td>
</tr>
</table>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="tablemm">
<tr>
            <td colspan=7><span class="heading"><center><b>Packing Details</b></center></td>
        </tr>
		  <tr bgcolor="#FFFFFF">
		 <td width="5%" align="center"><span class="heading">
           <b>Seq</b></font></td>

		   		<td width="7%" align="center"><span class="heading">
		   <b>Length<br>(In Inches)</b></font></td>

             <td width="7%" align="center"><span class="heading">
		   <b>Width<br>(In Inches)</b></font></td>

		   	<td width="7%" align="center"><span class="heading">
		   <b>Thickness<br>(In Inches)</b></font></td>

		     <td width="7%" align="center"><span class="heading">
            <b>Nett Weight</b></font></td>

            <td width="7%" align="center"><span class="heading">
            <b>Total Weight</b></font></td>

            <td width="7%" align="center"><span class="heading">
            <b>No. of Boxes</b></font></td>


           </tr>';

	  $x=1;
	  $totnettwt = 0;
      $totgrosstwt = 0;
	  $totnumboxes = 0;

	  $resultli=$newli->getpackinglidetails($recnum);
	  while($myrowli=mysql_fetch_row($resultli))
	  {
            $totnettwt += $myrowli[5];
            $totgrosstwt += $myrowli[6];
            $totnumboxes+= $myrowli[8];

	      $data.='<tr bgcolor="#FFFFFF">
          <td align="center" width=5%><span class=tabletext>
           '.$myrowli[1].'</font></td>
		   <td align="center" width=7%><span class=tabletext>
		   '.$myrowli[2] .'</font></td>
		   <td align="center" width=7%><span class=tabletext>
		   '.$myrowli[3].'</font></td>
		   <td align="center" width=7%><span class=tabletext>
		   '.$myrowli[4].'</font></td>
			<td align="center" width=7%><span class=tabletext>
			'.$myrowli[5].'</font></td>
             <td align="center" width=7%><span class=tabletext>
			'.$myrowli[6] .'</font></td>
             <td align="center" width=7%><span class=tabletext>
			'.$myrowli[8] .'</font></td>

     </tr>';
 	$x++;
    }
       $data.="
			<td colspan=4 align=\"center\"><span class=\"labeltext\"><b>Total</b></p></font></td>
			<td width=7% align=\"center\"><span class=\"style6\"><b>$totnettwt</b></font></td>
             <td width=7% align=\"center\"><span class=\"style6\"><b>$totgrosstwt</b></font></td>
		     <td width=7% align=\"center\"><span class=\"style6\"><b>$totnumboxes</b></font></td>
               ";

    


$data.='</table>
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td width=19%><span class="labeltext">
            <p align="left">Remarks</p></font></td>
<td colspan=6 width=45%><span class=tabletext>
'.$myrow['remarks'] .'</p></font></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Transportation By:</p></td>
<td colspan=6><span class="tabletext">'.$myrow['transportation'].'</span></td></tr>
</table>
</td>
 <table border=2 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td colspan=3><span class="labeltext">'.$myrow['formrev'].'</td>
            <td colspan=3><span class="labeltext">CIMTOOLS PRIVATE LIMITED</td>
        </tr>

</table>
</td>
</tr></table>';
$data.='<input type=\"hidden\" name=\"index\" id=\"index\" value=$x>
            <input type=\"hidden\" name=\"curindex\" id=\"curindex\" value=$x>';
$data.='</body></html>';

header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=packingDetails_".$myrow['packingnum'].".xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";

