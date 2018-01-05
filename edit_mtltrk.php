<?php
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: edit_mtltrk.php                   =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Board details                               =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
header("Location:login.php");
}
// Includes
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/mtl_trackerclass.php');
include('classes/liClass.php');
include('classes/helperClass.php');
$help = new helper;

//$space='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'edit_mtltrk';
////////////session_register('pagename');

$usertype = $_SESSION['usertype'];
// echo $usertype;
//echo $_SESSION['userrole'];
$userid = $_SESSION['user'];
$dept=$_SESSION['department'];
$page = "Purchasing: Mtl Tracker";
if ( !isset ( $_SESSION['ms'] ) )
{
$_SESSION['ms']=0;
}

//echo $usertype;
//echo $userid;

$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisplay = new display;
$newMT = new mtl_trk;
$newPO = new po_line_items;

$ponum = $_REQUEST['ponum'];
$result = $newMT->getmtltrk_details($ponum);
$myrow = mysql_fetch_row($result);

// echo "<pre>"; print_r($ponum);

$result1 = $newMT->getmtltrk_li($ponum);
if(isset($_REQUEST['error']))
{
$err = $_REQUEST['error'];
$invnum = $_REQUEST['invnum'];
if($err == 1)
{
$error = "Inv Date should be max of 15 days greater than Delivery Date for invnum $invnum";
}
else if($err == 2)
{
$error = "Vendor Pay Due Date should be greater than Inv Date for invnum $invnum";
}
else if($err == 3)
{	
$error = "Pick Date should be greater than Inv Date for invnum $invnum";
}
else if($err == 4)
{
$error = "Sail Date should be greater than Pick Date for invnum $invnum";
}
else if($err == 5)
{
$error = "EDA should be greater than Sail Date for invnum $invnum";
}
else if($err == 6)
{
$error = "FF Pay Due Date should be greater than EDA for invnum $invnum";
}
else if($err == 7)
{
$error = "AAD should be greater than EDA for invnum $invnum";
}
else if($err == 8)
{
$error = "Exp Cl Dt should be greater than aad for invnum $invnum";
}
else if($err == 9)
{
$error = "CF Delivery Date should be greater than Exp Cl Dt for invnum $invnum";
}
else if($err == 10)
{

$error = "CF Pay Due Date should be greater than CF Delivery Date for invnum $invnum";
}
else if($err == 11)
{

$error = "Vendor Pay Due Date should be entered for invnum $invnum";
}
else if($err == 12)
{

$error = "CF Pay Due Date should be entered for invnum $invnum";
}
else if($err == 13)
{

$error = "CF Pay Due Date should be entered for invnum $invnum";
}
//echo $error;
}
else
{
$error = '';
}   
$checked="checked";




?>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mtltrk.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>
<script language="javascript" src="scripts/popcalendar.js"></script>
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


<!-- <table width=100% border=0 cellpadding=0 cellspacing=0 >
<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
<table style="width:100%" border=0 cellpadding=0 cellspacing=0 >
<td bgcolor="#FFFFFF">
<table style="width:100%" border=0 cellpadding=6 cellspacing=0  class="stdtable1">
<tr>
<td width=24%><span class="pageheading"><b>Material Tracker</b></td>
<td align=left class=tabletext><font color='#ff0000'><?php echo $error; ?></font>
</td>
</tr>

<form action='processmtltrk.php' method='GET' enctype='multipart/form-data'>
<tr>
<td colspan=2>
<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Material Tracker Header</b></center></td>
</tr>
<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr bgcolor="#FFFFFF">

<td colspan=4 bgcolor="#FFFFFF"><span class="labeltext"><p align="center">PO#/Date</p></td>
<td colspan=5><span class="tabletext"><?php echo $myrow[1]." / ". $podate ?></td>
<input type='hidden' name='ponumber' value=<?php echo $myrow[1]; ?>>
<td colspan=5 bgcolor="#FFFFFF"><span class="labeltext"><p align="center">Supplier</p></td>
<td colspan=11><span class="tabletext"><?php echo "$myrow[3]<br>$myrow[4],$myrow[5]<br>$myrow[6]-$myrow[7]<br>ph-$myrow[8]." ?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td colspan=25 align=right>&nbsp</td>
</tr>

<tr bgcolor="#FFFFFF">
<td colspan=4><span class="labeltext"><p align="center">CIM</p></font></td>
<!--<td class="cnf"><span class="labeltext"><p align="center">C&F</p></font></td>-->
<td 
<?php 
if($usertype == 'VEND' || $usertype == 'EMPL') 
echo 'colspan=7'; 
else echo 'colspan=7'; 
?> 
class="sup">
<span class="labeltext"><p align="center"><?php echo $myrow[3]; ?></p></font></td>
<?php 
if($usertype == 'VEND' || $usertype == 'EMPL')
{
?>
<td colspan=7><span class="labeltext"><p align="center">CIM</p></font></td> 
<?php
}
?>


<?php if($usertype == 'FF' || $usertype == 'EMPL')
{?>
<!--<td><span class="labeltext"><p align="center">CIM</p></font></td>-->
<?php
}
?>

<?php if($usertype == 'CF' || $usertype == 'EMPL')
{
?>
<!--<td><span class="labeltext"><p align="center">CIM</p></font></td>-->
<?php
}
?>

</tr>
<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
	<thead>
<tr>
<td width=2% class="head0"><span class="labeltext"><p align="center">LN</p></font></td>
<td width=2% class="head1"><span class="labeltext"><p align="center">Mtl Spec</p></font></td>
<td width=2% class="head0"><span class="labeltext"><p align="center">Qty</p></font></td>
<!-- <td width=6%> <span class="labeltext"><p align="center">Adv Lic Qty</p></font></td> -->
<td width=2% class="head1"><span class="labeltext"><p align="center">Del <br>Date</p></font></td>
<td width=2% bgcolor="#FF9900"><span class="labeltext"><p align="center">Inv</p></font></td>
<td width=3% bgcolor="#FF9900"><span class="labeltext"><p align="center">Inv Dt</p></font></td>
<td width=2% bgcolor="#FF9900"><span class="labeltext"><p align="center">Inv Qty</p></font></td>
<td width=2% bgcolor="#FF9900"><span class="labeltext"><p align="center">P/S #</p></font></td>
<td width=2% bgcolor="#FF9900"><span class="labeltext"><p align="center">B/L #</p></font></td>
<td width=2% bgcolor="#FF9900"><span class="labeltext"><p align="center">B/L Dt</p></font></td>


<td width=2% bgcolor="#FF9900"><span class="labeltext"><p align="center">Credit Note#</p></font></td>

<?php 
/*if($usertype == 'EMPL' || $usertype == 'VEND')
{
<td width=3% bgcolor="#FF9900"><span class="labeltext"><p align="center">Pay Due Dt</p></font></td>
<?php

} if($usertype == 'EMPL' || $usertype == 'VEND')
{
<td><span class="labeltext"><p align="center">Pay Exp Dt</p></font></td>-->
<?
}*/

if($usertype == 'EMPL' || $usertype == 'VEND')
{?>
<td style="width:2%" class="head0"><span class="labeltext"><p align="center">Received Dt</p></font></td>

<td width=2% class="head1"><span class="labeltext"><p align="center">Diff</p></font></td>

<td width=2% class="head0"><span class="labeltext"><p align="center">NC</p></font></td>

<td width=2% class="head1"><span class="labeltext"><p align="center">Acc<br>Qty</p></font></td>
<td width=2% class="head0"><span class="labeltext"><p align="center">Rej<br>Qty</p></font></td>
<td width=2% class="head1"><span class="labeltext"><p align="center">Quar</p></font></td>
<td width=2% class="head0"><span class="labeltext"><p align="center">Remarks</p></font></td>

<?
}
?>

<?php if($usertype == 'EMPL' || $usertype == 'CF')
{?>
<!--<td bgcolor="#659EC7"><span class="labeltext"><p align="center">Pay Due Dt</p></font></td>
<td><span class="labeltext"><p align="center">Pay Exp Dt</p></font></td>
-->
<?php
}
?>
</tr>

<?php

$i=1;
$polirecnum = '';
$var1=0;
$var2=0;
while ($myLI = mysql_fetch_row($result1)) {
$var1++;

$j = 0;
$result3 = $newPO->getLI4mtltrk($ponum);

while ($myLI1 = mysql_fetch_assoc($result3)) {
$var2++;
//echo "hiiiiiiiiiiiii $ponum";
//echo "====".$myLI1['cim1_approval'];
if($myLI1["duedate"] != '0000-00-00' && $myLI1["duedate"] != '' && $myLI1["duedate"] != 'NULL')
{
$datearr = split('-',$myLI1["duedate"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$due[$j]=date("M j, Y",$x);
}
else
{
$due[$j] = '';
}
$j++;
if($var2==$var1)
{
$approv2=$myLI1['cim2_approval'];
$approv1=$myLI1['cim1_approval'];
}

}
$var2=0;
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
$link2mtltracker ='link2mtltracker' . $i;
$prevlinenum="prev_line_num" . $i;
$lirecnum="lirecnum" . $i;
$partnum = 'partnum' . $i;
$ffpaydue_date ='ffpaydue_date' . $i;
$ffpayexp_date ='ffpayexp_date' . $i;
$cfpaydue_date ='cfpaydue_date' . $i;
$cfpayexp_date ='cfpayexp_date' . $i;
$packnum = 'packnum' . $i;
$bill_lading_num ='bill_lading_num' . $i;
$bil_lading_date ='bil_lading_date' . $i;
$docket_num ='docket_num' . $i;
$boe_num ='boe_num' . $i;
$recd_date ='recd_date' . $i;
$credit_note='credit_note'.$i;
$delv_by ='delv_by' . $i;
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
// echo "<br>date12 is   $myLI[12]";
if($date12 == '0000-00-00')
{
// echo "Here";
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

$date15 = trim($myLI[21]);
if($date15 == '0000-00-00')
{
$date15 = '';
}

$date16 = trim($myLI[22]);
if($date16 == '0000-00-00')
{
$date16 = '';
}

$date17 = $myLI[25];

$date18 = $myLI[26];

$date19 = $myLI[27];
if($date19 == '0000-00-00')
{
$date19 = '';
}					
$date20 = $myLI[28];
$date21 = $myLI[29];      
echo "<input type=\"hidden\" name=\"ms\" id=\"ms\" value=\"1\">";	


//*******************************************************************//			

$flag=$newMT->getQuar($ponum,$myLI[24]);
//echo $myrow[1];
$value=$newMT->getnc($myLI[24],$myrow[1],$myrow[3]);

if($polirecnum != $myLI[17])
{
echo "<tr bgcolor=\"#FFFFFF\" >";
echo "<td width=1% ><span class=\"labeltext\"><p align=\"center\">$myLI[24]</p></font></td>";
echo "<td width=2% ><span class=\"labeltext\"><p align=\"center\">$myLI[30]</p></font></td>";
$myLI[16]=$myLI[16]?$myLI[16]:$myLI[18];
echo "<td width=2% ><span class=\"tabletext\"><p align=\"center\">$myLI[16]</p></font></td>";

if(($usertype == 'VEND') && ($myLI[22] == '' || $myLI[22] =='0000-00-00'))
{
if($usertype == 'VEND')
{
if($date7 == '')
{
if($date4!='' && $date!='0000-00-00')
$newDate = date("M d, Y", strtotime($date4));
else
$newDate='';
echo "<td width=1%><span class=\"tabletext\"><p align=\"left\">$newDate</p></font></td>";
if($myLI[1]=='')
echo "<td width=3%><input type=\"textbox\" size=\"2\" name=\"$invnum\" id=\"$invnum\"  value=\"$myLI[1]\"></td>";
else
echo "<td width=3%><input type=\"textbox\" readonly size=\"2\" name=\"$invnum\" id=\"$invnum\"  value=\"$myLI[1]\" style=\"background-color:#DFDFDF;\"></td>";
//echo "====".$var1;
if(($approv2 == 'yes' || $approv1 == 'yes') && 
($date2 == '0000-00-00' || $date2 ==''))
{

echo "<td  width=4%><input type=\"textbox\" size=\"9\" name=\"$invdate\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\" readonly='readonly' style=\"background-color:#DFDFDF;\">
<img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$invdate')\"></td>"; 
}
else
{

echo "<td  width=3%><input type=\"textbox\" size=\"9\" name=\"$invdate\" id=\"$invdate\"  value=\"$date2\" style=\"background-color:#DFDFDF;\" readonly='readonly' ></td>";   

}

if($myLI[3]=='')
echo "<td width=2%><input type=\"textbox\" size=\"2\" name=\"$invqty\" value=\"$myLI[3]\"></td>";
else
echo "<td width=2%><input type=\"textbox\" readonly size=\"2\" name=\"$invqty\" value=\"$myLI[3]\" style=\"background-color:#DFDFDF;\"></td>";

if($date17=='')
echo "<td><input type=\"textbox\" size=\"6\" name=\"$packnum\" id=\"$packnum\" value=\"$date17\"></td>";
else
echo "<td><input type=\"textbox\" size=\"6\" readonly name=\"$packnum\" id=\"$packnum\" value=\"$date17\" style=\"background-color:#DFDFDF;\"></td>";

if($date18=='')
echo "<td><input type=\"textbox\" size=\"6\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" value=\"$date18\"></td>";
else
echo "<td><input type=\"textbox\" readonly size=\"6\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" value=\"$date18\" style=\"background-color:#DFDFDF;\"></td>";

if(($date19 != '0000-00-00' && $date19 !='')||
($approv2 != 'yes' && $approv1 != 'yes'))
{
echo "<td><input type=\"textbox\" size=\"12\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" value=\"$date19\" style=\"background-color:#DFDFDF;\" readonly='readonly'></td>";  
}
else
{
echo "<td><input type=\"textbox\" size=\"12\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" value=\"$date19\"  readonly='readonly' style=\"background-color:#DFDFDF;\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$bil_lading_date')\"></td>";
}			
//...................................
//echo $myLI[34]."======";
if($myLI[36]=='' && $value[1]>0)
echo "<td><input type=\"textbox\" size=\"9\" name=\"$credit_note\" id=\"$credit_note\" value=\"$myLI[36]\"></td>";  
else
echo "<td>$myLI[36]<input type=\"hidden\" size=\"9\" name=\"$credit_note\" id=\"$credit_note\" readonly  value=\"$myLI[36]\" style=\"background-color:#DFDFDF;\"></td>";  


echo "<td style='display:none'><input type='hidden' size=\"9\" name=\"$paydue_date\" id=\"$paydue_date\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\"></td>";
?>
<input type='hidden' size=\"9\" name=\"$paydue_date\" id=\"$paydue_date\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\">
<?
echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$supdel_date','$supdel_date');\" value=\"$date4\">";

echo "<input type=\"hidden\" name=\"$delv_by\" id=\"$delv_by\" size=\"7\"
value=\"$myLI[32]\">";
}               
else if($date6 == '')
{
echo "<td><span class=\"tabletext\">$date4</td>";
echo "<td><span class=\"tabletext\">$myLI[1]</td>";
echo "<td><span class=\"tabletext\">$date2</td>";
echo "<td><span class=\"tabletext\">$myLI[3]</td>";
echo "<td><span class=\"tabletext\">$date17</td>";
echo "<td><span class=\"tabletext\">$date18</td>";
echo "<td><span class=\"tabletext\">$date19</td>";
echo "<td  style='display:none'><input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\"></td>";
?>
<input type='hidden' name=\"$paydue_date\" id=\"$paydue_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\">
<?
echo "<td align=center><a href=\"javascript:addRow('mtltrk$i',document.forms[0].index.value,'$myLI[17]','$date4','ms')\"><img src=\"images/arrow2.gif\" border=0></td>";

// echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\">";
echo "<input type=\"hidden\" name=\"$invnum\" id=\"$invnum\" size=\"7\" value=\"$myLI[1]\">";
echo "<input type=\"hidden\" name=\"$invdate\" size=\"7\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\">";
echo "<input type=\"hidden\" name=\"$invqty\" size=\"7\" value=\"$myLI[3]\">";
echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$supdel_date','$supdel_date');\" value=\"$date4\">";
echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$supdel_date','$supdel_date');\" value=\"$date4\">";
echo "<input type=\"hidden\" name=\"$packnum\" id=\"$packnum\" size=\"8\" value=\"$date17\">";
echo "<input type=\"hidden\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"8\" value=\"$date18\">";
echo "<input type=\"hidden\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$bil_lading_date','$bil_lading_date');\" value=\"$date19\">";
echo "<input type=\"hidden\" name=\"$recd_date\" size=\"7\" value=\"$myLI[31]\">";
}
else
{
echo "<td><span class=\"tabletext\">$date4</td>";
echo "<td><span class=\"tabletext\">$myLI[1]</td>";
echo "<td><span class=\"tabletext\">$date2</td>";
echo "<td><span class=\"tabletext\">$myLI[3]</td>";
echo "<td><span class=\"tabletext\">$date17</td>";
echo "<td><span class=\"tabletext\">$date18</td>";
echo "<td><span class=\"tabletext\">$date19</td>";
echo "<td><span class=\"tabletext\">$date5</td>";

//echo "<td align=center><a href=\"javascript:addRow('mtltrk$i',document.forms[0].index.value,'$myLI[17]','$date4')\"><img src=\"images/arrow2.gif\" border=0></td>";

echo "<input type=\"hidden\" name=\"$invnum\" id=\"$invnum\" size=\"7\" value=\"$myLI[1]\">";
echo "<input type=\"hidden\" name=\"$invdate\" size=\"8\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\">";
echo "<input type=\"hidden\" name=\"$invqty\" size=\"7\" value=\"$myLI[3]\">";
echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$supdel_date','$supdel_date');\" value=\"$date4\">";
echo "<input type=\"hidden\" name=\"$packnum\" id=\"$packnum\" size=\"8\" value=\"$date17\">";
echo "<input type=\"hidden\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"8\" value=\"$date18\">";
echo "<input type=\"hidden\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$bil_lading_date','$bil_lading_date');\" value=\"$date19\">";
echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\">";
echo "<input type=\"hidden\" name=\"$recd_date\" id=\"$recd_date\" size=\"7\" value=\"$myLI[31]\">";
}
}
}
else
{
//echo "here2";
if($date4!='' && $date4 !='0000-00-00')
$newDate = date("M d, Y", strtotime($date4));
else
$newDate='';
echo "<td width=4%><span class=\"tabletext\">$newDate</td>";
echo "<td width=4%><span class=\"tabletext\">$myLI[1]</td>";
if($date2!='' &&$date2!='0000-00-00')
$newDate = date("M d, Y", strtotime($date2));
else
$newDate='';
echo "<td width=4%><span class=\"tabletext\">$newDate</td>";
echo "<td width=4%><span class=\"tabletext\">$myLI[3]</td>";
echo "<td width=4%><span class=\"tabletext\">$date17</td>";
echo "<td width=4%><span class=\"tabletext\">$date18</td>";
if($date19!='' && $date19!='0000-00-00')
$newDate = date("M d, Y", strtotime($date19));
else
$newDate='';
echo "<td width=4%><span class=\"tabletext\">$newDate</td>";



echo "<input type=\"hidden\" name=\"$invnum\" id=\"$invnum\" size=\"7\" value=\"$myLI[1]\">";
echo "<input type=\"hidden\" name=\"$invdate\" size=\"7\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\">";
echo "<input type=\"hidden\" name=\"$invqty\" size=\"7\" value=\"$myLI[3]\">";
echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$supdel_date','$supdel_date');\" value=\"$date4\">";

echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\">";

echo "<input type=\"hidden\" name=\"$packnum\" id=\"$packnum\" size=\"8\" value=\"$date17\">";
echo "<input type=\"hidden\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"8\" value=\"$date18\">";
echo "<input type=\"hidden\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$bil_lading_date','$bil_lading_date');\" value=\"$date19\">";
}
if(($usertype == 'EMPL' || $usertype == 'VEND') && ($myLI[22] == '' || $myLI[22] =='0000-00-00') && $date5!='')
{
if($usertype == 'EMPL')
{
?>
<input type='hidden' name=\"$payexp_date\" id=\"$payexp_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$payexp_date','$payexp_date');\" value=\"$date6\">
<?
}
else if($usertype == 'VEND')
{
/*echo "<td width=4% style='display:none'><span class=\"tabletext\">$date6</td>";*/
echo "<input type='hidden' name=\"$payexp_date\" id=\"$payexp_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$payexp_date','$payexp_date');\" value=\"$date6\">";

}
}
else
{

if($usertype == 'EMPL' || $usertype == 'VEND')
{

}
echo "<input type='hidden' name=\"$payexp_date\" id=\"$payexp_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$payexp_date','$payexp_date');\" value=\"$date6\">";

}
if(($usertype == 'FF' || $usertype == 'EMPL') &&($myLI[22] == '' || $myLI[22] =='0000-00-00') && $date2 != '' )
{
//echo "here2";
if($usertype == 'FF')
{
if($date10 == '')
{

}                
else if($date14 == '')
{ 

echo "<td width=4%><input type=\"textbox\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$ffpaydue_date','$ffpaydue_date');\" value=\"$date13\"></td>";
echo "<td width=4%><span class=\"tabletext\">$date14</td>";
echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
}                
else
{ 
echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
}
}
else if($usertype == 'EMPL' )
{ 

/*echo "<td width=4%><span class=\"tabletext\">$date9</td>";*/

if($date9 != '')
{
echo "<td width=4% style='display:none'><input type=\"textbox\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$ffpayexp_date','$ffpayexp_date');\" value=\"$date14\"></td>";
}
else
{
echo "<td width=4% style='display:none'><span class=\"tabletext\">$date14</td>";
}
echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
}
}
else
{ 
if($usertype == 'EMPL' || $usertype == 'FF')
{
/*-echo "<td width=4%><span class=\"tabletext\">$date13</td>";
echo "<td width=4%><span class=\"tabletext\">$date14===</td>";*/
}
echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
}
if(($usertype == 'CF' || $usertype == 'EMPL') && ($myLI[22] == '' || $myLI[22] =='0000-00-00')  && $date9 != '')
{
$date12 = $date12 ? $date12 : $space;
$date15 = $date15 ? $date15 : $space;
$date16 = $date16 ? $date16 : $space;

if($usertype == 'CF')
{
if( $date15 == '' || $date15 == $space)
{
echo "<td width=4%><input type=\"textbox\" name=\"$aad\" id=\"$aad\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$docket_num\" id=\"$docket_num\" size=\"8\" value=\"$date20\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$boe_num\" id=\"$boe_num\" size=\"8\" value=\"$date21\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\"></td>";
//echo "<td width=6%><span class=\"tabletext\">" . $date15 . "</td>";
echo "<td width=4%><input type=\"textbox\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfpaydue_date','$cfpaydue_date');\" value=\"$date15\"></td>";
echo "<td width=4%><span class=\"tabletext\">" . $date16 . "</td>";
echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";
}                
else if( $date16 == '' || $date16 == $space)
{
echo "<td width=4%><span class=\"tabletext\">$date10</td>";
echo "<td width=4%><span class=\"tabletext\">$date20</td>";
echo "<td width=4%><span class=\"tabletext\">$date21</td>";
echo "<td width=4%><span class=\"tabletext\">$date11</td>";
echo "<td width=4%><span class=\"tabletext\">" . $date12 . "</td>";
echo "<td width=4%><input type=\"textbox\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfpaydue_date','$cfpaydue_date');\" value=\"$date15\"></td>";
echo "<td width=4%><span class=\"tabletext\">" . $date16 . "</td>";
echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"8\" value=\"$myLI[28]\">";
echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"8\" value=\"$date21\">";
echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";
echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";
}                
else
{

echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"8\" value=\"$date20\">";
echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"8\" value=\"$date21\">";
echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";
echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";
}
}
else if($usertype == 'EMPL' )
{

if($date12 != '' && $date12 != $space)
{
echo "<td width=4%><input type=\"textbox\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfpayexp_date','$cfpayexp_date');\" value=\"$date16\"></td>";
}
else
{
echo "<td width=4%><span class=\"tabletext\">" . $date16 . "</td>";
}
echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"8\" value=\"$date20\">";
echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"8\" value=\"$date21\">";
echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";
echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
}
}
else
{ 
$date12 = $date12 ? $date12 : $space;
$date15 = $date15 ? $date15 : $space;
$date16 = $date16 ? $date16 : $space;

if($usertype == 'EMPL' || $usertype == 'CF')
{
/*echo "<td width=4%><span class=\"tabletext\">" . $date15 . "</td>";
echo "<td width=4%><span class=\"tabletext\">" . $date16 . "</td>";*/
}
echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"8\" value=\"$date20\">";
echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"8\" value=\"$date21\">";
echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";

echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";
}
}
//....................................................
//echo "===".$value[0]."===".$value[1];
//echo $query;

if($usertype == 'EMPL' || $usertype == 'VEND')
{

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




if($usertype == 'EMPL')
{
echo "<td width=4%><span class=\"tabletext\">$myLI[36]</td>";
echo "<input type=\"hidden\" size=\"9\" name=\"$credit_note\" id=\"$credit_note\" value=\"$myLI[36]\">";

}

if($myLI[31]!='0000-00-00' && $myLI[31]!='')
$newDate = date("M d, Y", strtotime($myLI[31]));
else
$newDate='';
if($usertype == 'EMPL')
{
/*echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$recd_date\" name=\"$recd_date\"
style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"13%\" value=\"$myLI[31]\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$recd_date')\">";*/
echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$newDate."
<input type=\"hidden\" id=\"$recd_date\" name=\"$recd_date\"
style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"13%\" value=\"$myLI[31]\">";
}
else
{
echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$newDate."
<input type=\"hidden\" id=\"$recd_date\" name=\"$recd_date\"
style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"13%\" value=\"$myLI[31]\">";
}



echo "<td width=3%><span class=\"tabletext\">$days</td>";
echo "<td width=3%><span class=\"tabletext\">$value[0]</td>";
echo "<td width=4%><span class=\"tabletext\">$myLI[33]</td>";
echo "<td width=4%><span class=\"tabletext\">$value[1]</td>";

$days='';
if($flg==1)
{
echo "<td width=4%><span class=\"tabletext\">Yes</td>";
echo "<td width=4%><span class=\"tabletext\">Credit Note<br>Due Amount $$$$</td>";
}
else
{
echo "<td width=6%><span class=\"tabletext\">No</td>";
echo "<td width=3%><span class=\"tabletext\">$rw[0]</td>";
}
}
else
{  // echo "hi";
//$date4=$due[$i-2];

echo "<tr bgcolor=\"#FFFFFF\" >";
echo "<td width=4%><span class=\"labeltext\"><p align=\"center\">$myLI[24]</p></font></td>";
echo  "<td width=4%><span class=\"labeltext\"><p align=\"center\">$myLI[15]</p></font></td>";
echo "<td width=4%><span class=\"tabletext\"><p align=\"center\">$myLI[18]</p></font></td>";


if($usertype == 'EMPL' && ($myLI[22] == '' || $myLI[22] =='0000-00-00'))
{
if($myLI[1] == '')
{
$myLI[16]=$myLI[16]?$myLI[16]:$myLI[18];
// echo "<td width=6%><input type=\"textbox\" name=\"$adv_license_qty\" size=\"4\" value=\"$myLI[16]\" onblur=\"javascript:checkValue($myLI[18],this.value,this)\"></td>";
}
// else
//  echo "<td width=6%><span class=\"tabletext\">$myLI[16]</td>";
}

else
{
// echo "<td width=6%><span class=\"tabletext\">$myLI[16]</td>";
//  echo "<input type=\"hidden\" name=\"$adv_license_qty\" size=\"4\" value=\"$myLI[16]\">";
}


/* echo "<tr bgcolor=\"#FFFFFF\" ><td width=6%><span class=\"labeltext\"><p align=\"center\"></p></td>";
echo "<td width=6%><span class=\"tabletext\"><p align=\"center\"></p></font></td>";
echo "<td width=6%></td>";
*/
if(($usertype == 'VEND' || $usertype == 'EMPL') && ($myLI[22] == '' || $myLI[22] =='0000-00-00'))
{
if($usertype == 'VEND')
{
if($date7 == '')
{
echo "<td width=4%><span class=\"tabletext\"><p align=\"center\">$date4</p></td>";
//echo "<td width=6%><input type=\"textbox\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$supdel_date','$supdel_date');\" value=\"$date4\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$invnum\" id=\"$invnum\" size=\"4\" value=\"$myLI[1]\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$invdate\" size=\"8\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$invqty\" size=\"3\" value=\"$myLI[3]\"></td>";
//echo "<td width=6%><span class=\"tabletext\">$date5</td>";
echo "<td width=4%><input type=\"textbox\" name=\"$packnum\" id=\"$packnum\" size=\"8\" value=\"$date17\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"8\" value=\"$date18\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$bil_lading_date','$bil_lading_date');\" value=\"$date19\"></td>";


echo "<td width=4%><input type=\"textbox\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\"></td>";
//echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\" value=\"$date5\">";
echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\" value=\"hi$date4\">";
}

else if($date6 == '')
{

echo "<td width=4%><input type=\"textbox\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\"></td>";
//echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\" value=\"$date5\">";

echo "<input type=\"hidden\" name=\"$invnum\"  id=\"$invnum\" size=\"7\" value=\"$myLI[1]\">";
echo "<input type=\"hidden\" name=\"$invdate\" size=\"7\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\">";
echo "<input type=\"hidden\" name=\"$invqty\" size=\"7\" value=\"$myLI[3]\">";
echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\" value=\"$date4\">";
echo "<input type=\"hidden\" name=\"$packnum\" id=\"$packnum\" size=\"7\" value=\"$date17\">";
echo "<input type=\"hidden\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"7\" value=\"$date18\">";
echo "<input type=\"hidden\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"7\" value=\"$date19\">";
}

else
{



echo "<input type=\"hidden\" name=\"$invnum\" id=\"$invnum\" size=\"7\" value=\"$myLI[1]\">";
echo "<input type=\"hidden\" name=\"$invdate\" size=\"7\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\">";
echo "<input type=\"hidden\" name=\"$invqty\" size=\"7\" value=\"$myLI[3]\">";
echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\" value=\"$date4\">";
echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\" value=\"$date5\">";
echo "<input type=\"hidden\" name=\"$packnum\" id=\"$packnum\" size=\"7\" value=\"$date17\">";
echo "<input type=\"hidden\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"7\" value=\"$date18\">";
echo "<input type=\"hidden\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"7\" value=\"$date19\">";
}
}
if($usertype == 'EMPL')
{

//if($date4 != '')
//{
//   echo "<td width=6%><input type=\"textbox\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\"></td>";
//}
// else
// {
echo "<td width=4%><span class=\"tabletext\">$date5</td>";
//}
echo "<input type=\"hidden\" name=\"$invnum\" id=\"$invnum\" size=\"7\" value=\"$myLI[1]\">";
echo "<input type=\"hidden\" name=\"$invdate\" size=\"7\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\">";
echo "<input type=\"hidden\" name=\"$invqty\" size=\"7\" value=\"$myLI[3]\">";
echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\" value=\"$date4\">";
echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\" value=\"$date5\">";
echo "<input type=\"hidden\" name=\"$packnum\" id=\"$packnum\" size=\"7\" value=\"$date17\">";
echo "<input type=\"hidden\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"7\" value=\"$date18\">";
echo "<input type=\"hidden\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"7\" value=\"$date19\">";
}

}

else
{


if($usertype == 'EMPL' || $usertype == 'VEND')
{
echo "<td width=4%><span class=\"tabletext\">$date5</td>";
}


echo "<input type=\"hidden\" name=\"$invnum\" id=\"$invnum\"  size=\"7\" value=\"$myLI[1]\">";
echo "<input type=\"hidden\" name=\"$invdate\" size=\"7\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\">";
echo "<input type=\"hidden\" name=\"$invqty\" size=\"7\" value=\"$myLI[3]\">";
echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\" value=\"$date4\">";
echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\" value=\"$date5\">";
echo "<input type=\"hidden\" name=\"$packnum\" id=\"$packnum\" size=\"7\" value=\"$date17\">";
echo "<input type=\"hidden\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"7\" value=\"$date18\">";
echo "<input type=\"hidden\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"7\" value=\"$date19\">";
}

echo "<td width=4%></td>";

if(($usertype == 'EMPL' || $usertype == 'VEND') && ($myLI[22] == '' || $myLI[22] =='0000-00-00') && $date5!='')
{

if($usertype == 'EMPL')
{
echo "<td width=4%><input type=\"textbox\" name=\"$payexp_date\" id=\"$payexp_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$payexp_date','$payexp_date');\" value=\"$date6\"></td>";
}
else if($usertype == 'VEND')
{
echo "<td width=4%><span class=\"tabletext\">" . $date6 . "</td>";
echo "<input type='hidden' name=\"$payexp_date\" id=\"$payexp_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$payexp_date','$payexp_date');\" value=\"$date6\">";
}
}
else
{

if($usertype == 'EMPL' || $usertype == 'VEND')
{
echo "<td width=4%><span class=\"tabletext\">$date6</td>";
}
echo "<input type=hidden name=\"$payexp_date\" id=\"$payexp_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$payexp_date','$payexp_date');\" value=\"$date6\">";
}
if(($usertype == 'FF' || $usertype == 'EMPL') && ($myLI[22] == '' || $myLI[22] =='0000-00-00') && $date2 != '')
{
// echo "here3";
if($usertype == 'FF')
{
if($date10 == '')
{
echo "<td width=4%><input type=\"textbox\" name=\"$pick_date\" id=\"$pick_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$sail_date\" id=\"$sail_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$eda\" id=\"$eda\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\"></td>";
//echo "<td width=6%><span class=\"tabletext\">$date13</td>";
echo "<td width=4%><input type=\"textbox\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$ffpaydue_date','$ffpaydue_date');\" value=\"$date13\"></td>";
echo "<td width=4%><span class=\"tabletext\">$date14</td>";
//echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
}

else if($date14 == '')
{

echo "<td width=4%><input type=\"textbox\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$ffpaydue_date','$ffpaydue_date');\" value=\"$date13\"></td>";
echo "<td width=4%><span class=\"tabletext\">$date14</td>";

//echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";

echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
}

else
{


echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
}
}
else if($usertype == 'EMPL')
{

if($date9 != '')
{
//echo "<td width=6%><input type=\"textbox\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$ffpaydue_date','$ffpaydue_date');\" value=\"$date13\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$ffpayexp_date','$ffpayexp_date');\" value=\"$date14\"></td>";
}
else
{
//echo "<td width=6%><span class=\"tabletext\">$date13</td>";
echo "<td width=4%><span class=\"tabletext\">$date14</td>";
echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
}
echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
}

}

else
{
//echo "here2";


if($usertype == 'EMPL' || $usertype == 'FF')
{

}
echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
}

// echo 'date14 ' . $date14;


if(($usertype == 'CF' || $usertype == 'EMPL') && ($myLI[22] == '' || $myLI[22] =='0000-00-00') && $date9 != '')
{
// echo 'hiiiii';
if($usertype == 'CF')
{
if($date15 == '')
{
echo "<td width=4%><input type=\"textbox\" name=\"$aad\" id=\"$aad\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$docket_num\" id=\"$docket_num\" size=\"8\" value=\"$date20\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$boe_num\" id=\"$boe_num\" size=\"8\" value=\"$date21\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\"></td>";
//echo "<td width=6%><span class=\"tabletext\">$date15</td>";
echo "<td width=4%><input type=\"textbox\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfpaydue_date','$cfpaydue_date');\" value=\"$date15\"></td>";
echo "<td width=4%><span class=\"tabletext\">$date16</td>";
// echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";
}

else if($date16 == '')
{

echo "<td width=4%><input type=\"textbox\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfpaydue_date','$cfpaydue_date');\" value=\"$date15\"></td>";
echo "<td width=4%><span class=\"tabletext\">$date16</td>";
// echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";

echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"7\" value=\"$date20\">";
echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"7\" value=\"$date21\">";
echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";
echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";
}              
else
{

echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"7\" value=\"$date20\">";
echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"7\" value=\"$date21\">";
echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";
echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";
}
}
else if($usertype == 'EMPL')
{
;
if($date12 != '' && $date12 != '0000-00-00')
{
//echo "<td width=6%><input type=\"textbox\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfpaydue_date','$cfpaydue_date');\" value=\"$date15\"></td>";
echo "<td width=4%><input type=\"textbox\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfpayexp_date','$cfpayexp_date');\" value=\"$date16\"></td>";
}
else
{
// echo "<td width=6%><span class=\"tabletext\">$date15</td>";

}
echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";
echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"7\" value=\"$date20\">";
echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"7\" value=\"$date21\">";
}
}
else
{
//echo "here";

if($usertype == 'EMPL' || $usertype == 'CF')
{

}

echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";
echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";
echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"7\" value=\"$date20\">";
echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"7\" value=\"$date21\">";
}

}

echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[1]\">";
echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[0]\">";
echo "<input type=\"hidden\" name=\"$partnum\" value=\"$myLI[15]\">";
echo "<input type=\"hidden\" name=\"$link2mtltracker\" value=\"$myLI[17]\">";

$i++;
$polirecnum = $myLI[17];
}

?>
</tr>

</table>
</table>

<?php


echo "<input type=\"hidden\" name=\"index\" id=\"index\"  value=\"$i\">";
echo "<input type=\"hidden\" name=\"ponum\" value=\"$ponum\">";
echo "<input type=\"hidden\" name=\"usertype\" id=\"usertype\"  value=\"$usertype\">";
echo "<input type=\"hidden\" name=\"userid\" value=\"$userid\">";


if($usertype != 'FF' && $usertype != 'CF')
{?>
<table style="width:100%" border=0 cellpadding=0 cellspacing=0  class="stdtable1">
<tr>
<td bgcolor="#FFFFFF">
<table style="width:100%" border=0 cellpadding=6 cellspacing=0  >
<tr>
<td><span class="pageheading"><b>Original PO</b></td>
</tr>

<tr>
<td colspan=2>
<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php

printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for %s</b></center></td>',$myrow[1] );
printf('<td colspan=4><span class="heading"><b>Add Notes (CIM)</b></center></td></tr>');



$po_notes = $newMT->getNotes($ponum);

printf('<tr bgcolor="#FFFFFF"><td colspan=6><textarea name="notes1" rows="6" cols="60" style="background-color:#DDDDDD;" readonly="readonly">');
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

<?php if ($usertype == 'VEND') { ?>
<td colspan=6><textarea name="notes" id="notes" rows="6" cols="60" value="" readonly="readonly" style="background-color:#DDDDDD;"></textarea>
</td> </tr>
<?php  }else{ ?>

<td colspan=6><textarea name="notes" id="notes" rows="6" cols="60" value=""></textarea>
</td> </tr>

<?php }	 ?>

<?php
printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for supplier</b></center></td>',$myrow[1] );

printf('<td colspan=4><span class="heading"><b>Add Notes (Supplier) </b></center></td></tr>');


$sup_notes = $newMT->get_mtl_supplier_notes($ponum);

printf('<tr bgcolor="#FFFFFF"><td colspan=6><textarea name="sup_notes" rows="6" cols="60" style="background-color:#DDDDDD;" readonly="readonly">');
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

<?php   if ($usertype == 'VEND') { 
?>

<td colspan=4><textarea name="notes2" id="notes2" rows="6" cols="60" value="" ></textarea>
</td> </tr>
<?php }else{ ?>

<td colspan=4><textarea name="notes2" id="notes2" rows="6" cols="60" value="" readonly="readonly" style="background-color:#DDDDDD;" ></textarea>
</td> </tr>
</table>

<?php } ?>

<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
<thead>
<td class="head0"><span class="heading"><b>Ln</b></td>
<td class="head1"><span class="heading"><b>Material<br/> Ref</b></td>
<td class="head0"><span class="heading"><b>Material<br/> Spec</b></td>
<td class="head1"><span class="heading"><b>UOM</b></td>
<td class="head0"><span class="heading"><b>Dia</b></td>
<td class="head1"><span class="heading"><b>Length</b></td>
<td class="head0"><span class="heading"><b>Width</b></td>
<td class="head1"><span class="heading"><b>Thickness</b></td>
<td class="head0"><span class="heading"><b>Grainflow</b></td>
<td class="head1"><span class="heading"><b>No.<br/> of <br>Meters req</b></td>
<td class="head0"><span class="heading"><b>No. of <br>Lengths req</b></td>			
<td class="head1"><span class="heading"><b>Accepted</b></td>
<td class="head0"><span class="heading"><b>Dispatch <br/>Due<br/> Date</b></td>			
<td class="head1"><span class="heading"><b>Supplier <br />Agreed<br/> Dispatch<br/> Date1<br></b></td>

<td class="head0"><span class="heading"><b>CIM Approval<br>for Dispatch <br> Date1</b></td>

<td class="head1"><span class="heading"><b>Supplier<br/> Agreed<br/>Dispatch<br/> Date2<br></b></td>

<td class="head0"><span class="heading"><b>CIM<br/> Approval<br>for<br/> Dispatch <br> Date2</b></td>

<td class="head1"><span class="heading"><b>Delv<br/> Mode</b></td>
<?
if($dept != 'purch1')
{?>
<td class="head0"><span class="heading"><b>Rate</b></td>
<td class="head1" align="right"><span class="heading"><b>Amount</b></td>
<?}?> 
</tr>
</thead>
</table>
<div style="width:100%; overflow-x: scroll;">

<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">

<?php
$total = 0;
$i = 0;
$ft=0;    
$result3 = $newPO->getLI4mtltrk($ponum);
while ($myLI = mysql_fetch_assoc($result3)) 
{
if ($ft == 0) 
{
$curr = $myLI["currency"];
$poamount = $myLI["poamount"];
$ft = 1;
}
$date=($myLI["duedate"] != '0000-00-00' )?$myLI["duedate"]:"";
$date1=($myLI["due_date1"] != '0000-00-00' )?$myLI["due_date1"]:"";
$date2=($myLI["due_date2"] != '0000-00-00' )?$myLI["due_date2"]:"";
$accdate=($myLI["accepted_date"] != '0000-00-00' )?$myLI["accepted_date"]:"";

$block='';
$enddate = date('Y-m-d', strtotime($date) + strtotime("+7 day", 0));
// echo $enddate;

// echo strtotime($enddate) < strtotime(date('Y-m-d'));

//echo strtotime($enddate) .'>'. strtotime(date('Y-m-d')).'<br>';
if(strtotime($enddate) < strtotime(date('Y-m-d')))
{
$block='yes';
} 



if($date1 !='' && $date !='' && $date1 !='0000-00-00' && $date !='0000-00-00')
{
$diff=$help->dateDiff("-", $date1, $date);
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

$i = $i + 1;
$linenum="linenum" . $i;
$duedate="due_date" . $i;
$due_datef="due_datef" . $i;
$due_dates="due_dates" . $i;
$accepted_date="accepted_date" . $i;
$cim_due1="cim_due1" . $i;
$cim_due2="cim_due2" . $i;
echo "<input type=\"hidden\" id=\"$linenum\" name=\"$linenum\" value=\"$line_num\">"; 
echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line_num</td>" ;
//echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$item_name</td>";
//                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$material_ref</td>";
echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".wordwrap($material_spec,15,"<br/> \n",true)."</td>";
echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$uom</td>";
echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$dia</td>";
echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$width</td>";
echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$length</td>";
echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$thick</td>";
echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$grainflow</td>";
echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$no_of_meterages</td>";
echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$no_of_lengths</td>";

if(($accdate != '0000-00-00' && $accdate != '') || $block == 'yes')
{
echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$accepted_date\" name=\"$accepted_date\"
style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"13%\" value=\"$accdate\">";
}
else if($usertype != 'EMPL')
{
echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$accepted_date\" name=\"$accepted_date\"
style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"13%\" value=\"$accdate\">";
}

else
{ 
echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$accepted_date\" name=\"$accepted_date\"
style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"13%\" value=\"$accdate\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$accepted_date')\">";
}


if(($date != '0000-00-00' && $date != '' ) || $block == 'yes')
{
echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$duedate\" name=\"$duedate\"
style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"13%\" value=\"$date\">";
}
else
{
echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$duedate\" name=\"$duedate\"
style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"13%\" value=\"$date\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$duedate')\">";
}
if(($date1 != '0000-00-00' && $date1 != '') || $block == 'yes')
{
echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$due_datef\" name=\"$due_datef\"
style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"13%\" value=\"$date1\">";
}
else
{
echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$due_datef\" name=\"$due_datef\"
style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"13%\" value=\"$date1\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$due_datef')\">";
}
$checked="checked";
if($usertype == 'EMPL')
{
if($myLI['cim1_approval'] != '')
{?>
<td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myLI['cim1_approval'] == 'yes'?$checked:"" ?>  id="<?= $cim_due1 ?>" name="<?= $cim_due1 ?>" onclick="return false" readonly value='<?= $myLI['cim1_approval'] ?>'></td>

<?}

else
{ ?>
<td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myLI['cim1_approval'] == 'yes'?$checked:"" ?>  id="<?= $cim_due1 ?>" name="<?= $cim_due1 ?>" onclick="JavaScript:toggleValue_dir('<?= $cim_due1 ?>',this,'<?= $due_datef ?>');" value=''></td>
<?} 
}
else
{?>
<td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myLI['cim1_approval'] == 'yes'?$checked:"" ?>  id="<?= $cim_due1 ?>" name="<?= $cim_due1 ?>" onclick="return false" readonly value='<?= $myLI['cim1_approval'] ?>'  ></td>
<?}
if($date2 != '0000-00-00' && $date2 != '')
{
echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$due_dates\" name=\"$due_dates\"
style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"13%\" value=\"$date2\">";  
}
else
{ 
//................. 

if($date1 !='' )
$diff1=$help->dateDiff("-", $date1, date('Y-m-d'));
// echo "<br>====== $diff1";

if($diff1<20 || $date1=='')
{
echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$due_dates\" name=\"$due_dates\"
style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"13%\" value=\"$date2\">";   
}
else
{					
echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$due_dates\" name=\"$due_dates\"
style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"13%\" value=\"$date2\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDueDate('$due_dates')\">";   
}
}
if($usertype == 'EMPL')
{
if($myLI['cim2_approval'] != '')
{?>
<td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myLI['cim2_approval'] == 'yes'?$checked:"" ?>  id="<?= $cim_due2 ?>" name="<?= $cim_due2 ?>" onclick="return false" readonly value='<?= $myLI['cim2_approval'] ?>'></td>						
<?}
else
{?>
<td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myLI['cim2_approval']  == 'yes'?$checked:"" ?>  id="<?= $cim_due2 ?>" name="<?= $cim_due2 ?>" 
onclick="JavaScript:toggleValue_dir('<?= $cim_due2 ?>',this,'<?= $due_dates ?>');" value=''></td>
<?}
}
else
//...............................................
{?>
<td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myLI['cim2_approval'] == 'yes'?$checked:"" ?>  id="<?= $cim_due2 ?>" name="<?= $cim_due2 ?>" onclick="return false" readonly value='<?= $myLI['cim2_approval'] ?>'></td>

<?}
echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$delvby</td>";						
if($dept != 'purch1')
{
printf('<td bgcolor="#FFFFFF"><span class="tabletext">%s %.2f</td>',$myLI["currency"],$myLI["rate"]);
printf('<td align="right" bgcolor="#FFFFFF"><span class="tabletext">%s %.2f</td>',$curr,$myLI["amount"]);
}
$total += $myLI["amount"];
}	
if($dept != 'purch1')
{?>
<tr>
<td bgcolor="#FFFFFF" colspan=19 align="right"><span class="tabletext"><b>Total</b></td>
<td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$curr,$total); ?></td>
</tr>
<?}?>
</span>
</td></tr>
</table>
</table>
</table>
<?php } ?>
<table border=0 bgcolor="#FFFFFF" width=100%  cellspacing=1 cellpadding=3>
<tr>
<td>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>


</tr></table>
</table>
<input type="hidden" value="<?php echo $myrow[3];?>" name="supp_name" id="supp_name">

<span class="labeltext"><input type="submit"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
value="Submit" name="submit" onclick="javascript: return check_req_fields()">
<INPUT TYPE="RESET"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
VALUE="Reset" onclick="javascript: putfocus()">
</form>
</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->

</table>

</table>

</body>
</html>
