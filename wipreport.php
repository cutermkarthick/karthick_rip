<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 19, 2008                =
// Filename: crn_status.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Displays WO Status report                   =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');

include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 4000;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
	//echo "i am set";
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}
// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;
$cond='';
if($_REQUEST['wonum']=='' && $_REQUEST['grnnum']=='' && $_REQUEST['crnnum']=='')
{
	$cond='';
}
if($_REQUEST['wonum']!=''){	
$wonum = "'" . $_REQUEST['wonum'] . "%" . "'";
$cond .= ' and '.'w.wonum like '.$wonum;
}
if($_REQUEST['grnnum']!=''){	
if($cond!='where'){	
$grnnum = "'" . $_REQUEST['grnnum'] . "%" . "'";
$cond .= ' and '.'w.grnnum like '.$grnnum;
}
else
{	
$grnnum = "'" . $_REQUEST['grnnum'] . "%" . "'";
$cond .= ' and '.'w.grnnum like '.$grnnum;
}
}

if($_REQUEST['crnnum']!=''){	
if($cond!='where'){	
$crnnum = "'" . $_REQUEST['crnnum'] . "%" . "'";
$cond .= ' and '.'m.CIM_refnum like '.$crnnum;
}
else
{	
$crnnum = "'" . $_REQUEST['crnnum'] . "%" . "'";
$cond .= ' and '.'m.CIM_refnum like '.$crnnum;
}
}

include('classes/reportClass.php');
include('classes/displayClass.php');
$newreport = new report;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>WIP Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
	
<?php
include('header.html');

?>
<form action='wipreport.php' method='post' enctype='multipart/form-data'>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
 </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>
<?php $newdisplay ->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td>
  <table width=100% border=0 cellspacing="0" cellpadding="0">
   <tr><td><span class="heading"><b>Work in Progress Report</b></td>
	<tr>
 <td align="right" cospan=10><a href="wip_export.php?crnnum=<?php echo $_REQUEST['crnnum'] ?>&grnnum=<?php echo $_REQUEST['grnnum'] ?>
 &wonum=<?php echo $_REQUEST['wonum'] ?>"><b><img src="images/export.gif" alt="CRN Stock Report"></b></a></td>
 </tr>

<table width=100% border=0 cellpadding=6 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="17"><span class="heading"><b><center>Search Criteria</center></b></td>
</tr>
<tr>
	<td bgcolor="#FFFFFF" ><span class="labeltext"><b>GRN No:</b>&nbsp;
	<input type="text" name="grnnum" size=15 value="<?php echo $_REQUEST['grnnum'] ?>" ></td>
	<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN #:</b>&nbsp;
	<input type="text" name="crnnum" size=15 value="<?php echo $_REQUEST['crnnum'] ?>" ></td>
	<td bgcolor="#FFFFFF"><span class="labeltext"><b>WO No:</b>&nbsp;
	<input type="text" name="wonum" size=15 value="<?php echo $_REQUEST['wonum'] ?>"></td>		
	<td bgcolor="#FFFFFF" rowspan=2  align="center"><span class="tabletext"><input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">
	</td>     
	</tr>

</table>

<table width=100% border=0 cellpadding=6 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
		  <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>GRN No</b></td>
            <td width="7%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN #</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>WO No</b></td>
             <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty</b></td>
            <td width="7%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Unit Sales Price</b></td>
            <td width="7%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Sales Cost</b></td>
			 <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Unit RM Price</b></td>
            <td width="7%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Cost</b></td>
        </tr>

<?php   		
		$total_dollar_unit_cost=0;
		$total_dollar_rm_cost=0;
		$total_rupee_unit_cost=0;
		$total_rupee_rm_cost=0;
		$total_without_unit_cost=0;
		$total_without_rm_cost=0;

        $result = $newreport->getworkinprogress($cond,$offset,$rowsPerPage);
        while ($myrow = mysql_fetch_row($result)) {	 
			$curr=$myrow[8];
			if($curr == '$'){
                $total_dollar_unit_cost += $myrow[5];
                $total_dollar_rm_cost += ($myrow[7]*45);
			}
			else if($curr == 'Rs'){
				 $total_rupee_unit_cost += $myrow[5];
				 $total_rupee_rm_cost += ($myrow[7]);
			}
			else if($curr == ''){
				 $total_without_unit_cost += $myrow[5];
				 $total_without_rm_cost += ($myrow[7]*45);
			}

            printf('<tr><td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
					<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
					<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%s %.2f</td>',
                      $myrow[0],                     
                      $myrow[1],
                      $myrow[2],
                      $myrow[3],
					  $myrow[8],
					  $myrow[4]);
		printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%s %.2f</td>',$myrow[8],$myrow[5]);
		printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s %.2f</td>',$myrow[8],$myrow[6]);
		printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">Rs %.2f</td>',($myrow[7]*45));
			

}
?>
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan="5" align="right" class="labeltext">Total Cost($)</td>
<td colspan="1" align="right" class="tabletext"><?php printf('%s %.2f','$',$total_dollar_unit_cost);?></td>
<td colspan="1" align="right" class="labeltext">&nbsp;</td>
<td colspan="1" align="right" class="tabletext"><?php printf('%s %.2f','Rs',$total_dollar_rm_cost);?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan="5" align="right" class="labeltext">Total Cost(Rs)</td>
<td colspan="1" align="right" class="tabletext"><?php printf('%s %.2f','Rs',$total_rupee_unit_cost);?></td>
<td colspan="1" align="right" class="labeltext">&nbsp;</td>
<td colspan="1" align="right" class="tabletext"><?php printf('%s %.2f','Rs',$total_rupee_rm_cost);?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan="5" align="right" class="labeltext">Total Cost(null)</td>
<td colspan="1" align="right" class="tabletext"><?php printf('%s %.2f','',$total_without_unit_cost);?></td>
<td colspan="1" align="right" class="labeltext">&nbsp;</td>
<td colspan="1" align="right" class="tabletext"><?php printf('%s %.2f','',$total_without_rm_cost);?></td>
</tr>
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
</form>
</body>
</html>
