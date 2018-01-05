<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec,20, 2004                 =
// Filename: wo2po.php                         =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays POs                                =
// Coded by Jerry George
// For displaying Pos related to specific Wos
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['popage'] = 'wo2po';
//////session_register('pagename');
$worecnum=$_REQUEST['worecnum'];
$wonum=$_REQUEST['wonum'];

// First include the class definition
include('classes/userClass.php');
include('classes/poClass.php');
include('classes/workorderClass.php');
include('classes/displayClass.php');
$newworkOrder = new workOrder;
$newPO = new po;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>PO</title>
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
	<tr><td>

	</td></tr>
	<tr>
	<td>
<?php
     $newdisplay->dispLinks('');


?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >



			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

					<table width=100% border=0 cellpadding=6 cellspacing=0  >

					<tr><td><span class="pageheading"><b>Purchase Orders Linked To Work Order          :<?php echo"$wonum"; ?></b></td></tr>

						<tr><td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

        <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Seq #</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>PO #</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Date</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Vendor Name</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Description</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Amount</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Status</b></td>

        </tr>


<?php
        $result = $newPO->getpo4Wo($worecnum);

        while ($myrow = mysql_fetch_row($result)) {
	    $precnum='';
	    printf('<tr>
                         <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                         <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                         <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                         <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                         <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                         <td bgcolor="#FFFFFF"><span class="tabletext">$%.2f</td>
                         <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    </tr>',
		         $myrow[11],
                         $myrow[0],
                         $myrow[1],
                         $myrow[3],
                         $myrow[2],
                         $myrow[6],
                         $myrow[7]);
            printf('</td></tr>');
        }
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
	<td align=left>
</td>
</tr></table>

</body>
</html>