<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2007                =
// Filename: new_qualityplan.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new quality plan            =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'newcustdata';
//////session_register('pagename');

// First include the class definition
include('classes/loginClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;

?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/custdata.js"></script>



<html>
<head>
<title>Customer Data Validation</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

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
        <td><span class="pageheading"><b>Customer Data Validation</b></td>
    </tr>


     <form action='processCustdata.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Stage Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Number</p></font></td>
            <td><span class="tabletext"><input type="text" name="partnum" size=20 value=""></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer Ref No.</p></font></td>
            <td><span class="tabletext"><input type="text" name="cust_ref_num" size=20 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></font></td>
            <td><span class="tabletext"><input type="text" name="partname" size=20 value=""></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer Rev No.</p></font></td>
            <td><span class="tabletext"><input type="text" name="cust_rev_num" size=20 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Supplied Model Format</p></font></td>
            <td><span class="tabletext"><input type="text" name="sup_mod_format" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">Translated To</p></font></td>
            <td><input type="text" name="translated_to" size=20 value=""> </td>
        </tr>


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Note</font></td>
             <td colspan=4><textarea name="note" rows="4" cols="45" value=""></textarea></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Approved By</p></font></td>
            <td><span class="tabletext"><input type="text" name="approved_by" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">Prepared By</p></font></td>
            <td><span class="tabletext"><input type="text" name="prepared_by" size=20 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Issue No</p></font></td>
            <td><span class="tabletext"><input type="text" name="Issue" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">Date</p></font></td>
            <td><span class="tabletext"><input type="text" name="Date"
                                              style="background-color:#DDDDDD;"
                                              readonly="readonly" size=20 value="">
                  <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('Date')">
                                              </td>
        </tr>

<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Customer Data Line Items</b></center></td>
</tr>
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">
<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>



<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
  <td bgcolor="#EEEFEE" rowspan=3><span class="heading"><b><center>Ref No.</center></b></td>
  <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>Point Co-ordinates as given</center></b></td>
  <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>Measured Co-ordinates</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=3><span class="heading"><b><center>Remarks/<br>Deviation</center></b></td>
<tr>
<tr>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>X-Value</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Y-Value</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Z-Value</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>X-Value</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Y-Value</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Z-Value</center></b></td>
</tr>

<?php

      $i=1;
      while ($i<=5)
     {
	printf('<tr bgcolor="#FFFFFF">');
	$refnum="refnum" . $i;
	$px="px" . $i;
	$py="py" . $i;
	$pz="pz" . $i;
	$mx="mx" . $i;
	$my="my" . $i;
	$mz="mz" . $i;
	$remarks="remarks" . $i;

	echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$refnum\"  value=\"\" size=\"10%\"></td>";
	echo "<td><input type=\"text\" name=\"$px\" size=\"20%\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$py\" size=\"20%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$pz\" size=\"20%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$mx\" size=\"20%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$my\" size=\"20%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$mz\" size=\"20%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$remarks\" size=\"20%\" value=\"\"></td>";
	printf('</tr>');
	$i++;
    }
echo "<input type=\"hidden\" name=\"index\" value=$i>";

?>

        </table>
	</td>
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
<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">

      </FORM>
</table>
</body>
</html>
