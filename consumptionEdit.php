<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Apr 23, 2012                 =
// Filename: consumptionEdit.php               =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Edit stock consumption                      =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'consumptionedit';
//////session_register('pagename');
$grnnum=$_REQUEST['recnum'];
//echo $grnnum."---------";
// First include the class definition
include_once('classes/userClass.php');
include_once('classes/reportClass.php');
include_once('classes/displayClass.php');
include_once('classes/consumptionClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newreport = new report;
$newconsumption = new consumption;
$newdisplay = new display;

$close_bal=0; $qty_recd=0;$qty_cons=0;$wastage=0;

$result = $newconsumption->getgrndets4edit($grnnum);
$myrow = mysql_fetch_row($result);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>

<html>
<head>
<title>Stock Consumption Edit</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='consumptionProcess.php' method='post' enctype='multipart/form-data'>
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
	<td width="100%"><span class="pageheading"><b>Stock Consumption Edit</b></td>
    </table>
  <tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
 <tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>
       <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

               	<tr bgcolor="#FFFFFF" colspan=3>

              <td><span class="labeltext"><p align="left"><b>BOND #</p></font></td>
      		<td><input type="text" name="bond_num"  id="bond_num"
        size=20 value="<?php echo $myrow[15] ?>" >
                </td>
                <td><span class="labeltext"><p align="left"><b>BE #</p></font></td>
            		<td><input type="text" name="be_num"  id="be_num"
                               size=20 value="<?php echo $myrow[16] ?>">
                    </td>
                  </tr>

                <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Invoice #</p></font></td>
          <td width= 20%><input type="text" name="invnum" id="invnum" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[1] ?>">
                   <input type="hidden" name="create_date" id="create_date" value="<?php echo $myrow[8] ?>"></td>
                   <input type="hidden" name="pagename" id="pagename" value="editconsreg"></td>
             <td width= 20%><span class="labeltext"><p align="left"><b>Invoice Date</p></font></td>
      		<td><input type="text" name="invdate"  id="invdate"  style="background-color:#DDDDDD;"
                               readonly="readonly" size=20 value="<?php echo $myrow[13] ?>" >
                               <input type="hidden" name="recnum"  id="recnum"  style="background-color:#DDDDDD;"
                               readonly="readonly" size=20 value="<?php echo $myrow[0] ?>" >
                </td>
                </tr>
                     <tr bgcolor="#FFFFFF">
              <td width= 16% ><span class="labeltext"><p align="left"><b>GRN #</p></font></td>
            		<td ><span class="labeltext"><input type="text" name="grnnum" id="grnnum" size=20 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow[2] ?>"></td>
                    <td><span class="tabletext"><p align="left"><b>GRN Date</b></p></font></td>
                    <td><input type="text" name="grndate"  id="grndate" size=20 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow[3] ?>"> </td>
     			</tr>
                   <tr bgcolor="#FFFFFF">
                   <td ><span class="labeltext"><p align="left"><b>PRN #</p></font></td>
            		<td ><span class="labeltext"><input type="text" name="crnnum" id="crnnum" size=20 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow[10] ?>"></td>
                    <td ><span class="tabletext"><p align="left"><b>UOM</b></p></font></td>
                    <td width=20%><span class="labeltext"><input type="text" name="uom" id="uom" size=20 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow[20] ?>"></td>

                   </tr>
                   
                   	</tr>
                   <tr bgcolor="#FFFFFF">
                   <td ><span class="labeltext"><p align="left"><b>Description</p></font></td>
            		<td width= 20%><span class="labeltext"><input type="text" name="descr" id="descr" size=20 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo wordwrap($myrow[5],"40","<br>",true) ?>"></td>
                    <td ><span class="tabletext"><p align="left"><b>RM Type</b></p></font></td>
                    <td width=20%><span class="labeltext"><input type="text" name="rmtype" id="rmtype" size=40 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo wordwrap($myrow[19],"40","<br>",true)  ?>"></td>

                   </tr>

                   <tr bgcolor="#FFFFFF">
            		<td width= 16% ><span class="labeltext"><p align="left"><b>Qty Received</p></font></td>
            		<td ><span class="labeltext"><input type="text" name="qtyrecd" id="qtyrecd" size=20 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow[6] ?>"></td>
                      <td ><span class="tabletext"><p align="left"><b>Invoice Amount</b></p></font></td>
                    <td width=20%><span class="labeltext"><input type="text" name="invamt" id="invamt" size=20  value="<?php echo $myrow[26] ?>">
                     <span class="tabletext">
		<select name="currency" id="currency"  width=2>
		            <?
		            $currency=array('USD','GBP');
					for($j=0;$j<count($currency);$j++){

					if($currency[$j] == $myrow[28]){?>
					<option selected value="<? echo $currency[$j]?>"><?echo $currency[$j]; ?>
					</option>
					<?}
					else{?>
                    <option value="<? echo $currency[$j]?>"><?echo $currency[$j]; ?>
					</option>
					<?}
					}?></td>

     			</tr>
     			
  			   <tr bgcolor="#FFFFFF">
            		<td width= 16% ><span class="labeltext"><p align="left"><b>COFC #</p></font></td>
            		<td ><span class="labeltext"><input type="text" name="cofcnum" id="cofcnum" size=20 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow[14] ?>"></td>
                                <td><span class="tabletext"><p align="left"><b>COFC Qty</b></p></font></td>
                    <td><input type="text" name="qtyused"  id="qtyused" size=20 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow[7] ?>"> </td>
     			</tr>
     			
     			<tr bgcolor="#FFFFFF">
                    <td width= 16% ><span class="labeltext"><p align="left"><b>QTY</p></font></td>
            		<td ><span class="labeltext"><input type="text" name="qty" id="qty" size=20 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow[27] ?>"></td>
                    <td width= 16% ><span class="labeltext"><p align="left"><b>QTY Rej</p></font></td>
            		<td ><span class="labeltext"><input type="text" name="qty_rej" id="qty_rej" size=20 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow[29] ?>"></td>
     			</tr>
     			

     			<tr bgcolor="#FFFFFF">
                    <td width= 16% ><span class="labeltext"><p align="left"><b>Company</p></font></td>
            		<td ><span class="labeltext"><input type="text" name="company" id="company" size=20 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow[18] ?>"></td>
              <td width= 16% ><span class="labeltext"><p align="left"><b>Export Invoice #</p></font></td>
            		<td ><span class="labeltext"><input type="text" name="expinvnum" id="expinvnum" size=20 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow[31] ?>"></td>

     			</tr>

     		<!--	<tr bgcolor="#FFFFFF">
     <td ><span class="tabletext"><p align="left"><b>Invoice Assess Value</b></p></font></td>
     <td width=20%><span class="labeltext"><input type="text" name="inv_assessval" id="inv_assessval" size=20
     value="<?php //echo $myrow[32] ?>"></td>
     <td ><span class="tabletext"><p align="left"><b>Invoice Duty Amount</b></p></font></td>
     <td ><span class="labeltext"><input type="text" name="inv_dutyamt" id="inv_dutyamt" size=20
     value="<?php //echo $myrow[33] ?>"></td></tr> -->
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
