<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="tablesi">

<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">

<tr>
    <td>&nbsp;</td> <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td colspan=13><span class="heading"><center><b>Stage Inspection Details</b></center></td>
</tr>

<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Operation No.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>1</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>2</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>3</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>4</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>5</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>6</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>7</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>8</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>9</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>10</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>11</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>12</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>13</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>14</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>15</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Remarks</center></b></td>
</tr>

<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>First off QC.</center></b></td>
<?php
     $i=1;
     
   while($i<=15)
   {
        $fchk = 'fchk' . $i;
        $fcheck = 'fcheck' . $i;
        $fopn = 'fopn' . $i;
        $fqc = 'fqc' . $i;
        
        if($userrole='SU' || ($userrole == 'RU' && $dept == 'QA'))
         {
            $disabled = '';
         }
        else
         {
            $disabled = "disabled='disabled'";
         }
         
        // echo $disabled;
     echo "<td bgcolor=#EEEFEE><span class='heading'><b><center><input type='checkbox' name='$fchk' id='$fcheck' onclick=onSelectstatus1('$fcheck','$fqc','$userid') $disabled></center></b>";
     echo "<input type='hidden' name='$fopn' id='$fqc'></td>";
     
     $i++;
   }
   
?>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='textbox' name='fremarks'></center></b></td>
</tr>

<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Production.</center></b></td>
<?php
     $i=1;
   while($i<=15)
   {
        $pchk = 'pchk' . $i;
        $pcheck = 'pcheck' . $i;
        $popn = 'popn' . $i;
        $pqc = 'pqc' . $i;
        
        $fcheck = 'fcheck' . $i;
        $fqc = 'fqc' . $i;
        
        if($userrole='SU' || ($userrole == 'RU' && $dept == 'Production'))
         {
            $disabled = '';
         }
        else
         {
            $disabled = "disabled='disabled'";
         }
         //echo $disabled;
     echo "<td bgcolor=#EEEFEE><span class='heading'><b><center><input type='checkbox' name='$pchk' id='$pcheck' onclick=onSelectstatus2('$pcheck','$pqc','$fcheck','$fqc','$userid') $disabled></center></b>";
     echo "<input type='hidden' name='$popn' id='$pqc'></td>";

     $i++;
   }

?>

<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='textbox' name='premarks'></center></b></td>
</tr>

<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>QC Sign.</center></b></td>
<?php
     $i=1;
   while($i<=15)
   {
        $chk = 'chk' . $i;
        $check = 'check' . $i;
        $opn = 'opn' . $i;
        $qc = 'qc' . $i;
        
        $fcheck = 'fcheck' . $i;
        $fqc = 'fqc' . $i;
        
        $pcheck = 'pcheck' . $i;
        $pqc = 'pqc' . $i;
        
        if($userrole='SU' || ($userrole == 'RU' && $dept == 'QA'))
         {
            $disabled = '';
         }
        else
         {
            $disabled = "disabled='disabled'";
         }
         //echo $disabled;
     echo "<td bgcolor=#EEEFEE><span class='heading'><b><center><input type='checkbox' name='$chk' id='$check' onclick=onSelectstatus3('$check','$qc','$fcheck','$fqc','$pcheck','$pqc','$userid') $disabled></center></b>";
     echo "<input type='hidden' name='$opn' id='$qc'></td>";

     $i++;
   }

?>

<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='textbox' name='remarks'></center></b></td>
</tr>

<!--<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>QC Sign.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk1' id="check1" onclick="onSelectstatus1('check1','qc1')"></center></b>
                                                       <input type='hidden' name='opn1' id='qc1'></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk2' id="check2" onclick="onSelectstatus1('check2','qc2')"></center></b>
                                                       <input type='hidden' name='opn2' id="qc2"></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk3' id="check3" onclick="onSelectstatus1('check3','qc3')"></center></b>
                                                       <input type='hidden' name='opn3' id="qc3"></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk4' id="check4" onclick="onSelectstatus1('check4','qc4')"></center></b>
                                                       <input type='hidden' name='opn4' id="qc4"></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk5' id="check5" onclick="onSelectstatus1('check5','qc5')"></center></b>
                                                       <input type='hidden' name='opn5' id="qc5"></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk6' id="check6" onclick="onSelectstatus1('check6','qc6')"></center></b>
                                                       <input type='hidden' name='opn6' id="qc6"></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk7' id="check7" onclick="onSelectstatus1('check7','qc7')"></center></b>
                                                       <input type='hidden' name='opn7' id="qc7"></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk8' id="check8" onclick="onSelectstatus1('check8','qc8')"></center></b>
                                                       <input type='hidden' name='opn8' id="qc8"></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk9' id="check9" onclick="onSelectstatus1('check9','qc9')"></center></b>
                                                       <input type='hidden' name='opn9' id="qc9"></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk10' id="check10" onclick="onSelectstatus1('check10','qc10')"></center></b>
                                                       <input type='hidden' name='opn10' id="qc10"></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk11' id="check11" onclick="onSelectstatus1('check11','qc11')"></center></b>
                                                       <input type='hidden' name='opn11' id="qc11"></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk12' id="check12" onclick="onSelectstatus1('check12','qc12')"></center></b>
                                                       <input type='hidden' name='opn12' id="qc12"></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk13' id="check13" onclick="onSelectstatus1('check13','qc13')"></center></b>
                                                       <input type='hidden' name='opn13' id="qc13"></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk14' id="check14" onclick="onSelectstatus1('check14','qc14')"></center></b>
                                                       <input type='hidden' name='opn14' id="qc14"></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk15' id="check15" onclick="onSelectstatus1('check15','qc15')"></center></b>
                                                       <input type='hidden' name='opn15' id="qc15"></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='textbox' name='remarks'></center></b></td>
</tr>       -->
<?php
/*      $x=1;
      while ($x<=5)
     {
    printf('<tr bgcolor="#FFFFFF">');
	$fidline_num="fidline_num" . $x;
	$qty_recd="qty_recd" . $x;
	$qty_accp="qty_accp" . $x;
	$cim_num="cim_num" . $x;
	$dc_qty="dc_qty" . $x;
	$insp_report_num="insp_report_num" . $x;
	$cust_information="cust_information" . $x;
	$fidremarks="fidremarks" . $x;


    echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$fidline_num\"  value=\"\" size=\"9%\"></td>";
    echo "<td ><input type=\"text\" name=\"$qty_recd\" size=\"20%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$qty_accp\" size=\"9%\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$cim_num\" size=\"20%\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$dc_qty\" size=\"9%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$insp_report_num\" size=\"20%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$cust_information\" size=\"25%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$fidremarks\" size=\"12%\" value=\"\"></td>";
    printf('</tr>');
	$x++;
    }
    echo "<input type=\"hidden\" name=\"indexfid\" value=$x>";  */

?>
    <input type="hidden" name="siproc" value="sientry">
