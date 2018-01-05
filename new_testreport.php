<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = may 04, 2007                 =
// Filename: new_testreport.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Inserts New test report details             =
//                                             =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'new_testreport';
//////session_register('pagename');
include('classes/testreportClass.php');
include('classes/chemicalcompliClass.php');
include('classes/mechpropertiesliClass.php');
include('classes/displayClass.php');

$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/testreport.js"></script>

<html>
<head>
<title>New Test Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
	<form action='processTestreport.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        					<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right">&nbsp;
       					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>New Test Report</b></td>
    </tr>


     <form action='processTestreport.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
  			<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
			     <tr bgcolor="#FFFFFF">

            <td  bgcolor="#F5F6F5" width=100%><span class="heading"><center><b>General Information</b></center></td>

       </tr>
        <tr bgcolor="#FFFFFF">
  <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

       <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext"><span class='asterisk'>*</span>Ref. No.</td>
            <td  bgcolor="#FFFFFF" width=25%><span class="tabletext"><input type="text" size="20" name="refno"> </td>
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext"><span class='asterisk'>*</span>Part Number</td>
            <td  bgcolor="#FFFFFF" width=25%><span class="tabletext"><input type="text" size="20" name="partno"> </td>
            </td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext"><span class='asterisk'>*</span>Customer</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="customer" size="20"></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part Name</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="partname" size="20"></td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Customer Standard</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="cust_standard" size="20"></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">RM Inv. No.</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="rm_inv_no" size="20"></td>
            </td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Material Type</td>
            <td><span class="tabletext"><input type="text" name="material_type" value=""src="images/bu-browse.gif"></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext"><span class='asterisk'>*</span>Inv. Date</td>
             <td><input type="text" name="inv_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="">
            <img src="images/bu-getdate.gif" alt="Get Issue Date" onclick="GetDate('inv_date')">
       </tr>
       <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Material Specification</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="material_spec" size="20"></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext"><span class='asterisk'>*</span>Date of Receipt of RM</td>
            <td><input type="text" name="rm_receipt_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="">
            <img src="images/bu-getdate.gif" alt="Get Issue Date" onclick="GetDate('rm_receipt_date')">
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">RM Supplier</td>
            <td  bgcolor="#FFFFFF" colspan=3><span class="tabletext"><input type="text" name="rm_supplier" size="20"></td>

       </tr>

       <tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Chemical Composition Line Items</b></center></td>
</tr>
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">
<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRowchem('myTable1',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<tr bgcolor="#FFFFFF">

<table id="myTable1" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

    <tr bgcolor="#FFFFFF">
  <td bgcolor="#EEEFEE" rowspan=3><span class="heading"><b><center>Line Num.</center></b></td>
  <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>% Chemical Composition as per Standards</center></b></td>
  <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b><center>% Chemical Composition as per RM Supplier</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=3><span class="heading"><b><center>Test Report by Laboratory</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=3><span class="heading"><b><center>Remarks</center></b></td>
<tr>
<tr>


  <td bgcolor="#EEEFEE"><span class="heading"><b><center>Constituents</center></b></td>
  <td bgcolor="#EEEFEE"><span class="heading"><b><center>Min.</center></b></td>
  <td bgcolor="#EEEFEE"><span class="heading"><b><center>Max.</center></b></td>
  <td bgcolor="#EEEFEE"><span class="heading"><b><center>Min.</center></b></td>
  <td bgcolor="#EEEFEE"><span class="heading"><b><center>Max.</center></b></td>

</tr>


 <tr>

<?php

      $i=1;
    while ($i<=3)
    {
	printf('<tr bgcolor="#FFFFFF">');
	$cc_lineno = "cc_lineno" . $i;
    $cc_constituents = "cc_constituents" . $i;
	$cc_standard_min = "cc_standard_min" . $i;
	$cc_standard_max = "cc_standard_max" . $i;
	$cc_supplier_min = "cc_supplier_min" . $i;
	$cc_supplier_max = "cc_supplier_max" . $i;
	$cc_report_lab = "cc_report_lab" . $i;
	$cc_remarks = "cc_remarks" . $i;


	echo "<td><span class=\"tabletext\"><input type=\"text\" name=\"$cc_lineno\"  value=\"\" size=\"10%\"></td>";
    echo "<td><input type=\"text\" name=\"$cc_constituents\" size=\"20%\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$cc_standard_min\" size=\"20%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$cc_standard_max\" size=\"20%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$cc_supplier_min\" size=\"20%\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$cc_supplier_max\" size=\"20%\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$cc_report_lab\" size=\"20%\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$cc_remarks\" size=\"20%\" value=\"\"></td>";

	printf('</tr>');
	$i++;
    }
echo "<input type=\"hidden\" name=\"index\" value=$i>";


?>
        </table>
	</td>
    </tr>
    
     <tr bgcolor="#DDDEDD">
<td colspan=5><span class="heading"><center><b>Mechanical Properties Line Items</b></center></td>
</tr>
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">
<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRowmach('myTable2',document.forms[0].mpindex.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<tr bgcolor="#FFFFFF">

<table id="myTable2" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

     <tr bgcolor="#FFFFFF">
  <td bgcolor="#EEEFEE" rowspan=3><span class="heading"><b><center>Line Num.</center></b></td>
  <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>% Mechanical Properties as per Standards</center></b></td>
  <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b><center>% Mechanical Properties as per RM Supplier</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=3><span class="heading"><b><center>Test Report by Laboratory</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=3><span class="heading"><b><center>Remarks</center></b></td>
<tr>
<tr>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Constituents</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Min.</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Max.</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Min.</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Max.</center></b></td>
 <tr>

<?php

   $j=1;
    while ($j<=3)
    {
	printf('<tr bgcolor="#FFFFFF">');
	$mp_lineno="mp_lineno" . $j;
    $mp_constituents="mp_constituents" . $j;
	$mp_standard_min="mp_standard_min" . $j;
	$mp_standard_max="mp_standard_max" . $j;
	$mp_supplier_min="mp_supplier_min" . $j;
	$mp_supplier_max="mp_supplier_max" . $j;
	$mp_report_lab="mp_report_lab" . $j;
	$mp_remarks="mp_remarks" . $j;

	echo "<td><span class=\"tabletext\"><input type=\"text\" name=\"$mp_lineno\"  value=\"\" size=\"10%\"></td>";
    echo "<td><input type=\"text\" name=\"$mp_constituents\" size=\"20%\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$mp_standard_min\" size=\"20%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$mp_standard_max\" size=\"20%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$mp_supplier_min\" size=\"20%\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$mp_supplier_max\" size=\"20%\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$mp_report_lab\" size=\"20%\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$mp_remarks\" size=\"20%\" value=\"\"></td>";
	printf('</tr>');
	$j++;
    }
echo "<input type=\"hidden\" name=\"mpindex\" value=$j>";

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
<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields1()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">

      </form>
</table>
</body>
</html>
