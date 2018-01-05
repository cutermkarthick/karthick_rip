<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: solutionSummary.php               =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of solutions.                 =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$_SESSION['pagename'] = 'solutionsummary';
//session_register('pagename');
$page = "Solution: Solution";
$userid = $_SESSION['user'];

$cond = "s.solnum like '%'";
$worec='';
$oper='like';
$select='sol';
$sort1='sol';
$sol_match='';
$where1='';
if ( isset ( $_REQUEST['solcritval'] ) )
	$select=$_REQUEST['solcritval'];
if ( isset ( $_REQUEST['sol'] ) )
{
		$sol_match = $_REQUEST['sol']  ;
         		$cond = "s.prob_desc like" . " " .  "'" . "%" . $_REQUEST['sol'] . "%" . "'" . " " . "||" . " " . "s.sol_desc like" . " " .  "'" . "%" . $_REQUEST['sol'] . "%" . "'" ;
}
else
{$sol_match = '';
}

$sort1='';

if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
$sort1='s.solnum';
}

include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/solutionClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newdisp = new display;
$newlogin->dbconnect();
//$username = $_SESSION['user'];
$newsol = new solution;
// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage =10;

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

?>


<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Solution Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
	<form action='solutionSummary.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>

<script language="javascript" solc="scripts/solution.js"></script>
<table width=100% cellspacing="0" cellpadding="6" border="0">

<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
    <tr>

        <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        <td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>

    </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>

	</td></tr>
	<tr>
	<td>
		<?php $newdisp->dispLinks(''); ?>

<table width=100% border=0 cellpadding=0 cellspacing=0  >



			<tr bgcolor="DEDFDE">
      <td width="6"><img src="images/spacer.gif " width="6"></td> -->
				<td bgcolor="#FFFFFF">

					<table width=100% border=0 cellpadding=6 cellspacing=0  >

						<tr><td><span class="labeltext"><i>Please click on the sol# link for details and to Edit/Delete</i></td></tr>

						<tr><td>

				<table width=60% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" align=center class="stdtable1">

						<tr>
							<td bgcolor="#F5F6F5" colspan="3"><span class="labeltext"><b><center>Key Word Search</center></b></td>

							<td bgcolor="#F5F6F5"  colspan="4"><span class="labeltext"><b><center>Sort Criteria</center></b></td>

							<td bgcolor="#FFFFFF" rowspan=2 align="center"><span class="tabletext"><!-- <input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"> -->
<button class="stdbtn btn_blue" style="background-color:#2d3e50" onclick="javascript: return searchsort_fields()">Get</button></td>
</tr>

						<tr>
							<td bgcolor="#FFFFFF" colspan=3 align=center><input type="text" name="sol" size=15 value="<?php echo $sol_match ?>" onkeypress="javascript: return checkenter(event)">
        					   		 </td>
							<td bgcolor="#FFFFFF" colspan=4 align=center><span class="tabletext"><select name="sort1" size="1" width="100">
								<option selected>Sol ID
             								</select>
             								<input type="hidden" name="sortfld1">
             							</td>
<input type="hidden" name="sortfld1">
</td>
</tr>
</table>
</td></tr>

<tr><td>
<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2><span>List of Solutions               
  </h2>
</span>
</td>
</tr>

</td></tr>
</table>
<!-- <tr><td><span class="pageheading"><b>List of Solutions</b></td></tr>

<tr><td> -->

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<thead>
<tr>
<td class="head0"><span class="heading"><b>Sol ID #</b></td>
<td class="head1"><span class="heading"><b>Type</b></td>
<td class="head0"><span class="heading"><b><center>Title</b></td>
<td class="head1"><span class="heading"><b><center>File Name</b></td>
</tr>
</thead>         <?php
            $result = $newsol->getsols($cond,$sort1,$offset,$rowsPerPage);
            while ($myrow = mysql_fetch_row($result)) {
    	    printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="solution.php?recnum=%s">%s</td>',
		         $myrow[0],$myrow[1]);
          ?>
                           <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
                          <?php printf('<td bgcolor="#FFFFFF"><span class="tabletext"><a href="%s">%s</a></td>',"solutions/" . $myrow[4],$myrow[4]);?>
	          </tr> </tr>
           <?php
	}
              ?>
</table>


</td></tr>



					</table>

				</td>
				<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
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

<?php
//  Added on Dec 6,04 for paging
// how many rows we have in database
//$query   = "SELECT COUNT(*) AS numrows FROM work_order";
//$result  = mysql_query($query) or die('Error, query failed');
//$row     = mysql_fetch_array($result, MYSQL_ASSOC);
//$numrows = $row['numrows'];
$numrows = $newsol->getsolcount($cond,$offset, $rowsPerPage);
// how many pages we have when using paging?

$maxPage = ceil($numrows/$rowsPerPage);

if (!isset($_REQUEST['page']))
{
    $totpages = $maxPage;
}

$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one
if ($pageNum > 1)
{
    $page = $pageNum - 1;
    $prev = " <a href=\"solutionsummary.php?page=$page&totpages=$totpages&sol=$sol_match&solcritval=$where1&soloperval=&oper\">[Prev]</a> ";

    $first = " <a href=\"solutionsummary.php?page=1&totpages=$totpages&sol=$sol_match&solcritval=$where1&soloperval=&oper\">[First Page]</a> ";
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
    $next = " <a href=\"solutionsummary.php?page=$page&totpages=$totpages&sol=$sol_match&solcritval=$where1&soloperval=&oper\">[Next]</a> ";

    $last = " <a href=\"solutionsummary.php?page=$totpages&totpages=$totpages&sol=$sol_match&solcritval=$where1&soloperval=&oper\">[Last Page]</a> ";
}
else
{
    $next = ' [Next] ';      // we're on the last page, don't enable 'next' link
    $last = ' [Last Page] '; // nor 'last page' link
}

if($totpages!=0)
{
//$pageNum=0;
// print the page navigation link
echo "<span class=\"labeltext\">" . $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last;
}
else
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";
// End additions on Dec 6,04
?>
</td>
</tr></table>
</form>
</body>
</html>