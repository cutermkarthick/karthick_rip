<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 21, 2004                =
// Filename: Po2wosummary.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Coded by Jerry George
// For displaying Wos related to specific Pos
// Modifications History                       =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$cond = "c.name like '%'";
$porecnum=$_REQUEST['porecnum'];
$add='';
$_SESSION['pagename'] = 'po2wosummary';
//////session_register('pagename');

// First include the class definition

include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/workorderClass.php');
include('classes/poClass.php');
include('classes/displayClass.php');
$newPO = new po;
$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$newworkOrder = new workOrder;
$newdisplay = new display;

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 6;

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

// End additions on Dec 6,04
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/wo.js"></script>

<html>
<head>
<title>Work Order</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action="po_link_unlink.php?porecnum=<?php echo "$porecnum";?>" method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">

<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
    <tr>

        <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        <td align="right"><a href="chPassword.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/chpwd_mo.gif',1)"><img name="Image15" border="0" src="images/chpwd.gif"></a>
        <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>

    </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>

	</td></tr>
	<tr>
	<td>
<?php $newdisplay->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >



			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

					<table width=100% border=0 cellpadding=6 cellspacing=0  >

						<tr><td>
							<table width=100% border=0 cellpadding=6 cellspacing=0>
								<tr>
                                    <td><span class="pageheading"><b>List of Work Orders Linked With Purchase Order : <?php echo "$porecnum";?></b></td><td colspan=380>&nbsp;</td>
        						    <td bgcolor="#FFFFFF" rowspan=2 align="right"><a href ="po_link_unlink.php?submit=LinkWO&porecnum=<?php echo "$porecnum";?>"><img name="Image7" border="0" src="images/bu-linkwo.gif"></a>
                    				    <a href ="po_link_unlink.php?submit=UnlinkWO&porecnum=<?php echo "$porecnum";?>"><img name="Image7" border="0" src="images/bu-unlinkwo.gif"></a> </td>
                                </tr>
							</table>
						</td></tr>
<tr><td>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>WO</b></td>
           <td bgcolor="#EEEFEE"><span class="heading"><b><center>Company</center></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Designer</center></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Type</center></b></td>
           <td bgcolor="#EEEFEE"><span class="heading"><b><center>Cust PO</center></b></td>
           <td bgcolor="#EEEFEE"><span class="heading"><b>Quote</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Status</center></b></td>
           <td bgcolor="#EEEFEE"><span class="heading"><b><center>Sch Due Date(yymmdd)</center></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Actual Ship Date(yymmdd)</center></b></td>

        </tr>



<?php


            $result = $newPO->getwo4Po($cond,$porecnum,$offset,$rowsPerPage);
            $flag = 0;
        while ($myrow = mysql_fetch_row($result)) {
            if ($flag == 0)
 {
              	      printf('<tr><td rowspan=2 bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
		        $myrow[0]
                        );

              $flag = 1;
?>              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
                         <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[13] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[14] != '00-00-00') echo $myrow[14] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[15] != '00-00-00') echo $myrow[15] ?></td></tr>
             <tr><td colspan=8 bgcolor="#FFFFFF"><span class="heading">Description:<span class="tabletext"><?php echo $myrow[12] ?></td></tr>
        </tr>
<?php
        }

            else {
              	      printf('<tr><td rowspan=2 bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
		        $myrow[0]
                        );
                     $flag = 0;
?>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
                         <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[13] ?></td>
                         <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[14] != '00-00-00') echo $myrow[14] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[15] != '00-00-00') echo $myrow[15] ?></td></tr>
             <tr bgcolor="#EEEEEE"><td colspan=8  bgcolor="#FFFFFF"><span class="heading">Description:<span class="tabletext"><?php echo $myrow[12] ?></td></tr>
        </tr>
<?php
        }
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


<?php
//  Added on Dec 04 for paging
// how many rows we have in database
//$query   = "SELECT COUNT(*) AS numrows FROM work_order";
//$result  = mysql_query($query) or die('Error, query failed');
//$row     = mysql_fetch_array($result, MYSQL_ASSOC);
//$numrows = $row['numrows'];
//echo "$cond</br>";
$numrows = $newPO->getWocount4Po($porecnum);
// how many pages we have when using paging?
//echo "row num  :$numrows";
$maxPage = ceil($numrows/$rowsPerPage);

//echo "max pages  :$maxPage";
if (!isset($_REQUEST['page']))
{
    $totpages = $maxPage;
//echo "</br>page set total pages  :$totpages";

}
//echo "</br>total pages  :$totpages";
$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one
if ($pageNum > 1)
{
    $page = $pageNum - 1;
    $prev = "<a href=\"po2wosummary.php?page=$page&porecnum=$porecnum&totpages=$totpages\">[Prev]</a> ";

    $first = "<a href=\"po2wosummary.php?page=1&porecnum=$porecnum&totpages=$totpages\">[First Page]</a> ";
}
else
{
    $prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
    $first = ' [First Page] '; // nor 'first page' link
}

// print 'next' link only if we're not
// on the last page
if ($pageNum < $totpages)
{
    $page = $pageNum + 1;
    $next = "<a href=\"po2wosummary.php?page=$page&porecnum=$porecnum&totpages=$totpages\">[Next]</a> ";

    $last = " <a href=\"po2wosummary.php?page=$totpages&porecnum=$porecnum&totpages=$totpages\">[Last Page]</a> ";
}
else
{
    $next = ' [Next] ';      // we're on the last page, don't enable 'next' link
    $last = ' [Last Page] '; // nor 'last page' link
}

// print the page navigation link echo ;
echo "<span class=\"labeltext\">" . $first . $prev . "Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last;

// End additions

?>

</td>
</tr></table>
</form>
</body>
</html>