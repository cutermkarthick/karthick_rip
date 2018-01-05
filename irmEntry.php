<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="tableirm">
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">

<tr>
  <td colspan=1><a href="javascript:addRow4irm('tableirm',document.forms[0].indexirm.value)"> <img src="images/bu-addrow.gif" border="0"></a></td>
<td colspan=11><span class="heading"><center><b>Incoming Raw Materials Details</b></center></td>
</tr>



<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Sl.No</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Purchase Order<br>Number</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>PO Qty.</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>MGP/DC No.</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2 width='10%'><span class="heading"><b><center>MGP/DC Date</center></b></td>
<td bgcolor="#EEEFEE" colspan=4><span class="heading"><b><center>Received RM Dimensions</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Qty. to make</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Customer Batch<br>Number</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Customer WO Number</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>RM Inspected by and<br>Remarks if any</center></b></td>
</tr>

<tr bgcolor="#FFFFFF">
 <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim1</center></b></td>
 <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim2</center></b></td>
 <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim3</center></b></td>
 <td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty.</center></b></td>
</tr>


<?php
      $x=1;
      while ($x<=5)
     {
    printf('<tr bgcolor="#FFFFFF">');
	$irmline_num="irmline_num" . $x;
	$po_num="po_num" . $x;
	$po_qty="po_qty" . $x;
	$mgp_num="mgp_num" . $x;
	$mgp_date="mgp_date" . $x;
	$rm_dim1="rm_dim1" . $x;
	$rm_dim2="rm_dim2" . $x;
	$rm_dim3="rm_dim3" . $x;
	$rm_qty="rm_qty" . $x;
	$qty_to_make="qty_to_make" . $x;
	$cust_batch_num="cust_batch_num" . $x;
	$cust_wo_num="cust_wo_num" . $x;
	$irmremarks="irmremarks" . $x;

    echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$irmline_num\"  value=\"\" size=\"9%\"></td>";
    echo "<td ><input type=\"text\" name=\"$po_num\" size=\"9%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$po_qty\" size=\"9%\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$mgp_num\" size=\"9%\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$mgp_date\" size=\"9%\" value=\"\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$mgp_date')\"></td>";
	echo "<td ><input type=\"text\" name=\"$rm_dim1\" size=\"9%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$rm_dim2\" size=\"9%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$rm_dim3\" size=\"9%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$rm_qty\" size=\"9%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$qty_to_make\" size=\"9%\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$cust_batch_num\" size=\"9%\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$cust_wo_num\" size=\"9%\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$irmremarks\" size=\"9%\" value=\"\"></td>";
	printf('</tr>');
	$x++;
    }
    echo "<input type=\"hidden\" name=\"indexirm\" value=$x>";

?>
    <input type="hidden" name="irmproc" value="irmentry">
