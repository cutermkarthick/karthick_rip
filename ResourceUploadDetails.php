<?php



session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
  header ( "Location: login.php" );  
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'edit_wotype'; 
$page = "ResourceSchdule";

include('classes/userClass.php'); 
include_once('classes/loginClass.php');
include('classes/displayClass.php'); 
include('classes/ResourcePlanningClass.php');

$newdisp = new display;
$newlogin = new userlogin;
$newlogin->dbconnect();
$newRP = new ResourcePlanning;

$recnum=$_REQUEST['recnum'];
$result = $newRP->getResourceUploadDetails($recnum);
$myrow = mysql_fetch_row($result);


?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/wotype.js"></script>
<html>
<head>
<title>Template Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
  include('header.html');
?>

<table width=100% border=0 cellpadding=6 cellspacing=0  >
	<tr>
		<td><span class="pageheading"><b>Details</b></td>
		<td colspan=10>&nbsp;</td>
	</tr>

</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable">

	<tr bgcolor="#FFFFFF" width=100%>
		<td><span class="labeltext"><p align="left">File Name</p></td>
		<td><span class="tabletext"><p align="left"><?php echo $myrow[1] ?></p></td>
		<td><span class="labeltext"><p align="left">Upload Date</p></td>
		<td><span class="tabletext"><p align="left"><?php echo $myrow[3] ?></p></td>
	</tr>

	<tr bgcolor="#FFFFFF" width=100%>
		<td><span class="labeltext"><p align="left">Upload By</p></td>
		<td><span class="tabletext"><p align="left"><?php echo $myrow[4] ?></p></td>
		<td><span class="labeltext"><p align="left">Upload Size</p></td>
		<td><span class="tabletext"><p align="left"><?php echo $myrow[2] ?></p></td>
	</tr>

	<tr bgcolor="#FFFFFF">
	<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
		<tr bgcolor="#FFFFFF" width=100%>
			<td colspan="8"><center><span class="labeltext">Line Items</center></span></td>
		</tr>
	<tr>
		<td class="head0"><span class="heading"><b><center>Seq #</center></b></td>
		<td class="head1"><span class="heading"><b><center>Emp ID</center></b></td>
		<td class="head0"><span class="heading"><b><center>Company</center></b></td>
		<td class="head1"><span class="heading"><b><center>Subsidary</center></b></td>
		<td class="head0"><span class="heading"><b><center>Shift Date</center></b></td>
		<td class="head1"><span class="heading"><b><center>Shift</center></b></td>
	</tr>

	<?php
    $i=1;
    $result1 = $newRP->getResourceUploadLIDetails($recnum);
    while ($myrowli = mysql_fetch_assoc($result1)) 
   	{	
   		
   		?>
   		<tr bgcolor="#FFFFFF">
   			<td align="center"><span class="tabletext"><?php echo $i; ?></span></td>
   			<td align="center"><span class="tabletext"><?php echo $myrowli['empid']; ?></span></td>
   			<td align="center"><span class="tabletext"><?php echo $myrowli['parent_company']; ?></span></td>
   			<td align="center"><span class="tabletext"><?php echo $myrowli['subsidary']; ?></span></td>
   			<td align="center"><span class="tabletext"><?php echo $myrowli['shiftdate']; ?></span></td>
   			<td align="center"><span class="tabletext"><?php echo $myrowli['shift']; ?></span></td>

   		</tr>
   	<?php
   		$i++;
    }    

	?>

</table>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3> 


</td></tr>

</table>
</td>

</table>
		</body>
</html>
