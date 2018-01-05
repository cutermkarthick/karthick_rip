<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 19, 2008                =
// Filename: crn_status.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Displays WO Status report                   =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$usertype = $_SESSION['usertype'];
$_SESSION['pagename'] = 'reports';
$crn=$_REQUEST['crn'];
$page = "Reports";
//////session_register('pagename');


include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 10;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
	//echo "i am set";
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;



// $cond0 = "w.actual_ship_date like %";


// echo $cond;
// First include the class definition

include('classes/reportClass.php');
include('classes/displayClass.php');
$newreport = new report;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>WO Status Report</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
	
<?php
include('header.html');

?>
<form action='dispatch_pending.php' method='post' enctype='multipart/form-data'>

<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr>
	<td>
  <table width=100% border=0 >

    
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td align="center" colspan=7><span class="heading"><b>Search Criteria</b></td></tr>
<tr>
<td valign='top' bgcolor="#FFFFFF"><span class="labeltext"><b>PRN:</b>&nbsp;
<input type="text" size=15% name="crn" value="<?echo $_REQUEST['crn'] ?>">
<span class="button"><b><input type="submit" name="submit" value="Get"></b>

<input type="hidden" name="company_oper">
<input type="hidden" name="wonum_oper">
</td>
</tr>


</tr>
</table>

</td></tr>
    </tr>
   </table>
<tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable">
<thead>
 <tr>
<th class="head0"><span class="heading"><b>PRN</b></th>
<th class="head1"><span class="heading"><b>Cofcnum</b></th>
<th class="head0"><span class="heading"><b>Sch Qty</b></th>
<th class="head0"><span class="heading"><b>Disp Qty</b></th>
<th class="head1"><span class="heading"><b>Schedule Dt</b></th>
<th class="head0"><span class="heading"><b>Disp Date</b></th>
</tr>
</thead>

<?php      

$curdate = date('y-m-d');
$crecnum = "d.disp2customer like '%'";
$crnval = '';
      if($usertype == 'CUST')
      {
      		$result4com = $newreport->getcompany($crn);
          $row = mysql_fetch_row($result4com);
          $crecnum = "d.disp2customer like '" .$row[0]."%'";
      }

        $result = $newreport->getpendingdelivery_sch($crn,$crecnum);
        while ($myrow = mysql_fetch_row($result)) {
          $cofcnum = $myrow[4];
          $schdtflag = 0;
        	
	   if($myrow[1] != '0000-00-00' && $myrow[1] != '' && $myrow[1] != 'NULL')
            {
                $datearr = split('-', $myrow[1]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $schdate=date("M j, Y",$x);
            }
            else
            {
               $schpdate = '';
            }
	    if($myrow[6] != '0000-00-00' && $myrow[6] != '' && $myrow[6] != 'NULL')
            {
                $datearr = split('-', $myrow[6]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $dispdate=date("M j, Y",$x);
            }
            else
            {
               $dispdate = '';
            }
	  
	  if(strtotime($schdate) <= strtotime($curdate) && $cofcnum == '')
	  {
	  	$trcolor = "#FF0000";

	  }else
	  {
	  		$trcolor = "#FFFFFF";

	  }




            printf('<tr bgcolor = "%s"><td  align="center"><span class="tabletext">%s</td>
                    <td align="center"><span class="tabletext">%s</td>
                    <td  align="center"><span class="tabletext">%s</td>
                    <td  align="center"><span class="tabletext">%s</td>
                     <td align="center"><span class="tabletext">%s</td>
                     <td align="center"><span class="tabletext">%s</td>
                   
                    ',
                      $trcolor,
                      $myrow[0],
                      $cofcnum, 
                      $myrow[2],
                      $myrow[7],
            		  $schdate,
                      $dispdate
                      
                      );


                 $crnval = $myrow[0];

     	
              
          }

?>
</td></tr>
</table>
</td></tr>
</table>
</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>


<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
	<td align=left>
  <?php
//  Added on Dec 6,04 for paging

$numrows = 10;
//echo $numrows;

// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

if (!isset($_REQUEST['page']))
{
    $totpages = $maxPage;
}

$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one
if ($pageNum > 1)
{
    $page = $pageNum - 1;
    $prev = " <a href=\"dispatch_pending.php?page=$page&totpages=$totpages&crn=$crn\">[Prev]</a> ";

    $first = " <a href=\"dispatch_pending.php?page=1&totpages=$totpages&crn=$crn\">[First Page]</a> ";
}
else
{
    $prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
    $first = ' [First Page] '; // nor 'first page' link
}

// print 'next' link only if we're not
// on the last page
if ($pageNum < $totpages)
{
    $page = $pageNum + 1;
  $next = " <a href=\"dispatch_pending.php?page=$page&totpages=$totpages&crn=$crn\">[Next]</a> ";

  $last = " <a href=\"dispatch_pending.php?page=$totpages&totpages=$totpages&crn=$crn\">[Last Page]</a> ";
}
else
{
    $next = ' [Next] ';      // we're on the last page, don't enable 'next' link
    $last = ' [Last Page] '; // nor 'last page' link
}

if($totpages!=0)
{
//$pageNum=0;
// print the page navigation link
echo "<span class=\"labeltext\">" . $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last;
}
else
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";
// End additions on Dec 6,04

?>
</td>
</tr></table>
</form>
</body>
</html>
