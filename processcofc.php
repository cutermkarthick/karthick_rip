<?
//==============================================
// Author: FSI                                 =
// Date-written = Oct 22, 2013                 =
// Filename: processcofc.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//==============================================
$worecnum=$_REQUEST['worecnum'];
include('classes/workorderClass.php');
 include('classes/masterdataClass.php');
include('classes/dispatchClass.php');
include('classes/dispatchliClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newwo = new workOrder;
$newMD = new masterdata;
$newDispatch = new dispatch;
$newdli = new dispatch_line_items;

$result = $newwo->getGenInfo($worecnum);
$myrow = mysql_fetch_array($result);
$result = $newwo->getlink2masterdata($worecnum);
$myrec =  mysql_fetch_row($result);
$link2masterdata = $myrec[0];
$resultmd = $newMD->getmasterdata4wo($link2masterdata);
$mymd = mysql_fetch_row($resultmd);

$crn=$mymd[9];
$disp2cust=$myrow[14];
$type=$myrow[40];
$disp_date = date('Y-m-d');
$schdate=$myrow[17];
$schqty=$myrow[58];

$newlogin = new userlogin;
$newlogin->dbconnect();

$newDispatch->setdisp_date($disp_date);
$newDispatch->setdisp2cust($disp2cust);
$newDispatch->setcrn($crn);
$newDispatch->setschdate($schdate);
$newDispatch->setschqty($schqty);
$newDispatch->settype($type);
$wonum=$myrow[0];
$result=$newdli->getcofc_lineitems($wonum);
if(mysql_num_rows($result) == 0)
{
$disprecnum = $newDispatch->addDispatch();
$c = "C";
$disp_recnum=$c.$disprecnum;
$linenumber1=1;
if($myrow[0] != ''&& $myrow[0] != 'NULL')
{
              $wonumarr = split('-', $myrow[0]);
              $wonum_suff=$wonumarr[1];
              if($wonum_suff != ''&& $wonum_suff != 'NULL')
              {
              $wonum_suf='-'.$wonumarr[1];
              }
              else
              {
               $wonum_suf =$wonum_suff;
              } 
}
$newdli->setlinenum($linenumber1);
$newdli->setwonum($wonum);
$newdli->setlink2dispatch($disprecnum);
if($type != 'With Treatment')
{  
      $result = $newdli->getdispatch4wo($crn,$disp2cust,$wonum);       
      while ($myrow = mysql_fetch_row($result)) 
      {
	$partname=$myrow[11];
	$partnum=$myrow[2];
	$woqty=$myrow[7];
	$compqty=$myrow[19];
	$grnnum=$myrow[3];
	$custpoqty='';
	$rmspec=$myrow[12];
	$drgiss=$myrow[13];
	$partiss=$myrow[14];

	$cos=$myrow[17];
	$batchnum=$myrow[20];
	$itemnum=$myrow[16];
	$custpodate=$myrow[6];
	$custponum=$myrow[4];
	$disp_update=$myrow[9];
	$supplier_wonum ='';

//echo $partnum.'----'.$woqty.'---------'.$compqty.'---------'.$grnnum.'---------'.$custpoqty.'---------'.$rmspec.'---------'.$drgiss.'---------'.$partiss.'---------'.$cos.'---------'.$batchnum.'---------'.$itemnum.'---------'.$custpodate.'---------'.$custponum.'---------'.$disp_update;
      }
}
else
{
       $result = $newdli->gettreat4wo($crn,$disp2cust,$wonum);
       while ($myrow = mysql_fetch_row($result)) 
       {
          $disputd = '';
          $result_disputd = $newdli->getdisputd4treat($myrow[1],$myrow[18]);
          $myrow_disp =  mysql_fetch_row($result_disputd);
          $disputd = $myrow_disp[9];
         if($disputd == '')
         {
           $disputd = 0;
         }
	$partname=$myrow[11];
	$partnum=$myrow[2];
	$woqty=$myrow[7];
	$compqty=$myrow[19];
	$grnnum=$myrow[3];
	$custpoqty='';
	$rmspec=$myrow[12];
	$drgiss=$myrow[13];
	$partiss=$myrow[14];

	$cos=$myrow[17];
	$batchnum=$myrow[20];
	$itemnum=$myrow[16];
	$custpodate=$myrow[6];
	$custponum=$myrow[4];

	$disp_update=$myrow[9];
	$supplier_wonum =$myrow[18];
       }

}
$newdli->setpartnum($partnum);
$newdli->setwoqty($woqty);
$newdli->setcompqty($compqty);
$newdli->setgrnnum($grnnum);
$newdli->setcustpo_qty($custpoqty);
$newdli->setpartname($partname);
$newdli->setrmspec($rmspec);
$newdli->setdrgiss($drgiss);
$newdli->setpartiss($partiss);
$newdli->setcos($cos);
$newdli->setBatchnum($batchnum);
$newdli->setitemnum($itemnum);
$newdli->setcustpo_date($custpodate);
$newdli->setcustpo_num($custponum);
$newdli->setsupplier_wonum($supplier_wonum);
$newdli->addLI();
$status='added';
header("Location:dispatchDetails.php?disprecnum=$disprecnum");
}
?>
