<?
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'packingentry';
$page = "Invoice: Packing";
//////session_register('pagename');

//include('classes/packingClass.php');
include('classes/displayClass.php');
//$newPO = new packing;
$newdisp = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/packing.js"></script>
<html>
<head>
<title>New P/S</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form  action='packingProcess.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td></td></tr>
<tr>
<td>
<?php
$newdisp->dispLinks('');
?>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif" width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td> -->
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>New Packing List</b></td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>  </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
<td ><input type="text" name="company" id="company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value=""> <img src="images/bu-getcustomer.gif" alt="Get Customer"
                    onclick="GetAllCustomers()">  </td>
                    <input type="hidden" name="companyrecnum" id="companyrecnum" value=""></td>
</td>
<td width=15%><span class="labeltext"><p align="left">Packing No.</p></td>
<td ><input type="text" size=15  name="packingnum" id="packingnum"></td>
</tr>
<tr bgcolor="#FFFFFF">

<td width=15%><span class="labeltext"><p align="left">PO Date</p></td>
<td colspan=3><input type="text" id="podate" name="podate"
   				style="background-color:#DDDDDD;"size=20 value="">
  				 <input type="hidden" name="custporecnum" id="custporecnum" value="">

</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Work Order #</p></td>
<td ><input type="text" size=15  name="wonum" id="wonum"></td>
<td colspan=2></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=4>&nbsp;</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Item Description</p></td>
<td colspan=3><input type="text" size=100  name="item_descr" id="item_descr" value="Aerospace Parts"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=4>&nbsp;</td>
</tr>
</table>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">


		  <tr bgcolor="#FFFFFF">

		   		<td width="7%"><span class="tabletext">
		   <p align="left"><b>PO</b></p></font></td>

             <td width="7%"><span class="tabletext">
		   <p align="left"><b>Order Qty</b></p></font></td>

		   	<td width="7%"><span class="tabletext">
		   <p align="left"><b>QTY This<br>Shipment</b></p></font></td>

		     <td width="7%"><span class="tabletext">
            <p align="left"><b>Bal Qty To Be <br>Dispatched</b></p></font></td>

           </tr>

<tr bgcolor="#FFFFFF">
<td ><input type="text" size=15  name="ponum" id="ponum" style="background-color:#DDDDDD;"
  				 value=""><img src="images/bu-getpo.gif" alt="Get PO"  onclick="GetCustpo('this')"></td>
<td><input type="text" size=5  name="order_qty" id="order_qty" value="0"></td>
<td><input type="text" size=5  name="qty_disp" id="qty_disp" value="0"></td>
<td><input type="text" size=5  name="qty_bal" id="qty_bal" value="0"></td>
</tr>
<?
	  $i=1;
	  while($i<6)
	  {

	 echo(' <tr bgcolor="#FFFFFF">');
	 $ponum_li="ponum_li".$i;
	 $order_qtyli="order_qtyli".$i;
	 $this_shipment="this_shipment".$i;
	 $bal_dispatch="bal_dispatch".$i;

     //$remarks="remarks".$x;

       echo "<td><input type=\"text\" id=\"$ponum_li\" name=\"$ponum_li\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"15%\" value=\"$myLI[1]\">";
?>
<img src="images/bu-getpo.gif" alt="Get PO"  onclick="GetCustpo('<?php echo "$i";?>')"></td>

<?php
		   echo "<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$order_qtyli id=$order_qtyli type=text size=5 > </b></p></font></td>";
		   echo "<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$this_shipment id=$this_shipment type=text size=5 > </b></p></font></td>";
			echo "<td width=7%><span class=tabletext>
			<p align=left><b><input name=$bal_dispatch id=$bal_dispatch  type=text size=5 > </b></p></font></td>";

     printf('</tr>');
    	//<td width=30%><span class=tabletext>
		   //<p align=left><b><input name=$remarks type=text size=50></b></p></font></td>
	$i++;
    }
    echo "<input type=\"hidden\" name=\"index_qty\" id=\"index_qty\" value=$i>";
    echo "<input type=\"hidden\" name=\"curindex_qty\" id=\"curindex_qty\" value=$i>";

?>
</table>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">CIM Invoice No.</p></td>
<td colspan=3><input type="text" size=50  name="cim_invoice" id="cim_invoice">
                   <input type="hidden" name="ciminvoicerecnum" id="ciminvoicerecnum" value="0"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=4>&nbsp;</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Packing List Dated:</p></td>
<td colspan=3><input type="text" id="packdate" name="packdate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=25 value="">
				<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('packdate')">
</td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">No. Of Packings</p></td>
<td width=45%><span class="labeltext"><p align="left">Type Of Packing And Contents</p></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><input type="text" size=10  name="no_packing" id="no_packing"></td>
<td><input type="text" size=15  name="type_packing" id="type_packing">
<select name="packingtype" id="packingtype" size="1" width="10" onchange="onSelectType(this)">
                <option value=''>Please Specify</option>
                <option value='Wooden Box'>Wooden Box</option>
	            <option value='Corrugated Box'>Corrugated Box</option>
              </select></td>
</tr>
</table>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
                <tr bgcolor="#DDDEDD">
                    <td colspan=4><span class="heading"><center><b>Details</b></center></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" id="tablemm" class="stdtable1">
                <tr bgcolor="#FFFFFF">
                <td colspan=20><span class="heading"><a href="javascript:addRow('tablemm',document.forms[0].index.value)"> <img src="images/bu-addrow.gif" border="0"></a></td>
                </tr>

		  <tr bgcolor="#FFFFFF">
		 <td width="5%"><span class="tabletext">
           <p align="left"><b>Seq</b></p></font></td>

		   		<td width="7%"><span class="tabletext">
		   <p align="left"><b>Length<br>(In Inches)</b></p></font></td>

             <td width="7%"><span class="tabletext">
		   <p align="left"><b>Width<br>(In Inches)</b></p></font></td>

		   	<td width="7%"><span class="tabletext">
		   <p align="left"><b>Thickness<br>(In Inches)</b></p></font></td>

		     <td width="7%"><span class="tabletext">
            <p align="left"><b>Nett Weight</b></p></font></td>

            <td width="7%"><span class="tabletext">
            <p align="left"><b>Total Weight</b></p></font></td>

		    <td width="7%"><span class="tabletext">
            <p align="left"><b>No. of Boxes</b></p></font></td>

           </tr>
<?
	  $x=1;
	  while($x<6)
	  {

	 echo(' <tr bgcolor="#FFFFFF">');
	 $line_num="line_num" . $x;
	 $length="length".$x;
	 $width_po="width_po".$x;
	 $thickness="thickness".$x;
	 $net_weight="net_weight".$x;
	 $tot_weight="tot_weight".$x;
 	 $numboxes="numboxes".$x;

     //$remarks="remarks".$x;
			echo "
			<td width=5%><span class=tabletext>
           <p align=left><b><input name=$line_num id=$line_num type=text size=4></b></p></font></td>";
		   echo "<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$length id=$length type=text size=5> </b></p></font></td>";
		   echo "<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$width_po id=$width_po type=text size=5 > </b></p></font></td>";
		   echo "<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$thickness id=$thickness type=text size=5 > </b></p></font></td>";
			echo "<td width=7%><span class=tabletext>
			<p align=left><b><input name=$net_weight id=$net_weight  type=text size=5 > </b></p></font></td>";
             echo "<td width=7%><span class=tabletext>
			<p align=left><b><input name=$tot_weight id=$tot_weight  type=text size=5 > </b></p></font></td>";
		    echo "<td width=7%><span class=tabletext>
			<p align=left><b><input name=$numboxes id=$numboxes type=text size=5 > </b></p></font></td>";


     printf('</tr>');
    	//<td width=30%><span class=tabletext>
		   //<p align=left><b><input name=$remarks type=text size=50></b></p></font></td>
	$x++;
    }
    echo "<input type=\"hidden\" name=\"index\" id=\"index\" value=$x>";
    echo "<input type=\"hidden\" name=\"curindex\" id=\"curindex\" value=$x>";

?>

</table>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  class="stdtable1">
<tr bgcolor="#FFFFFF">
<td width=19%><span class="tabletext">
            <p align="left"><b>Remarks</b></p></font></td>
<td width=45%><span class=tabletext>
<p align=left><b><input name=remarks id=remarks type=text size=100></b></p></font></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Transportation By:</p></td>
<td ><input type="text" size=10  name="transportation" id="transportation" value="AIR" ></td></tr>
</table>
</tr>
</table>
</td>
</tr>
</table>
<!-- </td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table> -->
<table border = 0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>
<span class="tabletext"><input type="submit"
      style="color=#0066CC;background-color:#DDDDDD;width=130;"
      value="Submit" name="submit" onclick="javascript: return check_req_fields()">
      <INPUT TYPE="RESET"
           style="color=#0066CC;background-color:#DDDDDD;width=130;"
           VALUE="Reset" onclick="javascript: return allowReset()">
</FORM>
</body>
</html>


