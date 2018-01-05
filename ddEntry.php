<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="tabledd">

<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">

<tr>
  <td colspan=1><a href="javascript:addRow4dd('tabledd',document.forms[0].indexdd.value)"> <img src="images/bu-addrow.gif" border="0"></a></td>
  <td colspan=10><span class="heading"><center><b>Dispatch Details</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE" width='6%'><span class="heading"><b><center>line No.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Purchase Order No.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Component Serial No</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Batch No.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>RM Gate Pass No.</center></b></td>
<td bgcolor="#EEEFEE" width='15%'><span class="heading"><b><center>RM Gate Pass Date</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Our D.C No</center></b></td>
<td bgcolor="#EEEFEE" width='15%'><span class="heading"><b><center>Our D.C date</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>INSPN report</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Inspector Approval</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>QC Head Approval</center></b></td>
</tr>

<?php
      $x=1;
      while ($x<=1)
     {
    printf('<tr bgcolor="#FFFFFF">');
    $line_num="line_num" . $x;
	$pur_ord_num="pur_ord_num" . $x;
	$comp_ser_num="comp_ser_num" . $x;
	$batch_num="batch_num" . $x;
	$qty="qty" . $x;
	$gate_pass_num="gate_pass_num" . $x;
	$gate_pass_date="gate_pass_date" . $x;
	$dc_num="dc_num" . $x;
	$dc_date="dc_date" . $x;
	$inspn_report="inspn_report" . $x;
	$insp_approval="insp_approval" . $x;
	$qchead_approval="qchead_approval" . $x;

    echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$line_num\"  value=\"\" size=\"5\"></td>";
    echo "<td><input type=\"text\"  name=\"$pur_ord_num\"  value=\"\" size=\"10\"></td>";
    echo "<td ><input type=\"text\" name=\"$comp_ser_num\" size=\"10\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$batch_num\" size=\"10\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$qty\" size=\"5\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$gate_pass_num\" size=\"10\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$gate_pass_date\" size=\"10\" value=\"\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$gate_pass_date')\"></td>";
    echo "<td ><input type=\"text\" name=\"$dc_num\" size=\"10\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$dc_date\" size=\"10\" value=\"\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$dc_date')\"></td>";
    echo "<td ><input type=\"text\" name=\"$inspn_report\" size=\"10\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$insp_approval\" size=\"\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$qchead_approval\" size=\"\" value=\"\"></td>";
    printf('</tr>');
	$x++;
    }
    echo "<input type=\"hidden\" name=\"indexdd\" value=$x>";

?>
    <input type="hidden" name="ddproc" value="ddentry">
