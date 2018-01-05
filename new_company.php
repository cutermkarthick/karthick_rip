<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: new_company.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows entry of new companies               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

if (!isset($_SESSION['userrole']))
{
     header ( "Location: login.php" );
}

if ($_SESSION['userrole'] == 'SU'|| $_SESSION['userrole'] == 'SALES')
{
    $_SESSION['pagename'] = 'newucompany';
}
else
{
    $_SESSION['pagename'] = 'newcompany';
}
//////session_register('pagename');


// First include the class definition
include('classes/companyClass.php');
include('classes/displayClass.php');
$newCompany = new company;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/company.js"></script>

<html>
<head>
<title>New Company</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='processCompany.php' method='post' enctype='multipart/form-data'>

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
						?>
						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
											 <table width=100% border=0>
												<tr>
													 <td><span class="pageheading"><b>New Company</b></td>

    												</tr>
										     	 </table>
										</td></tr>

										<tr>
											<td>
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
												        <tr bgcolor="#FFFFFF"  >
   												         	<td><span class="labeltext"><p align="left">Company Name</p></font></td>
            													<td colspan=3><span class="labeltext"><input type="text" name="cname" size=90 value=""></td>
           										 		</tr>
        											 	       <tr bgcolor="#FFFFFF">
            													<td><span class="labeltext"><p align="left">Type</p></font></td>
            													<td><span class="labeltext"><select name="type" size="1" width="100">
             														<option selected>CUST
             														<option value>HOST
            														<option value>VEND
           														 </select>
													</td>
           													 <td><span class="labeltext"><p align="left">Phone</p></font></td>
           													 <td><span class="labeltext"><input type="text" name="phone" size=30  value=""><input type="hidden" name="typeval" value=""></td>
        												       </tr>

        									 			       <tr bgcolor="#FFFFFF" colspan=3>
            													<td><span class="labeltext"><p align="left">Fax</p></font></td>
            													<td><span class="labeltext"><input type="text" name="fax" size=30  value=""></td>
            													<td><span class="labeltext"><p align="left">Guid</p></font></td>
            													<td><span class="labeltext"><input type="text" name="guid" size=30  value=""></td>
     								  				      </tr>
      										  		      <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Primary Address</b></center></td></tr>
												     <tr bgcolor="#FFFFFF">
           								 					<td><span class="labeltext"><p align="left">Address1</p></font></td>
            													<td><span class="labeltext"><input type="text" name="address1" size=30  value=""></td>
            													<td><span class="labeltext"><p align="left">Address2</p></font></td>
            													<td><span class="labeltext"><input type="text" name="address2" size=30  value=""></td>
												     </tr>
        												    <tr bgcolor="#FFFFFF">
        													 <td><span class="labeltext"><p align="left">City</p></font></td>
            													 <td><span class="labeltext"><input type="text" name="city" size=30  value=""></td>
            													 <td><span class="labeltext"><p align="left">State</p></font></td>
            													 <td><span class="labeltext"><input type="text" name="state" size=30  value=""></td>
        												      </tr>
        												    <tr bgcolor="#FFFFFF">
          										  			<td><span class="labeltext"><p align="left">Zip</p></font></td>
          						 							 <td><span class="labeltext"><input type="text" name="zip" size=30  value=""></td>
           								 					<td><span class="labeltext"><p align="left">Country</p></font></td>
            													 <td><span class="labeltext"><input type="text" name="country" size=30  value=""></td>
        												     </tr>
        												     <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Billing Address</b></center></td></tr>
        									 				<tr bgcolor="#FFFFFF">
          								  						<td><span class="labeltext"><p align="left">Address1</p></font></td>
          						  								<td><span class="labeltext"><input type="text" name="baddress1" size=30  value=""></td>
          										  				<td><span class="labeltext"><p align="left">Address2</p></font></td>
           								 						<td><span class="labeltext"><input type="text" name="baddress2" size=30  value=""></td>
        													</tr>
      							 						 <tr bgcolor="#FFFFFF">
         										   				<td><span class="labeltext"><p align="left">City</p></font></td>
				           										<td><span class="labeltext"><input type="text" name="bcity" size=30  value=""></td>
            														<td><span class="labeltext"><p align="left">State</p></font></td>
            														<td><span class="labeltext"><input type="text" name="bstate" size=30  value=""></td>
       													 </tr>
       													 <tr bgcolor="#FFFFFF">
         								  						<td><span class="labeltext"><p align="left">Zip</p></font></td>
          								  						<td><span class="labeltext"><input type="text" name="bzip" size=30  value=""></td>
          														 <td><span class="labeltext"><p align="left">Country</p></font></td>
          							  							<td><span class="labeltext"><input type="text" name="bcountry" size=30  value=""></td>
       								 					</tr>
       									 				<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Shipping Address</b></center></td></tr>
       							 						<tr bgcolor="#FFFFFF">
         									   					<td><span class="labeltext"><p align="left">Address1</p></font></td>
           								 						<td><span class="labeltext"><input type="text" name="saddress1" size=30  value=""></td>
           							 							<td><span class="labeltext"><p align="left">Address2</p></font></td>
           					 									<td><span class="labeltext"><input type="text" name="saddress2" size=30  value=""></td>
        													</tr>
       							  						<tr bgcolor="#FFFFFF">
         					   									<td><span class="labeltext"><p align="left">City</p></font></td>
		         							   					<td><span class="labeltext"><input type="text" name="scity" size=30  value=""></td>
          												  		<td><span class="labeltext"><p align="left">State</p></font></td>
          									  					<td><span class="labeltext"><input type="text" name="sstate" size=30  value=""></td>
        													</tr>
        									 				<tr bgcolor="#FFFFFF">
         							   							<td><span class="labeltext"><p align="left">Zip</p></font></td>
          								  						<td><span class="labeltext"><input type="text" name="szip" size=30  value=""></td>
         							   							<td><span class="labeltext"><p align="left">Country</p></font></td>
        									    					<td><span class="labeltext"><input type="text" name="scountry" size=30  value=""></td>
      									 				</tr>
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