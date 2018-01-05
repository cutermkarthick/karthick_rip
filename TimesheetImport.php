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
include('classes/attendanceClass.php');

$newEmpconfig = new empconfig; 
$newAttendance = new Attendance;

$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];

$submit = $_REQUEST['submit'];
if($submit == 'Submit')
{
	$import_text=$_POST['import_text'];
	
	$importarr = split('\*',$import_text);



	foreach ($importarr as $key => $eachrow) {

		if ($key > 0) {

			$value = split('\,',$eachrow);	
			if ($value[1] != "") {
				$uploadtype = 'Import';

   			$newAttendance->setempid($value[2]);
   			$newAttendance->setsiteid($value[3]);
   			$newAttendance->setsubsidaryid($value[4]);
   			$newAttendance->setuploadtype($uploadtype);
   			$newAttendance->setlink2upload($link2upload);

   			if (!empty($value[0])) {
   				$stage = 1;
   				$newAttendance->setstage($stage);
   				$newAttendance->settime($value[0]);
   				$newAttendance->UploadAttendance();
   			}

   			if (!empty($value[1])) {
   				$stage = 0;
   				$newAttendance->setstage($stage);
   				$newAttendance->settime($value[1]);
   				$newAttendance->UploadAttendance();
   			}
			}
			
		}else if($key == 0) {
			$uploadname = "Import_".date("Y-m-d H:i:s");
	 		$uploadsize = '';
	 		

     	$newAttendance->setuploadname($uploadname);
     	$newAttendance->setuploadsize($uploadsize);
     	$newAttendance->setlink2user($userrecnum);
     	$newAttendance->setuserid($userid);
     	$link2upload = $newAttendance->InsertUploadDetails();
		}
	}

	header("Location:Timesheet.php");

}



?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>


<html>
	<head>
		<title>Resource Summary</title>
	</head>

	<body leftmargin="0" topmargin="0" marginwidth="0">
		<form action='TimesheetImport.php' method='post' enctype='multipart/form-data'>
		<?php
			include('header.html');
		?>

		<table style="table-layout: fixed"  width=70%  align='center' border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
			<tr>
				<td bgcolor="#B0C4DE" align='center'><span class="pageheading">
				<b>Import Planning (Copy Paste data from exported csv file with * as delimiter for each record
				<br>Column titles are - From(YYYY-MM-DD), To(YYYY-MM-DD), Emp ID, Company ID, Subsidary ID
				<br>Data Columns are From(YYYY-MM-DD), To(YYYY-MM-DD), Emp ID, Company ID, Subsidary ID
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
