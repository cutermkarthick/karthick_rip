<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: employees.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays employees                          =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'employees'; 
$page= "Employee";
//////session_register('pagename');

// First include the class definition 
include('classes/empClass.php'); 
include_once('classes/loginClass.php');
include_once('classes/displayClass.php'); 
$newdisplay = new display;
 
$newlogin = new userlogin;
$newlogin->dbconnect();
$empname = $_SESSION['user'];

//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George

$newEmp = new emp; 
$cond = "e.role like '%'";
$sort1='e.lname';
$select='role';
$select1='lname';
$worec='';
$oper='like';
$where1='';

if ( isset ( $_REQUEST['semp'] ))
{
     $emp_match = $_REQUEST['semp'];
     if ($emp_match!='')
{

     if ( isset ( $_REQUEST['emp_oper'] ) ) {
          $oper = $_REQUEST['emp_oper'];
//echo "$oper</br>";   
     }
     else {
         $oper = 'like';
     }
     if ($oper == 'like') {
         $semp = "'" . $_REQUEST['semp'] . "%" . "'";
     }
     else {
         $semp = "'" . $_REQUEST['semp'] . "'";
     }
     $where1 =$_REQUEST['semprl'];
     $select=$_REQUEST['semprl'];
     $cond = "e." . $where1 . " " . $oper . " " . $semp;
//echo "$cond</br>";
}
else
  $cond="e.role like '%'";
}
else {
     $emp_match = '';
  }

//$sort1='';
if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = "e." . $_REQUEST['sortfld1'];
    $select1 =$_REQUEST['sortfld1'];
}
if (isset($_REQUEST['submit'])) {
       $submit=$_REQUEST['submit'];
       if ($submit=='New Employee')
	 header ("Location: new_emp.php");
}

//echo "$sort1";


if (isset($_REQUEST['empid'])) {
    $empid = $_REQUEST['empid'];
    $cond1 = "e.empid like '" . $empid . "%'";
}
else{
  $empid = "";
  $cond1 = "e.empid like '" . $empid . "%'";
}


if (isset($_REQUEST['role'])) {
    $urole = $_REQUEST['role'];
    $cond2 = 'e.role like "' . $urole . '%"';
}
else{
  $urole = "";
  $cond2 = 'e.role like "' . $urole . '%"';
}

if (isset($_REQUEST['fname'])) {
    $fname = $_REQUEST['fname'];
    $cond3 = 'e.fname like "' . $fname . '%"';
}
else{
  $fname = "";
  $cond3 = 'e.fname like "' . $fname . '%"';
}

if (isset($_REQUEST['dept'])) {
    $dept = $_REQUEST['dept'];
    $cond4 = 'e.dept like "' . $dept . '%"';
}
else{
  $dept = "";
  $cond4 = 'e.dept like "' . $dept . '%"';
}

$cond = $cond1 .' and '. $cond2 .' and '. $cond3 .' and '. $cond4 ;



// how many rows to show per page 
$rowsPerPage = 10; 

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

//End of Addition on Dec 29 -04 by Jerry George

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/emp.js"></script>

<html>
<head>
<title>Employee</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='employees.php?semp=&$emp_match&emp_oper=$oper&semprl=$where1&sortfld1=$sort1' method='post' enctype='multipart/form-data'>
<?php
	include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
	<td>
		<table width=100% border=0 cellspacing="0" cellpadding="0">
    			<tr>
       				 <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
       				 <td align="right" >&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image11','','images/logout_mo.gif',1)"><img name="Image11" border="0" src="images/logout.gif"></a></td>
    			</tr>
		</table>
		<table width=100% border=0 cellpadding=0 cellspacing=0  >
			<tr><td></td></tr>
			<tr>
				<td>
					<?php $newdisplay->dispLinks(''); ?>
					<table width=100% border=0 cellpadding=0 cellspacing=0  >
						<tr bgcolor="DEDFDE">
  						<td width="6"><img src="images/spacer.gif " width="6"></td>
						<td bgcolor="#FFFFFF"> -->
							<table width=100% border=0 cellpadding=6 cellspacing=0  >
								<tr><td><span class="heading"><i>Please click on the Id link to Edit or Delete</i></td></tr>
								<tr><td>
								<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
									<tr>
										<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search Criteria</center></b></td>
										
										<td bgcolor="#FFFFFF" rowspan=3 align="center"><span class="tabletext">
											<input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">
										</td>
									</tr>

	   					    <tr>
                    <td bgcolor="#FFFFFF"><span class="labeltext"><b>Emp Id</b></span></td>
                    <td bgcolor="#FFFFFF"></td>
                    <td bgcolor="#FFFFFF"><input type="text" name="empid" id="empid" value="<?php echo $empid; ?>"></td>
                    
                    <td bgcolor="#FFFFFF"><span class="labeltext"><b>Role</b></span></td>
                   <td bgcolor="#FFFFFF"><input type="text" name="role" id="role" value="<?php echo $urole; ?>"></td>
                    
                  </tr>

                  <tr>
                    <td bgcolor="#FFFFFF"><span class="labeltext"><b>First Name</b></span></td>
                    <td bgcolor="#FFFFFF"></td>
                    <td bgcolor="#FFFFFF"><input type="text" name="fname" id="fname" value="<?php echo $fname; ?>"></td>
                    
                    <td bgcolor="#FFFFFF"><span class="labeltext"><b>Department</b></span></td>
                   <td bgcolor="#FFFFFF"><input type="text" name="dept" id="dept" value="<?php echo $dept; ?>"></td>
                    
                  </tr>


								</table>
								</td></tr>
								<tr><td>
								       <table width=100% border=0>
									<div class="contenttitle radiusbottom0">
<h2 class="table"><span>List of Employees

<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='new_emp.php'" value="New Employee" >
<!-- <a href ="new_emp.php"><img name="Image8" border="0" src="images/bu-newemployee.gif"> -->
</h2></span>
</tr>
</table>
								</td></tr>
								<tr>
									<td>
										<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
        											<tr>
                              <thead>
           												 <th class="head0"><span class="heading"><b>Id</b></th>
             												 <th class="head1"><span class="heading"><b>First Name</b></th>
            												<th class="head0"><span class="heading"><b>Last Name</b></th>
            												<th class="head1"><span class="heading"><b>Phone</b></th>
           												 <th class="head0"><span class="heading"><b>Email</b></th>
             												<th class="head1"><span class="heading"><b>Title</b></th>
             												<th class="head0"><span class="heading"><b>Role</b></th>
             													<th class="head1"><span class="heading"><b>Department</b></th>
            												<th class="head0"><span class="heading"><b>Status</b></th>                
        											</tr>
        												<?php
												$newlogin = new userlogin;
												$newlogin->dbconnect();
												$result = $newEmp->getEmps4sa($cond,$sort1,$offset,$rowsPerPage);
     												while ($myrow = mysql_fetch_row($result)) {
	      											printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="edit_emp.php?empid=%s&emp_type=%s"><b>%s</b></td>
                          									 		<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          											<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          											<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          											<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          											<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          											<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          											<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          											<td bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>',
										         		 $myrow[4],$myrow[15],$myrow[4],
                         											$myrow[0],
                         											$myrow[1],
                        										  	$myrow[6],
                         											 $myrow[7],
                          											$myrow[5],
                         											$myrow[3],
                         											$myrow[14],
                        									  		$myrow[13]);
             												 printf('</td></tr>');
      										  		}
 												?>
											               </table>
 											</td>
										</tr>
									</table>
								</td>
						<!-- 		<td width="6"><img src="images/spacer.gif " width="6"></td>
							</tr>
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/box-left-bottom.gif"></td>
								<td><img src="images/spacer.gif " height="6"></td>
								<td width="6"><img src="images/box-right-bottom.gif"></td>
							</tr>
						</table>
						<table border = 0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left>   --> 
<?php

//Additions on Dec 29 04 by Jerry George to implement pagination

$numrows = $newEmp->getEmpcount($cond,$offset, $rowsPerPage);
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
    $prev = " <a href=\"employees.php?page=$page&totpages=$totpages&empid=$empid&role=$urole&fname=$fname&dept=$dept\">[Prev]</a> "; 
     
    $first = " <a href=\"employees.php?page=1&totpages=$totpages&empid=$empid&role=$urole&fname=$fname&dept=$dept\">[First Page]</a> "; 
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
    $next = " <a href=\"employees.php?page=$page&totpages=$totpages&empid=$empid&role=$urole&fname=$fname&dept=$dept\">[Next]</a> "; 
     
    $last = " <a href=\"employees.php?page=$totpages&totpages=$totpages&empid=$empid&role=$urole&fname=$fname&dept=$dept\">[Last Page]</a> "; 
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
echo "<span class=\"labeltext\"><align=\"center\">There is no matching records find";
// End additions on Dec 29,04

?> 

								</td>
							</tr>
						</table>
					</FORM>
		</body>
</html>
