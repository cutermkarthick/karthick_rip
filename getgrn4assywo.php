<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 17, 2013                =
// Filename: getgrn4assywo.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Popup for selecting GRN                     =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
include('classes/assywoClass.php');
$newassywo = new assywo;
$partnum=$_REQUEST['partnum'];
$type=$_REQUEST['type'];

$result = $newassywo->getgrns4assywo($partnum);
   $grnarr = array();
   $result1 = $newassywo->getassywoqty4grn();
   while ($myrow = mysql_fetch_row($result1)) 
   {
        $grnnum = "'" . $myrow[0] . "'";
        $grnarr[$grnnum] = $myrow[1];
   }
   $pattern="/[$&*\"\'\/\\-\\s\;\,\:#!.,+]/";
//print_r($grnarr);
 if($type=='Consummables')
 {
   $result_type = $newassywo->getallgrns4cons($type);
 }
 else
 {
 $result_part = $newassywo->getallgrns4assy($partnum);
 }
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All GRN's</title>
</head>
<body onload=self.focus()>
<form>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

<table>
<tr><td><span class="pageheading"><b>GRN</b></td></tr>
<tr><td>
	<table style="table-layout: fixed" width=800px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
        <td width=4% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
        <td width=6% bgcolor="#EEEFEE"><span class="tabletext"><b>GRN</b></td>
        <td width=12% bgcolor="#EEEFEE"><span class="tabletext"><b>Batch<br>#</b></td>
        <td width=7% bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></td>
        <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>PRN<br>Num</b></td>
        <td width=5% bgcolor="#EEEFEE"><span class="tabletext"><b>Raw Mat<br>Type</b></td>
        <td width=5% bgcolor="#EEEFEE"><span class="tabletext"><b>Raw Mat<br>Spec</b></td>
        <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Expiry<br>Date</b></td>
       </tr>
</table>
<div style="width:820px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=800px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?
        if($type !='Consummables')
               {
                 while ($myrow = mysql_fetch_row($result_part) )
                  {
					 $part_num =(preg_replace($pattern,"", $_REQUEST['partnum']));
                   $partnumber=(preg_replace($pattern,"", $myrow[7]));
                  // echo $myrow[8]."*--*-**-*-$part_num ---- $partnumber<br>";
                  if(($part_num == $partnumber))
                  {
                     $ret_qty = 0;
                     $retqtyres = $newassywo->get_woretqty($myrow[1]);
                     $total=0; $i=0;
                     $retqtyrow = mysql_fetch_row($retqtyres);
                     $ret_qty = $retqtyrow[1];
                     $grnnum = "'" . $myrow[1] . "'";
                     $grnli = $newassywo->getgrnli($myrow[0]);

                 while($myrowli = mysql_fetch_row($grnli))
                 {
                   if($myrowli[17] =='')
                 {

                  $total = $total + $myrowli[9];
                  //echo"---------------<br>" .$total."----------------<br>".$myrowli[9];
                  }
                 }

                     if (isset($grnarr[$grnnum]))
                     {
                        $qty = $total - $grnarr[$grnnum] + $ret_qty;
                        //echo $qty."------------";
                     }
                     else
                     {
                        $qty = $total;
                        //echo $qty."****************";
                     }
					 if ($qty > 0)
	                 {
?>

    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=4%><input type="radio" id="crn"  name="crn"   value="<?php echo $myrow[0]?>"></td>
	<td width=6% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
    <td width=12%><span class="tabletext"><?php echo $myrow[2] ?></td>
    <td width=7%><span class="tabletext"><?php echo $qty ?></td>
    <td width=10%><span class="tabletext"><?php echo $myrow[4] ?></td>
    <td width=5%><span class="tabletext"><?php echo $myrow[5] ?></td>
     <td width=5%><span class="tabletext"><?php echo $myrow[6] ?></td>
     <td width=10%><span class="tabletext"><?php echo $myrow[9] ?></td>
      </tr>
<?php
        }
	 }
                  }
                  }
                  else
                  {
                  while ($myrow = mysql_fetch_row($result_type) )
                  {
                  //echo $myrow[8]."2222----";
                   $part_num =(preg_replace($pattern,"", $_REQUEST['partnum']));
                   $partnumber=(preg_replace($pattern,"", $myrow[7]));
                   //echo $myrow[8]."*--*-**-*-";
                  //if(($part_num == $partnumber))
                  //{
                     $ret_qty = 0;
                     $retqtyres = $newassywo->get_woretqty($myrow[1]);
                     $total=0; $i=0;
                     $retqtyrow = mysql_fetch_row($retqtyres);
                     $ret_qty = $retqtyrow[1];
                     $grnnum = "'" . $myrow[1] . "'";
                     $grnli = $newassywo->getgrnli($myrow[0]);

                 while($myrowli = mysql_fetch_row($grnli))
                 {
                   if($myrowli[17] =='')
                 {

                  $total = $total + $myrowli[9];
                  //echo"---------------<br>" .$total."----------------<br>".$myrowli[9];
                  }
                 }

                     if (isset($grnarr[$grnnum]))
                     {
                        $qty = $total - $grnarr[$grnnum] + $ret_qty;
                        //echo $qty."------------";
                     }
                     else
                     {
                        $qty = $total;
                        //echo $qty."****************";
                     }
                     if ($qty > 0)
	                 {?>
						 <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=4%><input type="radio" id="crn"  name="crn"   value="<?php echo $myrow[0]?>"></td>
	<td width=6% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
    <td width=12%><span class="tabletext"><?php echo $myrow[2] ?></td>
    <td width=7%><span class="tabletext"><?php echo $qty ?></td>
    <td width=10%><span class="tabletext"><?php echo $myrow[4] ?></td>
    <td width=5%><span class="tabletext"><?php echo $myrow[5] ?></td>
     <td width=5%><span class="tabletext"><?php echo $myrow[6] ?></td>
     <td width=10%><span class="tabletext"><?php echo $myrow[8] ?></td>
      </tr>
 <?}?>
</table>
 </div>
<script language=javascript>
function Submitgrn(etype) {
var ind = document.forms[0].crn.selectedIndex;
window.opener.SetGRN(document.forms[0].crn[ind].text,document.forms[0].crn[ind].value,etype);
if (ind == 0)
{ alert("Please select a GRN");
  return false;
}
self.close();
}
</script>

<input type=button value="Submit" onclick="javascript: return Submitgrn(window.name)">
</form>

</html>

