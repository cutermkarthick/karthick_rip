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

$_SESSION['pagename'] = 'custdatadetails';
//////session_register('pagename');

// First include the class definition

include('classes/masterClass.php');
include('classes/masterliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newmaster = new master;
$newLI = new master_line_items;
$newdisplay = new display;

$masterrecnum = $_REQUEST['masterrecnum'];

$myQI = $newLI->getLI($masterrecnum);
$result = $newmaster->getmasterdetails($masterrecnum);
$myrow = mysql_fetch_assoc($result);

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Master Process Sheet</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Master Process Sheet Details</b></center></td></tr>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
 <tr bgcolor="#FFFFFF"></tr>
         <?php
           /* $d=substr($myrow["Date"],8,2);
            $m=substr($myrow["Date"],5,2);
            $y=substr($myrow["Date"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";    */
          ?>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext">Reference No.</td>
            <td  bgcolor="#FFFFFF" width=25%><span class="tabletext"> <?php echo $myrow['refnum']?></td>
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext">Issue Date.</td>
            <td  bgcolor="#FFFFFF" width=25%><span class="tabletext"><?php echo $myrow['issue_date']?></td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part Number</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['partnum']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Rev. No.</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['revnum']?></td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part Name</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['partname']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Rev. Date</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['revdate']?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Attachments</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['attachments']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Drg. Issue</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['drg_issue']?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Customer</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['customer']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Project</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['project']?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Material Type</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['material_type']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Material Specification</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['material_sp']?></td>
       </tr>

</table>
 <br>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Line Items</b></center></td>
</tr>

<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
   <td bgcolor="#EEEFEE"><span class="heading"><b>Opn. No.</b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b>Operation Description</b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b>Work Center</b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b>Opn. Reference No.</b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b>Rev. No.</b></td>
</tr>

<?php
    $i = 1;
      while ($QI = mysql_fetch_assoc($myQI))
      {
	printf('<tr bgcolor="#FFFFFF">');
	$opnnum = $QI["opnnum"];
	$opn_desc = $QI["opn_desc"];
	$work_center = $QI["work_center"];
    $opn_ref_no = $QI["opn_ref_no"];
    $revnum = $QI["revnum"];

	echo "<td align=\"center\"><span class=\"tabletext\">$opnnum</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$opn_desc</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$work_center</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$opn_ref_no</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$revnum</td>";
	printf('</tr>');
	printf('</tr>');
	$i++;
    }

?>




</table>

</body>
</html>
