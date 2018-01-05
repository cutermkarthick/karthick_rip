<?php
//==============================================
// Author: FSI                                 =
// Date-written = Mar 20, 2007                 =
// Filename: processqa4efficiency.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Process of QA for Efficiency                    =
//==============================================

   session_start();
   header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/qa4efficiencyClass.php');
$newQA = new qa4efficiency;

               $qa4effrecnum = $_REQUEST['qa4effrecnum'];
               $crn = $_REQUEST["crn"];
               $wonum = $_REQUEST["wonum"];
			   $release_note = $_REQUEST["release_note"];
			   $insp_by = $_REQUEST["insp_by"];
               $qadate = $_REQUEST["qadate"];
               $qty_disp = $_REQUEST["qty_disp"];
               $qty_accp = $_REQUEST["qty_accp"];
               $newlogin = new userlogin;
		        $newQA->setcrn($crn);
	            $newQA->setwonum($wonum);
                $newQA->setrelnote($release_note);
                $newQA->setinsp_by($insp_by);
                $newQA->setqadate($qadate);
                $newQA->setqty_disp($qty_disp);
                $newQA->setqty_accp($qty_accp);
// Next, create an instance of the classes required

// Get all fields related to master data
if ($pagename == 'qa4efficiencyEntry') {
	$qa4effrecnum = $newQA->addqa();
}

if ($pagename == 'qa4efficiencyEdit')
 {
      	$newQA->updateqa($qa4effrecnum);
 }
header("Location:qa4efficiency.php");

?>
