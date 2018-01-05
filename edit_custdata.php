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

$_SESSION['pagename'] = 'editcustdata';
//////session_register('pagename');

// First include the class definition
include('classes/custdataClass.php');
include('classes/custdataliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newcustdata = new custdata;
$newLI = new custdatali;
$newdisplay = new display;

$custdatarecnum = $_REQUEST['custdatarecnum'];

//$myLI = $newLI->getcustdatali($custdatarecnum);
$result = $newcustdata->getcustdata($custdatarecnum);
$myrow = mysql_fetch_assoc($result);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/custdata.js"></script>
<html>
<head>
<title>Edit customer data validation</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
    <form action='processCustdata.php' method='post' enctype='multipart/form-data'>
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
	<td width="100%"><span class="pageheading"><b>Edit Cusomer Data</b></td>
    <td colspan=20>&nbsp;</td>
	<td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
	</td>
    </table>

  <tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Edit Customer Data Validation Details</b></center></td></tr>

 <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
         <tr bgcolor="#FFFFFF">
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Number</p></font></td>
            		<td><span class="labeltext"><input type="text" name="partnum" size=30  value="<?php echo $myrow["partnum"] ?>"></td>
            		<td><span class="tabletext"><p align="left"><b><span class='asterisk'>*</span>Customer Ref No.</b></p></font></td>
                    <td><span class="labeltext"><input type="text" name="cust_ref_num" size=30  value="<?php echo $myrow["cust_ref_num"] ?>"></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            	    <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></font></td>
            		<td><span class="labeltext"><input type="text" name="partname" size=30  value="<?php echo $myrow["partname"] ?>"></td>
                    <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer Rev No.</p></font></td>
            		<td><span class="labeltext"><input type="text" name="cust_rev_num" size=30  value="<?php echo $myrow["cust_rev_num"] ?>"></td>
           </tr>
          <tr bgcolor="#FFFFFF">
            	    <td><span class="labeltext"><p align="left">Supplied Model Format</p></font></td>
            		<td><span class="labeltext"><input type="text" name="sup_mod_format" size=30  value="<?php echo $myrow["sup_mod_format"] ?>"></td>
                    <td><span class="labeltext"><p align="left">Translated To</p></font></td>
            		<td><input type="text" name="translated_to" size=30 value="<?php echo $myrow["translated_to"] ?>">

                    </td>
          </tr>

          <tr bgcolor="#FFFFFF">
                   <td><span class="labeltext"><p align="left">Approved By</p></font></td>
            	   <td><span class="labeltext"><input type="text" name="approved_by" size=30  value="<?php echo $myrow["approved_by"]?>"></td>
                   <td><span class="labeltext"><p align="left">Prepared By</td>
                   <td><span class="tabletext"><input type="text" name="prepared_by" size=30 value="<?php echo $myrow["prepared_by"] ?>"<td></td>
          </tr>
          <tr bgcolor="#FFFFFF" >
            		<td><span class="labeltext"><p align="left">Issue No</p></font></td>
            		<td><span class="labeltext"><input type="text" name="Issue" size=30  value="<?php echo $myrow["Issue"]?>"></td>
            		<td><span class="labeltext"><p align="left">Date</p></font></td>
              <td><input type="text" name="Date"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="<?php echo $myrow["Date"] ?>">
                               <img src="images/bu-getdate.gif" alt="Get Due Date" onclick="GetDate('Date')">
                    </td>
     	  </tr>
           <tr bgcolor="#FFFFFF" >
            		<td><span class="labeltext"><p align="left">Note</p></font></td>
            		<td colspan=4><span class="labeltext"><input type="text" name="note" size=30  value="<?php echo $myrow["note"]?>"></td>

     	  </tr>
             <input type="hidden" name="custdatarecnum" value="<?php echo $custdatarecnum ?>">
             <input type="hidden" name="deleteflag" value="">

<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Line Items</b></center></td>
</tr>
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">





 <tr bgcolor="#FFFFFF"><td><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
<td colspan=4 bgcolor="#FFFFFF"><span class="labeltext">To delete line items - blankout line number</td></tr>

<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
  <td bgcolor="#EEEFEE" rowspan=3><span class="heading"><b><center>Ref No.</center></b></td>
  <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>Point Co-ordinates as given</center></b></td>
  <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>Measured Co-ordinates</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=3><span class="heading"><b><center>Remarks/<br>Deviation</center></b></td>
<tr>
<tr>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>X-Value</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Y-Value</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Z-Value</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>X-Value</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Y-Value</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Z-Value</center></b></td>
</tr>

									                <?php
                                                            $result = $newLI->getcustdatali($custdatarecnum);

                                                            $i=1;
															while ($myLI = mysql_fetch_row($result))
												    	 		{
																//echo "i am inside inner while loop";
																printf('<tr bgcolor="#FFFFFF">');
																$refnum="refnum" . $i;
	                                                            $px="px" . $i;
	                                                            $py="py" . $i;
	                                                            $pz="pz" . $i;
	                                                            $mx="mx" . $i;
	                                                            $my="my" . $i;
	                                                            $mz="mz" . $i;
                                                                $remarks="remarks" . $i;

																$prevlinenum="prev_line_num" . $i;
																$lirecnum="lirecnum" . $i;
																//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
																echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$refnum\"  value=\"$myLI[0]\" size=\"10%\"></td>";
																echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[0]\">";
																echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[8]\">";
																echo "<td><input type=\"text\" name=\"$px\" size=\"20%\" value=\"$myLI[1]\"></td>";
																echo "<td><input type=\"text\" name=\"$py\" size=\"20%\" value=\"$myLI[2]\"></td>";
																echo "<td><input type=\"text\" name=\"$pz\" size=\"20%\" value=\"$myLI[3]\"></td>";
																echo "<td><input type=\"text\" name=\"$mx\" size=\"20%\" value=\"$myLI[4]\"></td>";
																echo "<td><input type=\"text\" name=\"$my\" size=\"20%\" value=\"$myLI[5]\"></td>";
																echo "<td><input type=\"text\" name=\"$mz\" size=\"20%\" value=\"$myLI[6]\"></td>";
                                                                echo "<td><input type=\"text\" name=\"$remarks\" size=\"20%\" value=\"$myLI[7]\"></td>";
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
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=100;"
                     VALUE="Reset" onclick="javascript: putfocus()">

					</FORM>
		</body>
</html>
