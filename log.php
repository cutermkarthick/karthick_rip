<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: log.php                           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays user log                           =
//==============================================
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'log'; 
$page = "Log";
//////session_register('pagename');

//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George

$cond = "like '%'";
//$select ='like';
$worec='';

if ( isset ( $_REQUEST['slog'] ) )
{
     $log_match = $_REQUEST['slog'];
     if ( isset ( $_REQUEST['log_oper'] ) ) {
          $oper = $_REQUEST['log_oper'];
     }
     else {
         $oper = 'like';
     }
     if ($oper == 'like') {
         $slog = "'" . $_REQUEST['slog'] . "%" . "'";
     }
     else {
         $slog = "'" . $_REQUEST['slog'] . "'";
     }
     $select=$_REQUEST['logs_oper'];
     $cond = $oper . " " . $slog;

}
else {
     $log_match = '';
$oper='like';
}
//echo "$oper";

$sort1='userid';
if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
if ($sort1=='time')
$sort1='logtime';
}
/*if (isset($_REQUEST['submit'])) {
       //$submit=$_REQUEST['submit'];
}
else{
// $_REQUEST['submit']='Get';
 header ( "Location: log.php?submit='Get'");
}*/

// how many rows to show per page 
$rowsPerPage = -1; 

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


// Includes 
include_once('classes/loginClass.php'); 
include_once('classes/userClass.php'); 
include_once('classes/displayClass.php'); 
$newlogin = new userlogin; 
$newuser = new user;
$newdisplay = new display;
$newlogin->dbconnect();


?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/log.js"></script>

<html>
<head>
<title>Log</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='log.php ' method='post' enctype='multipart/form-data'>
<?php
	include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
	<td>
		<table width=100% border=0 cellspacing="0" cellpadding="0">
			<tr> 
			        <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        			        <td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image10','','images/logout_mo.gif',1)"><img name="Image10" border="0" src="images/logout.gif"></a></td>
			</tr>
		</table>
		<table width=100% border=0 cellpadding=0 cellspacing=0>
			<tr><td></td></tr>
			<tr>
				<td>
					<?php $newdisplay->dispLinks(''); ?>
					<table width=100% border=0 cellpadding=0 cellspacing=0  >
						<tr bgcolor="DEDFDE">
  							<td width="6"><img src="images/spacer.gif " width="6"></td>
							<td bgcolor="#FFFFFF">
								<table width=100% border=0 cellpadding=6 cellspacing=0  >
								   <tr><td> -->
								   <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
							                   	<tr>
										<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
										<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
										<td bgcolor="#FFFFFF" rowspan=2 align="center"><span class="tabletext">
											<input type= "image" name="Get" src="images/bu-get.gif" value="Get"  onclick="javascript: return searchsort_fields()">
										</td>
									   </tr>
							  		    <tr>
   						 				<td bgcolor="#FFFFFF"><span class="labeltext"><b>User ID</b></td>	
										<td bgcolor="#FFFFFF"><span class="tabletext"><select name="log_oper" size="1" width="100">
											<?php if($oper=='like'){?>
            											<option selected>like
											<option value>=<?php }else {?>
             											<option selected>=
											<option value>like<?php }?>

          										</select>
									     	 </td>
										 <td bgcolor="#FFFFFF"><input type="text" name="slog" size=20 value="<?php echo "$log_match";?>" onkeypress="javascript: return checkenter(event)"></td>
										<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
										<td bgcolor="#FFFFFF"  colspan=3><span class="tabletext"><select name="sort1" size="1" width="100">
											<?php if($sort1=='userid'){?>
											<option selected>userid
											<option value>time<?php }else{?>
											<option selected>time
											<option value>userid<?php }?>
				             							  </select>
     											<input type="hidden" name="logs_oper">
      											  <input type="hidden" name="sortfld1">
										</td>
										
  										
									</tr>
								</table>
								<table width=100% border=0>
<tr>
<td rowspan="3">
								<div class="contenttitle radiusbottom0">
<h2 class="table"><span>Activity Log of Users</h2></span>
</table>
								<tr>
									<td>
										<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
        											<tr>
            												<td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Userid</b></td>
            												<td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Session</b></td>
          												 <td bgcolor="#EEEFEE" width=30%><span class="heading"><b>Date/Time</b></td>
            												<td bgcolor="#EEEFEE" width=12%><span class="heading"><b>Activity</b></td>
       
        											</tr>
										</table>
									</td>
								</tr>
											<tr>
												<td>
  												    <div style="overflow: scroll; width: 100%; height: 250px;"> 
													<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
														<?php
														$result = $newuser ->getLog($cond,$sort1,$offset, $rowsPerPage);
														//$result = $newuser->getLog();
        														while ($myrow = mysql_fetch_row($result)) {
	     													 printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                       									   				<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          													<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                        										  			<td bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>',
		        								  				$myrow[0],
                          													$myrow[1],
                         										 			$myrow[2],
                        								  					$myrow[3]);
             										 				printf('</td></tr>');}
														?>
											               		</table>
												</div>
 											</td>
										</tr>
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

								</td>
							</tr>
						</table>
					</FORM>
		</body>
</html>