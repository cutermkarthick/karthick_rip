<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 2, 2005                 =
// Filename: wotypeDetails.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//==============================================
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
  header ( "Location: login.php" );
}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'contractdetails'; 
$page = "Contract";


include('classes/contractClass.php');
include('classes/userClass.php'); 
$newContract = new contract;
$newlogin = new userlogin;
$newlogin->dbconnect();

$recnum = $_REQUEST['recnum'];
$result = $newContract->getContractDetails($recnum);
$myrow = mysql_fetch_assoc($result);

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/wotype.js"></script>
<html>
<head>
<title>Contract Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
    include('header.html');
?>


<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr>
<td><span class="pageheading"><b>Contract Details</b></td>
<td colspan=10>&nbsp;</td>
<?php 

echo "<td align=\"right\">  
<a href =\"EditContract.php?recnum=$recnum\"><img name=\"Image8\" border=\"0\" src=\"images/bu-edit.gif\"></a>";
?>
           
</tr>

</table>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">
	<tr bgcolor="#FFFFFF" width=100%>
		<td><span class="labeltext"><p align="left">ID</p></td>
		<td><span class="tabletext"><p align="left"><?php echo $myrow['id']; ?></p></td>
		<td><span class="labeltext"><p align="left">Company Name</p></td>
		<td><span class="tabletext"><p align="left"><?php echo $myrow['name']; ?></p></td>
	</tr>

	<tr bgcolor="#FFFFFF" width=100%>
		<td><span class="labeltext"><p align="left">Start Date</p></td>
		<td><span class="tabletext"><p align="left"><?php echo $myrow['start_date']; ?></p></td>
		<td><span class="labeltext"><p align="left">End Date</p></td>
		<td><span class="tabletext"><p align="left"><?php echo $myrow['end_date']; ?></p></td>
	</tr>

	<tr bgcolor="#FFFFFF" width=100%>
		<td><span class="labeltext"><p align="left">Approved By</p></td>
		<td><span class="tabletext"><p align="left"><?php echo $myrow['approved_by']; ?></p></td>
		<td><span class="labeltext"><p align="left">Approved Date</p></td>
		<td><span class="tabletext"><p align="left"><?php echo $myrow['approved_date']; ?></p></td>
	</tr>

	<tr bgcolor="#FFFFFF" width=100%>
		<td><span class="labeltext"><p align="left">Status</p></td>
		<td><span class="tabletext"><p align="left"><?php echo $myrow['status']; ?></p></td>
		<td></td>
		<td></td>
	</tr>

</table>



</td></tr>

</table>
</td>

</table>
		</body>
</html>
