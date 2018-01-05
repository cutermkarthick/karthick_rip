<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="tablefid">
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">

<tr>
    <td colspan=1><a href="javascript:addRow4fid('tablefid',document.forms[0].indexfid.value)"> <img src="images/bu-addrow.gif" border="0"></a></td>
    <td colspan=17><span class="heading"><center><b>Final Inspection and Dispatch Details</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Sl.No</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty. Recd for Final<br>Inspection</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty Accp.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>CIM DC No.</center></b></td>
<td bgcolor="#EEEFEE" width=22%><span class="heading"><b><center>CIM DC Date</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>DC Qty.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Inspection Report No.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Any Information from Customer</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Remarks</center></b></td>
</tr>


<?php
      $x=1;
      while ($x<=5)
     {
    printf('<tr bgcolor="#FFFFFF">');
	$fidline_num="fidline_num" . $x;
	$qty_recd="qty_recd" . $x;
	$qty_accp="qty_accp" . $x;
	$cim_num="cim_num" . $x;
	$cim_date="cim_date" . $x;
	$dc_qty="dc_qty" . $x;
	$insp_report_num="insp_report_num" . $x;
	$cust_information="cust_information" . $x;
	$fidremarks="fidremarks" . $x;

    echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$fidline_num\"  value=\"\" size=\"9%\"></td>";
    echo "<td ><input type=\"text\" name=\"$qty_recd\" size=\"20%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$qty_accp\" size=\"9%\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$cim_num\" size=\"20%\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$cim_date\" size=\"20%\" value=\"\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$cim_date')\"></td>";
	echo "<td ><input type=\"text\" name=\"$dc_qty\" size=\"9%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$insp_report_num\" size=\"20%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$cust_information\" size=\"25%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$fidremarks\" size=\"12%\" value=\"\"></td>";
    printf('</tr>');
	$x++;
    }
    echo "<input type=\"hidden\" name=\"indexfid\" value=$x>";

?>
    <input type="hidden" name="fidproc" value="fidentry">
