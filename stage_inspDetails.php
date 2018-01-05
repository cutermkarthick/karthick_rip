<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 20, 2007                 =
// Filename: qualityplanDetails.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Quality Plan Details                        =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'stage_insp_details';
//////session_register('pagename');

$stage_insprecnum = $_REQUEST['stage_insprecnum'];

include('classes/stage_insp_reportClass.php');
include('classes/stage_insp_reportliClass.php');
include('classes/displayClass.php');

$newdisplay = new display;
$newSIR = new stage_insp_report;
$newLI = new stage_insp_reportli;

$result = $newSIR->getStage_insp($stage_insprecnum);
$myrow = mysql_fetch_assoc($result);
$mySI = $newLI->getLI($stage_insprecnum);
$mySI1= $newLI->getLI($stage_insprecnum);
$mySI2 = $newLI->getLI($stage_insprecnum);

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/stage_insp.js"></script>

<html>
<head>
<title>Stage Inspection Report Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
       <tr>
          <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
          <td align="right">&nbsp;
          <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
       </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>

<?php  $newdisplay->dispLinks(''); ?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>Stage Inspection Report Details</b><td colspan=250></td>
    <td bgcolor="#FFFFFF" rowspan=2 align="right">
          <a href ="edit_stage_insp.php?stage_insprecnum=<?php echo $stage_insprecnum ?>" ><img name="Image8" border="0" src="images/bu_editstage.gif" ></a>
          <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript: printstage_insp(<?php echo $stage_insprecnum ?>)">
</td>
  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>

  <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <?php
            $d=substr($myrow['revdate'],8,2);
            $m=substr($myrow['revdate'],5,2);
            $y=substr($myrow['revdate'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";
        ?>


       <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext">CIM Reference No.</td>
            <td  bgcolor="#FFFFFF" width=25%><span class="tabletext"> <?php echo $myrow['refnum']?></td>
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext">Operation No.</td>
            <td  bgcolor="#FFFFFF" width=25%><span class="tabletext"><?php echo $myrow['opnnum']?></td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part No.</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['partnum']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Batch Quantity</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['batch_qty']?></td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part Name</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['partname']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Sheet</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['sheet']?></td>
       </tr>


      </table>

 <br>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
   <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Sl No.</center></b></td>
   <td bgcolor="#EEEFEE" rowspan=2  width=15%><span class="heading"><b><center>Nominal<br>Dimension</center></b></td>
   <td bgcolor="#EEEFEE" colspan=5><span class="heading"><b><center>Measured Dimensions</center></b></td>
</tr>
 <tr>
<?php

     $i = 1;
    while ($SI = mysql_fetch_assoc($mySI))
    {
      if($i == 1)
      {

      $slno1 = $SI['slno1'];
      $slno2 = $SI['slno2'];
      $slno3 = $SI['slno3'];
      $slno4 = $SI['slno4'];
      $slno5 = $SI['slno5'];
      echo "<td bgcolor=\"#EEEFEE\" width=15%><span class=\"heading\"><b>Sl No:&nbsp;</b> $slno1</td>";
      echo "<td bgcolor=\"#EEEFEE\" width=15%><span class=\"heading\"><b>Sl No:&nbsp;</b> $slno2</td>";
      echo "<td bgcolor=\"#EEEFEE\" width=15%><span class=\"heading\"><b>Sl No:&nbsp;</b> $slno3</td>";
      echo "<td bgcolor=\"#EEEFEE\" width=15%><span class=\"heading\"><b>Sl No:&nbsp;</b> $slno4</td>";
      echo "<td bgcolor=\"#EEEFEE\" width=15%><span class=\"heading\"><b>Sl No:&nbsp;</b> $slno5</td>";

     }
     $i++;
   }
?>
</tr>

<?php
 $i = 1;
    while ($SI = mysql_fetch_assoc($mySI1))
    {

	printf('<tr bgcolor="#FFFFFF">');
	$linenum = $SI["linenum"];
	$normal_dim = $SI["normal_dim"];
	$measured_dim1 = $SI["measured_dim1"];
    $measured_dim2 = $SI["measured_dim2"];
    $measured_dim3 = $SI["measured_dim3"];
    $measured_dim4 = $SI["measured_dim4"];
    $measured_dim5 = $SI["measured_dim5"];

	echo "<td align=\"left\"><span class=\"tabletext\">$linenum</td>";
	echo "<td align=\"left\" width=15%><span class=\"tabletext\">$normal_dim</td>";
	echo "<td align=\"left\" width=15%><span class=\"tabletext\">$measured_dim1</td>";
	echo "<td align=\"left\" width=15%><span class=\"tabletext\">$measured_dim2</td>";
    echo "<td align=\"left\" width=15%><span class=\"tabletext\">$measured_dim3</td>";
    echo "<td align=\"left\" width=15%><span class=\"tabletext\">$measured_dim4</td>";
    echo "<td align=\"left\" width=15%><span class=\"tabletext\">$measured_dim5</td>";
	printf('</tr>');

	
	$i++;
    }

?>



 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<?php

$i=1;

   while ($SI = mysql_fetch_assoc($mySI2))
   {
     if($i ==1)
     {
     
            $d=substr($SI['date1'],8,2);
            $m=substr($SI['date1'],5,2);
            $y=substr($SI['date1'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date1=date("M j, Y",$x);
            
            $d=substr($SI['date2'],8,2);
            $m=substr($SI['date2'],5,2);
            $y=substr($SI['date2'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date2=date("M j, Y",$x);
            
            $d=substr($SI['date3'],8,2);
            $m=substr($SI['date3'],5,2);
            $y=substr($SI['date3'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date3=date("M j, Y",$x);
            
            $d=substr($SI['date4'],8,2);
            $m=substr($SI['date4'],5,2);
            $y=substr($SI['date4'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date4=date("M j, Y",$x);
            
            $d=substr($SI['date5'],8,2);
            $m=substr($SI['date5'],5,2);
            $y=substr($SI['date5'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date5=date("M j, Y",$x);
?>


         <tr bgcolor="#FFFFFF">
            <td width=23% rowspan=3><span class="labeltext">Verified By:</font>
                                                           <span class="tabletext"><?php echo $SI['verified_by']?></td>
            <td width=13%><span class="labeltext"><p align="left">Inspected By:</p><span class="tabletext"><?php echo $SI['insp_by1']?></td>
            <td width=13%><span class="labeltext"><p align="left">Inspected By:</p><span class="tabletext"><?php echo $SI['insp_by2']?></td>
            <td width=13%><span class="labeltext"><p align="left">Inspected By:</p><span class="tabletext"><?php echo $SI['insp_by3']?></td>
            <td width=13%><span class="labeltext"><p align="left">Inspected By:</p><span class="tabletext"><?php echo $SI['insp_by4']?></td>
            <td width=13%><span class="labeltext"><p align="left">Inspected By:</p><span class="tabletext"><?php echo $SI['insp_by5']?></td>
        </tr>

       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Shift:</p><span class="tabletext"><?php echo $SI['shift1']?></td>
            <td><span class="labeltext"><p align="left">Shift:</p><span class="tabletext"><?php echo $SI['shift2']?></td>
            <td><span class="labeltext"><p align="left">Shift:</p><span class="tabletext"><?php echo $SI['shift3']?></td>
            <td><span class="labeltext"><p align="left">Shift:</p><span class="tabletext"><?php echo $SI['shift4']?></td>
            <td><span class="labeltext"><p align="left">Shift:</p><span class="tabletext"><?php echo $SI['shift5']?></td>
        </tr>

      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Date:</p><span class="tabletext"><?php echo $date1?></td>
            <td><span class="labeltext"><p align="left">Date:</p><span class="tabletext"><?php echo $date2?></td>
            <td><span class="labeltext"><p align="left">Date:</p><span class="tabletext"><?php echo $date3?></td>
            <td><span class="labeltext"><p align="left">Date:</p><span class="tabletext"><?php echo $date4?></td>
            <td><span class="labeltext"><p align="left">Date:</p><span class="tabletext"><?php echo $date5?></td>
       </tr>
       
<?php
   }
   $i++;
}
?>
      <tr bgcolor="#FFFFFF">
            <td colspan=7><span class="labeltext"><p align="left">Remarks:</p></font><br>
            <?php echo $myrow['remarks']?></td>
      </tr>
      <tr bgcolor="#FFFFFF">
            <td width=15% valign='middle'><span class="labeltext"><p align="left">TR No.</p></font><br></td>
            <td><span class="tabletext"><?php echo $myrow['tr_no']?></td>
            <td width=15% valign='middle'><span class="labeltext"><p align="left">Rev No.</p></font><br></td>
            <td><span class="tabletext"><?php echo $myrow['rev_no']?></td>
            <td width=15% valign='middle'><span class="labeltext"><p align="left">Rev Date.</p></font><br></td>
            <td colspan=2><span class="tabletext"><?php echo $date?></td>

      </tr>

</table>


 </td>
		<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
		</table>
      </FORM>
</table>
</body>
</html>
