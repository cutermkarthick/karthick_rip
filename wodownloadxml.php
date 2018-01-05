<?php
@session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'worderSummary';
//////session_register('pagename');

$cond0 = "w.actual_ship_date like %";

$cond1 = "c.name like '%'";
$cond2 = "w.wonum like '%'";
$cond3 = "(to_days(w.sch_due_date)-to_days('1582-01-01') > 0 ||
                    w.sch_due_date = '0000-00-00' ||
                    w.sch_due_date = 'NULL' ) and
           (to_days(w.sch_due_date)-to_days('2050-12-31') < 0 ||
                    w.sch_due_date = '0000-00-00' ||
                    w.sch_due_date = 'NULL')";
$cond4 = "w.wotype like '%'";
$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4;

$worec='';
$oper1='like';
$oper2='like';
$sort1='wo';
$sort2='company';
$sess=session_id();
if ( isset ( $_REQUEST['status_val'] ) )
{

     $sval = $_REQUEST['status_val'];
     if ($sval == 'All')
     {
         $cond0 = "w.condition like " . "'%'";
     }
     else if ($sval == 'Open')
     {
         $cond0 = "(w.condition = '" . $sval . "' && (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = ''))" ;
     }
     else if ($sval == 'Closed')
     {
         $cond0 = "(w.condition = '" . $sval . "' || (w.actual_ship_date is not NULL && w.actual_ship_date != '0000-00-00' && w.actual_ship_date != ''))" ;
     }
     else
     {
         $cond0 = "w.condition = '" . $sval . "'";
     }
}
else
{
     $sval = 'Open';
         $cond0 = "(w.condition = '" . $sval . "' && (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = ''))" ;
}

if ( isset ( $_REQUEST['scomp'] ) )
{
     $company_match = $_REQUEST['scomp'];
     if ( isset ( $_REQUEST['company_oper'] ) ) {
          $oper1 = $_REQUEST['company_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $scomp = "'" . $_REQUEST['scomp'] . "%" . "'";
     }
     else {
         $scomp = "'" . $_REQUEST['scomp'] . "'";
     }

     $cond1 = "c.name " . $oper1 . " " . $scomp;

}
else {
     $company_match = '';
}

if ( isset ( $_REQUEST['swonum'] ) )
{
     $wonum_match = $_REQUEST['swonum'];
     if ( isset ( $_REQUEST['wonum_oper'] ) ) {
          $oper2 = $_REQUEST['wonum_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $swonum = "'" . $_REQUEST['swonum'] . "%" . "'";
     }
     else {
         $swonum = "'" . $_REQUEST['swonum'] . "'";
     }

     $cond2 = "w.wonum " . $oper2 . " " . $swonum;

}
else {
     $wonum_match = '';
}
if ( isset ( $_REQUEST['stype'] ) )
{
     $type_match = $_REQUEST['stype'];
     $cond4 = "w.wotype like '" . $type_match . "%'";

}
else {
     $type_match = '';
}
if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond31 = "to_days(w.sch_due_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(w.sch_due_date)-to_days('1582-01-01') > 0 || w.sch_due_date = 'NULL' || w.sch_due_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond32 = "to_days(w.sch_due_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(w.sch_due_date)-to_days('2050-12-31') < 0 || w.sch_due_date = 'NULL' || w.sch_due_date = '0000-00-00')";
     }
     $cond3 = $cond31 . ' and ' . $cond32;

}
else
{
     $date1_match = '';
     $date2_match = '';
}
if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}
if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4;

// First include the class definition

include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/workorderClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$newworkOrder = new workOrder;
$newdisp = new display;

// how many rows to show per page
$rowsPerPage = 30;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;


 $xml_dec = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";

 $rootELementStart = "<workorders>";
 $rootElementEnd = "</workorders>";
 $subrootELementStart = "<wo>";
 $subrootElementEnd = "</wo>";
 $xml_doc= $xml_dec;

$xml_doc .= $rootELementStart;

        $result = $newworkOrder->getWorkOrders($username,$cond,$sort1,$sort2,$offset, $rowsPerPage);
        while ($myrow = mysql_fetch_row($result))
          {

                    $woid=$myrow[0];
                    $company= $myrow[2];
                    $designer=$myrow[13];
                    $type=$myrow[1];
                    $custpo=$myrow[3];
                    $quote=$myrow[4];
                    $stage=$myrow[5];
                    $polink=$myrow[17];
                    $stages=$myrow[17];
                    $schdue=$myrow[14];
                    $RevShip=$myrow[17];
                    $bom=$myrow[19];
                    $desc=$myrow[12];
                    $bookdate=$myrow[16];

                    $file1=$myrow[21];
                    $file2=$myrow[22];
                    $file3=$myrow[23];
                    $file4=$myrow[24];

    $xml_doc .= $subrootELementStart;
         $xml_doc .= "<id>";
         $xml_doc .= $woid;
         $xml_doc .= "</id>";
         $xml_doc .= "<company >";
         $xml_doc .= $company;
         $xml_doc .= "</company >";
         $xml_doc .= "<designer >";
         $xml_doc .= $designer;
         $xml_doc .= "</designer >";
         $xml_doc .= "<type>";
         $xml_doc .= $type;
         $xml_doc .= "</type>";
         $xml_doc .= "<CustPO>";
         $xml_doc .= $custpo;
         $xml_doc .= "</CustPO>";
         $xml_doc .= "<quote>";
         $xml_doc .= $quote;
         $xml_doc .= "</quote>";
         $xml_doc .= "<bookdate>";
         $xml_doc .= $bookdate;
         $xml_doc .= "</bookdate>";
         $xml_doc .= "<bom>";
         $xml_doc .= $bom;
         $xml_doc .= "</bom>";
         $xml_doc .= "<stage>";
         $xml_doc .= $stage;
         $xml_doc .= "</stage>";
         $xml_doc .= "<schdue>";
         $xml_doc .= $schdue;
         $xml_doc .= "</schdue>";
         $xml_doc .= "<RevShip>";
         $xml_doc .= $RevShip;
         $xml_doc .= "</RevShip>";
         $xml_doc .= "<desc>";
         $xml_doc .= $desc;
         $xml_doc .= "</desc>";

         $xml_doc .= "<Attachedfiles>";
         $xml_doc .= "<file1>";
         $xml_doc .= $file1;
         $xml_doc .= "</file1>";
         $xml_doc .= "<file2>";
         $xml_doc .= $file2;
         $xml_doc .= "</file2>";
         $xml_doc .= "<file3>";
         $xml_doc .= $file3;
         $xml_doc .= "</file3>";
         $xml_doc .= "<file4>";
         $xml_doc .= $file4;
         $xml_doc .= "</file4>";
         $xml_doc .= "</Attachedfiles>";
    $xml_doc .= $subrootElementEnd;


         }

$xml_doc .= $rootElementEnd;

        header("Content-type: application/x-msdownload",true);
		header("Content-Disposition: attachment; filename=extraction.xml",false);
		header("Pragma: no-cache");
		header("Expires: 0");
	    print($xml_doc);

?>