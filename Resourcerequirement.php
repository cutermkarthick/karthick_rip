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
include('classes/ResourceRequirementClass.php');

$newEmpconfig = new empconfig; 
$newRr = new ResourceRequirement;

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
					<h2 class="table"><span>List of Resource Requirement TimeSheet

					<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='ResourceSchduleUpload.php'" value="New Upload" >
					<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='ResourcerequirementImport.php'" value="New Import" >

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
              <th class="head1"><span class="heading"><b>CustomerID</b></span></th>
					    <th class="head0"><span class="heading"><b>Upload Date</b></span></th>
						  <th class="head1"><span class="heading"><b>Upload Lines</b></span></th>
						</thead>               
						</tr>

						<?php
							
							$result = $newRr->getResourceSummary();
							while ($myrow = mysql_fetch_assoc(($result)) )
							{
					  		printf('
					  			<tr>
                  	<td bgcolor="#FFFFFF"><span class="tabletext"><a href="requirementUploadDetails.php?cmpid=%s&date=%s"><b>%s</b></td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
								 		<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
										<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                  </tr>',

   		            $myrow['customercompanyid'],$myrow['upload_date'],$myrow['customercompanyid'],
                  	$myrow['customercompanyid'],
									$myrow['upload_date'],
									$myrow['line']);
						  	printf('</td></tr>');
			  			}
					?>
           	</table>
					</td>
			</tr>
		</table>
	</td>


								</td>
							</tr>
						</table>
					</FORM>
		</body>
</html>
