<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = march 20, 2007               =
// Filename: masterprocesssheetSummary.php     =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of MPS.                       =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$_SESSION['pagename'] = 'testreport';
//////session_register('pagename');

$userid = $_SESSION['user'];

$cond = "refno like '%'";
$worec='';
$oper='like';
$select='Part num';
$sort1='Ref No';
$mast_match='';
$where1='';

if ( isset ( $_REQUEST['mast'] ) )
{
  	 // echo "po set</br>";
     	$mast_match = $_REQUEST['mast'];
    	//echo "</br>po match  :$po_match</br>";
        if ($mast_match!='')
        {
    	if ( isset ( $_REQUEST['mastoperval'] ) ) {
       		   $oper = $_REQUEST['mastoperval'];
          		//echo "po oper set   :$oper</br>";
    	 }
     	else {
      		// echo "po oper not set</br>";
         		$oper = 'like';
    	       }
   	       if ($oper == 'like') {
         		$master = "'" . $_REQUEST['mast'] . "%" . "'";
    	       }
                      else {
         	     	$master = "'" . $_REQUEST['mast'] . "'";
             	      }
	$where1 =$_REQUEST['mastcritval'];
       	$select=$_REQUEST['mastcritval'];
	//echo "</br> value of where   :$where1";
	 if($where1=='Part num'){


  		$cond = "partno" . " " . $oper . " " . $master;}

    }
    else
   {
$mast_match = '';
           //   echo "</br>po match is null";

	//$where1 =$_REQUEST['pocritval'];
	//echo "where1 is  :$where1";

             //echo "cond :$cond";
}
}
else {
//echo "po not set";
$mast_match = '';
}
//echo "$cond";
$sort11='';

if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
   if ($sort1=='Ref No')
     $sort11= "refno" ;
    //echo "sort is set :$sort1</br>";
    //	$sort1='s.ponum';
   //echo "sort is set after :$sort1";
}



include_once('classes/loginClass.php');
include('classes/testreportClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newdisp = new display;
$newlogin->dbconnect();
//$username = $_SESSION['user'];
$newTR = new testreport;
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
<title>Test Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
	<form action='testreport.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<link rel="stylesheet" href="style.css">

<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" solc="scripts/testreport.js"></script>

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
		<?php $newdisp->dispLinks('');?>

<table width=100% border=0 cellpadding=0 cellspacing=0  >



			<tr bgcolor="DEDFDE">
      <td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

					<table width=100% border=0 cellpadding=6 cellspacing=0  >

						<tr><td><span class="heading"><i>Please click on the ref# link for details and to Edit/Delete</i></td></tr>

						<tr><td>

				<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" align=center>

						<tr>
							<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>

							<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>

                            <td bgcolor="#FFFFFF" rowspan=2 align="center">
                                 <input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">
                            </td>

						<tr>

                            <td bgcolor="#FFFFFF"><span class="tabletext"><select name="mastcrit" size="1" width="50">
            													<?php
													if($select=='Part num'){
													?>
													        <option selected>Ref num

													<?php }?>
             						 							</select>
						  							 <input type="hidden" name="mastcritval">
					   	 						</td>
        					    				<td bgcolor="#FFFFFF"><span class="tabletext"><select name="mast_oper" size="1" width="50">
             									    <?php if($oper=='like'){?>
            													<option selected>like
													            <option value>=<?php }else {?>
             													<option selected>=
													            <option value>like<?php }?>
            													</select>
             													<input type="hidden" name="mastoperval">
        					    				 </td>
							<td bgcolor="#FFFFFF" align=center><input type="text" name="mast" size=15 value="<?php echo $mast_match ?>" onkeypress="javascript: return checkenter(event)">
        					   		 </td>
        					<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
							<td bgcolor="#FFFFFF" colspan=3 align=center><span class="tabletext"><select name="sort1" size="1" width="100">
								<option selected>Ref No
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
  <tr>
	<td><span class="pageheading"><b>List Test Reports</b></td>
	<td colspan=180>&nbsp;</td>
    <td><a href ="new_testreport.php"><img name="Image8" border="0" src="images/bu_newtestreport.gif"></a>
	</td>
  </tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
            <tr>
            	<td bgcolor="#EEEFEE"><span class="heading"><b>Ref#</b></td>
               	<td bgcolor="#EEEFEE"><span class="heading"><b>Part Num</b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Customer</b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Name</b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Customer Standard</b></td>
                <td bgcolor="#EEEFEE"><span class="heading"><b><center>RM Inv. No.</b></td>
                <td bgcolor="#EEEFEE"><span class="heading"><b><center>Material Type</b></td>
                <td bgcolor="#EEEFEE"><span class="heading"><b><center>Material Specification</b></td>
         </tr>
       <?php
            $result = $newTR->gettestreports($cond,$sort11,$offset,$rowsPerPage);
            while ($myrow = mysql_fetch_assoc($result)) {
    	    printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="testreportDetails.php?trrecnum=%s">%s</td>',
		        $myrow['recno'],$myrow['refno']);
          ?>


        <?php
          //  $d=substr($myrow['inv_date'],8,2);
           // $m=substr($myrow['inv_date'],5,2);
           // $y=substr($myrow['inv_date'],0,4);
           // $x=mktime(0,0,0,$m,$d,$y);
           // $date=date("M j, Y",$x);
           // echo "$date";
          ?>


                   <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['partno'] ?></td>
                   <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['customer'] ?></td>
                   <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['partname'] ?></td>
                   <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['cust_standard'] ?></td>
                   <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['rm_inv_no'] ?></td>
                   <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['material_type'] ?></td>
                   <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['material_spec'] ?></td>
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
$numrows = $newTR->gettestreportCount($cond,$offset, $rowsPerPage);
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
    $prev = " <a href=\"testreport.php?page=$page&totpages=$totpages&sol=$mast_match&solcritval=$where1&soloperval=&oper\">[Prev]</a> ";

   $first = " <a href=\"testreport.php?page=1&totpages=$totpages&sol=$mast_match&solcritval=$where1&soloperval=&oper\">[First Page]</a> ";
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
    $next = " <a href=\"testreport.php?page=$page&totpages=$totpages&sol=$mast_match&solcritval=$where1&soloperval=&oper\">[Next]</a> ";

    $last = " <a href=\"testreport.php?page=$totpages&totpages=$totpages&sol=$mast_match&solcritval=$where1&soloperval=&oper\">[Last Page]</a> ";
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
