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

/*if ( !isset ( $worecnum ) )
{
     header ( "Location: login.php" );
    
}*/
 $_SESSION['pagename']='addnotes4support';
//session_register('pagename');
//$srrecnum = $_SESSION['srrecnum'];
$supp2type = $_REQUEST['recnum'];
$type = $_REQUEST['type'];
//echo  "$supp2type";
//echo  "<br>$type";
// First include the class definition 

include('classes/srClass.php');
include('classes/boardClass.php');
include('classes/displayClass.php');

$newsr = new sr; 
$newdisp = new display; 
$newboard = new board; 

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>Add Notes</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<FORM ACTION = "processNotes4support.php" METHOD = "POST">
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr> 
        					<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right"><a href="chPassword.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/chpwd_mo.gif',1)"><img name="Image15" border="0" src="images/chpwd.gif"></a>
       					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisp->dispLinks(''); ?>
						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
											 <table width=100% border=0>
												<tr>
													   <td align="left"><span class="heading"><b>Add Notes</b></td>
													
    												</tr>
										     	 </table>
										</td></tr>

										<tr>
											<td>
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
												       <tr bgcolor="#EEEFEE"><span class="heading"><td colspan=4><center><b>SR Notes</b></center></td></tr>
												       <tr bgcolor="#FFFFFF"  >
					     								<td colspan=4><textarea name="spec_instrns" rows="3" cols="88%" value=""></textarea>
														<input type="hidden" name="supp2type" value="<?php echo "$supp2type" ?>">
														<input type="hidden" name="type" value="<?php echo "$type" ?>">
													</td>
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
                     value="Submit" name="submit">

					</FORM>
		</body>
</html>


