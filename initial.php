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




$_SESSION['pagename'] = 'initial'; 
//////session_register('pagename');
 $bomrecnum  =$_SESSION['bomrecnum'];

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

<html>
<head>
<title>BOM Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='initial.php?bomrecnum=<?php echo "$bomrecnum";?>' method='post' enctype='multipart/form-data'>

<?php
include('header.html');
$result = $newbom ->getBOMDetails($bomrecnum);
$myrow=mysql_fetch_row($result);
if ( isset ( $_REQUEST['status'] ) )
{
     $status=$_REQUEST['status'];
}
else
{
      $status=$myrow[5];
}
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
<tr><td><span class="heading"><i>Bom Details</i></td>
<td align=right><a href="javascript:printBom('<?php echo $status ?>')"><img name="Image7" border="0" src="images/bu-print.gif"></a></td>
</tr>
</tr>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
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
<td ><span class="tabletext"><?php echo "$status";?>
</td>
</tr>
<tr bgcolor="#FFFFFF">
    <td><span class="labeltext">Status</td>
<?php
                 if($myrow[5] == 'Finalize')
                {
        		echo "<td><span class=\"tabletext\"><input type=\"text\" name=\"status\" size=10  value=\"$status\" onkeypress=\"javascript: return checkenter(event)\">
		        <span class=\"tabletext\"><select name=\"statusval\" size=\"1\" width=\"100\" onchange=\"onSelectStatus1()\">
		        <option selected>$status
		        <option value>Please Specify
		        <option value>Prelim
		        <option value>Finalize
		        </select>
		</td>";
	}
	else
	    echo "<td ><span class=\"tabletext\">$status </td>";
?>
<td colspan=2>&nbsp;</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">BOM Desc</p></font></td>
<td colspan=3><span class="tabletext"><?php echo "$myrow[2]";?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Work Order No&nbsp;</p></font></td>
<td><span class="tabletext"><?php echo "$myrow[14]";?>
</td>
<input type="hidden" name="worecnum" value="<?php echo "$myrow[13]";?>">
<td><span class="labeltext"><p align="left">Quote No&nbsp;</p></font></td>
<td><span class="tabletext"><?php echo "$myrow[16]";?>
</td>
<input type="hidden" name="quoterecnum" value="<?php echo "$myrow[15]";?>">
</tr>           		
<?php
                 if($status == 'Prelim')
                {
	         $result = $newBOMLI->getLIprelim($bomrecnum);
	          echo "<tr><td bgcolor=\"#EEEFEE\"  colspan=5 align=\"center\"><span class=\"heading\"><b>Preliminary Bom</b></td></tr>";
	}
                else
	{
	         $result = $newBOMLI->getLIfinal($bomrecnum);
	         echo "<tr><td bgcolor=\"#EEEFEE\"  colspan=5 align=\"center\"><span class=\"heading\"><b>Finalized Bom</b></td></tr>";
	}
?>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
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
	while ($myLI = mysql_fetch_row($result))
	{	
	        printf('<tr bgcolor="#FFFFFF">');
	        echo "<td ><span class=\"tabletext\">$myLI[0]</td>";
	        echo "<td ><span class=\"tabletext\">$myLI[12]</td>";
	        echo "<td><span class=\"tabletext\">$myLI[2]</td>";
	        echo "<td><span class=\"tabletext\">$myLI[3]</td>";
	        echo "<td><span class=\"tabletext\">$myLI[5]</td>";
	        echo "<td><span class=\"tabletext\">$myLI[6]</td>";
	        echo "<td><span class=\"tabletext\">$myLI[4]</td>";
	        echo "<td><span class=\"tabletext\">$myLI[7]</td>";
	        echo "<td><span class=\"tabletext\">$myLI[8]</td>";
	        echo "<td><span class=\"tabletext\">$myLI[9]</td>";
	        echo "<td><span class=\"tabletext\">$myLI[10]</td>";
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




