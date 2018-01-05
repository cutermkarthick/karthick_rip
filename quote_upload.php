<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: quote_upload.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Upload quotes                               =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];

include('classes/quoteClass.php'); 

$quoteid = $_REQUEST['quoteid'];
$desc = $_REQUEST['desc'];
$company = $_REQUEST['company'];
$rfqid = $_REQUEST['rfqid'];
$quotedate = $_REQUEST['quotedate'];

// Next, create an instance of the class 
$newQuote = new quote; 

if ($_SESSION['pagename'] == 'newquote') {
   $excelfile = $userid . '_' . $_FILES['excelfile']['name'];
   $excelfile = preg_replace('/\s+/',' ',$excelfile);
   $excelfile = preg_replace('/\s/','_',$excelfile);
   $excelfile = strtolower($excelfile);
   $newQuote->setexcelfile($excelfile);
}$delete = $_REQUEST['deleteflag'];
}

// Set the quote fields

$newQuote->setid($quoteid);
$newQuote->setCompany($company);
$newQuote->setdesc($desc);
$newQuote->setrfqid($rfqid);
$newQuote->setquotedate($quotedate);
$crdate = date("d-M-y");



// Upload the Excel file
if ($_SESSION['pagename'] == 'newquote') { 
    if (!file_exists("quotes/" . $userid . $excelfile)) {
         $newQuote->addQuote();
         copy($_FILES['excelfile']['tmp_name'], "quotes/" . $excelfile);
         header("Location:quote1.php" );
   }

   else  {
?>
<html>
<head>
<title>Quote Upload</title>
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
    echo "<tr><td><font color=#FF0000>Please check all quotes and try again" . '</td></tr></table>';
    echo "</table>";
    echo "</body>";
    echo "</html>";
   }
}

if ($_SESSION['pagename'] == 'editquote' && $delete != 'y') {
           $newQuote->updateQuote($quoteid);
           header("Location:quote1.php" );
}
if ($_SESSION['pagename'] == 'editquote' && $delete == 'y') { 
           $newQuote->deleteQuote($quoteid);
           header("Location:quote1.php" );
}

?> 

