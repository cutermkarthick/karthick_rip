<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: new_invoice.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new invoice                 =
//==============================================

session_start();
header("Cache-control: private");
/*
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
*/
$_SESSION['pagename'] = 'appendixcedit';
//////session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/appendixcClass.php');
include('classes/displayClass.php');
$newappendixc = new appendixc;
$newdisplay = new display;
$apprecnum= $_REQUEST['appendixcrecnum'];
//echo $apprecnum;
$result4app= $newappendixc->getappendixcdetails($apprecnum);
$myappendix=mysql_fetch_assoc($result4app);
$resultadd =$newappendixc->customeraddress($apprecnum);
$myrow1= mysql_fetch_assoc($resultadd);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/excise.js"></script>

<html>
<head>
<title>APPENDIX-C Edit</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='appendixcProcess.php' method='post' enctype='multipart/form-data'>
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
       				<a href="exit.php" onMouseOut="MM_swapImgRestore()"
                       onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        		</tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
				<td>
				<?php
   				     $newdisplay->dispLinks('');
				?>
		<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr bgcolor="DEDFDE">
	<td width="6"><img src="images/spacer.gif " width="6"></td>
 <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellspacing=4 >
	<tr><td>
 <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>APPENDIX-C Edit</b></td>
    </table>
  <tr>
<td>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
 <tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>
         <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

         <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">DC NO:</p></font></td>
          <td><span class="tabletext"><p align="left"><b>DC Date</b></p></font></td>
             	</tr>
     			 <tr bgcolor="#FFFFFF">

            		<td><span class="tabletext"><p align="left"><b>Shipping Bill No:</b></p></font></td>
                       <td><span class="tabletext"><p align="left"><b>Shipping Date</b></p></font></td>
                   	</tr>

                  <tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left">1.Name of EOU:</font></td>
            <td><span class="tabletext"><b>CIM Tools Pvt. Ltd.</b></td>
            </tr>
            <tr bgcolor="#FFFFFF">
		<td><span class="labeltext"><p align="left">2.IEC No.(of the EOU):</font></td>
            <td><span class="tabletext"><b>0797004271</b></td>

            </tr>
            <tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">3.Factory Address:</font></td>
    <td ><span class="tabletext"><b>#467-469, 4th Phase, Peenya Industrial Area</b></td>

<tr bgcolor="#FFFFFF">

    <td colspan=1></td><td ><span class="labeltext">Bangalore - 560058, INDIA.</font></td>
            </tr>
     			 <tr bgcolor="#FFFFFF">
                 	<td><span class="labeltext"><p align="left">4.Date of Examination:</p></font></td>
            		<td colspan=3>
                    </td>
                   </tr>
                    <tr bgcolor="#FFFFFF">
            		<td><span class="labeltext"><p align="left">5.Name and designation of the examining<br>Officer-Inspector/EO/PO:</p></font></td>
              <td colspan=3>
                  </tr>
                  <tr bgcolor="#FFFFFF" colspan=3>
            	    <td><span class="labeltext"><p align="left">6.Name and designation of the supervision<br>Officer-Appraiser/Superintendent:</p></font></td>
            		<td colspan=3></td>
                    </td>
                  </tr>
                  <tr bgcolor="#FFFFFF" colspan=3>
            	    <td><span class="labeltext"><p align="left">7.(a)Name of Commissionerate/Division/Range:</p></font></td>
            		<td colspan=3></td>
                    </td>
                  </tr>
                     <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left"> &nbsp;&nbsp;&nbsp;(b)Location Code:</p></font></td>
            		<td colspan=3></td>
                    </td>
                  </tr>
                 <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left">8. Particulars of Export Invoice</p></font></td>
            		<td colspan=3></td>
                    </td>
                  </tr>
                     <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left"> &nbsp;&nbsp;&nbsp;(a)Export Invoice No.:</p></font></td>
            		<td colspan=3><input type="text" name="expinvnum"  id="expinvnum"
                               size=40 value="<?php echo $myappendix["exportinvnum"]?>"></td>
                    </td>
                  </tr>
                     <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left"> &nbsp;&nbsp;&nbsp;(b)Total No. of packages:</p></font></td>
            		<td colspan=3><input type="text" name="totnumpkgs"  id="totnumpkgs"
                               size=15 value="<?php echo $myappendix["totnumpkgs"]?>"></td>
                    </td>
                  </tr>
                     <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left"> &nbsp;&nbsp;&nbsp;(c)Name and address of the consignee abroad:</p></font></td>
            		<td colspan=3><input type="text" name="company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value="<?php echo $myrow1["name"]?>"> <img src="images/bu-getcustomer.gif" alt="Get Customer"
                    onclick="GetAllCustomers()">  </td>
                    <input type="hidden" name="companyrecnum" id ="companyrecnum" value="<?php echo $myappendix["link2customer"]?>">
                    <input type="hidden" name="create_date" id ="create_date" value="<?php echo $myappendix["create_date"]?>">
                    <input type="hidden" name="appendixcrecnum" id ="appendixcrecnum" value="<?php echo $apprecnum ?>">
                    </td>
                    </td>
                  </tr>
                    <tr  bgcolor="#FFFFFF">
                    <td colspan=1></td>
                          <td id="ba1" ><span class="tabletext"><?php echo $myrow1["baddr1"] . "," . $myrow1["baddr2"]?></td>
                      </tr>
                      <tr  bgcolor="#FFFFFF">
                      <td colspan=1></td>
                          <td id="ba2"><span class="tabletext"><?php echo $myrow1["bcity"] . "," . $myrow1["bstate"] . "," . $myrow1["bzipcode"] ?></td>

                      </tr>
                      <tr  bgcolor="#FFFFFF">
                      <td colspan=1></td>
                          <td id="ba3"><span class="tabletext"><?php echo $myrow1["bcountry"]?></td>
                     </tr>
                     <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left">9.(a) Is the description of the goods,the Quantity and their value as:</p></font></td>
            		<td colspan=3><span class="labeltext">Yes/NO</span></td>
                    </td>
                  </tr>
                     <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left"> &nbsp;&nbsp;&nbsp;(b)Whether sample is drawn for being forwarded to port of export:</p></font></td>
            		<td colspan=3><span class="labeltext">Yes/NO</span></td>
                    </td>
                  </tr>
                   <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left">10.(a) For Non-containerized cargo</p></font></td>
            		<td colspan=3></td>
                    </td>
                  </tr>
                     <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left">Nos. of packages</p></font></td>
            		<td colspan=3><span class="labeltext">Seal Nos</span></td>
                    </td>
                  </tr>
                  <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left">&nbsp;&nbsp;&nbsp;(b) For Containerized cargo</p></font></td>
            		<td colspan=3></td>
                    </td>
                  </tr>
                  </table>
                  <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
                     <tr bgcolor="#FFFFFF">
                    <td width=25%><span class="labeltext">Container No.</span></td>
            		<td width=25%><span class="labeltext">Size</span></td>
            		<td width=25%><span class="labeltext">Seal No.</span></td>
                    </td>
                  </tr>
                   <tr bgcolor="#FFFFFF">
                    <td width=25%><span class="labeltext">Signature of Exporter</span></td>
            		<td width=25%><span class="labeltext">Signature of Examiner/Inspector</span></td>
            		<td width=25%><span class="labeltext">Signature of Appraiser/Superintendent</span></td>
                    </td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                 	<td><span class="labeltext"><p align="left">Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________</p></font></td>
                    <td><span class="labeltext"><p align="left">Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________</p></font></td>
                    <td><span class="labeltext"><p align="left">Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________</p></font></td>
                   </tr>
                    <tr bgcolor="#FFFFFF">
            		<td><span class="labeltext"><p align="left">Designation:______________________</p></font></td>
                   <td><span class="labeltext"><p align="left">Designation:______________________</p></font></td>
                   <td><span class="labeltext"><p align="left">Designation:______________________</p></font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF" colspan=3>
            	    <td><span class="labeltext"><p align="left">Stamp:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________</p></font></td>
            		<td><span class="labeltext"><p align="left">Stamp:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________</p></font></td>
            		<td><span class="labeltext"><p align="left">Stamp:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________</p></font></td>
                    </td>
                  </tr>
                   <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left">Note:</p></font></td>
            		<td colspan=3></td>
                    </td>
                  </tr>
                  </table>
                    <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
                   <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left">1.The office supervising the examination should attest Invoice(s) and any other document accompanying this </p></font></td>

                    </td>
                  </tr>
                     <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left"> 2.* To be filled in by the exporter before filling this documnet at the time goods registration in the export shed.</p></font></td>

                    </td>
                  </tr>
                   <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left">3.* Revised 6 digit code as assigned by the directorate of S & I,XXYYZZ</p></font></td>

                    </td>
                  </tr>
                  <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left">Commissionerate </p></font></td>

                    </td>
                  </tr>
                     <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left"> Division</p></font></td>

                    </td>
                  </tr>
                   <tr bgcolor="#FFFFFF" colspan=3>
                    <td><span class="labeltext"><p align="left">Range</p></font></td>

                    </td>
                  </tr>
        </table>
</table>
  </td>
 <td width="6"><img src="images/spacer.gif " width="6"></td>
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
</body>
</html>
