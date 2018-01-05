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
$emailrecnum =$_REQUEST['emailrecnum'] ;
$newemail= new email;
$newdisplay = new display;

$result = $newemail->getemail($emailrecnum);
$myrow = mysql_fetch_row($result);
              $d=substr($myrow[8],8,2);
              $m=substr($myrow[8],5,2);
              $y=substr($myrow[8],0,4);
              $x=mktime(0,0,0,$m,$d,$y);
              $date=date("D j, F Y",$x);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/tasklist.js"></script>

<html>
<head>
<title>Mail Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processemail.php' method='post' >
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
<table width=100% border=0>
        <td><span class="pageheading"><b>Mail Details</b></td>
           <td colspan=20>&nbsp;</td>
	       <td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
	    </td>
     <input type="hidden" name="deleteflag" value="">
    </table>
    <input type="hidden" name="emailrecnum" value="<?php echo $emailrecnum ?>">
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
    <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">To</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[1]?></td>
        </tr>
    <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">From</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[4]?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">Date</p></font></td>
            <td ><span class="tabletext"><?php echo $date?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">Subject</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[5]?></td>


     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Body</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[6]?></td>
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