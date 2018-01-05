<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = March 15,2005                =
// Filename: boardReport.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Board report                                =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
// First include the class definition

include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/reportClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$newreport = new report;
$newdisp = new display;

$cond = $_SESSION['printcond'];

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage =50;

// by default we show first page
$pageNum = 1;
$offset = 0;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/wo.js"></script>


<html>
<head>
<title>Board Wo Status</title>
</head>



<table width=650 border=0>
             <tr><td><font style="Arial" size=5 color="#000000"><center><b><A HREF="javascript:window.print()">Board WO Report</A></b></center></td</tr>
</table>


<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

    <table border=1 width=630 rules=all frame=box>

<tr>
	<td bgcolor="#EEEFEE"><span class="heading"><b>WO</b></td>
	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Company</center></b></td>
	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Sch Due</center></b></td>
<?php
         $numstages = 0;
         $result = $newreport->getWFstages('Board');
         while ($wfstage = mysql_fetch_row($result)) {

               printf('<td bgcolor="#EEEFEE"><b><span class="heading">%s</b></td>
                      ',
		         $wfstage[0]
               );
               $numstages = $numstages + 1;
         }
?>

</tr>

<?php

            $result = $newreport->getWOs4print('Board',$cond);

            $appr = 1;
            while ($myrow = mysql_fetch_row($result)) {
                 $str = '<tr bgcolor="#FFFFFF"><td><span class="tabletext">' . $myrow[0] . '</td><td><span class="tabletext">' . $myrow[1] . "</td>". '</td><td><span class="tabletext">' . $myrow[2] . "</td>";
                 $tl = $newreport->getdates4WO($myrow[3]);
                 while ($mytl = mysql_fetch_row($tl)) {
                     $str = $str . '<td><span class="tabletext">' . $mytl[0] . "</td>";
                     $appr++;
                 }
                 print $str;
                 while ($appr <= $numstages)
                 {
                     print('<td bgcolor="#FFFFFF"></td>');
                     $appr++;
                 }
                 $appr = 1;
              }

             print("</tr>");

?>

 </table>
    </td>
</tr>
</table>



</body>
</html>
