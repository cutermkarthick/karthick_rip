<?php
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$_SESSION['page1'] = 'rmasummary'; 
//////session_register('page1');

$cond = "r.rmaid like '%'";
$worec='';
$oper='like';
$select='rma ID';
$sort1='rma ID';
$rma_match='';
$where1='rma ID';
if ( isset ( $_REQUEST['rmacritval'] ) )
{	$select=$_REQUEST['rmacritval'];
	$where1=$_REQUEST['rmacritval'];
}
if ( isset ( $_REQUEST['rma'] ) )
{
      	$rma_match = $_REQUEST['rma'];
        if ($rma_match!='')
        {
    	if ( isset ( $_REQUEST['rmaoperval'] ) ) {
       		  $oper = $_REQUEST['rmaoperval'];
    	 }
     	else {
         		$oper = 'like';
    	       }
   	       if ($oper == 'like') {
         		$rma = "'" . $_REQUEST['rma'] . "%" . "'";
    	       }
                      else {
         	     	$rma = "'" . $_REQUEST['rma'] . "'";
             	      }
	$where1 =$_REQUEST['rmacritval'];
       	$select=$_REQUEST['rmacritval'];
	 if($where1=='rma ID'){
		$where1="rmaid" ;
  		$cond = "r." . $where1 . " " . $oper . " " . $rma;}
	else  if($where1=='Customer'){
		 $where1="name" ;
    		 $cond = "c." . $where1 . " " . $oper . " " . $rma;}
	else if($where1='Status'){
		 $where1="rmaid" ;
    		 $cond = "r." . $where1 . " " . $oper . " " . $rma;}
   }
    else
   {
$rma_match = '';
}
}
else {
//echo "rma not set";
$rma_match = '';
}

$sort1='';

if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
    if($sort1=='rma ID')
	$sort1='r.rmaid';
    else
	$sort1='c.name';
}

include_once('classes/userClass.php'); 
include_once('classes/loginClass.php'); 
include('classes/rmaClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
//$username = $_SESSION['user'];
$newrma = new rma; 
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
	<form action='rmasummary.php? method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/rma.js"></script>
<table width=100% cellspacing="0" cellpadding="6" border="0">

<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
    <tr>
 
        <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        <td align="right">&nbsp; <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image161','','images/logout_mo.gif',1)"><img name="Image161" border="0" src="images/logout.gif"></a></td>
       
    </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>
	
	</td></tr>
	<tr>
	<td>
<?php $newrma->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

		

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

					<table width=100% border=0 cellpadding=6 cellspacing=0  >
						
						<tr><td><span class="heading"><i>Please click on the rma ID# link for details and to Edit/Delete</i></td></tr>

						<tr><td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
						
						<tr>
							<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
							
							<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
							
							<td bgcolor="#FFFFFF" rowspan=2 align="center"><span class="tabletext"><input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"></td>
</tr>

						<tr>
							<td bgcolor="#FFFFFF"><span class="tabletext"><select name="rmacrit" size="1" width="50">
						<?php if($select=='rma ID'){?>
              						 <option selected>rma ID
             						 <option value>Wo num
             						 <?php }?>
						<?php if($select=='Wo num'){?>
              						<option selected>Wo num
             						 <option value>rma ID
      						 <?php }?>
      
      						  </select>
						   </td>
							<td bgcolor="#FFFFFF"><span class="tabletext"><select name="rma_oper" size="1" width="50">
      						<?php if($oper=='like'){?>
            						<option selected>like
						<option value>=<?php }else {?>
             						<option selected>=
						<option value>like<?php }?>
            						</select>
              			 	</td>
							<td bgcolor="#FFFFFF"><input type="text" name="rma" size=15 value="<?php echo $rma_match ?>" onkeypress="javascript: return checkenter(event)">
        			 	</td>
							<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
							<td bgcolor="#FFFFFF" colspan=3><span class="tabletext"><select name="sort1" size="1" width="100">
					<option selected>rma ID
             					 </select>
             					</td>
<input type="hidden" name="rmacritval" value="rma ID">
<input type="hidden" name="sortfld1" value="Customer">
<input type="hidden" name="company_oper">
</td>
							
</tr>
</table>
</td></tr>
<tr><td><span class="pageheading"><b>List of Service Requests</b></td></tr>

<tr><td>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
						
						<tr>

            	<td bgcolor="#EEEFEE"><span class="heading"><b>rma ID #</b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Received Date</center></b></td>
           	<td bgcolor="#EEEFEE"><span class="heading"><b>Actual Complete date</b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Wo Num</center></b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Sol Num</center></b></td>
         </tr>
         <?php
            $result = $newrma->getrmas($cond,$sort1,$offset,$rowsPerPage); 
            while ($myrow = mysql_fetch_row($result)) {
	    printf('<tr><td rowspan=2 bgcolor="#FFFFFF"><span class="tabletext"><a href="rma.php?recnum=%s">%s</td>',
		         $myrow[0],$myrow[1]);
          ?>
           	         <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
	          </tr>
           <?php
       	 }
             ?>
</table>


</td></tr>



					</table>

				</td>
				<td width="6"><img rmac="images/spacer.gif " width="6"></td>
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
$numrows = $newrma->getrmacount($cond,$offset, $rowsPerPage);
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
    $prev = " <a href=\"rmaSummary.php?page=$page&totpages=$totpages&rma=$rma_match&rmacritval=$where1&rmaoperval=&oper\">[Prev]</a> "; 
     
    $first = " <a href=\"rmaSummary.php?page=1&totpages=$totpages&rma=$rma_match&rmacritval=$where1&rmaoperval=&oper\">[First Page]</a> "; 
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
    $next = " <a href=\"rmaSummary.php?page=$page&totpages=$totpages&rma=$rma_match&rmacritval=$where1&rmaoperval=&oper\">[Next]</a> "; 
     
    $last = " <a href=\"rmaSummary.php?page=$totpages&totpages=$totpages&rma=$rma_match&rmacritval=$where1&rmaoperval=&oper\">[Last Page]</a> "; 
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
