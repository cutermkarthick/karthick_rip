<?php


session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
    header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'editemp';
$page="ResourceSchdule";

include('classes/empconfigClass.php'); 
include('classes/ResourcePlanningClass.php');

$newEmpconfig = new empconfig; 
$newRP = new ResourcePlanning;

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>


<html>
<head>
<title>Resource Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='employees.php?semp=&$emp_match&emp_oper=$oper&semprl=$where1&sortfld1=$sort1' method='post' enctype='multipart/form-data'>
<?php
	include('header.html');
?>

		<table width=100% border=0 cellpadding=6 cellspacing=0  >
			<tr><td><span class="heading"><i>Please click on the Seq link to Edit or Delete</i></td></tr>
			<tr><td>
							
			</td></tr>
			<tr><td>

   		<table width=100% border=0>
				<div class="contenttitle radiusbottom0">
					<h2 class="table"><span>List of Resource TimeSheet

					<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='ResourceSchduleUpload.php'" value="New Upload" >
					<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='ResourceSchduleImport.php'" value="New Import" >

					</h2></span>
				</tr>
			</table>

			</td></tr>
			<tr>
				<td>
					<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
						<tr>
            <thead>
							<th class="head0"><span class="heading"><b>Seq #</b></span></th>
              <th class="head1"><span class="heading"><b>File Name</b></span></th>
					    <th class="head0"><span class="heading"><b>Upload Date</b></span></th>
						  <th class="head1"><span class="heading"><b>Upload Size</b></span></th>
							<th class="head0"><span class="heading"><b>Upload By</b></span></th> 
						</thead>               
						</tr>

						<?php
							$newlogin = new userlogin;
							$newlogin->dbconnect();
							$result = $newRP->getResourceUpload();
							while ($myrow = mysql_fetch_row($result))
							{
					  		printf('
					  			<tr>
                  	<td bgcolor="#FFFFFF"><span class="tabletext"><a href="ResourceUploadDetails.php?recnum=%s"><b>%s</b></td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
								 		<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
										<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
										<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                  </tr>',

   		            $myrow[0],$myrow[0],
                  $myrow[1],
									$myrow[3],
									$myrow[2],
									$myrow[4]);
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
