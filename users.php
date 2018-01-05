<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: users.php                         =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// User List page                              =
//==============================================
@session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'users'; 
$page = "User";
//////session_register('pagename');

//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George

$cond = "u.userid like '%'";
$select ='userid';
$worec='';
$where1='';
$oper='like';
if ( isset ( $_REQUEST['suser'] ) )
{
     $user_match = $_REQUEST['suser'];
     if ($user_match!='')
{
     if ( isset ( $_REQUEST['user_oper'] ) ) {
          $oper = $_REQUEST['user_oper'];
    }
     else {
         $oper = 'like';
     }
     if ($oper == 'like') {
         $suser = "'" . $_REQUEST['suser'] . "%" . "'";
     }
     else {
         $suser = "'" . $_REQUEST['suser'] . "'";
     }
     $where1 =$_REQUEST['user2'];
     $select=$_REQUEST['user2'];
     $cond = "u." . $where1 . " " . $oper . " " . $suser;
    if ($where1=='Company')
	$cond="c2.name  " . $oper . " " . $suser;
  // if ($where1=='Company')

}
else
$cond="u.userid like '%'";
}
else {
     $user_match = '';
}

//echo "$oper";

$sort1='';
$sort2='';
if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}
if (isset($_REQUEST['submit'])) {
       $submit=$_REQUEST['submit'];
       if ($submit=='New User')
	 header ("Location: new_user.php");
}
/*else{
 header ( "Location: users.php?submit='Get'");
}*/
include_once('classes/userClass.php'); 
include_once('classes/loginClass.php'); 
include_once('classes/displayClass.php'); 
$newUser = new user; 
$newdisplay = new display;
$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
 
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
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/user.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
	<title>User</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='users.php?suser=&$user_match&user_oper=$oper&user2=$where1&sortfld1=$sort1' method='post' enctype='multipart/form-data'>
<?php
	include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr> 
        					<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right"><a href="chPassword.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/chpwd_mo.gif',1)"><img name="Image15" border="0" src="images/chpwd.gif"></a>
       					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
						<?php $newdisplay->displinks(''); ?>
						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF"> -->
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
  										 <tr><td><span class="heading"><i>Please click on the Userid link to Edit or Delete</i></td></tr>
										 <tr><td>
										 <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
											<tr>
												<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
												<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
												<td bgcolor="#FFFFFF" rowspan=2 align="center"><input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">
												</td>
											  </tr>
					    						   <tr>
												<td bgcolor="#FFFFFF"><span class="tabletext"><select name="use1" size="1" width="100">
													<?php if($select=='userid'){?>
        														<option selected>userid
             														<option value>type
														<option value>Company 
													<?php }if($select=='type') {?>
             															<option selected>type
             															<option value>userid 
															<option value>Company 
														<?php } if($select=='Company') {?>
														<option selected>Company 
														<option value>userid 
														<option value>type<?php }?>
            													</select>
        												</td>
												<td bgcolor="#FFFFFF"><span class="tabletext"><select name="use_oper" size="1" width="100">
          													<?php if($oper=='like'){?>
            													<option selected>like
													<option value>=<?php }else {?>
             													<option selected>=
													<option value>like<?php }?>
         													</select>
												</td>
												<td bgcolor="#FFFFFF"><input type="text" name="suser" size=20 value="<?php echo "$user_match";?>" onkeypress="javascript: return checkenter(event)"></td>
												<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
												<td bgcolor="#FFFFFF"  colspan="3"><span class="tabletext"><select name="sort1" size="1" width="100">
            							 						<option selected>userid
               							 						</select>
      													<input type="hidden" name="user_oper">
        													<input type="hidden" name="user2">
       													<input type="hidden" name="sortfld1">
												</td>		

  											   </tr>
										</table>
										</td></tr>
										<tr><td>
										       <table width=100% border=0>
											<div class="contenttitle radiusbottom0">
                      <h2 class="table"><span>LList of Users
                      <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='new_user.php'" value="New User" >
												<!-- <a href ="new_user.php"><img name="Image8" border="0" src="images/bu-newuser.gif"></a> -->
                        </h2></span>
												 </table>
										</td></tr>
										<tr>
											<td>
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
												        <tr>
                                <thead>
         												        	<th class="head0"><span class="heading"><b>Userid</b></th>
       													<th class="head0"><span class="heading"><b>Type</b></th>
       													<th class="head1"><span class="heading"><b>Initials</b></th>
													<th class="head0"><span class="heading"><b>Company</b></th>
       													<th class="head1"><span class="heading"><b>Phone</b></th>
         													<th class="head0"><span class="heading"><b>Email</b></th>
         													<th class="head1"><span class="heading"><b>Title</b></th>
        													<th class="head0"><span class="heading"><b>Role</b></th>
        													<th class="head1"><span class="heading"><b>Status</b></th>                
        											        	       </tr>
													<?php
														$newlogin = new userlogin;
														$newlogin->dbconnect();
														$newUser = new user;
														$result1 = $newUser->getEmpUsers($cond,$sort1,$sort2,$offset, $rowsPerPage);
														$result2 = $newUser->getContactUsers($cond,$sort1,$sort2,$offset, $rowsPerPage);
														//$result3=$result1+$result2 ;
	       												 	while ($myrow = mysql_fetch_row($result1)) {
	      													printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="edit_user.php?userid=%s&type=%s"><b>%s</b></td>
                          													<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          													<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
														<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          													<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          													<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          													<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                         											 		<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                         											 		<td bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>',
													        	  $myrow[0],$myrow[1],$myrow[0],
                       											   		$myrow[1],
                          													$myrow[7],$myrow[8],
                          													$myrow[2],
                        										 			$myrow[5],
                       									  				$myrow[3],
                         										 			$myrow[4],
                          													$myrow[6]);
             														printf('</td></tr>');
        														}
        														while ($myrow = mysql_fetch_row($result2)) {
	     											 		printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="edit_user.php?userid=%s&type=%s"><b>%s</b></td>
                          													<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          													<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
														<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          													<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          													<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          													<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          													<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          													<td bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>',
		          												$myrow[0],$myrow[1],$myrow[0],
                          													$myrow[1],
                          													$myrow[7],$myrow[8],
                          													$myrow[2],
                          													$myrow[5],
                          													$myrow[3],
                          													$myrow[4],
                        											  		$myrow[6]);
              														printf('</td></tr>');
      											  			}
   														/* Free resultset */
   														mysql_free_result($result1);
   														mysql_free_result($result2);
   														/* Closing connection */
 											 			$newlogin->dbdisconnect();

													?>
											               </table>
 											</td>
										</tr>
									</table>
								</td>
							<!-- 	<td width="6"><img src="images/spacer.gif " width="6"></td>
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

//Additions on Dec 29 04 by Jerry George to implement pagination

$newlogin = new userlogin;
$newlogin->dbconnect();
$numrows1 = $newUser->getEmpusersCount($cond,$offset, $rowsPerPage);
$numrows2 = $newUser->getContactusersCount($cond,$offset, $rowsPerPage);
$numrows3=$numrows1+ $numrows2;
//echo "</br>$numrows3";
// how many pages we have when using paging? 

$maxPage = ceil($numrows3/$rowsPerPage); 
if($numrows2 <>0 || $numrows2 <>0)
$maxPage=ceil($maxPage/2);
//echo "    $maxPage";
//echo "rows pre page $rowsPerPage";

//echo "max page = $maxPage";
//echo "page =$_REQUEST['page']";

if (!isset($_REQUEST['page'])) 
{ 
    $totpages = $maxPage; 
} 

//echo "total pages =$totpages";
$self = $_SERVER['PHP_SELF']; 

// creating 'previous' and 'next' link 
// plus 'first page' and 'last page' link 

// print 'previous' link only if we're not 
// on page one 
if ($pageNum > 1) 
{ 
// echo "page num >1 =$pageNum";
 
    $page = $pageNum - 1; 
    $prev = " <a href=\"users.php?page=$page&totpages=$totpages&suser=$user_match&user2=$where1&user_oper=$oper\">[Prev]</a> ";
    $first = " <a href=\"users.php?page=1&totpages=$totpages&suser=$user_match&user2=$where1&user_oper=$oper\">[First Page]</a> ";
} 
else 
{ 
// echo "page num <=1 =$pageNum";

    $prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link 
    $first = ' [First Page] '; // nor 'first page' link 
} 

// print 'next' link only if we're not 
// on the last page 
if ($pageNum < $totpages) 
{ 
    $page = $pageNum + 1; 
     $next = " <a href=\"users.php?page=$page&totpages=$totpages&suser=$user_match&user2=$where1&user_oper=$oper\">[Next]</a> "; 
     
    $last = " <a href=\"users.php?page=$totpages&totpages=$totpages&suser=$user_match&user2=$where1&user_oper=$oper\">[Last Page]</a> "; 
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
// End additions on Dec 29,04

?> 
								</td>
							</tr>
						</table>
					</FORM>
		</body>
</html>
