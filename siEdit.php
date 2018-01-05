<table id="tablesi" border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD">
<td colspan=17><span class="heading"><center><b>Stage Inspection Details</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Sl.No</center></b></td>
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
    $resultsi = $newsi->getsi($worecnum);
    while ($mysi = mysql_fetch_row($resultsi))
    {
    
      if($userrole=='SU' || ($userrole == 'RU' && $dept == 'QA'))
         {
            $disabled = '';
         }
        else
         {
            $disabled = 'true';
         }

?>
    <td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='fchk<?php echo $i?>' id='fcheck<?php echo $i?>' onclick="onSelectstatus1('fcheck<?php echo $i?>','fqc<?php echo $i?>','<?php echo $userid?>')" <?php if($mysi[2] != ''){echo 'checked';}?> <?php if($mysi[2] != ''){echo "disabled=true";} elseif($disabled == true) echo "disabled=$disabled"; ?>></center></b>
                                                           <input type='hidden' name='fopn<?php echo $i?>' id='fqc<?php echo $i?>' <?php if($mysi[2] != ''){ echo "value=$mysi[2]";}?>></td>

<?php

      $i++;
     }
?>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='textbox' name='fremarks' value='<?php $mysi = mysql_fetch_row($resultsi); echo $mysi[3]?>'></center></b></td>
</tr>


<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Production.</center></b></td>

<?php
    $i=1;
    $resultsi = $newsi->getsi($worecnum);
    while ($mysi = mysql_fetch_row($resultsi))
    {
    
       if($userrole=='SU' || ($userrole == 'RU' && $dept == 'Production'))
         {
            //echo "inside if $userrole $dept";
            $disabled = '';
         }
        else
         {
          //  echo 'inside else';
            $disabled = 'true';
         }

?>
    <td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='pchk<?php echo $i?>' id='pcheck<?php echo $i?>' onclick="onSelectstatus2('pcheck<?php echo $i?>','pqc<?php echo $i?>','fcheck<?php echo $i?>','fqc<?php echo $i?>','<?php echo $userid?>')" <?php if($mysi[4] != ''){echo 'checked';}?> <?php if($mysi[4] != ''){echo "disabled=true";}  elseif($disabled == true) echo "disabled=$disabled"; ?>></center></b>
                                                           <input type='hidden' name='popn<?php echo $i?>' id='pqc<?php echo $i?>' <?php if($mysi[4] != ''){ echo "value=$mysi[4]";}?>></td>

<?php

      $i++;
     }
?>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='textbox' name='premarks' value='<?php $mysi = mysql_fetch_row($resultsi); echo $mysi[5]?>'></center></b></td>
</tr>


<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>QC Sign.</center></b></td>

<?php
    $i=1;
    $resultsi = $newsi->getsi($worecnum);
    while ($mysi = mysql_fetch_row($resultsi))
    {
    
      if($userrole=='SU' || ($userrole == 'RU' && $dept == 'QA'))
         {
            $disabled = '';
         }
        else
         {
            $disabled = 'true';
         }

?>
    <td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk<?php echo $i?>' id='check<?php echo $i?>' onclick="onSelectstatus3('check<?php echo $i?>','qc<?php echo $i?>','fcheck<?php echo $i?>','fqc<?php echo $i?>','pcheck<?php echo $i?>','pqc<?php echo $i?>','<?php echo $userid?>')" <?php if($mysi[0] != ''){echo 'checked';}?> <?php  if($mysi[0] != ''){echo "disabled=true";} else if($disabled==true){echo "disabled=$disabled";}?>></center></b>
                                                           <input type='hidden' name='opn<?php echo $i?>' id='qc<?php echo $i?>' <?php if($mysi[0] != ''){ echo "value=$mysi[0]";}?>></td>
                                                           <input type='hidden' name='worecnum' value='<?php echo $worecnum?>'>
<?php

      $i++;
     }
?>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='textbox' name='remarks' value='<?php $mysi = mysql_fetch_row($resultsi); echo $mysi[1]?>'></center></b></td>
</tr>



<!--
<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>QC Sign.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk1'></center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk2'></center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk3'></center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk4'></center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk5'></center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk6'></center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk7'></center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk8'></center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk9'></center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk10'></center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk11'></center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk12'></center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk13'></center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk14'></center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='checkbox' name='chk15'></center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center><input type='textbox' name='rematks'></center></b></td>
</tr>
      -->

         <input type="hidden" name="siproc" value="siedit">


</table>
