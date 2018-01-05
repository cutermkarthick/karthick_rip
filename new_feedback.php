<?php
//==============================================
// Author: FSI                                 =
// Date-written = March 22, 2007               =
// Filename: new_feedback.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new feedback form           =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'newfeedback';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/displayClass.php');

$newdisplay = new display;

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/feedback.js"></script>

<html>
<head>
<title>New Feedback Form</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processfeedback.php' method='post' >
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
  <tr><td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
   <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
      <td bgcolor="#FFFFFF">

        <table width=100% border=0 cellpadding=6 cellspacing=0  >
     <tr>
        <td><span class="pageheading"><b>New Feedback Form</b></td>
     </tr>
  <td>

<tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
   <tr bgcolor="#EEEFEE">
        <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
  </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr bgcolor="#FFFFFF" colspan=3>
         <td><span class="labeltext"><p align="left">PRN</p></font></td>
         <td><span class="labeltext"><input type="text" name="crn" size=30  value=""></td>
         <td><span class="labeltext"><p align="left">Reference No</font></td>
         <td><span class="labeltext"><input type="text" name="refno" size=30  value=""></td>
       </tr>
       <tr bgcolor="#FFFFFF" colspan=3>
         <td><span class="labeltext"><p align="left">Part Number</p></font></td>
         <td><span class="labeltext"><input type="text" name="partnumber" size=30  value=""></td>
         <td><span class="labeltext"><p align="left">Requested By</font></td>
         <td><span class="labeltext"><input type="text" name="requestedby" size=30  value=""></td>
       </tr>
       <tr bgcolor="#FFFFFF" width=100%>
         <td><span class="labeltext"><p align="left">Part Name</font></td>
         <td><span class="labeltext"><input type="text" name="partname" size=30  value=""></td>
         <td><span class="labeltext"><p align="left">Date</p></font></td>
         <td><input type="text" name="docdate"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=15 value="">
            <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('docdate')"></td>
	   </tr>

      <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Change Required in</center></b></td></tr>
	    <tr bgcolor="#FFFFFF">
         <tr bgcolor="#FFFFFF" >
         <td><span class="labeltext"><p align="left">Process</p></font></td>
         <td><span class="labeltext"><span class="labeltext"><select name="process" size="1" width="100">
                        <OPTION value='No'>No</OPTION>
                        <OPTION value='Yes'>Yes</OPTION></select>
         </td>
         <td><span class="labeltext"><p align="left">Program</p></font></td>
         <td><span class="labeltext"><span class="labeltext"><select name="program" size="1" width="100">
                        <OPTION value='No'>No</OPTION>
                        <OPTION value='Yes'>Yes</OPTION></select>
         </td>
		</tr>
      <tr bgcolor="#FFFFFF" >
         <td><span class="labeltext"><p align="left">Fixture</p></font></td>
         <td><span class="labeltext"><span class="labeltext"><select name="fixture" size="1" width="100">
                        <OPTION value='No'>No</OPTION>
                        <OPTION value='Yes'>Yes</OPTION></select>
         </td>
         <td><span class="labeltext"><p align="left">Tools</p></font></td>
         <td><span class="labeltext"><span class="labeltext"><select name="tools" size="1" width="100">
                        <OPTION value='No'>No</OPTION>
                        <OPTION value='Yes'>Yes</OPTION></select>
         </td>
	  </tr>
      <tr bgcolor="#FFFFFF" colspan=3>
        <td><span class="labeltext">Brief Description of Feedback and change Requested</font></td>
        <td colspan=3><textarea name="description" rows="6" cols="70" value=""></textarea></td>
     </tr>
 </table>
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
