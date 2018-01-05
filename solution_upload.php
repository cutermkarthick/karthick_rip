<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 10, 2005 by Jerry George               =
// Filename: solution_upload.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

include('classes/solutionClass.php');

$solnum = $_REQUEST['solnum'];
$title = $_REQUEST['title'];
$type = $_REQUEST['soltypeval'];
$prob_desc = $_REQUEST['prob_desc'];
$sol_desc = $_REQUEST['sol_desc'];
$excelfile='';
// Next, create an instance of the class
$newsolution = new solution;
//echo $_SESSION['pagename'];

//if ($_SESSION['pagename'] == 'newsolution' || $_SESSION['pagename'] == 'editolution') {
//echo "heloo i am inside";

if($_FILES['excelfile']['name']=='')
{
	if($_SESSION['pagename'] == 'editsolution')
	{
		 $excelfile =$_REQUEST['exelval'];
		 $excelfile = preg_replace('/\s+/',' ',$excelfile);
		 $excelfile = preg_replace('/\s/','_',$excelfile);
		 $excelfile = strtolower($excelfile);
		 $newsolution->setsol_upload_file($excelfile);
	}
}
else
{
	$excelfile = $userid . '_' . $_FILES['excelfile']['name'];
	$excelfile = preg_replace('/\s+/',' ',$excelfile);
	$excelfile = preg_replace('/\s/','_',$excelfile);
	$excelfile = strtolower($excelfile);
	$newsolution->setsol_upload_file($excelfile);
}

// Set the solution fields

$newsolution->setsolnum($solnum );
$newsolution->settitle ($title );
$newsolution->setsol_desc($sol_desc);
$newsolution->setprob_desc($prob_desc);
$newsolution->settype($type);
//$createdate = date("d-M-y");

//echo "$excelfile";
// Upload the Excel file
if ($_SESSION['pagename'] == 'newsolution') {
	if ($excelfile!='')
	{
    		if (!file_exists("solutions/" . $userid . $excelfile))
		{
			$newsolution->addsolution();
			copy($_FILES['excelfile']['tmp_name'], "solutions/" . $excelfile);
			header("Location:new_solution.php" );
		}
       		else
		{
		?>
		<html>
		<head>
		<title>Solution Upload</title>
		</head>

        <?php include('header.html');
		 include('scripts/mouseover.inc');
		?>
		<table cellspacing="2" cellpadding="20" border="0">
		<tr><td>
		<table width=600 border=0>
		<tr>
		<td colspan=2><span class="heading"><b>Welcome <?php echo $userid?></b></td>
		<td colspan=9 align="right" width="7%"><a href="login.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image10','','images/logout_mo.gif',1)"><img name="Image10" border="0" src="images/logout.gif" width="90" height="30"></a></td>
		</tr>
		<tr><td>&nbsp</td></tr>

         <?php  $newQuote->dispLinks();
		  echo "<table border=1><tr><td><font color=#FF0000>File " .  $userid . '_'. $_FILES['excelfile']['name'] . " exists" . '</td></tr>';
		  echo "<tr><td><font color=#FF0000>Please check all solutions and try again" . '</td></tr></table>';
		  echo "</table>";
		  echo "</body>";
		  echo "</html>";
		   }
	}
	else
	{
		$newsolution->addsolution();
		header("Location:solutionsummary.php");
	}


}
$pagename=$_SESSION['pagename'];
if ($_SESSION['pagename'] == 'editsolution') {
           $newsolution->updatesolution($solnum);
           copy($_FILES['excelfile']['tmp_name'], "solutions/" . $excelfile);
           header("Location:solutionsummary.php" );
}

if ($_SESSION['pagename']=='editsolution')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
       $solrecnum=$_SESSION['solrecnum'];
       $newsolution->deleteSolution($solrecnum);
       header("Location:solutionsummary.php" );
     }
 }
?>