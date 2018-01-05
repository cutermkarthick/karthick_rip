<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: new_user.php                      =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new users                   =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'newuser';
$page = "user";
//////session_register('pagename');



// First include the class definition

include_once('classes/userClass.php');
include('classes/companyClass.php');
include('classes/displayClass.php');
$newUser = new user;
$newCompany = new company;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/crypt.js"></script>
<script language="javascript" src="scripts/user.js"></script>



<html>
<head>
<title>New User</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='processUser.php' method='post' enctype='multipart/form-data'>
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
						<?php
  						 $newdisplay->dispLinks('');
						$result = $newCompany->getCompanies1();
						?>
						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td> -->
											 <table width=100% border=0>
												<tr>
													<td><span class="pageheading"><b>New User</b></td>
    												</tr>
										     	 </table>
										</td></tr>
										<tr>
											<td>
                                            <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
      	         										<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
                                                                       <tr bgcolor="#FFFFFF"  >
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
												    <tr bgcolor="#FFFFFF">
												        <td><span class="heading"><p align="left">User ID</p></font></td>
            											<td colspan=3><span class="heading"><input type="text" name="loginid" size=20 value=""></td>
        											</tr>
        											<tr bgcolor="#FFFFFF">
           								 				<td ><span class="heading"><p align="left">Password</p></font></td>
          												<td  colspan=3><input type="password" name="password" maxlength="32"></td></tr>
      												</tr>
        											<tr bgcolor="#FFFFFF">
           												<td ><span class="heading"><p align="left">Initials</p></font></td>
            											<td colspan=3 ><span class="tabletext"><input type="text" name="initials" size=20 value=""></td>
        											</tr>
        											<tr bgcolor="#FFFFFF">
            											<td ><span class="heading"><p align="left">Type</p></font></td>
            											<td  colspan=3><span class="heading"><select name="type" size="1" width="100">
             														<option selected>EMPL
             														<option value>CUST
             														<option value>VEND
             														<option value>SALES PERSON
             														<option value>SALES MANAGER
             														<option value>CF
             														<option value>FF
            														</select>
														            <input type="hidden" name="typeval"></td>
        											    </tr>
        												<tr bgcolor="#FFFFFF">
             												<td ><span class="heading"><p align="left">Employee Link</p></font></td>
            												<td colspan=3><span class="tabletext"><input type="text" name="employee" style=";background-color:#DDDDDD;" readonly="readonly" size=20 value="">
             														<img src="images/bu-getemployee.gif" alt="Get Employee"  onclick="GetAllEmps()">
														            <input type="hidden" name="emprecnum" value=NULL> </td>
        												</tr>
        												<tr bgcolor="#FFFFFF">
            												<td ><span class="heading"><p align="left">Customer/Vendor</p></font></td>
                       										<td colspan=1><span class="tabletext"><input type="text" name="company" style=";background-color:#DDDDDD;" readonly="readonly" size=20 value="">
            											    <img src="images/bu-getcustomer.gif" alt="Get Company"  onclick="GetAllCustomers()">
            														<input type="hidden" name="companyrecnum"> </td>
        												</tr>
        												<tr bgcolor="#FFFFFF">
             												<td><span class="heading"><p align="left">Contact Link</p></font></td>
             											    <td colspan=3><span class="tabletext"><input type="text" name="contact" style=";background-color:#DDDDDD;" readonly="readonly" size=20 value="">
            									 			<img src="images/bu-getcontact.gif" alt="Get Contact" onclick="GetContact()">
															<input type="hidden" name="contactrecnum" value=NULL></td>
        												</tr>

     									   				<tr bgcolor="#FFFFFF">
        									   				<td ><span class="heading"><p align="left">Active</p></font></td>
            												<td  colspan=3><span class="heading"><select name="active" size="1" width="100">
             															<option selected>Active
            									 						<option value>Inactive
            															 <option value>Obsolete
            															</select>
															<input type="hidden" name="activeval"> </td>
        												</tr>
        												</table>
											</td>
										</tr>
									</table>
								</td>
						<!-- 		<td width="6"><img src="images/spacer.gif " width="6"></td>
							</tr>
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/box-left-bottom.gif"></td>
								<td><img src="images/spacer.gif " height="6"></td>
								<td width="6"><img src="images/box-right-bottom.gif"></td>
							</tr> -->
						</table>
						<table border = 0 cellpadding=0 cellspacing=0 width=100%>
							<tr>
								<td align=left>
								</td>
							</tr>
						</table>
               <span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

					</FORM>
		</body>
</html>
