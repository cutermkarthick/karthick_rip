<?php
//
//==============================================
// Author: FSI                                 =
// Date-written =Nov 2,2006                    =
// Filename: bomDetails.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'bomDetails';
//////session_register('pagename');
$bomrecnum=$_REQUEST['bomrecnum'];
$_SESSION['bomrecnum'] = $bomrecnum ;
//////session_register('bomrecnum');
$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];

// First include the class definition
include('classes/bomClass.php');
include('classes/displayClass.php');
include('classes/bomliClass.php');
$newbom = new bom;
$newBOMLI = new bomli;
$newdisplay = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/bom.js"></script>
<?php
$result = $newbom ->getBOMDetails($bomrecnum);
$result1 = $newbom ->getBOMDetails($bomrecnum);
$myrow = mysql_fetch_assoc($result);
$myrow1=mysql_fetch_row($result1);
if ( isset ( $_REQUEST['status'] ) )
{
     $status=$_REQUEST['status'];
     if($status=='Prelim' && $myrow["status"] =='Prelim')
     {
		$_SESSION['pagename'] = 'editablePrelim';
		//////session_register('pagename');
      }
     if($status=='Prelim' && $myrow["status"] !='Prelim')
     {
		$_SESSION['pagename'] = 'noneditablePrelim';
		//////session_register('pagename');
      }

    if($status=='Initial' && $myrow["status"] =='Initial')
    {
		$_SESSION['pagename'] = 'editableInitial';
		//////session_register('pagename');
     }
    if($status=='Initial' && $myrow["status"] !='Initial')
    {
		$_SESSION['pagename'] = 'noneditableInitial';
		//////session_register('pagename');
     }

    if($status=='Final')
     {
		$_SESSION['pagename'] = 'final';
		//////session_register('pagename');

     }
}
?>
<html>
<head>
<title><?php ?>BOM Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='bomDetails.php?bomrecnum=<?php echo "$bomrecnum";?>' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>


<table width=100% cellspacing="0" cellpadding="6" border="0">

<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
    <a href="exit.php" onMouseOut="MM_swapImgRestore()"
    onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0"
     src="images/logout.gif"></a>
</td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
</table>

<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
	<td width="6"><img src="images/spacer.gif " width="6"></td>
	<td bgcolor="#FFFFFF">
		<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr><td><span class="heading"><b><?php ?>Bom Details</b></td>

<td align="right">
    <img src="images/bu-print.gif" alt="Print BoardWO" onclick="javascript: printBom(status)">
   <!--
    <img src="images/bu-activitylog.gif" alt="Get InvXsactions"  onclick="javscript:GetInvXsaction()">
   -->
</td>

</tr>
</tr>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr><td bgcolor="#EEEFEE"  colspan=5 align="center"><span class="heading"><b>General Information</b></td></tr>
<tr bgcolor="#FFFFFF" width=100%>
<td><span class="labeltext"><p align="left">*Customer Name</p></font></td>
<td ><span class="tabletext"><?php echo $myrow["name"]?>

</td>
<td><span class="labeltext"><p align="left">*BOM #</p></td>
<td  ><span class="tabletext"><?php echo $myrow["bomnum"]?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">*BOM Date</p></font></td>
<td ><span class="tabletext">
<?php
$d=substr($myrow["bomdate"],8,2);
$m=substr($myrow["bomdate"],5,2);
$y=substr($myrow["bomdate"],0,4);

$x=mktime(0,0,0,$m,$d,$y);
$date=date("M j, Y",$x);
//$date=date("jS F Y",$x);
echo "$date";
//$fdate=date("D j F Y",$x);
//echo "$fdate";
?>
</td>
<td><span class="labeltext"><p align="left">BOM Type</p></font></td>
<td ><span class="tabletext"><?php echo $myrow["type"]?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">App Engineer</p></font></td>
<td ><span class="tabletext"><?php echo "$myrow1[7] $myrow1[17]";?></td>

</td>
<td><span class="labeltext"><p align="left">Sales/Support Engineer</p></font></td>
<td ><span class="tabletext"><?php echo "$myrow1[8] $myrow1[18]";?>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">BOM Desc</p></font></td>
<td><span class="tabletext"><?php echo $myrow["bomdescr"]?></td>
<td><span class="labeltext"><p align="left">Make/Buy</p></font></td>
<td ><span class="tabletext"><?php echo $myrow["makebuy"]?></td>
</tr>

<tr bgcolor="#FFFFFF">
<!--
<td><span class="labeltext"><p align="left">Work Order No&nbsp;</p></font></td>
<td><span class="tabletext"><?php echo "$myrow[14]";?>
</td>
<input type="hidden" name="worecnum" value="<?php echo "$myrow[13]";?>">
-->
<td><span class="labeltext"><p align="left">Status&nbsp;</p></font></td>
<td><span class="tabletext"><?php echo $myrow["status"]?></td>
<td><span class="labeltext"><p align="left">Quote No&nbsp;</p></font></td>
<td><span class="tabletext"><?php echo $myrow["id"]?></td>
<input type="hidden" name="quoterecnum" value="<?php echo $myrow["link2quote"]?>">
</tr>
<!--
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Work Center</p></font></td>
<td colspan=3><span class="tabletext"><?php echo  $myrow["workcenter"]?></td>
</tr>
-->
<?php
/*
                 if($status == 'Prelim')
                {*/
        $result = $newBOMLI->getLIprelim($bomrecnum);
        echo "<tr><td bgcolor=\"#EEEFEE\"  colspan=5 align=\"center\"><span class=\"heading\"><b>BOM Line Items</b></td></tr>";
	/*}
               if($status == 'Initial')
                {
	         $result = $newBOMLI->getLIinitial($bomrecnum);
	          echo "<tr><td bgcolor=\"#EEEFEE\"  colspan=5 align=\"center\"><span class=\"heading\"><b>Initial Bom Line Items</b></td></tr>";
	}

                 if($status == 'Final')
	{
	         $result = $newBOMLI->getLIfinal($bomrecnum);
	         echo "<tr><td bgcolor=\"#EEEFEE\"  colspan=5 align=\"center\"><span class=\"heading\"><b>Finalized Bom Line Items</b></td></tr>";
	}
*/
?>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Description</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Work Center</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Value</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Manufacturer</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Mfr P/N</b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Part #</b></td>
<?php
  if ($userrole == 'PE' || $userrole == 'SU')
  {
	echo "<td bgcolor=\"#EEEFEE\" width=11%><span class=\"heading\"><b>Supplied By</b></td>";
}
?>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Qty</b></td>
<?php
  if ($userrole == 'PE' || $userrole == 'SU')
  {
	echo"<td bgcolor=\"#EEEFEE\" width=6%><span class=\"heading\"><b>Rate</b></td>";
	echo"<td bgcolor=\"#EEEFEE\" width=6%><span class=\"heading\"><b>Amount</b></td>";
   }
?>

<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Comments</b></td>
<?php
	while ($myLI = mysql_fetch_assoc($result))
	{
    printf('<tr bgcolor="#FFFFFF">
	        <td ><span class="tabletext">%s</td>
	        <td ><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>',
        $myLI["line_num"],$myLI["item_desc"],$myLI["workcenter"],
        $myLI["item_value"],$myLI["mfr"],$myLI["mfr_pn"],$myLI["item_name"]);

           if ($userrole == 'PE' || $userrole == 'SU')
 	      {
	    	   printf('<td><span class="tabletext">%s</td>',$myLI["supplied_by"]);
	       }
	       printf('<td><span class="tabletext">%s</td>',$myLI["qty"]);
	       if ($userrole == 'PE' || $userrole == 'SU')
 	      {
		printf('<td align="center"><span class="tabletext">$%.2f</td>',$myLI["rate"]);
		printf('<td align="center"><span class="tabletext">$%.2f</td>',$myLI["amount"]);
	      }
	         printf('<td><span class=\"tabletext\">%s</td>',$myLI["comments"]);
	         printf('</tr>');
	}
?>
<tr>
</tr>

</table>
</td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table>
</table>
</form>
</body>
</html>
