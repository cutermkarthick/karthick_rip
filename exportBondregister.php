<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';

include_once('classes/consumptionClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newconsumption = new consumption;

$bondnum=$_REQUEST['bondnum'];
$remarkDate = '';
$prev_grnnum='#';
$prev_invnum='#';


//echo $cond."----fcond";
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
$address="M/s. CIM Tools Private Limited<br>Plot No.467-469,Site No.1D,12th Cross,4th Phase,<br>Peenya Industrial Area Bangalore-560058.<br>
Customs License no-73/2009 Dt 16.10.2009 Valid upto 10.02.2013<br>Towards the permission from Asstn Commisioner4 of Customs,Customs Division,Bangalore to maitin soft Copy of Registers over the file<br>
C.No: VIII/48/08/2009 EOU II letter Dt 10.11.2009" ;
$data.='<table border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" rules="all">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=13 bgcolor="#00DDFF" align="left"><span class="tabletext"><font size="2" ><b>';
$data.=$address.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';
$title="Bond Register<br>Annexure D-1";
$data.='<table border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" rules="all">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=13 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="2" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';

		$data.='<table width=100% border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
		<tr>
		<td  bgcolor="#EEEFEE" align="center" colspan=13><span class="tabletext"><b>ANNEXURE</b></td>
		</tr>
      <tr>
           <td  bgcolor="#EEEFEE"><span class="tabletext"><b>SL No.</b></td>
           <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Bond No</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Date</b></td>
	        <td  bgcolor="#EEEFEE"><span class="tabletext"><b>B.E. No.</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Date</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Invoice #</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Description</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Volume</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>CIF Val</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Assess Val</b></td>
		    <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Duty Amt</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Remarks</b></td></tr>';


             $flag=0; $linecount=0;   $alt_flag=0;
             $prevbondnum="#";$prevbenum="#";
             $result = $newconsumption->getbond4export($bondnum);
            while ($myrow = mysql_fetch_array($result))
			{
                    $rmspec= wordwrap($myrow["description"],20,"<br>\n");
                    $rmtype= wordwrap($myrow["rmtype"],20,"<br>\n");
					$supplier = wordwrap($myrow['company'],20,"<br>\n");
                    if($myrow['bonddate'] != '0000-00-00' && $myrow['bonddate'] != 'NULL' && $myrow['bonddate'] != '')
                    {
                     $datearr = split('-', $myrow['bonddate']);
                     $d=$datearr[2];
                     $m=$datearr[1];
                     $y=$datearr[0];
                     $x=mktime(0,0,0,$m,$d,$y);
                     $bonddate=date("j-M-Y",$x);
                     }
                     else
                     {
                     $bonddate = '';
                     }

                     if($myrow['bedate'] != '0000-00-00' && $myrow['bedate'] != 'NULL' && $myrow['bedate'] != '')
                    {
                       $datearr = split('-', $myrow['bedate']);
                       $d=$datearr[2];
                       $m=$datearr[1];
                       $y=$datearr[0];
                       $x=mktime(0,0,0,$m,$d,$y);
                       $bedate=date("j-M-Y",$x);
                     }
                     else
                     {
                       $bedate = '';
                     }
                     $bondarr=split('/',$myrow['bond_num']);
                     $slnum=$bondarr[0];
                    //echo $prevgrnnum."----111----".$myrow[2]."----------<br>";
                     //echo $closingbal."----1222----".$close_bal;
                     if($myrow['bonddate'] !='' && $myrow['bonddate'] !='0000-00-00' && $myrow['bonddate'] !='NULL')
                     {
                     
                      $remark_date = strtotime(date("Y-m-d", strtotime($myrow['bonddate'])) . " +3 years");
                      $remark_date = date ( 'Y-m-d' , $remark_date );
                       if($remark_date != '0000-00-00' && $remark_date != 'NULL' && $remark_date != '')
                    {
                       $datearr = split('-', $remark_date);
                       $d=$datearr[2];
                       $m=$datearr[1];
                       $y=$datearr[0];
                       $x=mktime(0,0,0,$m,$d,$y);
                       $remarkDate=date("j-M-Y",$x);
                     }
                     else
                     {
                       $remarkDate = '';
                     }
                     }
                     //echo $remark_date."----t---8-<br>";
                     //$date = strtotime($D_TEMP);
                     //$todays_date = date("Y-m-d");
                     //$today = strtotime($todays_date);
    	$data.='<tr  bgcolor="#FFFFFF"> ';

	if ($prevbondnum!=$myrow['bond_num'])
	{

      $data.='
     <td><span class="tabletext">'. $slnum .'</td>
     <td bgcolor="#FFFFFF"><span class="tabletext">'.$myrow['bond_num'].'</a></td>
      <td><span class="tabletext">'.$bonddate.'</td>';
      $prevbondnum=$myrow['bond_num'];

    }
	else
	{

       $data.=' <td><span class="tabletext">&nbsp</td>
       <td><span class="tabletext">&nbsp</td>
      <td><span class="tabletext">&nbsp</td>';

	}
	if ($prevbenum!=$myrow['be_num'])
	{

      $data.='<td bgcolor="FFFFFF"><span class="tabletext">'.$myrow['be_num'].'</a></td>
      <td><span class="tabletext">'.$bedate.'</td>';
      $prevbenum=$myrow['be_num'];

    }
	else
	{

      $data.='<td><span class="tabletext">&nbsp</td>
      <td><span class="tabletext">&nbsp</td>';

	}
                        $qty_format=number_format ($myrow['qty'],2 );
                        if($prev_invnum!=$myrow['invoice_num'])
                        {
                          $data.='<td><span class="tabletext">'. $myrow['invoice_num'] .'</td>';
                          $prev_invnum=$myrow['invoice_num'];
                       }else
                       {
                         $data.='<td><span class="tabletext">&nbsp;</td>';
                       }
                        if($prev_grnnum!=$myrow['grnnum'])
                        {
						$data.='<td><span class="tabletext">'. $rmspec.' '.$rmtype .'</td>
						<td><span class="tabletext">'. $qty_format .'</td>
                        <td><span class="tabletext">'. $myrow['uom'].'</td> ';
                        $prev_grnnum=$myrow['grnnum'];
                        }
                        if($flag==0)
                        {
						$data.=' <td><span class="tabletext">'. $myrow['cifval'] .'</td>
                        <td><span class="tabletext">'. $myrow['assessval'] .'</td>
                        <td><span class="tabletext">'.$myrow['dutyamt'].'</td>';
                        $flag=1;
                        }
                        else
                        {
                         $data.='<td><span class="tabletext">&nbsp</td>
                         <td><span class="tabletext">&nbsp</td>
                         <td><span class="tabletext">&nbsp</td>
                         ';
                        }
                          if($alt_flag==0)
                          {
                           $data.='<td><span class="tabletext">'.$remarkDate.'</td>';
                           $alt_flag=1;
                          }else
                          {
                           $data.='<td><span class="tabletext">&nbsp;</td>';
                          }



                        $data.='</tr>';

			}


$data.='</table>
      </table>
';

header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment;filename=export_bond_register.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";

