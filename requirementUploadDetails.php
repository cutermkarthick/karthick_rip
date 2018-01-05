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
include('classes/ResourceRequirementClass.php');

$newdisp = new display;
$newlogin = new userlogin;
$newlogin->dbconnect();
$newRr = new ResourceRequirement;

$cmpid=$_REQUEST['cmpid'];
$date=$_REQUEST['date'];
$result = $newRr->getResourceUploadDetails($cmpid,$date);



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

	

	<tr bgcolor="#FFFFFF">
	<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
		
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
    
    while ($myrowli = mysql_fetch_assoc($result)) 
   	{	
   		
   		?>
   		<tr bgcolor="#FFFFFF">
   			<td align="center"><span class="tabletext"><?php echo $i; ?></span></td>
   			<td align="center"><span class="tabletext"><?php echo $myrowli['custmoercompanyid']; ?></span></td>
   			<td align="center"><span class="tabletext"><?php echo $myrowli['date']; ?></span></td>
   			<td align="center"><span class="tabletext"><?php echo $myrowli['shift']; ?></span></td>
   			<td align="center"><span class="tabletext"><?php echo $myrowli['requirement']; ?></span></td>
   			<td align="center"><span class="tabletext"><?php echo $myrowli['upload_date']; ?></span></td>

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
