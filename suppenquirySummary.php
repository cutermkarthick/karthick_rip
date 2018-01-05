<?php
//==============================================
// Author: FSI                                 =
// Date-written =  Dec 28, 2017                =
// Filename: suppenquirySummary.php            =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of Quality Plan.              =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
	header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'suppenquirySummary';
$page = "Purchasing: Supplier Enquiry";


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

include('classes/suppenquiryClass.php');
include_once('classes/displayClass.php');
$newdisplay = new display;
$newsuppenquiry = new suppenquiry;

?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="../scripts/mouseover.js"></script>
<script language="javascript" src="scripts/enquiry.js"></script>

<html>
	<head>
		<title>Enquiry Summary</title>
	</head>
	<body leftmargin="0"topmargin="0" marginwidth="0">
		<form action='enquirySummary.php' method='post' enctype='multipart/form-data'>
		<?php
			include('header.html');
		?>

		<td bgcolor="#FFFFFF">
		<table width=100% border=0 cellpadding=6 cellspacing=5>
			<tr>
				<td><span class="heading"><i>Please click on the Ref Num link to Edit or Delete</i></td>
			</tr>
			<tr>
				<td>
					<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
						<tr>
							<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></span></td>
							<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></span></td>
							<td bgcolor="#FFFFFF" rowspan=2 align="center">
							<button class="stdbtn btn_blue" style="background-color:#2d3e50" onclick="javascript: return searchsort_fields()">Get</button>
							</td>
						</tr>

						<tr>
							<td bgcolor="#FFFFFF"><span class="tabletext">
								<select name="scomp" size="1" width="50">
								<?php if($select=='id'){?>
								<option selected>id
								<option value>name<?php }else {?>
								<option selected>name
								<option value>id<?php }?>
								</select>
							</td>
							<td bgcolor="#FFFFFF"><span class="tabletext">
								<select name="competitor_oper" size="1" width="50">
								<?php if($oper=='like'){?>
								<option selected>like
								<option value>=<?php }else {?>
								<option selected>=
								<option value>like<?php }?>
							</td>
							<td bgcolor="#FFFFFF"><input type="text" name="competitor" size=20 value="<?php echo $company_match ?>" onkeypress="javascript: return checkenter(event)"></td>
							<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
							<td bgcolor="#FFFFFF" colspan=3><span class="tabletext">
								<select name="sort1" size="1" width="100">
									<option selected>name
								</select>
								<input type="hidden" name="sortfld1">
								<input type="hidden" name="competitorfl">
								<input type="hidden" name="competitor_oper">
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table width=100% border=0>
					<div class="contenttitle radiusbottom0">
					<h2><span>Enquiry Summary
					<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px" onclick="location.href='newsuppenquiry.php'" value="New Enquiry">
					</h2>
					</span>
				</td>
			</tr>
		</table>

		<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable">
			<thead>
				<tr>
					<th class="head0"><span class="tabletext"><b>SL NO.</b></th>
					<th class="head1"><span class="tabletext"><b>Enq Date</b></th>
					<th class="head0"><span class="tabletext"><b>Customer</b></th>
					<th class="head1"><span class="tabletext"><b>Part Description</b></th>
					<th class="head0"><span class="tabletext"><b>Prt Number</b></th>
					<th class="head1"><span class="tabletext"><b>Qty</b></th>
					<!-- <th class="head0"><span class="tabletext"><b>RT Quatation Date</b></th>
					<th class="head1"><span class="tabletext"><b>RT Quatation No</b></th>
					<th class="head0"><span class="tabletext"><b>Risk Involved</b></th>
					<th class="head1"><span class="tabletext"><b>Risk Details</b></th> -->
					<th class="head0"><span class="tabletext"><b>Status</b></th>
				</tr>
			</thead>

				<?php
				$result = $newsuppenquiry->getAllSuppEnquirys($cond);
				while ($myrow = mysql_fetch_assoc($result)) 
				{

			   	if($myrow['enq_date'] != '0000-00-00' && $myrow['enq_date'] != '' && $myrow['enq_date'] != 'NULL')
		      {
			      $datearr = split('-', $myrow['enq_date']);
			      $d=$datearr[2];
			      $m=$datearr[1];
			      $y=$datearr[0];
			      $x=mktime(0,0,0,$m,$d,$y);
			      $enq_date=date("M j, Y",$x);
		     	}
		     	else
		     	{
		        $enq_date = '';
		     	}

         	if($myrow['rtquot_date'] != '0000-00-00' && $myrow['rtquot_date'] != '' && $myrow['rtquot_date'] != 'NULL')
          {
	          $datearr = split('-', $myrow['rtquot_date']);
	          $d=$datearr[2];
	          $m=$datearr[1];
	          $y=$datearr[0];
	          $x=mktime(0,0,0,$m,$d,$y);
	          $rtquot_date=date("M j, Y",$x);
         	}
	        else
	        {
	          $rtquot_date = '';
	        }
	        echo "<tr>";
	        echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\"><a href=\"suppenquiryDetails.php?recnum=".$myrow["recnum"]."\">".$myrow["recnum"]."</span></td>";
	        echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$enq_date."</span></td>";
	        echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$myrow["name"]."</span></td>";
	        echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$myrow["partdesc"]."</span></td>";
	        echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$myrow["partnum"]."</span></td>";
	        echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$myrow["qty"]."</span></td>";
	        // echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$rtquot_date."</span></td>";
	        // echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$myrow["rtquot_no"]."</span></td>";
	        // echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$myrow["risk_involv"]."</span></td>";
	        // echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$myrow["risk_details"]."</span></td>";
	        echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$myrow["status"]."</span></td>";
					echo "</tr>";
				}

				?>
				</table>
				</td>
				</tr>
				</table>
				</td>

</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>

<?php


$numrows=10;
$maxPage = ceil($numrows/$rowsPerPage);

if (!isset($_REQUEST['page']))
{
	$totpages = $maxPage;
}

$self = $_SERVER['PHP_SELF'];

if ($pageNum > 1)
{
	$page = $pageNum - 1;
	$prev = " <a href=\"qualityplanSummary.php?page=$page&totpages=$totpages&qualityplanSummary=$company_match&scompanyfl=$where1&competitor_oper=$oper\">[Prev]</a> ";

	$first = " <a href=\"qualityplanSummary.php?page=1&totpages=$totpages&qualityplanSummary=$company_match&competitorfl=$where1&competitor_oper=$oper\">[First Page]</a> ";
}
else
{
	$prev  = ' [Prev] ';       
	$first = ' [First Page] '; 
}

if ($pageNum < $totpages)
{
	$page = $pageNum + 1;
	$next = " <a href=\"qualityplanSummary.php?page=$page&totpages=$totpages&competitor=$company_match&competitorfl=$where1&competitor_oper=$oper\">[Next]</a> ";

	$last = " <a href=\"qualityplanSummary.php?page=$totpages&totpages=$totpages&competitor=$company_match&competitorfl=$where1&competitor_oper=$oper\">[Last Page]</a> ";
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
</body>
</html>
