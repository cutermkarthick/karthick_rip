<?php
//
//==============================================
// Author: FSI                                 =
// Date-written =May 26,2005                   =
// Filename: bomDetails.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];

//$_SESSION['pagename'] = 'bomDetails'; 
////////session_register('pagename');
$bomrecnum=$_SESSION['bomrecnum'];
//$_SESSION['bomrecnum'] = $bomrecnum ;
////////session_register('bomrecnum');

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
$myrow=mysql_fetch_row($result);
?>

<html>
<head>
<title>Print BOM</title>
</head>

<table width=650 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Service Request</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>
  
<table width=660 border=1 rules=none>
<tr bgcolor="#FFFFFF" width=100%>
<td><span class="labeltext"><p align="left">*Customer Name</p></font></td>
<td ><span class="tabletext"><?php echo "$myrow[6]";?>

</td>
<td><span class="labeltext"><p align="left">*BOM #</p></td>
<td  ><span class="tabletext"><?php echo "$myrow[0]";?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">*BOM Date</p></font></td>
<td ><span class="tabletext"><?php echo "$myrow[3]";?>
</td>
<td><span class="labeltext"><p align="left">BOM Type</p></font></td>
<td ><span class="tabletext"><?php echo "$myrow[1]";?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">App Engineer</p></font></td>
<td ><span class="tabletext"><?php echo "$myrow[7]";?></td>

</td>
<td><span class="labeltext"><p align="left">Sales/Support Engineer</p></font></td>
<td ><span class="tabletext"><?php echo "$myrow[7]";?>
</td>
</tr>
<tr bgcolor="#FFFFFF">
    <td><span class="labeltext">Status</td>
    <td ><span class="tabletext"><?php echo "$myrow[5]";?>
            </td>
<td colspan=2>&nbsp;</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">BOM Desc</p></font></td>
<td colspan=7><span class="tabletext"><?php echo "$myrow[2]";?></td>
</tr>
<tr><td bgcolor="#FFFFFF" colspan=5 align="center"><span class="heading"><b>Prelim/Final</b></font></td></tr>

<table id="myTable1" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Name</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Description</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Value</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Manufacturer</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Mfr P/N</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Supplied By</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Qty</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Rate</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Amount</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Comments</b></td>

<?php
	$resultp = $newBOMLI->getLIprelim($bomrecnum);
	while ($myLIp = mysql_fetch_row($resultp))
	{	
	               $resultf = $newBOMLI->getLIfinal4Compare($bomrecnum,$myLIp[0]);
		while ($myLIf = mysql_fetch_row($resultf))
		{	
		        printf('<tr bgcolor="#FFFFFF">');
		        echo "<td ><span class=\"tabletext\">$myLIp[0]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIp[12]</td>";
	 	        echo "<td><span class=\"tabletext\">$myLIp[2]</td>";
		        echo "<td><span class=\"tabletext\">$myLIp[3]</td>";
		        echo "<td><span class=\"tabletext\">$myLIp[5]</td>";
		        echo "<td><span class=\"tabletext\">$myLIp[6]</td>";	
		        echo "<td><span class=\"tabletext\">$myLIp[4]</td>";
		        echo "<td><span class=\"tabletext\">$myLIp[7]</td>";
		        echo "<td><span class=\"tabletext\">$myLIp[8]</td>";
		        echo "<td><span class=\"tabletext\">$myLIp[9]</td>";
		        echo "<td><span class=\"tabletext\">$myLIp[10]</td>";
		        printf('</tr>');

		        printf('<tr bgcolor="#FFFFFF">');
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIf[0]</td>";
		        echo "<td  bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIf[12]</td>";
	 	        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIf[2]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIf[3]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIf[5]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIf[6]</td>";	
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIf[4]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIf[7]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIf[8]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIf[9]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIf[10]</td>";
		        printf('</tr>');
		}

	}       
?>

</tr>


<tr><td bgcolor="#FFFFFF" colspan=11 align="center"><span class="heading"><b>Line Items Only In Prelim</b></font></td></tr>


<table id="myTable2" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Name</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Description</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Value</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Manufacturer</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Mfr P/N</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Supplied By</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Qty</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Rate</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Amount</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Comments</b></td>

<?php
	$resultp = $newBOMLI->getLI4prelim($bomrecnum);
	while ($myLIp = mysql_fetch_row($resultp))
	{	
		        printf('<tr bgcolor="#FFFFFF">');
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[0]</td>";
		        echo "<td  bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[12]</td>";
	 	        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[2]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[3]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[5]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[6]</td>";	
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[4]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[7]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[8]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[9]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[10]</td>";
		        printf('</tr>');

	}       
?>

</tr>


<tr><td bgcolor="#FFFFFF" colspan=11 align="center"><span class="heading"><b>Line Items Only In Final</b></font></td></tr>


<table id="myTable3" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Name</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Description</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Value</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Manufacturer</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Mfr P/N</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Supplied By</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Qty</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Rate</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Amount</b></td>
<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Comments</b></td>

<?php
	$resultp = $newBOMLI->getLI4final($bomrecnum);
	while ($myLIp = mysql_fetch_row($resultp))
	{	
		        printf('<tr bgcolor="#FFFFFF">');
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[0]</td>";
		        echo "<td  bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[12]</td>";
	 	        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[2]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[3]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[5]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[6]</td>";	
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[4]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[7]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[8]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[9]</td>";
		        echo "<td bgcolor=\"#EEEFEE\" ><span class=\"tabletext\">$myLIp[10]</td>";
		        printf('</tr>');

	}       
?>

</tr>



     </table>
    </td>
</tr>
</table>



</body>
</html>
