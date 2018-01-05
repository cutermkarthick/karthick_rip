<?php
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$_SESSION['page1'] = 'ecosummary'; 
//////session_register('page1');

$cond = "e.econum like '%'";
$worec='';
$oper='like';
$select='eco ID';
$sort1='eco ID';
$eco_match='';
$where1='eco ID';
if ( isset ( $_REQUEST['ecocritval'] ) )
{	$select=$_REQUEST['ecocritval'];
	$where1=$_REQUEST['ecocritval'];
}
if ( isset ( $_REQUEST['eco'] ) )
{
      	$eco_match = $_REQUEST['eco'];
        if ($eco_match!='')
        {
    	if ( isset ( $_REQUEST['ecooperval'] ) ) {
       		  $oper = $_REQUEST['ecooperval'];
    	 }
     	else {
         		$oper = 'like';
    	       }
   	       if ($oper == 'like') {
         		$eco = "'" . $_REQUEST['eco'] . "%" . "'";
    	       }
                      else {
         	     	$eco = "'" . $_REQUEST['eco'] . "'";
             	      }
	$where1 =$_REQUEST['ecocritval'];
       	$select=$_REQUEST['ecocritval'];
	 if($where1=='eco ID'){
		$where1="econum" ;
  		$cond = "r." . $where1 . " " . $oper . " " . $eco;}
	else  if($where1=='Customer'){
		 $where1="name" ;
    		 $cond = "c." . $where1 . " " . $oper . " " . $eco;}
	else if($where1='Status'){
		 $where1="econum" ;
    		 $cond = "r." . $where1 . " " . $oper . " " . $eco;}
   }
    else
   {
$eco_match = '';
}
}
else {
//echo "eco not set";
$eco_match = '';
}

$sort1='';

if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
    if($sort1=='eco ID')
	$sort1='e.econum';
    else
	$sort1='c.name';
}

include_once('classes/userClass.php'); 
include_once('classes/loginClass.php'); 
include('classes/ecoClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
//$username = $_SESSION['user'];
$neweco = new eco; 
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
	<form action='ecosummary.php? method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/eco.js"></script>
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
<?php $neweco->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

		

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

					<table width=100% border=0 cellpadding=6 cellspacing=0  >
						
						<tr><td><span class="heading"><i>Please click on the eco ID# link for details and to Edit/Delete</i></td></tr>

						<tr><td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
						
						<tr>
							<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
							
							<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
							
							<td bgcolor="#FFFFFF" rowspan=2 align="center"><span class="tabletext"><input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"></td>
</tr>

						<tr>
							<td bgcolor="#FFFFFF"><span class="tabletext"><select name="ecocrit" size="1" width="50">
						<?php if($select=='eco ID'){?>
              						 <option selected>eco ID
             						 <option value>Wo num
             						 <?php }?>
						<?php if($select=='Wo num'){?>
              						<option selected>Wo num
             						 <option value>eco ID
      						 <?php }?>
      
      						  </select>
						   </td>
							<td bgcolor="#FFFFFF"><span class="tabletext"><select name="eco_oper" size="1" width="50">
      						<?php if($oper=='like'){?>
            						<option selected>like
						<option value>=<?php }else {?>
             						<option selected>=
						<option value>like<?php }?>
            						</select>
              			 	</td>
							<td bgcolor="#FFFFFF"><input type="text" name="eco" size=15 value="<?php echo $eco_match ?>" onkeypress="javascript: return checkenter(event)">
        			 	</td>
							<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
							<td bgcolor="#FFFFFF" colspan=3><span class="tabletext"><select name="sort1" size="1" width="100">
					<option selected>eco ID
             					 </select>
             					</td>
<input type="hidden" name="ecocritval" value="eco ID">
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

            	<td bgcolor="#EEEFEE"><span class="heading"><b>eco ID #</b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Doc Date</center></b></td>
           	<td bgcolor="#EEEFEE"><span class="heading"><b>Actual Complete date</b></td>
            	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Wo Num</center></b></td>
         </tr>
         <?php
            $result = $neweco->getecos($cond,$sort1,$offset,$rowsPerPage); 
            while ($myrow = mysql_fetch_row($result)) {
	    printf('<tr><td rowspan=2 bgcolor="#FFFFFF"><span class="tabletext"><a href="eco.php?recnum=%s">%s</td>',
		         $myrow[0],$myrow[1]);
          ?>
           	         <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4] ?></td>
	          </tr>
           <?php
       	 }
             ?>
</table>


</td></tr>



					</table>

				</td>
				<td width="6"><img ecoc="images/spacer.gif " width="6"></td>
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
$numrows = $neweco->getecocount($cond,$offset, $rowsPerPage);
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
    $prev = " <a href=\"ecoSummary.php?page=$page&totpages=$totpages&eco=$eco_match&ecocritval=$where1&ecooperval=&oper\">[Prev]</a> "; 
     
    $first = " <a href=\"ecoSummary.php?page=1&totpages=$totpages&eco=$eco_match&ecocritval=$where1&ecooperval=&oper\">[First Page]</a> "; 
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
    $next = " <a href=\"ecoSummary.php?page=$page&totpages=$totpages&eco=$eco_match&ecocritval=$where1&ecooperval=&oper\">[Next]</a> "; 
     
    $last = " <a href=\"ecoSummary.php?page=$totpages&totpages=$totpages&eco=$eco_match&ecocritval=$where1&ecooperval=&oper\">[Last Page]</a> "; 
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
