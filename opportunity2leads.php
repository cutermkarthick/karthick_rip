<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = October 18,2006              =
// Filename: opportunity2leads.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays leads                              =
// Coded by Suresh Devadiga                    =
// For displaying leads related to specific opp=
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$_SESSION['popage'] = 'opportunity2leads';
// $page = $_SESSION['popage'];
$page ="CRM: Leads";
//session_register('pagename');
//$wonum=$_REQUEST['wonum'];
if (isset($_REQUEST['opportunityrecnum']))
{
	$opportunityrecnum=$_REQUEST['opportunityrecnum'];
  }
  else if (isset($_SESSION['opportunityrecnum']))
  {

}
$leadrecnum=$_REQUEST['leadrecnum'];
$oppname=$_REQUEST['oppname'];
// First include the class definition
include('classes/userClass.php');
include('classes/leadsClass.php');
include('classes/opportunityClass.php');
include('classes/displayClass.php');
$newopportunity = new opportunity;
$newLead = new leads;
$newdisplay = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>Leads</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
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
	<tr><td>

	</td></tr>
	<tr>
	<td>
<?php
     $newdisplay->dispLinks('');


?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >



			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td> -->
				<td bgcolor="#FFFFFF">

					<table width=100% border=0 cellpadding=6 cellspacing=0  >

					<tr><td><span class="pageheading"><b>Leads Linked To Opportunity   :<?php echo"$oppname"; ?></b></td></tr>

						<tr><td>

<table width=100% border=0 cellpadding=4 cellspacing=1 class="stdtable" >
<thead>
<tr>
<th class="head0"><span class="heading"><b>Leads Name</b></th>
<th class="head1"><span class="heading"><b>Lead Date</b></th>
<th class="head1"><span class="heading"><b>Company</b></th>
<th class="head0"><span class="heading"><b>Source</b></th>
<th class="head1"><span class="heading"><b>Industry</b></th>
<th class="head0"><span class="heading"><b>Product Interest</b></th>
<th class="head1"><span class="heading"><b>Primary</b></th>
</tr>
</thead>


<?php

       $result = $newLead->getleads4opportunity($leadrecnum);
         while ($row = mysql_fetch_assoc($result)) {
	    $precnum='';
	    printf('
<tr>
<td align="center" bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td align="center" bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td align="center" bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td align="center" bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td align="center" bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td align="center" bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td align="center" bgcolor="#FFFFFF"><span class="tabletext">%s</td>
</tr>',
                          $row["name"],
                          $row["creation_date"],
                          $row["company"],
                          $row["source"],
                          $row["industry_segment"],
                          $row["product_interest"],
                          $row["primary_lead"]);
            printf('</td></tr>');
        }
?>


</table>

</td></tr>

			</table>

				</td>
		<!-- 		<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
 -->
		</table>

<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
	<td align=left>
</td>
</tr></table>

</body>
</html>