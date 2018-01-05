<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: addNotes.php                      =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Allows the addition of Notes.               =
//==============================================

session_start();
header("Cache-control: private"); 
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$pagename=$_SESSION['pagename'];
$bmrecnum = $_REQUEST['recnum'];
if ( !isset ( $bmrecnum ) )
{
     header ( "Location: login.php" );
}
$userrecnum = $_SESSION['userrecnum'];
include('classes/workorderClass.php');
include_once('classes/userClass.php'); 
include_once('classes/loginClass.php'); 
include('classes/displayClass.php');
$newdisp = new display;

$newlogin = new userlogin;
$newlogin->dbconnect();
$newwo = new workOrder; 
if (isset ( $_REQUEST['submit'] ) )
{
	$newwo->deleteBookmark($bmrecnum);
}

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<html>
	<head>
		<title>Add Notes</title>
	</head>
	<body leftmargin="0"topmargin="0" marginwidth="0">
	<?php
		include('header.html');
		$result = $newwo->getnotes4Bookmarks($bmrecnum); 
		$myrow     = mysql_fetch_array($result); 
	?>
	<table width=100% cellspacing="0" cellpadding="6" border="0">
		<tr><td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
    				<tr><td>
					<span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right">&nbsp;
        					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a>
				</td></tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td>
				</td></tr>
				<tr><td>
				<?php 
      				$newdisp->dispLinks(''); 
				?>
				</td></tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr bgcolor="DEDFDE">
  					<td width="6"><img src="images/spacer.gif " width="6"></td>
					<td bgcolor="#FFFFFF">
					<table width=100% border=0 cellspacing="1" cellpadding="6">
						<tr><td  align ="center"><span class="pageheading"><b>Book Mark For Work Order   :<?php echo "$myrow[2]";?></b></td></tr>
						<tr><td><span class="heading"><i>Created on        :<?php echo "$myrow[4]";?></i></td></tr>

						<FORM ACTION = "bookmark_det.php" METHOD = "POST">
    						<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
							<?php
               								echo "<tr bgcolor=\"#FFFFFF\">";
							?>
							<td colspan=4><textarea name="spec_instrns" rows="3" cols="72" value="" ><?php echo "$myrow[1]";?></textarea>
							</tr> 
						 </table>
					</td>
					<td width="6"><img src="images/spacer.gif " width="6"></td>
				</tr>
				<tr bgcolor="DEDFDE">
  					<td width="6"><img src="images/box-left-bottom.gif"></td>
					<td ><img src="images/spacer.gif" height="6"></td>
					<td width="6"><img src="images/box-right-bottom.gif"></td>
				</tr>
		               <table>
	       <tr>
 	       <span class="tabletext"><input type="submit" value="delete" name="submit">
	       <input type="hidden" name="recnum" value="<?php echo "$bmrecnum";?>">
          </FORM>
</td></tr>
</table>
</body>
</html>
