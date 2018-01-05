<?php


session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
    header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'editemp';
$page="EmployeeConfig";

include('classes/empconfigClass.php'); 
$newEmpconfig = new empconfig; 

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>


<html>
<head>
<title>Employee</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='employees.php?semp=&$emp_match&emp_oper=$oper&semprl=$where1&sortfld1=$sort1' method='post' enctype='multipart/form-data'>
<?php
	include('header.html');
?>

		<table width=100% border=0 cellpadding=6 cellspacing=0  >
			<tr><td><span class="heading"><i>Please click on the Id link to Edit or Delete</i></td></tr>
			<tr><td>
							
								</td></tr>
								<tr><td>
								       <table width=100% border=0>
									<div class="contenttitle radiusbottom0">
<h2 class="table"><span>List of Shift

<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='new_employee_config.php'" value="New Shift" >
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
 												 <th class="head0"><span class="heading"><b>Seq #</b></th>
                          <th class="head1"><span class="heading"><b>Company</b></th>
											    <th class="head0"><span class="heading"><b>Shift</b></th>
												  <th class="head1"><span class="heading"><b>Start Time</b></th>
  												<th class="head0"><span class="heading"><b>End Time</b></th>                
										</tr>
						<?php
		$newlogin = new userlogin;
		$newlogin->dbconnect();
		$result = $newEmpconfig->getEmpConfig4sa();
					while ($myrow = mysql_fetch_row($result)) {

              if ($myrow[2] < 10) {
                $start_hour = "0".$myrow[2];
              }
              else{
                $start_hour = $myrow[2];
              }
              if ($myrow[3] < 10) {
                $start_min = "0".$myrow[3];
              }else{
                $start_min = $myrow[3];
              }
              if ($myrow[4] < 10) {
                $end_hour = "0".$myrow[4];
              }else{
                $end_hour = $myrow[4];
              }
              if ($myrow[5] < 10) {
                $end_min = "0".$myrow[5];
              }else{
                $end_min = $myrow[5];
              }

              $start_time = $start_hour.":".$start_min;
              $end_time = $end_hour.":".$end_min;

					  printf('<tr>
                    <td bgcolor="#FFFFFF"><span class="tabletext"><a href="edit_employee_config.php?recnum=%s"><b>%s</b></td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
									 		<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
											<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
											<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    </tr>',
         		            $myrow[0],$myrow[0],
                        $myrow[6],
     										$myrow[1],
     										$start_time,
    										$end_time);
						  printf('</td></tr>');
			  		}
 												?>
											               </table>
 											</td>
										</tr>
									</table>
								</td>

<?php



// $numrows = $newEmp->getEmpcount($cond,$offset, $rowsPerPage);


// $maxPage = ceil($numrows/$rowsPerPage); 

// if (!isset($_REQUEST['page'])) 
// { 
//     $totpages = $maxPage; 
// } 

// $self = $_SERVER['PHP_SELF']; 


// if ($pageNum > 1) 
// { 
//     $page = $pageNum - 1; 
//     $prev = " <a href=\"employees.php?page=$page&totpages=$totpages&semp=$emp_match&semprl=$where1&emp_oper=$oper\">[Prev]</a> "; 
     
//     $first = " <a href=\"employees.php?page=1&totpages=$totpages&semp=$emp_match&semprl=$where1&emp_oper=$oper\">[First Page]</a> "; 
// } 
// else 
// { 
//     $prev  = ' [Prev] ';      
//     $first = ' [First Page] '; 
// } 

 
// if ($pageNum < $totpages) 
// { 
//     $page = $pageNum + 1; 
//     $next = " <a href=\"employees.php?page=$page&totpages=$totpages&semp=$emp_match&semprl=$where1&emp_oper=$oper\">[Next]</a> "; 
     
//     $last = " <a href=\"employees.php?page=$totpages&totpages=$totpages&semp=$emp_match&semprl=$where1&emp_oper=$oper\">[Last Page]</a> "; 
// } 
// else 
// { 
//     $next = ' [Next] ';      
//     $last = ' [Last Page] '; 
// } 

// if($totpages!=0)
// {

// echo "<span class=\"labeltext\">" . $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last; 
// }
// else
// echo "<span class=\"labeltext\"><align=\"center\">There is no matching records find";


?> 

								</td>
							</tr>
						</table>
					</FORM>
		</body>
</html>
