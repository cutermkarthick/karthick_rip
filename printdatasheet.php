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

$_SESSION['pagename'] = 'ds_details';
//////session_register('pagename');

// First include the class definition

include('classes/dataclass.php');
include('classes/dataliclass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newdatasheet = new data;
$newLI = new datasheet_line_items;
$newdisplay = new display;

$dsrecnum = $_REQUEST['dsrecnum'];

$myQI = $newLI->getLI($dsrecnum);
$result = $newdatasheet->getdatadetails($dsrecnum);
$myrow = mysql_fetch_assoc($result);

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Datasheet</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Datasheet Details</b></center></td></tr>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
 <tr bgcolor="#FFFFFF"></tr>
         <?php
            $d=substr($myrow["revdate"],8,2);
            $m=substr($myrow["revdate"],5,2);
            $y=substr($myrow["revdate"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";
          ?>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext">Opn Ref No.</td>
            <td  bgcolor="#FFFFFF" width=25%><span class="tabletext"> <?php echo $myrow['opn_ref_no']?></td>
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext">Drg Issue</td>
            <td  bgcolor="#FFFFFF" width=25%><span class="tabletext"><?php echo $myrow['drg_issue']?></td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Work centre</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['work_center']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Opn No.</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['opnnum']?></td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part Number</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['partnum']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Attachments</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['attachments']?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Rev No.</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['revnum']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part Name</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['partname']?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part type</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['parttype']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Rev date</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['revdate']?></td>
       </tr>
       
       <tr bgcolor="#FFFFFF">
            <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Prepared By</p></font></td>
            <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["prepared_by"] ?></td>
            <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Approved By</p></font></td>
            <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["approved_by"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Issue No</p></font></td>
            <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["issuenum"] ?></td>
            <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Sheet</p></font></td>
            <td bgcolor="#FFFFFF"><span class="labeltext"></td>
            
            <!--<td width=20%><span class="tabletext"><?php /* echo $myrow["sheet"] */?></td>-->
        </tr>
</table>
<table>
<tr>
  <td>&nbsp;</td>
</tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>linenum</b></td>
            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>tool_details</b></td>
            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>tool_length</b></td>
            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>speed</b></td>
            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>feed</b></td>
            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>opn_desc</b></td>
            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>cnc_pgm_name</b></td>
            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>Est Time</b></td>
</tr>
<?php
 $i = 1;
      while ($QI = mysql_fetch_assoc($myQI))
      {
	printf('<tr bgcolor="#FFFFFF">');
	$linenum = $QI["linenum"];
	$tool_details = $QI["tool_details"];
	$tool_length = $QI["tool_length"];
    $speed = $QI["speed"];
    $feed = $QI["feed"];
    $opn_desc = $QI["opn_desc"];
    $cnc_pgm_name = $QI["cnc_pgm_name"];
    $est_time = $QI["est_time"];

	echo "<td align=\"center\" colspan=2><span class=\"tabletext\">$linenum</td>";
	echo "<td align=\"center\" colspan=2><span class=\"tabletext\">$tool_details</td>";
	echo "<td align=\"center\" colspan=2><span class=\"tabletext\">$tool_length</td>";
	echo "<td align=\"center\" colspan=2><span class=\"tabletext\">$speed</td>";
    echo "<td align=\"center\" colspan=2><span class=\"tabletext\">$feed</td>";
    echo "<td align=\"center\" colspan=2><span class=\"tabletext\">$opn_desc</td>";
    echo "<td align=\"center\" colspan=2><span class=\"tabletext\">$cnc_pgm_name</td>";
    echo "<td align=\"center\" colspan=2><span class=\"tabletext\">$est_time</td>";
	printf('</tr>');
	printf('</tr>');
	$i++;
?>
 <?php
    }

?>
</table>


</body>
</html>
