<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = MArch 11,05                  =
// Filename: edit_ucompany.php                 =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Allows editing of company details for user  =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'editucompany'; 
//////session_register('pagename');

// First include the class definition 
include('classes/companyClass.php'); 
include('classes/displayClass.php'); 
$id=$_REQUEST['companyid'];

$newlogin = new userlogin;
$newlogin->dbconnect();
$newCompany = new company;
$newdisplay = new display;
$result = $newCompany->getCompany($id);
$myrow = mysql_fetch_row($result);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/company.js"></script>
<html>
<head>
<title>Edit Company</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
    <form action='processuCompany.php' method='post' enctype='multipart/form-data'>
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
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
											 <table width=100% border=0>
												<tr>
													<td width=412><span class="pageheading"><b>Edit Company</b></td>
													</td>
													
    												</tr>
										     	 </table>
										</td></tr>
										<tr>
											<td>
  												<table width=80% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
												        <tr bgcolor="#FFFFFF">





            <td><span class="labeltext"><p align="left">Name</p></font></td>
            <td><span class="tabletext"><input type="text" name="cname"
                    style="background-color:#DDDDDD;width=180;" 
                    readonly="readonly" value="<?php echo $myrow[0] ?>"</td>
            <td><span class="labeltext"><p align="left">Id</p></font></td>
            <td><span class="tabletext"><input type="text" name="cid"
                    style="background-color:#DDDDDD;width=180;" 
                    readonly="readonly" value="<?php echo $myrow[1] ?>"</td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Type</p></font></td>
            <td><span class="tabletext"><input type="text" name="typeval"
                    style="background-color:#DDDDDD;width=180;" 
                    readonly="readonly" value="<?php echo $myrow[2] ?>"></td>
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><input type="text" name="phone" size=20 value="<?php echo $myrow[3] ?>"</td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Fax</p></font></td>
            <td><input type="text" name="fax" size=20 value="<?php echo $myrow[4] ?>"</td>
            <td><span class="labeltext"><p align="left">Guid</p></font></td>
            <td><input type="text" name="guid" size=20 value="<?php echo $myrow[5] ?>"</td>
        </tr>
        <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Primary Address</b></center></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Address 1</p></font></td>
            <td><input type="text" name="address1" size=20 value="<?php echo $myrow[6] ?>"</td>
            <td><span class="labeltext"><p align="left">Address2</p></font></td>
            <td><input type="text" name="address2" size=20 value="<?php echo $myrow[7] ?>"</td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">City</p></font></td>
            <td><input type="text" name="city" size=20 value="<?php echo $myrow[8] ?>"</td>
            <td><span class="labeltext"><p align="left">State</p></font></td>
            <td><input type="text" name="state" size=20 value="<?php echo $myrow[9] ?>"</td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Zip</p></font></td>
            <td><input type="text" name="zip" size=20 value="<?php echo $myrow[10] ?>"</td>
            <td><span class="labeltext"><p align="left">Country</p></font></td>
            <td><input type="text" name="country" size=20 value="<?php echo $myrow[11] ?>"</td>
        </tr>
        <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Billing Address</b></center></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Address1</p></font></td>
            <td><span class="labeltext"><input type="text" name="baddress1" size=30  value="<?php echo $myrow[12] ?>"></td>
            <td><span class="labeltext"><p align="left">Address2</p></font></td>
            <td><span class="labeltext"><input type="text" name="baddress2" size=30  value="<?php echo $myrow[13] ?>"></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">City</p></font></td>
            <td><span class="labeltext"><input type="text" name="bcity" size=30  value="<?php echo $myrow[14] ?>"></td>
            <td><span class="labeltext"><p align="left">State</p></font></td>
            <td><span class="labeltext"><input type="text" name="bstate" size=30  value="<?php echo $myrow[15] ?>"></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Zip</p></font></td>
            <td><span class="labeltext"><input type="text" name="bzip" size=30  value="<?php echo $myrow[16] ?>"></td>
            <td><span class="labeltext"><p align="left">Country</p></font></td>
            <td><span class="labeltext"><input type="text" name="bcountry" size=30  value="<?php echo $myrow[17] ?>"></td>
        </tr>
         <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Shipping Address</b></center></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Address1</p></font></td>
            <td><span class="labeltext"><input type="text" name="saddress1" size=30  value="<?php echo $myrow[18] ?>"></td>
            <td><span class="labeltext"><p align="left">Address2</p></font></td>
            <td><span class="labeltext"><input type="text" name="saddress2" size=30  value="<?php echo $myrow[19] ?>"></td>
        </tr>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">City</p></font></td>
            <td><span class="labeltext"><input type="text" name="scity" size=30  value="<?php echo $myrow[20] ?>"></td>
            <td><span class="labeltext"><p align="left">State</p></font></td>
            <td><span class="labeltext"><input type="text" name="sstate" size=30  value="<?php echo $myrow[21] ?>"></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Zip</p></font></td>
            <td><span class="labeltext"><input type="text" name="szip" size=30  value="<?php echo $myrow[22] ?>"></td>
            <td><span class="labeltext"><p align="left">Country</p></font></td>
            <td><span class="labeltext"><input type="text" name="scountry" size=30  value="<?php echo $myrow[23] ?>"></td>
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


