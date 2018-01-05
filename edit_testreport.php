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



$_SESSION['pagename'] = 'edit_testreport';
//////session_register('pagename');

// First include the class definition
include('classes/testreportClass.php');
include('classes/chemicalcompliClass.php');
include('classes/mechpropertiesliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newTR = new testreport;
$newCCLI = new chemicalcomp;
$newMPLI = new mechproperties;
$newdisplay = new display;

$trrecnum = $_REQUEST['trrecnum'];

//$myLI = $newLI->getcustdatali($custdatarecnum);
$result = $newTR->gettestreport($trrecnum);
$myrow = mysql_fetch_assoc($result);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/testreport.js"></script>
<html>
<head>
<title>Edit Test Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
    <form action='processtestreport.php' method='post' enctype='multipart/form-data'>
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
 <table width=100% border=0 cellspacing=4>
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
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Edit Test Report Details</b></center></td></tr>

 <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
         <tr bgcolor="#FFFFFF" >
            		<td><span class="labeltext"><p align="left">Ref. No.</p></font></td>
            		<td><span class="labeltext"><input type="text" name="refno" size=30  value="<?php echo $myrow["refno"] ?>"></td>
            		<td><span class="tabletext"><p align="left"><b>Part Number</b></p></font></td>
                    <td><span class="labeltext"><input type="text" name="partno" size=30  value="<?php echo $myrow["partno"] ?>"></td>
          </tr>
          <tr bgcolor="#FFFFFF" >
            	    <td><span class="labeltext"><p align="left">Customer</p></font></td>
            		<td><span class="labeltext"><input type="text" name="customer" size=30  value="<?php echo $myrow["customer"] ?>"></td>
                    <td><span class="labeltext"><p align="left">Part Name</p></font></td>
            		<td><span class="labeltext"><input type="text" name="partname" size=30  value="<?php echo $myrow["partname"] ?>"></td>
           </tr>
          <tr bgcolor="#FFFFFF" >
            	    <td><span class="labeltext"><p align="left">Customer Standard</p></font></td>
            		<td><span class="labeltext"><input type="text" name="cust_standard" size=30  value="<?php echo $myrow["cust_standard"] ?>"></td>
                    <td><span class="labeltext"><p align="left">RM Inv. No.</p></font></td>
            		<td><input type="text" name="rm_inv_no" size=30 value="<?php echo $myrow["rm_inv_no"] ?>">
                     </td>
            </tr>
           <tr bgcolor="#FFFFFF">
                   <td><span class="labeltext"><p align="left">Material Type</p></font></td>
            	   <td><span class="labeltext"><input type="text" name="material_type" size=30  value="<?php echo $myrow["material_type"]?>"></td>
                   <td><span class="labeltext"><p align="left">Inv. Date</td>
                   <td><span class="tabletext">
                   <input type="text" name="inv_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow["inv_date"] ?>">
                    <img src="images/bu-getdate.gif" alt="Get Due Date" onclick="GetDate('inv_date')"></td>
          </tr>
          <tr bgcolor="#FFFFFF" >
            		<td><span class="labeltext"><p align="left">Material Specification</p></font></td>
            		<td><span class="labeltext"><input type="text" name="material_spec" size=30  value="<?php echo $myrow["material_spec"]?>"></td>
            		<td><span class="labeltext"><p align="left">Date of Receipt of RM</p></font></td>
              <td><input type="text" name="rm_receipt_date"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="<?php echo $myrow["rm_receipt_date"] ?>">
                               <img src="images/bu-getdate.gif" alt="Get Due Date" onclick="GetDate('rm_receipt_date')">
                    </td>
     	  </tr>
           <tr bgcolor="#FFFFFF" >
            		<td><span class="labeltext"><p align="left">RM Supplier</p></font></td>
            		<td colspan=4><span class="labeltext"><input type="text" name="rm_supplier" size=30  value="<?php echo $myrow["rm_supplier"]?>"></td>

     	  </tr>
             <input type="hidden" name="trrecnum" value="<?php echo $trrecnum ?>">
             <input type="hidden" name="deleteflag" value="">

<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Chemical Composition Line Items</b></center></td>
</tr>
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">

<tr bgcolor="#FFFFFF"><td><a href="javascript:addRow4editchem('myTable1',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
<td colspan=4><span class="labeltext"></td></tr>

<tr bgcolor="#FFFFFF">
<table id="myTable1" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
  <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Line Num.</center></b></td>
  <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>% Chemical Composition as per Standards</center></b></td>
  <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b><center>% Chemical Composition as per RM Supplier</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Test Report by Laboratory</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Remarks</center></b></td>
</tr>
<tr>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Constituents</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Min.</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Max.</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Min.</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Max.</center></b></td>

</tr>

									                <?php
                                                          $result = $newCCLI->getLI($trrecnum);

                                                            $i=1;
                                                             while($myCCLI = mysql_fetch_row($result))
												    	 		{
																//echo "i am inside inner while loop";
																printf('<tr bgcolor="#FFFFFF">');

                                                                $lineno="cc_lineno" . $i;
																$constituents="cc_constituents" . $i;
	                                                            $standard_min="cc_standard_min" . $i;
	                                                            $standard_max="cc_standard_max" . $i;
	                                                            $supplier_min="cc_supplier_min" . $i;
	                                                            $supplier_max="cc_supplier_max" . $i;
	                                                            $report_lab="cc_report_lab" . $i;
	                                                            $remarks="cc_remarks" . $i;

																$prevlinenum="cc_prevlineno" . $i;
																$lirecnum="cc_lirecnum" . $i;
																//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
																echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$lineno\"  value=\"$myCCLI[7]\" size=\"10%\"></td>";
                                                                echo "<td><input type=\"text\" name=\"$constituents\" size=\"20%\" value=\"$myCCLI[0]\"></td>";
                                                                echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myCCLI[7]\">";
																echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myCCLI[8]\">";
																echo "<td><input type=\"text\" name=\"$standard_min\" size=\"20%\" value=\"$myCCLI[1]\"></td>";
																echo "<td><input type=\"text\" name=\"$standard_max\" size=\"20%\" value=\"$myCCLI[2]\"></td>";
																echo "<td><input type=\"text\" name=\"$supplier_min\" size=\"20%\" value=\"$myCCLI[3]\"></td>";
																echo "<td><input type=\"text\" name=\"$supplier_max\" size=\"20%\" value=\"$myCCLI[4]\"></td>";
																echo "<td><input type=\"text\" name=\"$report_lab\" size=\"20%\" value=\"$myCCLI[5]\"></td>";
																echo "<td><input type=\"text\" name=\"$remarks\" size=\"20%\" value=\"$myCCLI[6]\"></td>";
                                                                printf('</tr>');
																$i++;
															}


                                                        echo "<input type=\"hidden\" name=\"index\" value=$i>";
	                                                    echo "<input type=\"hidden\" name=\"curindex\" value=$i>";
												?>





     </table>
  <table  width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
 <tr bgcolor="#DDDEDD">
 <td colspan=4><span class="heading"><center><b>Mechanical Properties Line Items</b></center></td>
</tr>
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">
<tr bgcolor="#FFFFFF"><td><a href="javascript:addRow4editmach('myTable2',document.forms[0].mpindex.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>


<tr bgcolor="#FFFFFF">
<table id="myTable2" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
 <tr bgcolor="#FFFFFF">
  <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Line Num.</center></b></td>
  <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>% Mechanical Properties as per Standards</center></b></td>
  <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b><center>% Mechanical Properties as per RM Supplier</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Test Report by Laboratory</center></b></td>
  <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Remarks</center></b></td>
</tr>
<tr>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Constituents</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Min.</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Max.</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Min.</center></b></td>
  <td bgcolor="#EEEFEE" ><span class="heading"><b><center>Max.</center></b></td>
 </tr>

									                <?php
                                                            $result = $newMPLI->getLI($trrecnum);

                                                            $i=1;
															while ($myMPLI = mysql_fetch_row($result))
												    	 		{
																//echo "i am inside inner while loop";
																printf('<tr bgcolor="#FFFFFF">');
																$lineno="mp_lineno" . $i;
																$constituents="mp_constituents" . $i;
	                                                            $standard_min="mp_standard_min" . $i;
	                                                            $standard_max="mp_standard_max" . $i;
	                                                            $supplier_min="mp_supplier_min" . $i;
	                                                            $supplier_max="mp_supplier_max" . $i;
	                                                            $report_lab="mp_report_lab" . $i;
	                                                            $remarks="mp_remarks" . $i;


																$prevlinenum="mp_prevlineno" . $i;
																$lirecnum="mp_lirecnum" . $i;
																//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
																echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$lineno\"  value=\"$myMPLI[7]\" size=\"10%\"></td>";
																echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myMPLI[7]\">";
																echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myMPLI[8]\">";
																echo "<td><input type=\"text\" name=\"$constituents\" size=\"20%\" value=\"$myMPLI[0]\"></td>";
																echo "<td><input type=\"text\" name=\"$standard_min\" size=\"20%\" value=\"$myMPLI[1]\"></td>";
																echo "<td><input type=\"text\" name=\"$standard_max\" size=\"20%\" value=\"$myMPLI[2]\"></td>";
																echo "<td><input type=\"text\" name=\"$supplier_min\" size=\"20%\" value=\"$myMPLI[3]\"></td>";
																echo "<td><input type=\"text\" name=\"$supplier_max\" size=\"20%\" value=\"$myMPLI[4]\"></td>";
																echo "<td><input type=\"text\" name=\"$report_lab\" size=\"20%\" value=\"$myMPLI[5]\"></td>";
																echo "<td><input type=\"text\" name=\"$remarks\" size=\"20%\" value=\"$myMPLI[6]\"></td>";

																printf('</tr>');
																$i++;
															}


                                                        echo "<input type=\"hidden\" name=\"mpindex\" value=$i>";
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
