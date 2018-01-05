<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: worderSummary.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays WO Summary for SU                  =
// Modifications History                       =
// Dec 6,04 - Paging Enhancements              =
// Dec20,04 - Wo2Po link enhancements          =
//            Coded By  Jerry George           =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'bookmarks'; 
//////session_register('pagename');
$sess=session_id();

// First include the class definition 

include_once('classes/userClass.php'); 
include_once('classes/loginClass.php'); 
include('classes/workorderClass.php');
include('classes/displayClass.php');
$newdisp = new display;
$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$userrecnum=   $_SESSION['userrecnum']; 
$newworkOrder = new workOrder; 
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/wo.js"></script>
<html>
	<head>
		<title>Work Order</title>
	</head>
	<body leftmargin="0"topmargin="0" marginwidth="0">
		<?php
			include('header.html');
		?>
		<form action='worderSummary.php' method='post' enctype='multipart/form-data'>
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
	<tr><td>
	
	</td></tr>
	<tr>
	<td>
<?php $newdisp->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

		

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

					<table width=100% border=0 cellpadding=6 cellspacing=0  >
						
						<tr><td><span class="pageheading"><b>Book Marks</b></td></tr>
<tr><td><span class="heading"><i>Please click on the Book Mark link for details and to Edit/Delete</i></td></tr>
						<tr><td>

								<tr><td>
									<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
										<tr>
											<td bgcolor="#EEEFEE"><span class="heading"><b>Sequence No</b></td>
											<td bgcolor="#EEEFEE"><span class="heading"><b><center>Work Order No</center></b></td>
											<td bgcolor="#EEEFEE"><span class="heading"><b><center>User Name</center></b></td>
						  					<td bgcolor="#EEEFEE"><span class="heading"><b><center>Create date</center></b></td>
										</tr>
										<?php
										             $i=1;
										            $result = $newworkOrder->getBookmarks($userrecnum); 
            						           				            $flag = 0;
						            				            while ($myrow = mysql_fetch_row($result)) {
						           				            $flag = 1;
	     									            printf('<tr><td  bgcolor="#FFFFFF"><span class="tabletext"><a href="bookmark_det.php?recnum=%s">%s</td> ',
		        									 $myrow[0],$i);

										?>
					              						<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
				                             						<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
				                             						<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
										</tr>
					            					<?php
					              						$i++;}
					            					 ?>
			     							
									</table>
								</td></tr>
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
							<td align=left></td>
</tr></table>

</body>
</html>
