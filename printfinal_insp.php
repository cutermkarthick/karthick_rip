<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 21, 2007                 =
// Filename: printqualityplanDetails.php       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// print Quality Plan Details                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'FinalInspdetails';
//////session_register('pagename');

// First include the class definition

include('classes/Final_insp_reportClass.php');
include('classes/Final_insp_reportliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newFIR = new final_insp_report;
$newLI = new final_insp_reportli;
$newdisplay = new display;

$final_insprecnum = $_REQUEST['final_insprecnum'];


$result = $newFIR->getFinal_insp($final_insprecnum);
$myrow = mysql_fetch_assoc($result);
$myFI = $newLI->getLI($final_insprecnum);
$myFI1= $newLI->getLI($final_insprecnum);
$myFI2 = $newLI->getLI($final_insprecnum);


?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Final Inspection Report</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Final Inspection Report</b></center></td></tr>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
 <tr bgcolor="#FFFFFF"></tr>
          <?php
            $d=substr($myrow['billdate'],8,2);
            $m=substr($myrow['billdate'],5,2);
            $y=substr($myrow['billdate'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";

            $d=substr($myrow['approved_date'],8,2);
            $m=substr($myrow['approved_date'],5,2);
            $y=substr($myrow['approved_date'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date11=date("M j, Y",$x);
          ?>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">CIM Ref Num.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['refnum']?></td>
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['customer']?>
            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">WO No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['wonum']?></td>
            <td><span class="labeltext"><p align="left">Part No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['partnum']?>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Bill No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['billnum']?></td>
            <td><span class="labeltext"><p align="left">Bill Date</p></font></td>
            <td><span class="tabletext"><?php echo $date?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['partname']?></td>
            <td><span class="labeltext"><p align="left">PO No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['ponum']?></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Issue</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['issue']?></td>
            <td><span class="labeltext"><p align="left">Report No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['reportnum']?></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Page.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['page']?></td>
            <td><span class="labeltext"><p align="left">Qty.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['qty']?></td>
        </tr>


      </table>

 <br>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Sl</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>DRG</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>DIM</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dimensions</center></b></td>
   <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>Actual Dimensions</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Accept/</center></b></td>
</tr>

 <tr>
<?php

     $i = 1;
    while ($FI = mysql_fetch_assoc($myFI))
    {
      if($i == 1)
      {

      $slnum1 = $FI['slnum1'];
      $slnum2 = $FI['slnum2'];
      $slnum3 = $FI['slnum3'];

     echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>No.</center></b></td>";
     echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>Sheet</center></b></td>";
     echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>Map</center></b></td>";
     echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>Main View</center></b></td>";
     echo "<td bgcolor=\"#EEEFEE\" width=15%><span class=\"heading\"><b><center>Sl No:</center></b> $slnum1</td>";
     echo "<td bgcolor=\"#EEEFEE\" width=15%><span class=\"heading\"><b><center>Sl No:</center></b> $slnum2</td>";
     echo "<td bgcolor=\"#EEEFEE\" width=15%><span class=\"heading\"><b><center>Sl No:</center></b> $slnum3</td>";
     echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>Reject</center></b></td>";
     }
     $i++;
   }
?>
</tr>

<?php
 $i = 1;
    while ($FI = mysql_fetch_assoc($myFI1))
    {

	printf('<tr bgcolor="#FFFFFF">');

    $slno = $FI["slno"];
	$sheet = $FI["sheet"];
	$map = $FI["map"];
    $main_view = $FI["main_view"];
    $actual_dim1 = $FI["actual_dim1"];
    $actual_dim2 = $FI["actual_dim2"];
    $actual_dim3 = $FI["actual_dim3"];
    $accpt_reject = $FI["accpt_reject"];

	echo "<td align=\"left\"><span class=\"tabletext\">$slno</td>";
	echo "<td align=\"left\" width=15%><span class=\"tabletext\">$sheet</td>";
	echo "<td align=\"left\" width=15%><span class=\"tabletext\">$map</td>";
	echo "<td align=\"left\" width=15%><span class=\"tabletext\">$main_view</td>";
    echo "<td align=\"left\" width=15%><span class=\"tabletext\">$actual_dim1</td>";
    echo "<td align=\"left\" width=15%><span class=\"tabletext\">$actual_dim2</td>";
    echo "<td align=\"left\" width=15%><span class=\"tabletext\">$actual_dim3</td>";
    echo "<td align=\"left\" width=15%><span class=\"tabletext\">$accpt_reject</td>";
	printf('</tr>');


	$i++;
    }

?>



 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<?php

$i=1;

   while ($FI = mysql_fetch_assoc($myFI2))
   {
     if($i ==1)
     {

            $d=substr($FI['insp_date1'],8,2);
            $m=substr($FI['insp_date1'],5,2);
            $y=substr($FI['insp_date1'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date1=date("M j, Y",$x);

            $d=substr($FI['insp_date2'],8,2);
            $m=substr($FI['insp_date2'],5,2);
            $y=substr($FI['insp_date2'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date2=date("M j, Y",$x);

            $d=substr($FI['insp_date3'],8,2);
            $m=substr($FI['insp_date3'],5,2);
            $y=substr($FI['insp_date3'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date3=date("M j, Y",$x);


?>



       <tr bgcolor="#FFFFFF">
            <td align=centre width=47%><span class="labeltext"><p align="centre">Inspected By:</p></font></td>
            <td><span class="tabletext"><?php echo $FI['insp_by1']?></td>
            <td><span class="tabletext"><?php echo $FI['insp_by2']?></td>
            <td><span class="tabletext"><?php echo $FI['insp_by3']?></td>
        </tr>

       <tr bgcolor="#FFFFFF">
            <td align=centre width=47%><span class="labeltext"><p align="centre">Inspected Date:</p></font></td>
            <td><span class="tabletext"><?php echo $date1?></td>
            <td><span class="tabletext"><?php echo $date2?></td>
            <td><span class="tabletext"><?php echo $date3?></td>
       </tr>

<?php
   }
   $i++;
}
?>
     <tr bgcolor="#FFFFFF">
                   <td align=centre><span class="labeltext"><p align="centre">Approved By:</p></td>
           <td><span class="tabletext"><?php echo $myrow['approved_by']?></td>
            <td align=centre><span class="labeltext"><p align="centre">Approved Date:</p></td>
            <td><span class="tabletext"><?php echo $date11?></td>

      </tr>




</table>

</body>
</html>
