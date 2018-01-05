<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 19, 2017                 =
// Filename: suppmastersummary.php             =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays RM Master Summary list.            =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'rmmastersummary';
$page = "Purchasing: RM Master";
//////session_register('pagename');

// First include the class definition
include('classes/suppmasterClass.php');
include_once('classes/displayClass.php');

$newdisplay = new display;
$newsuppmaster = new suppmaster;

$dept = $_SESSION['department'];
$userrole = $_SESSION['userrole'];

$supplier = $_REQUEST['supplier'];
$recnum = $_REQUEST['recnum'];
$cname = $_REQUEST['cname'];
$cemail = $_REQUEST['cemail'];
$status = $_REQUEST['status'];


if ( isset ( $_REQUEST['supplier'] ) )
{
	$supplier = $_REQUEST['supplier'];
	$cond1 = "s.supplier like" . "'" . $supplier . "%" . "'";
}
else 
{
	$supplier = '';
	$cond1 = "s.supplier like '%'";
}

if ( isset ( $_REQUEST['recnum'] ) )
{
	$recnum = $_REQUEST['recnum'];
	$cond2 = "s.recnum like" . "'" . $recnum . "%" . "'";
}
else 
{
	$recnum = '';
	$cond2 = "s.recnum like '%'";
}

if ( isset ( $_REQUEST['cname'] ) )
{
	$cname = $_REQUEST['cname'];
	$cond3 = "s.contact_person like" . "'" . $cname . "%" . "'";
}
else 
{
	$cname = '';
	$cond3 = "s.contact_person like '%'";
}

if ( isset ( $_REQUEST['cemail'] ) )
{
	$cemail = $_REQUEST['cemail'];
	$cond4 = "s.contact_email like" . "'" . $cemail . "%" . "'";
}
else 
{
	$cemail = '';
	$cond4 = "s.contact_email like '%'";
}


if ( isset ( $_REQUEST['status'] ) )
{
	$status = $_REQUEST['status'];
	
	if ($status == "All") {
		$cond5 = "s.status in ('Active', 'Inactive','Pending')";
	}
	else
	{
		$cond5 = "s.status like" . "'" . $status . "%" . "'";
	}
}
else 
{
	$status = '';
	$cond5 = "s.status in ('Active', 'Inactive','Pending')";
}


$cond = $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5;

$rowsPerPage = 10;
$pageNum = 1;

if (isset($_REQUEST['page']))
{
	$pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
	$totpages = $_REQUEST['totpages'];
}

$offset = ($pageNum - 1) * $rowsPerPage;



?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/rmmaster.js"></script>

<html>
	<head>
		<title>Supplier Master Summary</title>
	</head>
<body leftmargin="0" topmargin="0" marginwidth="0" >

	<form action='suppmastersummary.php' method='post' enctype='multipart/form-data'>
	<?php
		include('header.html');
	?>

	<td bgcolor="#FFFFFF">
		<table width=100% border=0 cellpadding=6 cellspacing=0  >
		<tr><td>
		<tr>
			<td><span class="heading"><i>Please click on the RM to Edit</i></td>
		</tr>
		</tr>
		<tr>
			<td>
				
				<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
					<tr>
						<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search & Sort Criteria</center></b></td>
						<td bgcolor="#FFFFFF" rowspan=3 align="center"><span class="tabletext">
							<button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button>
						</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF"><span class="tabletext"><b>Seq #</b></td>
						<td bgcolor="#FFFFFF"><input type="text" name="seqnum" size=15 value="<?php echo $seqnum ?>" ></td>

						<td bgcolor="#FFFFFF"><span class="tabletext"><b>Supplier</b></td>
						<td bgcolor="#FFFFFF" ><input type="text" name="supplier" size=15 value="<?php echo $supplier ?>" ></td>

						<td bgcolor="#FFFFFF"><span class="tabletext"><b>Contact Name</b></td>
						<td bgcolor="#FFFFFF" ><input type="text" name="cname" size=15 value="<?php echo $cname ?>" ></td>

					</tr>
					<tr>
						<td bgcolor="#FFFFFF"><span class="labeltext"><b>Status </b></td>
						<td bgcolor="#FFFFFF"><span class="tabletext">
							<select name="status" size="1" width="50">
								<option value="All" <?php if($status == "All" || $status == ""){ echo "selected='selected'";}?>>All</option>
								<option value="Active" <?php if($status == "Active"){ echo "selected='selected'";}?> >Active</option>
								<option value="Inactive" <?php if($status == "Inactive"){ echo "selected='selected'";}?> > Inactive</option>
								<option value="Pending" <?php if($status == "Pending"){ echo "selected='selected'";}?> >Pending</option>
							</select>
						</td>

						<td bgcolor="#FFFFFF"><span class="tabletext"><b>Contact Email</b></td>
						<td bgcolor="#FFFFFF" colspan="3"><input type="text" name="cemail" size=15 value="<?php echo $cemail ?>" ></td>

					</tr>
				</table>

			</td>
		</tr>

		<tr>
			<td>
				<table width=100% border=0>
					<div class="contenttitle radiusbottom0">
						<h2><span>List Of RM Master Data

						<?php
						if($dept=='Sales' ||$dept=='Purchasing' )
						{
						?>
						<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='suppmasterEntry.php'" value="New" >
						<!-- <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='rmmasterExport.php?cond=<?php echo $rmcode_match ?>'" value="Export" > -->

						<?php
						}

						?>
						</span>
						</h2>

			</td>
		</tr>
		</table>

		<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" >
		  <thead>
				<tr>
					<th  class="head0"><span class="tabletext"><b>Seq#</b></th>
					<th  class="head1"><span class="tabletext"><b>Supplier</b></th>
					<th  class="head0"><span class="tabletext"><b>Address</b></th>
					<th  class="head1"><span class="tabletext"><b>Scope</b></th>
					<th  class="head0"><span class="tabletext"><b>Contact Name</b></th>
					<th  class="head1"><span class="tabletext"><b>Contact Email</b></th>
					<th  class="head0"><span class="tabletext"><b>Method Type</b></th>
					<th  class="head1"><span class="tabletext"><b>Extent Control</b></th>
					<th  class="head0"><span class="tabletext"><b>Inspect Year</b></th>
					<th  class="head1"><span class="tabletext"><b>Status</b></th>
				</tr>
			</thead>

			<?php

			$result = $newsuppmaster->GetAllSuppMaster($cond, $offset,$rowsPerPage);

			while($myrow=mysql_fetch_assoc($result))
			{


				$address = $myrow['addr1'].', '.$myrow['addr2'].'<br>';
				$address .= $myrow['city'].', '.$myrow['state'].'<br>';
				$address .= $myrow['zipcode'];
				$recnum = $myrow['recnum'];
				?>
				<tr bgcolor="#FFFFFF">
					<td ><span class="tabletext"><a href="suppmasterEdit.php?recnum=<?php echo $recnum; ?>"><?php echo $myrow['recnum']?></a></span></td>
					<td ><span class="tabletext"><?php echo $myrow['supplier']?></span></td>
					<td ><span class="tabletext"><?php echo $address ?></span></td>
					<td ><span class="tabletext"><?php echo $myrow['scope_approval']?></span></td>
					<td ><span class="tabletext"><?php echo $myrow['contact_person']?></span></td>
					<td ><span class="tabletext"><?php echo $myrow['contact_email']?></span></td>
					<td ><span class="tabletext"><?php echo $myrow['method_type']?></span></td>
					<td ><span class="tabletext"><?php echo $myrow['extent_control']?></span></td>
					<td ><span class="tabletext"><?php echo $myrow['inspection_year']?></span></td>
					<td ><span class="tabletext"><?php echo $myrow['status']?></span></td>
				</tr>
				<?php
			}
			?>
		</table>
	</table>
</table>

<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>

<?php

	$numrows = $newsuppmaster->GetSuppmasterCount();
	$maxPage = ceil($numrows/$rowsPerPage);

	if (!isset($_REQUEST['page']))
	{
		$totpages = $maxPage;
	}

	$self = $_SERVER['PHP_SELF'];

	if ($pageNum > 1)
	{
		$page = $pageNum - 1;
		$prev = " <a href=\"rmmastersummary.php?page=$page&totpages=$totpages&rmcode=$rmcode_match&rmspec=$rmspec_match&sortfld1=$sort1&status_val=$sval\">[Prev]</a> ";

		$first = " <a href=\"rmmastersummary.php?page=1&totpages=$totpages&rmcode=$rmcode_match&rmspec=$rmspec_match&sortfld1=$sort1&status_val=$sval\">[First Page]</a> ";
	}
	else
	{
		$prev  = ' [Prev] ';       
		$first = ' [First Page] '; 
	}

	if ($pageNum < $totpages)
	{
		$page = $pageNum + 1;
		$next = " <a href=\"rmmastersummary.php?page=$page&totpages=$totpages&rmcode=$rmcode_match&rmspec=$rmspec_match&sortfld1=$sort1&status_val=$sval\">[Next]</a> ";

		$last = " <a href=\"rmmastersummary.php?page=$totpages&totpages=$totpages&rmcode=$rmcode_match&rmspec<PRE></PRE>=$rmspec_match&sortfld1=$sort1&status_val=$sval\">[Last Page]</a> ";
	}
	else
	{
		$next = ' [Next] ';     
		$last = ' [Last Page] '; 
	}

	if($totpages!=0)
	{

		echo "<span class=\"labeltext\">" . $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last;
	}
	else{
		echo "<span class=\"labeltext\"><align=\"center\">No matching records found";	
	}
	

?>
</td>
</tr>


</table>
</FORM>
</body>
</html >

