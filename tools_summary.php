<?php
//==============================================
// Author: FSI                                 =
// Date-written = Aug 25, 2008                 =
// Filename: fixtures_summary.php              =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays fixtures summary                   =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
include('classes/displayClass.php');
$newdisplay = new display;
$_SESSION['pagename'] = 'tools_summary'; 
?>

<html>
<head>
<title>Fixtures summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='account.php?scompany=$company_match&company_oper=$oper&sortfld1=$sort1&scompanyfl=$where1' method='post' enctype='multipart/form-data'>
<?php
	include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
    				<tr>
       					 <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/logout_mo.gif',1)"><img name="Image15" border="0" src="images/logout.gif"></a></td>
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
																	</td>
								<td width="6"><img src="images/spacer.gif " width="6"></td>
							
                                                       </tr>
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/box-left-bottom.gif"></td>
								<td><img src="images/spacer.gif " height="6"></td>
								<td width="6"><img src="images/box-right-bottom.gif"></td>
							</tr>
                                                     
						</table>
						<table border = 0 cellpadding=0 cellspacing=0 width=100% bgcolor="FFFFFF">
							<tr>
							<td align=left><b> Coming Soon......

							</td>
							</tr>
						</table>
					</FORM>
		</body>
</html>
