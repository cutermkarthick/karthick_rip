<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: new_quote.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows entry of new quotes                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$solrecnum = $_SESSION['solrecnum'];
//$solrecnum = $_REQUEST['recnum'];
$_SESSION['pagename'] = 'editsolution';
//session_register('pagename');

//echo "$solrecnum";

// First include the class definition
include_once('classes/loginClass.php');
include('classes/solutionClass.php');
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newpage = new page;
$newdisplay = new display;
$newsol = new solution;
//$newCustomer = new company;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/solution.js"></script>

<html>
<head>
<title>Edit Solution</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='solution_upload.php' method='post' enctype='multipart/form-data'>
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
<?php
   $newdisplay->dispLinks('');
//   $result = $newCustomer->getAllCustomers();
	$result=$newsol->getsols4prntUpd($solrecnum);
	$myrow = mysql_fetch_row($result);

?>

						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
											<table width=100% border=0>
												<td><span class="pageheading"><b>Edit Leads</b></td>
                                               <td colspan=20>&nbsp;</td>
	                                           <td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
	                                            </td>
										    </table>
										</td></tr>

										<tr>
											<td>
                                            <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
												        <tr bgcolor="#FFFFFF"  >
                                                        <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
                                                </tr>  </table>
        <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr bgcolor="#FFFFFF"  >
            <td><span class="labeltext">Solution ID</font></td>
         <td height="30"><span class="tabletext"><?php echo "$myrow[1]";?></font></td>
            <input type="hidden" name="solnum" size=10 value="<?php echo "$myrow[1]";?>">
        </tr>
       <tr bgcolor="#FFFFFF"  >
            <td><span class="labeltext">Solution Title</font></td>
            <td><span class="tabletext"><input type="text" name="title" size=20 value="<?php echo "$myrow[2]";?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF"  >
        <td><span class="labeltext">Type</font></td>
        <td><span class="tabletext"><select name="soltype" size="1" width="75">
             <option selected><?php echo "$myrow[3]";?>
             <option value>SR
             <option value>RMA
             <option value>APPDEV
              </select></td>
         <input type="hidden" name="soltypeval">
        </tr>
       <tr bgcolor="#FFFFFF"  >
            <td><span class="labeltext">Problem Description</font></td>
            <td colspan=4><textarea name="prob_desc" rows="6" cols="45" value=""><?php echo "$myrow[4]";?></textarea></td>
        </tr>


        <tr bgcolor="#FFFFFF"  >
            <td><span class="labeltext">Solution Description</font></td>
            <td colspan=4><textarea name="sol_desc" rows="6" cols="45" value=""><?php echo "$myrow[5]";?></textarea></td>
        </tr>
       <tr bgcolor="#FFFFFF"  >
           <td style='vertical-align: middle'><span class="labeltext"><p align="left">Excel File</td>
	<td><span class="labeltext"><?php echo "$myrow[6]";?></font>
	<input type=hidden name=exelval value="<?php echo "$myrow[6]";?>"></td>
      </tr>
    <tr bgcolor="#FFFFFF" >
   <td style='vertical-align: middle'><span class="labeltext"><p align="left">New Excel File</td>
    <td><span class="tabletext"><input type="file" name="excelfile" value=""></td>
        </tr>

    <input type="hidden" name="deleteflag" value="">
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
						<table border = 0 cellpadding=0 cellspacing=0 width=100%>
							<tr>
								<td align=left>
  											</td>
							</tr>
						</table>
        <span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

					</FORM>
		</body>
</html>