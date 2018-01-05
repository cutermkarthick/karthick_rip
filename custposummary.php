<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: custposummary.php                 =
// Copyright of Fluent Technologies            =
// Revision: v1.0 WMS                          =
// Displays list of GRNs.                      =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'custposummary';
//////session_register('pagename');

// First include the class definition
include_once('classes/salesorderClass.php');
include_once('classes/displayClass.php');

$newsalesorder = new salesorder;
$newdisplay = new display;

$userrole = $_SESSION['userrole'];

// echo $cond;
// how many rows to show per page
$rowsPerPage = 1000;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

 //echo $offset;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<html>
<head>
<title>SalesOrder Summary</title>
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
			<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
     <tr><td>
          <tr><td><span class="heading"><i>Please click on the link fordetails</i></td></tr>
		</tr>
  <tr>
<td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
</table>
<tr><td>
<table width=100% border=0>
	<tr>
	<td><span class="pageheading"><b>List of Sales Order</b></td>
	</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr  bgcolor="#FFCC00">
            <td align="center" bgcolor="#EEEFEE" width=5%><span class="tabletext"><b>Sl.#</b></td>
            <td align="center" bgcolor="#EEEFEE" width=6%><span class="tabletext"><b>Cust PO</b></td>
            <td align="center" bgcolor="#EEEFEE" width=15%><span class="tabletext"><b>Description</b></td>
            <td align="center" bgcolor="#EEEFEE" width=15%><span class="tabletext"><b>Customer Name</b></td>
            <td align="center" bgcolor="#EEEFEE" width=8%><span class="tabletext"><b>Order Date</b></td>
            <td align="center" bgcolor="#EEEFEE" width=8%><span class="tabletext"><b>PO Amount</b></td>
        </tr>      

<?php


           $result = $newsalesorder->getSo4cust($wcond);
	   while ($myrow = mysql_fetch_row($result)) 
           {
              
                if($myrow[3] != '0000-00-00' && $myrow[3] != '' && $myrow[3] != 'NULL')
                {
                    $datearr = split('-', $myrow[3]);
                    $d=$datearr[2];
                    $m=$datearr[1];
                    $y=$datearr[0];
                    $x=mktime(0,0,0,$m,$d,$y);
                    $date=date("M j, Y",$x);
                }
                else
                {
                    $date = '';
                }
                printf('<tr bgcolor="#FFFFFF"><td align="center"><span class="tabletext"><a href="custpoDetails.php?salesorderrecnum=%s">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="left"><span class="tabletext">%s</td>
                          <td align="left"><span class="tabletext">%s</td>
                          <td align="left"><span class="tabletext">%s</td>
                          <td align="right"><span class="tabletext">%s %.2f</td>',

                          $myrow[0],$myrow[0],
                          $myrow[4],
                          $myrow[2],
                          $myrow[1],
                          $date,
                          $myrow[10],$myrow[5]);
  
                printf('</td></tr>');
           }
?>
</table>
      </table>
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
							</tr>
						</table>
      </FORM>
</body>
</html>

