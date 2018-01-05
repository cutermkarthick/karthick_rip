<?php


session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
    header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'editemp';
$page="Resourcerequirement";

include('classes/empconfigClass.php'); 
include('classes/ResourceRequirementClass.php');
include_once('classes/CompanyClass.php');
$companyCls = new Company;
$customerList=$companyCls->getAllCustomers();
$newEmpconfig = new empconfig; 
$newRr = new ResourceRequirement;

$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];
$cmpid=$_REQUEST['cmpid'];
$submit = $_REQUEST['submit'];
if($submit == 'Submit')
{
	$import_text=$_POST['import_text'];
	
	$importarr = split('\*',$import_text);
	$numrows = count($importarr)-1;

	//echo "numrows $numrows <br>";
	

	foreach ($importarr as $key => $eachrow) {
		if ($key > 0) {

			$value = split('\,',$eachrow);	
			if ($value[1] != "") {
				$uploadtype = 'Import';
				$newRr->setcustomercompanyid($cmpid);
				$newRr->setshift($value[1]);
		    $newRr->setshiftdate($value[0]);
		    $newRr->setreqcount($value[2]);

				$newRr->Insertrequirements();

			}
			
		}
	}

	header("Location:Resourcerequirement.php");

}



?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>


<html>
	<head>
		<title>Resource import</title>
	</head>

	<body leftmargin="0"topmargin="0" marginwidth="0">
		<form  method='post' enctype='multipart/form-data'>
		<?php
			include('header.html');
		?>
		<div style="margin-bottom: 10px; ">
			<label for="sel" style="font-size: 16px; color: black;"><b>Select Customer</b></label>
			<select id="sel" name="cmpid" style="width: 500px; height: 25px;" >
				<?php
				while($row=mysql_fetch_assoc($customerList))
				{
					echo "<option value='".$row['id']."'>".$row['name']."</option>";
				}
				?>
			</select>
		</div>
		<table style="table-layout: fixed"  width=70%  align='center' border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
			<tr>
				<td bgcolor="#B0C4DE" align='center'><span class="pageheading">
				<b>Import Planning (Copy Paste data from exported csv file with * as delimiter for each record
				<br>Column titles are - Shift Date(YYYY-MM-DD),Shift,ReqCount
				<br>Data Columns are Shift Date(YYYY-MM-DD),Shift,ReqCount
				</b>
				<a href ="ResourceSchdule.php" ><img name="Image8" border="0" src="images/arrow_left.png" height='25' title="Back To Delivery Schedule Summary" align='right'></a></td> 
			</tr>

			<tr>
				<td bgcolor="#FFFFFF" align='center'><textarea name="import_text" rows=30 cols=100 value="<?echo $import_text?>"><?echo $import_text?></textarea>
				<br/>
				<span class="labeltext">
					<input type="submit" style="color=#0066CC;background-color:#DDDDDD;width=80;" value="Submit" name="submit">

		      <input type="RESET" style="color=#0066CC;background-color:#DDDDDD;width=80;" VALUE="Reset" onClick="javascript: putfocus()">
				</span>
				</td>
			</tr>
		</table>

		</form>
	</body>
</html>
