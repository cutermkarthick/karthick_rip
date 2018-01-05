<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: edit_master.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// editing master sheets                       =
//                                             =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'edit_master';
//////session_register('pagename');

include('classes/masterclass.php');
include('classes/masterliClass.php');
include('classes/displayClass.php');

$newdisplay = new display;
$newLI = new master_line_items;
$newMA = new master;
$masterrecnum = $_REQUEST['masterrecnum'];
$result = $newMA->getmasterdetails($masterrecnum);

$myrow = mysql_fetch_assoc($result);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/masterprocesssheet.js"></script>
<html>
<head>
<title>Edit Master Process Sheet</title>
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
			<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr><td></td></tr>
				<tr>
				<td>
<?php $newdisplay->dispLinks(''); ?>

 <table width=100% border=0 cellpadding=0 cellspacing=0>
	<tr bgcolor="DEDFDE">
	<td width="6"><img src="images/spacer.gif " width="6"></td>
 <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellspacing=4>
	<tr><td>
 <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>Edit Master Process Sheet</b></td>
    <td colspan=20>&nbsp;</td>
	<td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
	</td>
    </table>

  <tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>

 <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
     <tr bgcolor="FFFFFF">
            <td><span class="labeltext"><p align="left">Reference No.</p></font></td>
            <td><span class="tabletext"><input type="text" name="refnum" size="20" value="<?php echo $myrow['refnum'] ?>" > </td>
            <td><span class="labeltext"><p align="left">Issue Date.</p></font></td>
            <td><span class="tabletext"><input type="text" name="issue_date" style=";background-color:#DDDDDD;" size="20" readonly='readonly' bgcolor="#DFDEDF" value="<?php echo $myrow['issue_date'] ?>">
                                                            <img src="images/bu-getdate.gif" alt="Get Issue Date" onclick="GetDate('issue_date')">
             <input type="hidden" name="masterrecnum" value="<?php echo $masterrecnum ?>">
       </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Number</p></font></td>
            <td><span class="labeltext"><input type="text" size="20" name="partnum" value="<?php echo $myrow['partnum'] ?>"></td>
            <td><span class="labeltext"><p align="left">Rev. No.</p></font></td>
            <td><span class="tabletext"><input type="text" size="20" name="revnum" value="<?php echo $myrow['revnum'] ?>"></td>
       <input type="hidden" name="masterrecnum" value="<?php echo $myrow['recnum'] ?>">
       <input type="hidden" name="deleteflag" value="">
      </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td><span class="tabletext"><input type="text" size="20" name="partname" value="<?php echo $myrow['partname'] ?>"></td>
            <td><span class="labeltext"><p align="left">Rev. Date</p></font></td>
            <td><span class="tabletext"><input type="text" size="20" name="revdate" style=";background-color:#DDDDDD;" readonly='readonly' value="<?php echo $myrow['revdate'] ?>"><img src="images/bu-getdate.gif" alt="Get Rev Date" onclick="GetDate('revdate')">
       </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><span class="tabletext"><input type="text" size="20" name="customer" value="<?php echo $myrow['customer'] ?>"></td>
            <td><span class="labeltext"><p align="left">Drg. Issue</p></font></td>
            <td><span class="tabletext"><input type="text" size="20" name="drgissue" value="<?php echo $myrow['drg_issue'] ?>"></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Material Specification</p></font></td>
            <td><span class="tabletext"><input type="text" size="20" name="materialsp" value="<?php echo $myrow['material_sp'] ?>"></td>
            <td><span class="labeltext"><p align="left">Project</p></font></p></font></td>
            <td><span class="tabletext"><input type="text" size="20" name="project" value="<?php echo $myrow['project'] ?>"></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Material Type</p></font></td>
            <td><span class="tabletext"><input type="text" size="20" name="materialtype" value="<?php echo $myrow['material_type'] ?>"></td>
            <td style='vertical-align: middle'><span class="labeltext"><p align="left">Attachments</td>
                   <td><span class="tabletext"><input type="text" name="attachments" style=";background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow["attachments"] ?>"<td><input type="file" name="attachments" value="<?php echo $myrow["attachments"] ?>" src="images/bu-browse.gif"></td>
       </tr>

       <input type="hidden" name="deleteflag" value="">
      <tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Line Items</b></center></td>
</tr>
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">

<tr bgcolor="#FFFFFF"><td><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
<td colspan=4 bgcolor="#FFFFFF"><span class="labeltext">To delete line items - blankout line number</td></tr>

<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
                            <tr>
                                    <td bgcolor="#EEEFEE"><span class="heading"><b>OPN.No.</b></td>
                                    <td bgcolor="#EEEFEE"><span class="heading"><b>Operation Description</b></td>
                                    <td bgcolor="#EEEFEE"><span class="heading"><b>Work Center</b></td>
                                    <td bgcolor="#EEEFEE"><span class="heading"><b>Opn. Reference No.</b></td>
                                    <td bgcolor="#EEEFEE"><span class="heading"><b>Rev. No.</b></td>
                            </tr>

									                <?php

   															$result = $newLI->getLI($masterrecnum);
                                                            $i=1;
															while ($myLI = mysql_fetch_row($result))
												    	 		{
																//echo "i am inside inner while loop";
																printf('<tr bgcolor="#FFFFFF">');
													            $opnnum="opnnum" . $i;
													            $opn_desc="opn_desc" . $i;
													            $work_center="work_center" . $i;
													            $opn_ref_no="opn_ref_no" . $i;
													            $revnum="revnum" . $i;
                                                                $prevlinenum="prev_line_num" . $i;
																$lirecnum="lirecnum" . $i;

																//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
																echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[0]\">";
																echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[5]\">";
                                                                echo "<td><input type=\"text\" name=\"$opnnum\" size=\"10%\" value=\"$myLI[0]\"></td>";
																echo "<td><input type=\"text\" name=\"$opn_desc\" size=\"20%\" value=\"$myLI[1]\"></td>";
																echo "<td><input type=\"text\" name=\"$work_center\" size=\"20%\" value=\"$myLI[2]\"></td>";
																echo "<td><input type=\"text\" name=\"$opn_ref_no\" size=\"20%\" value=\"$myLI[3]\"></td>";
                                                                echo "<td><input type=\"text\" name=\"$revnum\" size=\"20%\" value=\"$myLI[4]\"></td>";
																printf('</tr>');
																$i++;
															}


                                                        echo "<input type=\"hidden\" name=\"index\" value=$i>";
	                                                    echo "<input type=\"hidden\" name=\"curindex\" value=$i>";
												?>

     </table>
  </table>
<td width="6"><img src="images/spacer.gif " width="6"></td>
		</tr>
			<tr bgcolor="DEDFDE">
				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
		</table>
			<table border = 0 cellpadding=0 cellspacing=0 width=100% >
				<tr>
					<td align=left>
						</td>
					</tr>
				</table>
                <span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=100;"
                     VALUE="Reset" onclick="javascript: putfocus()">

					</form>
		</body>
</html>
