<table id="tableirm" border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
<td colspan=13><span class="heading"><center><b>Incoming Raw Material Details</b></center></td>
</tr>
<tr bgcolor="#FFFFFF"><td colspan=2><a href="javascript:addRow4irm('tableirm',document.forms[0].indexirm.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
<td colspan=13 bgcolor="#FFFFFF"><span class="tabletext">To delete line items - blankout line number</td></tr>

<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE" rowspan=2 width=5% ><span class="heading"><b><center>Sl.No</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2 width=18%><span class="heading"><b><center>Purchase Order<br>Number</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2 width=7%><span class="heading"><b><center>PO Qty.</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2 width=18%><span class="heading"><b><center>MGP/DC No.</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2 width=18% nowrap><span class="heading"><b><center>&nbsp;&nbsp;&nbsp;&nbsp;MGP/DC Date&nbsp;&nbsp;&nbsp;&nbsp;</center></b></td>
<td bgcolor="#EEEFEE" colspan=4 width=18%><span class="heading"><b><center>Received RM Dimensions</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2 width=18%><span class="heading"><b><center>Qty. to make</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2 width=18%><span class="heading"><b><center>Customer Batch<br>Number</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2 width=18%><span class="heading"><b><center>Customer WO Number</center></b></td>
<td bgcolor="#EEEFEE" rowspan=2 width=18%><span class="heading"><b><center>RM Inspected by and<br>Remarks if any</center></b></td>
</tr>

<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Dim1</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Dim2</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Dim3</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Qty.</center></b></td>
</tr>


<?php
    $resultirm = $newirm->getirm($worecnum);
    $i=1;

                while ($myLI = mysql_fetch_row($resultirm))
                    {
                    
                    //echo 'aaa';
					//echo "i am inside inner while loop";
					printf('<tr bgcolor="#FFFFFF">');
                            $irmline_num="irmline_num" . $i;
	                        $po_num="po_num" . $i;
	                        $po_qty="po_qty" . $i;
	                        $mgp_num="mgp_num" . $i;
	                        $mgp_date="mgp_date" . $i;
	                        $rm_dim1="rm_dim1" . $i;
	                        $rm_dim2="rm_dim2" . $i;
	                        $rm_dim3="rm_dim3" . $i;
	                        $rm_qty="rm_qty" . $i;
	                        $qty_to_make="qty_to_make" . $i;
	                        $cust_batch_num="cust_batch_num" . $i;
	                        $cust_wo_num="cust_wo_num" . $i;
	                        $irmremarks="irmremarks" . $i;

					$prevlinenum="prevlinenum" . $i;
					$lirecnum="lirecnum" . $i;
					//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";

                    echo "<td width=18%><span class=\"tabletext\"><input type=\"text\"  name=\"$irmline_num\"  value=\"$myLI[0]\" size=\"4\"></td>";
					echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[0]\">";
					echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[12]\">";

                    echo "<td width=18%><input type=\"text\" name=\"$po_num\" size=\"10\" value=\"$myLI[1]\"></td>";
                    echo "<td width=18%> <input type=\"text\" name=\"$po_qty\" size=\"6\" value=\"$myLI[2]\"></td>";
                    echo "<td width=18%><input type=\"text\" name=\"$mgp_num\" size=\"10\" value=\"$myLI[3]\"></td>";
                    echo "<td width=18% text=nowrap><input type=\"text\" name=\"$mgp_date\" size=\"10\" value=\"$myLI[13]\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$mgp_date')\"></td>";
					echo "<td width=18%><input type=\"text\" name=\"$rm_dim1\" size=\"5\" value=\"$myLI[4]\"></td>";
					echo "<td width=18%><input type=\"text\" name=\"$rm_dim2\" size=\"5\" value=\"$myLI[5]\"></td>";
					echo "<td width=18%><input type=\"text\" name=\"$rm_dim3\" size=\"5\" value=\"$myLI[6]\"></td>";
                    echo "<td width=18%><input type=\"text\" name=\"$rm_qty\" size=\"5\" value=\"$myLI[7]\"></td>";
                    echo "<td width=18%><input type=\"text\" name=\"$qty_to_make\" size=\"7\" value=\"$myLI[8]\"></td>";
					echo "<td width=18%><input type=\"text\" name=\"$cust_batch_num\" size=\"10\" value=\"$myLI[9]\"></td>";
					echo "<td width=18%><input type=\"text\" name=\"$cust_wo_num\" size=\"10\" value=\"$myLI[10]\">";
					echo "<td width=18%><input type=\"text\" name=\"$irmremarks\" size=\"10\" value=\"$myLI[11]\">";
					printf('</tr>');
					$i++;
					}

                echo "<input type=\"hidden\" name=\"indexirm\" value=$i>";
	            echo "<input type=\"hidden\" name=\"curindex\" value=$i>";
                echo "<input type=\"hidden\" name=\"worecnum\" value=$worecnum>";

?>
         <input type="hidden" name="irmproc" value="irmedit">


