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

include('classes/menuClass.php'); 
$newmenu = new menu;

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>


<html>
<head>
<title>Menu Summary</title>
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
					<h2 class="table"><span>List of Dept Wise Menus

					<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='CreateMenu.php'" value="New" >

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
              <th class="head1"><span class="heading"><b>Dept</b></span></th>
					    <th class="head0"><span class="heading"><b>Userrole</b></span></th>
						  <th class="head1"><span class="heading"><b>Status</b></span></th>
						  <th class="head0"><span class="heading"><b>Created Date</b></span></th>
						  <th class="head0"><span class="heading"><b>Main Menus</b></span></th>
						</thead>               
						</tr>

						<?php
							$result = $newmenu->GetAllMenus();
							while ($myrow = mysql_fetch_assoc(($result)) )
							{
								$menuarr = array();
								$menus = json_decode($myrow['menus']);
								foreach ($menus as $key => $mainmenu) 
								{
									$menuarr[] = $mainmenu->text;
								}
								$allmainmenus = implode(', ', $menuarr);
								echo "<tr>";
								echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\"><a href=\"EditMenu.php?recnum=".$myrow['recnum']."\"><b>".$myrow['recnum']."</b></a></span></td>";
								echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$myrow['dept']."</span></td>";
								echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$myrow['userrole']."</span></td>";
								echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$myrow['status']."</span></td>";
								echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".$myrow['created_date']."</span></td>";
								echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">".wordwrap($allmainmenus,50,'<br>')."</span></td>";
					  		echo "</tr>";
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
