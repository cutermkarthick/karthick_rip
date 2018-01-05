<?php


session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
    header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'newempConfig';
$page="TimeSheet";

$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];

include('classes/empClass.php');
include('classes/attendanceClass.php');
$newEmp = new emp;
$newAttendance = new Attendance;

if ($_POST) {
	 if(isset($_POST["Import"])){
			
	 
		$filename=$_FILES["fileupload"]["tmp_name"];		
		
		 if($_FILES["fileupload"]["size"] > 0)
		 {	
		 		
		 		$uploadname = $_FILES["fileupload"]["name"];
		 		$uploadsize = $_FILES["fileupload"]["size"];
		 		

       	$newAttendance->setuploadname($uploadname);
       	$newAttendance->setuploadsize($uploadsize);
       	$newAttendance->setlink2user($userrecnum);
       	$newAttendance->setuserid($userid);
       	$link2upload = $newAttendance->InsertUploadDetails();
       	// $link2upload = 2;
		 		$row = 1;
		  	$file = fopen($filename, "r");
		  	fgetcsv($handle);
		  	$data = array();
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
       	{
       		if ($row > 1) {
       			// echo "<pre>";
       			// print_r($getData); exit;

       			$uploadtype = 'Upload';
       			$newAttendance->setempid($getData[2]);
       			$newAttendance->setsiteid($getData[3]);
       			$newAttendance->setsubsidaryid($getData[4]);
       			$newAttendance->setuploadtype($uploadtype);
       			$newAttendance->setlink2upload($link2upload);

       			if (!empty($getData[0])) {
       				$stage = 1;
       				$newAttendance->setstage($stage);
       				$newAttendance->settime($getData[0]);
       				$newAttendance->UploadAttendance();
       			}

       			if (!empty($getData[1])) {
       				$stage = 0;
       				$newAttendance->setstage($stage);
       				$newAttendance->settime($getData[1]);
       				$newAttendance->UploadAttendance();
       			}
       			
       			
       		}
       		$row++;
       	}
				
				
       	
       	

       	fclose($file);	
		 }
	}	 
}


?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/emp.js"></script>


<html>
<head>
<title>Edit Employee</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='TimesheetUpload.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>

    <table width=100% border=0>
      <tr>
        <td><span class="pageheading"><b>Employee</b></td>
      </tr>
   	</table>

		</td></tr>
		<tr>
    <td>

    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
      <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
     	<tr bgcolor="#FFFFFF"  >
    		<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
          
    			<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Select File</p></span></td>
            <td><input type="file" name="fileupload" id="fileupload" >
             
            </td>
            <td></td>
            <td></td>
        	</tr>

        </table>
      </td>
    </tr>
    </table>
    </td>
  </table>
                        
    <table border = 0 cellpadding=0 cellspacing=0 width=100% >
      <tr>
          <td align=left>
          </td>
      </tr>
  	</table>

    	<span class="tabletext">
    	<input type="submit"   value="Submit" name="Import"  onClick="javascript: return check_req_field4EmpConfig()">
    	<input TYPE="reset" style="color=#0066CC;background-color:#DDDDDD;width=130;" VALUE="Reset" onclick="javascript: putfocus()">

    	</form>
  </body>
</html>
