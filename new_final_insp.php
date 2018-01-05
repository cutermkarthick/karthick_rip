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
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'new_final_insp';
$page = "QA: Final Insp";
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/quoteClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newpage = new page;
$newQuote = new quote;
$newdisplay = new display;
$newCustomer = new company;

if(isset($_REQUEST['quoteid']))
	$quoteid=$_REQUEST['quoteid'];
else
	$quoteid='';
if(isset($_REQUEST['quotedate']))
	$quotedate=$_REQUEST['quotedate'];
else
	$quotedate='';
if(isset($_REQUEST['company']))
	$company=$_REQUEST['company'];
else
	$company='';
if(isset($_REQUEST['companyrecnum']))
	$companyrecnum=$_REQUEST['companyrecnum'];
else
	$companyrecnum='';
if(isset($_REQUEST['desc']))
	$desc=$_REQUEST['desc'];
else
	$desc='';
if(isset($_REQUEST['delivarydate']))
	$delivarydate=$_REQUEST['delivarydate'];
else
	$delivarydate='';

if(isset($_REQUEST['terms']))
	$terms=$_REQUEST['terms'];
else
	$terms='';
if(isset($_REQUEST['rfqid']))
	$rfqid=$_REQUEST['rfqid'];
else
	$rfqid='';
if(isset($_REQUEST['quotetypeval']))
	$quotetype=$_REQUEST['quotetypeval'];
else
	$quotetype='';
if(isset($_FILE['excelfile']['name']))
	$excelfile = $_FILE['excelfile']['name'];
else
	$excelfile ='';
if(isset($_REQUEST['comments']))
	$comments=$_REQUEST['comments'];
else
	$comments='';
if(isset($_REQUEST['salesperson']))
	$salesperson=$_REQUEST['salesperson'];
else
	$salesperson='';

if(isset($_REQUEST['salespersonrecnum']))
	$salespersonrecnum=$_REQUEST['salespersonrecnum'];
else
	$salesperson='';

$lockstatus="Not Locked" ;

?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/final_insp.js"></script>


<html>
<head>
<title>New Final Inspection</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
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

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>New Final Inspection</b></td>
    </tr>


     <form action='processFinal_insp_report.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Final Inspection Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

        <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>WO No.</p></font></td>
            <td><input type="text" id="wonum" name="wonum" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/getwo.gif" alt="Get wo" onclick="Getwo_qa()">
                </td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Host Ref Num.</p></font></td>
            <td><span class="tabletext"><input type="text" id="refnum" name="refnum" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
            <td><input type="text" id="customer" name="customer" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly">
            <input type="hidden" name="custrecnum"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO No.</p></font></td>
            <td><input type="text" id="ponum" name="ponum" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly">
            <input type="hidden" name="porecnum">
             </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part No.</p></font></td>
            <td><input type="text" id="partnum" name="partnum" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly">
            </td>
            <td><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td><input type="text" id="partname" name="partname" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly"></td>

        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Bill No.</p></font></td>
            <td><input type="text" name="billnum" size=20 value=""></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Bill Date</p></font></td>
            <td><input type="text" name="billdate" size=10 value=""  style=";background-color:#DDDDDD;" readonly="readonly"><img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('billdate')"></td>
        </tr>
        
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Issue</p></font></td>
            <td><input type="text" name="issue" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">Report No.</p></font></td>
            <td><input type="text" name="reportnum" size=20 value=""></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Page.</p></font></td>
            <td><input type="text" name="page" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">Qty.</p></font></td>
            <td><span class="tabletext"><input type="text" name="qty" size=20 value=""></td>
        </tr>

<input type="hidden" name="action" value="new">
<?php
 //echo "quotetype:$quotetype";
//$wotype="test2";
// $ctrls=$newpage->createjs4quote("Quote",$quotetype) ;
 //$ctrls=$newpage->createctrls("Quote",$quotetype) ;
//echo "$ctrls";
?>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Final Inspection Line Items</b></center></td>
</tr>

<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<tr bgcolor="#FFFFFF">


<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
   <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Sl No.</center></b></td>
   <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>DRG Sheet</center></b></td>
   <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>DIM Map</center></b></td>
   <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Dimensions <br>Main View</center></b></td>
   <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>Actual Dimensions</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Accept/</center></b></td>
</tr>
<tr>
   <td bgcolor="#EEEFEE"><span class="heading"><b><span class='asterisk'>*</span>Sl No:&nbsp;</b><input type="text" id="slnum1" name="slnum1" size=8 value=""></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b>Sl No:&nbsp;</b><input type="text" name="slnum2" size=8 value=""></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b>Sl No:&nbsp;</b><input type="text" name="slnum3" size=8 value=""></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Reject</center></b></td>
</tr>

<?php

      $i=1;
      while ($i<=5)
     {
	printf('<tr bgcolor="#FFFFFF">');
	$slno="slno" . $i;
	$sheet="sheet" . $i;
	$map="map" . $i;
	$main_view="main_view" . $i;
	$actual_dim1="actual_dim1" . $i;
	$actual_dim2="actual_dim2" . $i;
	$actual_dim3="actual_dim3" . $i;
	$accpt_reject="accpt_reject" . $i;

	echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$slno\"  value=\"\" size=\"10\"></td>";
	echo "<td><input type=\"text\" name=\"$sheet\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$map\" size=\"15\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$main_view\" size=\"10\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$actual_dim1\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$actual_dim2\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$actual_dim3\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$accpt_reject\" size=\"10\" value=\"\"></td>";
	printf('</tr>');
	$i++;
    }
echo "<input type=\"hidden\" name=\"index\" value=$i>";

?>

        </table>
	</td>
    </tr>

     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >

         <tr bgcolor="#FFFFFF">
            <td align=centre width=46%><span class="labeltext"><p align="centre">Inspected By:</p></font></td>
            <td width=14%><span class="labeltext"><input type="text" name="insp_by1" size=15></td>
            <td width=14%><span class="labeltext"><input type="text" name="insp_by2" size=15></td>
            <td><span class="labeltext"><input type="text" name="insp_by3" size=15></td>
        </tr>

       <tr bgcolor="#FFFFFF">
            <td align=centre><span class="labeltext"><p align="centre">Inspected Date:</p></font></td>
            <td nowrap><span class="labeltext"><input type="text" name="insp_date1" size=15>
                                         <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('insp_date1')"></td>
            <td nowrap><span class="labeltext"><input type="text" name="insp_date2" size=15>
                                         <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('insp_date2')"></td>
            <td nowrap><span class="labeltext"><input type="text" name="insp_date3" size=15>
                                         <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('insp_date3')"></td>
       </tr>
       <tr bgcolor="#FFFFFF">
           <td align=centre><span class="labeltext"><p align="centre">Approved By:</p></td>
           <td colspan=3><span class="labeltext"><input type="text" name="approved_by" size=15></td>
      </tr>
      <tr bgcolor="#FFFFFF">
            <td align=centre><span class="labeltext"><p align="centre">Approved Date:</p></td>
            <td colspan=3><span class="labeltext"><input type="text" name="approved_date" size=15>
                          <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('approved_date')"></td>
      </tr>

</table>

</td>
		<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->

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
