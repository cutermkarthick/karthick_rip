<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: leadssummary.php                  =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of Leads.                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'emailsummary';
//session_register('pagename');

// First include the class definition
include_once('classes/userClass.php');
include('classes/emailClass.php');
include_once('classes/displayClass.php');
$newemail= new email;
$newdisplay = new display;
$page = "Utillities: Email";
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/leads.js"></script>
<html>
<head>
<title>Email Summary</title>
</head>
<?php
include('header.html');
?>
<form action='emailsummary.php' method='post' >
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
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
 -->	    <td bgcolor="#FFFFFF">
      <table width=100% border=0 cellpadding=6 cellspacing=0  >
  <tr><td><span class="heading"><i></i></td></tr>
  <tr><td>
<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2><span>Emails: My Inbox
  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px" onClick="location.href='new_email.php'" value="Compose" >

</h2>
</span>
</td>
</tr>

</td></tr>
</table>
<!--<tr>
<td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>

<table width=100% border=0>
  <tr>
	<td><span class="pageheading"><b>Emails: My Inbox</b></td>
	<td colspan=170>&nbsp;</td>
    <td><a href ="new_email.php"><img name="Image88" border="0" src="images/compose.gif"></a>
 </td>
  </tr>

</table> -->
    <table width=100% border=0 cellpadding=0 cellspacing=1  >
    <td> <HR align="left" width=100% size=2 >
    </table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable" >
<thead>
<tr  bgcolor="#FFCC00">
<td  class="head0" width=10%><span class="tabletext"><b>To</b></td>
<td  class="head1" width=10%><span class="tabletext"><b>Sender</b></td>
<td  class="head0" width=10%><span class="tabletext"><b>Subject</b></td>
<td  class="head1" width=20%><span class="tabletext"><b>Date</b></td>
</tr>
</thead>
<?php

             $result = $newemail->getmails();
            while ($row = mysql_fetch_assoc($result)) {

                $d=substr($row["create_date"],8,2);
                $m=substr($row["create_date"],5,2);
                $y=substr($row["create_date"],0,4);
                $x=mktime(0,0,0,$m,$d,$y);
                $date=date("M j, Y",$x);
             //echo "$date";

                  printf('<tr bgcolor="#FFFFFF"><td ><span class="tabletext">
                          <span class="tabletext">%s</a></td>
                          <td><a href="mailDetails.php?emailrecnum=%s">%s</td>
                          <td><span class="tabletext">%s</a></td>
                          <td><span class="tabletext">%s</td>',
                    $row["to_addrs"],
                    $row["recnum"], $row["from_addr"],
                    $row["subject"],
                    $date
                   );

              printf('</td></tr>');
              }
?>

</table>
      </table>
        <!--  <td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
                <tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->

        </table>
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
	<td align=left>


</td>
</tr></table>

      </FORM>
</body>
</html >