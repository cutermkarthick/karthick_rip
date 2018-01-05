<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: edit_user.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows editing of users                     =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'edituser'; 
$page="user";
//////session_register('pagename');

// First include the class definition 
include('classes/userClass.php'); 
include('classes/displayClass.php');
$loginid=$_REQUEST['userid'];
$type=$_REQUEST['type'];

$newlogin = new userlogin;
$newlogin->dbconnect();
$newUser = new user;
$newdisplay = new display;
$result = $newUser->getUser($loginid,$type);
$myrow = mysql_fetch_row($result);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/crypt.js"></script>
<script language="javascript" src="scripts/user.js"></script>

<html>
<head>
<title>Edit User</title>
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
						?>
						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF"> -->
									<table width=100% border=0 cellpadding=6 cellspacing=0  class="stdtable1">
										<tr><td>
											 <table width=100% border=0>
												<tr>
													<td><span class="pageheading"><b>New User</b></td>
													<td colspan=50>&nbsp;</td>
										         			<td bgcolor="#FFFFFF" rowspan=2 ><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript:DeleteUser()">
												</td>
													
    												</tr>
										     	 </table>
										</td></tr>
										<tr>
											<td>
                                            <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
      	         										<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
                                                                       <tr bgcolor="#FFFFFF"  >
  						<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
						<tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext"><p align="left">User ID</p></font></td>
            <td width=70%><span class="tabletext"><input type="text" name="loginid"
                    style="background-color:#DDDDDD;width=205;" 
                    readonly="readonly" value="<?php echo $myrow[0] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=4 ><span class="labeltext"><p align="left">Type</p></font></td>
            <td ><span class="tabletext"><input type="text" name="typeval"
                    style="background-color:#DDDDDD;width=205;" 
                    readonly="readonly" value="<?php echo $myrow[2] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext"><p align="left">Initials</p></font></td>
            <td><input type="text" name="initials" size=20 value="<?php echo $myrow[6] ?>"</td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext"><p align="left">Status</p></font></td>
            <td><span class="tabletext"><input type="text" name="status" size=10  value="<?php echo $myrow[5] ?>"
            <span class="tabletext"><select name="active" size="1" width="20" onchange="onSelectStatus()">
             <option selected>Please Specify
             <option value>Active
             <option value>Inactive
             <option value>Obsolete
            </select><input type="hidden" name="activeval" value="<?php echo $myrow[5] ?>">
            </td>
        </tr>
                 
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext"><p align="left">Title</p></font></td>
            <td><span class="tabletext"><input type="text"
                    style="background-color:#DDDDDD;width=205;" 
                    readonly="readonly" value="<?php echo $myrow[3] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext"><p align="left">Role</p></font></td>
            <td><span class="tabletext"><input type="text"
                    style="background-color:#DDDDDD;width=205;" 
                    readonly="readonly" value="<?php echo $myrow[4] ?>"></td>

        </tr>
         <input type="hidden" name="companyrecnum">
       <input type="hidden" name="contactrecnum">
       <input type="hidden" name="emprecnum">
       <input type="hidden" name="deleteflag" value="">
        									 				
        												</table>
											</td>
										</tr>
									</table>
								<!-- </td>
								<td width="6"><img src="images/spacer.gif " width="6"></td>
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
                     style="color=#0066CC;background-color:#DDDDDD;width=100;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields4upd()"/>
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=100;"
                     VALUE="Reset" onclick="javascript: putfocus()">

					</FORM>
		</body>
</html>
