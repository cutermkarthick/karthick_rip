<?php

session_start();
header("Cache-control: private");
$userid = $_SESSION['user'];

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/grnclass.php');
include_once('classes/displayClass.php');
include_once('classes/grncofcclass.php');
include_once('classes/loginClass.php');

$newcofc = new cofc;
$newgrn = new grn;
$newlogin = new userlogin;
$newlogin->dbconnect();
$grnrecnum = $_REQUEST['grnrecnum'];
$result = $newgrn->getgrn($grnrecnum);
$myrow = mysql_fetch_row($result);
$cofc= $newcofc->getcofc($grnrecnum);
//$username = $_SESSION['user'];
$header='';
$data='';
$username=$_SESSION['username'] ;
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
$row=mysql_fetch_object($cofc);
$noncon=$row->noncon;
$ncref=$row->ncref;
$ncdate=$row->ncdate;
$comm=$row->comm;
$dcomm=$row->dcomm;
$remarks=$row->remarks;
$approval=$row->approval;

              if($ncdate != '0000-00-00' && $ncdate != '' && $ncdate != 'NULL')
              {
                  $datearr = split('-', $ncdate);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date2=date("M j, Y",$x);
              }
              else
              {
                 $date2 = '';
              }
     $date = date('d M Y ');
     $data .='<body><table  width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
     $data .='<tr bgcolor="#DDDEDD">';
     $data .='<td  colspan=8>   <table border=0 width=100%><tr><td align=center colspan=6  width=80%><b> GRN Report For Non-Conformance</b>  </td>
                                       <td  colspan=2 width=20%><b>  Date:' .$date. '</b></td></tr>
                                       </table>
     </td>';

     $data .='</tr>';
     $data .='<tr bgcolor="#FFFFFF">';
     $data .='<td width="25%"><span class="labeltext"><p align="left">GRN No.</p></font></td>';
     $data .='<td  colspan=7 width="25%"><span class="tabletext"><p align="left">' .$myrow[25]. '</p></td>';
     $data .='</tr>';
     $data .='<tr bgcolor="#FFFFFF">';
     $data .='<td  width="25%"><span class="labeltext">Supplier</td>';
     $data .='<td  colspan=7 width="25%"><span class="tabletext">' ."$myrow[23]". '</td>';
     $data .='</tr>';
     $data .='<tr bgcolor="#FFFFFF">';
     if($myrow[15] != '0000-00-00' && $myrow[15] != '' && $myrow[15] != 'NULL')
              {
                  $datearr = split('-', $myrow[15]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                 $date1 = '';
              }
     $data .='<td width="25%"><span class="labeltext"><p align="left">Recieved Date</p></font></td>';
     $data .='<td colspan=7 width="25%"><span class="tabletext"><p align="left">' .$date1. '</p></td>';
     $data .='</tr>';
     $data .='<tr bgcolor="#FFFFFF">';
     $data .='<td><span class="labeltext"><p align="left">GRN Type</p></font></td>';
     $data .='<td colspan=7><span class="tabletext">' .$myrow[35]. '</td>';
     $data .='</tr>';
	 $data .='<tr bgcolor="#FFFFFF">';
	 $data .='<td width=30% border=1 colspan=2><span class="labeltext"><p align="left">Are any Non Conformance Observed</p></td>';
	 
	 if($noncon==1){
        $conformance="Yes";
       }
       else $conformance="No";
       
    $data .='<td width=5% colspan=2> <b><span class="labeltext">'.$conformance. '</b></span>';
    $data .='</td>';
    $data .='<td width=5% align=top><b><span class="labeltext">NCR Ref No.</b> </td>';
    $data .='<td width=5% align=top><b><span class="tabletext">' .$ncref. '</span><br></td>';
	$data .='<td width=5% align=top><b><span class="labeltext">NCR Date</b> </td>';
    $data .='<td width=5% align=top><b><span class="tabletext">'.$date2. '</span></td></tr>';
	$data .='<tr bgcolor="#FFFFFF">';
	$data .='<td width=30% colspan=4><span class="labeltext"><p align="left">Is the Observed Non-Conformance communicated to the respective authorities</p></td>';
	if($comm==1)
    {
      $communicate="Yes";
    }
    else $communicate="No";
	$data .='<td colspan=4> <b><span class="labeltext">'.$communicate.'</b></td></tr>';
	$data .='<tr bgcolor="#FFFFFF">';
	$data .='<td width=30%><span class="labeltext"><p align="left">Details of Communication</p></td>';
	$data .='<td width=5% colspan=7> <span class="tabletext">' .$dcomm. '</span></td></tr>';
	$data .='<tr bgcolor="#FFFFFF">';
	$data .='<td width=30%><span class="labeltext"><p align="left">Additional Notes/Remarks</p></td>';
	$data .='<td width=5% colspan=7> <span class="tabletext">' .$remarks. '</span></td></tr>';
	$data .='<tr bgcolor="#FFFFFF">';
	$data .='<td width=30%><span class="labeltext"><p align="left">Authorised Signatory With Date<br>(Store Department)</p></td>';
	$data .='<td width=5% colspan=7 class=tabletext>'.$approval.'</td></tr>';
    $data .='</table></body></html>';
	
	
    header("Content-type: application/x-msdownload",true);
	header("Content-Disposition: attachment; filename=extractiong.xls",false);
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$data";
	
?>
	
