<?php
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: mtltrk.php                        =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Mtl Track Details                           =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
header("Location: login.php" );
}
// Includes
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/mtl_trackerclass.php');
include('classes/liClass.php');
include('classes/helperClass.php');
$help = new helper;

$usertype = $_SESSION['usertype'];
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'mtltrk_details';
$page = "Purchasing: Mtl Tracker";
//////////////////session_register('pagename');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisplay = new display;
$newMT = new mtl_trk;
$newPO = new po_line_items;
$ponum = $_REQUEST['ponum'];
$dept=$_SESSION['department'];
$result = $newMT->getmtltrk_details($ponum);
$myrow = mysql_fetch_row($result);
$result1 = $newMT->getmtltrk_li($ponum);
?>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mtltrk.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>Material Tracker Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>

<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">

<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>

<td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>

</tr>
</table>


<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>

</td></tr>
<tr>
<td> -->
<?php
// $newdisplay->dispLinks('');
if($myrow[9] != '0000-00-00' && $myrow[9] != '' && $myrow[9] != 'NULL')
{
$datearr = split('-', $myrow[9]);
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
?>
</td></tr>
</table>

<!-- <table width=100% border=0 cellpadding=0 cellspacing=0  >

<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table style="width:100%" border=0 cellpadding=6 cellspacing=0  >
<tr>
<td><span class="pageheading"><b>Material Tracker</b></td>
<?php
$tem = $newPO->getLI4mtltrk($ponum);





?>

<td align=right>
	<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='edit_mtltrk.php?ponum=<?php echo $ponum ?>'" value="Edit" >
<!-- <a href ="edit_mtltrk.php?ponum=<?php echo $ponum ?>" >
<img name="Image8" border="0" src="images/bu-edit.gif" ></a> -->
<?php if($usertype !="VEND") {?>
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="javscript:displayActivityLog(<?php echo $ponum ?>)" value="Activity Log" >
<!-- <img src="images/bu-activitylog.gif" alt="Get ActLog"  onclick="javscript:displayActivityLog(<?php echo $ponum ?>)">  -->
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="javascript:printmtltrk(<?php echo "'" . $ponum . "'"?>)" value="Print" >
<!-- <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript:printmtltrk(<?php echo "'" . $ponum . "'"?>)"> -->
<?php }?>
</td>
</tr>


<form action='' method='post' enctype='multipart/form-data'>
<tr>
<td colspan=2>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Material Tracker Header</b></center></td>
</tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

<tr bgcolor="#FFFFFF">
<td colspan=4 bgcolor="#FFFFFF"><span class="labeltext"><p align="center">PO#/Date</p></td>
<td colspan=5><span class="tabletext"><?php echo $myrow[1]." / ". $podate ?></td>
<td colspan=5 bgcolor="#FFFFFF"><span class="labeltext"><p align="center">Supplier</p></td>
<td colspan=11><span class="tabletext"><?php echo "$myrow[3]<br>$myrow[4],$myrow[5]<br>$myrow[6]-$myrow[7]<br>ph-$myrow[8]." ?></td>
</tr>

<tr bgcolor="#FFFFFF">

<td colspan=4><span class="labeltext"><p align="center">CIM</p></font></td>
<!--<td class="cnf"><span class="labeltext"><p align="center">C&F</p></font></td>-->
<td <?php if($usertype == 'VEND' || $usertype == 'EMPL') echo 'colspan=7'; else echo 'colspan=6'; ?>  class="sup"><span class="labeltext"><p align="center"><?php echo $myrow[3]; ?></p></font></td>
<?php if($usertype == 'EMPL' || $usertype == 'VEND')
{
?>
<td colspan=7><span class="labeltext"><p align="center">CIM</p></font></td> 
<?php
}
?>

<?php if($usertype == 'FF' || $usertype == 'EMPL')
{
?>
<!--<td><span class="labeltext"><p align="center">CIM</p></font></td>-->
<?php
}
?>

<?php if($usertype == 'CF' || $usertype == 'EMPL')
{?>
<!--<td><span class="labeltext"><p align="center">CIM</p></font></td>-->
<?php
}
?>
<!--<td>&nbsp;</td>-->
</tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
	<thead>
<th class="head0" width=6%><span class="labeltext"><p align="center">Line #</p></font></td>
<th class="head1" width=6%><span class="labeltext"><p align="center">Mtl Spec</p></font></td>
<th class="head0" width=6%><span class="labeltext"><p align="center">Qty</p></font></td>
<th class="head1" width=6%><span class="labeltext"><p align="center">Delivery <br>Date</p></font></td>
<th class="head0" width=6%><span class="labeltext"><p align="center">Inv#</p></font></td>
<th class="head1" width=6%><span class="labeltext"><p align="center">Inv Date</p></font></td>
<th class="head0" width=6%><span class="labeltext"><p align="center">Inv Qty</p></font></td>
<th class="head1" width=6%><span class="labeltext"><p align="center">P/S #</p></font></td>
<th class="head0" width=6%><span class="labeltext"><p align="center">B/L #</p></font></td>
<th class="head1" width=6%><span class="labeltext"><p align="center">B/L Date</p></font></td>



<th class="head0" width=6%><span class="labeltext"><p align="center">Credit Note</p></font></td>

<?php if($usertype == 'VEND' || $usertype == 'EMPL')
{
?>
<!--<td width=6%><span class="labeltext"><p align="center">Pay Due Dt</p></font></td>
<td width=6%><span class="labeltext"><p align="center">Pay Exp Dt</p></font></td>-->
<th class="head1" width=6%><span class="labeltext"><p align="center">Received Dt</p></font></td>

<th class="head0" width=6%><span class="labeltext"><p align="center">Diff</p></font></td>
<th class="head1" width=6%><span class="labeltext"><p align="center">NC</p></font></td>


<th class="head0" width=6%><span class="labeltext"><p align="center">Acc<br>Qty</p></font></td>

<th class="head1" width=6%><span class="labeltext"><p align="center">Rej<br>Qty</p></font></td>

<th class="head0" width=6%><span class="labeltext"><p align="center">Quar</p></font></td>

<th class="head1" width=6%><span class="labeltext"><p align="center">Remark</p></font></td>


<?php
}

?>



</tr>
</thead>

<?php

$i=1;
$partname = '';
while ($myLI = mysql_fetch_row($result1)) 
{  
// echo "<pre>"; print_r($myLI); exit;
$j = 0;
$result3 = $newPO->getLI4mtltrk($ponum);

while ($myLI1 = mysql_fetch_assoc($result3)) {
//echo "hiiiiiiiiiiiii $ponum";

if($myLI1["duedate"] != '' && $myLI1["duedate"] != '0000-00-00')
{
$datearr = split('-', $myLI1["duedate"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$due[$j]=date("j M Y",$x);
}
else
{
$due[$j] = '';
}

$j++;
}

$adv_license_qty = 'adv_license_qty' . $i;
$invnum ='invnum' . $i;
$invdate = 'invdate' . $i;
$invqty ='invqty' . $i;

$supdel_date ='supdel_date' . $i;
$paydue_date ='paydue_date' . $i;
$payexp_date ='payexp_date' . $i;

$pick_date ='pick_date' . $i;
$sail_date ='sail_date' . $i;
$eda ='eda' . $i;
$aad ='aad' . $i;
$expclr_date ='expclr_date' . $i;
$cfdel_date ='cfdel_date' . $i;

$date2 = $myLI[2];
if($date2 == '0000-00-00')
{
$date2 = '';
}
$date4 = $myLI[23];
if($date4 == '0000-00-00')
{
$date4 = '';
}
$date5 = $myLI[5];
if($date5 == '0000-00-00')
{
$date5 = '';
}
$date6 = $myLI[6];
if($date6 == '0000-00-00')
{
$date6 = '';
}
$date7 = $myLI[7];
if($date7 == '0000-00-00')
{
$date7 = '';
}

$date8 = $myLI[8];
if($date8 == '0000-00-00')
{
$date8 = '';
}

$date9 = $myLI[9];
if($date9 == '0000-00-00')
{
$date9 = '';
}

$date10 = $myLI[10];
if($date10 == '0000-00-00')
{
$date10 = '';
}

$date11 = $myLI[11];
if($date11 == '0000-00-00')
{
$date11 = '';
}

$date12 = $myLI[12];
if($date12 == '0000-00-00')
{
$date12 = '';
}

$date13 = $myLI[19];
if($date13 == '0000-00-00')
{
$date13 = '';
}

$date14 = $myLI[20];
if($date14 == '0000-00-00')
{
$date14 = '';
}

$date15 = $myLI[21];
if($date15 == '0000-00-00')
{
$date15 = '';
}

$date16 = $myLI[22];
if($date16 == '0000-00-00')
{
$date16 = '';
}

$date17 = $myLI[25];
if($date17 == '0000-00-00')
{
$date17 = '';
}

$date18 = $myLI[26];
if($date18 == '0000-00-00')
{
$date18 = '';
}

$date19 = $myLI[27];
if($date19 == '0000-00-00')
{
$date19 = '';
}

$date20 = $myLI[28];
if($date20 == '0000-00-00')
{
$date20 = '';
}

$date21 = $myLI[29];
if($date21 == '0000-00-00')
{
$date21 = '';
}


if($partname != $myLI[15])
{
//echo "<table id=\"mtltrk$i\"  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\" >";
echo "<tr bgcolor=\"#FFFFFF\">";
echo "<td width=6%><span class=\"tabletext\">$myLI[24]</td>";
echo "<td width=6%><span class=\"labeltext\"><p align=\"center\">$myLI[30]</p></font></td>";
$myLI[16]=$myLI[16]?$myLI[16]:$myLI[18];
echo "<td width=6%><span class=\"tabletext\">$myLI[16]</td>";
//$myLI[23]
echo "<td width=6%><span class=\"tabletext\">$date4</td>";
echo "<td width=6%><span class=\"tabletext\">$myLI[1]</td>";
echo "<td width=6%><span class=\"tabletext\">$date2</td>";
echo "<td width=6%><span class=\"tabletext\">$myLI[3]</td>";
echo "<td width=6%><span class=\"tabletext\">$date17</td>";
echo "<td width=6%><span class=\"tabletext\">$date18</td>";


echo "<td width=6%><span class=\"tabletext\">$date19</td>";
if($usertype == 'VEND' || $usertype == 'EMPL')
{
/* echo "<td width=6%><span class=\"tabletext\">$date5</td>";
echo "<td width=6%><span class=\"tabletext\">$date6</td>";*/
}
echo "<td width=6%><span class=\"tabletext\">$date7</td>";
echo "<td width=6%><span class=\"tabletext\">$date8</td>";
echo "<td width=6%><span class=\"tabletext\">$date9</td>";
if($usertype == 'FF' || $usertype == 'EMPL')
{
echo "<td width=6%><span class=\"tabletext\">$date13</td>";
echo "<td width=6%><span class=\"tabletext\">$date14</td>";
}
echo "<td width=6%><span class=\"tabletext\">$date10</td>";
echo "<td width=6%><span class=\"tabletext\">$date20</td>";
echo "<td width=6%><span class=\"tabletext\">$date21</td>";
echo "<td width=6%><span class=\"tabletext\">$date11</td>";
echo "<td width=6%><span class=\"tabletext\">$date12</td>";
if($usertype == 'CF' || $usertype == 'EMPL')
{

echo "<td width=6%><span class=\"tabletext\">$date15</td>";
echo "<td width=6%><span class=\"tabletext\">$date16</td>";
}
}
else
{
echo "<tr bgcolor=\"#FFFFFF\">";
echo "<td width=6%><span class=\"tabletext\">$myLI[24]</td>";
echo "<td width=6%><span class=\"labeltext\"><p align=\"center\">$myLI[30]</p></font></td>";
$myLI[16]=$myLI[16]?$myLI[16]:$myLI[18];
// echo "<td width=6%><span class=\"tabletext\"><p align=\"center\">$myLI[18]</p></font></td>";
echo "<td width=6%><span class=\"tabletext\">$myLI[16]</td>";
if($myLI[23]!='' && $myLI[23]!='0000-00-00')
$newDate = date("M d, Y", strtotime($myLI[23]));
else
$newDate='';
echo "<td width=7%><span class=\"tabletext\">$newDate</td>";
echo "<td width=6%><span class=\"tabletext\">$myLI[1]</td>";
if($date2!='' && $date2!='0000-00-00')
$newDate = date("M d, Y", strtotime($date2));
else
$newDate='';
echo "<td width=6%><span class=\"tabletext\">$newDate</td>";
echo "<td width=6%><span class=\"tabletext\">$myLI[3]</td>";
echo "<td width=6%><span class=\"tabletext\">$date17</td>";
echo "<td width=6%><span class=\"tabletext\">$date18</td>";
if($myLI[27]!='' && $myLI[27]!='0000-00-00')
$newDate = date("M d, Y", strtotime($myLI[27]));
else
$newDate='';
echo "<td width=6%><span class=\"tabletext\">$newDate</td>";

if($myLI[34]!=0&&$myLI[36]=='')
{
echo "<td style='background-color:red;' width=6%>
<span class=\"tabletext\">$myLI[36]</td>";
}
else
{
echo "<td width=6%><span class=\"tabletext\">$myLI[36]</td>";
}



if($usertype == 'VEND' || $usertype == 'EMPL')
{


$flag=$newMT->getQuar($ponum,$myLI[24]);
$value1=$newMT->getnc($myLI[24],$myrow[1],$myrow[3]);
//echo $myLI[24]."===".$myrow[1];
//echo $value[0]."===".$value[1];
//echo "====".$myLI[31]."===".$date19;
//echo $query;

if(($myLI[31]!='0000-00-00' && $myLI[31]!='') && 
($myLI[27]!='0000-00-00' && $myLI[27]!=''))
{
$days=$help->dateDiff('-', $myLI[31],$myLI[27] );
if($days<0) $days='';
}
else
{
$days='';
}


/*echo "<td width=6%><span class=\"tabletext\">$date5</td>";
echo "<td width=6%><span class=\"tabletext\">$date6</td>";*/
if($myLI[31]!='0000-00-00'&& $myLI[31]!='')
$newDate = date("M d, Y", strtotime($myLI[31]));
else
$newDate='';
echo "<td width=6%><span class=\"tabletext\">$newDate</td>";
echo "<td width=6%><span class=\"tabletext\">$days</td>";
echo "<td width=6%><span class=\"tabletext\">$value1[0]</td>";

$days='';
echo "<td width=6%><span class=\"tabletext\">$myLI[33]</td>";
echo "<td width=6%><span class=\"tabletext\">$value1[1]</td>";

if($flg==1)
{
echo "<td width=6%><span class=\"tabletext\">Yes</td>";
echo "<td width=6%><span class=\"tabletext\">Credit Note<br>Due Amount $$$$</td>";
}
else
{
echo "<td width=6%><span class=\"tabletext\">No</td>";
echo "<td width=6%><span class=\"tabletext\">$rw[0]</td>";
}



}









//echo "<td width=6%><input type='image' name='Print' src='images/bu-print.gif' value='Print' onclick='javascript:printmtltrkrow(" . $ponum . ',' . $myLI[0] .")'></td>";
}

$i++;
$partname = $myLI[15];
}
echo "<input type=\"hidden\" name=\"index\" value=\"$i\">";
?>
</tr>
<tr bgcolor="#EEEEEE">
</table>
</table>


<?php if($usertype != 'FF' && $usertype != 'CF')
{
?>


<table width=100% border=0 cellpadding=0 cellspacing=0  >

<tr>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  class="stdtable1">
<tr>
<td><span class="pageheading"><b>Original PO</b></td>

</tr>


<tr>
<td colspan=2>
<table style="width:80%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<?
printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for %s</b></center></td></tr>',$myrow[1]);
$po_notes = $newMT->getNotes($ponum);
printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes1" rows="6" cols="100" style="background-color:#DDDDDD;" readonly="readonly" >');
while ($mynotes = mysql_fetch_row($po_notes))
{    


print("\n");
print("********Added by $mynotes[2] *********** on $mynotes[1] ");
print("\n");
print(" $mynotes[0]");
print("   \n");
}
?>
</textarea></td>
</tr>

<table style="width:80%" border=0 cellpadding=0 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<?
printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for Supplier</b></center></td></tr>',$myrow[1]);
$sup_notes = $newMT->get_mtl_supplier_notes($ponum);

printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes2" rows="6" cols="100" style="background-color:#DDDDDD;" readonly="readonly" >');
while ($mynotes1 = mysql_fetch_row($sup_notes))
{    

print("\n");
print("********Added by $mynotes1[2] *********** on $mynotes1[1] ");
print("\n");
print(" $mynotes1[0]");
print("   \n");
}
?>
</textarea></td>
</tr>


</table>
<div style="width:80%; overflow-x: scroll;">
<table style="width:80%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
<thead>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Ln</b></td>
<!--<td bgcolor="#EEEFEE"2><span class="heading"><b>RM Code</b></td>-->
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>M/R</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>M/S</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>UOM</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Dia</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Len</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Width</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Thick</br>ness</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Grainflow</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>No. of<br>Meters req</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>No. of<br>Lengths req</b></td>			
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Accepted</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Dispatch Due Date</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Supplier Agreed Dispatch Date1</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>CIM Approval<br>for Dispatch <br> Date1</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Supplier Agreed Dispatch Date2</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>CIM Approval<br>for Dispatch <br> Date2</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Delv Mode</b></td>
<?
if($dept != 'purch1')
{?>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Rate</b></td>
<th class="head1" bgcolor="#EEEFEE" align="right"><span class="heading"><b>Amount</b></td>
<?}?>
</tr>

<?php
$total = 0;
$i = 0;
$ft=0;    
$result3 = $newPO->getLI4mtltrk($ponum);
while ($myLI = mysql_fetch_assoc($result3)) {
if ($ft == 0) {
$curr = $myLI["currency"];
$poamount = $myLI["poamount"];
$ft = 1;
}
//echo "hiiiiiiiiiiiii $ponum";

if($myLI["duedate"] != '0000-00-00' && $myLI["duedate"] != '' && $myLI["duedate"] != 'NULL')
{
$cim_date = strtotime($myLI["duedate"]);
$datearr = split('-', $myLI["duedate"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date=date("M j, Y",$x);
}
else
{
$cim_date = "";
$date = '';
}
if($myLI["due_date1"] != '0000-00-00' && $myLI["due_date1"] != '' && $myLI["due_date1"] != 'NULL')
{
$due1 = strtotime($myLI["due_date1"]);
$datearr = split('-', $myLI["due_date1"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date1=date("M j, Y",$x);
}
else
{
$due1 = "";
$date1 = '';
}

if (!empty($due1) && !empty($cim_date)) {

$days_old=round(abs($cim_date-$due1)/60/60/24)."days";
if ($days_old > 15) {
$bgcolor='red';
}else{
$bgcolor='#FFFFFF';
}


}else{
$bgcolor='#FFFFFF';

}


if($myLI["due_date2"] != '0000-00-00' && $myLI["due_date2"] != '' && $myLI["due_date2"] != 'NULL')
{
$datearr = split('-', $myLI["due_date2"]);
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
//echo "$date";
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
$no_of_meterages = $myLI["no_of_meterages"];
$no_of_lengths = $myLI["no_of_lengths"];
$crn1 = $myLI["crn"];
$status = $myLI["status"];


$i = $i + 1;

if($status =='Open')
{
$color = '#00FF00';

}
else
{
$color = '#FFFFFF';
}
echo"<tr bgcolor='$color'><td ><span class=\"tabletext\">$line_num</td>" ;
//echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$item_name</td>";
//                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
echo"<td ><span class=\"tabletext\">$crn1</td>";
echo"<td ><span class=\"tabletext\">$material_ref</td>";
echo"<td ><span class=\"tabletext\">".wordwrap($material_spec,15,"<br/> \n",true)."</td>";
echo"<td ><span class=\"tabletext\">$uom</td>";
echo"<td ><span class=\"tabletext\">$dia</td>";
echo"<td ><span class=\"tabletext\">$width</td>";
echo"<td ><span class=\"tabletext\">$length</td>";
echo"<td ><span class=\"tabletext\">$thick</td>";
echo"<td ><span class=\"tabletext\">$grainflow</td>";
echo"<td ><span class=\"tabletext\">$no_of_meterages</td>";
echo"<td ><span class=\"tabletext\">$no_of_lengths</td>";			 
echo"<td ><span class=\"tabletext\">$accdate</td>";
echo"<td ><span class=\"tabletext\">$date</td>";
echo"<td><span class=\"tabletext\">$date1</td>";

echo "<td ><span class=\"tabletext\">$myLI[cim1_approval]</td>";

echo"<td ><span class=\"tabletext\">$date2</td>";

echo"<td ><span class=\"tabletext\">$myLI[cim2_approval]</td>";
echo"<td ><span class=\"tabletext\">$delvby</td>";

if($dept != 'purch1')
{
printf('<td align="right"  ><span class="tabletext">%s %.2f</td>',$myLI["currency"],$myLI["rate"]);
printf('<td align="right" ><span class="tabletext">%s %.2f</td>',$curr,$myLI["amount"]);
}
$total += $myLI["amount"];
}

if($dept != 'purch1')
{?>
<tr>
<td bgcolor="#FFFFFF" colspan=20 align="right"><span class="tabletext"><b>Total</b></td>
<td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$curr,$total); ?></td>
</tr>
<?}?>
</span></td></tr>
</table>
</table>
</table>
</thead>
<?php } ?>




</FORM>


<table border=0 bgcolor="#FFFFFF" width=100%  cellspacing=1 cellpadding=3>
<tr>
<td>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>


</tr></table>
</table>


</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->

</table>

</FORM>


</table>

</body>
</html>
