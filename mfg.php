<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 18, 2005                =
// Filename: mfg.php                           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays Manufacture orders                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'mfg';
//////session_register('pagename');

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/mfgClass.php');
include_once('classes/displayClass.php');
$newmfg = new mfg;
$newdisplay = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>MFG</title>
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
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	<td bgcolor="#FFFFFF">
	<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>List of MFG Orders</b></td>
    </tr>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>MFG #</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Date</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Description</b></td>
        </tr>
<?php


            $result = $newmfg->getmfgs();
        while ($myrow = mysql_fetch_assoc($result)) {
              $d=substr($myrow["orderdate"],8,2);
              $m=substr($myrow["orderdate"],5,2);
              $y=substr($myrow["orderdate"],0,4);
              $x=mktime(0,0,0,$m,$d,$y);
              $date=date("M j, Y",$x);
	      printf('<tr bgcolor="#FFFFFF"><td><span class="tabletext"><a href="mfgDetails.php?recnum=%s"><b>%s</b></td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>',
		         $myrow["recnum"],$myrow["mfg_id"],
                         $date,
                         $myrow["mfg_desc"]);
              printf('</td></tr>');
        }
?>

</table>
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