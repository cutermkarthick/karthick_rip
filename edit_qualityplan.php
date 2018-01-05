<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 20, 2007                 =
// Filename: edit_quality.php                  =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Allows editing of quality plan  details     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'editqualityplan';
//////session_register('pagename');

// First include the class definition
include('classes/qualityplanClass.php');
include('classes/qualityplanliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newqualityplan = new qualityplan;
$newLI = new qualityplanli;
$newdisplay = new display;

$qualityplanrecnum = $_REQUEST['qualityplanrecnum'];

$myQI = $newLI->getQualityplanli($qualityplanrecnum);
$result = $newqualityplan->getQualityplan($qualityplanrecnum);
$myrow = mysql_fetch_assoc($result);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/qualityplan.js"></script>
<html>
<head>
<title>Edit Quality Plan</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
    <form action='processQualityplan.php' method='post' enctype='multipart/form-data'>
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
 <table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr bgcolor="DEDFDE">
	<td width="6"><img src="images/spacer.gif " width="6"></td>
 <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellspacing=4  >
	<tr><td>
 <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>Edit Quality Plan</b></td>
    <td colspan=20>&nbsp;</td>
	<td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
	</td>
    </table>

  <tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Edit Quality Plan Details</b></center></td></tr>

 <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
         <tr bgcolor="#FFFFFF" >
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Opn.Ref.No</p></font></td>
            		<td><span class="labeltext"><input type="text" name="opnrefno" size=30  value="<?php echo $myrow["opnrefno"] ?>"></td>
            		<td><span class="tabletext"><p align="left"><span class='asterisk'>*</span><b>Operation No.</b></p></font></td>
                    <td><span class="labeltext"><input type="text" name="operationnumber" size=30  value="<?php echo $myrow["operationnumber"] ?>"></td>
          </tr>
          <tr bgcolor="#FFFFFF" >
            	    <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Number</p></font></td>
            		<td><span class="labeltext"><input type="text" name="partnumber" size=30  value="<?php echo $myrow["partnumber"] ?>"></td>
                    <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Rev. No.</p></font></td>
            		<td><span class="labeltext"><input type="text" name="revnumber" size=30  value="<?php echo $myrow["revnumber"] ?>"></td>
           </tr>
          <tr bgcolor="#FFFFFF" >
            	    <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></font></td>
            		<td><span class="labeltext"><input type="text" name="partname" size=30  value="<?php echo $myrow["partname"] ?>"></td>
                    <td><span class="labeltext"><p align="left">Rev.Date</p></font></td>
            		<td><input type="text" name="revdate"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="<?php echo $myrow["revdate"] ?>">
                               <img src="images/bu-getdate.gif" alt="Get Due Date" onclick="GetDate('revdate')">
                    </td>
            </tr>
		   <tr bgcolor="#FFFFFF" >
            		<td><span class="labeltext"><p align="left">Part Type</p></font></td>
            		<td><span class="labeltext"><input type="text" name="parttype" size=30  value="<?php echo $myrow["parttype"]?>"></td>
            		<td><span class="labeltext"><p align="left">Drg Issue</p></font></td>
            		<td><span class="labeltext"><input type="text" name="drgissue" size=30  value="<?php echo $myrow["drgissue"]?>"></td>
     	  </tr>
          <tr bgcolor="#FFFFFF" >

            	   <td><span class="labeltext"><p align="left">Note</p></font></td>
            	   <td><span class="labeltext"><input type="text" name="note" size=30  value="<?php echo $myrow["note"]?>"></td>
                   <td style='vertical-align: middle'><span class="labeltext"><p align="left">Attachments</td>
                   <td><span class="tabletext"><input type="text" name="attachments" style=";background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow["attachments"] ?>"<td><input type="file" name="attachments" value="<?php echo $myrow["attachments"] ?>" src="images/bu-browse.gif"></td>
          </tr>
          <tr bgcolor="#FFFFFF" >
            		<td><span class="labeltext"><p align="left">Approved By</p></font></td>
            		<td><span class="labeltext"><input type="text" name="approvedby" size=30  value="<?php echo $myrow["approvedby"]?>"></td>
            		<td><span class="labeltext"><p align="left">Prepared By</p></font></td>
            		<td><span class="labeltext"><input type="text" name="preparedby" size=30  value="<?php echo $myrow["preparedby"]?>"></td>
     	  </tr>
          <tr bgcolor="#FFFFFF" >
            		<td><span class="labeltext"><p align="left">Issue No</p></font></td>
            		<td><span class="labeltext"><input type="text" name="issuesnumber" size=30  value="<?php echo $myrow["issuesnumber"]?>"></td>
            		<td><span class="labeltext"><p align="left">Sheet</p></font></td>
            		<td><span class="labeltext"><input type="text" name="sheet" size=30  value="<?php echo $myrow["sheet"]?>"></td>
     	  </tr>
             <input type="hidden" name="qualityplanrecnum" value="<?php echo $qualityplanrecnum ?>">
             <input type="hidden" name="deleteflag" value="">

<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Line Items</b></center></td>
</tr>
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">

<tr bgcolor="#FFFFFF"><td><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
<td colspan=4 bgcolor="#FFFFFF"><span class="labeltext">To delete line items - blankout line number</td></tr>

<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
                                    <tr>
                                                <td bgcolor="#EEEFEE"><span class="heading"><b><center>Sl.No.</center></b></td>
                                                <td bgcolor="#EEEFEE"><span class="heading"><b><center>Drawing Dimension</center></b></td>
                                                <td bgcolor="#EEEFEE"><span class="heading"><b><center>Measuring Instrument</center></b></td>
                                                <td bgcolor="#EEEFEE"><span class="heading"><b><center>Sample Size</center></b></td>
                                                <td bgcolor="#EEEFEE"><span class="heading"><b><center>Remarks</center></b></td>
                                    </tr>

									                <?php

   															$result = $newLI->getQualityplanli($qualityplanrecnum);

                                                            $i=1;
															while ($myLI = mysql_fetch_row($result))
												    	 		{
																//echo "i am inside inner while loop";
																printf('<tr bgcolor="#FFFFFF">');
																$sl_num="sl_num" . $i;
																$drawing_dim="drawing_dim" . $i;
																$measuring_istrument="measuring_istrument" . $i;
																$samplesize="samplesize" . $i;
																$remarks="remarks" . $i;
																$prevlinenum="prev_line_num" . $i;
																$lirecnum="lirecnum" . $i;
																//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
																echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$sl_num\"  value=\"$myLI[0]\" size=\"10%\"></td>";
																echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[0]\">";
																echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[6]\">";
																echo "<td><input type=\"text\" name=\"$drawing_dim\" size=\"20%\" value=\"$myLI[1]\"></td>";
																echo "<td><input type=\"text\" name=\"$measuring_istrument\" size=\"20%\" value=\"$myLI[2]\"></td>";
																echo "<td><input type=\"text\" name=\"$samplesize\" size=\"20%\" value=\"$myLI[3]\"></td>";
                                                                echo "<td><input type=\"text\" name=\"$remarks\" size=\"20%\" value=\"$myLI[4]\"></td>";
																printf('</tr>');
																$i++;
															}


                                                        echo "<input type=\"hidden\" name=\"index\" value=$i>";
	                                                    echo "<input type=\"hidden\" name=\"curindex\" value=$i>";
												?>

     </table>
  </table>
<td width="6"><img src="images/spacer.gif " width="6"></td>
		</tr>
			<tr bgcolor="DEDFDE">
				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
		</table>
			<table border = 0 cellpadding=0 cellspacing=0 width=100% >
				<tr>
					<td align=left>
						</td>
					</tr>
				</table>
                <span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" >
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=100;"
                     VALUE="Reset" onclick="javascript: putfocus()">

					</FORM>
		</body>
</html>
