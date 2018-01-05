<?php
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'srsummary'; 
//////session_register('pagename');

$cond = "s.status like '%'";
$worec='';
$oper='like';
$select='Sr';
$sort1='Sr';
$sr_match='';
$where1='Sr';
if ( isset ( $_REQUEST['srcritval'] ) )
{	$select=$_REQUEST['srcritval'];
	$where1=$_REQUEST['srcritval'];
}
if ( isset ( $_REQUEST['sr'] ) )
{
      	$sr_match = $_REQUEST['sr'];
        if ($sr_match!='')
        {
    	if ( isset ( $_REQUEST['sroperval'] ) ) {
       		  $oper = $_REQUEST['sroperval'];
    	 }
     	else {
         		$oper = 'like';
    	       }
   	       if ($oper == 'like') {
         		$sr = "'" . $_REQUEST['sr'] . "%" . "'";
    	       }
                      else {
         	     	$sr = "'" . $_REQUEST['sr'] . "'";
             	      }
	$where1 =$_REQUEST['srcritval'];
       	$select=$_REQUEST['srcritval'];
	 if($where1=='SR'){
		$where1="srnum" ;
  		$cond = "s." . $where1 . " " . $oper . " " . $sr;}
	else  if($where1=='COMPANY'){
		 $where1="name" ;
    		 $cond = "c." . $where1 . " " . $oper . " " . $sr;}
	else if($where1='Status'){
		 $where1="status" ;
    		 $cond = "s." . $where1 . " " . $oper . " " . $sr;}
   }
    else
   {
$sr_match = '';
}
}
else {
//echo "sr not set";
$sr_match = '';
}

$sort1='';

if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
    if($sort1=='Sr')
	$sort1='s.srnum';
    else
	$sort1='c.name';
}

include_once('classes/userClass.php'); 
include_once('classes/loginClass.php'); 
include('classes/srClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
//$username = $_SESSION['user'];
$newsr = new sr; 
// For paging - Added on Dec 6,04
 
// how many rows to show per page 
$rowsPerPage =1; 

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
<title>Service Request</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
	<form action='srsummary.php? method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/sr.js"></script>
<table width=100% cellspacing="0" cellpadding="6" border="0">

<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
    <tr>
 
        <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        <td align="right">&nbsp; <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
       
    </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>
	
	</td></tr>
	<tr>
	<td>
<?php $newsr->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

		

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

					<table width=100% border=0 cellpadding=6 cellspacing=0  >
						
						<tr><td><span class="heading"><i>Please click on the SR# link for details and to Edit/Delete</i></td></tr>

						<tr><td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
						
						<tr>
							<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
							
							<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
							
							<td bgcolor="#FFFFFF" rowspan=2 align="center"><span class="tabletext"><input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"></td>
</tr>

						<tr>
							<td bgcolor="#FFFFFF"><span class="tabletext"><select name="srcrit" size="1" width="50">
						<?php if($select=='Sr'){?>
              						 <option selected>Sr
             						 <option value>Company
      						 <option value>Type
             						 <option value>Status<?php }?>
						<?php if($select=='Company'){?>
              						<option selected>Company
             						 <option value>Sr
      						 <option value>Type
             						 <option value>Status<?php }?>
						<?php if($select=='Type'){?>
              						<option selected>Type
             						 <option value>Sr
      						 <option value>Company
             						 <option value>Status<?php }?>
						<?php if($select=='Status'){?>
              						<option selected>Status
             						 <option value>Sr
      						 <option value>Company
             						 <option value>Type<?php }?>
      
      						  </select>
						   </td>
							<td bgcolor="#FFFFFF"><span class="tabletext"><select name="sr_oper" size="1" width="50">
      						<?php if($oper=='like'){?>
            						<option selected>like
						<option value>=<?php }else {?>
             						<option selected>=
						<option value>like<?php }?>
            						</select>
              			 	</td>
							<td bgcolor="#FFFFFF"><input type="text" name="sr" size=15 value="<?php echo $sr_match ?>" onkeypress="javascript: return checkenter(event)">
        			 	</td>
							<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
							<td bgcolor="#FFFFFF" colspan=3><span class="tabletext"><select name="sort1" size="1" width="100">
					<?php if($sort1=='Sr'){?>
             					<option selected>Sr
             					<option value>Company<?php }else {?>
             					<option selected>Company
					<option value>Sr<?php }?>
             					 </select>
             					</td>
<input type="hidden" name="srcritval" value="Sr">
<input type="hidden" name="sortfld1" value="Company">
<input type="hidden" name="company_oper">
</td>
							
</tr>
</table>
</td></tr>
<tr><td><span class="pageheading"><b>List of Service Requests</b></td></tr>

<tr><td>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
						
						<tr>

            	<td bgcolor="#EEEFEE"><span class="heading"><b>SR ID #</b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Customer</center></b></td>
           	<td bgcolor="#EEEFEE"><span class="heading"><b>Type</b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Owner</center></b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Priority</center></b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Status</center></b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Date</b></center></td>  
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Title</b></td>    
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Age (days)</center></b></td>
         </tr>
         <?php
            $result = $newsr->getsrs($cond,$sort1,$offset,$rowsPerPage); 
            while ($myrow = mysql_fetch_row($result)) {
	    printf('<tr><td rowspan=2 bgcolor="#FFFFFF"><span class="tabletext"><a href="sr.php?recnum=%s">%s</td>',
		         $myrow[0],$myrow[1]);
          ?>
           	         <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
                         <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[6] ?></td>
              	          <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[7] != '00-00-00') echo $myrow[7] ?></td>
                        <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[8] ?></td>
  	 <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[9] ?></td></td></tr>
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
$numrows = $newsr->getSrcount($cond,$offset, $rowsPerPage);
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
    $prev = " <a href=\"srSummary.php?page=$page&totpages=$totpages&sr=$sr_match&srcritval=$where1&sroperval=&oper\">[Prev]</a> "; 
     
    $first = " <a href=\"srSummary.php?page=1&totpages=$totpages&sr=$sr_match&srcritval=$where1&sroperval=&oper\">[First Page]</a> "; 
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
    $next = " <a href=\"srSummary.php?page=$page&totpages=$totpages&sr=$sr_match&srcritval=$where1&sroperval=&oper\">[Next]</a> "; 
     
    $last = " <a href=\"srSummary.php?page=$totpages&totpages=$totpages&sr=$sr_match&srcritval=$where1&sroperval=&oper\">[Last Page]</a> "; 
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
