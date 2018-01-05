<table id="tablemm" border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD">
<td colspan=12><span class="heading"><center><b>Material Movement Details</b></center></td>
</tr>

<tr bgcolor="#FFFFFF"><td colspan=2><a href="javascript:addRow4mm('tablemm',document.forms[0].indexmm.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
<td colspan=12 bgcolor="#FFFFFF"><span class="tabletext">To delete line items - blankout line number</td></tr>

<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Sl.No</center></b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b><center>Qty Drawn</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Drawn By</center></b></td>
<td bgcolor="#EEEFEE" width=12% nowrap><span class="heading"><b><center>&nbsp;&nbsp;&nbsp;&nbsp;Drawn Date&nbsp;&nbsp;&nbsp;&nbsp;</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Issued By</center></b></td>
<td bgcolor="#EEEFEE" width=12% nowrap><span class="heading"><b><center>&nbsp;&nbsp;&nbsp;&nbsp;Issued Date&nbsp;&nbsp;&nbsp;&nbsp;</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Recd By</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>From Sl.No</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>To Sl.No</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Accepted</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Rejected</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Returned</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Notes</center></b></td>
</tr>

<?php
    $resultmm = $newmm->getmm($worecnum);
    $i=1;
   // echo $worecnum;
    


                while ($myLI = mysql_fetch_row($resultmm))
                    {
					//echo "i am inside inner while loop";
					printf('<tr bgcolor="#FFFFFF">');
					$mmline_num="mmline_num" . $i;
					$qty_drawn="qty_drawn" . $i;
					$drawn_by="drawn_by" . $i;
                    $drawn_date="drawn_date" . $i;
	                $issued_by="issued_by" . $i;
	                $issued_date="issued_date" . $i;
					$recd_by="recd_by" . $i;
					$sl_from="sl_from" . $i;
					$sl_to="sl_to" . $i;
					$accepted="accepted" . $i;
                    $rejected="rejected" . $i;
                    $returned="returned" . $i;
                    $notes="notes" . $i;

					$mmprevlinenum="mmprevlinenum" . $i;
					$mmlirecnum="mmlirecnum" . $i;
					//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
					
				//	echo "worecnum" . $worecnum;
				//	echo "prevlinenum" . $myLI[0];
				//	echo "lirecnum" . $myLI[11];
				
			//	echo " $prevlinenum is " . $myLI[0];

                    echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$mmline_num\"  value=\"$myLI[0]\" size=\"4\"></td>";
					echo "<input type=\"hidden\" name=\"$mmprevlinenum\" value=\"$myLI[0]\">";
					echo "<input type=\"hidden\" name=\"$mmlirecnum\" value=\"$myLI[11]\">";

                    echo "<td><input type=\"text\" name=\"$qty_drawn\" size=\"6\" value=\"$myLI[1]\"></td>";
                    echo "<td><input type=\"text\" name=\"$drawn_by\" size=\"10\" value=\"$myLI[2]\"></td>";
                    echo "<td><input type=\"text\" name=\"$drawn_date\" size=\"10\" value=\"$myLI[12]\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$drawn_date')\"></td>";
	                echo "<td><input type=\"text\" name=\"$issued_by\" size=\"10\" value=\"$myLI[3]\"></td>";
	                echo "<td><input type=\"text\" name=\"$issued_date\" size=\"10\" value=\"$myLI[13]\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\"> <img src=\"images/bu-getdateicon.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$issued_date')\"></td>";
					echo "<td><input type=\"text\" name=\"$recd_by\" size=\"10\" value=\"$myLI[4]\"></td>";
					echo "<td><input type=\"text\" name=\"$sl_from\" size=\"5\" value=\"$myLI[5]\"></td>";
					echo "<td><input type=\"text\" name=\"$sl_to\" size=\"5\" value=\"$myLI[6]\"></td>";
                    echo "<td><input type=\"text\" name=\"$accepted\" size=\"5\" value=\"$myLI[7]\"></td>";
                    echo "<td><input type=\"text\" name=\"$rejected\" size=\"5\" value=\"$myLI[8]\"></td>";
					echo "<td><input type=\"text\" name=\"$returned\" size=\"5\" value=\"$myLI[9]\"></td>";
					echo "<td><input type=\"text\" name=\"$notes\" size=\"10\" value=\"$myLI[10]\">";
					printf('</tr>');
					$i++;
					}

				//echo "i am in outside while loop";
  /*  printf('<tr bgcolor="#FFFFFF">');
		            $item="item" . $i;
					$qty_drawn="qty_drawn" . $i;
					$drawn_by="drawn_by" . $i;
                    $drawn_date="drawn_date" . $i;
	                $issued_by="issued_by" . $i;
	                $issued_date="issued_date" . $i;
					$recd_by="recd_by" . $i;
					$sl_from="sl_from" . $i;
					$sl_to="sl_to" . $i;
					$accepted="accepted" . $i;
                    $rejected="rejected" . $i;
                    $returned="returned" . $i;
                    $notes="notes" . $i;
				    $prevlinenum="prevlinenum" . $i;
				    $lirecnum="lirecnum" . $i;
				    //echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
				    echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$item\"  value=\"\" size=\"9%\"></td>";
				    echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
				    echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"\">";

                    echo "<td><input type=\"text\" name=\"$qty_drawn\" size=\"9%\" value=\"\"></td>";
                    echo "<td><input type=\"text\" name=\"$drawn_by\" size=\"9%\"  value=\"\"></td>";
                    echo "<td><input type=\"text\" name=\"$drawn_date\" size=\"9%\" value=\"\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\"> <img src=\"images/bu-getdate.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$drawn_date')\"></td>";
	                echo "<td><input type=\"text\" name=\"$issued_by\" size=\"9%\" value=\"\"></td>";
	                echo "<td><input type=\"text\" name=\"$issued_date\" size=\"9%\" value=\"\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\"> <img src=\"images/bu-getdate.gif\" alt=\"Get BookDate\" onclick=\"GetDate('$issued_date')\"></td>";
					echo "<td><input type=\"text\" name=\"$recd_by\" size=\"9%\"  value=\"\"></td>";
					echo "<td><input type=\"text\" name=\"$sl_from\" size=\"9%\"  value=\"\"></td>";
					echo "<td><input type=\"text\" name=\"$sl_to\" size=\"9%\"  value=\"\"></td>";
                    echo "<td><input type=\"text\" name=\"$accepted\" size=\"9%\"  value=\"\"></td>";
                    echo "<td><input type=\"text\" name=\"$rejected\" size=\"9%\"  value=\"\"></td>";
					echo "<td><input type=\"text\" name=\"$returned\" size=\"9%\"  value=\"\"></td>";
					echo "<td><input type=\"text\" name=\"$notes\" size=\"9%\"  value=\"\"></td>";

				printf('</tr>');
				$i++;
   	}   */
                echo "<input type=\"hidden\" name=\"indexmm\" value=$i>";
	            echo "<input type=\"hidden\" name=\"curindex\" value=$i>";


	?>
         <input type="hidden" name="mmproc" value="mmedit">


    
