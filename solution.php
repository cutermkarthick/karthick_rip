<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 9, 2005 by Jerry George                 =
// Filename: solution.php                         =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Board details                               =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}


// Includes
include_once('classes/loginClass.php');
include('classes/solutionClass.php');
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newpage = new page;
$newsol = new solution;
$newdisplay = new display;

$solrecnum = $_REQUEST['recnum'];
if ( !isset ( $solrecnum ) )
{
     header ( "Location: login.php" );

}
$_SESSION['pagename'] = 'solution';
//session_register('pagename');
$_SESSION['solrecnum'] = $solrecnum;
//session_register('typenum');
$userid = $_SESSION['user'];

?>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/solution.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>Solution</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
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
        <?php $result=$newsol->getsols4prntUpd($solrecnum);
	  $myrow = mysql_fetch_row($result);
?>
						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
											 <table width=100% border=0>
												<tr>
													   <td align="left"><span class="pageheading"><b>Solution Details                            </b></td>
													<td align=right><input type= "image" name="Delete" src="images/bu-print.gif" value="Print" onclick="javascript: printSol(<?php echo $solrecnum ?>)"></td>

    												</tr>
										     	 </table>
										</td></tr>

										<tr>
											<td>
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
												  	<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Solution Request  :<?php echo "$solrecnum";?></b></center></td></tr>
            <tr bgcolor="#FFFFFF">
            <td ><span class="labeltext">Solution Num</td>
            <td ><span class="tabletext"><p align="left"><?php echo "$myrow[1]";?></p></font></td>

        </tr>
         <tr bgcolor="#FFFFFF">

            <td><span class="labeltext"><p align="left">Solution Title</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[2]";?></p></font></td>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Solution Type</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[3]";?></p></font></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Solution Upload File</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[6]";?></p></font></td>
        </tr>
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Problem Description</b></center></td></tr>
	<tr bgcolor="#FFFFFF">
     		<td colspan=4><span class="tabletext"><p align="left"><?php echo  "$myrow[4]";?> </p></font></td>

        	</tr>
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Solution Description</b></center></td></tr>
<tr bgcolor="#FFFFFF">
          <td colspan=4><span class="tabletext"><p align="left"><?php echo  "$myrow[5]";?></p></font></td>
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

					</FORM>
		</body>
</html>