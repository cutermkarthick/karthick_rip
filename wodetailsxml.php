<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: Feb 1, 2007                   =
// Filename: wodetailsxml.php                  =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// xml files for Workorder details             =
// Written by : Suresh Devadiga                =
//==============================================
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
include('classes/datesClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$newworkOrder = new workOrder;
$newdisp = new display;
$newDates = new dates;

$worecnum = $_SESSION['worecnum'];
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

//xml report
$xml_dec = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";

 $rootELementStart = "<Workorders>";
 $rootElementEnd = "</Workorders>";
 $subrootELementStart = "<WO>";
 $subrootElementEnd = "</WO>";
 $subroot1ELementStart = "<GeneralInformation>";
 $subroot1ElementEnd = "</GeneralInformation>";
 $subroot2ELementStart = "<BillingAddress>";
 $subroot2ElementEnd = "</BillingAddress>";
 $subroot3ELementStart = "<ShippingAddress>";
 $subroot3ElementEnd = "</ShippingAddress>";
 $subroot4ELementStart = "<ContactDetails>";
 $subroot4ElementEnd = "</ContactDetails>";
 $subroot5ELementStart = "<BoardInformation>";
 $subroot5ElementEnd = "</BoardInformation>";
 $subroot6ELementStart = "<ProcessSteps>";
 $subroot6ElementEnd = "</ProcessSteps>";
 $subroot7ELementStart = "<SpecialInstructions>";
 $subroot7ElementEnd = "</SpecialInstructions>";
 $subroot8ELementStart = "<TimelineOwner>";
 $subroot8ElementEnd = "</TimelineOwner>";
 $subroot9ELementStart = "<AttachedFile>";
 $subroot9ElementEnd = "</AttachedFile>";
 $subroot10ELementStart = "<SocketInformation>";
 $subroot10ElementEnd = "</SocketInformation>";

 $xml_doc= $xml_dec;

  $result = $newworkOrder->getwodetails($worecnum);
     $myrow = mysql_fetch_row($result);
              $customer=$myrow[2];
              $wonum= $myrow[0];
              $ponum=$myrow[3];
              $quotenum=$myrow[4];
              $description=$myrow[25];
              $designer=$myrow[31].$myrow[32];
              $bookdate=$myrow[40];
              $reorder=$myrow[7];
              $name=$myrow[27].$myrow[28];
              $email=$myrow[30];
              $phone=$myrow[29];
              $schdue=$myrow[9];
              $baddress=$myrow[11] . " " . $myrow[12];
              $bcity=$myrow[13];
              $bstate=$myrow[14];
              $saddress=$myrow[17] . " " . $myrow[18];
              $scity=$myrow[19];
              $sstate=$myrow[20];
              $sch_due_date=$myrow[38];
              $actual_ship_date=$myrow[39];
              $revised_ship_date=$myrow[41];





    $xml_doc .= $rootELementStart;
         $xml_doc .= $subrootELementStart;
                  $xml_doc .= $subroot1ELementStart;
                        $xml_doc .= "<customer>";
                        $xml_doc .= $customer;
                        $xml_doc .= "</customer>";
                        $xml_doc .= "<wonum >";
                        $xml_doc .= $wonum;
                        $xml_doc .= "</wonum >";
                        $xml_doc .= "<ponum >";
                        $xml_doc .= $ponum;
                        $xml_doc .= "</ponum >";
                        $xml_doc .= "<quotenum>";
                        $xml_doc .= $quotenum;
                        $xml_doc .= "</quotenum>";
                        $xml_doc .= "<description>";
                        $xml_doc .= $description;
                        $xml_doc .= "</description>";
                        $xml_doc .= "<designer>";
                        $xml_doc .= $designer;
                        $xml_doc .= "</designer>";
                        $xml_doc .= "<bookdate>";
                        $xml_doc .= $bookdate;
                        $xml_doc .= "</bookdate>";
                        $xml_doc .= "<reorder>";
                        $xml_doc .= $reorder;
                        $xml_doc .= "</reorder>";
                  $xml_doc .= $subroot1ElementEnd;
                  $xml_doc .= $subroot2ELementStart;
                        $xml_doc .= "<baddress>";
                        $xml_doc .= $baddress;
                        $xml_doc .= "</baddress>";
                        $xml_doc .= "<bcity >";
                        $xml_doc .= $bcity;
                        $xml_doc .= "</bcity >";
                        $xml_doc .= "<bstate >";
                        $xml_doc .= $bstate;
                        $xml_doc .= "</bstate >";
                  $xml_doc .= $subroot2ElementEnd;
                  $xml_doc .= $subroot3ELementStart;
                        $xml_doc .= "<saddress>";
                        $xml_doc .= $saddress;
                        $xml_doc .= "</saddress>";
                        $xml_doc .= "<scity >";
                        $xml_doc .= $scity;
                        $xml_doc .= "</scity >";
                        $xml_doc .= "<sstate >";
                        $xml_doc .= $sstate;
                        $xml_doc .= "</sstate >";
                  $xml_doc .= $subroot3ElementEnd;
                  $xml_doc .= $subroot4ELementStart;
                        $xml_doc .= "<name>";
                        $xml_doc .= $name;
                        $xml_doc .= "</name>";
                        $xml_doc .= "<email >";
                        $xml_doc .= $email;
                        $xml_doc .= "</email >";
                        $xml_doc .= "<phone >";
                        $xml_doc .= $phone;
                        $xml_doc .= "</phone >";
                  $xml_doc .= $subroot4ElementEnd;


        //Board Information
            if($myrow[1]=="Board")
            {

            $result1 = $newworkOrder->getwodetails1("WorkOrder",$myrow[1],$myrow[37],1);
            $myrow1 = mysql_fetch_row($result1);
                    $boardtype=$myrow1[0];
                    $layers = $myrow1[1];
                    $boardsize= $myrow1[3];
                    $tester=$myrow1[2];

            $result2 = $newworkOrder->getwodetails1("WorkOrder",$myrow[1],$myrow[37],2);
            $myrow2 = mysql_fetch_row($result2);
                    $design = $myrow2[0];
                    $fab= $myrow2[1];
                    $ship=$myrow2[2];

            $result3 = $newworkOrder->getwodetails1("WorkOrder",$myrow[1],$myrow[37],3);
            $myrow3 = mysql_fetch_row($result3);
                  $si = $myrow3[0];

                $xml_doc .= $subroot5ELementStart;
                        $xml_doc .= "<boardtype>";
                        $xml_doc .= $boardtype;
                        $xml_doc .= "</boardtype>";
                        $xml_doc .= "<layers>";
                        $xml_doc .= $layers;
                        $xml_doc .= "</layers>";
                        $xml_doc .= "<tester>";
                        $xml_doc .= $tester;
                        $xml_doc .= "</tester>";
                        $xml_doc .= "<boardsize>";
                        $xml_doc .= $boardsize;
                        $xml_doc .= "</boardsize>";
                  $xml_doc .= $subroot5ElementEnd;
                  $xml_doc .= $subroot6ELementStart;
                        $xml_doc .= "<design>";
                        $xml_doc .= $design;
                        $xml_doc .= "</design>";
                        $xml_doc .= "<fab>";
                        $xml_doc .= $fab;
                        $xml_doc .= "</fab>";
                        $xml_doc .= "<ship>";
                        $xml_doc .= $ship;
                        $xml_doc .= "</ship>";
                  $xml_doc .= $subroot6ElementEnd;
                  $xml_doc .= $subroot7ELementStart;
                        $xml_doc .= "<si>";
                        $xml_doc .= $si;
                        $xml_doc .= "</si>";
                  $xml_doc .= $subroot7ElementEnd;
            }
            //End of Board Information

            //Socket Information

            if($myrow[1]=="Socket")
              {

              $result1 = $newworkOrder->getwodetails1("WorkOrder",$myrow[1],$myrow[37],1);
              $myrow1 = mysql_fetch_row($result1);

                        $device=$myrow1[0];
                        $contact= $myrow1[1];
                        $pitch = $myrow1[2];
                        $bodysize=$myrow1[3];
                        $lidtype=$myrow1[4];

                   $xml_doc .= $subroot10ELementStart;
                        $xml_doc .= "<device>";
                        $xml_doc .= $device;
                        $xml_doc .= "</device>";
                        $xml_doc .= "<contact>";
                        $xml_doc .= $contact;
                        $xml_doc .= "</contact>";
                        $xml_doc .= "<pitch>";
                        $xml_doc .= $pitch;
                        $xml_doc .= "</pitch>";
                        $xml_doc .= "<boardsize>";
                        $xml_doc .= $bodysize;
                        $xml_doc .= "</boardsize>";
                        $xml_doc .= "<lidtype>";
                        $xml_doc .= $lidtype;
                        $xml_doc .= "</lidtype>";
                    $xml_doc .= $subroot10ElementEnd;
             }
             //End of Socket Information

             //Timeline information

             $timeline = $newDates->getdates('WO', $worecnum,$myrow[1]);

                   $xml_doc .= $subroot8ELementStart;
                        $xml_doc .= "<sch_due_date>";
                        $xml_doc .= $sch_due_date;
                        $xml_doc .= "</sch_due_date>";
                        $xml_doc .= "<revised_ship_date>";
                        $xml_doc .= $revised_ship_date;
                        $xml_doc .= "</revised_ship_date>";
                        $xml_doc .= "<actual_ship_date>";
                        $xml_doc .= $actual_ship_date;
                        $xml_doc .= "</actual_ship_date>";

                    while ($myrow4 = mysql_fetch_row($timeline))
                    {
                            $dept = $myrow4[28];
                            $milestone = $myrow4[1];
                            $scheduleddate = $myrow4[2];
                            $reviseddate = $myrow4[3];
                            $hold  = $myrow4[24];
                            $completeddate = $myrow4[4];
                            $owner  = $myrow4[12];
                            $approvedby  = $myrow4[15];

                        $xml_doc .= "<dept>";
                        $xml_doc .= $dept;
                        $xml_doc .= "</dept>";
                        $xml_doc .= "<milestone>";
                        $xml_doc .= $milestone;
                        $xml_doc .= "</milestone>";
                        $xml_doc .= "<scheduleddate>";
                        $xml_doc .= $scheduleddate;
                        $xml_doc .= "</scheduleddate>";
                        $xml_doc .= "<reviseddate>";
                        $xml_doc .= $reviseddate;
                        $xml_doc .= "</reviseddate>";
                        $xml_doc .= "<hold>";
                        $xml_doc .= $hold;
                        $xml_doc .= "</hold>";
                        $xml_doc .= "<completeddate>";
                        $xml_doc .= $completeddate;
                        $xml_doc .= "</completeddate>";
                        $xml_doc .= "<owner>";
                        $xml_doc .= $owner;
                        $xml_doc .= "</owner>";
                        $xml_doc .= "<approvedby>";
                        $xml_doc .= $approvedby;
                        $xml_doc .= "</approvedby>";
                    }
                 $xml_doc .= $subroot8ElementEnd;

                 //end of timeline information

                 //Attachments
                 $result1 = $newworkOrder->attachments($worecnum);
                 $myrow1 = mysql_fetch_row($result1);
                         $file1= $myrow1[0];
                         $file2= $myrow1[1];
                         $file3= $myrow1[2];
                         $file4= $myrow1[3];

                  $xml_doc .= $subroot9ELementStart;
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
                  $xml_doc .= $subroot9ElementEnd;
                  //end of file attachment

         $xml_doc .= $subrootElementEnd;
  $xml_doc .= $rootElementEnd;

        header("Content-type: application/x-msdownload",true);
		header("Content-Disposition: attachment; filename=extraction.xml",false);
		header("Pragma: no-cache");
		header("Expires: 0");
	    print($xml_doc);
?>