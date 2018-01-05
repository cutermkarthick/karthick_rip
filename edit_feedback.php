<?php
//==============================================
// Author: FSI                                 =
// Date-written = Mar 22, 2007                 =
// Filename: edit_feedback.php                 =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Allows editing of feedback details          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'editfeedback';
//////session_register('pagename');

// First include the class definition
include('classes/feedbackClass.php');
include('classes/displayClass.php');
$feedbackrecnum=$_REQUEST['feedbackrecnum'];
$newlogin = new userlogin;
$newlogin->dbconnect();
$newfeedback = new feedback;
$newdisplay = new display;
$result = $newfeedback->getFeedback($feedbackrecnum);
$myrow = mysql_fetch_assoc($result);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/feedback.js"></script>
<html>
<head>
<title>Edit Feedback</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
    <form action='processfeedback.php' method='post' enctype='multipart/form-data'>
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
 <table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr bgcolor="DEDFDE">
	<td width="6"><img src="images/spacer.gif " width="6"></td>
 <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellspacing=4  >
	<tr><td>
 <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>Edit Feedback</b></td>
   <td colspan=20>&nbsp;</td>
	<td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
	</td>
    </table>

  <tr>
<td>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
      <tr bgcolor="#EEEFEE">
            <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PRN</p></font></td>
            <td><input type="text" name="crn" size=30 value="<?php echo $myrow["crn"] ?>"</td>
            <td><span class="labeltext"><p align="left">Reference No. </p></font></td>
             <td><input type="text" name="refno" size=30 value="<?php echo $myrow["refno"] ?>"</td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Number</p></font></td>
            <td><input type="text" name="partnumber" size=30 value="<?php echo $myrow["partnumber"] ?>"</td>
            <td><span class="labeltext"><p align="left">Requested By</p></font></td>
            <td><input type="text" name="requestedby" size=30 value="<?php echo $myrow["requestedby"] ?>"</td>
        </tr>

       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td><input type="text" name="partname" size=30 value="<?php echo $myrow["partname"] ?>"</td>
            <td><span class="labeltext"><p align="left">Date</p></font></td>
            <td><input type="text" name="docdate"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=11 value="<?php echo $myrow["docdate"]?>">
             <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('docdate')">
            </td>
        </tr>
        <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Change Required in</b></center></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Process</p></font></td>
            <td><span class="labeltext"><input type="text" name="process" size="15" value="<?php echo $myrow["process"] ?>">
                <span class="tabletext"><select name="process1" size="1" width="100" onchange="onSelectprocess()">
             	    <option selected>No </option>
            		<option value>Yes</option>
           		 </select>
               </td>
            <td><span class="labeltext"><p align="left">Program</p></font></td>
             <td><span class="labeltext"><input type="text" name="program" size="15" value="<?php echo $myrow["program"] ?>">
                <span class="tabletext"><select name="program1" size="1" width="100" onchange="onSelectprogram()">
             	    <option selected>No </option>
            		<option value>Yes</option>
           		 </select>
               </td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Fixture</p></font></td>
            <td><span class="labeltext"><input type="text" name="fixture" size="15" value="<?php echo $myrow["fixture"] ?>">
                <span class="tabletext"><select name="fixture1" size="1" width="100" onchange="onSelectfixture()">
             	    <option selected>No </option>
            		<option value>Yes</option>
           		 </select>
               </td>
            <td><span class="labeltext"><p align="left">Tools</p></font></td>
            <td><span class="labeltext"><input type="text" name="tools" size="15" value="<?php echo $myrow["tools"] ?>">
                <span class="tabletext"><select name="tools1" size="1" width="100" onchange="onSelecttools()">
             	    <option selected>No </option>
            		<option value>Yes</option>
           		 </select>
               </td>
        </tr>
        <tr bgcolor="#FFFFFF"  >
            <td><span class="labeltext">Description of Feedback & change Requested</font></td>
            <td colspan=4><textarea name="description" rows="6" cols=90% value=""><?php echo $myrow["description"]?></textarea>

      </tr>
    </table>
		</td>
 	</tr>
	</table>
	</td>
    <input type="hidden" name="feedbackrecnum" value="<?php echo $feedbackrecnum ?>">
	<input type="hidden" name="deleteflag" value="">
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
               <span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=100;"
                     value="Submit" name="submit" onclick="javascript: return upd_check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=100;"
                     VALUE="Reset" onclick="javascript: putfocus()">

					</FORM>
		</body>
</html>
