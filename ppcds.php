<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = march 22, 2007               =
// Filename: ppcds.php                         =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of Data Sheets.               =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$_SESSION['pagename'] = 'ppcds';
//////session_register('pagename');

$userid = $_SESSION['user'];

$cond = "d.opn_ref_no like '%'";
$worec='';
$oper='like';
$select='opn ref num';
$sort1='opn ref num';
$data_match='';
$where1='';

if ( isset ( $_REQUEST['data'] ) )
{
  	 // echo "po set</br>";
     	$data_match = $_REQUEST['data'];
    	//echo "</br>po match  :$po_match</br>";
        if ($data_match!='')
        {
    	if ( isset ( $_REQUEST['dataoperval'] ) ) {
       		   $oper = $_REQUEST['dataoperval'];
          		//echo "po oper set   :$oper</br>";
    	 }
     	else {
      		// echo "po oper not set</br>";
         		$oper = 'like';
    	       }
   	       if ($oper == 'like') {
         		$data = "'" . $_REQUEST['data'] . "%" . "'";
    	       }
                      else {
         	     	$data = "'" . $_REQUEST['data'] . "'";
             	      }
	$where1 =$_REQUEST['datacritval'];
       	$select=$_REQUEST['datacritval'];
	//echo "</br> value of where   :$where1";
	 if($where1=='opn ref num'){

  		$cond = "d.opn_ref_no" . " " . $oper . " " . $data;
      }

    }
    else
   {
$data_match = '';
           //   echo "</br>po match is null";

	//$where1 =$_REQUEST['pocritval'];
	//echo "where1 is  :$where1";

             //echo "cond :$cond";
}
}
else {
//echo "po not set";
$data_match = '';
}
//echo "$cond";
$sort11='';

if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
   if ($sort1=='opn ref num')
     $sort11= "d.opn_ref_no" ;
    //echo "sort is set :$sort1</br>";
    //	$sort1='s.ponum';
   //echo "sort is set after :$sort1";
}



include_once('classes/loginClass.php');
include('classes/dataClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newdisp = new display;
$newlogin->dbconnect();
//$username = $_SESSION['user'];
$newDT = new data;
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
<title>DS Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
	<form action='ppcds.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>

<script language="javascript" solc="scripts/datasheet.js"></script>
<table width=100% cellspacing="0" cellpadding="6" border="0">

<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
    <tr>

        <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        <td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>

    </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
	<tr><td>

	</td></tr>
	<tr>
	<td>
		<?php $newdisp->dispLinks(''); ?>

<table width=100% border=0 cellpadding=0 cellspacing=0  >



			<tr bgcolor="DEDFDE">
      <td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

					<table width=100% border=0 cellpadding=6 cellspacing=0  >

						<tr><td><span class="heading"><i>Please click on the opn ref# link for details and to Edit/Delete</i></td></tr>

						<tr><td>

    <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" align=center>

						<tr>
							<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
                            <td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
                         	<td bgcolor="#FFFFFF" rowspan=2 align="center">
                                 <input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">
                            </td>
                        </tr>

     <tr>
											<td bgcolor="#FFFFFF"><span class="tabletext"><select name="scomp" size="1" width="50">
												<?php if($select=='id'){?>
             												<option selected>id
             												<option value>Opn Ref Num<?php }else {?>
             												<option selected>Opn Ref Num
             												<option value>id<?php }?>
             							 					</select>
        							 				</td>
        											<td bgcolor="#FFFFFF"><span class="tabletext"><select name="competitor_oper" size="1" width="50">
             												<?php if($oper=='like'){?>
            												<option selected>like
												<option value>=<?php }else {?>
             												<option selected>=
												<option value>like<?php }?>
        											</td>
											<td bgcolor="#FFFFFF"><input type="text" name="competitor" size=20 value="<?php echo $data_match ?>" onkeypress="javascript: return checkenter(event)"></td>
											<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
											<td bgcolor="#FFFFFF" colspan=3><span class="tabletext"><select name="sort1" size="1" width="100">
             												<option selected>Opn Ref Num
            												</select>
												<input type="hidden" name="sortfld1">
												<input type="hidden" name="competitorfl">
												<input type="hidden" name="competitor_oper">
       							 				</td>
										</tr>

</td></tr>
<table width=100% border=0>
  <tr>
	<td><span class="pageheading"><b>List of DS's</b></td>
	<td colspan=200>&nbsp;</td>
    <td><a href ="new_ds.php"><img name="Image8" border="0" src="images/bu_newdatasheet.gif"></a>
	</td>
  </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

			<tr>
            	<td bgcolor="#EEEFEE"><span class="heading"><b>Opn Ref#</b></td>
               	<td bgcolor="#EEEFEE"><span class="heading"><b>Drg. Issue</b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Work Centre</b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Opn. No.</b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Number</b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Attachments</b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Rev. No.</b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Name</b></td>
                <td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Type</b></td>
                <td bgcolor="#EEEFEE"><span class="heading"><b><center>Rev. Date</b></td>
             </tr>
       <?php
            $result = $newDT->getdatas($cond,$sort11,$offset,$rowsPerPage);
            while ($myrow = mysql_fetch_assoc($result)) {
    	    printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="ds_details.php?datarecnum=%s">%s</td>',
		        $myrow['recnum'],$myrow['opn_ref_no']);
          ?>
          
          <?php
            $d=substr($myrow['revdate'],8,2);
            $m=substr($myrow['revdate'],5,2);
            $y=substr($myrow['revdate'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";
          ?>
          
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['drg_issue']  ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['work_center'] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['opnnum'] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['partnum'] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['attachments'] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['revnum'] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['partname'] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['parttype'] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date ?></td>
                          <!--<td bgcolor="#FFFFFF"><span class="tabletext"><?php /*echo $myrow['prepared_by'] */?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php  /* echo $myrow['approved_by'] */?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php /* echo $myrow['issuenum'] */?></td>  -->

	         </tr>
           <?php
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
//  Added on Dec 6,04 for paging
// how many rows we have in database
//$query   = "SELECT COUNT(*) AS numrows FROM work_order";
//$result  = mysql_query($query) or die('Error, query failed');
//$row     = mysql_fetch_array($result, MYSQL_ASSOC);
//$numrows = $row['numrows'];
$numrows = $newDT->getdatacount($cond,$offset, $rowsPerPage);
// how many pages we have when using paging?
//$numrows = 15;
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
    $prev = " <a href=\"ppcds.php?page=$page&totpages=$totpages&sol=$data_match&solcritval=$where1&soloperval=&oper\">[Prev]</a> ";

   $first = " <a href=\"ppcds.php?page=1&totpages=$totpages&sol=$data_match&solcritval=$where1&soloperval=&oper\">[First Page]</a> ";
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
    $next = " <a href=\"ppcds.php?page=$page&totpages=$totpages&sol=$data_match&solcritval=$where1&soloperval=&oper\">[Next]</a> ";

    $last = " <a href=\"ppcds.php?page=$totpages&totpages=$totpages&sol=$data_match&solcritval=$where1&soloperval=&oper\">[Last Page]</a> ";
}
else
{
    $next = ' [Next] ';      // we're on the last page, don't enable 'next' link
    $last = ' [Last Page] '; // nor 'last page' link
}

if($totpages!=0)
{
$pageNum;
 //print the page navigation link
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
