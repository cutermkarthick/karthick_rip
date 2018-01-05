<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 21, 2007                =
// Filename: new_processdeviation.php          =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of process deviation           =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'newprocessdeviation';
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
<script language="javascript" src="scripts/processdeviation.js"></script>

<html>
<head>
<title>Process Deviation Slip</title>
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
        <td><span class="pageheading"><b>New Process Deviation Slip</b></td>
    </tr>

     <form action='processProcdeviation.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Number</p></font></td>
            <td><span class="tabletext"><input type="text" name="partnumber" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">Drg. Issue</p></font></td>
            <td><span class="tabletext"><input type="text" name="drgissue" size=20 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><input type="text" name="company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="">
                    <img src="images/bu-getcustomer.gif" alt="Get Customer" onclick="GetAllCustomers()">
            </td>
            <td><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td><span class="tabletext"><input type="text" name="partname" size=20 value=""></td>
        <input type="hidden" name="companyrecnum"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Material Type</p></font></td>
            <td><span class="tabletext"><input type="text" name="matltype" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">Project</p></font></td>
            <td><span class="tabletext"><input type="text" name="project" size=20 value=""></td>

        </tr>
        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">Matl.Spec</p></font></td>
            <td><span class="tabletext"><input type="text" name="matlspec" size=20 value=""></td>
             <td><span class="labeltext"><p align="left">Ref. No</p></font></td>
            <td><span class="tabletext"><input type="text" name="refno" size=20 value=""></td>
             </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Attachments</p></font></td>
            <td colspan=3><span class="tabletext"><input type="file" name="attachments" value=""
             src="images/bu-browse.gif">
           </td>
        </tr>

<tr bgcolor="#DDDEDD">
</tr>
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">
<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<tr bgcolor="#FFFFFF">

<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Sl.No.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Description</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Signature</center></b></td>
 <tr>

<?php

      $i=1;
      while ($i<=5)
     {
	printf('<tr bgcolor="#FFFFFF">');
	$sl_num="sl_num" . $i;
	$description="description" . $i;
	$signature="signature" . $i;

	echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$sl_num\"  value=\"\" size=\"10%\"></td>";
	echo "<td><input type=\"text\" name=\"$description\" size=\"70%\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$signature\" size=\"20%\" value=\"\"></td>";
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
