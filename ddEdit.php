<table id="tabledd" border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD">
<td colspan=11><span class="heading"><center><b>Dispatch Details</b></center></td>
</tr>

<tr bgcolor="#FFFFFF"><td colspan=2><a href="javascript:addRow4dd('tabledd',document.forms[0].indexdd.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
<td colspan=11 bgcolor="#FFFFFF"><span class="tabletext">To delete line items - blankout line number</td></tr>

<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>line No.</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Purchase Order No.</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Component Serial No.</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Batch No.</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Qty</center></b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b><center>RM Gate Pass No.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>RM Gate Pass Date</center></b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b><center>Our D.C No</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Our D.C Date</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>INSPN report</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Inspector Approval</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>QC Head Approval</center></b></td>
</tr>


<?php
    $resultdd = $newdd->getdisp_det($worecnum);
    $i=1;
       while ($myLI = mysql_fetch_row($resultdd))
                    {
					//echo "i am inside inner while loop";
					printf('<tr bgcolor="#FFFFFF">');
					$line_num="line_num" . $i;
	                $pur_ord_num="pur_ord_num" . $i;
	                $comp_ser_num="comp_ser_num" . $i;
	                $batch_num="batch_num" . $i;
	                $qty="qty" . $i;
	                $gate_pass_num="gate_pass_num" . $i;
	                $gate_pass_date="gate_pass_date" . $i;
	                $dc_num="dc_num" . $i;
	                $dc_date="dc_date" . $i;
	                $inspn_report="inspn_report" . $i;
	                $insp_approval="insp_approval" . $i;
	                $qchead_approval="qchead_approval" . $i;


					$ddprevlinenum="ddprevlinenum" . $i;
					$ddlirecnum="ddlirecnum" . $i;
					//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";

                    echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$line_num\"  value=\"$myLI[1]\" size=\"4\"></td>";
					echo "<input type=\"hidden\" name=\"$ddprevlinenum\" value=\"$myLI[1]\">";
					echo "<input type=\"hidden\" name=\"$ddlirecnum\" value=\"$myLI[0]\">";

                    echo "<td><input type=\"text\" name=\"$pur_ord_num\" size=\"10\" value=\"$myLI[2]\"></td>";
                    echo "<td><input type=\"text\" name=\"$comp_ser_num\" size=\"10\" value=\"$myLI[3]\"></td>";
                    echo "<td><input type=\"text\" name=\"$batch_num\" size=\"5\" value=\"$myLI[4]\"></td>";
					echo "<td><input type=\"text\" name=\"$qty\" size=\"5\" value=\"$myLI[5]\"></td>";
					echo "<td><input type=\"text\" name=\"$gate_pass_num\" size=\"6\" value=\"$myLI[6]\"></td>";
					echo "<td><input type=\"text\" name=\"$gate_pass_date\" size=\"10\" value=\"$myLI[7]\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$gate_pass_date')\"></td>";
                    echo "<td><input type=\"text\" name=\"$dc_num\" size=\"6\" value=\"$myLI[8]\"></td>";
                    echo "<td><input type=\"text\" name=\"$dc_date\" size=\"10\" value=\"$myLI[9]\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$dc_date')\"></td>";
					echo "<td><input type=\"text\" name=\"$inspn_report\" size=\"10\" value=\"$myLI[10]\"></td>";
					echo "<td><input type=\"text\" name=\"$insp_approval\" size=\"10\" value=\"$myLI[11]\"></td>";
                    echo "<td><input type=\"text\" name=\"$qchead_approval\" size=\"10\" value=\"$myLI[12]\"></td>";

					printf('</tr>');
					$i++;
					}

				//echo "i am in outside while loop";

                echo "<input type=\"hidden\" name=\"indexdd\" value=$i>";
	            echo "<input type=\"hidden\" name=\"curindex\" value=$i>";


?>
         <input type="hidden" name="ddproc" value="ddedit">

</table>

