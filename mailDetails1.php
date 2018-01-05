<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = September 20, 2006           =
// Filename:  mailDetails.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Mail Details                                =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
if (isset($_REQUEST['emailrecnum']))
{
	$emailrecnum=$_REQUEST['emailrecnum'];
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'mailDetails';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/emailClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
//$emailrecnum =$_REQUEST['emailrecnum'] ;
$newemail= new email;
$newdisplay = new display;

$result = $newemail->getemail($emailrecnum);
$myrow = mysql_fetch_row($result);

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/quote.js"></script>

<html>
<head>
<title>Mail Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>
<?php    $newdisplay->dispLinks('');
 ?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td align="left"><span class="pageheading"><b> Task List   :</b></td>
  </tr>

 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

    <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">10:00</p></font></td>
            <td><input type="text" name="terms" size=100% value=""></td>
        </tr>
    <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">11:00</p></font></td>
           <td><input type="text" name="terms" size=100% value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">12:00</p></font></td>
            <td><input type="text" name="terms" size=100% value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">13:00</p></font></td>
            <td><input type="text" name="terms" size=100% value=""></td>
         </tr>
     <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">14:00</p></font></td>
            <td><input type="text" name="terms" size=100% value=""></td>
        </tr>
    <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">15:00</p></font></td>
            <td><input type="text" name="terms" size=100% value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">16:00</p></font></td>
            <td><input type="text" name="terms" size=100% value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">17:00</p></font></td>
           <td><input type="text" name="terms" size=100% value=""></td>
         </tr>
      <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">18:00</p></font></td>
           <td><input type="text" name="terms" size=100% value=""></td>
         </tr>


</table>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

        <tr>
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

      </FORM>

</table>

</body>
</html>