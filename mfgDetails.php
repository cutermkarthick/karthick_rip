<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 18, 2005                =
// Filename: mfgDetails.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$cond = "c.name like '%'";
$mfgrecnum=$_REQUEST['recnum'];
$_SESSION['mfgrecnum'] = $mfgrecnum;
//////session_register('mfgrecnum');
$add='';
$_SESSION['pagename'] = 'mfgDetails';
//////session_register('pagename');

// First include the class definition

include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/mfgClass.php');
include('classes/displayClass.php');
$newmfg = new mfg;
$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
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
<script language="javascript" src="scripts/mfg.js"></script>

<html>
<head>
<title>MFG Details</title>
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
<?php $newdisplay->dispLinks('');
$result = $newmfg ->getmfg($mfgrecnum);
$myrow=mysql_fetch_assoc($result);
 ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td>
<table width=100% border=0 cellpadding=2 cellspacing=0>
<tr><td><span class="pageheading"><b>Manufacturing Orders</b></td>
<td align=right>
<a href ="womgt4mfg.php?submit=LinkWO&recnum=<?php echo "$mfgrecnum";?>"><img name="Image7" border="0" src="images/bu-linkwo.gif"></a>
<a href ="womgt4mfg.php?submit=UnlinkWO&recnum=<?php echo "$mfgrecnum";?>"><img name="Image7" border="0" src="images/bu-unlinkwo.gif"></a>
<a href="javascript:printMfg('<?php echo $mfgrecnum ?>')"><img name="Image7" border="0" src="images/bu-print.gif"></a>
</td></tr>
</table>
</td></tr>
<tr><td>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>
<?php
              $d=substr($myrow["orderdate"],8,2);
              $m=substr($myrow["orderdate"],5,2);
              $y=substr($myrow["orderdate"],0,4);
              $x=mktime(0,0,0,$m,$d,$y);
              $date=date("M j, Y",$x);

?>
<tr bgcolor="#FFFFFF" width=100%>
<td><span class="labeltext"><p align="left">*Mfg ID #</p></td>
<td ><span class="tabletext"><?php echo $myrow["mfg_id"] ?></td>
<td><span class="labeltext"><p align="left">*Order Date</p></font></td>
<td ><span class="tabletext"><?php echo $date ?>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Mfg Desc</p></font></td>
<td colspan=3><span class="tabletext"><?php echo $myrow["mfg_desc"] ?></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Company</p></font></td>
            <td  colspan=3><span class="tabletext"><?php echo $myrow["name"] ?> </td>

</tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>*Contact Information</b></center></td>
        </tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Contact</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow["fname"].' '.$myrow["lname"]?>
            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["phone"] ?></td>
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["email"] ?></td>
        </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#DDDEDD">
<td colspan=6><span class="heading"><center><b>List of Work Orders</b></center></td>
</tr>
      <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>WO</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Company</center></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Designer</center></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Type</center></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Status</center></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Sch Due Date(yymmdd)</center></b></td>

        </tr>


<?php

            $result = $newmfg->getwo4mfg($mfgrecnum);
            $flag = 0;
        while ($myrow = mysql_fetch_assoc($result)) {
            if ($flag == 0)
 {
              	      printf('<tr><td  bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
		        $myrow["wonum"]
                        );

              $flag = 1;
?>              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["name"] ?></td>
                <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["initials"] ?></td>
                <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["wotype"] ?></td>
                <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["status"] ?></td>

                <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow["date_format(w.sch_due_date,'%y-%m-%d')"] != '00-00-00') echo $myrow["date_format(w.sch_due_date,'%y-%m-%d')"] ?></td>
        </tr>
<?php
        }

            else {
              	      printf('<tr><td  bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
		        $myrow["wonum"]
                        );
                     $flag = 0;
?>
                        <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["name"] ?></td>
                        <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["initials"] ?></td>
                        <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["wotype"] ?></td>
                        <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["status"] ?></td>
                        <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow["date_format(w.sch_due_date,'%y-%m-%d')"] != '00-00-00') echo $myrow["date_format(w.sch_due_date,'%y-%m-%d')"] ?></td>
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
<?php /*
//  Added on Dec 04 for paging
// how many rows we have in database
//$query   = "SELECT COUNT(*) AS numrows FROM work_order";
//$result  = mysql_query($query) or die('Error, query failed');
//$row     = mysql_fetch_array($result, MYSQL_ASSOC);
//$numrows = $row['numrows'];
//echo "$cond</br>";
$numrows = $newmfg->getwo4mfgcnt($mfgrecnum);
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
*/
?>

</td>
</tr></table>
</form>
</body>
</html>