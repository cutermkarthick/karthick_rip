
<table id="tablefid" border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD">
<td colspan=11><span class="heading"><center><b>Final Inspection and Dispatch Details</b></center></td>
</tr>

<tr bgcolor="#FFFFFF"><td colspan=2><a href="javascript:addRow4fid('tablefid',document.forms[0].indexfid.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
<td colspan=11 bgcolor="#FFFFFF"><span class="tabletext">To delete line items - blankout line number</td></tr>

<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Sl.No</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty. Recd for Final<br>Inspection</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Qty Accp.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>CIM DC No.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>CIM DC Date</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>DC Qty.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Inspection Report No.</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Any Information from Customer</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Remarks</center></b></td>

</tr>


<?php
    $resultfid = $newfid->getfid($worecnum);
    $i=1;
                while ($myLI = mysql_fetch_row($resultfid))
                    {
					//echo "i am inside inner while loop";
					printf('<tr bgcolor="#FFFFFF">');
					$fidline_num="fidline_num" . $i;
					$qty_recd="qty_recd" . $i;
					$qty_accp="qty_accp" . $i;
					$cim_num="cim_num" . $i;
					$cim_date="cim_date" . $i;
					$dc_qty="dc_qty" . $i;
					$insp_report_num="insp_report_num" . $i;
					$cust_information="cust_information" . $i;
					$fidremarks="fidremarks" . $i;

					$fidprevlinenum="fidprevlinenum" . $i;
					$fidlirecnum="fidlirecnum" . $i;
					//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";

                    //echo $fidprevlinenum;
                    //echo $fidlirecnum;

                    echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$fidline_num\"  value=\"$myLI[0]\" size=\"4\"></td>";
					echo "<input type=\"hidden\" name=\"$fidprevlinenum\" value=\"$myLI[0]\">";
					echo "<input type=\"hidden\" name=\"$fidlirecnum\" value=\"$myLI[8]\">";

                    echo "<td><input type=\"text\" name=\"$qty_recd\" size=\"10\" value=\"$myLI[1]\"></td>";
                    echo "<td><input type=\"text\" name=\"$qty_accp\" size=\"5\" value=\"$myLI[2]\"></td>";
                    echo "<td><input type=\"text\" name=\"$cim_num\" size=\"10\" value=\"$myLI[3]\"></td>";
                    echo "<td><input type=\"text\" name=\"$cim_date\" size=\"10\" value=\"$myLI[9]\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$cim_date')\"></td>";
                    echo "<td><input type=\"text\" name=\"$dc_qty\" size=\"5\" value=\"$myLI[4]\"></td>";
					echo "<td><input type=\"text\" name=\"$insp_report_num\" size=\"20\" value=\"$myLI[5]\"></td>";
					echo "<td><input type=\"text\" name=\"$cust_information\" size=\"20\" value=\"$myLI[6]\"></td>";
                    echo "<td><input type=\"text\" name=\"$fidremarks\" size=\"20\" value=\"$myLI[7]\"></td>";

					printf('</tr>');
					$i++;
					}


				//echo "i am in outside while loop";
           /*  printf('<tr bgcolor="#FFFFFF">');
					$fidline_num="fidline_num" . $i;
					$qty_recd="qty_recd" . $i;
					$qty_accp="qty_accp" . $i;
					$cim_num="cim_num" . $i;
                    $cim_date="cim_date" . $i;
					$dc_qty="dc_qty" . $i;
					$insp_report_num="insp_report_num" . $i;
					$cust_information="cust_information" . $i;
					$fidremarks="fidremarks" . $i;

					$prevlinenum="prevlinenum" . $i;
					$lirecnum="lirecnum" . $i;
					//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";

                    echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$fidline_num\"  value=\"\" size=\"9%\"></td>";
					echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
					echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"\">";
                    echo "<td><input type=\"text\" name=\"$qty_recd\" size=\"9%\" value=\"\"></td>";
                    echo "<td><input type=\"text\" name=\"$qty_accp\" size=\"9%\" value=\"\"></td>";
                    echo "<td><input type=\"text\" name=\"$cim_num\" size=\"9%\" value=\"\"></td>";
                    echo "<td><input type=\"text\" name=\"$cim_date\" size=\"20%\" value=\"\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\"> <img src=\"images/bu-getdate.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$cim_date')\"></td>";
                    echo "<td><input type=\"text\" name=\"$dc_qty\" size=\"9%\" value=\"\"></td>";
					echo "<td><input type=\"text\" name=\"$insp_report_num\" size=\"9%\" value=\"\"></td>";
					echo "<td><input type=\"text\" name=\"$cust_information\" size=\"9%\" value=\"\"></td>";
                    echo "<td><input type=\"text\" name=\"$fidremarks\" size=\"9%\" value=\"\"></td>";

					printf('</tr>');
				$i++;   */

                echo "<input type=\"hidden\" name=\"indexfid\" value=$i>";
	            echo "<input type=\"hidden\" name=\"curindex\" value=$i>";


	?>
         <input type="hidden" name="fidproc" value="fidedit">



