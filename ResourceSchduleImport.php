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

$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];

$submit = $_REQUEST['submit'];
if($submit == 'Submit')
{
	$import_text=$_POST['import_text'];
	
	$importarr = split('\*',$import_text);
	$numrows = count($importarr)-1;

	echo "numrows $numrows <br>";
	

	foreach ($importarr as $key => $eachrow) {
		if ($key > 0) {

			$value = split('\,',$eachrow);	
			if ($value[1] != "") {
				$uploadtype = 'Import';
				$newRP->setempid($value[3]);
				$newRP->setsiteid($value[1]);
		    $newRP->setsubsidaryid($value[2]);
		    $newRP->setshift($value[4]);
				$newRP->setshiftdate($value[5]);
				$newRP->setuploadtype($uploadtype);
				$newRP->setlink2upload($link2upload);

				$newRP->UploadReourceSchdule();
			}
			
		}else if($key == 0) {
			$uploadname = "Import_".date("Y-m-d H:i:s");
	 		$uploadsize = '';
	 		

     	$newRP->setuploadname($uploadname);
     	$newRP->setuploadsize($uploadsize);
     	$newRP->setlink2user($userrecnum);
     	$newRP->setuserid($userid);
     	$link2upload = $newRP->InsertUploadDetails();
		}
	}

	header("Location:ResourceSchdule.php");

}



?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>


<html>
	<head>
		<title>Resource Summary</title>
	</head>

	<body leftmargin="0"topmargin="0" marginwidth="0">
		<form action='ResourceSchduleImport.php' method='post' enctype='multipart/form-data'>
		<?php
			include('header.html');
		?>

		<table style="table-layout: fixed"  width=70%  align='center' border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
			<tr>
				<td bgcolor="#B0C4DE" align='center'><span class="pageheading">
				<b>Import Planning (Copy Paste data from exported csv file with * as delimiter for each record
				<br>Column titles are - SI No, Company ID, Subsidary ID, Emp ID, Shift, Shift Date(YYYY-MM-DD)
				<br>Data Columns are SI No, Company ID, Subsidary ID, Emp ID, Shift, Shift Date(YYYY-MM-DD)
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
