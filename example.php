<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = May 26 , 05                   =
// Filename: edit_bom.php                       =
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
$_SESSION['pagename'] = 'edit_bom'; 
//////session_register('pagename');
$bomrecnum = $_SESSION['bomrecnum'];

// First include the class definition 
include('classes/bomClass.php'); 
include('classes/displayClass.php'); 
include('classes/bomliClass.php'); 
require_once 'Excel/reader.php';
$newbom = new bom; 
$newBOMLI = new bomli; 
$newdisplay = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/bom.js"></script>

<html>
<head>
<title>Edit BOM</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processBOM.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
$result = $newbom ->getBOMDetails($bomrecnum);
$myrow=mysql_fetch_row($result);

      $status=$myrow[5];

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
<tr><td><span class="heading"><i>Edit BOM Details</i></td>
<td align=right><a href="javascript:printBom('<?php echo $status ?>')"><img name="Image7" border="0" src="images/bu-print.gif"></a>
</td>
</tr>
</tr>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
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
      readonly="readonly" size=25 value="<?php echo "$myrow[7]";?>">
<img src="images/bu-getemployee.gif" alt="Get AE" onclick="GetAllEmps1()">
</td>
<input type="hidden" name= "aerecnum" value="<?php echo "$myrow[11]";?>">
<input type="hidden" name= "serecnum" value="<?php echo "$myrow[12]";?>">
</tr>
<tr bgcolor="#FFFFFF">
    <td><span class="labeltext">Status</td>
    <td colspan=3><span class="tabletext"><input type="text" name="status" size=25  value="<?php echo "$myrow[5]";?>" onkeypress="javascript: return checkenter(event)">
<?php
                 if($status == 'Prelim')
                {
	        echo "<span class=\"tabletext\"><select name=\"statusval\" size=\"1\" width=\"100\" onchange=\"onSelectStatus()\">
	        <option selected>Prelim
	        <option value>Initial
	        </select>";
	}
                 if($status == 'Initial')
                {
	        echo "<span class=\"tabletext\"><select name=\"statusval\" size=\"1\" width=\"100\" onchange=\"onSelectStatus()\">
	        <option selected>Initial
	        <option value>Finalize
	        </select>";
	}
                 if($status == 'Finalize')
                {
	        echo "<span class=\"tabletext\"><select name=\"statusval\" size=\"1\" width=\"100\" onchange=\"onSelectStatus()\">
	        <option selected>Finalize
	        </select>";
	}
?>
    </td>
</tr>
<input type="hidden" name="prevstatus" value="<?php echo "$myrow[5]";?>">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">BOM Desc</p></font></td>
<td colspan=3><input type="text" size=60 name="desc" value="<?php echo "$myrow[2]";?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Work Order No&nbsp;</p></font></td>
<td><input type="text" name="wonum" style="background-color:#DDDDDD;" readonly="readonly" size=20 value="<?php echo "$myrow[14]";?>">
	<img src="images/bu_getwo.gif" alt="Get Wo No" onclick="GetWoNo()">
</td>
<input type="hidden" name="worecnum" value="<?php echo "$myrow[13]";?>">
<td><span class="labeltext"><p align="left">Quote No&nbsp;</p></font></td>
<td><input type="text" name="quotenum" style="background-color:#DDDDDD;" readonly="readonly" size=20 value="<?php echo "$myrow[16]";?>">
	<img src="images/bu_getquote.gif" alt="Get Quote No" onclick="GetQuoteNo()">
</td>
<input type="hidden" name="quoterecnum" value="<?php echo "$myrow[15]";?>">
</tr>           			  															
<?php
                 if($status == 'Prelim')
                {
	         $result = $newBOMLI->getLIprelim($bomrecnum);
	          echo "<tr><td bgcolor=\"#EEEFEE\"  colspan=5 align=\"center\"><span class=\"heading\"><b>Preliminary Bom</b></td></tr>";
	}
                 else if($status == 'Initial')
                {
	         $result = $newBOMLI->getLIinitial($bomrecnum);
	          echo "<tr><td bgcolor=\"#EEEFEE\"  colspan=5 align=\"center\"><span class=\"heading\"><b>Preliminary Bom</b></td></tr>";
	}

                else
	{
	         $result = $newBOMLI->getLIfinal($bomrecnum);
	         echo "<tr><td bgcolor=\"#EEEFEE\"  colspan=5 align=\"center\"><span class=\"heading\"><b>Finalized Bom</b></td></tr>";
	}
?>
<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow4edit('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
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
	//$result = $newBOMLI->getLIprelim($bomrecnum);
	$i=1;$flag=0;

// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');
$data->read('jxlrwtest.xls');
error_reporting(E_ALL ^ E_NOTICE);

/*for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
		echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
	}
	echo "\n";

}*/
	while($i<=5)			
	{
		if($flag==0)
		{
		        for ($m = 1; $m <= $data->sheets[0]['numRows']; $m++) {
			       $j=1;		
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
			        echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\"  value=\"".$data->sheets[0]['cells'][$m][$j]."\" size=\"3%\"></td>";
			        echo "<td><input type=\"text\" name=\"$itemname\" size=\"15%\" value=\"".$data->sheets[0]['cells'][$m][$j+1]."\"></td>";
 			        echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"20%\" value=\"".$data->sheets[0]['cells'][$m][$j+2]."\"></td>";
			        echo "<td><input type=\"text\" name=\"$value\" size=\"10%\" value=\"".$data->sheets[0]['cells'][$m][$j+3]."\"></td>";
			        echo "<td><input type=\"text\" name=\"$mfr\" size=\"10%\" value=\"".$data->sheets[0]['cells'][$m][$j+4]."\"></td>";
			        echo "<td><input type=\"text\" name=\"$mfrpn\" size=\"10%\" value=\"".$data->sheets[0]['cells'][$m][$j+5]."\"></td>";
			        echo "<td><input type=\"text\" name=\"$supplier\" size=\"10%\" value=\"".$data->sheets[0]['cells'][$m][$j+6]."\"></td>";
			        echo "<td><input type=\"text\" name=\"$qty\" size=\"5%\" value=\"".$data->sheets[0]['cells'][$m][$j+7]."\"></td>";
			        echo "<td><input type=\"text\" name=\"$rate\" size=\"10%\" value=\"".$data->sheets[0]['cells'][$m][$j+8]."\"></td>";
			        echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\" 
			                 readonly=\"readonly\" size=\"10%\" value=\"".$data->sheets[0]['cells'][$m][$j+9]."\">";
			        echo "<td><input type=\"text\" name=\"$comments\" size=\"20%\" value=\"".$data->sheets[0]['cells'][$m][$j+10]."\"></td>";
			        echo "<input type=\"hidden\" name=\"$prevlinenumber\" value=\"0\">";
	                                        echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"0\">";

			        printf('</tr>');
			        $i++;     
			}
			$flag=1;    
		}  
		if ($i<=5)
		{
			        printf('<tr bgcolor="#FFFFFF">');
			        $linenumber="linenum" . $i;	
			        $prevlinenumber="prevlinenum" . $i;
	                                        $lirecnum="lirecnum" . $i;
			        $itemdesc="itemdesc" . $i;	
			        $itemname="itemname" . $i;
			        $value="value" . $i;											
			        $mfr="mfr" . $i;
			        $mfrpn="mfrpn" . $i;
			        $supplier="supplier" . $i;
			        $qty="qty" . $i;
			        $rate="rate" . $i;
			        $amount="amount" . $i;
			        $comments="comments" . $i;
			        echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\"  value=\"\" size=\"3%\"></td>";
			        echo "<td><input type=\"text\" name=\"$itemname\" size=\"15%\" value=\"\"></td>";
			        echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"20%\" value=\"\"></td>";
			        echo "<td><input type=\"text\" name=\"$value\" size=\"10%\" value=\"\"></td>";
			        echo "<td><input type=\"text\" name=\"$mfr\" size=\"10%\" value=\"\"></td>";
			        echo "<td><input type=\"text\" name=\"$mfrpn\" size=\"10%\" value=\"\"></td>";
			        echo "<td><input type=\"text\" name=\"$supplier\" size=\"10%\" value=\"\"></td>";
			        echo "<td><input type=\"text\" name=\"$qty\" size=\"5%\" value=\"\"></td>";
			        echo "<td><input type=\"text\" name=\"$rate\" size=\"10%\" value=\"\"></td>";
			        echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\" 
			                 readonly=\"readonly\" size=\"10%\" value=\"\">";
			        echo "<td><input type=\"text\" name=\"$comments\" size=\"20%\" value=\"\"></td>";
			         echo "<input type=\"hidden\" name=\"$prevlinenumber\" value=\"\">";
	                                        echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"\">";

			        printf('</tr>');
			        $i++;     
		}
               }
echo "<input type=\"hidden\" name=\"index\" value=$i>";   												
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


