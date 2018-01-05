<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="tablemm">

<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">

<tr>
  <td colspan=1><a href="javascript:addRow4mm('tablemm',document.forms[0].indexmm.value)"> <img src="images/bu-addrow.gif" border="0"></a></td>
  <td colspan=11><span class="heading"><center><b>Material Movement Details</b></center></td>
</tr>

<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Sl.No</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty Drawn</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Drawn By</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Drawn Date</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Issued By</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Issued Date</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Recd By</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>From Sl.No</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>To Sl.No</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Accepted</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Rejected</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Returned</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Notes</center></b></td>
</tr>


<?php
      $x=1;
      while ($x<=5)
     {
    printf('<tr bgcolor="#FFFFFF">');
	$mmline_num="mmline_num" . $x;
	$qty_drawn="qty_drawn" . $x;
	$drawn_by="drawn_by" . $x;
	$drawn_date="drawn_date" . $x;
	$issued_by="issued_by" . $x;
	$issued_date="issued_date" . $x;
	$recd_by="recd_by" . $x;
	$sl_from="sl_from" . $x;
	$sl_to="sl_to" . $x;
	$accepted="accepted" . $x;
	$rejected="rejected" . $x;
	$returned="returned" . $x;
	$notes="notes" . $x;

    echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$mmline_num\"  value=\"\" size=\"9%\"></td>";
    echo "<td ><input type=\"text\" name=\"$qty_drawn\" size=\"9%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$drawn_by\" size=\"9%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$drawn_date\" size=\"9%\" value=\"\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$drawn_date')\"></td>";
	echo "<td ><input type=\"text\" name=\"$issued_by\" size=\"9%\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$issued_date\" size=\"9%\" value=\"\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$issued_date')\"></td>";
	echo "<td ><input type=\"text\" name=\"$recd_by\" size=\"9%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$sl_from\" size=\"9%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$sl_to\" size=\"9%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$accepted\" size=\"9%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$rejected\" size=\"9%\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$returned\" size=\"9%\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$notes\" size=\"9%\" value=\"\"></td>";
	printf('</tr>');
	$x++;
    }
    echo "<input type=\"hidden\" name=\"indexmm\" value=$x>";

?>
    <input type="hidden" name="mmproc" value="mmentry"> 
