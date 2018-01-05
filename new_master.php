<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = march 20, 2007               =
// Filename: new_master.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Inserts New Master details                  =
//                                             =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'new_master';
//////session_register('pagename');
include('classes/masterclass.php');
include('classes/masterliClass.php');
include('classes/displayClass.php');

$newdisplay = new display;

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/masterprocesssheet.js"></script>

<html>
<head>
<title>New Master Process Sheet</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
	<form action='processMaster.php' method='post' enctype='multipart/form-data'>
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
        <td><span class="pageheading"><b>New Master Process Sheet</b></td>
    </tr>


     <form action='processmaster.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
  			<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
			     <tr bgcolor="#FFFFFF">

            <td  bgcolor="#F5F6F5" width=100%><span class="heading"><center><b>General Information</b></center></td>

       </tr>
        <tr bgcolor="#FFFFFF">
  <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

       <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext"><span class='asterisk'>*</span>Reference No.</td>
            <td  bgcolor="#FFFFFF" width=25%><span class="tabletext"><input type="text" size="20" name="refnum"> </td>
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext"><span class='asterisk'>*</span>Issue Date.</td>
            <td><input type="text" name="issue_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="">
            <img src="images/bu-getdate.gif" alt="Get Issue Date" onclick="GetDate('issue_date')">
            </td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext"><span class='asterisk'>*</span>Part Number</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="partnum" size="20" ></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Rev. No.</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="revnum" size="20"></td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext"><span class='asterisk'>*</span>Part Name</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="partname" size="20"></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Rev. Date</td>
            <td><input type="text" name="revdate"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="">
            <img src="images/bu-getdate.gif" alt="Get Issue Date" onclick="GetDate('revdate')">
            </td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Attachments</td>
            <td><span class="tabletext"><input type="file" name="attachments" value=""src="images/bu-browse.gif"></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Drg. Issue</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="drgissue" size="20"></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext"><span class='asterisk'>*</span>Customer</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="customer" size="20"></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Project</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="project" size="20"></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Material Type</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="materialtype" size="20"></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Material Specification</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="materialsp" size="20"></td>
       </tr>

       <tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Line Items</b></center></td>
</tr>
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">
<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<tr bgcolor="#FFFFFF">

<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

    <td bgcolor="#EEEFEE"><span class="heading"><b>OPN.No.</b></td>
    <td bgcolor="#EEEFEE"><span class="heading"><b>Operation Description</b></td>
    <td bgcolor="#EEEFEE"><span class="heading"><b>Work Center</b></td>
    <td bgcolor="#EEEFEE"><span class="heading"><b>Opn. Reference No.</b></td>
    <td bgcolor="#EEEFEE"><span class="heading"><b>Rev. No.</b></td>
 <tr>

<?php

      $i=1;
      while ($i<=5)
     {
	printf('<tr bgcolor="#FFFFFF">');
    $opnnum="opnnum" . $i;
	$opn_desc="opn_desc" . $i;
	$work_center="work_center" . $i;
	$opn_ref_no="opn_ref_no" . $i;
	$revnum="revnum" . $i;

	echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$opnnum\"  value=\"\" size=\"10%\"></td>";
    echo "<td><input type=\"text\" name=\"$opn_desc\" size=\"20%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$work_center\" size=\"20%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$opn_ref_no\" size=\"20%\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$revnum\" size=\"20%\" value=\"\"></td>";
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

      </form>
</table>
</body>
</html>
