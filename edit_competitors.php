<?php
//==============================================
// Author: FSI                                 =
// Date-written = September 20, 2006           =
// Filename: edit_trackcompetitor.php          =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Allows editing of competitor details        =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'editcompetitor';
$page = "CRM: Competitor";
//session_register('pagename');

// First include the class definition
include('classes/competitorsClass.php');
include('classes/displayClass.php');
$competitorrecnum=$_REQUEST['competitorrecnum'];
$newlogin = new userlogin;
$newlogin->dbconnect();
$newcompetitor = new competitor;
$newdisplay = new display;
$result = $newcompetitor->getcompetitor($competitorrecnum);
$myrow = mysql_fetch_row($result);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/competitor.js"></script>
<html>
<head>
<title>Edit Competitor</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
    <form action='processcompetitors.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
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
	<td width="6"><img src="images/spacer.gif " width="6"></td> -->
 <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellspacing=4  >
	<tr><td>
 <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>Edit Competitor</b></td>
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
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
        <input type="hidden" name="competitorrecnum" value="<?php echo $competitorrecnum ?>">
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Company Name</p></font></td>
            <td><input type="text" name="companyname" size=30 value="<?php echo $myrow[1] ?>"</td>
            <td><span class="labeltext"><p align="left">Revenue</p></font></td>
            <td><input type="text" name="revenue" size=30 value="<?php echo $myrow[2] ?>"</td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Industry Segment</p></font></td>
            <td><input type="text" name="industrysegment" size=30 value="<?php echo $myrow[3] ?>"</td>
            <td><span class="labeltext"><p align="left">Product</p></font></td>
            <td><input type="text" name="product" size=30 value="<?php echo $myrow[4] ?>"</td>
        </tr>

       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><input type="text" name="phone" size=30 value="<?php echo $myrow[5] ?>"</td>
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><input type="text" name="email" size=30 value="<?php echo $myrow[6] ?>"</td>
        </tr>

         <tr bgcolor="#FFFFFF" colspan=3>
            <td ><span class="labeltext"><p align="left">GUID</p></font></td>
            <td colspan=3><input type="text" name="guid" size=30 value="<?php echo $myrow[8] ?>">
        </tr>

        <tr bgcolor="#FFFFFF" colspan=3>
        <td><span class="labeltext">Notes</font></td>
        <td colspan=3><textarea name="notes" rows="4" cols="45" value="<?php echo $myrow[7] ?>"></textarea></td>
        </tr>
        <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Address</b></center></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Address 1</p></font></td>
            <td><input type="text" name="address1" size=30 value="<?php echo $myrow[9] ?>"</td>
            <td><span class="labeltext"><p align="left">Address2</p></font></td>
            <td><input type="text" name="address2" size=30 value="<?php echo $myrow[10] ?>"</td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">City</p></font></td>
            <td><input type="text" name="city" size=30 value="<?php echo $myrow[11] ?>"</td>
            <td><span class="labeltext"><p align="left">State</p></font></td>
            <td><input type="text" name="state" size=30 value="<?php echo $myrow[12] ?>"</td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Zip</p></font></td>
            <td><input type="text" name="zip" size=30 value="<?php echo $myrow[13] ?>"</td>
            <td><span class="labeltext"><p align="left">Country</p></font></td>
            <td><input type="text" name="country" size=30 value="<?php echo $myrow[14] ?>"</td>
        </tr>

    </table>
		</td>
 	</tr>
	</table>
	</td>
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