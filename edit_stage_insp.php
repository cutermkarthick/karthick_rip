<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: quoteDetailsEntry.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new quotes                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'edit_stage_insp';
//////session_register('pagename');


// First include the class definition
include('classes/userClass.php');
include('classes/stage_insp_reportClass.php');
include('classes/stage_insp_reportliClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newSIR = new stage_insp_report;
$newLI = new stage_insp_reportli;

$stage_insprecnum = $_REQUEST['stage_insprecnum'];

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
<title>Edit Stage Inspection</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        					<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right">&nbsp;
       					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td>
        <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>Edit Stage Inspection</b></td>
    <td colspan=20>&nbsp;</td>
	<td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
	</td>
    </table>
        </td>
    </tr>


     <form action='processStage_insp_report.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Stage Inspection Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Host Reference No.</p></font></td>
            <td><span class="tabletext"><input type="text" name="refnum" size=20 value="<?php echo $myrow['refnum']?>"></td>
            <td><span class="labeltext"><p align="left">Operation No.</p></font></td>
            <td><input type="text" name="opnnum" size=20 value="<?php echo $myrow['opnnum']?>">
            <input type="hidden" name="stage_insprecnum" value="<?php echo $stage_insprecnum ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part No.</p></font></td>
            <td><input type="text" name="partnum" size=20 value="<?php echo $myrow['partnum']?>"></td>
            <td><span class="labeltext"><p align="left">Batch Quantity</p></font></td>
            <td><input type="text" name="batch_qty" size=20 value="<?php echo $myrow['batch_qty']?>">
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td><input type="text" name="partname" size=20 value="<?php echo $myrow['partname']?>"></td>
            <td><span class="labeltext"><p align="left">Sheet</p></font></td>
            <td><input type="text" name="sheet" size=20 value="<?php echo $myrow['sheet']?>"></td>
        </tr>

  <input type="hidden" name="deleteflag" value="">
<input type="hidden" name="action" value="edit">
<?php
 //echo "quotetype:$quotetype";
//$wotype="test2";
// $ctrls=$newpage->createjs4quote("Quote",$quotetype) ;
 //$ctrls=$newpage->createctrls("Quote",$quotetype) ;
//echo "$ctrls";
?>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Stage Inspection Line Items</b></center></td>
</tr>

<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<tr bgcolor="#FFFFFF">


<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
   <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Sl No.</center></b></td>
   <td bgcolor="#EEEFEE" rowspan=2 width=10%><span class="heading"><b><center>Nominal<br>Dimension</center></b></td>
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
        echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>Sl No.</center></b><input type=\"text\" name=\"slno1\" size=10 value=\"$slno1\"></td>";
        echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>Sl No.</center></b><input type=\"text\" name=\"slno2\" size=10 value=\"$slno2\"></td>";
        echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>Sl No.</center></b><input type=\"tex\" name=\"slno3\" size=10 value=\"$slno3\"></td>";
        echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>Sl No.</center></b><input type=\"text\" name=\"slno4\" size=10 value=\"$slno4\"></td>";
        echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>Sl No.</center></b><input type=\"text\" name=\"slno5\" size=10 value=\"$slno5\"></td>";
      }
     $i++;
  }
?>

</tr>

<?php

      $i=1;
     while ($SI = mysql_fetch_assoc($mySI1))
    {
    $recnum = $SI['recnum'];
    $line = $SI["linenum"];
	$nd = $SI["normal_dim"];
	$md1 = $SI["measured_dim1"];
    $md2 = $SI["measured_dim2"];
    $md3 = $SI["measured_dim3"];
    $md4 = $SI["measured_dim4"];
    $md5 = $SI["measured_dim5"];

	printf('<tr bgcolor="#FFFFFF">');
	$linenum="linenum" . $i;
	$nominal_dim="nominal_dim" . $i;
	$measured_dim1="measured_dim1" . $i;
	$measured_dim2="measured_dim2" . $i;
	$measured_dim3="measured_dim3" . $i;
	$measured_dim4="measured_dim4" . $i;
	$measured_dim5="measured_dim5" . $i;
	$prevlinenum="prev_line_num" . $i;
	$lirecnum="lirecnum" . $i;

    echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$line\">";
    echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$recnum\">";
	echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$linenum\"  value=\"$line\" size=\"10\"></td>";
	echo "<td><input type=\"text\" name=\"$nominal_dim\" size=\"20\" value=\"$nd\"></td>";
    echo "<td><input type=\"text\" name=\"$measured_dim1\" size=\"10\" value=\"$md1\"></td>";
	echo "<td><input type=\"text\" name=\"$measured_dim2\" size=\"10\" value=\"$md2\"></td>";
	echo "<td><input type=\"text\" name=\"$measured_dim3\" size=\"10\" value=\"$md3\"></td>";
    echo "<td><input type=\"text\" name=\"$measured_dim4\" size=\"10\" value=\"$md4\"></td>";
    echo "<td><input type=\"text\" name=\"$measured_dim5\" size=\"10\" value=\"$md5\"></td>";
	printf('</tr>');
	$i++;
    }
echo "<input type=\"hidden\" name=\"index\" value=$i>";

?>

        </table>
	</td>
    </tr>

     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<?php

$i=1;

   while ($SI = mysql_fetch_assoc($mySI2))
   {
     if($i ==1)
     {

?>

         <tr bgcolor="#FFFFFF">
            <td colspan=2 rowspan=3><span class="labeltext"><p align="left">Verified By</p></font>
                                                            <input type="text" name="verified_by" size=20 value="<?php echo $SI['verified_by']?>"></td>
            <td width=13%><span class="labeltext"><p align="left">Inspected By:</p><input type="text" name="insp_by1" size=15 value="<?php echo $SI['insp_by1']?>"></td>
            <td width=10%><span class="labeltext"><p align="left">Inspected By:</p><input type="text" name="insp_by2" size=15 value="<?php echo $SI['insp_by2']?>"></td>
            <td width=13%><span class="labeltext"><p align="left">Inspected By:</p><input type="text" name="insp_by3" size=15 value="<?php echo $SI['insp_by3']?>"></td>
            <td width=15%><span class="labeltext"><p align="left">Inspected By:</p><input type="text" name="insp_by4" size=15 value="<?php echo $SI['insp_by4']?>"></td>
            <td width=15%><span class="labeltext"><p align="left">Inspected By:</p><input type="text" name="insp_by5" size=15 value="<?php echo $SI['insp_by5']?>"></td>
        </tr>

       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Shift:</p><input type="text" name="shift1" size=15 value="<?php echo $SI['shift1']?>"></td>
            <td><span class="labeltext"><p align="left">Shift:</p><input type="text" name="shift2" size=15 value="<?php echo $SI['shift2']?>"></td>
            <td><span class="labeltext"><p align="left">Shift:</p><input type="text" name="shift3" size=15 value="<?php echo $SI['shift3']?>"></td>
            <td><span class="labeltext"><p align="left">Shift:</p><input type="text" name="shift4" size=15 value="<?php echo $SI['shift4']?>"></td>
            <td><span class="labeltext"><p align="left">Shift:</p><input type="text" name="shift5" size=15 value="<?php echo $SI['shift5']?>"></td>
        </tr>

      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Date:</p><input type="text" name="date1" size=15 value="<?php echo $SI['date1']?>">
                                                                 <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('date1')"></td>
            <td><span class="labeltext"><p align="left">Date:</p><input type="text" name="date2" size=15 value="<?php echo $SI['date2']?>">
                                                                 <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('date2')"></td>
            <td><span class="labeltext"><p align="left">Date:</p><input type="text" name="date3" size=15 value="<?php echo $SI['date3']?>">
                                                                 <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('date3')"></td>
            <td><span class="labeltext"><p align="left">Date:</p><input type="text" name="date4" size=15 value="<?php echo $SI['date4']?>">
                                                                 <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('date4')"></td>
            <td><span class="labeltext"><p align="left">Date:</p><input type="text" name="date5" size=15 value="<?php echo $SI['date5']?>">
                                                                 <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('date5')"></td>
       </tr>

<?php
   }
   $i++;
}
?>
      <tr bgcolor="#FFFFFF">
            <td colspan=7><span class="labeltext"><p align="left">Remarks:</p></font><br>
            <textarea name="remarks" rows=5 cols=50 value="<?php echo $myrow['remarks']?>"></textarea></td>
      </tr>
      <tr bgcolor="#FFFFFF">
            <td width=15% valign='middle'><span class="labeltext"><p align="left">TR No.</p></font><br></td>
            <td><input type="text" name="tr_no" size=20 value="<?php echo $myrow['tr_no']?>"></td>
            <td width=15% valign='middle'><span class="labeltext"><p align="left">Rev No.</p></font><br></td>
            <td><input type="text" name="rev_no" value="<?php echo $myrow['rev_no']?>"></td>
            <td width=15% valign='middle'><span class="labeltext"><p align="left">Rev Date.</p></font><br></td>
            <td colspan=2><input type="text" name="revdate" value="<?php echo $myrow['revdate']?>">
                          <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('revdate')"></td>

      </tr>


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
<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">

      </FORM>
</table>
</body>
</html>
