<?php


session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
    header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'newempConfig';
$page="ResourceSchdule";

$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];

include('classes/empClass.php');
include('classes/ResourcePlanningClass.php');
$newEmp = new emp;
$newRP = new ResourcePlanning;

if ($_POST) {
	 if(isset($_POST["Import"])){
			
	 
		$filename=$_FILES["fileupload"]["tmp_name"];		
		
		 if($_FILES["fileupload"]["size"] > 0)
		 {	
		 		
		 		$uploadname = $_FILES["fileupload"]["name"];
		 		$uploadsize = $_FILES["fileupload"]["size"];
		 		

       	$newRP->setuploadname($uploadname);
       	$newRP->setuploadsize($uploadsize);
       	$newRP->setlink2user($userrecnum);
       	$newRP->setuserid($userid);
       	$link2upload = $newRP->InsertUploadDetails();
        // echo "link2upload $link2upload <br>"; exit;
       	// $link2upload = 1;
		 		$row = 1;
		  	$file = fopen($filename, "r");
		  	$data = array();
        while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
       	{
       		if ($row > 1) {
            // echo "<pre>";
            // print_r($getData); exit;
       			$uploadtype = 'Upload';
       			$newRP->setempid($getData[3]);
       			$newRP->setsiteid($getData[1]);
            $newRP->setsubsidaryid($getData[2]);
            // $newRP->setlink2user($getData[4]);
            $newRP->setshift($getData[4]);
       			$newRP->setshiftdate($getData[5]);
       			$newRP->setuploadtype($uploadtype);
       			$newRP->setlink2upload($link2upload);


       			$newRP->UploadReourceSchdule();

       			
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
<title>Resource Upload</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='ResourceSchduleUpload.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>

    <table width=100% border=0>
      <tr>
        <td><span class="pageheading"><b>Resource</b></td>
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
