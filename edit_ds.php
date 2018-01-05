<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: edit_master.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// editing master sheets                       =
//                                             =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'edit_ds';
//////session_register('pagename');

if ( !isset ( $_REQUEST['dsrecnum']) )
{
//echo "i am not set in podetails";
   header ( "Location: login.php" );

}
$dsrecnum = $_REQUEST['dsrecnum'];
$_SESSION['dsrecnum'] = $dsrecnum;
//////session_register('dsrecnum');



include('classes/dataClass.php');
include('classes/dataliClass.php');
include('classes/displayClass.php');

$newdisplay = new display;
$newLI = new datasheet_line_items;
$newDT = new data;

$result = $newDT->getdatadetails($dsrecnum);
$myrow = mysql_fetch_assoc($result);




?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/datasheet.js"></script>
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>Edit Data Sheet</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
	<form action='processds.php? method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
	                 <tr>
 	        				<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid;?></b></td>
        					<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
       				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0>
			<tr><td></td></tr>
			<tr>
				<td>
				<?php $newdisplay->dispLinks(''); ?>
     		<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
										       <table width=100% border=0>
											<tr>
												<td><span class="pageheading"><b>Data Sheet Details</b></td>
                                                 <td>&nbsp;</td>
                                                  <td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
												</td>
    											</tr>
										      </table>
										</td></tr>

										<tr>
											<td>
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
												         <tr bgcolor="#FFFFFF">

  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
     <form>
            <td  bgcolor="#F5F6F5" width=100%><span class="heading"><center><b>General Information</b></center></td>

       </tr>
        <tr bgcolor="#FFFFFF">
  <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

       <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=25% colspan=4>&nbsp;</td>

       </tr>

       <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext">Opn Ref No.</td>
            <td  bgcolor="#FFFFFF" width=25%><span class="tabletext"><input type="text" name="opnrefnum" size="20" value="<?php echo $myrow['opn_ref_no'] ?>" > </td>
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext">Drg Issue</td>
            <td  bgcolor="#FFFFFF" width=25%><span class="tabletext"><input type="text" name="drgissue"  size="20"  bgcolor="#DFDEDF" value="<?php echo $myrow['drg_issue'] ?>">
                                                            </td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Work Centre</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" size="20" name="workcentre" value="<?php echo $myrow['work_center'] ?>"></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Opn No.</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" size="20" name="opnnum" value="<?php echo $myrow['opnnum'] ?>"></td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part Number</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" size="20" name="partnum" value="<?php echo $myrow['partnum'] ?>"></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Attachments</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="attachments" style=";background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow["attachments"] ?>"<td><input type="file" name="attachments" value="<?php echo $myrow["attachments"] ?>" src="images/bu-browse.gif"></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Rev No.</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" size="20" name="revnum" value="<?php echo $myrow['revnum'] ?>"></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part Name</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" size="20" name="partname" value="<?php echo $myrow['partname'] ?>"></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part type</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" size="20" name="parttype" value="<?php echo $myrow['parttype'] ?>"></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Rev Date</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" size="20" name="revdate" readonly="readonly" style=";background-color:#DDDDDD;" value="<?php echo $myrow['revdate'] ?>">
                                                         <img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('revdate')"></td>
       </tr>
       <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Prepared By</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="preparedby" size="20" value="<?php echo $myrow['prepared_by'] ?>"></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Approved By</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="approvedby" size="20" value="<?php echo $myrow['approved_by'] ?>"></td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Issue Num</td>
            <td  bgcolor="#FFFFFF" colspan=3><span class="tabletext"><input type="text" name="issuenum" size="20" value="<?php echo $myrow['issuenum'] ?>"</td>

             <input type="hidden" name="link2ds" value="<?php echo $dsrecnum ?>">
             <input type="hidden" name="deleteflag" value="">
      </table>

 <br>

<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

      <tr bgcolor="#DDDEDD">
        <td colspan=12><span class="heading"><center><b>Data Sheet Line Items</b></center></td>
       </tr>
         <input type="hidden" name="caserecnum" value="<?php /* echo $caserecnum */?>">
       <tr bgcolor="#FFFFFF"><td colspan=8><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>

       <tr>

            <td bgcolor="#EEEFEE" ><span class="heading"><b>Line No.</b></td>
            <td bgcolor="#EEEFEE" ><span class="heading"><b>Tool Details</b></td>
            <td bgcolor="#EEEFEE" ><span class="heading"><b>Tool Length</b></td>
            <td bgcolor="#EEEFEE" ><span class="heading"><b>Speed</b></td>
            <td bgcolor="#EEEFEE" ><span class="heading"><b>Feed</b></td>
            <td bgcolor="#EEEFEE" ><span class="heading"><b>Open Desc</b></td>
            <td bgcolor="#EEEFEE" ><span class="heading"><b>CNC Pgm Name</b></td>
            <td bgcolor="#EEEFEE" ><span class="heading"><b>Est Time</b></td>


       </tr>

	<?php
	
	                          $result = $newLI->getLI($dsrecnum);

	


												      $i=1;
              											      while ($myLI = mysql_fetch_assoc($result))
												      {
													  printf('<tr bgcolor="#FFFFFF">');
													  $linenum="linenum" . $i;
													  $tool_details="tool_details" . $i;
													  $tool_length="tool_length" . $i;
													  $speed="speed" . $i;
													  $feed="feed" . $i;
													  $opn_desc="opn_desc" . $i;
													  $cnc_pgm_name="cnc_pgm_name" . $i;
													  $est_time="est_time" . $i;
													  

													 $prevlinenum="prev_line_num" . $i;
													 $lirecnum="lirecnum" . $i;

                                                      echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[linenum]\">";
													  echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[recnum]\">";
													  echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenum\"  value=\"$myLI[linenum]\" size=\"15\"></td>";
													  echo "<td ><input type=\"text\" name=\"$tool_details\" size=\"15\" value=\"$myLI[tool_details]\"></td>";
													  echo "<td ><input type=\"text\" name=\"$tool_length\" size=\"15\" value=\"$myLI[tool_length]\"></td>";
                                                      echo "<td ><input type=\"text\" name=\"$speed\" size=\"15\" value=\"$myLI[speed]\"></td>";
                                                      echo "<td ><input type=\"text\" name=\"$feed\" size=\"15\" value=\"$myLI[feed]\">";
                                                      echo "<td ><input type=\"text\" name=\"$opn_desc\" size=\"15\" value=\"$myLI[opn_desc]\"></td>";
                                                      echo "<td><input type=\"text\" name=\"$cnc_pgm_name\" size=\"15\" value=\"$myLI[cnc_pgm_name]\"></td>";
                                                      echo "<td><input type=\"text\" name=\"$est_time\" size=\"15\" value=\"$myLI[est_time]\"></td>";

													  printf('</tr>');
													  $i++;
												      }
												      echo "<input type=\"hidden\" name=\"index\" value=$i>";
                                                       echo "<input type=\"hidden\" name=\"curindex\" value=$i>";

                                            	?>


		   	</table>


 											</td>
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
						<table border = 0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left>

								</td>
							</tr>
						</table>

						<span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields1()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
					</FORM>
		</body>
</html>
