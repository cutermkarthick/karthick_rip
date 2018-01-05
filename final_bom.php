<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = May 26 , 05                  =
// Filename: edit_bom.php                      =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows entry of new BOMs                    =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
if(isset($_REQUEST['bomrecnum']))
{
	$bomrecnum =$_REQUEST['bomrecnum'];
	$_SESSION['bomrecnum'] =$bomrecnum; 
	//////session_register('bomrecnum');
}
else
{
	$bomrecnum = $_SESSION['bomrecnum'];
}

// First include the class definition 
include('classes/bomClass.php'); 
include('classes/displayClass.php'); 
include('classes/bomliClass.php'); 
require_once 'Excel/reader.php';

$newbom = new bom; 
$newBOMLI = new bomli; 
$newdisplay = new display;
?>
<?php
$result = $newbom ->getBOMDetails($bomrecnum);
$myrow=mysql_fetch_row($result);
if(isset($_REQUEST['status']))
{
      $status=$_REQUEST['status'];
}
 if($status == 'newFinal')
{
	$_SESSION['pagename'] = 'newfinal_bom'; 
	//////session_register('pagename');
}
else
{
	$_SESSION['pagename'] = 'editfinal_bom'; 
	//////session_register('pagename');	
}

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/bom.js"></script>
<html>
<head>
<?php
 if($status == 'newFinal')
$head='New Final Bom';
else
$head='Edit Final Bom';
?>
<title><?php echo "$head";?></title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processBOM.php?stat=<?php echo $status?>' method='post' enctype='multipart/form-data'>
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
<tr><td><span class="heading"><b><?php echo "$head";?></b></td>
<td align=right><a href="example.php"><img name="Image7" border="0" src="images/bu-upload-bom.gif" ></a>
</td>
</tr>
</tr>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr><td bgcolor="#DDDEDD"  colspan=5 align="center"><span class="heading"><b>General Information</b></td></tr>
<tr bgcolor="#FFFFFF" width=100%>
<td><span class="labeltext"><p align="left">*Customer Name</p></font></td>
<td ><input type="text" name="company" style=";background-color:#DDDDDD;" 
		 	readonly="readonly" size=25 value="<?php echo "$myrow[6]";?>">
		<img src="images/bu-getcustomer.gif" alt="Get Customer" onclick="GetAllCustomers()">	
</td>
<input type="hidden" name ="companyrecnum" value="<?php echo "$myrow[10]";?>">
<td><span class="labeltext"><p align="left">*BOM #</p></td>
<td ><input type="text" size=30  name="bomnum" value="<?php echo "$myrow[0]";?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">*BOM Date</p></font></td>
<td><input type="text" name="bomdate" 
 		style="background-color:#DDDDDD;" 
		 readonly="readonly" size=25 value="<?php echo "$myrow[3]";?>">
        <img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('bomdate')">	
</td>
<td><span class="labeltext"><p align="left">BOM Type</p></font></td>
<td ><input type="text" size=20 name="type" value="<?php echo "$myrow[1]";?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">App Engineer</p></font></td>
<td><input type="text" name="ae" 
      style=";background-color:#DDDDDD;" 
      readonly="readonly" size=25 value="<?php echo "$myrow[7]";?>">
      	<img name="Get" src="images/bu-getemployee.gif" value="Get Employee"  onclick="GetAllEmps()"></td>

</td>
<td><span class="labeltext"><p align="left">Sales/Support Engineer</p></font></td>
<td><input type="text" name="se" 
      style=";background-color:#DDDDDD;" 
      readonly="readonly" size=25 value="<?php echo "$myrow[8]";?>">
<img src="images/bu-getemployee.gif" alt="Get AE" onclick="GetAllEmps1()">
</td>
<input type="hidden" name= "aerecnum" value="<?php echo "$myrow[11]";?>">
<input type="hidden" name= "serecnum" value="<?php echo "$myrow[12]";?>">

<input type="hidden" name= "upload" value="<?php echo "$upload";?>">
<input type="hidden" name="status" size=25  value="Final">
<input type="hidden" name="quoterecnum" value="<?php echo "$myrow[15]";?>">
<input type="hidden" name="worecnum" value="<?php echo "$myrow[13]";?>">
<input type="hidden" name="prevstatus" value="<?php echo "$myrow[5]";?>">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">BOM Desc</p></font></td>
<td colspan=3><input type="text" size=60 name="desc" value="<?php echo "$myrow[2]";?>" onkeypress="javascript:checkenter(event)"></td>
</tr>

<tr><td bgcolor="#DDDEDD" colspan=5 align="center"><span class="heading"><b>Prelim/Initial</b></font></td></tr>
<tr><td bgcolor="#FFFFFF" colspan=11 ></td></tr>
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
	$bgcolor=1;
	$resultp = $newBOMLI->getLIprelim($bomrecnum);
	while ($myLIp = mysql_fetch_row($resultp))
	{	
	               $resultf = $newBOMLI->getLIfinal4Compare($bomrecnum,$myLIp[0]);
		while ($myLIf = mysql_fetch_row($resultf))
		{	
		        if($bgcolor==1)
		        printf('<tr bgcolor="#FFFFFF">');
                                        else
		        printf('<tr bgcolor="#EEEFEE">');
           
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

		        if($bgcolor==1)
		        printf('<tr bgcolor="#FFFFFF">');
                                        else
		        printf('<tr bgcolor="#EEEFEE">');
		        echo "<td ><span class=\"tabletext\">$myLIf[0]</td>";
		        echo "<td  ><span class=\"tabletext\">$myLIf[12]</td>";
	 	        echo "<td ><span class=\"tabletext\">$myLIf[2]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIf[3]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIf[5]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIf[6]</td>";	
		        echo "<td ><span class=\"tabletext\">$myLIf[4]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIf[7]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIf[8]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIf[9]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIf[10]</td>";
		        printf('</tr>');
		        if($bgcolor==1)
		        $bgcolor=0;
		        else
                                        $bgcolor=1;
		}

	}       
?>

</tr>

<tr><td bgcolor="#FFFFFF" colspan=11 ></td></tr>

<tr><td bgcolor="#DDDEDD" colspan=11 align="center"><span class="heading"><b>Line Items Only In Prelim</b></font></td></tr>
<tr><td bgcolor="#FFFFFF" colspan=11 ></td></tr>

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
		        echo "<td ><span class=\"tabletext\">$myLIp[0]</td>";
		        echo "<td  ><span class=\"tabletext\">$myLIp[12]</td>";
	 	        echo "<td ><span class=\"tabletext\">$myLIp[2]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIp[3]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIp[5]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIp[6]</td>";	
		        echo "<td ><span class=\"tabletext\">$myLIp[4]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIp[7]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIp[8]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIp[9]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIp[10]</td>";
		        printf('</tr>');

	}       
?>

</tr>

<tr><td bgcolor="#FFFFFF" colspan=11 ></td></tr>

<tr><td bgcolor="#DDDEDD" colspan=11 align="center"><span class="heading"><b>Line Items Only In Initial</b></font></td></tr>
<tr><td bgcolor="#FFFFFF" colspan=11 ></td></tr>

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
	$resultp = $newBOMLI->getLI4Initial($bomrecnum);
	while ($myLIp = mysql_fetch_row($resultp))
	{	
		        printf('<tr bgcolor="#FFFFFF">');
		        echo "<td ><span class=\"tabletext\">$myLIp[0]</td>";
		        echo "<td  ><span class=\"tabletext\">$myLIp[12]</td>";
	 	        echo "<td ><span class=\"tabletext\">$myLIp[2]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIp[3]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIp[5]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIp[6]</td>";	
		        echo "<td ><span class=\"tabletext\">$myLIp[4]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIp[7]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIp[8]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIp[9]</td>";
		        echo "<td ><span class=\"tabletext\">$myLIp[10]</td>";
		        printf('</tr>');

	}       
?>

</tr>
<tr><td bgcolor="#FFFFFF" colspan=11 ></td></tr>
<tr><td bgcolor="#DDDEDD"  colspan=11 align="center"><span class="heading"><b>Line Items Of Final</b></font></td></tr>
<tr bgcolor="#FFFFFF"><td colspan=11><a href="javascript:addRow4edit('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
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
</tr>
<?php
                 if($status == 'newFinal')
                {
	         $result = $newBOMLI->getLIinitial($bomrecnum);
	}
                else
               {
	         $result = $newBOMLI->getLIfinal($bomrecnum);
	}
	$i=1;$flag=0;
			while ($myLI = mysql_fetch_row($result))
	 		{	
			        printf('<tr bgcolor="#FFFFFF">');
			        $linenumber="linenum" . $i;	
			        $prevlinenumber="prevlinenum" . $i;
			        $itemname="itemname" . $i;
	                                        $lirecnum="lirecnum" . $i;
			        $itemdesc="itemdesc" . $i;	
			        $value="value" . $i;											
			        $mfr="mfr" . $i;
			        $mfrpn="mfrpn" . $i;
			        $supplier="supplier" . $i;
			        $qty="qty" . $i;
			        $rate="rate" . $i;
			        $amount="amount" . $i;
			        $comments="comments" . $i;
			        echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\"  value=\"$myLI[0]\" size=\"3%\"></td>";
			        echo "<td><input type=\"text\" name=\"$itemname\" size=\"15%\" value=\"$myLI[12]\"></td>";
 			        echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"20%\" value=\"$myLI[2]\"></td>";
			        echo "<td><input type=\"text\" name=\"$value\" size=\"10%\" value=\"$myLI[3]\"></td>";
			        echo "<td><input type=\"text\" name=\"$mfr\" size=\"10%\" value=\"$myLI[5]\"></td>";
			        echo "<td><input type=\"text\" name=\"$mfrpn\" size=\"10%\" value=\"$myLI[6]\"></td>";
			        echo "<td><input type=\"text\" name=\"$supplier\" size=\"10%\" value=\"$myLI[4]\"></td>";
			        echo "<td><input type=\"text\" name=\"$qty\" size=\"5%\" value=\"$myLI[7]\"></td>";
			        echo "<td><input type=\"text\" name=\"$rate\" size=\"10%\" value=\"$myLI[8]\"></td>";
			        echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\" 
			                 readonly=\"readonly\" size=\"10%\" value=\"$myLI[9]\">";
			        echo "<td><input type=\"text\" name=\"$comments\" size=\"20%\" value=\"$myLI[10]\"></td>";
			         echo "<input type=\"hidden\" name=\"$prevlinenumber\" value=\"$myLI[0]\">";
	                                        echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[11]\">";

			        printf('</tr>');
			        $i++;     
              			 }
echo "<input type=\"hidden\" name=\"index\" value=$i>"; 
echo "<input type=\"hidden\" name=\"curindex\" value=$i>";
?>

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
<span class="tabletext"><input type="submit" 
            style="color=#0066CC;background-color:#DDDDDD;width=130;"
            value="Submit" name="submit" onclick="javascript: return check_req_fields()">
             <INPUT TYPE="RESET"
                 style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">
</FORM>
</table>
</body>
</html>




