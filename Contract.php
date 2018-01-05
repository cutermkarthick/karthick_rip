<?php


session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
    header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'contract';
$page="Contract";

include('classes/contractClass.php');
$newContract = new contract;

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>


<html>
<head>
<title>TimeSheet Summary</title>
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
<h2 class="table"><span>List of Contract

<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='NewContract.php'" value="New Contract" >

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
              <th class="head1"><span class="heading"><b>Id</b></span></th>
					    <th class="head0"><span class="heading"><b>Company Name</b></span></th>
						  <th class="head1"><span class="heading"><b>Start Date</b></span></th>
							<th class="head0"><span class="heading"><b>End Date</b></span></th> 
							<th class="head0"><span class="heading"><b>Status</b></span></th> 
						</thead>               
						</tr>

						<?php
							$newlogin = new userlogin;
							$newlogin->dbconnect();
							$result = $newContract->getContracts();
							while ($myrow = mysql_fetch_row($result))
							{
					  		printf('
					  			<tr>
                  	<td bgcolor="#FFFFFF"><span class="tabletext"><a href="ContractDetails.php?recnum=%s"><b>%s</b></td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
								 		<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
										<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
										<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
										<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                  </tr>',

   		            $myrow[0],$myrow[0],
                  $myrow[2],
									$myrow[1],
									$myrow[4],
									$myrow[5],
									$myrow[3]);
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
				</form>
		</body>
</html>
